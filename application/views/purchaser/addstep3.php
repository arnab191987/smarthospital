

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                      <h2>Add Purchaser details<small>Entry of perticulars</small></b></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="<?php echo $base_url; ?>index.php/paymentvoucher/">List</a>
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
                                              <small>Find Supplier </small>
                                          </span>
                          </a>
                        </li>
                        <li>
                            <a href="#step-2" class="done">
                            <span class="step_no">2</span>
                            <span class="step_descr">
                                              Step 2<br />
                                              <small>Show the supplier details</small>
                                          </span>
                          </a>
                        </li>
                        <li>
                          <a href="#step-3">
                            <span class="step_no">3</span>
                            <span class="step_descr">
                                              Step 3<br />
                                              <small>Entry of perticulars</small>
                                          </span>
                          </a>
                        </li>
                       </ul>
                   </div>
                    <div class="x_content">
                      <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Supplier Name : 
                          </label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                               <?php echo $supplier_name; ?>
                          </div>
                        </div>
                        <br>
                        <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Supplier Ledger : 
                          </label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                               <?php echo $supplier_ledger; ?>
                          </div>
                        </div>
                    </div>

                    <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="<?php echo $base_url; ?>index.php/purchaser/addstep3" method="post">
                      <input type="hidden" name="supplier[supplier_ledger]" value="<?php echo $supplier_ledger; ?>">
                      <input type="hidden" name="supplier[supplier_name]" value="<?php echo $supplier_name; ?>">
                      <!--- Table -->
                      <div class="x_content">
                        <div class="table-responsive">
                        <table class="table jambo_table bulk_action">
                          <thead>
                            <tr class="headings">
                              <th class="column-title">SL </th>
                              <th class="column-title">Bill No </th>
                              <th class="column-title">Perticulars </th>
                              <th class="column-title">Qty </th>
                              <th class="column-title">Price (Rs.) </th>
                              <th class="column-title">Amount (Rs.) </th>
                              <th class="column-title">Action </th>
                            </tr>
                          </thead>
                          <tbody id="CloneContainer">
                            <tr class="even pointer">
                              <td class="counter hidden" style="display: none;">1</td>
                              <td class="counterSl">1</td>
                              <td class=" "><input type="text" name="purchaser[1][bill]" class="bill" value=""></td>
                              <td class=" "><input type="text" name="purchaser[1][perticular]" class="bill" value=""></td>
                              <td class=" "><input type="text" name="purchaser[1][qty]" class="qty" value="0"> </td>
                              <td class=" "><input type="text" name="purchaser[1][price]" class="pricepurchaser" value="0"> </td>
                              <td class=" "><input type="text" name="purchaser[1][amount]" class="amount" value="0" readonly=""></td>
                              <td class=" "><a href="#" class="btn btn-info btn-xs clone" style="background-color: orange; border: orange;"><i class="fa fa-plus"></i> </a><a href="#" class="btn btn-info btn-xs remove" style="background-color: red;border: red;"><i class="fa fa-minus"></i> </a></td>
                            </tr>
                          </tbody>
                          <tfoot>
                             <tr>
                              <td colspan="5" align="right"><div style="font-size: 18px;    padding: 6px;"><strong>Total :</strong></div></td>
                              <td class=" "><input type="text" name="total_amount" class="total_amount" value="" readonly=""></td>
                              <td ></td>
                            </tr>
                          </tfoot>
                          </table>
                          </div>
                        </div>
                      <!-- End of table -->
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
