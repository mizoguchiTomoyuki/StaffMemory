<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>無題ドキュメント</title>


<link rel="stylesheet" type="text/css" href="design.css" media="all">

</head>

<body tracingsrc="sitedesign1024.png" tracingopacity="80" width="100%">
<?php

require_once 'sqlClass.php';
require_once 'date_encode.php';
	$now = date('Y-m-d');
ThreadFormat("溝口",$now,"□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□");
ThreadFormat("溝口",'2016-12-11',"□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□□");

postFormat();
function ThreadFormat($name,$dates,$article){
	

	$escapename = escape_char($name);
	$escapeart = escape_char($article);
	$year = '2001';
	$month = '01';
	$day = '01';
	list($year, $month, $day) = explode('-', $dates);
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
				<span style=$styledaytext>$day</span>
				</div>
				
				</div>
				<div class="dow" style=$styleback>
				
                	<span style=$styletext>$dow</span>
				</div>
			</div>
 </div>
	
EOF;
}

function postFormat(){
	$dates = date('Y-m-d');
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

<form method="post" action="index.php">
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
        <button type="submit" class = "Button">
			<img src='postButton.png' width="122" height="35" alt="/" />
        </button>
</div>
 </div>
 
</form>
	
EOF;
	
}


?>


<form method="post" action="index.php">

   <div class="form">


	
    <textarea name="toukou"  rows="5" cols="36" class= "textbox" id="tform" maxlength="255"></textarea>
	<div class = "sidebox">
		<div class = "sidebox date">
        	<div class="sidebox date month">
            12
            </div>
            
        	<div class="sidebox date day">
            09
            </div>
			<img src='smallbar.png' width="41px" height="41px" alt="/" />
			<div class = "sidebox date week" style="background-color:#E6E6E6">
				<span style="color:#999999">FRY</span>
			</div>
		</div>
        <button type="submit" class = "Button">
			<img src='postButton.png' width="122" height="35" alt="/" />
        </button>
   </div>

</form>

</body>
</html>