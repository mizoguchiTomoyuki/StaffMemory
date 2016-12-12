<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>登録フォーム</title>
</head>
<link rel="stylesheet" type="text/css" href="designindex.css" media="all">

<body>
<?php

require_once'sqlClass.php';
session_start();
#このページからのサブミットに対応
if(!empty($_POST)){
	//エラー確認
	if($_POST['name'] == ''){
		$error['name'] = 'blank';	
	}
	if($_POST['pass'] == ''){
		$error['pass'] = 'blank';	
	}else if(strlen($_POST['pass']) < 4){ //パスの長さに対するエラー
		$error['pass'] = 'length';	
	}
	if($_POST['mail'] == ''){
		$error['mail'] = 'blank';
	}
	
	
	
	if(empty($error)){
		$mysql = new MySQLClass();
		$mysql->connect('localhost','testuser','testuser');
		$mysql->selectDatabase('service');
		mysql_set_charset('utf8');

		$qresult = $mysql->Query('SELECT name,mail FROM logindata');
		while ($row = mysql_fetch_assoc($qresult)) {
			if($row['name'] == $_POST['name']){
		
				$error['name'] = 'duplicate';	
			}
			if($row['mail'] == $_POST['mail']){
		
				$error['mail'] = 'duplicate';	
			}
		}
		$mysql->disconnect();
	}


#送信データのエラーチェック後Confirm.phpへ
	if(empty($error)){
		$_SESSION['join'] = $_POST;
		header('Location: confirm.php');
		exit();	
		
	}
	
	
	
	
}	
#Confirm.phpからのrewriteに対応
if(!empty($_REQUEST['action']) && $_REQUEST['action'] == 'rewrite'){
		$_POST = $_SESSION['join'];	
}
?>
<div class="main">
	<div class="main align">
     <div class="regiform">
        <img src="icondata/registform.png" id="regist" width="374" height="329" />
        <div class="registform">
		  <form method="POST" action="registration.php">

			<p>NAME
			<?php
				if(!empty($error['name']) && $error['name'] == 'blank')
					print('<font color = "red">※ユーザー名を入力してください。</font>');
 				if(!empty($error['name']) && $error['name'] == 'duplicate')
					print('<font color = "red">※そのユーザー名は既に登録されています。</font>');
			?>
            </p>
			<input type="text" name="name" size="60" maxlength="255" value="<?php  if(!empty($_POST['name']))echo htmlspecialchars($_POST['name'], ENT_QUOTES,'UTF-8'); ?>"></p>
			

			<p>メールアドレス
			<?php
				if(!empty($error['mail']) && $error['mail'] == 'blank')
						print('<font color = "red">※メールアドレスを入力してください。</font>');
				if(!empty($error['mail']) && $error['mail'] == 'duplicate')
						print('<font color = "red">※そのメールアドレスは既に登録されています。</font>');
			?>
            </p>
            <input type="text" name="mail" size="60" maxlength="255" value="<?php if(!empty($_POST['mail']))echo htmlspecialchars($_POST['mail'], ENT_QUOTES,'UTF-8'); ?>"></p>
			

			<p>パスワード
			<?php
				if(!empty($error['pass']) && $error['pass'] == 'blank')
					print('<font color = "red">※パスワードを入力してください。</font>');

				if(!empty($error['pass']) && $error['pass'] == 'length')
					print('<font color = "red">※パスワードが短すぎます。4文字以上にしてください。</font>');
			?>
            
            </p>
            <input type="password" name="pass" size="60" maxlength="255" value="<?php if(!empty($_POST['pass']))echo htmlspecialchars($_POST['pass'], ENT_QUOTES,'UTF-8'); ?>"></p>
			
			<div class="registform buttons" ><a href="index.php"><img src="icondata/registform-backbutton.png" id="back" width="74" height="38" alt="back" /></a>
            
            <input type="image" id="confirmbutton" value="ログイン" width="105" height="38" src="icondata/registform-button.png">
            </div>
</form>
	</form>
</div>
      </div>
    
    </div>

</div>

</body>
</html>