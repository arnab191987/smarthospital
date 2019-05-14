

<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>List of Death Certificate details</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="<?php echo $base_url; ?>index.php/deathcertificate/addstep1">Add</a>
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
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>IPD No.</th>
                                    <th>Name</th>
                                    <th>Age</th>
                                    <th>Sex</th>
                                    <th>Religion</th>
                                    <th>Address</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($birthList as $key => $value) { ?>
                                    <tr>
                                        <td><?php echo $value['death_date'] ?></td>
                                        <td><?php echo $value['death_time'] ?></td>
                                        <td><?php echo $value['ipd_no'] ?></td>
                                        <td><?php echo $value['name'] ?></td>
                                        <td><?php echo strtoupper($value['age']); ?></td>
                                        <td><?php echo strtoupper($value['sex']); ?></td>
                                        <td><?php echo strtoupper($value['religion']); ?></td>
                                        <td>
                                            <?php
                                            echo $value['address']
                                            . " <br/> P.S:" . $value['ps']
                                            . " <br/> City:" . $value['city']
                                            . " <br/> Pin:" . $value['pin'];
                                            ?>
                                        </td>
                                        <td>
                                            <a href="<?php echo base_url(); ?>index.php/deathcertificate/edit/<?php echo $value['id'] ?>" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit </a>
                                            <a href="<?php echo base_url(); ?>index.php/deathcertificate/deletecertificate/<?php echo $value['id'] ?>" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Delete </a>
                                            <a href="<?php echo base_url(); ?>index.php/deathcertificate/printcertificate/<?php echo $value['id'] ?>" class="btn btn-primary btn-xs" target="_blank"><span class="glyphicon glyphicon-print" aria-hidden="true"></span>  Print</a>
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
