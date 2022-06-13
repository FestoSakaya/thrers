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
<th style="background:#796AEE; color:#FFFFFF; height:20px;">Rec Name</th>
<th style="background:#796AEE; color:#FFFFFF; height:20px;">Total Submissions</th>
<th style="background:#796AEE; color:#FFFFFF; height:20px;">Slug</th>
<th style="background:#796AEE; color:#FFFFFF; height:20px;">Code</th>
<th style="background:#796AEE; color:#FFFFFF; height:20px;">Contacts</th>
<th style="background:#796AEE; color:#FFFFFF; height:20px;">Email</th>



<th style="background:#796AEE; color:#FFFFFF; height:20px;">Rec Chair</th>
<th style="background:#796AEE; color:#FFFFFF; height:20px;">Rec Chair Email</th>



</tr>

<?php
$rquery = $mysqli->query("select *,DATE_FORMAT(`created`,'%d/%m/%Y') AS created from ".$prefix."list_rec_affiliated  order by id desc");


while ($results = $rquery->fetch_array()){
	$recAffiliated_id=$results['id'];
	
	$sqlSRR_tr = "select * from ".$prefix."submission where recAffiliated_id='$recAffiliated_id'";
$resultSSS_tr = $mysqli->query($sqlSRR_tr);
$total_tr = $resultSSS_tr->num_rows;

echo "<tr>";
////Five
echo "<td>".$results['name']."</td>";
echo "<td>".$total_tr."</td>";
echo "<td>".$results['slug']."</td>";
echo "<td>".$results['code']."</td>";
echo "<td>".$results['contacts']."</td>";
echo "<td>".$results['recemail']."</td>";

echo "<td>".$results['recChairName']."</td>";
echo "<td>".$results['recchairEmail']."</td>";


echo "</tr>";}


echo "</table>";
?>
