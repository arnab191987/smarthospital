

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Update Bed details of Bill No. <?php echo $bill_no; ?></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="<?php echo $base_url; ?>index.php/bill/billdetails/<?php echo $bill_no; ?>">List</a>
                          </li>
                        </ul>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                       
                      <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="<?php echo $base_url; ?>index.php/bill/editbedinfo/<?php echo $bill_no; ?>/<?php echo $info['id']; ?>" method="post">
			<div class="alert alert-success" <?php if($success_msg!=""){ ?> style="display: block;" <?php }else{ ?> style="display: none;"<?php } ?>>
                            <button class="close" data-dismiss="alert">×</button>
                            <strong>Success!</strong>  <?php echo $success_msg ?>
                        </div>
                        <div class="alert alert-error" <?php if($error_msg!=""){ ?> style="display: block" <?php }else{ ?>style="display: none" <?php } ?>>
                            <button class="close" data-dismiss="alert">×</button>
                            <strong>Error!</strong>  <?php echo $error_msg ?>
                        </div>		
                        
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Bed No <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select class="form-control" id="bedNo" name="bed[bed_no]" required="required">
                            <option>Choose option</option>
                            <?php foreach ($bedList as $key => $value) { ?>
                                    <?php 
                                        if($value['bed_no']==$info['bed_no']){ 
                                            $selected="selected";
                                        }
                                        else{
                                            $selected="";
                                        }
                                    ?>
                                    <option value="<?php echo $value['bed_no'] ?>" <?php echo $selected; ?>><?php echo $value['bed_no'] ?></option>
                            <?php } ?>
                          </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Bed Type<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input class="form-control"  readonly="readonly" id="bedType" type="text" value="<?php echo $info['bed_type']; ?>">
                        </div>
                      </div>
                      <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12">Charge per <span id="unit"><?php echo $info['unit']; ?></span><span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input class="form-control" readonly="readonly" id="bedCharge" type="text" value="<?php echo "Rs. ".$info['rate']; ?>">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Quantity <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="qty" name="bed[qty]" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $info['qty']; ?>">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Total Amount<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input class="form-control"  readonly="readonly" id="totalAmount" type="text" value="<?php echo $info['amount']; ?>">
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
