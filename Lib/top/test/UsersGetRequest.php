<?php
require "../RequestCheckUtil.php";
require "../TopClient.php";
/**
 * TOP API: taobao.users.get request
 * 
 * @author auto create
 * @since 1.0, 2012-08-07 16:31:26
 */
class UsersGetRequest
{
	/** 
	 * 查询字段：User数据结构的公开信息字段列表，以半角逗号(,)分隔
	 **/
	private $fields;
	
	/** 
	 * 用户昵称，多个以半角逗号(,)分隔，最多40个
	 **/
	private $nicks;
	
	private $apiParas = array();
	
	public function setFields($fields)
	{
		$this->fields = $fields;
		$this->apiParas["fields"] = $fields;
	}

	public function getFields()
	{
		return $this->fields;
	}

	public function setNicks($nicks)
	{
		$this->nicks = $nicks;
		$this->apiParas["nicks"] = $nicks;
	}

	public function getNicks()
	{
		return $this->nicks;
	}

	public function getApiMethodName()
	{
		return "taobao.users.get";
	}
	
	public function getApiParas()
	{
		return $this->apiParas;
	}
	
	public function check()
	{
		
		RequestCheckUtil::checkNotNull($this->fields,"fields");
		RequestCheckUtil::checkNotNull($this->nicks,"nicks");
	}
}
$request = new;
$tc = new TopClient();
var_export(json_decode(json_encode($tc->execute($request)), true));
