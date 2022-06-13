<?php
require_once('../configlrcn/db_mconfig.php');
$country=$_GET['country'];
//if($country=='Approved'){
if($country==1){
?><br /><select name="period" id="period" class="form-control  required">
<option name="12">12 Months</option>
</select>
<?php }

if($country=='Request for VIVA'){
?>
<div class="success" style="width:100%;"><br />
Date and Time for the meeting<br />
<input type="text" value="" name="meeting_set_date" class="form-control  required" style="width:100%;"/><br />

Meeting Place<br />
<input type="text" value="" name="meetingplace" class="form-control  required" style="width:100%;" />
</div>
<?php }




?>






<?php /*?><?php echo $sqlUserff = "select * FROM ".$prefix."user where recAffiliated_id='$recAffiliated_id' and authorisedtosign='Yes' order by name desc";?>
<div class="form-group row" style="margin-left:5px;">


<select name="whosigns" id="whosigns" class="form-control  required" style=" width:500px!important;">
<option value="">Please Select who signs on Approval Letter</option>
<?php
$sqlUserff = "select * FROM ".$prefix."user where recAffiliated_id='$recAffiliated_id' and authorisedtosign='Yes' order by name desc";//and conceptm_status='new' 
$resultUserff = $mysqli->query($sqlUserff);
while($rClUserv=$resultUserff->fetch_array()){
?>
<option value="<?php echo $rClUserv['asrmApplctID'];?>"><?php echo $rClUserv['name'];?></option>
<?php }?>
</select>


</div>
<div class="line"></div><?php 

//}?><?php */?>