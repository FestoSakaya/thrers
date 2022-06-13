<ul id="countrytabs" class="shadetabs">
<li><a href="#" rel="#default" class="selected">Annual Renewal View Submission</a></li>
</ul>

<div id="countrydivcontainer" style="border:0px solid gray; width:100%; margin-bottom: 1em; padding: 10px">
<?php
$sqlstudym="SELECT * FROM ".$prefix."renewals where id='$id' order by id desc limit 0,1";
$Querystudym = $mysqli->query($sqlstudym);
$rstudym = $Querystudym->fetch_array();
$owner_id=$rstudym['owner_id'];
$protocol_idwe=$rstudym['protocol_id'];
$renewal_id=$rstudym['renewal_id'];
$rstudym['ammendType'];

if($rstudym['ammendType']=='online'){
$sqlprotocalSubSel="SELECT * FROM ".$prefix."submission where id='$protocol_idwe'";
$QprotocalSub2Sel = $mysqli->query($sqlprotocalSubSel);
$rprotocalSub2Sel = $QprotocalSub2Sel->fetch_array();

$public_title=$rprotocalSub2Sel['public_title'];
}

if($rstudym['ammendType']=='manual'){
$public_title=$rstudym['public_title'];	
}

$sqlSRR = "select * from ".$prefix."user where asrmApplctID='$owner_id'";
$resultSSS = $mysqli->query($sqlSRR);
$sqUserdd = $resultSSS->fetch_array();


if($_POST['doConfirmPayment']=='Confirm Payment'){
require("viewlrcn/class.phpmailer.php");
require("viewlrcn/class.smtp.php");

$sqlReviewer="SELECT * FROM ".$prefix."user  where asrmApplctID='$cfnreviewer'";
$QueryReviewer=$mysqli->query($sqlReviewer);
$sqReviewer = $QueryReviewer->fetch_array();
$assignedtoName=$sqReviewer['name'];
$usrm_email=$sqReviewer['email'];

	$asrmApplctID_user=$mysqli->real_escape_string($_POST['asrmApplctID_user']);
	$protocol_idmm=$mysqli->real_escape_string($_POST['protocol_idmm']);
	$recAffiliated_c=$mysqli->real_escape_string($_POST['recAffiliated_id']);
	$paymentStatus=$mysqli->real_escape_string($_POST['paymentStatus']);
	$payments_comment=$mysqli->real_escape_string($_POST['comment']);
	
	
$sqlMyrecnamew="SELECT * FROM ".$prefix."list_rec_affiliated where id='$recAffiliated_id'";
$sqlFMyreccnaw=$mysqli->query($sqlMyrecnamew);
$recNamew=$sqlFMyreccnaw->fetch_array();

	$contacts=$recNamew['contacts'];
	$recOriginalName=$recNamew['name'];
$update="update ".$prefix."renewals set paymentStatus='$paymentStatus' where id='$id'";
$mysqli->query($update);
$message='<p class="success">Thank you, renewal payment has been updated.</p>';

echo '<img src="images/loading_wait.gif">';
echo '<div class="spacer"></div>';
echo '<meta http-equiv="refresh" content="0; url='.$base_url.'/main.php?option=AnnualRenualMaREC" />';
	
}
////////////////////////////////////END

if($_POST['doAssignReviewes']=='Save Details'){///Add reviewers to this protccol

$asrmApplctID_user=$mysqli->real_escape_string($_POST['asrmApplctID_user']);
	$protocol_idmm=$mysqli->real_escape_string($_POST['protocol_idmm']);
	$recAffiliated_c=$mysqli->real_escape_string($_POST['recAffiliated_id']);
	$subject=$mysqli->real_escape_string("Annual Renewal");//$subject=$mysqli->real_escape_string($_POST['Meetingsubject']);
	$reviewtype=$mysqli->real_escape_string($_POST['reviewtype']);
	$cfnreviewer=$mysqli->real_escape_string($_POST['cfnreviewer']);
	$ammendType=$mysqli->real_escape_string($_POST['ammendType']);
	$public_title=$mysqli->real_escape_string($_POST['public_title']);

$queryConceptLogs="select * from ".$prefix."submission_review_sr where  reviewer_id='$cfnreviewer' and reviewer_id='$cfnreviewer'  and reviewStatus='Pending'  and reviewFor='AnnualRenewal' and renewal_id='$id' order by id desc";
$rsConceptLogs=$mysqli->query($queryConceptLogs);
$rTotalConceptLogs=$rsConceptLogs->num_rows;



if($subject and !$rTotalConceptLogs){
$sqlA2rr="insert into ".$prefix."submission_review_sr (`asrmApplctID`,`protocol_id`,`owner_id`,`reviewer_id`,`reviewDate`,`recstatus`,`protocolStage`,`reviewtype`,`subject`,`recAffiliated_c`,`reviewFor`,`conflictofInterest`,`conflictReason`,`reviewStatus`,`reassigned`,`ammendType`,`renewal_id`,`public_title`) 

values('$cfnreviewer','$protocol_idmm','$asrmApplctID_user','$cfnreviewer',now(),'new','stage1','$reviewtype','$subject','$recAffiliated_c','AnnualRenewal','none','','Pending','No','$ammendType','$id','$public_title')";
$mysqli->query($sqlA2rr);
$message='<p class="success">Thank you, reviewer has been included on this protocol.</p>';
}



}

if($_POST['doAssignReviewesConfirm']=='Assign Now' and $_POST['public_title']){
require("viewlrcn/class.phpmailer.php");
require("viewlrcn/class.smtp.php");

foreach($_POST['reviewer'] as $cfn_reviewer) {
$cfnreviewer= $cfn_reviewer;
//First get details about this submission
$queryConceptLogs="select * from ".$prefix."submission_review_sr where id='$cfnreviewer'";
$rsConceptLogs=$mysqli->query($queryConceptLogs);
$rTotalConceptLogs=$rsConceptLogs->num_rows;
$sqSubmission = $rsConceptLogs->fetch_array();

    $assignedTo=$sqSubmission['reviewer_id'];
	$asrmApplctID_user=$mysqli->real_escape_string($sqSubmission['owner_id']);
	$protocol_idmm=$mysqli->real_escape_string($sqSubmission['protocol_id']);
	$recAffiliated_c=$mysqli->real_escape_string($sqSubmission['recAffiliated_c']);
	$subject=$mysqli->real_escape_string("Renewal for Review");
	//$subject=$mysqli->real_escape_string($sqSubmission['subject']);
	$reviewtype=$mysqli->real_escape_string($sqSubmission['reviewtype']);
	//renewals set status='Scheduled for Review',assignedto='Assigned' where id='$id'
	$public_title=$mysqli->real_escape_string($_POST['public_title']);
	

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
$sqlA2rr="update ".$prefix."submission_review_sr set recstatus='Pending' where reviewer_id='$cfnreviewer' and renewal_id='$id'";
$mysqli->query($sqlA2rr); 

$update="update ".$prefix."renewals set status='Scheduled for Review',assignedto='Assigned' where id='$id'";
$mysqli->query($update);echo $usrm_email;
///Now Send mail
require_once("viewlrcn/mail_template_assign_reviewers_annualrenewal.php");
$ComponentAction="renewal";
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
//$mail->addCc('mawandammoses@gmail.com',$recOriginalName);//
//$mail->addBcc('mwesigwa.collins@gmail.com',$recOriginalName);//

$mail->FromName = "REC - $recOriginalName"; //From Name -- CHANGE --
$mail->AddAddress($usrm_email, $assignedtoName); //To Address -- CHANGE --
//if($dbEmail2){echo $mail->addCc($dbEmail2,'Activation Link from UNCST');}
$mail->AddReplyTo($usrm_email, $assignedtoName); //Reply-To Address -- CHANGE --$usrm_email

$mail->WordWrap = 50; // set word wrap to 50 characters
$mail->IsHTML(false); // set email format to HTML
$mail->Subject = "$subject - Annual Renewal for Review";
$body="$allSentMessage";
$mail->MsgHTML($body);

if(!$mail->Send()){
	echo "Mailer Error: " . $mail->ErrorInfo;
}///end

}
		}
$message='<p class="success">Thank you, renewal has been assigned.</p>';
	echo '<img src="images/loading_wait.gif">';
echo '<div class="spacer"></div>';
echo '<meta http-equiv="refresh" content="3; url='.$base_url.'/main.php?option=AnnualRenualMaREC" />';
}

//////////////////////////Make Final Decision ***********************************************************************************


