<?php
session_start();
unset($_SESSION["slogin"]);
header("Location:slogin.php");
?>