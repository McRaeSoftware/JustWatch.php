<?php
include_once '../Controller/countMovies.php';
if(!isset($_GET['page']))
{
  $currentPage = 1;
}
else
{
  $currentPage = $_GET['page'];
}

$moviesPerPage = 50;
$fullPages = intdiv($count, $moviesPerPage);
$moviesOnLastPage = $count % $moviesPerPage;

echo "</br> Movie Count: ".$count."</br>";

if($moviesOnLastPage > 0)
{
  $lastPage = $fullPages + 1;
}
else
{
  $lastPage = $fullPages;
}

$url = $_SERVER['REQUEST_URI'];
//if(substr( $url, 0, 31 ) === "/Site/JustWatch/View/movies.php")
if(substr( $url, 0, 26 ) === "/JustWatch/View/movies.php")
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

          if($currentPage > 2)
          {
            $page = $currentPage -2;
            echo "<li class='page-item'><a class='page-link' href='movies.php?page=".$page."'>".$page."</a></li>";
            $page = $currentPage -1;
            echo "<li class='page-item'><a class='page-link' href='movies.php?page=".$page."'>".$page."</a></li>";
          }
          else if($currentPage > 1)
          {
            $page = $currentPage -1;
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
  <div class='container'>
    <ul class='pagination justify-content-center'>
      <li class='page-item'>
        ";
        if($currentPage == 1)
        {
          //TODO:remove sweary words haha
          echo "
          <a class='page-link btn disabled' href='updateMovies.php?page=".($currentPage -1)."' aria-label='Next'>
          <span>Previous</span>
          </a>
          ";
        }
        else
        {
          echo "
          <a class='page-link' href='updateMovies.php?page=".($currentPage -1)."' aria-label='Previous'>
          <span>Previous</span>
          </a>
          ";
        }

        if($currentPage > 2)
        {
          $page = $currentPage -2;
          echo "<li class='page-item'><a class='page-link' href='updateMovies.php?page=".$page."'>".$page."</a></li>";
          $page = $currentPage -1;
          echo "<li class='page-item'><a class='page-link' href='updateMovies.php?page=".$page."'>".$page."</a></li>";
        }
        else if($currentPage > 1)
        {
          $page = $currentPage -1;
          echo "<li class='page-item'><a class='page-link' href='updateMovies.php?page=".$page."'>".$page."</a></li>";
        }

        echo "<li class='page-item disabled'><a class='page-link' href='updateMovies.php?page=".$currentPage."'>".$currentPage."</a></li>";

        if($currentPage < $fullPages && $lastPage > $fullPages)
        {
          $page = $currentPage +1;
          echo "<li class='page-item'><a class='page-link' href='updateMovies.php?page=".$page."'>".$page."</a></li>";
          $page = $currentPage +2;
          echo "<li class='page-item'><a class='page-link' href='updateMovies.php?page=".$page."'>".$page."</a></li>";
        }
        else if($currentPage == $fullPages && $lastPage > $fullPages)
        {
          $page = $currentPage +1;
          echo "<li class='page-item'><a class='page-link' href='updateMovies.php?page=".$page."'>".$page."</a></li>";
        }

      if($currentPage >= $lastPage)
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
