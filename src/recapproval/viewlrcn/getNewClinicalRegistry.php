<?php
require_once('../configlrcn/db_mconfig.php');
$country=$_GET['country'];
if($country=='Other'){
?>

<input type="text" name="NewClinicalRegistry" id="NewClinicalRegistry" tabindex="9" value="" class="form-control  required" style="margin-left:180px; width:480px;"/>

<?php }?>

