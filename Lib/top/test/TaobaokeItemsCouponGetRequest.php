<?php
require "../RequestCheckUtil.php";
require "../TopClient.php";
/**
 * TOP API: taobao.taobaoke.items.coupon.get request
 * 
 * @author auto create
 * @since 1.0, 2012-08-07 16:31:26
 */
class TaobaokeItemsCouponGetRequest
{
	/** 
	 * 商品所在地
	 **/
	private $area;
	
	/** 
	 * 商品所属分类id。该ID为商品类目ID，与taobao.itemcats.get接口获取到的后台类目ID有所区别。
	 **/
	private $cid;
	
	/** 
	 * 优惠商品类型.1:打折商品,默认值为1
	 **/
	private $couponType;
	
	/** 
	 * 设置30天累计推广量（与返回数据中的commission_num字段对应）上限.注：该字段要与start_commissionNum一起使用才生效
	 **/
	private $endCommissionNum;
	
	/** 
	 * 最高佣金比率选项，如：2345表示23.45%。注：要起始佣金比率和最高佣金比率一起设置才有效。
	 **/
	private $endCommissionRate;
	
	/** 
	 * 最高累计推广佣金选项
	 **/
	private $endCommissionVolume;
	
	/** 
	 * 设置折扣比例范围上限,如：8000表示80.00%.注：要起始折扣比率和最高折扣比率一起设置才有效
	 **/
	private $endCouponRate;
	
	/** 
	 * 可选值和start_credit一样.start_credit的值一定要小于或等于end_credit的值。注：end_credit与start_credit一起使用才生效
	 **/
	private $endCredit;
	
	/** 
	 * 设置商品总成交量（与返回字段volume对应）上限。
	 **/
	private $endVolume;
	
	/** 
	 * 需返回的字段列表.可选值:num_iid,title,nick,pic_url,price,click_url,commission,commission_rate,commission_num,commission_volume,shop_click_url,seller_credit_score,item_location,volume,coupon_price,coupon_rate,coupon_start_time,coupon_end_time,shop_type;字段之间用","分隔
	 **/
	private $fields;
	
	/** 
	 * 标识一个应用是否来在无线或者手机应用,如果是true则会使用其他规则加密点击串.如果不传值,则默认是false
	 **/
	private $isMobile;
	
	/** 
	 * 商品标题中包含的关键字. 注意:查询时keyword,cid至少选择其中一个参数
	 **/
	private $keyword;
	
	/** 
	 * 推广者的淘宝会员昵称.注:指的是淘宝的会员登录名
	 **/
	private $nick;
	
	/** 
	 * 自定义输入串.格式:英文和数字组成;长度不能大于12个字符,区分不同的推广渠道,如:bbs,表示bbs为推广渠道;blog,表示blog为推广渠道
	 **/
	private $outerCode;
	
	/** 
	 * 结果页数.1~99
	 **/
	private $pageNo;
	
	/** 
	 * 每页返回结果数.最大每页100
	 **/
	private $pageSize;
	
	/** 
	 * 用户的pid,必须是mm_xxxx_0_0这种格式中间的"xxxx". 注意nick和pid至少需要传递一个,如果2个都传了,将以pid为准,且pid的最大长度是20
	 **/
	private $pid;
	
	/** 
	 * 店铺类型.默认all,商城:b,集市:c
	 **/
	private $shopType;
	
	/** 
	 * default(默认排序),
price_desc(折扣价格从高到低),
price_asc(折扣价格从低到高),
credit_desc(信用等级从高到低),
credit_asc(信用等级从低到高),
commissionRate_desc(佣金比率从高到低),
commissionRate_asc(佣金比率从低到高),
volume_desc(成交量成高到低), volume_asc(成交量从低到高)
	 **/
	private $sort;
	
	/** 
	 * 设置30天累计推广量（与返回数据中的commission_num字段对应）下限.注：该字段要与end_commissionNum一起使用才生效
	 **/
	private $startCommissionNum;
	
	/** 
	 * 起始佣金比率选项，如：1234表示12.34%
	 **/
	private $startCommissionRate;
	
	/** 
	 * 起始累计推广量佣金.注：返回的数据是30天内累计推广佣金，该字段要与最高累计推广佣金一起使用才生效
	 **/
	private $startCommissionVolume;
	
	/** 
	 * 设置折扣比例范围下限,如：7000表示70.00%
	 **/
	private $startCouponRate;
	
	/** 
	 * 卖家信用: 1heart(一心) 2heart (两心) 3heart(三心) 4heart(四心) 5heart(五心) 1diamond(一钻) 2diamond(两钻) 3diamond(三钻) 4diamond(四钻) 5diamond(五钻) 1crown(一冠) 2crown(两冠) 3crown(三冠) 4crown(四冠) 5crown(五冠) 1goldencrown(一黄冠) 2goldencrown(二黄冠) 3goldencrown(三黄冠) 4goldencrown(四黄冠) 5goldencrown(五黄冠)
	 **/
	private $startCredit;
	
	/** 
	 * 设置商品总成交量（与返回字段volume对应）下限。
	 **/
	private $startVolume;
	
	private $apiParas = array();
	
	public function setArea($area)
	{
		$this->area = $area;
		$this->apiParas["area"] = $area;
	}

	public function getArea()
	{
		return $this->area;
	}

	public function setCid($cid)
	{
		$this->cid = $cid;
		$this->apiParas["cid"] = $cid;
	}

	public function getCid()
	{
		return $this->cid;
	}

	public function setCouponType($couponType)
	{
		$this->couponType = $couponType;
		$this->apiParas["coupon_type"] = $couponType;
	}

	public function getCouponType()
	{
		return $this->couponType;
	}

	public function setEndCommissionNum($endCommissionNum)
	{
		$this->endCommissionNum = $endCommissionNum;
		$this->apiParas["end_commission_num"] = $endCommissionNum;
	}

	public function getEndCommissionNum()
	{
		return $this->endCommissionNum;
	}

	public function setEndCommissionRate($endCommissionRate)
	{
		$this->endCommissionRate = $endCommissionRate;
		$this->apiParas["end_commission_rate"] = $endCommissionRate;
	}

	public function getEndCommissionRate()
	{
		return $this->endCommissionRate;
	}

	public function setEndCommissionVolume($endCommissionVolume)
	{
		$this->endCommissionVolume = $endCommissionVolume;
		$this->apiParas["end_commission_volume"] = $endCommissionVolume;
	}

	public function getEndCommissionVolume()
	{
		return $this->endCommissionVolume;
	}

	public function setEndCouponRate($endCouponRate)
	{
		$this->endCouponRate = $endCouponRate;
		$this->apiParas["end_coupon_rate"] = $endCouponRate;
	}

	public function getEndCouponRate()
	{
		return $this->endCouponRate;
	}

	public function setEndCredit($endCredit)
	{
		$this->endCredit = $endCredit;
		$this->apiParas["end_credit"] = $endCredit;
	}

	public function getEndCredit()
	{
		return $this->endCredit;
	}

	public function setEndVolume($endVolume)
	{
		$this->endVolume = $endVolume;
		$this->apiParas["end_volume"] = $endVolume;
	}

	public function getEndVolume()
	{
		return $this->endVolume;
	}

	public function setFields($fields)
	{
		$this->fields = $fields;
		$this->apiParas["fields"] = $fields;
	}

	public function getFields()
	{
		return $this->fields;
	}

	public function setIsMobile($isMobile)
	{
		$this->isMobile = $isMobile;
		$this->apiParas["is_mobile"] = $isMobile;
	}

	public function getIsMobile()
	{
		return $this->isMobile;
	}

	public function setKeyword($keyword)
	{
		$this->keyword = $keyword;
		$this->apiParas["keyword"] = $keyword;
	}

	public function getKeyword()
	{
		return $this->keyword;
	}

	public function setNick($nick)
	{
		$this->nick = $nick;
		$this->apiParas["nick"] = $nick;
	}

	public function getNick()
	{
		return $this->nick;
	}

	public function setOuterCode($outerCode)
	{
		$this->outerCode = $outerCode;
		$this->apiParas["outer_code"] = $outerCode;
	}

	public function getOuterCode()
	{
		return $this->outerCode;
	}

	public function setPageNo($pageNo)
	{
		$this->pageNo = $pageNo;
		$this->apiParas["page_no"] = $pageNo;
	}

	public function getPageNo()
	{
		return $this->pageNo;
	}

	public function setPageSize($pageSize)
	{
		$this->pageSize = $pageSize;
		$this->apiParas["page_size"] = $pageSize;
	}

	public function getPageSize()
	{
		return $this->pageSize;
	}

	public function setPid($pid)
	{
		$this->pid = $pid;
		$this->apiParas["pid"] = $pid;
	}

	public function getPid()
	{
		return $this->pid;
	}

	public function setShopType($shopType)
	{
		$this->shopType = $shopType;
		$this->apiParas["shop_type"] = $shopType;
	}

	public function getShopType()
	{
		return $this->shopType;
	}

	public function setSort($sort)
	{
		$this->sort = $sort;
		$this->apiParas["sort"] = $sort;
	}

	public function getSort()
	{
		return $this->sort;
	}

	public function setStartCommissionNum($startCommissionNum)
	{
		$this->startCommissionNum = $startCommissionNum;
		$this->apiParas["start_commission_num"] = $startCommissionNum;
	}

	public function getStartCommissionNum()
	{
		return $this->startCommissionNum;
	}

	public function setStartCommissionRate($startCommissionRate)
	{
		$this->startCommissionRate = $startCommissionRate;
		$this->apiParas["start_commission_rate"] = $startCommissionRate;
	}

	public function getStartCommissionRate()
	{
		return $this->startCommissionRate;
	}

	public function setStartCommissionVolume($startCommissionVolume)
	{
		$this->startCommissionVolume = $startCommissionVolume;
		$this->apiParas["start_commission_volume"] = $startCommissionVolume;
	}

	public function getStartCommissionVolume()
	{
		return $this->startCommissionVolume;
	}

	public function setStartCouponRate($startCouponRate)
	{
		$this->startCouponRate = $startCouponRate;
		$this->apiParas["start_coupon_rate"] = $startCouponRate;
	}

	public function getStartCouponRate()
	{
		return $this->startCouponRate;
	}

	public function setStartCredit($startCredit)
	{
		$this->startCredit = $startCredit;
		$this->apiParas["start_credit"] = $startCredit;
	}

	public function getStartCredit()
	{
		return $this->startCredit;
	}

	public function setStartVolume($startVolume)
	{
		$this->startVolume = $startVolume;
		$this->apiParas["start_volume"] = $startVolume;
	}

