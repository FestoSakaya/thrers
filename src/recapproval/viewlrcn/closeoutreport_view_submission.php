<ul id="countrytabs" class="shadetabs">
<li><a href="#" rel="#default" class="selected">Close Out Report View Submission</a></li>
</ul>

<div id="countrydivcontainer" style="border:0px solid gray; width:100%; margin-bottom: 1em; padding: 10px">
<?php
$sqlstudym="SELECT * FROM ".$prefix."final_reports where id='$id' order by id desc limit 0,1";
$Querystudym = $mysqli->query($sqlstudym);
$rstudym = $Querystudym->fetch_array();
$owner_id=$rstudym['owner_id'];
$protocol_idwe=$rstudym['protocol_id'];


$sqlprotocalSubSel="SELECT * FROM ".$prefix."submission where id='$protocol_idwe'";
$QprotocalSub2Sel = $mysqli->query($sqlprotocalSubSel);
$rprotocalSub2Sel = $QprotocalSub2Sel->fetch_array();

$public_title=$rprotocalSub2Sel['public_title'];

$sqlSRR = "select * from ".$prefix."user where asrmApplctID='$owner_id'";
$resultSSS = $mysqli->query($sqlSRR);
$sqUserdd = $resultSSS->fetch_array();


if($_POST['doAssignReviewes']=='Save Details'){///Add reviewers to this protccol

$asrmApplctID_user=$mysqli->real_escape_string($_POST['asrmApplctID_user']);
	$protocol_idmm=$mysqli->real_escape_string($_POST['protocol_idmm']);
	$recAffiliated_c=$mysqli->real_escape_string($_POST['recAffiliated_id']);
	$subject=$mysqli->real_escape_string("Closeout Report Review");
	$reviewtype=$mysqli->real_escape_string($_POST['reviewtype']);
	$cfnreviewer=$mysqli->real_escape_string($_POST['cfnreviewer']);

$queryConceptLogs="select * from ".$prefix."submission_review_sr where protocol_id='$protocol_idmm' and reviewer_id='$cfnreviewer'";
$rsConceptLogs=$mysqli->query($queryConceptLogs);
$rTotalConceptLogs=$rsConceptLogs->num_rows;



if($subject){
$sqlA2rr="insert into ".$prefix."submission_review_sr (`asrmApplctID`,`protocol_id`,`owner_id`,`reviewer_id`,`reviewDate`,`recstatus`,`protocolStage`,`reviewtype`,`subject`,`recAffiliated_c`,`reviewFor`,`conflictofInterest`) 

values('$cfnreviewer','$protocol_idmm','$asrmApplctID_user','$cfnreviewer',now(),'new','stage1','$reviewtype','$subject','$recAffiliated_c','CloseOutReport','none')";
$mysqli->query($sqlA2rr);
$message='<p class="success">Thank you, reviewer has been included on this protocol.</p>';
}



}

if($_POST['doAssignReviewesConfirm']=='Assign Now'){
require("viewlrcn/class.phpmailer.php");
require("viewlrcn/class.smtp.php");

foreach($_POST['reviewer'] as $cfn_reviewer) {
$cfnreviewer= $cfn_reviewer;
//First get details about this submission
$queryConceptLogs="select * from ".$prefix."submission_review_sr where id='$cfnreviewer'";
$rsConceptLogs=$mysqli->query($queryConceptLogs);
$rTotalConceptLogs=$rsConceptLogs->num_rows;
$sqSubmission = $rsConceptLogs->fetch_array();
    $assignedTo=$sqSubmission['asrmApplctID'];
	$asrmApplctID_user=$mysqli->real_escape_string($sqSubmission['owner_id']);
	$protocol_idmm=$mysqli->real_escape_string($sqSubmission['protocol_id']);
	$recAffiliated_c=$mysqli->real_escape_string($sqSubmission['recAffiliated_c']);
	$subject=$mysqli->real_escape_string($sqSubmission['subject']);
	$reviewtype=$mysqli->real_escape_string($sqSubmission['reviewtype']);
	

$sqlReviewer="SELECT * FROM ".$prefix."user  where asrmApplctID='$assignedTo'";
$QueryReviewer=$mysqli->query($sqlReviewer);
$sqReviewer = $QueryReviewer->fetch_array();
$assignedtoName=$sqReviewer['name'];
$usrm_email=$sqReviewer['email'];


	
$sqlMyrecnamew="SELECT * FROM ".$prefix."list_rec_affiliated where id='$recAffiliated_c'";
$sqlFMyreccnaw=$mysqli->query($sqlMyrecnamew);
$recNamew=$sqlFMyreccnaw->fetch_array();

	$contacts=$recNamew['contacts'];
	$recOriginalName=$recNamew['name'];

	
$usr_ip = md5($_SERVER['REMOTE_ADDR']);
$md5pass = md5($_POST['pwd']);
$host  = $_SERVER['HTTP_HOST'];
$host_upper = strtoupper($host);
$path   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');



if($rTotalConceptLogs and $subject){
$sqlA2rr="update ".$prefix."submission_review_sr set recstatus='Pending' where reviewer_id='$cfnreviewer'";
$mysqli->query($sqlA2rr); 

$update="update ".$prefix."final_reports set status='Scheduled for Review',assignedto='Assigned' where id='$id'";
$mysqli->query($update);
///Now Send mail
require_once("viewlrcn/mail_template_assign_reviewers_annualrenewal.php");
$ComponentAction="CloseOutReport";
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
//$mail->addBcc('uncstuncstapps@gmail.com',$recOriginalName);//

$mail->FromName = "REC - $recOriginalName"; //From Name -- CHANGE --
$mail->AddAddress($usrm_email, $assignedtoName); //To Address -- CHANGE --
//if($dbEmail2){echo $mail->addCc($dbEmail2,'Activation Link from UNCST');}
$mail->AddReplyTo($usrm_email, $assignedtoName); //Reply-To Address -- CHANGE --$usrm_email


$mail->WordWrap = 50; // set word wrap to 50 characters
$mail->IsHTML(false); // set email format to HTML
$mail->Subject = "$subject - Close Out Report for Review";
$body="$allSentMessage";
$mail->MsgHTML($body);

if(!$mail->Send()){
	echo "Mailer Error: " . $mail->ErrorInfo;
}///end

}
		}
$message='<p class="success">Thank you, Close Out Report has been assigned.</p>';
	echo '<img src="images/loading_wait.gif">';
echo '<div class="spacer"></div>';
echo '<meta http-equiv="refresh" content="5; url='.$base_url.'/main.php?option=MyFinalReportREC" />';
}

//////////////////////////Make Final Decision

