 <?php
session_start();
require_once('contrlrcn/c_mlsrcontrol.php');
timeout($timeout);
if(!$mysqli->real_escape_string($_SESSION['username']) and !$mysqli->real_escape_string($_SESSION['asrmApplctID']))
{
echo '<meta http-equiv="REFRESH" content="0;url='.$base_url.'/">';
	
die;
}
?><!DOCTYPE html>
<html>
  <head>
  <base href="<?php echo $base_url;?>">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $sitename;?></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Google fonts - Roboto -->
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="css/style.default.css" id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="css/custom.css">
    <!-- Favicon-->
    <link rel="shortcut icon" href="img/favicon.ico">
    <!-- Font Awesome CDN-->
    <!-- you can replace it by local Font Awesome-->

    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->

  </head>
  <body>
    <div class="page home-page">
      <!-- Main Navbar-->
      <header class="header">
        <nav class="navbar">
          <!-- Search Box-->
          <div class="search-box">
            <button class="dismiss"><i class="icon-close"></i></button>
            <form id="searchForm" action="#" role="search">
              <input type="search" placeholder="What are you looking for..." class="form-control">
            </form>
          </div>
          <div class="container-fluid">
            <div class="navbar-holder d-flex align-items-center justify-content-between">
              <!-- Navbar Header-->
              <!--<div class="logogrid"></div>-->
              <div class="navbar-header">
              
              <div class="logogrid"></div>
              

<?php /*?>   <?php if($session_privillage=='investigator'){?>Welcome, <?php echo $session_fullname;?><?php }else{?><div class="logogrid"></div><?php }?><?php */?>          
              </div>
              <!-- Navbar Menu -->
              
    
            </div>
          </div>
        </nav>
      </header>
      <div class="page-content d-flex align-items-stretch">
        <!-- Side Navbar -->
     
        <div class="content-inner">
          <!-- Page Header-->
     
          <!-- Projects Section-->
          <section class="projects no-padding-top">
            <div class="container-fluid">
    <?php
$Authmail=base64_decode($_GET['Authmail']);
$AuthID=base64_decode($_GET['AuthID']);
  
$sql="SELECT * FROM apvr_user where (email='$Authmail' OR username='$Authmail') and asrmApplctID='$AuthID'";
		$Query=$mysqli->query($sql);
		$total=$Query->num_rows;
		$r=$Query->fetch_array();
		$dbasrmApplctID=$r['asrmApplctID'];
		$dbprdffullname=$r['name'];
		$dbasrmEmail=$r['email'];
		$dbasrmUserName=$r['username'];
		$dbasrmApproved=$r['is_active'];
		$dbasrmStatus=$r['asrmStatus'];
		$dbprivillage=$r['privillage'];
		
if($total){

$today=date("Y-m-d H:i:s");

$query="update apvr_user set `rstug_login_date`='$today' where (email='$Authmail' OR username='$Authmail') and asrmApplctID='$AuthID'";
$cd=$mysqli->query($query);
	
}
       $_SESSION['username']=$dbasrmUserName;
		$_SESSION['email']=$dbasrmEmail;
		$_SESSION['asrmApplctID']=$dbasrmApplctID;
		$_SESSION['privillage']=$dbprivillage;
		$_SESSION['mmfullname']=$dbprdffullname;
		
echo $message='<div style=" color:#36F; font-size:16px; font-weight:bold; padding-top:10px;">Welcome to Research Ethics Committees Portal (REC). We are preparing your account...</div>';
echo '<img src="./images/loading_wait.gif">';

echo '<meta http-equiv="refresh" content="0; url='.$base_url.'/main.php?option=dashboard" />';
  ?>
            </div>
          </section>
          <!-- Client Section-->


        </div>
      </div>
    </div>


  </body>
</html>