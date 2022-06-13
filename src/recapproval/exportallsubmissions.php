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
?>

<table border="1" align="center" style="width:50%;">

<tr>
<th style="background:#796AEE; color:#FFFFFF; height:20px;">Name</th>
<th style="background:#796AEE; color:#FFFFFF; height:20px;">Institution of Affiliation</th>
<th style="background:#796AEE; color:#FFFFFF; height:20px;">Protocol Title</th>
<th style="background:#796AEE; color:#FFFFFF; height:20px;">Submission Date</th>
<th style="background:#796AEE; color:#FFFFFF; height:20px;">REC Submitted to</th>
<th style="background:#796AEE; color:#FFFFFF; height:20px;">Email</th>
<th style="background:#796AEE; color:#FFFFFF; height:20px;">Telephone</th>
<th style="background:#796AEE; color:#FFFFFF; height:20px;">Status</th>


</tr>

<?php
$rquery = $mysqli->query("select *,DATE_FORMAT(`updated`,'%d/%m/%Y') AS datesubmitted from ".$prefix."submission order by id asc ");
while ($results = $rquery->fetch_array()){
	$owner_id=$results['owner_id'];
$main_submission_id=$results['protocol_id'];
$sqlSRR = "select * from ".$prefix."user where asrmApplctID='$owner_id'";
$resultSSS = $mysqli->query($sqlSRR);
$sqUserdd = $resultSSS->fetch_array();

////Get REC
$recAffiliated_id=$results['recAffiliated_id'];
$sqlSRREC = "select * from ".$prefix."list_rec_affiliated where id='$recAffiliated_id'";
$resultSSSREC = $mysqli->query($sqlSRREC);
$sqUserddRREC = $resultSSSREC->fetch_array();

echo "<tr>";
////Five
echo "<td>".$sqUserdd['name']."</td>";
echo "<td>".$sqUserdd['institution']."</td>";
echo "<td>".$results['public_title']."</td>";
echo "<td  align=center>".$results['datesubmitted']."</td>";
echo "<td>".$sqUserddRREC['name']."</td>";
echo "<td align=center>".$sqUserdd['email']."</td>";

echo "<td align=center>".$sqUserdd['phone']."</td>";

echo "<td>".$results['status']."</td>";

echo "</tr>";}


echo "</table>";
?>
