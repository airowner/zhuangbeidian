<?php

class TaobaoComponent extends Component
{
/*
	 array (
	  'approve_status' => 'onsale',
	  'auction_point' => 0,
	  'cid' => 1101,
	  'delist_time' => '2012-08-13 20:16:43',
	  'desc' => '',#描述页
	  'detail_url' => 'http://item.taobao.com/item.htm?id=18446972931&spm=2014.12129701.0.0',
	  'ems_fee' => '0.00',
	  'express_fee' => '0.00',
	  'freight_payer' => 'seller',
	  'has_discount' => false,
      'has_invoice' => false,
	  'has_showcase' => false,
	  'has_warranty' => true,
	  'input_pids' => '14837354',
	  'input_str' => '5公斤',
	  'is_virtual' => false,
	  'item_imgs' => 
	  array (
	    'item_img' => 
	    array (
	      0 => 
	      array (
	        'id' => 0,
	        'position' => 0,
	        'url' => 'http://img06.taobaocdn.com/bao/uploaded/i6/T1sZaDXXRzXXXMolgW_024416.jpg',
	      ),
	    ),
	  ),
	  'list_time' => '2012-08-06 20:16:43',
	  'location' => 
	  array (
	    'city' => '上海',
	    'state' => '上海',
	  ),
	  'modified' => '2012-08-11 17:02:16',
	  'nick' => '方承实业',
	  'num' => 983,
	  'num_iid' => 18446972931,
	  'outer_id' => '',
	  'pic_url' => 'http://img06.taobaocdn.com/bao/uploaded/i6/T1sZaDXXRzXXXMolgW_024416.jpg',
	  'post_fee' => '0.00',
	  'postage_id' => 0,
	  'price' => '7999.00',
	  'property_alias' => '1627207:28341:大陆行货',
	  'props' => '14837354:8346491;20000:30111;3127340:38597;31182:152318040;20100:21372;31356:99825;20143:124862591;14513524:148396841;20183:21968;31357:72163639;20121:14873065;20122:65242;14636630:3222910;20137:21955;20145:11669893;1626817:3422062;1626817:107193199;1626975:3229217;4012728:12805419;21530:122742847;20930:32998;31696:137283541;20420:27389;14495765:33214235;14528434:6548912;14528551:24312922;14528616:80137;14528616:3218357;20879:21456',
	  'seller_cids' => ',225095017,225092888,',
	  'stuff_status' => 'new',
	  'title' => '实体2012款13寸Apple/苹果 MacBook Pro MD101CH/A正品行货笔记本',
	  'type' => 'fixed',
	  'valid_thru' => 7,
	  );
	 */
	public function getItem($num_id)
	{
		var_dump($num_id);exit;
	    static $request = null;
	    if(!$request){
	        include(WWW_ROOT . '../Lib/top/request/ItemGetRequest.php');
	        $request = new ItemGetRequest();
	$request->setFields("detail_url,num_iid,title,nick,type,cid,seller_cids,props,input_pids,input_str,desc,pic_url,num,valid_thru,list_time,delist_time,stuff_status,location,price,post_fee,express_fee,ems_fee,has_discount,freight_payer,has_invoice,has_warranty,has_showcase,modified,increment,approve_status,postage_id,product_id,auction_point,property_alias,item_img,prop_img,sku,video,outer_id,is_virtual");
	    }
	    $request->setNumIid($num_id);
	    $result = self::ins()->execute($request);
	    $result = self::parse_taobao($result);
	    if($result && isset($result['item_get_response'], $result['item_get_response']['item'])){
	        $result = $result['item_get_response']['item'];
	    }
	    return $result;
	}
	
	public function getItemByUrl($url)
	{
		$num_id = self::getTaobaoId($url);
		if(!$num_id){
			return false;
		}
		return $this->getItem($num_id);
  	}

/*
	 array (
	    'bulletin' => '',
	    'cid' => 10,
	    'created' => '2012-06-16 19:44:43',
	    'desc' => '这是店铺描述。....................',
	    'modified' => '2012-08-20 12:46:28',
	    'nick' => 'sandbox_b_20',
	    'pic_path' => '',
	    'sid' => 50795559,
	    'title' => 'sandbox_b_20的测试商城店铺',
	  ),
*/
	public function getShop($taobao_nick)
	{
	    static $request = null;
	    if(!$request){
	        include(WWW_ROOT . '../Lib/top/request/ShopGetRequest.php');
	        $request = new ShopGetRequest();
	        $request->setFields("sid,cid,title,nick,desc,bulletin,pic_path,created,modified");
	    }
	    $request->setNick($taobao_nick);
	    $result = self::ins()->execute($request);
	    $result = self::parse_taobao($result);
	    if($result){
	        $result = $result['shop'];
	    }
	    return $result;
	}

	private static function parse_taobao($result)
	{
		var_dump($result);exit;
		$result = @json_decode($result);
		var_dump($result);exit;
		if($result->code){
			$error = '';
			if(isset($result->msg)){
				$error .= $result->msg;
			}
			if(isset($result->submsg)){
				$error .= ' '. $result->submsg;
			}
			throw new Exception($error);
		}
		//parse
		return @json_decode($result, true);
	}


	private static function ins()
	{
		static $client = null;
		if($client === null){			                              
		    include(WWW_ROOT . '../Lib/top/TopClient.php');
	        include(WWW_ROOT . '../Lib/top/RequestCheckUtil.php');
	        //~ TopConf::$online = false;
	        $client = new TopClient();
		}
		return $client;
	}

	private static function getTaobaoId($url)
	{
	    if(!preg_match('/[^\/\s]+(taobao|tmall)\.com\//', $url)){
	        return false;
	    }
	    $id = false;
	    $query = parse_url($url, PHP_URL_QUERY);
	    parse_str($query, $q_ary);
		var_dump($q_ary);
	    foreach($q_ary as $key => $value){
	        switch($key){
	            case 'id':
	                $id = intval($value);
	                break;
	        }
	    }
		return $id;
	}
}
                          

