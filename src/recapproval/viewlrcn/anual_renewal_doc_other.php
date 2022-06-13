<?php
require_once('../configlrcn/db_mconfig.php');
$country=$_GET['country'];

if($country=='other'){
?>

<div class="col-sm-10ss">
<table width="100%" border="0">
  <tr>
    <td width="86%" align="right" style="width:250px; text-indent:5px;"><label class="form-control-label">Document Name <span class="error">*</span>:</label></td>
    <td width="64%"><input type="text" name="othername" id="othername" class="form-control  required" value="" required  style="width:500px;"></td>
  </tr>
</table>




</div>

<?php }

if($country=='Payment'){
?>

<div class="col-sm-10ss">

<table width="100%" border="0">
  <tr>
    <td width="86%" align="right"  style="width:250px; text-indent:5px;"><label class="form-control-label">Type of Payment <span class="error">*</span>:</label></td>
    <td width="64%"><select name="type_of_payment" id="type_of_payment" class="form-control  required" required style="width:500px;">
<option value="">Please Select</option>
<option value="Wire Transfer">Wire Transfer</option>
<option value="Cash Deposit">Cash Deposit</option>
<option value="Cheque">Cheque</option>
</select></td>
  </tr>
</table>



</div>

<?php }
?>

