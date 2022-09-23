<!-- Pagination with chevrons -->
<nav aria-label="Page navigation example">
  <ul class="pagination flex-row">
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
</nav><!-- End Pagination with chevrons -->
<?php

if(!isset($_GET['page']))
{
  $page = 1;
}
else
{
  $page = $_GET['page'];
}
$url = $_SERVER['REQUEST_URI'];
if(substr( $url, 0, 34 ) === "/Site/JustWatchphp/View/movies.php")
{
  // MOVIES PAGE
    echo "
    <div class='container'>
      <ul class='pagination justify-content-center'>
        <li class='page-item'>
          ";
          if($page == 1)
          {
            //TODO:remove sweary words haha
            echo "
            <a class='page-link btn disabled' href='movies.php?page=".($page -1)."' aria-label='Next'>
            <span>Previous</span>
            </a>
            ";
          }
          else
          {
            echo "
            <a class='page-link' href='movies.php?page=".($page -1)."' aria-label='Previous'>
            <span>Previous</span>
            </a>
            ";
          }
          // TODO check maximum number of pages
        echo "
        </li>
        <li class='page-item'><a class='page-link' href='movies.php?page=1'>1</a></li>
        <li class='page-item'><a class='page-link' href='movies.php?page=".$page."'>".$page."</a></li>
        <li class='page-item'><a class='page-link' href='movies.php?page=".($page +1)."'>".($page +1)."</a></li>
        <li class='page-item'><a class='page-link' href='movies.php?page=".($page +2)."'>".($page +2)."</a></li>
        <li class='page-item'><a class='page-link' href='movies.php?page=".($page +3)."'>".($page +3)."</a></li>
        <li class='page-item'><a class='page-link' href='movies.php?page=".($page +4)."'>".($page +4)."</a></li>
        <li class='page-item'><a class='page-link' href='movies.php?page=".($page +5)."'>".($page +5)."</a></li>
        <li class='page-item'>
        ";

        if($page >= 20)
        {
          echo "
          <a class='page-link btn disabled' href='movies.php?page=".($page +1)."' aria-label='Next'>
            <span>Next</span>
          </a>
          ";
        }
        else
        {
          echo "
          <a class='page-link' href='movies.php?page=".($page +1)."' aria-label='Next'>
            <span>Next</span>
          </a>
          ";
        }
        echo "
        </li>
      </ul>
    </div>
    ";
}
else if(substr( $url, 0, 40 ) === "/Site/JustWatchphp/View/updateMovies.php")
{
  // ADMIN NAVIGATION FOR UPDATE MOVIES
  echo "
  <div>
    <ul class='pagination justify-content-center'>
      <li class='page-item'>
        ";
        if($page == 1)
        {
          echo "
          <a class='page-link btn disabled' href='updateMovies.php?page=".($page -1)."' aria-label='nob'>
          <span>Previous</span>
          </a>
          ";
        }
        else
        {
          echo "
          <a class='page-link' href='updateMovies.php?page=".($page -1)."' aria-label='Dick'>
          <span>Previous</span>
          </a>
          ";
        }
        // TODO check maximum number of pages
      echo "
      </li>
      <li class='page-item'><a class='page-link' href='updateMovies.php?page=1'>1</a></li>
      <li class='page-item'><a class='page-link' href='updateMovies.php?page=".$page."'>".$page."</a></li>
      <li class='page-item'><a class='page-link' href='updateMovies.php?page=".($page +1)."'>".($page +1)."</a></li>
      <li class='page-item'><a class='page-link' href='updateMovies.php?page=".($page +2)."'>".($page +2)."</a></li>
      <li class='page-item'><a class='page-link' href='updateMovies.php?page=".($page +3)."'>".($page +3)."</a></li>
      <li class='page-item'><a class='page-link' href='updateMovies.php?page=".($page +4)."'>".($page +4)."</a></li>
      <li class='page-item'><a class='page-link' href='updateMovies.php?page=".($page +5)."'>".($page +5)."</a></li>
      <li class='page-item'>
      ";
      if($page >= 20)
      {
        echo "
        <a class='page-link btn disabled' href='updateMovies.php?page=".($page +1)."' aria-label='Next'>
          <span>Next</span>
        </a>
        ";
      }
      else
      {
        echo "
        <a class='page-link' href='updateMovies.php?page=".($page +1)."' aria-label='Next'>
          <span>Next</span>
        </a>
        ";
      }
      echo "
      </li>
    </ul>
  </div>
  ";
}
else {
  // echo "Only one Page";
}
?>
