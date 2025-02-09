<?php
class Response
{
    public $response;

    public function __construct(bool $success = false, string $message = "")
    {
        $this->response = (object)["success" => $success, "message" => $message ];
    }

    public function SetResponse(bool $success, string $message, bool $replace = false)
    {
        if(!$replace)
        {
            $message = $this->response->message .= $message;
        }

        $this->response->success = $success;
        $this->response->message = $message;

        return $this->response;
    }
}
?>