<?php
//Get Movie by date added
function GetMovieByDateAddd($date_added)
{
  require 'connection.php';

  $query = $connection->prepare
  ("
    SELECT * FROM Movie WHERE date_added <= DATEADD(day, -30, GETDATE());
  ");

  $success = $query->execute
  ([
    'date_added' => $date_added
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
