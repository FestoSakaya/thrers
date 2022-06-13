<ul id="countrytabs" class="shadetabs">
<li><a href="./main.php?option=initialCommitteeReview&id=<?php echo $id;?>">Reviewer Comments</a></li>
<li><a href="./main.php?option=initialCommitteeReviews&id=<?php echo $id;?>">Initial Committee Review</a></li>
<li><a href="#" rel="#default" class="selected">End Review</a></li>
</ul>

<div id="countrydivcontainer" style="border:0px solid gray; width:100%; margin-bottom: 1em; padding: 10px">
<?php
$sqlstudym="SELECT * FROM ".$prefix."submission where id='$id' order by id desc limit 0,1";
$Querystudym = $mysqli->query($sqlstudym);
$rstudym = $Querystudym->fetch_array();
$owner_id=$rstudym['owner_id'];
$protocol_idwe=$rstudym['protocol_id'];
$submission_idm=$rstudym['id'];
$public_title=$rstudym['public_title'];
$type_of_review=$rstudym['type_of_review'];


$sqlstudymMain="SELECT * FROM ".$prefix."protocol where id='$id' order by id desc limit 0,1";
$QuerystudymMain = $mysqli->query($sqlstudymMain);
$rstudymMain = $QuerystudymMain->fetch_array();
$refNo=$rstudymMain['code'];

$sqlprotocalSubSel="SELECT * FROM ".$prefix."protocol where id='$protocol_idwe' and owner_id='$owner_id'";
$QprotocalSub2Sel = $mysqli->query($sqlprotocalSubSel);
$rprotocalSub2Sel = $QprotocalSub2Sel->fetch_array();


$sqlSRR = "select * from ".$prefix."user where asrmApplctID='$owner_id'";
$resultSSS = $mysqli->query($sqlSRR);
$sqUserdd = $resultSSS->fetch_array();

