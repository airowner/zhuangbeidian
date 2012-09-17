<?php
require "../RequestCheckUtil.php";
require "../TopClient.php";
/**
 * TOP API: taobao.item.sku.get request
 * 
 * @author auto create
 * @since 1.0, 2012-08-07 16:31:26
 */
class ItemSkuGetRequest
{
	/** 
	 * 需返回的字段列表。可选值：Sku结构体中的所有字段；字段之间用“,”分隔。
	 **/
	private $fields;
	
	/** 
	 * 卖家nick(num_iid和nick必传一个)
	 **/
	private $nick;
	
	/** 
	 * 商品的数字IID（num_iid和nick必传一个，推荐用num_iid）
	 **/
	private $numIid;
	
	/** 
	 * Sku的id。可以通过taobao.item.get得到
	 **/
	private $skuId;
	
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

	public function setNick($nick)
	{
		$this->nick = $nick;
		$this->apiParas["nick"] = $nick;
	}

	public function getNick()
	{
		return $this->nick;
	}

	public function setNumIid($numIid)
	{
		$this->numIid = $numIid;
		$this->apiParas["num_iid"] = $numIid;
	}

	public function getNumIid()
	{
		return $this->numIid;
	}

	public function setSkuId($skuId)
	{
		$this->skuId = $skuId;
		$this->apiParas["sku_id"] = $skuId;
	}

	public function getSkuId()
	{
		return $this->skuId;
	}

	public function getApiMethodName()
	{
		return "taobao.item.sku.get";
	}
	
	public function getApiParas()
	{
		return $this->apiParas;
	}
	
	public function check()
	{
		
		RequestCheckUtil::checkNotNull($this->fields,"fields");
		RequestCheckUtil::checkMinValue($this->numIid,0,"numIid");
		RequestCheckUtil::checkNotNull($this->skuId,"skuId");
	}
}
$request = new ItemSkuGetRequest;
$request->setFields('sku_id,num_iid,properties,quantity,price,outer_id,created,modified,status');
$request->setSkuId(28523928872);

$request->setNumIid(15365490074);
//$request->setNick('');

$tc = new TopClient();
var_export(json_decode(json_encode($tc->execute($request)), true));


/*
    {
        "item_sku_get_response":{
            "sku":{
                "created":"2012-07-17 13:18:01",
                "modified":"2012-07-18 01:41:21",
                "num_iid":15365490074,
                "price":"89.00",
                "properties":"1627207:28341;20509:28317",
                "quantity":99,
                "sku_id":28523928872,
                "status":"normal"
                }
            }
        }

 */