if($_POST['doSendToEthical']=='Save Decision and Finalize Process' and $_POST['screening'] and $_POST['recruitment_status']=='Approved' and $_POST['renewal_id'] and $_POST['public_title'] and $_POST['code'] and $_POST['Meetingdate'] and $_POST['MeetingNumber']){

	$screening=$mysqli->real_escape_string($_POST['screening']);
	
	
	
require("viewlrcn/class.phpmailer.php");
require("viewlrcn/class.smtp.php");

	$asrmApplctID_user=$mysqli->real_escape_string($_POST['asrmApplctID_user']);
	$protocol_idmm=$mysqli->real_escape_string($_POST['protocol_idmm']);
	$recruitment_status=$mysqli->real_escape_string($_POST['recruitment_status']);
	$period=12;
	$submission_idm=$mysqli->real_escape_string($_POST['submission_idm']);
	$public_title=$mysqli->real_escape_string($_POST['public_title']);
	$studyRefNo=$mysqli->real_escape_string($_POST['studyRefNo']);
	$reviewer_id=$mysqli->real_escape_string($_POST['reviewer_id']);
	$riskLevel=$mysqli->real_escape_string($_POST['riskLevel']);
	$protocolCode=$mysqli->real_escape_string($_POST['code']);
	$recruitment_status=$_POST['recruitment_status'];
	$type_of_review=$mysqli->real_escape_string($_POST['type_of_review']);
	$recAffiliated_id=$mysqli->real_escape_string($_POST['recAffiliated_id']);
	$renewal_id=$mysqli->real_escape_string($_POST['renewal_id']);
	$ammendType=$mysqli->real_escape_string($_POST['ammendType']);
	$rstug_UNCSTRefNumber2=md5($mysqli->real_escape_string($_POST['code']));
	$rstug_UNCSTRefNumber=$mysqli->real_escape_string($_POST['code']);
	$MeetingNumber=$mysqli->real_escape_string($_POST['MeetingNumber']);
	$whosigns=$mysqli->real_escape_string($_POST['whosigns']);
	$Meetingdate=date("d/m/Y", strtotime($_POST['Meetingdate']));
	
	$querypUser="select * from apvr_user where asrmApplctID='$whosigns' order by asrmApplctID desc";
$cmdwUser=$mysqli->query($querypUser);
$rSwUser=$cmdwUser->fetch_array();
$signedby=$rSwUser['name'];
$signedEmail=$rSwUser['email'];
if($rSwUser['signatures']){$signature=$rSwUser['signatures'];}else{$signature="hellensignature.jpg";}
	
	$sqlInvestigators="SELECT * FROM ".$prefix."initial_committee_screening where `owner_id`='$asrmApplctID_user' and screening='$screening' and reviewer_id='$id' and reviewer_id='$asrmApplctID' order by id desc";
	$QueryInvestigators = $mysqli->query($sqlInvestigators);
	$totalInvestigators = $QueryInvestigators->num_rows;
	
		if(!$totalInvestigators){
$sqlA2="insert into ".$prefix."initial_committee_screening (`owner_id`,`protocol_id`,`created`,`updated`,`screening`,`draftopinion`,`recAffiliated_id`,`reviewer_id`,`screeningFor`,`completionStatus`,`collectiveDecision`,`ammendType`,`renewal_id`,`public_title`) 

values('$asrmApplctID_user','$protocol_idmm',now(),now(),'$screening','$draftopinion2','$recAffiliated_id','$asrmApplctID','CloseOutReport','Completed','Yes','$ammendType','$renewal_id','$public_title')";
$mysqli->query($sqlA2);
		}
		//////////////////////////Save Decision and Finalize Process send email
	//sleep(50);	
	////Get Protocl Comments
$sqlSComments = "select * from ".$prefix."initial_committee_screening where reviewer_id='$id' and owner_id='$asrmApplctID_user' and screeningFor='CloseOutReport'";
$resComments = $mysqli->query($sqlSComments);
while($sqComments = $resComments->fetch_array()){
$screeningmessage.=$sqComments['screening'].'<br>';
}	
		
///Get this meeting Number
$sqlSmeeting = "select * from ".$prefix."meeting where protocol_id='$protocol_idmm' and meetingFor='CloseOutReport' order by id desc";
$resmeeting = $mysqli->query($sqlSmeeting);
$sqmeeting = $resmeeting->fetch_array();
$MeetingNumber=$sqmeeting['id'];
//$Meetingdate=date("d/m/Y", strtotime($sqmeeting['date']));

$sqlSRecruitment = "select * from ".$prefix."decision_status where id='$recruitment_status'";
$resRecruitment = $mysqli->query($sqlSRecruitment);
$sqRecruitment = $resRecruitment->fetch_array();

$status=$sqRecruitment['name'];
$Approvaltoday=date("d/m/Y");
$dateSubmitted=date("Y-m-d G:i:s");
//Get Approval period
$Approvaltoday;
$endofproject = date("d/m/Y", strtotime($dateSubmitted . "+12 month"));	

$sqlMyrecnamew="SELECT * FROM ".$prefix."list_rec_affiliated where id='$recAffiliated_id'";
$sqlFMyreccnaw=$mysqli->query($sqlMyrecnamew);
$recNamew=$sqlFMyreccnaw->fetch_array();

	$contacts=$recNamew['contacts'];
	$recOriginalName=$recNamew['name'];
	$recchairEmail=$recNamew['recchairEmail'];
	$recemail=$recNamew['recemail'];
	$accroname=$recNamew['accroname'];
	$rec_header=$recNamew['recheader'];
	
	//Get Protocol Owner
$sqlSOwner = "select * from ".$prefix."user where asrmApplctID='$asrmApplctID_user'";
$resOwner = $mysqli->query($sqlSOwner);
$sqOwner = $resOwner->fetch_array();
$owneremail=$sqOwner['email'];
$ownername=$sqOwner['name'];
$institution=$sqOwner['institution'];
$phone=$sqOwner['phone'];
///Which admin has reviewed this protocol
$sqlSReviewer = "select * from ".$prefix."user where asrmApplctID='$reviewer_id'";
$resReviewer = $mysqli->query($sqlSReviewer);
$sqReviewer = $resReviewer->fetch_array();
$ReviewerName=$sqReviewer['name'];
$reviewerTitle=$sqReviewer['reviewerTitle'];
////Now send email
$sqlA2="update ".$prefix."final_reports set `status`='$recruitment_status' where id='$id'";
$mysqli->query($sqlA2);


$emailMessage="<p>I am pleased to inform you that at the <strong>$MeetingNumber</strong> convened meeting on <strong>$Meetingdate,</strong> the $recOriginalName reviewed the Close out Report to the  above referenced study and found it satisfactory.</p>";

require_once("viewlrcn/mail_template_approval_closeoutreport.php");
$whatApproved="Close Out Report";
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
///////////Send copy to UNCST Research
//mmmmm///$mail->addCc($recchairEmail,"$recOriginalName - Chairman"); //REC Chair
//$mail->addBcc("uncstuncstapps@gmail.com","$recOriginalName - REC Approval Notice");//$recchairEmail
$mail->FromName = "$recOriginalName"; //From Name -- CHANGE --
$mail->AddAddress($owneremail, $ownername); //
$mail->AddReplyTo($recemail, $ownername); //Reply-To Address -- CHANGE --$usrm_email

$mail->WordWrap = 50; // set word wrap to 50 characters
$mail->IsHTML(false); // set email format to HTML
$mail->Subject = "Closeout Report - $public_title";
$body="$allSentMessage
<br><br>
<a href='$base_url/closeoutreport.php?rmd_id=$rstug_UNCSTRefNumber2' style='background:#06F; border: none;  color: white; padding: 15px 32px;  text-align: center;  text-decoration: none;  display: inline-block; font-size: 16px;' target='_blank'>Download/Print PDF</a>";

$mail->MsgHTML($body);

if(!$mail->Send()){
	echo "Mailer Error: " . $mail->ErrorInfo;
}///end	

$messageSent="I am pleased to inform you that at the <strong>$MeetingNumber</strong> convened meeting on <strong>$Meetingdate,</strong> the $recOriginalName reviewed the Close out Report to the  above referenced study and found it satisfactory.";

require_once("./viewlrcn/send_close_out_text.php");

 $queryp2w="select * from ".$prefix."study_post_approvals where rmd_id='$rstug_UNCSTRefNumber2' order by id desc";
$cmdw2=$mysqli->query($queryp2w);
if(!$cmdw2->num_rows){
$Insert_sendAp="insert into ".$prefix."study_post_approvals (`rstug_user_id`,`rstug_rsch_project_id`,`refNo`,`approvalMain`,`approvalText1`,`approvalText2`,`approvalText3`,`dateupdated`,`rmd_id`,`signature`,`totaldocs`,`DateApproved`,`studyTools`,`whosigns`,`renewal_id`,`public_title`,`recAffiliated_id`,`ptype`) values ('$asrmApplctID_user','$protocol_idmm','$protocolCode','$sendTextHr','$sendText1','$sendText2','$sendText3',now(),'$rstug_UNCSTRefNumber2','$signature','$nummm','$sendTextDate','$sendTextStudyTools','$whosigns','$renewal_id','$public_title','$recAffiliated_id','CloseOutReport')";
$mysqli->query($Insert_sendAp);
}

if($cmdw2->num_rows){
$Insert_sendAp2="update ".$prefix."study_post_approvals set `approvalMain`='$sendTextHr',`approvalText1`='$sendText1',`approvalText2`='$sendText2',`approvalText3`='$sendText3',`dateupdated`=now(),`signature`='$signature',`totaldocs`='$nummm',`DateApproved`='$sendTextDate',`studyTools`='$sendTextStudyTools',`whosigns`='$whosigns',`renewal_id`='$renewal_id',`public_title`='$public_title',`recAffiliated_id`='$recAffiliated_id',`ptype`='CloseOutReport' where rmd_id='$rstug_UNCSTRefNumber2'";
$mysqli->query($Insert_sendAp2);	
}
///Send mail with comments to the PI

$msg="REC CLOSEOUT REPORT: Dear $ownername, your protocol RefNo $protocolCode has been reviewed, check your email for more details. $accroname. ";//

echo '<img src="images/loading_wait.gif">';
echo '<div class="spacer"></div>';
echo '<meta http-equiv="refresh" content="5; url='.$base_url.'/main.php?option=MyFinalReportREC" />';
		
}////End Approvals, rejects







