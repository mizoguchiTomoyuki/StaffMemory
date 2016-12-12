// JavaScript Document
//Buttonのアクションなどで指定の要素を徐々に透明にする。
function changeOpacity($a, $b, $targetID){
//	document.getElementById("sampleButton").disabled = true;
	$once = false;
	$addTime=1; //表示のための追加時間
	$a+=$addTime; //一秒の表示時間を設ける
	//main関数を10ミリ秒ごとに呼び出す
	var $intervalD=setInterval(
		function(){
			main($targetID);	
		},
		10
	
	)	
	
	function main($targetID){
		//id属性の値がtargetIDである要素への参照を得る
		var $targetElement = document.getElementById($targetID);	
		
		if(!$once){
			$targetElement.style.cssText = "opacity:" + $a + ";";	
			$targetElement.style.cssText = "z-index:" + 1000 + ";";	
			$once = true;
		}
		
		
		//変化前の値$aを減算
		$a = $a -0.01;
		$c = 2;//$aが上限値を超えていたときの補正用(いらない？)
		//不透明度が変数$b以上のとき
		if($a > 1){
			$c = 1;
		}else{
			$c = $a;	
		}
		
		if($a>=$b){
			//スタイル属性値を指定
			$targetElement.style.cssText = "opacity:" + $c + ";";	
		
		}else{ //指定した値を下回ったら
		//タイマー停止
			$targetElement.style.cssText = "z-index:" + 0 + ";";	
			clearInterval($intervalID);
			
	//		document.getElementById("sampleButton").disabled = false;
			
		}
		
	}
	
}

	
	