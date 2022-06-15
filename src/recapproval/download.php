<?php 
session_start();
$hostm   = "db";
$dbm = "c1nrims_recapprovals";//eacint_rptsdbnew
$usrm   = "c1nrimsrm";
$pwdm   = "xgfkbGNPWZ!4";
//object oriented style (recommended)
$mysqli = new mysqli($hostm,$usrm,$pwdm,$dbm);
//Output any connection error
if ($mysqli->connect_error) {
    die('Error : ('. $mysqli->connect_errno .') '. $mysqli->connect_error);
}


$prefix="apvr_";
$rew=$mysqli->real_escape_string($_GET['rew']);
$amm=$mysqli->real_escape_string($_GET['amm']);
$amma=$mysqli->real_escape_string($_GET['amma']);
$ammb=$mysqli->real_escape_string($_GET['ammb']);
$ammc=$mysqli->real_escape_string($_GET['ammc']);
$sty=$mysqli->real_escape_string($_GET['sty']);
$sae=$mysqli->real_escape_string($_GET['sae']);
$dev=$mysqli->real_escape_string($_GET['dev']);
function get_content_type($ext) {
   switch(strtolower($ext)) {
      case 'ppt': return "application/vnd.ms-powerpoint"; break;
      case 'doc': return "application/msword";
      case 'txt': return "text/plain";
      case 'xls': return "application/vnd.ms-excel";
      case 'pdf': return "application/pdf";
      case 'zip': return "application/zip";
      case 'jpg': case 'jpeg': return "image/jpg";
      case 'gif': return "image/gif";
      case 'png': return "image/png";
      default: return NULL;
   }
}

extract($_GET);
if(!preg_match("/^[0-9]+$/", $id) && !preg_match("/^[0-9]+$/", $act) && !preg_match("/^[0-9]+$/", $bt) && !preg_match("/^[0-9]+$/", $c) && !preg_match("/^[0-9]+$/", $n) && !preg_match("/^[0-9]+$/", $bkey) && !preg_match("/^[0-9]+$/", $bmw)  && !preg_match("/^[0-9]+$/", $rew) && !preg_match("/^[0-9]+$/", $amm) && !preg_match("/^[0-9]+$/", $sty) && !preg_match("/^[0-9]+$/", $sae) && !preg_match("/^[0-9]+$/", $dev) && !preg_match("/^[0-9]+$/", $amma) && !preg_match("/^[0-9]+$/", $ammb) && !preg_match("/^[0-9]+$/", $ammc)) {
   die('Permission denied');
}
//$db = new database();

if($id)
{
$sql = "SELECT id,filename FROM ".$prefix."submission_upload WHERE id='$id'";
  $result = $mysqli->query($sql);
$row = $result->fetch_array();
$file = $row['filename'];
}

if($act)
{
$sql = "SELECT id,attachacadimcpaper,antiplagiarism FROM ".$prefix."protocol WHERE id='$act'";
  $result = $mysqli->query($sql);
$row = $result->fetch_array();
$file = $row['attachacadimcpaper'];
}
if($act)
{
$sql = "SELECT id,attachacadimcpaper,antiplagiarism FROM ".$prefix."protocol WHERE id='$act'";
  $result = $mysqli->query($sql);
$row = $result->fetch_array();
$file = $row['antiplagiarism'];
}

if($bt)
{
$sql = "SELECT id,protocol_id,DataSharingAgreement FROM ".$prefix."collaborating_institutions WHERE id='$bt'";
  $result = $mysqli->query($sql);
$row = $result->fetch_array();
$file = $row['DataSharingAgreement'];
}

if($c)
{
$sql = "SELECT id,GCPtraining FROM ".$prefix."team WHERE id='$c'";
  $result = $mysqli->query($sql);
$row = $result->fetch_array();
$file = $row['GCPtraining'];
}

if($n)
{
$sql = "SELECT id,paymentProof FROM ".$prefix."submission WHERE id='$n'";
  $result = $mysqli->query($sql);
$row = $result->fetch_array();
$file = $row['paymentProof'];
}

if($bkey)
{
$sql = "SELECT id,description FROM ".$prefix."submission_task WHERE id='$bkey'";
  $result = $mysqli->query($sql);
$row = $result->fetch_array();
$file = $row['description'];
}


if($bmw)
{
$sql = "SELECT id,fileAttachment FROM ".$prefix."final_reports_attachments WHERE id='$bmw'";
  $result = $mysqli->query($sql);
$row = $result->fetch_array();
$file = $row['fileAttachment'];
}

if($rew)
{
$sql = "SELECT id,attachment_file FROM ".$prefix."renewals_attachments WHERE id='$rew'";
  $result = $mysqli->query($sql);
$row = $result->fetch_array();
$file = $row['attachment_file'];
}

if($amm)
{
$sql = "SELECT id,fileAttachment FROM ".$prefix."ammendments_documents WHERE id='$amm'";
  $result = $mysqli->query($sql);
$row = $result->fetch_array();
$file = $row['fileAttachment'];
}

if($amma)
{
$sql = "SELECT id,Attachnewtool FROM ".$prefix."ammendments WHERE id='$amma'";
  $result = $mysqli->query($sql);
$row = $result->fetch_array();
$file = $row['Attachnewtool'];
}

if($ammb)
{
$sql = "SELECT id,Attachnewconsentform FROM ".$prefix."ammendments WHERE id='$ammb'";
  $result = $mysqli->query($sql);
$row = $result->fetch_array();
$file = $row['Attachnewconsentform'];
}

if($ammc)
{
$sql = "SELECT id,Attachnewprotocol FROM ".$prefix."ammendments WHERE id='$ammc'";
  $result = $mysqli->query($sql);
$row = $result->fetch_array();
$file = $row['Attachnewprotocol'];
}

if($sty)
{
$sql = "SELECT id,fileAttachment FROM ".$prefix."notifications_attachments WHERE id='$sty'";
  $result = $mysqli->query($sql);
$row = $result->fetch_array();
$file = $row['fileAttachment'];
}


if(!strlen($file) || !file_exists('/var/www/clients/client1/web1/tmp/uploads/'.$file)) {
     //logaction("Download Failed for: $file but failed");
     die('File Not Found!');
	   
}
$content_type = get_content_type(array_pop(explode('.', $file)));


header("Content-Type: $content_type");
header("Content-Disposition: attachment; filename=\"".basename('/var/www/clients/client1/web1/tmp/uploads/'.$file)."\";");
header("Content-Transfer-Encoding: binary");
header("Content-Length: ".filesize('/var/www/clients/client1/web1/tmp/uploads/'.$file));

if(!readfile('/var/www/clients/client1/web1/tmp/uploads/'.$file)) {
  die("Error reading File.");
  logaction("Download Failed for: $file but failed");
}

logaction("Downloaded Report: $file ");
exit();

?>