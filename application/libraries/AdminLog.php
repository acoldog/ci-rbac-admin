<?php defined('BASEPATH') OR exit('No direct script access allowed');

class AdminLog {

	static protected $CI = null;

	static protected function getCIInstance()
	{
		if( !self::$CI ) self::$CI = get_instance();
	}

	/**
	 * [record 记录]
	 * @param  string $type [操作类型：add，update，delete]
	 * @param  [type] $ops  [description]
	 * @return [type]       [description]
	 */
	static function record($type = 'add', $ops) {
		self::getCIInstance();

		$uri = uri_string();
		$uri_array = explode('/', $uri);
		$memo = self::$CI->db->select('memo')->get_where('rbac_node', array(
			'dirc'=>$uri_array[0], 
			'cont'=>$uri_array[1], 
			'func'=>$uri_array[2]
		))->row_array();
		if(count($memo) > 0) {
			$uri = '【'. $memo['memo'] .'】'. $uri;
		}

		$in = array(
			'admin_user_id'			=>intval($_SESSION['MyAuth']['INFO']['id']),
			'admin_nickname'		=>$_SESSION['MyAuth']['INFO']['nickname'],
			'type'					=>$type,
			'uri'					=>$uri,
			'create_time'			=>date('Y-m-d H:i:s')
		);
		if(isset($ops['db_name'])) {
			$in['db_name'] = $ops['db_name'];
		}
		if(isset($ops['data_ids'])) {
			$in['data_ids'] = $ops['data_ids'];
		}
		if(isset($ops['data_num'])) {
			$in['data_num'] = $ops['data_num'];
		}
		if(isset($ops['intro'])) {
			$in['intro'] = $ops['intro'];
		}

		return self::$CI->db->insert('rbac_log', $in);
	}


}