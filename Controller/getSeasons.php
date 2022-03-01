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

  Include '../Model/getSeasons.php';

  $series = GetSeasons($seriesid);
  $seriesArray = json_decode($series);
}
