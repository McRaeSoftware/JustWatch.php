<?php
Include '../Model/JustWatchMethods.php';
$movies = GetMoviesByFilter($movieFilter);
$movieArray = json_decode($movies);
?>
