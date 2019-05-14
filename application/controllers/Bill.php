<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bill extends MY_Controller {

	 public function __construct() {
             parent::__construct();
             $this->load->model('bill_model');
             $this->load->model('billbeddetails_model');
             $this->load->model('billservicedetails_model');
             $this->load->model('billdoctordetails_model');
             $this->load->model('billmachinedetails_model');
             $this->load->model('bed_model');
             $this->load->model('doctor_model');
             $this->load->model('service_model');
             $this->load->model('mechinary_model');
             $this->load->model('admission_model');
             $this->load->model('opd_patient_model');
         }

	public function index()
	{
                $this->data['success_msg']="";
                $this->data['error_msg']="";
                $this->data['success_msg']=$this->session->userdata('success_msg');
                $this->data['error_msg']=$this->session->userdata('error_msg');
                
                $this->session->unset_userdata('success_msg');
                $this->session->unset_userdata('error_msg');
                $billList=array();
                $join_cond = array(
                    'admission' => array('admission.admission_id=bill.admission_id', 'left'),
                );
                $cond="bill_type LIKE 'ipd'";
                $billList = $this->bill_model->fetch_join($join_cond,$cond);
                $this->data['billList']=$billList;
		$this->load->view('bill/list',$this->data);
		$this->load->view('common/footer',$this->data);
	}
        
        public function finalsave($billNo=null) {
            $bill['final']=1;
            $bill['bill_generate_date']= date("Y-m-d");
            $cond=" bill_no='".$billNo."'";
            $val=$this->bill_model->edit_cond($bill,$cond);
            if($val){
               $this->data['success_msg']='Bill Complete, final information is saved.';
            }
            else {
               $this->data['error_msg']="Cannot save the final information";
            }
            redirect('index.php/bill/');
        }
        
        public function billregister()
	{
                $this->data['success_msg']="";
                $bill=array();
                $bill=$this->input->post('bill');
                if(count($bill) > 0){
                    if($bill['to_date'] >= $bill['from_date']){
                        $cond=" bill.bill_generate_date >='".$bill['from_date']."' AND bill.bill_generate_date <='".$bill['to_date']."' AND final=1";
                        if(!empty($bill['bill_no'])){
                            $cond.=" AND bill.bill_no='".$bill['bill_no']."'";
                        }
                        $join_cond = array(
                            'admission' => array('admission.admission_id=bill.admission_id', 'left'),
                        );
                        $billList = $this->bill_model->fetch_join($join_cond,$cond,'*,bill.ipd_no as ipdno');
                        for ($i=0; $i < count($billList) ; $i++) { 
                            if($billList[$i]['bill_type']=='opd'){
                                $billList[$i]['ipd_no']=$billList[$i]['ipdno'];
                                $details=array();
                                $cond="opd_no LIKE '".$billList[$i]['ipdno']."'";
                                $details=$this->opd_patient_model->fetch($cond);
                                if(count($details) > 0){
                                    $billList[$i]['patient_name']=$details[0]['patient_name'];
                                }
                                else{
                                    $billList[$i]['patient_name']="NA";
                                }
                            }
                        }
                    }
                    else{
                        $billList=array();
                        $this->data['success_msg']="To Date must be greated then from Date";
                    }
                }
                else{
                    $billList=array();   
                }
                $this->data['billList']=$billList;
		$this->load->view('report/billregister',$this->data);
		$this->load->view('common/footer',$this->data);
	}
	
	public function addstep1()
	{
            $this->data['success_msg']=$this->session->userdata('success_msg');
            $this->data['error_msg']=$this->session->userdata('error_msg');

            $this->session->unset_userdata('success_msg');
            $this->session->unset_userdata('error_msg');
        
            
            $this->load->view('bill/addstep1',$this->data);
            $this->load->view('common/footer',$this->data);
	}
        
        public function addstep2() {
            $bill=array();
            $bill=$this->input->post('bill');
            if(count($bill)>0){
                $admissionData=array();
                $this->data['details']=$admissionData;
                $cond="ipd_no='".$bill['ipd_no']."'";
                $admissionData = $this->admission_model->fetch($cond);
                if(empty($admissionData)){
                    $this->data['error_msg']="Wrong IPD";
                }
                else{
                    $cond="ipd_no='".$bill['ipd_no']."'";
                    $countBill = $this->bill_model->fetch($cond);
                    if(count($countBill)==0){
                        $bill['admission_id']=$admissionData[0]['admission_id'];
                        $bill['bill_type']='ipd';
                        $result=$this->bill_model->add($bill);
                        // Generate BIll  No //
                        $cond="fin_id=1";
                        $financialYear=$this->financial_year_model->fetch($cond);
                        $condBill=" bill_no LIKE '".$financialYear[0]['financial_year']."-%'";
                        $getbillCount=$this->bill_model->fetch($condBill);
                        $totalBillCount=count($getbillCount)+1;
                        $billNo= str_pad($totalBillCount, 6,"0",STR_PAD_LEFT);
                        $billNo=$financialYear[0]['financial_year']."-".$billNo;
                        $bill['bill_no']=$billNo;
                        // echo $bill['bill_no'];
                        $val=$this->bill_model->edit($bill,$result[0]['bill_id']);
                        if($val){
                            $this->data['success_msg']='Successfully Generated';
                        }
                    }
                    else {
                        $this->session->set_userdata('error_msg','Bill already generated.');
                        redirect('index.php/bill/addstep1');
                    }
                    $this->data['bill_no']=$billNo;
                    $this->data['details']=$admissionData[0];
                }
                
            }
            $this->load->view('bill/addstep2',$this->data);
            $this->load->view('common/footer',$this->data);
        }
        
        public function addstep3($billNo=null,$mode=null) {
            $this->data['success_msg']="";
            $this->data['error_msg']="";
            
            if(!empty($mode)){
                $this->data["mode"]="edit";
            }
            else{
                $this->data["mode"]="";
            }
            
            if(empty($billNo)){
                redirect('index.php/bill/addstep1');
            }
            else{
                $bedInfo=array();
                $bedInfo=$this->input->post('bed');
                
                $bedList = $this->bed_model->fetch();
                $this->data['bedList']= $bedList;
                $this->data['bill_no']= $billNo;
                
                if(count($bedInfo)>0){
                    $cond="bed_no='".$bedInfo['bed_no']."'";
                    $join_cond = array(
                        'bed_type' => array('bed_type.id=bed.bed_type', 'left'),
                        'unit' => array('unit.id=bed.unit', 'left')
                    );
                    $bedDetails = $this->bed_model->fetch_join($join_cond,$cond);
                    $bedInfo['bed_type']=$bedDetails[0]['type'];
                    $bedInfo['rate']=$bedDetails[0]['charge'];
                    $bedInfo['unit']=$bedDetails[0]['display_name'];
                    $bedInfo['amount']=$bedInfo['rate']*$bedInfo['qty'];
                    $bedInfo['bill_no']=$billNo;
                    //print_r($bedInfo);
                    $result=$this->billbeddetails_model->add($bedInfo);
                    $totalAmount=$this->totalBilledAmount($billNo);
                    $bill['total_amount']= $totalAmount['total_amount']+$bedInfo['amount'];
                    $cond=" bill_no='".$billNo."'";
                    $val=$this->bill_model->edit_cond($bill,$cond);
                    if($result > 0){
                        $this->data['success_msg']="Bed information added";
                    }
                    else{
                        $this->data['error_msg']="Bed information not added";
                    }
                }
                $this->data['total_amount']= $this->totalBilledAmount($billNo);
//                $val=$this->billbeddetails_model->edit($bill,$result[0]['bill_id']);
                $this->load->view('bill/addstep3',$this->data);
                $this->load->view('common/footer',$this->data);
            }
        }
        
        public function addstep4($billNo=null,$mode=null) {
            $this->data['success_msg']="";
            $this->data['error_msg']="";
            
            if(!empty($mode)){
                $this->data["mode"]="edit";
            }
            else{
                $this->data["mode"]="";
            }
            
            if(empty($billNo)){
                redirect('index.php/bill/addstep1');
            }
            else{
                $serviceInfo=array();
                $serviceInfo=$this->input->post('service');
                
                $serviceList = $this->service_model->fetch();
                $this->data['serviceList']= $serviceList;
                $this->data['bill_no']= $billNo;
                if(count($serviceInfo)>0){
                    $cond="service_id='".$serviceInfo['service_name']."'";
                    $join_cond = array(
                        'unit' => array('unit.id=service.unit', 'left')
                    );
                    $serviceDetails = $this->service_model->fetch_join($join_cond,$cond);
                    $serviceInfo['service_name']=$serviceDetails[0]['service_name'];
                    $serviceInfo['service_charge']=$serviceDetails[0]['charge'];
                    $serviceInfo['unit']=$serviceDetails[0]['display_name'];
                    $serviceInfo['amount']=$serviceInfo['service_charge']*$serviceInfo['qty'];
                    $serviceInfo['bill_no']=$billNo;
                    //print_r($bedInfo);
                    $result=$this->billservicedetails_model->add($serviceInfo);
                    $totalAmount=$this->totalBilledAmount($billNo);
                    $cond=" bill_no='".$billNo."'";
                    $bill['total_amount']= $totalAmount['total_amount']+$serviceInfo['amount'];
                    $val=$this->bill_model->edit_cond($bill,$cond);
                    if($result > 0){
                        $this->data['success_msg']="Service information added";
                    }
                    else{
                        $this->data['error_msg']="Service information not added";
                    }
                }
                $this->data['total_amount']= $this->totalBilledAmount($billNo);
//                $val=$this->billbeddetails_model->edit($bill,$result[0]['bill_id']);
                $this->load->view('bill/addstep4',$this->data);
                $this->load->view('common/footer',$this->data);
            }
        }
        
        public function addstep5($billNo=null,$mode=null) {
            $this->data['success_msg']="";
            $this->data['error_msg']="";
            
            if(!empty($mode)){
                $this->data["mode"]="edit";
            }
            else{
                $this->data["mode"]="";
            }
            
            if(empty($billNo)){
                redirect('index.php/bill/addstep1');
            }
            else{
                $doctorInfo=array();
                $doctorInfo=$this->input->post('doctor');
                
                $doctorList = $this->doctor_model->fetch();
                $this->data['doctorList']= $doctorList;
                $this->data['bill_no']= $billNo;
                if(count($doctorInfo)>0){
                    $cond="doctor_id='".$doctorInfo['doctor_name']."'";
                    $join_cond = array(
                        'unit' => array('unit.id=doctor.unit', 'left')
                    );
                    $doctorDetails = $this->doctor_model->fetch_join($join_cond,$cond);
                    $doctorInfo['doctor_name']=$doctorDetails[0]['doctor_name'];
                    $doctorInfo['doctor_charge']=$doctorDetails[0]['doctor_charge'];
                    $doctorInfo['unit']=$doctorDetails[0]['display_name'];
                    $doctorInfo['amount']=$doctorInfo['doctor_charge']*$doctorInfo['qty'];
                    $doctorInfo['bill_no']=$billNo;
                    //print_r($bedInfo);
                    $result=$this->billdoctordetails_model->add($doctorInfo);
                    $totalAmount=$this->totalBilledAmount($billNo);
                    $cond=" bill_no='".$billNo."'";
                    $bill['total_amount']= $totalAmount['total_amount']+$doctorInfo['amount'];
                    $val=$this->bill_model->edit_cond($bill,$cond);
                    if($result > 0){
                        $this->data['success_msg']="Doctor information added";
                    }
                    else{
                        $this->data['error_msg']="Doctor information not added";
                    }
                }
                $this->data['total_amount']= $this->totalBilledAmount($billNo);
//                $val=$this->billbeddetails_model->edit($bill,$result[0]['bill_id']);
                $this->load->view('bill/addstep5',$this->data);
                $this->load->view('common/footer',$this->data);
            }
        }
        
        public function addstep6($billNo=null,$mode=null) {
            $this->data['success_msg']="";
            $this->data['error_msg']="";
            
            if(!empty($mode)){
                $this->data["mode"]="edit";
            }
            else{
                $this->data["mode"]="";
            }
            
            if(empty($billNo)){
                redirect('index.php/bill/addstep1');
            }
            else{
                $machineInfo=array();
                $machineInfo=$this->input->post('machine');
                
                $machineList = $this->mechinary_model->fetch();
                $this->data['machineList']= $machineList;
                $this->data['bill_no']= $billNo;
                if(count($machineInfo)>0){
                    $cond="equipement_name='".$machineInfo['machine_name']."'";
                    $join_cond = array(
                        'unit' => array('unit.id=machinary.unit', 'left')
                    );
                    $mechinaryDetails = $this->mechinary_model->fetch_join($join_cond,$cond);
                    $machineInfo['charge']=$mechinaryDetails[0]['charge'];
                    $machineInfo['unit']=$mechinaryDetails[0]['display_name'];
                    $machineInfo['amount']=$machineInfo['charge']*$machineInfo['qty'];
                    $machineInfo['bill_no']=$billNo;
                   // print_r($machineInfo);die;
                    $result=$this->billmachinedetails_model->add($machineInfo);
                    $cond=" bill_no='".$billNo."'";
                    $totalAmount=$this->bill_model->fetch($cond,"total_amount");
                    $totalAmount=$this->totalBilledAmount($billNo);
                    $bill['total_amount']= $totalAmount['total_amount']+$machineInfo['amount'];
                    $val=$this->bill_model->edit_cond($bill,$cond);
                    if($result > 0){
                        $this->data['success_msg']="Equipement information added";
                    }
                    else{
                        $this->data['error_msg']="Equipement information not added";
                    }
                }
                $this->data['total_amount']= $this->totalBilledAmount($billNo);
//                $val=$this->billbeddetails_model->edit($bill,$result[0]['bill_id']);
                $this->load->view('bill/addstep6',$this->data);
                $this->load->view('common/footer',$this->data);
            }
        }
        
        
        public function billdetails($billNo=null)
        {
                $this->data['success_msg']=$this->session->userdata('success_msg');
                $this->data['error_msg']=$this->session->userdata('error_msg');
                
                $this->session->unset_userdata('success_msg');
                $this->session->unset_userdata('error_msg');
                
                $this->data['bill_no']= $billNo;
                 
                ////////////// Fetch Doctor ////////////
                $condBed="bill_no='".$billNo."'";
                $bedList = $this->billbeddetails_model->fetch($condBed);
                
                ////////////// Fetch Service ////////////
                $condService="bill_no='".$billNo."'";
                $serviceList = $this->billservicedetails_model->fetch($condService);
                
                ////////////// Fetch Doctor ////////////
                $condDoctor="bill_no='".$billNo."'";
                $doctorList = $this->billdoctordetails_model->fetch($condDoctor);
                
                ////////////// Fetch Machinary ////////////
                $condMachine="bill_no='".$billNo."'";
                $machineList = $this->billmachinedetails_model->fetch($condMachine);

                ///////////// Fetch Total amount ///////////
                $cond=" bill_no='".$billNo."'";
                $totalAmount=$this->bill_model->fetch($cond,"total_amount,discount,original_amount"); 

                $this->data['doctorList']=$doctorList;
                $this->data['bedList']=$bedList;
                $this->data['serviceList']=$serviceList;
                $this->data['machineList']=$machineList;
                if($totalAmount[0]['discount']!=''){
                    $this->data['totalAmount']=$totalAmount[0]['original_amount'] ;
                }
                else{
                    $this->data['totalAmount']=$totalAmount[0]['total_amount'] ;
                }
                
		      $this->load->view('bill/billdetails',$this->data);
		      $this->load->view('common/footer',$this->data);
	   }
        
       public function billDiscount($billNo=null){

            $bill=array();
            $bill=$this->input->post('bill');
            if($bill['discount'] > 0){
                ///////////// Fetch Total amount ///////////
                $discountAmount=round(($bill['original_amount']*$bill['discount'])/100);
                $total=$bill['original_amount']-$discountAmount;
                $bill['total_amount']=$total;
                ///////////////////////////
                $cond=" bill_no='".$billNo."'";
                $val=$this->bill_model->edit_cond($bill,$cond);
            }
            redirect('index.php/bill/billdetails/'.$billNo);
       }
        public function editbedinfo($billNo=null,$id=null) {
            $this->data['success_msg']="";
            $this->data['error_msg']="";
            
            if(empty($id)){
                redirect('index.php/bill/billdetails/'.$billNo);
            }
            else{
                $bedInfo=array();
                $bedInfo=$this->input->post('bed');
                
                $bedList = $this->bed_model->fetch();
                $this->data['bedList']= $bedList;
                $this->data['bill_no']= $billNo;
                if(count($bedInfo)>0){
                    $totalPrevBed=$this->bedlistTotal($billNo);
                    $cond="bed_no='".$bedInfo['bed_no']."'";
                    $join_cond = array(
                        'bed_type' => array('bed_type.id=bed.bed_type', 'left'),
                        'unit' => array('unit.id=bed.unit', 'left')
                    );
                    $bedDetails = $this->bed_model->fetch_join($join_cond,$cond);
                    $bedInfo['bed_type']=$bedDetails[0]['type'];
                    $bedInfo['rate']=$bedDetails[0]['charge'];
                    $bedInfo['unit']=$bedDetails[0]['display_name'];
                    $bedInfo['amount']=$bedInfo['rate']*$bedInfo['qty'];
                    $bedInfo['bill_no']=$billNo;
                    //print_r($bedInfo);
                    $cond="id=".$id;
                    $result=$this->billbeddetails_model->edit_cond($bedInfo,$cond);
                    $totalNextBed=$this->bedlistTotal($billNo);
                    $cond=" bill_no='".$billNo."'";
                    $totalAmount=$this->bill_model->fetch($cond,"total_amount");
                    
                    $bill['total_amount']= $this->getExactTotalToBeUpdated($totalAmount[0]['total_amount'],$totalPrevBed,$totalNextBed);
                    $val=$this->bill_model->edit_cond($bill,$cond);
                    if($result > 0){
                        $this->data['success_msg']="Bed information updated";
                    }
                    else{
                        $this->data['error_msg']="Bed information not updated";
                    }
                    redirect('index.php/bill/billdetails/'.$billNo);
                }
                else{
                    $cond="id=".$id;
                    $info=$this->billbeddetails_model->fetch($cond);
                    $this->data['info']=$info[0];
                }
//                $val=$this->billbeddetails_model->edit($bill,$result[0]['bill_id']);
                $this->load->view('bill/editstep2',$this->data);
                $this->load->view('common/footer',$this->data);
            }
        }
        
        public function editservicedinfo($billNo=null,$id=null) {
            $this->data['success_msg']="";
            $this->data['error_msg']="";
            
            if(empty($id)){
                redirect('index.php/bill/billdetails/'.$billNo);
            }
            else{
                $serviceInfo=array();
                $serviceInfo=$this->input->post('service');
                $serviceList = $this->service_model->fetch();
                $this->data['serviceList']= $serviceList;
                $this->data['bill_no']= $billNo;
                if(count($serviceInfo)>0){
                    $totalPrevService=$this->servicelistTotal($billNo);
                    $cond="service_id='".$serviceInfo['service_name']."'";
                    $join_cond = array(
                        'unit' => array('unit.id=service.unit', 'left')
                    );
                    $serviceDetails = $this->service_model->fetch_join($join_cond,$cond);
                    $serviceInfo['service_name']=$serviceDetails[0]['service_name'];
                    $serviceInfo['service_charge']=$serviceDetails[0]['charge'];
                    $serviceInfo['unit']=$serviceDetails[0]['display_name'];
                    $serviceInfo['amount']=$serviceInfo['service_charge']*$serviceInfo['qty'];
                    $serviceInfo['bill_no']=$billNo;
                    $cond="id=".$id;
                    $result=$this->billservicedetails_model->edit_cond($serviceInfo,$cond);
                    $totalNextService=$this->servicelistTotal($billNo);
                    $cond=" bill_no='".$billNo."'";
                    $totalAmount=$this->bill_model->fetch($cond,"total_amount");
                    
                    $bill['total_amount']= $this->getExactTotalToBeUpdated($totalAmount[0]['total_amount'],$totalPrevService,$totalNextService);
                    $val=$this->bill_model->edit_cond($bill,$cond);
                    if($result > 0){
                        $this->data['success_msg']="Service information updated";
                    }
                    else{
                        $this->data['error_msg']="Service information not updated";
                    }
                    redirect('index.php/bill/billdetails/'.$billNo);
//                );$val=$this->billbeddetails_model->edit($bill,$result[0]['bill_id']);
                   
                }
                else{
                    $cond="id=".$id;
                    $info=$this->billservicedetails_model->fetch($cond);
                    $cond="service_name='".$info[0]['service_name']."'";
                    $join_cond = array(
                        'unit' => array('unit.id=service.unit', 'left')
                    );
                    $serviceDetails = $this->service_model->fetch_join($join_cond,$cond);
                    $info[0]['service_name']=$serviceDetails[0]['service_name'];
                    $this->data['info']=$info[0];
                }
            }
            $this->load->view('bill/editstep3',$this->data);
            $this->load->view('common/footer',$this->data);
        }
        
        public function editdoctorinfo($billNo=null,$id=null) {
            $this->data['success_msg']="";
            $this->data['error_msg']="";
            
            if(empty($id)){
                redirect('index.php/bill/billdetails/'.$billNo);
            }
            else{
                $doctorInfo=array();
                $doctorInfo=$this->input->post('doctor');
                
                $doctorList = $this->doctor_model->fetch();
                $this->data['doctorList']= $doctorList;
                $this->data['bill_no']= $billNo;
                $totalPrevDoctor=$this->doctorlistTotal($billNo);
                if(count($doctorInfo)>0){
                    $cond="doctor_id='".$doctorInfo['doctor_name']."'";
                    $join_cond = array(
                        'unit' => array('unit.id=doctor.unit', 'left')
                    );
                    $doctorDetails = $this->doctor_model->fetch_join($join_cond,$cond);
                    $doctorInfo['doctor_name']=$doctorDetails[0]['doctor_name'];
                    $doctorInfo['doctor_charge']=$doctorDetails[0]['doctor_charge'];
                    $doctorInfo['unit']=$doctorDetails[0]['display_name'];
                    $doctorInfo['amount']=$doctorInfo['doctor_charge']*$doctorInfo['qty'];
                    $doctorInfo['bill_no']=$billNo;
                    //print_r($bedInfo);
                    $cond="id=".$id;
                    $result=$this->billdoctordetails_model->edit_cond($doctorInfo,$cond);
                    $totalNextDoctor=$this->doctorlistTotal($billNo);
                    $cond=" bill_no='".$billNo."'";
                    $totalAmount=$this->bill_model->fetch($cond,"total_amount");
                    $bill['total_amount']= $this->getExactTotalToBeUpdated($totalAmount[0]['total_amount'],$totalPrevDoctor,$totalNextDoctor);
                    $val=$this->bill_model->edit_cond($bill,$cond);
                    if($result > 0){
                        $this->data['success_msg']="Doctor information updated";
                    }
                    else{
                        $this->data['error_msg']="Doctor information not updated";
                    }
                    redirect('index.php/bill/billdetails/'.$billNo);
                }
                else{
                    $cond="id=".$id;
                    $info=$this->billdoctordetails_model->fetch($cond);
		    $cond="doctor_name='".$info[0]['doctor_name']."'";
                    $join_cond = array(
                        'unit' => array('unit.id=doctor.unit', 'left')
                    );
                    $doctorList = $this->doctor_model->fetch_join($join_cond,$cond);
                    $info[0]['doctor_name']=$doctorList[0]['doctor_name'];
                    $this->data['info']=$info[0];
                }
            }
            $this->load->view('bill/editstep4',$this->data);
            $this->load->view('common/footer',$this->data);
        }
        
        public function editmachinaryinfo($billNo=null,$id=null) {
            $this->data['success_msg']="";
            $this->data['error_msg']="";
            
            if(empty($id)){
                redirect('index.php/bill/billdetails/'.$billNo);
            }
            else{
                $machineInfo=array();
                $machineInfo=$this->input->post('machine');
                
                $machineList = $this->mechinary_model->fetch();
                $this->data['machineList']= $machineList;
                $this->data['bill_no']= $billNo;
                $totalPrevMachinary=$this->machinelistTotal($billNo);
                if(count($machineInfo)>0){
                    $cond="equipement_name='".$machineInfo['machine_name']."'";
                    $join_cond = array(
                        'unit' => array('unit.id=machinary.unit', 'left')
                    );
                    $mechinaryDetails = $this->mechinary_model->fetch_join($join_cond,$cond);
                    $machineInfo['charge']=$mechinaryDetails[0]['charge'];
                    $machineInfo['unit']=$mechinaryDetails[0]['display_name'];
                    $machineInfo['amount']=$machineInfo['charge']*$machineInfo['qty'];
                    $machineInfo['bill_no']=$billNo;
                    //print_r($bedInfo);
                    $cond="id=".$id;
                    $result=$this->billmachinedetails_model->edit_cond($machineInfo,$cond);
                    $totalNextMachinary=$this->machinelistTotal($billNo);
                    $cond=" bill_no='".$billNo."'";
                    $totalAmount=$this->bill_model->fetch($cond,"total_amount");
                    $bill['total_amount']= $this->getExactTotalToBeUpdated($totalAmount[0]['total_amount'],$totalPrevMachinary,$totalNextMachinary);
                    $val=$this->bill_model->edit_cond($bill,$cond);
                    if($result > 0){
                        $this->data['success_msg']="Machinary information updated";
                    }
                    else{
                        $this->data['error_msg']="Machinary information not updated";
                    }
                    redirect('index.php/bill/billdetails/'.$billNo);
                }
                else{
                    $cond="id=".$id;
                    $info = $this->billmachinedetails_model->fetch($cond);
                    $this->data['info']=$info[0];
                }
            }
            $this->load->view('bill/editstep5',$this->data);
            $this->load->view('common/footer',$this->data);
        }
        
        public function deletebill($billNo=null,$id=null) {
            $result=$this->bill_model->delete('bill_id',$id);
            if($result > 0){
                $result=$this->billbeddetails_model->delete('bill_no',$billNo);
                $result=$this->billservicedetails_model->delete('bill_no',$billNo);
                $result=$this->billdoctordetails_model->delete('bill_no',$billNo);
                $result=$this->billmachinedetails_model->delete('bill_no',$billNo);
                $this->session->set_userdata('success_msg', "Bill deleted");
            }
            else{
                $this->session->set_userdata('error_msg', "Bill is not deleted");
            }
            redirect('index.php/bill/');
        }
        
        public function deletebedinfo($billNo=null,$id=null) {
            $totalPrevBed=$this->bedlistTotal($billNo);
            $result=$this->billbeddetails_model->delete('id',$id);
            if($result > 0){
                $totalNextBed=$this->bedlistTotal($billNo);
                $cond=" bill_no='".$billNo."'";
                $totalAmount=$this->bill_model->fetch($cond,"total_amount");
                $bill['total_amount']= $this->getExactTotalToBeUpdated($totalAmount[0]['total_amount'],$totalPrevBed,$totalNextBed);
                $val=$this->bill_model->edit_cond($bill,$cond);
                if($val > 0){
                    $this->session->set_userdata('success_msg', "Bed information deleted");
                }
                else{
                    $this->session->set_userdata('error_msg', "Bed information not deleted");
                }
            }
            else{
                $this->session->set_userdata('error_msg', "Bed information not deleted");
            }
            redirect('index.php/bill/billdetails/'.$billNo);
        }
        
        public function deleteserviceinfo($billNo=null,$id=null) {
            $totalPrevService=$this->servicelistTotal($billNo);
            $result=$this->billservicedetails_model->delete('id',$id);
            if($result > 0){
                $totalNextService=$this->servicelistTotal($billNo);
                $cond=" bill_no='".$billNo."'";
                $totalAmount=$this->bill_model->fetch($cond,"total_amount");
                $bill['total_amount']= $this->getExactTotalToBeUpdated($totalAmount[0]['total_amount'],$totalPrevService,$totalNextService);
                $val=$this->bill_model->edit_cond($bill,$cond);
                if($val > 0){
                    $this->session->set_userdata('success_msg', "Service information deleted");
                }
                else{
                    $this->session->set_userdata('error_msg', "Service information not deleted");
                }
            }
            else{
                $this->session->set_userdata('error_msg', "Service information not deleted");
            }
            redirect('index.php/bill/billdetails/'.$billNo);
        }
        
        public function deletedoctorinfo($billNo=null,$id=null) {
            $totalPrevDoctor=$this->doctorlistTotal($billNo);
            $result=$this->billdoctordetails_model->delete('id',$id);
            if($result > 0){
                $totalNextDoctor=$this->doctorlistTotal($billNo);
                $cond=" bill_no='".$billNo."'";
                $totalAmount=$this->bill_model->fetch($cond,"total_amount");
                $bill['total_amount']= $this->getExactTotalToBeUpdated($totalAmount[0]['total_amount'],$totalPrevDoctor,$totalNextDoctor);
                $val=$this->bill_model->edit_cond($bill,$cond);
                if($val > 0){
                    $this->session->set_userdata('success_msg', "Doctor information deleted");
                }
                else{
                    $this->session->set_userdata('error_msg', "Doctor information not deleted");
                }
            }
            else{
                $this->session->set_userdata('error_msg', "Doctor information not deleted");
            }
            redirect('index.php/bill/billdetails/'.$billNo);
        }
        
        public function deletemachinaryinfo($billNo=null,$id=null) {
            $totalPrevMachinary=$this->machinelistTotal($billNo);
            $result=$this->billmachinedetails_model->delete('id',$id);
            if($result > 0){
                $totalNextMachinary=$this->machinelistTotal($billNo);
                $cond=" bill_no='".$billNo."'";
                $totalAmount=$this->bill_model->fetch($cond,"total_amount");
                $bill['total_amount']= $this->getExactTotalToBeUpdated($totalAmount[0]['total_amount'],$totalPrevMachinary,$totalNextMachinary);
                $val=$this->bill_model->edit_cond($bill,$cond);
                if($val > 0){
                    $this->session->set_userdata('success_msg', "Equipment information deleted");
                }
                else{
                    $this->session->set_userdata('error_msg', "Equipment information not deleted");
                }
            }
            else{
                $this->session->set_userdata('error_msg', "Equipment information not deleted");
            }
            redirect('index.php/bill/billdetails/'.$billNo);
        }
        
        public function bedinfoajax($bedno=null,$qty=0){
            $bedno= urldecode($bedno);
            $cond="bed_no='".$bedno."'";
            $join_cond = array(
                'bed_type' => array('bed_type.id=bed.bed_type', 'left'),
                'unit' => array('unit.id=bed.unit', 'left')
            );
            $bedDetails = $this->bed_model->fetch_join($join_cond,$cond);
            $bedInfo['bed_type']=$bedDetails[0]['type'];
            $bedInfo['rate']=$bedDetails[0]['charge'];
            $bedInfo['unit']=$bedDetails[0]['display_name'];
            $bedInfo['amount']=$bedInfo['rate']*$qty;
            echo json_encode($bedInfo);
            die;
        }
        
        public function serviceinfoajax($serviceno=null,$qty=0){
            $serviceno= urldecode($serviceno);
            $cond="service_id='".$serviceno."'";
            $join_cond = array(
                'unit' => array('unit.id=service.unit', 'left')
            );
            $serviceDetails = $this->service_model->fetch_join($join_cond,$cond);
            $serviceInfo['service_name']=$serviceDetails[0]['service_name'];
            $serviceInfo['service_charge']=$serviceDetails[0]['charge'];
            $serviceInfo['unit']=$serviceDetails[0]['display_name'];
            $serviceInfo['amount']=$serviceInfo['service_charge']*$qty;
            echo json_encode($serviceInfo);
            die;
        }
        
        public function doctorinfoajax($doctorno=null,$qty=0){
            $doctorno= urldecode($doctorno);
            $cond="doctor_id='".$doctorno."'";
            $join_cond = array(
                    'unit' => array('unit.id=doctor.unit', 'left')
                );
            $doctorDetails = $this->doctor_model->fetch_join($join_cond,$cond);
            $doctorInfo['doctor_name']=$doctorDetails[0]['doctor_name'];
            $doctorInfo['doctor_charge']=$doctorDetails[0]['doctor_charge'];
            $doctorInfo['unit']=$doctorDetails[0]['display_name'];
            $doctorInfo['amount']=$doctorInfo['doctor_charge']*$qty;
            echo json_encode($doctorInfo);
            die;
        }
        
        public function machinaryinfoajax($machinaryno=null,$qty=0){
            $machinaryno= urldecode($machinaryno);
            $cond="equipement_name='".$machinaryno."'";
            $join_cond = array(
                'unit' => array('unit.id=machinary.unit', 'left')
            );
            $mechinaryDetails = $this->mechinary_model->fetch_join($join_cond,$cond);
            $machineInfo['charge']=$mechinaryDetails[0]['charge'];
            $machineInfo['unit']=$mechinaryDetails[0]['display_name'];
            $machineInfo['amount']=$machineInfo['charge']*$qty;
            echo json_encode($machineInfo);
            die;
        }

        public function printall($billNo=null)
	{
                ///////// Find bill info ////////////////
                $cond=" bill_no='".$billNo."'";
                $bill=$this->bill_model->fetch($cond);
                /////////////////////////////////////////
                
                ////// Find Admission Details ////////
                
                $cond=" ipd_no='".$bill[0]['ipd_no']."'";
                $admissionData = $this->admission_model->fetch($cond);
                /////////////////////////////////////
                
                ////////////// Fetch Bed ////////////
                $condBed="bill_no='".$billNo."'";
                $bedList = $this->billbeddetails_model->fetch($condBed);
                
                ////////////// Fetch Service ////////////
                $condService="bill_no='".$billNo."'";
                $serviceList = $this->billservicedetails_model->fetch($condService);
                
                ////////////// Fetch Doctor ////////////
                $condDoctor="bill_no='".$billNo."'";
                $doctorList = $this->billdoctordetails_model->fetch($condDoctor);
                
                ////////////// Fetch Machinary ////////////
                $condMachine="bill_no='".$billNo."'";
                $machineList = $this->billmachinedetails_model->fetch($condMachine);
                
                $this->data['bill']=$bill[0];
                $this->data['admissionData']=$admissionData[0];
                $this->data['doctorList']=$doctorList;
                $this->data['bedList']=$bedList;
                $this->data['serviceList']=$serviceList;
                $this->data['machineList']=$machineList;
                $this->data['bedTotal']=$this->bedlistTotal($billNo);
                $this->data['serviceTotal']=$this->servicelistTotal($billNo);
                $this->data['doctorTotal']=$this->doctorlistTotal($billNo);
                $this->data['machinaryTotal']=$this->machinelistTotal($billNo);
                
                //load the view, pass the variable and do not show it but "save" the output into $html variable
                $html=$this->load->view('bill/billPdfPrint', $this->data, true); 
                
                //this the the PDF filename that user will get to download
                $pdfFilePath = "Bill.pdf";
                
                //actually, you can pass mPDF parameter on this load() function
                $pdf = $this->m_pdf->load();
                //generate the PDF!
                $pdf->WriteHTML($html);
                //offer it to user via browser download! (The PDF won't be saved on your server HDD)
                $pdf->Output($pdfFilePath, "I");
	
//                $this->pdf->load_view('bill/billPdfPrint',$this->data);
//                $this->pdf->render();
//                
//                $this->pdf->stream("Bill.pdf",array('Attachment'=>0));
	}
        
        public function viewbillbyipd($ipd=null)
	{
                // Find bill no by IPD ///
                $cond=" ipd_no ='".$ipd."'";
                $billList = $this->bill_model->fetch($cond);
                $billNo=$billList[0]['bill_no'];
                ////////////// Fetch Bed ////////////
                $condBed="bill_no='".$billNo."'";
                $bedList = $this->billbeddetails_model->fetch($condBed);
                
                ////////////// Fetch Service ////////////
                $condService="bill_no='".$billNo."'";
                $serviceList = $this->billservicedetails_model->fetch($condService);
                
                ////////////// Fetch Doctor ////////////
                $condDoctor="bill_no='".$billNo."'";
                $doctorList = $this->billdoctordetails_model->fetch($condDoctor);
                
                 ////////////// Fetch Machinary ////////////
                $condMachine="bill_no='".$billNo."'";
                $machineList = $this->billmachinedetails_model->fetch($condMachine);
                
                $this->data['doctorList']=$doctorList;
                $this->data['bedList']=$bedList;
                $this->data['serviceList']=$serviceList;
                $this->data['machineList']=$machineList;
	
                $this->pdf->load_view('bill/billPdfPrint',$this->data);
                $this->pdf->render();
                $this->pdf->stream("Bill.pdf",array('Attachment'=>0));
	}
        
        private function bedlistTotal($billNo=null) {
             ////////////// Fetch Bed ////////////
            $condBed="bill_no='".$billNo."'";
            $bedList = $this->billbeddetails_model->fetch($condBed,"amount");
            $total=0;
            foreach ($bedList as $key => $value) {
                $total=$total+$value['amount'];
            }
            return $total;
        }
        
        private function servicelistTotal($billNo=null) {
             ////////////// Fetch Service ////////////
            $condService="bill_no='".$billNo."'";
            $serviceList = $this->billservicedetails_model->fetch($condService,"amount");
            $total=0;
            foreach ($serviceList as $key => $value) {
                $total=$total+$value['amount'];
            }
            return $total;
        }
        
        private function doctorlistTotal($billNo=null) {
             ////////////// Fetch Doctor ////////////
            $condDoctor="bill_no='".$billNo."'";
            $doctorList = $this->billdoctordetails_model->fetch($condDoctor,"amount");
            $total=0;
            foreach ($doctorList as $key => $value) {
                $total=$total+$value['amount'];
            }
            return $total;
        }
        
        private function machinelistTotal($billNo=null) {
             ////////////// Fetch Machine ////////////
            $condMachine="bill_no='".$billNo."'";
            $machineList = $this->billmachinedetails_model->fetch($condMachine,"amount");
            $total=0;
            foreach ($machineList as $key => $value) {
                $total=$total+$value['amount'];
            }
            return $total;
        }
        
        private function getExactTotalToBeUpdated($totAmt=0,$totalPrevBed=0,$totalNextBed=0){
            /// Get the total exclude bed ///
            $totAmt=$totAmt-$totalPrevBed;
            $totAmt=$totAmt+$totalNextBed;
            ////////////////////////////////
            return $totAmt;
        }
        
        private function totalBilledAmount($billNo){
           $cond=" bill_no='".$billNo."'";
           $totalAmount=$this->bill_model->fetch($cond,"total_amount");
           return $totalAmount[0];
        }
}
