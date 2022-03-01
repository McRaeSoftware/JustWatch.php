<?php
/*
  Description: Action to display a single movie

  Author: David McRae
*/
$movieid = $_GET['id'];
if(!isset($movieid))
{
  header('location: ../View/index.php?error=No ID found');
}
else
{
  Include '../Model/getMovieByID.php';

  $movie = GetMovieByID($movieid);
  $movieArray = json_decode($movie);
}
