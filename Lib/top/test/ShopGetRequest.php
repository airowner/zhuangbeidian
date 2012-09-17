<?php
require "../RequestCheckUtil.php";
require "../TopClient.php";
/**
 * TOP API: taobao.shop.get request
 * 
 * @author auto create
 * @since 1.0, 2012-08-07 16:31:26
 */
class ShopGetRequest
{
	/** 
	 * 需返回的字段列表。可选值：Shop 结构中的所有字段；多个字段之间用逗号(,)分隔
	 **/
	private $fields;
	
	/** 
	 * 卖家昵称
	 **/
	private $nick;
	
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

	public function getApiMethodName()
	{
		return "taobao.shop.get";
	}
	
	public function getApiParas()
	{
		return $this->apiParas;
	}
	
	public function check()
	{
		
		RequestCheckUtil::checkNotNull($this->fields,"fields");
		RequestCheckUtil::checkNotNull($this->nick,"nick");
	}
}
$request = new ShopGetRequest;
$request->setFields("sid,cid,title,nick,desc,bulletin,pic_path,created,modified");
$request->setNick("sandbox_b_20");
$tc = new TopClient();
$result = json_decode(json_encode($tc->execute($request)), true);


var_export($result);
echo "\n";
