<?php
class auth_digest {
  private $data;

  function __construct($txt) {
    // protect against missing data
    $needed_parts = array('nonce'=>1, 'nc'=>1, 'cnonce'=>1, 'qop'=>1, 'username'=>1, 'uri'=>1, 'response'=>1);
    $this->data = array();

    $txt = explode(',', $txt);
    foreach ($txt as $param) {
      list($k, $v) = explode("=", $param, 2);
      $this->data[$k] = trim($v, "\"'");
      unset($needed_parts[$k]);
    }
    if ($needed_parts) throw new InvalidArgumentException(implode(";",$txt), 1);
  }
  function __get($k) {
    if (!isset($this->data[$k]))
      throw new InvalidArgumentException("Digest does not contain '$k'", 2);
    return $this->data[$k];
  }
  function valid_response($A1) {
    $A2 = md5($_SERVER['REQUEST_METHOD'] . ':' . $this->data['uri']);
    $valid_response = md5(
      $A1 . ':' .
      $this->data['nonce'] . ':' .
      $this->data['nc'] . ':' .
      $this->data['cnonce'] . ':' .
      $this->data['qop'] . ':' . $A2
    );
    return $this->data['response'] == $valid_response;
  }
}

class authorizer {
  private $realm;
  private $users; // arrayIterator over array ('username' => 'password')
  private $plainpass; // TRUE if $users stores passwords in plain text

  function __construct($auth_realm, ArrayIterator $userIterator,
$plainpw = TRUE) {
    $this->realm = $auth_realm;
    $this->users = $userIterator;
    $this->plainpass = $plainpw;
  }
  static private function parse_digest($txt) {  // parse the http auth header
    // protect against missing data
    $needed_parts = array('nonce'=>1, 'nc'=>1, 'cnonce'=>1, 'qop'=>1, 'username'=>1, 'uri'=>1, 'response'=>1);
    $data = array();

    $txt = explode(',', $txt);
    foreach ($txt as $param) {
      list($k, $v) = explode("=", $param, 2);
      $data[$k] = trim($v, "\"'");
      unset($needed_parts[$k]);
    }
    return $needed_parts ? FALSE : $data;
  }
  private static function gen_nonce() {
    return date('Ymd') . uniqid();
  }
  private static function nonceok($nonce) {
    return date('Ymd') == substr($nonce, 0, 8);
  }
  private static function unauth($status_text, $body) {
    header("HTTP/1.1 403 $status_text");
    die($body);
  }
  private function getlogin() { // dies
    header('HTTP/1.1 401 Unauthorized');
    header('WWW-Authenticate: Digest realm="' . $this->realm .
     '",qop="auth",nonce="' . self::gen_nonce() . '",opaque="' . md5($this->realm) . '"');
    // display if user hits Cancel
    die('OK, you obviously know when you are beaten.');
  }
  function check() {
    if (empty($_SERVER['PHP_AUTH_DIGEST'])) $this->getlogin();

    // analyze the PHP_AUTH_DIGEST variable
    try {
      $d = new auth_digest($digest_text = $_SERVER['PHP_AUTH_DIGEST']);
    }
    catch (InvalidArgumentException $e) {
      self::unauth('Bad Credentials', "Parse error: $digest_text");
    }
    if (!isset($this->users[$uname = $d->username]))
      self::unauth('Unauthorized user', "Wrong credentials: user '$uname' unknown.");

    // check valid response
    $A1 = $this->users[$uname];
    if ($this->plainpass) $A1 = md5("$uname:{$this->realm}:$A1");
    if (!$d->valid_response($A1))
      self::unauth('Invalid Response', "Wrong credentials: digest=$digest_text");
    if (!self::nonceok($d->nonce)) $this->getlogin();
    return $uname;
  }
}

