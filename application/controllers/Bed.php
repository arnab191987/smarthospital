<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bed extends MY_Controller {

	 public function __construct() {
             parent::__construct();
             $this->load->model('bed_model');
             $this->load->model('bedtype_model');
             $this->load->model('unit_model');
         }

	public function index()
	{
                $this->data['success_msg']=$this->session->userdata('success_msg');
                $this->data['error_msg']=$this->session->userdata('error_msg');
                
                $this->session->unset_userdata('success_msg');
                $this->session->unset_userdata('error_msg');
                
                $join_cond = array(
                    'bed_type' => array('bed_type.id=bed.bed_type', 'left'),
                    'unit' => array('unit.id=bed.unit', 'left')
                );
                $bedList = $this->bed_model->fetch_join($join_cond);
                $this->data['bedList']=$bedList;
		$this->load->view('bed/list',$this->data);
		$this->load->view('common/footer',$this->data);
	}
	
	public function add()
	{
            $bed=array();
            $bed=$this->input->post('bed');
            $bedTypeList=$this->bedtype_model->fetch();
            $this->data['bedTypeList']=$bedTypeList;
            $unitList=$this->unit_model->fetch();
            $this->data['unitList']=$unitList;
            $this->data['success_msg']="";
            $this->data['error_msg']="";
            if(count($bed) > 0){
              $result=$this->bed_model->add($bed);
              if($result > 0){
                  $this->data['success_msg']="Bed information added";
              }
              else{
                  $this->data['error_msg']="Bed information not added";
              }
            }
            
            $this->load->view('bed/add',$this->data);
            $this->load->view('common/footer',$this->data);
	}
        
        public function edit($id=null)
	{
            $bed=array();
            $bed=$this->input->post('bed');
            $bedTypeList=$this->bedtype_model->fetch();
            $this->data['bedTypeList']=$bedTypeList;
            $unitList=$this->unit_model->fetch();
            $this->data['unitList']=$unitList;
            $this->data['success_msg']="";
            $this->data['error_msg']="";
            if(count($bed) > 0){
              $result=$this->bed_model->edit($bed,$id);
              if($result > 0){
                  $this->data['success_msg']="Bed information updated";
              }
              else{
                  $this->data['error_msg']="Bed information not updated";
              }
            }
            
            $cond="bed_id=".$id;
            $details=$this->bed_model->fetch($cond);
            $this->data['details']=$details[0];
            
            $this->load->view('bed/edit',$this->data);
            $this->load->view('common/footer',$this->data);
	}
        
        public function deletebed($id=null)
	{
            $result=$this->bed_model->delete('bed_id',$id);
            if($result > 0){
                $this->session->set_userdata('success_msg', "Bed information deleted");
            }
            else{
                $this->session->set_userdata('error_msg', "Bed information not deleted");
            }
            
            redirect('index.php/bed/');
	}
}
