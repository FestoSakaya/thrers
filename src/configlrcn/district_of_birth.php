<?php
require_once('../configlrcn/db_mconfig.php');
$country=$_GET['country'];
if($country=='800'){
?>
<?php /*?><label for="names">Place of Birth  (eg Kampala, Uganda): <font color="#CC0000">*</font></label> <input type="text" name="placeofbirth" id="boxno" tabindex="9" value="<?php echo $TMM['rstug_user_placeofbirth'];?>" class="required"/><br /><br /><?php */?>

<label for="email">Place of Birth  (eg Kampala) <font color="#CC0000">*</font></label> 
 <select name="district" id="country_id" tabindex="10" class="required">
                <option value="" selected></option>
<?php
$qRMMDistricts="select * from ".$prefix."districts order by districtm_name asc";
$RDistricts = $mysqli->query($qRMMDistricts);
while($TMDistricts = $RDistricts->fetch_array()){ 
?>
                <option value="<?php echo $TMDistricts['districtm_id'];?>" <?php if($TMDistricts['districtm_id']==$TMM['rstug_mdistrict']){?>selected="selected"<?php }?>><?php echo $TMDistricts['districtm_name'];?></option>
<?php }?>
                </select><br /><br />
                
<label for="names">National Id Number (NIN)/ Passport/ Driver's Permit: <font color="#CC0000">*</font></label> <input type="text" name="rstug_nin_passport" id="passportsss" tabindex="9" value="<?php echo $TMM['rstug_nin_passport'];?>" class="required"/><br />

<input name="idtype" type="radio" value="National Id Number"  class="required" id="idtype"/> National Id Number
<input name="idtype" type="radio" value="Passport"  class="required" id="idtype"/> Passport
<input name="idtype" type="radio" value="Driver's Permit"  class="required" id="idtype"/> Driver's Permit

<?php }else{?>
<label for="names">Place of Birth  (eg state, province): <font color="#CC0000">*</font></label> <input type="text" name="placeofbirth" id="boxno" tabindex="9" value="<?php echo $TMM['rstug_user_placeofbirth'];?>" class="required"/><br /><br />

<label for="names">Passport Number: <font color="#CC0000">*</font></label> <input type="text" name="rstug_nin_passport" id="passportsss" tabindex="9" value="<?php echo $TMM['rstug_nin_passport'];?>" class="required"/><br /><br />
<?php }?>
