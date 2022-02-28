<?php
/*
    Description: Action to display a single movie record on its own page locate in the Movie file.

    Author: David McRae
 */
$movieid = $_GET['id'];
if(!isset($movieid))
{
  header('location: ../View/index.php?error=No ID found');
}
else
{
  Include '../Model/JustWatchMethods.php';

  $movie = GetMovieByID($movieid);
  $movieArray = json_decode($movie);
}
