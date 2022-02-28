<?php
/*
    Description: Update User information

    Author: David McRae
 */

?>
<!DOCTYPE html>
<html>
<!-- <head> -->
<?php
include '../Controller/session.php';
include 'header.php';
include 'navbar.php';
?>
<!-- </head> -->
<title>Account Management</title>
<body>

<!-- contains the visible web page-->

<!-- Container for the Form -->
<div class="container">

<?php
if(isset($_GET['error']))
{
  $error = $_GET['error'];
  $error = str_replace(":","</br>", $error);
  echo $error;
}
?>
<!-- Form -->
  <form class='mt-5 form-group needs-validation' action='../Controller/attemptUpdateUser.php' method='POST' novalidate>

      <div class='form-group input-group'>
        <div class='input-group-prepend'>
          <span class='input-group-text' id='inputGroupPrepend'>Username</span>
        </div>
          <input class='form-control' type='text' id='username' name='username' value='<?php echo $_SESSION['username'];?>' required>
            <div class='invalid-feedback'>
              You cannot Leave This field Empty.
            </div>
        </div>

      <div class='form-group input-group'>
        <div class='input-group-prepend'>
          <span class='input-group-text' id='inputGroupPrepend'>Password</span>
        </div>
          <input class='form-control' type='password' id='password' name='password' placeholder='Password' required>
            <div class='invalid-feedback'>
              You cannot Leave This field Empty.
            </div>
        </div>

      <div class='form-group input-group'>
        <div class='input-group-prepend'>
          <span class='input-group-text' id='inputGroupPrepend'>Password Confirmation</span>
        </div>
        <input class='form-control' type='password' id='passwordConfirm' name='passwordConfirm' placeholder='Password Confirmation' required>
        <div class='invalid-feedback'>
          You cannot Leave This field Empty.
        </div>
      </div>

      <button class='form-control' type='submit' name='updateUserSubmit'>Update</button>
  </form>
<!-- End Form -->
</div>
<!-- End Form Container -->

<?php
include 'footer.php';
include '../Controller/bootstrapScript.php';
include '../Controller/ValidateEmptyFields.js';
include '../Controller/ajaxScript.php';
include '../Controller/navControl.js';
?>
</body>
</html>
