<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Mechinary_model extends MY_Model {

    protected $tableName = 'machinary'; /* This is the table name */
    public $primaryKey = 'machinary_id';  /* This is the table primary key */

    public function __construct() {
        parent::__construct();
    }

  

}

?>