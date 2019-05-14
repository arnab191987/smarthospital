

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Bill Register</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="<?php echo $base_url; ?>index.php/bill/addstep1">Add</a>
                          </li>
                        </ul>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                      <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="<?php echo $base_url; ?>index.php/bill/billregister/" method="post">
		      
                    <div class="alert alert-success" <?php if($success_msg!=""){ ?> style="display: block;" <?php }else{ ?> style="display: none;"<?php } ?>>
                            <button class="close" data-dismiss="alert">×</button>
                              <?php echo $success_msg ?>
                        </div>
                          <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Bill No <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" name="bill[bill_no]" id="qtydoctor" class="form-control col-md-7 col-xs-12" >
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">From Date <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="birthday" name="bill[from_date]" class="date-picker form-control col-md-7 col-xs-12" required="required" type="text">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">To Date <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="birthday_to" name="bill[to_date]" class="date-picker form-control col-md-7 col-xs-12" required="required" type="text">
                        </div>
                      </div>
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <button type="submit" class="btn btn-success">Search Bill</button>
                        </div>
                      </div>

                    </form>
                  
                    
                    <table id="datatable" class="table table-striped table-bordered  billReg">
                      <thead>
                        <tr>
                          <th>Sl</th>
                          <th>Date</th>
                          <th>Bill No</th>
                          <th>IPD/OPD No</th>
                          <th>Patient</th>
                          <th>Amount (Rs.)</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                            $sl=1;
                            $total=0;
                        ?>
                        <?php foreach ($billList as $key => $value) { ?>
                        <tr>
                            <td><?php echo $sl; ?></td>
                            <td><?php echo $value['add_date'] ?></td>
                            <td><?php echo $value['bill_no'] ?></td>
                            <td><?php echo $value['ipd_no'] ?></td>
                            <td><?php echo $value['patient_name'] ?></td>
                            <td><?php echo $value['total_amount'] ?></td>
                        </tr>
                        <?php 
                            $sl++; 
                            $total=$total+$value['total_amount'];
                        ?>
                        <?php } ?>
                       
                    </table>
                      <div id="wrapAmpount"><div id="showAmount"><h2><span><b>Total</b> &nbsp;</span><span id="amountShow"><b><?php echo "Rs. ".$total; ?></b></span></h2></div></div>
                  </div>
                </div>
              </div>
            </div>
        </div>
        <!-- /page content -->
