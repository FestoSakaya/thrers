<?php
require_once('../configlrcn/db_mconfig.php');
$country=$_GET['country'];
?>

<div class="form-group row">
<label class="col-sm-6 form-control-label">Duration: <span class="error">*</span></label>
<br />
    <select name="minimum_age_period" id="minimum_age_period" class="form-control  required"  onchange="getMaximumAge2(<?php echo $country;?>,this.value)">
    <option value="">------</option>
    <option value="Days" <?php if($rstudy['minimum_age_period']=='Days'){?>selected="selected"<?php }?>>Days</option>
<option value="Months" <?php if($rstudy['minimum_age_period']=='Months'){?>selected="selected"<?php }?>>Months</option>
<option value="Years" <?php if($rstudy['minimum_age_period']=='Years'){?>selected="selected"<?php }?>>Years</option>
</select>
 </div>
<div class="line"></div>
    
    <div  id="MaximumAgediv2">
    
<div class="form-group row">
Maximum Age: <span class="error">*</span>
<input type="text" name="maximum_age" id="maximum_age" class="form-control  required number" value=""  autocomplete="off"></div>
<div class="line"></div>

<div class="form-group row">
Duration: <span class="error">*</span><br />
<select name="maximum_age_period" id="maximum_age_period" class="form-control  required">
    <option value="">------</option>
    <option value="Days" <?php if($rstudy['maximum_age_period']=='Days'){?>selected="selected"<?php }?>>Days</option>
<option value="Months" <?php if($rstudy['maximum_age_period']=='Months'){?>selected="selected"<?php }?>>Months</option>
<option value="Years" <?php if($rstudy['maximum_age_period']=='Years'){?>selected="selected"<?php }?>>Years</option>
</select>
</div>

</div>