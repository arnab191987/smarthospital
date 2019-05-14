

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Add Equipment details</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="<?php echo $base_url; ?>index.php/bill/">List</a>
                          </li>
                        </ul>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                       <div id="wizard" class="form_wizard wizard_horizontal">
                       <ul class="wizard_steps">
                        <li>
                          <a href="#step-1" class="done">
                            <span class="step_no">1</span>
                            <span class="step_descr">
                                              Step 1<br />
                                              <small>Generate Bill No</small>
                                          </span>
                          </a>
                        </li>
                        <li>
                          <a href="#step-1" class="done">
                            <span class="step_no">2</span>
                            <span class="step_descr">
                                              Step 2<br />
                                              <small>Admission Details</small>
                                          </span>
                          </a>
                        </li>
                        <li>
                            <a href="#step-2"  class="done">
                            <span class="step_no">3</span>
                            <span class="step_desc">
                                              Step 3<br />
                                              <small>Add Bed information</small>
                                          </span>
                          </a>
                        </li>
                        <li>
                          <a href="#step-3" class="done">
                            <span class="step_no">4</span>
                            <span class="step_descr">
                                              Step 4<br />
                                              <small>Add Service Information</small>
                                          </span>
                          </a>
                        </li>
                        <li>
                          <a href="#step-3" class="done">
                            <span class="step_no">5</span>
                            <span class="step_descr">
                                              Step 5<br />
                                              <small>Add Doctor Information</small>
                                          </span>
                          </a>
                        </li>
                        <li>
                          <a href="#step-3" class="active">
                            <span class="step_no">6</span>
                            <span class="step_descr">
                                              Step 6<br />
                                              <small>Add Equipment</small>
                                          </span>
                          </a>
                        </li>
                      </ul>
                  </div>
                      <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="<?php echo $base_url; ?>index.php/bill/addstep6/<?php echo $bill_no; ?>/<?php echo $mode; ?>" method="post">
			<div class="alert alert-success" <?php if($success_msg!=""){ ?> style="display: block;" <?php }else{ ?> style="display: none;"<?php } ?>>
                            <button class="close" data-dismiss="alert">×</button>
                            <strong>Success!</strong>  <?php echo $success_msg ?>
                        </div>
                        <div class="alert alert-error" <?php if($error_msg!=""){ ?> style="display: block" <?php }else{ ?>style="display: none" <?php } ?>>
                            <button class="close" data-dismiss="alert">×</button>
                            <strong>Error!</strong>  <?php echo $error_msg ?>
                        </div>		
                        
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Equipment Name <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select class="form-control" name="machine[machine_name]" required="required">
                            <option>Choose option</option>
                            <?php foreach ($machineList as $key => $value) { ?>
                                    <option value="<?php echo $value['equipement_name'] ?>"><?php echo $value['equipement_name'] ?></option>
                            <?php } ?>
                          </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Quantity <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="machineQty" name="machine[qty]" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                      <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Total billed amount <span class="required"><b>Rs.</b></span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" readonly="" class="form-control col-md-7 col-xs-12" value="<?php echo $total_amount['total_amount']; ?>">
                        </div>
                      </div>
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <?php 
                            if($mode=="edit"){ 
                                $path=base_url()."index.php/bill/billdetails/". $bill_no;
                            }else{
                                $path=base_url()."index.php/bill/";
                            } 
                          ?>
                          <a class="buttonPrevious buttonDisabled btn btn-primary" style="background-color: #FFA500; border-color: #FFA500;" href="<?php echo base_url(); ?>index.php/bill/finalsave/<?php echo $bill_no; ?>">Final & Save </a>
                          <button type="submit" class="btn btn-success">Submit</button>
                          <a class="buttonPrevious buttonDisabled btn btn-primary" href="<?php echo $path; ?>">Complete </a>
                        </div>
                          
                      </div>

                    </form>
                  
                    </div>
                </div>
              </div>
	    </div>
        </div>
        <!-- /page content -->
