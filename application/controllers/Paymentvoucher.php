<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Paymentvoucher extends MY_Controller {

	 public function __construct() {
             parent::__construct();
             $this->load->model('reciptvoucher_model');
             $this->load->model('ledgermaster_model');
             $this->load->model('paymentmode_model');
             $this->load->model('supplier_model');
         }

	public function index()
	{
                $this->data['success_msg']="";
                $this->data['error_msg']="";
                
                $this->data['success_msg']=$this->session->userdata('success_msg');
                $this->data['error_msg']=$this->session->userdata('error_msg');
                
                $this->session->unset_userdata('success_msg');
                $this->session->unset_userdata('error_msg');
                
                
                $join_cond = array(
                    'supplier' => array('supplier.supplier_ledger=recipt_voucher.party', 'left'),
                    'payment_mode' => array('payment_mode.id=recipt_voucher.mode', 'left'),
                    'ledger_master' => array('ledger_master.id=recipt_voucher.posting_ledger', 'left'),
                );
                $cond="voucher_type='payment'";
                $reciptvoucherList = $this->reciptvoucher_model->fetch_join($join_cond,$cond);
                $this->data['reciptvoucherList']=$reciptvoucherList;
		$this->load->view('paymentvoucher/list',$this->data);
		$this->load->view('common/footer',$this->data);
	}
      
	
	public function addstep1()
	{
            $this->load->view('paymentvoucher/addstep1',$this->data);
            $this->load->view('common/footer',$this->data);
	}
        
        public function addstep2() {
            $supplier=array();
            $supplier=$this->input->post('supplier');
            if(empty($supplier['supplier_ledger'])){
                redirect('index.php/paymentvoucher/addstep1');
            }
            $cond="supplier_ledger='".$supplier['supplier_ledger']."'";
            $supplierData = $this->supplier_model->fetch($cond);
            if(count($supplierData) > 0){
                $supplierData[0]['depositer_name']=$this->input->post('supplier[depositer_name]');
                $this->data['details']=$supplierData[0];
            }
            else{
                redirect('index.php/paymentvoucher/addstep1');
            }
            
            $this->load->view('paymentvoucher/addstep2',$this->data);
            $this->load->view('common/footer',$this->data);
        }
        
        public function addstep3() {
            $ledgerList=$this->ledgermaster_model->fetch();
            $this->data['ledgerList']=$ledgerList;
            
            $paymentModeList=$this->paymentmode_model->fetch();
            $this->data['paymentModeList']=$paymentModeList;
            
            $this->data['supplier_ledger']=$this->input->post('supplier[supplier_ledger]');
            $this->data['depositer_name']=$this->input->post('supplier[depositer_name]');
            $voucher=array();
            $voucher=$this->input->post('voucher');
            if(count($voucher) > 0){
              $voucher['voucher_type']='payment';
              $result=$this->reciptvoucher_model->add($voucher);
              // Generate Voucher No //
              $voucherNo= str_pad($result[0]['id'], 6,"0",STR_PAD_LEFT);
              $voucher['voucher_no']= "R".$voucherNo;
              
              $val=0;
              $val=$this->reciptvoucher_model->edit($voucher,$result[0]['id']);
              if($val!=0){
                  redirect('index.php/paymentvoucher');
              }
            }
            
            $this->load->view('paymentvoucher/addstep3',$this->data);
            $this->load->view('common/footer',$this->data);
        }
        
        public function edit($voucherno=null) {
            $this->data['success_msg']="";
            $this->data['error_msg']="";
                
            $ledgerList=$this->ledgermaster_model->fetch();
            $this->data['ledgerList']=$ledgerList;
            
            $paymentModeList=$this->paymentmode_model->fetch();
            $this->data['paymentModeList']=$paymentModeList;
            
            $this->data['ipd']=$this->input->post('admission[ipd_no]');
            
            $voucher=array();
            $voucher=$this->input->post('voucher');
            if(count($voucher) > 0){
              $val=0;
              $cond=" voucher_no='".$voucherno."'";
              $val=$this->reciptvoucher_model->edit_cond($voucher,$cond);
              if($val!=0){
                  $this->session->set_userdata('success_msg','Vocher updated successfully.');
                 
              }
              else{
                  $this->session->set_userdata('error_msg','Cannot update the vouchar.');
              }
               redirect('index.php/paymentvoucher');
            }
            else{
                 $join_cond = array(
                    'supplier' => array('supplier.supplier_ledger=recipt_voucher.party', 'left'),
                    'payment_mode' => array('payment_mode.id=recipt_voucher.mode', 'left'),
                    'ledger_master' => array('ledger_master.id=recipt_voucher.posting_ledger', 'left'),
                );
                $cond="voucher_type='payment' AND recipt_voucher.voucher_no='".$voucherno."'";
                $paymentvoucherDetails = $this->reciptvoucher_model->fetch_join($join_cond,$cond);
            }
            $this->data['paymentvoucherDetails']=$paymentvoucherDetails;
            $this->data['voucher']=$paymentvoucherDetails[0]['voucher_no'];
            $this->load->view('paymentvoucher/edit',$this->data);
            $this->load->view('common/footer',$this->data);
        }
        
        public function deletevoucher($voucherno=null)
	   {
            $result=$this->reciptvoucher_model->delete('voucher_no ',$voucherno);
            if($result > 0){
                $this->session->set_userdata('success_msg', "Vouchar deleted");
            }
            else{
                $this->session->set_userdata('error_msg', "Vouchar is not deleted");
            }
            redirect('index.php/paymentvoucher/');
	   }
        
        public function viewvoucherbyipd($ipd=null)
	   {
                $join_cond = array(
                    'supplier' => array('supplier.supplier_ledger=recipt_voucher.party', 'left'),
                    'payment_mode' => array('payment_mode.id=recipt_voucher.mode', 'left'),
                    'ledger_master' => array('ledger_master.id=recipt_voucher.posting_ledger', 'left'),
                );
                $cond="voucher_type='payment' AND party='".$ipd."'";
                $reciptvoucherList = $this->reciptvoucher_model->fetch_join($join_cond,$cond);
                $this->data['reciptvoucherList']=$reciptvoucherList;
	
                $this->pdf->load_view('paymentvoucher/listPdfPrint',$this->data);
                $this->pdf->render();
                $this->pdf->stream("Recipt Voucher.pdf",array('Attachment'=>0));
	   }
        
        public function printall()
	   {
                $join_cond = array(
                    'supplier' => array('supplier.supplier_ledger=recipt_voucher.party', 'left'),
                    'payment_mode' => array('payment_mode.id=recipt_voucher.mode', 'left'),
                    'ledger_master' => array('ledger_master.id=recipt_voucher.posting_ledger', 'left'),
                );
                $cond="voucher_type='payment'";
                $reciptvoucherList = $this->reciptvoucher_model->fetch_join($join_cond,$cond);
                $this->data['reciptvoucherList']=$reciptvoucherList;
	
                $this->pdf->load_view('paymentvoucher/listPdfPrint',$this->data);
                $this->pdf->render();
                $this->pdf->stream("Payment Voucher.pdf",array('Attachment'=>0));
	   }
        
        public function printmr($voucherno=null)
	   {
                if(!empty($voucherno)){
                $join_cond = array(
                    'supplier' => array('supplier.supplier_ledger=recipt_voucher.party', 'left'),
                    'payment_mode' => array('payment_mode.id=recipt_voucher.mode', 'left'),
                    'ledger_master' => array('ledger_master.id=recipt_voucher.posting_ledger', 'left'),
                );
                $cond="voucher_type='payment' AND voucher_no='".$voucherno."'";
                $reciptvoucherDetails = $this->reciptvoucher_model->fetch_join($join_cond,$cond);
                $this->data['reciptvoucherDetails']=$reciptvoucherDetails[0];
	
                $this->pdf->load_view('paymentvoucher/mr_print',$this->data);
                $this->pdf->render();
                $this->pdf->stream("Payment Voucher.pdf",array('Attachment'=>0));
                }
                else{
                    redirect('index.php/paymentvoucher/');
                }
	   }
        
}
