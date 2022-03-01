<?php
function GetSeasonEpisodes($seriesId, $seasonId)
{
  require 'connection.php';

  // SELECT all seeason id's where series id = series id
  $query = $connection->prepare
  ("
    SELECT * FROM Series WHERE Series_ID = :seriesId AND Season_ID = :seasonId
  ");

  $success = $query->execute
  ([
    'seriesId' => $seriesId,
    'seasonId' => $seasonId
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
    echo "Unable to find Episodes";
  }
}
?>
