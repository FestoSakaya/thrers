<?php
$sqlstudy="SELECT * FROM ".$prefix."submission where `owner_id`='$asrmApplctID' and id='$id' order by id desc limit 0,1";
$Querystudy = $mysqli->query($sqlstudy);
$totalstudy = $Querystudy->num_rows;
$rstudy = $Querystudy->fetch_array();
?><ul id="countrytabs" class="shadetabs">
<?php if($totalstudy>=1){?><li><a href="./main.php?option=submission">Protocol Information</a></li><?php }?>
<?php if(!$totalstudy){?><li class="extra">Protocol Information</li><?php }?>

<?php if($totalstudy>=1){?><li><a href="./main.php?option=submissionSecond&id=<?php echo $rstudy['id'];?>">Protocol Details</a></li><?php }?>
<?php if(!$totalstudy){?><li class="extra">Protocol Details</li><?php }?>

<?php if($totalstudy>=1){?><li><a href="./main.php?option=submissionThird&id=<?php echo $rstudy['id'];?>">Study Description</a></li><?php }?>
<?php if(!$totalstudy){?><li class="extra">Study Description</li><?php }?>

<?php if($totalstudy>=1){?><li><a href="./main.php?option=StudyPopulation&id=<?php echo $rstudy['id'];?>" <?php if($rsSubStages['study_population']==1){?> style="background:green; color:#FFF;" <?php }?>>Study Population</a></li><?php }?>
<?php if(!$totalstudy){?><li class="extra" <?php if($rsSubStages['study_population']==1){?> style="background:green; color:#FFF;" <?php }?>>Study Population</li><?php }?>

<?php if($totalstudy>=1){?><li><a href="./main.php?option=submissionFour&id=<?php echo $rstudy['id'];?>">Clinical Trial</a></li><?php }?>
<?php if(!$totalstudy){?><li class="extra">Clinical Trial</li><?php }?>

<?php if($totalstudy>=1){?><li><a href="./main.php?option=submissionBudget&id=<?php echo $rstudy['id'];?>">Budget</a></li><?php }?>
<?php if(!$totalstudy){?><li class="extra">Budget</li><?php }?>

<?php if($totalstudy>=1){?><li><a href="./main.php?option=submissionSchedule&id=<?php echo $rstudy['id'];?>">Study Work Plan</a></li><?php }?>
<?php if(!$totalstudy){?><li class="extra">Study Work Plan</li><?php }?>

<?php /*?><?php if($totalstudy>=1){?><li><a href="./main.php?option=submissionFive/<?php echo $rstudy['id'];?>/">Bibliography</a></li><?php }?>
<?php if(!$totalstudy){?><li class="extra">Bibliography</li><?php }?><?php */?>

<?php if($totalstudy>=1){?><li><a href="./main.php?option=submissionSix&id=<?php echo $rstudy['id'];?>">Attached Files</a></li><?php }?>
<?php if(!$totalstudy){?><li class="extra">Attached Files</li><?php }?>

<li><a href="#" rel="#default" class="selected">Payments</a></li>



</ul>

<div id="countrydivcontainer" style="border:0px solid gray; width:100%; margin-bottom: 1em; padding: 10px">
<?php
$sqlstudym="SELECT * FROM ".$prefix."submission where `owner_id`='$asrmApplctID' and protocol_id='$id' order by id desc limit 0,1";
$Querystudym = $mysqli->query($sqlstudym);
$rstudym = $Querystudym->fetch_array();
$owner_id=$rstudym['owner_id'];

$sqlSRR = "select * from ".$prefix."user where asrmApplctID='$asrmApplctID'";
$resultSSS = $mysqli->query($sqlSRR);
$sqUserdd = $resultSSS->fetch_array();
?>
  <!-- Project-->
              <div class="project">
                <div class="row bg-white has-shadow">
                  <div class="left-col col-lg-6 d-flex align-items-center justify-content-between">
                    <div class="project-title d-flex align-items-center">
                     <?php if($sqUserdd['profile']){?> <div class="image has-shadow"><img src="files/profile/<?php echo $sqUserdd['profile'];?>" alt="..." class="img-fluid"></div><?php }?>
                      <div class="text">
                        <h3 class="h4">Protocal Title</h3><small><?php echo $rstudym['public_title'];?></small>
                      </div>
                    </div>
                    <div class="project-date"><span class="hidden-sm-down"><h3 class="h4">Author</h3> <?php echo $sqUserdd['name'];?></span></div>
                  </div>
                  <div class="right-col col-lg-6 d-flex align-items-center">
                    <div class="time"><i class="fa fa-clock-o"></i><h3 class="h4">Updated At</h3> <?php echo $rstudym['updated'];?> </div>
                    <!--<div class="comments"><i class="fa fa-comment-o"></i>20</div>-->
                    <div class="project-progress">
                     
                     
          <?php //include("viewlrcn/status_log.php");?>


                    </div>
                  </div>
                </div>
              </div>
