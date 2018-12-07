<?php
	require 'connect.php';
	date_default_timezone_set("America/Los_Angeles");

	$result = $conn->query("
		SELECT `info`.`username`,  `info`.`password`
		FROM `info`
		WHERE `info`.`school-id` = '" . $_POST['school_id'] ."'
	");

	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
      if($_POST['username'] == $row["username"] && password_verify($_POST['password'], $row["password"])) {
        echo "true";
      } else {
        echo $_POST['username'];
        echo $_POST['password'];
        echo $row["password"];
        echo $row["username"]; 
        echo "false";
      }
		}
	}
	mysqli_close($conn);

?>
