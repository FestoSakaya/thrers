<?php
require_once('../configlrcn/db_mconfig.php');
$country=$_GET['country'];
if($country=='800'){
?>

<div class="form-group row">
<label class="col-sm-2 form-control-label">Place of Birth  (eg Kampala, Uganda): <span class="error">*</span></label>
<div class="col-sm-10">
<input type="text" name="placeofbirth" id="boxno" tabindex="9" value="<?php echo $TMM['rstug_user_placeofbirth'];?>" class="form-control required"/></div>
</div>
<div class="line"></div>

<div class="form-group row">
<label class="col-sm-2 form-control-label">District: <span class="error">*</span></label>
<div class="col-sm-10">
 <select name="district" id="country_id" tabindex="10" class="form-control required">
                <option value="" selected></option>
<?php
$qRMMDistricts="select * from ".$prefix."districts order by districtm_name asc";
$RDistricts = $mysqli->query($qRMMDistricts);
while($TMDistricts = $RDistricts->fetch_array()){ 
?>
                <option value="<?php echo $TMDistricts['districtm_id'];?>" <?php if($TMDistricts['districtm_id']==$TMM['rstug_mdistrict']){?>selected="selected"<?php }?>><?php echo $TMDistricts['districtm_name'];?></option>
<?php }?>
                </select>
</div>
</div>
<div class="line"></div>

<div class="form-group row">
<label class="col-sm-2 form-control-label">National Id Number (NIN)/ Passport/ Driver's Permit:: <span class="error">*</span></label>
<div class="col-sm-10">
<input type="text" name="rstug_nin_passport" id="passportsss" tabindex="9" value="<?php echo $TMM['rstug_nin_passport'];?>" class="form-control required"/><br />

National Id Number <input name="idtype" type="radio" value="National Id Number"  class="form-control required"/> <br />
Passport <input name="idtype" type="radio" value="Passport"  class="form-control required"/> <br />
Driver's Permit <input name="idtype" type="radio" value="Driver's Permit"  class="form-control required"/> 
</div>
</div>
<div class="line"></div>


<?php }else{?>

<div class="form-group row">
<label class="col-sm-2 form-control-label">Place of Birth  (eg state, province): <span class="error">*</span></label>
<div class="col-sm-10">
<input type="text" name="placeofbirth" id="boxno" tabindex="9" value="<?php echo $TMM['rstug_user_placeofbirth'];?>" class="form-control required"/>
</div>
</div>
<div class="line"></div>


<div class="form-group row">
<label class="col-sm-2 form-control-label">Passport Number: <span class="error">*</span></label>
<div class="col-sm-10">
<label for="names"> <font color="#CC0000">*</font></label> <input type="text" name="rstug_nin_passport" id="passportsss" tabindex="9" value="<?php echo $TMM['rstug_nin_passport'];?>" class="form-control required"/>
</div>
</div>


<?php }?>
