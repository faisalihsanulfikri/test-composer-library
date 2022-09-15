<?php 

namespace Arteam\TestComposerLibrary;

class Index
{
  
  private $data;
  private $responseData;
  private $responseCode;

  public function __construct()
  {
    $this->setDefaultResponse();
  }

  public function send()
  {
    $this->build();
    
    return response()->json(
      $this->responseData,
      $this->responseCode
    );
  }

  public function build()
  {
    $components = ['code','status','message','error','data'];

    foreach ($components as $component) {
      if (array_key_exists($component, $this->data)) {
        $this->responseData[$component] = $this->data[$component];
      }
    }
  }

  public function setHttpCode(int $httpCode)
  {
    $this->responseCode = $httpCode;
    return $this;
  }

  public function setStatus(string $status)
  {
    $this->data["status"] = $status;
    return $this;
  }
  
  public function setCode(string $code)
  {
    $this->data["code"] = $code;
    return $this;
  }

  public function setMessage(string $message)
  {
    $this->data["message"] = $message;
    return $this;
  }

  public function setData($data)
  {
    if (is_array($data) || is_object($data)) {
      $this->data["data"] = $data;
    }    
    return $this;
  }

  public function setError($error)
  {
    if (is_array($error) || is_object($error)) {
      $this->data["error"] = $error;
    }
    return $this;
  }

  public function success()
  {
    $this->data["status"] = "success";
    $this->data["code"] = "200";
    $this->data["message"] = "Successfully connected";
    $this->responseCode = 200;
    return $this;
  }

  public function unauthorized()
  {
    $this->data["status"] = "error";
    $this->data["code"] = "401";
    $this->data["message"] = "unauthorized access";
    $this->responseCode = 401;
    return $this;
  }

  public function forbidden()
  {
    $this->data["status"] = "error";
    $this->data["code"] = "403";
    $this->data["message"] = "Forbidden access";
    $this->responseCode = 403;
    return $this;
  }

  public function badRequest()
  {
    $this->data["status"] = "failed";
    $this->data["code"] = "400";
    $this->data["message"] = "Bad request";
    $this->responseCode = 400;
    return $this;
  }
  
  public function notFound()
  {
    $this->data["status"] = "error";
    $this->data["code"] = "404";
    $this->data["message"] = "Data not found";
    $this->responseCode = 404;
    return $this;
  }

  public function invalidData()
  {
    $this->data["status"] = "error";
    $this->data["code"] = "422";
    $this->data["message"] = "Invalid data";
    $this->responseCode = 422;
    return $this;
  }

  private function setDefaultResponse()
  {
    $this->success();
    return $this;
  }
  
}