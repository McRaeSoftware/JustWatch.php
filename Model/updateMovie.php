<?php
// Attempt to update a movies details
function AttemptUpdateMovie()
{
  Require 'connection.php';
  // Checks if submit button has been pressed
  if (isset($_POST['updateMovieSubmit']))
  {
    $movieid = (filter_input(INPUT_POST, 'index', FILTER_SANITIZE_STRING));
    $imdbID = (filter_input(INPUT_POST, 'imdbID', FILTER_SANITIZE_STRING));
    $title = (filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING));
    $video = (filter_input(INPUT_POST, 'video', FILTER_SANITIZE_STRING));
    $image = (filter_input(INPUT_POST, 'image', FILTER_SANITIZE_STRING));
    $description = (filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING));
    $genre = (filter_input(INPUT_POST, 'genre', FILTER_SANITIZE_STRING));
    $year = (filter_input(INPUT_POST, 'year', FILTER_SANITIZE_STRING));

    if(isset($imdbID))
    {
      include '../imdb/imdb.class.php';

      $IMDB = new IMDB($imdbID);

      if($IMDB->isReady)
      {
          $description = $IMDB->getPlot();
          if(strtolower($description) == "n/a" || empty($description) || is_null($description))
          {
            $description = $IMDB->getDescription();
          }
          $genre = $IMDB->getGenre();
          $rating = $IMDB->getRating();
          $certification = $IMDB->getCertification();
          $runtime = $IMDB->getRuntime();
          $image = $IMDB->getPoster($sSize = 'big', $bDownload = false);
          $director = $IMDB->getDirector();
          $cast = $IMDB->getCastAndCharacter($iLimit = 0);
      }
      else
      {
        $invalidError = "IMDB Cannot Find ID";
        header('location: ../View/updateMovies.php?error='.$invalidError);
      }
      $query = $connection->prepare
      ("

      UPDATE Movie SET (Title, Year, Description, Genre, Rating, Certification, Runtime, Image_link, Video_link, Director, Cast, Quality)
      VALUES (:title, :year, :description, :genre, :rating, :certification, :runtime, :image, :video, :director, :cast, :quality)
      WHERE Movie_ID = ".$movieid."

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
        header('location: ../View/updateMovies.php?error='.$validError);
      }
      else
      {
        //echo $query->errorInfo()[2];
        $invalidError = "Insert Failed";
        header('location: ../View/updateMovies.php?error='.$invalidError);
      }
    }
    else
    {
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
}
?>
