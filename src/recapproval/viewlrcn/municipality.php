<?php
require_once('../configlrcn/db_mconfig.php');
$country=$_GET['country'];
if($country!='114' and $country!='115' and $country!='116' and $country!='117' and $country!='118'){
?>

<div class="form-group row">


<label class="col-sm-2 form-control-label">County/ Municipality:</label>
<div class="col-sm-10">
<select name="Municipality" id="recAffiliated_id" class="form-control  required"  onchange="getSubcounty(<?php echo $country;?>,this.value)">
<option value="">Please Select</option>
<?php
$sqlClinicalcv2 = "select * FROM ".$prefix."municipalities where districtID='$country' order by municipalitityName asc";//and conceptm_status='new' 
$resultClinicalcv2 = $mysqli->query($sqlClinicalcv2);
while($rClinicalcv2=$resultClinicalcv2->fetch_array()){
?>
<option value="<?php echo $rClinicalcv2['municipalitityID'];?>"><?php echo $rClinicalcv2['municipalitityName'];?></option>
<?php }?>
</select>

</div>
</div>
<?php }?>


