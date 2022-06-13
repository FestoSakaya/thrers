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
        <title>NRIMS - Register</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" type="image/png" href="favicon.ico">

        <!--Google Font link-->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
<meta name="keywords" content="National Research Information Management System,NRIMS, CRIMS, Clinical Research Information Management System, Clinical Research Management, Non Clinical Research Management, CRIMS Uganda, Clinical Trials Uganda" />
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


  
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>-->
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
                            <img src="assets/images/logo.png" class="logo" alt="CRIMS">
                            <!--<img src="assets/images/footer-logo.png" class="logo logo-scrolled" alt="">-->
                        </a>

                    </div>
                    <!-- End Header Navigation -->

                    <!-- navbar menu -->
                    <div class="collapse navbar-collapse" id="navbar-menu">
                        <ul class="nav navbar-nav navbar-right">
                        <?php //Menu();?>
                     <li><a href="./">Home</a></li>
                     <li><a href="./#about">About the Portal</a></li>
                     <li><a href="./#HowtoApply">How to Apply</a></li>
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
if($_POST['doRegister']=='Register' and $_POST['fname']  and $_POST['surname'] and $_POST['email'] and $_POST['institution']){

require("configlrcn/class.phpmailer.php");
require("configlrcn/class.smtp.php"); 


$fname=$mysqli->real_escape_string($_POST['fname']);
function getExtension($str) {

         $i = strrpos($str,".");
         if (!$i) { return ""; } 

         $l = strlen($str) - $i;
         $ext = substr($str,$i+1,$l);
         return $ext;
 }
 
	define ("MAX_SIZE","400");

 $errors=0;

$image =$_FILES["photo"]["name"];
 $uploadedfile = $_FILES['photo']['tmp_name'];

  if ($image) 
  {
  $filename = stripslashes($_FILES['photo']['name']);
  $extension = getExtension($filename);
  $extension = strtolower($extension);
 if (($extension != "jpg") && ($extension != "jpeg") && ($extension != "png") && ($extension != "gif")) 
  {
//echo ' Unknown Image extension ';
$errors=1;
  }
 else
{
  $size=filesize($_FILES['photo']['tmp_name']);
 
if ($size > MAX_SIZE*1024)
{
$sizelimit='<li class="red"><span class="ico"></span><strong class="system_title">If not uploaded, check Image size, resize to 500px width</strong></li>';
 $errors=1;
}
 
if($extension=="jpg" || $extension=="jpeg" )
{
$uploadedfile = $_FILES['photo']['tmp_name'];
$src = imagecreatefromjpeg($uploadedfile);
}
else if($extension=="png")
{
$uploadedfile = $_FILES['photo']['tmp_name'];
$src = imagecreatefrompng($uploadedfile);
}
else 
{
$src = imagecreatefromgif($uploadedfile);
}
 
list($width,$height)=getimagesize($uploadedfile);
//image
$newwidth=150;
$newheight=($height/$width)*$newwidth;
$tmp=imagecreatetruecolor($newwidth,$newheight);

imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight,$width,$height);


//$no=rand(1000,0000);
$hp="uncst_".$fname;
$newname=$hp.$image;

$filename ='./recapproval/files/profile/'. $newname;


imagejpeg($tmp,$filename,100);

imagedestroy($src);



}
}
$usernamema=$mysqli->real_escape_string($_POST['username']);
	$country_id=$mysqli->real_escape_string($_POST['country_id']);
	$email=$mysqli->real_escape_string($_POST['email']);
	$phone=$mysqli->real_escape_string($_POST['phone']);
	$allPass = preg_replace('/\s+/', '', $_POST['pwd']);
	$password=md5($mysqli->real_escape_string($allPass));
	$pwdNot=$mysqli->real_escape_string($allPass);

	
	$username = preg_replace('/\s+/', '', $usernamema);
	$institution=$mysqli->real_escape_string($_POST['institution']);
	$rstug_nin_passport=$mysqli->real_escape_string($_POST['rstug_nin_passport']);
	$rstug_district=$mysqli->real_escape_string($_POST['district']);
	$rstug_placeofbirth=$mysqli->real_escape_string($_POST['placeofbirth']);
	$idtype=$mysqli->real_escape_string($_POST['idtype']);
	$fname=$mysqli->real_escape_string($_POST['fname']);
