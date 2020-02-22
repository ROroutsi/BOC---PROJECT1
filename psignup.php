<?php if (isset($_GET['error'])) {
    if ($_GET['error']=="passwordnotmatching") { ?>
        <p class="error">Passwords are not matching, try again!</p>
    <?php } elseif ($_GET['error']=="usertaken") { ?>
        <p class="error">User already exists!</p>
    <?php }; 
}?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/form.css">
    <title>Sign up Professor</title>
</head>
<body>
    <div class="container">
        <div class="form">
            <h2>Sign up Professor!</h2>
            <form method="post" action="pindex.php">
            <input type="text" name="pname" placeholder="Name" required>
            <input type="text" name="plastname" placeholder="Lastname" required>
            <input type="email" name="pemail" placeholder="Email" required>
            <input type="text" name="ppassword" placeholder="Password" required>
            <input type="text" name="prpassword" placeholder="Repeat password" required>
            <input type="submit" value="Sign Up" name="submit">
            </form>
        </div>
    </div>
</body>
</html>

<?php 
echo '<h2><a href="plogin.php"> Log in </a> </h2>';
?>