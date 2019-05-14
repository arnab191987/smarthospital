<style type="text/css">
.printwrapper{
    padding: 10px; 
    font-size: 10px;
}

.tableprint{
  border: 1px solid #000;
}

td,th{
  border: 1px solid #000;
}

.tableprint th{
  background-color: #000;
  color :#FFF;
}
</style>
<div class="printwrapper">
<table class="tableprint" style="width: 100%">
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