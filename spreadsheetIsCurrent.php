<?php
	require 'connect.php';
	date_default_timezone_set("America/Los_Angeles");
  //gets specific spreadsheet ID for the school

  $result = $conn->query("
    SELECT * FROM `late` ORDER BY time DESC LIMIT 1
  ");

	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			//gets date of last entry in yyyy-mm-dd
      $dayOfLastEntry = explode(" ", $row["time"])[0];
      $currentDate = date("Y-m-d");
      if ($dayOfLastEntry == $currentDate) {
        echo "true";
      }
      else {
        echo "false";
      }
		}
	}
	mysqli_close($conn);
?>
