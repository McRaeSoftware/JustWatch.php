<html>
<?php
  /*
      Authors: David McRae, Oliver Dickens
   */
    include '../Controller/session.php';
    include 'header.php';
?>
  <body>
    <div id="loginPage" class="col-12 no-gutters">
      <div class="container col-6 text-center mt-5">
      <h1>LOG IN</h1><br>
      <?php //Error Reporting for the user
        if(isset($_GET['error']))
        {
          $error = $_GET['error'];
          echo $error;
        }
        ?>
        <?php echo '<form class="form-group needs-validation" action="../Controller/attemptLogin.php" method="POST" novalidate>'?>

        <div class="form-group">
            <input class="form-control" type="text" id="username" name="username" placeholder="Username" required>
            <div class="invalid-feedback">
              You cannot Leave This field Empty.
            </div>
        </div>
        <div class="form-group">
            <input class="form-control" type="password" id="password" name="password" autocomplete="off" placeholder="Password" required>
            <div class="invalid-feedback">
              You cannot Leave This field Empty.
            </div>
        </div>
          <br><button class="form-control" type="submit" name="LoginSubmit" value="Login">Login</button>
      </form>
      </div>

  </div>
</body>
<style>
.container {
  color: #ffffff;
  padding-top: 5%;
  letter-spacing: 1px;
}
.form-control{
  border-radius: 10em;
}

</style>
<?php
require '../Controller/bootstrapScript.php';
require '../Controller/ValidateEmptyFields.js';
?>
</html>
