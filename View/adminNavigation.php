
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
  <div class="container text-center pb-5">
    <h1>Admin Screen</h1>
    <hr>

    <!-- Site Navigation -->
    <div class='row'>
      <div class='col-12'>
        <a class='btn btn-outline-primary btn-block' href='movies.php'>View Movies</a>
      </div>
    </div>

    <h4 class="mt-5">Manage Movies</h4><hr>
    <div class='row'>
      <div class='col-6 mt-5'>
        <a class='btn btn-outline-danger btn-block' href='insertMovie.php'>Add Movie</a>
      </div>
      <div class='col-6 mt-5'>
        <a class='btn btn-outline-danger btn-block' href='updateMovies.php'>Alter Movie</a>
      </div>
    </div>
    <div class='row'>
      <div class='col-6 mt-5'>
        <a class='btn btn-outline-danger btn-block' href='removeMovie.php'>Remove Movie</a>
      </div>
    </div>

    <h4 class="mt-5">Manage Series</h4>
    <hr>
    <div class='row'>
      <div class='col-6 mt-5'>
        <a class='btn btn-outline-danger btn-block' href='insertSeries.php'>Add Series</a>
      </div>
      <div class='col-6 mt-5'>
        <a class='btn btn-outline-danger btn-block' href='#'>Add Episode</a>
      </div>
    </div>
    <div class='row'>
      <div class='col-6 mt-5'>
        <a class='btn btn-outline-danger btn-block' href='#'>Alter Series</a>
      </div>
      <div class='col-6 mt-5'>
        <a class='btn btn-outline-danger btn-block' href='#'>Remove Series</a>
      </div>
    </div>
  </div>
</body>

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
