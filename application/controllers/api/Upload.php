<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

use OSS\OssClient;
use OSS\Core\OssException;

class Upload extends CI_Controller {
	const SERVER_HOST = 'http://admin2.hxsapp.com/';

	public function __construct() {
		parent::__construct();
		// 取消重写VIEW
		$this->view_override = FALSE;
	}

	/**
	 * [local 存本地]
	 * @return [type] [description]
	 */
	public function local() {
		if($this->input->get('action') == 'config') {
			echo json_encode(array(
				'imageActionName'		=>'local',	/* 执行上传图片的action名称 */
				'imageFieldName'		=>'photo_upload',	/* 提交的图片表单名称 */  
				'imageMaxSize'			=>307200,	/* 上传大小限制，单位B */
				'imageAllowFiles'		=>array('.png','.jpg','.jpeg','.gif','.bmp'),
				'imageCompressEnable'	=>true,	/* 是否压缩图片,默认是true*/ 
				'imageCompressBorder'	=>1200,	/* 图片压缩最长边限制 */ 
				'imageUrlPrefix'		=>""	/* 图片访问路径前缀 */
			));
			exit;
		}


		$whitelist = array('jpg', 'jpeg', 'png', 'gif');
		$name      = null;
		$error     = 'No file uploaded.';
		$path 	   = '';
		$size 	   = 0;
		$extension = '';

		if (isset($_FILES)) {
			if (isset($_FILES['photo_upload'])) {
				$tmp_name 	= $_FILES['photo_upload']['tmp_name'];
				$path 		= FCPATH .'upload/';
				$name     	= basename($_FILES['photo_upload']['name']);
				$error    	= $_FILES['photo_upload']['error'];
				$size 		= $_FILES['photo_upload']['size'];
				
				if ($error === UPLOAD_ERR_OK) {
					$extension = pathinfo($name, PATHINFO_EXTENSION);

					if (!in_array($extension, $whitelist)) {
						$error = 'Invalid file type uploaded.';
					} else {
						move_uploaded_file($tmp_name, $path . $name);
					}
				}
			}
		}

		$back = array(
			"originalName" => $name, 
			"name" => $name, 
			"url" => self::SERVER_HOST . 'upload/' . $name, 
			"size" => $size, 
			"type" => $extension, 
			"state" => 'SUCCESS'
		);

		echo json_encode($back);
	}


	/**
	 * [resizeImage 图片等比压缩]
	 * @param  [type] $image_path [description]
	 * @param  [type] $max_width  [最大图宽，超过这个宽度才压]
	 * @return [type]             [description]
	 */
	private function resizeImage($image_path, $max_width = 640, $rotate = TRUE)
	{
		if( !file_exists($image_path) ) return false;

		list($srcWidth, $srcHeight) = getimagesize($image_path);

		if( $srcWidth > $max_width ){
			$ratio = $max_width / $srcWidth;

			$config['image_library'] = 'gd2';
			$config['source_image'] = $image_path;
			$config['maintain_ratio'] = TRUE;
			$config['width']    = ceil ( $srcWidth * $ratio );
			$config['height']   = ceil ( $srcHeight * $ratio );
			
			if( $rotate ){
				// $config['rotation_angle'] = '270';
			}

			$this->load->library('image_lib');
			$this->image_lib->initialize($config);
			$res = $this->image_lib->resize();
			// $this->image_lib->rotate();
			$this -> image_lib -> clear();
			return $res;
		}

		return false;
	}

}