if($_POST['doSendToEthical']=='Save Decision and Finalize Process' and $_POST['screening'] and ($_POST['recruitment_status']=='Rejected' || $_POST['recruitment_status']=='Resubmit | Needs Major Revisions') and $_POST['renewal_id'] and $_POST['public_title'] and $_POST['code'] and $_POST['Meetingdate'] and $_POST['MeetingNumber']){

	$screening=$mysqli->real_escape_string($_POST['screening']);
	
	
	
require("viewlrcn/class.phpmailer.php");
require("viewlrcn/class.smtp.php");

	$asrmApplctID_user=$mysqli->real_escape_string($_POST['asrmApplctID_user']);
	$protocol_idmm=$mysqli->real_escape_string($_POST['protocol_idmm']);
	$recruitment_status=$mysqli->real_escape_string($_POST['recruitment_status']);
	$period=12;
	$submission_idm=$mysqli->real_escape_string($_POST['submission_idm']);
	$public_title=$mysqli->real_escape_string($_POST['public_title']);
	$studyRefNo=$mysqli->real_escape_string($_POST['studyRefNo']);
	$reviewer_id=$mysqli->real_escape_string($_POST['reviewer_id']);
	$riskLevel=$mysqli->real_escape_string($_POST['riskLevel']);
	$protocolCode=$mysqli->real_escape_string($_POST['code']);
	$recruitment_status=$_POST['recruitment_status'];
	$type_of_review=$mysqli->real_escape_string($_POST['type_of_review']);
	$recAffiliated_id=$mysqli->real_escape_string($_POST['recAffiliated_id']);
	$renewal_id=$mysqli->real_escape_string($_POST['renewal_id']);
	$ammendType=$mysqli->real_escape_string($_POST['ammendType']);
	$rstug_UNCSTRefNumber2=md5($mysqli->real_escape_string($_POST['code']));
	$rstug_UNCSTRefNumber=$mysqli->real_escape_string($_POST['code']);
	$MeetingNumber=$mysqli->real_escape_string($_POST['MeetingNumber']);
	$whosigns=$mysqli->real_escape_string($_POST['whosigns']);
	$Meetingdate=date("d/m/Y", strtotime($_POST['Meetingdate']));
	
	$querypUser="select * from apvr_user where asrmApplctID='$whosigns' order by asrmApplctID desc";
$cmdwUser=$mysqli->query($querypUser);
$rSwUser=$cmdwUser->fetch_array();
$signedby=$rSwUser['name'];
$signedEmail=$rSwUser['email'];
if($rSwUser['signatures']){$signature=$rSwUser['signatures'];}else{$signature="hellensignature.jpg";}
	
	$sqlInvestigators="SELECT * FROM ".$prefix."initial_committee_screening where `owner_id`='$asrmApplctID_user' and screening='$screening' and reviewer_id='$id' and reviewer_id='$asrmApplctID' order by id desc";
	$QueryInvestigators = $mysqli->query($sqlInvestigators);
	$totalInvestigators = $QueryInvestigators->num_rows;
	
		if(!$totalInvestigators){
$sqlA2="insert into ".$prefix."initial_committee_screening (`owner_id`,`protocol_id`,`created`,`updated`,`screening`,`draftopinion`,`recAffiliated_id`,`reviewer_id`,`screeningFor`,`completionStatus`,`collectiveDecision`,`ammendType`,`renewal_id`,`public_title`) 

values('$asrmApplctID_user','$protocol_idmm',now(),now(),'$screening','$draftopinion2','$recAffiliated_id','$asrmApplctID','CloseOutReport','Completed','Yes','$ammendType','$id','$public_title')";
$mysqli->query($sqlA2);
		}
		//////////////////////////Save Decision and Finalize Process send email
	//sleep(50);	
	////Get Protocl Comments
$sqlSComments = "select * from ".$prefix."initial_committee_screening where reviewer_id='$id' and owner_id='$asrmApplctID_user' and screeningFor='CloseOutReport'";
$resComments = $mysqli->query($sqlSComments);
while($sqComments = $resComments->fetch_array()){
$screeningmessage.=$sqComments['screening'].'<br>';
}	
		
///Get this meeting Number
$sqlSmeeting = "select * from ".$prefix."meeting where protocol_id='$protocol_idmm' and meetingFor='CloseOutReport' order by id desc";
$resmeeting = $mysqli->query($sqlSmeeting);
$sqmeeting = $resmeeting->fetch_array();
$MeetingNumber=$sqmeeting['id'];
//$Meetingdate=date("d/m/Y", strtotime($sqmeeting['date']));

$sqlSRecruitment = "select * from ".$prefix."decision_status where id='$recruitment_status'";
$resRecruitment = $mysqli->query($sqlSRecruitment);
$sqRecruitment = $resRecruitment->fetch_array();

$status=$sqRecruitment['name'];
$Approvaltoday=date("d/m/Y");
$dateSubmitted=date("Y-m-d G:i:s");
//Get Approval period
$Approvaltoday;
$endofproject = date("d/m/Y", strtotime($dateSubmitted . "+12 month"));	

$sqlMyrecnamew="SELECT * FROM ".$prefix."list_rec_affiliated where id='$recAffiliated_id'";
$sqlFMyreccnaw=$mysqli->query($sqlMyrecnamew);
$recNamew=$sqlFMyreccnaw->fetch_array();

	$contacts=$recNamew['contacts'];
	$recOriginalName=$recNamew['name'];
	$recchairEmail=$recNamew['recchairEmail'];
	$recemail=$recNamew['recemail'];
	$accroname=$recNamew['accroname'];
	$rec_header=$recNamew['recheader'];
	
	//Get Protocol Owner
$sqlSOwner = "select * from ".$prefix."user where asrmApplctID='$asrmApplctID_user'";
$resOwner = $mysqli->query($sqlSOwner);
$sqOwner = $resOwner->fetch_array();
$owneremail=$sqOwner['email'];
$ownername=$sqOwner['name'];
$institution=$sqOwner['institution'];
$phone=$sqOwner['phone'];
///Which admin has reviewed this protocol
$sqlSReviewer = "select * from ".$prefix."user where asrmApplctID='$reviewer_id'";
$resReviewer = $mysqli->query($sqlSReviewer);
$sqReviewer = $resReviewer->fetch_array();
$ReviewerName=$sqReviewer['name'];
$reviewerTitle=$sqReviewer['reviewerTitle'];
////Now send email
$sqlA2="update ".$prefix."final_reports set `status`='$recruitment_status' where id='$id'";
$mysqli->query($sqlA2);

$emailMessage="This is to inform you that the <b>$recOriginalName</b> at its <strong>$MeetingNumber</strong> held on <b>$Meetingdate</b> reviewed the Closeout Report of the above-named study. The committee noted the following that need to be addressed;<br><br>
<p>$screeningmessage</p>";

require_once("viewlrcn/mail_template_approval_closeoutreport.php");
$whatApproved="Close Out Report";
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
///////////Send copy to UNCST Research
//mmmmm///$mail->addCc($recchairEmail,"$recOriginalName - Chairman"); //REC Chair
//$mail->addBcc("uncstuncstapps@gmail.com","$recOriginalName - REC Revisions Notice");//$recchairEmail
$mail->FromName = "$recOriginalName"; //From Name -- CHANGE --
$mail->AddAddress($owneremail, $ownername); //
$mail->AddReplyTo($recemail, $ownername); //Reply-To Address -- CHANGE --$usrm_email


$mail->WordWrap = 50; // set word wrap to 50 characters
$mail->IsHTML(false); // set email format to HTML
$mail->Subject = "Closeout Report - $public_title";
$body="$allSentMessage
<br><br>
<a href='$base_url/closeoutreport.php?rmd_id=$rstug_UNCSTRefNumber2' style='background:#06F; border: none;  color: white; padding: 15px 32px;  text-align: center;  text-decoration: none;  display: inline-block; font-size: 16px;' target='_blank'>Download/Print PDF</a>";

$mail->MsgHTML($body);

if(!$mail->Send()){
	echo "Mailer Error: " . $mail->ErrorInfo;
}///end	

$messageSent="This is to inform you that the <b>$recOriginalName</b> at its <strong>$MeetingNumber</strong> held on <b>$Meetingdate</b> reviewed the Closeout Report of the above-named study. The committee noted the following that need to be addressed;<br><br><p>$screeningmessage</p>";

require_once("./viewlrcn/send_close_out_text.php");

 $queryp2w="select * from ".$prefix."study_post_approvals where rmd_id='$rstug_UNCSTRefNumber2' order by id desc";
$cmdw2=$mysqli->query($queryp2w);
if(!$cmdw2->num_rows){
$Insert_sendAp="insert into ".$prefix."study_post_approvals (`rstug_user_id`,`rstug_rsch_project_id`,`refNo`,`approvalMain`,`approvalText1`,`approvalText2`,`approvalText3`,`dateupdated`,`rmd_id`,`signature`,`totaldocs`,`DateApproved`,`studyTools`,`whosigns`,`renewal_id`,`public_title`,`recAffiliated_id`,`ptype`) values ('$asrmApplctID_user','$protocol_idmm','$protocolCode','$sendTextHr','$sendText1','$sendText2','$sendText3',now(),'$rstug_UNCSTRefNumber2','$signature','$nummm','$sendTextDate','$sendTextStudyTools','$whosigns','$renewal_id','$public_title','$recAffiliated_id','CloseOutReport')";
$mysqli->query($Insert_sendAp);
}

if($cmdw2->num_rows){
$Insert_sendAp2="update ".$prefix."study_post_approvals set `approvalMain`='$sendTextHr',`approvalText1`='$sendText1',`approvalText2`='$sendText2',`approvalText3`='$sendText3',`dateupdated`=now(),`signature`='$signature',`totaldocs`='$nummm',`DateApproved`='$sendTextDate',`studyTools`='$sendTextStudyTools',`whosigns`='$whosigns',`renewal_id`='$renewal_id',`public_title`='$public_title',`recAffiliated_id`='$recAffiliated_id',`ptype`='CloseOutReport' where rmd_id='$rstug_UNCSTRefNumber2'";
$mysqli->query($Insert_sendAp2);	
}
///Send mail with comments to the PI

$msg="REC CLOSEOUT REPORT: Dear $ownername, your protocol RefNo $protocolCode has been reviewed, check your email for more details. $accroname. ";//

echo '<img src="images/loading_wait.gif">';
echo '<div class="spacer"></div>';
echo '<meta http-equiv="refresh" content="5; url='.$base_url.'/main.php?option=MyFinalReportREC" />';
		
}////End Approvals, rejects




