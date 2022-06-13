<?php
session_start();
require_once('../configlrcn/db_mconfig.php');
echo $country=$_GET['country'];


$asrmApplctID=$_SESSION['asrmApplctID'];
if($country=='Amendments'){
?>
  <div class="form-group row" style="height:120px; overflow:scroll;">
 <?php
$sqlSRR = "select * from ".$prefix."user where asrmApplctID='$asrmApplctID'";
$resultSSS = $mysqli->query($sqlSRR);
$sqUserdd = $resultSSS->fetch_array();
$recAffiliated_idm=$sqUserdd['recAffiliated_id'];

///Amendments

 ?>

<!--<label class="col-sm-3 form-control-label">For which Protocol:</label>-->
<div class="col-sm-9">

  <?php
$sqlRStatus3 = "select * FROM ".$prefix."ammendments where (assignedto='Not Assigned' || assignedto='') and recAffiliated_id='$recAffiliated_idm' and (paymentProof='Paid' || paymentProof='Review Pending Payment' || paymentProof='Payment Waiver') group by code  order by id desc";//and conceptm_status='new' 
$resultStatus3 = $mysqli->query($sqlRStatus3);
while($rStatus3=$resultStatus3->fetch_array()){
$pprotocol_id3=$rStatus3['protocol_id'];

$sqlRStatus33 = "select * FROM ".$prefix."submission where id='$pprotocol_id3'";
$resultStatus33 = $mysqli->query($sqlRStatus33);
$rStatus33=$resultStatus33->fetch_array();
?>
<input name="protocol_id_ammendments[]" type="checkbox" value="<?php echo $rStatus3['id'];?>" class="required"/> <?php if($rStatus3['ammendType']=='manual'){?><?php echo $rStatus3['protocol_title'];}?><?php if($rStatus3['ammendType']=='online'){?><?php echo $rStatus33['public_title'];}?><br />
<?php }?>



</div>
<?php }?>