<!DOCTYPE html>
<html>
<!--<head>-->
<?php
/*
    Description: JustWatch Movies for free viewing.
    Author: David McRae, Oliver Dickens
*/
  include '../Controller/session.php';

  if(isset($_SESSION['username']))
  {

  if(!isset($_GET['filter']))
  {
    include '../Controller/getAllMovies.php';
  }
  else
  {
    $movieFilter = $_GET['filter'];
    include '../Controller/getMoviesByFilter.php';
  }
  include 'header.php';
  include 'navbar.php';
  ?>
<!-- </head> -->
<body>
  <title>
    Movies
  </title>
  <div class="container mt-2">
    <div id="mobileSearch" class="row no-gutters justify-content-center">
      <form class="form-inline row m-2" method="GET">
        <input class="form-control col" type="search" placeholder="Search by Title" name="filter">
        <button class="btn btn-danger col-2" type="submit"><i class="fas fa-search"></i></button>
      </form>
    </div>

    <div class="btn-group-toggle" data-toggle="buttons">

      <label class="btn btn-outline-danger">
        <input type="checkbox" checked>Action</input>
      </label>

      <label class="btn btn-outline-danger">
        <input type="checkbox" checked>Adventure</input>
      </label>

      <label class="btn btn-outline-danger">
        <input type="checkbox" checked>Family</input>
      </label>

    </div>

  </div>
    <?php
      //Error Reporting for the users
        if(isset($_GET['error']))
          {
            $error = $_GET['error'];
            echo $error;
          }
          ?>
            <div class="container text-center mt-2">
              <br><h1>Movies</h1><br>
              <?php
              include 'pageNavigation.php';
              //TODO: Expansion: add Bookmarked button to add to watch list


              $perRow = 5;//10 works best on small screens:no single movie options
              $totalItems = sizeof($movieArray);
              $currentItem = 0;

              $rows = $totalItems / $perRow;
              $countPerRow = 0;


              //TODO: make custom row which is the same as class row
              //but takes all CSS off during mobile view
              echo "<div class='row'>";
              for ($i=0 ; $i < sizeof($movieArray) ; $i++)
              {
                echo "<div class='col mt-5'>"; // open col

                    echo "<div class='card'>"; // Open card div
                      echo "<a href='playMovie.php?id=".$movieArray[$i]->Movie_ID."'> <img src='".$movieArray[$i]->Image_link."'  alt='".$movieArray[$i]->Movie_ID."' onerror=this.src='Images/film.placeholder.poster.jpg'></a>"; // card image


                      echo "<div class='card-bottom'>";
                        echo "<br><class='movieTitle'>".$movieArray[$i]->Title." (".$movieArray[$i]->Year.")";
                      echo "</div>";// close card-bottom

                    echo "</div>";// close card
                echo "</div>";// close col
              }
              echo "</div>";


              echo "<div class='row mt-5'>";
              include 'pageNavigation.php';
              echo "</div>";

            echo "
            </div>
            <br>";
              ?>


          <?php
          include 'footer.php';
          include '../Controller/bootstrapScript.php';
          include '../Controller/ajaxScript.php';
          include '../Controller/navControl.js';
          ?>
    </body>
<?php
}
else
{
  header("Location: ../index.php?error=ACCESS DENIED");
}
?>
</html>
