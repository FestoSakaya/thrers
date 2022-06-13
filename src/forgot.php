<?php
session_start();
require_once('configlrcn/db_mconfig.php'); 
require_once('configlrcn/slmain_mlquery.php'); 
?><!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <title>National Research Information Management System : NRIMS</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" type="image/png" href="favicon.ico">

        <!--Google Font link-->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
<meta name="keywords" content="National Research Information Management System, NRIMS, NRIMS, Clinical Research Information Management System, Clinical Research Management, Non Clinical Research Management, NRIMS Uganda, Clinical Trials Uganda" />
<meta name="description" content="This is an online platform that supports the National Regulatory Agencies; NDA/UNHRO/UNCST and Research Ethics Committees in the regulatory oversight of clinical research to be carried in the country. The system provides efficient reviews of research and provides the researcher with an interface with the regulatory agencies in the data capture, data management, data validation, quality control and overall regulatory compliance to clinical research management processes" />

        <link rel="stylesheet" href="assets/css/slick/slick.css"> 
        <link rel="stylesheet" href="assets/css/slick/slick-theme.css">
        <link rel="stylesheet" href="assets/css/animate.css">
        <link rel="stylesheet" href="assets/css/iconfont.css">
        <link rel="stylesheet" href="assets/css/font-awesome.min.css">
        <link rel="stylesheet" href="assets/css/bootstrap.css">
        <link rel="stylesheet" href="assets/css/magnific-popup.css">
        <link rel="stylesheet" href="assets/css/bootsnav.css">

        <!-- xsslider slider css -->


        <!--<link rel="stylesheet" href="assets/css/xsslider.css">-->




        <!--For Plugins external css-->
        <!--<link rel="stylesheet" href="assets/css/plugins.css" />-->

        <!--Theme custom css -->
        <link rel="stylesheet" href="assets/css/style.css">
        <!--<link rel="stylesheet" href="assets/css/colors/maron.css">-->

        <!--Theme Responsive css-->
        <link rel="stylesheet" href="assets/css/responsive.css" />

        <script src="assets/js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>
        <script type="text/javascript">
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
        </script>
        
        
<script language="JavaScript" type="text/javascript" src="./assets/js/jquery-1.3.2.min.js"></script>
<script language="JavaScript" type="text/javascript" src="./assets/js/jquery.validate.js"></script>

  <script>
  $(document).ready(function(){
    $.validator.addMethod("username", function(value, element) {
        return this.optional(element) || /^[a-z0-9\_]+$/i.test(value);
    }, "Username must contain only letters, numbers, or underscore.");

    $("#regForm").validate();
  });
  </script>
