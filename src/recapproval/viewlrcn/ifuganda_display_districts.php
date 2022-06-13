<?php
require_once('../configlrcn/db_mconfig.php');
$country=$_GET['country'];
if($country==800){
?>
<div class="form-group row">
<label class="col-sm-2 form-control-label">District:</label>
<div class="col-sm-10">
<select name="district_id" id="district_id" class="form-control  required" onChange="getMunicipality(this.value)">
<option value="120">All Districts</option>
<option value="116">Central Region</option>
<option value="117">Western Region</option>
<option value="118">Eastern Region</option>
<option value="119">Northen Region</option>


<?php
$sqlDistrictv = "select * FROM ".$prefix."list_districts where id!='120' and id!='116' and id!='117' and id!='118' and id!='119' order by name asc";//and conceptm_status='new' 
$resultDistrictcv = $mysqli->query($sqlDistrictv);
while($rDistrictcv=$resultDistrictcv->fetch_array()){
?>
<option value="<?php echo $rDistrictcv['id'];?>"><?php echo $rDistrictcv['name'];?></option>
<?php }?>
</select>
</div>
</div><?php }?>


<?php 
if($country=='895'){}else{?>
<div class="form-group row">
<label class="col-sm-2 form-control-label">Duration:</label>
<div class="col-sm-4">
<input name="Duration" type="text" id="Duration"  class="form-control  required"/>
</div>
 
<label class="col-sm-2 form-control-label">Period:</label>
<div class="col-sm-4">
<select name="Durationperiod" id="Durationperiod" class="form-control  required">
    <option value="">------</option>
    <option value="Days">Days</option>
<option value="Months">Months</option>
<option value="Years">Years</option>
</select>
</div>
</div><?php }?>



<?php 
if($country=='895'){?>
<div class="form-group row">
 
<label class="col-sm-2 form-control-label">Number of samples:</label>
<div class="col-sm-10">
<input type="text" name="Numberofsamples" id="Numberofsamples" class="form-control  required" value="" required>

</div>


</div>
<?php }?>