

<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>List of Recipt Voucher details</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="<?php echo $base_url; ?>index.php/reciptvoucher/addstep1">Add</a>
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
                        <div class="col-md-12 col-sm-12 col-xs-12" style="text-align: right;font-weight: bold;color: #73879c;margin-bottom: 5px;margin-right: 20px;"><a href="<?php echo $base_url; ?>index.php/reciptvoucher/printall" target="_blank"><img style="" src="<?php echo $base_url; ?>images/print.png" /></a> Print </div>
                        
                        <table id="datatable" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Voucher No.</th>
                                    <th>IPD No.</th>
                                    <th>Patient Name</th>
                                    <th>Age/Sex</th>
                                    <th>Address</th>
                                    <th>Payment Mode</th>
                                    <th>Credit</th>
                                    <th>Narration</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($reciptvoucherList as $key => $value) { ?>
                                    <tr>
                                        <td><?php echo $value['voucher_no'] ?></td>
                                        <td><?php echo $value['party'] ?></td>
                                        <td><?php echo $value['patient_name'] ?></td>
                                        <td><?php echo $value['age'] . "/" . strtoupper($value['sex']); ?></td>
                                        <td>
                                            <?php
                                            echo $value['patient_address']
                                            . " <br/> P.S:" . $value['patient_ps']
                                            . " <br/> City:" . $value['patient_city_district']
                                            . " <br/> Pin:" . $value['patient_pin'];
                                            ?>
                                        </td>
                                        <td><?php echo $value['mode_name'] ?></td>
                                        <td><?php echo "Rs." . $value['credit'] ?></td>
                                        <td><?php echo $value['narration'] ?></td>
                                        <td>
                                            <a href="<?php echo base_url(); ?>index.php/reciptvoucher/edit/<?php echo $value['voucher_no'] ?>" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit </a>
                                            <a href="<?php echo base_url(); ?>index.php/reciptvoucher/deletevoucher/<?php echo $value['voucher_no'] ?>" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Delete </a>
                                            <a href="<?php echo base_url(); ?>index.php/reciptvoucher/printmr/<?php echo $value['voucher_no'] ?>" class="btn btn-primary btn-xs" target="_blank"><span class="glyphicon glyphicon-print" aria-hidden="true"></span> MR Print</a>
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
