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
//doSaveFive
if($_POST['doRescheduleMeeting']=='Re-schedule Meeting' and $_POST['public_title'] and $id and $_POST['year'] and $_POST['month'] and $_POST['date']){
$mdate=$mysqli->real_escape_string($_POST['year'].'-'.$_POST['month'].'-'.$_POST['date']);
	$subject=$mysqli->real_escape_string($_POST['subject']);
	$content=$mysqli->real_escape_string($_POST['content']);
	$public_title=$mysqli->real_escape_string($_POST['public_title']);
	$protocol_id=$mysqli->real_escape_string($_POST['protocol_id']);


$sqlA2="update ".$prefix."meeting set `updated`=now(),`date`='$mdate',`meetingStatus`='Pending' where id='$id'";
$mysqli->query($sqlA2);


$queryConceptLogs="select * from ".$prefix."meeting where id='$id'";
$rsConceptLogs=$mysqli->query($queryConceptLogs);
$sqSubmission = $rsConceptLogs->fetch_array();
$cfnreviewer= $sqSubmission['reviewer_id'];
$recAffiliated_c= $sqSubmission['recAffiliated_id'];
//send notification
require("viewlrcn/class.phpmailer.php");
require("viewlrcn/class.smtp.php");


//////////////////Get reviewers
$sqlReviewer="SELECT * FROM ".$prefix."user  where asrmApplctID='$cfnreviewer'";
$QueryReviewer=$mysqli->query($sqlReviewer);
$sqReviewer = $QueryReviewer->fetch_array();
$assignedtoName=$sqReviewer['name'];
$usrm_email=$sqReviewer['email'];

$sqlMyrecnamew="SELECT * FROM ".$prefix."list_rec_affiliated where id='$recAffiliated_c'";
$sqlFMyreccnaw=$mysqli->query($sqlMyrecnamew);
$recNamew=$sqlFMyreccnaw->fetch_array();

	$contacts=$recNamew['contacts'];
	$recOriginalName=$recNamew['name'];
	$recemail=$recNamew['recemail'];

//////////////////Send now
require_once("viewlrcn/mail_template_rescheduled_meeting.php");
$mail = new PHPMailer(true); //important
$mail->IsSMTP(); // set mailer to use SMTP
$mail->Port = "587"; // SMTP Port
$mail->CharSet =  "utf-8";
$mail->Host = "$usmtpHost"; // specify SMTP server//nemesis.eahd.or.ug mailhost02.cfi.co.ug
$mail->SMTPAuth = true; // turn on SMTP authentication
$mail->SMTPSecure = 'tls';
$mail->SMTPDebug = 0;


$mail->Username = "uncstuncstapps@gmail.com"; // SMTP username -- CHANGE --
$mail->Password = "lpupvbvillxraaey"; // SMTP password -- CHANGE --
$mail->setFrom("uncstuncstapps@gmail.com", "Admin");
/////////////////////////////Begin Mail Body
$mail->addCc('$usrm_email',$assignedtoName);//mutumba.beth@yahoo.com

$mail->FromName = "REC - $recOriginalName"; //From Name -- CHANGE --
$mail->AddAddress("mawandammoses@gmail.com", $assignedtoName); //To Address -- CHANGE --
//if($dbEmail2){echo $mail->addCc($dbEmail2,'Activation Link from UNCST');}
$mail->AddReplyTo($recemail, $recOriginalName); //Reply-To Address -- CHANGE --$usrm_email

$mail->WordWrap = 50; // set word wrap to 50 characters
$mail->IsHTML(false); // set email format to HTML
$mail->Subject = "Meeting Re-scheduled: $subject";
$body="$allSentMessage";
$mail->MsgHTML($body);

if(!$mail->Send()){
	echo "Mailer Error: " . $mail->ErrorInfo;
}///end



$message="<div class='success'>Meeting has been re-scheduled.</div>";
if($message){
echo "
<script type=\"text/javascript\">
        alert('Meeting has been re-scheduled');
        window.close();
</script>";
}


}//end post



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
?>

<?php 

if(isset($message)){echo $message;}
?>

<div style="font-size:16px;" class="success">Protocol: <?php echo $sqUserdd_meeting['subject'];?>

</div>
<div style="font-size:12px;" class="success">
Please choose new protocol date below, meeting date will be re-scheduled to a new meeting date

</div>
<?php $startYear=date('Y');?>
<form action="" method="post" name="regForm" id="regForm" autocomplete="off">
 
 <div class="form-group row" style="padding-top:10px;">
<label class="col-sm-3 form-control-label">Change Meeting Date:</label>
<div class="col-sm-9">
 <select name="year" id="dyear" class="form-control required" tabindex="8" style=" width:100px; float:left;"  onChange="getMonthPopulateMeeting(this.value)">
<option value="">Year</option>
<?php

define('DOB_YEAR_START', $startYear);

$current_year = date('Y')+1;

for ($count = $current_year; $count >= DOB_YEAR_START; $count--)
{
?>
 <option value="<?php echo $count;?>"><?php echo $count;?></option>
<?php }?>

  </select>
                         
   <div id="monthdivmn"></div>
                              
  <select name="date" id="ddate" class="form-control required" tabindex="6" style=" width:80px; float:left;">
    <option value="">Date</option>
   <option value="01">&nbsp;01</option>
   <option value="02">&nbsp;02</option>
   <option value="03">&nbsp;03</option>
   <option value="04">&nbsp;04</option>
   <option value="05">&nbsp;05</option>
   <option value="06">&nbsp;06</option>
   <option value="07">&nbsp;07</option>
   <option value="08">&nbsp;08</option>
   <option value="09">&nbsp;09</option>
   <option value="10">&nbsp;10</option>
   <option value="11">&nbsp;11</option>
   <option value="12">&nbsp;12</option>
  <option value="13">&nbsp;13</option>
<option value="14">&nbsp;14</option>
<option value="15">&nbsp;15</option>
<option value="16">&nbsp;16</option>
<option value="17">&nbsp;17</option>
<option value="18">&nbsp;18</option>
<option value="19">&nbsp;19</option>
<option value="20">&nbsp;20</option>
<option value="21">&nbsp;21</option>
<option value="22">&nbsp;22</option>
<option value="23">&nbsp;23</option>
<option value="24">&nbsp;24</option>
<option value="25">&nbsp;25</option>
<option value="26">&nbsp;26</option>
<option value="27">&nbsp;27</option>
<option value="28">&nbsp;28</option>
<option value="29">&nbsp;29</option>
<option value="30">&nbsp;30</option>
<option value="31">&nbsp;31</option>
   
  </select>
  
  
  <input name="protocol_id" type="hidden" value="<?php echo $sqUserdd_meeting['protocol_id'];?>">
  <input name="public_title" type="hidden" value="<?php echo $sqUserdd_meeting['public_title'];?>">
  <input name="content" type="hidden" value="<?php echo $sqUserdd_meeting['content'];?>">
  <input name="subject" type="hidden" value="<?php echo $sqUserdd_meeting['subject'];?>">
  
</div>
</div> 

         
       
       <div class="form-group row">
                          <div class="col-sm-4 offset-sm-3">
                    <input name="doRescheduleMeeting" type="submit"  class="btn btn-primary" value="Re-schedule Meeting"/>

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