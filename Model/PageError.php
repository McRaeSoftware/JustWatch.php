<?php
include_once 'Response.php';

class PageError extends Response
{
  public function __construct(bool $success = false, string $message = "")
  {
      $this->response->success = $success;
      $this->response->message = $message;
  }

  public function ErrorExists()
  {
    if(isset($_GET['error']))
    return $this->response->success = true;
    else
    return $this->response->success = false;
  }

  public function MsgExists()
  {
    if(isset($_GET['msg']))
    return $this->response->success = true;
    else
    return $this->response->success = false;
  }

  public function GetError()
  {
    if(isset($_GET['error']))
    {
      $error = $_GET['error'];
      $this->SetResponse(true, $error);
    }
    else
    $this->response = $this->SetResponse(false, "");

    return $this->response;
  }

  public function DisplayError()
  {
    if($this->ErrorExists())
    {
      $this->GetError();
      echo($this->response->message);
    }
  }

  public function GetMsg()
  {
    if(isset($_GET['msg']))
    {
      $msg = $_GET['msg'];
      $this->SetResponse(true, $msg);
    }
    else
    $this->SetResponse(false, "");

    return $this->response;
  }

  public function DisplayMsg()
  {
    if($this->MsgExists())
    {
      $this->GetMsg();
      echo($this->response->message);
    }
  }
}
