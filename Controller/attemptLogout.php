<?php
/*
    Description: action to logout the user.
    used to destroy all sessions.

    Author: David McRae
*/
include 'UserController.php';

session_start();
$response = Logout();
header('location: ../View/login.php?msg='.$response->message);
?>
