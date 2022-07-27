<!DOCTYPE html>
<html>
<!--<head>-->
<?php
/*
    Description: JustWatch Movies for free viewing.
    Author: David McRae
*/
  include '../Controller/session.php';

  if(isset($_SESSION['username']))
  {

  if(!isset($_GET['filterByTitle']))
  {
    include '../Controller/getAllMovies.php';
  }
  else
  {
    $movieFilter = $_GET['filterByTitle'];
    include '../Controller/getMoviesByTitle.php';
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
          <input class="form-control col" type="search" placeholder="Search by Title" name="filterByTitle">
          <button class="btn btn-danger col-2" type="submit"><i class="fas fa-search"></i></button>
        </form>
      </div>


      <div class="row col-12 no-gutters" style="display:inline-block;">
          <button id="filterByGenreButton" class="btn btn-danger col-2 m-2 float-right">Filter</button>
        </div>

  <div style="display:none;" id="filterDiv" class="container mt-2 row col-12 no-gutters">
  <form class="m-2 row text-center justify-content-center" method="POST">
      <div class="btn-group-toggle" data-toggle="buttons">

        <label class="btn btn-outline-danger m-2">
          <input type="checkbox" name="genre[]" checked="">Action
        </label>
        <label class="btn btn-outline-danger m-2">
          <input type="checkbox" name="genre[]" checked="">Adventure
        </label>
        <label class="btn btn-outline-danger m-2">
          <input type="checkbox" name="genre[]" checked="">Animation
        </label>
        <label class="btn btn-outline-danger m-2">
          <input type="checkbox" name="genre[]" checked="">Comedy
        </label>
        <label class="btn btn-outline-danger m-2">
          <input type="checkbox" name="genre[]" checked="">Crime
        </label>
        <label class="btn btn-outline-danger m-2">
          <input type="checkbox" name="genre[]" checked="">DC
        </label>
        <label class="btn btn-outline-danger m-2">
          <input type="checkbox" name="genre[]" checked="">Drama
        </label>
        <label class="btn btn-outline-danger m-2">
          <input type="checkbox" name="genre[]" checked="">Fantasy
        </label>
        <label class="btn btn-outline-danger m-2">
          <input type="checkbox" name="genre[]" checked="">Family
        </label>
        <label class="btn btn-outline-danger m-2">
          <input type="checkbox" name="genre[]" checked="">Marvel
        </label>
        <label class="btn btn-outline-danger m-2">
          <input type="checkbox" name="genre[]" checked="">Romance
        </label>
        <label class="btn btn-outline-danger m-2">
          <input type="checkbox" name="genre[]" checked="">Sci-Fi
        </label>
        <label class="btn btn-outline-danger m-2">
          <input type="checkbox" name="genre[]" checked="">Thriller
        </label>
        <label class="btn btn-outline-danger m-2">
          <input type="checkbox" name="genre[]" checked="">History
        </label>
        <label class="btn btn-outline-danger m-2">
          <input type="checkbox" name="genre[]" checked="">Documentary
        </label>
        <label class="btn btn-outline-danger m-2">
          <input type="checkbox" name="genre[]" checked="">Mystery
        </label>
        <label class="btn btn-outline-danger m-2">
          <input type="checkbox" name="genre[]" checked="">Horror
        </label>
        <label class="btn btn-outline-danger m-2">
          <input type="checkbox" name="genre[]" checked="">Biography
        </label>
        <label class="btn btn-outline-danger m-2">
          <input type="checkbox" name="genre[]" checked="">Music
        </label>
        <label class="btn btn-outline-danger m-2">
          <input type="checkbox" name="genre[]" checked="">Sport
        </label>
        <label class="btn btn-outline-danger m-2">
          <input type="checkbox" name="genre[]" checked="">War
        </label>
        <label class="btn btn-outline-danger m-2">
          <input type="checkbox" name="genre[]" checked="">Western
        </label>

      </div>
      <button class="btn btn-danger m-2" type="submit">Search By Genre</button>
    </form>
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
                        echo "<br><class=''>".$movieArray[$i]->Rating." / 10";
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
          include '../Controller/toggleFilter.js';
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
