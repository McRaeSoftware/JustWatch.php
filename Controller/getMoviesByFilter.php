<?php
  Include '../Model/GetMoviesByFilter.php';
  $movies = GetMoviesByFilter($movieFilter);
  $movieArray = json_decode($movies);
?>
