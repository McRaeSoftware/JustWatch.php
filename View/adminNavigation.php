
<?php
/*
Authors: David McRae & Oliver Dickens
*/
include '../Controller/session.php';

if(isset($_SESSION['username']) && $_SESSION['admin'] === true)
{

include 'header.php';
// include 'navbar.php';
include 'sidebar.php';
?>
<body>
  <main id="main" class="main">
    <div class="pagetitle">
      <h1>Admin Page</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item active"><a href="adminNavigation.php">Admin</a></li>
        </ol>
      </nav>
    </div><!-- End Page Title -->



      <div class="row">
      <div class="col">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Manage Movies</h5>
            <!-- List group With badges -->
            <ul class="list-group">
              <li class="list-group-item d-flex justify-content-between align-items-center">
                View Movies
                <a button type="button" class='btn btn-secondary' data-bs-toggle="tooltip" data-bs-placement="bottom" title="View Movies" href='movies.php'><i class="bi bi-collection"></i></button></a>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center">
                Add Movie
                <a button type="button" class='btn btn-success' data-bs-toggle="tooltip" data-bs-placement="bottom" title="Add Movies" href='insertMovie.php'><i class="bi bi-check-circle"></i></button></a>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center">
                Alter Movies
                <a button type="button" class='btn btn-warning' data-bs-toggle="tooltip" data-bs-placement="bottom" title="Alter Movies" href='updateMovies.php'><i class="bi bi-exclamation-triangle"></i></button></a>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center">
                Remove Movies
                <!-- <button type="button" class="btn btn-danger" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Remove Movies" href='removeMovie.php'><i class="bi bi-exclamation-octagon"></i></button> -->
                <a button type="button" class='btn btn-danger' data-bs-toggle="tooltip" data-bs-placement="bottom" title="Remove Movies" href='removeMovie.php'><i class="bi bi-exclamation-octagon"></i></button></a>
              </li>
            </ul><!-- End List With badges -->
          </div>
        </div>
      </div>

  <div class="col">
<div class="card">
<div class="card-body">
  <h5 class="card-title">Manage Series</h5>

  <!-- List group With badges -->
  <ul class="list-group">
    <li class="list-group-item d-flex justify-content-between align-items-center">
      View Series
      <a button type="button" class='btn btn-secondary' data-bs-toggle="tooltip" data-bs-placement="bottom" title="View Series" href='series.php'><i class="bi bi-collection"></i></button></a>
    </li>
    <li class="list-group-item d-flex justify-content-between align-items-center">
      Add Series
      <a button type="button" class='btn btn-success' data-bs-toggle="tooltip" data-bs-placement="bottom" title="Add Series" href='insertSeries.php'><i class="bi bi-check-circle"></i></button></a>
    </li>
    <li class="list-group-item d-flex justify-content-between align-items-center">
      Alter Series
      <a button type="button" class='btn btn-warning' data-bs-toggle="tooltip" data-bs-placement="bottom" title="Alter Series" href='#'><i class="bi bi-exclamation-triangle"></i></button></a>
    </li>
    <li class="list-group-item d-flex justify-content-between align-items-center">
      Remove Series
      <a button type="button" class='btn btn-danger' data-bs-toggle="tooltip" data-bs-placement="bottom" title="Remove Series" href='#'><i class="bi bi-exclamation-octagon"></i></button></a>
    </li>
  </ul><!-- End List With badges -->

  </div>
  </div>
  </div>
  </div>
</main>
<?php
include 'footer.php';
include '../Controller/bootstrapScript.php';
include '../Controller/ajaxScript.php';
include '../Controller/navControl.js';
}
else
{
  header("Location: ../index.php?error=ACCESS DENIED");
}
?>
</body>
