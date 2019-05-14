
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="#" class="site_title"><i class="fa fa-paw"></i> <span style="text-transform: uppercase;">Repose </span></a>
            </div>

            <div class="clearfix"></div>

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
			  <div class="menu_section">
			   <ul class="nav side-menu">
                  <li><a><i class="fa fa-edit"></i> Accounts <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?php echo base_url(); ?>index.php/reciptvoucher/">Recipt Voucher</a></li>
                      <li><a href="<?php echo base_url(); ?>index.php/paymentvoucher/">Payment Voucher</a></li>
                      <li><a href="<?php echo base_url(); ?>index.php/purchaser/">Purchaser</a></li>
                      <li><a href="<?php echo base_url(); ?>index.php/supplier/"> Supplier</a></li>
                      <li><a href="<?php echo base_url(); ?>index.php/ledgermaster/">Ledger Master</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-edit"></i> IPD <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?php echo base_url(); ?>index.php/admission/">Admission</a></li>
                      <li><a href="<?php echo base_url(); ?>index.php/bill/">Bill</a></li>
                      <li><a href="<?php echo base_url(); ?>index.php/admission/bedshift">Bed shift</a></li>
                      <li><a href="<?php echo base_url(); ?>index.php/discharge/">Discharge</a></li>
                      <li><a href="<?php echo base_url(); ?>index.php/patientaccount/">Patient Account</a></li> 
                      <li><a href="<?php echo base_url(); ?>index.php/birthcertificate/">Birth Certificate</a></li> 
                      <li><a href="<?php echo base_url(); ?>index.php/deathcertificate/">Death Certificate</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-edit"></i> OPD <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?php echo base_url(); ?>index.php/opdpaitent/">Patient</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-edit"></i> Pathology <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?php echo base_url(); ?>index.php/biochemistry/">Biochemistry</a></li>
                    </ul>
                  </li>
                  <?php if($this->data['site_admin_type ']==1){ ?>
				          <li><a><i class="fa fa-edit"></i> Report <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?php echo base_url(); ?>index.php/admission/patientregister">Patient Register</a></li>
                      <li><a href="<?php echo base_url(); ?>index.php/opdpaitent/opdregister">OPD Register</a></li>
                      <li><a href="<?php echo base_url(); ?>index.php/bill/billregister">Bill Register</a></li>
                      <li><a href="<?php echo base_url(); ?>index.php/reciptvoucher/mrregister">MR Register</a></li>
                      <li><a href="<?php echo base_url(); ?>index.php/reciptvoucher/closingreport">Closing Report</a></li>
                    </ul>
                  </li>     
                  <li><a><i class="fa fa-bug"></i> Configuration <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?php echo base_url(); ?>index.php/bed/">Bed</a></li>
                      <li><a href="<?php echo base_url(); ?>index.php/mechinary/">Mechinary</a></li>
                      <li><a href="<?php echo base_url(); ?>index.php/doctoropd/">OPD Doctor</a></li>
                      <li><a href="<?php echo base_url(); ?>index.php/service/">Service</a></li>
                      <li><a href="<?php echo base_url(); ?>index.php/doctor/">Doctor</a></li>
                      <li><a href="<?php echo base_url(); ?>index.php/user/">User</a></li>
                      <li><a href="<?php echo base_url(); ?>index.php/financialyear/">Financial Year</a></li>
                      <li><a href="<?php echo base_url(); ?>index.php/opdsevicecharg/">OPD Service Charge</a></li>
                    </ul>
                  </li>  
                  <?php } ?>   
                </ul>
              </div>
            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Logout">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="<?php echo base_url(); ?>images/img.jpg" alt=""><?php echo $site_admin_name; ?>
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
<!--                    <li><a href="javascript:;"> Profile</a></li>
                    <li>
                      <a href="javascript:;">
                        <span class="badge bg-red pull-right">50%</span>
                        <span>Settings</span>
                      </a>
                    </li>
                    <li><a href="javascript:;">Help</a></li>-->
                    <li><a href="<?php echo $base_url; ?>index.php/login/logout"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                  </ul>
                </li>

              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->