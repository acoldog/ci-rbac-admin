<?php  
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * controller基类
 */

abstract class MY_Controller extends CI_Controller {

	abstract public function index($page);	//列表

	abstract public function add($id);	//修改

	abstract public function delete($id); 	//删除
}