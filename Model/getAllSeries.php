<?php
//Get All Series
function GetAllSeries($page)
{
  require_once 'connection.php';

  $amountPerPage = 50;

  $startAtRowNo = $page * $amountPerPage;
  $offset = $startAtRowNo - $amountPerPage;

    $sql = "SELECT * FROM Series GROUP BY Series_ID ORDER BY Year desc, Series_Name asc LIMIT ".$offset.", ".$amountPerPage;

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
}
?>
