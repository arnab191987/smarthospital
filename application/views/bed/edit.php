

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Update bed information</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="<?php echo $base_url; ?>index.php/bed/">List</a>
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
                      <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="<?php echo $base_url; ?>index.php/bed/edit/<?php echo $details['bed_id']; ?>" method="post">
					
                        <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Bed Type<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select class="form-control" name="bed[bed_type]" required="required">
                            <option>Choose option</option>
                            <?php foreach ($bedTypeList as $key => $value) { ?>
                                <?php 
                                   if($value['id']==$details['bed_type']){
                                      $selected="selected";
                                   } 
                                   else{
                                       $selected="";

                                   }
                                ?>
                                    <option value="<?php echo $value['id'] ?>" <?php echo $selected; ?>><?php echo $value['type'] ?></option>
                            <?php } ?>
                          </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Bed No <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="bed_no" name="bed[bed_no]" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $details['bed_no']; ?>">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Charge <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="charge" name="bed[charge]" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $details['charge']; ?>">
                        </div>
                      </div>
                        <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Unit<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select class="form-control" name="bed[unit]" required="required">
                            <option>Choose option</option>
                             <?php foreach ($unitList as $key => $value) { ?>
                                <?php 
                                   if($value['id']==$details['unit']){
                                      $selected="selected";
                                   } 
                                   else{
                                       $selected="";

                                   }
                                ?>
                                    <option value="<?php echo $value['id'] ?>" <?php echo $selected; ?>><?php echo $value['unit_name'] ?></option>
                            <?php } ?>
                          </select>
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
