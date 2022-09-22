<!DOCTYPE html>
<html>
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
  include 'sidebar.php';
  // include 'testnavbar.php';
  ?>

<body>
  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Movies</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="#">Movies</a></li>
          <!-- <li class="breadcrumb-item">Components</li> -->
          <!-- <li class="breadcrumb-item active">Cards</li> -->
        </ol>
      </nav>
    </div><!-- End Page Title -->


    <?php
    include 'pageNavigation.php';
    ?>


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
              <?php

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
        </main>
    </body>
<?php
}
else
{
  header("Location: ../index.php?error=ACCESS DENIED");
}
?>
</html>
