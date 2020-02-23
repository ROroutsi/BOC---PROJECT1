<?php
session_start();
if (!isset($_SESSION["plogin"])) {
    header("Location:plogin.php?error=pnotloggedin");
};
if (isset($_GET['success'])) {
    if($_GET['success']=="loggedin") {
        echo "<h2>Successfully logged in!</h2>";
     }
    else if ($_GET['success']=="gradespassed") {
        echo "<h2>Grades successfuly updated!</h2>";    
     }; 
};     
?>
<?php if (isset($_GET['error'])) {
    if ($_GET['error']=="doesnotexist") { ?>
        <p class="error">Student does not exist, try again!</p>
    <?php }; }?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/form.css">
    <title>Search Student</title>
</head>
<body>
    <div class="container">
        <div class="form">
            <h2>Search Student!</h2>
            <form method="POST" action="psearchindex.php">
            <input type="text" name="sname" placeholder="Student Name" required>
            <input type="text" name="slastname" placeholder="Student Lastname" required>
            <input type="submit" name="search" value="Search">
            </form>
        </div>
    </div>
</body>
</html>

<?php 
if (isset($_SESSION["plogin"])) {
    echo '<h2><a href="plogout.php">Log out</a> or <a href="Start.php">Switch</a></h2>';
};
?>