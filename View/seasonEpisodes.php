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

  include '../Controller/getSeasonEpisodes.php';
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
              <?php

              echo "<h1>".$seriesArray[0]->Series_Name."</h1><hr>";
              echo "<h2>Season: ".$seriesArray[0]->Season_ID."</h2><hr>";


              echo "<ul>";
              for ($i=0 ; $i < sizeof($seriesArray) ; $i++)
              {
                echo "<a href='playEpisode.php?id=".$seriesArray[$i]->Series_ID."&S=".$seriesArray[$i]->Season_ID."&E=".$seriesArray[$i]->Episode_ID."'><div class='row text-center'>";
                echo "<li class='list-group-item mx-auto'><text>Episode: ".$seriesArray[$i]->Episode_ID."&nbsp;:&nbsp;</text>".$seriesArray[$i]->Episode_Name."</li>";
                echo "</div></a><hr>";
              }
              echo "</ul>";

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
