<?php

require "connection.php";

if (isset($_POST["submit"])) {
	$ppassword = mysqli_real_escape_string($conn, $_POST['ppassword']);
	$pemail = mysqli_real_escape_string($conn, $_POST['pemail']);
	$same = "SELECT `pemail`,`ppassword` FROM `professors` WHERE `pemail` = ?";
	$stmt = mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt,$same)) {
		header("Location:plogin.php?error=sqlerror");
		exit();
	}
	else{
		mysqli_stmt_bind_param($stmt,"s",$pemail);
		mysqli_stmt_execute($stmt);
		$sameresult = mysqli_stmt_get_result($stmt);
		$samecheck = mysqli_num_rows($sameresult);
		if ($samecheck > 0) {
			while ($row = mysqli_fetch_assoc($sameresult)) {
				$pwordcheck = password_verify($ppassword, $row['ppassword']);
				if ($pwordcheck == FALSE) {
					header("Location:plogin.php?error=wrongpassword");
					}
					exit();
				else {
					if ($pemail !== $row['pemail']) {
						header("Location:plogin.php?error=wrongemail");
						exit();
					}	
					else {
						session_start();
						$_SESSION["plogin"] = $row['pemail'];
						header("Location:psearch.php?success=loggedin");
					}
				}
			}
		}
	else {
		header("Location:plogin.php?error=userdoesnotexist");
	}
	}
}
else{
	header("Location:plogin.php");
}

?>