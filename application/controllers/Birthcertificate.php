<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Birthcertificate extends MY_Controller {

	public function __construct() {
         parent::__construct();
         $this->load->model('birthcertificate_model');
         $this->load->model('ledgermaster_model');
         $this->load->model('paymentmode_model');
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
                
                $birthList = $this->birthcertificate_model->fetch();
                $this->data['birthList']=$birthList;
		        $this->load->view('birthcertificate/list',$this->data);
		        $this->load->view('common/footer',$this->data);
	}
        
	
	public function addstep1()
	{
            $reciptvoucher=array();
            $reciptvoucher=$this->input->post('reciptvoucher');
            
            if(count($reciptvoucher) > 0){
              $result=$this->admission_model->add($admission);
            }
            
            $this->load->view('birthcertificate/addstep1',$this->data);
            $this->load->view('common/footer',$this->data);
	}
        
    public function addstep2() {
        $admission=array();
        $admission=$this->input->post('admission');
        if(empty($admission['ipd_no'])){
            redirect('index.php/birthcertificate/addstep1');
        }
        $cond="ipd_no='".$admission['ipd_no']."'";
        $admissionData = $this->admission_model->fetch($cond);
        if(count($admissionData) > 0){
            $admissionData[0]['depositer_name']=$this->input->post('admission[depositer_name]');
            $this->data['details']=$admissionData[0];
        }
        
        $this->load->view('birthcertificate/addstep2',$this->data);
        $this->load->view('common/footer',$this->data);
    }
        
    public function addstep3() {
        
        $birthcertificate=array();
        $birthcertificate=$this->input->post('birthcertificate');
        if(count($birthcertificate) > 0){
          $birthcertificate['born_time']=$birthcertificate['hh'].":".$birthcertificate['mm'].":".$birthcertificate['ss'];
          unset($birthcertificate['hh']);
          unset($birthcertificate['mm']);
          unset($birthcertificate['ss']);
          $val=0;
          $val=$this->birthcertificate_model->add($birthcertificate);
          if($val!=0){
              $this->session->set_userdata('success_msg','Birth Certificate add successfully.');
              redirect('index.php/birthcertificate');
          }
        }
        
        $this->load->view('reciptvoucher/addstep3',$this->data);
        $this->load->view('common/footer',$this->data);
    }
        
    public function edit($id=null) {
        $this->data['success_msg']="";
        $this->data['error_msg']="";
        
        $birthcertificate=array();
        $birthcertificate=$this->input->post('birthcertificate');
        if(count($birthcertificate) > 0){
          $birthcertificate['born_time']=$birthcertificate['hh'].":".$birthcertificate['mm'].":".$birthcertificate['ss'];
          unset($birthcertificate['hh']);
          unset($birthcertificate['mm']);
          unset($birthcertificate['ss']);
          $val=0;
          $cond=" id='".$id."'";
          $val=$this->birthcertificate_model->edit_cond($birthcertificate,$cond);
          if($val!=0){
              $this->session->set_userdata('success_msg','Certificate updated successfully.');
             
          }
          else{
              $this->session->set_userdata('error_msg','Cannot update the Certificate information.');
          }
           redirect('index.php/birthcertificate');
        }
        else{
            
            $cond="id=".$id;
            $details = $this->birthcertificate_model->fetch($cond);
        }
        $this->data['details']=$details[0];
        $this->load->view('birthcertificate/edit',$this->data);
        $this->load->view('common/footer',$this->data);
    }
        
    public function deletecertificate($id=null)
    {
        $result=$this->birthcertificate_model->delete('id ',$id);
        if($result > 0){
            $this->session->set_userdata('success_msg', "Certificate deleted");
        }
        else{
            $this->session->set_userdata('error_msg', "Certificate is not deleted");
        }
        redirect('index.php/birthcertificate/');
    }
   
        
    public function printcertificate($id=null)
	{
                $cond="id=".$id;
                $certificateDetails = $this->birthcertificate_model->fetch($cond);
                $this->data['certificateDetails']=$certificateDetails[0];
	
                $this->pdf->load_view('birthcertificate/certificateprint',$this->data);
                $this->pdf->render();
                $this->pdf->stream("Recipt Voucher.pdf",array('Attachment'=>0));
               
	}
        
}
