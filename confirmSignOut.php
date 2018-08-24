<?php
	require 'connect.php';
	date_default_timezone_set("America/Los_Angeles");
	//adds student to late table
	$result = $conn->query("
		INSERT INTO `sign-out`(`first_name`, `last_name`, `grade`)
		SELECT `student`.`first_name`,  `student`.`last_name`, `student`.`grade`
		FROM `student`
		WHERE `student`.`id` = '" . mysqli_real_escape_string($conn, trim($_POST['name']))."'
	");

	$result = $conn->query("
		SELECT `student`.`first_name`,  `student`.`last_name`, `student`.`grade`
		FROM `student`
		WHERE `student`.`id` = '" . mysqli_real_escape_string($conn, trim($_POST['name']))."'
	");

	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			//format entry for Google Sheets
			$myfile = fopen("Sheets.txt", "w") or die("Unable to open file!");
			$txt = '"' . date("h:i:sa"). '","' . $row["first_name"]. '","' . $row["last_name"]. '","' . $row["grade"]. '","' .$_POST['name']. '"';
			fwrite($myfile, $txt);
			fclose($myfile);

			//write to textfile for offline access
			$fileName = 'Late_Student_Records/'.date('m-d-Y').'.txt';
			$myfile = fopen($fileName, "a+") or die("Unable to open file!");
			$txt = "IN: ". date("Y-m-d"). "\t". date("h:i:sa"). "\t". $row["grade"]. "\t". $row["first_name"]. "\t" . $row["last_name"]. "\t" .$_POST['name']. "\r\n";
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
