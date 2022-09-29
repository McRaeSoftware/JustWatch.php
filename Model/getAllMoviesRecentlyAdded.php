<?php
//All Movies in the LAST 30 days
function GetAllMoviesRecentlyAdded($page)
{
  require_once 'connection.php';

  $amountPerPage = 50;

  $startAtRowNo = $page * $amountPerPage;
  $offset = $startAtRowNo - $amountPerPage;


  $sql ="SELECT  *
        FROM    Movie
        WHERE   date_added BETWEEN CURDATE() - INTERVAL 30 DAY AND CURDATE() ORDER BY Year desc, Title asc LIMIT ".$offset.", ".$amountPerPage;

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
