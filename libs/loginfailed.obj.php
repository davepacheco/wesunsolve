<?php
/**
 * LoginFailed object
 *
 * @author Gouverneur Thomas <tgo@ians.be>
 * @copyright Copyright (c) 2011, Gouverneur Thomas
 * @version 1.0
 * @package objects
 * @category classes
 * @subpackage backend
 * @filesource
 */


class LoginFailed extends mysqlObj
{
  /* Data Var */
  public $id = -1;
  public $when = 0;
  public $ip = "";
  public $login = "";
  public $pass = "";
  public $agent = "";

 /**
  * Constructor
  */
  public function __construct($id=-1)
  {
    $this->id = $id;
    $this->_table = "login_failed";
    $this->_nfotable = "";
    $this->_my = array(
                        "id" => SQL_INDEX,
                        "when" => SQL_PROPE,
                        "ip" => SQL_PROPE,
                        "login" => SQL_PROPE,
                        "pass" => SQL_PROPE,
			"agent" => SQL_PROPE
                 );

    $this->_myc = array( /* mysql => class */
                        "id" => "id",
                        "when" => "when",
                        "ip" => "ip",
                        "login" => "login",
                        "pass" => "pass",
                        "agent" => "agent"
                 );
  }

}
?>
