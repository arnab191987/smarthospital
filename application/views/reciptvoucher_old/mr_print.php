<div class="printMRWrapper">
    <table style="width: 100%,margin: 0 auto;border : 2px solid #000;border-collapse:collapse" >
     	<tr><td colspan="5" align="center"><h1>Repose Clinic & Research Centre Pvt. Ltd.</h1><h2>20/C Broad Street, Kolkata - 700019,WB <br/>Phone: 033 -2267 1442/2267 3436</h2></td></tr>
     	<tr><td colspan="5" align="center" style="border-bottom: 2px solid #000;"><b>Money Recipt</b></td></tr>
     	<tr><td colspan="5" align="center"><h1></h1></td></tr>
        <tr><td align="center"><div style="display: block;margin-top: 10px;">Voucher No : <?php echo $reciptvoucherDetails['voucher_no'] ?></div></td><td></td><td align="center" colspan="3"><div style="display: block;margin-top: 10px;">Date and Time: <?php echo $reciptvoucherDetails['add_date'] ?></div></td></tr>
         <tr><td align="center"><div style="display: block;margin-top: 4px;">Received with thanks  : Rs.<?php echo $reciptvoucherDetails['credit'] ?></div></td><td></td><td></td><td align="center" colspan="2"></td></tr>
         <tr><td align="center"><div style="display: block;margin-top: 4px;">From Mr/Mrs/Miss/MS. : <?php echo $reciptvoucherDetails['depositer_name'] ?> </div></td><td></td><td></td><td align="center" colspan="2"></td></tr>
       	<tr><td align="center"><div style="display: block;margin-top: 4px;">Mode of Payment : <?php echo $reciptvoucherDetails['mode_name'] ?></div> </td><td></td><td></td><td align="center" colspan="2"></td></tr>
         <tr><td align="center"></td><td></td><td align="center" colspan="3"><div style="display: block;padding: 10px;margin-top: 10px;">Authorised Signatory</div></td></tr>
    </table>
</div>