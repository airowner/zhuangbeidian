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

	public function Item($num_id)
	{
		static $request = null;
		if(!$request){
			include(WWW_ROOT . '../Lib/top/request/ItemGetRequest.php');
			$request = new ItemGetRequest();
			$request->setFields("detail_url,num_iid,title,nick,type,cid,seller_cids,props,input_pids,input_str,desc,pic_url,num,valid_thru,list_time,delist_time,stuff_status,location,price,post_fee,express_fee,ems_fee,has_discount,freight_payer,has_invoice,has_warranty,has_showcase,modified,increment,approve_status,postage_id,product_id,auction_point,property_alias,item_img,prop_img,sku,video,outer_id,is_virtual");
		}
		$request->setNumIid($num_id);
		return self::request($request, 'item');
	}

	public function TKItemByUrl($url)
	{
		$num_id = self::getTaobaoId($url);
		if(!$num_id){
			return false;
		}
		$result = $this->TKItem($num_id);
		if($result){
			$result = $result[0];
		}
		return $result;
	}

	/*
	   返回数据类型同基本获取,　同时可传入１０个num_iid
	   {"taobaoke_items_detail_get_response":{"taobaoke_item_details":{
	   "taobaoke_item_detail":[{
	   "click_url":"",
	   "item":{}, //其余商品细细
	   "seller_credit_score":14,
	   "shop_click_url":""}]
	   },
	   "total_results":1
	   }}
	 */
	public function TKItem($num_iids)
	{
		static $request = null;
		if(!$request){
			include(WWW_ROOT . '../Lib/top/request/TaobaokeItemsDetailGetRequest.php');
			$request = new TaobaokeItemsDetailGetRequest();	
			$request->setFields("click_url,shop_click_url,seller_credit_score,detail_url,num_iid,title,nick,type,cid,seller_cids,props,input_pids,input_str,desc,pic_url,num,valid_thru,list_time,delist_time,stuff_status,location,price,post_fee,express_fee,ems_fee,has_discount,freight_payer,has_invoice,has_warranty,has_showcase,modified,approve_status,postage_id,auction_point,property_alias,item_img,prop_img,sku,outer_id,is_virtual");//video
		}
		if(is_array($num_iids)){
			$num_iids = implode(',', $num_iids);
		}
		$request->setNumIids($num_iids);
		$result = self::request($request);
		if($result->total_results){
			$result = $result->taobaoke_item_details->taobaoke_item_detail;
		}else{
			$result = array();
		}
		return $result;
	}

	/*
	   查询淘宝客推广商品
	   keyword or cid
	   {"taobaoke_items_get_response":{"taobaoke_items":{"taobaoke_item":
	   {"click_url":"http:\/\/s.click.taobao.com\/t?e=zGU34CA7K%2BPkqB07S4%2FK0CITy7klxn%2F7bvn0ayzWJnTnEa2SXqybAtUq9wRBdx53BkCIOf2Ek06nbUBnQeatjOsEk4o7Ql3a%2FHpGZmhWe%2Fhl7qT3QHehM6w6f3rc6qamE%2BNJ6fg22EA2XOBZbGer8i7qOMGcFoMRsvAxvc6qlQ%3D%3D&pid=mm_17531361_0_0&spm=2014.21101696.1.0",
	   "commission":"27.90",
	   "commission_num":"0",
	   "commission_rate":"50.00",
	   "commission_volume":"0",
	   "item_location":"广东 深圳",
	   "nick":"威廉科技",
	   "num_iid":15835893026,
	   "pic_url":"http:\/\/img04.taobaocdn.com\/bao\/uploaded\/i4\/T1OiLKXXRpXXbQ90I__105735.jpg",
	   "price":"5580.00",
	   "seller_credit_score":14,
	   "shop_click_url":"http:\/\/s.click.taobao.com\/t?e=zGU34CA7K%2BPkqB04MQzdgG69RGcaJPb63yl1mhTcxLmvM0RoTx5PVJdZqGr7OwarFYSqoSTQt55u9jK5mxdVafOi0baLC31fjLitQ9jCqI4iWMGYDA5g8vRrhJXGhc9ytJb0hLcxNAu0KldBtBJtWtw%3D&pid=mm_17531361_0_0&spm=2014.21101696.1.0",
	   "title":"今日到货 机锋网认证 Apple\/苹果 <span class=H>iPhone<\/span> <span class=H>5<\/span> 苹果<span class=H>5<\/span> 预售中港版无锁",
	   "volume":254}
	 */
public function TKItems($keyword)
{
	static $request = null;
	if(!$request){
		include(WWW_ROOT . '../Lib/top/request/TaobaokeItemsGetRequest.php');
		$request = new TaobaokeItemsGetRequest();	$request->setFields("num_iid,title,nick,pic_url,price,click_url,commission,commission_rate,commission_num,commission_volume,shop_click_url,seller_credit_score,item_location,volume");
	}
	$request->setKeyword($keyword);
	return self::request($request);
}

