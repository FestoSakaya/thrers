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
   <!-- <script src="https://use.fontawesome.com/99347ac47f.js"></script>-->
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
          <header class="page-header">
            <div class="container-fluid">
            <?php
$sqlInvestigatorsT33="SELECT * FROM ".$prefix."submission_review_sr where `id`='$id'";
$QueryInvestigatorsTr22 = $mysqli->query($sqlInvestigatorsT33);
$Data = $QueryInvestigatorsTr22->fetch_array();
$protocol_id=$Data['protocol_id'];

$sqlstudy="SELECT * FROM ".$prefix."submission where `id`='$protocol_id' order by id desc limit 0,1";
$Querystudy = $mysqli->query($sqlstudy);
$totalstudy = $Querystudy->num_rows;
$rstudy = $Querystudy->fetch_array();
$protocol_id=$rstudy['protocol_id'];

?>
         <h2 class="no-margin-bottom">Make an Appeal</h2>
 
            </div>
          </header>


          <!-- Projects Section-->
          <section class="projects no-padding-top">
            <div class="container-fluid">
         
         
       <?php
//doSaveFive
if($_POST['doSaveHalting'] and $_POST['asrmApplctID'] and $id and $_POST['appealReason']){

	$reason=$mysqli->real_escape_string($_POST['reason']);
	$asrmApplctID=$mysqli->real_escape_string($_POST['asrmApplctID']);
	$type_of_review=$mysqli->real_escape_string($_POST['type_of_review']);
	$appealReason=$mysqli->real_escape_string($_POST['appealReason']);
   $public_title=$mysqli->real_escape_string($_POST['public_title']);


$sqlMyrecnamew="SELECT * FROM ".$prefix."list_rec_affiliated where id='$recAffiliated_id'";
$sqlFMyreccnaw=$mysqli->query($sqlMyrecnamew);
$recNamew=$sqlFMyreccnaw->fetch_array();

	$contacts=$recNamew['contacts'];
	$recOriginalName=$recNamew['name'];
	$recchairEmail=$recNamew['recchairEmail'];
	$recemail=$recNamew['recemail'];

	
	///Which admin has reviewed this protocol
$sqlSReviewer = "select * from ".$prefix."user where asrmApplctID='$asrmApplctID'";
$resReviewer = $mysqli->query($sqlSReviewer);
$sqReviewer = $resReviewer->fetch_array();
$OwnerName=$sqReviewer['name'];
$OwnerEmail=$sqReviewer['email'];

$sqlChceckMembersNew2ee="update ".$prefix."appeal_halted_studies set appealReason='$appealReason',appealDate=now(),appealSubmitted='Yes' where protocol_id='$id' and owner_id='$asrmApplctID' and id='$act'";
$mysqli->query($sqlChceckMembersNew2ee);//status='notallowedaccess'

$sqlChceckMembersNew2="update ".$prefix."submission set appeals='Yes', appealHalting='$appealReason' where  id='$id'";
$mysqli->query($sqlChceckMembersNew2);//status='notallowedaccess'
logaction("$session_fullname has made an appeal on halted study for $public_title");

if($recemail){
require("viewlrcn/class.phpmailer.php");
require("viewlrcn/class.smtp.php"); 	

require_once("viewlrcn/mail_template_halting_submission_appeal.php");
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
$mail->addCc("mawandammoses@gmail.com",$OwnerName);
$mail->addCc("mutumba.beth@yahoo.com",$OwnerName);
$mail->addBcc("uncstuncstapps@gmail.com",$OwnerName);//$mail->addBcc($reviewerEmail,$ReviewerName);

$mail->FromName = $OwnerName; //From Name -- CHANGE --
$mail->AddAddress($recemail, $recOriginalName); //To Address -- CHANGE --$recemail
//if($dbEmail2){echo $mail->addCc($dbEmail2,'Activation Link from UNCST');}
$mail->AddReplyTo($OwnerEmail, $OwnerName); //Reply-To Address -- CHANGE --$usrm_email

$mail->WordWrap = 50; // set word wrap to 50 characters
$mail->IsHTML(false); // set email format to HTML
$mail->Subject = "Appeal for Halted Study - $public_title";
$body="$allSentMessage
";
$mail->MsgHTML($body);

if(!$mail->Send()){
	echo "Mailer Error: " . $mail->ErrorInfo;
}///end	
}//end REC

if($OwnerEmail){
require("viewlrcn/class.phpmailer.php");
require("viewlrcn/class.smtp.php"); 	

require_once("viewlrcn/mail_template_halting_submission_appeal2.php");
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
$mail->addCc("mawandammoses@gmail.com",$OwnerName);
$mail->addBcc("uncstuncstapps@gmail.com",$OwnerName);//$mail->addBcc($reviewerEmail,$ReviewerName);

$mail->FromName = $OwnerName; //From Name -- CHANGE --
$mail->AddAddress($recOriginalName, $OwnerName); //To Address -- CHANGE --$recemail
//if($dbEmail2){echo $mail->addCc($dbEmail2,'Activation Link from UNCST');}
$mail->AddReplyTo($recemail, $OwnerName); //Reply-To Address -- CHANGE --$usrm_email

$mail->WordWrap = 50; // set word wrap to 50 characters
$mail->IsHTML(false); // set email format to HTML
$mail->Subject = "Appeal for Halted Study - $public_title";
$body="$allSentMessage
";
$mail->MsgHTML($body);

if(!$mail->Send()){
	echo "Mailer Error: " . $mail->ErrorInfo;
}///end	
}//end Owner



echo "
<script type=\"text/javascript\">
        alert('Infomation has been updated, please wait..');
        window.close();
</script>";


}//end post