if($_POST['doSendToEthical']=='Save Decision and Finalize Process' and $_POST['screening'] and ($_POST['recruitment_status']=='Conditional Approval | Needs Minor Revisions') and $_POST['renewal_id'] and $_POST['public_title'] and $_POST['code'] and $_POST['Meetingdate'] and $_POST['MeetingNumber']){

	$screening=$mysqli->real_escape_string($_POST['screening']);
	
	
	
require("viewlrcn/class.phpmailer.php");
require("viewlrcn/class.smtp.php");

	$asrmApplctID_user=$mysqli->real_escape_string($_POST['asrmApplctID_user']);
	$protocol_idmm=$mysqli->real_escape_string($_POST['protocol_idmm']);
	$recruitment_status=$mysqli->real_escape_string($_POST['recruitment_status']);
	$period=12;
	$submission_idm=$mysqli->real_escape_string($_POST['submission_idm']);
	$public_title=$mysqli->real_escape_string($_POST['public_title']);
	$studyRefNo=$mysqli->real_escape_string($_POST['studyRefNo']);
	$reviewer_id=$mysqli->real_escape_string($_POST['reviewer_id']);
	$riskLevel=$mysqli->real_escape_string($_POST['riskLevel']);
	$protocolCode=$mysqli->real_escape_string($_POST['code']);
	$recruitment_status=$_POST['recruitment_status'];
	$type_of_review=$mysqli->real_escape_string($_POST['type_of_review']);
	$recAffiliated_id=$mysqli->real_escape_string($_POST['recAffiliated_id']);
	$renewal_id=$mysqli->real_escape_string($_POST['renewal_id']);
	$ammendType=$mysqli->real_escape_string($_POST['ammendType']);
	$rstug_UNCSTRefNumber2=md5($mysqli->real_escape_string($_POST['code']));
	$rstug_UNCSTRefNumber=$mysqli->real_escape_string($_POST['code']);
	$MeetingNumber=$mysqli->real_escape_string($_POST['MeetingNumber']);
	$whosigns=$mysqli->real_escape_string($_POST['whosigns']);
	$Meetingdate=date("d/m/Y", strtotime($_POST['Meetingdate']));
	
	$querypUser="select * from apvr_user where asrmApplctID='$whosigns' order by asrmApplctID desc";
$cmdwUser=$mysqli->query($querypUser);
$rSwUser=$cmdwUser->fetch_array();
$signedby=$rSwUser['name'];
$signedEmail=$rSwUser['email'];
if($rSwUser['signatures']){$signature=$rSwUser['signatures'];}else{$signature="hellensignature.jpg";}
	
	$sqlInvestigators="SELECT * FROM ".$prefix."initial_committee_screening where `owner_id`='$asrmApplctID_user' and screening='$screening' and reviewer_id='$id' and reviewer_id='$asrmApplctID' order by id desc";
	$QueryInvestigators = $mysqli->query($sqlInvestigators);
	$totalInvestigators = $QueryInvestigators->num_rows;
	
		if(!$totalInvestigators){
$sqlA2="insert into ".$prefix."initial_committee_screening (`owner_id`,`protocol_id`,`created`,`updated`,`screening`,`draftopinion`,`recAffiliated_id`,`reviewer_id`,`screeningFor`,`completionStatus`,`collectiveDecision`,`ammendType`,`renewal_id`,`public_title`) 

values('$asrmApplctID_user','$protocol_idmm',now(),now(),'$screening','$draftopinion2','$recAffiliated_id','$asrmApplctID','CloseOutReport','Completed','Yes','$ammendType','$id','$public_title')";
$mysqli->query($sqlA2);
		}
		//////////////////////////Save Decision and Finalize Process send email
	//sleep(50);	
	////Get Protocl Comments
$sqlSComments = "select * from ".$prefix."initial_committee_screening where reviewer_id='$id' and owner_id='$asrmApplctID_user' and screeningFor='CloseOutReport'";
$resComments = $mysqli->query($sqlSComments);
while($sqComments = $resComments->fetch_array()){
$screeningmessage.=$sqComments['screening'].'<br>';
}	
		
///Get this meeting Number
$sqlSmeeting = "select * from ".$prefix."meeting where protocol_id='$protocol_idmm' and meetingFor='CloseOutReport' order by id desc";
$resmeeting = $mysqli->query($sqlSmeeting);
$sqmeeting = $resmeeting->fetch_array();
$MeetingNumber=$sqmeeting['id'];
//$Meetingdate=date("d/m/Y", strtotime($sqmeeting['date']));

$sqlSRecruitment = "select * from ".$prefix."decision_status where id='$recruitment_status'";
$resRecruitment = $mysqli->query($sqlSRecruitment);
$sqRecruitment = $resRecruitment->fetch_array();

$status=$sqRecruitment['name'];
$Approvaltoday=date("d/m/Y");
$dateSubmitted=date("Y-m-d G:i:s");
//Get Approval period
$Approvaltoday;
$endofproject = date("d/m/Y", strtotime($dateSubmitted . "+12 month"));	

$sqlMyrecnamew="SELECT * FROM ".$prefix."list_rec_affiliated where id='$recAffiliated_id'";
$sqlFMyreccnaw=$mysqli->query($sqlMyrecnamew);
$recNamew=$sqlFMyreccnaw->fetch_array();

	$contacts=$recNamew['contacts'];
	$recOriginalName=$recNamew['name'];
	$recchairEmail=$recNamew['recchairEmail'];
	$recemail=$recNamew['recemail'];
	$accroname=$recNamew['accroname'];
	$rec_header=$recNamew['recheader'];
	
	//Get Protocol Owner
$sqlSOwner = "select * from ".$prefix."user where asrmApplctID='$asrmApplctID_user'";
$resOwner = $mysqli->query($sqlSOwner);
$sqOwner = $resOwner->fetch_array();
$owneremail=$sqOwner['email'];
$ownername=$sqOwner['name'];
$institution=$sqOwner['institution'];
$phone=$sqOwner['phone'];
///Which admin has reviewed this protocol
$sqlSReviewer = "select * from ".$prefix."user where asrmApplctID='$reviewer_id'";
$resReviewer = $mysqli->query($sqlSReviewer);
$sqReviewer = $resReviewer->fetch_array();
$ReviewerName=$sqReviewer['name'];
$reviewerTitle=$sqReviewer['reviewerTitle'];
////Now send email
$sqlA2="update ".$prefix."final_reports set `status`='$recruitment_status' where id='$id'";
$mysqli->query($sqlA2);

$emailMessage="<p>This is to inform you that the <b>$recOriginalName</b> held on <b>$Meetingdate</b> reviewed closeout report of the above-named study and granted conditional approval. The committee however noted the following that need to be addressed;</p>";

require_once("viewlrcn/mail_template_approval_closeoutreport.php");
$whatApproved="Close Out Report";
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
///////////Send copy to UNCST Research
//mmmmm///$mail->addCc($recchairEmail,"$recOriginalName - Chairman"); //REC Chair
//$mail->addBcc("uncstuncstapps@gmail.com","$recOriginalName - REC Revisions Notice");//$recchairEmail
$mail->FromName = "$recOriginalName"; //From Name -- CHANGE --
$mail->AddAddress($owneremail, $ownername); //
$mail->AddReplyTo($recemail, $ownername); //Reply-To Address -- CHANGE --$usrm_email


$mail->WordWrap = 50; // set word wrap to 50 characters
$mail->IsHTML(false); // set email format to HTML
$mail->Subject = "Closeout Report - $public_title";
$body="$allSentMessage
<br><br>
<a href='$base_url/closeoutreport.php?rmd_id=$rstug_UNCSTRefNumber2' style='background:#06F; border: none;  color: white; padding: 15px 32px;  text-align: center;  text-decoration: none;  display: inline-block; font-size: 16px;' target='_blank'>Download/Print PDF</a>";

$mail->MsgHTML($body);

if(!$mail->Send()){
	echo "Mailer Error: " . $mail->ErrorInfo;
}///end	

$messageSent="<p>This is to inform you that the <b>$recOriginalName</b> held on <b>$Meetingdate</b> reviewed closeout report of the above-named study and granted conditional approval. The committee however noted the following that need to be addressed;</p>";

require_once("./viewlrcn/send_close_out_text.php");

 $queryp2w="select * from ".$prefix."study_post_approvals where rmd_id='$rstug_UNCSTRefNumber2' order by id desc";
$cmdw2=$mysqli->query($queryp2w);
if(!$cmdw2->num_rows){
$Insert_sendAp="insert into ".$prefix."study_post_approvals (`rstug_user_id`,`rstug_rsch_project_id`,`refNo`,`approvalMain`,`approvalText1`,`approvalText2`,`approvalText3`,`dateupdated`,`rmd_id`,`signature`,`totaldocs`,`DateApproved`,`studyTools`,`whosigns`,`renewal_id`,`public_title`,`recAffiliated_id`,`ptype`) values ('$asrmApplctID_user','$protocol_idmm','$protocolCode','$sendTextHr','$sendText1','$sendText2','$sendText3',now(),'$rstug_UNCSTRefNumber2','$signature','$nummm','$sendTextDate','$sendTextStudyTools','$whosigns','$renewal_id','$public_title','$recAffiliated_id','CloseOutReport')";
$mysqli->query($Insert_sendAp);
}

if($cmdw2->num_rows){
$Insert_sendAp2="update ".$prefix."study_post_approvals set `approvalMain`='$sendTextHr',`approvalText1`='$sendText1',`approvalText2`='$sendText2',`approvalText3`='$sendText3',`dateupdated`=now(),`signature`='$signature',`totaldocs`='$nummm',`DateApproved`='$sendTextDate',`studyTools`='$sendTextStudyTools',`whosigns`='$whosigns',`renewal_id`='$renewal_id',`public_title`='$public_title',`recAffiliated_id`='$recAffiliated_id',`ptype`='CloseOutReport' where rmd_id='$rstug_UNCSTRefNumber2'";
$mysqli->query($Insert_sendAp2);	
}
///Send mail with comments to the PI

$msg="REC CLOSEOUT REPORT: Dear $ownername, your protocol RefNo $protocolCode has been reviewed, check your email for more details. $accroname. ";//

echo '<img src="images/loading_wait.gif">';
echo '<div class="spacer"></div>';
echo '<meta http-equiv="refresh" content="5; url='.$base_url.'/main.php?option=MyFinalReportREC" />';
		
}////End Approvals, rejects







