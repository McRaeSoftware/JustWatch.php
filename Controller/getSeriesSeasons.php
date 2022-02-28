<?php
/*
    Description: Find each season of a series
    Author: David McRae
 */

if(!isset($_GET['id']))
{
  header('location: ../View/index.php?error=No ID found');
}
else
{
  $seriesid = $_GET['id'];

  Include '../Model/JustWatchMethods.php';

  $series = GetSeriesSeasons($seriesid);
  $seriesArray = json_decode($series);
}
