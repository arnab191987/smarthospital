<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Deathcertificate extends MY_Controller {

	public function __construct() {
         parent::__construct();
         $this->load->model('deathcertificate_model');
         $this->load->model('admission_model');
    }

	public function index()
	{
                $this->data['success_msg']="";
                $this->data['error_msg']="";
                
                $this->data['success_msg']=$this->session->userdata('success_msg');
                $this->data['error_msg']=$this->session->userdata('error_msg');
                
                $this->session->unset_userdata('success_msg');
                $this->session->unset_userdata('error_msg');
                
                $birthList = $this->deathcertificate_model->fetch();
                $this->data['birthList']=$birthList;
		        $this->load->view('deathcertificate/list',$this->data);
		        $this->load->view('common/footer',$this->data);
	}
   
	public function addstep1()
	{
            $reciptvoucher=array();
            $reciptvoucher=$this->input->post('reciptvoucher');
            
            if(count($reciptvoucher) > 0){
              $result=$this->admission_model->add($admission);
            }
            
            $this->load->view('deathcertificate/addstep1',$this->data);
            $this->load->view('common/footer',$this->data);
	}
        
    public function addstep2() {
        $admission=array();
        $admission=$this->input->post('admission');
        if(empty($admission['ipd_no'])){
            redirect('index.php/deathcertificate/addstep1');
        }
        $cond="ipd_no='".$admission['ipd_no']."'";
        $admissionData = $this->admission_model->fetch($cond);
        if(count($admissionData) > 0){
            $admissionData[0]['depositer_name']=$this->input->post('admission[depositer_name]');
            $this->data['details']=$admissionData[0];
        }
        
        $this->load->view('deathcertificate/addstep2',$this->data);
        $this->load->view('common/footer',$this->data);
    }
        
    public function addstep3() {
        
        $deathcertificate=array();
        $deathcertificate=$this->input->post('deathcertificate');
        if(count($deathcertificate) > 0){
         $deathcertificate['death_time']=$deathcertificate['hh'].":".$deathcertificate['mm'].":".$deathcertificate['ss'];
         unset($deathcertificate['hh']);
         unset($deathcertificate['mm']);
         unset($deathcertificate['ss']);
          $val=0;
          $val=$this->deathcertificate_model->add($deathcertificate);
          if($val!=0){
              $this->session->set_userdata('success_msg','Death Certificate add successfully.');
              redirect('index.php/deathcertificate');
          }
        }
    }
        
    public function edit($id=null) {
        $this->data['success_msg']="";
        $this->data['error_msg']="";
        
        $deathcertificate=array();
        $deathcertificate=$this->input->post('deathcertificate');
        if(count($deathcertificate) > 0){
         $deathcertificate['death_time']=$deathcertificate['hh'].":".$deathcertificate['mm'].":".$deathcertificate['ss'];
         unset($deathcertificate['hh']);
         unset($deathcertificate['mm']);
         unset($deathcertificate['ss']);
          $val=0;
          $cond=" id='".$id."'";
          $val=$this->deathcertificate_model->edit_cond($deathcertificate,$cond);
          if($val!=0){
              $this->session->set_userdata('success_msg','Certificate updated successfully.');
             
          }
          else{
              $this->session->set_userdata('error_msg','Cannot update the Certificate information.');
          }
           redirect('index.php/deathcertificate');
        }
        else{
            
            $cond="id=".$id;
            $details = $this->deathcertificate_model->fetch($cond);
        }
        $this->data['details']=$details[0];
        $this->load->view('deathcertificate/edit',$this->data);
        $this->load->view('common/footer',$this->data);
    }
        
    public function deletecertificate($id=null)
    {
        $result=$this->deathcertificate_model->delete('id ',$id);
        if($result > 0){
            $this->session->set_userdata('success_msg', "Certificate deleted");
        }
        else{
            $this->session->set_userdata('error_msg', "Certificate is not deleted");
        }
        redirect('index.php/deathcertificate/');
    }
        
   
    public function printcertificate($id=null)
	{
                $cond="id=".$id;
                $certificateDetails = $this->deathcertificate_model->fetch($cond);
                $this->data['certificateDetails']=$certificateDetails[0];
	
                $this->pdf->load_view('deathcertificate/certificateprint',$this->data);
                $this->pdf->render();
                $this->pdf->stream("Recipt Voucher.pdf",array('Attachment'=>0));
	}
        
}
