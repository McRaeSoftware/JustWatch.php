<html>
<?php
/*
  Authors: David McRae
*/
  include '../Controller/session.php';
  include 'header.php';
?>
  <body>
    <div id="registerPage" class="col-12 no-gutters">
      <div class="container col-6 text-center mt-5">
      <h1>Register</h1><br>
      <?php //Error Reporting for the user
        if(isset($_GET['error']))
        {
          $error = $_GET['error'];
          echo $error;
        }
        ?>
        <?php echo '<form class="form-group needs-validation" action="../Controller/attemptregister.php" method="POST" novalidate>'?>

        <div class="form-group">
            <input class="form-control" type="text" id="username" name="username" placeholder="Username" required>
            <div class="invalid-feedback">
              This field must not be empty.
            </div>
        </div>
        <div class="form-group">
            <input class="form-control" type="text" id="email" name="email" placeholder="Email" required>
            <div class="invalid-feedback">
              This field must not be empty.
            </div>
        </div>
        <div class="form-group">
            <input class="form-control" type="password" id="password" name="password" autocomplete="off" placeholder="Password" required>
            <div class="invalid-feedback">
              This field must not be empty.
            </div>
        </div>
        <div class="form-group">
            <input class="form-control" type="password" id="passwordConfirm" name="passwordConfirm" autocomplete="off" placeholder="Password Confirmation" required>
            <div class="invalid-feedback">
              This field must not be empty.
            </div>
        </div>
          <br>
          <button class="form-control" type="submit" name="RegisterSubmit" value="Register">Register</button>
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
