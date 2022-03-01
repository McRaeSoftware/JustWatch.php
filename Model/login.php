<?php //Login User
function AttemptLogin()
{
  Require 'connection.php';

  if (isset($_POST["LoginSubmit"]))
  {
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

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
          $bool = true;
        }
        else
        {
          $bool = false;
        }

        $_SESSION['admin'] = $bool;

        header("Location:../View/movies.php");
      }
      else
      {
        // Password is incorrect
        $invalidError = "Invalid Credentials";
        header('location: ../View/Login.php?error='.$invalidError);
      }
    }
    else
    {
      // no records found
      $invalidError = "Invalid Credentials";
      header('location: ../View/Login.php?error='.$invalidError);
    }
  }
}
?>
