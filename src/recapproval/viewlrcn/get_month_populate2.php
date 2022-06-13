<?php
require_once('../configlrcn/db_mconfig.php');
$country=$_GET['country'];
$currentYears=date("Y");
$previousMonth=date("m");
if($country==$currentYears){
?>
<?php if($previousMonth=='01'){?>
<select name="month" id="dmonth" class="form-control" tabindex="7" style=" width:200px; float:left;">
    <option value="">&nbsp;Month</option>
<option value="01" <?php if($chop2=='01' || $currentMonth=='01'){?> selected="selected"<?php }?>>&nbsp;January</option>
<option value="02" <?php if($chop2=='02' || $currentMonth=='02'){?> selected="selected"<?php }?>>&nbsp;February</option>
   <option value="03" <?php if($chop2=='03' || $currentMonth=='03'){?> selected="selected"<?php }?>>&nbsp;March</option>
<option value="04" <?php if($chop2=='04' || $currentMonth=='04'){?> selected="selected"<?php }?>>&nbsp;April</option>
<option value="05" <?php if($chop2=='05' || $currentMonth=='05'){?> selected="selected"<?php }?>>&nbsp;May</option>
   <option value="06" <?php if($chop2=='06' || $currentMonth=='06'){?> selected="selected"<?php }?>>&nbsp;June</option>
   <option value="07" <?php if($chop2=='07' || $currentMonth=='07'){?> selected="selected"<?php }?>>&nbsp;July</option>
   <option value="08" <?php if($chop2=='08' || $currentMonth=='08'){?> selected="selected"<?php }?>>&nbsp;August</option>
   <option value="09" <?php if($chop2=='09' || $currentMonth=='09'){?> selected="selected"<?php }?>>&nbsp;September</option>
   <option value="10" <?php if($chop2=='10' || $currentMonth=='10'){?> selected="selected"<?php }?>>&nbsp;October</option>
   <option value="11" <?php if($chop2=='11' || $currentMonth=='11'){?> selected="selected"<?php }?>>&nbsp;November</option>
   <option value="12" <?php if($chop2=='12' || $currentMonth=='12'){?> selected="selected"<?php }?>>&nbsp;December</option>
  </select><?php }?>
  
  <?php if($previousMonth=='02'){?>
<select name="month" id="dmonth" class="form-control" tabindex="7" style=" width:200px; float:left;">
    <option value="">&nbsp;Month</option>
<option value="02" <?php if($chop2=='02' || $currentMonth=='02'){?> selected="selected"<?php }?>>&nbsp;February</option>
   <option value="03" <?php if($chop2=='03' || $currentMonth=='03'){?> selected="selected"<?php }?>>&nbsp;March</option>
<option value="04" <?php if($chop2=='04' || $currentMonth=='04'){?> selected="selected"<?php }?>>&nbsp;April</option>
<option value="05" <?php if($chop2=='05' || $currentMonth=='05'){?> selected="selected"<?php }?>>&nbsp;May</option>
   <option value="06" <?php if($chop2=='06' || $currentMonth=='06'){?> selected="selected"<?php }?>>&nbsp;June</option>
   <option value="07" <?php if($chop2=='07' || $currentMonth=='07'){?> selected="selected"<?php }?>>&nbsp;July</option>
   <option value="08" <?php if($chop2=='08' || $currentMonth=='08'){?> selected="selected"<?php }?>>&nbsp;August</option>
   <option value="09" <?php if($chop2=='09' || $currentMonth=='09'){?> selected="selected"<?php }?>>&nbsp;September</option>
   <option value="10" <?php if($chop2=='10' || $currentMonth=='10'){?> selected="selected"<?php }?>>&nbsp;October</option>
   <option value="11" <?php if($chop2=='11' || $currentMonth=='11'){?> selected="selected"<?php }?>>&nbsp;November</option>
   <option value="12" <?php if($chop2=='12' || $currentMonth=='12'){?> selected="selected"<?php }?>>&nbsp;December</option>
  </select><?php }?>
  
  <?php if($previousMonth=='03'){?>
<select name="month" id="dmonth" class="form-control" tabindex="7" style=" width:200px; float:left;">
    <option value="">&nbsp;Month</option>
 <option value="03" <?php if($chop2=='03' || $currentMonth=='03'){?> selected="selected"<?php }?>>&nbsp;March</option>
<option value="04" <?php if($chop2=='04' || $currentMonth=='04'){?> selected="selected"<?php }?>>&nbsp;April</option>
<option value="05" <?php if($chop2=='05' || $currentMonth=='05'){?> selected="selected"<?php }?>>&nbsp;May</option>
   <option value="06" <?php if($chop2=='06' || $currentMonth=='06'){?> selected="selected"<?php }?>>&nbsp;June</option>
   <option value="07" <?php if($chop2=='07' || $currentMonth=='07'){?> selected="selected"<?php }?>>&nbsp;July</option>
   <option value="08" <?php if($chop2=='08' || $currentMonth=='08'){?> selected="selected"<?php }?>>&nbsp;August</option>
   <option value="09" <?php if($chop2=='09' || $currentMonth=='09'){?> selected="selected"<?php }?>>&nbsp;September</option>
   <option value="10" <?php if($chop2=='10' || $currentMonth=='10'){?> selected="selected"<?php }?>>&nbsp;October</option>
   <option value="11" <?php if($chop2=='11' || $currentMonth=='11'){?> selected="selected"<?php }?>>&nbsp;November</option>
   <option value="12" <?php if($chop2=='12' || $currentMonth=='12'){?> selected="selected"<?php }?>>&nbsp;December</option>
  </select><?php }?>
  
  
  <?php if($previousMonth=='04'){?>
<select name="month" id="dmonth" class="form-control" tabindex="7" style=" width:200px; float:left;">
    <option value="">&nbsp;Month</option>
<option value="04" <?php if($chop2=='04' || $currentMonth=='04'){?> selected="selected"<?php }?>>&nbsp;April</option>
<option value="05" <?php if($chop2=='05' || $currentMonth=='05'){?> selected="selected"<?php }?>>&nbsp;May</option>
   <option value="06" <?php if($chop2=='06' || $currentMonth=='06'){?> selected="selected"<?php }?>>&nbsp;June</option>
   <option value="07" <?php if($chop2=='07' || $currentMonth=='07'){?> selected="selected"<?php }?>>&nbsp;July</option>
   <option value="08" <?php if($chop2=='08' || $currentMonth=='08'){?> selected="selected"<?php }?>>&nbsp;August</option>
   <option value="09" <?php if($chop2=='09' || $currentMonth=='09'){?> selected="selected"<?php }?>>&nbsp;September</option>
   <option value="10" <?php if($chop2=='10' || $currentMonth=='10'){?> selected="selected"<?php }?>>&nbsp;October</option>
   <option value="11" <?php if($chop2=='11' || $currentMonth=='11'){?> selected="selected"<?php }?>>&nbsp;November</option>
   <option value="12" <?php if($chop2=='12' || $currentMonth=='12'){?> selected="selected"<?php }?>>&nbsp;December</option>
  </select><?php }?>
  
   <?php if($previousMonth=='05'){?>
<select name="month" id="dmonth" class="form-control" tabindex="7" style=" width:200px; float:left;">
    <option value="">&nbsp;Month</option>
<option value="05" <?php if($chop2=='05' || $currentMonth=='05'){?> selected="selected"<?php }?>>&nbsp;May</option>
   <option value="06" <?php if($chop2=='06' || $currentMonth=='06'){?> selected="selected"<?php }?>>&nbsp;June</option>
   <option value="07" <?php if($chop2=='07' || $currentMonth=='07'){?> selected="selected"<?php }?>>&nbsp;July</option>
   <option value="08" <?php if($chop2=='08' || $currentMonth=='08'){?> selected="selected"<?php }?>>&nbsp;August</option>
   <option value="09" <?php if($chop2=='09' || $currentMonth=='09'){?> selected="selected"<?php }?>>&nbsp;September</option>
   <option value="10" <?php if($chop2=='10' || $currentMonth=='10'){?> selected="selected"<?php }?>>&nbsp;October</option>
   <option value="11" <?php if($chop2=='11' || $currentMonth=='11'){?> selected="selected"<?php }?>>&nbsp;November</option>
   <option value="12" <?php if($chop2=='12' || $currentMonth=='12'){?> selected="selected"<?php }?>>&nbsp;December</option>
  </select><?php }?>
  
  <?php if($previousMonth=='06'){?>
<select name="month" id="dmonth" class="form-control" tabindex="7" style=" width:200px; float:left;">
    <option value="">&nbsp;Month</option>
   <option value="06" <?php if($chop2=='06' || $currentMonth=='06'){?> selected="selected"<?php }?>>&nbsp;June</option>
   <option value="07" <?php if($chop2=='07' || $currentMonth=='07'){?> selected="selected"<?php }?>>&nbsp;July</option>
   <option value="08" <?php if($chop2=='08' || $currentMonth=='08'){?> selected="selected"<?php }?>>&nbsp;August</option>
   <option value="09" <?php if($chop2=='09' || $currentMonth=='09'){?> selected="selected"<?php }?>>&nbsp;September</option>
   <option value="10" <?php if($chop2=='10' || $currentMonth=='10'){?> selected="selected"<?php }?>>&nbsp;October</option>
   <option value="11" <?php if($chop2=='11' || $currentMonth=='11'){?> selected="selected"<?php }?>>&nbsp;November</option>
   <option value="12" <?php if($chop2=='12' || $currentMonth=='12'){?> selected="selected"<?php }?>>&nbsp;December</option>
  </select><?php }?>
  
  <?php if($previousMonth=='07'){?>
<select name="month" id="dmonth" class="form-control" tabindex="7" style=" width:200px; float:left;">
    <option value="">&nbsp;Month</option>
   <option value="07" <?php if($chop2=='07' || $currentMonth=='07'){?> selected="selected"<?php }?>>&nbsp;July</option>
   <option value="08" <?php if($chop2=='08' || $currentMonth=='08'){?> selected="selected"<?php }?>>&nbsp;August</option>
   <option value="09" <?php if($chop2=='09' || $currentMonth=='09'){?> selected="selected"<?php }?>>&nbsp;September</option>
   <option value="10" <?php if($chop2=='10' || $currentMonth=='10'){?> selected="selected"<?php }?>>&nbsp;October</option>
   <option value="11" <?php if($chop2=='11' || $currentMonth=='11'){?> selected="selected"<?php }?>>&nbsp;November</option>
   <option value="12" <?php if($chop2=='12' || $currentMonth=='12'){?> selected="selected"<?php }?>>&nbsp;December</option>

  </select><?php }?>
  
    <?php if($previousMonth=='08'){?>
<select name="month" id="dmonth" class="form-control" tabindex="7" style=" width:200px; float:left;">
    <option value="">&nbsp;Month</option>
   <option value="08" <?php if($chop2=='08' || $currentMonth=='08'){?> selected="selected"<?php }?>>&nbsp;August</option>
   <option value="09" <?php if($chop2=='09' || $currentMonth=='09'){?> selected="selected"<?php }?>>&nbsp;September</option>
   <option value="10" <?php if($chop2=='10' || $currentMonth=='10'){?> selected="selected"<?php }?>>&nbsp;October</option>
   <option value="11" <?php if($chop2=='11' || $currentMonth=='11'){?> selected="selected"<?php }?>>&nbsp;November</option>
   <option value="12" <?php if($chop2=='12' || $currentMonth=='12'){?> selected="selected"<?php }?>>&nbsp;December</option>
  </select><?php }?>
  
   <?php if($previousMonth=='09'){?>
<select name="month" id="dmonth" class="form-control" tabindex="7" style=" width:200px; float:left;">
    <option value="">&nbsp;Month</option>
   <option value="09" <?php if($chop2=='09' || $currentMonth=='09'){?> selected="selected"<?php }?>>&nbsp;September</option>
   <option value="10" <?php if($chop2=='10' || $currentMonth=='10'){?> selected="selected"<?php }?>>&nbsp;October</option>
   <option value="11" <?php if($chop2=='11' || $currentMonth=='11'){?> selected="selected"<?php }?>>&nbsp;November</option>
   <option value="12" <?php if($chop2=='12' || $currentMonth=='12'){?> selected="selected"<?php }?>>&nbsp;December</option>

  </select><?php }?>
  
  <?php if($previousMonth=='10'){?>
<select name="month" id="dmonth" class="form-control" tabindex="7" style=" width:200px; float:left;">
    <option value="">&nbsp;Month</option>
   <option value="10" <?php if($chop2=='10' || $currentMonth=='10'){?> selected="selected"<?php }?>>&nbsp;October</option>
   <option value="11" <?php if($chop2=='11' || $currentMonth=='11'){?> selected="selected"<?php }?>>&nbsp;November</option>
   <option value="12" <?php if($chop2=='12' || $currentMonth=='12'){?> selected="selected"<?php }?>>&nbsp;December</option>
  </select><?php }?>
  
  <?php if($previousMonth=='11'){?>
<select name="month" id="dmonth" class="form-control" tabindex="7" style=" width:200px; float:left;">
    <option value="">&nbsp;Month</option>
<option value="11" <?php if($chop2=='11' || $currentMonth=='11'){?> selected="selected"<?php }?>>&nbsp;November</option>
   <option value="12" <?php if($chop2=='12' || $currentMonth=='12'){?> selected="selected"<?php }?>>&nbsp;December</option>

  </select><?php }?>
  
  <?php if($previousMonth=='12'){?>
<select name="month" id="dmonth" class="form-control" tabindex="7" style=" width:200px; float:left;">
    <option value="">&nbsp;Month</option>
<option value="12" <?php if($chop2=='12' || $currentMonth=='12'){?> selected="selected"<?php }?>>&nbsp;December</option>
  </select><?php }?>
<?php }

if($country!=$currentYears){
?>
<select name="month" id="dmonth" class="form-control" tabindex="6" style=" width:150px; float:left;">
    <option value="">Month</option>
   <option value="01">&nbsp;January</option>
   <option value="02">&nbsp;February</option>
   <option value="03">&nbsp;March</option>
   <option value="04">&nbsp;April</option>
   <option value="05">&nbsp;May</option>
   <option value="06">&nbsp;June</option>
   <option value="07">&nbsp;July</option>
   <option value="08">&nbsp;August</option>
   <option value="09">&nbsp;September</option>
   <option value="10">&nbsp;October</option>
   <option value="11">&nbsp;November</option>
   <option value="12">&nbsp;December</option>
  </select>
<?php }
?>

