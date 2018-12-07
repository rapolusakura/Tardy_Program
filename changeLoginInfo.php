<?php
require 'connect.php';
date_default_timezone_set("America/Los_Angeles");

$school = "San Ramon Valley High School";
$username = "srvhs";
$password = "123";

$hash = password_hash($password, PASSWORD_DEFAULT);

$conn->query("
  UPDATE `info`
  SET `info`.`username` = '" . $username."'
  WHERE `info`.`school-id` = '" . $school."'
");

$conn->query("
  UPDATE `info`
  SET `info`.`password` = '" . $hash."'
  WHERE `info`.`school-id` = '" . $school."'
");

mysqli_close($conn);
?>
