<?php
// Attempt to update a movies details
function AttemptUpdateMovie()
{
  Require 'connection.php';
  // Checks if submit button has been pressed
  if (isset($_POST['updateMovieSubmit']))
  {
    $movieid = (filter_input(INPUT_POST, 'index', FILTER_SANITIZE_STRING));

    // Once complete carry out the INSERT statement to database
    $title = (filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING));
    $video = (filter_input(INPUT_POST, 'video', FILTER_SANITIZE_STRING));
    $image = (filter_input(INPUT_POST, 'image', FILTER_SANITIZE_STRING));
    $description = (filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING));
    $genre = (filter_input(INPUT_POST, 'genre', FILTER_SANITIZE_STRING));
    $year = (filter_input(INPUT_POST, 'year', FILTER_SANITIZE_STRING));

    $query = $connection->prepare
    ("

    UPDATE Movie SET
    Title = :title,
    Video_link = :video,
    Image_link = :image,
    Description =:description,
    Genre = :genre,
    Year = :year
    WHERE Movie_ID = ".$movieid."

    ");

    $success = $query->execute
    ([
      'title' => $title,
      'video' => $video,
      'image' => $image,
      'description' => $description,
      'genre' => $genre,
      'year' => $year
    ]);

    $count = $query->rowCount();
    if($count > 0)
    {
      $validError = "Success";
      header('location: ../View/updateMovies.php?error='.$validError);
    }
    else
    {
      $invalidError = "Insert Failed";
      header('location: ../View/updateMovies.php?error='.$invalidError);
    }
  }
}
?>
