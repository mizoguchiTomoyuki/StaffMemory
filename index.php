<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>トップページ</title>
</head>
<link rel="stylesheet" type="text/css" href="designindex.css" media="all">
<body>

<?php
//同ページからのログイン要請にこたえる
require 'sqlClass.php';
session_start();

if(isset($_SESSION['username'])){
	header('Location: ../StaffMemory/index3.php');
	exit;	
}
#このページからのサブミットに対応
if($_SERVER["REQUEST_METHOD"] == "POST"){
	
	
	if($_POST['mail'] != '' && $_POST['pass'] != ''){
		$mysql = new MySQLClass();
		$mysql->connect('localhost','testuser','testuser');
		$mysql->selectDatabase('service');
		mysql_set_charset('utf8');
		$query = sprintf('SELECT * FROM logindata WHERE mail = %s AND pass = %s',
						quote_smart($_POST['mail']),
						quote_smart(sha1($_POST['pass'])));
		$qresult = $mysql->Query($query);
		$table = mysql_fetch_assoc($qresult);
		if(!empty($table)){
			//ログイン成功
			session_regenerate_id(true);
			$_POST = array();
			$_SESSION['userid'] = $table['id']; //ユーザーのidをidとしてセッションで渡す
			header('Location: ../StaffMemory/index3.php');
			exit();
		}else{
			$error['login'] = 'failed';	
		}
		$mysql->disconnect();
	}else{
		$error['login'] = 'blank';
	}


	
	
	
	
}	
?>
<div class="main">
	<div class="main align">
    	<div class="logo">
        <img src="icondata/logo.png" width="368" height="66" />
        </div>
        <div class="loginform">
        <img src="icondata/loginform.png" width="374" height="329" />
        <div class="form">
	<form method="POST" action="index.php">

	<p>メールアドレス</p>
	<input type="text" name="mail" size="60" maxlength="255" value="<?php if(!empty($_POST['mail']))echo htmlspecialchars($_POST['mail'], ENT_QUOTES,'UTF-8'); ?>"></p>

	<p>パスワード</p>
	<input type="password" name="pass" size="60" maxlength="255" value=""></p>

	<?php
		if(!empty($error['login']) && $error['login'] == 'blank')
		print('<p><font color = "red">※いずれかの項目が入力されていません。</font></p>');
		if(!empty($error['login']) && $error['login'] == 'failed')
		print('<p><font color = "red">※ログインに失敗しました。アドレスとパスワードを確認してください。</font></p>');

		?>
		<input type="image" id="loginbutton" value="ログイン" width="105" height="38" src="icondata/login-button.png">
	</form>
    
        <div class="loginform goregist">
        <a href= "registration.php">
        <img src="icondata/goregist.png" width="109" height="19" /></a>
        </div>
</div>
        </div>
    
    
    </div>
</div>


</body>
</html>