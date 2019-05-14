<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Opdsevicecharg extends MY_Controller {

	 public function __construct() {
             parent::__construct();
             $this->load->model('opd_service_charg_model');
         }

	public function index()
	{
            $opdservicecharge=array();
            $opdservicecharge=$this->input->post('opdservicecharge');
            $this->data['success_msg']="";
            $this->data['error_msg']="";
            if(count($opdservicecharge) > 0){
              $result=$this->opd_service_charg_model->edit($opdservicecharge,1);
              if($result > 0){
                  $this->data['success_msg']="Service Charge is updated";
              }
              else{
                  $this->data['error_msg']="Service Charge is not updated";
              }
            }

            $cond="service_charge_id=1";
            $this->data['details']=$this->opd_service_charg_model->fetch($cond);
            
            $this->load->view('opd_service_charge/add',$this->data);
            $this->load->view('common/footer',$this->data);
	}
	
	
}
