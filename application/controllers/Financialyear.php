<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Financialyear extends MY_Controller {

	 public function __construct() {
             parent::__construct();
             $this->load->model('financial_year_model');
         }

	public function index()
	{
            $fin=array();
            $fin=$this->input->post('fin');
            $this->data['success_msg']="";
            $this->data['error_msg']="";
            if(count($fin) > 0){
              $result=$this->financial_year_model->edit($fin,1);
              if($result > 0){
                  $this->data['success_msg']="Financial year is added";
              }
              else{
                  $this->data['error_msg']="Financial year is not added";
              }
            }

            $cond="fin_id=1";
            $this->data['details']=$this->financial_year_model->fetch($cond);
            
            $this->load->view('financial_year/add',$this->data);
            $this->load->view('common/footer',$this->data);
	}
	
	
}
