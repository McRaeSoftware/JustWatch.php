<?php
Require '../Model/User.php';
// Validate User properties
function ValidateUser($name, $username, $email, $password, $passwordConfirm = false, $existingUsername = false)
{
  $validationResponse = (object)["success" => true, 'message' => ""];

  if(!$passwordConfirm == false)
  {
    if(!empty($password) && $password == $passwordConfirm) // Password & PasswordConfirm Must Match
    {
      if(!empty($password) && $password != $passwordConfirm) // Password and PasswordConfirm do NOT Match
      {
        $validationResponse->success = false;
        $validationResponse->message = $validationResponse->message += ":Please Check You've Confirmed Your Password!";
      }
      if(empty($password)) // Password Is Empty
      {
        $validationResponse->success = false;
        $validationResponse->message = $validationResponse->message += ":Please enter a password";
      }
    }
  }

  if (!preg_match("/^[a-zA-Z ]*$/",$name))
  {
    $validationResponse->success = false;
    $validationResponse->message = $validationResponse->message += ":Your name can only contain letters";
  }
  if(!preg_match("/^[a-zA-Z0-9]*$/", $username))//Username Must be letters & Numbers
  {
    $validationResponse->success = false;
    $validationResponse->message = $validationResponse->message += ":Username Must Contain only letters and numbers";
  }
  if(strlen($password) <= '8')// Passowrd must be Atleast 8 characters
  {
    $validationResponse->success = false;
    $validationResponse->message = $validationResponse->message += ":Password Must be Atleast 8 characters Long";
  }
  if(!preg_match("#[0-9]+#",$password))// Password must contain a number
  {
    $validationResponse->success = false;
    $validationResponse->message = $validationResponse->message += ":Your Password Must Contain At Least 1 Number!";
  }
  if(!preg_match("#[A-Z]+#",$password))// Password Must contain an Uppercase letter
  {
    $validationResponse->success = false;
    $validationResponse->message = $validationResponse->message += ":Your Password Must Contain At Least 1 uppercase Letter!";
  }
  if(!preg_match("#[a-z]+#",$password))// Password Must Conatain a Lowercase letter
  {
    $validationResponse->success = false;
    $validationResponse->message = $validationResponse->message += ":Your Password Must Contain At Least 1 Lowercase Letter!";
  }

  if($existingUsername !== false)
  {
    if($existingUsername !== $username) // make sure that username doesnt already exist
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
        $validationResponse->success = false;
        $validationResponse->message = $validationResponse->message += ":Username already exists!";
      }
    }
  }
  return $validationResponse;
}
// Crud -> Create User in Database
function CreateUser($name, $username, $email, $password, $passwordConfirm)
{
  Require '../Model/connection.php';
  $createResponse = (object)["success" => false, 'message' => ""];

  if (isset($_POST["registerSubmit"]))
  {
    $name = (filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING));
    $username = (filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING));
    $email = (filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL));
    $password = (filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING));
    $passwordConfirm = (filter_input(INPUT_POST, 'passwordConfirm', FILTER_SANITIZE_STRING));

    $validationResponse = ValidateUser($name, $username, $email, $password, $passwordConfirm);

    if($validationResponse->success == false) // An Error Has Occured
    {
      $createResponse->success = false;
      $createResponse->message = ":Validation Error";
    }
    else // Continue with the Registration
    {
      //Hash the password
      $password = password_hash($password, PASSWORD_DEFAULT);

      // Create SQL Template
      $query = $connection->prepare
      ("
        INSERT INTO User (Name, Username, Password)
        VALUES(:Name, :username, :password)
      ");

      $success = $query->execute
      ([
        'Name' => $name,
        'username' => $username,
        'password' => $password
      ]);

      $count = $query->rowCount();
      if($count > 0)
      {
        $createResponse->success = true;
        $createResponse->message = ":Create Success";
      }
      else
      {
        $createResponse->success = false;
        $createResponse->message = ":Create Failed";
      }
    }
  }
  return $createResponse;
}
// cRud -> Login user
function Login($username, $password)
{
  Require '../Model/connection.php';
  $loginResponse = (object)["success" => false, 'message' => ""];

  if (isset($_POST["LoginSubmit"]))
  {
    $sql = "SELECT * FROM User WHERE Username = :username";

    $stmt = $connection->prepare($sql);
    $success = $stmt->execute(['username' => $username]);

    if($success && $stmt->rowCount() > 0)
    {
      $result = $stmt->fetch();

      if ($result && password_verify($password, $result['Password']))
      {
        $_SESSION['userid'] = $result['User_ID'];
        $_SESSION['username'] = $result['Username'];
        if($result['Admin'] === '1')
        {
          $adminBool = true;
        }
        else
        {
          $adminBool = false;
        }

        $_SESSION['admin'] = $adminBool;
        $loginResponse->success = true;
        $loginResponse->message = ":Logged in";
      }
      else
      {
        // Password is incorrect
        $loginResponse->success = false;
        $loginResponse->message = ":Invalid Credentials";
      }
    }
    else
    {
      // Username is incorrect
      $loginResponse->success = false;
      $loginResponse->message = ":Invalid Credentials";
    }
  }
  return $loginResponse;
}
// crUd -> Update User in database
function UpdateUser($userid, $existingUsername = false)
{
  Require '../Model/connection.php';
  $updateResponse = (object)["success" => false, 'message' => ""];

  if (isset($_POST["updateUserSubmit"]))
  {
    $name = (filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING));
    $username = (filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING));
    $email = (filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL));
    $password = (filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING));
    $passwordConfirm = (filter_input(INPUT_POST, 'passwordConfirm', FILTER_SANITIZE_STRING));

    $validationResponse = ValidateUser($name, $username, $email, $password, $passwordConfirm, $existingUsername);

    if($validationResponse->success == false) // An Error Has Occured
    {
      $createResponse->success = false;
      $createResponse->message = ":Validation Error";
    }
    else // Continue with the Update
    {
      // Hash the password
      $password = password_hash($password, PASSWORD_DEFAULT);
      $passwordConfirm ="";

      // Create SQL Template
      $query = $connection->prepare
      ("

      UPDATE User SET Name = :name, Username = :username, Email = :email, Password = :password
      WHERE User_ID = :userid

      ");

      // Runs and executes the query
      $success = $query->execute
      ([
        'name' => $name,
        'username' => $username,
        'email' => $email,
        'password' => $password,
        'userid' => $userid
      ]);

      // If rows returned is more than 0 Let us know if it inserted or not.
      $count = $query->rowCount();
      if($count > 0)
      {
        $_SESSION['username'] = $username;
        $createResponse->success = true;
        $createResponse->message = ":Update Success";
      }
      else
      {
        $createResponse->success = false;
        $createResponse->message = ":Update Failed";
      }
    }
  }
  return $updateResponse;
}
//cruD -> Delete User from database
function DeleteUser($userid)
{
  Require '../Model/connection.php';
  $deleteResponse = (object)["success" => false, 'message' => ""];

  $stmt = $connection->prepare
  (
    "DELETE FROM USer WHERE User_ID = :userid"
  );

  $success = $stmt->execute
  ([
    'userid' => $userid
  ]);

  if($success && $stmt->rowCount() > 0)
  {
    $createResponse->success = true;
    $createResponse->message = ":User Deleted";
  }
  else
  {
    $createResponse->success = false;
    $createResponse->message = ":Delete Failed";
  }
  return $deleteResponse;
}
//Logout User
function Logout()
{
  $logoutResponse = (object)["success" => false, 'message' => ""];

  if(session_destroy())
  {
    $logoutResponse->success = true;
    $logoutResponse->message = ":logged out";
  }
  else
  {
    $logoutResponse->success = false;
    $logoutResponse->message = ":logout Failed";
  }
  return $logoutResponse;
}
?>
