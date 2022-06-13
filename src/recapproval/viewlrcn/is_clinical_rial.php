<?php
require_once('../configlrcn/db_mconfig.php');
$country=$_GET['country'];
//if($country==1){
?><?php /*?><input name="clinical_trial_type" type="hidden" value="Clinical Trial" class="form-control required"/>
<label class="form-control-label"><strong>Pan African Clinical Trials Registry (PACTR)  registration number <span class="error">*</span></strong></label><br />
<input name="PACTR_number" type="text" value="" class="form-control required" autocomplete="off"/><?php */?>

<?php //}

if($country==0){
?>

<select name="clinical_trial_type" id="dropdown" class="form-control required">
   <option value="" selected="selected">&nbsp;Select Category</option>
<?php
$qRCat="select * from apvr_categories where publish='Yes' order by rstug_categoryName asc";
$RCat = $mysqli->query($qRCat);
while($TCat = $RCat->fetch_array()){
?>
                <option value="<?php echo $TCat['rstug_categoryID'];?>" <?php if($TCat['rstug_categoryID']==$rowProject['rstug_categoryID']){?>selected="selected"<?php }?>>&nbsp;<?php echo $TCat['rstug_categoryName'];?></option>
<?php }?>
                </select>

<?php }?>