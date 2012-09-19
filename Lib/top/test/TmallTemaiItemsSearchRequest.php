<?php
require "../RequestCheckUtil.php";
require "../TopClient.php";
/**
 * TOP API: tmall.temai.items.search request
 * 
 * @author auto create
 * @since 1.0, 2012-08-07 16:31:26
 */
class TmallTemaiItemsSearchRequest
{
	/** 
	 * 特卖前台类目id，传入的必须是特卖类目50100982或其下的二级类目。
	 **/
	private $cat;
	
	/** 
	 * 排序类型。类型包括： s: 人气排序 p: 价格从低到高; pd: 价格从高到低; d: 月销量从高到低; pt: 按发布时间排序.
	 **/
	private $sort;
	
	/** 
	 * 表示查询起始位置:
start=0:返回第1条记录到第48条记录（即第一页）；
start=48:返回第48条记录到第96条记录（即第二页）；
start=96，start=144，start=192......
依此类推，每次加start值加48(每页返回记录数固定为48条)
	 **/
	private $start;
	
	private $apiParas = array();
	
	public function setCat($cat)
	{
		$this->cat = $cat;
		$this->apiParas["cat"] = $cat;
	}

	public function getCat()
	{
		return $this->cat;
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

	public function setStart($start)
	{
		$this->start = $start;
		$this->apiParas["start"] = $start;
	}

	public function getStart()
	{
		return $this->start;
	}

	public function getApiMethodName()
	{
		return "tmall.temai.items.search";
	}
	
	public function getApiParas()
	{
		return $this->apiParas;
	}
	
	public function check()
	{
		
		RequestCheckUtil::checkNotNull($this->cat,"cat");
	}
}
$request = new TmallTemaiItemsSearchRequest;
$request->setCat(50100982);
$tc = new TopClient();
$result = json_decode(json_encode($tc->execute($request)), true);


var_export($result);
echo "\n";