if($_POST['doSendToEthical']=='Save Decision and Finalize Process' and $_POST['screening'] and ($_POST['recruitment_status']=='Request for Responses') and $_POST['renewal_id'] and $_POST['public_title'] and $_POST['code'] and $_POST['Meetingdate'] and $_POST['MeetingNumber']){

	$screening=$mysqli->real_escape_string($_POST['screening']);
	
	
	
require("viewlrcn/class.phpmailer.php");
require("viewlrcn/class.smtp.php");

	$asrmApplctID_user=$mysqli->real_escape_string($_POST['asrmApplctID_user']);
	$protocol_idmm=$mysqli->real_escape_string($_POST['protocol_idmm']);
	$recruitment_status=$mysqli->real_escape_string($_POST['recruitment_status']);
	$period=12;
	$submission_idm=$mysqli->real_escape_string($_POST['submission_idm']);
	$public_title=$mysqli->real_escape_string($_POST['public_title']);
	$studyRefNo=$mysqli->real_escape_string($_POST['studyRefNo']);
	$reviewer_id=$mysqli->real_escape_string($_POST['reviewer_id']);
	$riskLevel=$mysqli->real_escape_string($_POST['riskLevel']);
	$protocolCode=$mysqli->real_escape_string($_POST['code']);
	$recruitment_status=$_POST['recruitment_status'];
	$type_of_review=$mysqli->real_escape_string($_POST['type_of_review']);
	$recAffiliated_id=$mysqli->real_escape_string($_POST['recAffiliated_id']);
	$renewal_id=$mysqli->real_escape_string($_POST['renewal_id']);
	$ammendType=$mysqli->real_escape_string($_POST['ammendType']);
	$rstug_UNCSTRefNumber2=md5($mysqli->real_escape_string($_POST['code']));
	$rstug_UNCSTRefNumber=$mysqli->real_escape_string($_POST['code']);
	$MeetingNumber=$mysqli->real_escape_string($_POST['MeetingNumber']);
	$whosigns=$mysqli->real_escape_string($_POST['whosigns']);
	$Meetingdate=date("d/m/Y", strtotime($_POST['Meetingdate']));
	
	$querypUser="select * from apvr_user where asrmApplctID='$whosigns' order by asrmApplctID desc";
$cmdwUser=$mysqli->query($querypUser);
$rSwUser=$cmdwUser->fetch_array();
$signedby=$rSwUser['name'];
$signedEmail=$rSwUser['email'];
if($rSwUser['signatures']){$signature=$rSwUser['signatures'];}else{$signature="hellensignature.jpg";}
	
	$sqlInvestigators="SELECT * FROM ".$prefix."initial_committee_screening where `owner_id`='$asrmApplctID_user' and screening='$screening' and reviewer_id='$id' and reviewer_id='$asrmApplctID' order by id desc";
	$QueryInvestigators = $mysqli->query($sqlInvestigators);
	$totalInvestigators = $QueryInvestigators->num_rows;
	
		if(!$totalInvestigators){
$sqlA2="insert into ".$prefix."initial_committee_screening (`owner_id`,`protocol_id`,`created`,`updated`,`screening`,`draftopinion`,`recAffiliated_id`,`reviewer_id`,`screeningFor`,`completionStatus`,`collectiveDecision`,`ammendType`,`renewal_id`,`public_title`) 

values('$asrmApplctID_user','$protocol_idmm',now(),now(),'$screening','$draftopinion2','$recAffiliated_id','$asrmApplctID','CloseOutReport','Completed','Yes','$ammendType','$id','$public_title')";
$mysqli->query($sqlA2);
		}
		//////////////////////////Save Decision and Finalize Process send email
	//sleep(50);	
	////Get Protocl Comments
$sqlSComments = "select * from ".$prefix."initial_committee_screening where reviewer_id='$id' and owner_id='$asrmApplctID_user' and screeningFor='CloseOutReport'";
$resComments = $mysqli->query($sqlSComments);
while($sqComments = $resComments->fetch_array()){
$screeningmessage.=$sqComments['screening'].'<br>';
}	
		
///Get this meeting Number
$sqlSmeeting = "select * from ".$prefix."meeting where protocol_id='$protocol_idmm' and meetingFor='CloseOutReport' order by id desc";
$resmeeting = $mysqli->query($sqlSmeeting);
$sqmeeting = $resmeeting->fetch_array();
$MeetingNumber=$sqmeeting['id'];
//$Meetingdate=date("d/m/Y", strtotime($sqmeeting['date']));

$sqlSRecruitment = "select * from ".$prefix."decision_status where id='$recruitment_status'";
$resRecruitment = $mysqli->query($sqlSRecruitment);
$sqRecruitment = $resRecruitment->fetch_array();

$status=$sqRecruitment['name'];
$Approvaltoday=date("d/m/Y");
$dateSubmitted=date("Y-m-d G:i:s");
//Get Approval period
$Approvaltoday;
$endofproject = date("d/m/Y", strtotime($dateSubmitted . "+12 month"));	

$sqlMyrecnamew="SELECT * FROM ".$prefix."list_rec_affiliated where id='$recAffiliated_id'";
$sqlFMyreccnaw=$mysqli->query($sqlMyrecnamew);
$recNamew=$sqlFMyreccnaw->fetch_array();

	$contacts=$recNamew['contacts'];
	$recOriginalName=$recNamew['name'];
	$recchairEmail=$recNamew['recchairEmail'];
	$recemail=$recNamew['recemail'];
	$accroname=$recNamew['accroname'];
	$rec_header=$recNamew['recheader'];
	
	//Get Protocol Owner
$sqlSOwner = "select * from ".$prefix."user where asrmApplctID='$asrmApplctID_user'";
$resOwner = $mysqli->query($sqlSOwner);
$sqOwner = $resOwner->fetch_array();
$owneremail=$sqOwner['email'];
$ownername=$sqOwner['name'];
$institution=$sqOwner['institution'];
$phone=$sqOwner['phone'];
///Which admin has reviewed this protocol
$sqlSReviewer = "select * from ".$prefix."user where asrmApplctID='$reviewer_id'";
$resReviewer = $mysqli->query($sqlSReviewer);
$sqReviewer = $resReviewer->fetch_array();
$ReviewerName=$sqReviewer['name'];
$reviewerTitle=$sqReviewer['reviewerTitle'];
////Now send email
$sqlA2="update ".$prefix."final_reports set `status`='$recruitment_status' where id='$id'";
$mysqli->query($sqlA2);

$emailMessage="This is to inform you that the <b>$recOriginalName</b> at its <strong>$MeetingNumber</strong> held on <b>$Meetingdate</b> reviewed the Closeout Report of the above-named study. The committee noted the following that need to be addressed;<br><br>
$screeningmessage<br><br>
	
Note: You are requested to address the above comments within 4 weeks<br>";

require_once("viewlrcn/mail_template_approval_closeoutreport.php");
$whatApproved="Close Out Report";
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
///////////Send copy to UNCST Research
//mmmmm///$mail->addCc($recchairEmail,"$recOriginalName - Chairman"); //REC Chair
$mail->addBcc("uncstuncstapps@gmail.com","$recOriginalName - REC Responses Notice");//$recchairEmail
$mail->FromName = "$recOriginalName"; //From Name -- CHANGE --
$mail->AddAddress($owneremail, $ownername); //
$mail->AddReplyTo($recemail, $ownername); //Reply-To Address -- CHANGE --$usrm_email

$mail->WordWrap = 50; // set word wrap to 50 characters
$mail->IsHTML(false); // set email format to HTML
$mail->Subject = "Closeout Report - $public_title";
$body="$allSentMessage
<br><br>
<a href='$base_url/closeoutreport.php?rmd_id=$rstug_UNCSTRefNumber2' style='background:#06F; border: none;  color: white; padding: 15px 32px;  text-align: center;  text-decoration: none;  display: inline-block; font-size: 16px;' target='_blank'>Download/Print PDF</a>";

$mail->MsgHTML($body);

if(!$mail->Send()){
	echo "Mailer Error: " . $mail->ErrorInfo;
}///end	


$messageSent="This is to inform you that the <b>$recOriginalName</b> at its <strong>$MeetingNumber</strong> held on <b>$Meetingdate</b> reviewed the Closeout Report of the above-named study. The committee noted the following that need to be addressed;<br><br>
$screeningmessage<br><br>
	
Note: You are requested to address the above comments within 4 weeks<br>";

require_once("./viewlrcn/send_close_out_text.php");;

 $queryp2w="select * from ".$prefix."study_post_approvals where rmd_id='$rstug_UNCSTRefNumber2' order by id desc";
$cmdw2=$mysqli->query($queryp2w);
if(!$cmdw2->num_rows){
$Insert_sendAp="insert into ".$prefix."study_post_approvals (`rstug_user_id`,`rstug_rsch_project_id`,`refNo`,`approvalMain`,`approvalText1`,`approvalText2`,`approvalText3`,`dateupdated`,`rmd_id`,`signature`,`totaldocs`,`DateApproved`,`studyTools`,`whosigns`,`renewal_id`,`public_title`,`recAffiliated_id`,`ptype`) values ('$asrmApplctID_user','$protocol_idmm','$protocolCode','$sendTextHr','$sendText1','$sendText2','$sendText3',now(),'$rstug_UNCSTRefNumber2','$signature','$nummm','$sendTextDate','$sendTextStudyTools','$whosigns','$renewal_id','$public_title','$recAffiliated_id','CloseOutReport')";
$mysqli->query($Insert_sendAp);
}

if($cmdw2->num_rows){
$Insert_sendAp2="update ".$prefix."study_post_approvals set `approvalMain`='$sendTextHr',`approvalText1`='$sendText1',`approvalText2`='$sendText2',`approvalText3`='$sendText3',`dateupdated`=now(),`signature`='$signature',`totaldocs`='$nummm',`DateApproved`='$sendTextDate',`studyTools`='$sendTextStudyTools',`whosigns`='$whosigns',`renewal_id`='$renewal_id',`public_title`='$public_title',`recAffiliated_id`='$recAffiliated_id',`ptype`='CloseOutReport' where rmd_id='$rstug_UNCSTRefNumber2'";
$mysqli->query($Insert_sendAp2);	
}
///Send mail with comments to the PI

$msg="REC CLOSEOUT REPORT: Dear $ownername, your protocol RefNo $protocolCode has been reviewed, check your email for more details. $accroname. ";//

echo '<img src="images/loading_wait.gif">';
echo '<div class="spacer"></div>';
echo '<meta http-equiv="refresh" content="5; url='.$base_url.'/main.php?option=MyFinalReportREC" />';
		
}////End Approvals, rejects

