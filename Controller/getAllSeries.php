<?php
/*
    Description: Action to get all series from the database.

    Author: David McRae
 */


Include '../Model/JustWatchMethods.php';

if(!isset($_GET['page']))
{
  $page = 1;
}
else
{
  $page = $_GET['page'];
}

$series = GetAllSeries($page);
$seriesArray = json_decode($series);
?>
