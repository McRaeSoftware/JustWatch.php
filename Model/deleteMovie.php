<?php
//TODO: When movie deleted include image delete as that sticks around
//Delete Movie from database
function DeleteMovieByID($movieid)
{
  require 'connection.php';

  $stmt = $connection->prepare
  (
    "DELETE FROM Movie WHERE Movie_ID = :movieid"
  );

  $success = $stmt->execute
  ([
    'movieid' => $movieid
  ]);

  if($success && $stmt->rowCount() > 0)
  {
    header('location: ../View/removeMovie.php');
  }
  else
  {
    header('location: ../View/removeMovie.php?error=FAILED');
  }
}
?>
