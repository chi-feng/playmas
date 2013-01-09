<?php

class Views {
  
  private $output;
  
  public function __construct() {
    $output = '';
  }
  
  public function showView($view, $options=NULL) {
    // TODO: check if $view is a valid view
    ob_start();
    require("views/{$view}.php");
    $this->output = ob_get_contents();
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
