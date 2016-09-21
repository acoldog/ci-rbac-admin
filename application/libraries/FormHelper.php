<?php defined('BASEPATH') OR exit('No direct script access allowed');

class FormHelper {

	static protected $CI = null;

	static protected function getCIInstance()
	{
		if( !self::$CI ) self::$CI = get_instance();
	}
	
	/**
	 * [savePostDataToDB 新增和修改表单封装，表单的name和数据库字段名要一致]
	 * @param  [type]  $db_handle [description]
	 * @param  [type]  $tablename [description]
	 * @param  integer $id        [description]
	 * @param  [type]  $jump_url  [description]
	 * @param  array   $extra_set [description]
	 * @return [type]             [description]
	 */
	static public function savePostDataToDB($db_handle, $tablename, $id = 0, $jump_url, array $extra_set = array()) {
		self::getCIInstance();
		if(self::$CI->input->post()) {
			foreach (self::$CI->input->post() as $key => $value) {
				$in[$key] = $value;
			}
			//其它自定义修改
			if(count($extra_set) > 0){
				foreach ($extra_set as $key2 => $value2) {
					$in[$key2] = $value2;
				}
			}

			if(!empty($id)) {
				unset($in['create_time']);
				$res = $db_handle->update($tablename, $in, array('id'=>$id));
				if($res) {
					//记录管理员操作日志
					AdminLog::record('update', array(
						'db_name'		=>$tablename,
						'data_ids'		=>$id,
						'intro'			=>'修改数据'
					));

					success_redirct($jump_url, "数据修改成功！", 1);
				}else{
					error_redirct("","数据修改失败，请重试！");
				}
			}else{
				$res = $db_handle->insert($tablename, $in);
				if($res) {
					//记录管理员操作日志
					AdminLog::record('add', array(
						'db_name'		=>$tablename,
						'data_ids'		=>$res,
						'intro'			=>'新增数据'
					));

					success_redirct($jump_url, "数据添加成功！", 1);
				}else{
					error_redirct("","数据添加失败，请重试！");
				}
			}
		}
	}

	/**
	 * [getUpdateData 取单条数据（修改单条数据页）]
	 * @param  [type] $db_handle [description]
	 * @param  [type] $tablename [description]
	 * @param  [type] $id        [description]
	 * @return [type]            [description]
	 */
	static public function getUpdateData($db_handle, $tablename, $id) {
		$data = array();
		if( !empty($id) ) {
			$data = $db_handle->get_where($tablename, array('id'=>$id))->row_array();
		}
		return $data;
	}

	/**
	 * [deleteData 删除单条数据]
	 * @param  [type]  $db_handle [description]
	 * @param  [type]  $tablename [description]
	 * @param  [type]  $id        [description]
	 * @param  boolean $is_delete [description]
	 * @return [type]             [description]
	 */
	static public function deleteData($db_handle, $tablename, $id, $jump_url) {
		if(!empty($id)) {
			$res = $db_handle->delete($tablename, array('id'=>$id));
			if ($res) {
				//记录管理员操作日志
				AdminLog::record('delete', array(
					'db_name'		=>$tablename,
					'data_ids'		=>$id,
					'intro'			=>'删除数据'
				));

				success_redirct($jump_url, "数据删除成功！", 1);
			}
		}
		error_redirct("","数据删除失败，请重试！");
	}

	/**
	 * [createPageList 生成分页]
	 * @param  [type]  $tablename [description]
	 * @param  array   $condition [description]
	 * @param  string  $base_url  [description]
	 * @param  integer $per_page  [description]
	 * @return [type]             [description]
	 */
	static public function createPageList($db_handle, $tablename, $condition = array(), $base_url = '', $per_page = 30, $uri_segment = 4) {
		self::getCIInstance();

		$cnt_data = $db_handle->where($condition)->count_all_results($tablename);

		//分页
		self::$CI->load->library('pagination');
		$config['base_url'] = site_url($base_url);
		$config['total_rows'] = $cnt_data;
		$config['per_page']   = $per_page;
		$config['uri_segment']= $uri_segment;
		$config['use_page_numbers'] = TRUE;
		self::$CI->pagination->initialize($config);
		return self::$CI->pagination;
	}

}	//class end