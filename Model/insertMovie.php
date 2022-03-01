<?php
//Insert new Movie to database
function AttemptInsertMovie()
{
  Require 'connection.php';

  // Checks if submit button has been pressed
  if (isset($_POST['insertMovieSubmit']))
  {
    $title = (filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING));
    $video = (filter_input(INPUT_POST, 'video', FILTER_SANITIZE_STRING));
    $image = (filter_input(INPUT_POST, 'image', FILTER_SANITIZE_STRING));
    $description = (filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING));
    $genre = (filter_input(INPUT_POST, 'genre', FILTER_SANITIZE_STRING));
    $year = (filter_input(INPUT_POST, 'year',FILTER_SANITIZE_STRING ));

    $query = $connection->prepare
    ("

    INSERT INTO Movie (Title, Video_link, Image_link, Description, Genre, Year)
    VALUES (:title, :video, :image, :description, :genre, :year)

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
      header('location: ../View/insertMovie.php?error='.$validError);
    }
    else
    {
      $invalidError = "Insert Failed";
      header('location: ../View/insertMovie.php?error='.$invalidError);
    }
  }
}
?>
