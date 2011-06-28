<?php
/**
 * HTTP class
 *
 * @author Gouverneur Thomas <tgo@ians.be>
 * @copyright Copyright (c) 2007-2008, Gouverneur Thomas
 * @version 1.0
 * @package libs
 * @subpackage various
 * @category libs
 * @filesource
 */


class HTTP
{
  private static $_instance;    /* instance of the class */

  public $argc;
  public $argv;

  public static function Piwik($title) {
    global $config;
    @require_once('../../../libs/PiwikTracker.php');
     /* Log visit on piwik */
    $piwikTracker = new PiwikTracker( $config['piwikId'], $config['piwikUri']);
    $piwikTracker->setUrl( $_SERVER['REQUEST_URI'] );
    $piwikTracker->setTokenAuth( $config['piwikToken'] );
    $piwikTracker->doTrackPageView("Site News RSS Feed");
    return true;
  }

  public function parseUrl() {
    global $_SERVER;
    global $_GET;
    if (count($_GET)) {
	return;
    }
    if(!isset($_SERVER['PATH_INFO'])) {
      return;
    }
    $url = explode('/',$_SERVER['PATH_INFO']);
    $g = array();
    $idx = "";
    $val = "";
    for ($i=1,$s=0; $i<count($url); $i++) {
      if ($s == 0) {
	$idx = $url[$i];
	$g[$idx] = "";
	$s++;
      } else {
        $val = $url[$i];
	$g[$idx] = $val;
        $idx = "";
	$val = "";
	$s=0;
      }
    }
    $_GET = $g;
    return;
  }

 /**
  * return the instance of HTTP object
  */
  public static function getInstance()
  { 
    if (!isset(self::$_instance)) {
     $c = __CLASS__;
     self::$_instance = new $c;
    }
    return self::$_instance;
  }

 /**
  * Avoid the __clone method to be called
  */
  public function __clone()
  { 
    trigger_error("Cannot clone a singlton object, use ::instance()", E_USER_ERROR);
  }

 /**
  * Get the http post/get variable
  * @arg Name of the variable to get
  * @return the variable, with POST->GET priority
  */
  public function getHTTPVar($name) {
    global $_GET, $_POST;
   
    /* first check POST, then fallback on GET */
    if (isset($_POST[$name])) return $_POST[$name];
    if (isset($_GET[$name])) return $_GET[$name];
    return NULL;
  }

 /**
  * Sanitize an array by escaping the strings inside.
  * @arg Name of the variable to sanitize
  */
  public function sanitizeArray(&$var) {

    foreach($var as $name => $value) {

      if (is_array($value)) { 
        $this->sanitizeArray($value); 
        continue; 
      }

      $var[$name] = mysql_escape_string($value);

    }
  }

  public static function checkEmail($email) {
  if (!ereg("^[^@]{1,64}@[^@]{1,255}$", $email)) {
    return false;
  }
  $email_array = explode("@", $email);
  $local_array = explode(".", $email_array[0]);
  for ($i = 0; $i < sizeof($local_array); $i++) {
    if (!ereg("^(([A-Za-z0-9!#$%&'*+/=?^_`{|}~-][A-Za-z0-9!#$%&↪'*+/=?^_`{|}~\.-]{0,63})|(\"[^(\\|\")]{0,62}\"))$", $local_array[$i])) {
      return false;
    }
  }
  if (!ereg("^\[?[0-9\.]+\]?$", $email_array[1])) {
    $domain_array = explode(".", $email_array[1]);
    if (sizeof($domain_array) < 2) {
        return false; // Not enough parts to domain
    }
    for ($i = 0; $i < sizeof($domain_array); $i++) {
      if (!ereg("^(([A-Za-z0-9][A-Za-z0-9-]{0,61}[A-Za-z0-9])|↪([A-Za-z0-9]+))$",$domain_array[$i])) {
        return false;
      }
    }
  }
  return true;
}

}

?>
