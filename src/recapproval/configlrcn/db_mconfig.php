<?php
error_reporting(1);
$hostm   = "localhost";
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
$keywords="REC Approval, National Institute for Medical Research - NIMR";
$metatags="REC Approval, National Institute for Medical Research - NIMR";
//////////////////////////////Time Zone////////////////////
date_default_timezone_set('Africa/Dar_es_Salaam');
$today=date("Y-m-d");
$halfday=date("m-d");
$year=date("Y");
$time=date("H:i:s");
$usersipaddress=$_SERVER['REMOTE_ADDR'];
$sesdate=date("Y/m/d/");
//G-24 hour without a leading zero
//H-24 hour with a leading zero
$localtime=date("G:i:s");
$dateSubmitted=date("Y-m-d G:i:s");
$Hour=date("G:i");
$todayfull=date("l jS \of F Y h:i:s A");
////////////mysql///////////////

////////////////////Get Base URL Link/////////////////////

if ($_SERVER['HTTP_HOST'] == "localhost") {
    $base_url = 'http://localhost/work/tanzania/recapproval/';
	$logoutlink='http://localhost/work/tanzania/';//NOTE: Dont include recapproval/ here
} 
if ($_SERVER['HTTP_HOST'] == "www.example.com") {
    $base_url = 'https://www.example.com/recapproval/';
	$logoutlink='http://example.com/tanzania/';//NOTE: Dont include recapproval/ here
} 
if ($_SERVER['HTTP_HOST'] == "example.com") {
    $base_url = 'https://www.example.com/recapproval/';
	$logoutlink='http://example.com/tanzania/';//NOTE: Dont include recapproval/ here
}

if ($_SERVER['HTTP_HOST'] == "example.com") {
    $base_url = 'https://www.example.com/recapproval/';
	$logoutlink='http://example.com/tanzania/';//NOTE: Dont include recapproval/ here
}
/////////////////end//////////////////////////////////
$usmtpportNo="587"; // SMTP Port
$usmtpHost="smtp.gmail.com";

/*//Office 365
$usmtpportNo = "587"; // SMTP Port
$usmtpHost = "smtp.office365.com";*/

?>



