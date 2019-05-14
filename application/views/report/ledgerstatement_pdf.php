
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="<?php echo $base_url; ?>vendors/closingreport/style.css" media="all" />
    <title>Ledger Statement</title>
  </head>
  <body>
    <header class="clearfix">
      <div id="logo">
          <h2>Ledger Statement of <?php echo $postingLedgerName; ?> from <?php echo $from_date; ?> to <?php echo $to_date; ?></h2>
      </div>
    </header>
    <main>
    <table>
      <thead>
        <tr>
          <th style="width:10px">Sl</th>
          <th style="width:150px">Date</th>
          <th style="width:50px">Mode</th>
          <th>Voucher Type</th>
          <th style="width:150px">Narration</th>
          <th >Dr(Rs.)</th>
          <th>Cr(Rs.)</th>
        </tr>
      </thead>
      <tbody>
        <?php
            $sl=1;
            $totalDr=$totalCr=0;
        ?>
        <tr>
            <td style="width:10px"><?php echo $sl++; ?></td>
            <td style="width:150px"></td>
            <td style="width:50px">&nbsp;</td>
            <td>Opening Balance</td>
            <td style="width:150px">&nbsp;</td>
            <td><?php echo $openingBalance_Dr ?></td>
            <td><?php echo $openingBalance_Cr ?></td>
            <?php
              $totalDr=$totalDr+$openingBalance_Dr;
              $totalCr=$totalCr+$openingBalance_Cr;
            ?>
        </tr>
        <?php 
              if(count($voucharList) > 0){
              foreach ($voucharList as $key => $value) { ?>
        <tr>
            <td><?php echo $sl++; ?></td>
            <td style="width:150px"><?php echo $value['recipt_add_date'] ?></td>
            <td style="width:50px"><?php echo $value['mode_name'] ?></td>
            <td><?php echo ucfirst($value['voucher_type']); ?></td>
            <td style="width:150px"><?php echo $value['narration']; ?></td>
            <td><?php echo $value['debit'] ?></td>
            <td><?php echo $value['credit'] ?></td>
            <?php
              $totalDr=$totalDr+$value['debit'];
              $totalCr=$totalCr+$value['credit'];
            ?>
        </tr>
        <?php } ?>
        
        </tbody>
        <tfoot>
          <tr>
            <th></th>
            <th></th>
            <th style="font-size: 17px;"><b>Total</b></th>
            <th></th>
            <th></th>
            <th style="font-size: 17px"><b>Rs.<?php echo $totalDr; ?></b></th>
            <th style="font-size: 17px"><b>Rs.<?php echo $totalCr; ?></b></th>
          </tr>
          <tr>
            <th></th>
            <th></th> 
            <th style="font-size: 17px;"><b>Closing Balance</b></th>
            <th></th>
            <th></th>
            <?php if($totalDr > $totalCr ){ ?>
            <th style="font-size: 17px"><b>Rs.<?php echo ($totalDr-$totalCr); ?></b></th>
            <th style="font-size: 17px"><b>Rs.<?php echo "0"; ?></b></th>
            <?php }elseif($totalDr < $totalCr){ ?>
            <th style="font-size: 17px"><b>Rs.<?php echo "0"; ?></b></th>
            <th style="font-size: 17px"><b>Rs.<?php echo ($totalCr-$totalDr); ?></b></th>
            <?php } ?>
          </tr>
        </tfoot>
        </table>
       
        
       <!-- <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td style="font-size: 17px;">Total></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td style="font-size: 17px"><b>Rs.<?php echo $totalDr; ?></b></td>
            <td style="font-size: 17px"><b>Rs.<?php echo $totalCr; ?></b></td>
        </tr> -->
        <?php } ?>
      
  
    </main>
  </body>
</html>