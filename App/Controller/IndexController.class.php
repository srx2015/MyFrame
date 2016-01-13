<?php
namespace App\Controller;
use Vendor\Core\ActiveRecord;
class IndexController{
	public function index(){
		$aa = new ActiveRecord();
		$aa->test();
	}
}