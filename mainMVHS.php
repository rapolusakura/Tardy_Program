<?php
$school_id = "Monte Vista High School";
setcookie("school_id", $school_id, time() + (86400 * 30), "/"); // 86400 = 1 day
?>
<html>
<head>
<title>MVHS Attendance Registration</title>
<link rel="stylesheet" href="index.css">
<link rel="shortcut icon" href="wildcat.ico"/>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="w3.css">
<link rel="stylesheet" href="google.css">
<link rel="stylesheet" href="font.css">
<link rel="stylesheet" href="tab.css">
<style>
body {
		background: linear-gradient(to bottom right, #ffffff, #ffb3b3, #ff1a1a, #800000) fixed;
}
</style>
</head>
<body>
	<img class = "nonprint" src="mvhsBanner.png"></img>
	<h1 class="w3-xxxlarge w3-main w3-padding-large nonprint">	MVHS Attendance Registration</h1>
	<h4 class="w3-large w3-main w3-padding-large nonprint" id="subtitle">	CURRENTLY SIGNING IN </h4>
	<div id="SIGN-IN" class="tabcontent">
	  <h3>SIGN-IN</h3>
	</div>

	<div id="SIGN-OUT" class="tabcontent">
	  <h3>SIGN-OUT</h3>
	</div>

	<button class="selectedTablink" onclick="signInMode()" id="sign-in">SIGN-IN</button>
	<button class="notSelectedTablink" onclick="signOutMode()" id="sign-out">SIGN-OUT</button>
  <br></br>
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
<script type="text/javascript" src="Services/ServiceLayer.js"></script>
<script type="text/javascript" src="global.js"></script>
<script type="text/javascript" src="search.js"></script>
<script type="text/javascript" src="Constants.js"></script>
<script type="text/javascript" src="jquery.min.js"></script>
<script type="text/javascript" src = "print.js"></script>
<script type="text/javascript" src = "signOut.js"></script>
<div style = "padding: 30px; margin-top: 12em;" class = nonprint><h5> Created by Sakura Rapolu C/O 2018</h5></div>
</body>
</html>
