<!DOCTYPE html>
<?php
$dir = 'S01';
$files = scandir($dir);

for ($i=0 ; $i < sizeof($files) ; $i++)
{
  echo '<a class="cd-btn mt-2" href="playMe.html?title='.$files[$i].'" data-type="page-transition">Play</a>';
  echo "</br>";
  echo $files[$i];
}
?>
