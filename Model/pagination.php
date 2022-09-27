
<?php
  //require_once 'connection.php';
// website-https://www.etutorialspoint.com/index.php/50-simple-pagination-in-php

  $start = 0;
  $per_page = 19; //movies per page, count starts at 0
  $page_counter = 0; //page starts on
  $next = $page_counter + 1;
  $previous = $page_counter - 1;

  if(isset($_GET['start'])){
   $start = $_GET['start'];
   $page_counter =  $_GET['start'];
   $start = $start *  $per_page;
   $next = $page_counter + 1;
   $previous = $page_counter - 1;
  }
  // query to get messages from messages table
  $q = "SELECT * FROM movie LIMIT $start, $per_page";
  $query = $dbname->prepare($q);
  $query->execute();

  if($query->rowCount() > 0){
      $result = $query->fetchAll(PDO::FETCH_ASSOC);
  }
  // count total number of rows in movie dbname
  $count_query = "SELECT * FROM movie";
  $query = $dbname->prepare($count_query);
  $query->execute();
  $count = $query->rowCount();
  // calculate the pagination number by dividing total number of rows with per page.
  $paginations = ceil($count / $per_page);







//
//
// class Pagination{
//
//   // declaring varibales
//   private $connection;
//   private $_limit; // records rows of movies per page
//   private $_page; //current page
//   private $_query;
//   private $_total;
//   private $_row_start;
//
// public function __construct( $connection,$query){
//
//   //$this-> = variables become available anywhere within THIS class
//   $this->connection = $connection; // database connection
//   $this->_query = $query; // database query string
//
//   $rs = $this->connection;
//   $this->_total = $rs->num_rows; //total number of rows
// }
//
// // LIMIT DATA
// // all this does is to limit the data returned and returns everything as $result object
// public function getData( $limit = 10, $page = 1 ){ //set how many pages show on pagination
//
//   $this->_limit = $limit;
//   $this->_page = $page;
// // no limiting necessary, use query as it is
// if ($this->_limit == 'all'){
//   $query = $this->_query;
// }
// else
// {
//     //create the query, limiting records from page, to limit
//     $this->_row_start = (($this->_page - 1) * $this->_limit);
//     $query = $this->_query .
//     //add to original query:(minus one becasue of the way SQL works)
//     "LIMIT{$this->_row_start}, $this->_limit";
// }
//  //echo $query;die;
// $rs = $this->connection->query($query) or die ($this->connection->error);
//
//
// while($row = $rs->fetch_assoc()){
//   //store this array in $result -> data below
//   $results[] = $row;
//
// }
//   //print_r($results);die;
//   //return data as object, new stdClass() creates new empty object
//   $result = new stdClass();
//   $result->page = $this->_page;
//   $result->limit = $this->_limit;
//   $result->total = $this->_total;
//   $result->data = $results; //results->data = array
//
//   //print_r($result);die;
//   return $result; //object
// }
//
//  //printing links
//  public function createLinks($links, $list_class)
//  {
//    //return empty results string, no links necessary
//    if($this->_limit == 'all'){
//      return '';
//    }
//
// //get the last page NumberFormatter
// //ceil rounds up
// $last = ceil($this->_total / $this->_limit);
// //calculate start of the range for the link printing
// $start = (($this->_page - $links) > 0)? $this->_page - $links : 1;
// //calculate end of the range for the link printing
// $end = (($this->_page + $links) < $last) ? $this->_page + $links : $last;
// //debugging
// echo '$total: '.$this->_total. ' | '; //total rows
// echo '$row_start: '.$this->_row_start. ' | '; //total rows
// echo '$limit: '.$this->_limit. ' | '; //total rows per query
// echo '$start: '.$start. ' | '; //tstart printing lines from
// echo '$end: '.$end. ' | '; //end printing links at
// echo '$last: '.$last. ' | '; //last page
// echo '$page: '.$this->_page. ' | '; //current page
// echo '$links: '.$links. ' <br /> '; //links
//
//
// //ul bootstrap class -"pagination"
// $html = '<ul class="' . $list_class . '">';
// $class = ($this->_page ==1 ) ? "disabled" : ""; //disable previous page link if sitting on page 1
//
// //create the links and pass limit and page as $_GET parameters
// //start of the pagination with page 1
// $previous_page = ($this->_page == 1) ?
// '<a href=""><li class="' . $class . '">&laquo;</a></li>': //remove link from prevous page
// '<li class="' . $class . '"><a href="?limit=' . $this->_limit . '&page=' . ($this->_page - 1) . '">&laquo;</a></li>';
//
// $html .=$previous_page;
// //adding the dots after page 1
// if ( $start > 1 ){//print . . . before (previous link)
//   $html .= '<li><a href="?limit=' . $this->_limit . '&page=1">1</a></li>';//prints first page
//   $html .= '<li class= "disabled"><span>...</span></li>';//print 3 dots if not on first page
//
// }
//
// //print all the numbered pages between start and end
// for ($i = $start ; $i <= $end; $i++){
//   $class = ($this->_page == $i)? "active" : ""; //highlight current page
//   $html .= '<li class"' . $class . '"><a href="?limit=' . $this->_limit . '&page=' . $i . '">' . $i .'</a></li>';
// }
//
// //adding the dots before last page
// if ( $end < $last ){//print . . . before (previous link)
//   $html .= '<li class= "disabled"><span>...</span></li>';//print 3 dots if not on last page
//   $html .= '<li class"' . $class . '"><a href="?limit=' . $this->_limit . '&page=' . $last . '">' . $last .'</a></li>';//prints last page
// }
//  $class =($this->_page == $last)?"disabled" : ""; //disable the next link to stop loop
//
//  //$this->_page + 1 = next page
//  $next_page = ($this->_page == $last) ?
//  '<li class="' . $class . '"><a href="">&raquo;</a></li>': //remove link from next button
//  '<li class="' . $class . '"><a href="?limit=' . $this->_limit . '&page=' . ($this->_page + 1) . '">&raquo;</a></li>';
//
//   $html .= $next_page;
//   $html .='</ul>';
//
//   return $html;
//  }
// }
?>
