<!DOCTYPE html>
<html>
  <body>
    <?php
      include '../Controller/session.php';
        if(isset($_SESSION['username']))
        {
          if(!isset($_GET['filterByTitle']))
          {
            include '../Controller/getAllMoviesRecentlyAdded.php';
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
      <main id="main" class="main">
        <div class="pagetitle">
          <h1>Recently Added</h1>
          <nav>
            <ol class="breadcrumb">
              <li class="breadcrumb-item active"><a href="#">Recently Added</a></li>
            </ol>
          </nav>
        </div><!-- End Page Title -->

          <div class="row ">
            <div class="col-lg-6 pb-4 pt-4">
              <?php
               include 'filterGenre.php';
              //include 'filterGenre2.php';
              ?>
              </div>

            <!-- <div class="col-lg-6"> -->
              <?php
              //include 'pageNavigation.php'
              //include '../Controller/getPagination.php';
              ?>
              <!-- </div> -->
          </div>
        <?php
        //Error Reporting for the users
        if(isset($_GET['error']))
          {
            $error = $_GET['error'];
            echo $error;
          }
          ?>
          <section class="section">
              <?php
              // $perRow = 5;//10 works best on small screens:no single movie options
              // $totalItems = sizeof($movieArray);
              // $currentItem = 0;
              //
              // $rows = $totalItems / $perRow;
              // $countPerRow = 0;
              echo "<div class='row'>";
                for ($i=0 ; $i < sizeof($movieArray) ; $i++)
                {
                  echo "<div class='col-sm'>";
                    echo "<div class='card'>";
                      echo "<a href='viewMovie.php?id=".$movieArray[$i]->Movie_ID."'> <img src='".$movieArray[$i]->Image_link."'   alt='".$movieArray[$i]->Movie_ID."' onerror=this.src='Images/film.placeholder.poster.jpg'></a>"; // card image
                        echo "<div class='card-body'>";
                        echo "<br><h8 class='card-title'>".$movieArray[$i]->Title." (".$movieArray[$i]->Year.")</h8>";
                        echo "<p class='card-text'>".$movieArray[$i]->Rating." / 10</p>";
                      echo "</div>";// close card body
                    echo "</div>";// close card
                  echo "</div>";// close col
                  }
               echo "</div>";// close row

              // include 'pageNavigation.php';
              ?>
          </section>
        </main>
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