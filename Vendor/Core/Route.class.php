<?php
namespace Vendor\Core;
use Vendor\Core\Config;
/*
 * 路由
 */
class Route{
	public static function init(){		
		if(Config::get('URL_MODEL') == 1){		
			//PATHINFO模式
			$ary_se   = explode('/',  ltrim($_SERVER['REQUEST_URI'], '/index.php/'));
			$se_count = count($ary_se);
			if($se_count <= 1){			
				//获取默认控制器跟操作
				$controller = Config::get('DEFAULT_CONTROLLER');
				$action     = Config::get('DEFAULT_ACTION');
			}else{
				$controller = $ary_se[0];
				$action     = $ary_se[1];
			}			
		}else{
			//普通模式
			$controller = $_GET[Config::get('VAR_CONTROLLER')];
			$action     = $_GET[Config::get('VAR_ACTION')];
		}
		$controller = 'App\\Controller\\'.ucfirst($controller).'Controller';
		$obj = new $controller;
		$obj->$action();
	}
}
