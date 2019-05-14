<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Update Birth Certificate details<small>Details of certificate</small></h2>
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
              <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="<?php echo $base_url; ?>index.php/birthcertificate/edit/<?php echo $details['id'] ?>" method="post">
             
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Birth Date <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input id="birthday" class="date-picker form-control col-md-7 col-xs-12" name="birthcertificate[born_date]" required="required" type="text" value="<?php echo $details['born_date']; ?>">
                  <input id="birthday" class="date-picker form-control col-md-7 col-xs-12" name="birthcertificate[ipd_no]" type="hidden" value="<?php echo $details['ipd_no']; ?>">
                </div>
              </div> 
              <?php
                  $birthTime=$details['born_time'];
                  $time=explode(":", $birthTime);
                  $hh=$time[0];
                  $mm=$time[1];
                  $ss=$time[2];
              ?>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Birth Time <span class="required">*</span>
                </label>
                  <div class="col-md-2 col-sm-2 col-xs-12">
                          <select class="select2_single form-control select2-hidden-accessible" tabindex="-1" aria-hidden="true" name="birthcertificate[hh]">
                            <option>HH</option>
                            <?php for ($i=1;$i<=60;$i++) { $i = sprintf('%02d', $i);
                                  $selected="";
                                  if($hh==$i){
                                    $selected="selected";
                                  }
                            ?>
                            <option value="<?php echo $i; ?>" <?php echo $selected; ?>><?php echo $i; ?></option>
                            <?php } ?>
                            </select>
                        </div>
                         <div class="col-md-2 col-sm-2 col-xs-12">
                          <select class="select2_single form-control select2-hidden-accessible" tabindex="-1" aria-hidden="true" name="birthcertificate[mm]">
                            <option>MM</option>
                            <?php for ($i=1;$i<=60;$i++) { $i = sprintf('%02d', $i);
                                  $selected=""; 
                                  if($mm==$i){
                                    $selected="selected";
                                  }
                            ?>
                            <option value="<?php echo $i; ?>" <?php echo $selected; ?>><?php echo $i; ?></option>
                            <?php } ?>
                            </select>
                        </div>
                        <div class="col-md-2 col-sm-2 col-xs-12">
                          <select class="select2_single form-control select2-hidden-accessible" tabindex="-1" aria-hidden="true" name="birthcertificate[ss]">
                            <option>SS</option>
                            <?php for ($i=1;$i<=60;$i++) { $i = sprintf('%02d', $i);
                                  $selected="";
                                  if($ss==$i){
                                    $selected="selected";
                                  }
                            ?>
                            <option value="<?php echo $i; ?>" <?php echo $selected; ?>><?php echo $i; ?></option>
                            <?php } ?>
                            </select>
                        </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Child Name <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" id="name" name="birthcertificate[child_name]" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $details['child_name']; ?>">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Child Sex</label>
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
                      <input type="radio" name="birthcertificate[sex]" value="male"> &nbsp; Male &nbsp;
                    </label>
                    <label class="btn btn-primary <?php echo $female; ?>" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                      <input type="radio" name="birthcertificate[sex]" value="female"> Female
                    </label>
                  </div>
                </div>
              </div> 
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Father Name <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" id="name" name="birthcertificate[father_name]" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $details['father_name']; ?>">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Mother Name <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" id="name" name="birthcertificate[mother_name]" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $details['mother_name']; ?>">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Nationality <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" id="name" name="birthcertificate[nationality]" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $details['nationality']; ?>">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Religion <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" id="name" name="birthcertificate[religion]" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $details['religion']; ?>">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Address <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" id="name" name="birthcertificate[address]" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $details['address']; ?>">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">City <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" id="name" name="birthcertificate[city]" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $details['city']; ?>">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Police Station <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" id="name" name="birthcertificate[ps]" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $details['ps']; ?>">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Pin <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" id="name" name="birthcertificate[pin]" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $details['pin']; ?>">
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
