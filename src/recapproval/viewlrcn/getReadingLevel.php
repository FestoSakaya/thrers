<?php
require_once('../configlrcn/db_mconfig.php');
$country=$_GET['country'];
if($country=='Other'){
?>
<label for="names">Specify <font color="#CC0000">*</font></label>

<input type="text" name="getReadingLevel" id="getReadingLevel" tabindex="9" value="" style="width:400px;"/><br /><br />

<?php }?>

