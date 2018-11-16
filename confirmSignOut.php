<?php
	require 'connect.php';
	date_default_timezone_set("America/Los_Angeles");
	//adds student to sign-out table
	$id_num = mysqli_real_escape_string($conn, trim($_POST['name']));
	$result = $conn->query("
		INSERT INTO `sign-out`(`first_name`, `last_name`, `grade`, `id`)
		SELECT `student`.`first_name`,  `student`.`last_name`, `student`.`grade`, " .$id_num. "
		FROM `student`
		WHERE `student`.`id` = '" .$id_num."'
	");

	$result = $conn->query("
		SELECT `student`.`first_name`,  `student`.`last_name`, `student`.`grade`
		FROM `student`
		WHERE `student`.`id` = '" . mysqli_real_escape_string($conn, trim($_POST['name']))."'
	");

	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			//format entry for Google Sheets
			$txt = '"' . date("h:i:sa"). '","' . $row["first_name"]. '","' . $row["last_name"]. '","' . $row["grade"]. '","' .$_POST['name']. '"';
			$conn->query("
			  UPDATE `spreadsheet_id`
			  SET `spreadsheet_id`.`sheets-format` = '" . $txt."'
			  WHERE `spreadsheet_id`.`school-id` = '" . $_COOKIE["school_id"]."'
			");

			//write to textfile for offline access
			$fileName = 'Late_Student_Records/'.date('m-d-Y').'.txt';
			$myfile = fopen($fileName, "a+") or die("Unable to open file!");
			$txt = "OUT: ". date("Y-m-d"). "\t". date("h:i:sa"). "\t". $row["grade"]. "\t". $row["first_name"]. "\t" . $row["last_name"]. "\t" .$_POST['name']. "\r\n";
			fwrite($myfile, $txt);
			fclose($myfile);

			echo "Name: " . $row["first_name"]. " " . $row["last_name"];
			echo "\nGrade: " . $row["grade"];
			echo "\nDate: " . date("Y-m-d");
			echo " \nTime: " . date("h:i:sa");
			echo "\n\n" . $row["first_name"]. " " . $row["last_name"]. " was successfully signed out at " . date("h:i:sa");
		}
	}
	mysqli_close($conn);

?>
