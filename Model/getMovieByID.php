<?php
//Get Movie by ID
function GetMovieByID($movieid)
{
  require 'connection.php';

  $query = $connection->prepare
  ("
    SELECT * FROM Movie WHERE Movie_ID = :movieid LIMIT 1
  ");

  $success = $query->execute
  ([
    'movieid' => $movieid
  ]);

  if($success && $query->rowCount() > 0)
  {
    $row = $query->fetch();
    return json_encode($row);
  }
  else
  {
    echo "Unable to find Movie";
  }
}
?>
