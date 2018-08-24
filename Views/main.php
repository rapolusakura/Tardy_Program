<!DOCTYPE html>
<html>
<head>
<title>Tardy Registration</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="shortcut icon" href="../images/wildcat.ico"/>
<link rel="stylesheet" href="Stylesheets/w3.css">
<link rel="stylesheet" href="Stylesheets/google.css">
<link rel="stylesheet" href="Stylesheets/font.css">
<link rel="stylesheet" href="Stylesheets/index.css">
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
		background: linear-gradient(to bottom, #1E90FF, #99ddff, #e6e6e6) fixed;
}
body, h1,h2,h3,h4,h5,h6 {font-family: "Montserrat", sans-serif}
.w3-row-padding img {margin-bottom: 8px}
</style>
</head>
<body>
	<img class = "nonprint" src="../images/banner.png"></img>
	<h1 class="w3-xxxlarge w3-main w3-padding-large nonprint">	DVHS Tardy Registration</h1>
	<h4 class="w3-large w3-main w3-padding-large nonprint">	Sign students into admin efficiently. </h4>
	<input type="button" id = "print" class = "nonprint" style = "padding: 16px" value = "SIGN OUT" onclick="window.location.href='signOut.php'"></input><br></br>
	<h4><div style="margin-right:5em;" align="right" id="response"></div></h4>
<div class="row">
			<h4><div align="left"></div></h4>
  <div class="column left">
    <img src= "../images/wildcat.jpg" class = "nonprint" id ="picture"></img>
  </div>
  <div class="column right">
		<h5 class = "nonprint">Enter Student ID#:</h5>
		<input style  = "padding: 16px" onkeyup="search()" autofocus class = "nonprint search" type="text" id = "name" name = "name" autocomplete = "off" placeholder="ex. 123456"></input>
		<br></br><pre><h5><div style = "printer" id ="name-data"></div></h5></pre>
		<h4><div class = "nonprint" id ="success"></div></h4>
		<h4><div id="message"></div></h4>
  </div>
</div>
<script type="text/javascript" src="../Services/sheets.js"></script>
<script type="text/javascript" src="../Controllers/search.js"></script>
<script type="text/javascript" src="../Helpers/Constants.js"></script>
<script type="text/javascript" src="../Helpers/jquery.min.js"></script>
<script type="text/javascript" src = "../Controllers/print.js"></script>
<img src = "../images/logo.png" class = "nonprint"></img>
<div style = "padding: 30px; margin-top: 12em;" class = nonprint><h5> Created by Sakura Rapolu C/O 2018</h5></div>
</body>
</html>