<?php
  Include '../Model/getMoviesByTitle.php';
  $movieTitle = $_GET['filterByTitle'];
  $movies = GetMoviesByTitle($movieTitle);
  $movieArray = json_decode($movies);
?>