?>

<div id="countrydivcontainer" style="border:0px solid gray; width:100%; margin-bottom: 1em; padding: 10px">
<?php
$sqlstudym="SELECT * FROM ".$prefix."submission where protocol_id='$id' order by id desc limit 0,1";
$Querystudym = $mysqli->query($sqlstudym);
$rstudym = $Querystudym->fetch_array();
$owner_id=$rstudym['owner_id'];

$sqlstudym2="SELECT * FROM ".$prefix."appeal_halted_studies where protocol_id='$id' and id='$act'";
$Querystudym2 = $mysqli->query($sqlstudym2);
$rstudym2 = $Querystudym2->fetch_array();

$sqlSRR = "select * from ".$prefix."user where asrmApplctID='$asrmApplctID'";
$resultSSS = $mysqli->query($sqlSRR);
$sqUserdd = $resultSSS->fetch_array();
?>

<?php 

if(isset($message)){echo $message;}
?>

<form action="" name="regForm" id="regForm" method="post" enctype="multipart/form-data" autocomplete="off">

                       <div class="form-group row success">
                          <label class="col-sm-7 form-control-label">Reasons for Halting: <span class="error">*</span></label>
                          <textarea name="bbb" id="mawanda1hh" cols="" rows="5" class="form-control  required" readonly><?php echo $rstudym2['reasonsforhalting'];?></textarea>
                        </div>
                        
                        
                         <div class="form-group row success">
                          <label class="col-sm-7 form-control-label">Provide reasons: <span class="error">*</span></label>
                          <textarea name="appealReason" id="mawanda1hh" cols="" rows="5" class="form-control  required"><?php if($rstudym2['appealReason']){echo $rstudym2['appealReason'];}else{$_POST['appealReason'];}?></textarea>
                        </div>
                             
                       
                         <div class="form-group row">

                    
                            
                            <input type="hidden" name="asrmApplctID" value="<?php echo $owner_id;?>">
                            <input type="hidden" name="submission_id" value="<?php echo $rstudym['id'];?>">
                            <input type="hidden" name="public_title" value="<?php echo $rstudym['public_title'];?>">
                         <input type="hidden" name="oldtype_of_review" value="<?php echo $rstudym['type_of_review'];?>">
                       
                        
                        </div>
                        
                        
                        <div class="form-group row">

 <div id="conflictdiv"></div>  
                       
                        
                        </div>
                        
                        <div class="line"></div>
                        
                         <?php /*?> <div class="form-group row">
                          <label class="col-sm-4 form-control-label">Prior Ethical Approval:</label>

                          <input name="prior_ethical_approval" type="radio" value="1" class="required"  onChange="getState(this.value)"/> Yes &nbsp;<input name="prior_ethical_approval" type="radio" value="0" class="required" onChange="getState(this.value)"/> No
  
                          
                          
                        </div>
                        <div id="statediv"></div><?php */?>
         
                       
                        
                        <div class="form-group row">
                          <div class="col-sm-4 offset-sm-3">
                    <input name="doSaveHalting" type="submit"  class="btn btn-primary" value="Submit"/>

                          </div>
                        </div>
                        
                        
                        
                        
                        
                        
                        
                        
                        
   
   </form>
   
                                     
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