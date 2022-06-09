<?php
require("sql.php");

if(isset($_POST['submit'])) {
   $msg = null;
    // account aanmaken
      if(addUser($_POST['username'],$_POST['password'],$msg)) {
       header("location: login.php");
    } else {
        // user niet toegevoegd
        var_dump($msg);
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
    <title>Create Account</title>
</head>
<body>
<p>Aanmaken account</p>
<form method="post">
    <input type="text" name="username" placeholder="enter username">
    <input type="password" name="password" placeholder="enter password">
    <input type="submit" name="submit" value="submit">
</form>
</body>
</html>
