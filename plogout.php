<?php
session_start();
unset($_SESSION["plogin"]);
header("Location:plogin.php");
?>