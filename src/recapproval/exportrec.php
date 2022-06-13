<?php
session_start();
require_once('contrlrcn/c_mlsrcontrol.php');
$timestamp=date("Ymdhsi");//xlsx
header('Content-Type: application/octet-stream');
header("Content-Type: application/force-download");
header("Content-Type: application/x-msdownload");
header("Content-Disposition: attachment; filename=".$timestamp.".xls");
header("Pragma: no-cache");
header("Expires: 0");

$datesfrom=$mysqli->real_escape_string($_GET['datesfrom']);
$datesto=$mysqli->real_escape_string($_GET['datesto']);
$status=$mysqli->real_escape_string($_GET['status']);
$category=$mysqli->real_escape_string($_GET['category']);
?>

<table border="1" align="center" style="width:50%;">

<tr>
<th style="background:#796AEE; color:#FFFFFF; height:20px;">S/N</th>
<th style="background:#796AEE; color:#FFFFFF; height:20px;">Title of the study</th>
<th style="background:#796AEE; color:#FFFFFF; height:20px;">Name of principal investigator</th>
<th style="background:#796AEE; color:#FFFFFF; height:20px;">Institution of Affiliation</th>
<th style="background:#796AEE; color:#FFFFFF; height:20px;">Sponsor</th>



<th style="background:#796AEE; color:#FFFFFF; height:20px;">Date of approval</th>
<th style="background:#796AEE; color:#FFFFFF; height:20px;">Academic or non Academic</th>



</tr>

<?php
if($datesto){
$rquery = $mysqli->query("select *,DATE_FORMAT(`updated`,'%d/%m/%Y') AS datesubmitted from ".$prefix."submission where is_sent='1'  and recAffiliated_id='$recAffiliated_id' and (created >= '$datesfrom' AND created <= '$datesto')  and status='Approved' order by id desc");
}

if($status){
$rquery = $mysqli->query("select *,DATE_FORMAT(`updated`,'%d/%m/%Y') AS datesubmitted from ".$prefix."submission where is_sent='1'  and recAffiliated_id='$recAffiliated_id' and (status='$status') and clinical_trial_type='$category' and status='Approved' order by id desc");
}

if($category){
$rquery = $mysqli->query("select *,DATE_FORMAT(`updated`,'%d/%m/%Y') AS datesubmitted from ".$prefix."submission where is_sent='1'  and recAffiliated_id='$recAffiliated_id' and clinical_trial_type='$category' and status='Approved' order by id desc");
}


while ($results = $rquery->fetch_array()){
	$owner_id=$results['owner_id'];
$main_submission_id=$results['id'];
$sqlSRR = "select * from ".$prefix."user where asrmApplctID='$owner_id'";
$resultSSS = $mysqli->query($sqlSRR);
$sqUserdd = $resultSSS->fetch_array();

$sqlSprotocol = "select * from ".$prefix."protocol where id='$main_submission_id'";
$resultprotocol = $mysqli->query($sqlSprotocol);
$sqUprotocol = $resultprotocol->fetch_array();
$sqUprotocol['end_of_project'];


$ProjectApprovalDate=($sqUprotocol['end_of_project']);
$Positionbaby1 = explode("/", $ProjectApprovalDate);
$chops1="$Positionbaby1[0]";
$chops2="$Positionbaby1[1]";
$chops3="$Positionbaby1[2]";
$subtractchops3=($chops3-1);

$finalApprovalDate=($chops1.'/'.$chops2.'/'.$subtractchops3);
//SELECT * FROM `apvr_protocol` WHERE `end_of_project`!='' and `decision_in`='0000-00-00'

////Get REC
$recAffiliated_id=$results['recAffiliated_id'];
$sqlSRREC = "select * from ".$prefix."list_rec_affiliated where id='$recAffiliated_id'";
$resultSSSREC = $mysqli->query($sqlSRREC);
$sqUserddRREC = $resultSSSREC->fetch_array();

echo "<tr>";
////Five
echo "<td>".$results['code']."</td>";
echo "<td>".$results['public_title']."</td>";
echo "<td>".$sqUserdd['name']."</td>";
echo "<td>".$sqUserdd['institution']."</td>";
echo "<td>".$results['primary_sponsor']."</td>";



echo "<td>".$finalApprovalDate."</td>";

echo "<td align=center>".$results['protocol_academic']."</td>";


echo "</tr>";}


echo "</table>";
?>
