<?php
require_once('../configlrcn/db_mconfig.php');
$country=$_GET['country'];
if($country=='1'){
?>

<div class="col-sm-10"><label class="col-sm-355 form-control-label" style="padding-left:1px;">Language <span class="error">*</span>:</label>
<input type="text" name="Language" id="Language" class="form-control  required" value="English" required readonly="readonly" style="margin-left:255px; width:500px;">

</div>


<?php }

if($country!='1' and $country!='other' and $country!='otherattachment'){
?>

<div class="col-sm-810"><label class=" form-control-label" style="padding-left:10px;">Language <span class="error">*</span>:</label>
<input type="text" name="Language" id="Language" class="form-control  required" value="" required  style="margin-left:255px; width:500px;">

</div>

<?php }

if($country=='other'){
?>

<div class="col-sm-10ss">
<label class="form-control-label">Document Name <span class="error">*</span>:</label>
<input type="text" name="othername" id="othername" class="form-control  required" value="" required style="margin-left:170px; width:400px;">

</div>


<div class="col-sm-10ss" style="margin-bottom:20px;">
<label class="form-control-label" style="padding-left:15px;">Language <span class="error">*</span>:</label>
<input type="text" name="Language" id="Language" class="form-control  required" value="" required  style="margin-left:170px; width:400px;">

</div>
<?php }

if($country=='otherattachment'){
?>

<div class="col-sm-10ss" style="margin-left:10px;">
<label class="form-control-label">Document Name <span class="error">*</span>:</label>
<input type="text" name="otherattachment" id="othername" class="form-control  required" value="" required style="width:730px;">

</div>

<?php }

?>

