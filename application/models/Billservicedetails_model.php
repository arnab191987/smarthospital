<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Billservicedetails_model extends MY_Model {

    protected $tableName = 'bill_service_details'; /* This is the table name */
    public $primaryKey = 'id';  /* This is the table primary key */

    public function __construct() {
        parent::__construct();
    }

  

}

?>