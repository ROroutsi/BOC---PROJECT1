<?php

require_once "connection.php";
session_start();
$student_id = $_SESSION["id"];
$subjectone = mysqli_real_escape_string($conn, $_POST['subjectone']);
$subjecttwo = mysqli_real_escape_string($conn, $_POST['subjecttwo']);
$subjectthree = mysqli_real_escape_string($conn, $_POST['subjectthree']);
$subjectfour = mysqli_real_escape_string($conn, $_POST['subjectfour']);
	
$insertgrade = "INSERT INTO `grades`(`student_id`,`subjectone`,`subjecttwo`,`subjectthree`, `subjectfour`) VALUES (?,?,?,?,?);";
$stmt = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt,$insertgrade)) {
	header("Location:pupdate.php?error=sqlerror");
		exit();		
	}
else{
	mysqli_stmt_bind_param($stmt,"sssss",$student_id,$subjectone, $subjecttwo,$subjectthree,$subjectfour);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_store_result($stmt);
	unset($_SESSION['onlyone']);
	header("Location:psearch.php?success=gradespassed");
	}
?>