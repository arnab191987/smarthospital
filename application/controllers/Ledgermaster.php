<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ledgermaster extends MY_Controller {

	 public function __construct() {
             parent::__construct();
             $this->load->model('ledgermaster_model');
         }

	public function index()
	{
                $this->data['success_msg']=$this->session->userdata('success_msg');
                $this->data['error_msg']=$this->session->userdata('error_msg');
                
                $this->session->unset_userdata('success_msg');
                $this->session->unset_userdata('error_msg');
                
                $ledgerList = $this->ledgermaster_model->fetch();
                $this->data['ledgerList']=$ledgerList;
		$this->load->view('ledger/list',$this->data);
		$this->load->view('common/footer',$this->data);
	}
	
	public function add()
	{
            $ledger=array();
            $ledger=$this->input->post('ledger');
            
            $this->data['success_msg']="";
            $this->data['error_msg']="";
            
            if(count($ledger) > 0){
              $result=$this->ledgermaster_model->add($ledger);
              if($result > 0){
                  $this->data['success_msg']="Ledger information added";
              }
              else{
                  $this->data['error_msg']="Ledger information not added";
              }
            }
            
            $this->load->view('ledger/add',$this->data);
            $this->load->view('common/footer',$this->data);
	}
        
        public function edit($ledger_id=null){
            
            $ledger=array();
            $ledger=$this->input->post('ledger');
            
            $this->data['success_msg']="";
            $this->data['error_msg']="";
            
            if(count($ledger) > 0){
              $result=$this->ledgermaster_model->edit($ledger,$ledger_id);
              if($result > 0){
                  $this->data['success_msg']="Ledger information updated";
              }
              else{
                  $this->data['error_msg']="Ledger information not updated";
              }
            } 
            
            /// Fetch all the value of the ledger ///
            $cond="id=".$ledger_id;
            $details=$this->ledgermaster_model->fetch($cond);
            $this->data['details']=$details[0];
            
            $this->load->view('ledger/edit',$this->data);
            $this->load->view('common/footer',$this->data);
        }
        
        public function deleteledger($id=null)
	{
            $result=$this->ledgermaster_model->delete('id',$id);
            if($result > 0){
                $this->session->set_userdata('success_msg', "Ledger information deleted");
            }
            else{
                $this->session->set_userdata('error_msg', "Ledger information not deleted");
            }
            redirect('index.php/ledgermaster/');
	}
}
