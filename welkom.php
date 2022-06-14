<?php
    session_start();
    if (!(isset($_SESSION['sessionid']) && $_SESSION['sessionid'] == session_id())) {
        header("location: index.php");
    } else {

        // overzicht van alle gebruikers
        include("sql.php");
        include("helpers.php");
        $msg = null;
        $users = getUsers($msg);
        var_dump($users);

        $html = getDivTableRows($users);




            //"<a href=\"page.php?id=" . $id . "\">dit is de link</a>";



        if(isset($_POST['logout'])) {
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
    <style>
        .user_container {
            display: table;
            border-collapse: collapse;
            width: 100%;
        }

        .user_container .row  {
            display: table-row;
        }

        .user_container .row:first-child  {
            font-weight: bold;
            border-bottom: 1px solid black;
        }

        .user_container .row:nth-child(even):not(:first-child)  {
            background-color: azure;
        }

        .user_container .row:nth-child(odd):not(:first-child)  {
            background-color: beige;
        }

        .user_container .row:hover:not(:first-child)  {
            background-color: bisque;
        }
        .user_container .row > .col {
            display: table-cell;
        }

        .user_container .row:not(:first-child) > .col:first-child {
            font-size: 0.5rem;
        }


    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <form method="post">
        <input type="submit" name="logout" value="logout">
    </form>
    <p>Welkom op deze pagina achter de login "wall"</p>
    <div class="user_container">
        <div class="row">
            <div class="col">edit</div>
            <div class="col">username</div>
            <div class="col">rol</div>
        </div>
        <!--<div class="row">
            <div class="col">id</div>
            <div class="col">username</div>
            <div class="col">rol</div>
        </div>
        <div class="row">
            <div class="col">id</div>
            <div class="col">username</div>
            <div class="col">rol</div>
        </div>
        <div class="row">
            <div class="col">id</div>
            <div class="col">username</div>
            <div class="col">rol</div>
        </div>
        <div class="row">
            <div class="col">id</div>
            <div class="col">username</div>
            <div class="col">rol</div>
        </div>-->
        <?=$html?>
    </div>




</body>
</html>
