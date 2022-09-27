<html>
<?php
  /*
      Authors: David McRae, Oliver Dickens
   */
    include '../Controller/session.php';
    include 'header.php';
?>

  <body>
    <main>
        <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
          <div class="container">
            <div class="row justify-content-center">
              <!-- Content -->
              <div class="col-lg-6 col-md-6 d-flex flex-column align-items-center justify-content-center">
                <div class="d-flex justify-content-center py-4 pt-4 pb-2">
                    <img src="Images/testlogoSmall.png" alt="">
                </div>
                  <h4 class="card-title text-center pb-0 fs-4">Login to Your Account</h4>
                <div id="loginPage" class="col-lg no-gutters">
                  <?php //Error Reporting for the user
                  if(isset($_GET['error']))
                  {
                    $error = $_GET['error'];
                    echo $error;
                  }
                  ?>
                  <?php echo '<form class="form-group needs-validation" action="../Controller/attemptLogin.php" method="POST" novalidate>'?>
                    <!-- Username -->
                    <div class="form-group col">
                      <input class="form-control" type="text" id="username" name="username" placeholder="Username" required>
                      <div class="invalid-feedback">You cannot Leave This field Empty.</div>
                    </div>
                    <!-- Password -->
                    <div class="form-group col">
                      <input class="form-control" type="password" id="password" name="password" autocomplete="off" placeholder="Password" required>
                      <div class="invalid-feedback">You cannot Leave This field Empty.</div>
                    </div>
                  <!--Button -->
                  <div class="col">
                    <button class="form-control btn btn-primary w-100" name="LoginSubmit" type="submit" value="Login">Login</button>
                  </div>
                </div>
              </form>
            </div><!-- End of Content -->
            </div>
          </div>
        </div>

      </section>
    </main>
  </body>
<?php
require '../Controller/bootstrapScript.php';
require '../Controller/ValidateEmptyFields.js';
?>
</html>
