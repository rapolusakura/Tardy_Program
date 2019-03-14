<?php
	require 'connect.php';
	date_default_timezone_set("America/Los_Angeles");
	//adds student to late table
	$id_num = mysqli_real_escape_string($conn, trim($_POST['name']));
	$result = $conn->query("
		INSERT INTO `" . $_COOKIE["school_id"]. "`(`first_name`, `last_name`, `grade`, `time`,`in-or-out`)
		SELECT `student`.`first_name`,  `student`.`last_name`, `student`.`grade`, CURRENT_TIMESTAMP, 'IN'
		FROM `student`
		WHERE `student`.`id` = " . $id_num);

	$result = $conn->query("
		SELECT `student`.`first_name`,  `student`.`last_name`, `student`.`grade`
		FROM `student`
		WHERE `student`.`id` = '" . $id_num ."'
	");

	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {

			//format entry for Google Sheets
			$txt = '"' . date("h:i:sa"). '","' . $row["first_name"]. '","' . $row["last_name"]. '","' . $row["grade"]. '","' .$_POST['name']. '"';
			$conn->query("
			  UPDATE `info`
			  SET `info`.`sheets-format` = '" . $txt."'
			  WHERE `info`.`school-id` = '" . $_COOKIE["school_id"]."'
			");

			//write to textfile for offline access
			$fileName = 'Late_Student_Records/'.date('m-d-Y').'.txt';
			$myfile = fopen($fileName, "a+") or die("Unable to open file!");
			$txt = "IN: ". date("Y-m-d"). "\t". date("h:i:sa"). "\t". $row["grade"]. "\t". $row["first_name"]. "\t" . $row["last_name"]. "\t" .$_POST['name']. "\r\n";
			fwrite($myfile, $txt);
			fclose($myfile);

			//format string to print as a slip
			$slipTxt = "Name: " . $row["first_name"]. " " . $row["last_name"] . "<br>Grade: " . $row["grade"] . "<br>Date: " . date("Y-m-d") . "<br>Time: " . date("h:i:sa");
			$htmlTxt = "Name: " . $row["first_name"]. " " . $row["last_name"] . "\nGrade: " . $row["grade"] . "\nDate: " . date("Y-m-d") . "\nTime: " . date("h:i:sa") . "\n\n" . $row["first_name"]
			. " " . $row["last_name"]. " was successfully signed in at " . date("h:i:sa");

			$myArr = array($htmlTxt, $slipTxt);
			$myJSON = json_encode($myArr, JSON_PRETTY_PRINT);
			echo $myJSON;
		}
	}
	mysqli_close($conn);

?>
