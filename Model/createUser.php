<?php
// Create User
function CreateUser()
{
  Require 'connection.php';

  if (isset($_POST["registerSubmit"]))
  {
    $name = (filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING));
    $username = (filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING));
    $password = (filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING));
    $passwordConfirm = (filter_input(INPUT_POST, 'passwordConfirm', FILTER_SANITIZE_STRING));

    // Error checking variables
    $Error = false;
    $nameError;
    $usernameError;
    $passwordError;
    $passwordConfirmError;

    if (!preg_match("/^[a-zA-Z ]*$/",$name))
    {
      $Error = true;
      $nameError = ":Your name can only contain letters";
    }

    if(!preg_match("/^[a-zA-Z0-9]*$/", $username))//Username Must be letters & Numbers
    {
      $Error = true;
      $usernameError = ":Username Must Contain only letters and numbers";
    }

    if(!empty($password) && $password == $passwordConfirm) // Password & PasswordConfirm Must Match
    {
      if(strlen($password) <= '8')// Passowrd must be Atleast 8 characters
      {
        $Error = true;
        $passwordError = ":Password Must be Atleast 8 characters Long";
      }
      elseif(!preg_match("#[0-9]+#",$password)) // Password must contain a number
      {
        $Error = true;
        $passwordError = ":Your Password Must Contain At Least 1 Number!";
      }
      elseif(!preg_match("#[A-Z]+#",$password)) // Password Must contain an Uppercase letter
      {
        $Error = true;
        $passwordError = ":Your Password Must Contain At Least 1 Capital Letter!";
      }
      elseif(!preg_match("#[a-z]+#",$password))// Password Must Conatain a Lowercase letter
      {
        $Error = true;
        $passwordError = ":Your Password Must Contain At Least 1 Lowercase Letter!";
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
    $errorString = $nameError.$usernameError.$passwordError.$passwordConfirmError;
    header('Location: ../View/register.php?error='.$errorString);
  }
  else // Continue with the Registration
  {
    //Hash the password
    $password = password_hash($password, PASSWORD_DEFAULT);

    // Create SQL Template
    $query = $conncetion->prepare
    ("

    INSERT INTO User (Name, Username, Password)
    VALUES( :Name, :username, :password)

    ");

    $success = $query->execute
    ([
      'firstName' => $firstName,
      'username' => $username,
      'password' => $password
    ]);

    $count = $query->rowCount();
    if($count > 0)
    {
      echo "Insert Successful";
      header('Location: ../View/register.php?error=user created');
    }
    else
    {
      echo "Insert Failed";
    }
  }
}
?>
