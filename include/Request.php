<?php

class Request {

  private $id; //unique message id
  private $from; //from phone number
  private $to; //destination phone number
  private $userid; //destination user id
  private $received; //timestamp for when received
  private $seen; //timestamp for when seen by user
  private $archived; //bool whether or not it's been archived
  private $response; //bool whether accepted or denied
  private $responseMsg; //text of response message
  private $responseTime; //timestamp for response
  private $body; //request msg text
  private $songid; //external song info id

  public function __construct($array) {
    $this->id = $array['id'];
    $this->from = $array['from'];
    $this->to = $array['to'];
    $this->received = $array['$received'];
    $this->body = $array['$body'];
  }

  public function getID() {
    return $this->id;
  }
  public function getFrom() {
    return $this->from ;
  }
  public function getTo() {
    return $this->to ;
  }   
    
  public function getUserid() {
    return $this->userid ;
  }   
    
  public function getReceived() {
    return $this->received ;
  }   
    
  public function getSeen() {
    return $this->seen ;
  }   
    
  public function getArchived() {
    return $this->archived ;
  }   
    
  public function getResponse() {
    return $this->response ;
  }

  public function getResponseMsg() {
    return $this->responseMsg ;
  }

  public function getResponseTime() {
    return $this->responseTime ;
  }

  public function getBody() {
    return $this->body ;
  }   
    
  public function getSongid() {
    return $this->songid ;
  }

  public function setID($id) {
    $this->id = id;
  }
  public function setFrom($from) {
    $this->from = from;
  }
  public function setTo($to) {
    $this->to = to;
  }
  public function setUserid($userid) {
    $this->userid = userid;
  }
  public function setSeen($seen) {
    $this->seen = seen;
  }
  public function setArchived($archived) {
    $this->archived = archived;
  }
  public function setResponse($response) {
    $this->response = response;
  }
  public function setResponseMsg($responseMsg) {
    $this->responseMsg = responseMsg;
  }
  public function setResponseTime($responseTime) {
    $this->responseTime = responseTime;
  }
  public function setBody($body) {
    $this->body = body;
  }
  public function setSongid($songid) {
    $this->songid = songid;
  }

}

?>