<?php
require_once('../configlrcn/db_mconfig.php');
$country=$_GET['country'];
if($country=='Yes'){
?>
<table width="80%" border="0" id="POITableis">
        <tr>
            <td width="2%" style=" display:none;">&nbsp;</td>
            <td width="23%"><strong>Name of Institution<span class="error">*</span></strong>
            </td>
            <td width="25%"><strong>Institutional Code</strong></td>
            <td width="1%"><strong>Data Sharing Agreement <span class="error">*</span></strong></td>


            <td width="1%">&nbsp;</td>
            <td width="14%">&nbsp;</td>
        </tr>
        <tr>
            <td style=" display:none;">1</td>
            <td>
<input type="text" name="institution[]" id="vvv" tabindex="4" class="requiremd" minlength="8" style="border:1px solid #ffffff;width:230px;background:#ffffff;padding:5px;" autocomplete="off"/>
            </td>
            <td><input type="text" name="institutioncode[]" id="customss2" tabindex="5" class="requiredm" style="border:1px solid #ffffff;width:230px;background:#ffffff;padding:5px;" autocomplete="off"/></td>
            <td> <input type="file" name="DataSharingAgreement[]" id="DataSharingAgreement" class="required"></td>

           
            <td><input type="button" id="delPOIbutton" value="Delete" onClick="deleteRow(this)" style="display:none; font-size:12px;"/></td>
            <td><input type="button" id="addmorePOIbutton" value="Add Rows" onClick="insRowInst()" style="font-size:12px;"/></td>
        </tr>
       
    </table>




<?php }
if($country=='No'){}

?>

