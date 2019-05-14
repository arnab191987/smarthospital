

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Add Death Certificate details<small>Details of certificate</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="<?php echo $base_url; ?>index.php/birthcertificate/">List</a>
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
                                              <small>Details of Certificate</small>
                                          </span>
                          </a>
                        </li>
                      </ul>
                  </div>
                      <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="<?php echo $base_url; ?>index.php/deathcertificate/addstep3" method="post">
					           
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Date <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="birthday" class="date-picker form-control col-md-7 col-xs-12" name="deathcertificate[death_date]" required="required" type="text" value="<?php echo $details['patient_admission_date']; ?>">
                          <input id="birthday" class="date-picker form-control col-md-7 col-xs-12" name="deathcertificate[ipd_no]" type="hidden" value="<?php echo $details['ipd_no']; ?>">
                        </div>
                      </div> 
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Time <span class="required">*</span>
                        </label>
                        <div class="col-md-2 col-sm-2 col-xs-12">
                          <select class="select2_single form-control select2-hidden-accessible" tabindex="-1" aria-hidden="true" name="deathcertificate[hh]">
                            <option>HH</option>
                            <?php for ($i=1;$i<=60;$i++) { $i = sprintf('%02d', $i);?>
                            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                            <?php } ?>
                            </select>
                        </div>
                         <div class="col-md-2 col-sm-2 col-xs-12">
                          <select class="select2_single form-control select2-hidden-accessible" tabindex="-1" aria-hidden="true" name="deathcertificate[mm]">
                            <option>MM</option>
                            <?php for ($i=1;$i<=60;$i++) { $i = sprintf('%02d', $i);?>
                            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                            <?php } ?>
                            </select>
                        </div>
                        <div class="col-md-2 col-sm-2 col-xs-12">
                          <select class="select2_single form-control select2-hidden-accessible" tabindex="-1" aria-hidden="true" name="deathcertificate[ss]">
                            <option>SS</option>
                            <?php for ($i=1;$i<=60;$i++) { $i = sprintf('%02d', $i);?>
                            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                            <?php } ?>
                            </select>
                        </div>
                      </div> 

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Name <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="name" name="deathcertificate[name]" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $details['patient_name']; ?>">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Sex</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <div id="gender" class="btn-group" data-toggle="buttons">
                            <label class="btn btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                              <input type="radio" name="deathcertificate[sex]" value="male"> &nbsp; Male &nbsp;
                            </label>
                            <label class="btn btn-primary" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                              <input type="radio" name="deathcertificate[sex]" value="female"> Female
                            </label>
                          </div>
                        </div>
                      </div> 
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Nationality <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="name" name="deathcertificate[nationality]" required="required" class="form-control col-md-7 col-xs-12" value="">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Religion <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="name" name="deathcertificate[religion]" required="required" class="form-control col-md-7 col-xs-12" value="">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Age <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="name" name="deathcertificate[age]" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $details['age']; ?>">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Address <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="name" name="deathcertificate[address]" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $details['patient_address']; ?>">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">City <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="name" name="deathcertificate[city]" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $details['patient_city_district']; ?>">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Police Station <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="name" name="deathcertificate[ps]" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $details['patient_ps']; ?>">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Pin <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="name" name="deathcertificate[pin]" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $details['patient_pin']; ?>">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Reason <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                           <textarea id="message" name="deathcertificate[reason]" required="required" class="form-control" name="message" data-parsley-trigger="keyup"   data-parsley-maxlength="100" data-parsley-minlength-message="Come on! You need to enter at least a 20 caracters long comment.."
                            data-parsley-validation-threshold="10"></textarea>
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
