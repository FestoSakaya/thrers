<?php
session_start(); error_reporting(1);
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
<th style="background:#796AEE; color:#FFFFFF; height:20px;">Institution of affiliation</th>	
<th style="background:#796AEE; color:#FFFFFF; height:20px;">Email</th>
<th style="background:#796AEE; color:#FFFFFF; height:20px;">Telephone</th>
</tr>

<?php
$rquery = $mysqli->query("select *,DATE_FORMAT(`updated`,'%d/%m/%Y') AS datesubmitted from ".$prefix."submission where recAffiliated_id='$recAffiliated_id' group by owner_id order by id desc");
while ($results = $rquery->fetch_array()){//and worked_on='No' 
	$owner_id=$results['owner_id'];
$main_submission_id=$results['id'];
$sqlSRR = "select * from ".$prefix."user where asrmApplctID='$owner_id'";
$resultSSS = $mysqli->query($sqlSRR);
$sqUserdd = $resultSSS->fetch_array();

echo "<tr>";
////Five
echo "<td>".$sqUserdd['name']."</td>";//.'code:'.$main_submission_id
echo "<td>".$sqUserdd['institution']."</td>";
echo "<td>".$sqUserdd['email']."</td>";
echo "<td>".$sqUserdd['phone']."</td>";
echo "</tr>";

}


echo "</table>";
?>
