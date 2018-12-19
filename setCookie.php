<?php
setcookie("school_id", $_POST['school_id'], time() + (86400 * 30), "/"); // 86400 = 1 day
// $domain = ($_SERVER['HTTP_HOST'] != 'localhost') ? $_SERVER['HTTP_HOST'] : false;
// setcookie("school_id", $_POST['school_id'], time() + (86400 * 30), '/', $domain, false);
?>
