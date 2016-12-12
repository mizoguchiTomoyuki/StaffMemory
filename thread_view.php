<?php
require_once 'sqlClass.php';
require_once 'date_encode.php';
//指定したユーザーのIDから表示するthreadを検索する
function threadviewFromUserId($userid){
$mysql = new MySQLClass();
$mysql->connect('localhost','testuser','testuser');
$mysql->selectDatabase('service');
mysql_set_charset('utf8');
//
$query = sprintf('SELECT * FROM thread where userid = %s ORDER BY date DESC',
				quote_smart($userid));
$qresult = $mysql->Query($query);

	$query = sprintf('SELECT name FROM logindata where id = %s',
				quote_smart($userid));
	$userqresult = mysql_fetch_assoc($mysql->Query($query));
print<<<EOF
	<div class="scr">
EOF;

while ($row = mysql_fetch_assoc($qresult)) {
 
	ThreadFormat($userqresult['name'],$row['date'],$row['article']);
 
}
print<<<EOF
	</div>
EOF;
$mysql->disconnect();
unset($mysql);

}
//指定した日付のthreadを検索表示する
function threadviewFromDate($date){
$mysql = new MySQLClass();
$mysql->connect('localhost','testuser','testuser');
$mysql->selectDatabase('service');
mysql_set_charset('utf8');

$year = '2001';
$month = '01';
$day = '01';
list($year, $month, $day) = explode('-', $date);
$query = sprintf('SELECT * FROM thread where YEAR(date)=%s AND MONTH(date) = %s AND DAY(date) = %s  ORDER BY date DESC',
				quote_smart($year),
				quote_smart($month),
				quote_smart($day));
$qresult = $mysql->Query($query);

print<<<EOF
	<div class="scr">
EOF;
while ($row = mysql_fetch_assoc($qresult)) {
	//周回中に探す
	$query = sprintf('SELECT name FROM logindata where id =  %s',
				quote_smart($row['userid']));
	$userqresult =mysql_fetch_assoc( $mysql->Query($query));
	
	ThreadFormat($userqresult['name'],$row['date'],$row['article']);

}

print<<<EOF
	</div>
EOF;
$mysql->disconnect();
unset($mysql);

}


function ThreadFormat($name,$dates,$article){
	

	$escapename = escape_char($name);
	$escapeart = escape_char($article);
	$year = '2001';
	$month = '01';
	$day = '01';
	list($year, $month, $day) = explode('-', $dates);
	$pos = strpos($day,' ');
	$subday = substr($day,0,$pos);
	$dow_color_back = '#CCCCCC';
	$dow_color_text = '#4D4D4D';
	$day_color_text = '#666666';
	$dow = getDayoftheWeek($dates);
	$bar = 'bar.png';
	if($dow == 'SUN'){
	$dow_color_back = '#ED1E79';
	$dow_color_text = '#FFFFFF';
	$day_color_text = '#ED1E79';
	$bar = 'barred.png';
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
	<div class = "thread">
			<div class="article">
				<div class = "name">
                $escapename
				</div>
				<div class = "tags">
                　
				</div>
			  <div class = "text">
                $escapeart
				</div>
			</div>
			
			<div class="date">
				<div class="day">
				
				<div class="month">
				<span style=$styledaytext>$month</span>
				</div>
				<img src=$bar width="66" height="66" alt="/" />
				
				<div class="detailday">
				<span style=$styledaytext>$subday</span>
				</div>
				
				</div>
				<div class="dow" style=$styleback>
				
                	<span style=$styletext>$dow</span>
				</div>
			</div>
 </div>
EOF;
}
?>