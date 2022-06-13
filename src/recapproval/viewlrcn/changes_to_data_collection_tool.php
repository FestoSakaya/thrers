<?php
require_once('../configlrcn/db_mconfig.php');
$country=$_GET['country'];
//if($country==1){
?><?php /*?><input name="clinical_trial_type" type="hidden" value="Clinical Trial" class="form-control required"/>
<label class="form-control-label"><strong>Pan African Clinical Trials Registry (PACTR)  registration number <span class="error">*</span></strong></label><br />
<input name="PACTR_number" type="text" value="" class="form-control required" autocomplete="off"/><?php */?>

<?php //}

if($country=='Yes'){
?><div style="margin-left:15px;">Attach new tool<br />
<input name="Attachnewtool" type="file" id="Attachnewtool" class="required" required/>
</div>

<?php }?>