<?php
function GetEpisode($seriesId, $seasonId, $episodeId)
{
  require 'connection.php';

  // SELECT all seeason id's where series id = series id
  $query = $connection->prepare
  ("
    SELECT * FROM Series WHERE Series_ID = :seriesId AND Season_ID = :seasonId AND Episode_ID = :episodeId
  ");

  $success = $query->execute
  ([
    'seriesId' => $seriesId,
    'seasonId' => $seasonId,
    'episodeId' => $episodeId
  ]);

  if($success && $query->rowCount() > 0)
  {
    $row = $query->fetch();
    return json_encode($row);
  }
  else
  {
    echo "Unable to find Episode";
  }
}
?>
