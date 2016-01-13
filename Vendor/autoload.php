<?php
/*
 * 自动加载
 */
spl_autoload_register(function($class){
	if($class){
		$file = str_replace('\\', '/', $class);
		$file = '../' . $file . '.class.php';
		if(file_exists($file)){
			include "$file";
		}
	}
});
