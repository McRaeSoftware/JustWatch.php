
<?php
Require '../Model/connection.php';
$dir    = 'EpisodesToBeAdded';
$files = scandir($dir);


// Check file name for Season and episodes
//add file to season folder


function formatFileNames($dir, $files)
{
  for ($i=0 ; $i < sizeof($files) ; $i++)
  {
    if($i > 1)
    {
      try
      {
        $chars = array(' ', '-');
        $newFileName = str_replace($chars, '.', $files[$i]);
        rename($dir.'/'.$files[$i], $dir.'/'.$newFileName);
      }
      catch(Exception $e)
      {
        echo $e;
      }
    }
  }
}

function RunInsert()
{
  // remove file extension
  for ($i=0 ; $i < sizeof($files) ; $i++)
  {
    if($i > 1)
    {
      try
      {
        $parts = explode(".", $files[$i]);
        for($j=0 ; $j < sizeof($parts) ; $j++)
        {
          if(preg_match('/^[0-9]{4}$/', $parts[$j]))
          {
            $year = $parts[$j];
            $parts[$j] = '';
          }
          if(preg_match('/(1080p|720p)/', $parts[$j]))
          {
            $quality = $parts[$j];
            $parts[$j] = '';
          }
          if(preg_match('/([S][0-9]{2})/', $parts[$j]))
          {
            $seasonNumber = $parts[$j];
            $parts[$j] = '';
          }
          if(preg_match('/([E][0-9]{2})/', $parts[$j]))
          {
            $episodeNumber = $parts[$j];
            $parts[$j] = '';
          }
        }
        $yearAndQuality = ".".$year.".".$quality;
        $endOfTitle = strpos($files[$i], $yearAndQuality);
        $titleWithDots = substr($files[$i], 0, $endOfTitle);
        $title = trim(str_replace('.', ' ', $titleWithDots));

        $extension = substr($files[$i], -4);
        $startOfExtension = strpos($files[$i], $extension);
        $endOfTitle + strlen($yearAndQuality);
        $newFileName = $titleWithDots.$yearAndQuality.$extension;

        // Check Series Exists and Get Series ID
        $check = $connection->prepare
        ("

        SELECT Series_ID, Series_Name, Year FROM Series WHERE Title = :title AND Year = :year

        ");

        $exists = $check->execute
        ([
          'title' => $title,
          'year' => $year
        ]);

        $existsCount = $check->rowCount();
        if($existsCount > 0)
        {
          $seriesID = $check[Series_ID];
          $seriesName = $check[Series_Name];
          echo "Series Exists";
          echo "Now inserting Episodes";
        }
        else
        {
          $IMDB = new IMDB($title, null, "episode");

          if($IMDB->getYear() != $year)
          {
            $IMDB = new IMDB($title." (".$year.")", null, "episode");
          }

          if($IMDB->isReady)
          {
            $description = $IMDB->getPlot();
            if(strtolower($description) == "n/a")
            {
              $description = $IMDB->getDescription();
            }
            $seriesName = $IMDB->getTitle();
          }
          else
          {
            $Error = "Something is Wrong with IMDB right now.";
            header('location: massMovieInsert.php?error='.$Error);
          }

          $video = "Series/".$season."/".$newFileName;

          /////////////////////////////////////////////////////////////////
            $episodeQuery = $connection->prepare
            ("

            INSERT INTO Episode (Title, Video_link, Image_link, Description, Genre, Year)
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
              echo $count."Rows effected"."</br>";
            }
            else
            {
              echo "Inserting".$title." Failed"."</br>";
            }

          $count = $query->rowCount();
          if($count > 0)
          {
            echo $title." Succesfully Inserted "."</br>";
          //  rename($dir.'/'.$files[$i], $movieFolder.$newFileName);
          //  rename($movieFolder.$newFileName, $video);
          }
          else
          {
            echo "Inserting -> ".$title." <- Failed".".</br>";
            echo $query->errorInfo()[2];
            echo "</br></br>";
          }
        }
      }
      catch(Exception $e)
      {
        echo "Something got busted up real bad... looks like this was an issue -> ".$e;
      }
    }

    $videoLink = "Series/".$files[$i];
    $image = "Series/Images/".$noExtension.".jpg";
    $description = "Awaiting Description";
    $genre = "TODO";

    $seriesName;


  ///////////////////////////////////////////////////
  } // end For
}

function InsertSeries($seriesName, $year = null, $quality)
{
  $seriesCheckQuery = $connection->prepare
  ("
    SELECT Series_ID FROM Series Where Series_Name = :seriesName
  ");

  $seriesCheckCount = $seriesCheckQuery->rowCount();
  if($seriesCheckCount > 0)
  {
    echo "Series Exists";
  }
  else
  {
    $seriesName = $IMDB->getTitle();
    $year = $IMDB->getYear();
    $genre = $IMDB->getGenre();
    $description = $IMDB->getPlot();
    if(strtolower($description) == "n/a")
    {
      $description = $IMDB->getDescription();
    }
    $img = $IMDB->getPoster($sSize = 'big', $bDownload = false);
    $runtime = $IMDB->getRuntime();
    $rating = $IMDB->getRating();
    $certification = $IMDB->getCertification();
    $cast = $IMDB->getCastAndCharacter($iLimit = 0);


    $seriesQuery = $connection->prepare
    ("
      INSERT INTO Series (Series_Name, Year, Genre, Description, Image_link, Runtime, Rating, Certification, Cast, Quality)
      Values (:imageLink, :seriesName, :description, :genre, :year, :runtime, :certification, :cast, :quality)
    ");

    $seriesSuccess = $seriesQuery->execute
    ([
      'imageLink' => $title,
      'seriesName' => $video,
      'description' => $image,
      'genre' => $description,
      'year' => $genre,
      'runtime' => $year,
      'rating' => $rating,
      'certification' => $certification,
      'cast' => $cast,
      'quality' => $quality
    ]);

    $seriesCount = $seriesQuery->rowCount();
    if($seriesCount > 0)
    {
      echo "Inserting -> ".$seriesName." Success </br>";
    }
    else
    {
      echo "Inserting".$seriesName." Failed"."</br>";
    }
  }
}

// TODO Finish this function
function InsertEpisodes($title, $year)
{
  // init IMDB class
  $IMDB = new IMDB($title, null, "episode");

  // if Year found is not equal to year we passed its not the correct match
  // so add year to search and make sure its the correct match
  if($IMDB->getYear() != $year)
  {
    $IMDB = new IMDB($title." (".$year.")", null, "episode");
  }

  // When correct matches are found Set Data
  if($IMDB->isReady)
  {
    // make sure series matches
    $seriesName = $IMDB->getTitle();

    // get plot, if plot N/A then get description instead.
    $description = $IMDB->getPlot();
    if(strtolower($description) == "n/a")
    {
      $description = $IMDB->getDescription();
    }
  }
  else
  {
    $Error = "Something is Wrong with IMDB right now.";
    header('location: massMovieInsert.php?error='.$Error);
  }

  // Set new Video path
  $video = "Series/".$season."/".$newFileName;

  // Prepare insert Query
  $episodeQuery = $connection->prepare
  ("

  INSERT INTO Episode (Title, Video_link, Image_link, Description, Genre, Year)
  VALUES (:title, :video, :image, :description, :genre, :year)

  ");

  // Bind Params to the insert query
  $success = $query->execute
  ([
    'title' => $title,
    'video' => $video,
    'image' => $image,
    'description' => $description,
    'genre' => $genre,
    'year' => $year
  ]);

  // Get Rows effected
  $count = $query->rowCount();
  if($count > 0)
  {
    echo "Episode ->".$episodeName."Insert Success </br>";
  }
  else
  {
    echo "Episode ->".$episodeName." Insert Failed </br>";
  }
}
?>
