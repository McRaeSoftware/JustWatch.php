<?php
include_once 'imdb/imdb.class.php';
//$baseURL = "https://www.imdb.com/search/title/?";

// $type = "tv";
// $year = "";
// $title = "snowpiercer";

//https://www.imdb.com/search/title/?title=snowpiercer&release_date=2013-01-01,2013-12-31&title_type=feature

// function searchParameters($baseURL, $title, $releaseDate = null, $type = null)
// {
//   if($releaseDate != null)
//   {
//     $releaseDate = "&release_date=".$releaseDate."-01-01,".$releaseDate."-12-31";
//   }
//
//   if($type != null)
//   {
//     if($type == "movie")
//     {
//       $type = "&title_type=feature";
//     }
//     if ($type == "series")
//     {
//       $type = "&title_type=tv_series";
//     }
//   }
//
//   $title = "title=".$title;
//   return $searchCriteria = $type;
// };

// 'movie',
// 'tv',
// 'episode',
// 'game',
// 'documentary',
// 'all', default

//$searchCriteria = searchParameters($baseURL, $title, $year, $type);

//testDirSearch();
echo "</br></br>";
echo "</br></br>";

//moveAllFiles("/media/pi/server.pii.at/Site/JustWatchphp/View/Movies/");

function moveAllFiles($dir)
{
  $takeFrom = "/media/pi/server.pii.at/Site/JustWatchphp/View/Movies";
  $moveTo = "/media/pi/server.pii.at/Site/JustWatchphp/MoviesToBeAdded/";
  $array = array_diff(scandir($dir), array('.', '..'));

  foreach ($array as &$item)
  {
    $item = $dir . $item;
  }
  unset($item);
  foreach ($array as $item)
  {
    if (is_dir($item))
    {
     $array = array_merge($array, moveAllFiles($item . DIRECTORY_SEPARATOR));
    }
  }

  foreach ($array as $item)
  {
    $filename = explode("/",$item);
    rename($item, $moveTo.'/'.end($filename));
  }
  return $array;
}

function testDirSearch()
{
  $takeFrom = "/media/pi/server.pii.at/Site/JustWatchphp/View/Movies";
  $moveTo = "/media/pi/server.pii.at/Site/JustWatchphp/MoviesToBeAdded/";
  $folders = scandir($takeFrom);
  echo "</br></br>";
  var_dump($folders);
  echo "</br></br>";
  $folders = array_diff(scandir($takeFrom), array('.', '..'));
  foreach($folders as $folder)
  {
    $files = scandir($folder);
    echo "</br></br>";
    var_dump($files);
    echo "</br></br>";
    foreach($files as $file)
    {
      echo "</br>".$file."</br>";
    }
  }
    //rename($takeFrom.'/*.mp4 *.srt *.vtt', $moveTo.'/'.$file);
}

function testExtended()
{
  $array = array("yer", "da", "sells", "EXTENDED", "Avon");
  echo "</br></br>";
  var_dump($array);
  $array = array_diff($array, ["EXTENDED"]);
  echo "</br></br>";
  var_dump($array);
}


function testIMDB()
{
  $title = "Goofy Movie";
  $searchFor = "movie";
  $year = "2000";

  $IMDB = new IMDB($title, null, $searchFor);

  if($IMDB->getYear() != $year)
  {
   $IMDB = new IMDB($title." (".$year.")", null, $searchFor);
  }

  if($IMDB->isReady)
  {
    // SERIES //
    // Series_ID

    // Series_Name
    echo ($IMDB->getTitle());
    echo "</br>";	echo "</br>";
    // Year
    echo ($IMDB->getYear());
    echo "</br>";	echo "</br>";
    // Genre
    echo ($IMDB->getGenre());
    echo "</br>";	echo "</br>";
    // Description
    $desc = $IMDB->getPlot();
    if(strtolower($desc) == "n/a")
    {
        echo ($IMDB->getDescription());
    }
    echo "</br>";	echo "</br>";
    // Image_link
    echo ($img = $IMDB->getPoster($sSize = 'big', $bDownload = false));
    echo "<img src=".$img." alt='' />";
    // Runtime
    echo ($IMDB->getRuntime());
    echo "</br>";	echo "</br>";
    // Rating
    echo ($IMDB->getRating());
    echo "</br>";	echo "</br>";
    // Certification
    echo ($IMDB->getCertification());
    echo "</br>";	echo "</br>";
    // Cast
    echo ($IMDB->getCastAndCharacter($iLimit = 0));
    echo "</br>";	echo "</br>";
    // Quality
    // handled in the file name


    //  EPISODE //
    // echo ($IMDB->getTitle());
    // echo "</br>";	echo "</br>";
    // echo ($IMDB->getEpisodeTitle());
    // echo "</br>";	echo "</br>";
    // echo ($IMDB->getDescription());
    // echo "</br>";	echo "</br>";
    // echo ($IMDB->getPlot());
    // echo "</br>";	echo "</br>";
    // echo ($IMDB->getYear());

    // MOVIE //
  	// echo "</br>";	echo "</br>";
  	// echo ($IMDB->getGenre());
  	// echo "</br>";	echo "</br>";
  	// echo ($IMDB->getYear());
  	// echo "</br>";	echo "</br>";
  	// echo ($IMDB->getRating());
  	// echo "</br>";	echo "</br>";
  	// echo ($IMDB->getRuntime());
    // echo "</br>";	echo "</br>";
    // echo ($IMDB->getCertification());
    // echo "</br>";	echo "</br>";
    // echo ($IMDB->getDirector());
    // echo "</br>";	echo "</br>";
    // // echo ($IMDB->getUserReview());
    // // echo "</br>";	echo "</br>";
    // echo ($IMDB->getRating());
    // echo "</br>";	echo "</br>";
    // echo ($IMDB->getCastAndCharacter($iLimit = 0));
    // echo "</br>";	echo "</br>";
    // echo ($IMDB->getCast($iLimit = 0));
    // echo "</br>";	echo "</br>";
    // echo ($img = $IMDB->getPoster($sSize = 'big', $bDownload = false));
    // echo "<img src=".$img." alt='' />";


  }
  else
  {
  	echo 'Movie not found. 😞';
  }
}
?>
