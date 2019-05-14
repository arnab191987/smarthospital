<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Bed_model extends MY_Model {

    protected $tableName = 'bed'; /* This is the table name */
    public $primaryKey = 'bed_id';  /* This is the table primary key */

    public function __construct() {
        parent::__construct();
    }

  

}

?>