?>
  <!-- Project-->
              <div class="project">
                <div class="row bg-white has-shadow">
                  <div class="left-col col-lg-6 d-flex align-items-center justify-content-between">
                    <div class="project-title d-flex align-items-center">
                     <?php if($sqUserdd['profile']){?> <div class="image has-shadow"><img src="files/profile/<?php echo $sqUserdd['profile'];?>" alt="..." class="img-fluid"></div><?php }?>
                      <div class="text">
                        <h3 class="h4">Protocal Title</h3><small><?php echo $rprotocalSub2Sel['public_title'];?></small>
                      </div>
                    </div>
                    <div class="project-date"><span class="hidden-sm-down"><h3 class="h4">Author</h3> <?php echo $sqUserdd['name'];?></span></div>
                  </div>
                  <div class="right-col col-lg-6 d-flex align-items-center">
                    <div class="time"><i class="fa fa-clock-o"></i><h3 class="h4">Updated At</h3> <?php echo $rstudym['updated'];?> </div>
                    <!--<div class="comments"><i class="fa fa-comment-o"></i>20</div>-->
                    <div class="project-progress">
                     
                     
                     <div class="progress">
  <div class="progress-bar progress-bar-striped active" role="progressbar"
  aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:100%">
    100% Complete
  </div>
