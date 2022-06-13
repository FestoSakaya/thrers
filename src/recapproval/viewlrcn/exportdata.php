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
<th>Name</th>
<th>Protocol Title</th>
<th>Email</th>
<th>Telephone</th>
<th>Status</th>


</tr>

<?php
$rquery = $mysqli->query("select * from ".$prefix."submission order by id asc limit 0,1000");
while ($results = $rquery->fetch_array()){
	$owner_id=$results['owner_id'];
$main_submission_id=$results['protocol_id'];
$sqlSRR = "select * from ".$prefix."user where asrmApplctID='$owner_id'";
$resultSSS = $mysqli->query($sqlSRR);
$sqUserdd = $resultSSS->fetch_array();

echo "<tr>";
////Five
echo "<td>".$sqUserdd['name']."</td>";
echo "<td>".$results['public_title']."</td>";
echo "<td>".$sqUserdd['email']."</td>";

echo "<td>".$sqUserdd['phone']."</td>";

echo "<td>".$sqUserdd['status']."</td>";

echo "</tr>";}


echo "</table>";
?>
