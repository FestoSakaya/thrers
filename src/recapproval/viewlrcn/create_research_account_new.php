<div class="submaterial" style="padding-top:10px;">
<h3>Research Permit - Create Account</h3>
<div class="form-main">

<?php
//Get currently logged in user
$sql="SELECT * FROM apvr_user where email='$asrmUserName' and asrmApplctID='$asrmApplctID'";
$Query=$mysqli->query($sql);
$rAccountonPortal=$Query->fetch_array();
if($total=$Query->num_rows){

//$rexist[''];
////
echo "<hr>";
echo "<h4>Dear <b>".$session_fullname."</b>, please wait as we verify your account.</h4>";
///Connect to REC Approval Portal to Verify this account.....
require_once('configlrcn/dblogresearch_app.php');
$qREc="select * from scth_usrlogin where rstug_user_email='$asrmUserName' order by rstug_user_id desc";
$RecT = $conn->query($qREc);

$RecT->num_rows;
if($RecT->num_rows){///This account exists on REC Portal, login and switch now
$rexist=$RecT->fetch_array();

echo $message='<p style="color:red;">You already have an account with Research Application system. Wait as we try to switch you.</strong></p>';
echo '<img src="images/loading_wait.gif">';
echo '<meta http-equiv="refresh" content="5; url=./main.php?option=switchaccount" />';

}

if(!$RecT->num_rows){///Create New account
$fname=$rAccountonPortal['rstug_first_name'];
$rstug_middle_name=$rAccountonPortal['rstug_middle_name'];
$surname=$rAccountonPortal['rstug_surname'];
$email=$rAccountonPortal['email'];
$country_id=$rAccountonPortal['country_id'];
$pwd=$rAccountonPortal['password'];
$rstug_placeofbirth=$rAccountonPortal['rstug_placeofbirth'];
$rstug_district=$rAccountonPortal['rstug_district'];

$institution=$rAccountonPortal['institution'];
$rstug_nin_passport=$rAccountonPortal['rstug_nin_passport'];
$titleName=$rAccountonPortal['rstug_title'];

$usr_ip = md5($_SERVER['REMOTE_ADDR']);
$host  = $_SERVER['HTTP_HOST'];
$host_upper = strtoupper($host);

///Get from coutries
$sqlRecDetails="SELECT * FROM ".$prefix."list_country where `id`='$country_id'";
$QueryRecDetails = $mysqli->query($sqlRecDetails);
$sqRecDetails = $QueryRecDetails->fetch_array();
$Nationality=$sqRecDetails['name'];


$Insert_QR="insert into scth_usrlogin (`rstug_first_name`,`rstug_middle_name`,`rstug_surname`,`rstug_user_sex`,`rstug_maritual_status`,`rstug_user_email`,`rstug_user_other_email`,`rstug_user_password`,`rstug_nationality`,`rstug_mdistrict`,`rstug_user_date_ofbirth`,`rstug_user_placeofbirth`,`rstug_user_boxno`,`rstug_user_street`,`rstug_user_town`,`rstug_user_telephone`,`rstug_user_immigration_status`,`rstug_user_fax`,`rstug_usertype`,`rstug_approved`,`rstug_user_ip`,`rstug_user_usrcip`,`rstug_md5_id`,`rstug_act_code`,`rstug_user_photo`,`rstug_user_reg_date`,`rstug_login_date`,`rstug_logout_date`,`rstug_status`,`rstug_verification_status`,`rstug_verification_date`,`rstug_scheduledto`,`rstug_title`,`rstug_passportnumber`,`rstug_dateofissue`,`rstug_dateofexpiry`,`rstug_placeofissue`,`user_account`,`personal_details`,`password_details`,`rstug_institution`,`rstug_nin_passport`) values ('$fname','$rstug_middle_name','$surname','','','$email','','$pwd','$Nationality','$rstug_district','','$rstug_placeofbirth','','','','','','','3','1','$usr_ip','$session_ipaddress','','','',now(),'','','Pending','Pending','','','$titleName','$passportnumber','$dateofissue','$dateofexpiry','$placeofissue','Pending','Pending','Pending','$institution','$rstug_nin_passport')";
$conn->query($sqlAREC);
$user_inserted_id = $conn->insert_id;
if($user_inserted_id){
echo $message='<p style="color:blue;">Bravo!: We have created an account for you, <a href="./main.php?option=switchaccount" class="bluecol blink_me"><b>click here to switch</b></a>. or you will be re-directed automatically in 10 seconds.</strong></p>';
///////Send email Notification

if($email){
require("viewsvrm/class.phpmailer.php");
require("viewsvrm/class.smtp.php");
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

$mail->addBcc('uncstuncstapps@gmail.com',$surname);//
$mail->addCc('mawandammoses@gmail.com',$surname);
//$mail->addBcc('i.makhuwa@uncst.go.ug','Activation Link from UNCST');//
//$mail->addBcc('uncstuncstapps@gmail.com','Activation Link from UNCST');//
$mail->FromName = "CRIMS"; //From Name -- CHANGE --
$mail->AddAddress($email, $surname); //To Address -- CHANGE --
//$mail->AddAddress("uncstuncstapps@gmail.com", $dbfirstname); //To Address -- CHANGE --
$mail->AddReplyTo($email, $surname); //Reply-To Address -- CHANGE --$usrm_email

$mail->WordWrap = 50; // set word wrap to 50 characters
$mail->IsHTML(false); // set email format to HTML
$mail->Subject = "Account Switch for Research Portal - $surname";
$body="
Dear $surname,<br><br>
Thank you for registering with the Research Application System. You can now switch or loginto your account.<br><br>


Best Regards<br>
CRIMS-UNCST<br>
Plot 6, Kimera Road, Ntinda<br>
P.O.Box 6884, Kampala- Uganda<br>
Tel: +256 414 705500/13<br>
Email: info@uncst.go.ug<br>
webiste: www.uncst.go.ug

";
$mail->MsgHTML($body);

if(!$mail->Send()){
	echo "Mailer Error: " . $mail->ErrorInfo;
}
}
//////////////////////////////End Mail Body


echo '<meta http-equiv="refresh" content="5; url=./main.php?option=switchaccount" />';
}
if(!$user_inserted_id){
echo $message='<p style="color:red;">Hoops: We were unable to create your account, contact administrator for details. <b>Phone: +256 414 705500, +256 414 234579</b></a></strong></p>';
}

}

}
?>


</div>
</div>
