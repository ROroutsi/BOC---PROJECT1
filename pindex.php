<?php

require "connection.php";

if (isset($_POST["submit"])) {
	$pname = mysqli_real_escape_string($conn, $_POST['pname']);
	$plastname = mysqli_real_escape_string($conn, $_POST['plastname']);
	$ppassword= mysqli_real_escape_string($conn, $_POST['ppassword']);
	$phpassword = password_hash($ppassword, PASSWORD_DEFAULT);
	$prpassword= mysqli_real_escape_string($conn, $_POST['prpassword']);
	$pemail = mysqli_real_escape_string($conn, $_POST['pemail']);
	if ($ppassword !== $prpassword) {
		header("Location:psignup.php?error=passwordnotmatching");
		exit();	
		}
	else {
			$same = "SELECT `pemail` FROM `professors` WHERE `pemail` = ?;"; 
			$stmt = mysqli_stmt_init($conn);
			if (!mysqli_stmt_prepare($stmt,$same)) {
				header("Location:psignup.php?error=sqlerror");
				exit();
			}
			else{
				mysqli_stmt_bind_param($stmt,"s", $pemail);
				mysqli_stmt_execute($stmt);
				mysqli_stmt_store_result($stmt);
				$samecheck = mysqli_stmt_num_rows($stmt);
				if ($samecheck >0) {
					header("Location:psignup.php?error=usertaken");
					exit();
				}
				else{
					$addmysql = "INSERT INTO `professors`(`pname`,`plastname`,`ppassword`,`pemail`) VALUES (?,?,?,?);";
					$stmt1 = mysqli_stmt_init($conn);
					if (!mysqli_stmt_prepare($stmt1,$addmysql)) {
						echo 'Sql error';
					}
					else{
						mysqli_stmt_bind_param($stmt1,"ssss", $pname, $plastname, $phpassword, $pemail);
						mysqli_stmt_execute($stmt1);
						mysqli_stmt_store_result($stmt1);
						header("Location:plogin.php?success=signedup");
					}
				}
			}
	}
}
else{
	header("Location:psignup.php");
}
?>