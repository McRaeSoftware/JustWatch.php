<?php
//Count All Movies
function CountMovies()
{
  require 'connection.php';

  $sql = "SELECT Count(*) FROM Movie";

  $stmt = $connection->prepare($sql);
  $result = $stmt->fetch();
  $success = $stmt->execute();

  if($success && $stmt->rowCount() > 0)
  {
    return $stmt->fetch()[0];
  }
  else
  {
    return 0;
  }
}
?>
