 <?php
session_start();
require_once('contrlrcn/c_mlsrcontrol.php');
timeout($timeout);
if(!$mysqli->real_escape_string($_SESSION['username']) and !$mysqli->real_escape_string($_SESSION['asrmApplctID']))
{
echo '<meta http-equiv="REFRESH" content="0;url=$base_url">';
	
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
    <!--<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,700">-->
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="css/style.default.css" id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="css/custom.css">
    <!-- Favicon-->
    <link rel="shortcut icon" href="img/favicon.ico">
    <!-- Font Awesome CDN-->
    <!-- you can replace it by local Font Awesome-->
    <!--<script src="https://use.fontawesome.com/99347ac47f.js"></script>-->
    <!-- Font Icons CSS-->
    <!--<link rel="stylesheet" href="https://file.myfontastic.com/da58YPMQ7U5HY8Rb6UxkNf/icons.css">-->
    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
 <link rel="stylesheet" type="text/css" href="ajaxtabs/ajaxtabs.css" />
<script type="text/javascript" src="ajaxtabs/ajaxtabs.js"></script>

   <!--Begin Word count-->
<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
	<script type="text/javascript" src="js/jquery.inputlimiter.1.3.1.min.js"></script>
	<script type="text/javascript" src="js/word-count.js"></script>
    <link rel="stylesheet" type="text/css" href="js/jquery.inputlimiter.1.0.css" />
    <!--End Word count-->

<!--<script language="JavaScript" type="text/javascript" src="js/jquery-1.3.2.min.js"></script>-->
<script language="JavaScript" type="text/javascript" src="js/jquery.validate.js"></script>

  <script>
  $(document).ready(function(){
    $.validator.addMethod("username", function(value, element) {
        return this.optional(element) || /^[a-z0-9\_]+$/i.test(value);
    }, "Username must contain only letters, numbers, or underscore.");

    $("#regForm").validate();
  });
  </script>
 <!-- <script type='text/javascript'>
window.onunload = function(){
window.opener.location.reload();}
</script>-->
  <link rel="stylesheet" type="text/css" href="css/tcal.css" />
	<script type="text/javascript" src="js/tcal.js"></script>
    <script type="text/javascript" src="js/ajax.js"></script>
    
   <script type="text/javascript">
        function refreshParent() {
            if (window.opener != null && !window.opener.closed) {
                window.opener.location.reload();
            }
        }
        //call the refresh page on closing the window
        window.onunload = refreshParent;
    </script>


    <!--End Word count-->
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
              
              <div class="dropdown">
  <button class="dropbtn">Welcome, <?php echo $session_fullname;?> </button>

</div>
              
    
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
if($_POST['doMeeting']=='Save' and $_POST['year'] and $_POST['subject'] and $_POST['comment'] and $_POST['protocol_id']){
	$mdate=$mysqli->real_escape_string($_POST['year'].'-'.$_POST['month'].'-'.$_POST['date']);
	$activ_code = rand(1000,9999);
	
	if($mdate>=$today){///meeting has to be after today
	
for ($i=0; $i < count($_POST['protocol_id']); $i++) {
$cfnreviewer= $cfn_reviewer;


	
	$subject=$mysqli->real_escape_string($_POST['subject']);
	$comment=$mysqli->real_escape_string($_POST['comment']);
	$meetingFor=$mysqli->real_escape_string($_POST['meetingFor']);
	$meetingCode=$mysqli->real_escape_string($_POST['meetingCode']);
	$meetingStatus=$mysqli->real_escape_string($_POST['meetingStatus']);
    //$protocol_id=$mysqli->real_escape_string($_POST['protocol_id']);
$protocol_id=$mysqli->real_escape_string($_POST['protocol_id'][$i]);
	
$sqlRStatus4 = "select * FROM ".$prefix."submission where protocol_id='$protocol_id'";
$resultStatus4 = $mysqli->query($sqlRStatus4);
$rStatus4=$resultStatus4->fetch_array();
$public_title=$mysqli->real_escape_string($rStatus4['public_title']);
$recAffiliated_id=$rStatus4['recAffiliated_id'];
	
$sqlInvestigators="SELECT * FROM ".$prefix."meeting where `subject`='$subject' and content='$comment' and protocol_id='$protocol_id' and date>='$mdate' order by id desc";
	$QueryInvestigators = $mysqli->query($sqlInvestigators);
	$totalInvestigators = $QueryInvestigators->num_rows;
	
	
	
if(!$totalInvestigators){
$sqlA2="insert into ".$prefix."meeting (`created`,`updated`,`date`,`subject`,`content`,`protocol_id`,`public_title`,`recAffiliated_id`,`meetingStatus`,`meetingFor`,`meetingCode`) 

values(now(),now(),'$mdate','$subject','$comment','$protocol_id','$public_title','$recAffiliated_id','$meetingStatus','$meetingFor','$meetingCode')";
$mysqli->query($sqlA2);
		}
		
if($totalInvestigators){
$sqlA2="update ".$prefix."meeting set `updated`=now(),`date`='$mdate',`subject`='$subject',`content`='$comment',`public_title`='$public_title
',`meetingStatus`='Pending' where id='$id'";
$mysqli->query($sqlA2);
}

}//end for loop
$message="<div class=success>SUCCESS! You have successfully added a meeting.</div>";
	}///end meeting has to be after today
	else{$message="<div class=error2>ERROR! You have set a meeting for a past date. Please correct and add again</div>";}
}


$sqlstudy="SELECT * FROM ".$prefix."submission where `owner_id`='$asrmApplctID' and is_sent='0' order by id desc limit 0,1";
$Querystudy = $mysqli->query($sqlstudy);
$totalstudy = $Querystudy->num_rows;
$rstudy = $Querystudy->fetch_array();
$protocol_id=$rstudy['protocol_id'];
//submission_stages
$sqlSub_Stages="SELECT * FROM ".$prefix."submission_stages where `owner_id`='$asrmApplctID' and protocol_id='$protocol_id' and status='new' order by id desc limit 0,1";
$QuerySub_stages = $mysqli->query($sqlSub_Stages);
$totalSub_Stages = $QuerySub_stages->num_rows;
$rsSubStages = $QuerySub_stages->fetch_array();
?>


<div id="countrydivcontainer" style="border:0px solid gray; width:100%; margin-bottom: 1em; padding: 10px">
<?php

$sqlSRR = "select * from ".$prefix."user where asrmApplctID='$asrmApplctID'";
$resultSSS = $mysqli->query($sqlSRR);
$sqUserdd = $resultSSS->fetch_array();

///////////////Get this meeting
$sqlSRR_meeting = "select * from ".$prefix."meeting where id='$id'";
$resultSSS_meeting = $mysqli->query($sqlSRR_meeting);
$sqUserdd_meeting = $resultSSS_meeting->fetch_array();

$shcategoryID3=$sqUserdd_meeting['date'];
$categoryChunks3 = explode("-", $shcategoryID3);

$year="$categoryChunks3[0]";
$month="$categoryChunks3[1]";
$date="$categoryChunks3[2]";
?>

<?php 

if(isset($message)){echo $message;}
?>

<div style="font-size:16px;" class="success">Protocol: <?php echo $sqUserdd_meeting['subject'];?>

</div>
<div style="font-size:12px;" class="success">
Please choose new protocol date below, meeting date will be re-scheduled to a new meeting date

</div>

<form action="" method="post" name="regForm" id="regForm" autocomplete="off">
 <?php $startYear=date('Y');?>
 <div class="form-group row" style="padding-top:10px;">
<label class="col-sm-3 form-control-label">Meeting Date:</label>
<div class="col-sm-9">
 <select name="year" id="dyear" class="form-control" tabindex="8" style=" width:100px; float:left;"  onChange="getMonthPopulateMeeting(this.value)">
<option value="">Year</option>
<?php
define('DOB_YEAR_START', $startYear);

$current_year = date('Y')+1;

for ($count = $current_year; $count >= DOB_YEAR_START; $count--)
{
?>
 <option value="<?php echo $count;?>" <?php if($count==$year){?>selected<?php }?>><?php echo $count;?></option>
<?php }?>

  </select>
       
                        
   <div id="monthdiv"><?php if($month>=1){require_once("viewlrcn/get_month_populate_update.php");}?> </div>
                              
  <select name="date" id="ddate" class="form-control" tabindex="6" style=" width:80px; float:left;">
    <option value="">Date</option>
   <option value="01" <?php if($date=='01'){?>selected<?php }?>>&nbsp;01</option>
   <option value="02" <?php if($date=='02'){?>selected<?php }?>>&nbsp;02</option>
   <option value="03" <?php if($date=='03'){?>selected<?php }?>>&nbsp;03</option>
   <option value="04" <?php if($date=='04'){?>selected<?php }?>>&nbsp;04</option>
   <option value="05" <?php if($date=='05'){?>selected<?php }?>>&nbsp;05</option>
   <option value="06" <?php if($date=='06'){?>selected<?php }?>>&nbsp;06</option>
   <option value="07" <?php if($date=='07'){?>selected<?php }?>>&nbsp;07</option>
   <option value="08" <?php if($date=='08'){?>selected<?php }?>>&nbsp;08</option>
   <option value="09" <?php if($date=='09'){?>selected<?php }?>>&nbsp;09</option>
   <option value="10" <?php if($date=='10'){?>selected<?php }?>>&nbsp;10</option>
   <option value="11" <?php if($date=='11'){?>selected<?php }?>>&nbsp;11</option>
   <option value="12" <?php if($date=='12'){?>selected<?php }?>>&nbsp;12</option>
  <option value="13" <?php if($date=='13'){?>selected<?php }?>>&nbsp;13</option>
<option value="14" <?php if($date=='14'){?>selected<?php }?>>&nbsp;14</option>
<option value="15" <?php if($date=='15'){?>selected<?php }?>>&nbsp;15</option>
<option value="16" <?php if($date=='16'){?>selected<?php }?>>&nbsp;16</option>
<option value="17" <?php if($date=='17'){?>selected<?php }?>>&nbsp;17</option>
<option value="18" <?php if($date=='18'){?>selected<?php }?>>&nbsp;18</option>
<option value="19" <?php if($date=='19'){?>selected<?php }?>>&nbsp;19</option>
<option value="20" <?php if($date=='20'){?>selected<?php }?>>&nbsp;20</option>
<option value="21" <?php if($date=='21'){?>selected<?php }?>>&nbsp;21</option>
<option value="22" <?php if($date=='22'){?>selected<?php }?>>&nbsp;22</option>
<option value="23" <?php if($date=='23'){?>selected<?php }?>>&nbsp;23</option>
<option value="24" <?php if($date=='24'){?>selected<?php }?>>&nbsp;24</option>
<option value="25" <?php if($date=='25'){?>selected<?php }?>>&nbsp;25</option>
<option value="26" <?php if($date=='26'){?>selected<?php }?>>&nbsp;26</option>
<option value="27" <?php if($date=='27'){?>selected<?php }?>>&nbsp;27</option>
<option value="28" <?php if($date=='28'){?>selected<?php }?>>&nbsp;28</option>
<option value="29" <?php if($date=='29'){?>selected<?php }?>>&nbsp;29</option>
<option value="30" <?php if($date=='30'){?>selected<?php }?>>&nbsp;30</option>
<option value="31" <?php if($date=='31'){?>selected<?php }?>>&nbsp;31</option>
   
  </select>
</div>
</div> 

 <div class="form-group row">

<label class="col-sm-3 form-control-label">Meeting For:</label>
<div class="col-sm-9">

<select name="meetingFor"  class="form-control  required"  onChange="getProtocolsMeetings(this.value)">
<option value=""></option>
<option value="protocol" <?php if($sqUserdd_meeting['meetingFor']=='protocol'){?>selected<?php }?>>Protocol</option>
<option value="AnnualRenewal" <?php if($sqUserdd_meeting['meetingFor']=='AnnualRenewal'){?>selected<?php }?>>Annual Renewal</option>
<option value="Amendments" <?php if($sqUserdd_meeting['meetingFor']=='Amendments'){?>selected<?php }?>>Amendments</option>
<option value="SAEs" <?php if($sqUserdd_meeting['meetingFor']=='SAEs'){?>selected<?php }?>>SAEs</option>
<option value="Deviations" <?php if($sqUserdd_meeting['meetingFor']=='Deviations'){?>selected<?php }?>>Deviations</option>
<option value="Notifications" <?php if($sqUserdd_meeting['meetingFor']=='Notifications'){?>selected<?php }?>>Notifications</option>
<option value="CloseOutReport" <?php if($sqUserdd_meeting['meetingFor']=='CloseOutReport'){?>selected<?php }?>>Close Out Report</option>
</select>


</div>
</div>

 <div class="form-group row">

<label class="col-sm-3 form-control-label">Subject:</label>
<div class="col-sm-9">
<input type="text" name="subject" id="subject" class="form-control  required" value="<?php echo $sqUserdd_meeting['subject'];?>">
<input type="hidden" name="meetingCode" id="meetingCode" class="form-control  required" value="<?php echo $sqUserdd_meeting['meetingCode'];?>">
<input type="hidden" name="meetingStatus" id="meetingStatus" class="form-control  required" value="<?php echo $sqUserdd_meeting['meetingStatus'];?>">
</div>
</div>
  
 <div id="protocolmeetingdiv"><?php if($sqUserdd_meeting['protocol_id']>=1){require_once("viewlrcn/getProtocolsMeetings_update.php");}?></div>
                      
<div class="form-group row">
 
<label class="col-sm-3 form-control-label">Agenda:</label>
<div class="col-sm-9">
<textarea name="comment" id="comment" cols="" rows="5" class="form-control  required"><?php echo $sqUserdd_meeting['content'];?></textarea>
</div>
</div>                
                        
       
       <div class="form-group row">
                          <div class="col-sm-4 offset-sm-3">
                    <input name="doMeeting" type="submit"  class="btn btn-primary" value="Save"/>

                          </div>
                        </div>
                                          
     </form>                 
    </div>
    </div>
    </div><!--End-->
    

                                     
</div>













<script type="text/javascript">

var countries=new ddajaxtabs("countrytabs", "countrydivcontainer")
countries.setpersist(true)
countries.setselectedClassTarget("link") //"link" or "linkparent"
countries.init()

</script>
         
         
            </div>
          </section>
          <!-- Client Section-->

          <!-- Page Footer-->
          <footer class="main-footer">
            <div class="container-fluid">
              <div class="row">
                <div class="col-sm-10">
                  <p>&copy; Uganda National Council for Science and Technology - UNCST, <?php echo date("Y");?>. All rights reserved</p>
                </div>
            
              </div>
            </div>
          </footer>
        </div>
      </div>
    </div>
<?php /*?> <!-- Javascript files-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="js/tether.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.cookie.js"> </script>
    <script src="js/jquery.validate.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
    <script src="js/charts-home.js"></script><?php */?>
    <script src="js/front.js"></script>
    <!-- Google Analytics: change UA-XXXXX-X to be your site's ID.-->
    <!---->
    <script>
      (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
      function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
      e=o.createElement(i);r=o.getElementsByTagName(i)[0];
      e.src='//www.google-analytics.com/analytics.js';
      r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
      ga('create','UA-XXXXX-X');ga('send','pageview');
    </script>
    
    <script>
// Get the modal
var modal = document.getElementById('myModal');

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
    modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>


  </body>
</html>