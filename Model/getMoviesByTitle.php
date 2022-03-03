<?php
function GetMoviesByTitle($movieTitle)
{
  require_once 'connection.php';

  $sql = "SELECT * FROM Movie WHERE Title LIKE '%".$movieTitle."%' ORDER BY Title asc";

  $stmt = $connection->prepare($sql);
  $result = $stmt->fetch();
  $success = $stmt->execute();

  if($success && $stmt->rowCount() > 0)
  {
    //  convert to JSON
    $rows = array();
    while($r = $stmt->fetch())
    {
      $rows[] = $r;
    }
    return json_encode($rows);
  }
  else
  {
    header('Location ../View/movies.php?error=Filter Not Found');
  }
}
?>