</div> 


                    </div>
                  </div>
                </div>
              </div>
              
                                
</div>

  <?php
  $count=0;
$sqlstudy="SELECT * FROM ".$prefix."final_reports where id='$id' order by id desc limit 0,1";
$Querystudy = $mysqli->query($sqlstudy);
$totalstudy = $Querystudy->num_rows;
$rstudy = $Querystudy->fetch_array();
?> 
<button class="accordion">Close Out Report, click to review</button>
  <div class="panel">
 
<table class="table table-striped table-sm" id="customers">
                  <thead>
                          <tr>
                            <th>Attachment</th>
                     

                          </tr>
                        </thead>
                        <tbody>
            
                          <tr>
                            <td>
                            <h3><?php echo $rstudy['protocol_title'];?></h3><hr />
                            
                            
                              <?php
							
$notification_id=$rstudy['id'];
$sqlstudy2="SELECT * FROM ".$prefix."final_reports_attachments where notification_id='$id' order by id desc";
$Querystudy2 = $mysqli->query($sqlstudy2);
$totalstudy2 = $Querystudy2->num_rows;
while($rstudy2 = $Querystudy2->fetch_array()){
$count++;
echo $count.' .';	
	?>
<a href="./files/uploads/<?php echo $rstudy2['fileAttachment'];?>" target="_blank">View Attachment</a><br />
<?php }?></td>
                     
                            </tr>
               
                        </tbody>
                      </table> 

  </div>
  

    
   <?php
   ///////////////////Assign Reviewers
$sqlgg = "select * FROM ".$prefix."initial_committee_screening where owner_id='$owner_id' and protocol_id='$protocol_idwe' and screeningFor='CloseOutReport'";//and conceptm_status='new' 
$resultgg = $mysqli->query($sqlgg);
$rInvestigatorgg=$resultgg->fetch_array();

if($category=='AssignReviewersDel' and $id and $_GET['sid']){
    $sid=$_GET['sid'];
	$sqlA2Protocol2="delete from ".$prefix."submission_review_sr where protocol_id='$protocol_idwe' and id='$sid'";
	$mysqli->query($sqlA2Protocol2);
	$message='<p class="error2">Reviewer has been removed.</p>';
	}

?>

<?php if($rstudym['assignedto']!='Assigned'){?>
<button id="myBtn">Click to Add Reviewers to this Closeout</button>   
<div style="clear:both;"></div>

 <form action="" method="post" name="regForm" id="regForm" enctype="multipart/form-data">

<h4>Assigned Reviewer (s)</h4>
<table width="100%" border="0" class="success">
<tr>
    <td align="left">Reviewer</td>
    <td align="left">Type</td>
    <td align="left">Meeting</td>
    <td align="left"></td>
  </tr>
<?php
$sqlProtocols="SELECT * FROM ".$prefix."submission_review_sr  where protocol_id='$protocol_idwe' and recstatus='new' and reviewFor='CloseOutReport'";
$QueryProtocols=$mysqli->query($sqlProtocols);
$rTotalAnyAssigned=$QueryProtocols->num_rows;
while($sqProtocols = $QueryProtocols->fetch_array()){
	//Get Reviewer
$masrmApplctID=$sqProtocols['asrmApplctID'];
$sqlReviewer="SELECT * FROM ".$prefix."user  where asrmApplctID='$masrmApplctID'";
$QueryReviewer=$mysqli->query($sqlReviewer);
$sqReviewer = $QueryReviewer->fetch_array();
?>

  
  <tr>
    <td width="30%" align="left" class="defmf2">
	<input name="reviewer[]" type="hidden" value="<?php echo $sqProtocols['id'];?>"  class="required" checked="checked"/>
	<?php echo $sqReviewer['name'];?></td>
    
    
    <td width="22%" align="left" style="padding-bottom:20px;" class="defmf2"><?php echo $sqProtocols['reviewtype'];?> </td>
    <td width="48%" align="left" class="defmf2"><?php echo $sqProtocols['subject'];?></td>
    <td width="48%" align="left" class="defmf2"><a href="main.php?option=AssignReviewersDel&id=<?php echo $id;?>&sid=<?php echo $sqProtocols['id'];?>" style="color:#F00; font-weight:bold;" onclick="return confirm('Are you sure you want to delete this item?');">Delete</a></td>
  </tr>



<?php }?>
</table>
<?php if($rTotalAnyAssigned){?><input name="doAssignReviewesConfirm" type="submit"  class="btn btn-primary" value="Assign Now"/><?php }?>
         </form>
   <?php }/// if it has not been assigned?>     
        
        
 <!--Modal Popup-->       
        
   <!-- The Modal -->
