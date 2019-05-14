<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Admission_model extends MY_Model {

    protected $tableName = 'admission'; /* This is the table name */
    public $primaryKey = 'admission_id';  /* This is the table primary key */

    public function __construct() {
        parent::__construct();
    }

  

}

?>