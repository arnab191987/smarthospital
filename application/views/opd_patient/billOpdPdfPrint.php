
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>INVOICE <?php echo $admissionData['bill_no']; ?></title>
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
            <div><span>OPD DATE </span> <?php echo $admissionData['patient_opd_date']; ?></div>
            <div><span>Bill</span> <?php echo $admissionData['bill_no']; ?></div>
            <div><span>Bill DATE & Time</span> <?php echo $admissionData['bill_date']; ?></div>
          </div>
      </div>
    </header>
    <main>
      <table class="opdbill">
        <thead>
          <tr>
            <th class="service" style="">PERTICULAR</th>
            <th class="desc">DOCTOR NAME</th>
            <th class="unit">UNIT</th>
            <th class="qty">RATE</th>
            <th class="total">TOTAL</th>
          </tr>
        </thead>
        <tbody>
            <tr>
                <td class="service">OPD</td>
                <th class="desc"><?php echo $admissionData['doctor_name']; ?></th>
                <td class="unit">1</td>
                <td class="qty">Rs.<?php echo $admissionData['doctor_charge']; ?></td>
                <td class="total">Rs.<?php echo number_format((float)$admissionData['doctor_charge'], 2, '.', ''); ?></td>
            </tr>
         
        </tbody>
      </table>
        <table class="opdgrand">
            <tbody>
        
        <tr>
            <td colspan="4" class="grand total">Grand Total</td>
            <td class="grand total">RS.<?php echo number_format((float)$admissionData['total_amount'], 2, '.', ''); ?></td>
        </tr>
        <tr>
            <td colspan="4" class="grand total">Sevice charge </td>
            <?php
                $billable_amount=$admissionData['total_amount']+$service_charge;
                $total_amt=$billable_amount;
            ?>
            <td class="grand total">RS.<?php echo number_format((float)$service_charge, 2, '.', ''); ?></td>
        </tr>
        <tr>
            <td colspan="4" class="grand total">Net Payable</td>
            <td class="grand total"><b>RS.<?php echo number_format((float)$billable_amount, 2, '.', ''); ?></b></td>
        </tr>
        
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
         <span style="font-size: 12px;font-weight: bold;"><!-- Some text can be written here --></span><br/>
         <span style="font-size: 10px;"> <!-- Some text can be written here --> </span>
         <div style="display: block;width: 100%;text-align: right;margin-top: 10px;"> For &nbsp;&nbsp;Repose Clinic & Research Centre Pvt. Ltd.<div class="dottedline"></div></div>
        
      </div>
    </main><!-- 
    <footer>
      Repose Clinic & Research Centre Pvt. Ltd. | 20/C Broad Street, Kolkata - 700019 | Phone: 033 -2267 1442/2267 3436
    </footer> -->
  </body>
</html>