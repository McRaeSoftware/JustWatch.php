<?php
/*
    Description: action to logout the user.
    used to destroy all sessions.

    Author: David McRae
*/
include '../Model/logout.php';

session_start();
AttemptLogOut();
?>
