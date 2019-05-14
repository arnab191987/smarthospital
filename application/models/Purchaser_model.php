<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Purchaser_model extends MY_Model {

    protected $tableName = 'purchaser'; /* This is the table name */
    public $primaryKey = 'purchaser_id';  /* This is the table primary key */

    public function __construct() {
        parent::__construct();
    }

  

}

?>