<?php 
//doSaveFive
if($rstudy['status']=='Pending Final Submission' and $id){
require("viewlrcn/class.phpmailer.php");
require("viewlrcn/class.smtp.php"); 

//protocls
$sqlsProtocol="SELECT * FROM ".$prefix."submission where `owner_id`='$asrmApplctID' and id='$id'";
$QuerystudyProtocol = $mysqli->query($sqlsProtocol);
$rstudyProtocol = $QuerystudyProtocol->fetch_array();

if($QuerystudyProtocol->num_rows){
$submission_id=$rstudyProtocol['id'];
$public_title=$rstudyProtocol['public_title'];
$recAffiliated_id=$rstudyProtocol['recAffiliated_id'];

$sqlprotocalSubSel="SELECT * FROM ".$prefix."protocol where `owner_id`='$asrmApplctID' and id='$submission_id'";
$QprotocalSub2Sel = $mysqli->query($sqlprotocalSubSel);
$rprotocalSub2Sel = $QprotocalSub2Sel->fetch_array();
$ProtoclRefNo=$rprotocalSub2Sel['code'];


$sqlMyrecnamew="SELECT * FROM ".$prefix."list_rec_affiliated where id='$recAffiliated_id'";
$sqlFMyreccnaw=$mysqli->query($sqlMyrecnamew);
$recNamew=$sqlFMyreccnaw->fetch_array();

$contacts=$recNamew['contacts'];
$recOriginalNamem=$recNamew['name'];
$recShortNamem=$recNamew['accroname'];
$recchairEmail=$recNamew['recchairEmail'];
$recemail=$recNamew['recemail'];
//PI Name
$sqlMyUser="SELECT * FROM ".$prefix."user where asrmApplctID='$asrmApplctID'";
$sqlFUser=$mysqli->query($sqlMyUser);
$recUser=$sqlFUser->fetch_array();
$name=$recUser['name'];
$email=$recUser['email'];
///Get Reference Number

$sqlA2Protocol="update ".$prefix."submission  set `is_sent`='1',`status`='Waiting for Committee',`paymentStatus`='Not Paid',`updated`='$dateSubmitted',`newresubmission`='1' where id='$id' and owner_id='$asrmApplctID'";
$mysqli->query($sqlA2Protocol);
//update protocl
$sqlA2ProtocolTable="update ".$prefix."protocol  set `updated`=now() where id='$id' and owner_id='$asrmApplctID'";
$mysqli->query($sqlA2ProtocolTable);

$sqlA2Protocol33="update ".$prefix."study_population  set `status`='completed' where protocol_id='$id' and owner_id='$asrmApplctID'";
$mysqli->query($sqlA2Protocol33);

$sqlA2Protocol44="update ".$prefix."determination_of_risk  set `status`='completed' where protocol_id='$id' and owner_id='$asrmApplctID'";
$mysqli->query($sqlA2Protocol44);

$sqlStageDone="update ".$prefix."submission_stages set status='completed' where `owner_id`='$asrmApplctID' and protocol_id='$id' and status='new'";
$QueryStgCompleted = $mysqli->query($sqlStageDone);
//update tema
$sqlTeam="update ".$prefix."team set protocol_id='$submission_id' where `owner_id`='$asrmApplctID' and protocol_id='$id' and status='new'";
//$mysqli->query($sqlTeam);

$sqlTeam2="update ".$prefix."team set status='completed' where `owner_id`='$asrmApplctID' and protocol_id='$id'";
$mysqli->query($sqlTeam2);

$sqlPopulation="update ".$prefix."study_population set status='completed' where `owner_id`='$asrmApplctID' and protocol_id='$id'";
$mysqli->query($sqlPopulation);
///Now Send mail
require_once("viewlrcn/mail_template_make_final_submission.php");

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
$mail->addCc($recchairEmail,$recOriginalNamem);//
$mail->addBcc($recemail,$recOriginalNamem);//

$mail->FromName = "$recOriginalNamem"; //From Name -- CHANGE --
$mail->AddAddress($email, $name); //To Address -- CHANGE --$email
//if($dbEmail2){echo $mail->addCc($dbEmail2,'Activation Link from UNCST');}
$mail->AddReplyTo($email, $name); //Reply-To Address -- CHANGE --$usrm_email

$mail->WordWrap = 50; // set word wrap to 50 characters
$mail->IsHTML(false); // set email format to HTML
$mail->Subject = "REC Protocol Application Confirmation - $public_title";
$body="$allSentMessage
";
$mail->MsgHTML($body);

if(!$mail->Send()){
	echo "Mailer Error: " . $mail->ErrorInfo;
}///end

		
echo '<img src="images/loading_wait.gif">';
echo '<div class="spacer"></div>';

echo '<meta http-equiv="refresh" content="2; url='.$base_url.'/main.php?option=dashboard" />';
//$base_url/
$message="<p class='success'>Dear $name !<br><br>
Thank you for your protocol titled, '<b>$public_title</b>' Your protocol has been submitted on <b>$today</b>.<br /><br />

Your protocol reference number is <b>$ProtoclRefNo</b>. Please, use this number for all your future correspondences with the REC on this particular protocol.<br /><br />

Best Regards<br>
$contacts<br><br></p>";




}//end post
else{
	$message="<p class='red'>Dear $name !<br><br>
Your proposal was not submitted, please contact administrator for details.<br></p>";
}
}


