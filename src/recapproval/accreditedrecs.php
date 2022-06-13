<?php
session_start();
require_once('contrlrcn/c_mlsrcontrol.php'); 
?><!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"><![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"><![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"><![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="en"><!--<![endif]-->
<head>
<!-- Website Template designed by www.downloadwebsitetemplates.co.uk -->
<meta charset="UTF-8">
<title><?php echo $sitename;?></title>
<meta name="description" content="">
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144.png">
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114.png">
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72.png">
<link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57.png">
<link rel="shortcut icon" href="images/ico/favicon.png">
<!--[if IE]><![endif]-->
<link rel="stylesheet" href="css/framework.css">
<link rel="stylesheet" href="css/style.css">
<!--<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Signika+Negative:400,600,700">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,300italic,400,400italic,600,600italic,700,700italic,900,900italic">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">-->
<script src="js/jquery.js"></script>
<script src="js/flexslider.min.js"></script>
<script src="js/scripts.js"></script>
<link rel="stylesheet" href="css/loginbox.css">
<!--[if lt IE 9]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->

<script language="JavaScript" type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
<script language="JavaScript" type="text/javascript" src="js/jquery.validate.js"></script>

  <script>
  $(document).ready(function(){
    $.validator.addMethod("username", function(value, element) {
        return this.optional(element) || /^[a-z0-9\_]+$/i.test(value);
    }, "Username must contain only letters, numbers, or underscore.");

    $("#regForm").validate();
  });
  </script>

</head>
<body>

<div id="headercont" class="container bg1 clearfix">
	<div class="bodycontainer clearfix">
    
		<div class="row clearfix">
			<div id="logocont" class="dwdgrid-4">
				<p><a href="http://localhost/work/uncst/recapproval/">REC Approval</a></p>
			</div>
			<div id="menucont" class="dwdgrid-8">
                <div id="menu" class="clearfix">
                    <ul>
                        <li class="active"><a href="./">Home</a></li>
                       <li><a href="./register.php">Register Now</a></li>
                        <!-- <li><a href="#">FAQs</a></li>
                        <li><a href="#">About</a></li>
                        <li><a href="#">Contact</a></li>-->
                    </ul>
                </div>
			</div>
		</div>
        
	</div>
</div>

<div id="gallerycont" class="containerfull bg2 clearfix">
	<div class="bodycontainer bgpattern clearfix">
        
		<div class="flexslider">
			<ul class="slides">
				<li>
					<div class="container">
						<div class="bodycontainer">
                        
                        <div class="welcomeleft2">
							<h3>UNCST ACCREDITED RECs</h3>
							<p style="text-align:left;color:#ffffff;">Accreditation of RECs is within  Section 4 of the <a href="./files/Human_Subjects_Protection_Guidelines_July_2014.pdf" target="_blank" style=" text-decoration:underline;">National Guidelines for Research Involving Humans</a> as Research Participants published by UNCST in July 2014, which requires all RECs operating in Uganda to be accredited by UNCST. The Accreditation is valid for three (3) years and is subject to the RECs' continuing compliance with all applicable national standards and guidelines for RECs in Uganda, and to any additional stipulations or guidelines that may be provided by the UNCST. </p>
							<p><a class="button" href="accreditedrecs.php" >Learn More</a></p>
						
                            </div>
                            
                            
                            <div class="loginbox2">
                            
                            
                              <!-- Form Panel    -->
            <div class="col-lg-8 bg-white">
              <div class="form d-flex align-items-center">
                <div class="content" style=" padding-bottom:0px; padding-top:20px;">
                <h4 style="padding-top:10px;">Re-set Password</h4>
<?php
if ($_POST['doChangePassword']=='Change' and $_POST['name'])
{

		$name = $mysqli->real_escape_string($_POST['name']);
		
	$sqlInvestigators="SELECT * FROM ".$prefix."user where email='$name'";
	$QueryInvestigators = $mysqli->query($sqlInvestigators);
	$total = $QueryInvestigators->num_rows;
	$r = $QueryInvestigators->fetch_array();
	
		$dbrstug_user_id=$r['asrmApplctID'];
		$dbrstug_user_email=$r['email'];
		$dbfirstname=$r['name'];
		$dbfullName=$dbfirstname;
////////////////////////////////////////////////////////////////////////////////////////

		if($total==1 && $dbrstug_user_email==$name){ //&& $dbcac_usertype==1

    $hostmain  = $_SERVER['HTTP_HOST'];
    $host_upper = strtoupper($host);
    $path   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
	$length=25;
$generated = md5(substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length));
	
$query="update ".$prefix."user set `rstug_act_code`='$generated' where email='$dbrstug_user_email' and asrmApplctID='$dbrstug_user_id'";
$mysqli->query($query);

///send email

require("viewlrcn/class.phpmailer.php");
require("viewlrcn/class.smtp.php"); 

///Now send Email
///////////Send Email now//////////////////////////////
$mail1="uncstuncstapps@gmail.com";
$mail2=$smail;//sender, original creator

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
//$mail->addBcc('mawandammoses@gmail.com','Activation Link from UNCST');

$mail->FromName = "REC Approval"; //From Name -- CHANGE --
$mail->AddAddress($dbrstug_user_email, $dbfullName); //To Address -- CHANGE --
$mail->AddReplyTo($dbrstug_user_email, "REC Approval Password Re-set"); //Reply-To Address -- CHANGE --$usrm_email


#This port has changed from 587 to 465
$mail->WordWrap = 50; // set word wrap to 50 characters
$mail->IsHTML(false); // set email format to HTML
$mail->Subject = "Password Reset";
$body="Dear $dbfirstname,<br>
To reset your password, click the URL below.<br><br>

If you cant see the link, copy and paste the link in your browser<br><br>
http://localhost/work/uncst/recapproval/reset.php?rs=$generated<br>
<a href='http://localhost/work/uncst/recapproval/reset.php?rs=$generated'>Click to Re-set Password</a><br><br>

If you did not request your password to be reset, just ignore this email and your password will continue to stay the same.<br><br>

Best Regards<br>
Research Registration and Clearance| Uganda National Council for Science and Technology<br>
Plot 6, Kimera Road, Ntinda<br>
P.O.Box 6884, Kampala- Uganda<br>
Tel: +256 414 705500/13/21<br>
Email: info@uncst.go.ug<br>
webiste: www.uncst.go.ug 
";
$mail->MsgHTML($body);

if(!$mail->Send()){
	echo "Mailer Error: " . $mail->ErrorInfo;
}


$err2='<strong class="msg">Your Password has been emailed to '.$dbrstug_user_email.'</strong>';
			}else{
$err2='<strong class="error">The email you have entered doesnot exist</strong>';
		
		
			}
					}//end if post
