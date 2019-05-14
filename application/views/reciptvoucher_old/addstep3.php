

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                      <h2>Add Recipt Voucher details<small>Entry of deposit amount</small></b></h2>
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
                                              <small>Find details by IPD </small>
                                          </span>
                          </a>
                        </li>
                        <li>
                            <a href="#step-2" class="done">
                            <span class="step_no">2</span>
                            <span class="step_descr">
                                              Step 2<br />
                                              <small>Details of admission</small>
                                          </span>
                          </a>
                        </li>
                        <li>
                          <a href="#step-3">
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
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Amount <span class="required">*</span>
                          </label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                              <input type="text" id="name" name="voucher[credit]" required="required" class="form-control col-md-7 col-xs-12" value="">
                              <input type="hidden" id="name" name="voucher[party]" class="form-control col-md-7 col-xs-12" value="<?php echo $ipd; ?>">
                              <input type="hidden" id="name" name="voucher[depositer_name]" required="required" class="form-control col-md-4 col-xs-12" value="<?php echo $depositer_name; ?>">
                          </div>
                        </div>  
                        <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12">Payment Mode<span class="required">*</span></label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            <select class="form-control" name="voucher[mode]" required="required">
                              <option>Choose option</option>
                              <?php foreach ($paymentModeList as $key => $value) { ?>
                                      <option value="<?php echo $value['id'] ?>"><?php echo $value['mode_name'] ?></option>
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
                                      <option value="<?php echo $value['id'] ?>"><?php echo $value['ledger_name'] ?></option>
                              <?php } ?>
                            </select>
                          </div>
                        </div>
                        <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Narration <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                           <textarea id="message" name="voucher[narration]" required="required" class="form-control" name="message" data-parsley-trigger="keyup" data-parsley-maxlength="100" data-parsley-minlength-message="Come on! You need to enter at least a 20 caracters long comment.."
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
