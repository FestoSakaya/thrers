<?php
require_once('../configlrcn/db_mconfig.php');
$country=$_GET['country'];
$stateId=intval($_GET['state']);
?>

<div class="form-group row">


<label class="col-sm-2 form-control-label">Sub County:</label>
<div class="col-sm-10">
<input type="text" name="SubCounty" id="recAffiliated_id" class="form-control  required" value="" required>

<?php /*?><select name="SubCounty" id="recAffiliated_id" class="form-control  required"  onchange="getCity(<?php echo $country;?>,this.value)">
<option value="">Please Select</option>
<?php
$sqlClinicalcv2 = "select * FROM ".$prefix."municipality_subcounties where districtID='$country' and municipalitityID='$stateId' order by subcountyName asc";//and conceptm_status='new' 
$resultClinicalcv2 = $mysqli->query($sqlClinicalcv2);
while($rClinicalcv2=$resultClinicalcv2->fetch_array()){
?>
<option value="<?php echo $rClinicalcv2['subcountyName'];?>"><?php echo $rClinicalcv2['subcountyName'];?></option>
<?php }?>
</select><?php */?>

</div>
</div>

<div class="form-group row">
 
<label class="col-sm-2 form-control-label">Parish:</label>
<div class="col-sm-10">
<input type="text" name="Parish" id="participants" class="form-control  required" value="" required>

</div>
</div>
