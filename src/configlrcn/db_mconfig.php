<?php
error_reporting(1);
$hostm   = "db";
$dbm = "nrims_tanzania";//
$usrm   = "admin";////uccdbadmin
$pwdm   = "N1mx@9653";//lZxDRJm
//object oriented style (recommended)
$mysqli = new mysqli($hostm,$usrm,$pwdm,$dbm);
//Output any connection error
if ($mysqli->connect_error) {
    die('Error : ('. $mysqli->connect_errno .') '. $mysqli->connect_error);
}
  ///////////////////////site details
$sitename="REC Approval";
$sitename2="REC Approval";
$prefix="apvr_";
$siteshortname="REC Approval";
///////////////////key words//////////////////
if ($_SERVER['HTTP_HOST'] == "localhost") {
    $base_url = 'http://localhost/tanzania/';
} 
if ($_SERVER['HTTP_HOST'] == "www.example.com") {
    $base_url = 'https://www.example.com/';
} 
if ($_SERVER['HTTP_HOST'] == "example.com") {
    $base_url = 'https://www.example.com/';
}

if ($_SERVER['HTTP_HOST'] == "example.com") {
    $base_url = 'https://www.example.com/';
}

$usmtpportNo="587"; // 465 SMTP Port
$usmtpHost="smtp.gmail.com";

//Office 365
/*$usmtpportNo = "587"; // SMTP Port
$usmtpHost = "smtp.office365.com";*/
?>



