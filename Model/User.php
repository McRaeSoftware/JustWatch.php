<?php
class User
{
  protected $userID;
  protected $name;
  protected $username;
  private $password;
  protected $admin;

  function __construct($userID, $name, $username, $password, $admin = 0)
  {
    $this->userID = $userID;
    $this->name = $name;
    $this->username = $username;
    $this->password = $password;
    $this->admin = $admin;
  }

  function GetName()
  {
    return $this->name;
  }

  function GetUsername()
  {
    return $this->username;
  }

  function IsAdmin()
  {
    if($this->admin == "1")
    {
      return true;
    }
    else
    {
      return false;
    }
  }
}
?>
