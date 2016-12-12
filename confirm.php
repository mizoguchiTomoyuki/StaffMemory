<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>無題ドキュメント</title>
<link rel="stylesheet" type="text/css" href="designindex.css" media="all">
<script type="text/javascript">
function Appearance(tabname){
document.getElementById(tabname).style.cssText = "opacity:1;";	
}
function DeAppearance(tabname){
document.getElementById(tabname).style.cssText = "opacity:0;";	
}
function ChangeHref(tabname,ena,url){
	var obj_link = document.getElementById(tabname);
	if(obj_link.disabled && !ena){
		obj_link.disabled = ena;
		if(ena){
			obj_link.setAttribute("href",url);	
		}else{
			obj_link.removeAttribute("href");	
		}
	}
}
</script>
</head>
<body>
<?php
session_start();
if(!isset($_SESSION['join'])){//セッション開始してない場合はtopに戻す
	//header('Location: index.php');
	//exit();
}
if($_SERVER['REQUEST_METHOD'] == 'POST'){
require_once "sqlClass.php";
$mysql = new MySQLClass();
$mysql->connect('localhost','testuser','testuser');
$mysql->selectDatabase('service');
mysql_set_charset('utf8');
//データベースへの登録
$sql = sprintf('INSERT INTO logindata(name,mail,pass) VALUES( %s,%s,%s)',
quote_smart( $_SESSION['join']['name']),
quote_smart( $_SESSION['join']['mail']),
quote_smart( sha1($_SESSION['join']['pass'])));//sha1で暗号化
$res = $mysql->Query($sql);
unset($_SESSION['join']);//セッションを空に

$mysql->disconnect();
if($res){
echo<<<EOM
<script>
Appearance('complete');
ChangeHref("comp-login",true,"index.php");
</script>
EOM;
	header('Location: index.php');
	exit();
}else{
echo<<<EOM
<script>
Appearance('error');
ChangeHref("comp-error",true,"index.php");
</script>
EOM;
}
}

?>

<div class="main">
<div id="complete">
<p>登録完了</p>
<p><a href= "index.php" id="comp-login">ログインする</a></p>
</div>
<div id="error">
<p>データベースエラー</p>
<p><a href= "index.php" id="comp-error">トップ</a></p>

</div>
	<div class = "main align">
   	 <div class="regiform">
        <img src="icondata/registform-confirm.png" id="regist" width="374" height="329" />
        <div class="registform">
      	  <form action="" method="post" >
				<p>ユーザー名</p>
					<?php require_once "sqlClass.php"; print("<p>".escape_char($_SESSION['join']['name']))."</p>" ?>
				<p>メールアドレス</p>
					<?php require_once "sqlClass.php"; print("<p>".escape_char($_SESSION['join']['mail']))."</p>" ?>
                        
			<div class="registform buttons"><a href="registration.php?action=rewrite"><img src="icondata/registform-backbutton.png" width="74" height="38" alt="back" /></a>
					
				
                <input type="image" width = "74" height="38" src="icondata/registform-completebutton.png" >
                </div>
		</form>
       </div>
     </div>
        
    </div>
</div>

</body>

<script>
ChangeHref("comp-login",false,"index.php");
ChangeHref("comp-error",false,"index.php");
</script>
</html>