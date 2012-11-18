<?php

class SphinxComponent extends Component
{
    static $index = 'zbd_index';

    static public function ins()
    {   
        static $svc = null;
        if($svc == null){
	    require dirname(__FILE__) . '/sphinxapi.php';
            $svc = new SphinxClient();
            $svc->setServer('127.0.0.1', 9312);
        }   
        return $svc;
    }   

    /*
     * kw (string|array) 搜索关键字 
     * 数组可以表明要查找的字段, 比如只搜索name字段
     * kw = array('name' => '张三');
     * 否则进行全文检索
     * kw = array('李四');
     *
     * filter (array) 过滤关键字, 过滤值必须为 int 或 float, 
     * 可以包括exclude key, exclude为true用来表示不包括不包括过滤值, false表示仅从范围内搜索, 默认为false
     * filter = array('money'=>100) 表示只查找money == 100 的
     * filter = array('money'=>array(100, 200)) 表示只查找money 在 100 至 200 之间的
     * filter = array('money'=>array(100, 200, 'exclude'=>true)) 表示查找结果中不包含 money 在 100 至 200 之间的
     *
     * todo
     * group 关键词的加入 , 进行分组的查询
     */
    public function query($kw, $filter=array())
    {
    	$svc = self::ins();
        $keywords = self::make_keywords($svc, $kw);
        self::make_filters($svc, $filter);

        $result = $svc->query($kw, self::$index);
        if($result === false){
            $errmsg = $svc->GetLastError();
            throw new Exception($errmsg);
        }   
        $warings = $svc->GetLastWarning();
        CakeLog::error(json_encode($warings));

        //$fields = $result['fields']; //查询依据字段
        //$attrs = $result['attrs']; //查询返回字段属性
        $total = $result['total'];
        //$totalfound = $result['totalfound'];
        $cost_time = $result['time'];
        //$words = $result['words']; //查询关键字
        /*
         *  ["matches"]=> array(1) { [5599342]=> array(2) { ["weight"]=> string(1) "1" ["attrs"]=> array(3) { ["uid"]=> string(16) "1792383540063741" ["
         */
        $result = is_array($result['matches']) ? $result['matches'] : array();
        return array(
            'total' => $total,
            'cost_time' => $cost_time,
            'result' => $result,
        );
    }

    private static function make_keywords($svc, $kw)
    {
        $kw = (array)$kw;
        $keywords = array();
        $extend = false;
        foreach($kw as $key => $value){
            if(is_numeric($key)){
                $keywords[] = $svc->EscapeString($value);
            }else{
                $keywords[] = "@{$key} " . $svc->EscapeString($value);
                $extend = true;
            }
        }
        if($extend){
            $svc->SetMatchMode ( SPH_MATCH_EXTENDED2 );
        }else{
            if($keywords){
                $svc->SetMatchMode ( SPH_MATCH_ALL );
            }else{
                $svc->SetMatchMode ( SPH_MATCH_FULLSCAN );
            }
        }
        return implode(" ", $keywords);
    }

    private static function make_filters($svc, $filter)
    {
        assert(is_array($filter));
        foreach($filter as $key => $value){
	    if(is_int($key)){
	    	self::make_filters($svc, $value);
	    }else{
                if(is_array($value)){
                    $exclude = false;
                    if(isset($value['exclude'])){
                        $exclude = $value['exclude'];
                        unset($value['exclude']);
                    }
                    if(count($value)==1){
                        $svc->SetFilter($key, intval($value[0]), $exclude);
                    }else{
                        if(is_float($value[0]) || is_float($value[1])){
                            $svc->SetFilterFloatRange($key, intval($value[0]), intval($value[1]), $exclude);
                        }else{
                            $svc->SetFilterRange($key, intval($value[0]), intval($value[1]), $exclude);
                        }
                    }
                }else{
                    $svc->SetFilter($key, $value);
                }
	    }
        }
    }


    public function __call($name, $params)
    {
    	$svc = self::ins();
        if(method_exists($svc, $name)){
            return call_user_func_array(array($svc, $name), $params);
        }
        throw new Exception('undefined function');
    }
}
