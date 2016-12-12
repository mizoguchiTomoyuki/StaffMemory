<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
session_start();
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>無題ドキュメント</title>
<link rel="stylesheet" type="text/css" href="designindex.css" media="all">

</head>
<?php

    $_SESSION = array();

    if (isset($_COOKIE["PHPSESSID"])) {
        setcookie("PHPSESSID", '', time() - 1800, '/');
    }

    session_destroy();

?>
<body>
<div class="main">
	<div class="main align">
    	<div class="logoutdialog">
			<p>ログアウトしました。</p>
			<a href = "index.php" >トップページ</a>
    	</div>
	</div>
</div>

</body>
</html>