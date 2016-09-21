<?php
/**
 * @todo:   autoload for ci
 * 	acol
 *
 * 	支持自动加载  libraries , models 和 命名空间的类
 */
defined('BASEPATH') OR exit('No direct script access allowed');

if ( ! function_exists('autoload'))
{
    function autoload($class)
    {
    	//命名空间
    	if( strpos($class, '\\') !== false ){

	        $temp = explode('\\', $class);
	        $class_name = array_pop($temp);
	        $class_file = APPPATH . implode('/', $temp) .'/'. $class_name .'.php';
	    }
	    //models
	    else if( strpos($class, '_model') !== false ){
	    	$CI =& get_instance();
	    	$CI->load->model($class);
	    	return;
		}
		//libreries
		else{
	    	$dir = 'libraries';
	    	
	        $class_file = APPPATH . $dir .'/'. $class .'.php';
	    }

	    if ( !file_exists($class_file) ) {
	        return;
	    } elseif (! is_readable ( $class_file )) {
	        die("unable to read class file ". $class_file);
	    } else {
	        include_once ($class_file);
	    }
    }
    spl_autoload_register('autoload');
}