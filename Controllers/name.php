<?php
	if (isset($_POST['name'])===true && empty($_POST['name']===false)){
		require 'connect.php';
		//query student table for inputted ID number
		$result = $conn->query("
			SELECT `student`.`first_name`,  `student`.`last_name`, `student`.`grade`
			FROM `student`
			WHERE `student`.`id` = '" . mysqli_real_escape_string($conn, trim($_POST['name']))."'
		");
		date_default_timezone_set("America/Los_Angeles");
		if ($result->num_rows > 0) {
			// output data of each row
			  $row = $result->fetch_assoc();
				//Text to be printed out
				$myfile = fopen("DVHS_Tardy_Registration.txt", "w") or die("Unable to open file!");
				$txt = "Name: " . $row["first_name"]. " " . $row["last_name"] . "\nGrade: " . $row["grade"] . "\nDate: " . date("Y-m-d") . "\nTime: " . date("h:i:sa");
				fwrite($myfile, $txt);
				fclose($myfile);
				//write to textfile in format to be added to google sheets
				$myfile = fopen("Sheets.txt", "w") or die("Unable to open file!");
				$txt = '"' . date("h:i:sa"). '","' . $row["first_name"]. '","' . $row["last_name"]. '","' . $row["grade"]. '","' .$_POST['name']. '"';
				fwrite($myfile, $txt);
				fclose($myfile);
				echo "Name: " . $row["first_name"]. " " . $row["last_name"];
				echo "\nGrade: " . $row["grade"];
				echo "\nDate: " . date("Y-m-d");
				echo " \nTime: " . date("h:i:sa");
		} else {
			echo "0 results";
		}

	}
	mysqli_close($conn);
?>
