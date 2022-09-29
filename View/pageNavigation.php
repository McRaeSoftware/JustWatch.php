<?php
if(!isset($_GET['page']))
{
  $currentPage = 1;
}
else
{
  $currentPage = $_GET['page'];
}
include '../Controller/countMovies.php';

$moviesPerPage = 50;
$fullPages = intdiv($count, $moviesPerPage);
$moviesOnLastPage = $count % $moviesPerPage;
if($moviesOnLastPage > 0)
{
  $lastPage = $fullPages + 1;
}
else
{
  $lastPage = $fullPages;
}


$url = $_SERVER['REQUEST_URI'];
//if(substr( $url, 0, 34 ) === "/Site/JustWatchphp/View/movies.php")
if(substr( $url, 0, 29 ) === "/JustWatchphp/View/movies.php")
{
  // MOVIES PAGE
    echo "
    <div class='container'>
      <ul class='pagination justify-content-center'>
        <li class='page-item'>
          ";
          if($currentPage == 1)
          {
            //TODO:remove sweary words haha
            echo "
            <a class='page-link btn disabled' href='movies.php?page=".($currentPage -1)."' aria-label='Next'>
            <span>Previous</span>
            </a>
            ";
          }
          else
          {
            echo "
            <a class='page-link' href='movies.php?page=".($currentPage -1)."' aria-label='Previous'>
            <span>Previous</span>
            </a>
            ";
          }

          $page = $currentPage;

          if($currentPage > 2)
          {
            $page = $currentPage -2;
            echo "<li class='page-item'><a class='page-link' href='movies.php?page=".$page."'>".$page."</a></li>";
            $page = $currentPage -1;
            echo "<li class='page-item'><a class='page-link' href='movies.php?page=".$page."'>".$page."</a></li>";
          }
          else if($currentPage > 1)
          {
            $page = $page -1;
            echo "<li class='page-item'><a class='page-link' href='movies.php?page=".$page."'>".$page."</a></li>";
          }

          echo "<li class='page-item disabled'><a class='page-link' href='movies.php?page=".$currentPage."'>".$currentPage."</a></li>";

          if($currentPage < $fullPages && $lastPage > $fullPages)
          {
            $page = $currentPage +1;
            echo "<li class='page-item'><a class='page-link' href='movies.php?page=".$page."'>".$page."</a></li>";
            $page = $currentPage +2;
            echo "<li class='page-item'><a class='page-link' href='movies.php?page=".$page."'>".$page."</a></li>";
          }
          else if($currentPage == $fullPages && $lastPage > $fullPages)
          {
            $page = $currentPage +1;
            echo "<li class='page-item'><a class='page-link' href='movies.php?page=".$page."'>".$page."</a></li>";
          }

        if($currentPage >= $lastPage)
        {
          echo "
          <a class='page-link btn disabled' href='movies.php?page=".($currentPage +1)."' aria-label='Next'>
            <span>Next</span>
          </a>
          ";
        }
        else
        {
          echo "
          <a class='page-link' href='movies.php?page=".($currentPage +1)."' aria-label='Next'>
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
        if($currentPage == 1)
        {
          echo "
          <a class='page-link btn disabled' href='updateMovies.php?page=".($currentPage -1)."' aria-label='nob'>
          <span>Previous</span>
          </a>
          ";
        }
        else
        {
          echo "
          <a class='page-link' href='updateMovies.php?page=".($currentPage -1)."' aria-label='Dick'>
          <span>Previous</span>
          </a>
          ";
        }
        // TODO check maximum number of pages
      echo "
      </li>
      <li class='page-item'><a class='page-link' href='updateMovies.php?page=1'>1</a></li>
      <li class='page-item'><a class='page-link' href='updateMovies.php?page=".$currentPage."'>".$currentPage."</a></li>
      <li class='page-item'><a class='page-link' href='updateMovies.php?page=".($currentPage +1)."'>".($currentPage +1)."</a></li>
      <li class='page-item'><a class='page-link' href='updateMovies.php?page=".($currentPage +2)."'>".($currentPage +2)."</a></li>
      <li class='page-item'><a class='page-link' href='updateMovies.php?page=".($currentPage +3)."'>".($currentPage +3)."</a></li>
      <li class='page-item'><a class='page-link' href='updateMovies.php?page=".($currentPage +4)."'>".($currentPage +4)."</a></li>
      <li class='page-item'><a class='page-link' href='updateMovies.php?page=".($currentPage +5)."'>".($currentPage +5)."</a></li>
      <li class='page-item'>
      ";
      if($currentPage >= 20)
      {
        echo "
        <a class='page-link btn disabled' href='updateMovies.php?page=".($currentPage +1)."' aria-label='Next'>
          <span>Next</span>
        </a>
        ";
      }
      else
      {
        echo "
        <a class='page-link' href='updateMovies.php?page=".($currentPage +1)."' aria-label='Next'>
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
else
{
  echo "Only one Page";
}
?>