	public function getStartVolume()
	{
		return $this->startVolume;
	}

	public function getApiMethodName()
	{
		return "taobao.taobaoke.items.coupon.get";
	}
	
	public function getApiParas()
	{
		return $this->apiParas;
	}
	
	public function check()
	{
		
		RequestCheckUtil::checkNotNull($this->fields,"fields");
	}
}
$request = new TaobaokeItemsCouponGetRequest();
$request->setFields('num_iid,title,nick,pic_url,price,click_url,commission,commission_rate,commission_num,commission_volume,shop_click_url,seller_credit_score,item_location,volume,coupon_price,coupon_rate,coupon_start_time,coupon_end_time,shop_type');
$request->setKeyword('HTC'); // or $request->setCid(''); 至少传一个
$tc = new TopClient();

//var_export(json_decode(json_encode($tc->execute($request)), true));
//
/*
 * "taobaoke_items_coupon_get_response":
 * "taobaoke_items"
 * "taobaoke_item"
    19 => 
    array (
        'click_url' => 'http://s.click.taobao.com/t?e=zGU34CA7K%2BPkqB07S4%2FK0CITy7klxn%2F7bvn0ayzWJnVw%2FR8L3TPFIZ8WbPe95IzZJw%2Fi%2BgU428C61vf0tu2lUpOlVw%2B3xXxv0v6whwbfrXb7L2QLaHUF%2BinbVjZ7EXt1jUunAc1jRUMu3qZZdNvNcIwB2fjlSD33duh6pGmnHA%3D%3D&pid=mm_17531361_0_0&spm=2014.21101696.2.0',
        'commission' => '1.36',
        'commission_num' => '0',
        'commission_rate' => '100.00',
        'commission_volume' => '0.00',
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
        'volume' => 50,
    ),


$r = '{"taobaoke_items_coupon_get_response":{
    "taobaoke_items":{
        "taobaoke_item":[
    {"click_url":"http:\/\/s.click.taobao.com\/t?e=zGU34CA7K%2BPkqB07S4%2FK0CITy7klxn%2F7bvn0ayzWJnVw%2FR8L3TPFIZ8WbPe95IzZJw%2FrmwnyrnCOYMxhfmyCg9fVu0IaNvVoAK8O%2BbgcFZfXIJnCfPEcd06pHW9fsaAXsFCsAspd772bPfrgQ8Feji%2BWcXIIV5UXkeyLPyJWdQ%3D%3D&pid=mm_17531361_0_0&spm=2014.21101696.2.0","commission":"17.40","commission_num":"173","commission_rate":"50.00","commission_volume":"2633.01","coupon_end_time":"2012-10-18 23:59:59","coupon_price":"2888.05","coupon_rate":"8299.00","coupon_start_time":"2012-08-18 13:51:36","item_location":"广东 深圳","nick":"haijian52088","num_iid":15968116774,"pic_url":"http:\/\/img04.taobaocdn.com\/bao\/uploaded\/i4\/T1YSrNXi0jXXXK4OTa_091515.jpg","price":"3480.00","seller_credit_score":14,"shop_click_url":"http:\/\/s.click.taobao.com\/t?e=zGU34CA7K%2BPkqB04MQzdgG69RGcaJPb63yl1mhTcxLjztO5Tq6Gx5%2B%2FU56vxsG0zKkzEu0peASIcyLdQdDABXDF9SydbiLAOBKTNXJdnPZ6K1ekqi76vrj%2BTQAeSBbvUj7KIxbU9cfxWhThY%2BBK06sY%3D&pid=mm_17531361_0_0","shop_type":"C","title":"【9.25大放价】<span class=H>HTC<\/span> S720e G23 One X 八月产 亏本血拼 888台团购","volume":649},
    {"click_url":"http:\/\/s.click.taobao.com\/t?e=zGU34CA7K%2BPkqB07S4%2FK0CITy7klxn%2F7bvn0ayzWJnVw%2FR8L3TPFIZ8WbPe95IzZJw%2Ft8RPpt7GcncddhXOxv%2BQq8nb4tpUQExr%2BQJYGtI2iCJY%2FJbGzxdpczudkqPwaFyDDgbv0paxrmYQKPJzeOBuzZhWM4XQOOWDLPYlOFA%3D%3D&pid=mm_17531361_0_0&spm=2014.21101696.2.0","commission":"10.05","commission_num":"0","commission_rate":"50.00","commission_volume":"0.00","coupon_end_time":"2013-01-31 19:43:04","coupon_price":"1659.03","coupon_rate":"8258.00","coupon_start_time":"2012-08-27 19:42:50","item_location":"广东 深圳","nick":"heatlinda","num_iid":13742879250,"pic_url":"http:\/\/img02.taobaocdn.com\/bao\/uploaded\/i2\/T1qPYKXdJkXXbZ4LoW_023356.jpg","price":"2009.00","seller_credit_score":14,"shop_click_url":"http:\/\/s.click.taobao.com\/t?e=zGU34CA7K%2BPkqB04MQzdgG69RGcaJPb63yl1mhTcxLjztO5Tq6Gx5%2B%2FU56vxsG0zKkzCaJrK7p916ZfWlhYW21GP9Muq2aRe%2Fkz4MfM%2BtJH3DEKAfXQLJ7P4fu03lo3tZA9YyxgYiAnogpAn3pYSjFU%3D&pid=mm_17531361_0_0","shop_type":"C","title":"限量疯抢！<span class=H>HTC<\/span> S510b G20 Rhyme 送惊喜 可ROOT 女性手机 包邮","volume":381},
    {"click_url":"http:\/\/s.click.taobao.com\/t?e=zGU34CA7K%2BPkqB07S4%2FK0CITy7klxn%2F7bvn0ayzWJnVw%2FR8L3TPFIZ8WbPe95IzZJw%2Fooh8VVHv%2Bqrd6l0UhdJ4UuvWYlOOAgMx3m%2BlECwpYCPlv6M3t7mqQmjLeESWH7lWoSr4Uo3Fvt9%2Ff2VkEfWDU%2FZ33RLO%2FyFJ1Pxfxlg%3D%3D&pid=mm_17531361_0_0&spm=2014.21101696.2.0","commission":"45.00","commission_num":"0","commission_rate":"150.00","commission_volume":"0.00","coupon_end_time":"2013-07-23 22:50:05","coupon_price":"2720.10","coupon_rate":"9067.00","coupon_start_time":"2012-09-16 22:50:51","item_location":"广东 深圳","nick":"xiawunan","num_iid":17180531666,"pic_url":"http:\/\/img01.taobaocdn.com\/bao\/uploaded\/i1\/T1mEPJXlNqXXcYJJ3W_022903.jpg","price":"3000.00","seller_credit_score":14,"shop_click_url":"http:\/\/s.click.taobao.com\/t?e=zGU34CA7K%2BPkqB04MQzdgG69RGcaJPb63yl1mhTcxLjztO5Tq6Gx5%2B%2FU56vxsG0zKkzHMbKKB0VjOfTJ1mE7uvxg9ZePp4T3w6odTkD4S4heq%2BC%2Buw8CKI3qpS%2Fc4vjOIEn%2FdEMtAqJejAmuLp%2B7sn0%3D&pid=mm_17531361_0_0","shop_type":"C","title":"<span class=H>HTC<\/span> Thunderbolt One XL X325s双核LED4G网络安卓系统智能4.7寸","volume":8},
    {"click_url":"http:\/\/s.click.taobao.com\/t?e=zGU34CA7K%2BPkqB07S4%2FK0CITy7klxn%2F7bvn0ayzWJnVw%2FR8L3TPFIZ8WbPe95IzZJw%2FsW8zvk7Zr9LfvzRb0byd%2FvBhcTIa%2FmMnIkHalCk4x2LTVw%2BqKzNY5daWdoRosZFhsVMRLkJDQ87PvmteZnTr2Bc%2Bv%2FHKugO1E6725lw%3D%3D&pid=mm_17531361_0_0&spm=2014.21101696.2.0","commission":"6.00","commission_num":"0","commission_rate":"100.00","commission_volume":"0.00","coupon_end_time":"2013-08-20 15:52:55","coupon_price":"420.00","coupon_rate":"7000.00","coupon_start_time":"2012-07-31 15:52:41","item_location":"广东 深圳","nick":"zczlh_001","num_iid":15541443656,"pic_url":"http:\/\/img01.taobaocdn.com\/bao\/uploaded\/i1\/T1Bb6zXjXgXXbfrIQ._111551.jpg","price":"600.00","seller_credit_score":9,"shop_click_url":"http:\/\/s.click.taobao.com\/t?e=zGU34CA7K%2BPkqB04MQzdgG69RGcaJPb63yl1mhTcxLjztO5Tq6Gx5%2B%2FU56vxsG0zKkzDPprQqrauGK55QYnBeUwZijobB65LO2iOelRVs4kWv3XIKwzKV8uzjfMNPNVDmpHlKUALcJ%2Fm5BtK84dJjrY%3D&pid=mm_17531361_0_0","shop_type":"C","title":"<span class=H>HTC<\/span> EVO A9292 电信天翼CDMA智能手机  每日前十名客户送魔音耳机","volume":34},
    {"click_url":"http:\/\/s.click.taobao.com\/t?e=zGU34CA7K%2BPkqB07S4%2FK0CITy7klxn%2F7bvn0ayzWJnVw%2FR8L3TPFIZ8WbPe95IzZJw%2FpFszVy59YzmC2ieyOUr83WVXmDXhkGqcvxsHxMe4qgp6%2BWEoA%2FWt%2FtGg9FZJEX4gDW8cc%2FFO8Og3FjL1OfDN1YP9nKm1Xz1lZY8SGIw%3D%3D&pid=mm_17531361_0_0&spm=2014.21101696.2.0","commission":"16.24","commission_num":"69","commission_rate":"800.00","commission_volume":"1510.11","coupon_end_time":"2013-02-01 00:00:00","coupon_price":"158.54","coupon_rate":"7810.00","coupon_start_time":"2012-08-18 12:41:00","item_location":"广东 深圳","nick":"kindlyman44","num_iid":13497668007,"pic_url":"http:\/\/img02.taobaocdn.com\/bao\/uploaded\/i2\/T1Z9YLXc4jXXalR476_061838.jpg","price":"203.00","seller_credit_score":15,"shop_click_url":"http:\/\/s.click.taobao.com\/t?e=zGU34CA7K%2BPkqB04MQzdgG69RGcaJPb63yl1mhTcxLjztO5Tq6Gx5%2B%2FU56vxsG0zKkzGs0xQfHvkWlSwWwxTRyUfMMUrGGEpjBQHSikbZ2UQezv4fw8xICBQnZfO%2F%2B9FxH78zLBffJlV55CtH%2B8NPWM%3D&pid=mm_17531361_0_0","shop_type":"C","title":"Lepow乐泡移动充电器 苹果手机充电宝大容量 iphone4S移动电源<span class=H>htc<\/span>","volume":677},
    {"click_url":"http:\/\/s.click.taobao.com\/t?e=zGU34CA7K%2BPkqB07S4%2FK0CITy7klxn%2F7bvn0ayzWJnVw%2FR8L3TPFIZ8WbPe95IzZJw%2FrmqmfHEDdf49pHN7gYiTnEtXl19PoNVkKQCxLifgoVWUW5CBw74cOJz5gSvTqVQOYFcZyScaQt4bRBGGcur3ohF6q0Zk8E3oqBdgqR3c%3D&pid=mm_17531361_0_0&spm=2014.21101696.2.0","commission":"6.00","commission_num":"0","commission_rate":"100.00","commission_volume":"0.00","coupon_end_time":"2013-06-08 13:29:35","coupon_price":"420.00","coupon_rate":"7000.00","coupon_start_time":"2012-06-26 13:29:33","item_location":"广东 深圳","nick":"luolin5218394","num_iid":14698230128,"pic_url":"http:\/\/img02.taobaocdn.com\/bao\/uploaded\/i2\/T1f6YFXeBmXXcYywUT_011741.jpg","price":"600.00","seller_credit_score":6,"shop_click_url":"http:\/\/s.click.taobao.com\/t?e=zGU34CA7K%2BPkqB04MQzdgG69RGcaJPb63yl1mhTcxLjztO5Tq6Gx5%2B%2FU56vxsG0zKkzEuo5SSbnvVs1Pz9e%2FVpJMxLf08rZPX2MdSJCXIGo%2BKhR%2FzXXsL9FUY41VIczbkXogz1ipHzRajMjN9u0f1kJH&pid=mm_17531361_0_0","shop_type":"C","title":"<span class=H>HTC<\/span> EVO  A9292电信CDMA 安卓智能手机 电信机皇特价现货发售现货","volume":24},
    {"click_url":"http:\/\/s.click.taobao.com\/t?e=zGU34CA7K%2BPkqB07S4%2FK0CITy7klxn%2F7bvn0ayzWJnVw%2FR8L3TPFIZ8WbPe95IzZJw%2Fooh8VVHv%2Bqrd6l0UhdJ4UuvWYlOOAgMx3m%2BlECwpYCPlv6M3t7mqQmjLeESWH7lWoSr4Uo3Fvt9%2Ff2VkEfWDU%2FZ33SgUTpVbsYvHW0A%3D%3D&pid=mm_17531361_0_0&spm=2014.21101696.2.0","commission":"9.00","commission_num":"13","commission_rate":"500.00","commission_volume":"57.42","coupon_end_time":"2013-07-23 22:50:05","coupon_price":"95.58","coupon_rate":"5310.00","coupon_start_time":"2012-09-16 22:50:51","item_location":"广东 深圳","nick":"xiawunan","num_iid":19510132839,"pic_url":"http:\/\/img01.taobaocdn.com\/bao\/uploaded\/i1\/T17WbJXm4eXXbizOQ3_050426.jpg","price":"180.00","seller_credit_score":14,"shop_click_url":"http:\/\/s.click.taobao.com\/t?e=zGU34CA7K%2BPkqB04MQzdgG69RGcaJPb63yl1mhTcxLjztO5Tq6Gx5%2B%2FU56vxsG0zKkzHMbKKB0VjOfTJ1mE7uvxg9ZePp4T3w6odTkD4S4heq%2BC%2Buw8CKI3qpS%2Fc4vjOIEn%2FdEMtAqJejAmuLp%2B7sn0%3D&pid=mm_17531361_0_0","shop_type":"C","title":"长虹伊娃手机充电宝I9300三星iphone4s苹果<span class=H>HTC<\/span>移动电源便携式电池","volume":209},
    {"click_url":"http:\/\/s.click.taobao.com\/t?e=zGU34CA7K%2BPkqB07S4%2FK0CITy7klxn%2F7bvn0ayzWJnVw%2FR8L3TPFIZ8WbPe95IzZJw%2FsXUkg8ywKzlHFDfSk1HBz0%2F3icbq4eYTNxk1SpTDiBLvKCzd1OSUZxQ0%2BJId%2Fweia0VYcioIc7jdiVE14%2FCUyK1ow%2BboZPmvoOucRAb0%3D&pid=mm_17531361_0_0&spm=2014.21101696.2.0","commission":"6.76","commission_num":"130","commission_rate":"200.00","commission_volume":"1116.60","coupon_end_time":"2012-09-30 23:59:59","coupon_price":"280.54","coupon_rate":"8300.00","coupon_start_time":"2012-09-17 13:52:36","item_location":"浙江 台州","nick":"2012的以後","num_iid":16771152918,"pic_url":"http:\/\/img02.taobaocdn.com\/bao\/uploaded\/i2\/T1t.jDXkVqXXXlFkkZ_033156.jpg","price":"338.00","seller_credit_score":9,"shop_click_url":"http:\/\/s.click.taobao.com\/t?e=zGU34CA7K%2BPkqB04MQzdgG69RGcaJPb63yl1mhTcxLjztO5Tq6Gx5%2B%2FU56vxsG0zKkzDOBrjp0h6B77rsplJ2QNI%2FCA4xJdAxjyJEq329S4joP%2Ffm9952vcFioe6vAGoeMEc8Oe6cghaICA2egys%2B3%2FN&pid=mm_17531361_0_0","shop_type":"C","title":"<span class=H>HTC<\/span> 电信天翼CDMA 男女式 智能手机 安卓2.3.7 全国包邮","volume":761},
    {"click_url":"http:\/\/s.click.taobao.com\/t?e=zGU34CA7K%2BPkqB07S4%2FK0CITy7klxn%2F7bvn0ayzWJnVw%2FR8L3TPFIZ8WbPe95IzZJw%2FrkUn5gcqeJNB0JPZSBBW3YhVRZiVm9uUbHbqU1b4nohJRMoGrDJv614AVA3aeMhKjT7Qc%2Fhqg1ccw4haM54bWremDgPdkKUZJNJpvqjs%3D&pid=mm_17531361_0_0&spm=2014.21101696.2.0","commission":"2.80","commission_num":"21","commission_rate":"1000.00","commission_volume":"50.39","coupon_end_time":"2012-09-25 16:30:00","coupon_price":"20.00","coupon_rate":"7143.00","coupon_start_time":"2012-04-19 23:00:00","item_location":"福建 泉州","nick":"贵宾商店","num_iid":13459589882,"pic_url":"http:\/\/img02.taobaocdn.com\/bao\/uploaded\/i2\/T1qnOJXeJjXXaiUIs5_054903.jpg","price":"28.00","seller_credit_score":15,"shop_click_url":"http:\/\/s.click.taobao.com\/t?e=zGU34CA7K%2BPkqB04MQzdgG69RGcaJPb63yl1mhTcxLjztO5Tq6Gx5%2B%2FU56vxsG0zKkzEsftFMMGkD9gZpuHXTEGL58iZ%2B8zMJlUD0iQViBOKqseyxaqdKJxwnOg7RL0s%2BfzgidTawcJlJxFaG3LWVn2L&pid=mm_17531361_0_0","shop_type":"C","title":"<span class=H>HTC<\/span> G11手机壳G13手机套G14手机套G18手机壳g11手机保护套壳 外套","volume":162},
    {"click_url":"http:\/\/s.click.taobao.com\/t?e=zGU34CA7K%2BPkqB07S4%2FK0CITy7klxn%2F7bvn0ayzWJnVw%2FR8L3TPFIZ8WbPe95IzZJw%2FooA3ddUKTW9dwH4QBucUens6nJZryZQVaI9iytjzoYK9lBBuh1kENLBZslTGaKVKxLflBR62w%2F6z2nsH0Z9EVeN51rnPFdbMWR9Bw3A%3D%3D&pid=mm_17531361_0_0&spm=2014.21101696.2.0","commission":"12.00","commission_num":"11","commission_rate":"200.00","commission_volume":"144.00","coupon_end_time":"2012-10-31 13:20:25","coupon_price":"450.00","coupon_rate":"7500.00","coupon_start_time":"2012-07-30 13:20:25","item_location":"安徽 合肥","nick":"wwwwlei511","num_iid":15548445243,"pic_url":"http:\/\/img03.taobaocdn.com\/bao\/uploaded\/i3\/T12g_vXX0sXXcbQXU__105244.jpg","price":"600.00","seller_credit_score":12,"shop_click_url":"http:\/\/s.click.taobao.com\/t?e=zGU34CA7K%2BPkqB04MQzdgG69RGcaJPb63yl1mhTcxLjztO5Tq6Gx5%2B%2FU56vxsG0zKkzHMyCPyKuK1%2F0gy5p8wiLuIgV6qFfDIBLKT33pj%2Fg2UlzJmAGGaB8i6krd2k7NpuxDNPYTRIMsRKcVh%2F2fON0%3D&pid=mm_17531361_0_0","shop_type":"C","title":"热卖送大礼 <span class=H>HTC<\/span> EVO 电信天翼3G EVDO 安卓智能 大屏幕 CDMA 手机","volume":112},
    {"click_url":"http:\/\/s.click.taobao.com\/t?e=zGU34CA7K%2BPkqB07S4%2FK0CITy7klxn%2F7bvn0ayzWJnVw%2FR8L3TPFIZ8WbPe95IzZJw%2Ft9xNGWUW%2FD6XBZblql4qmQYKu0%2BXqJ3NJbG%2Ft20nCCfkbtA04JGt7gUGXTUH8hskRAr7ZQnxNbgdXh71WQiPNs1ebDtpCDHqsV8%2FHTg4%3D&pid=mm_17531361_0_0&spm=2014.21101696.2.0","commission":"4.34","commission_num":"283","commission_rate":"510.00","commission_volume":"1078.03","coupon_end_time":"2012-11-01 23:00:00","coupon_price":"68.00","coupon_rate":"8000.00","coupon_start_time":"2012-08-25 06:30:00","item_location":"广东 深圳","nick":"华强生科技","num_iid":16819164142,"pic_url":"http:\/\/img04.taobaocdn.com\/bao\/uploaded\/i4\/T1fuYEXeFoXXXeeQ77_065448.jpg","price":"85.00","seller_credit_score":11,"shop_click_url":"http:\/\/s.click.taobao.com\/t?e=zGU34CA7K%2BPkqB04MQzdgG69RGcaJPb63yl1mhTcxLjztO5Tq6Gx5%2B%2FU56vxsG0zKkzCbq7BwP5A3JV%2FaJ6gmQ47IYBwM%2BVxoGsTQPFNa5IYbG1mZmMeOoxnzHpcqLQcHqTXBjGBwzochah%2FZpiCZSmp&pid=mm_17531361_0_0","shop_type":"C","title":"<span class=H>HTC<\/span>蓝牙耳机 one x双耳立体声无线小米苹果三星手机通用 正品包邮","volume":2491},
    {"click_url":"http:\/\/s.click.taobao.com\/t?e=zGU34CA7K%2BPkqB07S4%2FK0CITy7klxn%2F7bvn0ayzWJnVw%2FR8L3TPFIZ8WbPe95IzZJw%2FrmqB%2FwntJ8rxqmQJmIwIFkrX29MOfQWXAjxCEPL9QdiWjXGT%2F2o7s4UuPChySpXIrh6mygzFlFp4ocS%2Ffdbd%2FykUPy%2FwgfI9%2B3xy4rhI%3D&pid=mm_17531361_0_0&spm=2014.21101696.2.0","commission":"14.80","commission_num":"0","commission_rate":"500.00","commission_volume":"0.00","coupon_end_time":"2012-09-23 02:00:00","coupon_price":"148.00","coupon_rate":"5000.00","coupon_start_time":"2012-09-22 05:00:00","item_location":"浙江 杭州","nick":"网易购数码","num_iid":17149107559,"pic_url":"http:\/\/img02.taobaocdn.com\/bao\/uploaded\/i2\/T1HkPIXitrXXcGYpPX_084122.jpg","price":"296.00","seller_credit_score":14,"shop_click_url":"http:\/\/s.click.taobao.com\/t?e=zGU34CA7K%2BPkqB04MQzdgG69RGcaJPb63yl1mhTcxLjztO5Tq6Gx5%2B%2FU56vxsG0zKkzEuofqIEMgXLlHEO8z4ptpHwV8IkO%2FNwVxGIwqPPn6sUvJ0U1ZyN6kdkbepFRRRSBEyc%2FW4tiRmlE6uuv61JQa&pid=mm_17531361_0_0","shop_type":"C","title":"手机移动电源20000毫安<span class=H>htc<\/span>外接电池三星旅行充电宝苹果iPhone4S","volume":229},
    {"click_url":"http:\/\/s.click.taobao.com\/t?e=zGU34CA7K%2BPkqB07S4%2FK0CITy7klxn%2F7bvn0ayzWJnVw%2FR8L3TPFIZ8WbPe95IzZJw%2FpH7AcCuWEGPSQj0GyVYMYu2TMBQXeVYGOkLNt%2Bpl9rlmwoVx7AUn1%2BJe6viAo%2BWIV1Wxy%2BqP%2BmwV9%2FNLaqRMB0toED85ZRRqpG2inUOY%3D&pid=mm_17531361_0_0&spm=2014.21101696.2.0","commission":"1.30","commission_num":"0","commission_rate":"50.00","commission_volume":"0.00","coupon_end_time":"2012-09-30 08:00:00","coupon_price":"210.00","coupon_rate":"8077.00","coupon_start_time":"2012-09-02 07:00:00","item_location":"广东 广州","nick":"碗豆尖n","num_iid":19401208288,"pic_url":"http:\/\/img01.taobaocdn.com\/bao\/uploaded\/i1\/T1CF6sXnpuXXXpG.7W_025210.jpg","price":"260.00","seller_credit_score":7,"shop_click_url":"http:\/\/s.click.taobao.com\/t?e=zGU34CA7K%2BPkqB04MQzdgG69RGcaJPb63yl1mhTcxLjztO5Tq6Gx5%2B%2FU56vxsG0zKkzGuhpJj%2FMFEBo7XpMqw0CV8Mnen49r%2BTR7zlwmlduJ91H60KXrBmFkmowcRlOl6PusY9IF061CQJjn5mIPwxFG&pid=mm_17531361_0_0","shop_type":"C","title":"挑战最低价<span class=H>HTC<\/span> Hero200 G3C 英雄200 电信天翼CDMA安卓3G智能手机","volume":40},
    {"click_url":"http:\/\/s.click.taobao.com\/t?e=zGU34CA7K%2BPkqB07S4%2FK0CITy7klxn%2F7bvn0ayzWJnVw%2FR8L3TPFIZ8WbPe95IzZJw%2FpHTnhK5%2FwFDaKULCqHiQG68lEmS1ZVciET2T%2BOk2CcGcZeS%2BwXzSFF%2FrgoAkmZdOp4NK6D%2FcjCE3m6xEytjGqu2dBEvRoL5YLXxvCBH0%3D&pid=mm_17531361_0_0&spm=2014.21101696.2.0","commission":"1.15","commission_num":"0","commission_rate":"50.00","commission_volume":"0.00","coupon_end_time":"2012-09-27 21:00:00","coupon_price":"207.00","coupon_rate":"9000.00","coupon_start_time":"2012-09-18 14:00:00","item_location":"广东 深圳","nick":"wumaogui168","num_iid":17837020361,"pic_url":"http:\/\/img01.taobaocdn.com\/bao\/uploaded\/i1\/T1ywDNXg4iXXcsgicU_015139.jpg","price":"230.00","seller_credit_score":5,"shop_click_url":"http:\/\/s.click.taobao.com\/t?e=zGU34CA7K%2BPkqB04MQzdgG69RGcaJPb63yl1mhTcxLjztO5Tq6Gx5%2B%2FU56vxsG0zKkzGuO4R%2FgiH8UlgcnyzdeF58%2Bq2cRkUUY1OXQHt1ZPkmYRIGiHVYUjOwFyx2rPZGW1q2aXWe41fGjSBkh4v%2BS7a&pid=mm_17531361_0_0","shop_type":"C","title":"<span class=H>HTC<\/span> 电信天翼Hero200安卓系统2.37 学生智能手机男女通用款 包邮","volume":48},
    {"click_url":"http:\/\/s.click.taobao.com\/t?e=zGU34CA7K%2BPkqB07S4%2FK0CITy7klxn%2F7bvn0ayzWJnVw%2FR8L3TPFIZ8WbPe95IzZJw%2FrmacQuDEQix99uS4PJXXiTv2jUfO2nWMwFjF8dX85QCPJcebcyru%2B2JEa2JQRMhsNvXfTuEYKPqxLTcCwHRFhkAFVi424sfS5jhr1cyU%3D&pid=mm_17531361_0_0&spm=2014.21101696.2.0","commission":"27.23","commission_num":"43","commission_rate":"150.00","commission_volume":"806.84","coupon_end_time":"2012-10-15 22:43:53","coupon_price":"980.10","coupon_rate":"5400.00","coupon_start_time":"2012-09-14 22:43:53","item_location":"广东 深圳","nick":"和讯通讯科技","num_iid":14000356978,"pic_url":"http:\/\/img02.taobaocdn.com\/bao\/uploaded\/i2\/T1KFTMXmBiXXcby.EV_021913.jpg","price":"1815.00","seller_credit_score":11,"shop_click_url":"http:\/\/s.click.taobao.com\/t?e=zGU34CA7K%2BPkqB04MQzdgG69RGcaJPb63yl1mhTcxLjztO5Tq6Gx5%2B%2FU56vxsG0zKkzEuTM%2B0SmedWmpUJ003Gc4mrAvjdCLlzb3mjqoG32TVGJPBJHfbZ9lrK%2BOHwrUjek%2B5lORC6k8IK5FS%2Butw%2BUN&pid=mm_17531361_0_0","shop_type":"C","title":"冲皇冠0利润<span class=H>HTC<\/span> A9191\/Desire HD\/G10\/港版3月份产\\包邮\\16G卡","volume":186},
    {"click_url":"http:\/\/s.click.taobao.com\/t?e=zGU34CA7K%2BPkqB07S4%2FK0CITy7klxn%2F7bvn0ayzWJnVw%2FR8L3TPFIZ8WbPe95IzZJw%2Fooh8VVHv%2Bqrd6l0UhdJ4UuvWYlOOAgMx3m%2BlECwpYCPlv6M3t7mqQmjLeESWH7lWoSr4Uo3Fvt9%2Ff2VkEfWDU%2FZ3%2B44i9kh%2BpTHrQ&pid=mm_17531361_0_0&spm=2014.21101696.2.0","commission":"27.00","commission_num":"8","commission_rate":"150.00","commission_volume":"173.55","coupon_end_time":"2013-07-23 22:50:05","coupon_price":"1020.06","coupon_rate":"5667.00","coupon_start_time":"2012-09-16 22:50:51","item_location":"广东 深圳","nick":"xiawunan","num_iid":8440974826,"pic_url":"http:\/\/img03.taobaocdn.com\/bao\/uploaded\/i3\/T1tffFXhBbXXaOBDQT_013230.jpg","price":"1800.00","seller_credit_score":14,"shop_click_url":"http:\/\/s.click.taobao.com\/t?e=zGU34CA7K%2BPkqB04MQzdgG69RGcaJPb63yl1mhTcxLjztO5Tq6Gx5%2B%2FU56vxsG0zKkzHMbKKB0VjOfTJ1mE7uvxg9ZePp4T3w6odTkD4S4heq%2BC%2Buw8CKI3qpS%2Fc4vjOIEn%2FdEMtAqJejAmuLp%2B7sn0%3D&pid=mm_17531361_0_0","shop_type":"C","title":"包邮<span class=H>HTC<\/span> A9191\/Desire HD\/G10\/DHD 安卓系统智能手机双电双充8G卡","volume":53},
    {"click_url":"http:\/\/s.click.taobao.com\/t?e=zGU34CA7K%2BPkqB07S4%2FK0CITy7klxn%2F7bvn0ayzWJnVw%2FR8L3TPFIZ8WbPe95IzZJw%2FpHTe6OZVcDTTSLhot24uh1sKT0k5prWmZUtLP0%2FaXZAJ7l6SCOEyyMwKuQVcsn4bAmIUkZ0owM0DVwhLgJM17C0HZZWaHV24Wqgublw%3D%3D&pid=mm_17531361_0_0&spm=2014.21101696.2.0","commission":"5.00","commission_num":"0","commission_rate":"50.00","commission_volume":"0.00","coupon_end_time":"2012-09-29 12:25:00","coupon_price":"700.00","coupon_rate":"7000.00","coupon_start_time":"2012-09-20 23:35:20","item_location":"广东 深圳","nick":"xp80054466","num_iid":10524364113,"pic_url":"http:\/\/img01.taobaocdn.com\/bao\/uploaded\/i1\/T1EyYJXa4sXXX5uhg._112425.jpg","price":"1000.00","seller_credit_score":10,"shop_click_url":"http:\/\/s.click.taobao.com\/t?e=zGU34CA7K%2BPkqB04MQzdgG69RGcaJPb63yl1mhTcxLjztO5Tq6Gx5%2B%2FU56vxsG0zKkzGuOAnTF63JcORSOS2BjcE47Y7GV3Ma%2B26P3cvv3VtUZwOze1t4PirNmZAomW6p5v8xNatGtzTP494PbQ2bEs%3D&pid=mm_17531361_0_0","shop_type":"C","title":"<span class=H>HTC<\/span> A510e G13 Wildfire S\/野火S 全新原装正品  最新 8月产 包邮","volume":102},
    {"click_url":"http:\/\/s.click.taobao.com\/t?e=zGU34CA7K%2BPkqB07S4%2FK0CITy7klxn%2F7bvn0ayzWJnVw%2FR8L3TPFIZ8WbPe95IzZJw%2Fu8w9T0IvUc9jiXJf5GVn5Gj2fXbzBRfhFSO06df%2BhmBZJwVpxf2wxrK5FlVe6vLxyyiVRQXha9D2bXEfvIJeabybHgINXt%2FGyn5KNcHw%3D&pid=mm_17531361_0_0&spm=2014.21101696.2.0","commission":"10.50","commission_num":"0","commission_rate":"150.00","commission_volume":"0.00","coupon_end_time":"2012-09-30 13:27:58","coupon_price":"500.01","coupon_rate":"7143.00","coupon_start_time":"2012-04-18 13:27:45","item_location":"广东 深圳","nick":"梅花勿念","num_iid":15545606405,"pic_url":"http:\/\/img08.taobaocdn.com\/bao\/uploaded\/i8\/T1mnnhXb0eXXbxtYE2_042958.jpg","price":"700.00","seller_credit_score":9,"shop_click_url":"http:\/\/s.click.taobao.com\/t?e=zGU34CA7K%2BPkqB04MQzdgG69RGcaJPb63yl1mhTcxLjztO5Tq6Gx5%2B%2FU56vxsG0zKkzBhu8GLgQVfmMurMuVnZZVT1b20kGPVk%2FD4TZE1rmy6ydlOcooTq%2Fr0Yha%2BubZ1nDyw8r9JCqsEI051lm%2Fd4hY&pid=mm_17531361_0_0","shop_type":"C","title":"<span class=H>HTC<\/span> EVO 手机电信天翼CDMA安卓 3G智能手机送大礼 包邮","volume":16},
    {"click_url":"http:\/\/s.click.taobao.com\/t?e=zGU34CA7K%2BPkqB07S4%2FK0CITy7klxn%2F7bvn0ayzWJnVw%2FR8L3TPFIZ8WbPe95IzZJw%2Ft9d3ygFCX%2BiQpDsa9LCDg6JDtm3YCBTMBR4l%2Fu8H3jEeFA3pMsuCfkOLovizgn3eFBTCRbDbLi59hMgHKjNO7mgsNyRXoI2vpX7UO7YY%3D&pid=mm_17531361_0_0&spm=2014.21101696.2.0","commission":"31.80","commission_num":"6","commission_rate":"300.00","commission_volume":"203.88","coupon_end_time":"2012-10-01 09:40:49","coupon_price":"779.10","coupon_rate":"7350.00","coupon_start_time":"2012-09-20 15:17:49","item_location":"广东 广州","nick":"中国赛龙科技","num_iid":14907230962,"pic_url":"http:\/\/img03.taobaocdn.com\/bao\/uploaded\/i3\/T1L7fNXn4mXXbb0pEW_022334.jpg","price":"1060.00","seller_credit_score":9,"shop_click_url":"http:\/\/s.click.taobao.com\/t?e=zGU34CA7K%2BPkqB04MQzdgG69RGcaJPb63yl1mhTcxLjztO5Tq6Gx5%2B%2FU56vxsG0zKkzCbB9V0IbUhndf03xz%2FrKdd8XDPOqbmlSYGZFLDxPeTF1B3heiBK53bxROep4GN5TdwFXFGbjKZvDJwhUSpQtb&pid=mm_17531361_0_0","shop_type":"C","title":"<span class=H>HTC<\/span> inspire 4G G11\/G26 惊艳双核3G安卓智能手机800万像素","volume":64},
    {"click_url":"http:\/\/s.click.taobao.com\/t?e=zGU34CA7K%2BPkqB07S4%2FK0CITy7klxn%2F7bvn0ayzWJnVw%2FR8L3TPFIZ8WbPe95IzZJw%2Fi%2BgU428C61vf0tu2lUpOlVw%2B3xXxv0v6whwbfrXb7L2QLaHUF%2BinbVjZ7EXt1jUunAc1jRUMu3qZZdNvNcIwB2fjlSD33duh6pGmnHA%3D%3D&pid=mm_17531361_0_0&spm=2014.21101696.2.0","commission":"1.36","commission_num":"0","commission_rate":"100.00","commission_volume":"0.00","coupon_end_time":"2012-09-23 02:00:00","coupon_price":"64.06","coupon_rate":"4710.00","coupon_start_time":"2012-09-22 08:00:00","item_location":"广东 深圳","nick":"fengfeng_20088888","num_iid":15886939685,"pic_url":"http:\/\/img04.taobaocdn.com\/bao\/uploaded\/i4\/T1hPqYXnVtXXceBREV_021525.jpg","price":"136.00","seller_credit_score":8,"shop_click_url":"http:\/\/s.click.taobao.com\/t?e=zGU34CA7K%2BPkqB04MQzdgG69RGcaJPb63yl1mhTcxLjztO5Tq6Gx5%2B%2FU56vxsG0zKkzN6Dc%2BniQj9hKzCWAbE6ZLz8g0VdachBqkgTEH6MGkMUCwPdu5YCeubGKFrjiCtjByeMmtambhLcafTs3Ozf0%3D&pid=mm_17531361_0_0","shop_type":"C","title":"#独畅团#Hello Kitty苹果<span class=H>HTC<\/span>移动电源充电器外置电池充电宝","volume":50},
    {"click_url":"http:\/\/s.click.taobao.com\/t?e=zGU34CA7K%2BPkqB07S4%2FK0CITy7klxn%2F7bvn0ayzWJnVw%2FR8L3TPFIZ8WbPe95IzZJw%2FoohlaXD5RFp99WkXpu4rv8H9Ee%2FvBBA84mzriuG9zNTRO7TiA9iaM%2FbEuc9db9LczwtNUrf9WxD0HV5eShQSKHyO7QpyCkQGi0aUQdg%3D%3D&pid=mm_17531361_0_0&spm=2014.21101696.2.0","commission":"3.56","commission_num":"0","commission_rate":"50.00","commission_volume":"0.00","coupon_end_time":"2012-10-15 23:56:13","coupon_price":"498.40","coupon_rate":"7000.00","coupon_start_time":"2012-07-01 14:48:13","item_location":"上海","nick":"飞扬通讯电子有限公司","num_iid":15752883885,"pic_url":"http:\/\/img03.taobaocdn.com\/bao\/uploaded\/i3\/T1VrHKXadnXXaEFCcZ_033414.jpg","price":"712.00","seller_credit_score":10,"shop_click_url":"http:\/\/s.click.taobao.com\/t?e=zGU34CA7K%2BPkqB04MQzdgG69RGcaJPb63yl1mhTcxLjztO5Tq6Gx5%2B%2FU56vxsG0zKkzHMbSavZjDpJ%2BVExuYYxu%2FMif3%2FWYuTCwyfrtH92q7bYXPy7o%2F%2F4jRRDFJZOMSuFEanOlpD9y5fZ9ooAhramQ%3D&pid=mm_17531361_0_0","shop_type":"C","title":"<span class=H>HTC<\/span> EVO 4G A9292--4.3寸电信CDMA 双电双冲 2.3.5 限时特价","volume":42},{"click_url":"http:\/\/s.click.taobao.com\/t?e=zGU34CA7K%2BPkqB07S4%2FK0CITy7klxn%2F7bvn0ayzWJnVw%2FR8L3TPFIZ8WbPe95IzZJw%2FrnQqRA9cwxvcWvEPrGLT1O8%2FGnzlWYRmd56oiRjxl6dB70q5X6mPb9W6Z2IkJaUWjXtudd2UmbCljIdlqq1sf%2BEFnuixOVWmHUDcbLH4%3D&pid=mm_17531361_0_0&spm=2014.21101696.2.0","commission":"5.00","commission_num":"0","commission_rate":"50.00","commission_volume":"0.00","coupon_end_time":"2013-01-20 00:43:05","coupon_price":"700.00","coupon_rate":"7000.00","coupon_start_time":"2012-09-20 00:42:33","item_location":"广东 深圳","nick":"guocong666","num_iid":16163511421,"pic_url":"http:\/\/img03.taobaocdn.com\/bao\/uploaded\/i3\/T19BTMXadeXXalff7._111957.jpg","price":"1000.00","seller_credit_score":9,"shop_click_url":"http:\/\/s.click.taobao.com\/t?e=zGU34CA7K%2BPkqB04MQzdgG69RGcaJPb63yl1mhTcxLjztO5Tq6Gx5%2B%2FU56vxsG0zKkzEvRw3aNaPyAkrTWAc7wd8xEofxG1cOLFowf3lANtb3D3LpJoM1t5hlKYUovfZ3fcJQ99wBnbsH0RBi2lO%2FBVH&pid=mm_17531361_0_0","shop_type":"C","title":"<span class=H>HTC<\/span> A510e G13 Wildfire S 解S-OFF 全新正品 包邮","volume":183},{"click_url":"http:\/\/s.click.taobao.com\/t?e=zGU34CA7K%2BPkqB07S4%2FK0CITy7klxn%2F7bvn0ayzWJnVw%2FR8L3TPFIZ8WbPe95IzZJw%2FrnnqjJVzMGBf2FbW8jN5L12NZ7bIVt6tuAjrYLwIU3vCWcctoUBrLEBB9wZ2Svcnpd6mDZb53A9o5aN3wZP7kKwYa%2BeJnO4MZ3siXiA%3D%3D&pid=mm_17531361_0_0&spm=2014.21101696.2.0","commission":"6.00","commission_num":"0","commission_rate":"100.00","commission_volume":"0.00","coupon_end_time":"2012-09-23 00:00:00","coupon_price":"480.00","coupon_rate":"8000.00","coupon_start_time":"2012-09-22 11:00:00","item_location":"广东 深圳","nick":"灵通资讯","num_iid":15075630895,"pic_url":"http:\/\/img04.taobaocdn.com\/bao\/uploaded\/i4\/T1dMy.XeRqXXbciYI1_040337.jpg","price":"600.00","seller_credit_score":11,"shop_click_url":"http:\/\/s.click.taobao.com\/t?e=zGU34CA7K%2BPkqB04MQzdgG69RGcaJPb63yl1mhTcxLjztO5Tq6Gx5%2B%2FU56vxsG0zKkzEvmS8LMND5oB2wFG9uey0jpczs8I8B84pWxAd7AfviOPjlQoxhHeolrDgafQ1Stob1hRCHr6u2XiNtWEQ1ag%3D&pid=mm_17531361_0_0","shop_type":"C","title":"现货礼包+膜+座充 安卓智能 <span class=H>HTC<\/span> evo 电信3G天翼CDMA手机 4.3大屏","volume":12},{"click_url":"http:\/\/s.click.taobao.com\/t?e=zGU34CA7K%2BPkqB07S4%2FK0CITy7klxn%2F7bvn0ayzWJnVw%2FR8L3TPFIZ8WbPe95IzZJw%2FrnCycMEtPMa7jwsGhmWBrXBkpWE6%2FpQIVd2Q9nlQKJePutP%2Fb3fjmeKwTGBYK0u0kvZFPIq%2BYNG1xCc97fm3n8qL9yzax63%2B83PZuQHc%3D&pid=mm_17531361_0_0&spm=2014.21101696.2.0","commission":"74.94","commission_num":"8","commission_rate":"600.00","commission_volume":"616.75","coupon_end_time":"2012-09-23 23:59:59","coupon_price":"999.20","coupon_rate":"8000.00","coupon_start_time":"2012-08-27 11:16:08","item_location":"上海","nick":"ninecontinents","num_iid":16941659323,"pic_url":"http:\/\/img05.taobaocdn.com\/bao\/uploaded\/i5\/T1EmjJXjBfXXclhnQU_015853.jpg","price":"1249.00","seller_credit_score":6,"shop_click_url":"http:\/\/s.click.taobao.com\/t?e=zGU34CA7K%2BPkqB04MQzdgG69RGcaJPb63yl1mhTcxLjztO5Tq6Gx5%2B%2FU56vxsG0zKkzEvJ4c3fx3oiFEoOpVZ%2BMUUuoezn9ju7Vqf%2BBUH9RcKxH5tdWBG6Og35LPnSlnq5hl2iblJq9OmJPqeZp4C5zJ&pid=mm_17531361_0_0","shop_type":"C","title":"<span class=H>htc<\/span>原装G29手机双核1.5G 双卡双待 安卓智能手机 G28\/G30官网验证","volume":253},{"click_url":"http:\/\/s.click.taobao.com\/t?e=zGU34CA7K%2BPkqB07S4%2FK0CITy7klxn%2F7bvn0ayzWJnVw%2FR8L3TPFIZ8WbPe95IzZJw%2FpF7ebg%2FEdftujU5GsIsu898STjtmJ623Les1NVnwmv3p2ohGIEY4m7Ut%2FpaLG5NIsGehoxVdv4RNJC2Lnz%2FscgMRYaO0OJ2BWsxU93r4%3D&pid=mm_17531361_0_0&spm=2014.21101696.2.0","commission":"43.50","commission_num":"133","commission_rate":"150.00","commission_volume":"3953.32","coupon_end_time":"2012-09-30 23:59:59","coupon_price":"1779.15","coupon_rate":"6135.00","coupon_start_time":"2012-08-24 14:29:18","item_location":"上海","nick":"xiaochangliu00","num_iid":15486096245,"pic_url":"http:\/\/img03.taobaocdn.com\/bao\/uploaded\/i3\/T1Ny2NXkRcXXaLY.MZ_034034.jpg","price":"2900.00","seller_credit_score":10,"shop_click_url":"http:\/\/s.click.taobao.com\/t?e=zGU34CA7K%2BPkqB04MQzdgG69RGcaJPb63yl1mhTcxLjztO5Tq6Gx5%2B%2FU56vxsG0zKkzGsq%2BFW8vGIIlu9zjcWz41cgoGkf4T1L7QMPXE92PQuURn0Na8qa9IrHDHPabAIJeGpkSRxNOhMt7spuOntqn7&pid=mm_17531361_0_0","shop_type":"C","title":"冲皇冠<span class=H>HTC<\/span> Z715e G18 Sensation XE 港版 最新5月 送原电座充8G卡","volume":729},{"click_url":"http:\/\/s.click.taobao.com\/t?e=zGU34CA7K%2BPkqB07S4%2FK0CITy7klxn%2F7bvn0ayzWJnVw%2FR8L3TPFIZ8WbPe95IzZJw%2Fi%2FxbMs3ZGr%2BpB3oe3cCHDf7g6ql5nwF8nfIieCtbn1cqIRSX6IuLcJ8ZmW%2B%2BeLL3UBZt0rgKwSUGlhHGJknc6iOcvOjOPx8AEd2SU%2FVY%3D&pid=mm_17531361_0_0&spm=2014.21101696.2.0","commission":"6.00","commission_num":"0","commission_rate":"50.00","commission_volume":"0.00","coupon_end_time":"2012-12-01 11:06:48","coupon_price":"600.00","coupon_rate":"5000.00","coupon_start_time":"2012-09-11 11:06:45","item_location":"广东 深圳","nick":"酷7数码","num_iid":15364372249,"pic_url":"http:\/\/img01.taobaocdn.com\/bao\/uploaded\/i1\/T1ct5nXkl6XXcQ_PcV_020919.jpg","price":"1200.00","seller_credit_score":8,"shop_click_url":"http:\/\/s.click.taobao.com\/t?e=zGU34CA7K%2BPkqB04MQzdgG69RGcaJPb63yl1mhTcxLjztO5Tq6Gx5%2B%2FU56vxsG0zKkzN7V5rzE438PSO1bw5usQRvwxUpe1uyvCgWWVLfI6bVlYFaxeQlyj9LnVbW092qWWYuifChRc3HGZkSfMHBOgT&pid=mm_17531361_0_0","shop_type":"C","title":"<span class=H>HTC<\/span> T8788 7 Surround WP7芒果可刷8772 支持验证内置16G清仓促销","volume":26},{"click_url":"http:\/\/s.click.taobao.com\/t?e=zGU34CA7K%2BPkqB07S4%2FK0CITy7klxn%2F7bvn0ayzWJnVw%2FR8L3TPFIZ8WbPe95IzZJw%2FsUc4haaqISkcdiBYrDFjQZYpo4qB5MVlGxM7dHnULf9%2B0AuNtXGruOxFnSAqHFiFFDQ%2FGY426lkwPq446ORWbVjYLKk87BUYba8Uncls%3D&pid=mm_17531361_0_0&spm=2014.21101696.2.0","commission":"25.66","commission_num":"5","commission_rate":"200.00","commission_volume":"114.99","coupon_end_time":"2012-09-26 03:01:00","coupon_price":"679.99","coupon_rate":"5300.00","coupon_start_time":"2012-09-19 10:28:00","item_location":"上海","nick":"周碧婵","num_iid":15075536270,"pic_url":"http:\/\/img01.taobaocdn.com\/bao\/uploaded\/i1\/T1Um2wXeFrXXXumkPX_085820.jpg","price":"1283.00","seller_credit_score":8,"shop_click_url":"http:\/\/s.click.taobao.com\/t?e=zGU34CA7K%2BPkqB04MQzdgG69RGcaJPb63yl1mhTcxLjztO5Tq6Gx5%2B%2FU56vxsG0zKkzDNNOUz%2BqC67OBM%2BPGi%2BUVqikTUHkgPKiJTPW4K39HKkSnelhzy9e35TC0VAVkWstN34ahGv6xSpYTa4q6%2FMfm&pid=mm_17531361_0_0","shop_type":"C","title":"<span class=H>HTC<\/span> A510e G13 Wildfire S\/G13 正品行货联保 送原电 商务蓝牙","volume":19},{"click_url":"http:\/\/s.click.taobao.com\/t?e=zGU34CA7K%2BPkqB07S4%2FK0CITy7klxn%2F7bvn0ayzWJnVw%2FR8L3TPFIZ8WbPe95IzZJw%2FrnC8DySRxrqcNkOmoarnO2KzMTGMIcadkITL87OqbT6L3BPuifndnZesDdPwxMOZKI9n7a1%2FmHQ7jEz2abqb3lsCOIKgyEvtPHgpespo%3D&pid=mm_17531361_0_0&spm=2014.21101696.2.0","commission":"28.20","commission_num":"1","commission_rate":"300.00","commission_volume":"19.53","coupon_end_time":"2012-10-10 13:23:04","coupon_price":"658.00","coupon_rate":"7000.00","coupon_start_time":"2012-09-17 12:25:58","item_location":"广东 深圳","nick":"朱成亿","num_iid":15918361989,"pic_url":"http:\/\/img05.taobaocdn.com\/bao\/uploaded\/i5\/T1FwHMXcpfXXaSDqZZ_031359.jpg","price":"940.00","seller_credit_score":6,"shop_click_url":"http:\/\/s.click.taobao.com\/t?e=zGU34CA7K%2BPkqB04MQzdgG69RGcaJPb63yl1mhTcxLjztO5Tq6Gx5%2B%2FU56vxsG0zKkzEvJ3esblUYn29R2dXTipulpHWz3buCooKVY5kI%2FhtcgfE857VDS2woIgFLSUOBPdfB0WiIdP1KHZ3VgGiZ5lp&pid=mm_17531361_0_0","shop_type":"C","title":"<span class=H>HTC<\/span> A510e G13 Wildfire S 野火S <span class=H>htc<\/span> g13全新 智能安卓2.37","volume":12},{"click_url":"http:\/\/s.click.taobao.com\/t?e=zGU34CA7K%2BPkqB07S4%2FK0CITy7klxn%2F7bvn0ayzWJnVw%2FR8L3TPFIZ8WbPe95IzZJw%2FrmqGha8uMDHWtZOLxJUTsJogBfjM0FPD%2B%2B8BGrIfgmbT%2FFUPmwSc5hFdlqy4UQiWHlv9C7JGNVgqkiprWx23bAGxAWHzqcbx7Mht6x6k%3D&pid=mm_17531361_0_0&spm=2014.21101696.2.0","commission":"6.00","commission_num":"0","commission_rate":"50.00","commission_volume":"0.00","coupon_end_time":"2012-09-24 10:00:00","coupon_price":"640.08","coupon_rate":"5334.00","coupon_start_time":"2012-09-10 10:00:00","item_location":"广东 深圳","nick":"老鹰通信","num_iid":15733233290,"pic_url":"http:\/\/img01.taobaocdn.com\/bao\/uploaded\/i1\/T1M_nIXXRbXXbhm.E8_102144.jpg","price":"1200.00","seller_credit_score":10,"shop_click_url":"http:\/\/s.click.taobao.com\/t?e=zGU34CA7K%2BPkqB04MQzdgG69RGcaJPb63yl1mhTcxLjztO5Tq6Gx5%2B%2FU56vxsG0zKkzEuoaQ2%2FDuVr8yzu37J16xM%2FTjt5LP%2F%2FrPDhIWeyLon99EDfmZYwqu5fvj7NKNF8hdGoAOMOPB3cJLb%2FuLptiH&pid=mm_17531361_0_0","shop_type":"C","title":"钓鱼岛是中国的 <span class=H>HTC<\/span> A510e G13 Wildfire S\/野火S<span class=H>htc<\/span>f包邮+送电池","volume":11},{"click_url":"http:\/\/s.click.taobao.com\/t?e=zGU34CA7K%2BPkqB07S4%2FK0CITy7klxn%2F7bvn0ayzWJnVw%2FR8L3TPFIZ8WbPe95IzZJw%2FsXptzSDl9KCp6EiLdDC2i0Pyu44ZHWhBKPYXOkzPrWz7%2FxC91z84xeLSAZbJZWFcVTP%2B5uc9fLXWm5uqHFlmbDcSMhodqpuGCtOf9bbU%3D&pid=mm_17531361_0_0&spm=2014.21101696.2.0","commission":"14.00","commission_num":"48","commission_rate":"70.00","commission_volume":"585.13","coupon_end_time":"2012-09-30 05:30:00","coupon_price":"1400.00","coupon_rate":"7000.00","coupon_start_time":"2012-09-17 07:39:00","item_location":"上海","nick":"给力2011数码8","num_iid":14999497785,"pic_url":"http:\/\/img01.taobaocdn.com\/bao\/uploaded\/i1\/T1SjDHXitfXXbEHlc9_074345.jpg","price":"2000.00","seller_credit_score":7,"shop_click_url":"http:\/\/s.click.taobao.com\/t?e=zGU34CA7K%2BPkqB04MQzdgG69RGcaJPb63yl1mhTcxLjztO5Tq6Gx5%2B%2FU56vxsG0zKkzDO%2BxGwaj7CQWGtvnY7atyhiaPdYBV61j3EhwK9CqtwWDrOJ%2BAeKakMToqhDqo2dCsTJJP6gE5Cmq0et%2BxZAd%2B&pid=mm_17531361_0_0","shop_type":"C","title":"未拆封<span class=H>HTC<\/span> S710e G11 Incredible S手机12年3-4月产 大陆行<span class=H>htc<\/span>g11","volume":140},{"click_url":"http:\/\/s.click.taobao.com\/t?e=zGU34CA7K%2BPkqB07S4%2FK0CITy7klxn%2F7bvn0ayzWJnVw%2FR8L3TPFIZ8WbPe95IzZJw%2Fi9aSpCF0btJuF30YRcTpQyfBtGsTHIwh%2B7dOn%2FvSWaZoGhsk8aG%2BN67%2BR7A5wmH3kBgONFkoDa7ca4BsBemwm6Lw41PTHmrQITM8EiA%3D%3D&pid=mm_17531361_0_0&spm=2014.21101696.2.0","commission":"4.50","commission_num":"0","commission_rate":"50.00","commission_volume":"0.00","coupon_end_time":"2012-10-03 00:00:00","coupon_price":"657.00","coupon_rate":"7300.00","coupon_start_time":"2012-09-03 00:23:22","item_location":"广东 广州","nick":"曾永南","num_iid":19690728653,"pic_url":"http:\/\/img04.taobaocdn.com\/bao\/uploaded\/i4\/T1MGbOXaloXXbUj2E._111921.jpg","price":"900.00","seller_credit_score":9,"shop_click_url":"http:\/\/s.click.taobao.com\/t?e=zGU34CA7K%2BPkqB04MQzdgG69RGcaJPb63yl1mhTcxLjztO5Tq6Gx5%2B%2FU56vxsG0zKkzN50rdIMO1ILkOX1OHJ15oFyY2OKEnxJfng0G%2Br9YbR2TSD9izsu9Nx3gukdFhimHUBwSbTLy2REN38u0d2TE%3D&pid=mm_17531361_0_0","shop_type":"C","title":"<span class=H>HTC<\/span> A510e G13 Wildfire S 安卓系统 正品 支持验证","volume":21},{"click_url":"http:\/\/s.click.taobao.com\/t?e=zGU34CA7K%2BPkqB07S4%2FK0CITy7klxn%2F7bvn0ayzWJnVw%2FR8L3TPFIZ8WbPe95IzZJw%2Frn%2FcFr8gQf9oGdm57k3LRDKT3Rp%2FWKEk36mqmjizlhhTzQ2uRYuwqynVFBnbDqZMfmxcqS4N4o8JPPmffHXu215OhJEERi2BSymDaFRQ%3D&pid=mm_17531361_0_0&spm=2014.21101696.2.0","commission":"31.20","commission_num":"0","commission_rate":"300.00","commission_volume":"0.00","coupon_end_time":"2012-10-31 10:40:11","coupon_price":"639.08","coupon_rate":"6145.00","coupon_start_time":"2012-08-21 10:40:08","item_location":"广东 深圳","nick":"赖林海","num_iid":18483084024,"pic_url":"http:\/\/img01.taobaocdn.com\/bao\/uploaded\/i1\/T11A6FXhppXXbBtpra_120012.jpg","price":"1040.00","seller_credit_score":7,"shop_click_url":"http:\/\/s.click.taobao.com\/t?e=zGU34CA7K%2BPkqB04MQzdgG69RGcaJPb63yl1mhTcxLjztO5Tq6Gx5%2B%2FU56vxsG0zKkzEvwRVdVWolqOKbKcrFjsld%2BxAVAxnNTXf1sY3BDa8bgsVojGBNqsFqgOEI%2BK3QG6dWxsiqtADaDNi4bK3uPlJ&pid=mm_17531361_0_0","shop_type":"C","title":"<span class=H>HTC<\/span> A510e G13 Wildfire S野火S正品手机 解S-off 大陆行魔声耳机","volume":38},{"click_url":"http:\/\/s.click.taobao.com\/t?e=zGU34CA7K%2BPkqB07S4%2FK0CITy7klxn%2F7bvn0ayzWJnVw%2FR8L3TPFIZ8WbPe95IzZJw%2Ft9IuowbLWG5wDaB6KEaGzvGq64PwKtKDxu4lIy4OG2st528UBqTmKosbT1Y1GbLtk1pXRBBKlrsW6%2BWkvyXOuwGNXPFNrlLsE8ebSsJo%3D&pid=mm_17531361_0_0&spm=2014.21101696.2.0","commission":"2.30","commission_num":"0","commission_rate":"500.00","commission_volume":"0.00","coupon_end_time":"2012-12-31 00:00:00","coupon_price":"38.18","coupon_rate":"8300.00","coupon_start_time":"2012-09-03 00:00:00","item_location":"广东 深圳","nick":"wenping2030","num_iid":18446372120,"pic_url":"http:\/\/img03.taobaocdn.com\/bao\/uploaded\/i3\/T1SLfpXoXrXXafh3.9_073529.jpg","price":"46.00","seller_credit_score":9,"shop_click_url":"http:\/\/s.click.taobao.com\/t?e=zGU34CA7K%2BPkqB04MQzdgG69RGcaJPb63yl1mhTcxLjztO5Tq6Gx5%2B%2FU56vxsG0zKkzCbat%2FTYAckXbQ9S6gz4Wfi4nEDbmn%2BMLJNn8uNHzHxlGjNRsfU9fdBOmyhMEXFC%2BWCPdHFoH5IgZCmWpzfoRG&pid=mm_17531361_0_0","shop_type":"C","title":"包邮iphone4s 三星 <span class=H>HTC<\/span> 3.5mm手机音箱 迷你小音响 低音炮 可爱","volume":1479},{"click_url":"http:\/\/s.click.taobao.com\/t?e=zGU34CA7K%2BPkqB07S4%2FK0CITy7klxn%2F7bvn0ayzWJnVw%2FR8L3TPFIZ8WbPe95IzZJw%2FsXpt3Y0n%2FYHREQaxWFxRgX93SrNvzNvA8%2FRSXI%2BDIh%2BuH%2BNewW0D2Oq9ueLoHDA%2BUWYtHZ2daCdYw%2FEhkPd9qsF2bAsvtcxcDWXjdgA%3D%3D&pid=mm_17531361_0_0&spm=2014.21101696.2.0","commission":"3.90","commission_num":"0","commission_rate":"300.00","commission_volume":"0.00","coupon_end_time":"2012-12-06 00:59:56","coupon_price":"65.00","coupon_rate":"5000.00","coupon_start_time":"2012-09-06 00:59:56","item_location":"浙江 温州","nick":"f589912","num_iid":15829818554,"pic_url":"http:\/\/img03.taobaocdn.com\/bao\/uploaded\/i3\/T1RbvLXlpXXXbdURsT_012627.jpg","price":"130.00","seller_credit_score":6,"shop_click_url":"http:\/\/s.click.taobao.com\/t?e=zGU34CA7K%2BPkqB04MQzdgG69RGcaJPb63yl1mhTcxLjztO5Tq6Gx5%2B%2FU56vxsG0zKkzDO%2BxCWDXvOSftomfkcArHA5B4Uw620GcKPYclAhyCgE5h41MCiHxow7FvreXf%2Bq45NAQkZFGkE58EDjUOMDk%3D&pid=mm_17531361_0_0","shop_type":"C","title":"<span class=H>HTC<\/span> One X配件手机壳s720e手机套G23保护套 外壳保护壳真空电镀壳","volume":22},{"click_url":"http:\/\/s.click.taobao.com\/t?e=zGU34CA7K%2BPkqB07S4%2FK0CITy7klxn%2F7bvn0ayzWJnVw%2FR8L3TPFIZ8WbPe95IzZJw%2FsXUgjzQbd5Sa9UEc4PMNubLw0NZS3TtHT2u63WfIoeJRotEJpXf79Sy04%2FDklkf1Al8kVlar%2Fc6rFLS%2FjJe4aMtTDRHT3hrGAQrScJ1M%3D&pid=mm_17531361_0_0&spm=2014.21101696.2.0","commission":"9.40","commission_num":"0","commission_rate":"50.00","commission_volume":"0.00","coupon_end_time":"2013-04-30 05:00:00","coupon_price":"1178.76","coupon_rate":"6270.00","coupon_start_time":"2012-08-28 09:03:00","item_location":"上海","nick":"ace女神","num_iid":15424277548,"pic_url":"http:\/\/img07.taobaocdn.com\/bao\/uploaded\/i7\/T1UjHOXlNdXXbZlnEW_024717.jpg","price":"1880.00","seller_credit_score":8,"shop_click_url":"http:\/\/s.click.taobao.com\/t?e=zGU34CA7K%2BPkqB04MQzdgG69RGcaJPb63yl1mhTcxLjztO5Tq6Gx5%2B%2FU56vxsG0zKkzDOBtDOc0h8hz%2Fg1NVYvVsOwcYdKYh%2BLTFFsZurPbKsoUyjDgi36fUT9BM%2BTd0pw1dcCbyJmmj7gKBpTe2NvEX&pid=mm_17531361_0_0","shop_type":"C","title":"<span class=H>HTC<\/span> Thunderbolt 4G 双核800万像素安卓智能手机4.3寸1280P高清屏","volume":96},{"click_url":"http:\/\/s.click.taobao.com\/t?e=zGU34CA7K%2BPkqB07S4%2FK0CITy7klxn%2F7bvn0ayzWJnVw%2FR8L3TPFIZ8WbPe95IzZJw%2Fu%2BkRvrNS1J1u2mTYiq7GVVVkzXKt9JuBGGgKVzoSdhqgFmedTJ4N4oTBAupoZ9XdtWzcxIMYeKrow6TBeeCeTgtQcEp9S2veKa8qdtA%3D%3D&pid=mm_17531361_0_0&spm=2014.21101696.2.0","commission":"33.00","commission_num":"159","commission_rate":"150.00","commission_volume":"3934.61","coupon_end_time":"2012-09-30 02:46:00","coupon_price":"1499.08","coupon_rate":"6814.00","coupon_start_time":"2012-09-21 16:47:00","item_location":"广东 深圳","nick":"vikyqiu","num_iid":16613752006,"pic_url":"http:\/\/img03.taobaocdn.com\/bao\/uploaded\/i3\/T1CIbOXXFkXXc_YP71_042020.jpg","price":"2200.00","seller_credit_score":12,"shop_click_url":"http:\/\/s.click.taobao.com\/t?e=zGU34CA7K%2BPkqB04MQzdgG69RGcaJPb63yl1mhTcxLjztO5Tq6Gx5%2B%2FU56vxsG0zKkzBj8AEVwkuRbW%2FhxoxdgHnv5R21y%2F5Hun%2FUHKPsFWlK%2FBLGg5cXWnFejjku%2FXjR1eAE6ZJYaVo9PN67VInl9U%3D&pid=mm_17531361_0_0","shop_type":"C","title":"<span class=H>HTC<\/span> S710e G11 Incredible S安卓<span class=H>htc<\/span>g11手机 12年4月份产 双冠","volume":728},{"click_url":"http:\/\/s.click.taobao.com\/t?e=zGU34CA7K%2BPkqB07S4%2FK0CITy7klxn%2F7bvn0ayzWJnVw%2FR8L3TPFIZ8WbPe95IzZJw%2Foqh%2FSV07HCrsuXuEBE3dQdDzoKyVGKxMx77ykLSn8yzVmGMPQJxefCQpfmuygkW0PitcM%2Bc26gH1q9%2FEAUCPCE%2FpdMHv%2FMm9OHKkKxW0%3D&pid=mm_17531361_0_0&spm=2014.21101696.2.0","commission":"13.30","commission_num":"0","commission_rate":"50.00","commission_volume":"0.00","coupon_end_time":"2012-12-02 16:45:23","coupon_price":"1330.00","coupon_rate":"5000.00","coupon_start_time":"2012-09-08 16:45:23","item_location":"广东 深圳","nick":"西盟数码科技","num_iid":15862058740,"pic_url":"http:\/\/img03.taobaocdn.com\/bao\/uploaded\/i3\/T1DqDOXlVbXXXE37.T_012602.jpg","price":"2660.00","seller_credit_score":9,"shop_click_url":"http:\/\/s.click.taobao.com\/t?e=zGU34CA7K%2BPkqB04MQzdgG69RGcaJPb63yl1mhTcxLjztO5Tq6Gx5%2B%2FU56vxsG0zKkzHOeUUSi4RhiDu9tvvM37JxtkWhNalew5qZcnqQWfu0hu3Jit48aTpHiRBhrK%2BOiZtMfrNWe1nLYDnuCaR%2BmPu&pid=mm_17531361_0_0","shop_type":"C","title":"<span class=H>HTC<\/span> S710e G11 Incredible S 安卓智能手机 4英寸 GPS导航 包邮","volume":12},{"click_url":"http:\/\/s.click.taobao.com\/t?e=zGU34CA7K%2BPkqB07S4%2FK0CITy7klxn%2F7bvn0ayzWJnVw%2FR8L3TPFIZ8WbPe95IzZJw%2FsWYA0nuwHPHxWWPssuoIfF10XnKNQD88FBqXC48vpTiHRwmAw4LH82A8YGh2lwlllXUu2ekTaCYPoDUw0nZ1%2BGgKrgZL8YByqPSTPqXc%3D&pid=mm_17531361_0_0&spm=2014.21101696.2.0","commission":"7.15","commission_num":"0","commission_rate":"50.00","commission_volume":"0.00","coupon_end_time":"2013-06-30 05:01:00","coupon_price":"1080.08","coupon_rate":"7553.00","coupon_start_time":"2012-09-03 09:44:00","item_location":"广东 深圳","nick":"棒棒糖19871128","num_iid":18413456324,"pic_url":"http:\/\/img04.taobaocdn.com\/bao\/uploaded\/i4\/T1q6jxXkXfXXcXSana_120126.jpg","price":"1430.00","seller_credit_score":10,"shop_click_url":"http:\/\/s.click.taobao.com\/t?e=zGU34CA7K%2BPkqB04MQzdgG69RGcaJPb63yl1mhTcxLjztO5Tq6Gx5%2B%2FU56vxsG0zKkzDPIOIpQFWHP6A9sO%2BE%2FukIGn4QwL2XsNlAVPFTw7I9tBJoreAXVtF5IQwVPveuqWSKPBvSJTKX2RsycesBo3T&pid=mm_17531361_0_0","shop_type":"C","title":"<span class=H>HTC<\/span> A320E Desire C渴望C 新款上市 魔音安卓4.0 ROOT 中秋特惠","volume":428},{"click_url":"http:\/\/s.click.taobao.com\/t?e=zGU34CA7K%2BPkqB07S4%2FK0CITy7klxn%2F7bvn0ayzWJnVw%2FR8L3TPFIZ8WbPe95IzZJw%2FrmacQuDEQix99uS4PJXXiTv2jUfO2nWMwFjF8dX85QCPJcebcyru%2B2JEa2JQRMhsNvXfTuEYKPqxLTcCwHRFhkAFVi4BMNXK1QNJ6z44%3D&pid=mm_17531361_0_0&spm=2014.21101696.2.0","commission":"33.75","commission_num":"11","commission_rate":"150.00","commission_volume":"239.89","coupon_end_time":"2012-10-10 11:05:17","coupon_price":"1350.00","coupon_rate":"6000.00","coupon_start_time":"2012-09-10 11:05:17","item_location":"广东 深圳","nick":"和讯通讯科技","num_iid":19500752466,"pic_url":"http:\/\/img02.taobaocdn.com\/bao\/uploaded\/i2\/T1_obLXldaXXbPzFg__104856.jpg","price":"2250.00","seller_credit_score":11,"shop_click_url":"http:\/\/s.click.taobao.com\/t?e=zGU34CA7K%2BPkqB04MQzdgG69RGcaJPb63yl1mhTcxLjztO5Tq6Gx5%2B%2FU56vxsG0zKkzEuTM%2B0SmedWmpUJ003Gc4mrAvjdCLlzb3mjqoG32TVGJPBJHfbZ9lrK%2BOHwrUjek%2B5lORC6k8IK5FS%2Butw%2BUN&pid=mm_17531361_0_0","shop_type":"C","title":"冲皇冠0利润 <span class=H>HTC<\/span> S710e G11 Incredible S[ 4月产正港全新未拆封]","volume":137},
{"click_url":"http:\/\/s.click.taobao.com\/t?e=zGU34CA7K%2BPkqB07S4%2FK0CITy7klxn%2F7bvn0ayzWJnVw%2FR8L3TPFIZ8WbPe95IzZJw%2FjvTvgNE64AazvauSN1NICRK%2BxuJ4%2Bdy%2FYRSKK8wI5Fd0o%2FKsLAmoV18VkzpT7huAu%2FwZwWGl3%2BlSGd79CZeXPAJYr5z6mx%2FruoNT88GM%3D&pid=mm_17531361_0_0&spm=2014.21101696.2.0","commission":"63.50","commission_num":"10","commission_rate":"500.00","commission_volume":"566.01","coupon_end_time":"2012-10-12 23:59:59","coupon_price":"889.00","coupon_rate":"7000.00","coupon_start_time":"2012-08-15 00:00:00","item_location":"广东 深圳","nick":"美丽花朵168","num_iid":19028132111,"pic_url":"http:\/\/img01.taobaocdn.com\/bao\/uploaded\/i1\/T1H5rIXktoXXaJ9M6X_085340.jpg","price":"1270.00","seller_credit_score":5,"shop_click_url":"http:\/\/s.click.taobao.com\/t?e=zGU34CA7K%2BPkqB04MQzdgG69RGcaJPb63yl1mhTcxLjztO5Tq6Gx5%2B%2FU56vxsG0zKkzMOwt5IQ202qZ5sq%2FeM4owy0t5o0cdl62JZ7atQFOfdNaeYvMDCMh0LCoSPQYn3LLNzAIr8gkS%2BBhpl49HpPc3&pid=mm_17531361_0_0","shop_type":"C","title":"<span class=H>HTC<\/span>原装G30双核1.5G安卓智能手机官网验证Dopod\/多普达 S710D","volume":94}
]
},
    "total_results":38355
}}';


$r = stripslashes($r);
var_export(json_decode($r, true));
