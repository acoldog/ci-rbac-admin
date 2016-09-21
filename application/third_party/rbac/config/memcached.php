<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| Memcached
| -------------------------------------------------------------------------
|
*/
//是否开启
$config['flag'] = FALSE;
//memcached权限验证
$config['config'] = array(
               'servers' => array('127.0.0.1:11211'),
               'debug'   => false
             );

/* End of file memcached.php */
/* Location: ./application/third_party/rbac/config/memcached.php */