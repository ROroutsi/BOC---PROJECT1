<?php

require "connection.php";

if (isset($_POST["submit"])) {
	$sname = mysqli_real_escape_string($conn, $_POST['sname']);
	$slastname = mysqli_real_escape_string($conn, $_POST['slastname']);
	$spassword= mysqli_real_escape_string($conn, $_POST['spassword']);
	$shpassword = password_hash($spassword, PASSWORD_DEFAULT);
	$srpassword= mysqli_real_escape_string($conn, $_POST['srpassword']);
	$semail = mysqli_real_escape_string($conn, $_POST['semail']);
	if ($spassword !== $srpassword) {
		header("Location:ssignup.php?error=passwordnotmatching");
		exit();	
	}
	else {
		$same = "SELECT `semail` FROM `students` WHERE `semail` = ?;";
		$stmt = mysqli_stmt_init($conn);
		if (!mysqli_stmt_prepare($stmt,$same)) {
			header("Location:ssignup.php?error=sqlerror");
			exit();
		}
		else{
			mysqli_stmt_bind_param($stmt,"s", $semail);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_store_result($stmt);
			$samecheck = mysqli_stmt_num_rows($stmt);
			if ($samecheck >0) {
				header("Location:ssignup.php?error=usertaken");
				exit();
			}
			else{
				$addmysql = "INSERT INTO `students`(`sname`,`slastname`,`spassword`,`semail`) VALUES (?,?,?,?);";
				$stmt1 = mysqli_stmt_init($conn);
				if (!mysqli_stmt_prepare($stmt1,$addmysql)) {
					echo 'Sql error';
				}
				else{
					mysqli_stmt_bind_param($stmt1,"ssss", $sname, $slastname, $shpassword, $semail);
					mysqli_stmt_execute($stmt1);
					mysqli_stmt_store_result($stmt1);
					header("Location:slogin.php?success=signedup");
				}
			}					
		}
	}	
}
else{
	header("Location:ssignup.php")
}
?>