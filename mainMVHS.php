<!DOCTYPE html>
<html>
<head>
<title>Tardy Registration</title>
<link rel="stylesheet" href="index.css">
<link rel="shortcut icon" href="wildcat.ico"/>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="w3.css">
<link rel="stylesheet" href="google.css">
<link rel="stylesheet" href="font.css">
<style>
img {
float:right;
padding-right: 1.55cm;
padding-top: 0.5cm;
}
header {
		float:left;
}
body {
		background: linear-gradient(to bottom right, #ffffff, #ffb3b3, #ff1a1a, #800000) fixed;
}
body, h1,h2,h3,h4,h5,h6 {font-family: "Montserrat", sans-serif}
.w3-row-padding img {margin-bottom: 8px}
</style>
</head>
<body>
	<img class = "nonprint" src="mvhsBanner.png"></img>
	<h1 class="w3-xxxlarge w3-main w3-padding-large nonprint">	MVHS Tardy Registration</h1>
	<?php
	echo "Value is: " . $_COOKIE["SAKURA"];
	?>
	<h4 class="w3-large w3-main w3-padding-large nonprint">	Sign students into admin efficiently. </h4>
	<h4><div style="margin-right:5em;" align="right" id="response"></div></h4>
<div class="row">
			<h4><div align="left"></div></h4>
  <div class="column left">
    <img src= "mustang.png" class = "nonprint" id ="picture"></img>
  </div>
  <div class="column right">
		<h5 class = "nonprint">Enter Student ID#:</h5>
		<input style  = "padding: 16px" onkeyup="search()" autofocus class = "nonprint search" type="text" id = "name" name = "name" autocomplete = "off" placeholder="ex. 123456"></input>
		<br></br><pre><h5><div style = "printer" id ="name-data"></div></h5></pre>
		<input type="submit" id = "print" class = "nonprint" style = "padding: 16px" value = "Print Slip"></input><br></br>
		<h4><div class = "nonprint" id ="success"></div></h4>
		<h4><div id="message"></div></h4>
  </div>
</div>
<script src="https://www.gstatic.com/firebasejs/4.9.0/firebase.js"></script>
<script>
  // Initialize Firebase
  var config = {
    apiKey: "AIzaSyA-Z5rzhwqwmX9HNSoF0dDes4VGdgFcqKo",
    authDomain: "intrepid-vista-188201.firebaseapp.com",
    databaseURL: "https://intrepid-vista-188201.firebaseio.com",
    projectId: "intrepid-vista-188201",
    storageBucket: "",
    messagingSenderId: "908096432316"
  };
  firebase.initializeApp(config);
</script>
<script type="text/javascript" src="search.js"></script>
<script type="text/javascript" src="jquery.min.js"></script>
<script type="text/javascript" src = "print.js"></script>
<script type="text/javascript" src = "create.js"></script>
<div style = "padding: 30px; margin-top: 12em;" class = nonprint><h5> Created by Sakura Rapolu C/O 2018</h5></div>
</body>
</html>
