

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Add Recipt Voucher details<small>Details of admission</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="<?php echo $base_url; ?>index.php/reciptvoucher/">List</a>
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
                                              <small>Find details by IPD</small>
                                          </span>
                          </a>
                        </li>
                        <li>
                            <a href="#step-2">
                            <span class="step_no">2</span>
                            <span class="step_descr">
                                              Step 2<br />
                                              <small>Details of admission</small>
                                          </span>
                          </a>
                        </li>
                        <li>
                          <a href="#step-3" class="disabled">
                            <span class="step_no">3</span>
                            <span class="step_descr">
                                              Step 3<br />
                                              <small>Entry of deposit amount</small>
                                          </span>
                          </a>
                        </li>
                      </ul>
                  </div>
                      <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="<?php echo $base_url; ?>index.php/reciptvoucher/addstep3" method="post">
					
			
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Patient Name <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="name" name="admission[patient_name]" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $details['patient_name']; ?>">
                            <input type="hidden" id="name" name="admission[depositer_name]" required="required" class="form-control col-md-4 col-xs-12" value="<?php echo $details['depositer_name']; ?>">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Bed No.<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input class="form-control" name="admission[patient_bed_no]" readonly="readonly" type="text" value="<?php echo $details['patient_bed_no']; ?>">
                          
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Gender</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <?php 
                                $male=$female="";
                                if($details['sex']=="male"){ 
                                   $male="active"; 
                                }
                                if($details['sex']=="female"){ 
                                   $female="active"; 
                                }
                            ?>
                          <div id="gender" class="btn-group" data-toggle="buttons">
                            <label class="btn btn-default <?php echo $male; ?>" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                              <input type="radio" name="admission[sex]" value="male"> &nbsp; Male &nbsp;
                            </label>
                            <label class="btn btn-primary <?php echo $female; ?>" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                              <input type="radio" name="admission[sex]" value="female"> Female
                            </label>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Age<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="numeric" id="name" name="admission[age]" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $details['age']; ?>">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Date Of admission <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="birthday" class="date-picker form-control col-md-7 col-xs-12" name="admission[patient_admission_date]" required="required" type="text" value="<?php echo $details['patient_admission_date']; ?>">
                          <input id="birthday" class="date-picker form-control col-md-7 col-xs-12" name="admission[ipd_no]" type="hidden" value="<?php echo $details['ipd_no']; ?>">
                        </div>
                      </div>   
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                      </div>

                    </form>
                  
                    </div>
                </div>
              </div>
	    </div>
        </div>
        <!-- /page content -->
