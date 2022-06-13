<?php
session_start();
require_once('contrlrcn/c_mlsrcontrol.php'); 
?><!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"><![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"><![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"><![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="en"><!--<![endif]-->
<head>

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
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Signika+Negative:400,600,700">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,300italic,400,400italic,600,600italic,700,700italic,900,900italic">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
<!--<script src="js/jquery.js"></script>
<script src="js/flexslider.min.js"></script>
<script src="js/scripts.js"></script>-->
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
<script type="text/javascript" src="js/ajax.js"></script>
</head>
<body>

<div id="headercont" class="container bg1 clearfix">
	<div class="bodycontainer clearfix">
    
		<div class="row clearfix">
			<div id="logocont" class="dwdgrid-4">
				<div class="logogrid"></div>
			</div>
			<div id="menucont" class="dwdgrid-8">
                <div id="menu" class="clearfix">
                    <ul>
                        <li class="active"><a href="./">Home</a></li>
                         <li><a href="../">UNCST Research</a></li>
                    
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
							<p style="text-align:left;color:#ffffff;">Accreditation of RECs is within  Section 4 of the National Guidelines for Research Involving Humans as Research Participants published by UNCST in July 2014, which requires all RECs operating in Uganda to be accredited by UNCST. The Accreditation is valid for three (3) years and is subject to the RECs' continuing compliance with all applicable national standards and guidelines for RECs in Uganda, and to any additional stipulations or guidelines that may be provided by the UNCST.  </p>
							<p><a class="buttonm" href="https://uncst.go.ug/research-ethics-committee-accreditation/" target="_blank">View list of Accredited RECs</a></p><p>&nbsp;</p>
                            </div>
                            
                            
                            <div class="loginbox2">
                            
                            
                              <!-- Form Panel    -->
            <div class="col-lg-8 bg-white">
              <div class="form d-flex align-items-center">
                <div class="content" style=" padding-bottom:0px; padding-top:20px;">
                
                 <?php
if($_POST['doRegister']=='Register' and $_POST['fname']  and $_POST['surname'] and $_POST['email']){

require("viewlrcn/class.phpmailer.php");
require("viewlrcn/class.smtp.php"); 

	$country_id=$mysqli->real_escape_string($_POST['country_id']);
	$email=$mysqli->real_escape_string($_POST['email']);
	
	$allPass = preg_replace('/\s+/', '', $_POST['pwd']);
	$password=md5($mysqli->real_escape_string($allPass));
	$pwdNot=$mysqli->real_escape_string($allPass);

	$usernamema=$mysqli->real_escape_string($_POST['username']);
	$username = preg_replace('/\s+/', '', $usernamema);
	$institution=$mysqli->real_escape_string($_POST['institution']);
	$rstug_nin_passport=$mysqli->real_escape_string($_POST['rstug_nin_passport']);
	$rstug_district=$mysqli->real_escape_string($_POST['district']);
	$rstug_placeofbirth=$mysqli->real_escape_string($_POST['placeofbirth']);
	
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


$usr_ip = md5($_SERVER['REMOTE_ADDR']);
$md5pass = md5($_POST['pwd']);
$host  = $_SERVER['HTTP_HOST'];
$host_upper = strtoupper($host);
$path   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');

$activ_code = rand(1000,9999);
	
	$sqlInvestigators="SELECT * FROM ".$prefix."user where `username`='$username' and email='$email' order by asrmApplctID desc";
	$QueryInvestigators = $mysqli->query($sqlInvestigators);
	$totalInvestigators = $QueryInvestigators->num_rows;
	if($totalInvestigators){
	$message='<p class="error">Your account was not created, already exists</p>';	
	}
		if(!$totalInvestigators){
$sqlA2="insert into ".$prefix."user (`country_id`,`created`,`updated`,`email`,`password`,`username`,`is_active`,`name`,`institution`,`hashcode`,`first_access`,`privillage`,`profile`,`recAffiliated_id`,`rstug_md5_id`,`rstug_act_code`,`rstug_first_name`,`rstug_middle_name`,`rstug_surname`,`rstug_nin_passport`,`rstug_title`,`rstug_placeofbirth`,`rstug_district`) 

values('$country_id',now(),now(),'$email','$password','$username','0','$dbfirstname','$institution','','0','investigator','','','','$activ_code','$fname','$rstug_middle_name','$surname','$rstug_nin_passport','$titleName','$rstug_placeofbirth','$rstug_district')";
$mysqli->query($sqlA2);
$md5_id = $mysqli->insert_id;
$md5_idmm = md5($mysqli->insert_id);

$updateLogin="update ".$prefix."user set rstug_md5_id='$md5_idmm' where asrmApplctID='$md5_id'";
$mysqli->query($updateLogin);

///Submit to Research database
////API to submit information in REC database
if($md5_id){
require_once('configlrcn/dblogresearch_app.php');
$qREc="select * from scth_usrlogin where rstug_user_email='$email'";
$RecT = $conn->query($qREc);
$TotalsREc = $RecT->num_rows;
if(!$TotalsREc){
$Insert_QR="insert into scth_usrlogin (`rstug_first_name`,`rstug_middle_name`,`rstug_surname`,`rstug_user_sex`,`rstug_maritual_status`,`rstug_user_email`,`rstug_user_other_email`,`rstug_user_password`,`rstug_nationality`,`rstug_mdistrict`,`rstug_user_date_ofbirth`,`rstug_user_placeofbirth`,`rstug_user_boxno`,`rstug_user_street`,`rstug_user_town`,`rstug_user_telephone`,`rstug_user_immigration_status`,`rstug_user_fax`,`rstug_usertype`,`rstug_approved`,`rstug_user_ip`,`rstug_user_usrcip`,`rstug_md5_id`,`rstug_act_code`,`rstug_user_photo`,`rstug_user_reg_date`,`rstug_login_date`,`rstug_logout_date`,`rstug_status`,`rstug_verification_status`,`rstug_verification_date`,`rstug_scheduledto`,`rstug_title`,`rstug_passportnumber`,`rstug_dateofissue`,`rstug_dateofexpiry`,`rstug_placeofissue`,`user_account`,`personal_details`,`password_details`,`rstug_institution`,`rstug_nin_passport`) values ('$fname','$rstug_middle_name','$surname','','','$email','','$password','$Nationality','$rstug_district','$date_ofbirth','$rstug_placeofbirth','','','','','','','3','0','$usr_ip','$session_ipaddress','$md5_idmm','','',now(),'','','Pending','Pending','','','','$titleName','','','','Pending','Pending','Pending','$institution','$rstug_nin_passport')";
$cmd_QR = $conn->query($Insert_QR);
$user_inserted_id = $conn->insert_id;
////Add dummy project
if($user_inserted_id){
$Insert_QR2="insert into scth_completed_processes (`rstug_user_id`,`rstug_rsch_project_id`,`completed_processes`,`completed_usrlogin`,`completed_occupation`,`completed_education`,`completed_postgraduate_research`,`completed_research_project`,`completed_terms_conditons`,`completed_personel_involved`,`rstug_attachment_status`,`rstug_expenditure_status`,`final_submission`,`projm_status`) values ('$user_inserted_id','0','0','0','0','0','0','0','0','0','0','0','No','new')";
$conn->query($Insert_QR2);
}

}


}

$message='<p class="success">Thank you for registering with Research Ethics Committees (RECs). Please check your inbox or junk/spam for the activation email to proceed.<br><br></p>';

if($md5_id){
///Now Send mail
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
//$mail->addCc('uncstuncstapps@gmail.com','Activation Link from UNCST');//
$mail->addBcc('uncstuncstapps@gmail.com','Activation Link from NRIMS');//

$mail->FromName = "Activation Link from NRIMS Approval"; //From Name -- CHANGE --
$mail->AddAddress($email, $dbfirstname); //To Address -- CHANGE --
//if($dbEmail2){echo $mail->addCc($dbEmail2,'Activation Link from UNCST');}
$mail->AddReplyTo($email, $dbfirstname); //Reply-To Address -- CHANGE --$usrm_email

$mail->WordWrap = 50; // set word wrap to 50 characters
$mail->IsHTML(false); // set email format to HTML
$mail->Subject = "Activation Link from REC Approval";
$body="
Dear $dbfirstname !<br><br>
Thank you for registering with the REC Approval Application. Below are your login details;<br><br>
Username: $username<br>
Password: $pwdNot<br><br>

Click on the Link below to activate your account, or copy and paste it into your web browser.<br>
<a href='$base_urlauthenticate.php?a=$md5_idmm&code=$activ_code'>Activation Link</a><br>
$base_urlrecapproval/authenticate.php?a=$md5_idmm&code=$activ_code
<br><br>

Best Regards<br>
REC
";
$mail->MsgHTML($body);

if(!$mail->Send()){
	echo "Mailer Error: " . $mail->ErrorInfo;
}///end



		}
		}
		
}?>
               
                <form id="regForm" method="post" action="" name="regForm" autocomplete="off">
                  <div  class="logmain"><b class="text-blue">User account creation</b> 
				  <?php if(isset($message)){echo $message;}?>
                <?php if(isset($errmessage)){echo $errmessage;}?>
                <?php if(!$message){?>
                  <table width="100%" border="0" class="logmainc">
                  
                  
                    <tr>
    <td width="26%"><label for="login-username" class="label-material">First Name <font color="#CC0000">*</font></label></td>
    <td width="74%"><input id="boxline" type="text" name="fname" class="required">
                      
                 </td>
  </tr>
               <tr>
    <td width="26%"><label for="login-username" class="label-material">Middle Name</label></td>
    <td width="74%"><input id="mname" type="text" name="middle_name">
     </td>
  </tr>
  
              <tr>
    <td width="26%"><label for="login-username" class="label-material">Last Name <font color="#CC0000">*</font></label></td>
    <td width="74%"><input id="lname" type="text" name="surname" class="required">
     </td>
  </tr>
  
        <tr>
    <td width="26%"><label for="login-username" class="label-material">Title <font color="#CC0000">*</font></label></td>
    <td width="74%"> <select name="title" class="required" id="htitle" tabindex="11" onChange="getStateTitle(this.value)">
                <option value="" selected></option>
                <option value="Prof." <?php if($TMM['rstug_title']=='Prof.'){?>selected="selected"<?php }?>>Prof.</option>
                <option value="Dr." <?php if($TMM['rstug_title']=='Dr.'){?>selected="selected"<?php }?>>Dr.</option>
                <option value="Ms." <?php if($TMM['rstug_title']=='Ms.'){?>selected="selected"<?php }?>>Ms.</option>
                <option value="Mr." <?php if($TMM['rstug_title']=='Mr.'){?>selected="selected"<?php }?>>Mr.</option>
                <option value="Rev." <?php if($TMM['rstug_title']=='Rev.'){?>selected="selected"<?php }?>>Rev.</option>
                <option value="Sr." <?php if($TMM['rstug_title']=='Sr.'){?>selected="selected"<?php }?>>Sr.</option>
                <option value="other" <?php if($TMM['rstug_title']!='Prof.' || $TMM['rstug_title']!='Dr.' || $TMM['rstug_title']!='Ms.' || $TMM['rstug_title']!='Rev.' || $TMM['rstug_title']!='Sr.' and $TMM['rstug_title']){?>selected="selected"<?php }?>>other</option>

                </select>
      <div id="tittleother"><?php if($TMM['rstug_title']!='Prof.' || $TMM['rstug_title']!='Dr.' || $TMM['rstug_title']!='Ms.' || $TMM['rstug_title']!='Rev.' || $TMM['rstug_title']!='Sr.'){?><br /><strong><?php echo $TMM['rstug_title'];?></strong><input type="hidden" name="titleother" id="titleother" tabindex="9" value="<?php echo $TMM['rstug_title'];?>"/><?php }?></div>
     </td>
  </tr>
  
  
   <tr>
    <td valign="top"><label for="login-username" class="label-material">Institution&nbsp;<font color="#CC0000">*</font></label></td>
    <td valign="top">
 <div class="form-group">
<input id="institution" type="text" name="institution" class="required">
</div>

 </td>
  </tr>
  
  
  
   <tr>
    <td valign="top"><label for="login-username" class="label-material">Nationality&nbsp;<font color="#CC0000">*</font></label></td>
    <td valign="top"><div class="col-sm-9 select">
 <select name="country_id" id="country_id" class="required" style="background: #eee;"  onChange="getStateB(this.value)">
 <option value="">Please Select</option>
<?php
$sqlCountrycv = "select * FROM ".$prefix."list_country order by name asc";//and conceptm_status='new' 
$resultCountrycv = $mysqli->query($sqlCountrycv);
while($rCountrycv=$resultCountrycv->fetch_array()){
?>
<option value="<?php echo $rCountrycv['id'];?>"><?php echo $rCountrycv['name'];?></option>
<?php }?>
</select>
 </div>
 
 <div id="birth"></div>
 
 </td>
  </tr>
  
  <tr>
    <td valign="top"><label for="login-username" class="label-material">Email <font color="#CC0000">*</font></label></td>
    <td valign="top"><div class="form-group"><input id="email" type="text" name="email" class="required email">
  </div></td>
  </tr>
  
  <tr>
    <td valign="top"><label for="login-username" class="label-material">UserName&nbsp; <font color="#CC0000">*</font></label></td>
    <td valign="top"><div class="form-group"><input id="username" type="text" name="username" class="required">
  </div></td>
  </tr>
  
  
   <tr>
    <td valign="top"><label for="login-username" class="label-material">Password&nbsp; <font color="#CC0000">*</font></label></td>
    <td valign="top">
    
    <div class="form-group">
    <input name="pwd" type="password" class="required password" minlength="5" id="pwd"> 

  </div>
    </td>
  </tr>
  
  
  <tr>
    <td valign="top"><label for="login-password" class="label-material">Retype Password&nbsp; <font color="#CC0000">*</font></label></td>
    <td valign="top"><div class="form-group">
                     <input name="pwd2"  id="pwd2" class="required password" type="password" minlength="5" equalto="#pwd">
                      
                    </div>
                    <input name="doRegister" type="submit" value="Register" class="btn btn-primary" id="login">
                    
                    
                    
                    </td>
  </tr>
  
</table>
</div>

                  </form>
                  <?php }?>
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



<div id="footercont" class="container clearfix">
    <div class="bodycontainer clearfix">
	    
        <div class="row">
            <div class="dwdgrid-2">
                <p><a class="scrolltop" href="#top"><span class="fa fa-angle-double-up"></span></a></p>
            </div>
            <div class="dwdgrid-10">
                <div id="socialmedia" class="clearfix">
              
                </div>
                <p>&copy; RECs, <?php echo date("Y");?>. All rights reserved </p>
            </div>
        </div>
        
    </div>
</div>
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
</script>
<!--End of Tawk.to Script-->
</body>
</html>