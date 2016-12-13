<?php
echo comment();

function comment(){
	$ret = "";
	$time = date("G");
	$dow = date("w");
	
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
	$greeting = "";
	if($time > 22){
		$greeting = "遅くまでお疲れ様です。";	
		
	}else if($time >18){
		$greeting = "お疲れ様です。報告することがありましたら投稿フォームからお願いしますね。";
		
		
	}else if($time >13){
		$greeting = "お昼休憩終わりですか？後半戦がんばりましょう。";
		
		
	}else if($time >=12){
		$greeting= "お昼休憩ですね。";
		
		
	}else if($time > 9){
		$greeting = "おはようございます。";
		
		
	}else if($time > 6){
		$greeting= "おはようございます。お早い出勤ですね。";
		
		
	}else if($time > 3){
		$greeting= "深夜遅くまでお疲れ様です。いま皆さんの報告書をまとめているところです。";
		
		
	}else{
		$greeting= "夜遅くまでお疲れ様です。";
		
		
	}
	$adding = "";

	if($weeken[$dow] == 'SUN'){
		$adding = "今日は休日ですね。残ってる作業を終わらせてしまいましょう。";
		
		
	}
	
	$ret = $greeting.$ret;
	
	
	
return $ret;	
}

?>