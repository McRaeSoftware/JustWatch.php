<?php
//Include '../Model/pagination.php';
?>
<nav aria-label="Page navigation example">
<ul class="pagination justify-content-center">
<?php
// if(!isset($page_counter)){
// $page_counter = 'Variable name is not set';
// echo "test ";
// }
// if(!isset($paginations)){
// $paginations = 'Variable name is not set';
// echo "end here 2";
// }
    if($page_counter == 0){
        echo "<li><a href=?start='0' class='active'>0</a></li>";
        for($j=1; $j < $paginations; $j++) {
          echo "<li><a href=?start=$j>".$j."</a></li>";
       }
    }else{
        echo "<li><a href=?start=$previous>Previous</a></li>";
        for($j=0; $j < $paginations; $j++) {
         if($j == $page_counter) {
            echo "<li><a href=?start=$j class='active'>".$j."</a></li>";
         }else{
            echo "<li><a href=?start=$j>".$j."</a></li>";
         }
      }if($j != $page_counter+1)
        echo "<li><a href=?start=$next>Next</a></li>";
    }
?>
</ul>
</nav>

<!-- Pagination with icons -->
<!-- <nav aria-label="Page navigation example">
  <ul class="pagination justify-content-center">
    <li class="page-item">
      <a class="page-link" href="#" aria-label="Previous">
        <span aria-hidden="true">&laquo;</span>
      </a>
    </li>
    <li class="page-item"><a class="page-link" href="#">1</a></li>
    <li class="page-item"><a class="page-link" href="#">2</a></li>
    <li class="page-item"><a class="page-link" href="#">3</a></li>
    <li class="page-item">
      <a class="page-link" href="#" aria-label="Next">
        <span aria-hidden="true">&raquo;</span>
      </a>
    </li>
  </ul>
</nav> -->
<!-- End Pagination with icons -->


<!-- // $query = "SELECT * FROM movie";
//
// $limit = (isset( $_GET['limit']))? $_GET['limit'] : 10; //movies per page
// $page = (isset( $_GET['page']))? $_GET['page'] : 1; //starting page
// $links = 5;
//
// $pagination = new Pagination( $query); //_constructor is called
// $results = $pagination->getData( $limit, $page);
// //print_r($results);die; $results is an object, $results->data is an array
// //print_r($results->data); //array
// echo $pagination-> createLinks( $links, 'pagination'); -->

<!-- ?> -->