///////////////////////////////Scheduled for Review
if($rstudy['status']=='Scheduled for Review' and $id){
require("viewlrcn/class.phpmailer.php");
require("viewlrcn/class.smtp.php"); 

//protocls
$sqlsProtocol="SELECT * FROM ".$prefix."submission where `owner_id`='$asrmApplctID' and id='$id'";
$QuerystudyProtocol = $mysqli->query($sqlsProtocol);
$rstudyProtocol = $QuerystudyProtocol->fetch_array();

if($QuerystudyProtocol->num_rows){
$submission_id=$rstudyProtocol['id'];
$public_title=$rstudyProtocol['public_title'];
$recAffiliated_id=$rstudyProtocol['recAffiliated_id'];

$sqlprotocalSubSel="SELECT * FROM ".$prefix."protocol where `owner_id`='$asrmApplctID' and id='$id'";
$QprotocalSub2Sel = $mysqli->query($sqlprotocalSubSel);
$rprotocalSub2Sel = $QprotocalSub2Sel->fetch_array();
$ProtoclRefNo=$rprotocalSub2Sel['code'];


$sqlMyrecnamew="SELECT * FROM ".$prefix."list_rec_affiliated where id='$recAffiliated_id'";
$sqlFMyreccnaw=$mysqli->query($sqlMyrecnamew);
$recNamew=$sqlFMyreccnaw->fetch_array();

$contacts=$recNamew['contacts'];
$recOriginalNamem=$recNamew['name'];
$recchairEmail=$recNamew['recchairEmail'];
$recemail=$recNamew['recemail'];
//PI Names
$sqlMyUser="SELECT * FROM ".$prefix."user where asrmApplctID='$asrmApplctID'";
$sqlFUser=$mysqli->query($sqlMyUser);
$recUser=$sqlFUser->fetch_array();
$name=$recUser['name'];
$email=$recUser['email'];
///Get Reference Number

$sqlA2Protocol="update ".$prefix."submission  set `is_sent`='1',`CompletenessCheck`='Pending',`status`='Waiting for Committee',`updated`='$dateSubmitted',`newresubmission`='1' where id='$id' and owner_id='$asrmApplctID'";
$mysqli->query($sqlA2Protocol);

//update protocl
$sqlA2ProtocolTable="update ".$prefix."protocol  set `updated_in`=now(),`comments_response_date`=now() where id='$id' and owner_id='$asrmApplctID'";
$mysqli->query($sqlA2ProtocolTable);

$sqlA2Protocol33="update ".$prefix."study_population  set `status`='completed' where protocol_id='$id' and owner_id='$asrmApplctID'";
$mysqli->query($sqlA2Protocol33);


$sqlStageDone="update ".$prefix."submission_stages set status='completed' where `owner_id`='$asrmApplctID' and protocol_id='$id' and status='new'";
$QueryStgCompleted = $mysqli->query($sqlStageDone);


require_once("viewlrcn/mail_template_re_submission.php");

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
$mail->addCc($recchairEmail,$recOriginalNamem);//
$mail->addBcc($recemail,$recOriginalNamem);//

$mail->FromName = "$recOriginalNamem"; //From Name -- CHANGE --
$mail->AddAddress($email, $name); //To Address -- CHANGE --$email
//if($dbEmail2){echo $mail->addCc($dbEmail2,'Activation Link from UNCST');}
$mail->AddReplyTo($email, $name); //Reply-To Address -- CHANGE --$usrm_email

$mail->WordWrap = 50; // set word wrap to 50 characters
$mail->IsHTML(false); // set email format to HTML
$mail->Subject = "Completeness Check - $public_title";
$body="$allSentMessage
";
$mail->MsgHTML($body);

if(!$mail->Send()){
	echo "Mailer Error: " . $mail->ErrorInfo;
}///end

		
echo '<img src="images/loading_wait.gif">';
echo '<div class="spacer"></div>';

echo '<meta http-equiv="refresh" content="6; url='.$base_url.'/main.php?option=dashboard" />';
//$base_url/
$message="<p class='success'>Dear $name !<br><br>
Thank you for your protocol titled, '<b>$public_title</b>' Your protocol has been submitted on <b>$today</b>.<br /><br />

Your protocol reference number is <b>$ProtoclRefNo</b>. Please, use this number for all your future correspondences with the REC on this particular protocol.<br /><br />

Best Regards<br>
$contacts<br><br></p>";

}//end post
else{
	$message="<p class='red'>Dear $name !<br><br>
Your concept was not submitted, please contact administrator for details.<br></p>";
}
}


