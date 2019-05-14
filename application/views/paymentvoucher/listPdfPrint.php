<table id="printable" border="1" class="table table-striped table-bordered">
           <thead>
             <tr>
               <th>Voucher</th>
               <th>IPD No.</th>
               <th>Patient Name</th>
               <th>Age/Sex</th>
               <th>Address</th>
               <th>Bed No</th>
               <th>Payment Mode</th>
               <th>Credit</th>
               <th>Narration</th>
             </tr>
           </thead>
           <tbody>
             <?php foreach ($reciptvoucherList as $key => $value) { ?>
             <tr>
                 <td><?php echo $value['voucher_no'] ?></td>
                 <td><?php echo $value['party'] ?></td>
                 <td><?php echo $value['patient_name'] ?></td>
                 <td><?php echo $value['age']."/".strtoupper($value['sex']); ?></td>
                 <td>
                     <?php echo $value['patient_address']
                         . " <br/> P.S:".$value['patient_ps']
                         . " <br/> City:".$value['patient_city_district']
                         . " <br/> Pin:".$value['patient_pin'];
                     ?>
                 </td>
                 <td><?php echo $value['patient_bed_no'] ?></td>
                 <td><?php echo $value['mode_name'] ?></td>
                 <td><?php echo "Rs.".$value['credit'] ?></td>
                 <td><?php echo $value['narration'] ?></td>
             </tr>
             <?php } ?>

         </table>

