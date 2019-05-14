<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Bill_model extends MY_Model {

    protected $tableName = 'bill'; /* This is the table name */
    public $primaryKey = 'bill_id';  /* This is the table primary key */

    public function __construct() {
        parent::__construct();
    }

  

}

?>