<?php

require_once('views/List.php');

class Views {
  
  private $output;
  
  public function __construct() {
    $output = '';
  }
  
  public function showView($view, $options=NULL) {
    global $allowedViews;
    if (!in_array($view, $allowedViews)) {
      fatal_error('View Error', "View '$view' not in allowedViews");
    }

    global $viewOptions;
    $viewOptions = $options; 
    
    ob_start();
    require("views/{$view}.php");
    $this->output .= ob_get_contents();
    ob_end_clean();
  }
  
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
