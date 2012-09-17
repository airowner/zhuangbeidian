<?php
require "../RequestCheckUtil.php";
require "../TopClient.php";
/**
 * TOP API: taobao.widget.loginstatus.get request
 * 
 * @author auto create
 * @since 1.0, 2012-08-07 16:31:26
 */
class WidgetLoginstatusGetRequest
{
	/** 
	 * 指定判断当前浏览器登陆用户是否此昵称用户，并且返回是否登陆。如果用户不一致返回未登陆，如果用户一致且已登录返回已登陆
	 **/
	private $nick;
	
	private $apiParas = array();
	
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
		return "taobao.widget.loginstatus.get";
	}
	
	public function getApiParas()
	{
		return $this->apiParas;
	}
	
	public function check()
	{
		
	}
}
$request = new WidgetLoginstatusGetRequest;
$request->setNick('sandbox_b_20')
$tc = new TopClient();
var_export(json_decode(json_encode($tc->execute($request)), true));
