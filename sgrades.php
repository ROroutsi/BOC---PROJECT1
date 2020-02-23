<?php

require "connection.php";
session_start();

if (!isset($_SESSION["slogin"])) {
    header("Location:slogin.php?error=snotloggedin");
};
 
$id = $_SESSION["fetchid"];   
$search = mysqli_real_escape_string($conn,$id);
$searchmysql = "SELECT `subjectone`, `subjecttwo`, `subjectthree`, `subjectfour` FROM `grades` WHERE `student_id` LIKE CONCAT('%',?,'%') ;";
$stmt = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt,$searchmysql)) {
    header("Location:psearch.php?error=sqlerror");
    exit();
}
else{
    mysqli_stmt_bind_param($stmt,"s",$search);
    mysqli_stmt_execute($stmt);
    $searchresult = mysqli_stmt_get_result($stmt);
    $searchcheck = mysqli_num_rows($searchresult);
    if ($searchcheck > 0) {
        while ($row = mysqli_fetch_assoc($searchresult)) {
                $first = $row['subjectone'];
                $second = $row['subjecttwo'];
                $third = $row['subjectthree'];
                $fourth = $row['subjectfour'];
                $average = (($first+$second+$third+$fourth)/4);
        }
    }
    else{
        header("Location:slogin.php?error=nogrades");
        } 
}

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
            <a> Subject two: <?php echo $second?></a>
            <a> Subject three: <?php echo $third?></a>
            <a> Subject four: <?php echo $fourth?></a>
            <a> Average: <?php echo $average?></a>
        </div>
    </main>
</body>
</html>

<?php echo "<h2><a href='slogout.php'>Log out</a></h2>".' '."<h2><a href='Start.php'>Switch</a></h2>"; ?>