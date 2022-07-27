<?php
include_once 'imdb/imdb.class.php';

$IMDB = new IMDB('he\'s just not');

if($IMDB->isReady)
{
  echo ($IMDB->getDescription());
	echo "</br>";	echo "</br>";
	echo ($IMDB->getGenre());
	echo "</br>";	echo "</br>";
	echo ($IMDB->getYear());
	echo "</br>";	echo "</br>";
	echo ($IMDB->getRating());
	echo "</br>";	echo "</br>";
	echo ($IMDB->getRuntime());
  echo "</br>";	echo "</br>";
  echo ($IMDB->getCertification());
  echo "</br>";	echo "</br>";
  echo ($IMDB->getDirector());
  echo "</br>";	echo "</br>";
  // echo ($IMDB->getUserReview());
  // echo "</br>";	echo "</br>";
  echo ($IMDB->getRating());
  echo "</br>";	echo "</br>";
  echo ($IMDB->getCastAndCharacter($iLimit = 0));
  echo "</br>";	echo "</br>";
  // echo ($IMDB->getCast($iLimit = 0));
  // echo "</br>";	echo "</br>";


  echo ($img = $IMDB->getPoster($sSize = 'big', $bDownload = false));
  echo "<img src=".$img." alt='' />";
  echo "</br>";	echo "</br>";
  echo ($IMDB->getPlot());

}
else
{
	echo 'Movie not found. 😞';
}
?>
