<?php
session_start();
require_once('../configlrcn/db_mconfig.php');
$country=$_GET['country'];


$asrmApplctID=$_SESSION['asrmApplctID'];
///SAEs
if($country=='SAEs'){
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
$sqlRStatus4 = "select * FROM ".$prefix."saes where (assignedto='Not Assigned' || assignedto='') and recAffiliated_id='$recAffiliated_idm' group by protocol_id order by id desc";//and conceptm_status='new' 
$resultStatus4 = $mysqli->query($sqlRStatus4);
while($rStatus4=$resultStatus4->fetch_array()){
$pprotocol_id4=$rStatus4['protocol_id'];

$sqlRStatus44 = "select * FROM ".$prefix."submission where id='$pprotocol_id4'";
$resultStatus44 = $mysqli->query($sqlRStatus44);
$rStatus44=$resultStatus44->fetch_array();
?>
<input name="protocol_id_saes[]" type="checkbox" value="<?php echo $rStatus44['protocol_id'];?>" class="required"/> <?php echo $rStatus44['code'];?> - <?php echo $rStatus44['public_title'];?><br />
<?php }?>




</div>
<?php }?>