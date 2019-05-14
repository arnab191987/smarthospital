<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Opd_service_charg_model extends MY_Model {

    protected $tableName = 'opd_service_charg'; /* This is the table name */
    public $primaryKey = 'service_charge_id';  /* This is the table primary key */

    public function __construct() {
        parent::__construct();
    }

  

}

?>