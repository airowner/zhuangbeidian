<?php

class SphinxComponent extends Component
{

    private $inited = false;
    private $svc;
    private $index;

    private function init()
    {
        if($this->inited) return;
        require dirname(__FILE__) . '/sphinxapi.php';
        $this->svc = new SphinxClient();
        $this->svc->setServer('127.0.0.1', 9312);
        $this->index = 'zbd_index,zbd_index_delta';
        $this->inited = true;
    }

    private function clean()
    {
        $this->init();
        $this->svc->SetConnectTimeout(300); //300ms
        $this->svc->SetRetries(2, 1000); //retry_count , retry_separate
        // $this->SetArrayResult(true); //结果已数组形式返回， 对mva分组可能包括重复的文档
        $this->svc->ResetFilters();
        $this->svc->ResetGroupBy();
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
     * sort (array) 一种类似于SQL的排序语法, 由主到次 array("a"=>"desc", "b"=>"asc")
     *
     * todo
     * group 关键词的加入 , 进行分组的查询
     */
    public function query($kw, $filter=array(), $sort=array())
    {
        $this->clean();
        $keywords = $this->make_keywords($kw);
        $this->make_filter($filter);
        $this->make_sort($sort);
        return $this->_query($keywords);
    }

    public function fuzzyQuery($kw, $filter=array(), $sort=array())
    {
        $this->clean();
        $keywords = $this->make_keywords($kw);
        $this->make_filter($filter);
        $this->make_sort($sort);
        $this->svc->SetMatchMode( SPH_MATCH_ANY );
        return $this->_query($keywords);
    }

    private function _query($keywords)
    {
        $result = $this->svc->query($keywords, $this->index);
        if($result === false){
            $errmsg = $this->svc->GetLastError();
            throw new Exception($errmsg);
        }

        $warings = $this->svc->GetLastWarning();
        GLogFinder::bizLogger()->error(json_encode($warings));

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
        $ret = array();
        foreach($result as $docid => $value){
            $tmp = array(
                'id' => $docid,
                'weight' => $value['weight'],
            );
            $tmp += $value['attrs'];
            $ret[] = $tmp;
        }
        return array(
            'total' => $total,
            'cost_time' => $cost_time,
            'items' => $ret,
        );
    }

    private function make_keywords($kw)
    {
        $kw = (array)$kw;
        $keywords = array();
        $extend = false;
        foreach($kw as $key => $value){
            if(is_numeric($key)){
                $keywords[] = $this->svc->EscapeString($value);
            }else{
                $keywords[] = "@{$key} " . $this->svc->EscapeString($value);
                $extend = true;
            }
        }
        if($extend){
            $this->svc->SetMatchMode ( SPH_MATCH_EXTENDED2 );
        }else{
            if($keywords){
                $this->svc->SetMatchMode ( SPH_MATCH_ALL );
            }else{
                $this->svc->SetMatchMode ( SPH_MATCH_FULLSCAN );
            }
        }
        return implode(" ", $keywords);
    }

    private function make_filter($filter)
    {
        assert(is_array($filter));
        foreach($filter as $key => $value){
            if(is_int($key)){
                $this->make_filter($value);
            }else{
                if(is_array($value)){
                    $exclude = false;
                    if(isset($value['exclude'])){
                        $exclude = $value['exclude'];
                        unset($value['exclude']);
                    }
                    if(count($value)==1){
                        $this->svc->SetFilter($key, intval($value[0]), $exclude);
                    }else{
                        if(is_float($value[0]) || is_float($value[1])){
                            $this->svc->SetFilterFloatRange($key, intval($value[0]), intval($value[1]), $exclude);
                        }else{
                            $this->svc->SetFilterRange($key, intval($value[0]), intval($value[1]), $exclude);
                        }
                    }
                }else{
                    $this->svc->SetFilter($key, $value);
                }
            }
        }
    }

    private function make_sort($sorts=array())
    {
        assert(is_array($sorts));
        $sort_modes = array('ASC'=>1, 'DESC'=>1);
        $end_sort = array();
        foreach($sorts as $sort_key => $sort_mode){
            $sort_mode = strtoupper($sort_mode);
            if(!isset($sort_modes[$sort_mode])) continue;
            $end_sort[] = "$sort_key $sort_mode";
        }
        if($end_sort){
            $end_sort[] = "@relevance DESC";
            $this->svc->SetSortMode( SPH_SORT_EXTENDED, implode(",", $end_sort) );
        }else{
            $this->svc->SetSortMode( SPH_SORT_RELEVANCE );
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
