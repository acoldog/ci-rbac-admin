<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Test1 extends CI_Controller {

	public function index() {
		// 取消重写VIEW
		$this->view_override = FALSE;
		echo '啊哈哈哈哈哈';
	}

}
