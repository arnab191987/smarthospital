

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>List of patient details(OPD)</h2>
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
                    <div class="alert alert-success" <?php if($success_msg!=""){ ?> style="display: block;" <?php }else{ ?> style="display: none;"<?php } ?>>
                        <button class="close" data-dismiss="alert">×</button>
                        <strong>Success!</strong>  <?php echo $success_msg ?>
                    </div>
                    <div class="alert alert-error" <?php if($error_msg!=""){ ?> style="display: block" <?php }else{ ?>style="display: none" <?php } ?>>
                        <button class="close" data-dismiss="alert">×</button>
                        <strong>Error!</strong>  <?php echo $error_msg ?>
                    </div>
                    <table id="datatable" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>OPD</th>
                          <th>Name</th>
                          <th>Age</th>
                          <th>Gender</th>
                          <th>phone</th>
                          <th>Doctor</th>
                          <th>Address</th>
                          <th>OPD Date</th>
                          <th>Bill</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($admissionList as $key => $value) { ?>
                        <tr>
                            <td><?php echo $value['opd_no'] ?></td>
                            <td><?php echo $value['patient_name'] ?></td>
                            <td><?php echo $value['age'] ?></td>
                            <td><?php echo $value['sex'] ?></td>
                            <td><?php echo $value['patient_phone'] ?></td>
                            <td><?php echo $value['doctor_name'] ?></td>
                            <td><?php echo $value['patient_address'] ?></td>
                            <td><?php echo $value['patient_opd_date'] ?></td>
                            <td>
                            <?php if($value['is_bill_generated']==0){ ?>
                            <a href="<?php echo base_url(); ?>index.php/opdpaitent/bill/<?php echo $value['opd_id'] ?>" class="btn btn-info btn-xs"> Bill </a>
                            <?php }else{ ?>
                            <a href="<?php echo base_url(); ?>index.php/opdpaitent/billPrint/<?php echo $value['opd_id'] ?>" class="btn btn-info btn-xs" style="" target="_blank" > <i class="fa fa-print"></i>&nbsp;Print </a>
                            <?php } ?>
                            </td>
                            <td>
                             <a href="<?php echo base_url(); ?>index.php/opdpaitent/edit/<?php echo $value['opd_id'] ?>" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit </a>
                             <a href="<?php echo base_url(); ?>index.php/opdpaitent/deleteopd/<?php echo $value['opd_id'] ?>" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Delete </a>
                            </td>
                        </tr>
                        <?php } ?>
                       
                    </table>
                  </div>
                </div>
              </div>
			</div>
        </div>
        <!-- /page content -->