$surname=$mysqli->real_escape_string($_POST['surname']);
$dbfirstname=$fname.' '.$surname;
$rstug_middle_name=$mysqli->real_escape_string($_POST['middle_name']);

$title=$mysqli->real_escape_string($_POST['title']);
if($title!="other"){$titleName=$mysqli->real_escape_string($_POST['title']);}
if($title=="other"){$titleName=$mysqli->real_escape_string($_POST['titleother']);}
///Get Rec Details
$sqlRecDetails="SELECT * FROM ".$prefix."list_country where `id`='$country_id'";
$QueryRecDetails = $mysqli->query($sqlRecDetails);
$sqRecDetails = $QueryRecDetails->fetch_array();
$Nationality=$sqRecDetails['name'];

///////////////////////////districts//////////////////
$sqlRecDistrict="SELECT * FROM ".$prefix."districts where `districtm_id`='$rstug_district'";
$QueryRecDistrict = $mysqli->query($sqlRecDistrict);
$sqRecDistrict = $QueryRecDistrict->fetch_array();
$district=$sqRecDistrict['districtm_name'];


$usr_ip = md5($_SERVER['REMOTE_ADDR']);
$md5pass = md5($_POST['pwd']);
$host  = $_SERVER['HTTP_HOST'];
$host_upper = strtoupper($host);
$path   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');

