<?php
session_start();
require_once('../configlrcn/db_mconfig.php');
$country=$_GET['country'];


$asrmApplctID=$_SESSION['asrmApplctID'];
///Deviations
if($country=='Deviations'){
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
$sqlRStatus5 = "select * FROM ".$prefix."deviations where (assignedto='Not Assigned' || assignedto='') and recAffiliated_id='$recAffiliated_idm' group by protocol_id order by deviationID desc";//and conceptm_status='new' 
$resultStatus5 = $mysqli->query($sqlRStatus5);
while($rStatus5=$resultStatus5->fetch_array()){
$pprotocol_id5=$rStatus5['protocol_id'];

$sqlRStatus55 = "select * FROM ".$prefix."submission where id='$pprotocol_id5'";
$resultStatus55 = $mysqli->query($sqlRStatus55);
$rStatus55=$resultStatus55->fetch_array();
?>
<input name="protocol_id_deviations[]" type="checkbox" value="<?php echo $rStatus55['protocol_id'];?>" class="required"/> <?php echo $rStatus55['code'];?> - <?php echo $rStatus55['public_title'];?><br />


<?php }?>


</div>
<?php }
?>