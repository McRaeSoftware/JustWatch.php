<?php
/*
    Description: Action to get all movies from the database.

    Author: David McRae
 */


Include '../Model/getAllMoviesRecentlyAdded.php';

if(!isset($_GET['page']))
{
  $page = 1;
}
else
{
  $page = $_GET['page'];
}

$movies = GetAllMoviesRecentlyAdded($page);
$movieArray = json_decode($movies);
?>
