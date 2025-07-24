<?php

class PHP_Email_Form {
  public $to = '';
  public $from_name = '';
  public $from_email = '';
  public $subject = '';
  public $smtp = false;
  public $ajax = false;
  private $messages = [];

  public function add_message($content, $label = '', $length = 0) {
    if ($length > 0 && strlen($content) < $length) return;
    $this->messages[] = "$label: $content";
  }

  public function send() {
    $body = implode("\n", $this->messages);
    $headers = "From: {$this->from_name} <{$this->from_email}>\r\n";
    $headers .= "Reply-To: {$this->from_email}\r\n";

    return mail($this->to, $this->subject, $body, $headers) ? 'OK' : 'Could not send message.';
  }
}
