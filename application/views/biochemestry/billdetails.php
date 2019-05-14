

<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Bill No. <?php echo $bill_no; ?></h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="<?php echo $base_url; ?>index.php/bill/">List</a>
                                    </li>
                                </ul>
                            </li>
                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="alert alert-success" <?php if ($success_msg != "") { ?> style="display: block;" <?php } else { ?> style="display: none;"<?php } ?>>
                            <button class="close" data-dismiss="alert">×</button>
                            <strong>Success!</strong>  <?php echo $success_msg ?>
                        </div>
                        <div class="alert alert-error" <?php if ($error_msg != "") { ?> style="display: block" <?php } else { ?>style="display: none" <?php } ?>>
                            <button class="close" data-dismiss="alert">×</button>
                            <strong>Error!</strong>  <?php echo $error_msg ?>
                        </div>
                        <div class="col-md-12 col-sm-12 col-xs-12" style="text-align: right;font-weight: bold;color: #73879c;margin-bottom: 5px;margin-right: 20px;"><a href="<?php echo $base_url; ?>index.php/bill/printall/<?php echo $bill_no; ?>" target="_blank"><img style="" src="<?php echo $base_url; ?>images/print.png" /></a> Print </div>
                        <!--Start Bed Information-->
                        <div class="x_title">
                            <h2>Bed Details</h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a href="<?php echo $base_url; ?>index.php/bill/addstep3/<?php echo $bill_no; ?>/edit">Add</a>
                                        </li>
                                    </ul>
                                </li>
                                <li><a class="close-link"><i class="fa fa-close"></i></a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="clearfix"></div>
                        <table id="datatable1" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Bed No</th>
                                    <th>Type</th>
                                    <th>Rate</th>
                                    <th>Qty</th>
                                    <th>Amount</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($bedList as $key => $value) { ?>
                                    <tr>
                                        <td><?php echo $value['bed_no'] ?></td>
                                        <td><?php echo $value['bed_type'] ?></td>
                                        <td><?php echo "Rs. " . $value['rate']."/ ".$value['unit']; ?></td>
                                        <td><?php echo $value['qty'] ?></td>
                                        <td><?php echo "Rs. " . $value['amount'] ?></td>
                                        <td>
                                         <a href="<?php echo base_url(); ?>index.php/bill/editbedinfo/<?php echo $bill_no; ?>/<?php echo $value['id'] ?>" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit </a>
                                         <a href="<?php echo base_url(); ?>index.php/bill/deletebedinfo/<?php echo $bill_no; ?>/<?php echo $value['id'] ?>" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Delete </a>
                                        </td>
                                    </tr>
                                <?php } ?>

                        </table>
                        <!--End Bed Information-->
                        <!--Start Service Information-->
                        <div class="x_title">
                            <h2>Service Details</h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a href="<?php echo $base_url; ?>index.php/bill/addstep4/<?php echo $bill_no; ?>/edit">Add</a>
                                        </li>
                                    </ul>
                                </li>
                                <li><a class="close-link"><i class="fa fa-close"></i></a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="clearfix"></div>
                        <table id="datatable2" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Service Name</th>
                                    <th>Service Charge</th>
                                    <th>No of time</th>
                                    <th>Amount</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($serviceList as $key => $value) { ?>
                                    <tr>
                                        <td><?php echo $value['service_name'] ?></td>
                                        <td><?php echo "Rs. " .$value['service_charge']."/ ".$value['unit'] ; ?></td>
                                        <td><?php echo $value['qty'] ?></td>
                                        <td><?php echo "Rs. " . $value['amount'] ?></td>
                                        <td>
                                         <a href="<?php echo base_url(); ?>index.php/bill/editservicedinfo/<?php echo $bill_no; ?>/<?php echo $value['id'] ?>" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit </a>
                                         <a href="<?php echo base_url(); ?>index.php/bill/deleteserviceinfo/<?php echo $bill_no; ?>/<?php echo $value['id'] ?>" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Delete </a>
                                        </td>
                                    </tr>
                                <?php } ?>

                        </table>
                        <!--End Doctor Information-->
                        <!--Start Doctor Information-->
                        <div class="x_title">
                            <h2>Doctor Details</h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a href="<?php echo $base_url; ?>index.php/bill/addstep5/<?php echo $bill_no; ?>/edit">Add</a>
                                        </li>
                                    </ul>
                                </li>
                                <li><a class="close-link"><i class="fa fa-close"></i></a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="clearfix"></div>
                        <table id="datatable" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Doctor</th>
                                    <th>Fees</th>
                                    <th>No of visit</th>
                                    <th>Amount</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($doctorList as $key => $value) { ?>
                                    <tr>
                                        <td><?php echo $value['doctor_name'] ?></td>
                                        <td><?php echo "Rs." . $value['doctor_charge']."/".$value['unit']; ?></td>
                                        <td><?php echo $value['qty'] ?></td>
                                        <td><?php echo "Rs. " . $value['amount'] ?></td>
                                        <td>
                                         <a href="<?php echo base_url(); ?>index.php/bill/editdoctorinfo/<?php echo $bill_no; ?>/<?php echo $value['id'] ?>" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit </a>
                                         <a href="<?php echo base_url(); ?>index.php/bill/deletedoctorinfo/<?php echo $bill_no; ?>/<?php echo $value['id'] ?>" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Delete </a>
                                        </td>
                                    </tr>
                                <?php } ?>

                        </table>
                        <!--End Doctor Information-->
                        <!--Start Machinary Information-->
                        <div class="x_title">
                            <h2>Equipment Details</h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a href="<?php echo $base_url; ?>index.php/bill/addstep6/<?php echo $bill_no; ?>/edit">Add</a>
                                        </li>
                                    </ul>
                                </li>
                                <li><a class="close-link"><i class="fa fa-close"></i></a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="clearfix"></div>
                        <table id="datatable3" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Equipement</th>
                                    <th>Charges</th>
                                    <th>Qty</th>
                                    <th>Amount</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($machineList as $key => $value) { ?>
                                    <tr>
                                        <td><?php echo $value['machine_name'] ?></td>
                                        <td><?php echo "Rs. " . $value['charge']."/ ",$value['unit'] ?></td>
                                        <td><?php echo $value['qty'] ?></td>
                                        <td><?php echo "Rs. " . $value['amount'] ?></td>
                                        <td>
                                         <a href="<?php echo base_url(); ?>index.php/bill/editmachinaryinfo/<?php echo $bill_no; ?>/<?php echo $value['id'] ?>" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit </a>
                                         <a href="<?php echo base_url(); ?>index.php/bill/deletemachinaryinfo/<?php echo $bill_no; ?>/<?php echo $value['id'] ?>" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Delete </a>
                                        </td>
                                    </tr>
                                <?php } ?>

                        </table>
                        <!--End Machinary Information-->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /page content -->
