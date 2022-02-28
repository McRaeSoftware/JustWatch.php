<?php
/*
    Description: Collection of Methods for the site

    Author: David McRae, Oliver Dickens
*/

//Create User
//Series=lines 500+
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

//Login User
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

//Logout User
function AttemptLogOut()
{
  session_start(); // Start Session / Resume Current Session
  session_destroy(); // Destroy Session
  header("Location: ../index.php"); // Redirect to index page
}

//Insert new Customer to database
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

//Read All Movies
function GetAllMovies($page)
{
  require_once 'connection.php';

  $amountPerPage = 50;

  $startAtRowNo = $page * $amountPerPage;
  $offset = $startAtRowNo - $amountPerPage;

  $sql = "SELECT * FROM Movie ORDER BY Year desc, Title asc LIMIT ".$offset.", ".$amountPerPage;

  $stmt = $connection->prepare($sql);
  $result = $stmt->fetch();
  $success = $stmt->execute();

  if($success && $stmt->rowCount() > 0)
  {
    //  convert to JSON
    $rows = array();
    while($r = $stmt->fetch())
    {
      $rows[] = $r;
    }
    return json_encode($rows);
  }
}

function GetMoviesByFilter($movieFilter)
{
  require_once 'connection.php';

  $sql = "SELECT * FROM Movie WHERE Title LIKE '%".$movieFilter."%' ORDER BY Title asc";

  $stmt = $connection->prepare($sql);
  $result = $stmt->fetch();
  $success = $stmt->execute();

  if($success && $stmt->rowCount() > 0)
  {
    //  convert to JSON
    $rows = array();
    while($r = $stmt->fetch())
    {
      $rows[] = $r;
    }
    return json_encode($rows);
  }
  else
  {
    header('Location ../View/movies.php?error=Filter Not Found');
  }
}

//Insert new Movie to database
function AttemptInsertMovie()
{
  Require 'connection.php';

  // Checks if submit button has been pressed
  if (isset($_POST['insertMovieSubmit']))
  {
    $title = (filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING));
    $video = (filter_input(INPUT_POST, 'video', FILTER_SANITIZE_STRING));
    $image = (filter_input(INPUT_POST, 'image', FILTER_SANITIZE_STRING));
    $description = (filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING));
    $genre = (filter_input(INPUT_POST, 'genre', FILTER_SANITIZE_STRING));
    $year = (filter_input(INPUT_POST, 'year',FILTER_SANITIZE_STRING ));

    $query = $connection->prepare
    ("

    INSERT INTO Movie (Title, Video_link, Image_link, Description, Genre, Year)
    VALUES (:title, :video, :image, :description, :genre, :year)

    ");

    $success = $query->execute
    ([
      'title' => $title,
      'video' => $video,
      'image' => $image,
      'description' => $description,
      'genre' => $genre,
      'year' => $year
    ]);

    $count = $query->rowCount();
    if($count > 0)
    {
      $validError = "Success";
      header('location: ../View/insertMovie.php?error='.$validError);
    }
    else
    {
      $invalidError = "Insert Failed";
      header('location: ../View/insertMovie.php?error='.$invalidError);
    }
  }
}

// Attempt to update a movies details
function AttemptUpdateMovie()
{
  Require 'connection.php';
  // Checks if submit button has been pressed
  if (isset($_POST['updateMovieSubmit']))
  {
    $movieid = (filter_input(INPUT_POST, 'index', FILTER_SANITIZE_STRING));

    // Once complete carry out the INSERT statement to database
    $title = (filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING));
    $video = (filter_input(INPUT_POST, 'video', FILTER_SANITIZE_STRING));
    $image = (filter_input(INPUT_POST, 'image', FILTER_SANITIZE_STRING));
    $description = (filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING));
    $genre = (filter_input(INPUT_POST, 'genre', FILTER_SANITIZE_STRING));
    $year = (filter_input(INPUT_POST, 'year', FILTER_SANITIZE_STRING));

    $query = $connection->prepare
    ("

    UPDATE Movie SET
    Title = :title,
    Video_link = :video,
    Image_link = :image,
    Description =:description,
    Genre = :genre,
    Year = :year
    WHERE Movie_ID = ".$movieid."

    ");

    $success = $query->execute
    ([
      'title' => $title,
      'video' => $video,
      'image' => $image,
      'description' => $description,
      'genre' => $genre,
      'year' => $year
    ]);

    $count = $query->rowCount();
    if($count > 0)
    {
      $validError = "Success";
      header('location: ../View/updateMovies.php?error='.$validError);
    }
    else
    {
      $invalidError = "Insert Failed";
      header('location: ../View/updateMovies.php?error='.$invalidError);
    }
  }
}
//TODO: When movie deleted include image delete as that sticks around
//Delete Movie from database
function RemoveMovieByID($movieid)
{
  require 'connection.php';

  $stmt = $connection->prepare
  (
    "DELETE FROM Movie WHERE Movie_ID = :movieid"
  );

  $success = $stmt->execute
  ([
    'movieid' => $movieid
  ]);

  if($success && $stmt->rowCount() > 0)
  {
    header('location: ../View/removeMovie.php');
  }
  else
  {
    header('location: ../View/removeMovie.php?error=FAILED');
  }
}

