
<?php

include '../Controller/session.php';
include 'header.php';
include 'navbar.php';
if(isset($_SESSION['username']) && $_SESSION['admin'] === true)
{
  if(isset($_GET['error']))
  {
    $error = $_GET['error'];
    $error = str_replace(":","</br>", $error);
    echo $error;
  }
      echo "

      <body>
        <div class='container primaryDark'>
          <div class='page-header'>
              <h1 class='primaryDark'>Insert Series</h1>
          </div>

          <div class='container'>

              <form class='form-group needs-validation' method='POST' action='../Controller/attemptInsertSeries.php' enctype='multipart/form-data' novalidate>

                  <div class='form-group input-group' form-group-lg>
                    <div class='input-group-prepend'>
                      <span class='input-group-text' id='inputGroupPrepend'>Series Name</span>
                    </div>
                      <input class='form-control' type='text' name='seriesName' placeholder='Title' required>
                  </div>

                  <hr />

                  <div class='form-group input-group' form-group-lg>
                    <div class='input-group-prepend'>
                      <span class='input-group-text' id='inputGroupPrepend'>Year</span>
                    </div>
                      <input class='form-control' type='text' name='year' placeholder='2020'>
                  </div>

                  <div class='form-group input-group'>
                    <div class='input-group-prepend'>
                      <span class='input-group-text' id='inputGroupPrepend'>Decription</span>
                    </div>
                      </br>
                      <textarea class='form-control' type='text' name='description' placeholder='Description' rows='5'></textarea>
                  </div>

                  <div class='form-group input-group' form-group-lg>
                    <div class='input-group-prepend'>
                      <span class='input-group-text' id='inputGroupPrepend'>Genre</span>
                    </div>
                      <input class='form-control' type='text' name='genre' placeholder='Genre'>
                  </div>

                  <div class='form-group input-group' form-group-lg>
                    <div class='input-group-prepend'>
                      <span class='input-group-text' id='inputGroupPrepend'>Rating</span>
                    </div>
                      <input class='form-control' type='text' name='rating' placeholder='7'>
                  </div>

                  <div class='form-group input-group' form-group-lg>
                    <div class='input-group-prepend'>
                      <span class='input-group-text' id='inputGroupPrepend'>Certification</span>
                    </div>
                      <input class='form-control' type='text' name='certification' placeholder='18'>
                  </div>

                  <div class='form-group input-group' form-group-lg>
                    <div class='input-group-prepend'>
                      <span class='input-group-text' id='inputGroupPrepend'>Runtime</span>
                    </div>
                      <input class='form-control' type='text' name='runtime' placeholder='90'>
                  </div>

                  <div class='form-group input-group' form-group-lg>
                    <div class='input-group-prepend'>
                      <span class='input-group-text' id='inputGroupPrepend'>Image</span>
                    </div>
                      <input class='form-control' type='text' name='image' placeholder='Path to Poster image'>
                  </div>


                  <div class='form-group input-group' form-group-lg>
                    <div class='input-group-prepend'>
                      <span class='input-group-text' id='inputGroupPrepend'>Cast</span>
                    </div>
                      <input class='form-control' type='text' name='cast' placeholder=''>
                  </div>

                  <button class='form-control' type='submit' name='insertMovieSubmit'>Insert Movie</button>
              </form>
          </div>
      </div>
      ";
      include 'footer.php';
      include '../Controller/bootstrapScript.php';
      include '../Controller/ValidateEmptyFields.js';
      include '../Controller/ajaxScript.php';
      include '../Controller/navControl.js';
      echo "
      </body>
      </html>
      ";
}
else
{
  header("Location: ../index.php?error=ACCESS DENIED");
  //TODO: error when not logged in-displays error and dosent relocate user to index
}
?>
