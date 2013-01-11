<?php

class InboxController { 
  
  private $db;
  private $view;
  
  public function __construct($db, $view) {
    $this->db = $db;
    $this->views = $view;
  }

  public function showInbox() {
    // Shows the full inbox view, includes all active, played, ignored
  }

  public function showActive() {
    // Shows only active requests (those not marked played or ignored) 
  }

  public function showPlayed() {
    // Shows all requests marked played

  }

  public function showIgnored() {
    // Shows all requests marked ignored

  }

  public function showArchive() {
    // Show all archived requests
    // we might need more functions to sort by date/session
  }

  public function getNewRequests() {
    // Gets all new requests since the last pull
  }

  public function respondToRequest($id, $response) {
    // Sends a message to requester

  }
  
  public function markRequest($id, $mark) {
    // Marks a request as played or ignored

  }

  public function archiveRequest($id) {
    // Archive specific a request by its id
  }

  public function archiveAllRequests() {
    // Archives every request in inbox
    // should have an option to do this on logout

  }

}

?>
