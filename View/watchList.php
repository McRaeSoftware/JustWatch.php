<!DOCTYPE html>
<html>
  <body>
    <?php
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
      <main id="main" class="main">
        <div class="pagetitle">
          <h1>Watch List</h1>
          <nav>
            <ol class="breadcrumb">
              <li class="breadcrumb-item active"><a href="#">Movies</a></li>
            </ol>
          </nav>
        </div><!-- End Page Title -->

          <!-- <div class="row pb-4 pt-4">
            <div class="col-lg-6">
              <?php
              // include 'filterGenre.php';
              ?>
              </div>

            <div class="col-lg-6">
              <?php
              //include 'pageNavigation.php'
              //include '../Controller/getPagination.php';
              ?>
              </div>
          </div> -->
        <?php
        //Error Reporting for the users
        if(isset($_GET['error']))
          {
            $error = $_GET['error'];
            echo $error;
          }
          ?>
          <section class="section">

            <h2>Page is Underconstruction.</h2>
            <img src="Images/not-found.svg" class="img-fluid py-5" alt="Page Not Found">



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
