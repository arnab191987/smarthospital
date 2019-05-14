<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Doctor_opd_model extends MY_Model {

    protected $tableName = 'doctor_opd'; /* This is the table name */
    public $primaryKey = 'doctor_id';  /* This is the table primary key */

    public function __construct() {
        parent::__construct();
    }

  

}

?>