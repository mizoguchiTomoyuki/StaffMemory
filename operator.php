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
	$adding = "";
	$endgreeting ="";

	if(!isset($_POST['toukou'])&&'' != strval($_POST['toukou'])){
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

	if($weeken[$dow] == 'SUN'){
		$adding = "今日は休日ですね。残ってる作業を終わらせてしまいましょう。";
		
		
	}
	}else{
		
		
	if($time > 22){
		$endgreeting = "投稿ありがとうございます。遅くまでお疲れ様でした。";	
		
	}else if($time >18){
		$endgreeting = "今日の成果報告ありがとうございます。お疲れさまでした。";
		
		
	}else if($time >=12){
		$endgreeting= "途中経過の報告ありがとうございます。";
		
		
	}else if($time > 9){
		$greeting = "報告ありがとうございます。";
		
		
	}else if($time > 6){
		$endgreeting= "報告ありがとうございます。皆さんの昨日の報告書が上がっているかもしれません。";
		
		
		
		
	}else{
		$endgreeting= "深夜遅くお疲れ様です。今日はゆっくりお休みください。";
		
		
	}

	}
	
	$ret = $greeting.$ret.$endgreeting;
	
	
	
return $ret;	
}

?>