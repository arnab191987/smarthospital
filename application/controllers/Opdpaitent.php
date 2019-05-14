<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Opdpaitent extends MY_Controller {

	 public function __construct() {
             parent::__construct();
             $this->load->model('doctor_opd_model');
             $this->load->model('opd_patient_model');
             $this->load->model('bill_model');
             $this->load->model('opd_service_charg_model');
         }

	public function index()
	{
            $this->data['success_msg']=$this->session->userdata('success_msg');
            $this->data['error_msg']=$this->session->userdata('error_msg');
            
            $this->session->unset_userdata('success_msg');
            $this->session->unset_userdata('error_msg');
            
            $join_cond = array(
                'doctor_opd' => array('doctor_opd.doctor_id=doctor', 'left'),
            );
            $admissionList = $this->opd_patient_model->fetch_join($join_cond);
            $this->data['admissionList']=$admissionList;
        		$this->load->view('opd_patient/list',$this->data);
        		$this->load->view('common/footer',$this->data);
	}
	
	public function add()
	{
            $admission=array();
            $admission=$this->input->post('admission');
            $doctorList=$this->doctor_opd_model->fetch();
            $this->data['doctorList']=$doctorList;
            
            $this->data['success_msg']="";
            $this->data['error_msg']="";
            
            if(count($admission) > 0){
              $result=$this->opd_patient_model->add($admission);
              // Generate OPD No //
              $stringPad= str_pad($result[0]['opd_id'], 6,"0",STR_PAD_LEFT);
              $opd_no="OPD".$stringPad;
              $admission['opd_no']= $opd_no;
              $this->opd_patient_model->edit($admission,$result[0]['opd_id']);
              
              if($result > 0){
                  $this->data['success_msg']="OPD patient added";
              }
              else{
                  $this->data['error_msg']="OPD patient added";
              }
            }
            
            $this->load->view('opd_patient/add',$this->data);
            $this->load->view('common/footer',$this->data);
	}
        
  public function edit($opd_id=null)
	{
            $admission=array();
            $admission=$this->input->post('admission');
            $doctorList=$this->doctor_opd_model->fetch();
            $this->data['doctorList']=$doctorList;
            
            $this->data['success_msg']="";
            $this->data['error_msg']="";
          
            if(count($admission) > 0){
              
              $result=$this->opd_patient_model->edit($admission,$opd_id); 
              
              if($result > 0){
                  $this->data['success_msg']="OPD patient updated";
              }
              else{
                  $this->data['error_msg']="OPD patient is not updated";
              }
            }
            
            /// Fetch all the value of the admission ///
            $cond="opd_id=".$opd_id;
            $details=$this->opd_patient_model->fetch($cond);
            $this->data['details']=$details[0];
            
            $this->load->view('opd_patient/edit',$this->data);
            $this->load->view('common/footer',$this->data);
	}
        
  public function deleteopd($id=null)
	{
            $result=$this->opd_patient_model->delete('opd_id',$id);
            if($result > 0){
                $this->session->set_userdata('success_msg', "OPD patient deleted");
            }
            else{
                $this->session->set_userdata('error_msg', "OPD patient deleted");
            }
            redirect('index.php/opdpaitent/');
	}

  public function opdregister()
  {
                $this->data['success_msg']="";
                $doctorList=$this->doctor_opd_model->fetch();
                $this->data['doctorList']=$doctorList;
                $opd=array();
                $opd=$this->input->post('opd');
                $doctorId='';
                if(count($opd) > 0){
                    if($opd['to_date'] >= $opd['from_date']){
                        $cond=" opd_patient.patient_opd_date >='".$opd['from_date']."' AND opd_patient.patient_opd_date <='".$opd['to_date']."'";
                        if($opd['doctor']!=0){
                            $cond.=" AND opd_patient.doctor ='".$opd['doctor']."'";
                            $doctorId=$opd['doctor'];
                        }
                        $join_cond = array(
                            'doctor_opd' => array('doctor_opd.doctor_id=doctor', 'left'),
                        );
                        $opdList = $this->opd_patient_model->fetch_join($join_cond,$cond);
                    }
                    else{
                        $opdList=array();
                        $this->data['success_msg']="To Date must be greated then from Date";
                    }
                    $from_date=$opd['from_date'];
                    $to_date=$opd['to_date'];

                }
                else{
                    $opdList=array();   
                    $from_date=date('Y-m-d');
                    $to_date=date('Y-m-d');
                    $ipdNo='';
                }
                $this->data['opdList']=$opdList;
                $this->data['from_date']=$from_date;
                $this->data['to_date']=$to_date;
                $this->data['doctorId']=$doctorId;
                $this->load->view('report/opdregister',$this->data);
                $this->load->view('common/footer',$this->data);
  }

  public function opdregisterprint($from_date='',$to_date='',$doctor=0)
  {
                $opd['from_date']=$from_date;
                $opd['to_date']=$to_date;
                $opd['doctor']=$doctor;
                $doctorId='';
                if($opd['from_date']!='' && $opd['to_date'] !=''){
                    if($opd['to_date'] >= $opd['from_date']){
                        $cond=" opd_patient.patient_opd_date >='".$opd['from_date']."' AND opd_patient.patient_opd_date <='".$opd['to_date']."'";
                        if($opd['doctor']!=0){
                            $cond.=" AND opd_patient.doctor ='".$opd['doctor']."'";
                            $doctorId=$opd['doctor'];
                        }
                        $join_cond = array(
                            'doctor_opd' => array('doctor_opd.doctor_id=doctor', 'left'),
                        );
                        $opdList = $this->opd_patient_model->fetch_join($join_cond,$cond);
                    }
                    else{
                        $opdList=array();
                    }
                    $from_date=$ipd['from_date'];
                    $to_date=$ipd['to_date'];
                }
                else{
                    $opdList=array();  
                    $from_date=date('Y-m-d');
                    $to_date=date('Y-m-d');
                    $ipdNo=''; 
                }
                $this->data['opdList']=$opdList;
                $this->data['from_date']=$from_date;
                $this->data['to_date']=$to_date;
                $this->data['doctorId']=$doctorId;
                $html=$this->load->view('report/opdregisterprint',$this->data,true);
                //this the the PDF filename that user will get to download
                $pdfFilePath = "Bill.pdf";
                
                //actually, you can pass mPDF parameter on this load() function
                $pdf = $this->m_pdf->load();
                //generate the PDF!
                $pdf->WriteHTML($html);
                //offer it to user via browser download! (The PDF won't be saved on your server HDD)
                $pdf->Output($pdfFilePath, "I");
  }

  public function bill($opdid=null){
    $opd_details=array();
    $join_cond = array(
        'doctor_opd' => array('doctor_opd.doctor_id=doctor', 'left'),
    );
    $cond=" opd_id=".$opdid;
    $opd_details = $this->opd_patient_model->fetch_join($join_cond,$cond);
    if(count($opd_details) > 0){
      $bill['final']=1;
      $bill['bill_type']='opd';
      $bill['ipd_no']=$opd_details[0]['opd_no'];
      $bill['admission_id']=$opd_details[0]['opd_id'];
      $bill['total_amount']=$opd_details[0]['doctor_charge'];
      $bill['bill_generate_date']= date("Y-m-d");
      $result=$this->bill_model->add($bill);
      $cond="fin_id=1";
      $financialYear=$this->financial_year_model->fetch($cond);
      $condBill=" bill_no LIKE '".$financialYear[0]['financial_year']."-%'";
      $getbillCount=$this->bill_model->fetch($condBill);
      $totalBillCount=count($getbillCount)+1;
      $billNo= str_pad($totalBillCount, 6,"0",STR_PAD_LEFT);
      $billNo=$financialYear[0]['financial_year']."-".$billNo;
      $bill=array();
      $bill['bill_no']=$billNo;
      $val=$this->bill_model->edit($bill,$result[0]['bill_id']);
      $opd['is_bill_generated']=1;
      $getResult=$this->opd_patient_model->edit($opd,$opdid);
      if($getResult){
          $this->session->set_userdata('success_msg', "Bill Generated");
      }
      else{
          $this->session->set_userdata('error_msg', "Bill Generate,Please check again.");
      }
      redirect('index.php/opdpaitent/');
    }
  }

  public function billPrint($opdid=null){
    $opd_details=array();
    $join_cond = array(
        'doctor_opd' => array('doctor_opd.doctor_id=doctor', 'left'),
        'bill' => array('bill.admission_id=opd_id', 'left')
    );
    $cond=" opd_id=".$opdid." and final=1 and bill_type='opd'";
    $opd_details = $this->opd_patient_model->fetch_join($join_cond,$cond,'*,bill.add_date as bill_date');
    if(count($opd_details) > 0){

      ///////// Find service charge for opd /////////
      $cond="service_charge_id=1";
      $chargedetails=$this->opd_service_charg_model->fetch($cond);

      $this->data['service_charge']=$chargedetails[0]['service_charge'];

      $this->data['admissionData']=$opd_details[0];
      //load the view, pass the variable and do not show it but "save" the output into $html variable
      $html=$this->load->view('opd_patient/billOpdPdfPrint', $this->data, true); 
      
      //this the the PDF filename that user will get to download
      $pdfFilePath = "BillOPD.pdf";
      
      //actually, you can pass mPDF parameter on this load() function
      $pdf = $this->m_pdf->load();
      //generate the PDF!
      $pdf->WriteHTML($html);
      //offer it to user via browser download! (The PDF won't be saved on your server HDD)
      $pdf->Output($pdfFilePath, "I");
  
    }
  }

}
