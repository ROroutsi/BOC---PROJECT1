<?php 

include_once "connection.php";

$selectmysql = "SELECT * FROM professors;";

$result = mysqli_query($conn,$selectmysql);

$checkresult = mysqli_num_rows($result);

?>