if($_POST['doEndReview']=='Save Decision and Finalize Process' and $_POST['public_title'] and $id and $_POST['recruitment_status']=='Approved' and $_POST['whosigns'] and $_POST['Meetingdate'] and $refNo and $_POST['approvaldate']){
	
require("viewlrcn/class.phpmailer.php");
require("viewlrcn/class.smtp.php");

	$asrmApplctID_user=$mysqli->real_escape_string($_POST['asrmApplctID_user']);
	$protocol_idmm=$mysqli->real_escape_string($_POST['protocol_idmm']);
	$recruitment_status=$mysqli->real_escape_string($_POST['recruitment_status']);
	$period=$mysqli->real_escape_string($_POST['period']);
	$submission_idm=$mysqli->real_escape_string($_POST['submission_idm']);
	$public_title=$mysqli->real_escape_string($_POST['public_title']);
	$studyRefNo=$mysqli->real_escape_string($_POST['studyRefNo']);
	$reviewer_id=$mysqli->real_escape_string($_POST['reviewer_id']);
	$riskLevel=$mysqli->real_escape_string($_POST['riskLevel']);
	$protocolCode=$mysqli->real_escape_string($_POST['protocolCode']);
	$recruitment_status=$_POST['recruitment_status'];
	$type_of_review=$mysqli->real_escape_string($_POST['type_of_review']);
	$whosigns=$mysqli->real_escape_string($_POST['whosigns']);
	$MeetingNumber=$mysqli->real_escape_string($_POST['MeetingNumber']);
	$Meetingdate=date("d/m/Y", strtotime($_POST['Meetingdate']));
	
	
	
$querypUser="select * from apvr_user where asrmApplctID='$whosigns' order by asrmApplctID desc";
$cmdwUser=$mysqli->query($querypUser);
$rSwUser=$cmdwUser->fetch_array();
$signedby=$rSwUser['name'];
$signedEmail=$rSwUser['email'];
if($rSwUser['signatures']){$signature=$rSwUser['signatures'];}else{$signature="hellensignature.jpg";}

////Get Protocl Comments
$sqlSComments = "select * from ".$prefix."initial_committee_screening where protocol_id='$protocol_idmm' and owner_id='$asrmApplctID_user' and collectiveDecision='Yes' order by id desc limit 0,1";
$resComments = $mysqli->query($sqlSComments);
while($sqComments = $resComments->fetch_array()){
$screeningmessage.=nl2br($sqComments['screening']).'<br>';
$draftopinion.=strlen($sqComments['draftopinion']);
}
///Get this meeting Number
if($type_of_review!='Expedited Review'){
$sqlSmeeting = "select * from ".$prefix."meeting where protocol_id='$protocol_idmm' order by id desc limit 0,1";
$resmeeting = $mysqli->query($sqlSmeeting);
$sqmeeting = $resmeeting->fetch_array();
//$MeetingNumber=$sqmeeting['id'];
//$Meetingdate=date("d/m/Y", strtotime($sqmeeting['date']));
}
$sqlSReviewDate = "select * from ".$prefix."submission_review_sr where protocol_id='$protocol_idmm' order by id desc limit 0,1";
$resReviewDate = $mysqli->query($sqlSReviewDate);
$TotalAnyReviewer=$resReviewDate->num_rows;

if($type_of_review=='Expedited Review' and $TotalAnyReviewer){
$sqmReviewDate = $resReviewDate->fetch_array();
//$MeetingNumber=$sqmReviewDate['id'];
//$Meetingdate=date("d/m/Y", strtotime($sqmReviewDate['reviewDate']));
}

if($type_of_review=='Expedited Review' and !$TotalAnyReviewer){
//$MeetingNumber=$sqmReviewDate['id'];
//$Meetingdate=date("d/m/Y");
}


$sqlSReviewDate = "select * from ".$prefix."submission_review_sr where protocol_id='$protocol_idmm' order by id desc limit 0,1";
$resReviewDate = $mysqli->query($sqlSReviewDate);
$TotalAnyReviewer=$resReviewDate->num_rows;

if($type_of_review=='Expedited Review' and $TotalAnyReviewer){
$sqmReviewDate = $resReviewDate->fetch_array();
//$MeetingNumber=$sqmReviewDate['id'];
//$Meetingdate=date("d/m/Y", strtotime($sqmReviewDate['reviewDate']));
}

if($type_of_review=='Expedited Review' and !$TotalAnyReviewer){
//$MeetingNumber=$sqmReviewDate['id'];
//$Meetingdate=date("d/m/Y");
}

$sqlSRecruitment = "select * from ".$prefix."decision_status where id='$recruitment_status'";
$resRecruitment = $mysqli->query($sqlSRecruitment);
$sqRecruitment = $resRecruitment->fetch_array();

$status=$sqRecruitment['name'];
$Approvaltoday=date("d/m/Y", strtotime($_POST['approvaldate']));
//$Approvaltoday=date("d/m/Y");
$dateSubmitted=date("Y-m-d G:i:s");
//Get Approval period
$Approvaltoday;
$endofproject = date("d/m/Y", strtotime($_POST['approvaldate'] . "+12 month"));

$nummm=1;
$restudytools="select * from ".$prefix."submission_upload where  user_id='$asrmApplctID_user' and submission_id='$protocol_idmm' and includedon_approval='Yes' order by id desc";
$cmdtools = $mysqli->query($restudytools);
while($DBtools= $cmdtools->fetch_array()){
	$nummm+1;
$upload_type_id=$DBtools['upload_type_id'];
$sqlSDocName = "select * from ".$prefix."upload_type where id='$upload_type_id'";
$resRDocName = $mysqli->query($sqlSDocName);
$sqReDocName = $resRDocName->fetch_array();
if($DBtools['othername']){$newDocuName=$DBtools['othername'];}
if(!$DBtools['othername']){$newDocuName=$sqReDocName['name'];}

$DocumentsSubmitted.="

  <tr>
    <td width='6%' valign='top'>&nbsp;$nummm </td>
    <td width='27%' valign='top'>&nbsp;$newDocuName</td>
    <td width='40%' valign='top'>&nbsp;$DBtools[Language]</td>
    <td width='12%' valign='top'>&nbsp;$DBtools[Version]</td>
    <td width='13%' valign='top'>&nbsp;$DBtools[DateofProposal]</td>
  </tr>
 "; $nummm++;}

$sqlMyrecnamew="SELECT * FROM ".$prefix."list_rec_affiliated where id='$recAffiliated_id'";
$sqlFMyreccnaw=$mysqli->query($sqlMyrecnamew);
$recNamew=$sqlFMyreccnaw->fetch_array();

	$contacts=$recNamew['contacts'];
	$recOriginalName=$recNamew['name'];
	$recchairEmail=$recNamew['recchairEmail'];
	$recemail=$recNamew['recemail'];
    $accroname=$recNamew['accroname'];
	$rec_header=$recNamew['recheader'];
////Get Templates for Innitial Review and Expedited Review 	type_of_review
if($type_of_review=='Expedited Review'){///use this template
$reviewText="I am pleased to inform you that the $recOriginalName, through expedited review held on <b>$Meetingdate</b> approved the above referenced study.";	
	
}

if($type_of_review!='Expedited Review'){///use this template
$reviewText="I am pleased to inform you that at the <b>$MeetingNumber</b> convened meeting on <b>$Meetingdate</b>,</strong> the $recOriginalName,  committee meeting, etc voted to approve the above referenced application.";	
	
}

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
/////////////////////////////////////////submission_upload//////////////////////	
$sqlSProtocol = "select * from ".$prefix."submission_upload where user_id='$asrmApplctID_user' and submission_id='$protocol_idmm' and upload_type_id='1' and includedon_approval='Yes' order by id desc";
$resOwnerProtocol = $mysqli->query($sqlSProtocol);
$sqOProtocol = $resOwnerProtocol->fetch_array();
$ProtocolVersion=$sqOProtocol['Version'];
$ProtocolLanguage=$sqOProtocol['Language'];
$DateofProposal=$sqOProtocol['DateofProposal'];

$sqlA2="update ".$prefix."protocol set `monitoring_action_id`='$recruitment_status',`period`='$period',`end_of_project`='$endofproject' where `owner_id`='$asrmApplctID_user' and `id`='$protocol_idmm'";
$mysqli->query($sqlA2);

$sqlA23="update ".$prefix."submission set `status`='$recruitment_status',`end_of_project`='$endofproject',`end_of_project2`='$endofproject',`meeting_status`='Completed',`reviewer_id`='$reviewer_id',`recmd_id`='$rstug_UNCSTRefNumber2' where `owner_id`='$asrmApplctID_user' and `id`='$submission_idm'";
$mysqli->query($sqlA23);

$sqlA2ProtocolTable="update ".$prefix."protocol  set `decision_in`=now() where id='$submission_idm' and owner_id='$asrmApplctID_user'";
$mysqli->query($sqlA2ProtocolTable);

$message='<p class="success">Review was completed successfully. Thank You</p>';
//send email to protocol owner

///Now Send mail

	$rstug_UNCSTRefNumber2=md5($protocolCode);
require_once("viewlrcn/mail_template_final_decision.php");
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
$mail->setFrom("uncstuncstapps@gmail.com", "NRIMS");
/////////////////////////////Begin Mail Body
///////////Send copy to UNCST Research
$mail->addCc($recemail,"$recOriginalName - Rec Admin"); //REC Chair
$mail->addBcc($recchairEmail,"$recOriginalName - Chairman UNCST Research Permit");//
$mail->FromName = "$recOriginalName"; //From Name -- CHANGE --
$mail->AddAddress($owneremail, $ownername); //To Address -- CHANGE --$owneremail
$mail->addCc($signedEmail,$ownername);///To UNCST
$mail->AddReplyTo($recemail, $ownername); //Reply-To Address -- CHANGE --$usrm_email

$mail->WordWrap = 50; // set word wrap to 50 characters
$mail->IsHTML(false); // set email format to HTML
$mail->Subject = "$public_title  - $refNo";
$body="$allSentMessage
<br><br>
<a href='$base_url/studyapproval.php?rmd_id=$rstug_UNCSTRefNumber2' style='background:#06F; border: none;  color: white; padding: 15px 32px;  text-align: center;  text-decoration: none;  display: inline-block; font-size: 16px;' target='_blank'>Download/Print PDF</a>";
$mail->MsgHTML($body);

if(!$mail->Send()){
	echo "Mailer Error: " . $mail->ErrorInfo;
}///end

$rstug_UNCSTRefNumber2=md5($protocolCode);
 require_once("./viewlrcn/send_approval_text.php");

$queryp2w="select * from ".$prefix."study_approvals where rmd_id='$rstug_UNCSTRefNumber2' order by id desc";
$cmdw2=$mysqli->query($queryp2w);
if(!$cmdw2->num_rows){
$Insert_sendAp="insert into ".$prefix."study_approvals (`rstug_user_id`,`rstug_rsch_project_id`,`refNo`,`approvalMain`,`approvalText1`,`approvalText2`,`approvalText3`,`dateupdated`,`rmd_id`,`signature`,`totaldocs`,`DateApproved`,`studyTools`,`whosigns`) values ('$asrmApplctID_user','$protocol_idmm','$refNo','$sendTextHr','$sendText1','$sendText2','$sendText3',now(),'$rstug_UNCSTRefNumber2','$signature','$nummm','$sendTextDate','$sendTextStudyTools','$whosigns')";
$mysqli->query($Insert_sendAp);
}

if($cmdw2->num_rows){
$Insert_sendAp="update ".$prefix."study_approvals set `approvalMain`='$sendTextHr',`approvalText1`='$sendText1',`approvalText2`='$sendText2',`approvalText3`='$sendText3',`dateupdated`=now(),`signature`='$signature',`totaldocs`='$nummm',`DateApproved`='$sendTextDate',`studyTools`='$sendTextStudyTools',`whosigns`='$whosigns' where rmd_id='$rstug_UNCSTRefNumber2'";
$mysqli->query($Insert_sendAp);	
}



echo '<img src="images/loading_wait.gif">';
echo '<div class="spacer"></div>';
echo '<meta http-equiv="refresh" content="2; url='.$base_url.'/main.php?option=dashboard" />';
	
}
/////////////////////////////Rejection/////////////////////////////////////////////////////////
if($_POST['doEndReview']=='Save Decision and Finalize Process' and $_POST['public_title'] and $id and ($_POST['recruitment_status']=='Rejected' || $_POST['recruitment_status']=='Resubmit | Needs Major Revisions') and $_POST['whosigns'] and $_POST['Meetingdate'] and $refNo and $_POST['approvaldate']){
require("viewlrcn/class.phpmailer.php");
require("viewlrcn/class.smtp.php");

	$asrmApplctID_user=$mysqli->real_escape_string($_POST['asrmApplctID_user']);
	$protocol_idmm=$mysqli->real_escape_string($_POST['protocol_idmm']);
	$recruitment_status=$mysqli->real_escape_string($_POST['recruitment_status']);
	$period=$mysqli->real_escape_string($_POST['period']);
	$submission_idm=$mysqli->real_escape_string($_POST['submission_idm']);
	$public_title=$mysqli->real_escape_string($_POST['public_title']);
	$studyRefNo=$mysqli->real_escape_string($_POST['studyRefNo']);
	$reviewer_id=$mysqli->real_escape_string($_POST['reviewer_id']);
	$riskLevel=$mysqli->real_escape_string($_POST['riskLevel']);
	$protocolCode=$mysqli->real_escape_string($_POST['protocolCode']);
	$recruitment_status=$_POST['recruitment_status'];
	$type_of_review=$mysqli->real_escape_string($_POST['type_of_review']);
	$whosigns=$mysqli->real_escape_string($_POST['whosigns']);
	$MeetingNumber=$mysqli->real_escape_string($_POST['MeetingNumber']);
	$Meetingdate=date("d/m/Y", strtotime($_POST['Meetingdate']));
	$Approvaltoday=date("d/m/Y", strtotime($_POST['approvaldate']));
	$rstug_UNCSTRefNumber2=md5($protocolCode);
	
$querypUser="select * from apvr_user where asrmApplctID='$whosigns' order by asrmApplctID desc";
$cmdwUser=$mysqli->query($querypUser);
$rSwUser=$cmdwUser->fetch_array();
$signedby=$rSwUser['name'];
$signedEmail=$rSwUser['email'];
if($rSwUser['signatures']){$signature=$rSwUser['signatures'];}else{$signature="hellensignature.jpg";}

////Get Protocl Comments
$sqlSComments = "select * from ".$prefix."initial_committee_screening where protocol_id='$protocol_idmm' and owner_id='$asrmApplctID_user' and collectiveDecision='Yes' order by id desc limit 0,1";
$resComments = $mysqli->query($sqlSComments);
while($sqComments = $resComments->fetch_array()){
$screeningmessage.=nl2br($sqComments['screening']).'<br>';
$draftopinion.=strlen($sqComments['draftopinion']);
}
///Get this meeting Number
if($type_of_review!='Expedited Review'){
$sqlSmeeting = "select * from ".$prefix."meeting where protocol_id='$protocol_idmm' order by id desc limit 0,1";
$resmeeting = $mysqli->query($sqlSmeeting);
$sqmeeting = $resmeeting->fetch_array();
//$MeetingNumber=$sqmeeting['id'];
//$Meetingdate=date("d/m/Y", strtotime($sqmeeting['date']));
}

$sqlSReviewDate = "select * from ".$prefix."submission_review_sr where protocol_id='$protocol_idmm' order by id desc limit 0,1";
$resReviewDate = $mysqli->query($sqlSReviewDate);
$TotalAnyReviewer=$resReviewDate->num_rows;

if($type_of_review=='Expedited Review' and $TotalAnyReviewer){
$sqmReviewDate = $resReviewDate->fetch_array();
//$MeetingNumber=$sqmReviewDate['id'];
//$Meetingdate=date("d/m/Y", strtotime($sqmReviewDate['reviewDate']));
}

if($type_of_review=='Expedited Review' and !$TotalAnyReviewer){
//$MeetingNumber=$sqmReviewDate['id'];
//$Meetingdate=date("d/m/Y");
}

$sqlSRecruitment = "select * from ".$prefix."decision_status where id='$recruitment_status'";
$resRecruitment = $mysqli->query($sqlSRecruitment);
$sqRecruitment = $resRecruitment->fetch_array();

$status=$sqRecruitment['name'];
//$Approvaltoday=date("d/m/Y");
$dateSubmitted=date("Y-m-d G:i:s");
//Get Approval period
$Approvaltoday;
$endofproject = date("d/m/Y", strtotime($_POST['approvaldate'] . "+12 month"));
$endofproject2 = date("Y-m-d", strtotime($_POST['approvaldate'] . "+12 month"));
$nummm=1;
$restudytools="select * from ".$prefix."submission_upload where  user_id='$asrmApplctID_user' and submission_id='$protocol_idmm' and includedon_approval='Yes'";
$cmdtools = $mysqli->query($restudytools);
while($DBtools= $cmdtools->fetch_array()){
	$nummm+1;
$upload_type_id=$DBtools['upload_type_id'];
$sqlSDocName = "select * from ".$prefix."upload_type where id='$upload_type_id'";
$resRDocName = $mysqli->query($sqlSDocName);
$sqReDocName = $resRDocName->fetch_array();

if($DBtools['othername']){$DocumentName=$DBtools['othername'];}
	if(!$DBtools['othername']){$DocumentName=$sqReDocName['name'];}

$DocumentsSubmitted.="

  <tr>
    <td width='6%' valign='top'>&nbsp;$nummm </td>
    <td width='27%' valign='top'>&nbsp;$DocumentName</td>
    <td width='40%' valign='top'>&nbsp;$DBtools[Language]</td>
    <td width='12%' valign='top'>&nbsp;$DBtools[Version]</td>
    <td width='13%' valign='top'>&nbsp;$DBtools[DateofProposal]</td>
  </tr>
 "; $nummm++;}

$sqlMyrecnamew="SELECT * FROM ".$prefix."list_rec_affiliated where id='$recAffiliated_id'";
$sqlFMyreccnaw=$mysqli->query($sqlMyrecnamew);
$recNamew=$sqlFMyreccnaw->fetch_array();

	$contacts=$recNamew['contacts'];
	$recOriginalName=$recNamew['name'];
	$recchairEmail=$recNamew['recchairEmail'];
	$recemail=$recNamew['recemail'];
	$rec_header=$recNamew['recheader'];
	
////Get Templates for Innitial Review and Expedited Review 	type_of_review
if($type_of_review=='Expedited Review'){///use this template
$reviewText="I am pleased to inform you that the $recOriginalName, through expedited review held on <b>$Meetingdate</b> approved the above referenced study.";	
	
}

if($type_of_review!='Expedited Review'){///use this template
$reviewText="I am pleased to inform you that at the <b>$MeetingNumber</b> convened meeting on <b>$Meetingdate</b>,</strong> the $recOriginalName,  committee meeting, etc voted to approve the above referenced application.";	
	
}

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
/////////////////////////////////////////submission_upload//////////////////////	
$sqlSProtocol = "select * from ".$prefix."submission_upload where user_id='$asrmApplctID_user' and submission_id='$protocol_idmm' and upload_type_id='1' and includedon_approval='Yes' order by id desc";
$resOwnerProtocol = $mysqli->query($sqlSProtocol);
$sqOProtocol = $resOwnerProtocol->fetch_array();
$ProtocolVersion=$sqOProtocol['Version'];
$ProtocolLanguage=$sqOProtocol['Language'];
$DateofProposal=$sqOProtocol['DateofProposal'];

$sqlA2="update ".$prefix."protocol set `monitoring_action_id`='$recruitment_status' where `owner_id`='$asrmApplctID_user' and `id`='$protocol_idmm'";
$mysqli->query($sqlA2);

$sqlA23="update ".$prefix."submission set `is_sent`='0',`status`='$recruitment_status',`meeting_status`='Completed',`reviewer_id`='$reviewer_id',`newresubmission`='0' where `owner_id`='$asrmApplctID_user' and `id`='$submission_idm'";
$mysqli->query($sqlA23);

$sqlA2ProtocolTable="update ".$prefix."protocol  set `decision_in`=now() where id='$submission_idm' and owner_id='$asrmApplctID_user'";
$mysqli->query($sqlA2ProtocolTable);

$sqlupdateSm2="update ".$prefix."submission_stages set status='new' where protocol_id='$submission_idm' and owner_id='$asrmApplctID_user'";
$mysqli->query($sqlupdateSm2);

$message='<p class="success">Review was completed successfully. Thank You</p>';
//send email to protocol owner
$newprotocolID=base64_encode($protocol_idmm);
if($draftopinion>=8){
$commentsFile="<a href='$base_url/downloadcomments.php?rmd_id=$newprotocolID' style='background:#E03A31; border: none;  color: white; padding: 15px 32px;  text-align: center;  text-decoration: none;  display: inline-block; font-size: 16px;' target='_blank'>View Attached Comments</a>";
}
///Now Send mail
require_once("viewlrcn/mail_template_rejected.php");
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
$mail->setFrom("uncstuncstapps@gmail.com", "NRIMS");
/////////////////////////////Begin Mail Body
///////////Send copy to UNCST Research
//mmmmm///$mail->addCc($recchairEmail,"$recOriginalName - Chairman"); //REC Chair
$mail->FromName = "$recOriginalName"; //From Name -- CHANGE --
$mail->AddAddress($owneremail, $ownername); //To Address -- CHANGE --
$mail->addCc($signedEmail,$ownername);///To UNCST
$mail->addBcc($recemail,"$recOriginalName - Chairman UNCST Research Permit");//$recchairEmail
$mail->addBcc('uncstuncstapps@gmail.com',"Research");
$mail->AddReplyTo($recemail, $ownername); //Reply-To Address -- CHANGE --$usrm_email

$mail->WordWrap = 50; // set word wrap to 50 characters
$mail->IsHTML(false); // set email format to HTML
$mail->Subject = "$public_title  - $refNo";
$body="$allSentMessage
<br><br>
<a href='$base_url/studyapprovals.php?rmd_id=$rstug_UNCSTRefNumber2' style='background:#06F; border: none;  color: white; padding: 15px 32px;  text-align: center;  text-decoration: none;  display: inline-block; font-size: 16px;' target='_blank'>Download/Print PDF</a>";
$mail->MsgHTML($body);

if(!$mail->Send()){
	echo "Mailer Error: " . $mail->ErrorInfo;
}///end


 require_once("./viewlrcn/send_approval_text2.php");

 $queryp2w="select * from ".$prefix."study_approvals where rmd_id='$rstug_UNCSTRefNumber2' order by id desc";
$cmdw2=$mysqli->query($queryp2w);
if(!$cmdw2->num_rows){
$Insert_sendAp="insert into ".$prefix."study_approvals (`rstug_user_id`,`rstug_rsch_project_id`,`refNo`,`approvalMain`,`approvalText1`,`approvalText2`,`approvalText3`,`dateupdated`,`rmd_id`,`signature`,`totaldocs`,`DateApproved`,`studyTools`,`whosigns`) values ('$asrmApplctID_user','$protocol_idmm','$refNo','$sendTextHr','$sendText1','$sendText2','$sendText3',now(),'$rstug_UNCSTRefNumber2','$signature','$nummm','$sendTextDate','$sendTextStudyTools','$whosigns')";
$mysqli->query($Insert_sendAp);
}

if($cmdw2->num_rows){
$Insert_sendAp2="update ".$prefix."study_approvals set `approvalMain`='$sendTextHr',`approvalText1`='$sendText1',`approvalText2`='$sendText2',`approvalText3`='$sendText3',`dateupdated`=now(),`signature`='$signature',`totaldocs`='$nummm',`DateApproved`='$sendTextDate',`studyTools`='$sendTextStudyTools',`whosigns`='$whosigns' where rmd_id='$rstug_UNCSTRefNumber2'";
$mysqli->query($Insert_sendAp2);	
}
///Send mail with comments to the PI

echo '<img src="images/loading_wait.gif">';
echo '<div class="spacer"></div>';
echo '<meta http-equiv="refresh" content="2; url='.$base_url.'/main.php?option=dashboard" />';
	
}
/////////////////CONDITIONAL APPROVAL////////////////////////////////////////////



/////////////////////////////Conditional Approval/////////////////////////////////////////////////////////

if($_POST['doEndReview']=='Save Decision and Finalize Process' and $_POST['public_title'] and $id and $_POST['recruitment_status']=='Conditional Approval | Needs Minor Revisions' and $_POST['Meetingdate'] and $refNo and $_POST['approvaldate']){
require("viewlrcn/class.phpmailer.php");
require("viewlrcn/class.smtp.php");

	$asrmApplctID_user=$mysqli->real_escape_string($_POST['asrmApplctID_user']);
	$protocol_idmm=$mysqli->real_escape_string($_POST['protocol_idmm']);
	$recruitment_status=$mysqli->real_escape_string($_POST['recruitment_status']);
	$period=$mysqli->real_escape_string($_POST['period']);
	$submission_idm=$mysqli->real_escape_string($_POST['submission_idm']);
	$public_title=$mysqli->real_escape_string($_POST['public_title']);
	$studyRefNo=$mysqli->real_escape_string($_POST['studyRefNo']);
	$reviewer_id=$mysqli->real_escape_string($_POST['reviewer_id']);
	$riskLevel=$mysqli->real_escape_string($_POST['riskLevel']);
	$protocolCode=$mysqli->real_escape_string($_POST['protocolCode']);
	$recruitment_status=$_POST['recruitment_status'];
	$type_of_review=$mysqli->real_escape_string($_POST['type_of_review']);
	
	$whosigns=$mysqli->real_escape_string($_POST['whosigns']);
	$MeetingNumber=$mysqli->real_escape_string($_POST['MeetingNumber']);
	$Meetingdate=date("d/m/Y", strtotime($_POST['Meetingdate']));
	$Approvaltoday=date("d/m/Y", strtotime($_POST['approvaldate']));
	$rstug_UNCSTRefNumber2=md5($protocolCode);
	
$querypUser="select * from apvr_user where asrmApplctID='$whosigns' order by asrmApplctID desc";
$cmdwUser=$mysqli->query($querypUser);
$rSwUser=$cmdwUser->fetch_array();
$signedby=$rSwUser['name'];
$signedEmail=$rSwUser['email'];
if($rSwUser['signatures']){$signature=$rSwUser['signatures'];}else{$signature="hellensignature.jpg";}

////Get Protocl Comments
$sqlSComments = "select * from ".$prefix."initial_committee_screening where protocol_id='$protocol_idmm' and owner_id='$asrmApplctID_user' and collectiveDecision='Yes' order by id desc limit 0,1";
$resComments = $mysqli->query($sqlSComments);
while($sqComments = $resComments->fetch_array()){
$screeningmessage.=nl2br($sqComments['screening']).'<br>';
$draftopinion.=strlen($sqComments['draftopinion']);
}
///Get this meeting Number
if($type_of_review!='Expedited Review'){
$sqlSmeeting = "select * from ".$prefix."meeting where protocol_id='$protocol_idmm' order by id desc limit 0,1";
$resmeeting = $mysqli->query($sqlSmeeting);
$sqmeeting = $resmeeting->fetch_array();
//$MeetingNumber=$sqmeeting['id'];
//$Meetingdate=date("d/m/Y", strtotime($sqmeeting['date']));
}

$sqlSReviewDate = "select * from ".$prefix."submission_review_sr where protocol_id='$protocol_idmm' order by id desc limit 0,1";
$resReviewDate = $mysqli->query($sqlSReviewDate);
$TotalAnyReviewer=$resReviewDate->num_rows;

if($type_of_review=='Expedited Review' and $TotalAnyReviewer){
$sqmReviewDate = $resReviewDate->fetch_array();
//$MeetingNumber=$sqmReviewDate['id'];
//$Meetingdate=date("d/m/Y", strtotime($sqmReviewDate['reviewDate']));
}

if($type_of_review=='Expedited Review' and !$TotalAnyReviewer){
//$MeetingNumber=$sqmReviewDate['id'];
//$Meetingdate=date("d/m/Y");
}

$sqlSRecruitment = "select * from ".$prefix."decision_status where id='$recruitment_status'";
$resRecruitment = $mysqli->query($sqlSRecruitment);
$sqRecruitment = $resRecruitment->fetch_array();

$status=$sqRecruitment['name'];
//$Approvaltoday=date("d/m/Y");
$dateSubmitted=date("Y-m-d G:i:s");
//Get Approval period
$Approvaltoday;
$endofproject = date("d/m/Y", strtotime($_POST['approvaldate'] . "+12 month"));
$endofproject2 = date("Y-m-d", strtotime($_POST['approvaldate'] . "+12 month"));
$nummm=1;
$restudytools="select * from ".$prefix."submission_upload where  user_id='$asrmApplctID_user' and submission_id='$protocol_idmm' and includedon_approval='Yes'";
$cmdtools = $mysqli->query($restudytools);
while($DBtools= $cmdtools->fetch_array()){
	$nummm+1;
	
	
	
$upload_type_id=$DBtools['upload_type_id'];
$sqlSDocName = "select * from ".$prefix."upload_type where id='$upload_type_id'";
$resRDocName = $mysqli->query($sqlSDocName);
$sqReDocName = $resRDocName->fetch_array();

if($DBtools['othername']){$DocumentName=$DBtools['othername'];}
	if(!$DBtools['othername']){$DocumentName=$sqReDocName['name'];}
$DocumentsSubmitted.="

  <tr>
    <td width='6%' valign='top'>&nbsp;$nummm </td>
    <td width='27%' valign='top'>&nbsp;$DocumentName</td>
    <td width='30%' valign='top'>&nbsp;$DBtools[Language]</td>
    <td width='22%' valign='top'>&nbsp;$DBtools[Version]</td>
    <td width='13%' valign='top'>&nbsp;$DBtools[DateofProposal]</td>
  </tr>
 "; $nummm++;}

$sqlMyrecnamew="SELECT * FROM ".$prefix."list_rec_affiliated where id='$recAffiliated_id'";
$sqlFMyreccnaw=$mysqli->query($sqlMyrecnamew);
$recNamew=$sqlFMyreccnaw->fetch_array();

	$contacts=$recNamew['contacts'];
	$recOriginalName=$recNamew['name'];
	$recchairEmail=$recNamew['recchairEmail'];
	$recemail=$recNamew['recemail'];
	$rec_header=$recNamew['recheader'];
////Get Templates for Innitial Review and Expedited Review 	type_of_review
if($type_of_review=='Expedited Review'){///use this template
$reviewText="I am pleased to inform you that the $recOriginalName, through expedited review held on <b>$Meetingdate</b> approved the above referenced study.";	
	
}

if($type_of_review!='Expedited Review'){///use this template
$reviewText="I am pleased to inform you that at the <b>$MeetingNumber</b> convened meeting on <b>$Meetingdate</b>,</strong> the $recOriginalName,  committee meeting, etc voted to approve the above referenced application.";	
	
}

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


/////////////////////////////////////////submission_upload//////////////////////	
$sqlSProtocol = "select * from ".$prefix."submission_upload where user_id='$asrmApplctID_user' and submission_id='$protocol_idmm' and upload_type_id='1' and includedon_approval='Yes' order by id desc";
$resOwnerProtocol = $mysqli->query($sqlSProtocol);
$sqOProtocol = $resOwnerProtocol->fetch_array();
$ProtocolVersion=$sqOProtocol['Version'];
$ProtocolLanguage=$sqOProtocol['Language'];
$DateofProposal=$sqOProtocol['DateofProposal'];

$sqlA2="update ".$prefix."protocol set `monitoring_action_id`='$recruitment_status',`decision_in`=now() where `owner_id`='$asrmApplctID_user' and `id`='$protocol_idmm'";
$mysqli->query($sqlA2);

$sqlA23="update ".$prefix."submission set `is_sent`='0',`status`='$recruitment_status',`meeting_status`='Completed',`reviewer_id`='$reviewer_id', CompletenessCheck='Rejected',`newresubmission`='0' where `owner_id`='$asrmApplctID_user' and `id`='$submission_idm'";
$mysqli->query($sqlA23);




	/////Update submissions Table
//$sqlupdateSm="update ".$prefix."submission set is_sent='0',status='completeness check', CompletenessCheck='Rejected' where id='$protocol_idwe'";

$sqlupdateSm2="update ".$prefix."submission_stages set status='new' where protocol_id='$protocol_idmm' and owner_id='$asrmApplctID_user'";
$mysqli->query($sqlupdateSm2);



$message='<p class="success">Review was completed successfully. Thank You</p>';
//send email to protocol owner
$newprotocolID=base64_encode($protocol_idmm);
if($draftopinion>=8){
$commentsFile="<a href='$base_url/downloadcomments.php?rmd_id=$newprotocolID' style='background:#E03A31; border: none;  color: white; padding: 15px 32px;  text-align: center;  text-decoration: none;  display: inline-block; font-size: 16px;' target='_blank'>View Attached Comments</a>";
}
///Now Send mail
require_once("viewlrcn/mail_template_conditional_approval.php");
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
$mail->setFrom("uncstuncstapps@gmail.com", "NRIMS");
/////////////////////////////Begin Mail Body
///////////Send copy to UNCST Research
//mmmmm///$mail->addCc($recchairEmail,"$recOriginalName - Chairman"); //REC Chair
$mail->addBcc($recemail,"$recOriginalName - Chairman UNCST Research Permit");//$recchairEmail
$mail->FromName = "$recOriginalName"; //From Name -- CHANGE --
$mail->AddAddress($owneremail, $ownername); //To Address -- CHANGE --
$mail->addCc($signedEmail,$ownername);///To UNCST
$mail->AddReplyTo($recemail, $ownername); //Reply-To Address -- CHANGE --$usrm_email

$mail->WordWrap = 50; // set word wrap to 50 characters
$mail->IsHTML(false); // set email format to HTML
$mail->Subject = "$public_title  - $refNo";
$body="$allSentMessageConditional
<br><br>
$commentsFile

<br><br>
<a href='$base_url/studyapproval.php?rmd_id=$rstug_UNCSTRefNumber2' style='background:#06F; border: none;  color: white; padding: 15px 32px;  text-align: center;  text-decoration: none;  display: inline-block; font-size: 16px;' target='_blank'>Download/Print PDF</a>";
$mail->MsgHTML($body);

if(!$mail->Send()){
	echo "Mailer Error: " . $mail->ErrorInfo;
}///end


 require_once("./viewlrcn/send_approval_text3.php");

 $queryp2w="select * from ".$prefix."study_approvals where rmd_id='$rstug_UNCSTRefNumber2' order by id desc";
$cmdw2=$mysqli->query($queryp2w);
if(!$cmdw2->num_rows){
$Insert_sendAp="insert into ".$prefix."study_approvals (`rstug_user_id`,`rstug_rsch_project_id`,`refNo`,`approvalMain`,`approvalText1`,`approvalText2`,`approvalText3`,`dateupdated`,`rmd_id`,`signature`,`totaldocs`,`DateApproved`,`studyTools`,`whosigns`) values ('$asrmApplctID_user','$protocol_idmm','$refNo','$sendTextHr','$sendText1','$sendText2','$sendText3',now(),'$rstug_UNCSTRefNumber2','$signature','$nummm','$sendTextDate','$sendTextStudyTools','$whosigns')";
$mysqli->query($Insert_sendAp);
}
if($cmdw2->num_rows){
$Insert_sendAp2="update ".$prefix."study_approvals set `approvalMain`='$sendTextHr',`approvalText1`='$sendText1',`approvalText2`='$sendText2',`approvalText3`='$sendText3',`dateupdated`=now(),`signature`='$signature',`totaldocs`='$nummm',`DateApproved`='$sendTextDate',`studyTools`='$sendTextStudyTools',`whosigns`='$whosigns' where `rmd_id`='$rstug_UNCSTRefNumber2'";
$mysqli->query($Insert_sendAp2);
}
///Send mail with comments to the PI

echo '<img src="images/loading_wait.gif">';
echo '<div class="spacer"></div>';
echo '<meta http-equiv="refresh" content="2; url='.$base_url.'/main.php?option=dashboard" />';
	
}


/////////////////////////////REQUEST FOR RESPONSES/////////////////////////////////////////////////////////
if($_POST['doEndReview']=='Save Decision and Finalize Process' and $_POST['public_title'] and $id and $_POST['recruitment_status']=='Request for Responses' and $_POST['Meetingdate'] and $refNo and $_POST['approvaldate']){
require("viewlrcn/class.phpmailer.php");
require("viewlrcn/class.smtp.php");

	$asrmApplctID_user=$mysqli->real_escape_string($_POST['asrmApplctID_user']);
	$protocol_idmm=$mysqli->real_escape_string($_POST['protocol_idmm']);
	$recruitment_status=$mysqli->real_escape_string($_POST['recruitment_status']);
	$period=$mysqli->real_escape_string($_POST['period']);
	$submission_idm=$mysqli->real_escape_string($_POST['submission_idm']);
	$public_title=$mysqli->real_escape_string($_POST['public_title']);
	$studyRefNo=$mysqli->real_escape_string($_POST['studyRefNo']);
	$reviewer_id=$mysqli->real_escape_string($_POST['reviewer_id']);
	$riskLevel=$mysqli->real_escape_string($_POST['riskLevel']);
	$protocolCode=$mysqli->real_escape_string($_POST['protocolCode']);
	$recruitment_status=$_POST['recruitment_status'];
	$type_of_review=$mysqli->real_escape_string($_POST['type_of_review']);
	
	$whosigns=$mysqli->real_escape_string($_POST['whosigns']);
	$MeetingNumber=$mysqli->real_escape_string($_POST['MeetingNumber']);
	$Meetingdate=date("d/m/Y", strtotime($_POST['Meetingdate']));
	$Approvaltoday=date("d/m/Y", strtotime($_POST['approvaldate']));
	$rstug_UNCSTRefNumber2=md5($protocolCode);
	
$querypUser="select * from apvr_user where asrmApplctID='$whosigns' order by asrmApplctID desc";
$cmdwUser=$mysqli->query($querypUser);
$rSwUser=$cmdwUser->fetch_array();
$signedby=$rSwUser['name'];
$signedEmail=$rSwUser['email'];
if($rSwUser['signatures']){$signature=$rSwUser['signatures'];}else{$signature="hellensignature.jpg";}

////Get Protocl Comments
$sqlSComments = "select * from ".$prefix."initial_committee_screening where protocol_id='$protocol_idmm' and owner_id='$asrmApplctID_user' and collectiveDecision='Yes' order by id desc limit 0,1";
$resComments = $mysqli->query($sqlSComments);
while($sqComments = $resComments->fetch_array()){
$screeningmessage.=nl2br($sqComments['screening']).'<br>';
$draftopinion.=strlen($sqComments['draftopinion']);
}
///Get this meeting Number
if($type_of_review!='Expedited Review'){
$sqlSmeeting = "select * from ".$prefix."meeting where protocol_id='$protocol_idmm' order by id desc limit 0,1";
$resmeeting = $mysqli->query($sqlSmeeting);
$sqmeeting = $resmeeting->fetch_array();
//$MeetingNumber=$sqmeeting['id'];
//$Meetingdate=date("d/m/Y", strtotime($sqmeeting['date']));
}

$sqlSReviewDate = "select * from ".$prefix."submission_review_sr where protocol_id='$protocol_idmm' order by id desc limit 0,1";
$resReviewDate = $mysqli->query($sqlSReviewDate);
$TotalAnyReviewer=$resReviewDate->num_rows;

if($type_of_review=='Expedited Review' and $TotalAnyReviewer){
$sqmReviewDate = $resReviewDate->fetch_array();
//$MeetingNumber=$sqmReviewDate['id'];
//$Meetingdate=date("d/m/Y", strtotime($sqmReviewDate['reviewDate']));
}

if($type_of_review=='Expedited Review' and !$TotalAnyReviewer){
//$MeetingNumber=$sqmReviewDate['id'];
//$Meetingdate=date("d/m/Y");
}

$sqlSRecruitment = "select * from ".$prefix."decision_status where id='$recruitment_status'";
$resRecruitment = $mysqli->query($sqlSRecruitment);
$sqRecruitment = $resRecruitment->fetch_array();

$status=$sqRecruitment['name'];
//$Approvaltoday=date("d/m/Y");
$dateSubmitted=date("Y-m-d G:i:s");
//Get Approval period
$Approvaltoday;
$endofproject = date("d/m/Y", strtotime($_POST['approvaldate'] . "+12 month"));
$endofproject2 = date("Y-m-d", strtotime($_POST['approvaldate'] . "+12 month"));
$nummm=1;
$restudytools="select * from ".$prefix."submission_upload where  user_id='$asrmApplctID_user' and submission_id='$protocol_idmm' and includedon_approval='Yes'";
$cmdtools = $mysqli->query($restudytools);
while($DBtools= $cmdtools->fetch_array()){
	$nummm+1;
	
	
	
$upload_type_id=$DBtools['upload_type_id'];
$sqlSDocName = "select * from ".$prefix."upload_type where id='$upload_type_id'";
$resRDocName = $mysqli->query($sqlSDocName);
$sqReDocName = $resRDocName->fetch_array();

if($DBtools['othername']){$DocumentName=$DBtools['othername'];}
	if(!$DBtools['othername']){$DocumentName=$sqReDocName['name'];}
$DocumentsSubmitted.="

  <tr>
    <td width='6%' valign='top'>&nbsp;$nummm </td>
    <td width='27%' valign='top'>&nbsp;$DocumentName</td>
    <td width='30%' valign='top'>&nbsp;$DBtools[Language]</td>
    <td width='22%' valign='top'>&nbsp;$DBtools[Version]</td>
    <td width='13%' valign='top'>&nbsp;$DBtools[DateofProposal]</td>
  </tr>
 "; $nummm++;}

$sqlMyrecnamew="SELECT * FROM ".$prefix."list_rec_affiliated where id='$recAffiliated_id'";
$sqlFMyreccnaw=$mysqli->query($sqlMyrecnamew);
$recNamew=$sqlFMyreccnaw->fetch_array();

	$contacts=$recNamew['contacts'];
	$recOriginalName=$recNamew['name'];
	$recchairEmail=$recNamew['recchairEmail'];
	$recemail=$recNamew['recemail'];
	$rec_header=$recNamew['recheader'];
////Get Templates for Innitial Review and Expedited Review 	type_of_review
if($type_of_review=='Expedited Review'){///use this template
$reviewText="I am pleased to inform you that the $recOriginalName, through expedited review held on <b>$Meetingdate</b> approved the above referenced study.";	
	
}

if($type_of_review!='Expedited Review'){///use this template
$reviewText="I am pleased to inform you that at the <b>$MeetingNumber</b> convened meeting on <b>$Meetingdate</b>,</strong> the $recOriginalName,  committee meeting, etc voted to approve the above referenced application.";	
	
}

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


/////////////////////////////////////////submission_upload//////////////////////	
$sqlSProtocol = "select * from ".$prefix."submission_upload where user_id='$asrmApplctID_user' and submission_id='$protocol_idmm' and upload_type_id='1' and includedon_approval='Yes' order by id desc";
$resOwnerProtocol = $mysqli->query($sqlSProtocol);
$sqOProtocol = $resOwnerProtocol->fetch_array();
$ProtocolVersion=$sqOProtocol['Version'];
$ProtocolLanguage=$sqOProtocol['Language'];
$DateofProposal=$sqOProtocol['DateofProposal'];

$sqlA2="update ".$prefix."protocol set `monitoring_action_id`='$recruitment_status',`decision_in`=now() where `owner_id`='$asrmApplctID_user' and `id`='$protocol_idmm'";
$mysqli->query($sqlA2);

$sqlA23="update ".$prefix."submission set `is_sent`='0',`status`='$recruitment_status',`meeting_status`='Completed',`reviewer_id`='$reviewer_id', CompletenessCheck='Rejected',`newresubmission`='0' where `owner_id`='$asrmApplctID_user' and `id`='$submission_idm'";
$mysqli->query($sqlA23);



	/////Update submissions Table
//$sqlupdateSm="update ".$prefix."submission set is_sent='0',status='completeness check', CompletenessCheck='Rejected' where id='$protocol_idwe'";

$sqlupdateSm2="update ".$prefix."submission_stages set status='new' where protocol_id='$protocol_idmm' and owner_id='$asrmApplctID_user'";
$mysqli->query($sqlupdateSm2);



$message='<p class="success">Review was completed successfully. Thank You</p>';
//send email to protocol owner
$newprotocolID=base64_encode($protocol_idmm);
if($draftopinion>=8){
$commentsFile="<a href='$base_url/downloadcomments.php?rmd_id=$newprotocolID' style='background:#E03A31; border: none;  color: white; padding: 15px 32px;  text-align: center;  text-decoration: none;  display: inline-block; font-size: 16px;' target='_blank'>View Attached Comments</a>";
}

///Now Send mail
require_once("viewlrcn/mail_template_request_for_responses.php");
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
$mail->setFrom("uncstuncstapps@gmail.com", "NRIMS");
/////////////////////////////Begin Mail Body
///////////Send copy to UNCST Research
//mmmmm///$mail->addCc($recchairEmail,"$recOriginalName - Chairman"); //REC Chair
$mail->addBcc($recchairEmail,"$recOriginalName - Chairman UNCST Research Permit");//$recchairEmail
$mail->FromName = "$recOriginalName"; //From Name -- CHANGE --
$mail->AddAddress($owneremail, $ownername); //To Address -- CHANGE --
$mail->addCc($signedEmail,$ownername);///To UNCST
$mail->addCc("uncstuncstapps@gmail.com","Collins Mwesigwa");
$mail->AddReplyTo($recemail, $ownername); //Reply-To Address -- CHANGE --$usrm_email

$mail->WordWrap = 50; // set word wrap to 50 characters
$mail->IsHTML(false); // set email format to HTML
$mail->Subject = "$public_title  - $refNo";
$body="$allSentMessageConditional
<br><br>
$commentsFile
<br><br>
<a href='$base_url/studyapprovalres.php?rmd_id=$rstug_UNCSTRefNumber2' style='background:#06F; border: none;  color: white; padding: 15px 32px;  text-align: center;  text-decoration: none;  display: inline-block; font-size: 16px;' target='_blank'>Download/Print PDF</a>";
$mail->MsgHTML($body);

if(!$mail->Send()){
	echo "Mailer Error: " . $mail->ErrorInfo;
}///end


 require_once("./viewlrcn/send_requestfor_responses_text.php");

 $queryp2w="select * from ".$prefix."study_approvals where rmd_id='$rstug_UNCSTRefNumber2' order by id desc";
$cmdw2=$mysqli->query($queryp2w);
if(!$cmdw2->num_rows){
$Insert_sendAp="insert into ".$prefix."study_approvals (`rstug_user_id`,`rstug_rsch_project_id`,`refNo`,`approvalMain`,`approvalText1`,`approvalText2`,`approvalText3`,`dateupdated`,`rmd_id`,`signature`,`totaldocs`,`DateApproved`,`studyTools`,`whosigns`) values ('$asrmApplctID_user','$protocol_idmm','$refNo','$sendTextHr','$sendText1','$sendText2','$sendText3',now(),'$rstug_UNCSTRefNumber2','$signature','$nummm','$sendTextDate','$sendTextStudyTools','$whosigns')";
$mysqli->query($Insert_sendAp);
}
if($cmdw2->num_rows){
$Insert_sendAp2="update ".$prefix."study_approvals set `approvalMain`='$sendTextHr',`approvalText1`='$sendText1',`approvalText2`='$sendText2',`approvalText3`='$sendText3',`dateupdated`=now(),`signature`='$signature',`totaldocs`='$nummm',`DateApproved`='$sendTextDate',`studyTools`='$sendTextStudyTools',`whosigns`='$whosigns' where `rmd_id`='$rstug_UNCSTRefNumber2'";
$mysqli->query($Insert_sendAp2);
}
///Send mail with comments to the PI

echo '<img src="images/loading_wait.gif">';
echo '<div class="spacer"></div>';
echo '<meta http-equiv="refresh" content="2; url='.$base_url.'/main.php?option=dashboard" />';
	
}
/////////////////REQUEST FOR RESPONSES////////////////////////////////////////////

/////////////////////////////Request for VIVA/////////////////////////////////////////////////////////
if($_POST['doEndReview']=='Save Decision and Finalize Process' and $_POST['public_title'] and $id and $_POST['recruitment_status']=='Request for VIVA' and $_POST['meetingplace'] and $_POST['meeting_set_date']  and $refNo){
require("viewlrcn/class.phpmailer.php");
require("viewlrcn/class.smtp.php");

	$asrmApplctID_user=$mysqli->real_escape_string($_POST['asrmApplctID_user']);
	$protocol_idmm=$mysqli->real_escape_string($_POST['protocol_idmm']);
	$recruitment_status=$mysqli->real_escape_string($_POST['recruitment_status']);
	$period=$mysqli->real_escape_string($_POST['period']);
	$submission_idm=$mysqli->real_escape_string($_POST['submission_idm']);
	$public_title=$mysqli->real_escape_string($_POST['public_title']);
	$studyRefNo=$mysqli->real_escape_string($_POST['studyRefNo']);
	$reviewer_id=$mysqli->real_escape_string($_POST['reviewer_id']);
	$riskLevel=$mysqli->real_escape_string($_POST['riskLevel']);
	$protocolCode=$mysqli->real_escape_string($_POST['protocolCode']);
	$recruitment_status=$_POST['recruitment_status'];
	$type_of_review=$mysqli->real_escape_string($_POST['type_of_review']);
	$meetingplace=$mysqli->real_escape_string($_POST['meetingplace']);
	$meeting_set_date=$mysqli->real_escape_string($_POST['meeting_set_date']);
	
	$whosigns=$mysqli->real_escape_string($_POST['whosigns']);
	$MeetingNumber=$mysqli->real_escape_string($_POST['MeetingNumber']);
	$Meetingdate=date("d/m/Y", strtotime($_POST['Meetingdate']));
	$Approvaltoday=date("d/m/Y", strtotime($_POST['approvaldate']));
	$rstug_UNCSTRefNumber2=md5($protocolCode);
	
$querypUser="select * from apvr_user where asrmApplctID='$whosigns' order by asrmApplctID desc";
$cmdwUser=$mysqli->query($querypUser);
$rSwUser=$cmdwUser->fetch_array();
$signedby=$rSwUser['name'];
$signedEmail=$rSwUser['email'];
if($rSwUser['signatures']){$signature=$rSwUser['signatures'];}else{$signature="hellensignature.jpg";}

////Get Protocl Comments
$sqlSComments = "select * from ".$prefix."initial_committee_screening where protocol_id='$protocol_idmm' and owner_id='$asrmApplctID_user' and collectiveDecision='Yes' order by id desc limit 0,1";
$resComments = $mysqli->query($sqlSComments);
while($sqComments = $resComments->fetch_array()){
$screeningmessage.=nl2br($sqComments['screening']).'<br>';
$draftopinion.=strlen($sqComments['draftopinion']);
}
///Get this meeting Number
if($type_of_review!='Expedited Review'){
$sqlSmeeting = "select * from ".$prefix."meeting where protocol_id='$protocol_idmm' order by id desc limit 0,1";
$resmeeting = $mysqli->query($sqlSmeeting);
$sqmeeting = $resmeeting->fetch_array();
//$MeetingNumber=$sqmeeting['id'];
//$Meetingdate=date("d/m/Y", strtotime($sqmeeting['date']));
}

$sqlSReviewDate = "select * from ".$prefix."submission_review_sr where protocol_id='$protocol_idmm' order by id desc limit 0,1";
$resReviewDate = $mysqli->query($sqlSReviewDate);
$TotalAnyReviewer=$resReviewDate->num_rows;

if($type_of_review=='Expedited Review' and $TotalAnyReviewer){
$sqmReviewDate = $resReviewDate->fetch_array();
//$MeetingNumber=$sqmReviewDate['id'];
//$Meetingdate=date("d/m/Y", strtotime($sqmReviewDate['reviewDate']));
}

if($type_of_review=='Expedited Review' and !$TotalAnyReviewer){
//$MeetingNumber=$sqmReviewDate['id'];
//$Meetingdate=date("d/m/Y");
}

$sqlSRecruitment = "select * from ".$prefix."decision_status where id='$recruitment_status'";
$resRecruitment = $mysqli->query($sqlSRecruitment);
$sqRecruitment = $resRecruitment->fetch_array();

$status=$sqRecruitment['name'];
//$Approvaltoday=date("d/m/Y");
$dateSubmitted=date("Y-m-d G:i:s");
//Get Approval period
$Approvaltoday;
$endofproject = date("d/m/Y", strtotime($_POST['approvaldate'] . "+12 month"));
$endofproject2 = date("Y-m-d", strtotime($_POST['approvaldate'] . "+12 month"));
$nummm=1;
$restudytools="select * from ".$prefix."submission_upload where  user_id='$asrmApplctID_user' and submission_id='$protocol_idmm' and includedon_approval='Yes'";
$cmdtools = $mysqli->query($restudytools);
while($DBtools= $cmdtools->fetch_array()){
	$nummm+1;
	
	
	
$upload_type_id=$DBtools['upload_type_id'];
$sqlSDocName = "select * from ".$prefix."upload_type where id='$upload_type_id'";
$resRDocName = $mysqli->query($sqlSDocName);
$sqReDocName = $resRDocName->fetch_array();

if($DBtools['othername']){$DocumentName=$DBtools['othername'];}
	if(!$DBtools['othername']){$DocumentName=$sqReDocName['name'];}
$DocumentsSubmitted.="

  <tr>
    <td width='6%' valign='top'>&nbsp;$nummm </td>
    <td width='27%' valign='top'>&nbsp;$DocumentName</td>
    <td width='30%' valign='top'>&nbsp;$DBtools[Language]</td>
    <td width='22%' valign='top'>&nbsp;$DBtools[Version]</td>
    <td width='13%' valign='top'>&nbsp;$DBtools[DateofProposal]</td>
  </tr>
 "; $nummm++;}

$sqlMyrecnamew="SELECT * FROM ".$prefix."list_rec_affiliated where id='$recAffiliated_id'";
$sqlFMyreccnaw=$mysqli->query($sqlMyrecnamew);
$recNamew=$sqlFMyreccnaw->fetch_array();

	$contacts=$recNamew['contacts'];
	$recOriginalName=$recNamew['name'];
	$recchairEmail=$recNamew['recchairEmail'];
	$recemail=$recNamew['recemail'];
	$rec_header=$recNamew['recheader'];
////Get Templates for Innitial Review and Expedited Review 	type_of_review
if($type_of_review=='Expedited Review'){///use this template
$reviewText="I am pleased to inform you that the $recOriginalName, through expedited review held on <b>$Meetingdate</b> approved the above referenced study.";	
	
}

if($type_of_review!='Expedited Review'){///use this template
$reviewText="I am pleased to inform you that at the <b>$MeetingNumber</b> convened meeting on <b>$Meetingdate</b>,</strong> the $recOriginalName,  committee meeting, etc voted to approve the above referenced application.";	
	
}

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


/////////////////////////////////////////submission_upload//////////////////////	
$sqlSProtocol = "select * from ".$prefix."submission_upload where user_id='$asrmApplctID_user' and submission_id='$protocol_idmm' and upload_type_id='1' and includedon_approval='Yes' order by id desc";
$resOwnerProtocol = $mysqli->query($sqlSProtocol);
$sqOProtocol = $resOwnerProtocol->fetch_array();
$ProtocolVersion=$sqOProtocol['Version'];
$ProtocolLanguage=$sqOProtocol['Language'];
$DateofProposal=$sqOProtocol['DateofProposal'];

$sqlA2="update ".$prefix."protocol set `monitoring_action_id`='$recruitment_status',`decision_in`=now() where `owner_id`='$asrmApplctID_user' and `id`='$protocol_idmm'";
$mysqli->query($sqlA2);

$sqlA23="update ".$prefix."submission set `is_sent`='0',`status`='$recruitment_status',`meeting_status`='Completed',`reviewer_id`='$reviewer_id', CompletenessCheck='Rejected' where `owner_id`='$asrmApplctID_user' and `id`='$submission_idm'";
$mysqli->query($sqlA23);





	/////Update submissions Table
//$sqlupdateSm="update ".$prefix."submission set is_sent='0',status='completeness check', CompletenessCheck='Rejected' where id='$protocol_idwe'";

$sqlupdateSm2="update ".$prefix."submission_stages set status='new' where protocol_id='$protocol_idmm' and owner_id='$asrmApplctID_user'";
$mysqli->query($sqlupdateSm2);



$message='<p class="success">Review was completed successfully. Thank You</p>';
//send email to protocol owner
$newprotocolID=base64_encode($protocol_idmm);
if($draftopinion>=8){
$commentsFile="<a href='$base_url/downloadcomments.php?rmd_id=$newprotocolID' style='background:#E03A31; border: none;  color: white; padding: 15px 32px;  text-align: center;  text-decoration: none;  display: inline-block; font-size: 16px;' target='_blank'>View Attached Comments</a>";
}

///Now Send mail
require_once("viewlrcn/mail_template_request_for_viva.php");
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
$mail->setFrom("uncstuncstapps@gmail.com", "NRIMS");
/////////////////////////////Begin Mail Body
///////////Send copy to UNCST Research
//mmmmm///$mail->addCc($recchairEmail,"$recOriginalName - Chairman"); //REC Chair
$mail->addBcc($recemail,"$recOriginalName - REC Admin");//$recchairEmail
$mail->FromName = "$recOriginalName"; //From Name -- CHANGE --
$mail->AddAddress($owneremail, $ownername); //To Address -- CHANGE --
$mail->addCc($signedEmail,$ownername);///To UNCST
$mail->addCc("uncstuncstapps@gmail.com","Collins Mwesigwa");
$mail->AddReplyTo($recemail, $ownername); //Reply-To Address -- CHANGE --$usrm_email

$mail->WordWrap = 50; // set word wrap to 50 characters
$mail->IsHTML(false); // set email format to HTML
$mail->Subject = "$public_title  - $refNo";
$body="$allSentMessageConditional
<br><br>
$commentsFile
<br><br>
<a href='$base_url/studyapprovalviv.php?rmd_id=$rstug_UNCSTRefNumber2' style='background:#06F; border: none;  color: white; padding: 15px 32px;  text-align: center;  text-decoration: none;  display: inline-block; font-size: 16px;' target='_blank'>Download/Print PDF</a>";
$mail->MsgHTML($body);

if(!$mail->Send()){
	echo "Mailer Error: " . $mail->ErrorInfo;
}///end


 require_once("./viewlrcn/send_requestfor_viva.php");

 $queryp2w="select * from ".$prefix."study_approvals where rmd_id='$rstug_UNCSTRefNumber2' order by id desc";
$cmdw2=$mysqli->query($queryp2w);
if(!$cmdw2->num_rows){
$Insert_sendAp="insert into ".$prefix."study_approvals (`rstug_user_id`,`rstug_rsch_project_id`,`refNo`,`approvalMain`,`approvalText1`,`approvalText2`,`approvalText3`,`dateupdated`,`rmd_id`,`signature`,`totaldocs`,`DateApproved`,`studyTools`,`whosigns`) values ('$asrmApplctID_user','$protocol_idmm','$refNo','$sendTextHr','$sendText1','$sendText2','$sendText3',now(),'$rstug_UNCSTRefNumber2','$signature','$nummm','$sendTextDate','$sendTextStudyTools','$whosigns')";
$mysqli->query($Insert_sendAp);
}
if($cmdw2->num_rows){
$Insert_sendAp2="update ".$prefix."study_approvals set `approvalMain`='$sendTextHr',`approvalText1`='$sendText1',`approvalText2`='$sendText2',`approvalText3`='$sendText3',`dateupdated`=now(),`signature`='$signature',`totaldocs`='$nummm',`DateApproved`='$sendTextDate',`studyTools`='$sendTextStudyTools',`whosigns`='$whosigns' where `rmd_id`='$rstug_UNCSTRefNumber2'";
$mysqli->query($Insert_sendAp2);
}
///Send mail with comments to the PI

echo '<img src="images/loading_wait.gif">';
echo '<div class="spacer"></div>';
echo '<meta http-equiv="refresh" content="2; url='.$base_url.'/main.php?option=dashboard" />';
	
}
/////////////////Request for VIVA////////////////////////////////////////////






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
<?php if(isset($message)){echo $message;}?>

  


<!--  <button class="accordion">History, click to review</button>
  <div class="panel">Ngssss  snsnsnsn</div>-->
  
  
  
  
  
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


  

    <h4>Make Final Decision:</h4>
    
 <form action="" method="post" name="regForm" id="regForm" enctype="multipart/form-data">
<input name="type_of_review" type="hidden" value="<?php echo $rstudym['type_of_review'];?>"/>
<input name="riskLevel" type="hidden" value="<?php echo $rstudym['riskLevel'];?>"/>
<input name="protocolCode" type="hidden" value="<?php echo $rprotocalSub2Sel['id'];?>"/>

<?php if($rstudym['type_of_review']!='Expedited Review'){?>
<div class="form-group row success">

Meeting Number <font color="#CC0000">*</font><br />
<input name="MeetingNumber" type="text" value="" class="form-control required"/>
</div>
<?php }?>

<div class="form-group row success">
Meeting /Decision Date <font color="#CC0000">*</font><br />
<input name="Meetingdate" type="date" value="" class="form-control required"/>
</div>

<div class="form-group row success">
Approval Date <font color="#CC0000">*</font><br />
<input name="approvaldate" type="date" value="" class="form-control required"/>
</div>

<div class="form-group row success">

<select name="recruitment_status" id="recruitment_status" class="form-control  required"  onChange="getState2(this.value)">
<option value="">Select Decision status</option>
<?php
$sqlClinicalcv = "select * FROM ".$prefix."decision_status where (actionfor='both' OR actionfor='endreview') order by id asc";//and conceptm_status='new' 
$resultClinicalcv = $mysqli->query($sqlClinicalcv);
while($rClinicalcv=$resultClinicalcv->fetch_array()){
?>
<option value="<?php echo $rClinicalcv['name'];?>" <?php if($rprotocalSub2Sel['monitoring_action_id']==$rClinicalcv['id']){?>selected="selected"<?php }?>><?php echo $rClinicalcv['name'];?></option>
<?php }?>
</select>
<div id="statediv2"></div>

<input name="asrmApplctID_user" type="hidden" value="<?php echo $owner_id;?>"/>
<input name="protocol_idmm" type="hidden" value="<?php echo $protocol_idwe;?>"/>
<input name="submission_idm" type="hidden" value="<?php echo $id;?>"/>
<input name="public_title" type="hidden" value="<?php echo $public_title;?>"/>
<input name="studyRefNo" type="hidden" value="<?php echo $rprotocalSub2Sel['code'];?>"/>
<input name="reviewer_id" type="hidden" value="<?php echo $_SESSION['asrmApplctID'];?>"/>


</div>
<div class="line"></div>



<div class="form-group row success" style="margin-left:5px;">


<select name="whosigns" id="whosigns" class="form-control  required" style=" width:500px!important;">
<option value="">Please Select who signs on Decision Letter</option>
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
                    <input name="doEndReview" type="submit"  class="btn btn-primary" value="Save Decision and Finalize Process"/>

                          </div>
                        </div>
         </form>
                        
<script type="text/javascript">

var countries=new ddajaxtabs("countrytabs", "countrydivcontainer")
countries.setpersist(true)
countries.setselectedClassTarget("link") //"link" or "linkparent"
countries.init()

</script>