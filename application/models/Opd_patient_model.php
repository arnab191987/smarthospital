<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Opd_patient_model extends MY_Model {

    protected $tableName = 'opd_patient'; /* This is the table name */
    public $primaryKey = 'opd_id';  /* This is the table primary key */

    public function __construct() {
        parent::__construct();
    }

  

}

?>