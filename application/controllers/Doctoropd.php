<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Doctoropd extends MY_Controller {

	 public function __construct() {
             parent::__construct();
             $this->load->model('doctor_opd_model');
             $this->load->model('unit_model');
         }

	public function index()
	{
                $this->data['success_msg']=$this->session->userdata('success_msg');
                $this->data['error_msg']=$this->session->userdata('error_msg');
                
                $this->session->unset_userdata('success_msg');
                $this->session->unset_userdata('error_msg');
                
                $join_cond = array(
                    'unit' => array('unit.id=doctor_opd.unit', 'left')
                );
                $doctor_opdList = $this->doctor_opd_model->fetch_join($join_cond);
                $this->data['doctorList']=$doctor_opdList;
         
            		$this->load->view('doctor_opd/list',$this->data);
            		$this->load->view('common/footer',$this->data);
	}
	
	public function add()
	{
            $doctor=array();
            $doctor=$this->input->post('doctor');
            $unitList=$this->unit_model->fetch();
            $this->data['unitList']=$unitList;
            
            $this->data['success_msg']="";
            $this->data['error_msg']="";
            
            if(count($doctor) > 0){
              $result=$this->doctor_opd_model->add($doctor);
              if($result > 0){
                  $this->data['success_msg']="OPD doctor information added";
              }
              else{
                  $this->data['error_msg']="OPD doctor information not added";
              }
            }
            
            $this->load->view('doctor_opd/add',$this->data);
            $this->load->view('common/footer',$this->data);
	}
        
        public function edit($id=null)
	{
            $doctor=array();
            $doctor=$this->input->post('doctor');
            $unitList=$this->unit_model->fetch();
            $this->data['unitList']=$unitList;
            
            $this->data['success_msg']="";
            $this->data['error_msg']="";
            if(count($doctor) > 0){
              $result=$this->doctor_opd_model->edit($doctor,$id);
              if($result > 0){
                  $this->data['success_msg']="OPD doctor information updated";
              }
              else{
                  $this->data['error_msg']="OPD doctor information not updated";
              }
            }
            
            $cond="doctor_id=".$id;
            $details=$this->doctor_opd_model->fetch($cond);
            $this->data['details']=$details[0];
            
            $this->load->view('doctor_opd/edit',$this->data);
            $this->load->view('common/footer',$this->data);
	}
        
        public function deletedoctor($id=null)
	{
            $result=$this->doctor_opd_model->delete('doctor_id',$id);
            if($result > 0){
                $this->session->set_userdata('success_msg', "OPD doctor information deleted");
            }
            else{
                $this->session->set_userdata('error_msg', "OPD doctor information not deleted");
            }
            redirect('index.php/doctoropd/');
	}
}
