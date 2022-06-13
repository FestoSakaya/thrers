<?php
session_start();
require_once('../configlrcn/db_mconfig.php');
$country=$_GET['country'];

$asrmApplctID=$_SESSION['asrmApplctID'];
 ////AnnualRenewal
 if($country=='AnnualRenewal'){
?>
  <div class="form-group row" style="height:120px; overflow:scroll;">
 <?php
$sqlSRR = "select * from ".$prefix."user where asrmApplctID='$asrmApplctID'";
$resultSSS = $mysqli->query($sqlSRR);
$sqUserdd = $resultSSS->fetch_array();
$totalProtocols = $resultStatus->num_rows;
//if($totalProtocols){
$recAffiliated_idm=$sqUserdd['recAffiliated_id'];

 ?>

<!--<label class="col-sm-3 form-control-label">For which Protocol:</label>-->
<div class="col-sm-9">

  <?php
$sqlRStatus22 = "select * FROM ".$prefix."renewals where assignedto='Not Assigned' and recAffiliated_id='$recAffiliated_idm' and (paymentStatus='Paid' || paymentStatus='Review Pending Payment' || paymentStatus='Payment Waiver') group by code order by id desc";//and conceptm_status='new'
$resultStatus22 = $mysqli->query($sqlRStatus22);
while($rStatus22=$resultStatus22->fetch_array()){
$pprotocol_id2=$rStatus22['protocol_id'];
$public_title=$rStatus22['public_title'];

$sqlRStatusREc = "select * FROM ".$prefix."submission where id='$pprotocol_id2'";
$resultStatusRec = $mysqli->query($sqlRStatusREc);
$rStatusREc=$resultStatusRec->fetch_array();
?>
<input name="protocol_id_annual[]" type="checkbox" value="<?php echo $rStatus22['id'];?>" class="required"/> <?php if($rStatus22['ammendType']=='manual'){?><?php echo $rStatus22['public_title'];}?><?php if($rStatus22['ammendType']=='online'){?><?php echo $rStatus22['public_title'];}?><br />
<?php }?>



</div>
<?php //}

?>


</div><?php }?>