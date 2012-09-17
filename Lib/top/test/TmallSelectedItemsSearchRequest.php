<?php
require "../RequestCheckUtil.php";
require "../TopClient.php";
/**
 * TOP API: tmall.selected.items.search request
 * 
 * @author auto create
 * @since 1.0, 2012-08-07 16:31:26
 */
class TmallSelectedItemsSearchRequest
{
	/** 
	 * 后台类目ID，支持父类目或叶子类目，可以通过taobao.itemcats.get 获取到后台类目ID列表
	 **/
	private $cid;
	
	private $apiParas = array();
	
	public function setCid($cid)
	{
		$this->cid = $cid;
		$this->apiParas["cid"] = $cid;
	}

	public function getCid()
	{
		return $this->cid;
	}

	public function getApiMethodName()
	{
		return "tmall.selected.items.search";
	}
	
	public function getApiParas()
	{
		return $this->apiParas;
	}
	
	public function check()
	{
		
		RequestCheckUtil::checkNotNull($this->cid,"cid");
	}
}
$request = new TmallSelectedItemsSearchRequest;
$request->setCid(1945228);
$tc = new TopClient();
var_export(json_decode(json_encode($tc->execute($request)), true));
