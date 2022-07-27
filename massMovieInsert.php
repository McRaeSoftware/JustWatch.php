
<?php
Require '../Model/connection.php';
$dir    = 'ToBeAdded';
$files = scandir($dir);

// remove file extension
for ($i=0 ; $i < sizeof($files) ; $i++)
{
  include_once 'imdb/imdb.class.php';

  // Remove last 4 characters e.g. file extension -> "Bloodshot_2020.mp4" = "Bloodshot_2020"
  $noExtension = substr($files[$i], 0, -4);
  // Find everything before the first "_" -> "Bloodshot_2020.mp4" = "Bloodshot"
  $titleNoSpaces = strtok($files[$i], '_');
  //Insert a " " before all Uppercase letters Ignoring the first one  ->  "LordOfTheRings" = "Lord Of The Rings"
  $title = preg_replace('/(?<! )(?<!^)[A-Z]/',' $0', $titleNoSpaces);

  //get the info inbetween the "_" and the "." -> "bloodshot_2020.mp4" = "2020"
  //$year = trim(strrev(strstr(strrev((strstr($files[$i], '_'))), '.')), '_.');

  $quality = "";

  // TODO:
  // Might need to build an array for the imdb data found here
  $IMDB = new IMDB($title);

  if($IMDB->isReady)
  {
      $year = $IMDB->getYear();
      $description = $IMDB->getDescription();
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
    $invalidError = "Insert Failed: Movie not found.";
    header('location: ../View/insertMovie.php?error='.$invalidError);
  }

  $video = "Movies/".$files[$i];
  //$image = "Movies/Images/".$noExtension.".jpg";

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
    echo $count."Rows effected"."</br>";
  }
  else
  {
    echo "Inserting".$title." Failed"."</br>";
  }

 }
?>