<div id="myModal" class="modal" style="margin-top:80px;">

  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
      <span class="close">&times;</span>
     
    </div>
    <div class="modal-body" style="height:300px; overflow:scroll;">

 <form action="" method="post" name="regForm" id="regForm" enctype="multipart/form-data">
 
 <div class="form-group row" style="padding-top:10px;">
<label class="col-sm-3 form-control-label">Select Reviewer: <span class="error">*</span></label>
<div class="col-sm-8">
<select name="cfnreviewer" id="cfnreviewer" class="form-control  required" required>
<option value="">Please Select</option>
<?php
$sqlReviewer="SELECT * FROM ".$prefix."user  where privillage='recreviewer' and recAffiliated_id='$recAffiliated_id'";
$QueryReviewer=$mysqli->query($sqlReviewer);
while($sqReviewer = $QueryReviewer->fetch_array()){
?>
<option value="<?php echo $sqReviewer['asrmApplctID'];?>"><?php echo $sqReviewer['name'];?></option>
<?php }?>
</select>

<input name="asrmApplctID_user" type="hidden" value="<?php echo $owner_id;?>"/>
<input name="protocol_idmm" type="hidden" value="<?php echo $protocol_idwe;?>"/>
<input name="recAffiliated_id" type="hidden" value="<?php echo $recAffiliated_id;?>"/>

</div>
</div> 


                        
  <div class="form-group row">
<label class="col-sm-3 form-control-label">Choose Type: <span class="error">*</span></label>
<div class="col-sm-8">


<select name="reviewtype" id="reviewtype" class="form-control  required" required>
<option value="">Please Select</option>
<option value="Primary Reviewer">Primary Reviewer</option>
<option value="Secondary Reviewer">Secondary Reviewer</option>
<option value="Expert Reviewer">Expert Reviewer</option>
<option value="Committee Members">Committee Members</option>
</select>


</div>
</div> 



       <div class="form-group row">
   <div class="col-sm-8 offset-sm-3sss">

<input name="doAssignReviewes" type="submit"  class="btn btn-primary" value="Save Details"/>

                          </div>
                        </div>
                                          
     </form>                   
    </div>
    </div>
    </div><!--End-->
    
    
   <!--Approve Renewal1110--> 
<?php 
$sqlSMeeting = "select * from ".$prefix."meeting where protocol_id='$protocol_idwe' and meetingFor='CloseOutReport' order by id desc";
$resultSMeeting = $mysqli->query($sqlSMeeting);
$sqUserMeeting = $resultSMeeting->fetch_array();

if($rstudym['status']=='Scheduled for Review' and $rstudym['status']!='Approved'){?>    
   <?php
$sqlgg2 = "select * FROM ".$prefix."initial_committee_screening where owner_id='$owner_id' and protocol_id='$protocol_idwe'  and reviewer_id='$asrmApplctID'  and screeningFor='CloseOutReport' order by id desc";//and conceptm_status='new' 
$resultgg2 = $mysqli->query($sqlgg2);
$rInvestigatorgg2=$resultgg2->fetch_array();?>
 <form action="" method="post" name="regForm" id="regForm" enctype="multipart/form-data">
<h4>Collective Decisions (Comments will be shared with PI):</h4>

 <div class="form-group row success">

Meeting Number <font color="#CC0000">*</font><br />
<input name="MeetingNumber" type="text" value="" class="form-control required"/>
</div>

<div class="form-group row success">
Meeting /Decision Date <font color="#CC0000">*</font><br />
<input name="Meetingdate" type="date" value="" class="form-control required"/>
</div>

<div class="form-group row success">
<label class="col-sm-6 form-control-label">Comments from the Committee Review Meeting (About this protocol):</label>
<textarea name="screening" id="screening" cols="" rows="5" class="form-control  required"><?php echo $rInvestigatorgg2['screening'];?></textarea>

<input name="asrmApplctID_user" type="hidden" value="<?php echo $owner_id;?>"/>
<input name="protocol_idmm" type="hidden" value="<?php echo $protocol_idwe;?>"/>
<input name="recAffiliated_id" type="hidden" value="<?php echo $recAffiliated_id;?>"/>
<input name="ammendType" type="hidden" value="<?php echo $rstudym['ammendType'];?>"/>
<input name="public_title" type="hidden" value="<?php echo $rstudym['protocol_title'];?>"/>
<input name="renewal_id" type="hidden" value="<?php echo $rstudym['id'];?>"/>
<input name="code" type="hidden" value="<?php echo $rstudym['code'];?>"/>

</div>
<div class="line"></div>


<div class="form-group row success">
<label class="col-sm-4 form-control-label">Choose Action:</label>
<select name="recruitment_status" id="recruitment_status" class="form-control  required">
<option value="">---------Select-------</option>
<?php
$sqlClinicalcv = "select * FROM ".$prefix."decision_status where actionfor='both' and id!='8' order by name desc";//and conceptm_status='new' 
$resultClinicalcv = $mysqli->query($sqlClinicalcv);
while($rClinicalcv=$resultClinicalcv->fetch_array()){
?>
<option value="<?php echo $rClinicalcv['name'];?>" <?php if($rprotocalSub2Sel['monitoring_action_id']==$rClinicalcv['id']){?>selected="selected"<?php }?>><?php echo $rClinicalcv['name'];?></option>
<?php }?>
</select>
</div>

<div class="form-group row success">


<select name="whosigns" id="whosigns" class="form-control  required" style=" width:500px!important;">
<option value="">Please Select who signs on Approval Letter</option>
<?php
$sqlUserff = "select * FROM ".$prefix."user where recAffiliated_id='$recAffiliated_id' and authorisedtosign='Yes' order by name desc";//and conceptm_status='new' 
$resultUserff = $mysqli->query($sqlUserff);
while($rClUserv=$resultUserff->fetch_array()){
?>
<option value="<?php echo $rClUserv['asrmApplctID'];?>"><?php echo $rClUserv['name'];?></option>
<?php }?>
</select>


</div>
<div class="line"></div><?php 

//}?>


<div class="form-group row  success">
                          <div class="col-sm-4 offset-sm-3">
                    <input name="doSendToEthical" type="submit"  class="btn btn-primary" value="Save Decision and Finalize Process"/>

                          </div>
                        </div>
         </form>
 
 <?php }?>   
    
    
       
         
    <script>
var acc = document.getElementsByClassName("accordion");
var i;

for (i = 0; i < acc.length; i++) {
    acc[i].addEventListener("click", function() {
        this.classList.toggle("activem");
        var panel = this.nextElementSibling;
        if (panel.style.display === "block") {
            panel.style.display = "none";
        } else {
            panel.style.display = "block";
        }
    });
}
</script> 

                        
<script type="text/javascript">

var countries=new ddajaxtabs("countrytabs", "countrydivcontainer")
countries.setpersist(true)
countries.setselectedClassTarget("link") //"link" or "linkparent"
countries.init()

</script>