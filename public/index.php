<?php
/*
 * 入口文件
 */
//自动加载
require_once '../Vendor/autoload.php';

//框架核心文件
require_once '../Vendor/Core/App.class.php';

Vendor\Core\App::run();
