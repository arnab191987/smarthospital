<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Supplier extends MY_Controller {

	 public function __construct() {
             parent::__construct();
             $this->load->model('supplier_model');
         }

	public function index()
	{
      $this->data['success_msg']=$this->session->userdata('success_msg');
      $this->data['error_msg']=$this->session->userdata('error_msg');
      
      $this->session->unset_userdata('success_msg');
      $this->session->unset_userdata('error_msg');
      
      $supplierList = $this->supplier_model->fetch();
      $this->data['supplierList']=$supplierList;
  		$this->load->view('supplier/list',$this->data);
  		$this->load->view('common/footer',$this->data);
	}
	
	public function add()
	{
      $supplier=array();
      $supplier=$this->input->post('supplier');

      $this->data['success_msg']="";
      $this->data['error_msg']="";
      
      if(count($supplier) > 0){
        $checkunique=$this->checkunique($supplier['supplier_ledger'],false);
        if($checkunique=="false"){
          $result=$this->supplier_model->add($supplier);
          
          if($result > 0){
              $this->data['success_msg']="Supplier added";
          }
          else{
              $this->data['error_msg']="Supplier is not added";
          }
        }
        else{
          $this->data['error_msg']="Ledger name must be unique, unless can not save.";
        }
      }
      
      $this->load->view('supplier/add',$this->data);
      $this->load->view('common/footer',$this->data);
	}
        
  public function edit($supplier_id=null)
	{
            $supplier=array();
            $supplier=$this->input->post('supplier');
            
            $this->data['success_msg']="";
            $this->data['error_msg']="";
          
            if(count($supplier) > 0){
              $result=$this->supplier_model->edit($supplier,$supplier_id); 
              
              if($result > 0){
                  $this->data['success_msg']="Supplier updated";
              }
              else{
                  $this->data['error_msg']="Supplier is not updated";
              }
            }
            
            /// Fetch all the value of the admission ///
            $cond="supplier_id=".$supplier_id;
            $details=$this->supplier_model->fetch($cond);
            $this->data['details']=$details[0];
            
            $this->load->view('supplier/edit',$this->data);
            $this->load->view('common/footer',$this->data);
	}
        
  public function deletesupplier($id=null)
	{
            $result=$this->supplier_model->delete('supplier_id',$id);
            if($result > 0){
                $this->session->set_userdata('success_msg', "Supplier deleted");
            }
            else{
                $this->session->set_userdata('error_msg', "Supplier not deleted");
            }
            redirect('index.php/supplier/');
	}

  public function checkunique($ledgerName="", $isAjax=true){
      $cond="supplier_ledger LIKE '".$ledgerName."'";
      $details=$this->supplier_model->fetch($cond);
      if(count($details) > 0){
         $show="true";
      }
      else{
        $show="false";
      }
      if($isAjax){
        echo $show;
        die;
      }
      else{
        return $show;
      }
  }
}
