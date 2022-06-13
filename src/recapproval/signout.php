<?php
session_start();
require_once('contrlrcn/c_mlsrcontrol.php');
$user=$_SESSION['mmfullname'];
$usersipaddress=$_SERVER['REMOTE_ADDR'];
//set logut time

//$sqlA = "update ".$prefix."user set logout=now() where asrmApplctID=".$_SESSION['asrmApplctID'];
//$mysqli->query($sqlA);
unset($_SESSION['asrmApplctID']);
unset($_SESSION['email']);
unset($_SESSION['user_status']);
unset($_SESSION['username']);
unset($_SESSION['mmfullname']);
unset($_SESSION['privillage']);

//Delete the cookies*******************
setcookie("asrmApplctID", '', time()-60*60*24*60, "/");
setcookie("email", '', time()-60*60*24*60, "/");
setcookie("user_status", '', time()-60*60*24*60, "/");
setcookie("username", '', time()-60*60*24*60, "/");
setcookie("mmfullname", '', time()-60*60*24*60, "/");
setcookie("privillage", '', time()-60*60*24*60, "/");
/******************* After Logout set this to any redirect page you want*************/

//header("Location:".$base_url);
///Now give option

echo '<meta http-equiv="refresh" content="0;url='.$logoutlink.'"> ';