///////////////////////////////completeness check
if($rstudy['status']=='completeness check' || $rstudy['status']=='waiting Committee' and $id){
require("viewlrcn/class.phpmailer.php");
require("viewlrcn/class.smtp.php"); 

//protocls
$sqlsProtocol="SELECT * FROM ".$prefix."submission where `owner_id`='$asrmApplctID' and id='$id'";
$QuerystudyProtocol = $mysqli->query($sqlsProtocol);
$rstudyProtocol = $QuerystudyProtocol->fetch_array();

if($QuerystudyProtocol->num_rows){
$submission_id=$rstudyProtocol['id'];
$public_title=$rstudyProtocol['public_title'];
$recAffiliated_id=$rstudyProtocol['recAffiliated_id'];

$sqlprotocalSubSel="SELECT * FROM ".$prefix."protocol where `owner_id`='$asrmApplctID' and id='$id'";
$QprotocalSub2Sel = $mysqli->query($sqlprotocalSubSel);
$rprotocalSub2Sel = $QprotocalSub2Sel->fetch_array();
$ProtoclRefNo=$rprotocalSub2Sel['code'];


$sqlMyrecnamew="SELECT * FROM ".$prefix."list_rec_affiliated where id='$recAffiliated_id'";
$sqlFMyreccnaw=$mysqli->query($sqlMyrecnamew);
$recNamew=$sqlFMyreccnaw->fetch_array();

$contacts=$recNamew['contacts'];
$recOriginalNamem=$recNamew['name'];
$recchairEmail=$recNamew['recchairEmail'];
$recemail=$recNamew['recemail'];
//PI Names
$sqlMyUser="SELECT * FROM ".$prefix."user where asrmApplctID='$asrmApplctID'";
$sqlFUser=$mysqli->query($sqlMyUser);
$recUser=$sqlFUser->fetch_array();
$name=$recUser['name'];
$email=$recUser['email'];
///Get Reference Number

$sqlA2Protocol="update ".$prefix."submission  set `is_sent`='1',`CompletenessCheck`='Pending',`status`='Waiting for Committee',`updated`='$dateSubmitted',`newresubmission`='1' where id='$id' and owner_id='$asrmApplctID'";
$mysqli->query($sqlA2Protocol);

//update protocl
$sqlA2ProtocolTable="update ".$prefix."protocol  set `updated_in`=now(),`comments_response_date`=now() where id='$id' and owner_id='$asrmApplctID'";
$mysqli->query($sqlA2ProtocolTable);

$sqlA2Protocol33="update ".$prefix."study_population  set `status`='completed' where protocol_id='$id' and owner_id='$asrmApplctID'";
$mysqli->query($sqlA2Protocol33);


$sqlStageDone="update ".$prefix."submission_stages set status='completed' where `owner_id`='$asrmApplctID' and protocol_id='$id' and status='new'";
$QueryStgCompleted = $mysqli->query($sqlStageDone);


require_once("viewlrcn/mail_template_re_submission.php");

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
$mail->addCc($recchairEmail,$recOriginalNamem);//
$mail->addBcc($recemail,$recOriginalNamem);//

$mail->FromName = "$recOriginalNamem"; //From Name -- CHANGE --
$mail->AddAddress($email, $name); //To Address -- CHANGE --$email
//if($dbEmail2){echo $mail->addCc($dbEmail2,'Activation Link from UNCST');}
$mail->AddReplyTo($email, $name); //Reply-To Address -- CHANGE --$usrm_email

$mail->WordWrap = 50; // set word wrap to 50 characters
$mail->IsHTML(false); // set email format to HTML
$mail->Subject = "Completeness Check - $public_title";
$body="$allSentMessage
";
$mail->MsgHTML($body);

if(!$mail->Send()){
	echo "Mailer Error: " . $mail->ErrorInfo;
}///end

		
echo '<img src="images/loading_wait.gif">';
echo '<div class="spacer"></div>';

echo '<meta http-equiv="refresh" content="6; url='.$base_url.'/main.php?option=dashboard" />';
//$base_url/
$message="<p class='success'>Dear $name !<br><br>
Thank you for your protocol titled, '<b>$public_title</b>' Your protocol has been submitted on <b>$today</b>.<br /><br />

Your protocol reference number is <b>$ProtoclRefNo</b>. Please, use this number for all your future correspondences with the REC on this particular protocol.<br /><br />

Best Regards<br>
$contacts<br><br></p>";

}//end post
else{
	$message="<p class='red'>Dear $name !<br><br>
Your concept was not submitted, please contact administrator for details.<br></p>";
}
}











