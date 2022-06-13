<?php
require_once('../configlrcn/db_mconfig.php');
$country=$_GET['country'];
if($country=='Yes'){
?><br />
<label class="col-sm- form-control-label">Enter Existing Reference Number: <span class="error">*</span></label>

<input type="text" name="independentstudy_refNo" id="vvv" tabindex="4" class="required" style="border:1px solid #ffffff;width:230px;background:#ffffff;padding:5px;" autocomplete="off" required/>

<?php }
if($country=='No'){}
 
?>

