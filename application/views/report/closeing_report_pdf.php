
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="<?php echo $base_url; ?>vendors/closingreport/style.css" media="all" />
  </head>
  <body>
    <header class="clearfix">
      <div id="logo">
          <h2>Closing Report as on <?php echo $date; ?></h2>
      </div>
    </header>
    <main>
    <div style="margin-left: 10px "><h2><b><u>Income</u></b></h2></div>
        <table style="color: #000;">              
        <thead>
          <tr>
            <th>Sl</th>
            <th>Date</th>
            <th>Vouchar No</th>
            <th>Payment Mode</th>
            <th>Posting Ledger</th>
            <th>Amount (Rs.)</th>
          </tr>
        </thead>
        <tbody>
          <?php
              $sl=1;
              $credittotal=$cash=$card=$cheque=$neft=0;
          ?>
          <?php foreach ($reciptVoucharList as $key => $value) { ?>
          <tr>
              <td style="color: #000"><?php echo $sl; ?></td>
              <td style="color: #000"><?php echo $value['add_date'] ?></td>
              <td style="color: #000"><?php echo $value['voucher_no'] ?></td>
              <td style="color: #000"><?php echo $value['mode_name'] ?></td>
              <td style="color: #000"><?php echo $value['ledger_name'] ?></td>
              <td style="color: #000"><?php echo $value['credit'] ?></td>
          </tr>
          <?php 
              $sl++; 
              if($value['mode']==1){
                $cash=$cash+$value['credit'];
              }
              if($value['mode']==2){
                $card=$card+$value['credit'];
              }
              if($value['mode']==3){
                $cheque=$cheque+$value['credit'];
              }
              if($value['mode']==4){
                $neft=$neft+$value['credit'];
              }
              $credittotal=$credittotal+$value['credit'];
          ?>
          <?php } ?>
         </tbody>
      </table>
      <div style="margin-left: 10px ">
        <div id="showAmount"><h3><span><b>Total cash recived &nbsp;=</b></span><span id="amountShow"><b><?php echo "Rs. ".$cash; ?></b></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style="float: right;"><b>Total(A)</b> &nbsp;</span><span id="amountShow"><b><?php echo "Rs. ".$credittotal; ?></b></span></h3></div>
         
        <div class="showAmount"><h3><span><b>Total card recived &nbsp;=</b></span><span id="amountShow"><b><?php echo "Rs. ".$card; ?></b></span></h3></div>
        
        <div class="showAmount"><h3><span><b>Total cheque recived &nbsp;=</b></span><span id="amountShow"><b><?php echo "Rs. ".$cheque; ?></b></span></h3></div>
        
        <div class="showAmount"><h3><span><b>Total NEFT recived &nbsp;=</b></span><span id="amountShow"><b><?php echo "Rs. ".$neft; ?></b></span></h3></div>
          
          
            <br/>
      </div>
      <div style="margin-left: 10px "><h2><b><u>Expenditure</u></b></h2></div>
       <table  class="table table-striped table-bordered ">
              <thead>
                <tr>
                  <th>Sl</th>
                  <th>Date</th>
                  <th>Vouchar No</th>
                  <th>Payment Mode</th>
                  <th>Posting Ledger</th>
                  <th>Amount (Rs.)</th>
                </tr>
              </thead>
              <tbody>
                <?php
                    $sl=1;
                    $debittotal=$cash=$card=$cheque=$neft=0;
                ?>
                <?php foreach ($paymentVoucharList as $key => $value) { ?>
                <tr>
                    <td><?php echo $sl; ?></td>
                    <td><?php echo $value['add_date'] ?></td>
                    <td><?php echo $value['voucher_no'] ?></td>
                    <td><?php echo $value['mode_name'] ?></td>
                    <td><?php echo $value['ledger_name'] ?></td>
                    <td><?php echo $value['debit'] ?></td>
                </tr>
                <?php 
                    $sl++; 
                    if($value['mode']==1){
                      $cash=$cash+$value['debit'];
                    }
                    if($value['mode']==2){
                      $card=$card+$value['debit'];
                    }
                    if($value['mode']==3){
                      $cheque=$cheque+$value['debit'];
                    }
                    if($value['mode']==4){
                      $neft=$neft+$value['debit'];
                    }
                    $debittotal=$debittotal+$value['debit'];
                ?>
                <?php } ?>     
          </table>
          <div style="margin-left: 10px; ">
           <?php $difference= $credittotal-$debittotal; ?>
            <div id="showAmount"><h3><span><b>Total cash expense &nbsp;=</b></span><span id="amountShow"><b><?php echo "Rs. ".$cash; ?></b></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style="display: block;text-align: right; width: 50%"><b>Total(B)</b> &nbsp;</span><span id="amountShow"><b><?php echo "Rs. ".$debittotal; ?></b></span></h3></div>
          <div class="showAmount"><h3><span><b>Total card expense &nbsp;=</b></span><span id="amountShow"><b><?php echo "Rs. ".$card; ?></b></span></h3></div>
          
          <div class="showAmount"><h3><span><b>Total cheque expense &nbsp;=</b></span><span id="amountShow"><b><?php echo "Rs. ".$cheque; ?></b></span></h3></div>
          
          <div class="showAmount"><h3><span><b>Total NEFT expense &nbsp;=</b></span><span id="amountShow"><b><?php echo "Rs. ".$neft; ?></b></span></h3></div>
          <br/>
          <br/>
          </div>
          <div style="margin-left: 10px "><h2><b><u>Summary</u></b></h2></div>
          <div style="margin-left: 10px; ">
          <div class="calculateReport"><h3><span><b>Total&nbsp;(A-B)&nbsp;=</b> &nbsp;</span><span id="amountShow"><b><?php echo "Rs. ".$difference; ?></b></span></h3></div>
            
            <?php if($cashinhand!=0){ ?>
            <div class="calculateReport"><h3><span><b>Cash Recived &nbsp;=</b></span><span id="amountShow"><b><?php echo "Rs. ".$cashcredit; ?></b></span></h3></div>
          
            <div class="calculateReport"><h3><span><b>Cash Expense &nbsp;=</b></span><span id="amountShow"><b><?php echo "Rs. ".$cashdebit; ?></b></span></h3></div>
            
            <div class="calculateReport"><h3><span><b>Cash in hand&nbsp;Rs. (&nbsp;<?php echo $cashcredit."-".$cashdebit ?>)&nbsp;=</b></span><span id="amountShow"><b><?php echo "Rs. ".$cashinhand; ?></b></span></h3></div>
            <?php } ?>
          </div>
          </div>
      
    </main>
  </body>
</html>