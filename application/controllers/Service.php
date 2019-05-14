<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Service extends MY_Controller {

	 public function __construct() {
             parent::__construct();
             $this->load->model('service_model');
             $this->load->model('unit_model');
         }

	public function index()
	{
                $this->data['success_msg']=$this->session->userdata('success_msg');
                $this->data['error_msg']=$this->session->userdata('error_msg');
                
                $this->session->unset_userdata('success_msg');
                $this->session->unset_userdata('error_msg');
                
                $join_cond = array(
                    'unit' => array('unit.id=service.unit', 'left')
                );
                $mechinaryList = $this->service_model->fetch_join($join_cond);
                $this->data['serviceList']=$mechinaryList;
		$this->load->view('service/list',$this->data);
		$this->load->view('common/footer',$this->data);
	}
	
	public function add()
	{
            $service=array();
            $service=$this->input->post('service');
            $unitList=$this->unit_model->fetch();
            $this->data['unitList']=$unitList;
            
            $this->data['success_msg']="";
            $this->data['error_msg']="";
            
            if(count($service) > 0){
              $result=$this->service_model->add($service);
              if($result > 0){
                  $this->data['success_msg']="Service information added";
              }
              else{
                  $this->data['error_msg']="Service information not added";
              }
            }
            
            $this->load->view('service/add',$this->data);
            $this->load->view('common/footer',$this->data);
	}
        
        public function edit($id=null)
	{
            $service=array();
            $service=$this->input->post('service');
            $unitList=$this->unit_model->fetch();
            $this->data['unitList']=$unitList;
            
            $this->data['success_msg']="";
            $this->data['error_msg']="";
            if(count($service) > 0){
              $result=$this->service_model->edit($service,$id);
              if($result > 0){
                  $this->data['success_msg']="Service information updated";
              }
              else{
                  $this->data['error_msg']="Service information not updated";
              }
            }
            
            $cond="service_id=".$id;
            $details=$this->service_model->fetch($cond);
            $this->data['details']=$details[0];
            
            $this->load->view('service/edit',$this->data);
            $this->load->view('common/footer',$this->data);
	}
        
        public function deleteservice($id=null)
	{
            $result=$this->service_model->delete('service_id',$id);
            if($result > 0){
                $this->session->set_userdata('success_msg', "Service information deleted");
            }
            else{
                $this->session->set_userdata('error_msg', "Service information not deleted");
            }
            redirect('index.php/service/');
	}
}
