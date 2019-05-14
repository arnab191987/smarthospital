<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Service_model extends MY_Model {

    protected $tableName = 'service'; /* This is the table name */
    public $primaryKey = 'service_id';  /* This is the table primary key */

    public function __construct() {
        parent::__construct();
    }

  

}

?>