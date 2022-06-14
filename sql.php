<?php

// lees de ini file met inloggegevens
$filepath = (dirname(__DIR__) . "\settings.ini");
$login_data = parse_ini_file($filepath);




//var_dump($login_data);


function trycatch_example() {
    try {
        // je code die eventueel fout kan gaan
    }
    catch (Exception $e) {
        // wat als er fouten ontstaan
    }
    finally {
         // dit wordt altijd nog even uitgevoerd
    }
}


function getSQLConnection() : mysqli {
    global $login_data; // lees de var met inlog gegevens
    static $conn;
    $result = null;
    try {
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        if(!isset($conn)) {
            /*$conn = new mysqli("localhost",
                "systemx_user",
                "Pa1XYab/T9xb!Dm",
                "systemx");*/
            $conn = new mysqli(
                $login_data['server'],
                $login_data['user'],
                $login_data['password'],
                $login_data['database']
            );
        }
        $result = $conn;
    }
    catch (Exception $e) {
        echo $e->getMessage();
    }
    return $result;
}

function addUser($username,$password,&$message) : bool {
    $result = false;
    try {
        $sql = "INSERT INTO `user` (`id`, `username`, `password`, `rol`) VALUES (NULL, ?, ?, 'admin');";
        $conn = getSQLConnection();
        $stmt = $conn->prepare($sql);
        $username = htmlspecialchars($username);
        $password = password_hash($password,PASSWORD_DEFAULT);
        $stmt->bind_param("ss",$username,$password);
        if($stmt->execute()) {
            $result = true;
        }
    }
    catch (Exception $e) {
        $result = false;
        $message = $e;
    }
    return $result;
}

function updateUser($id,$username,$rol,&$message) : bool {
    $result = false;
    try {
        $sql = "UPDATE `user` SET `username` = ?, `rol` = ? WHERE `id`=?";
        $conn = getSQLConnection();
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssi",$username,$rol,$id);
        if($stmt->execute()) {
            $result = true;
        }
    }
    catch (Exception $e) {
        $result = false;
        $message = $e;
    }
    return $result;
}

function getUser(int $id,string &$message) : array {
    $result = null;
    try {
        $sql = "SELECT `id`,`username`,`rol` FROM `user` WHERE `id` =?";
        $conn = getSQLConnection();
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i",$id);
        if($stmt->execute()) {
            $r = $stmt->get_result();
            $users = [];
            while($obj = $r->fetch_object()) {
                array_push($users,$obj);
            }
            $result = $users;
        }
    }
    catch (Exception $e) {
        $result = false;
        $message = $e;
    }
    return $result;
}




function getUsers(&$message) : array {
    $result = null;
    try {
        $sql = "SELECT `id`,`username`,`rol` FROM `user`";
        $conn = getSQLConnection();
        $stmt = $conn->prepare($sql);
        if($stmt->execute()) {
            $r = $stmt->get_result();
            $users = [];
            while($obj = $r->fetch_object()) {
                array_push($users,$obj);
            }
            $result = $users;
        }
    }
    catch (Exception $e) {
        $result = false;
        $message = $e;
    } return $result;
}






function loginUser($username, $password) : bool {
    $result = false;
    try {
        $sql = "SELECT `username`,`password` FROM `user` WHERE `username` = ? LIMIT 1;";
        $conn = getSQLConnection();
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s",$username);
        if($stmt->execute()) {
            $stmt->store_result();
            $stmt->bind_result($u,$p);
            if($stmt->num_rows>0) {
                while($stmt->fetch()) {
                    // password correct
                    if(password_verify($password,$p)) {
                        $result = true;
                    }
                    break;
                }
            }
        }
    }
    catch (Exception $e) {

    }
    return $result;
}