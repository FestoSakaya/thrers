<?php
$country=$sqUserdd_meeting['meetingFor'];
$asrmApplctID=$_SESSION['asrmApplctID'];
?>
  <div class="form-group row" style="height:120px; overflow:scroll;">
 <?php
$sqlSRR = "select * from ".$prefix."user where asrmApplctID='$asrmApplctID'";
$resultSSS = $mysqli->query($sqlSRR);
$sqUserdd = $resultSSS->fetch_array();
$recAffiliated_idm=$sqUserdd['recAffiliated_id'];

if($country=='protocol'){///protocol
?> 

<label class="col-sm-3 form-control-label">For which Protocol:</label>
<div class="col-sm-9">

  <?php
$sqlRStatus = "select * FROM ".$prefix."submission where (assignedto='Not Assigned' || assignedto='Assigned') and recAffiliated_id='$recAffiliated_idm'  and CompletenessCheck='Approved' and status!='Approved' group by protocol_id  order by id desc";//and conceptm_status='new' 
$resultStatus = $mysqli->query($sqlRStatus);
while($rStatus=$resultStatus->fetch_array()){
$pprotocol_id=$rStatus['protocol_id'];

$sqlRStatus2 = "select * FROM ".$prefix."protocol where id='$pprotocol_id'";
$resultStatus2 = $mysqli->query($sqlRStatus2);
$rStatus2=$resultStatus2->fetch_array();

/////////////meeting//////////////////////////////////
$sqlmeeting = "select * FROM ".$prefix."meeting where protocol_id='$pprotocol_id' and meetingStatus='pending'";
$resultmeeting = $mysqli->query($sqlmeeting);
$rStatusmeeting=$resultmeeting->fetch_array();

?>
<input name="protocol_id[]" type="checkbox" value="<?php echo $rStatus['protocol_id'];?>" class="required" <?php if($rStatus['protocol_id']==$rStatusmeeting['protocol_id']){?>checked="checked"<?php }?>/> <?php echo $rStatus2['code'];?> - <?php echo $rStatus['public_title'];?><br />

<?php }?>
    

</div>


<?php // end protocol
 }
 ////AnnualRenewal
 if($country=='AnnualRenewal'){
 ?>

<label class="col-sm-3 form-control-label">For which Protocol:</label>
<div class="col-sm-9">

  <?php
$sqlRStatus22 = "select * FROM ".$prefix."renewals where assignedto='Not Assigned' and recAffiliated_id='$recAffiliated_idm' and paymentStatus='Paid'  group by protocol_id order by id desc";//and conceptm_status='new'
$resultStatus22 = $mysqli->query($sqlRStatus22);
while($rStatus22=$resultStatus22->fetch_array()){
$pprotocol_id2=$rStatus22['protocol_id'];

$sqlRStatusREc = "select * FROM ".$prefix."submission where id='$pprotocol_id2'";
$resultStatusRec = $mysqli->query($sqlRStatusREc);
$rStatusREc=$resultStatusRec->fetch_array();
?>
<input name="protocol_id[]" type="checkbox" value="<?php echo $rStatus22['protocol_id'];?>" class="required"/> <?php echo $rStatusREc['code'];?> - <?php echo $rStatusREc['public_title'];?><br />
<?php }?>



</div>
<?php }

///Amendments
if($country=='Amendments'){
 ?>

<label class="col-sm-3 form-control-label">For which Protocol:</label>
<div class="col-sm-9">

  <?php
$sqlRStatus3 = "select * FROM ".$prefix."ammendments where assignedto='Not Assigned' and recAffiliated_id='$recAffiliated_idm' group by protocol_id  order by id desc";//and conceptm_status='new' 
$resultStatus3 = $mysqli->query($sqlRStatus3);
while($rStatus3=$resultStatus3->fetch_array()){
$pprotocol_id3=$rStatus3['protocol_id'];

$sqlRStatus33 = "select * FROM ".$prefix."submission where id='$pprotocol_id3'";
$resultStatus33 = $mysqli->query($sqlRStatus33);
$rStatus33=$resultStatus33->fetch_array();
?>
<input name="protocol_id[]" type="checkbox" value="<?php echo $rStatus33['protocol_id'];?>" class="required"/> <?php echo $rStatus33['code'];?> - <?php echo $rStatus33['public_title'];?><br />
<?php }?>



</div>
<?php }

