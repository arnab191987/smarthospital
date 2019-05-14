<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mechinary extends MY_Controller {

	 public function __construct() {
             parent::__construct();
             $this->load->model('mechinary_model');
             $this->load->model('unit_model');
         }

	public function index()
	{
                $this->data['success_msg']=$this->session->userdata('success_msg');
                $this->data['error_msg']=$this->session->userdata('error_msg');
                
                $this->session->unset_userdata('success_msg');
                $this->session->unset_userdata('error_msg');
                
                $join_cond = array(
                    'unit' => array('unit.id=machinary.unit', 'left')
                );
                $mechinaryList = $this->mechinary_model->fetch_join($join_cond);
                $this->data['mechinaryList']=$mechinaryList;
		$this->load->view('mechinary/list',$this->data);
		$this->load->view('common/footer',$this->data);
	}
	
	public function add()
	{
            $machinary=array();
            $machinary=$this->input->post('machinary');
            $unitList=$this->unit_model->fetch();
            $this->data['unitList']=$unitList;
            
            $this->data['success_msg']="";
            $this->data['error_msg']="";
            
            if(count($machinary) > 0){
              $result=$this->mechinary_model->add($machinary);
              if($result > 0){
                  $this->data['success_msg']="Mechinary information added";
              }
              else{
                  $this->data['error_msg']="Mechinary information not added";
              }
            }
            
            $this->load->view('mechinary/add',$this->data);
            $this->load->view('common/footer',$this->data);
	}
        
        public function edit($id=null)
	{
            $machinary=array();
            $machinary=$this->input->post('machinary');
            $unitList=$this->unit_model->fetch();
            $this->data['unitList']=$unitList;
            
            $this->data['success_msg']="";
            $this->data['error_msg']="";
            if(count($machinary) > 0){
              $result=$this->mechinary_model->edit($bed,$id);
              if($result > 0){
                  $this->data['success_msg']="Mechinary information updated";
              }
              else{
                  $this->data['error_msg']="Mechinary information not updated";
              }
            }
            
            $cond="machinary_id=".$id;
            $details=$this->mechinary_model->fetch($cond);
            $this->data['details']=$details[0];
            
            $this->load->view('mechinary/edit',$this->data);
            $this->load->view('common/footer',$this->data);
	}
        
        public function deletemachine($id=null)
	{
            $result=$this->mechinary_model->delete('machinary_id',$id);
            if($result > 0){
                $this->session->set_userdata('success_msg', "Mechinary information deleted");
            }
            else{
                $this->session->set_userdata('error_msg', "Mechinary information not deleted");
            }
            redirect('index.php/mechinary/');
	}
}
