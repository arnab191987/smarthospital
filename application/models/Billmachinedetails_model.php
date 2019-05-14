<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Billmachinedetails_model extends MY_Model {

    protected $tableName = 'bill_machine_details'; /* This is the table name */
    public $primaryKey = 'id';  /* This is the table primary key */

    public function __construct() {
        parent::__construct();
    }

  

}

?>