/*
   查询淘宝客折扣商品
   关键字　or cid(类目id)
   默认每次返回４０个
   return 
   "taobaoke_items_coupon_get_response":
   "taobaoke_items"
   "taobaoke_item"
   19 => 
   array (
   'click_url' => 'http://s.click.taobao.com/t?e=zGU34CA7K%2BPkqB07S4%2FK0CITy7klxn%2F7bvn0ayzWJnVw%2FR8L3TPFIZ8WbPe95IzZJw%2Fi%2BgU428C61vf0tu2lUpOlVw%2B3xXxv0v6whwbfrXb7L2QLaHUF%2BinbVjZ7EXt1jUunAc1jRUMu3qZZdNvNcIwB2fjlSD33duh6pGmnHA%3D%3D&pid=mm_17531361_0_0&spm=2014.21101696.2.0',
   'commission' => '1.36', //佣金
   'commission_num' => '0', //最近３０天累计推广量
   'commission_rate' => '100.00',　//佣金比率
   'commission_volume' => '0.00', //最近３０天累计推广佣金
   'coupon_end_time' => '2012-09-23 02:00:00',
   'coupon_price' => '64.06',
   'coupon_rate' => '4710.00',
   'coupon_start_time' => '2012-09-22 08:00:00',
   'item_location' => '广东 深圳',
   'nick' => 'fengfeng_20088888',
   'num_iid' => 15886939685,
   'pic_url' => 'http://img04.taobaocdn.com/bao/uploaded/i4/T1hPqYXnVtXXceBREV_021525.jpg',
   'price' => '136.00',
   'seller_credit_score' => 8,
   'shop_click_url' => 'http://s.click.taobao.com/t?e=zGU34CA7K%2BPkqB04MQzdgG69RGcaJPb63yl1mhTcxLjztO5Tq6Gx5%2B%2FU56vxsG0zKkzN6Dc%2BniQj9hKzCWAbE6ZLz8g0VdachBqkgTEH6MGkMUCwPdu5YCeubGKFrjiCtjByeMmtambhLcafTs3Ozf0%3D&pid=mm_17531361_0_0',
   'shop_type' => 'C',
   'title' => '#独畅团#Hello Kitty苹果<span class=H>HTC</span>移动电源充电器外置电池充电宝',
   'volume' => 50, //最近３０天成交量
   ),
 */
public function TKCoupon($keyword)
{
	static $request = null;
	if(!$request){
		include(WWW_ROOT . '../Lib/top/request/TaobaokeItemsCouponGetRequest.php');
		$request = new TaobaokeItemsCouponGetRequest();	
		$request->setFields("num_iid,title,nick,pic_url,price,click_url,commission,commission_rate,commission_num,commission_volume,shop_click_url,seller_credit_score,item_location,volume,coupon_price,coupon_rate,coupon_start_time,coupon_end_time,shop_type");
	}
	$request->setKeyword($keyword);
	return self::request($request);
}

/*
   通过昵称查询店铺信息 , 最多传入１０个昵称
   return
   object(stdClass)#172 (8) {
   ["auction_count"]=>
   string(2) "37"
   ["click_url"]=>
   string(236) "http://s.click.taobao.com/t?e=zGU34CA7K%2BPkqB04MQzdgG3VSuWRIvnJbEpKV5LvXOaNSppzIr%2FmAq%2BZWD39hYn76JT%2B%2BJ2qqfVJWZGm9BU8Szo85AuDj2LzvApcAYnLtSfsKCNJT8Vl0ZlP28veb1mbyfVXxgFGPKUiKkbBIIqoHI2%2B&pid=mm_17531361_0_0&spm=2014.21101696.1.0"
   ["commission_rate"]=>
   string(4) "5.04"
   ["seller_credit"]=>  //等级
   string(2) "11"
   ["shop_title"]=>
   string(21) "卡贝斯薇旗舰店"
   ["shop_type"]=>
   string(1) "B"
   ["total_auction"]=>
   string(4) "7259"	
   ["user_id"]=>
   int(734555740)
   }
 */
public function TKShopByNicks($nicks)
{
	$nicks = (array)$nicks;
	$nicks = implode(',', $nicks);
	static $request = null;
	if(!$request){
		include(WWW_ROOT . '../Lib/top/request/TaobaokeShopsConvertRequest.php');
		$request = new TaobaokeShopsConvertRequest();
		$request->setFields("user_id,click_url,shop_title,commission_rate,seller_credit,shop_type,auction_count,total_auction");
	}
	$request->setSellerNicks($nicks);
	$result = self::request($request);
	if($result){
		$result = $result->taobaoke_shops->taobaoke_shop;
	}
	return $result;
}

