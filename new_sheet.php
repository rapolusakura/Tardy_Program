<?php

require 'connect.php';
$conn->query("LOAD DATA LOCAL INFILE 'student_table.txt' INTO TABLE student COLUMNS TERMINATED BY '\t' IGNORE 1 LINES (id, first_name, last_name, grade);");
mysqli_close($conn);

if (isset($_POST['name'])===true && empty($_POST['name']===false)){
        $myfile = fopen("SpreadsheetID.txt", "w") or die("Unable to open file!");
				$txt = $_POST['name'];
				fwrite($myfile, $txt);
        fclose($myfile);
}
?>
