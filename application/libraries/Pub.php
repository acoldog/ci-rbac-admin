<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * 公共方法
 */
class Pub {
	/**
	 * 	作用：产生随机字符串，不长于32位
	 */
	static function createRandom($length = 32, $type='num') {
		if ($type == 'num') {
			$chars = "0123456789";
		} else {
			$chars = "abcdefghijklmnopqrstuvwxyz0123456789";
		}
		$str = "";
		for ($i = 0; $i < $length; $i++) {
			$str .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
		}
		return $str;
	}

	/**
	 * [strCut 字符串截断]
	 * @param  [type] $string  [description]
	 * @param  [type] $length  [description]
	 * @param  string $dot     [description]
	 * @param  string $charset [description]
	 * @return [type]          [description]
	 */
	static function strCut($string, $length, $dot = '...',$charset = 'utf8')
	{
	    if (strlen($string) <= $length) {
	        return $string;
	    }
	    $strcut = '';
	    if (strtolower($charset) == 'utf8') {
	        $n = $tn = $noc = 0;
	        while ($n < strlen($string)) {
	            $t = ord($string[$n]);
	            if ($t == 9 || $t == 10 || (32 <= $t && $t <= 126)) {
	                $tn = 1;
	                $n++;
	                $noc++;
	            }
	            elseif (194 <= $t && $t <= 223) {
	                $tn = 2;
	                $n += 2;
	                $noc += 2;
	            }
	            elseif (224 <= $t && $t < 239) {
	                $tn = 3;
	                $n += 3;
	                $noc += 2;
	            }
	            elseif (240 <= $t && $t <= 247) {
	                $tn = 4;
	                $n += 4;
	                $noc += 2;
	            }
	            elseif (248 <= $t && $t <= 251) {
	                $tn = 5;
	                $n += 5;
	                $noc += 2;
	            }
	            elseif ($t == 252 || $t == 253) {
	                $tn = 6;
	                $n += 6;
	                $noc += 2;
	            } else {
	                $n++;
	            }
	            if ($noc >= $length) {
	                break;
	            }
	        }
	        if ($noc > $length) {
	            $n -= $tn;
	        }
	        $strcut = substr($string, 0, $n);
	    } else {
	        for ($i = 0; $i < $length -strlen($dot) - 1; $i++) {
	            $strcut .= ord($string[$i]) > 127 ? $string[$i] . $string[++ $i] : $string[$i];
	        }
	    }
	    return $strcut . $dot;
	}


	/**
	 * [checkIdCard 验证身份证是否有效]
	 * @param  [type] $idcard [description]
	 * @return [type]         [description]
	 */
	static function checkIdCard($idcard){
	    // 只能是18位
	    if(strlen($idcard)!=18){
	        return false;
	    }
	
	    // 取出本体码
	    $idcard_base = substr($idcard, 0, 17);
	
	    // 取出校验码
	    $verify_code = substr($idcard, 17, 1);
	
	    // 加权因子
	    $factor = array(7, 9, 10, 5, 8, 4, 2, 1, 6, 3, 7, 9, 10, 5, 8, 4, 2);
	
	    // 校验码对应值
	    $verify_code_list = array('1', '0', 'X', '9', '8', '7', '6', '5', '4', '3', '2');
	
	    // 根据前17位计算校验码
	    $total = 0;
	    for($i=0; $i<17; $i++){
	        $total += substr($idcard_base, $i, 1)*$factor[$i];
	    }
	
	    // 取模
	    $mod = $total % 11;
	
	    // 比较校验码
	    if($verify_code == $verify_code_list[$mod]){
	        return true;
	    }else{
	        return false;
	    }
	
	}

	/**
	 * 验证手机
	 *
	 * @param string $value
	 * @param string $match
	 * @return boolean
	 */
	static function isMobile($value, $match = '/^1[34578][0-9]\d{8}$/') {
		$v = trim ( $value );
		if (empty ( $v ))
			return false;
		return preg_match ( $match, $v );
	}


	/**
	 * [oss_personal_url 取私有object的访问地址]
	 * @param  [type]  $uri      [description]
	 * @param  integer $timeout [超时时间]
	 * @return [type]           [description]
	 */
	static function oss_personal_url($uri, $timeout = 300) {

	}
	/**
	 * [oss_url description]
	 * @param  [type] $uri [description]
	 * @return [type]     [description]
	 */
	static function oss_url($uri, $bucket = 0) {
		$CI = get_instance();
		if (!$bucket) {	//默认是上传域那个bucket
			$oss = $CI->config->item('oss_config');
			$bucket = $oss['upload_bucket'];
		}
		return 'http://' . $bucket . '.oss-cn-hangzhou.aliyuncs.com/' . $uri;
	}


}	//end class