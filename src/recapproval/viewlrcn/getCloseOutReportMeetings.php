<?php
session_start();
require_once('../configlrcn/db_mconfig.php');
$country=$_GET['country'];


$asrmApplctID=$_SESSION['asrmApplctID'];///CloseOutReport
if($country=='CloseOutReport'){
?>
  <div class="form-group row" style="height:120px; overflow:scroll;">
 <?php
$sqlSRR = "select * from ".$prefix."user where asrmApplctID='$asrmApplctID'";
$resultSSS = $mysqli->query($sqlSRR);
$sqUserdd = $resultSSS->fetch_array();
$recAffiliated_idm=$sqUserdd['recAffiliated_id'];


 ?>

<!--<label class="col-sm-3 form-control-label">For which Protocol:</label>-->
<div class="col-sm-9">

  <?php
$sqlRStatus7 = "select * FROM ".$prefix."final_reports where (assignedto='Not Assigned' || assignedto='') and recAffiliated_id='$recAffiliated_idm' group by protocol_id order by id desc";//and conceptm_status='new' 
$resultStatus7 = $mysqli->query($sqlRStatus7);
while($rStatus7=$resultStatus7->fetch_array()){
$pprotocol_id7=$rStatus7['protocol_id'];

$sqlRStatus77 = "select * FROM ".$prefix."submission where id='$pprotocol_id7'";
$resultStatus77 = $mysqli->query($sqlRStatus77);
$rStatus77=$resultStatus77->fetch_array();
?>
<input name="protocol_id_CloseOutReport[]" type="checkbox" value="<?php echo $rStatus77['protocol_id'];?>" class="required"/> <?php echo $rStatus77['code'];?> - <?php echo $rStatus77['public_title'];?><br />
<?php }?>



</div>
<?php }
?>