//Read Movie by ID index
function GetMovieByID($movieid)
{
  require 'connection.php';

  $query = $connection->prepare
  ("
    SELECT * FROM Movie WHERE Movie_ID = :movieid LIMIT 1
  ");

  $success = $query->execute
  ([
    'movieid' => $movieid
  ]);

  if($success && $query->rowCount() > 0)
  {
    $row = $query->fetch();
    return json_encode($row);
  }
  else
  {
    echo "Unable to find Movie";
  }
}

//Read All Series
function GetAllSeries($page)
{
  require_once 'connection.php';

  $amountPerPage = 50;

  $startAtRowNo = $page * $amountPerPage;
  $offset = $startAtRowNo - $amountPerPage;

    $sql = "SELECT * FROM Series GROUP BY Series_ID ORDER BY Year desc, Series_Name asc LIMIT ".$offset.", ".$amountPerPage;

  $stmt = $connection->prepare($sql);
  $result = $stmt->fetch();
  $success = $stmt->execute();

  if($success && $stmt->rowCount() > 0)
  {
    //  convert to JSON
    $rows = array();
    while($r = $stmt->fetch())
    {
      $rows[] = $r;
    }
    return json_encode($rows);
  }
}

function GetSeriesByFilter($seriesFilter)
{
  require_once 'connection.php';

  $sql = "SELECT * FROM Series WHERE Series_Name LIKE '%".$seriesFilter."%' ORDER BY Season_ID asc";

  $stmt = $connection->prepare($sql);
  $result = $stmt->fetch();
  $success = $stmt->execute();

  if($success && $stmt->rowCount() > 0)
  {
    //  convert to JSON
    $rows = array();
    while($r = $stmt->fetch())
    {
      $rows[] = $r;
    }
    return json_encode($rows);
  }
  else
  {
    header('Location ../View/series.php?error=Filter Not Found');
  }
}

function GetSeriesSeasons($seriesid)
{
  require 'connection.php';

  // SELECT all seeason id's where series id = series id
  $query = $connection->prepare
  ("
    SELECT * FROM Series WHERE Series_ID = :seriesid GROUP BY Season_ID
  ");

  $success = $query->execute
  ([
    'seriesid' => $seriesid
  ]);

  if($success && $query->rowCount() > 0)
  {
    //  convert to JSON
    $rows = array();
    while($r = $query->fetch())
    {
      $rows[] = $r;
    }
    return json_encode($rows);
  }
  else
  {
    echo "Unable to find Seasons";
  }
}

function GetSeasonEpisodes($seriesId, $seasonId)
{
  require 'connection.php';

  // SELECT all seeason id's where series id = series id
  $query = $connection->prepare
  ("
    SELECT * FROM Series WHERE Series_ID = :seriesId AND Season_ID = :seasonId
  ");

  $success = $query->execute
  ([
    'seriesId' => $seriesId,
    'seasonId' => $seasonId
  ]);

  if($success && $query->rowCount() > 0)
  {
    //  convert to JSON
    $rows = array();
    while($r = $query->fetch())
    {
      $rows[] = $r;
    }
    return json_encode($rows);
  }
  else
  {
    echo "Unable to find Episodes";
  }
}

function GetEpisode($seriesId, $seasonId, $episodeId)
{
  require 'connection.php';

  // SELECT all seeason id's where series id = series id
  $query = $connection->prepare
  ("
    SELECT * FROM Series WHERE Series_ID = :seriesId AND Season_ID = :seasonId AND Episode_ID = :episodeId
  ");

  $success = $query->execute
  ([
    'seriesId' => $seriesId,
    'seasonId' => $seasonId,
    'episodeId' => $episodeId
  ]);

  if($success && $query->rowCount() > 0)
  {
    $row = $query->fetch();
    return json_encode($row);
  }
  else
  {
    echo "Unable to find Episode";
  }
}
