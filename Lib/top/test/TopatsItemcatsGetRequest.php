<?php
require "../RequestCheckUtil.php";
require "../TopClient.php";
class CakeLog
{
	public function __call($name, $params){}
	public static function __callStatic($name, $params){}
}
/**
 * TOP API: taobao.topats.itemcats.get request
 * 
 * @author auto create
 * @since 1.0, 2012-08-07 16:37:49
 */
class TopatsItemcatsGetRequest
{
	/** 
	 * 一级类目ID列表（非一级类目将会被忽略），用半角逗号(,)分隔，例如:"16,19562"，一次最多可以获取10个类目的增量数据。<span style="color:red">注：传入0代表获取所有类目的数据。</span>
	 **/
	private $cids;
	
	/** 
	 * 类目数据输出格式，可选值为：csv, json。
	 **/
	private $outputFormat;
	
	/** 
	 * 卖家类型，可选值：C, B。不传默认值视为C卖家。
	 **/
	private $sellerType;
	
	private $apiParas = array();
	
	public function setCids($cids)
	{
		$this->cids = $cids;
		$this->apiParas["cids"] = $cids;
	}

	public function getCids()
	{
		return $this->cids;
	}

	public function setOutputFormat($outputFormat)
	{
		$this->outputFormat = $outputFormat;
		$this->apiParas["output_format"] = $outputFormat;
	}

	public function getOutputFormat()
	{
		return $this->outputFormat;
	}

	public function setSellerType($sellerType)
	{
		$this->sellerType = $sellerType;
		$this->apiParas["seller_type"] = $sellerType;
	}

	public function getSellerType()
	{
		return $this->sellerType;
	}

	public function getApiMethodName()
	{
		return "taobao.topats.itemcats.get";
	}
	
	public function getApiParas()
	{
		return $this->apiParas;
	}
	
	public function check()
	{
		
		RequestCheckUtil::checkNotNull($this->cids,"cids");
		RequestCheckUtil::checkNotNull($this->outputFormat,"outputFormat");
	}
}

$request = new TopatsItemcatsGetRequest();
$request->setCids('0');
//$request->setCids('289');
//$request->setSellerType('B'); //or C 卖家类型
$request->setOutputFormat("json");

$tc = new TopClient();
$result = json_decode(json_encode($tc->execute($request)), true);

var_export($result);
echo "\n";
