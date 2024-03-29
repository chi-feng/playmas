<?php

if (!defined('INCLUDE_GUARD')) { header("HTTP/1.0 403 Forbidden"); die(); }

/**
 * View object to display views. Part of the MVC framework.
 *
 * @package default
 * @author Chi Feng
 */
class View {
  
  /**
   * Output buffer
   *
   * @var string
   */
  private $output;
  
  private $data;
  
  /**
   * Default constructor, initializes output buffer to emptystring.
   *
   * @author Chi Feng
   */
  public function __construct() {
    $output = '';
  }
  
  public function set($field, $value) {
    $this->data[$field] = $value;
  }
  
  public function get($field) {
    return $this->data[$field];
  }
  
  /**
   * Processes a view and stores output into buffer for deferred rendering
   *
   * @param string $view Name of view
   * @param string $options Passthrough for views
   * @return void
   * @author Chi Feng
   */
  public function show($view, $options=NULL) {

    global $views;

    if (!in_array($view, $views)) {
      throw new Exception("View '$view' not in allowedViews");
    }
    
    ob_start();
    require("views/{$view}.php");
    $this->output .= ob_get_contents();
    ob_end_clean();
    
  }
  
  /**
   * Renders the output buffer as html or json (raw text)
   *
   * @param string $format Output format, html or json
   * @return void
   * @author Chi Feng
   */
  public function render($format, $json=array()) {
    if ($format == 'html') {
      ob_start();
      require('views/site/header.php');
      echo $this->output;
      require('views/site/footer.php');
      ob_flush();
    } else if ($format == 'json') {
      header('Content-type: application/json');
      echo json_encode($json);
    } else {
      fatal_error('View Error', "Unknown render format '$format'");
    }
  }
  
}

?>
