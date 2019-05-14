<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Patientaccount extends MY_Controller {

	 public function __construct() {
             parent::__construct();
             $this->load->model('bill_model');
             $this->load->model('reciptvoucher_model');
             $this->load->model('ledgermaster_model');
             $this->load->model('paymentmode_model');
             $this->load->model('admission_model');
         }

	public function index(){
            $admission=array();
            $admission=$this->input->post('admission');
            if(count($admission) > 0){
                $cond="ipd_no='".$admission['ipd_no']."'";
                $admissionData = $this->admission_model->fetch($cond);
                
                /// Find Billed Amount /////
                $cond=" ipd_no='".$admission['ipd_no']."'";
                $totalAmount=$this->bill_model->fetch($cond,"total_amount");
                $admissionData[0]['totalBilledAmount']=$totalAmount[0]['total_amount'];
                ////////////////////////////
                
                /// Find Paid Amount ///
                $cond="voucher_type='recipt' AND party='".$admission['ipd_no']."'";
                $reciptvoucherList = $this->reciptvoucher_model->fetch($cond,'credit');
                $totalPaidAmount=0;
                foreach ($reciptvoucherList as $k => $v){
                    $totalPaidAmount=$totalPaidAmount+$v['credit'];
                }
                $admissionData[0]['totalPaidAmount']=$totalPaidAmount;
                ////////////////////////
                
                $this->data['details']=$admissionData[0];
                $this->load->view('patientaccount/addstep2',$this->data);
                $this->load->view('common/footer',$this->data);
            }
            else{
                $this->load->view('patientaccount/addstep1',$this->data);
                $this->load->view('common/footer',$this->data);
            }
        }
        
}