if($_POST['doSendToEthical']=='Save Decision and Finalize Process' and $_POST['screening'] and $_POST['recruitment_status']=='Approved' and $_POST['renewal_id'] and $_POST['public_title'] and $_POST['MeetingNumber'] and $_POST['initialApprovaldate'] and $_POST['InitialExpiryDate'] and $_POST['initialReferenceNumber'] and $_POST['approvaldate']){

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
	$rstug_UNCSTRefNumber2=md5($mysqli->real_escape_string($_POST['renewal_id']));
	$rstug_UNCSTRefNumber=$mysqli->real_escape_string($_POST['renewal_id']);
	$MeetingNumber=$mysqli->real_escape_string($_POST['MeetingNumber']);
	$whosigns=$mysqli->real_escape_string($_POST['whosigns']);
	$Meetingdate=date("d/m/Y", strtotime($_POST['Meetingdate']));
	$Approvaltoday=date("d/m/Y", strtotime($_POST['approvaldate']));
	
	$initialApprovaldate=date("d/m/Y", strtotime($_POST['initialApprovaldate']));
	$InitialExpiryDate=date("d/m/Y", strtotime($_POST['InitialExpiryDate']));
	$initialReferenceNumber=$mysqli->real_escape_string($_POST['initialReferenceNumber']);
	
	$querypUser="select * from apvr_user where asrmApplctID='$whosigns' order by asrmApplctID desc";
$cmdwUser=$mysqli->query($querypUser);
$rSwUser=$cmdwUser->fetch_array();
$signedby=$rSwUser['name'];
$signedEmail=$rSwUser['email'];
if($rSwUser['signatures']){$signature=$rSwUser['signatures'];}else{$signature="hellensignature.jpg";}
	
	$sqlInvestigators="SELECT * FROM ".$prefix."initial_committee_screening where `owner_id`='$asrmApplctID_user' and screening='$screening' and reviewer_id='$id' and reviewer_id='$asrmApplctID' and screeningFor='AnnualRenewal' order by id desc";
	$QueryInvestigators = $mysqli->query($sqlInvestigators);
	$totalInvestigators = $QueryInvestigators->num_rows;
	
		if(!$totalInvestigators){
$sqlA2="insert into ".$prefix."initial_committee_screening (`owner_id`,`protocol_id`,`created`,`updated`,`screening`,`draftopinion`,`recAffiliated_id`,`reviewer_id`,`screeningFor`,`completionStatus`,`collectiveDecision`,`ammendType`,`renewal_id`,`public_title`) 

values('$asrmApplctID_user','$protocol_idmm',now(),now(),'$screening','$draftopinion2','$recAffiliated_id','$asrmApplctID','AnnualRenewal','Completed','Yes','$ammendType','$renewal_id','$public_title')";
//$mysqli->query($sqlA2);
		}
		//////////////////////////Save Decision and Finalize Process send email
	//sleep(50);	
	////Get Protocl Comments
$sqlSComments = "select * from ".$prefix."initial_committee_screening where reviewer_id='$id' and owner_id='$asrmApplctID_user' and screeningFor='AnnualRenewal'";
$resComments = $mysqli->query($sqlSComments);
while($sqComments = $resComments->fetch_array()){
$screeningmessage.=$sqComments['screening'].'<br>';
}	
		
///Get this meeting Number
$sqlSmeeting = "select * from ".$prefix."meeting where protocol_id='$protocol_idmm' and meetingFor='AnnualRenewal' order by id desc";
$resmeeting = $mysqli->query($sqlSmeeting);
$sqmeeting = $resmeeting->fetch_array();
//$MeetingNumber=$sqmeeting['id'];
//$Meetingdate=date("d/m/Y", strtotime($sqmeeting['date']));

$sqlSRecruitment = "select * from ".$prefix."decision_status where id='$recruitment_status'";
$resRecruitment = $mysqli->query($sqlSRecruitment);
$sqRecruitment = $resRecruitment->fetch_array();

$status=$sqRecruitment['name'];
//$Approvaltoday=date("d/m/Y");
$dateSubmitted=date("Y-m-d G:i:s");
//Get Approval period
$Approvaltoday;
$endofproject = date("d/m/Y", strtotime($_POST['approvaldate'] . "+12 month"));	

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
$sqlA2="update ".$prefix."renewals set `status`='$recruitment_status',`period`='$period',`end_of_project`='$endofproject' where id='$id'";
$mysqli->query($sqlA2);

require_once("viewlrcn/mail_template_approval_all.php");
$whatApproved="Annual Renewals";
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

//$mail->addBcc("mwesigwa.collins@gmail.com","$recOriginalName - REC Approval Notice");//$recchairEmail
$mail->FromName = "$recOriginalName"; //From Name -- CHANGE --
$mail->AddAddress($owneremail, $ownername); //
$mail->addCc($recchairEmail,"REC Approval Notice");///To UNCST
$mail->AddReplyTo($recemail, $ownername); //Reply-To Address -- CHANGE --$usrm_email
$mail->WordWrap = 50; // set word wrap to 50 characters
$mail->IsHTML(false); // set email format to HTML
$mail->Subject = "Annual Renewal - $public_title";
$body="$allSentMessage
<br><br>
<a href='$base_url/studyrenewal.php?rmd_id=$rstug_UNCSTRefNumber2' style='background:#06F; border: none;  color: white; padding: 15px 32px;  text-align: center;  text-decoration: none;  display: inline-block; font-size: 16px;' target='_blank'>Download/Print PDF</a>";

$mail->MsgHTML($body);

if(!$mail->Send()){
	echo "Mailer Error: " . $mail->ErrorInfo;
}///end	

require_once("./viewlrcn/send_post_approval_text.php");

$queryp2w="select * from ".$prefix."study_post_approvals where rmd_id='$rstug_UNCSTRefNumber2' and  ptype='AnnualRenewal' order by id desc";
$cmdw2=$mysqli->query($queryp2w);
if(!$cmdw2->num_rows){
$Insert_sendAp="insert into ".$prefix."study_post_approvals (`rstug_user_id`,`rstug_rsch_project_id`,`refNo`,`approvalMain`,`approvalText1`,`approvalText2`,`approvalText3`,`dateupdated`,`rmd_id`,`signature`,`totaldocs`,`DateApproved`,`studyTools`,`whosigns`,`renewal_id`,`public_title`,`recAffiliated_id`,`ptype`) values ('$asrmApplctID_user','$protocol_idmm','$protocolCode','$sendTextHr','$sendText1','$sendText2','$sendText3',now(),'$rstug_UNCSTRefNumber2','$signature','$nummm','$sendTextDate','$sendTextStudyTools','$whosigns','$renewal_id','$public_title','$recAffiliated_id','AnnualRenewal')";
$mysqli->query($Insert_sendAp);
}

if($cmdw2->num_rows){
$Insert_sendAp2="update ".$prefix."study_post_approvals set `approvalMain`='$sendTextHr',`approvalText1`='$sendText1',`approvalText2`='$sendText2',`approvalText3`='$sendText3',`dateupdated`=now(),`signature`='$signature',`totaldocs`='$nummm',`DateApproved`='$sendTextDate',`studyTools`='$sendTextStudyTools',`whosigns`='$whosigns',`renewal_id`='$renewal_id',`public_title`='$public_title',`recAffiliated_id`='$recAffiliated_id',`ptype`='AnnualRenewal' where rmd_id='$rstug_UNCSTRefNumber2'";
$mysqli->query($Insert_sendAp2);	
}
///Send mail with comments to the PI

$msg="REC ANNUAL RENEWAL: Dear $ownername, your protocol RefNo $protocolCode has been renewed, check your email for more details. $accroname. ";//

echo '<img src="images/loading_wait.gif">';
echo '<div class="spacer"></div>';
echo '<meta http-equiv="refresh" content="6; url='.$base_url.'/main.php?option=AnnualRenualMaREC" />';
		
}////End Approvals, rejects







