<?php

include '../Controller/session.php';
include 'header.php';
// include 'navbar.php';
include 'sidebar.php';
if(isset($_SESSION['username']) && $_SESSION['admin'] === true)
{
  include '../Controller/getAllMovies.php';

echo "
<body>
<main id='main' class='main'>
  <div class='container primaryDark'>
  <div class='pagetitle'>
    <h1>Remove Movies</h1>
    <nav>
      <ol class='breadcrumb'>
        <li class='breadcrumb-item'><a href='adminNavigation.php'>Admin</a></li>
        <li class='breadcrumb-item active'><a href='removeMovie.php'>Remove</a></li>
      </ol>
    </nav>
  </div><!-- End Page Title -->
          ";

    echo "
    <table class='table border border-dark'>
      <thead class='thead-dark'>
        <tr>
          <th scope='col'>Movie ID</th>
          <th scope='col'>Title</th>
          <th scope='col'>Delete Movie</th>
        </tr>
      </thead>";

        for ($i=0 ; $i < sizeof($movieArray) ; $i++)
        {
          //echo "<div class='border border-success'>";
          echo "<tr>";
          echo "<td>".$movieArray[$i]->Movie_ID."</td>";
          echo "<td>".$movieArray[$i]->Title."</td>";
          echo "<td><a class='btn btn-danger text-light' data-toggle='modal' data-target='#delete".$movieArray[$i]->Movie_ID."Modal'>DELETE</a></td>";
          echo "</tr>";
          echo "<div class='modal fade' id='delete".$movieArray[$i]->Movie_ID."Modal' tabindex='-1' role='dialog' aria-labelledby='deleteModalLabel' aria-hidden='true'>
                  <div class='modal-dialog' role='document'>
                    <div class='modal-content bg-dark'>
                      <div class='modal-header'>
                        <h5 class='modal-title' id='deleteModalLabel'>Are You Sure?</h5>
                        <button type='button' class='close btn btn-dark' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                      </div>
                      <div class='modal-body'>
                        <p>Are you sure you want to delete ".$movieArray[$i]->Title."?<p>
                      </div>
                      <div class='modal-footer'>
                        <button type='button' class='btn btn-outline-warning' data-dismiss='modal'>No!</button>
                        <a class='btn btn-outline-danger' role='button' href='../Controller/attemptDeleteMovie.php?id=".$movieArray[$i]->Movie_ID."'>DELETE</a>
                      </div>
                    </div>
                  </div>
                </div>";
        }
      echo "
      </table>
    </div>
  </div>
  </div>
</section>
</main>
  ";

  include 'footer.php';
  include '../Controller/bootstrapScript.php';
  include '../Controller/ajaxScript.php';
  include '../Controller/navControl.js';
echo "

</body>
";
}
else
{
  header("Location: index.php?error=ACCESS DENIED");
}
?>
