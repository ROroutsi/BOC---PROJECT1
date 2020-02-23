<?php

require_once "connection.php";
session_start();

$onlyone = '';
$_SESSION['onlyone']=$onlyone;

if (!isset($_SESSION["plogin"])) {
	   header("Location:plogin.php?error=pnotloggedin");
	};
if (isset($_POST['submit'])) {
	$searchname = mysqli_real_escape_string($conn,$_POST['sname']);
	$searchlastname = mysqli_real_escape_string($conn,$_POST['slastname']);
	$searchmysql = "SELECT grades.`subjectone`, grades.`subjecttwo`, grades.`subjectthree`, grades.`subjectfour` FROM `students` JOIN `grades` ON grades.`student_id` = students.`id`  WHERE `sname` LIKE CONCAT('%',?,'%') AND `slastname` LIKE CONCAT('%',?,'%');";
	$stmt = mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt,$searchmysql)) {
	header("Location:psearch.php?error=sqlerror");
	exit();
	}
	else{
		mysqli_stmt_bind_param($stmt,"ss",$searchname,$searchlastname);
		mysqli_stmt_execute($stmt);
		$searchresult = mysqli_stmt_get_result($stmt);
		$searchcheck = mysqli_num_rows($searchresult);
		if ($searchcheck > 0) {
			while ($row = mysqli_fetch_assoc($searchresult)) {
   				$first = $row['subjectone'];
				$second = $row['subjecttwo'];
				$third = $row['subjectthree'];
				$fourth = $row['subjectfour'];
   			};
   		}		
		else{
			$searchmysql1 = "SELECT `id` FROM `students` WHERE `sname` LIKE CONCAT('%',?,'%') AND `slastname` LIKE CONCAT('%',?,'%');";
			$stmt1 = mysqli_stmt_init($conn);
			if (!mysqli_stmt_prepare($stmt1,$searchmysql1)) {
				header("Location:psearch.php?error=sqlerror");
				exit();
			}
				else{
					mysqli_stmt_bind_param($stmt1,"ss",$searchname,$searchlastname);
					mysqli_stmt_execute($stmt1);
					$searchresult1 = mysqli_stmt_get_result($stmt1);
					$searchcheck1 = mysqli_num_rows($searchresult1);
					if ($searchcheck1 > 0) {
						while ($row = mysqli_fetch_assoc($searchresult1)){
							session_start();
							$_SESSION["id"] = $row['id'];
						};
							header("Location:pupdate.php");
					}
					else{
						header("Location:psearch.php?error=doesnotexist");
					}
				}
		}
	}
}
else{
	header("Location:psearch.php");
};

echo '<h2><a href="psearch.php"> Search again! </a> </h2>';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/main.css">
    <title>Grades</title>
</head>
<body>
    <main>
        <div class="container">
            <a> Subject one: <?php echo $first?> </a>
            <a> Subject two: <?php echo $second?> </a>
            <a> Subject three: <?php echo $third?> </a>
            <a> Subject four: <?php echo $fourth?> </a>
        </div>
    </main>
</body>
</html>

<?php echo "<h2><a href='plogout.php'>Log out</a></h2>".' '."<h2><a href='Start.php'>Switch</a></h2>"; ?>