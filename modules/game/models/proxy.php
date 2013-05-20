<?php
defined('SYSPATH') or die('Access non autoris&eacute;.');

class Proxy_Model
{
	public function __construct()
	{
		$this->config = array();
		$this->lastLog = '';
		
		self::setConfig('LOG_FILE',APPPATH.'log/proxy_detector.log');

		$this->scan_headers = array(
			'HTTP_VIA',
			'HTTP_X_FORWARDED_FOR',
			'HTTP_FORWARDED_FOR',
			'HTTP_X_FORWARDED',
			'HTTP_FORWARDED',
			'HTTP_CLIENT_IP',
			'HTTP_FORWARDED_FOR_IP',
			'VIA',
			'X_FORWARDED_FOR',
			'FORWARDED_FOR',
			'X_FORWARDED',
			'FORWARDED',
			'CLIENT_IP',
			'FORWARDED_FOR_IP',
			'HTTP_PROXY_CONNECTION'
		);
	}

	public function setHeader( $trigger )
	{
		$this->scan_headers[] = $trigger;
	}

	public function getHeaders()
	{
    return $this->scan_headers;
	}

	public function setConfig($key, $value)
	{
		$this->config[$key] = $value;
	}

	public function getConfig( $key = false )
	{
		if($key)
			return $this->config[$key];
    
		return $this->config;
	}

	public function getLog()
	{
		return $this->lastLog;
	}

	public function detect()
	{
		$log = false;

		foreach( $this->scan_headers as $i )
			if(isset($_SERVER[$i]) && $_SERVER[$i])
				$log.= $i.' : '.$_SERVER[$i].'<br />';
		
		if($log)
			return gethostbyaddr($_SERVER['REMOTE_ADDR']);
			
		return false;
	}
}

?>