if($_POST['doSendToEthical']=='Save Decision and Finalize Process' and $_POST['screening'] and ($_POST['recruitment_status']=='Rejected' || $_POST['recruitment_status']=='Resubmit | Needs Major Revisions') and $_POST['renewal_id'] and $_POST['public_title'] and $_POST['MeetingNumber'] and $_POST['approvaldate']){

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
	$rstug_UNCSTRefNumber2=md5($mysqli->real_escape_string($_POST['renewal_id']));
	$rstug_UNCSTRefNumber=$mysqli->real_escape_string($_POST['renewal_id']);
	$MeetingNumber=$mysqli->real_escape_string($_POST['MeetingNumber']);
	$whosigns=$mysqli->real_escape_string($_POST['whosigns']);
	$Meetingdate=date("d/m/Y", strtotime($_POST['Meetingdate']));
	$Approvaltoday=date("d/m/Y", strtotime($_POST['approvaldate']));
	
	$querypUser="select * from apvr_user where asrmApplctID='$whosigns' order by asrmApplctID desc";
$cmdwUser=$mysqli->query($querypUser);
$rSwUser=$cmdwUser->fetch_array();
$signedby=$rSwUser['name'];
$signedEmail=$rSwUser['email'];
if($rSwUser['signatures']){$signature=$rSwUser['signatures'];}else{$signature="hellensignature.jpg";}
	
	$sqlInvestigators="SELECT * FROM ".$prefix."initial_committee_screening where `owner_id`='$asrmApplctID_user' and screening='$screening' and reviewer_id='$id' and reviewer_id='$asrmApplctID'  and screeningFor='AnnualRenewal' order by id desc";
	$QueryInvestigators = $mysqli->query($sqlInvestigators);
	$totalInvestigators = $QueryInvestigators->num_rows;
	
		if(!$totalInvestigators){
$sqlA2="insert into ".$prefix."initial_committee_screening (`owner_id`,`protocol_id`,`created`,`updated`,`screening`,`draftopinion`,`recAffiliated_id`,`reviewer_id`,`screeningFor`,`completionStatus`,`collectiveDecision`,`ammendType`,`renewal_id`,`public_title`) 

values('$asrmApplctID_user','$protocol_idmm',now(),now(),'$screening','$draftopinion2','$recAffiliated_id','$asrmApplctID','AnnualRenewal','Completed','Yes','$ammendType','$id','$public_title')";
$mysqli->query($sqlA2);
		}
		//////////////////////////Save Decision and Finalize Process send email
	//sleep(50);	
	////Get Protocl Comments
$sqlSComments = "select * from ".$prefix."initial_committee_screening where reviewer_id='$id' and owner_id='$asrmApplctID_user' and screeningFor='AnnualRenewal'";
$resComments = $mysqli->query($sqlSComments);
while($sqComments = $resComments->fetch_array()){
$screeningmessage.=$sqComments['screening'].'<br>';
}	
		
///Get this meeting Number
$sqlSmeeting = "select * from ".$prefix."meeting where protocol_id='$protocol_idmm' and meetingFor='AnnualRenewal' order by id desc";
$resmeeting = $mysqli->query($sqlSmeeting);
$sqmeeting = $resmeeting->fetch_array();
//$MeetingNumber=$sqmeeting['id'];
//$Meetingdate=date("d/m/Y", strtotime($sqmeeting['date']));

$sqlSRecruitment = "select * from ".$prefix."decision_status where id='$recruitment_status'";
$resRecruitment = $mysqli->query($sqlSRecruitment);
$sqRecruitment = $resRecruitment->fetch_array();

$status=$sqRecruitment['name'];
//$Approvaltoday=date("d/m/Y");
$dateSubmitted=date("Y-m-d G:i:s");
//Get Approval period
$Approvaltoday;
$endofproject = date("d/m/Y", strtotime($Approvaltoday . "+12 month"));	

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
$sqlA2="update ".$prefix."renewals set `status`='$recruitment_status' where id='$id'";
$mysqli->query($sqlA2);

require_once("viewlrcn/mail_template_reject_renewal.php");
$whatApproved="Annual Renewals";
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
$mail->addBcc("mwesigwa.collins@gmail.com","$recOriginalName - REC Revisions Notice");//$recchairEmail
$mail->FromName = "$recOriginalName"; //From Name -- CHANGE --
$mail->AddAddress($owneremail, $ownername); //
//$mail->addCc("mawandammoses@gmail.com","REC Revisions Notice");///To UNCST
$mail->AddReplyTo($recemail, $ownername); //Reply-To Address -- CHANGE --$usrm_email

$mail->WordWrap = 50; // set word wrap to 50 characters
$mail->IsHTML(false); // set email format to HTML
$mail->Subject = "Annual Renewal - $public_title";
$body="$allSentMessage
<br><br>
<a href='$base_url/studyrenewal.php?rmd_id=$rstug_UNCSTRefNumber2' style='background:#06F; border: none;  color: white; padding: 15px 32px;  text-align: center;  text-decoration: none;  display: inline-block; font-size: 16px;' target='_blank'>Download/Print PDF</a>";

$mail->MsgHTML($body);

if(!$mail->Send()){
	echo "Mailer Error: " . $mail->ErrorInfo;
}///end	


require_once("./viewlrcn/send_post_approval_text2.php");

 $queryp2w="select * from ".$prefix."study_post_approvals where rmd_id='$rstug_UNCSTRefNumber2' and  ptype='AnnualRenewal' order by id desc";
$cmdw2=$mysqli->query($queryp2w);
if(!$cmdw2->num_rows){
$Insert_sendAp="insert into ".$prefix."study_post_approvals (`rstug_user_id`,`rstug_rsch_project_id`,`refNo`,`approvalMain`,`approvalText1`,`approvalText2`,`approvalText3`,`dateupdated`,`rmd_id`,`signature`,`totaldocs`,`DateApproved`,`studyTools`,`whosigns`,`renewal_id`,`public_title`,`recAffiliated_id`,`ptype`) values ('$asrmApplctID_user','$protocol_idmm','$protocolCode','$sendTextHr','$sendText1','$sendText2','$sendText3',now(),'$rstug_UNCSTRefNumber2','$signature','$nummm','$sendTextDate','$sendTextStudyTools','$whosigns','$renewal_id','$public_title','$recAffiliated_id','AnnualRenewal')";
$mysqli->query($Insert_sendAp);
}

if($cmdw2->num_rows){
$Insert_sendAp2="update ".$prefix."study_post_approvals set `approvalMain`='$sendTextHr',`approvalText1`='$sendText1',`approvalText2`='$sendText2',`approvalText3`='$sendText3',`dateupdated`=now(),`signature`='$signature',`totaldocs`='$nummm',`DateApproved`='$sendTextDate',`studyTools`='$sendTextStudyTools',`whosigns`='$whosigns',`renewal_id`='$renewal_id',`public_title`='$public_title',`recAffiliated_id`='$recAffiliated_id',`ptype`='AnnualRenewal' where rmd_id='$rstug_UNCSTRefNumber2'";
$mysqli->query($Insert_sendAp2);	
}
///Send mail with comments to the PI

$msg="REC ANNUAL RENEWAL: Dear $ownername, your protocol RefNo $protocolCode has been renewed, check your email for more details. $accroname. ";//

echo '<img src="images/loading_wait.gif">';
echo '<div class="spacer"></div>';
echo '<meta http-equiv="refresh" content="6; url='.$base_url.'/main.php?option=AnnualRenualMaREC" />';
		
}////End Approvals, rejects