///////////////////////////////completeness check
if($rstudy['status']=='Waiting for Committee' and $id){
require("viewlrcn/class.phpmailer.php");
require("viewlrcn/class.smtp.php"); 

//protocls
$sqlsProtocol="SELECT * FROM ".$prefix."submission where `owner_id`='$asrmApplctID' and id='$id'";
$QuerystudyProtocol = $mysqli->query($sqlsProtocol);
$rstudyProtocol = $QuerystudyProtocol->fetch_array();

if($QuerystudyProtocol->num_rows){
$submission_id=$rstudyProtocol['id'];
$public_title=$rstudyProtocol['public_title'];
$recAffiliated_id=$rstudyProtocol['recAffiliated_id'];

$sqlprotocalSubSel="SELECT * FROM ".$prefix."protocol where `owner_id`='$asrmApplctID' and id='$id'";
$QprotocalSub2Sel = $mysqli->query($sqlprotocalSubSel);
$rprotocalSub2Sel = $QprotocalSub2Sel->fetch_array();
$ProtoclRefNo=$rprotocalSub2Sel['code'];


$sqlMyrecnamew="SELECT * FROM ".$prefix."list_rec_affiliated where id='$recAffiliated_id'";
$sqlFMyreccnaw=$mysqli->query($sqlMyrecnamew);
$recNamew=$sqlFMyreccnaw->fetch_array();

$contacts=$recNamew['contacts'];
$recOriginalNamem=$recNamew['name'];
$recchairEmail=$recNamew['recchairEmail'];
$recemail=$recNamew['recemail'];
//PI Names
$sqlMyUser="SELECT * FROM ".$prefix."user where asrmApplctID='$asrmApplctID'";
$sqlFUser=$mysqli->query($sqlMyUser);
$recUser=$sqlFUser->fetch_array();
$name=$recUser['name'];
$email=$recUser['email'];
///Get Reference Number

$sqlA2Protocol="update ".$prefix."submission  set `is_sent`='1',`CompletenessCheck`='Pending',`status`='Waiting for Committee',`updated`='$dateSubmitted',`newresubmission`='1' where id='$id' and owner_id='$asrmApplctID'";
$mysqli->query($sqlA2Protocol);

//update protocl
$sqlA2ProtocolTable="update ".$prefix."protocol  set `updated_in`=now(),`comments_response_date`=now() where id='$id' and owner_id='$asrmApplctID'";
$mysqli->query($sqlA2ProtocolTable);

$sqlA2Protocol33="update ".$prefix."study_population  set `status`='completed' where protocol_id='$id' and owner_id='$asrmApplctID'";
$mysqli->query($sqlA2Protocol33);


$sqlStageDone="update ".$prefix."submission_stages set status='completed' where `owner_id`='$asrmApplctID' and protocol_id='$id' and status='new'";
$QueryStgCompleted = $mysqli->query($sqlStageDone);


require_once("viewlrcn/mail_template_re_submission.php");

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
$mail->addCc($recchairEmail,$recOriginalNamem);//
$mail->addBcc($recemail,$recOriginalNamem);//

$mail->FromName = "$recOriginalNamem"; //From Name -- CHANGE --
$mail->AddAddress($email, $name); //To Address -- CHANGE --$email
//if($dbEmail2){echo $mail->addCc($dbEmail2,'Activation Link from UNCST');}
$mail->AddReplyTo($email, $name); //Reply-To Address -- CHANGE --$usrm_email

$mail->WordWrap = 50; // set word wrap to 50 characters
$mail->IsHTML(false); // set email format to HTML
$mail->Subject = "Completeness Check - $public_title";
$body="$allSentMessage
";
$mail->MsgHTML($body);

if(!$mail->Send()){
	echo "Mailer Error: " . $mail->ErrorInfo;
}///end

		
echo '<img src="images/loading_wait.gif">';
echo '<div class="spacer"></div>';

echo '<meta http-equiv="refresh" content="6; url='.$base_url.'/main.php?option=dashboard" />';
//$base_url/
$message="<p class='success'>Dear $name !<br><br>
Thank you for your protocol titled, '<b>$public_title</b>' Your protocol has been submitted on <b>$today</b>.<br /><br />

Your protocol reference number is <b>$ProtoclRefNo</b>. Please, use this number for all your future correspondences with the REC on this particular protocol.<br /><br />

Best Regards<br>
$contacts<br><br></p>";

}//end post
else{
	$message="<p class='red'>Dear $name !<br><br>
Your concept was not submitted, please contact administrator for details.<br></p>";
}
}

///////////////////////////////Conditional Approval
if(($rstudy['status']=='Conditional Approval' || $rstudy['status']=='Conditional Approval | Needs Minor Revisions') and $id){
require("viewlrcn/class.phpmailer.php");
require("viewlrcn/class.smtp.php"); 

//protocls
$sqlsProtocol="SELECT * FROM ".$prefix."submission where `owner_id`='$asrmApplctID' and id='$id'";
$QuerystudyProtocol = $mysqli->query($sqlsProtocol);
$rstudyProtocol = $QuerystudyProtocol->fetch_array();

if($QuerystudyProtocol->num_rows){
$submission_id=$rstudyProtocol['id'];
$public_title=$rstudyProtocol['public_title'];
$recAffiliated_id=$rstudyProtocol['recAffiliated_id'];

$sqlprotocalSubSel="SELECT * FROM ".$prefix."protocol where `owner_id`='$asrmApplctID' and id='$id'";
$QprotocalSub2Sel = $mysqli->query($sqlprotocalSubSel);
$rprotocalSub2Sel = $QprotocalSub2Sel->fetch_array();
$ProtoclRefNo=$rprotocalSub2Sel['code'];


$sqlMyrecnamew="SELECT * FROM ".$prefix."list_rec_affiliated where id='$recAffiliated_id'";
$sqlFMyreccnaw=$mysqli->query($sqlMyrecnamew);
$recNamew=$sqlFMyreccnaw->fetch_array();

$contacts=$recNamew['contacts'];
$recOriginalNamem=$recNamew['name'];
$recchairEmail=$recNamew['recchairEmail'];
$recemail=$recNamew['recemail'];
//PI Name
$sqlMyUser="SELECT * FROM ".$prefix."user where asrmApplctID='$asrmApplctID'";
$sqlFUser=$mysqli->query($sqlMyUser);
$recUser=$sqlFUser->fetch_array();
$name=$recUser['name'];
$email=$recUser['email'];
///Get Reference Number

$sqlA2Protocol="update ".$prefix."submission  set `is_sent`='1',`CompletenessCheck`='Pending',`status`='Conditional Approval | Needs Minor Revisions',`updated`='$dateSubmitted',`recstatus`='pending',`assignedto`='Not Assigned',`newresubmission`='1' where id='$id' and owner_id='$asrmApplctID'";
$mysqli->query($sqlA2Protocol);

//update protocl
$sqlA2ProtocolTable="update ".$prefix."protocol  set `revised_in`=now() where id='$id' and owner_id='$asrmApplctID'";
$mysqli->query($sqlA2ProtocolTable);

$sqlA2Protocol33="update ".$prefix."study_population  set `status`='completed' where protocol_id='$id' and owner_id='$asrmApplctID'";
$mysqli->query($sqlA2Protocol33);


$sqlStageDone="update ".$prefix."submission_stages set status='completed' where `owner_id`='$asrmApplctID' and protocol_id='$id' and status='new'";
$QueryStgCompleted = $mysqli->query($sqlStageDone);


require_once("viewlrcn/mail_template_re_submission.php");

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
$mail->addCc($recchairEmail,$recOriginalNamem);//
$mail->addBcc($recemail,$recOriginalNamem);//

$mail->FromName = "$recOriginalNamem"; //From Name -- CHANGE --
$mail->AddAddress($email, $name); //To Address -- CHANGE --$email
//if($dbEmail2){echo $mail->addCc($dbEmail2,'Activation Link from UNCST');}
$mail->AddReplyTo($email, $name); //Reply-To Address -- CHANGE --$usrm_email

$mail->WordWrap = 50; // set word wrap to 50 characters
$mail->IsHTML(false); // set email format to HTML
$mail->Subject = "Completeness Check - $public_title";
$body="$allSentMessage
";
$mail->MsgHTML($body);

if(!$mail->Send()){
	echo "Mailer Error: " . $mail->ErrorInfo;
}///end

		
echo '<img src="images/loading_wait.gif">';
echo '<div class="spacer"></div>';

echo '<meta http-equiv="refresh" content="6; url='.$base_url.'/main.php?option=dashboard" />';
//$base_url/
$message="<p class='success'>Dear $name !<br><br>
Thank you for your protocol titled, '<b>$public_title</b>' Your protocol has been submitted on <b>$today</b>.<br /><br />

Your protocol reference number is <b>$ProtoclRefNo</b>. Please, use this number for all your future correspondences with the REC on this particular protocol.<br /><br />

Best Regards<br>
$contacts<br><br></p>";

}//end post
else{
	$message="<p class='red'>Dear $name !<br><br>
Your concept was not submitted, please contact administrator for details.<br></p>";
}
}


