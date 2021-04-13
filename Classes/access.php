<?php
session_start();
function loggedIn(){
    if (isset($_SESSION["loggedIn"])) {
        $flag = $_SESSION["loggedIn"];
        if ($_SESSION["loggedIn"] === $flag) {
            return true;
        }
    }
    return false;
}
?>