<?php 
session_start();
$hostm   = "localhost";
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
$id=$mysqli->real_escape_string(base64_decode($_GET['rmd_id']));

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
if(!preg_match("/^[0-9]+$/", $id)) {
   die('Permission denied');
}
//$db = new database();
if($id)
{
$sql = "SELECT id,protocol_id,draftopinion FROM ".$prefix."initial_committee_screening WHERE protocol_id='$id' and draftopinion!='' order by id desc limit 0,1";
  $result = $mysqli->query($sql);
$row = $result->fetch_array();
$file = $row['draftopinion'];
}



if(!strlen($file) || !file_exists('files/uploads/'.$file)) {
     //logaction("Download Failed for: $file but failed");
     die('File Not Found!');
	   
}
$content_type = get_content_type(array_pop(explode('.', $file)));


header("Content-Type: $content_type");
header("Content-Disposition: attachment; filename=\"".basename('files/uploads/'.$file)."\";");
header("Content-Transfer-Encoding: binary");
header("Content-Length: ".filesize('files/uploads/'.$file));

if(!readfile('files/uploads/'.$file)) {
  die("Error reading File.");
  logaction("Download Failed for: $file but failed");
}

logaction("Downloaded Report: $file ");
exit();

?>