<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Discharge extends MY_Controller {

	 public function __construct() {
             parent::__construct();
             $this->load->model('bed_model');
             $this->load->model('bedshift_model');
             $this->load->model('doctor_model');
             $this->load->model('admission_model');
             $this->load->model('bill_model');
         }

	public function index()
	{
    $this->data['success_msg']="";
    $this->data['error_msg']="";

    $this->data['success_msg']=$this->session->userdata('success_msg');
    $this->data['error_msg']=$this->session->userdata('error_msg');

    $this->session->unset_userdata('success_msg');
    $this->session->unset_userdata('error_msg');

    $this->load->view('discharge/addstep1',$this->data);
    $this->load->view('common/footer',$this->data);
	}

  public function addstep2() {
      $admission=array();
      $admission=$this->input->post('admission');
      if(empty($admission['ipd_no'])){
          redirect('index.php/discharge/');
      }
      //////// Check bill status /////////////

      $cond="ipd_no='".$admission['ipd_no']."' AND final=1";
      $billData = $this->bill_model->fetch($cond);

      if(count($billData) > 0){
        $cond="ipd_no='".$admission['ipd_no']."' AND is_discharged!='on'";
        $admissionData = $this->admission_model->fetch($cond);
        if(count($admissionData) > 0){
            $this->data['details']=$admissionData[0];
        }
        else{
           $this->session->set_userdata('error_msg','Patient already discharged.');
           redirect('index.php/discharge');
        }
      }
      else{
          $this->session->set_userdata('error_msg','Bill not genrated.');
          redirect('index.php/discharge');
      }
      $this->load->view('discharge/addstep2',$this->data);
      $this->load->view('common/footer',$this->data);
  }

  public function addstep3() {
      $admission=array();
      $admission=$this->input->post('admission');

      if(count($admission) > 0){
        // Bed occupied status set //
        $bedOccupiedCond="bed_no='".$admission['patient_bed_no']."'";
        $bed['status']= "V";
        $bedList=$this->bed_model->edit_cond($bed,$bedOccupiedCond);

        //// Update discharg status in admission table of database ////
        $admissionCond="ipd_no='".$admission['ipd_no']."'";
        $discharge['is_discharged']="on";
        $discharge['discharge_comment']=$admission['discharge_comment'];
        $discharge['discharge_date']=$admission['discharge_date'];
        $result=$this->admission_model->edit_cond($discharge,$admissionCond);
        if($result!=0){
            $this->session->set_userdata('success_msg','Patient discharged successfully.');
           
        }
        else{
            $this->session->set_userdata('error_msg','Patient cannot be discharged.');
        }
      }
      else{
          $this->session->set_userdata('error_msg','Unable to find IPD.');
      }
      
      redirect('index.php/discharge');
  }
}