<script type="text/javascript" src="./assets/js/ajax.js"></script>
    </head>

    <body data-spy="scroll" data-target=".navbar-collapse">




        <div class="culmn">
            <!--Home page style-->


            <nav class="navbar navbar-default bootsnav navbar-fixed">
                <div class="navbar-top bg-grey fix">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="navbar-callus text-left sm-text-center">
                                    <ul class="list-inline">
                                        <li><a href=""><i class="fa fa-phone"></i> Call us: +256 414 705500</a></li>
                                        <li><a href=""><i class="fa fa-envelope-o"></i> Contact us: info@uncst.go.ug</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="navbar-socail text-right sm-text-center">
                                    <ul class="list-inline">
                                        <li><a href="https://web.facebook.com/UNCST?_rdc=1&_rdr" target="_blank"><i class="fa fa-facebook"></i></a></li>
                                        <li><a href="https://twitter.com/UNCST_Uganda" target="_blank"><i class="fa fa-twitter"></i></a></li>
                                        <li><a href="https://www.linkedin.com/company/uganda-national-council-for-science-and-technology" target="_blank"><i class="fa fa-linkedin"></i></a></li>
                                        <li><a href="https://plus.google.com/113486680663842578110" target="_blank"><i class="fa fa-google-plus"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Start Top Search -->
                <div class="top-search">
                    <div class="container">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-search"></i></span>
                            <input type="text" class="form-control" placeholder="Search">
                            <span class="input-group-addon close-search"><i class="fa fa-times"></i></span>
                        </div>
                    </div>
                </div>
                <!-- End Top Search -->


                <div class="container"> 
                    <div class="attr-nav">
                        <ul>
                            <li class="search"><a href="#"><i class="fa fa-search"></i></a></li>
                        </ul>
                    </div> 

                    <!-- Start Header Navigation -->
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu">
                            <i class="fa fa-bars"></i>
                        </button>
                        <a class="navbar-brand" href="./">
                            <img src="assets/images/logo.png" class="logo" alt="NRIMS">
                            <!--<img src="assets/images/footer-logo.png" class="logo logo-scrolled" alt="">-->
                        </a>

                    </div>
                    <!-- End Header Navigation -->

                    <!-- navbar menu -->
                    <div class="collapse navbar-collapse" id="navbar-menu">
                        <ul class="nav navbar-nav navbar-right">
                        <?php //Menu();?>
                     <li><a href="./#Home">Home</a></li>
                     <li><a href="./#about">About the Portal</a></li>
                     <li><a href="./#HowtoApply">How to Apply</a></li>
                     <li><a href="register.php" style="color:#03F;">Register/Create Account</a></li>
                     <li><a href="./#Home" style="color:#fe4641;width:auto;" onClick="document.getElementById('id01').style.display='block'" > Returning user/Login</a></li>
                     <li><a href="faqs.php">FAQs</a></li>
                
                        </ul>
                        
                    </div><!-- /.navbar-collapse -->
					
                </div> 

            </nav>

            <!--Home Sections-->

         <section id="home" class="home bg-black fix">
                <div class="overlay"></div>
                <div class="container">
                    <div class="row">
                        <div class="main_home text-center">
                            <div class="col-md-12">
                                <div class="hello_slid">
                                
                                </div></div></div></div></div></section>

<!--Brand Section-->
            <section id="brand" class="brand fix roomy-60">
                <div class="container">
                    <div class="row" style=" padding-top:10px;"">
                    
                    
                    
  <?php
if ($_POST['doChangePassword']=='Change')
{
$phone = $mysqli->real_escape_string($_POST['phone']);
		$name = $mysqli->real_escape_string($_POST['name']);// or phone='$phone'
		
	$sqlInvestigators="SELECT * FROM ".$prefix."user where email='$name' OR username='$name' order by asrmApplctID desc limit 0,1";
	$QueryInvestigators = $mysqli->query($sqlInvestigators);
	$total = $QueryInvestigators->num_rows;
	$r = $QueryInvestigators->fetch_array();
	
		$dbrstug_user_id=$r['asrmApplctID'];
		$dbrstug_user_email=$r['email'];
		$dbfirstname=$r['name'];
		$dbfirstphone=$r['phone'];
		$dbfullName=$dbfirstname;
////////////////////////////////////////////////////////////////////////////////////////

		if($total==1 && $dbrstug_user_email==$name){ //&& $dbcac_usertype==1 || $dbfirstphone==$phone

    $hostmain  = $_SERVER['HTTP_HOST'];
    $host_upper = strtoupper($host);
    $path   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
	$length=25;
$generated = md5(substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length));
	
$query="update ".$prefix."user set `rstug_act_code`='$generated' where email='$dbrstug_user_email' and asrmApplctID='$dbrstug_user_id'";
$mysqli->query($query);

///send email

require("configlrcn/class.phpmailer.php");
require("configlrcn/class.smtp.php"); 

//Now send Email
///////////Send Email now//////////////////////////////
$mail1="uncstapps@gmail.com";
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
/////////////////////////////Begin Mail Body

$mail->FromName = "NRIMS"; //From Name -- CHANGE --
$mail->AddAddress($dbrstug_user_email, $dbfullName); //To Address -- CHANGE --
$mail->AddReplyTo($dbrstug_user_email, "NRIMS Password Re-set"); //Reply-To Address -- CHANGE --$usrm_email


#This port has changed from 587 to 465
$mail->WordWrap = 50; // set word wrap to 50 characters
$mail->IsHTML(false); // set email format to HTML
$mail->Subject = "Password Reset";
$body="Dear $dbfirstname,<br>
To reset your password, click the URL below.<br><br>

If you cant see the link, copy and paste the link in your browser<br><br>
$base_url/reset.php?rs=$generated<br>
<a href='$base_url/reset.php?rs=$generated'>Click to Re-set Password</a><br><br>

If you did not request your password to be reset, just ignore this email and your password will continue to stay the same.<br><br>

Best Regards<br>
National Research Information Management System (NRIMS)<br>
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
$err2='<strong class="error">The email or phone number you have entered doesnot exist</strong>';
		
		
			}
					}//end if post