///////////////////////////////Conditional Approval
if($rstudy['status']=='Request for Responses' and $id){
require("viewlrcn/class.phpmailer.php");
require("viewlrcn/class.smtp.php"); 

//protocls
$sqlsProtocol="SELECT * FROM ".$prefix."submission where `owner_id`='$asrmApplctID' and id='$id'";
$QuerystudyProtocol = $mysqli->query($sqlsProtocol);
$rstudyProtocol = $QuerystudyProtocol->fetch_array();

if($QuerystudyProtocol->num_rows){
$submission_id=$rstudyProtocol['id'];
$public_title=$rstudyProtocol['public_title'];
$recAffiliated_id=$rstudyProtocol['recAffiliated_id'];

$sqlprotocalSubSel="SELECT * FROM ".$prefix."protocol where `owner_id`='$asrmApplctID' and id='$id'";
$QprotocalSub2Sel = $mysqli->query($sqlprotocalSubSel);
$rprotocalSub2Sel = $QprotocalSub2Sel->fetch_array();
$ProtoclRefNo=$rprotocalSub2Sel['code'];


$sqlMyrecnamew="SELECT * FROM ".$prefix."list_rec_affiliated where id='$recAffiliated_id'";
$sqlFMyreccnaw=$mysqli->query($sqlMyrecnamew);
$recNamew=$sqlFMyreccnaw->fetch_array();

$contacts=$recNamew['contacts'];
$recOriginalNamem=$recNamew['name'];
$recchairEmail=$recNamew['recchairEmail'];
$recemail=$recNamew['recemail'];
//PI Name
$sqlMyUser="SELECT * FROM ".$prefix."user where asrmApplctID='$asrmApplctID'";
$sqlFUser=$mysqli->query($sqlMyUser);
$recUser=$sqlFUser->fetch_array();
$name=$recUser['name'];
$email=$recUser['email'];
///Get Reference Number

$sqlA2Protocol="update ".$prefix."submission  set `is_sent`='1',`CompletenessCheck`='Pending',`status`='Request for Responses',`updated`='$dateSubmitted',`recstatus`='pending',`assignedto`='Not Assigned',`newresubmission`='1' where id='$id' and owner_id='$asrmApplctID'";
$mysqli->query($sqlA2Protocol);

//update protocl
$sqlA2ProtocolTable="update ".$prefix."protocol  set `revised_in`=now() where id='$id' and owner_id='$asrmApplctID'";
$mysqli->query($sqlA2ProtocolTable);

$sqlA2Protocol33="update ".$prefix."study_population  set `status`='completed' where protocol_id='$id' and owner_id='$asrmApplctID'";
$mysqli->query($sqlA2Protocol33);


$sqlStageDone="update ".$prefix."submission_stages set status='completed' where `owner_id`='$asrmApplctID' and protocol_id='$id' and status='new'";
$QueryStgCompleted = $mysqli->query($sqlStageDone);


require_once("viewlrcn/mail_template_re_submission.php");

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
$mail->addCc($recchairEmail,$recOriginalNamem);//
$mail->addBcc($recemail,$recOriginalNamem);//

$mail->FromName = "$recOriginalNamem"; //From Name -- CHANGE --
$mail->AddAddress($email, $name); //To Address -- CHANGE --$email
//if($dbEmail2){echo $mail->addCc($dbEmail2,'Activation Link from UNCST');}
$mail->AddReplyTo($email, $name); //Reply-To Address -- CHANGE --$usrm_email

$mail->WordWrap = 50; // set word wrap to 50 characters
$mail->IsHTML(false); // set email format to HTML
$mail->Subject = "Completeness Check - $public_title";
$body="$allSentMessage
";
$mail->MsgHTML($body);

if(!$mail->Send()){
	echo "Mailer Error: " . $mail->ErrorInfo;
}///end

		
echo '<img src="images/loading_wait.gif">';
echo '<div class="spacer"></div>';

echo '<meta http-equiv="refresh" content="6; url='.$base_url.'/main.php?option=dashboard" />';
//$base_url/
$message="<p class='success'>Dear $name !<br><br>
Thank you for your protocol titled, '<b>$public_title</b>' Your protocol has been submitted on <b>$today</b>.<br /><br />

Your protocol reference number is <b>$ProtoclRefNo</b>. Please, use this number for all your future correspondences with the REC on this particular protocol.<br /><br />

Best Regards<br>
$contacts<br><br></p>";

}//end post
else{
	$message="<p class='red'>Dear $name !<br><br>
Your concept was not submitted, please contact administrator for details.<br></p>";
}
}
///////////////////////////////Conditional Approval
if($rstudy['status']=='Resubmit | Needs Major Revisions' and $id){
require("viewlrcn/class.phpmailer.php");
require("viewlrcn/class.smtp.php"); 

//protocls
$sqlsProtocol="SELECT * FROM ".$prefix."submission where `owner_id`='$asrmApplctID' and id='$id'";
$QuerystudyProtocol = $mysqli->query($sqlsProtocol);
$rstudyProtocol = $QuerystudyProtocol->fetch_array();

if($QuerystudyProtocol->num_rows){
$submission_id=$rstudyProtocol['id'];
$public_title=$rstudyProtocol['public_title'];
$recAffiliated_id=$rstudyProtocol['recAffiliated_id'];

$sqlprotocalSubSel="SELECT * FROM ".$prefix."protocol where `owner_id`='$asrmApplctID' and id='$id'";
$QprotocalSub2Sel = $mysqli->query($sqlprotocalSubSel);
$rprotocalSub2Sel = $QprotocalSub2Sel->fetch_array();
$ProtoclRefNo=$rprotocalSub2Sel['code'];


$sqlMyrecnamew="SELECT * FROM ".$prefix."list_rec_affiliated where id='$recAffiliated_id'";
$sqlFMyreccnaw=$mysqli->query($sqlMyrecnamew);
$recNamew=$sqlFMyreccnaw->fetch_array();

$contacts=$recNamew['contacts'];
$recOriginalNamem=$recNamew['name'];
$recchairEmail=$recNamew['recchairEmail'];
$recemail=$recNamew['recemail'];
//PI Name
$sqlMyUser="SELECT * FROM ".$prefix."user where asrmApplctID='$asrmApplctID'";
$sqlFUser=$mysqli->query($sqlMyUser);
$recUser=$sqlFUser->fetch_array();
$name=$recUser['name'];
$email=$recUser['email'];
///Get Reference Number

$sqlA2Protocol="update ".$prefix."submission  set `is_sent`='1',`CompletenessCheck`='Pending',`status`='Request for Responses',`updated`='$dateSubmitted',`recstatus`='pending',`assignedto`='Not Assigned',`newresubmission`='1' where id='$id' and owner_id='$asrmApplctID'";
$mysqli->query($sqlA2Protocol);

//update protocl
$sqlA2ProtocolTable="update ".$prefix."protocol  set `revised_in`=now() where id='$id' and owner_id='$asrmApplctID'";
$mysqli->query($sqlA2ProtocolTable);

$sqlA2Protocol33="update ".$prefix."study_population  set `status`='completed' where protocol_id='$id' and owner_id='$asrmApplctID'";
$mysqli->query($sqlA2Protocol33);


$sqlStageDone="update ".$prefix."submission_stages set status='completed' where `owner_id`='$asrmApplctID' and protocol_id='$id' and status='new'";
$QueryStgCompleted = $mysqli->query($sqlStageDone);


require_once("viewlrcn/mail_template_re_submission.php");

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
$mail->addCc($recchairEmail,$recOriginalNamem);//
$mail->addBcc($recemail,$recOriginalNamem);//

$mail->FromName = "$recOriginalNamem"; //From Name -- CHANGE --
$mail->AddAddress($email, $name); //To Address -- CHANGE --$email
//if($dbEmail2){echo $mail->addCc($dbEmail2,'Activation Link from UNCST');}
$mail->AddReplyTo($email, $name); //Reply-To Address -- CHANGE --$usrm_email

$mail->WordWrap = 50; // set word wrap to 50 characters
$mail->IsHTML(false); // set email format to HTML
$mail->Subject = "Completeness Check - $public_title";
$body="$allSentMessage
";
$mail->MsgHTML($body);

if(!$mail->Send()){
	echo "Mailer Error: " . $mail->ErrorInfo;
}///end

		
echo '<img src="images/loading_wait.gif">';
echo '<div class="spacer"></div>';

echo '<meta http-equiv="refresh" content="6; url='.$base_url.'/main.php?option=dashboard" />';
//$base_url/
$message="<p class='success'>Dear $name !<br><br>
Thank you for your protocol titled, '<b>$public_title</b>' Your protocol has been submitted on <b>$today</b>.<br /><br />

Your protocol reference number is <b>$ProtoclRefNo</b>. Please, use this number for all your future correspondences with the REC on this particular protocol.<br /><br />

Best Regards<br>
$contacts<br><br></p>";

}//end post
else{
	$message="<p class='red'>Dear $name !<br><br>
Your concept was not submitted, please contact administrator for details.<br></p>";
}
}

