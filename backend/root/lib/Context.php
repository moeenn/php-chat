<?php declare(strict_types = 1);

class Context {
  private string $m_httpMethod;
  private string $m_URL;
  private string $m_contentType;
  private $m_body;

  public function __construct() {
    $this->m_httpMethod = $_SERVER["REQUEST_METHOD"];
    $this->m_URL = $_SERVER["REQUEST_URI"];
    $this->m_contentType = (isset($_SERVER["CONTENT_TYPE"])) ? $_SERVER["CONTENT_TYPE"] : "application/json";
    
    if($this->m_httpMethod === "POST") {
      $this->m_body = json_decode(file_get_contents("php://input"));
    } else {
      $this->m_body = [];
    }
  }

  public function Method() : string {
    return $this->m_httpMethod;
  }

  public function URL() : string {
    return $this->m_URL;
  }

  public function ContentType() : string {
    return $this->m_contentType;
  }

  public function Body() {
    return $this->m_body;
  }

  public function Status(int $httpStatus) {
    http_response_code($httpStatus);
  }

  // send JSON back to the client
  public function Send($data) : void {
    header("Content-Type: {$this->m_contentType}");
    $json = json_encode($data);
    echo($json);
  }
}

?>