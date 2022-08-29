<?php
function GetSeasons($seriesid)
{
  require 'connection.php';

  // SELECT all seeason id's where series id = series id
  $query = $connection->prepare
  ("
    SELECT * FROM Episode WHERE Series_ID = :seriesid GROUP BY Season_ID
  ");

  $success = $query->execute
  ([
    'seriesid' => $seriesid
  ]);

  if($success && $query->rowCount() > 0)
  {
    //  convert to JSON
    $rows = array();
    while($r = $query->fetch())
    {
      $rows[] = $r;
    }
    return json_encode($rows);
  }
  else
  {
    echo "Unable to find Seasons";
  }
}
?>