$activ_code = rand(1000,9999);
	
	$sqlInvestigators="SELECT * FROM ".$prefix."user where (`username`='$username' || email='$email') order by asrmApplctID desc";
	$QueryInvestigators = $mysqli->query($sqlInvestigators);
	$totalInvestigators = $QueryInvestigators->num_rows;

		if(!$totalInvestigators){
$sqlA2="insert into ".$prefix."user (`country_id`,`created`,`updated`,`email`,`password`,`username`,`is_active`,`name`,`institution`,`hashcode`,`first_access`,`privillage`,`profile`,`recAffiliated_id`,`rstug_md5_id`,`rstug_act_code`,`rstug_first_name`,`rstug_middle_name`,`rstug_surname`,`rstug_nin_passport`,`rstug_title`,`rstug_placeofbirth`,`rstug_district`,`phone`,`idtype`,`reviewerTitle`,`userConfirmation`) 

values('$country_id',now(),now(),'$email','$password','$username','0','$dbfirstname','$institution','','0','investigator','$newname','','','$activ_code','$fname','$rstug_middle_name','$surname','$rstug_nin_passport','$titleName','$rstug_placeofbirth','$rstug_district','$phone','$idtype','','new')";
$mysqli->query($sqlA2);

$md5_id = $mysqli->insert_id;
$md5_idmm = md5($mysqli->insert_id);

$updateLogin="update ".$prefix."user set rstug_md5_id='$md5_idmm' where asrmApplctID='$md5_id'";
$mysqli->query($updateLogin);

///Submit to Research database
////API to submit information in REC database

if($md5_id){
$message='<div class="success">Thank you for registering with National Research Information Management System  (NRIMS). Please check your inbox or junk/spam for the activation email to proceed.<br><br></div>';
///Now Send mail
$mail = new PHPMailer(true); //important
$mail->IsSMTP(); // set mailer to use SMTP
$mail->Port = $usmtpportNo; // SMTP Port
$mail->CharSet =  "utf-8";
$mail->Host = $usmtpHost; //


$mail->SMTPAuth = true; // turn on SMTP authentication
$mail->SMTPSecure = 'tls';
$mail->SMTPDebug = 0;


$mail->Username = "uncstuncstapps@gmail.com"; // SMTP username -- CHANGE --
$mail->Password = "lpupvbvillxraaey"; // SMTP password -- CHANGE --
$mail->setFrom("uncstuncstapps@gmail.com", "Admin");
/////////////////////////////Begin Mail Body

//$mail->addCc('mawandammoses@yahoo.com','Activation Link from NRIMS');////
$mail->addBcc('uncstuncstapps@gmail.com','Activation Link from NRIMS');//

$mail->FromName = "Activation Link from NRIMS"; //From Name -- CHANGE --
$mail->AddAddress($email, $dbfirstname); //To Address -- CHANGE --
//if($dbEmail2){echo $mail->addCc($dbEmail2,'Activation Link from UNCST');}
$mail->AddReplyTo($email, $dbfirstname); //Reply-To Address -- CHANGE --$usrm_email

$mail->WordWrap = 50; // set word wrap to 50 characters
$mail->IsHTML(false); // set email format to HTML
$mail->Subject = "Activation Link from NRIMS";
$body="
Dear $dbfirstname !<br><br>
Thank you for registering with the National Research Information Management System (NRIMS). Below are your login details;<br><br>
Username: $username<br>
Password: $pwdNot<br><br>

Click on the Link below to activate your account, or copy and paste it into your web browser.<br>
<a href='$base_url/authenticate.php?a=$md5_idmm&code=$activ_code'>Activation Link</a><br>
$base_url/authenticate.php?a=$md5_idmm&code=$activ_code
<br><br>

Best Regards<br>
National Research Information Management System (NRIMS)
";
$mail->MsgHTML($body);

if(!$mail->Send()){
	echo "Mailer Error: " . $mail->ErrorInfo;
}///end




		}
		}
		
		if($totalInvestigators){
	$message='<div class="error2">Your account was not created, already exists</div>';	
	}
		
}?>
               <div style="overflow-x:auto;">
                <form id="regForm" method="post" action="" name="regForm" autocomplete="off" enctype="multipart/form-data">
                  <div  class="logmain">
                <?php if(isset($errmessage)){echo $errmessage;}?>
                  <?php if(isset($message)){echo $message;}?>
                  
                <?php if(!$message){?>
                <h3>User account creation</h3> 
                  Required Fields marked (<span class="fontx">*</span>)
                  <hr>
				
                  <table width="100%" border="0" class="logmainc">
                  
                  
                    <tr>
                      <td width="12%" align="left" valign="top">First Name <span class="fontx">*</span></td>
                      <td width="30%" align="left" valign="top"><input id="boxline" type="text" name="fname" class="required"></td>
                      <td width="12%" align="left" valign="top">&nbsp;</td>
    <td width="11%" align="left" valign="top">Last Name <span class="fontx">*</span></td>
    <td width="35%" align="left" valign="top"><input id="lname" type="text" name="surname" class="required"></td>
  </tr>
               <tr>
                 <td width="12%" align="left" valign="top">Middle Name</td>
                 <td width="30%" align="left" valign="top"><input id="mname" type="text" name="middle_name"></td>
                 <td width="12%" align="left" valign="top">&nbsp;</td>
    <td width="11%" align="left" valign="top">Phone (Mobile) <span class="fontx">*</span></td>
    <td width="35%" align="left" valign="top"><input id="phone" type="text" name="phone" class="required"></td>
  </tr>
  
              <tr>
                <td width="12%" align="left" valign="top">Title <span class="fontx">*</span></td>
                <td width="30%" align="left" valign="top"><select name="title" class="required" id="dropdown" tabindex="11" onChange="getStateTitle(this.value)">
                <option value="" selected></option>
                <option value="Prof." <?php if($TMM['rstug_title']=='Prof.'){?>selected="selected"<?php }?>>Prof.</option>
                <option value="Dr." <?php if($TMM['rstug_title']=='Dr.'){?>selected="selected"<?php }?>>Dr.</option>
                <option value="Ms." <?php if($TMM['rstug_title']=='Ms.'){?>selected="selected"<?php }?>>Ms.</option>
                <option value="Mr." <?php if($TMM['rstug_title']=='Mr.'){?>selected="selected"<?php }?>>Mr.</option>
                <option value="Rev." <?php if($TMM['rstug_title']=='Rev.'){?>selected="selected"<?php }?>>Rev.</option>
                <option value="Sr." <?php if($TMM['rstug_title']=='Sr.'){?>selected="selected"<?php }?>>Sr.</option>
                <option value="other" <?php if($TMM['rstug_title']!='Prof.' || $TMM['rstug_title']!='Dr.' || $TMM['rstug_title']!='Ms.' || $TMM['rstug_title']!='Rev.' || $TMM['rstug_title']!='Sr.' and $TMM['rstug_title']){?>selected="selected"<?php }?>>other</option>

                </select>
      <div id="tittleother"><?php if($TMM['rstug_title']!='Prof.' || $TMM['rstug_title']!='Dr.' || $TMM['rstug_title']!='Ms.' || $TMM['rstug_title']!='Rev.' || $TMM['rstug_title']!='Sr.'){?><br /><strong><?php echo $TMM['rstug_title'];?></strong><input type="hidden" name="titleother" id="titleother" tabindex="9" value="<?php echo $TMM['rstug_title'];?>"/><?php }?></div></td>
                <td width="12%" align="left" valign="top">&nbsp;</td>
    <td width="11%" align="left" valign="top">Institution&nbsp;<span class="fontx">*</span></td>
    <td width="35%" align="left" valign="top"><span class="form-group">
      <input id="institution" type="text" name="institution" class="required">
    </span></td>
  </tr>
  
  
              <tr>
                <td align="left" valign="top">UserName&nbsp; <span class="fontx">*</span></td>
                <td align="left" valign="top"><input id="username" type="text" name="username" class="required" autocomplete="false"></td>
                <td align="left" valign="top">&nbsp;</td>
                <td align="left" valign="top">Email <span class="fontx">*</span></td>
                <td align="left" valign="top"><input id="email" type="text" name="email" class="required email"></td>
              </tr>
              <tr>
     <td align="left" valign="top">Password&nbsp; <span class="fontx">*</span></td>
     <td align="left" valign="top"><input name="pwd" type="password" class="required password" minlength="5" id="pwd" autocomplete="new-password"></td>
     <td align="left" valign="top">&nbsp;</td>
     <td align="left" valign="top">
       
       Photo <span class="fontx">*</span></td>
     <td align="left" valign="top">
       
       
       <input type="file" name="photo" tabindex="9" id="file2" class="required" /><br>
       
       
       
       
       </td>
   </tr>
  

  
   <tr>
     <td align="left" valign="top">Retype Password&nbsp; <span class="fontx">*</span></td>
     <td align="left" valign="top"><span class="form-group">
       <input name="pwd2"  id="pwd2" class="required password" type="password" minlength="5" equalto="#pwd" autocomplete="new-password">
     </span></td>
     <td rowspan="2" align="left" valign="top">&nbsp;</td>
    <td rowspan="2" align="left" valign="top">Nationality&nbsp;<span class="fontx">*</span></td>
    <td rowspan="2" align="left" valign="top">
  <select name="country_id" id="country_id" class="required"  onChange="getStateB(this.value)">
 <option value="">Please Select</option>
<?php
$sqlCountrycv = "select * FROM ".$prefix."list_country order by name asc";//and conceptm_status='new' 
$resultCountrycv = $mysqli->query($sqlCountrycv);
while($rCountrycv=$resultCountrycv->fetch_array()){
?>
<option value="<?php echo $rCountrycv['id'];?>"><?php echo $rCountrycv['name'];?></option>
<?php }?>
</select>
 
 
 <div id="birth"></div>
 </td>
  </tr>
  
  <tr>
    <td align="left" valign="top">&nbsp;</td>
    <td align="left" valign="top">&nbsp;</td>
    </tr>
  
  
  <tr>
    <td align="left" valign="top">&nbsp;</td>
    <td align="left" valign="top">&nbsp;</td>
    <td align="left" valign="top">&nbsp;</td>
    <td align="left" valign="top">&nbsp;</td>
    <td align="left" valign="top"><div class="form-group"></div>
      <input name="doRegister" type="submit" value="Register" class="btn btn-primary" id="login">

      
      
      </td>
  </tr>
  
</table> 
</div>

                  </form> 
                  </div>   
                   
          <?php }?>              
                         
                         
                         
                          
                  
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
                                    <a href="" class="btn btn-default">CRIMS</a>
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
