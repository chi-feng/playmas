<?php

require_once('views/List.php');

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
  
  /**
   * Default constructor, initializes output buffer to emptystring.
   *
   * @author Chi Feng
   */
  public function __construct() {
    $output = '';
  }
  
  /**
   * Processes a view and stores output into buffer for deferred rendering
   *
   * @param string $view Name of view
   * @param string $options Passthrough for views
   * @return void
   * @author Chi Feng
   */
  public function showView($view, $options=NULL) {
    global $allowedViews;
    if (!in_array($view, $allowedViews)) {
      throw new Exception("View '$view' not in allowedViews");
    }

    global $viewOptions;
    $viewOptions = $options; 
    
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
  public function render($format) {
    if ($format == 'html') {
      ob_start();
      require('views/header.php');
      echo $this->output;
      require('views/footer.php');
      ob_flush();
    } else if ($format == 'json') {
      echo $this->output;
    } else {
      fatal_error('View Error', "Unknown render format '$format'");
    }
  }
  
}

?>
