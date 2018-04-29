<?php

/**
 * Handle all requests.
 */
class FrontController {

  /**
   * The names of the controller class.
   *
   * @var string
   */
  protected $controller;

  /**
   * The names of the action method.
   *
   * @var string
   */
  protected $action;

  /**
   * The params route.
   *
   * @var array
   */
  protected $params;

  /**
   * The body content.
   *
   * @var mixed
   */
  protected $body;

  /**
   * The singleton instance.
   *
   * @var FrontController
   */
  private static $instance;

  /**
   * Returns a singleton of the FrontController.
   *
   * @return self
   */
  public static function getInstance() {
    if (empty(self::$instance)) {
      self::$instance = new self();
    }
    return self::$instance;
  }

  /**
   * Create a new FrontController instance.
   *
   * @return void
   */
  private function __construct() {
    $request = $_SERVER['REQUEST_URI'];
    $splits = explode('/', trim($request, '/'));
    // Set controller.
    $this->controller = !empty($splits[0]) ? ucfirst($splits[0]) . 'Controller' : 'IndexController';
    // Set action.
    $this->action = !empty($splits[1]) ? $splits[1] . 'Action' : 'indexAction';
    // Check parameters and their meanings.
    if (!empty($splits[2])) {
      $keys = $values = [];
      for ($i = 2, $cnt = count($splits); $i < $cnt; $i++) {
        if ($i % 2 == 0) {
          // Even = key (parameter)
          $keys[] = $splits[$i];
        }
        else {
          // Parameter value.
          $values[] = urldecode($splits[$i]);
        }
      }
      $this->params = array_combine($keys, $values);
    }
  }

  /**
   * Running the application.
   *
   * @return void
   */
  public function run() {
    if (class_exists($this->getController())) {
      $rc = new ReflectionClass($this->getController());
      if ($rc->hasMethod($this->getAction())) {
        self::setStatus(200);
        $controller = $rc->newInstance();
        $method = $rc->getMethod($this->getAction());
        $method->invoke($controller);
      }
      else {
        self::setError(404);
      }
    }
    else {
      self::setError(404);
    }
  }

  /**
   * Sets the status message for invalid values.
   *
   * @param int $status
   *
   * @return void
   */
  public static function setStatus($status) {
    switch ($status) {
      case 200:
        header('HTTP/1.1 200 Ok');
        break;

      case 404:
        header('HTTP/1.1 404 Not Found');
        break;
    }
  }

  /**
   * Sets the error message for invalid values.
   *
   * @param int $status
   *
   * @return void
   */
  public static function setError($status) {
    switch ($status) {
      case 404:
        header('Content-type: text/html; charset=utf8');
        self::setStatus($status);
        print '<h3>Page not found</h3>';
        exit;
      break;
    }
  }

  /**
   * Get query parameters.
   *
   * @return array
   */
  public function getParams() {
    return $this->params;
  }

  /**
   * Get controller class.
   *
   * @return string
   */
  public function getController() {
    return $this->controller;
  }

  /**
   * Get action method.
   *
   * @return string
   */
  public function getAction() {
    return $this->action;
  }

  /**
   * Get body content.
   *
   * @return mixed
   */
  public function getBody() {
    return $this->body;
  }

  /**
   * Set body content.
   *
   * @param  string  $body
   */
  public function setBody($body) {
    $this->body = $body;
  }

}
