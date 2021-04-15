<?php

class access
{
    function loggedIn(){
        if (isset($_SESSION["loggedIn"])) {
            return true;
        }
        return false;
    }

    function inactivityDestroy():bool{
        if (isset($_SESSION["login_time_stamp"])) {
            if (time() - $_SESSION["login_time_stamp"] > 15) {
                session_unset();
                session_destroy();
                header("Location: ../index.php");
                return true;
            }
        }
        return false;
    }

    function inactivityDestroyDiff():bool{
        if (isset($_SESSION["login_time_stamp"])) {
            if (time() - $_SESSION["login_time_stamp"] > (90* 60 /10 *10000)) {
                session_unset();
                session_destroy();
                return true;
            }
        }
        return false;
    }
}

?>