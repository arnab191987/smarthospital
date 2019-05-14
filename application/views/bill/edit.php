

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                      <h2>Update admission details of <b><?php echo $details['ipd_no']; ?></b></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="<?php echo $base_url; ?>index.php/admission/">List</a>
                          </li>
                        </ul>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div class="alert alert-success" <?php if($success_msg!=""){ ?> style="display: block;" <?php }else{ ?> style="display: none;"<?php } ?>>
                        <button class="close" data-dismiss="alert">×</button>
                        <strong>Success!</strong>  <?php echo $success_msg ?>
                    </div>
                    <div class="alert alert-error" <?php if($error_msg!=""){ ?> style="display: block" <?php }else{ ?>style="display: none" <?php } ?>>
                        <button class="close" data-dismiss="alert">×</button>
                        <strong>Error!</strong>  <?php echo $error_msg ?>
                    </div>
                      <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="<?php echo $base_url; ?>index.php/admission/edit/<?php echo $details['admission_id']; ?>" method="post">
					
			
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Patient Name <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="name" name="admission[patient_name]" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $details['patient_name']; ?>">
                        </div>
                      </div>
                      
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Sex</label>
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
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Address <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                           <textarea id="message" name="admission[patient_address]" required="required" class="form-control" name="message" data-parsley-trigger="keyup" data-parsley-minlength="0" data-parsley-maxlength="100" data-parsley-minlength-message="Come on! You need to enter at least a 20 caracters long comment.."
                            data-parsley-validation-threshold="10"><?php echo $details['patient_address']; ?></textarea>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">PS <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="name" name="admission[patient_ps]" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $details['patient_ps']; ?>">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">City/District <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="name" name="admission[patient_city_district]" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $details['patient_city_district']; ?>">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Pincode <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="name" name="admission[patient_pin]" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $details['patient_pin']; ?>">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Contact No <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="numeric" id="name" name="admission[patient_phone]" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $details['patient_phone']; ?>">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Contact No.1 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="numeric" id="name" name="admission[patient_phone1]" class="form-control col-md-7 col-xs-12" value="<?php echo $details['patient_phone1']; ?>">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Date Of admission <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="birthday" class="date-picker form-control col-md-7 col-xs-12" name="admission[patient_admission_date]" required="required" type="text" value="<?php echo $details['patient_admission_date']; ?>">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Bed No.<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input class="form-control" name="admission[patient_bed_no]" readonly="readonly" type="text" value="<?php echo $details['patient_bed_no']; ?>">
                          
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Doctor<small class="text-navy">(Admitted Under)</small><span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select class="form-control" name="admission[doctor]" required="required">
                            <option>Choose option</option>
                             <?php echo $details['doctor'];foreach ($doctorList as $key => $value) { ?>
                                    <?php 
                                        if($value['doctor_id']==$details['doctor']){ 
                                           $select="selected"; 
                                        }
                                        else{
                                           $select=""; 
                                        }
                                    ?>
                                    <option value="<?php echo $value['doctor_id'] ?>" <?php echo $select;  ?>><?php echo $value['doctor_name'] ?></option>
                            <?php } ?>
                          </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Remarks <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                           <textarea id="message" name="admission[remarks]" required="required" class="form-control" name="message" data-parsley-trigger="keyup"   data-parsley-maxlength="100" data-parsley-minlength-message="Come on! You need to enter at least a 20 caracters long comment.."
                            data-parsley-validation-threshold="10"><?php echo $details['remarks']; ?></textarea>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-md-3 col-sm-3 col-xs-12 control-label">Is patient discharged? 
                         </label>
                         <?php if($details['is_discharged']!="on"){ ?>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <div class="checkbox">
                            <label class="">
                                
                                <div class="icheckbox_flat-green" style="position: relative;"><input class="flat" name="admission[is_discharged]"  style="position: absolute; opacity: 0;" type="checkbox"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255) none repeat scroll 0% 0%; border: 0px none; opacity: 0;"></ins></div> Checked
                            </label>
                          </div>
                        </div>
                        <?php }else{ ?>
                          <div class="col-md-9 col-sm-9 col-xs-12">
                              <div class="checkbox">
                                  <label style="color:green;font-weight: bold;font-size: 20px;"><b>Yes</b></label>
                              </div>
                          </div>
                        <?php }?>
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
