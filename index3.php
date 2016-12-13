<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
session_start();
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>マイページ</title>
<link rel="stylesheet" type="text/css" href="design.css" media="all">

<script type="text/javascript" src="effect.js"></script>
<script type="text/javascript">
function ChangeTab(tabname){
document.getElementById('usertl').style.display = 'none';
document.getElementById('alltl').style.display = 'none';
document.getElementById(tabname).style.display = 'block';
	
}
function Changepage(pageindex,pagenum){
	for(var i=0;i<pagenum;i++){
		var str = "page_"+String(i);	
		document.getElementById(str).style.display = 'none';
	}
		var str = "page_"+String(pageindex);	
		document.getElementById(str).style.display = 'block';
	
}
</script>


</head>
<?php
if(!isset($_SESSION['userid'])){
//	header('Location: ../StaffMemory/index.php');
//	exit;	
}
?>
<?php
require_once 'thread_post.php';
#投稿ボタンを押されたら.
if($_SERVER["REQUEST_METHOD"] == "POST"){
	$DATA['id'] = '';
	if(isset($_SESSION['userid'])){
		$DATA['id'] = $_SESSION['userid'];	
	}
	$DATA['text'] = $_POST['toukou'];
	#セッションに残しておいた投稿内容と比較し同じ投稿でなければ投稿
	if(isset($_SESSION['postart'])){
		if('' == strval($_POST['toukou'])){
echo<<<EOM
<script>
changeOpacity( 1, 0 ,'alart_blank');
</script>
EOM;
		}else{
			if($_SESSION['postart'] !=$_POST['toukou']){
				$_SESSION['postart'] = $_POST['toukou'];
				threadpost($DATA['id'],$DATA['text']);
			}else{
echo<<<EOM
<script>
changeOpacity( 1, 0 ,'alart');
</script>
EOM;
			}
        }
	}else{
			$_SESSION['postart'] = $_POST['toukou'];
			threadpost($DATA['id'],$DATA['text']);
		
	}
        
	

}

?>
<body>
<div id="alart">
<p>前回の投稿と同じ内容です</p>
</div>
<div id="alart_blank">
<p>空白のままです</p>
</div>
<div class="upmenu">
<div class="smalllogo">
<img src="icondata/logo-mini.png" width="223" height="35" alt="logo" />
</div>
<ul class = "upmenuline">
<li>ユーザー：<?php
  require_once "sqlClass.php";
  $mysql = new MySQLClass();
$mysql->connect('localhost','testuser','testuser');
$mysql->selectDatabase('service');
mysql_set_charset('utf8');
if(isset($_SESSION['userid'])){
	$userid =  $_SESSION['userid'];
    $query = sprintf('SELECT name FROM logindata where id = %s',
				quote_smart($userid));
	$userqresult = mysql_fetch_assoc($mysql->Query($query));
	echo $userqresult['name'].'   ';
}

$mysql->disconnect();
unset($mysql);
?>
</li>
<li>
<a href = "logout.php">ログアウト</a>
</li>

</ul>
</div>
<div class="main">
<div class = "alignmenu">
	<div class="leftMenu">
		<div class="icon">
			<hr1>
            <div class="button">
				<a href="#usertl" class="usertl" onclick="ChangeTab('usertl')">
                <img src="icondata/mypageButtonIcon.png" alt="マイページ" name="icon" width="63" height="63" id="icon" />
                </div>
				<p>
				マイページ
				</p>
                </a>
			</hr1>
			<hr2>
            <div class="button">
				<a href="#alltl" class="alltl" onclick="ChangeTab('alltl')">
                <img src="icondata/dateButtonIcon.png" alt="報告書" name="icon" width="63" height="63" id="icon" />
                </div>

				<p>
				報告書
				</p>
                </a>
			</hr2>
		</div>
	</div>
    
	<div class="centerMenu">

		<div class="centerMenu form">
        <?php
		require_once 'thread_post.php';
		postFormat();
		?>
        </div>
        <p></p>
        <div id="usertl" class="timeline">
        
<?php
require_once 'date_encode.php';
require_once 'thread_view.php';
	if(isset($_SESSION['userid'])){
		$DATA['id'] = $_SESSION['userid'];	
		if(isset($_GET['usr_page_now'])){
			$page = $_GET['usr_page_now'];
			threadViewFromUserId($_SESSION['userid'],$page);
		}else{
			threadViewFromUserId($_SESSION['userid'],0);
		}
	}else{
		echo '読み込み失敗';	
	}
?>
        </div>
        <div id="alltl" class="timeline">
      <?php
require_once 'date_encode.php';
require_once 'thread_view.php';
		$yesterday_date =  GetYesterday();
		if(isset($_GET['date_page_now'])){
			$page = $_GET['date_page_now'];
			threadViewFromDate($yesterday_date,$page);
		}else{
			threadViewFromDate($yesterday_date,0);
		}
		?>
        </div>
    </div>
</div>

</div>

<div class="charspace">
<p class="comments" id="comments">
<img src="icondata/comment.png" width="302" height="202" alt="コメント" />
<span><?php 
require_once 'operator.php';
print<<<EOF
<script>
changeOpacity( 3, 0 ,'comments');
changeOpacity( 3, 0 ,'uketsuke');
</script>
EOF;
?></span>
</p>
  <p class="uketuske" id="uketsuke"><img src="icondata/uketuke2e.png" width="512" height="512" alt="うけつけ" /></p>
</div>
<script>
ChangeTab('usertl');
</script>
<?php
print <<< EOM

<script>
ChangeTab('usertl');
</script>

EOM;

?>
</body>
</html>