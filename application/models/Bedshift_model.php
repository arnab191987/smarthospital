<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Bedshift_model extends MY_Model {

    protected $tableName = 'bed_shift'; /* This is the table name */
    public $primaryKey = 'bed_shift_id';  /* This is the table primary key */

    public function __construct() {
        parent::__construct();
    }

  

}

?>