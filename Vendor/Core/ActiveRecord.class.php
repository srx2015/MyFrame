<?php
namespace Vendor\Core;
use Vendor\Core\Config;
/*
 * 活动记录
 */
class ActiveRecord{
	private $tablepre;
	private $table;
	private static $link;
	private $data;
	public function __construct(){
		$this->tablepre = Config::get('DB_PREFIX');
		$this->table    = Config::get('DB_PREFIX');
		$this->data     = array();
		$this->connect();
	}
	private function connect() {
		if(!self::$link) {
			try{
				$dsn = "mysql:local=".Config::get('DB_HOST').";dbname=".Config::get('DB_NAME');
				self::$link = new \PDO($dsn, Config::get('DB_USER'), Config::get('DB_PWD'));
				self::$link->exec('SET NAMES UTF8');
			}catch (MyHandler $e){
				//抛出异常
			}
		}
		return self::$link;
	}
	public function __set($name, $value){
		$this->data[$name] = $value;
	}
	public function test(){
		echo 123;
	}
}