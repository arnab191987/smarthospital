

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                      <h2>Update Payment Voucher details of <?php echo $voucher ?><small>Entry of paid amount</small></b></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="<?php echo $base_url; ?>index.php/paymentvoucher/">List</a>
                          </li>
                        </ul>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                      <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="<?php echo $base_url; ?>index.php/paymentvoucher/edit/<?php echo $voucher;  ?>" method="post">
                        <div class="alert alert-success" <?php if($success_msg!=""){ ?> style="display: block;" <?php }else{ ?> style="display: none;"<?php } ?>>
                            <button class="close" data-dismiss="alert">×</button>
                            <strong>Success!</strong>  <?php echo $success_msg ?>
                        </div>
                        <div class="alert alert-error" <?php if($error_msg!=""){ ?> style="display: block" <?php }else{ ?>style="display: none" <?php } ?>>
                            <button class="close" data-dismiss="alert">×</button>
                            <strong>Error!</strong>  <?php echo $error_msg ?>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">IPD No <span class="required">*</span>
                          </label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                              <input type="text" readonly="" id="name" name="" class="form-control col-md-7 col-xs-12" value="<?php echo $paymentvoucherDetails['0']['party']; ?>">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Amount(Rs.) <span class="required">*</span>
                          </label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                              <input type="text" id="name" name="voucher[debit]" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $paymentvoucherDetails['0']['debit']; ?>">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12">Payment Mode<span class="required">*</span></label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            <select class="form-control" name="voucher[mode]" required="required">
                              <option>Choose option</option>
                              <?php foreach ($paymentModeList as $key => $value) { ?>
                                    <?php 
                                        if($paymentvoucherDetails['0']['mode']==$value['id']){
                                            $selected="selected";
                                        }
                                        else{
                                            $selected="";
                                        }
                                    ?>
                                      <option value="<?php echo $value['id'] ?>" <?php echo $selected; ?>><?php echo $value['mode_name'] ?></option>
                              <?php } ?>
                            </select>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12">Ledger<span class="required">*</span></label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            <select class="form-control" name="voucher[posting_ledger]" required="required">
                              <option>Choose option</option>
                              <?php foreach ($ledgerList as $key => $value) { ?>
                                    <?php 
                                        if($paymentvoucherDetails['0']['posting_ledger']==$value['id']){
                                            $selected="selected";
                                        }
                                        else{
                                            $selected="";
                                        }
                                    ?>
                                      <option value="<?php echo $value['id'] ?>" <?php echo $selected; ?>><?php echo $value['ledger_name'] ?></option>
                              <?php } ?>
                            </select>
                          </div>
                        </div>
                        <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Narration <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                           <textarea id="message" name="voucher[narration]" required="required" class="form-control" name="message" data-parsley-trigger="keyup"   data-parsley-maxlength="100" data-parsley-minlength-message="Come on! You need to enter at least a 20 caracters long comment.."
                            data-parsley-validation-threshold="10"><?php echo $paymentvoucherDetails['0']['narration']; ?></textarea>
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
