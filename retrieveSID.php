<?php
	require 'connect.php';
	date_default_timezone_set("America/Los_Angeles");
	//adds student to late table

	$result = $conn->query("
		SELECT `spreadsheet_id`.`spreadsheet-id`
		FROM `spreadsheet_id`
		WHERE `spreadsheet_id`.`school-id` = '" . $_COOKIE["school_id"]."'
	");

	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			//format textfile to print as a slip
			echo $row["spreadsheet-id"]; 
		}
	}
	mysqli_close($conn);

?>
