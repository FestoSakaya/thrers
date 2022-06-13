<?php
require_once('../configlrcn/db_mconfig.php');
$country=$_GET['country'];
if($country=='other'){
?>
<label for="names">Input Title: <font color="#CC0000">*</font></label>

<input type="text" name="titleother" id="titleother" tabindex="9" value="<?php echo $TMM['rstug_title'];?>" class="required"/><br /><br />

<?php }else{?>

<?php }?>
