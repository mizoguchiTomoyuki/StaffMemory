<?php
require_once 'sqlClass.php';
require_once 'date_encode.php';
function threadpost($usrid,$text){
	$mysql = new MySQLClass();
	$mysql->connect('localhost','testuser','testuser');
	$mysql->selectDatabase('service');
	mysql_set_charset('utf8');
	$qresult = $mysql->Query('select count(*) from thread');
	$record =  mysql_fetch_assoc($qresult);
	$date = nowTimeInMySql();
	$query = sprintf('INSERT INTO thread(article,date,userid) VALUES(%s,%s,%s)',
				quote_smart($text),
				quote_smart($date),
				quote_smart($usrid));
	$qresult = $mysql->Query($query);

	$mysql->disconnect();
	unset($mysql);
}
function postFormat(){
	$dates = date('Y-m-d');//日付はその日のものを参照
	$year = '2001';
	$month = '01';
	$day = '01';
	list($year, $month, $day) = explode('-', $dates);
	$dow_color_back = '#E6E6E6';
	$dow_color_text = '#999999';
	$day_color_text = '#808080';
	$dow = getDayoftheWeek($dates);
	$bar = 'smallbar.png';
	if($dow == 'SUN'){
	$dow_color_back = '#ED1E79';
	$dow_color_text = '#FFFFFF';
	$day_color_text = '#ED1E79';
	$bar = 'smallredbar.png';
	}
	
	$styleback = sprintf('background-color:%s;',
	$dow_color_back
	);
	$styletext = sprintf( 'color:%s;',
	$dow_color_text
	);
	
	$styledaytext = sprintf( 'color:%s;',
	$day_color_text
	);
print<<< EOF

<form method="post" action="index3.php">
	<div class="form">
	
    <textarea name="toukou"  rows="5" cols="36" class= "textbox" id="tform" maxlength="255"></textarea>
	<div class = "sidebox">
		<div class = "sidebox date">
        	<div class="sidebox date month">
           <span style=$styledaytext> $month</span>
            </div>
            
        	<div class="sidebox date day">
           <span style=$styledaytext>  $day</span>
            </div>
			<img src=$bar width="41px" height="41px" alt="/" />
			<div class = "sidebox date week" style=$styleback>
				<span style=$styletext>$dow</span>
			</div>
		</div>
            <div class="button">
        <button type="submit" class = "Button">
			<img src='postButton.png' width="122" height="35" alt="/" />
        </button>
		</div>
</div>
 </div>
 
</form>
	
EOF;
	
}
?>