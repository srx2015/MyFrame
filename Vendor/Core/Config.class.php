<?php
namespace Vendor\Core;
/*
 * 获取配置
 */
class Config{
	private static $config    = null;
	private static $sysconfig = null;
	private function __construct(){
		self::$config    = include APP_PATH . '/Config/config.php';			//项目配置
		self::$sysconfig = include FRAME_PATH . '/Config/config.php';		//核心配置
	}
	public static function get($variate){
		if(is_null(self::$config) || is_null(self::$sysconfig)){
			new self();
		} 
		if(self::$config[$variate])
			return self::$config[$variate];
		elseif(self::$sysconfig[$variate])
			return self::$sysconfig[$variate];
		else
			return false;
	}
}