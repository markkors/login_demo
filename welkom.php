<?php
    session_start();
    if (!(isset($_SESSION['sessionid']) && $_SESSION['sessionid'] == session_id())) {
        header("location: index.php");
    } else {
        if(isset($_POST['submit'])) {
            // logout

            // Unset all of the session variables.
            $_SESSION = [];

            // If it's desired to kill the session, also delete the session cookie.
            // Note: This will destroy the session, and not just the session data!
            if (ini_get("session.use_cookies")) {
                $params = session_get_cookie_params();
                setcookie(session_name(), '', time() - 42000,
                    $params["path"], $params["domain"],
                    $params["secure"], $params["httponly"]
                );
            }
            // Finally, destroy the session.
            session_destroy();
            // En terug naar de hoofdpagina
            header("location: index.php");
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
    <title>Welkom</title>
</head>
<body>
    <p>Welkom op deze geheime pagina</p>
    <form method="post">
        <input type="submit" name="submit" value="logout">
    </form>
</body>
</html>
