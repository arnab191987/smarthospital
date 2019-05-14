

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Closing Report</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="<?php echo $base_url; ?>index.php/reciptvoucher/closingreportsummarypdf/<?php echo $date; ?>" target="_blank" >Summary Print</a></li>
                        </ul>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                  <div class="col-md-12 col-sm-12 col-xs-12" style="text-align: right;font-weight: bold;color: #73879c;margin-bottom: 5px;margin-right: 20px;"><a href="<?php echo $base_url; ?>index.php/reciptvoucher/closingreportpdf/<?php echo $date; ?>" target="_blank"><img style="" src="<?php echo $base_url; ?>images/print.png" /></a> Print </div>
                      <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="<?php echo $base_url; ?>index.php/reciptvoucher/closingreport/" method="post">
		      
                    <div class="alert alert-success" <?php if($success_msg!=""){ ?> style="display: block;" <?php }else{ ?> style="display: none;"<?php } ?>>
                            <button class="close" data-dismiss="alert">×</button>
                              <?php echo $success_msg ?>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12">Date <span class="required">*</span>
                          </label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="birthday" name="reciptvoucher[from_date]" class="date-picker form-control col-md-7 col-xs-12" required="required" type="text">
                          </div>
                        </div>
                        <div class="ln_solid"></div>
                        <div class="form-group">
                          <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                            <button type="submit" class="btn btn-success">Submit</button>
                          </div>
                        </div>

                    </form>
                    <h2><b><u>Income</u></b></h2>                    
                    <table  class="table table-striped table-bordered ">
                      <thead>
                        <tr>
                          <th>Sl</th>
                          <th>Date</th>
                          <th>Vouchar No</th>
                          <th>Payment Mode</th>
                          <th>Posting Ledger</th>
                          <th>Amount (Rs.)</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                            $sl=1;
                            $credittotal=$cash=$card=$cheque=$neft=0;
                        ?>
                        <?php foreach ($reciptVoucharList as $key => $value) { ?>
                        <tr>
                            <td><?php echo $sl; ?></td>
                            <td><?php echo $value['add_date'] ?></td>
                            <td><?php echo $value['voucher_no'] ?></td>
                            <td><?php echo $value['mode_name'] ?></td>
                            <td><?php echo $value['ledger_name'] ?></td>
                            <td><?php echo $value['credit'] ?></td>
                        </tr>
                        <?php 
                            $sl++; 
                            if($value['mode']==1){
                              $cash=$cash+$value['credit'];
                            }
                            if($value['mode']==2){
                              $card=$card+$value['credit'];
                            }
                            if($value['mode']==3){
                              $cheque=$cheque+$value['credit'];
                            }
                            if($value['mode']==4){
                              $neft=$neft+$value['credit'];
                            }
                            $credittotal=$credittotal+$value['credit'];
                        ?>
                        <?php } ?>
                      </tbody>
                    </table>
                    <div id="showAmount"><h2><span><b>Total(A)</b> &nbsp;</span><span id="amountShow"><b><?php echo "Rs. ".$credittotal; ?></b></span></h2></div>
                    <div class="showAmount"><h2><span><b>Total cash recived &nbsp;=</b></span><span id="amountShow"><b><?php echo "Rs. ".$cash; ?></b></span></h2></div>
                   
                    <div class="showAmount"><h2><span><b>Total card recived &nbsp;=</b></span><span id="amountShow"><b><?php echo "Rs. ".$card; ?></b></span></h2></div>
                    
                    <div class="showAmount"><h2><span><b>Total cheque recived &nbsp;=</b></span><span id="amountShow"><b><?php echo "Rs. ".$cheque; ?></b></span></h2></div>
                    
                    <div class="showAmount"><h2><span><b>Total NEFT recived &nbsp;=</b></span><span id="amountShow"><b><?php echo "Rs. ".$neft; ?></b></span></h2></div>
                    
                    
                      <br/>
                      
                  </div>
                  <h2><b><u>Expenditure</u></b></h2>
                  <table  class="table table-striped table-bordered ">
                      <thead>
                        <tr>
                          <th>Sl</th>
                          <th>Date</th>
                          <th>Vouchar No</th>
                          <th>Payment Mode</th>
                          <th>Posting Ledger</th>
                          <th>Amount (Rs.)</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                            $sl=1;
                            $debittotal=$cash=$card=$cheque=$neft=0;
                        ?>
                        <?php foreach ($paymentVoucharList as $key => $value) { ?>
                        <tr>
                            <td><?php echo $sl; ?></td>
                            <td><?php echo $value['add_date'] ?></td>
                            <td><?php echo $value['voucher_no'] ?></td>
                            <td><?php echo $value['mode_name'] ?></td>
                            <td><?php echo $value['ledger_name'] ?></td>
                            <td><?php echo $value['debit'] ?></td>
                        </tr>
                        <?php 
                            $sl++; 
                            if($value['mode']==1){
                              $cash=$cash+$value['debit'];
                            }
                            if($value['mode']==2){
                              $card=$card+$value['debit'];
                            }
                            if($value['mode']==3){
                              $cheque=$cheque+$value['debit'];
                            }
                            if($value['mode']==4){
                              $neft=$neft+$value['debit'];
                            }
                            $debittotal=$debittotal+$value['debit'];
                        ?>
                        <?php } ?>
                       
                    </table>
                    <?php $difference= $credittotal-$debittotal; ?>
                      <div id="showAmount"><h2><span><b>Total(B)</b> &nbsp;</span><span id="amountShow"><b><?php echo "Rs. ".$debittotal; ?></b></span></h2></div>
                      <div class="showAmount"><h2><span><b>Total cash recived &nbsp;=</b></span><span id="amountShow"><b><?php echo "Rs. ".$cash; ?></b></span></h2></div>
                    <div class="showAmount"><h2><span><b>Total card recived &nbsp;=</b></span><span id="amountShow"><b><?php echo "Rs. ".$card; ?></b></span></h2></div>
                    
                    <div class="showAmount"><h2><span><b>Total cheque recived &nbsp;=</b></span><span id="amountShow"><b><?php echo "Rs. ".$cheque; ?></b></span></h2></div>
                    
                    <div class="showAmount"><h2><span><b>Total NEFT recived &nbsp;=</b></span><span id="amountShow"><b><?php echo "Rs. ".$neft; ?></b></span></h2></div>
                    <br/>
                    <br/>
                    <h2><b><u>Summary:</u></b></h2>
                    <div class="calculateReport"><h2><span><b>Total&nbsp;(A-B)&nbsp;=</b> &nbsp;</span><span id="amountShow"><b><?php echo "Rs. ".$difference; ?></b></span></h2></div>
                      
                      <?php if($cashinhand!=0){ ?>
                      <div class="calculateReport"><h2><span><b>Cash Recived &nbsp;=</b></span><span id="amountShow"><b><?php echo "Rs. ".$cashcredit; ?></b></span></h2></div>
                    
                      <div class="calculateReport"><h2><span><b>Cash Given &nbsp;=</b></span><span id="amountShow"><b><?php echo "Rs. ".$cashdebit; ?></b></span></h2></div>
                      
                      <div class="calculateReport"><h2><span><b>Cash in hand&nbsp;Rs. (&nbsp;<?php echo $cashcredit."-".$cashdebit ?>)&nbsp;=</b></span><span id="amountShow"><b><?php echo "Rs. ".$cashinhand; ?></b></span></h2></div>
                      <?php } ?>
                  </div>
                  
                </div>
              </div>
            </div>
        </div>
        <!-- /page content -->
