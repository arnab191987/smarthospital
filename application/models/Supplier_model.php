<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Supplier_model extends MY_Model {

    protected $tableName = 'supplier'; /* This is the table name */
    public $primaryKey = 'supplier_id';  /* This is the table primary key */

    public function __construct() {
        parent::__construct();
    }

  

}

?>
