<?php
$myArr = array("John", "Mary", "Peter", "Sally");

$myJSON = json_encode($myArr);
var parsedData = JSON.parse(jsontext);

var cities = parsedData[0];

echo $myJSON["John"];
?>