/*
   搜索店铺　通过关键字或类目id
   keyword or cid
   {"taobaoke_shops_get_response":{"taobaoke_shops":{"taobaoke_shop":[
   {"auction_count":"8","click_url":"http:\/\/s.click.taobao.com\/t?e=zGU34CA7K%2BPkqB04MQzdgG69RGcaJPb63yl1mhTcxaNv1n0J756dJfnCiDPfxK9W9DKGC6840%2BVqGSnwk19Cz1%2F238WFmpLdauB1Wrse7zWxpYZLCBz34MB411E5EAOsXNnZCnB2vuaAMDt%2B%2FnEFGQs%3D&pid=mm_17531361_0_0&spm=2014.21101696.1.0","commission_rate":"1.0","seller_credit":"11","shop_title":"苹果iphone4手机壳_iphone5手机壳_义乌手机壳批发_手机保护膜","shop_type":"C","total_auction":"1636","user_id":88014895},
 */
public function TKShop($keyword)
{
	static $request = null;
	if(!$request){
		include(WWW_ROOT . '../Lib/top/request/TaobaokeShopsGetRequest.php');
		$request = new TaobaokeShopsGetRequest();
		$request->setFields("user_id,click_url,shop_title,commission_rate,seller_credit,shop_type,auction_count,total_auction");
	}
	$request->setKeyword($keyword);
	return self::request($request);
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
	return self::request($request, 'shop');
}

//搜索打折信息
public function SearchCoupon($keyword, $page, $pagecount=100)
{
	static $request = null;
	if(!$request){
		include(WWW_ROOT . '../Lib/top/request/TaobaokeItemsCouponGetRequest.php');
		$request = new TaobaokeItemsCouponGetRequest();
		$request->setFields('num_iid,title,nick,pic_url,price,click_url,commission,commission_rate,commission_num,commission_volume,shop_click_url,seller_credit_score,item_location,volume,coupon_price,coupon_rate,coupon_start_time,coupon_end_time,shop_type');
	}
	$request->setKeyword($keyword);
	$request->setPageNo($page);
	$request->setPageSize($pagecount);
	return self::request($request);
}

public function TaobaoCids()
{
	static $request = null;
	if(!$request){
		include(WWW_ROOT . '../Lib/top/request/ItemcatsGetRequest.php');
		$request = new ItemcatsGetRequest();
		$request->setFields('features,modified_type,modified_time,cid,parent_cid,name,is_parent,status,sort_order');
	}
	return self::request($request);
}

public function AllCids()
{

	static $request = null;
	if(!$request){
		include(WWW_ROOT . '../Lib/top/request/TopatsItemcatsGetRequest.php');
		$request = new TopatsItemcatsGetRequest();
		$request->setCids('0');
		$request->setOutputFormat('json');
	}
	return self::request($request);
}

public function Search($keyword, $page, $pagecount=100)
{
	static $request = null;
	if(!$request){
		include(WWW_ROOT . '../Lib/top/request/TaobaokeItemsGetRequest.php');
		$request = new TaobaokeItemsGetRequest();
		$request->setFields('num_iid,title,nick,pic_url,price,click_url,commission,commission_rate,commission_num,commission_volume,shop_click_url,seller_credit_score,item_location,volume,coupon_price,coupon_rate,coupon_start_time,coupon_end_time,shop_type');
	}
	$request->setKeyword($keyword);
	$request->setPageNo($page);
	$request->setPageSize($pagecount);
	return self::request($request);
}

private static function ins($widget=false)
{
	static $client = null;
	if($client === null){			                              
		include(WWW_ROOT . '../Lib/top/RequestCheckUtil.php');
		include(WWW_ROOT . '../Lib/top/TopClient.php');
		$client = array();
		//~ TopConf::$online = false;
		$client[] = new TopClient();
		$client[] = new TopWidgetClient();
	}
	if($widget){
		return $client[1];
	}else{
		return $client[0];
	}
}

private static function _request($widget, $request, $subCate=null)
{
	$result = null;
	try{
		$result = self::ins($widget)->execute($request);
		if($subCate && isset($result->{$subCate})){
			$result = $result->{$subCate};
		}
	}catch(Exception $e){
		CakeLog::error($e->getMessage());
	}
	return $result;
}

private static function request($request, $subCate=null)
{
	return self::_request(false, $request, $subCate);
}

private static function widgetRequest($request, $subCate=null)
{
	return self::_request(true, $request, $subCate);
}

private static function getTaobaoId($url)
{
	if(!preg_match('/[^\/\s]+(taobao|tmall)\.com\//', $url)){
		return false;
}
$id = false;
$query = parse_url($url, PHP_URL_QUERY);
parse_str($query, $q_ary);
foreach($q_ary as $key => $value){
	switch($key){
		case 'id':
			$id = $value;
			break;
	}
}
return $id;
}
}


