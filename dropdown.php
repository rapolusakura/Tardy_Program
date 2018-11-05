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
.dropbtn {
    background-color: #000000;
    color: white;
    padding: 16px;
    font-size: 16px;
    border: none;
    cursor: pointer;
}

.dropbtn:hover, .dropbtn:focus {
    background-color: #2980B9;
}

.dropdown {
    position: relative;
    display: inline-block;
}

.dropdown-content {
    display: none;
    position: absolute;
    background-color: #f1f1f1;
    min-width: 160px;
    overflow: auto;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 1;
}

.dropdown-content a {
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
}

.dropdown a:hover {background-color: #ddd;}

.show {display: block;}
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
	<h1 class="w3-xxxlarge w3-main w3-padding-large nonprint">	DVHS Tardy Registration</h1>
	<h4 class="w3-large w3-main w3-padding-large nonprint">	Sign students into admin efficiently. </h4>
  <br></br>
  <div class="dropdown">
<button onclick="myFunction()" class="dropbtn">Dropdown</button>
  <div id="myDropdown" class="dropdown-content">
    <a href="main.php">Dougherty Valley</a>
    <a href="mainCHS.php">California High School</a>
    <a href="mainMVHS.php">Monte Vista High School</a>
  </div>
</div>

<script>
/* When the user clicks on the button,
toggle between hiding and showing the dropdown content */
function myFunction() {
    document.getElementById("myDropdown").classList.toggle("show");
}

// Close the dropdown if the user clicks outside of it
window.onclick = function(event) {
  if (!event.target.matches('.dropbtn')) {

    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}
</script>
	<h4><div style="margin-right:5em;" align="right" id="response"></div></h4>
<div class="row">
			<h4><div align="left"></div></h4>

</div>
<script type="text/javascript" src="Services/ServiceLayer.js"></script>
<script type="text/javascript" src="search.js"></script>
<script type="text/javascript" src="Constants.js"></script>
<script type="text/javascript" src="jquery.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src = "print.js"></script>
<img src = "logo.png" class = "nonprint"></img>
<div style = "padding: 30px; margin-top: 12em;" class = nonprint><h5> Created by Sakura Rapolu C/O 2018</h5></div>
</body>
</html>