if($_POST['doSendToEthical']=='Save Decision and Finalize Process' and $_POST['screening'] and ($_POST['recruitment_status']=='Conditional Approval | Needs Minor Revisions') and $_POST['renewal_id'] and $_POST['public_title'] and $_POST['MeetingNumber'] and $_POST['approvaldate']){

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
	$rstug_UNCSTRefNumber2=md5($mysqli->real_escape_string($_POST['renewal_id']));
	$rstug_UNCSTRefNumber=$mysqli->real_escape_string($_POST['renewal_id']);
	$MeetingNumber=$mysqli->real_escape_string($_POST['MeetingNumber']);
	$whosigns=$mysqli->real_escape_string($_POST['whosigns']);
	$Meetingdate=date("d/m/Y", strtotime($_POST['Meetingdate']));
	$Approvaltoday=date("d/m/Y", strtotime($_POST['approvaldate']));
	
	$querypUser="select * from apvr_user where asrmApplctID='$whosigns' order by asrmApplctID desc";
$cmdwUser=$mysqli->query($querypUser);
$rSwUser=$cmdwUser->fetch_array();
$signedby=$rSwUser['name'];
$signedEmail=$rSwUser['email'];
if($rSwUser['signatures']){$signature=$rSwUser['signatures'];}else{$signature="hellensignature.jpg";}
	
	$sqlInvestigators="SELECT * FROM ".$prefix."initial_committee_screening where `owner_id`='$asrmApplctID_user' and screening='$screening' and reviewer_id='$id' and reviewer_id='$asrmApplctID'  and screeningFor='AnnualRenewal' order by id desc";
	$QueryInvestigators = $mysqli->query($sqlInvestigators);
	$totalInvestigators = $QueryInvestigators->num_rows;
	
		if(!$totalInvestigators){
$sqlA2="insert into ".$prefix."initial_committee_screening (`owner_id`,`protocol_id`,`created`,`updated`,`screening`,`draftopinion`,`recAffiliated_id`,`reviewer_id`,`screeningFor`,`completionStatus`,`collectiveDecision`,`ammendType`,`renewal_id`,`public_title`) 

values('$asrmApplctID_user','$protocol_idmm',now(),now(),'$screening','$draftopinion2','$recAffiliated_id','$asrmApplctID','AnnualRenewal','Completed','Yes','$ammendType','$id','$public_title')";
$mysqli->query($sqlA2);
		}
		//////////////////////////Save Decision and Finalize Process send email
	//sleep(50);	
	////Get Protocl Comments
$sqlSComments = "select * from ".$prefix."initial_committee_screening where reviewer_id='$id' and owner_id='$asrmApplctID_user' and screeningFor='AnnualRenewal'";
$resComments = $mysqli->query($sqlSComments);
while($sqComments = $resComments->fetch_array()){
$screeningmessage.=$sqComments['screening'].'<br>';
}	
		
///Get this meeting Number
$sqlSmeeting = "select * from ".$prefix."meeting where protocol_id='$protocol_idmm' and meetingFor='AnnualRenewal' order by id desc";
$resmeeting = $mysqli->query($sqlSmeeting);
$sqmeeting = $resmeeting->fetch_array();
//$MeetingNumber=$sqmeeting['id'];
//$Meetingdate=date("d/m/Y", strtotime($sqmeeting['date']));

$sqlSRecruitment = "select * from ".$prefix."decision_status where id='$recruitment_status'";
$resRecruitment = $mysqli->query($sqlSRecruitment);
$sqRecruitment = $resRecruitment->fetch_array();

$status=$sqRecruitment['name'];
//$Approvaltoday=date("d/m/Y");
$dateSubmitted=date("Y-m-d G:i:s");
//Get Approval period
$Approvaltoday;
$endofproject = date("d/m/Y", strtotime($Approvaltoday . "+12 month"));	

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
$sqlA2="update ".$prefix."renewals set `status`='$recruitment_status' where id='$id'";
$mysqli->query($sqlA2);

require_once("viewlrcn/mail_contional_approval_renewal.php");
$whatApproved="Annual Renewals";
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
$mail->FromName = "$recOriginalName"; //From Name -- CHANGE --
$mail->AddAddress($owneremail, $ownername); //
//$mail->addCc("mwesigwa.collins@gmail.com","REC Approval Notice");///To UNCST
$mail->AddReplyTo($recemail, $ownername); //Reply-To Address -- CHANGE --$usrm_email

$mail->WordWrap = 50; // set word wrap to 50 characters
$mail->IsHTML(false); // set email format to HTML
$mail->Subject = "Annual Renewal - $public_title";
$body="$allSentMessage
<br><br>
<a href='$base_url/studyrenewal.php?rmd_id=$rstug_UNCSTRefNumber2' style='background:#06F; border: none;  color: white; padding: 15px 32px;  text-align: center;  text-decoration: none;  display: inline-block; font-size: 16px;' target='_blank'>Download/Print PDF</a>";

$mail->MsgHTML($body);

if(!$mail->Send()){
	echo "Mailer Error: " . $mail->ErrorInfo;
}///end	


require_once("./viewlrcn/send_post_approval_text3.php");

 $queryp2w="select * from ".$prefix."study_post_approvals where rmd_id='$rstug_UNCSTRefNumber2' and  ptype='AnnualRenewal' order by id desc";
$cmdw2=$mysqli->query($queryp2w);
if(!$cmdw2->num_rows){
$Insert_sendAp="insert into ".$prefix."study_post_approvals (`rstug_user_id`,`rstug_rsch_project_id`,`refNo`,`approvalMain`,`approvalText1`,`approvalText2`,`approvalText3`,`dateupdated`,`rmd_id`,`signature`,`totaldocs`,`DateApproved`,`studyTools`,`whosigns`,`renewal_id`,`public_title`,`recAffiliated_id`,`ptype`) values ('$asrmApplctID_user','$protocol_idmm','$protocolCode','$sendTextHr','$sendText1','$sendText2','$sendText3',now(),'$rstug_UNCSTRefNumber2','$signature','$nummm','$sendTextDate','$sendTextStudyTools','$whosigns','$renewal_id','$public_title','$recAffiliated_id','AnnualRenewal')";
$mysqli->query($Insert_sendAp);
}

if($cmdw2->num_rows){
$Insert_sendAp2="update ".$prefix."study_post_approvals set `approvalMain`='$sendTextHr',`approvalText1`='$sendText1',`approvalText2`='$sendText2',`approvalText3`='$sendText3',`dateupdated`=now(),`signature`='$signature',`totaldocs`='$nummm',`DateApproved`='$sendTextDate',`studyTools`='$sendTextStudyTools',`whosigns`='$whosigns',`renewal_id`='$renewal_id',`public_title`='$public_title',`recAffiliated_id`='$recAffiliated_id',`ptype`='AnnualRenewal' where rmd_id='$rstug_UNCSTRefNumber2'";
$mysqli->query($Insert_sendAp2);	
}
///Send mail with comments to the PI

$msg="REC ANNUAL RENEWAL: Dear $ownername, your protocol RefNo $protocolCode has been renewed, check your email for more details. $accroname. ";//

echo '<img src="images/loading_wait.gif">';
echo '<div class="spacer"></div>';
echo '<meta http-equiv="refresh" content="6; url='.$base_url.'/main.php?option=AnnualRenualMaREC" />';
		
}////End Approvals, rejects







