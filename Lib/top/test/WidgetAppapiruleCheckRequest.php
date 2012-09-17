<?php
require "../RequestCheckUtil.php";
require "../TopClient.php";
/**
 * TOP API: taobao.widget.appapirule.check request
 * 
 * @author auto create
 * @since 1.0, 2012-08-07 16:31:26
 */
class WidgetAppapiruleCheckRequest
{
	/** 
	 * 要判断权限的api名称，如果指定的api不存在，报错invalid method
	 **/
	private $apiName;
	
	private $apiParas = array();
	
	public function setApiName($apiName)
	{
		$this->apiName = $apiName;
		$this->apiParas["api_name"] = $apiName;
	}

	public function getApiName()
	{
		return $this->apiName;
	}

	public function getApiMethodName()
	{
		return "taobao.widget.appapirule.check";
	}
	
	public function getApiParas()
	{
		return $this->apiParas;
	}
	
	public function check()
	{
		
		RequestCheckUtil::checkNotNull($this->apiName,"apiName");
	}
}
$request = new WidgetAppapiruleCheckRequest;
$request->setApiName('taobao.item.get');
$tc = new TopClient();
var_export(json_decode(json_encode($tc->execute($request)), true));

/*
(
    "method": "post",
    "call_permission": "true",
    "need_auth": "true"
}
 */
