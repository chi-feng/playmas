<?php

if (!defined('INCLUDE_GUARD')) { header("HTTP/1.0 403 Forbidden"); die(); }

class InboxController { 
  
  /**
   * Database handle
   *
   * @var Database an initialized Database object
   */
  private $db;
  
  /**
   * View hand
   *
   * @var View an initialized View object
   */
  private $view;
  
  /**
   * Constructor for InboxController
   *
   * @param Database $db an initialized Database object
   * @param View $view an initialized View object
   * @author Chi Feng
   */
  public function __construct($db, $view) {
    $this->db = $db;
    $this->view = $view;
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