if($_POST['doSendToEthical']=='Save Decision and Finalize Process' and $_POST['screening'] and ($_POST['recruitment_status']=='Request for Responses') and $_POST['renewal_id'] and $_POST['public_title'] and $_POST['MeetingNumber'] and $_POST['approvaldate']){

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
	$rstug_UNCSTRefNumber2=md5($mysqli->real_escape_string($_POST['renewal_id']));
	$rstug_UNCSTRefNumber=$mysqli->real_escape_string($_POST['renewal_id']);
	$MeetingNumber=$mysqli->real_escape_string($_POST['MeetingNumber']);
	$whosigns=$mysqli->real_escape_string($_POST['whosigns']);
	$Meetingdate=date("d/m/Y", strtotime($_POST['Meetingdate']));
	$Approvaltoday=date("d/m/Y", strtotime($_POST['approvaldate']));
	
	$querypUser="select * from apvr_user where asrmApplctID='$whosigns' order by asrmApplctID desc";
$cmdwUser=$mysqli->query($querypUser);
$rSwUser=$cmdwUser->fetch_array();
$signedby=$rSwUser['name'];
$signedEmail=$rSwUser['email'];
if($rSwUser['signatures']){$signature=$rSwUser['signatures'];}else{$signature="hellensignature.jpg";}
	
	$sqlInvestigators="SELECT * FROM ".$prefix."initial_committee_screening where `owner_id`='$asrmApplctID_user' and screening='$screening' and reviewer_id='$id' and reviewer_id='$asrmApplctID'  and screeningFor='AnnualRenewal' order by id desc";
	$QueryInvestigators = $mysqli->query($sqlInvestigators);
	$totalInvestigators = $QueryInvestigators->num_rows;
	
		if(!$totalInvestigators){
$sqlA2="insert into ".$prefix."initial_committee_screening (`owner_id`,`protocol_id`,`created`,`updated`,`screening`,`draftopinion`,`recAffiliated_id`,`reviewer_id`,`screeningFor`,`completionStatus`,`collectiveDecision`,`ammendType`,`renewal_id`,`public_title`) 

values('$asrmApplctID_user','$protocol_idmm',now(),now(),'$screening','$draftopinion2','$recAffiliated_id','$asrmApplctID','AnnualRenewal','Completed','Yes','$ammendType','$id','$public_title')";
$mysqli->query($sqlA2);
		}
		//////////////////////////Save Decision and Finalize Process send email
	//sleep(50);	
	////Get Protocl Comments
$sqlSComments = "select * from ".$prefix."initial_committee_screening where reviewer_id='$id' and owner_id='$asrmApplctID_user' and screeningFor='AnnualRenewal'";
$resComments = $mysqli->query($sqlSComments);
while($sqComments = $resComments->fetch_array()){
$screeningmessage.=$sqComments['screening'].'<br>';
}	
		
///Get this meeting Number
$sqlSmeeting = "select * from ".$prefix."meeting where protocol_id='$protocol_idmm' and meetingFor='AnnualRenewal' order by id desc";
$resmeeting = $mysqli->query($sqlSmeeting);
$sqmeeting = $resmeeting->fetch_array();
//$MeetingNumber=$sqmeeting['id'];
//$Meetingdate=date("d/m/Y", strtotime($sqmeeting['date']));

$sqlSRecruitment = "select * from ".$prefix."decision_status where id='$recruitment_status'";
$resRecruitment = $mysqli->query($sqlSRecruitment);
$sqRecruitment = $resRecruitment->fetch_array();

$status=$sqRecruitment['name'];
//$Approvaltoday=date("d/m/Y");
$dateSubmitted=date("Y-m-d G:i:s");
//Get Approval period
$Approvaltoday;
$endofproject = date("d/m/Y", strtotime($Approvaltoday . "+12 month"));	

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
$sqlA2="update ".$prefix."renewals set `status`='$recruitment_status' where id='$id'";
$mysqli->query($sqlA2);

require_once("viewlrcn/mail_request_for_responses.php");
$whatApproved="Annual Renewals";
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
$mail->addBcc("mwesigwa.collins@gmail.com","$recOriginalName - REC Responses Notice");//$recchairEmail
$mail->FromName = "$recOriginalName"; //From Name -- CHANGE --
$mail->AddAddress($owneremail, $ownername); //
//$mail->addCc("mawandammoses@gmail.com","REC Approval Notice");///To UNCST
$mail->AddReplyTo($recemail, $ownername); //Reply-To Address -- CHANGE --$usrm_email

$mail->WordWrap = 50; // set word wrap to 50 characters
$mail->IsHTML(false); // set email format to HTML
$mail->Subject = "Annual Renewal - $public_title";
$body="$allSentMessage
<br><br>
<a href='$base_url/studyrenewal.php?rmd_id=$rstug_UNCSTRefNumber2' style='background:#06F; border: none;  color: white; padding: 15px 32px;  text-align: center;  text-decoration: none;  display: inline-block; font-size: 16px;' target='_blank'>Download/Print PDF</a>";

$mail->MsgHTML($body);

if(!$mail->Send()){
	echo "Mailer Error: " . $mail->ErrorInfo;
}///end	


require_once("./viewlrcn/send_post_approval_text4.php");;

 $queryp2w="select * from ".$prefix."study_post_approvals where rmd_id='$rstug_UNCSTRefNumber2' and  ptype='AnnualRenewal' order by id desc";
$cmdw2=$mysqli->query($queryp2w);
if(!$cmdw2->num_rows){
$Insert_sendAp="insert into ".$prefix."study_post_approvals (`rstug_user_id`,`rstug_rsch_project_id`,`refNo`,`approvalMain`,`approvalText1`,`approvalText2`,`approvalText3`,`dateupdated`,`rmd_id`,`signature`,`totaldocs`,`DateApproved`,`studyTools`,`whosigns`,`renewal_id`,`public_title`,`recAffiliated_id`,`ptype`) values ('$asrmApplctID_user','$protocol_idmm','$protocolCode','$sendTextHr','$sendText1','$sendText2','$sendText3',now(),'$rstug_UNCSTRefNumber2','$signature','$nummm','$sendTextDate','$sendTextStudyTools','$whosigns','$renewal_id','$public_title','$recAffiliated_id','AnnualRenewal')";
$mysqli->query($Insert_sendAp);
}

if($cmdw2->num_rows){
$Insert_sendAp2="update ".$prefix."study_post_approvals set `approvalMain`='$sendTextHr',`approvalText1`='$sendText1',`approvalText2`='$sendText2',`approvalText3`='$sendText3',`dateupdated`=now(),`signature`='$signature',`totaldocs`='$nummm',`DateApproved`='$sendTextDate',`studyTools`='$sendTextStudyTools',`whosigns`='$whosigns',`renewal_id`='$renewal_id',`public_title`='$public_title',`recAffiliated_id`='$recAffiliated_id',`ptype`='AnnualRenewal' where rmd_id='$rstug_UNCSTRefNumber2'";
$mysqli->query($Insert_sendAp2);	
}
///Send mail with comments to the PI

$msg="REC ANNUAL RENEWAL: Dear $ownername, your protocol RefNo $protocolCode has been renewed, check your email for more details. $accroname. ";//

echo '<img src="images/loading_wait.gif">';
echo '<div class="spacer"></div>';
echo '<meta http-equiv="refresh" content="6; url='.$base_url.'/main.php?option=AnnualRenualMaREC" />';
		
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
  $sqlstudypp="SELECT * FROM ".$prefix."renewals where id='$id' order by id desc limit 0,1";
$Querystudypp = $mysqli->query($sqlstudypp);
$totalstudypp = $Querystudypp->num_rows;
$rstudypp = $Querystudypp->fetch_array();
?> 

<?php echo $message;?>
  <?php
$sqlgg = "select * FROM ".$prefix."renewals where id='$id'";//and conceptm_status='new' 
$resultgg = $mysqli->query($sqlgg);
$rInvestigatorgg=$resultgg->fetch_array();?>
<?php if($rInvestigatorgg['paymentStatus']=='' || $rInvestigatorgg['paymentStatus']=='Not Paid'){ //Begin Payment Section?>
 <form action="" method="post" name="regForm" id="regForm" enctype="multipart/form-data">
<h4>Update Payment Status</h4>


<div style="width:100%; padding-bottom:8px;">
<select name="paymentStatus" id="paymentStatus" class="form-control required"  onChange="getPayConfirm(this.value)">
<option value="" <?php if($rInvestigatorgg['paymentStatus']==''){?>selected="selected"<?php }?>>Please Select</option>

<option value="Not Paid" <?php if($rInvestigatorgg['paymentStatus']=='Not Paid'){?>selected="selected"<?php }?>>Not Paid</option>
<option value="Review Pending Payment" <?php if($rInvestigatorgg['paymentStatus']=='Review Pending Payment'){?>selected="selected"<?php }?>>Review Pending Payment</option>
<option value="Payment Waiver" <?php if($rInvestigatorgg['paymentStatus']=='Payment Waiver'){?>selected="selected"<?php }?>>Payment Waiver</option>
<option value="Paid" <?php if($rInvestigatorgg['paymentStatus']=='Paid'){?>selected="selected"<?php }?>>Paid</option>

</select>
<div id="getpay"><?php echo $rInvestigatorgg['payments_comment'];?></div>


</div>


<div class="form-group row">
<div class="col-sm-4 offset-sm-3">
<?php
if($_POST['doConfirmPayment']=='Confirm Payment'){
	echo '<img src="images/loading_wait.gif">';
echo '<div class="spacer"></div>';}?>     
<input name="doConfirmPayment" type="submit"  class="btn btn-primary" value="Confirm Payment"/>

<input name="asrmApplctID_user" type="hidden" value="<?php echo $owner_id;?>"/>
<input name="protocol_idmm" type="hidden" value="<?php echo $protocol_idwe;?>"/>
</div>
</div>

         </form>
   <?php }
   //end Payment Section?> 
 
 
 
 
 
 
 <button class="accordion">Protocol Information, click to review</button>
  <div class="panel">
 
  <label><strong>Brief rationale for the Study:</strong> <?php echo $rstudypp['Briefrationale'];?></label><br /><br />

<label><strong>General Research Objective:</strong> <?php echo $rstudypp['GeneralResearchObjective'];?></label><br /><br />

<label><strong>Brief description of the study design, study sites, study population, sample size, and study duration:</strong> <?php echo $rstudypp['StudyMethods'];?></label><br />

  </div>
 
 
  
  
<button class="accordion">Status of Participants & Specimens, click to review</button>
  <div class="panel">
            
    <strong>Status of Participants       in the study</strong><br><br>

Provide the  status of participant enrollment.
<table width="100%" border="1" cellpadding="0" cellspacing="0">
  <tr>
    <td width="4%" valign="top"></td>
    <td width="23%" valign="top"><strong>&nbsp;Participants</strong></td>
    <td width="24%" valign="top"><strong>&nbsp;Number</strong></td>
    <td width="49%" valign="top"><strong>&nbsp;Remarks*</strong></td>
  </tr>
  <tr>
    <td valign="top">&nbsp;1.</td>
    <td valign="top">&nbsp;Approved sample size</td>
    <td valign="top"><input type="text" name="Approvedsamplesize_Number" value="<?php echo $rstudypp['Approvedsamplesize_Number'];?>"  class="form-control  required"></td>
    <td valign="top"><input type="text" name="Approvedsamplesize_Remarks" id="Briefrationale" cols="" rows="5" class="form-control  required" value="<?php echo $rstudypp['Approvedsamplesize_Remarks'];?>">
</td>
  </tr>
  <tr>
    <td valign="top">&nbsp;2.</td>
    <td valign="top">&nbsp;Screened</td>
  <td valign="top"><input type="text" name="Screened_Number" value="<?php echo $rstudypp['Screened_Number'];?>"  class="form-control  required"></td>
    <td valign="top"><input type="text" name="Screened_Remarks" id="Screened_Remarks" cols="" rows="5" class="form-control  required" value="<?php echo $rstudypp['Screened_Remarks'];?>"></td>
  </tr>
  <tr>
    <td valign="top">&nbsp;3.&nbsp;</td>
    <td valign="top">&nbsp;Enrolled</td>
   <td valign="top"><input type="text" name="Enrolled_Number" id="Enrolled_Number" value="<?php echo $rstudypp['Enrolled_Number'];?>"  class="form-control  required"></td>
    <td valign="top"><input type="text" name="Enrolled_Remarks" id="Enrolled_Remarks" cols="" rows="5" class="form-control  required" value="<?php echo $rstudypp['Enrolled_Remarks'];?>"></td>
  </tr>
  <tr>
    <td valign="top">&nbsp;4.</td>
    <td valign="top">&nbsp;Withdrawn</td>
    <td valign="top"><input type="text" name="Withdrawn_Number" id="Withdrawn_Number" value="<?php echo $rstudypp['Withdrawn_Number'];?>"  class="form-control  required"></td>
    <td valign="top"><input type="text" name="Withdrawn_Remarks" id="Withdrawn_Remarks" cols="" rows="5" class="form-control  required" value="<?php echo $rstudypp['Withdrawn_Remarks'];?>"></td>
  </tr>
  <tr>
    <td valign="top">&nbsp;5.</td>
    <td valign="top">&nbsp;Terminated</td>
    <td valign="top"><input type="text" name="Terminated_Number" id="Terminated_Number" value="<?php echo $rstudypp['Terminated_Number'];?>"  class="form-control  required"></td>
    <td valign="top"><input type="text" name="Terminated_Remarks" id="Terminated_Remarks" cols="" rows="5" class="form-control  required" value="<?php echo $rstudypp['Terminated_Remarks'];?>"></td>
  </tr>
  <tr>
    <td valign="top">&nbsp;6.</td>
    <td valign="top">&nbsp;Lost to follow up</td>
    <td valign="top"><input type="text" name="Losttofollowup_Number" id="Losttofollowup_Number" value="<?php echo $rstudypp['Losttofollowup_Number'];?>"  class="form-control  required"></td>
    <td valign="top"><input type="text" name="Losttofollowup_Remarks" id="Losttofollowup_Remarks" class="form-control  required" value="<?php echo $rstudypp['Losttofollowup_Remarks'];?>"></td>
  </tr>
  <tr>
    <td valign="top">&nbsp;7.</td>
    <td valign="top">&nbsp;Died</td>
   <td valign="top"><input type="text" name="Died_Number" id="Died_Number" value="<?php echo $rstudypp['Died_Number'];?>"  class="form-control  required"></td>
    <td valign="top"><input type="text" name="Died_Remarks" id="Died_Remarks" class="form-control  required" value="<?php echo $rstudypp['Died_Remarks'];?>"></td>
  </tr>
</table>
*Give relevant  explanation where necessary<br><br>
<strong>Specimens description (where applicable):</strong>
<table width="100%" border="1" cellpadding="0" cellspacing="0">
  <tr>
    <td width="38" valign="top"></td>
    <td width="239" valign="top"><strong>&nbsp;Specimens</strong></td>
    <td width="257" valign="top"><strong>&nbsp;Number</strong></td>
    <td width="516" valign="top"><strong>&nbsp;Remarks*</strong></td>
  </tr>
  <tr>
    <td width="38" valign="top">&nbsp;1.&nbsp;</td>
    <td width="239" valign="top">&nbsp;Approved sample size</td>
    <td valign="top"><input type="text" name="ApprovedSampleSizeSpecimens_Number" id="ApprovedSampleSizeSpecimens_Number" value="<?php echo $rstudypp['ApprovedSampleSizeSpecimens_Number'];?>"  class="form-control  required"></td>
    <td valign="top"><input type="text" name="ApprovedSampleSizeSpecimens_Remarks" id="ApprovedSampleSizeSpecimens_Remarks" cols="" rows="5" class="form-control  required" value="<?php echo $rstudypp['ApprovedSampleSizeSpecimens_Remarks'];?>"></td>
  </tr>
  <tr>
    <td width="38" valign="top">&nbsp;2.</td>
    <td width="239" valign="top">&nbsp;Samples analyzed </td>
    <td valign="top"><input type="text" name="SamplesAnalyzed_Number" id="SamplesAnalyzed_Number" value="<?php echo $rstudypp['SamplesAnalyzed_Number'];?>"  class="form-control  required"></td>
    <td valign="top"><input type="text" name="SamplesAnalyzed_Remarks" id="SamplesAnalyzed_Remarks" cols="" rows="5" class="form-control  required" value="<?php echo $rstudypp['SamplesAnalyzed_Remarks'];?>"></td>
  </tr>
  <tr>
    <td width="38" valign="top">&nbsp;3.&nbsp;</td>
    <td width="239" valign="top">&nbsp;Withdrawn consent</td>
<td valign="top"><input type="text" name="WithdrawnConsent_Number" id="WithdrawnConsent_Number" value="<?php echo $rstudypp['WithdrawnConsent_Number'];?>"  class="form-control  required"></td>
    <td valign="top"><input type="text" name="WithdrawnConsent_Remarks" id="WithdrawnConsent_Remarks" cols="" rows="5" class="form-control  required" value="<?php echo $rstudypp['WithdrawnConsent_Remarks'];?>"></td>
  </tr>
</table>
*Give relevant  explanation where necessary                  
  </div>
  

  <?php
  $sqlstudyppt="SELECT * FROM ".$prefix."renewals_summary where annual_id='$id' order by id desc limit 0,1";
$Querystudyppt = $mysqli->query($sqlstudyppt);
$totalstudyppt = $Querystudyppt->num_rows;
$rstudyppt = $Querystudyppt->fetch_array();

$sqlUsersLit1="SELECT * FROM ".$prefix."renewals_literature where annual_id='$id' order by id desc limit 0,20";
$QueryUsersLit1 = $mysqli->query($sqlUsersLit1);
?>

<button class="accordion">Literature & Challanges, click to review</button>
  <div class="panel">
  


 <label>If there have been any new publications in the area of study, including those from your study, provide a brief summary of these stating the implication they might have on continuation of your research.</label> <br /><br />

<table width="80%" border="0" id="customers2">
        <tr>
            <th><strong>Source</strong></th>
            <th><strong>Brief description</strong></th>

            <th><strong>Implication on your research</strong></th>

        </tr>
     <?php  while($rstudyppLIT = $QueryUsersLit1->fetch_array()){?>
        <tr>
            <td><?php echo $rstudyppLIT['source'];?>
            </td>
            <td><?php echo $rstudyppLIT['BriefDescription'];?></td>
            
              <td><?php echo $rstudyppLIT['Implicationonresearch'];?>
            </td>
        
        </tr> <?php }?>
    </table>


<label><strong>Summary of Adverse Events:</strong></label><br />


<label><strong>Provide a summary of numbers of all the adverse events observed and their severity and types (use extra sheet if necessary).</strong> <?php echo $rstudyppt['AdverseEvents'];?></label><br /><br />


<label><strong>Summary of Protocol Deviations and Violations:</strong></label><br />


<label><strong>Provide a summary of any protocol deviations or violations during the reporting period.</strong> <?php echo $rstudyppt['summaryProtocolDeviations'];?></label><br /><br />


<label><strong>Summary of Site Activities:</strong></label><br />
<label><strong>Give a summary of other relevant activities carried out at the site including training of study staff and facilities upgraded and new changes in management of the study.</strong> <?php echo $rstudyppt['SummarySiteActivities'];?></label><br /><br />


<label><strong>Challenges:</strong></label><br />
<label><strong>Briefly state any challenges encountered during the reporting period, and steps taken to address them.</strong> <?php echo $rstudyppt['Challenges'];?></label><br /><br />



  </div>
  
    <button class="accordion">Future Plans/Activities</button>
  <div class="panel">
  <?php echo $rstudyppt['FuturePlans'];?>
  </div>
      
<button class="accordion">Attachments</button>
  <div class="panel">
  
  <div  class="success">


 <table class="table table-striped table-sm" id="customers">
                  <thead>
                          <tr>
                            <th>Attachment</th>
                            <th>File name</th>
            
                            <th>Date</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php

						
//if no page var is given, set start to 0
$sql = "select *,DATE_FORMAT(`attachment_date`,'%Y-%m-%d') AS attachment_date FROM ".$prefix."renewals_attachments where  renewal_id='$id' order by id desc LIMIT 0,200";//and conceptm_status='new' 
$result = $mysqli->query($sql);
while($rInvestigator=$result->fetch_array()){
	
$submittedBy=$rInvestigator['user_id'];
//user
$sqlUserup = "select * FROM ".$prefix."user where asrmApplctID='$submittedBy'";//and conceptm_status='new' 
$resultUser = $mysqli->query($sqlUserup);
$rUsers=$resultUser->fetch_array();
	?>
                          <tr>
                            <td>
                            
                            <?php if($today<$rInvestigator['attachment_date']){?>
<a href="./cfxdownload.php?rew=<?php echo $rInvestigator['id'];?>" target="_blank">View Attachment</a>
<?php }else{?>
<a href="./cfxdownload.php?rew=<?php echo $rInvestigator['id'];?>" target="_blank">View Attachment</a>
<?php }?><br />
                            </td>
                            <td><?php echo $rInvestigator['filename'];?></td>
                         
                            <td><?php echo $rInvestigator['attachment_date'];?></td>

                          </tr>
   <?php }///////////end function ?> 
   
   <?php
//if no page var is given, set start to 0
$sqlPrevious = "select *,DATE_FORMAT(`created`,'%Y-%m-%d') AS created FROM ".$prefix."submission_upload where user_id='$owner_id' and submission_id='$protocol_idwe' order by id desc LIMIT 0,150";//and conceptm_status='new' 
$resultPrevious = $mysqli->query($sqlPrevious);
while($rInvestigatorPrevious=$resultPrevious->fetch_array()){
$upload_type_id=$rInvestigatorPrevious['upload_type_id'];
$submittedBy=$rInvestigatorPrevious['user_id'];

$filem = "select * FROM ".$prefix."upload_type where id='$upload_type_id'";//and conceptm_status='new' 
$resultfile = $mysqli->query($filem);
$rfile=$resultfile->fetch_array();
//user
$sqlUserup = "select * FROM ".$prefix."user where asrmApplctID='$submittedBy'";//and conceptm_status='new' 
$resultUser = $mysqli->query($sqlUserup);
$rUsers=$resultUser->fetch_array();
	?>
                          <tr>
                            <td>  <?php if($today<$rInvestigatorPrevious['created']){?>
<a href="./cfxdownload.php?rew=<?php echo $rInvestigatorPrevious['id'];?>" target="_blank">View Attachment</a>
<?php }else{?>
<a href="./cfxdownload.php?rew=<?php echo $rInvestigatorPrevious['id'];?>" target="_blank">View Attachment</a>
<?php }?><br />
                            
                            </td>
                            <td><?php if($rInvestigatorPrevious['othername']){echo $rInvestigatorPrevious['othername'];}else{echo $rfile['name'];}?></td>
                         
                            <td><?php echo $rInvestigatorPrevious['created'];?></td>
<td></td>
                          </tr>
   <?php }///////////end function ?> 
                   
                        </tbody>
                      </table>
  
  </div>
  </div>

 
 <?php 
  
if($category=='AssignRenewalReviewersDel' and $id and $_GET['sid']){
    $sid=$_GET['sid'];
	$sqlA2Protocol2="delete from ".$prefix."submission_review_sr where  id='$sid'";
	$mysqli->query($sqlA2Protocol2);
	$message='<p class="error2">Reviewer has been removed.</p>';
	}
  ///ConfirmRenewalPayment?>
    
<?php if($category=='AssignRenewalReviewers' and $session_privillage=='recadmin' || $session_privillage=='rechairperson' || $session_privillage=='revicechairperson' || $category=='AssignRenewalReviewersDel' || $session_privillage=='recitadmin'){?>    
 <button class="accordion">Assign Reviewers</button>
  <div class="panelss">   
   <?php
   ///////////////////Assign Reviewers
$sqlgg = "select * FROM ".$prefix."initial_committee_screening where owner_id='$owner_id' and protocol_id='$protocol_idwe' and screeningFor='AnnualRenewal'";//and conceptm_status='new' 
$resultgg = $mysqli->query($sqlgg);
$rInvestigatorgg=$resultgg->fetch_array();


?>

<?php 
if($rstudym['paymentStatus']=='Paid' || $rstudym['paymentStatus']=='Review Pending Payment'|| $rstudym['paymentStatus']=='Payment Waiver'){?>
<button id="myBtn">Click to Add Reviewers to this Renewal</button>   
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
$sqlProtocols="SELECT * FROM ".$prefix."submission_review_sr  where renewal_id='$id' and recstatus='new'";
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
	<input name="reviewer[]" type="hidden" value="<?php echo $sqReviewer['asrmApplctID'];?>"  class="required" checked="checked"/>
	<?php echo $sqReviewer['name'];?>
    
    <input name="public_title" type="hidden" value="<?php echo $public_title;?>" />
    </td>
    
    
    <td width="22%" align="left" style="padding-bottom:20px;" class="defmf2"><?php echo $sqProtocols['reviewtype'];?> </td>
    <td width="48%" align="left" class="defmf2"><?php echo $sqProtocols['subject'];?></td>
    <td width="48%" align="left" class="defmf2"><a href="main.php?option=AssignRenewalReviewersDel&id=<?php echo $id;?>&sid=<?php echo $sqProtocols['id'];?>" style="color:#F00; font-weight:bold;" onclick="return confirm('Are you sure you want to delete this item?');">Delete</a></td>
  </tr>
<?php } //end loop ?>



</table>
<?php if($rTotalAnyAssigned){?><input name="doAssignReviewesConfirm" type="submit"  class="btn btn-primary" value="Assign Now"/><?php }?>
         </form>
<?php }?>
</div> 
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
<input name="ammendType" type="hidden" value="<?php echo $rstudym['ammendType'];?>"/>
<input name="public_title" type="hidden" value="<?php echo $public_title;?>"/>
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

<?php /*?><div class="form-group row">

  <label class="col-sm-3 form-control-label">Meeting Subject: <span class="error">*</span></label>
  <div class="col-sm-8">

  <select name="Meetingsubject" id="Meetingsubject" class="form-control  required" required>
  <option value="">Please Select</option>
<?php
$sqlMeeting="SELECT * FROM ".$prefix."meeting  where recAffiliated_id='$recAffiliated_id' and date>='$today' and protocol_id='$protocol_idwe' and meetingFor='AnnualRenewal'";
$QueryMeeting=$mysqli->query($sqlMeeting);
while($sqMeeting = $QueryMeeting->fetch_array()){?>
<option value="<?php echo $sqMeeting['subject'];?>"><?php echo $sqMeeting['subject'];?></option>
<?php }?>
</select>

</div>
</div><?php */?>

       <div class="form-group row">
   <div class="col-sm-8 offset-sm-3sss">
   <?php
$sqlMeeting2="SELECT * FROM ".$prefix."meeting  where recAffiliated_id='$recAffiliated_id' and date>='$today' and protocol_id='$protocol_idwe' and meetingFor='AnnualRenewal'";
$QueryMeeting2=$mysqli->query($sqlMeeting2);
$protocolMeeting2 = $QueryMeeting2->num_rows;
//if(!$protocolMeeting2){echo "<span  style='color:#F00;'>Please Add meeting, Protocol will not be assigned without creating a meeting</span>";}
//if($protocolMeeting2){
?>
<input name="doAssignReviewes" type="submit"  class="btn btn-primary" value="Save Details"/>
<?php //}?>
                          </div>
                        </div>
                                          
     </form>                   
    </div>
    </div>
    </div><!--End-->
    
    
    <button class="accordion">Comments, click to review </button>
  <div class="panel">
   <table id="customers">
                        <thead>
                          <tr>
                            <th>Date & Time</th>
                            <th>Reviewer</th>
                            <th>Message</th>
 
                          </tr>
                        </thead>
                        <tbody>
                        <?php
//if no page var is given, set start to 0
$sql = "select *,DATE_FORMAT(`created`,'%d/%m/%Y') AS created FROM ".$prefix."initial_committee_screening where renewal_id='$id' and screeningFor='AnnualRenewal' order by id desc LIMIT 0,100";//and conceptm_status='new'

$result = $mysqli->query($sql);
while($rInvestigator=$result->fetch_array()){
$upload_type_id=$rInvestigator['upload_type_id'];
$reviewer_id=$rInvestigator['reviewer_id'];

//user
$sqlUserup = "select * FROM ".$prefix."user where asrmApplctID='$reviewer_id'";//and conceptm_status='new' 
$resultUser = $mysqli->query($sqlUserup);
$rUsers=$resultUser->fetch_array();
	?>
                         <tr>
                            <td valign="top"><?php echo $rInvestigator['created'];?></td>
                            <td valign="top"><?php echo $rUsers['name'];?></td>
                            <td><?php echo $rInvestigator['screening'];?></td>

                          </tr>
   <?php }///////////end function ?>                 
                        </tbody>
                      </table>
  </div>
 
 
 <?php if($category=='DecisionRenewalReviewers' and $session_privillage=='recadmin' || $session_privillage=='rechairperson' || $session_privillage=='recitadmin'){?>    
<div class="successm">    
    
      <hr />
<div style="margin-bottom:10px;"></div>

 <h4 style="padding: 15px;
position: relative;
display: block;
margin: 5px 0;
border-radius: 3px;
color: #ffffff;
font-weight: bold;
background-color:#C30 !important;
font-size: 16px;">Documents to be included on Decision letter</h4>
 <hr />
 
 
 
  

 <?php
if($_POST['doUpdateDocuments']=='Update Documents'){

for ($i=0; $i < count($_POST['includedon_approval']); $i++) {
	
//foreach($_POST['includedon_approval'] as $cfn_includedon_approval) {
//$cfn_includedon_approval= $cfn_includedon_approval;
$cfn_includedon_approval= $mysqli->real_escape_string($_POST['includedon_approval'][$i]);

$includedm= $mysqli->real_escape_string($_POST['includedm'][$i]);
$sqlA2rr="update ".$prefix."renewals_attachments set includedon_approval='$includedm' where owner_id='$owner_id' and renewal_id='$id' and id='$cfn_includedon_approval'";
$mysqli->query($sqlA2rr);
}


for ($i=0; $i < count($_POST['includedon_approval2']); $i++) {
	
//foreach($_POST['includedon_approval'] as $cfn_includedon_approval) {
//$cfn_includedon_approval= $cfn_includedon_approval;
$includedon_approval2= $mysqli->real_escape_string($_POST['includedon_approval2'][$i]);

$includedm2= $mysqli->real_escape_string($_POST['includedm2'][$i]);
$sqlA2rr2="update ".$prefix."submission_upload set includedon_approvalRenewal='$includedm2' where user_id='$owner_id' and submission_id='$protocol_idwe' and id='$includedon_approval2'";
$mysqli->query($sqlA2rr2);
}

}
?>
 <form action="" method="post" name="regForm" id="regForm" autocomplte="off" enctype="multipart/form-data">
  <table class="table table-striped table-sm">
                        <thead>
                          <tr>
                          <th>&nbsp;</th>
                            <th>Attachment</th>
                            <th>File name</th>
                            <th>Date</th>
                         

                          </tr>
                        </thead>
                        <tbody>
                        <?php
//if no page var is given, set start to 0
$sql = "select *,DATE_FORMAT(`attachment_date`,'%d/%m/%Y') AS attachment_date,DATE_FORMAT(`attachment_date`,'%Y-%m-%d') AS created FROM ".$prefix."renewals_attachments where  renewal_id='$id' order by id desc LIMIT 0,200";//and conceptm_status='new' 
$result = $mysqli->query($sql);
while($rInvestigator=$result->fetch_array()){

$submittedBy=$rInvestigator['owner_id'];

//user
$sqlUserup = "select * FROM ".$prefix."user where asrmApplctID='$submittedBy'";//and conceptm_status='new' 
$resultUser = $mysqli->query($sqlUserup);
$rUsers=$resultUser->fetch_array();
	?>
                          <tr>
                          <td style="background:#F00;" align="center"> <input name="includedon_approval[]" type="hidden" value="<?php echo $rInvestigator['id'];?>" class="required" />
                          <select name="includedm[]" class="required">
                          <option value="No" <?php if($rInvestigator['includedon_approval']=='No'){?>selected="selected"<?php }?>>No</option>
                          <option value="Yes" <?php if($rInvestigator['includedon_approval']=='Yes'){?>selected="selected"<?php }?>>Yes</option>
                          </select>
                          
                          
                          </td>
                            <td>
                            
                            <?php if($today<$rInvestigator['created']){?>
<a href="./cfxdownload.php?rew=<?php echo $rInvestigator['id'];?>" target="_blank">View Attachment</a>
<?php }else{?>
<a href="./cfxdownload.php?rew=<?php echo $rInvestigator['id'];?>" target="_blank">View Attachment</a>
<?php }?><br />
                            
                            </td>
                            <td><?php if($rInvestigator['othername']){echo $rInvestigator['othername'];}else{echo $rInvestigator['filename'];}?></td>
                            <td><?php echo $rInvestigator['attachment_date'];?></td>
                           

                          </tr>
   <?php }///////////end function ?>  
   
   <?php
//if no page var is given, set start to 0
$sqlPrevious = "select *,DATE_FORMAT(`created`,'%d/%m/%Y') AS created FROM ".$prefix."submission_upload where user_id='$owner_id' and submission_id='$protocol_idwe' order by id desc LIMIT 0,150";//and conceptm_status='new' 
$resultPrevious = $mysqli->query($sqlPrevious);
while($rInvestigatorPrevious=$resultPrevious->fetch_array()){
$upload_type_id=$rInvestigatorPrevious['upload_type_id'];
$submittedBy=$rInvestigatorPrevious['user_id'];

$filem = "select * FROM ".$prefix."upload_type where id='$upload_type_id'";//and conceptm_status='new' 
$resultfile = $mysqli->query($filem);
$rfile=$resultfile->fetch_array();
//user
$sqlUserup = "select * FROM ".$prefix."user where asrmApplctID='$submittedBy'";//and conceptm_status='new' 
$resultUser = $mysqli->query($sqlUserup);
$rUsers=$resultUser->fetch_array();
	?>
                          <tr>
                          
                           <td style="background:#F00;" align="center">
                            
                           <input name="includedon_approval2[]" type="hidden" value="<?php echo $rInvestigatorPrevious['id'];?>" class="required" />
                          <select name="includedm2[]" class="required">
                          <option value="No" <?php if($rInvestigatorPrevious['includedon_approvalRenewal']=='No'){?>selected="selected"<?php }?>>No</option>
                          <option value="Yes" <?php if($rInvestigatorPrevious['includedon_approvalRenewal']=='Yes'){?>selected="selected"<?php }?>>Yes</option>
                          </select> 
                            
                            
                            </td>
                            <td>
                              <?php if($today<$rInvestigatorPrevious['created']){?>
<a href="./cfxdownload.php?rew=<?php echo $rInvestigatorPrevious['id'];?>" target="_blank">View Attachment</a>
<?php }else{?>
<a href="./cfxdownload.php?rew=<?php echo $rInvestigatorPrevious['id'];?>" target="_blank">View Attachment</a>
<?php }?><br />
                            </td>
                            <td><?php if($rInvestigatorPrevious['othername']){echo $rInvestigatorPrevious['othername'];}else{echo $rfile['name'];}?></td>
                         
                            <td><?php echo $rInvestigatorPrevious['created'];?></td>
<td></td>
                          </tr>
   <?php }///////////end function ?>
   
                  
                        </tbody>
                      </table>
                      
<div class="form-group row" style="float:left; padding-right:20%; margin-bottom:15px;">
<div class="col-sm-4 offset-sm-3">
<input name="doUpdateDocuments" type="submit"  class="btn btn-primary" value="Update Documents"/>

</div>
</div>
 <div style="clear:both;"></div>  
   </form>
   
   
  
   
   <button class="accordion">Final Decision</button>
  <div class="panelm"> 
   <!--Approve Renewal--> 
<?php 
$sqlSMeeting = "select * from ".$prefix."meeting where protocol_id='$protocol_idwe' and meetingFor='AnnualRenewal' order by id desc";
$resultSMeeting = $mysqli->query($sqlSMeeting);
$sqUserMeeting = $resultSMeeting->fetch_array();

if($rstudym['status']!='Approved'){?>    
   <?php
$sqlgg2 = "select * FROM ".$prefix."initial_committee_screening where owner_id='$owner_id' and renewal_id='$id'  and reviewer_id='$asrmApplctID' and screeningFor='AnnualRenewal' order by id desc";//and conceptm_status='new' 
$resultgg2 = $mysqli->query($sqlgg2);
$rInvestigatorgg2=$resultgg2->fetch_array();?>
 <form action="" method="post" name="regForm" id="regForm" enctype="multipart/form-data">
 
 <div class="form-group row success">

Meeting Number <font color="#CC0000">*</font><br />
<input name="MeetingNumber" type="text" value="" class="form-control required"/>
</div>

<div class="form-group row success">
Meeting /Decision Date <font color="#CC0000">*</font><br />
<input name="Meetingdate" type="date" value="" class="form-control required"/>
</div>

<div class="form-group row success">
Approval Date <font color="#CC0000">*</font><br />
<input name="approvaldate" type="date" value="" class="form-control required"/>
</div>

<div class="form-group row success">
<h4>Collective Decisions (Comments will be shared with PI):</h4>
<label class="col-sm-6 form-control-label">Comments from the Committee Review Meeting  (About this protocol):</label>
<textarea name="screening" id="screening" cols="" rows="5" class="form-control  required"><?php echo $rInvestigatorgg2['screening'];?></textarea>

<input name="asrmApplctID_user" type="hidden" value="<?php echo $owner_id;?>"/>
<input name="protocol_idmm" type="hidden" value="<?php echo $protocol_idwe;?>"/>
<input name="submission_idm" type="hidden" value="<?php echo $id;?>"/>
<input name="public_title" type="hidden" value="<?php echo $public_title;?>"/>
<input name="studyRefNo" type="hidden" value="<?php echo $rprotocalSub2Sel['code'];?>"/>
<input name="reviewer_id" type="hidden" value="<?php echo $_SESSION['asrmApplctID'];?>"/>
<input name="recAffiliated_id" type="hidden" value="<?php echo $recAffiliated_id;?>"/>
<input name="renewal_id" type="hidden" value="<?php echo $rstudym['id'];?>"/>
<input name="ammendType" type="hidden" value="<?php echo $rstudym['ammendType'];?>"/>
<input name="code" type="hidden" value="<?php echo $rstudym['code'];?>"/>
</div>
<div class="line"></div>


<div class="form-group row success">
<label class="col-sm-4 form-control-label">Choose Action:</label>
<select name="recruitment_status" id="recruitment_status" class="form-control  required"  onChange="getInnitialApprovalDateRenewal(this.value)">
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
<div id="initialrenewaldate"></div>

</div>


<div class="form-group row success">


<select name="whosigns" id="whosigns" class="form-control  required" style=" width:500px!important;" >
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


<div class="form-group row">
                          <div class="col-sm-4 offset-sm-3">
                    <input name="doSendToEthical" type="submit"  class="btn btn-primary" value="Save Decision and Finalize Process"/>

                          </div>
                        </div>
         </form>
 
 <?php }?>  </div> 
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