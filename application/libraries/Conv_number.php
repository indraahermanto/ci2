<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Conv_number{
	function __construct(){
		$this->_ci = & get_instance();
	}

	function getCharNumber($number='1', $digit='4', $prefix=''){
		$charNumber 			= $this->_ci->db->query("SELECT char_number('".$number
											 ."', ".$digit.", '".$prefix."') product")->row()->product;
		return $charNumber;
	}
}
