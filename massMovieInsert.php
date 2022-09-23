
<?php
Require 'Model/connection.php';
include 'imdb/imdb.class.php';

$dir = 'MoviesToBeAdded';
$files = scandir($dir);
$permissionAccess = "0777";
$movieFolder = "/media/pi/server.pii.at/Site/JustWatchphp/View/Movies/";
$year = "";
$quality = "";

if(isset($_GET["error"]))
{
  echo $_GET["error"];
}
else
{
  for ($i=0 ; $i < sizeof($files) ; $i++)
  {
    if($i > 1)
    {
      try
      {
        // Movie file must contain year and quality to begin inserting.
        if(preg_match('/[0-9]{4}[.| ](1080p|720p|2160p)/', $files[$i]))
        {
          str_replace(' ', '.', $files[$i]);
          $parts = explode(".", $files[$i]);

          // Use This line to remove specific words from the file names
          $parts = array_diff($parts, ["EXTENDED", UNRATED]);

          for($j=0 ; $j < sizeof($parts) ; $j++)
          {

              if(preg_match('/^[0-9]{4}$/', $parts[$j]))
              {
                $year = $parts[$j];
                $parts[$j] = '';
              }
              if(preg_match('/(1080p|720p|2160p)/', $parts[$j]))
              {
                $quality = $parts[$j];
                $parts[$j] = '';
              }
          }

          $yearAndQuality = ".".$year.".".$quality;
          $endOfTitle = strpos($files[$i], $yearAndQuality);
          $titleWithDots = substr($files[$i], 0, $endOfTitle);
          $title = trim(str_replace('.', ' ', $titleWithDots));
          $titleNoSpaces = trim(str_replace('.', '', $titleWithDots));

          $extension = substr($files[$i], -4);
          $startOfExtension = strpos($files[$i], $extension);
          $endOfTitle + strlen($yearAndQuality);
          $newFileName = $titleWithDots.$yearAndQuality.$extension;

          $video = "Movies/".$titleNoSpaces.'/'.$newFileName;

          if($title == "")
          {
            echo "</br> Error with Movie Title -> ".$files[$i]."</br>";
          }
          else
          {
            // IF file is an SRT file rename and move file.
            if(strtolower($extension) == ".srt" || strtolower($extension) == ".vtt")
            {
              if(!file_exists($movieFolder."/".$titleNoSpaces."/"))
              {
                mkdir($movieFolder."/".$titleNoSpaces."/", $permissionAccess);
              }

              rename($dir.'/'.$files[$i], $movieFolder."/".$titleNoSpaces."/".$newFileName);
              rename($movieFolder."/".$titleNoSpaces."/".$newFileName, $video);
              echo "Succesfully Moved ".$extension." file for ".$title."</br>";
            }
            else // file is an MP4 or MKV, Insert to database then move and rename
            {
              $check = $connection->prepare
              ("

              SELECT Title, Year FROM Movie WHERE Title = :title AND Year = :year

              ");

              $exists = $check->execute
              ([
                'title' => $title,
                'year' => $year
              ]);

              $existsCount = $check->rowCount();
              if($existsCount > 0)
              {
                echo "</br>".$title." ".$year." -> Already Exists"."</br>";
              }
              else
              {

                $IMDB = new IMDB($title, null, "movie");

                if($IMDB->getYear() != $year)
                {
                  $IMDB = new IMDB($title." (".$year.")", null, "movie");
                }

                // Movie still not found, try with just year and title.
                if(!$IMDB->isReady)
                {
                  $IMDB = new IMDB($title." (".$year.")");
                }

                if($IMDB->isReady)
                {
                    $description = $IMDB->getPlot();
                    if(strtolower($description) == "n/a" || empty($description) || is_null(£description))
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
                  //$Error = "Something is Wrong with IMDB right now.";
                  //header('location: massMovieInsert.php?error='.$Error);
                  echo "IMDB has an issue with -> ".$title."</br>";
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
                  echo $title." <-------- Succesfully Inserted "."</br>";

                  if(!file_exists($movieFolder."/".$titleNoSpaces."/"))
                  {
                    mkdir($movieFolder."/".$titleNoSpaces."/", $permissionAccess);
                  }

                  rename($dir.'/'.$files[$i], $movieFolder."/".$titleNoSpaces."/".$newFileName);
                  rename($movieFolder."/".$titleNoSpaces."/".$newFileName, $video);

                  // video = Movies/AnExtremelyGoofyMovie/An.Extremely.Goofy.Movie.2000.1080p.mp4
                }
                else
                {
                  echo "</br></br>";
                  echo "Inserting -> ".$title." <- Failed".".</br>";
                  echo $query->errorInfo()[2];
                  echo "</br></br>";
                }
              }
            }
          }
        }
        else
        {
          echo "The file is missing Year and quality";
        }
      }
      catch(Exception $e)
      {
        echo "Something got busted up real bad... looks like this was an issue -> ".$e;
      }
    }
  }
}
?>
