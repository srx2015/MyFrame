<?php
return array(
		'timezone'				=> 	'PRC',			//时区
		'session_status'		=> 	false,			//是否开启session
		
		'URL_MODEL'				=>	1,				//URL模式,0:普通模式,1:PATHINFO模式
		
		'DEFAULT_CONTROLLER'    =>  'Index', 		// 默认控制器名称
		'DEFAULT_ACTION'        =>  'index', 		// 默认操作名称
		'VAR_CONTROLLER'        =>  'c',    		// 默认控制器获取变量
		'VAR_ACTION'            =>  'a',    		// 默认操作获取变量
		
		'ERROR_RANK'			=>	-1,				//错误处理级别,0:关闭所有错误报告,-1:报告所有错误	
		'ERROR_SHOW'			=>	true,			//错误异常是否显示到屏幕
		
		'LOGTOFILE'				=>	false,			//日志是否输出到文件
		'ERROR_LOG'				=>	APP_PATH.'/data/log/',	//日志输出地址
		
		/* 数据库设置 */
		'DB_TYPE'               =>  'mysql',     	// 数据库类型
		'DB_HOST'               =>  'localhost', 	// 服务器地址
		'DB_PORT'               =>  '3306',      	// 端口
);