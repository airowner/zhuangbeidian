<?php
require "../RequestCheckUtil.php";
require "../TopClient.php";
/**
 * TOP API: taobao.shopcats.list.get request
 * 
 * @author auto create
 * @since 1.0, 2012-08-07 16:31:26
 */
class ShopcatsListGetRequest
{
	/** 
	 * 需要返回的字段列表，见ShopCat，默认返回：cid,parent_cid,name,is_parent
	 **/
	private $fields;
	
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

	public function getApiMethodName()
	{
		return "taobao.shopcats.list.get";
	}
	
	public function getApiParas()
	{
		return $this->apiParas;
	}
	
	public function check()
	{
		
	}
}
$request = new ShopcatsListGetRequest;
$request->setFields('cid,parent_cid,name,is_parent');
$tc = new TopClient();
$result = json_decode(json_encode($tc->execute($request)), true);

var_export($result);
echo "\n";

