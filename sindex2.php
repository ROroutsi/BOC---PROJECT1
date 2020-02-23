<?php

require "connection.php";
if (isset($_POST["submit"])) {
	$spassword = mysqli_real_escape_string($conn, $_POST['spassword']);
	$semail = mysqli_real_escape_string($conn, $_POST['semail']);
	$same = "SELECT `id`,`semail`,`spassword` FROM `students` WHERE `semail` = ?;";
	$stmt = mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt,$same)) {
		header("Location:slogin.php?error=sqlerror");
		exit();
	}
	else{
		mysqli_stmt_bind_param($stmt,"s",$semail);
		mysqli_stmt_execute($stmt);
		$sameresult = mysqli_stmt_get_result($stmt);
		$samecheck = mysqli_num_rows($sameresult);
		if ($samecheck > 0) {
			while ($row = mysqli_fetch_assoc($sameresult)) {
				$pwordcheck = password_verify($spassword, $row['spassword']);
				if ($pwordcheck == FALSE) {
					header("Location:slogin.php?error=wrongpassword");
					}
				else {
					if ($semail !== $row['semail']) {
						header("Location:slogin.php?error=wrongemail");
					}
					else {
						session_start();
						$_SESSION["fetchid"] = $row['id'];
						$_SESSION["slogin"] = $row['semail'];
						header("Location:sgrades.php");
					}
				}
			}
		}
		else {
			header("Location:slogin.php?error=userdoesnotexist");
		}
	}
}
else{
	header("Location:slogin.php")
}
?>