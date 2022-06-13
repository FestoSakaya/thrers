<ul id="countrytabs" class="shadetabs">
<li><a href="#" rel="#default" class="selected">Allow PI to Re-submi Protocol</a></li>

</ul>

<div id="countrydivcontainer" style="border:0px solid gray; width:100%; margin-bottom: 1em; padding: 10px">
<?php
$sqlstudym="SELECT * FROM ".$prefix."submission where id='$id' order by id desc limit 0,1";
$Querystudym = $mysqli->query($sqlstudym);
$rstudym = $Querystudym->fetch_array();
$owner_id=$rstudym['owner_id'];
$public_title=$rstudym['public_title'];
$ProtoclRefNo=$rstudym['code'];
$protocol_idwe=$rstudym['protocol_id'];
$recAffiliated_idREC=$rstudym['recAffiliated_id'];

/////Get Email for REC Admin list_rec_affiliated

if($category=='ResubmitAllowedProtocol' and $owner_id and $recAffiliated_idREC){

				 
$sqlprotocolResubmit = "select * from ".$prefix."submission_stages where protocol_id='$id'";
$resultprotocolResubmit = $mysqli->query($sqlprotocolResubmit);
$sqprotocolResubmit = $resultprotocolResubmit->fetch_array();

$totalStudyApproval = $resultprotocolResubmit->num_rows;
if($totalStudyApproval){
	$stage_id=$sqprotocolResubmit['id'];			 
//Update
$sqlprotocolResubmit_update = "update ".$prefix."submission_stages set status='new' where id='$stage_id' and protocol_id='$id'";
$mysqli->query($sqlprotocolResubmit_update);

echo $message='<p class="success">Action has been completed successfully. Thank You.</p>';

	echo '<img src="images/loading_wait.gif">';
echo '<div class="spacer"></div>';
echo '<meta http-equiv="REFRESH" content="0;url='.$base_url.'/main.php?option=dashboard">';

}
}
?>
</div>