<?php
/*
  Description: Action to display movies in last 30 days

*/
$date_added = $_GET['date_added'];
if(!isset($date_added))
{
  header('location: ../View/index.php?error=No ID found');
}
else
{
  Include '../Model/getMovieByDateAdded.php';

  // $movie = GetMovieByID($movieid);
  $date_added = getMovieByDateAdded($date_added);
  $movieArray = json_decode($movie);
}
