<?php
//Insert new Movie to database
function AttemptInsertMovie()
{
  Require 'connection.php';

  // Checks if submit button has been pressed
  if (isset($_POST['insertMovieSubmit']))
  {
    include_once '../imdb/imdb.class.php';

    $title = (filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING));
    $year = (filter_input(INPUT_POST, 'year',FILTER_SANITIZE_STRING ));
    $description = (filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING));
    $genre = (filter_input(INPUT_POST, 'genre', FILTER_SANITIZE_STRING));
    $rating = (filter_input(INPUT_POST, 'rating', FILTER_SANITIZE_STRING));
    $certification = (filter_input(INPUT_POST, 'certification', FILTER_SANITIZE_STRING));
    $runtime = (filter_input(INPUT_POST, 'runtime', FILTER_SANITIZE_STRING));
    $image = (filter_input(INPUT_POST, 'image', FILTER_SANITIZE_STRING));
    $video = (filter_input(INPUT_POST, 'video', FILTER_SANITIZE_STRING));
    $director = (filter_input(INPUT_POST, 'director', FILTER_SANITIZE_STRING));
    $cast = (filter_input(INPUT_POST, 'certification', FILTER_SANITIZE_STRING));
    $quality = (filter_input(INPUT_POST, 'quality', FILTER_SANITIZE_STRING));

    $IMDB = new IMDB($title);

    if($IMDB->isReady)
    {
      if(empty($year))
      {
        $year = $IMDB->getYear();
      }
      if(empty($description))
      {
        $description = $IMDB->getPlot();
      }
      if(empty($genre))
      {
        $genre = $IMDB->getGenre();
      }
      if(empty($rating))
      {
        $rating = $IMDB->getRating();
      }
      if(empty($certification))
      {
        $certification = $IMDB->getCertification();
      }
      if(empty($runtime))
      {
        $runtime = $IMDB->getRuntime();
      }
      if(empty($image))
      {
        $image = $IMDB->getPoster($sSize = 'big', $bDownload = false).jpg;
      }
      if(empty($director))
      {
        $director = $IMDB->getDirector();
      }
      if(empty($cast))
      {
        $cast = $IMDB->getCastAndCharacter($iLimit = 0);
      }
    }
    else
    {
      $invalidError = "Insert Failed: Movie not found.";
      header('location: ../View/insertMovie.php?error='.$invalidError);
    }


    $query = $connection->prepare
    ("

    INSERT INTO Movie (Title, Year, Description, Genre, Rating, Certification, Runtime, Image_link, Video_link, Director, Cast, Quality)
    VALUES (:title, :year, :description, :genre, :rating, :certification, :runtime, :image, :video, :director, :cast, :quality)

    ");

    $success = $query->execute
    ([
      'title' => $title,
      'year' => $year,
      'description' => $description,
      'genre' => $genre,
      'rating' => $rating,
      'certification' => $certification,
      'runtime' => $runtime,
      'image' => $image,
      'video' => $video,
      'director' => $director,
      'cast' => $cast,
      'quality' => $quality
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