?>



 
                <?php if(isset($err2)){echo $err2;}?>

                  <form id="login-form" method="post" action="">
                  <div  class="logmain">
                  <table width="100%" border="0" class="logmainc">


  
  <tr>
    <td valign="top"><label for="login-username" class="label-material">Email</label></td>
    <td valign="top"><div class="form-group"><input id="login-username email" type="text" name="name" required="" class="input-material" style="padding-left:5px;">
  </div></td>
  </tr>
  
 
  
  <tr>
    <td valign="top"></td>
    <td valign="top">
                    <input name="doChangePassword" type="submit" value="Change" class="btn btn-primary" id="login">
                    
                    
                    
                    </td>
  </tr>
  
</table>
</div>

                  </form>
        
                </div>
              </div>
            </div><!-- End Form Panel    -->
                            
                            
                            
                            
                            </div>
                            
                            
                            
						</div>
					</div>
				</li>
			
			
			</ul>
		</div>
		
	</div>
</div>

<div id="boxescont" class="container bg3 clearfix">
	<div class="bodycontainer clearfix">
        <table width="100%" border="0" class="logmainc" style="text-align: left!important; font-size:13px!important;">
  <tr>
    <td width="22%" style="background:#09F; font-size:16px; text-indent:5px; color:#FFF;"><strong>Host Institution</strong></td>
    <td width="15%" style="background:#09F; font-size:16px; text-indent:5px; color:#FFF;"><strong>REC Number</strong></td>
    <td width="21%" style="background:#09F; font-size:16px; text-indent:5px; color:#FFF;"><strong>Contact Information</strong></td>
    <td width="21%" style="background:#09F; font-size:16px; text-indent:5px; color:#FFF;"><strong>REC Chairperson</strong></td>
    <td width="21%" style="background:#09F; font-size:16px; text-indent:5px; color:#FFF;"><strong>REC Chair Email</strong></td>
  </tr>

 <?php
 $count=1;
    $color1="#F2F9FD";
    $color2="#ffffff";
$sql = "select * FROM ".$prefix."list_rec_affiliated order by name asc LIMIT 0,150";//and conceptm_status='new' 
$result = $mysqli->query($sql);
while($rRec=$result->fetch_array()){
	$rowcolor=($count%2)?$color1:$color2;
	?>
  <tr style="background:<?php echo $rowcolor;?>;">
    <td style="padding-top:10px; padding-left:10px;"><?php echo $rRec['name'];?></td>
    <td><?php echo $rRec['code'];?></td>
    <td><?php echo $rRec['contacts'];?></td>
    <td><?php echo $rRec['recChairName'];?></td>
    <td><?php echo $rRec['recchairEmail'];?></td>
  </tr>
  
   <tr>
    <td colspan="5">&nbsp;</td>
  </tr>
  
  
 <?php $count++;}?>
</table>


		
	</div>
</div>


<div id="footercont" class="container clearfix">
    <div class="bodycontainer clearfix">
	    
        <div class="row">
            <div class="dwdgrid-2">
                <p><a class="scrolltop" href="#top"><span class="fa fa-angle-double-up"></span></a></p>
            </div>
            <div class="dwdgrid-10">
                <div id="socialmedia" class="clearfix">
              
                </div>
                <p>&copy; Uganda National Council for Science and Technology - UNCST, <?php echo date("Y");?>. All rights reserved </p>
            </div>
        </div>
        
    </div>
</div>

</body>
</html>