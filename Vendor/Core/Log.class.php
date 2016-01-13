<?php
namespace Vendor\Core;
use Vendor\Core\Config;
/*
 * 日志
 */
class Log{
	public static function write($msg, $logdir=''){		
		$logdir = $logdir ? $logdir : Config::get('ERROR_LOG');		//register_shutdown_function是从内存中执行，输入日志的地址必须为绝对路径
		$log_dir = dirname($logdir);
		if (!is_dir($log_dir)) {
			mkdir($log_dir, 0755, true);
		}
		error_log ($msg, 3, $logdir.date('Y-m-d',time()).'.log');
	}
}