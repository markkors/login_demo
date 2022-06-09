<?php

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
    static $conn;
    $result = null;
    try {
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        if(!isset($conn)) {
            $conn = new mysqli("localhost",
                "systemx_user",
                "Pa1XYab/T9xb!Dm",
                "systemx");
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

function updateUser($id,$new,&$message) : bool {
    $result = false;
    try {
        $sql = "UPDATE `user` SET `username` = ? WHERE `id`=?";
        $conn = getSQLConnection();
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si",$new,$id);
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

function login($username,$password) : bool {
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