<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Purchaser extends MY_Controller {

	 public function __construct() {
             parent::__construct();
             $this->load->model('purchaser_model');
             $this->load->model('supplier_model');
             $this->load->model('purchaseritemdetails_model');
         }

	public function index()
	{
      $this->data['success_msg']=$this->session->userdata('success_msg');
      $this->data['error_msg']=$this->session->userdata('error_msg');
      
      $this->session->unset_userdata('success_msg');
      $this->session->unset_userdata('error_msg');

      $join_cond = array(
          'supplier' => array('supplier.supplier_ledger=purchaser.supplier_ledger', 'left'),
      );
      
      $purchaserList = $this->purchaser_model->fetch_join($join_cond);
      $this->data['purchaserList']=$purchaserList;
  		$this->load->view('purchaser/list',$this->data);
  		$this->load->view('common/footer',$this->data);
	}
	
	public function add()
	{
      $this->load->view('purchaser/addstep1',$this->data);
      $this->load->view('common/footer',$this->data);
	}

  public function addstep2() {
      $supplier=array();
      $supplier=$this->input->post('supplier');
      if(empty($supplier['supplier_ledger'])){
          redirect('index.php/purchaser/addstep1');
      }
      $cond="supplier_ledger='".$supplier['supplier_ledger']."'";
      $supplierData = $this->supplier_model->fetch($cond);
      if(count($supplierData) > 0){
          $supplierData[0]['depositer_name']=$this->input->post('supplier[depositer_name]');
          $this->data['details']=$supplierData[0];
      }
      else{
          redirect('index.php/purchaser/addstep1');
      }
      
      $this->load->view('purchaser/addstep2',$this->data);
      $this->load->view('common/footer',$this->data);
  }

  public function addstep3() {
      
      $this->data['supplier_ledger']=$this->input->post('supplier[supplier_ledger]');
      $this->data['supplier_name']=$this->input->post('supplier[supplier_name]');
      $purchaser=array();
      $purchaser=$this->input->post('purchaser');
      if(count($purchaser) > 0){

        //// Add to purchaser table ////
        $purcahseDetails=array();
        
        $total_amount=$this->input->post('total_amount');
        $purchaser_master=array('supplier_ledger' => $this->data['supplier_ledger'], 'grand_total' => $total_amount);
        $purcahseDetails=$this->purchaser_model->add($purchaser_master);
        
        /// Assign purchaser id ////
        if(count($purcahseDetails) > 0){
          $this->session->set_userdata('success_msg', "Purchaser information add, successfully");
          $purcahseId=$purcahseDetails[0]['purchaser_id'];
        }
        else{
          $this->session->set_userdata('error_msg', "Purchaser information can not add.");
          $purcahseId=null;
        }

        // Generate Purchaser No //
        $purchaserNo= str_pad($purcahseId, 6,"0",STR_PAD_LEFT);
        $purchaserGeneratedNo['purchaser_no']=$purchaserNo;
        
        $val=0;
        $val=$this->purchaser_model->edit($purchaserGeneratedNo,$purcahseId);

        if(!empty($purcahseId)){
        ///// Entry at the purchaser table ///////
        foreach ($purchaser as $key => $value) {
          $value['purchaser_id']=$purcahseId;
          $this->purchaseritemdetails_model->add($value);
        }
        //// End of entry of purchaser table /////
        }
        redirect('index.php/purchaser');
      }
      
      $this->load->view('purchaser/addstep3',$this->data);
      $this->load->view('common/footer',$this->data);
  }
        
  public function edit($purchaser_id=null)
	{
            $purchaser=array();
            $purchaser=$this->input->post('purchaser');
            
            $this->data['success_msg']="";
            $this->data['error_msg']="";
          
            if(count($purchaser) > 0){
              $result=$this->purchaseritemdetails_model->delete('purchaser_id',$purchaser_id);
              ///// Entry at the purchaser table ///////
              foreach ($purchaser as $key => $value) {
                $value['purchaser_id']=$purchaser_id;
                $this->purchaseritemdetails_model->add($value);
              }
              //// End of entry of purchaser table /////
              $purchaserGeneratedNo['grand_total']=$this->input->post('total_amount');
        
              $val=0;
              $val=$this->purchaser_model->edit($purchaserGeneratedNo,$purchaser_id);
              if($result > 0){
                  $this->data['success_msg']="Purchaser updated";
              }
              else{
                  $this->data['error_msg']="Purchaser is not updated";
              }
            }
            
            /// Fetch all the value of the admission ///
            $cond="purchaser_id=".$purchaser_id;
            $details=$this->purchaser_model->fetch($cond);

            //////// Find purchaser item /////////
            $cond="purchaser_id=".$purchaser_id;
            $itemdetails=$this->purchaseritemdetails_model->fetch($cond,'','','','','ASC');
            //////////////////////////////////////

            //// Find supplier name /////
            $cond="supplier_ledger='".$details[0]['supplier_ledger']."'";
            $supplierData = $this->supplier_model->fetch($cond);
            ///////////////////////////////

            $this->data['details']=$details[0];
            $this->data['supplier_ledger']=$details[0]['supplier_ledger'];
            $this->data['supplier_name']=$supplierData[0]['supplier_name'];
            $this->data['itemdetails']=$itemdetails;
            
            $this->load->view('purchaser/edit',$this->data);
            $this->load->view('common/footer',$this->data);
	}
        
  public function deletepurchaser($id=null)
	{
            $result=$this->purchaser_model->delete('purchaser_id',$id);
            if($result > 0){
                $result=$this->purchaseritemdetails_model->delete('purchaser_id',$id);
                $this->session->set_userdata('success_msg', "Purchaser deleted");
            }
            else{
                $this->session->set_userdata('error_msg', "Purchaser not deleted");
            }
            redirect('index.php/purchaser/');
	}

  public function checkunique($ledgerName="", $isAjax=true){
      $cond="purchaser_ledger LIKE '".$ledgerName."'";
      $details=$this->purchaser_model->fetch($cond);
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
