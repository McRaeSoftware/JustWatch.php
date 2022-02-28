<?php
/*
    Description: Action to display a single movie record on its own page locate in the Movie file.

    Author: Oliver Dickens
 */
$seriesid = $_GET['id'];
if(!isset($seriesid))
{
  header('location: ../View/index.php?error=No ID found');
}
else
{
  Include '../Model/JustWatchMethods.php';

  $series = GetSeriesByID($seriesid);
  $seriesArray = json_decode($series);
}
