<h3>Bed Details</h3>
<div class="clearfix"></div>
<table id="printableBed" border="1" class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>Bed No</th>
            <th>Type</th>
            <th>Rate</th>
            <th>Qty</th>
            <th>Amount</th>
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
            </tr>
        <?php } ?>
    </tbody>

</table>
<!--End Bed Information-->
<!--Start Service Information-->
<h3>Service Details</h3>
<div class="clearfix"></div>
<table id="printableService" border="1" class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>Service Name</th>
            <th>Service Charge</th>
            <th>No of time</th>
            <th>Amount</th>
<!--                          <th>Action</th>-->
        </tr>
    </thead>
    <tbody>
        <?php foreach ($serviceList as $key => $value) { ?>
            <tr>
                <td><?php echo $value['service_name'] ?></td>
                <td><?php echo "Rs. " .$value['service_charge']."/ ".$value['unit'] ; ?></td>
                <td><?php echo $value['qty'] ?></td>
                <td><?php echo "Rs. " . $value['amount'] ?></td>
            </tr>
        <?php } ?>

</table>
<!--End Doctor Information-->
<!--Start Doctor Information-->
<h3>Doctor Details</h3>
<div class="clearfix"></div>
<table id="printableDoc" border="1" class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>Doctor</th>
            <th>Fees</th>
            <th>No of visit</th>
            <th>Amount</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($doctorList as $key => $value) { ?>
            <tr>
                <td><?php echo $value['doctor_name'] ?></td>
                <td><?php echo "Rs." . $value['doctor_charge']."/".$value['unit']; ?></td>
                <td><?php echo $value['qty'] ?></td>
                <td><?php echo "Rs. " . $value['amount'] ?></td>
            </tr>
        <?php } ?>

</table>
<!--End Doctor Information-->
<!--Start Machinary Information-->
<h3>Equipment Details</h3>
<div class="clearfix"></div>
<table id="printableDoc" border="1" class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>Equipement</th>
            <th>Charges</th>
            <th>Qty</th>
            <th>Amount</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($machineList as $key => $value) { ?>
            <tr>
                <td><?php echo $value['machine_name'] ?></td>
                <td><?php echo "Rs. " . $value['charge']."/ ",$value['unit'] ?></td>
                <td><?php echo $value['qty'] ?></td>
                <td><?php echo "Rs. " . $value['amount'] ?></td>
            </tr>
        <?php } ?>
    </tbody>

</table>
<!--End Machinary Information-->