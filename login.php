<?php
require("sql.php");
$melding = null;
if(isset($_POST['submit'])) {
    session_start();
    $user = $_POST['username'];
    $pw = $_POST['password'];
    if(loginUser($user,$pw)) {
        $_SESSION['sessionid'] = session_id();
        header("location: welkom.php");
    } else {
        // doe even niks
        $melding = "<div>Verkeerde inloggegevens</div>";
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Inloggen Account</title>
</head>
<body>
<p>Inloggen</p>
<?=$melding?>
<form method="post">
    <input type="text" name="username" placeholder="enter username">
    <input type="password" name="password" placeholder="enter password">
    <input type="submit" name="submit" value="Login">
</form>
</body>
</html>