///SAEs
if($country=='SAEs'){
 ?>

<label class="col-sm-3 form-control-label">For which Protocol:</label>
<div class="col-sm-9">

  <?php
$sqlRStatus4 = "select * FROM ".$prefix."saes where assignedto='Not Assigned' and recAffiliated_id='$recAffiliated_idm' group by protocol_id order by id desc";//and conceptm_status='new' 
$resultStatus4 = $mysqli->query($sqlRStatus4);
while($rStatus4=$resultStatus4->fetch_array()){
$pprotocol_id4=$rStatus4['protocol_id'];

$sqlRStatus44 = "select * FROM ".$prefix."submission where id='$pprotocol_id4'";
$resultStatus44 = $mysqli->query($sqlRStatus44);
$rStatus44=$resultStatus44->fetch_array();
?>
<input name="protocol_id[]" type="checkbox" value="<?php echo $rStatus44['protocol_id'];?>" class="required"/> <?php echo $rStatus44['code'];?> - <?php echo $rStatus44['public_title'];?><br />
<?php }?>



</div>
<?php }
///Deviations
if($country=='Deviations'){
 ?>

<label class="col-sm-3 form-control-label">For which Protocol:</label>
<div class="col-sm-9">

  <?php
$sqlRStatus5 = "select * FROM ".$prefix."deviations where assignedto='Not Assigned' and recAffiliated_id='$recAffiliated_idm' group by protocol_id order by deviationID desc";//and conceptm_status='new' 
$resultStatus5 = $mysqli->query($sqlRStatus5);
while($rStatus5=$resultStatus5->fetch_array()){
$pprotocol_id5=$rStatus5['protocol_id'];

$sqlRStatus55 = "select * FROM ".$prefix."submission where id='$pprotocol_id5'";
$resultStatus55 = $mysqli->query($sqlRStatus55);
$rStatus55=$resultStatus55->fetch_array();
?>
<input name="protocol_id[]" type="checkbox" value="<?php echo $rStatus55['protocol_id'];?>" class="required"/> <?php echo $rStatus55['code'];?> - <?php echo $rStatus55['public_title'];?><br />
<?php }?>



</div>
<?php }


///Notifications
if($country=='Notifications'){
 ?>

<label class="col-sm-3 form-control-label">For which Protocol:</label>
<div class="col-sm-9">

  <?php
$sqlRStatus6 = "select * FROM ".$prefix."notifications where assignedto='Not Assigned' and recAffiliated_id='$recAffiliated_idm' group by protocol_id order by id desc";//and conceptm_status='new' 
$resultStatus6 = $mysqli->query($sqlRStatus6);
while($rStatus6=$resultStatus6->fetch_array()){
$pprotocol_id6=$rStatus6['protocol_id'];

$sqlRStatus66 = "select * FROM ".$prefix."submission where id='$pprotocol_id6'";
$resultStatus66 = $mysqli->query($sqlRStatus66);
$rStatus66=$resultStatus66->fetch_array();
?>
<input name="protocol_id[]" type="checkbox" value="<?php echo $rStatus66['protocol_id'];?>" class="required"/> <?php echo $rStatus66['code'];?> - <?php echo $rStatus66['public_title'];?><br />
<?php }?>



</div>
<?php }
///CloseOutReport
if($country=='CloseOutReport'){
 ?>

<label class="col-sm-3 form-control-label">For which Protocol:</label>
<div class="col-sm-9">

  <?php
$sqlRStatus7 = "select * FROM ".$prefix."final_reports where assignedto='Not Assigned' and recAffiliated_id='$recAffiliated_idm' group by protocol_id order by id desc";//and conceptm_status='new' 
$resultStatus7 = $mysqli->query($sqlRStatus7);
while($rStatus7=$resultStatus7->fetch_array()){
$pprotocol_id7=$rStatus7['protocol_id'];

$sqlRStatus77 = "select * FROM ".$prefix."submission where id='$pprotocol_id7'";
$resultStatus77 = $mysqli->query($sqlRStatus77);
$rStatus77=$resultStatus77->fetch_array();
?>
<input name="protocol_id[]" type="checkbox" value="<?php echo $rStatus77['protocol_id'];?>" class="required"/> <?php echo $rStatus77['code'];?> - <?php echo $rStatus77['public_title'];?><br />
<?php }?>



</div>
<?php }
?>


</div>