<?php
$seriesid = $_GET['id'];
if(!isset($seriesid))
{
  header('location: ../View/index.php?error=No ID found');
}
else
{
  Include '../Model/getSeries.php';

  $series = GetSeriesByID($seriesid);
  $seriesArray = json_decode($series);
}