?> <h4 style="padding-top:10px;">Re-set Password</h4>
       <?php if(isset($err2)){echo $err2;}?>      
                
                  <form id="login-form" method="post" action="">
                  Required Fields marked (<span class="fontx">*</span>)
                  <div  class="logmain">
                  <table width="100%" border="0" class="logmainc">


  
  <tr>
    <td width="18%" valign="top"><label for="login-username" class="label-material">Enter Email Address </label></td>
    <td width="82%" valign="top"><div class="form-group"><input id="login-username email" type="text" name="name" class="input-material" style="padding-left:5px;"> <br>OR
  </div></td>
  </tr>
  
   <tr>
    <td width="18%" valign="top"><label for="login-username" class="label-material">Enter Phone Number </label></td>
    <td width="82%" valign="top"><div class="form-group">Phone number you used on creating an account. <input id="login-username email" type="text" name="phone" class="input-material" style="padding-left:5px;">
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
            </section><!-- End off Brand section -->


  
            <!--Call to  action section-->
            <section id="action" class="action bg-primary roomy-40">
                <div class="container">
                    <div class="row">
                        <div class="maine_action">
                            <div class="col-md-8">
                                <div class="action_item text-center">
                                    <h2 class="text-white text-uppercase">"A prosperous Science and Technology Led Ugandan Society."</h2>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="action_btn text-left sm-text-center">
                                    <a href="" class="btn btn-default">NRIMS</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>




            <footer id="contact" class="footer action-lage bg-black p-top-80">
                <!--<div class="action-lage"></div>-->
             
                <div class="main_footer fix bg-mega text-center p-top-40 p-bottom-30 m-top-80">
                    <div class="col-md-12">
                        <p class="wow fadeInRight" data-wow-duration="1s">
                            Copyright &copy; <?php echo date("Y");?> all rights reserved to Uganda National Council for Science and Technology (UNCST)
                        </p>
                    </div>
                </div>
            </footer>




        </div>




        <!-- JS includes -->

   <?php /*?>     <script src="assets/js/vendor/jquery-1.11.2.min.js"></script>
        <script src="assets/js/vendor/bootstrap.min.js"></script>

        <script src="assets/js/owl.carousel.min.js"></script>
        <script src="assets/js/jquery.magnific-popup.js"></script>
        <script src="assets/js/jquery.easing.1.3.js"></script>
        <script src="assets/css/slick/slick.js"></script>
        <script src="assets/css/slick/slick.min.js"></script>
        <script src="assets/js/jquery.collapse.js"></script>
        <script src="assets/js/bootsnav.js"></script><?php */?>



 <?php /*?>       <script src="assets/js/plugins.js"></script>
        <script src="assets/js/main.js"></script>
<!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/5b445eaa6d961556373d9099/default';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script><?php */?>
<!--End of Tawk.to Script-->
    </body>
</html>
