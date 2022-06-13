<?php
session_start();
require_once('configlrcn/db_mconfig.php'); 
require_once('configlrcn/slmain_mlquery.php'); 
$user=$_SESSION['mmfullname'];
$usersipaddress=$_SERVER['REMOTE_ADDR'];
//set logut time


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

echo '<meta http-equiv="refresh" content="0;url='.$base_url.'"> ';
