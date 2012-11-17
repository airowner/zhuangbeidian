<?php
class CurlComponent extends Component
{
	public $ch = null;
	public $timeout = 300;

	public function get($url,$timeout=0)
	{
		$this->base();
		curl_setopt($this->ch,CURLOPT_CUSTOMREQUEST,"GET");
		$r = $this->callRemote('get',$url,$timeout);
		return $r; 
	}

	public function put($url,$data,$timeout=0)
	{
		$this->base();
		curl_setopt($this->ch,CURLOPT_CUSTOMREQUEST,"PUT");
		curl_setopt($this->ch,CURLOPT_HTTPHEADER,array('Content-Length: '.strlen($data)));
		curl_setopt($this->ch,CURLOPT_POSTFIELDS,$data);
		CakeLog::debug("[put] $data");
		return $this->callRemote('put',$url,$timeout);
	}

	public function post($url,$data,$timeout=0)
	{
		$this->base();
		curl_setopt($this->ch,CURLOPT_CUSTOMREQUEST,"POST");
		curl_setopt($this->ch,CURLOPT_HTTPHEADER,array('Content-Length: '.strlen($data)));
		curl_setopt($this->ch,CURLOPT_POSTFIELDS,$data);
		CakeLog::debug("[post] $data");
		return $this->callRemote('post',$url,$timeout);
	}

	public function delete($url,$data='',$timeout=0)
	{
		$this->base();
		curl_setopt($this->ch,CURLOPT_CUSTOMREQUEST,"DELETE");
		if($data){
			curl_setopt($this->ch,CURLOPT_HTTPHEADER,array('Content-Length: '.strlen($data)));
			curl_setopt($this->ch,CURLOPT_POSTFIELDS,$data);
		}
		return $this->callRemote('delete',$url,$timeout);
	}

	public function header($url, $timeout=0)
	{
		$this->base();
		curl_setopt($this->ch, CURLOPT_HEADER, TRUE);
		curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, FALSE);
		return $this->callRemote('delete',$url,$timeout);
	}

	private function base()
	{
		$this->ch = curl_init();
		curl_setopt($this->ch, CURLOPT_AUTOREFERER, TRUE);
		curl_setopt($this->ch, CURLOPT_FOLLOWLOCATION, TRUE);
		curl_setopt($this->ch, CURLOPT_MAXREDIRS, 5);
		curl_setopt($this->ch, CURLOPT_FRESH_CONNECT, TRUE);
		curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, TRUE);
	}

	private function callRemote($method,$url,$timeout=0)
	{
		$stime=microtime(true);
		$timeout = $timeout > 0 ? $timeout : $this->timeout;
		curl_setopt($this->ch, CURLOPT_CONNECTTIMEOUT, $timeout);
		curl_setopt($this->ch, CURLOPT_TIMEOUT, $timeout);
		curl_setopt($this->ch, CURLOPT_URL, $url);
		$r          = curl_exec($this->ch);
		$errono     = curl_errno($this->ch);
		if ($errono !=0 )
		{
			if(TIMEOUT_ERROR == $errono)
			{
				$errMsg = curl_error($this->ch);
				CakeLog::error("$url timeout: ".$errMsg);
			}
			else
			{
				$errMsg = curl_error($this->ch);
				CakeLog::error("$url curlerr: ".$errMsg);
			}
			CakeLog::error("[slow] errmsg: $errMsg, timeout: $timeout(s), method: $method, url: $url ");

			return false;
		}

		$http_code = curl_getinfo($this->ch,CURLINFO_HTTP_CODE);
		$etime=microtime(true);
		$usetime=sprintf("%.3f", $etime-$stime);
		CakeLog::debug("[response] code: $http_code, method: $method, timeout: $timeout, usetime: $usetime, url:$url");
		if($usetime > 1 )
		{
			CakeLog::error("[slow] usetime: $usetime(s), code: $http_code, timeout: $timeout(s), method: $method, url: $url ");
		}
		if ($http_code == 200 || $http_code == 201)
		{
			CakeLog::debug("[response] $r");
			return $r;
		}
		CakeLog::error("$url [response] $r");
		return false;
	}
}
