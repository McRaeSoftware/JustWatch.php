<?php
/*
    Description: Action to display a single episode

    Author: David McRae
 */
$seriesId = $_GET['id'];
$seasonId = $_GET['S'];
$episodeId = $_GET['E'];

if(!isset($seriesId) || !isset($seasonId) || !isset($episodeId))
{
  header('location: ../View/index.php?error=No Episode Found');
}
else
{
  Include '../Model/getEpisode.php';

  $series = GetEpisode($seriesId, $seasonId, $episodeId);
  $seriesArray = json_decode($series);
}
