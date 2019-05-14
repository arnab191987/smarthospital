<div class="printMRWrapper">
    <table style="width: 100%,margin: 0 auto;border : 2px solid #000;border-collapse:collapse" >
     	<tr>
            <td colspan="4" align="center"><h1>Repose Clinic & Research Centre Pvt. Ltd.</h1><h2>20/C Broad Street, Kolkata - 700019,WB <br/>Phone: 033 -2267 1442/2267 3436</h2></td></tr>
        <tr><td colspan="4" align="center" style="border-bottom: 2px solid #000;"><b>Birth Certificate</b></td></tr>
        <tr>
            <td align="center">
                Name : </div>
            </td>
            <td><?php echo $certificateDetails['child_name'] ?></td>
            
             <td align="center">
                Sex : 
            </td>
            <td><?php echo $certificateDetails['sex'] ?></td>
        </tr>
        <tr>
            <td align="center">
            Date and Time: 
            </td>
            <td><?php echo $certificateDetails['born_date']." ".$certificateDetails['born_time']?></td>
            <td align="center">
            Nationality: 
            </td>
            <td><?php echo $certificateDetails['nationality'] ?></td>
        </tr>
        <tr>
            <td align="center">
            Mother`s Name: 
            </td>
            <td><?php echo $certificateDetails['mother_name']?></td>
            <td align="center">
            Father`s Name:
            </td>
            <td> <?php echo $certificateDetails['father_name'] ?></td>
        </tr>
        <tr>
            <td align="center">
            Religion
            </td>
            <td><?php echo $certificateDetails['religion']?></td>
            <td align="center">
            Address:
            </td>
            <td> <?php
                echo $certificateDetails['address']
                . " <br/> P.S:" . $certificateDetails['ps']
                . " <br/> City:" . $certificateDetails['city']
                . " <br/> Pin:" . $certificateDetails['pin'];
                ?>
                
            </td>
        </tr>
         <tr><td align="center"></td><td align="center" colspan="3"><div style="display: block;padding: 10px;margin-top: 10px;">Authorised Signatory</div></td></tr>
    </table>
</div>