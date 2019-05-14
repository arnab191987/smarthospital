<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Unit_model extends MY_Model {

    protected $tableName = 'unit'; /* This is the table name */
    public $primaryKey = 'id';  /* This is the table primary key */

    public function __construct() {
        parent::__construct();
    }

  

}

?>