<?php
namespace Vendor\Core;
use Vendor\Core\Config;
use Vendor\Core\Log;
class MyHandler{
	/**
	 * 自定义错误处理器
	 * */
	private static  $errAry = array(
		1 	=> 'E_ERROR',
		2 	=> 'E_WARNING',
		4 	=> 'E_PARSE',								//编译时语法解析错误
		8 	=> 'E_NOTICE',
		256 => 'E_USER_ERROR',
		512 => 'E_USER_WARNING',
		1024=> 'E_USER_NOTICE ',
	);
	private function __construct(){
	}
	final private function __clone(){	
	}
	/**
	 * 初始化
	 * */
	public static function init($logdir = ''){
		ini_set('display_errors', 'Off');				//错误不显示到屏幕
		set_error_handler(array(__CLASS__,'ErrHandler'));					//设置一个用户定义的错误处理函数 
		set_exception_handler(array(__CLASS__,'ExcHandler'));				//设置一个用户定义的异常处理函数。 
		register_shutdown_function(array(__CLASS__,'ShutdownHandler'));		//定义PHP程序执行完成后执行的函数
	}
	/**
	 * 错误处理
	 * */
	public static function ErrHandler($errno, $message, $file, $line){
		$info = array(
			'message'  =>  $message,
			'file'	   =>  $file,
			'line'	   =>  $line
		);
		return self::deal($errno, $info);
	}
	/**
	 * 异常处理
	 * */
	public static function ExcHandler($exception){
		$date = date('Y-m-d H:i:s',time());
		$info = array(
				'message'  =>  $exception->getMessage(),
				'file'	   =>  $exception->getFile(),
				'line'	   =>  $exception->getLine(),
				'trace'    =>  $trace
		);
		return self::deal('Exception', $info);
	}
	/**
	 * 程序终止或完成调用，检查错误
	 * */
	public static function ShutdownHandler(){
		//获取最后发生的错误 
		$error = error_get_last();
		if (!empty($error['type'])) {
			$info = array(
					'message'  =>  $error['message'],
					'file'	   =>  $error['file'],
					'line'	   =>  $error['line']
			);
			return self::deal($error['type'], $info);
		}
	}	
	/**
	 * 输出错误
	 * */
	private static function deal($errno, $info){
		//不报NOTICE
		if(in_array($errno, array(8)))
			return false;
		$date = date('Y-m-d H:i:s',time());
		$type = self::$errAry[$errno] ? self::$errAry[$errno] : $errno;		//异常不用转码
		$errorMsg = <<<EOF
\r\n
{$type}-->\r\n
file：{$info['file']},\r\n
line：{$info['line']},\r\n
message：{$info['message']},\r\n
date：{$date}\r\n
EOF;
		$Msg = <<<EOF

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <meta name="robots" content="noindex,nofollow" />
        <style>            html{color:#000;background:#FFF;}body,div,dl,dt,dd,ul,ol,li,h1,h2,h3,h4,h5,h6,pre,code,form,fieldset,legend,input,textarea,p,blockquote,th,td{margin:0;padding:0;}table{border-collapse:collapse;border-spacing:0;}fieldset,img{border:0;}address,caption,cite,code,dfn,em,strong,th,var{font-style:normal;font-weight:normal;}li{list-style:none;}caption,th{text-align:left;}h1,h2,h3,h4,h5,h6{font-size:100%;font-weight:normal;}q:before,q:after{content:'';}abbr,acronym{border:0;font-variant:normal;}sup{vertical-align:text-top;}sub{vertical-align:text-bottom;}input,textarea,select{font-family:inherit;font-size:inherit;font-weight:inherit;}input,textarea,select{*font-size:100%;}legend{color:#000;}

            html { background: #eee; padding: 10px }
            img { border: 0; }
            #sf-resetcontent { width:970px; margin:0 auto; }
                        .sf-reset { font: 11px Verdana, Arial, sans-serif; color: #333 }
            .sf-reset .clear { clear:both; height:0; font-size:0; line-height:0; }
            .sf-reset .clear_fix:after { display:block; height:0; clear:both; visibility:hidden; }
            .sf-reset .clear_fix { display:inline-block; }
            .sf-reset * html .clear_fix { height:1%; }
            .sf-reset .clear_fix { display:block; }
            .sf-reset, .sf-reset .block { margin: auto }
            .sf-reset abbr { border-bottom: 1px dotted #000; cursor: help; }
            .sf-reset p { font-size:14px; line-height:20px; color:#868686; padding-bottom:20px }
            .sf-reset strong { font-weight:bold; }
            .sf-reset a { color:#6c6159; cursor: default; }
            .sf-reset a img { border:none; }
            .sf-reset a:hover { text-decoration:underline; }
            .sf-reset em { font-style:italic; }
            .sf-reset h1, .sf-reset h2 { font: 20px Georgia, "Times New Roman", Times, serif }
            .sf-reset .exception_counter { background-color: #fff; color: #333; padding: 6px; float: left; margin-right: 10px; float: left; display: block; }
            .sf-reset .exception_title { margin-left: 3em; margin-bottom: 0.7em; display: block; }
            .sf-reset .exception_message { margin-left: 3em; display: block; }
            .sf-reset .traces li { font-size:12px; padding: 2px 4px; list-style-type:decimal; margin-left:20px; }
            .sf-reset .block { background-color:#FFFFFF; padding:10px 28px; margin-bottom:20px;
                -webkit-border-bottom-right-radius: 16px;
                -webkit-border-bottom-left-radius: 16px;
                -moz-border-radius-bottomright: 16px;
                -moz-border-radius-bottomleft: 16px;
                border-bottom-right-radius: 16px;
                border-bottom-left-radius: 16px;
                border-bottom:1px solid #ccc;
                border-right:1px solid #ccc;
                border-left:1px solid #ccc;
            }
            .sf-reset .block_exception { background-color:#ddd; color: #333; padding:20px;
                -webkit-border-top-left-radius: 16px;
                -webkit-border-top-right-radius: 16px;
                -moz-border-radius-topleft: 16px;
                -moz-border-radius-topright: 16px;
                border-top-left-radius: 16px;
                border-top-right-radius: 16px;
                border-top:1px solid #ccc;
                border-right:1px solid #ccc;
                border-left:1px solid #ccc;
                overflow: hidden;
                word-wrap: break-word;
            }
            .sf-reset a { background:none; color:#868686; text-decoration:none; }
            .sf-reset a:hover { background:none; color:#313131; text-decoration:underline; }
            .sf-reset ol { padding: 10px 0; }
            .sf-reset h1 { background-color:#FFFFFF; padding: 15px 28px; margin-bottom: 20px;
                -webkit-border-radius: 10px;
                -moz-border-radius: 10px;
                border-radius: 10px;
                border: 1px solid #ccc;
            }
        </style>
    </head>
    <body>
                    <div id="sf-resetcontent" class="sf-reset">
                <h1>{$type}</h1>
                                        <h2 class="block_exception clear_fix">
                            <span class="exception_counter">1/1</span>
                            <span class="exception_title">{$info['file']} line {$info['line']}</a>:</span>
                            <span class="exception_message">{$info['message']}</span>                        
EOF;
		if(in_array($errno, array(1, 4, 256, 'Exception'))){
			ob_start();
			debug_print_backtrace();		
			$trace = ob_get_clean();
			$errorMsg .= <<<EOF
trace：{$trace}\r\n
EOF;
			$Msg .= <<<EOF
<span class="exception_message">trace：{$trace}</span>
EOF;
		}	
		$Msg .= <<<EOF
</h2>
<div class="block">
<ol class="traces list_exception">
	<li> in {$info['file']} line {$info['line']} </li>
</ol>
</div>
</div>
</body>
</html>
EOF;
		$log_dir = dirname(Config::get('ERROR_LOG'));
		if (!is_dir($log_dir)) {
			mkdir($log_dir, 0755, true);
		}
		$filename = Config::get('ERROR_LOG').date('Y-m-d',time()).'.log';
		error_log ($errorMsg, 3, $filename);
		//是否显示错误到屏幕
		if(Config::get('ERROR_SHOW')){
			in_array($errno, array(1, 4, 256)) ? die($Msg) : '';
			echo $Msg;
		}else{
			in_array($errno, array(1, 4, 256)) ? die() : '';
		}		
	}
}











