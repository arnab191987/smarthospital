

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Patient Register(OPD)</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="<?php echo $base_url; ?>index.php/opdpaitent/add">Add</a>
                          </li>
                        </ul>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                      <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="<?php echo $base_url; ?>index.php/opdpaitent/opdregister" method="post">
		      
                        <div class="alert alert-success" <?php if($success_msg!=""){ ?> style="display: block;" <?php }else{ ?> style="display: none;"<?php } ?>>
                            <button class="close" data-dismiss="alert">×</button>
                              <?php echo $success_msg ?>
                        </div>
                        <div class="col-md-12 col-sm-12 col-xs-12" style="text-align: right;font-weight: bold;color: #73879c;margin-bottom: 5px;margin-right: 20px;"><a href="<?php echo $base_url; ?>index.php/opdpaitent/opdregisterprint/<?php echo $from_date; ?>/<?php echo $to_date; ?>/<?php echo $doctorId; ?>" target="_blank"><img style="" src="<?php echo $base_url; ?>images/print.png" /></a> Print </div>
                          <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Doctor <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <select class="form-control" name="opd[doctor]" required="required">
                              <option value="0">Select ALL </option>
                              <?php foreach ($doctorList as $key => $value) { ?>
                                      <option value="<?php echo $value['doctor_id'] ?>"><?php echo $value['doctor_name'] ?></option>
                              <?php } ?>
                            </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">From Date <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="birthday" name="opd[from_date]" class="date-picker form-control col-md-7 col-xs-12" required="required" type="text">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">To Date <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="birthday_to" name="opd[to_date]" class="date-picker form-control col-md-7 col-xs-12" required="required" type="text">
                        </div>
                      </div>
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <button type="submit" class="btn btn-success">Search Patient</button>
                        </div>
                      </div>

                    </form>
                  
                    
                    <table id="datatable" class="table table-striped table-bordered  billReg">
                      <thead>
                        <tr>
                          <th>Sl</th>
                          <th>OPD No</th>
                          <th>Doctor</th>
                          <th>Patient</th>
                          <th>Address</th>
                          <th>Age/Sex</th>
                          <th>Phone</th>
                          <th>OPD Date</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                            $sl=1;
                            $total=0;
                        ?>
                        <?php foreach ($opdList as $key => $value) { ?>
                        <tr>
                            <td><?php echo $sl++; ?></td>
                            <td><?php echo $value['opd_no'] ?></td>
                            <td><?php echo $value['doctor_name'] ?></td>
                            <td><?php echo $value['patient_name'] ?></td>
                            <td>
                              <?php 
                                $address="";
                                $address=$value['patient_address'];
                                $address.=" ,".$value['patient_city_district'];
                                $address.=" <br/>P.S : ".$value['patient_ps'];
                                $address.=" <br/>Pin : ".$value['patient_pin'];
                                echo $address;
                              ?>
                            </td>
                            <td><?php echo $value['age']."/".$value['sex'] ?></td>
                            <td><?php echo $value['patient_phone'] ?></td>
                            <td><?php echo $value['patient_opd_date'] ?></td>
                        </tr>
                        <?php } ?>
                       
                    </table>
                  </div>
                </div>
              </div>
            </div>
        </div>
        <!-- /page content -->
