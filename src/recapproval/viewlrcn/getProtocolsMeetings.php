<?php
session_start();
require_once('../configlrcn/db_mconfig.php');
$country=$_GET['country'];


$asrmApplctID=$_SESSION['asrmApplctID'];

if($country=='protocol'){///protocol
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
$sqlRStatus = "select * FROM ".$prefix."submission where (assignedto='Not Assigned' || assignedto='') and recAffiliated_id='$recAffiliated_idm'  and CompletenessCheck='Approved' group by protocol_id  order by id desc";//and conceptm_status='new' 
$resultStatus = $mysqli->query($sqlRStatus);
$totalProtocols = $resultStatus->num_rows;

while($rStatus=$resultStatus->fetch_array()){
$pprotocol_id=$rStatus['protocol_id'];

$sqlRStatus2 = "select * FROM ".$prefix."protocol where id='$pprotocol_id'";
$resultStatus2 = $mysqli->query($sqlRStatus2);
$rStatus2=$resultStatus2->fetch_array();
?>
<input name="protocol_id[]" type="checkbox" value="<?php echo $rStatus['protocol_id'];?>" class="required"/> <?php echo $rStatus2['code'];?> - <?php echo $rStatus['public_title'];?><br />

<?php }?>
    

</div>





</div>
<?php // end protocol
 }
?>