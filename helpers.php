<?php


// data dit of dat...
$myvar = null;

/***
 * Build a html table string from incoming data
 * @param array $data
 * @return string
 */
function getDivTableRows(array $data) : string {
    $result = null;
    $r = [];
    foreach ($data as $row) {
        array_push($r,'<div class="row">');
        foreach($row as $key=>$value) {
            if($key=="id") {
                array_push($r,sprintf('<div class="col"><a href="edit_user.php?id=%s"><i class="fa fa-pencil" aria-hidden="true"></i></a></div>',$value));
            } else {
                array_push($r,sprintf('<div class="col">%s</div>',$value));
            }

        }
        array_push($r,'</div>');
    }
    $result = implode("",$r);
    return (string)$result;
}

/**
 * Bouw een formulier op basis van een binnenkomende gebruikers object
 * @param array $data
 * @return string
 */
function getUpdateUserForm(array $data) : string {
    $keys = get_object_vars($data[0]);
    $result = null;
    $r = [];
    array_push($r,"<form method=\"post\">");
    foreach($keys as $key=>$value) {
        if($key=="id") {
            array_push($r,"<input type=\"hidden\" name=\"$key\" value=\"$value\">");
        } else {
            array_push($r,"<input type=\"text\" name=\"$key\" value=\"$value\">");
        }

    }
    array_push($r,"<input type=\"submit\" name=\"submit\" value=\"verstuur\">");
    array_push($r,"</form>");
    $result = implode("",$r);
    return (string)$result;
}

/**
 * Uitleg..
 * @param array $a
 * @return bool
 * Created by: pietje
 * d.d. 2022-06-01
 */
function test(array $a) : bool {
    $t=null;
    return $t;
}