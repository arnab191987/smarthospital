

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                      <h2>Bed shift<small>shift the bed of ipd</small></h2>
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
                      <div class="alert alert-success" <?php if($success_msg!=""){ ?> style="display: block;" <?php }else{ ?> style="display: none;"<?php } ?>>
                          <button class="close" data-dismiss="alert">×</button>
                          <strong>Success!</strong>  <?php echo $success_msg ?>
                      </div>
                      <div class="alert alert-error" <?php if($error_msg!=""){ ?> style="display: block" <?php }else{ ?>style="display: none" <?php } ?>>
                          <button class="close" data-dismiss="alert">×</button>
                          <strong>Error!</strong>  <?php echo $error_msg ?>
                      </div>
                       <div id="wizard" class="form_wizard wizard_horizontal">
                       <ul class="wizard_steps">
                        <li>
                          <a href="#step-1" <?php if(($ableToFind)){ ?> class="done" <?php } ?>>
                            <span class="step_no">1</span>
                            <span class="step_descr">
                                              Step 1<br />
                                              <small>Enter the IPD</small>
                                          </span>
                          </a>
                        </li>
                        <li>
                            <a href="#step-2"  <?php if(!($ableToFind)){ ?> class="disabled" <?php } else{ ?> class="active" <?php } ?>>
                            <span class="step_no">2</span>
                            <span class="step_descr">
                                              Step 2<br />
                                              <small>Enter Bed Details</small>
                                          </span>
                          </a>
                        </li>
                      </ul>
                  </div>
                      <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="<?php echo $base_url; ?>index.php/admission/bedshift<?php if($ableToFind){ ?>/2 <?php } ?>" method="post">
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">IPD No. <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="name" name="admission[ipd_no]" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $ipd; ?>">
                        </div>
                      </div>
                      <?php if($ableToFind){ ?>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Bed No.<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select class="form-control" name="admission[patient_bed_no]" required="required">
                            <option>Choose option</option>
                             <?php foreach ($bedList as $key => $value) { ?>
                                    <option value="<?php echo $value['bed_no'] ?>"><?php echo $value['bed_no'] ?></option>
                            <?php } ?>
                          </select>
                        </div>
                      </div>
                      <?php } ?>
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <button type="submit" class="btn btn-success"><?php if($ableToFind){ ?>Shift Bed <?php }else{ ?>Find <?php } ?></button>
                        </div>
                      </div>

                    </form>
                  
                    </div>
                </div>
              </div>
            </div>
        </div>
        <!-- /page content -->
