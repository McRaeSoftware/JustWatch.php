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

  include '../Controller/getSeasons.php';
  include 'header.php';
  // include 'navbar.php';
include 'sidebar.php';
  ?>
<!-- </head> -->
<body>
  <title>
    Series
  </title>
  <div class="container mt-2">
    <div id="mobileSearch" class="row no-gutters justify-content-center">
      <form class="form-inline row m-2" method="GET">
        <input class="form-control col" type="search" placeholder="Search by Title" name="filter">
        <button class="btn btn-danger col-2" type="submit"><i class="fas fa-search"></i></button>
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
              <h1>Series</h1><hr>
              <?php
              include 'pageNavigation.php';
              //TODO: Expansion: add Bookmarked button to add to watch list


              $perRow = 5;
              $totalItems = sizeof($seriesArray);
              $currentItem = 0;

              $rows = $totalItems / $perRow;
              $countPerRow = 0;


              //TODO: make custom row which is the same as class row
              //but takes all CSS off during mobile view
              for ($i=0 ; $i < sizeof($seriesArray) ; $i++)
              {
                if($countPerRow === 0)
                {
                  echo "<div class='row'>";
                }

                echo "<div class='col'>"; // open col
                  echo "<div class='card'>"; // Open card div
                    echo "<div class='poster' >"; // Open card poster
                      echo "<a href='seasonEpisodes.php?id=".$seriesArray[$i]->Series_ID."&S=".$seriesArray[$i]->Season_ID."'> <img src='".$seriesArray[$i]->Image_link."' onerror=this.src='Images/film.placeholder.poster.jpg'></a>"; // card image
                    echo "</div>";// close poster

                    echo "<div class='card-bottom'>";
                      echo "<class='seriesTitle'>Season: ".$seriesArray[$i]->Season_ID."<br>";
                    echo "</div>";// close card-bottom
                  echo "</div>";// close card
                echo "</div>";// close col

                $countPerRow++;
                $currentItem++;

                if($countPerRow == $perRow || $currentItem == $totalItems)
                {
                  $countPerRow = 0;
                  echo "</div>";
                }
              }

              echo "<div class='row mt-5'>";
              include 'pageNavigation.php';
              echo "</div>";

            echo "
            </div>
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
