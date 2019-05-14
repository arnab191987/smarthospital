<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Birthcertificate_model extends MY_Model {

    protected $tableName = 'birthcertificate'; /* This is the table name */
    public $primaryKey = 'id';  /* This is the table primary key */

    public function __construct() {
        parent::__construct();
    }

  

}

?>