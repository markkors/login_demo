<?php
var_dump($_POST);


session_start();
if (!(isset($_SESSION['sessionid']) && $_SESSION['sessionid'] == session_id())) {
    header("location: index.php");
} else {
    include ("sql.php");
    include ("helpers.php");

    if(isset($_POST['submit'])) {
        // update met de ingestuurd postdata
        updateUser();
        header("terug naar de welkom pagina");
    }

    $msg = (string)null;
    $u = getUser(htmlspecialchars($_GET['id']),$msg);

    $html_updateform = getUpdateUserForm($u);


}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit User</title>
</head>
<body>
    <div id="update_container">
       <!-- <form method="post">
            <input type="hidden" name="id" value="">
            <input type="text" name="username" value="">
            <input type="text" name="rol" value="">
            <input type="submit" name="submit" value="verstuur">
        </form>-->
        <?=$html_updateform?>
    </div>

</body>
</html>
