<?php
/*$options = [
    'cost' => 11,
];
echo password_hash("", PASSWORD_BCRYPT, $options);
if(password_verify ( $_POST['pw'], '')!=1){
	readfile("password.html.lock");
	exit;
}*/
?>
<html>
<head>
<title>ossi bot</title>
<script>
var in_request=false;
var xhttp;
var data="";
var canvas;
var ctx;
var img;
var lastfile="";
var lastcom="";
var lastdata="";
if (window.XMLHttpRequest) {
    xhttp = new XMLHttpRequest();
    } else {
    //for IE6, IE5
    xhttp = new ActiveXObject("Microsoft.XMLHTTP");
}

xhttp.onreadystatechange = function() {
	if (xhttp.readyState == 4 && xhttp.status == 200) {
		//lädt
	}
	if (xhttp.readyState == 4) {
		data=xhttp.responseText;
		in_request=false;
	}
};
xhttp.ontimeout=function(){
	//timeout
};
function send_req(file,command){
	if(!in_request){
		in_request=true;
		var rand=Math.round(100000*Math.random());
		xhttp.open("POST", file, true);
		xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhttp.timeout=2000;
		xhttp.send(command+"&rand="+rand);
		lastfile=file;
		lastcom=command;
		return true;
	}else{
		if(instatus){
			alert("xhttp waiting on:" + lastfile + "?" + lastcom)
		}
		return false;
	}
}
var interv=setInterval(setoutput, 2000);
function setoutput(){
	if(!in_request){
		if(lastdata!=data){
			lastdata=data;
			var temp =lastdata.split("endl!?!").reverse();
			if (temp[0].indexOf("<hr>")==-1){
				temp[0]="";
			}
			if (temp[0].indexOf("Punktzahl")!=-1){
				clearInterval(interv);
			}
			document.getElementById("ausgabe").innerHTML=temp.join("");;
		}
		send_req("ossi_quiz/get_output.php","pw=<?php /*echo $_POST['pw']*/?>");
	}
}
</script>
<link rel="stylesheet" type="text/css" href="shared.css"/>
<style>
#eingabe{
	position: absolute;
	background:#c55151;
	left: 50%;
	top:70px;
	margin-left: -490px;
	width: 980px;
	height: 32px;
	padding-top:8px;
	color:#eeeeee;
}
#ausgabe{
	position: absolute;
	background:#c55151;
	left: 50%;
	top:120px;
	margin-left: -490px;
	width: 980px;
	height: 700px;
	color:#eeeeee;
	overflow-y:scroll;
	font-size:14px;
}
.r{
	position:relative;
	background:green;
	float:right;
	height:10px;
	width:10px;
}
.w{
	position:relative;
	background:red;
	float:right;
	height:10px;
	width:10px;
}
</style>
</head>
<body onload="">
<!-- here was a header-->
<div id="eingabe">
	<form action="index.php" method="post">
		<input type="hidden" name="pw" value="<?php /*echo $_POST['pw']*/?>">
		Name: <input type="text" name="name">
		Wohnort: <input type="text" name="ort">
		<input type="checkbox" name="start">
		<input type="submit" value="Submit">
	</form> 
</div>
<div id="ausgabe">
	<?php
		$to_exec=" ";
		if(!empty($_POST["ort"])){
			if(!empty($_POST["name"])){
				$to_exec.=" ".$_POST["ort"];
				$to_exec.=" ".$_POST["name"];
			}
		}
		if(!empty($_POST["start"])){
			if(file_get_contents("ossi_quiz/ossi_stat")!="1"){
				shell_exec("printf '' > ossi_quiz/ossi_output.lock &");
				shell_exec("python ossi_quiz/ossi_bot.py.lock".$to_exec.">> ossi_quiz/ossi_output.lock &");
			}
		}
	?>
</div>
</body>
</html>
