<?php
session_start();
require_once('../configlrcn/db_mconfig.php');
$country=$_GET['country'];


$asrmApplctID=$_SESSION['asrmApplctID'];
///Notifications
if($country=='Notifications'){
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
$sqlRStatus6 = "select * FROM ".$prefix."notifications where (assignedto='Not Assigned' || assignedto='') and recAffiliated_id='$recAffiliated_idm' group by protocol_id order by id desc";//and conceptm_status='new' 
$resultStatus6 = $mysqli->query($sqlRStatus6);
while($rStatus6=$resultStatus6->fetch_array()){
$pprotocol_id6=$rStatus6['protocol_id'];

$sqlRStatus66 = "select * FROM ".$prefix."submission where id='$pprotocol_id6'";
$resultStatus66 = $mysqli->query($sqlRStatus66);
$rStatus66=$resultStatus66->fetch_array();
?>
<input name="protocol_id_notifications[]" type="checkbox" value="<?php echo $rStatus66['protocol_id'];?>" class="required"/> <?php echo $rStatus66['code'];?> - <?php echo $rStatus66['public_title'];?><br />
<?php }?>



</div>
<?php }
?>