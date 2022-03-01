<?php
//Insert Update User in database
function AttemptUpdateUser($existingUsername, $userid)
{
  Require 'connection.php';

  if (isset($_POST["updateUserSubmit"]))
  {
    $username = (filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING));
    $password = (filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING));
    $passwordConfirm = (filter_input(INPUT_POST, 'passwordConfirm', FILTER_SANITIZE_STRING));

    $Error = false;
    $usernameError;
    $passwordError;
    $passwordConfirmError;

    if(!preg_match("/^[a-zA-Z0-9]*$/", $username))//Username Must be letters & Numbers
    {
      $Error = true;
      $usernameError = ":Username Must Contain only letters and numbers";
    }

    if(!empty($password) && $password == $passwordConfirm) // Password & PasswordConfirm Must Match
    {
      $passwordError = ":Password Must be:8 characters:Contain 1 or more numbers:Contain 1 or more uppercase letter:Contain 1 or more lowercase letter";

      if(strlen($password) <= '8')// Passowrd must be Atleast 8 characters
      {
        $Error = true;
      }
      elseif(!preg_match("#[0-9]+#",$password)) // Password must contain a number
      {
        $Error = true;
      }
      elseif(!preg_match("#[A-Z]+#",$password)) // Password Must contain an Uppercase letter
      {
        $Error = true;
      }
      elseif(!preg_match("#[a-z]+#",$password))// Password Must Conatain a Lowercase letter
      {
        $Error = true;
      }
      else// No password errors have Occured
      {
        $PasswordError = ":Password Is Acceptable";
      }
    }
  }

  if(!empty($password) && $password != $passwordConfirm) // Password and PasswordConfirm do NOT Match
  {
    $Error = true;
    $passwordConfirmError = ":Please Check You've Confirmed Your Password!";
  }
  if(empty($password)) // Password Is Empty
  {
    $Error = true;
    $passwordError = ":Please enter a password";
  }

  if($Error == true) // An Error Has Occured
  {
    $errorString = $usernameError.$passwordError.$passwordConfirmError;
    header('Location: ../View/accountManagement.php?error='.$errorString);
  }
  else if($existingUsername !== $username) // make sure that username doesnt already exist
  {
    $usernameCheck = $connection->prepare
    ("

    SELECT Username FROM User
    WHERE Username = :username

    ");

    // Runs and executes the query
    $success = $usernameCheck->execute
    ([
      'username' => $username
    ]);

    $count = $usernameCheck->rowCount();
    if($count > 0)
    {
      header('location: ../View/accountManagement.php?error=:Username already exists');
    }
    else // Continue updating username and password
    {
      // Hash the password
      $password = password_hash($password, PASSWORD_DEFAULT);
      $passwordConfirm ="";

      // Create SQL Template
      $query = $connection->prepare
      ("

      UPDATE User SET Username = :username, Password = :password
      WHERE User_ID = :userid

      ");

      // Runs and executes the query
      $success = $query->execute
      ([
        'username' => $username,
        'password' => $password,
        'userid' => $userid
      ]);

      // If rows returned is more than 0 Let us know if it inserted or not.
      $count = $query->rowCount();
      if($count > 0)
      {
        $_SESSION['username'] = $username;
        header('location: ../View/accountManagement.php?error=:Update Successful');
      }
      else
      {
        header('location: ../View/accountManagement.php?error=:Update Failed');
      }
    }
  }
  else // update only the password
  {
    // Hash the password
    $password = password_hash($password, PASSWORD_DEFAULT);
    $passwordConfirm ="";

    // Create SQL Template
    $query = $connection->prepare
    ("

    UPDATE User SET Password = :password
    WHERE User_ID = :userid

    ");

    // Runs and executes the query
    $success = $query->execute
    ([
      'password' => $password,
      'userid' => $userid
    ]);

    // If rows returned is more than 0 Let us know if it inserted or not.
    $count = $query->rowCount();
    if($count > 0)
    {
      header('location: ../View/accountManagement.php?error=:Update Successful');
    }
    else
    {
      header('location: ../View/accountManagement.php?error=:Update Failed');
    }
  }
}
?>
