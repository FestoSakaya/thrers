<?php
require_once('../configlrcn/db_mconfig.php');
$country=$_GET['country'];
if($country=='Academic'){
?>
<div class="form-group row">
<div class="col-sm-10">
<select name="protocol_academic_type" class="required" id="dropdown2" tabindex="16" style="width:50%;">
<option value="Diploma">&nbsp;Diploma</option>
<option value="Bachelors">&nbsp;Bachelors</option>
<option value="Masters">&nbsp;Masters</option>
<option value="Fellowship">&nbsp;Fellowship</option>
<option value="PHD">&nbsp;PHD</option>
<option value="Post-Doctoral Fellowship">&nbsp;Post-Doctoral</option>
   </select>
  </div>  
 </div>  
 
 <div class="form-group row">
<div class="col-sm-10">
<p>Attachment Academic/admission letter</p>
<input name="attachacadimcpaper" type="file" id="attachacadimcpaper" class="required" required/>
  </div>  
 </div> 
   
   
   <div class="form-group row">
<div class="col-sm-10">
<p>Attachment anti-plagiarism check </p>
<input name="antiplagiarism" type="file" id="antiplagiarism"/>
  </div>  
 </div> 
    <?php }?>

