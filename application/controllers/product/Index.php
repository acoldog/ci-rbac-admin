<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Index extends CI_Controller {
	
	function __construct(){
		parent::__construct();
	}

	public function index() {
		//取消重写VIEW
		//$this->view_override = FALSE;
		$header = array(
			'header_title'=>'测试系统页面'
		);
		$this->load->view("product/index", $header);
	}

	public function test() {

		$data['list'] = $this->db->get_where('test')->result();
		FormHelper::createPageList($this->db, 'test');

		$this->load->view("product/test", $data);
	}

	public function testAdd($id=0) {
		//图片上传表单项特殊处理
		if(isset($_POST['images']) && $_POST['images'] && is_array($_POST['images'])) {
			$_POST['ico'] = $_POST['images'][0];
		}
		unset($_POST['images']);

		//富文本表单项特殊处理
		if(isset($_POST['editorValue']) && !empty($_POST['editorValue'])) {
			$_POST['descr'] = $_POST['editorValue'];
		}
		unset($_POST['editorValue']);


		//新增和修改
		FormHelper::savePostDataToDB($this->db, 'test', $id, '/product/index/test', array('create_time'=>date('Y-m-d H:i:s')));

		$data = FormHelper::getUpdateData($this->db, 'test', $id);
		$this->load->view("product/test_add", $data);
	}

}


