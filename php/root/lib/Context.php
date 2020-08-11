<?php declare(strict_types = 1);

class Context {
  private string $httpMethod;
  private string $URL;
  private string $contentType;
  private array $body;

  public function __construct() {
    $this->httpMethod = $_SERVER["REQUEST_METHOD"];
    $this->URL = $_SERVER["REQUEST_URI"];
    $this->contentType = (isset($_SERVER["CONTENT_TYPE"])) ? $_SERVER["CONTENT_TYPE"] : "application/json";
    
    if($this->httpMethod === "POST") {
      $this->body = (array) json_decode(file_get_contents("php://input"));
    } else {
      $this->body = [];
    }
  }

  public function Method() : string {
    return $this->httpMethod;
  }

  public function URL() : string {
    return $this->URL;
  }

  public function ContentType() : string {
    return $this->contentType;
  }

  public function Body() {
    return $this->body;
  }

  public function Status(int $httpStatus) {
    http_response_code($httpStatus);
  }

  // send JSON back to the client
  public function Send($data) : void {
    header("Content-Type: {$this->contentType}");
    $json = json_encode($data);
    echo($json);
  }
}

?>