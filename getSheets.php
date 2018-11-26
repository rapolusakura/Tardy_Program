<?php
	require 'connect.php';
	date_default_timezone_set("America/Los_Angeles");
  //gets specific spreadsheet ID for the school

	$result = $conn->query("
		SELECT `info`.`sheets-format`
		FROM `info`
		WHERE `info`.`school-id` = '" . $_COOKIE["school_id"]."'
	");

	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			//format textfile to print as a slip
			echo $row["sheets-format"];
		}
	}
	mysqli_close($conn);

?>
