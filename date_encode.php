<?php
function nowTimeInMySql(){
	$now = date('Y-m-d H:i:s');
	return $now;
	
}
function nowDateInMySql(){
	$now = date('Y-m-d');
	return $now;
	
}
function GetYesterday(){
	$yesterday = date('Y-m-d', strtotime('-1 day'));
	return $yesterday;
	
}
#phpからmySqlへのdateの変換
function dateEncode(){
	
	
}
function getDayoftheWeek($dates){
	$weeken = array(
	
	'SUN',
	'MON',
	'TUE',
	'WED',
	'THU',
	'FRY',
	'SUT',
	'AUT'
);
	$ndate = str_replace('-','',$dates);
	$weekno = date('w',strtotime($ndate));
	$dow = $weeken[$weekno];
	return $dow;


}

?>