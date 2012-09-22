<?php
date_default_timezone_set('Asia/Shanghai');

define('TOP_SDK_WORK_DIR', dirname(dirname(__FILE__)) . '/tmp/top');

class OnlineConf
{
    public $appkey = '21101696';
    public $secretKey = '237ace29d974b9da95d0055f7c50e057';
    public $gatewayUrl = 'http://gw.api.taobao.com/router/rest';
}
class OnlineWidgetConf
{
    public $appkey = '21101696';
    public $secretKey = '237ace29d974b9da95d0055f7c50e057';
    public $gatewayUrl = 'http://gw.api.taobao.com/widget/rest';
}

class SandboxConf
{
    public $appkey = '1021101696';
    public $secretKey = 'sandbox9d974b9da95d0055f7c50e057';
    public $gatewayUrl = 'http://gw.api.tbsandbox.com/router/rest';
}

class SandboxWidgetConf
{
    public $appkey = '1021101696';
    public $secretKey = 'sandbox9d974b9da95d0055f7c50e057';
    public $gatewayUrl = 'http://gw.api.tbsandbox.com/widget/rest';
}

class TopConf
{
    #private static $online = false;
    public static $online = true;
    public static function ins($widget=false)
    {
        $confname = self::$online ? 'Online' : 'Sandbox';
        $confname .= ($widget ? 'Widget' : '') . 'Conf';

        static $conf = array();
        if (!isset($conf[$confname])) {
            $conf[$confname] = new $confname;
        }
        return $conf[$confname];
    }
}

class TopWidgetClient extends TopClient
{
    protected function getConf()
    {
        return TopConf::ins(true);
    }

    protected function generateSign($params)
    {
        CakeLog::info("widget generateSign: {$this->secretKey}app_key{$this->appkey}timestamp" . date('Y-m-d H:i:s') . "{$this->secretKey}");
        return strtoupper(bin2hex(mhash(MHASH_MD5, "{$this->secretKey}app_key{$this->appkey}timestamp" . date('Y-m-d H:i:s') . "{$this->secretKey}")));
    }
}

class TopClient
{
    public $format = "json";
    
    /** 是否打开入参check**/
    public $checkRequest = true;

    protected $signMethod = "md5";

    protected $apiVersion = "2.0";

    protected $sdkVersion = "top-sdk-php-20120807";

    public function __construct()
    {
        $conf = $this->getConf();
        $this->appkey = $conf->appkey;
        $this->secretKey = $conf->secretKey;
        $this->gatewayUrl = $conf->gatewayUrl;
    }

    protected function getConf()
    {
        return TopConf::ins();
    }

    protected function generateSign($params)
    {
        ksort($params);

        $stringToBeSigned = $this->secretKey;
        foreach ($params as $k => $v)
        {
            if("@" != substr($v, 0, 1))
            {
                $stringToBeSigned .= "$k$v";
            }
        }
        unset($k, $v);
        $stringToBeSigned .= $this->secretKey;
        CakeLog::info($stringToBeSigned);

        return strtoupper(md5($stringToBeSigned));
    }

    public function curl($url, $postFields = null)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_FAILONERROR, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        //https 请求
        if(strlen($url) > 5 && strtolower(substr($url,0,5)) == "https" ) {
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        }

        if (is_array($postFields) && 0 < count($postFields))
        {
            $postBodyString = "";
            $postMultipart = false;
            foreach ($postFields as $k => $v)
            {
                if("@" != substr($v, 0, 1))//判断是不是文件上传
                {
                    $postBodyString .= "$k=" . urlencode($v) . "&"; 
                }
                else//文件上传用multipart/form-data，否则用www-form-urlencoded
                {
                    $postMultipart = true;
                }
            }
            unset($k, $v);
            curl_setopt($ch, CURLOPT_POST, true);
            if ($postMultipart)
            {
                curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
            }
            else
            {
                curl_setopt($ch, CURLOPT_POSTFIELDS, substr($postBodyString,0,-1));
            }
        }
        $reponse = curl_exec($ch);
        
        if (curl_errno($ch))
        {
            throw new Exception(curl_error($ch),0);
        }
        else
        {
            $httpStatusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            if (200 !== $httpStatusCode)
            {
                throw new Exception($reponse,$httpStatusCode);
            }
        }
        curl_close($ch);
        return $reponse;
    }

    public function execute($request, $session = null)
    {
        if($this->checkRequest) {
			$request->check();
        }
        //组装系统参数
        $sysParams["app_key"] = $this->appkey;
        $sysParams["v"] = $this->apiVersion;
        $sysParams["format"] = $this->format;
        $sysParams["sign_method"] = $this->signMethod;
        $sysParams["method"] = $request->getApiMethodName();
        $sysParams["timestamp"] = date("Y-m-d H:i:s");
        $sysParams["partner_id"] = $this->sdkVersion;
        if (null != $session)
        {
            $sysParams["session"] = $session;
        }

        //获取业务参数
        $apiParams = $request->getApiParas();

        //~ var_dump($apiParams, $sysParams);exit;
        //签名
        $sysParams["sign"] = $this->generateSign(array_merge($apiParams, $sysParams));

        //系统参数放入GET请求串
        $requestUrl = $this->gatewayUrl . "?";
        foreach ($sysParams as $sysParamKey => $sysParamValue)
        {
            $requestUrl .= "$sysParamKey=" . urlencode($sysParamValue) . "&";
        }
        $requestUrl = substr($requestUrl, 0, -1);

        //发起HTTP请求
		$resp = $this->curl($requestUrl, $apiParams);

        //解析TOP返回结果
		$resp = stripslashes($resp);
        $respObject = json_decode($resp);
		if( null !== $respObject)
		{
			foreach ($respObject as $propKey => $propValue)
            {
                $respObject = $propValue;
            }
			if(isset($respObject->code)){
				$msg = json_encode($respObject);
				throw new Exception($msg);
			}
		}else{
			CakeLog::error(json_encode(array($sysParams["method"],$requestUrl,"HTTP_RESPONSE_NOT_WELL_FORMED",$resp)));
			throw new Exception('HTTP_RESPONSE_NOT_WELL_FORMED');
		}
		return $respObject;
    }

}
