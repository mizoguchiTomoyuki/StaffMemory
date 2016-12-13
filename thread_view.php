<?php
require_once 'sqlClass.php';
require_once 'date_encode.php';
//指定したユーザーのIDから表示するthreadを検索する
//pageでページ番号を指定
function threadviewFromUserId($userid,$pageIndex){
$id_Counter = 0;
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
$counter =0;
$page = "page_";
print<<<EOF
	<div class="scr">
EOF;

while ($row = mysql_fetch_assoc($qresult)) {
 if($counter ==0){

		echo '<div id='.$page.(string)$id_Counter.'>';
	}
	if($pageIndex==$id_Counter){
		ThreadFormat($userqresult['name'],$row['date'],$row['article']);
	}
 if($counter ==0){

		echo '</div>';
	}
	$counter++;
	if($counter>10){
	$counter = 0;	
	$id_Counter++;
	}


}
$_SESSION['usr_page'] = $id_Counter;
print<<<EOF
	</div>
	<div class="pages">
EOF;
//ページ数の表示
for($i=0;$i<$id_Counter+1;$i++){
$FormName = 'usr_page'.(string)$i;
$clickPage = 'document.usr_page'.(string)$i.'.submit()';
//フォーム部分---------
print<<<EOF
<form method="get" action="index3.php" name=$FormName>
		<input type="hidden" name="usr_page_now" value=$i>
		<input type="hidden" name="usr_page" value=$id_Counter>
</form>
EOF;
//---------------------

//ページインデックス---------
	if(isset($_GET['usr_page_now'])){
		if($i == $_GET['usr_page_now']){
			echo '<span>['.(string)$i.']</span>';
		}else{
			$clickPage = 'document.usr_page'.(string)$i.'.submit()';
print<<<EOF
		<span><a href="#" onclick=$clickPage>[$i]  </a></span>
EOF;
		}
	}else{
		if($i == 0){
			echo '<span>['.(string)$i.']</span>';
		}else{
			$clickPage = 'document.usr_page'.(string)$i.'.submit()';
print<<<EOF
			<span><a href="#" onclick=$clickPage>[$i]   </a></span>
EOF;
		}
	}

//--------------------------
}
print '</div>';
$mysql->disconnect();
unset($mysql);

}

//指定した日付のthreadを検索表示する
function threadviewFromDate($date,$pageIndex){
$mysql = new MySQLClass();
$mysql->connect('localhost','testuser','testuser');
$mysql->selectDatabase('service');
mysql_set_charset('utf8');
$Date_Counter = 0;

$year = '2001';
$month = '01';
$day = '01';
list($year, $month, $day) = explode('-', $date);
$query = sprintf('SELECT * FROM thread where YEAR(date)=%s AND MONTH(date) = %s AND DAY(date) = %s  ORDER BY date DESC',
				quote_smart($year),
				quote_smart($month),
				quote_smart($day));
$qresult = $mysql->Query($query);
$counter =0;
$page = "page_";
print<<<EOF
	<div class="scr">
EOF;
while ($row = mysql_fetch_assoc($qresult)) {
	if($counter ==0){

		echo '<div id='.$page.(string)$counter.'>';
	}
	//周回中に探す
	$query = sprintf('SELECT name FROM logindata where id =  %s',
				quote_smart($row['userid']));
	$userqresult =mysql_fetch_assoc( $mysql->Query($query));
	if($pageIndex == $Date_Counter){
		ThreadFormat($userqresult['name'],$row['date'],$row['article']);
	}
	if($counter ==0){

		echo '</div>';
	}
	if($counter>10){
	$counter = 0;	
	$Date_Counter++;
	}


	$counter++;
}
$_SESSION['date_page'] = $Date_Counter;//セッションに全体のページ数を表示

print<<<EOF
	</div>
	<div class="pages">
EOF;

for($i=0;$i<$Date_Counter+1;$i++){
$FormName = 'date_page'.(string)$i;
$clickPage = 'document.usr_page'.(string)$i.'.submit()';
//フォーム部分---------
print<<<EOF
		<form method="get" action="index3.php" name=$FormName>
		<input type="hidden" name="date_page_now" value=$i>
		<input type="hidden" name="date_page" value=$Date_Counter>
</form>
EOF;
//---------------------

//ページインデックス---------
	if(isset($_GET['date_page_now'])){
		if($i == $_GET['date_page_now']){
			echo '<span>['.(string)$i.']</span>';
		}else{
print<<<EOF
		<span><a href="#" onclick=$clickPage>[$i]   </a></span>
EOF;
		}
	}else{
		if($i == 0){
			echo '<span>['.(string)$i.']</span>';
		}else{
print<<<EOF
			<span><a href="#" onclick=$clickPage>[$i]   </a></span>
EOF;
		}
	}

//--------------------------
}
echo '</div>';
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

function getidCount(){return $id_Counter;}
function getdateCount(){return $Date_Counter;}
?>