<ul id="countrytabs" class="shadetabs">
<li><a href="#" rel="#default" class="selected">Reverse Final Decision Made</a></li>

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

if($category=='ReverseFinalDecision' and $owner_id and $recAffiliated_idREC){
	
$sql_rec = "select * from ".$prefix."list_rec_affiliated where id='$recAffiliated_idREC'";
$result_rec = $mysqli->query($sql_rec);
$sqrec = $result_rec->fetch_array();
$sqrec['name'];
$recemail=$sqrec['recemail'];
$recchairEmail=$sqrec['recchairEmail'];
$recChairName=$sqrec['recChairName'];

$sqlSRR = "select * from ".$prefix."user where asrmApplctID='$owner_id'";
$resultSSS = $mysqli->query($sqlSRR);
$sqUserdd = $resultSSS->fetch_array();
$Piemail=$sqUserdd['email'];
$PiName=$sqUserdd['name'];
$phone=$sqUserdd['phone'];
$institution=$sqUserdd['institution'];

$update="update ".$prefix."submission set is_sent='1',status='completeness check',CompletenessCheck='Approved' where protocol_id='$protocol_idwe' and owner_id='$owner_id'";
$mysqli->query($update);

echo $message='<p class="success">Thank you, Decision for this protocol has been reversed.</p>';





$message='<p class="success">Thank you, action has been sent.</p>';
	echo '<img src="images/loading_wait.gif">';
echo '<div class="spacer"></div>';
echo '<meta http-equiv="refresh" content="1; url='.$base_url.'/main.php?option=dashboard" />';
}
?>
</div>