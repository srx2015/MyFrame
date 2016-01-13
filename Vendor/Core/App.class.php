<?php
namespace Vendor\Core;
use Vendor\Core\Config;
use Vendor\Core\Route;
use Vendor\Core\MyHandler;
/*
 * 框架核心文件
 */
class App{
	public static  function run(){
		header('Content-type:text/html;charset=utf-8');
		error_reporting(0);
		self::setConst();	
		if(Config::get('ERROR_RANK') == -1)MyHandler::init();
		self::setDefault();
		self::includeFiles();		
		Route::init();	
	}
	private static function setDefault(){
		date_default_timezone_set(Config::get('timezone'));		//时区		
		if(Config::get('session_status')){
			session_start();
		}
	}
	private static function setConst(){
		define('FRAME_PATH', dirname(__DIR__));
        define('APP_PATH', dirname(FRAME_PATH) . DIRECTORY_SEPARATOR . 'App');
        define('IS_GET',        $_SERVER['REQUEST_METHOD'] =='GET' ? true : false);
        define('IS_POST',       $_SERVER['REQUEST_METHOD'] =='POST' ? true : false);
	}
	private static function includeFiles(){
		include APP_PATH   . '/Common/functions.php';
		include FRAME_PATH . '/Common/functions.php';
	}
}
