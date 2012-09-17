<?php
require "../RequestCheckUtil.php";
require "../TopClient.php";
/**
 * TOP API: taobao.time.get request
 * 
 * @author auto create
 * @since 1.0, 2012-08-07 16:31:26
 */
class TimeGetRequest
{
	
	private $apiParas = array();
	
	public function getApiMethodName()
	{
		return "taobao.time.get";
	}
	
	public function getApiParas()
	{
		return $this->apiParas;
	}
	
	public function check()
	{
		
	}
}
$request = new TimeGetRequest;
$tc = new TopClient();
var_export(json_decode(json_encode($tc->execute($request)), true));
