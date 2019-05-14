<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admission extends MY_Controller {

	 public function __construct() {
             parent::__construct();
             $this->load->model('bed_model');
             $this->load->model('bedshift_model');
             $this->load->model('doctor_model');
             $this->load->model('admission_model');
         }

	public function index()
	{
            $this->data['success_msg']=$this->session->userdata('success_msg');
            $this->data['error_msg']=$this->session->userdata('error_msg');
            
            $this->session->unset_userdata('success_msg');
            $this->session->unset_userdata('error_msg');
            
            $join_cond = array(
                'doctor' => array('doctor.doctor_id=admission.doctor', 'left'),
            );
            $admissionList = $this->admission_model->fetch_join($join_cond);
            $this->data['admissionList']=$admissionList;
        		$this->load->view('admission/list',$this->data);
        		$this->load->view('common/footer',$this->data);
	}
	
	public function add()
	{
            $admission=array();
            $admission=$this->input->post('admission');
            $condBed="status='V'";
            $bedList=$this->bed_model->fetch($condBed);
            $this->data['bedList']=$bedList;
            $doctorList=$this->doctor_model->fetch();
            $this->data['doctorList']=$doctorList;
            
            $this->data['success_msg']="";
            $this->data['error_msg']="";
            
            if(count($admission) > 0){
              $result=$this->admission_model->add($admission);
              // Generate IPD No //
              $stringPad= str_pad($result[0]['admission_id'], 6,"0",STR_PAD_LEFT);
              $ipd_no="IPD".$stringPad;
              $admission['ipd_no']= $ipd_no;
              $this->admission_model->edit($admission,$result[0]['admission_id']);
              
              // Bed occupied status set //
              $bedOccupiedCond="bed_no='".$admission['patient_bed_no']."'";
              $bed['status']= "O";
              $bedList=$this->bed_model->edit_cond($bed,$bedOccupiedCond);

              if($result > 0){

                  //// Add to bed shift table /////
                  $bedshift['patient_bed_no']=$admission['patient_bed_no'];
                  $bedshift['ipd_no']=$admission['ipd_no'];
                  $result=$this->bedshift_model->add($bedshift);
                  /////////////////////////////////
                  $this->data['success_msg']="Admission added";
              }
              else{
                  $this->data['error_msg']="Admission is not added";
              }
            }
            
            $this->load->view('admission/add',$this->data);
            $this->load->view('common/footer',$this->data);
	}
        
  public function edit($admission_id=null)
	{
            $admission=array();
            $admission=$this->input->post('admission');
            $bedList=$this->bed_model->fetch();
            $this->data['bedList']=$bedList;
            $doctorList=$this->doctor_model->fetch();
            $this->data['doctorList']=$doctorList;
            
            $this->data['success_msg']="";
            $this->data['error_msg']="";
          
            if(count($admission) > 0){
              if(!empty($admission['is_discharged'])){
                  // Bed occupied status set //
                    $bedOccupiedCond="bed_no='".$admission['patient_bed_no']."'";
                    $bed['status']= "V";
                    $bedList=$this->bed_model->edit_cond($bed,$bedOccupiedCond);
              }
              $result=$this->admission_model->edit($admission,$admission_id); 
              
              if($result > 0){
                  $this->data['success_msg']="Admission updated";
              }
              else{
                  $this->data['error_msg']="Admission is not updated";
              }
            }
            
            /// Fetch all the value of the admission ///
            $cond="admission_id=".$admission_id;
            $details=$this->admission_model->fetch($cond);
            $this->data['details']=$details[0];
            
            $this->load->view('admission/edit',$this->data);
            $this->load->view('common/footer',$this->data);
	}
        
  public function deleteadmission($id=null)
	{
            $result=$this->admission_model->delete('admission_id',$id);
            if($result > 0){
                $this->session->set_userdata('success_msg', "Admission deleted");
            }
            else{
                $this->session->set_userdata('error_msg', "Admission not deleted");
            }
            redirect('index.php/admission/');
	}

  public function bedshift($step=1)
  {
    $this->data['success_msg']="";
    $this->data['error_msg']="";

    $this->data['success_msg']=$this->session->userdata('success_msg');
    $this->data['error_msg']=$this->session->userdata('error_msg');
    
    $this->session->unset_userdata('success_msg');
    $this->session->unset_userdata('error_msg');

    $this->data['ableToFind']=false;
    $this->data['ipd']="";

    $bedList = array();
    $admission=array();
    $admission=$this->input->post('admission');
    if(count($admission) > 0){
      $cond="ipd_no='".$admission['ipd_no']."'";
      $admissionInfo = $this->admission_model->fetch($cond);
      if($step==1){
        ///// Start of step 1 block /////
        $ableToFInd=count($admissionInfo);
        if($ableToFInd > 0){
          $this->data['ableToFind']=true;
          $this->data['success_msg']=" Find IPD";

          ///// Find the bed ///////
          $condBed="status='V'";
          $bedList=$this->bed_model->fetch($condBed);
          $this->data['bedList']=$bedList;
          //////////////////////////

          $this->data['ipd']=$admission['ipd_no'];
        }
        else{
          $this->data['error_msg']="IPD Invalid";
        }
        ////// End of Step 1 block ///////
      }
      else{
        /// Start of Step 2 block /////
          // Bed occupied status set //
          $bedOccupiedCond="bed_no='".$admission['patient_bed_no']."'";
          $bed['status']= "O";
          $bedList=$this->bed_model->edit_cond($bed,$bedOccupiedCond);

          // Bed vacant status set //
          $bedOccupiedCond="bed_no='".$admissionInfo[0]['patient_bed_no']."'";
          $bed['status']= "V";
          $bedList=$this->bed_model->edit_cond($bed,$bedOccupiedCond);

          ///// set the bed no to admission table in database /////
          
          $admissionUpdate['patient_bed_no']=$admission['patient_bed_no'];
          $result=$this->admission_model->edit($admissionUpdate,$admissionInfo[0]['admission_id']); 
          //// Add to bed shift table /////
          $result=$this->bedshift_model->add($admission);
          if($result > 0){
              $this->session->set_userdata('success_msg','Successfully shift the bed of IPD '.$admission['ipd_no']);
              /// So, we put the status in session. redirect the page to step 1, $step=1 /////
              redirect('index.php/admission/bedshift/');
              ////////////////////////////////////////////////////////////////////////////////
          }
          else{
              $this->session->set_userdata('error_msg','Not able to shift the bed of IPD  '.$admission['ipd_no']);
          }
        /// End of step 2 block ///////
      }
    }
    $this->load->view('admission/bedshift',$this->data);
    $this->load->view('common/footer',$this->data);
  }

  public function patientregister()
  {
                $this->data['success_msg']="";
                $ipd=array();
                $ipd=$this->input->post('ipd');
                $ipdNo='';
                if(count($ipd) > 0){
                    if($ipd['to_date'] >= $ipd['from_date']){
                        $cond=" admission.discharge_date >='".$ipd['from_date']."' AND admission.discharge_date <='".$ipd['to_date']."'";
                        if(!empty($ipd['ipd_no'])){
                            $cond.=" AND admission.ipd_no ='".$ipd['ipd_no']."'";
                            $ipdNo=$ipd['ipd_no'];
                        }
                        $admissionList = $this->admission_model->fetch($cond);
                    }
                    else{
                        $admissionList=array();
                        $this->data['success_msg']="To Date must be greated then from Date";
                    }
                    $from_date=$ipd['from_date'];
                    $to_date=$ipd['to_date'];

                }
                else{
                    $admissionList=array();   
                    $from_date=date('Y-m-d');
                    $to_date=date('Y-m-d');
                    $ipdNo='';
                }
                $this->data['admissionList']=$admissionList;
                $this->data['from_date']=$from_date;
                $this->data['to_date']=$to_date;
                $this->data['ipd']=$ipdNo;
                $this->load->view('report/patientregister',$this->data);
                $this->load->view('common/footer',$this->data);
  }

  public function patientregisterprint($from_date='',$to_date='',$ipdNo='')
  {
                $ipd['from_date']=$from_date;
                $ipd['to_date']=$to_date;
                $ipd['ipd_no']=$ipdNo;
                $ipdNo='';
                if($ipd['from_date']!='' && $ipd['to_date'] !=''){
                    if($ipd['to_date'] >= $ipd['from_date']){
                        $cond=" admission.discharge_date >='".$ipd['from_date']."' AND admission.discharge_date <='".$ipd['to_date']."'";
                        if(!empty($ipd['ipd_no'])){
                            $cond.=" AND admission.ipd_no ='".$ipd['ipd_no']."'";
                            $ipdNo=$ipd['ipd_no'];
                        }
                        $admissionList = $this->admission_model->fetch($cond);
                    }
                    else{
                        $admissionList=array();
                    }
                    $from_date=$ipd['from_date'];
                    $to_date=$ipd['to_date'];
                }
                else{
                    $admissionList=array();  
                    $from_date=date('Y-m-d');
                    $to_date=date('Y-m-d');
                    $ipdNo=''; 
                }
                $this->data['admissionList']=$admissionList;
                $this->data['from_date']=$from_date;
                $this->data['to_date']=$to_date;
                $this->data['ipd']=$ipdNo;
                $html=$this->load->view('report/patientregisterprint',$this->data,true);
                //this the the PDF filename that user will get to download
                $pdfFilePath = "Bill.pdf";
                
                //actually, you can pass mPDF parameter on this load() function
                $pdf = $this->m_pdf->load();
                //generate the PDF!
                $pdf->WriteHTML($html);
                //offer it to user via browser download! (The PDF won't be saved on your server HDD)
                $pdf->Output($pdfFilePath, "I");
  }
}
