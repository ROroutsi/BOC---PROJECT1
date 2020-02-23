<?php

if (isset($_GET['success'])) {
    if ($_GET['success']=="signedup") {
          echo "<h2>Successfully signed up!</h2>";
    }; 
 };

?>     

<?php if (isset($_GET['error'])) {
    if ($_GET['error']=="wrongpassword") { ?>
        <p class="error">Wrong password, try again!</p>
    <?php } elseif ($_GET['error']=="wrongemail") { ?>
        <p class="error">Wrong email, try again!</p>
    <?php } elseif ($_GET['error']=="pnotloggedin") { ?>
        <p class="error">You are not logged in!</p>
    <?php } elseif ($_GET['error']=="userdoesnotexist") { ?>
        <p class="error">User does not exist!</p>        
    <?php }; 
}?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/form.css">
    <title>Login Professor</title>
</head>
<body>
    <div class="container">
       
        <div class="form">
            <h2>Login Professor!</h2>
            <form method="post" action="pindex2.php">
            <input type="email" name="pemail" placeholder="Email" required>
            <input type="text" name="ppassword" placeholder="Password" required>
            <input type="submit" value="Log In" name="submit">
            </form>
        </div>
    </div>
</body>
</html>

<?php echo '<h2><a href="psignup.php">Sign up</a> or <a href="Start.php">Switch</a></h2>'; ?>