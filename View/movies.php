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
          <button class="btn btn-outline-info col-2" type="submit"><i class="fas fa-search"></i></button>
        </form>
      </div>


      <div class="row col-12 no-gutters" style="display:inline-block;">
          <button id="filterByGenreButton" class="btn btn-info col-2 m-2 float-right">Filter</button>
        </div>

  <div style="display:none;" id="filterDiv" class="container mt-2 row col-12 no-gutters">
    <form class="form-group col-12" method="POST" action="">
        <div class="form-group input-group col-4">
          <div class="input-group-prepend">
            <span class="input-group-text highlightText" id="inputGroupPrepend">Genre</span>
          </div>
          <select class="custom-select" id="genreSelect" name="ageRating" multiple>
              <option value="Action">Action</option>
              <option value="Adventure">Adventure</option>
              <option value="Family">Family</option>
              <option value="Marvel">Marvel</option>
              <option value="Horror">Horror</option>
          </select>
          <div class="invalid-feedback">Selecty a Genre</div>
        </div>
        <input class="btn btn-outline-info m-2 float-right" type="submit" value="Apply Filter" />
      </div>

    </form>
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
              //TODO: Expansion: add Bookmarked button to add to watch list
              echo "<div class='row mt-5'>";
              include 'pageNavigation.php';
              echo "</div>";
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
          include '../Controller/multiselect.js';
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
