<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Biochemestrypatient_model extends MY_Model {

    protected $tableName = 'biochemestry_patient'; /* This is the table name */
    public $primaryKey = 'biochem_id';  /* This is the table primary key */

    public function __construct() {
        parent::__construct();
    }

  

}

?>