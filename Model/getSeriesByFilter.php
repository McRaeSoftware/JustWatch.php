<?php
//TODO: Implement this feature
function GetSeriesByFilter($seriesFilter)
{
  require_once 'connection.php';

  $sql = "SELECT * FROM Series WHERE Series_Name LIKE '%".$seriesFilter."%' ORDER BY Season_ID asc";

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
    header('Location ../View/series.php?error=Filter Not Found');
  }
}
?>
