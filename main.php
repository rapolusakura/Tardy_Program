<?php
$school_id = "Dougherty Valley High School";
setcookie("school_id", $school_id, time() + (86400 * 30), "/"); // 86400 = 1 day
?>
<html>
<head>
<title>SRVUSD Attendance Registration</title>
<link rel="stylesheet" href="index.css">
<link rel="shortcut icon" href="wildcat.ico"/>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="w3.css">
<link rel="stylesheet" href="google.css">
<link rel="stylesheet" href="font.css">
<style>
.selectedTablink {
    background-color: #fffff0;
    color: Black;
    float: left;
    border: none;
    outline: none;
    cursor: pointer;
    padding: 14px 16px;
    font-size: 17px;
    width: 50%;
}

.notSelectedTablink {
    background-color: #111;
    color: white;
    float: left;
    border: none;
    outline: none;
    cursor: pointer;
    padding: 14px 16px;
    font-size: 17px;
    width: 50%;
}

.tablink:hover {
    background-color: #888;
}

/* Style the tab content */
.tabcontent {
    color: Black;
    display: none;
    padding: 50px;
    text-align: center;
}

img {
float:right;
padding-right: 1.55cm;
padding-top: 0.5cm;
}
header {
		float:left;
}
body {
		background: linear-gradient(to bottom, #1E90FF, #99ddff, #e6e6e6) fixed;
}
body, h1,h2,h3,h4,h5,h6 {font-family: "Montserrat", sans-serif}
.w3-row-padding img {margin-bottom: 8px}
</style>
</head>
<body>
	<img class = "nonprint" src="banner.png"></img>
	<h1 class="w3-xxxlarge w3-main w3-padding-large nonprint">	SRVUSD Attendance Registration</h1>
	<h4 class="w3-large w3-main w3-padding-large nonprint" id="subtitle">	Sign students into admin efficiently. </h4>
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
  <div class="column left" style = "padding: 30px">
    <img src= "wildcat.jpg" class = "nonprint" id ="picture"></img>
  </div>
  <div class="column right" style = "padding: 30px">
		<h5 class = "nonprint">Enter Student ID#:</h5>
		<input style  = "padding: 16px" onkeyup="search()" autofocus class = "nonprint search" type="text" id = "name" name = "name" autocomplete = "off" placeholder="ex. 123456"></input>
		<br></br><pre><h5><div style = "printer" id ="name-data"></div></h5></pre>
		<h4><div class = "nonprint" id ="success"></div></h4>
		<h4><div id="message"></div></h4>
  </div>
</div>
<script>
var isSigningIn = true;

function signInMode() {
  document.getElementById("sign-in").className = "selectedTablink";
  document.getElementById("sign-out").className = "notSelectedTablink";
  document.getElementById("subtitle").innerHTML = "CURRENTLY SIGNING IN"
  document.body.style.background = "linear-gradient(to bottom, #1E90FF, #99ddff, #e6e6e6) fixed";
  isSigningIn = true;
  document.getElementsByName('name').focus();
}

function signOutMode() {
  document.getElementById("sign-out").className = "selectedTablink";
  document.getElementById("sign-in").className = "notSelectedTablink";
  document.getElementById("subtitle").innerHTML = "CURRENTLY SIGNING OUT"
  document.body.style.background = "linear-gradient(to bottom, #ffa500, #ffff00, #ffffff) fixed";
  isSigningIn = false;
  document.getElementsByName('name').focus();
}

document.getElementById('name').onkeydown = function(event) {
  if (event.keyCode == 13) {
    if(isSigningIn) {
      signIn();
    } else {
      signOut();
    }
  }
};

</script>
<script type="text/javascript" src="Services/ServiceLayer.js"></script>
<script type="text/javascript" src="search.js"></script>
<script type="text/javascript" src="Constants.js"></script>
<script type="text/javascript" src="jquery.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src = "print.js"></script>
<script type="text/javascript" src = "signOut.js"></script>
<img src = "logo.png" class = "nonprint"></img>
<div style = "padding: 30px; margin-top: 12em;" class = nonprint><h5> Created by Sakura Rapolu C/O 2018</h5></div>
</body>
</html>
