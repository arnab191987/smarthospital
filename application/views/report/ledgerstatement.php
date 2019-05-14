

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Ledger Statement</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="<?php echo $base_url; ?>index.php/reciptvoucher/add">Add</a>
                          </li>
                        </ul>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                      <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="<?php echo $base_url; ?>index.php/reciptvoucher/ledgerstatement" method="post">
		      
                        <div class="alert alert-success" <?php if($success_msg!=""){ ?> style="display: block;" <?php }else{ ?> style="display: none;"<?php } ?>>
                            <button class="close" data-dismiss="alert">×</button>
                              <?php echo $success_msg ?>
                        </div>
                        <div class="col-md-12 col-sm-12 col-xs-12" style="text-align: right;font-weight: bold;color: #73879c;margin-bottom: 5px;margin-right: 20px;"><a href="<?php echo $base_url; ?>index.php/reciptvoucher/ledgerstatementpdf/<?php echo $from_date; ?>/<?php echo $to_date; ?>/<?php echo $ledgerid; ?>" target="_blank"><img style="" src="<?php echo $base_url; ?>images/print.png" /></a> Print </div>
                          <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Posting Ledger <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <select class="form-control" name="ledger_statement[posting_ledger]" required="required">
                              <option value="">Choose option</option>
                              <?php foreach ($ledgerList as $key => $value) { ?>
                                      <option value="<?php echo $value['id'] ?>"><?php echo $value['ledger_name'] ?></option>
                              <?php } ?>
                            </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">From Date <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="birthday" name="ledger_statement[from_date]" class="date-picker form-control col-md-7 col-xs-12" required="required" type="text">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">To Date <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="birthday_to" name="ledger_statement[to_date]" class="date-picker form-control col-md-7 col-xs-12" required="required" type="text">
                        </div>
                      </div>
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <button type="submit" class="btn btn-success">Search Patient</button>
                        </div>
                      </div>

                    </form>
                  
                    <div style="text-align: center;font-size: 17px"><b>Khata : <?php echo $postingLedgerName; ?>&nbsp;&nbsp;&nbsp;&nbsp;From : &nbsp;&nbsp;<?php echo $from_date; ?>&nbsp;&nbsp;&nbsp;&nbsp;To: <?php echo $to_date; ?></b></div>
                    <table id="datatable" class="table table-striped table-bordered  billReg">
                      <thead>
                        <tr>
                          <th>Sl</th>
                          <th>Date</th>
                          <th>Mode</th>
                          <th>Voucher Type</th>
                          <th>Narration</th>
                          <th>Dr(Rs.)</th>
                          <th>Cr(Rs.)</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                            $sl=1;
                            $totalDr=$totalCr=0;
                        ?>
                        <tr>
                            <td><?php echo $sl++; ?></td>
                            <td colspan="4"><center>Opening Balance</center></td>
                            <td><?php echo $openingBalance_Dr ?></td>
                            <td><?php echo $openingBalance_Cr ?></td>
                            <?php
                              $totalDr=$totalDr+$openingBalance_Dr;
                              $totalCr=$totalCr+$openingBalance_Cr;
                            ?>
                        </tr>
                        <?php 
                              if(count($voucharList) > 0){
                              foreach ($voucharList as $key => $value) { ?>
                        <tr>
                            <td><?php echo $sl++; ?></td>
                            <td><?php echo $value['recipt_add_date'] ?></td>
                            <td><?php echo $value['mode_name'] ?></td>
                            <td><?php echo ucfirst($value['voucher_type']); ?></td>
                            <td><?php echo ucfirst($value['narration']); ?></td>
                            <td><?php echo $value['debit'] ?></td>
                            <td><?php echo $value['credit'] ?></td>
                            <?php
                              $totalDr=$totalDr+$value['debit'];
                              $totalCr=$totalCr+$value['credit'];
                            ?>
                        </tr>
                        <?php } ?>
                       <tr>
                            <td colspan="5" style="font-size: 17px"><center><b>Total</b></center></td>
                            <td style="font-size: 17px"><b>Rs.<?php echo $totalDr; ?></b></td>
                            <td style="font-size: 17px"><b>Rs.<?php echo $totalCr; ?></b></td>
                        </tr>
                        <tr>
                            <td colspan="5" style="font-size: 17px"><center><b>Closing Balance</b></center></td>
                            <?php if($totalDr > $totalCr ){ ?>
                            <td style="font-size: 17px"><b>Rs.<?php echo ($totalDr-$totalCr); ?></b></td>
                            <td style="font-size: 17px"><b>Rs.<?php echo "0"; ?></b></td>
                            <?php }elseif($totalDr < $totalCr){ ?>
                            <td style="font-size: 17px"><b>Rs.<?php echo "0"; ?></b></td>
                            <td style="font-size: 17px"><b>Rs.<?php echo ($totalCr-$totalDr); ?></b></td>
                            <?php } ?>
                        </tr>
                        <?php } ?>
                    </table>
                  </div>
                </div>
              </div>
            </div>
        </div>
        <!-- /page content -->
