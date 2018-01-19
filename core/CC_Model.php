<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
	ALTOB base model
*/

class CC_Model extends CI_Model
{          
	// 車道
	var $lanes = array
		(
			40701 => array
				(
					0 => array ('name' => '4號門(中) 出',	'p_ip' => '192.168.2.85'),	// 4號門 出, 中間	（傳送離場給博辰）
					1 => array ('name' => '4號門(左) 出',	'p_ip' => '192.168.2.84'),	// 4號門 出, 左		（傳送離場給博辰）
					2 => array ('name' => '4號門(右) 入',	'p_ip' => ''),				// 4號門 入, 右
					3 => array ('name' => '4號門(左) 入',	'p_ip' => ''),				// 4號門 入, 左
					4 => array ('name' => '4號門(右) 出',	'p_ip' => '192.168.2.86'),	// 4號門 出, 右		（傳送離場給博辰）
					5 => array ('name' => '3號門A 出',		'p_ip' => '192.168.2.81'),	// 3號門 出, 單		（傳送離場給博辰）
					6 => array ('name' => '3號門B 出',		'p_ip' => '192.168.2.82'),	// 3號門 出, 單		（傳送離場給博辰）
					7 => array ('name' => '??',				'p_ip' => ''),				// ??
					8 => array ('name' => '1號門(左) 入',	'p_ip' => ''),				// 1號門 入, 左
					9 => array ('name' => '1號門(右) 入',	'p_ip' => ''),				// 1號門 入, 右
					10 => array ('name' => '1號門 入',		'p_ip' => ''),				// 1號門 入, 單
					11 => array ('name' => '5號門 入',		'p_ip' => ''),				// 5號門 入
					12 => array ('name' => '5號門 出',		'p_ip' => '')				// 5號門 出			（傳送離場給博辰）
				),
			40702 => array
				(
					0 => array ('name' => '入0',	'p_ip' => ''),	// 無
					1 => array ('name' => '入1',	'p_ip' => ''),	// 無
					2 => array ('name' => '出2',	'p_ip' => '')	// 無
				)
		);
	
	// 車道進出名稱
	public function gen_io_name($rows)
	{
		if(!isset($this->lanes[$rows['station_no']]))
			return empty($rows['out_time']) ? "入口 {$rows['in_lane']}" : "入口 {$rows['in_lane']} -> 出口 {$rows['out_lane']}";
		
		return empty($rows['out_time']) ? $this->lanes[$rows['station_no']][$rows['in_lane']]['name'] : $this->lanes[$rows['station_no']][$rows['in_lane']]['name'] . " -> " . $this->lanes[$rows['station_no']][$rows['out_lane']]['name'];
	}
	
	// 車道進出圖片
	public function gen_io_image_path($rows)
	{
		$pic_name = empty($rows['out_pic_name']) ? $rows['in_pic_name'] : $rows['out_pic_name'];
		$arr = explode('-', $pic_name);
		return isset($arr[7]) ? SERVER_URL.'carpic/'.substr($arr[7], 0, 8).'/'.$pic_name : '';	// 20180119 改為靜態路徑
	}
	
	// 車道進出時間字串
	public function gen_io_time($rows)
	{
		return empty($rows['out_time']) ? $rows['in_time'] : "{$rows['in_time']}(入)<br>{$rows['out_time']}(出)<br>{$rows['minutes']}分(停留時間)";
	}    
    
	function __construct()
	{
		parent::__construct(); 
		$this->load->database(); 
    }
	
}
