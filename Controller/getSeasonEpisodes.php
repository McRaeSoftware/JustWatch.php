<?php
/*
    Description: Find each season of a series
    Author: David McRae
 */

if(!isset($_GET['id']) || !isset($_GET['S']))
{
  header('location: ../View/index.php?error=Cant get Episodes');
}
else
{
  $seriesId = $_GET['id'];
  $seasonId = $_GET['S'];

  Include '../Model/JustWatchMethods.php';

  $series = GetSeasonEpisodes($seriesId, $seasonId);
  $seriesArray = json_decode($series);
}
