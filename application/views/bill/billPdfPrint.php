
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>INVOICE <?php echo $bill['bill_no']; ?></title>
    <link rel="stylesheet" href="<?php echo $base_url; ?>vendors/invoice/style.css" media="all" />
  </head>
  <body>
    <header class="clearfix">
      <div id="logo">
          <!-- <img src="<?php echo $base_url; ?>vendors/invoice/logo.png" width="50"> -->
          <h2>BILL</h2>
      </div>
      <!-- <h1>BILL NO <?php echo $bill['bill_no']; ?></h1> -->
      <div class="container-project-company">
          <div id="company" class="clearfix">
            <div style="font-size: 15px;font-weight: bold; "> Repose Clinic & Research Centre Pvt. Ltd.</div>
            <div>20/C Broad Street<br /> Kolkata- 700019,<br/> West Bengal, India</div>
            <div>033 -2267 1442/2267 3436</div>
            <!-- <div><a href="mailto:company@example.com">company@example.com</a></div> -->
          </div>
          <div id="project">
            <div><span>PATIENT</span> <?php echo $admissionData['patient_name']; ?></div>
            <div><span>ADDRESS</span> <?php echo $admissionData['patient_address'].", PS : ".$admissionData['patient_ps'].", ".$admissionData['patient_city_district'].", Pin-".$admissionData['patient_pin']; ?></div>
            <!-- <div><span>PHONE</span> <?php echo $admissionData['patient_phone']."<br/><span></span> ".$admissionData['patient_phone1']; ?></div> -->
            <div><span>ADMISSION DATE & TIME</span> <?php echo $admissionData['add_date']; ?></div>
            <div><span>Bill</span> <?php echo $bill['bill_no']; ?></div>
            <div><span>Bill DATE & Time</span> <?php echo $bill['add_date']; ?></div>
          </div>
      </div>
    </header>
    <main>
      <?php
      $bed=$service=$doctor=$machine=0;
      $r=1;
      ?>
      <table>
        <thead>
          <tr>
            <th class="service" style="">PARTICULARS</th>
            <th class="desc">DESCRIPTION</th>
            <th>RATE</th>
            <th>UNIT</th>
            <th>TOTAL</th>
          </tr>
        </thead>
        <tbody>
         <?php
            if($r==1){
                $row=$r;
            }
         ?>
         <?php foreach ($bedList as $key => $value) { $bed=1; ?>
            <?php
                /// Class odd/ event print ///
                if($row%2!=0){
                    $class="odd";
                }else{
                    $class="";
                }
                $row++;
            ?>
            <tr class="<?php echo $class; ?>">
                <td class="service">Bed</td>
                <td class="desc"><?php echo $value['bed_no']." , Bed Type : ".$value['bed_type']; ?></td>
                <td class="unit"><?php echo "Rs. " . $value['rate']."/ ".$value['unit']; ?></td>
                <td class="qty"><?php echo $value['qty'] ?></td>
                <td class="total"><?php echo "Rs. " . number_format((float)$value['amount'], 2, '.', ''); ?></td>
            </tr>
        <?php } ?>
        <?php if($bed==1){ ?>
            <?php
                /// Class odd/ event print ///
                if($row%2!=0){
                    $class="odd";
                }else{
                    $class="";
                }
                $row++;
            ?>
        <tr class="<?php echo $class; ?>">
            <td colspan="4" style="font-weight: bold;" >SUBTOTAL</td>
            <td class="total" style="font-weight: bold;" ><?php echo "Rs. " . number_format((float)$bedTotal, 2, '.', ''); ?></td>
        </tr>
        <?php } ?>
        <?php foreach ($serviceList as $key => $value) { $service=1; ?>
            <?php
                /// Class odd/ event print ///
                if($row%2!=0){
                    $class="odd";
                }else{
                    $class="";
                }
                $row++;
            ?>
            <tr class="<?php echo $class; ?>">
                <td class="service">Service</td>
                <td class="desc"><?php echo $value['service_name'] ?></td>
                <td class="unit"><?php echo "Rs. " .$value['service_charge']."/ ".$value['unit'] ; ?></td>
                <td class="qty"><?php echo $value['qty'] ?></td>
                <td class="total"><?php echo "Rs. " . number_format((float)$value['amount'], 2, '.', ''); ?></td>
            </tr>
        <?php } ?>
        <?php if($service==1){ ?>
            <?php
                /// Class odd/ event print ///
                if($row%2!=0){
                    $class="odd";
                }else{
                    $class="";
                }
                $row++;
            ?>
        <tr class="<?php echo $class; ?>">
            <td colspan="4" style="font-weight: bold;" >SUBTOTAL</td>
            <td class="total" style="font-weight: bold;" ><?php echo "Rs. " .  number_format((float)$serviceTotal, 2, '.', ''); ?></td>
        </tr>
        <?php } ?>
        <?php foreach ($doctorList as $key => $value) { $doctor=1; ?>
            <?php
                /// Class odd/ event print ///
                if($row%2!=0){
                    $class="odd";
                }else{
                    $class="";
                }
                $row++;
            ?>
            <tr class="<?php echo $class; ?>">
                <td class="service">Doctor</td>
                <td class="desc"><?php echo $value['doctor_name'] ?></td>
                <td class="unit"><?php echo "Rs." . $value['doctor_charge']."/".$value['unit']; ?></td>
                <td class="qty"><?php echo $value['qty'] ?></td>
                <td class="total"><?php echo "Rs. " . number_format((float)$value['amount'], 2, '.', ''); ?></td>
            </tr>
        <?php } ?>
        <?php if($doctor==1){ ?>
        <?php
            /// Class odd/ event print ///
            if($row%2!=0){
                $class="odd";
            }else{
                $class="";
            }
            $row++;
        ?>
        <tr class="<?php echo $class; ?>">
            <td colspan="4" style="font-weight: bold;" >SUBTOTAL</td>
            <td class="total" style="font-weight: bold;" ><?php echo "Rs. " . number_format((float)$doctorTotal, 2, '.', ''); ?></td>
        </tr>
        <?php } ?>
        <?php foreach ($machineList as $key => $value) { $machine=1; ?>
            <?php
                /// Class odd/ event print ///
                if($row%2!=0){
                    $class="odd";
                }else{
                    $class="";
                }
                $row++;
            ?>
            <tr class="<?php echo $class; ?>">
                <td class="service">Machinary</td>
                <td class="desc"><?php echo $value['machine_name'] ?></td>
                <td class="unit"><?php echo "Rs. " . $value['charge']."/ ",$value['unit'] ?></td>
                <td class="qty"><?php echo $value['qty'] ?></td>
                <td class="total"><?php echo "Rs. " . number_format((float)$value['amount'], 2, '.', ''); ?></td>
            </tr>
        <?php } ?>
        <?php if($machine==1){ ?>
            <?php
                /// Class odd/ event print ///
                if($row%2!=0){
                    $class="odd";
                }else{
                    $class="";
                }
                $row++;
            ?>
            <tr class="<?php echo $class; ?>" >
            <td colspan="4" style="font-weight: bold;" >SUBTOTAL</td>
            <td class="total" style="font-weight: bold;" >RS. <?php echo number_format((float)$machinaryTotal, 2, '.', ''); ?></td>
        </tr>
        <?php } ?>
        </tbody>
      </table>
        <table>
            <tbody>
        <?php if($bill['discount']!=''){ ?>
        <tr>
            <td colspan="4" class="grand total">Grand Total</td>
            <td class="grand total">RS. <?php echo number_format((float)$bill['original_amount'], 2, '.', ''); ?></td>
        </tr>
        <tr>
            <td colspan="4" class="grand total">Sevice charge (+)10%</td>
            <?php
                $service_charge=round(($bill['original_amount']*10)/100);
                $billable_amount=$bill['original_amount']+$service_charge;
            ?>
            <td class="grand total">RS. <?php echo number_format((float)$service_charge, 2, '.', ''); ?></td>
        </tr>
        <tr>
            <td colspan="4" class="grand total">Net amount</td>
            <td class="grand total">RS. <?php echo number_format((float)$billable_amount, 2, '.', ''); ?></td>
        </tr>
        <tr>
            <td colspan="4" class="grand total">Discount(-)<?php echo $bill['discount']."%"; ?></td>
            <?php
                $discountAmount=round(($billable_amount*$bill['discount'])/100);
            ?>
            <td class="grand total">RS. <?php echo number_format((float)$discountAmount, 2, '.', ''); ?></td>
        </tr>
        <tr>
            <td colspan="4" class="grand total">Net Payable</td>
            <?php
                $total_amt= $billable_amount- $discountAmount;
            ?>
            <td class="grand total"><b>RS. <?php echo number_format((float)$total_amt, 2, '.', ''); ?></b></td>
        </tr>
        <?php }else{ ?>
        <tr>
            <td colspan="4" class="grand total">Grand Total</td>
            <td class="grand total">RS. <?php echo number_format((float)$bill['total_amount'], 2, '.', ''); ?></td>
        </tr>
        <tr>
            <td colspan="4" class="grand total">Sevice charge (+)10%</td>
            <?php
                $service_charge=round(($bill['total_amount']*10)/100);
                $billable_amount=$bill['total_amount']+$service_charge;
                $total_amt=$billable_amount;
            ?>
            <td class="grand total">RS. <?php echo number_format((float)$service_charge, 2, '.', ''); ?></td>
        </tr>
        <tr>
            <td colspan="4" class="grand total">Net Payable</td>
            <td class="grand total"><b>RS. <?php echo number_format((float)$billable_amount, 2, '.', ''); ?></b></td>
        </tr>
        <?php } ?>
        </tbody>

      </table>
     <div id="notices">
     <?php
        // Convert digit to words
        $number = $total_amt;
        $no = round($number);
        $point = round($number - $no, 2) * 100;
        $hundred = null;
        $digits_1 = strlen($no);
        $i = 0;
        $str = array();
        $words = array('0' => '', '1' => 'one', '2' => 'two',
        '3' => 'three', '4' => 'four', '5' => 'five', '6' => 'six',
        '7' => 'seven', '8' => 'eight', '9' => 'nine',
        '10' => 'ten', '11' => 'eleven', '12' => 'twelve',
        '13' => 'thirteen', '14' => 'fourteen',
        '15' => 'fifteen', '16' => 'sixteen', '17' => 'seventeen',
        '18' => 'eighteen', '19' =>'nineteen', '20' => 'twenty',
        '30' => 'thirty', '40' => 'forty', '50' => 'fifty',
        '60' => 'sixty', '70' => 'seventy',
        '80' => 'eighty', '90' => 'ninety');
        $digits = array('', 'hundred', 'thousand', 'lakh', 'crore');
        while ($i < $digits_1) {
         $divider = ($i == 2) ? 10 : 100;
         $number = floor($no % $divider);
         $no = floor($no / $divider);
         $i += ($divider == 10) ? 1 : 2;
         if ($number) {
            $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
            $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
            $str [] = ($number < 21) ? $words[$number] .
                " " . $digits[$counter] . $plural . " " . $hundred
                :
                $words[floor($number / 10) * 10]
                . " " . $words[$number % 10] . " "
                . $digits[$counter] . $plural . " " . $hundred;
         } else $str[] = null;
        }
        $str = array_reverse($str);
        $result = implode('', $str);
        $points = ($point) ?
        "." . $words[$point / 10] . " " . 
              $words[$point = $point % 10] : '';
        if($points!==""){
            $points=$points." Paise";
        }
        // End of code for convert digit
     ?>
         <span style="font-size: 14px; text-transform: capitalize;"> Net amount in words&nbsp;&nbsp;:&nbsp;&nbsp;<?php echo $result . "Rupees  " . $points; ?></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span><b>E & O.E.</b></span><br/>
         <span style="font-size: 12px;font-weight: bold;"> N.B&nbsp;&nbsp;:&nbsp;&nbsp;Checkout Time&nbsp;&nbsp;:&nbsp;11:00 AM </span><br/>
         <span style="font-size: 10px;"> Interest will be change if the bill is not paid within 2 days </span>
         <div style="display: block;width: 100%;text-align: right;margin-top: 10px;"> For &nbsp;&nbsp;Repose Clinic & Research Centre Pvt. Ltd.<div class="dottedline"></div></div>
        
      </div>
    </main>
    <footer>
      Repose Clinic & Research Centre Pvt. Ltd. | 20/C Broad Street, Kolkata - 700019 | Phone: 033 -2267 1442/2267 3436
    </footer>
  </body>
</html>