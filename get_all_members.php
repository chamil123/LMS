<?php
include './database/connection.php';
global $con;
//$q = mysql_real_escape_string(strtolower($_GET["q"]));
//if (!$q) return;
print_r("sasdsd");

$sql="SELECT 
            tc.center_name, tc.center_id
        FROM
            center tc";
$result = mysqli_query($con, $sql);
while ($row = mysqli_fetch_row($result)) {
   echo "$row[0]\n";
}
?>