if($rstudy['status']=='Rejected' and $id){
require("viewlrcn/class.phpmailer.php");
require("viewlrcn/class.smtp.php"); 

//protocls
$sqlsProtocol="SELECT * FROM ".$prefix."submission where `owner_id`='$asrmApplctID' and id='$id'";
$QuerystudyProtocol = $mysqli->query($sqlsProtocol);
$rstudyProtocol = $QuerystudyProtocol->fetch_array();

if($QuerystudyProtocol->num_rows){
$submission_id=$rstudyProtocol['id'];
$public_title=$rstudyProtocol['public_title'];
$recAffiliated_id=$rstudyProtocol['recAffiliated_id'];

$sqlprotocalSubSel="SELECT * FROM ".$prefix."protocol where `owner_id`='$asrmApplctID' and id='$id'";
$QprotocalSub2Sel = $mysqli->query($sqlprotocalSubSel);
$rprotocalSub2Sel = $QprotocalSub2Sel->fetch_array();
$ProtoclRefNo=$rprotocalSub2Sel['code'];


$sqlMyrecnamew="SELECT * FROM ".$prefix."list_rec_affiliated where id='$recAffiliated_id'";
$sqlFMyreccnaw=$mysqli->query($sqlMyrecnamew);
$recNamew=$sqlFMyreccnaw->fetch_array();

$contacts=$recNamew['contacts'];
$recOriginalNamem=$recNamew['name'];
$recchairEmail=$recNamew['recchairEmail'];
$recemail=$recNamew['recemail'];
//PI Name
$sqlMyUser="SELECT * FROM ".$prefix."user where asrmApplctID='$asrmApplctID'";
$sqlFUser=$mysqli->query($sqlMyUser);
$recUser=$sqlFUser->fetch_array();
$name=$recUser['name'];
$email=$recUser['email'];
///Get Reference Number

$sqlA2Protocol="update ".$prefix."submission  set `is_sent`='1',`CompletenessCheck`='Pending',`status`='Request for Responses',`updated`='$dateSubmitted',`recstatus`='pending',`assignedto`='Not Assigned',`newresubmission`='1' where id='$id' and owner_id='$asrmApplctID'";
$mysqli->query($sqlA2Protocol);

//update protocl
$sqlA2ProtocolTable="update ".$prefix."protocol  set `revised_in`=now() where id='$id' and owner_id='$asrmApplctID'";
$mysqli->query($sqlA2ProtocolTable);

$sqlA2Protocol33="update ".$prefix."study_population  set `status`='completed' where protocol_id='$id' and owner_id='$asrmApplctID'";
$mysqli->query($sqlA2Protocol33);


$sqlStageDone="update ".$prefix."submission_stages set status='completed' where `owner_id`='$asrmApplctID' and protocol_id='$id' and status='new'";
$QueryStgCompleted = $mysqli->query($sqlStageDone);


require_once("viewlrcn/mail_template_re_submission.php");

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
$mail->addCc($recchairEmail,$recOriginalNamem);//
$mail->addBcc($recemail,$recOriginalNamem);//

$mail->FromName = "$recOriginalNamem"; //From Name -- CHANGE --
$mail->AddAddress($email, $name); //To Address -- CHANGE --$email
//if($dbEmail2){echo $mail->addCc($dbEmail2,'Activation Link from UNCST');}
$mail->AddReplyTo($email, $name); //Reply-To Address -- CHANGE --$usrm_email

$mail->WordWrap = 50; // set word wrap to 50 characters
$mail->IsHTML(false); // set email format to HTML
$mail->Subject = "Completeness Check - $public_title";
$body="$allSentMessage
";
$mail->MsgHTML($body);

if(!$mail->Send()){
	echo "Mailer Error: " . $mail->ErrorInfo;
}///end

		
echo '<img src="images/loading_wait.gif">';
echo '<div class="spacer"></div>';

echo '<meta http-equiv="refresh" content="6; url='.$base_url.'/main.php?option=dashboard" />';
//$base_url/
$message="<p class='success'>Dear $name !<br><br>
Thank you for your protocol titled, '<b>$public_title</b>' Your protocol has been submitted on <b>$today</b>.<br /><br />

Your protocol reference number is <b>$ProtoclRefNo</b>. Please, use this number for all your future correspondences with the REC on this particular protocol.<br /><br />

Best Regards<br>
$contacts<br><br></p>";

}//end post
else{
	$message="<p class='red'>Dear $name !<br><br>
Your concept was not submitted, please contact administrator for details.<br></p>";
}
}

echo $message;
?>
                        
</div>

<script type="text/javascript">

var countries=new ddajaxtabs("countrytabs", "countrydivcontainer")
countries.setpersist(true)
countries.setselectedClassTarget("link") //"link" or "linkparent"
countries.init()

</script>