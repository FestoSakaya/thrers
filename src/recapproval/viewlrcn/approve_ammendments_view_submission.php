<ul id="countrytabs" class="shadetabs">
<li><a href="#" rel="#default" class="selected">Amendments View Submission</a></li>
</ul>

<div id="countrydivcontainer" style="border:0px solid gray; width:100%; margin-bottom: 1em; padding: 10px">
<?php
$sqlstudym="SELECT * FROM ".$prefix."ammendments where id='$id' order by id desc limit 0,1";
$Querystudym = $mysqli->query($sqlstudym);
$rstudym = $Querystudym->fetch_array();
$owner_id=$rstudym['owner_id'];
$code=$rstudym['code'];
$protocol_idwe=$rstudym['protocol_id'];
$ammendType=$rstudym['ammendType'];

if($rstudym['ammendType']=='online'){
$sqlprotocalSubSel="SELECT * FROM ".$prefix."submission where id='$protocol_idwe'";
$QprotocalSub2Sel = $mysqli->query($sqlprotocalSubSel);
$rprotocalSub2Sel = $QprotocalSub2Sel->fetch_array();

$public_title=$rprotocalSub2Sel['public_title'];
}

if($rstudym['ammendType']=='manual'){
$public_title=$rstudym['protocol_title'];	
}

$sqlSRR = "select * from ".$prefix."user where asrmApplctID='$owner_id'";
$resultSSS = $mysqli->query($sqlSRR);
$sqUserdd = $resultSSS->fetch_array();


if($_POST['doSendToEthical']=='Save Decision and Finalize Process' and $_POST['screening'] and $_POST['recruitment_status']=='Approved' and $_POST['renewal_id'] and $_POST['public_title'] and $id and $_POST['approvalvaliduntil'] and $_POST['initialReferenceNumber']  and $_POST['approvaldate']){

	$screening2=$mysqli->real_escape_string($_POST['screening']);
	$screening = str_replace('\r\n', '<br>', $screening2);
	
	
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
	
	$approvalvaliduntil=date("d/m/Y", strtotime($_POST['approvalvaliduntil']));
	$initialReferenceNumber=$mysqli->real_escape_string($_POST['initialReferenceNumber']);
	
	$restudytools2="select * from ".$prefix."ammendments where  owner_id='$asrmApplctID_user' and id='$id' order by id desc";
$cmdtools2 = $mysqli->query($restudytools2);
$DBtools2= $cmdtools2->fetch_array();

$rstug_UNCSTRefNumber=$DBtools2['code'];
$rstug_UNCSTRefNumber2=md5($DBtools2['code']);
$protocolCode=$DBtools2['code'];


	$nummm=1;
$restudytools="select * from ".$prefix."ammendments_documents where  owner_id='$asrmApplctID_user' and amendment_id='$id' and includedon_approval='Yes' order by id desc";
$cmdtools = $mysqli->query($restudytools);
while($DBtools= $cmdtools->fetch_array()){
	$nummm+1;

$DocumentsSubmitted.="

  <tr>
    <td width='6%' valign='top'>&nbsp;$nummm </td>
	<td width='27%' valign='top'>&nbsp;$DBtools[atype]</td>
    <td width='27%' valign='top'>&nbsp;$DBtools[aLanguage]</td>
    <td width='40%' valign='top'>&nbsp;$DBtools[aVersion]</td>
    <td width='12%' valign='top'>&nbsp;$DBtools[aDate]</td>
  </tr>
 "; $nummm++;}
	
	$querypUser="select * from apvr_user where asrmApplctID='$whosigns' order by asrmApplctID desc";
$cmdwUser=$mysqli->query($querypUser);
$rSwUser=$cmdwUser->fetch_array();
$signedby=$rSwUser['name'];
$signedEmail=$rSwUser['email'];
if($rSwUser['signatures']){$signature=$rSwUser['signatures'];}else{$signature="hellensignature.jpg";}
	
	$sqlInvestigators="SELECT * FROM ".$prefix."initial_committee_screening where `owner_id`='$asrmApplctID_user' and screening='$screening' and renewal_id='$id' and reviewer_id='$asrmApplctID' order by id desc";
	$QueryInvestigators = $mysqli->query($sqlInvestigators);
	$totalInvestigators = $QueryInvestigators->num_rows;
	
		if(!$totalInvestigators){
$sqlA2="insert into ".$prefix."initial_committee_screening (`owner_id`,`protocol_id`,`created`,`updated`,`screening`,`draftopinion`,`recAffiliated_id`,`reviewer_id`,`screeningFor`,`completionStatus`,`collectiveDecision`,`ammendType`,`renewal_id`,`public_title`) 

values('$asrmApplctID_user','$protocol_idmm',now(),now(),'$screening','$draftopinion2','$recAffiliated_id','$asrmApplctID','Amendments','Completed','Yes','$ammendType','$renewal_id','$public_title')";
$mysqli->query($sqlA2);
		}
		//////////////////////////Save Decision and Finalize Process send email
	//sleep(50);	
	////Get Protocl Comments
$sqlSComments = "select * from ".$prefix."initial_committee_screening where renewal_id='$id' and owner_id='$asrmApplctID_user' and screeningFor='Amendments'";
$resComments = $mysqli->query($sqlSComments);
while($sqComments = $resComments->fetch_array()){
$screeningmessage.=$sqComments['screening'].'<br>';
}	
		
///Get this meeting Number
$sqlSmeeting = "select * from ".$prefix."meeting where protocol_id='$protocol_idmm' and meetingFor='Amendments' order by id desc";
$resmeeting = $mysqli->query($sqlSmeeting);
$sqmeeting = $resmeeting->fetch_array();
$MeetingNumber=$sqmeeting['id'];
//$Meetingdate=date("d/m/Y", strtotime($sqmeeting['date']));

$sqlSRecruitment = "select * from ".$prefix."decision_status where id='$recruitment_status'";
$resRecruitment = $mysqli->query($sqlSRecruitment);
$sqRecruitment = $resRecruitment->fetch_array();

$status=$sqRecruitment['name'];
$Approvaltoday=date("d/m/Y", strtotime($_POST['approvaldate']));
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
$sqlA2="update ".$prefix."ammendments set `is_sent`='1',`status`='Approved',`period`='$period',`end_of_project`='$approvalvaliduntil' where id='$id'";//endofproject
$mysqli->query($sqlA2);

require_once("viewlrcn/mail_template_approval_ammendments.php");
$whatApproved="Ammendments";
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
//$mail->addBcc("uncstuncstapps@gmail.com","REC Approval Notice");//$recchairEmail
$mail->FromName = "$recOriginalName"; //From Name -- CHANGE --
$mail->AddAddress($owneremail, $ownername); //
//$mail->addCc("mawandammoses@gmail.com","REC Approval Notice");///To UNCST
$mail->AddReplyTo($recemail, $ownername); //Reply-To Address -- CHANGE --$usrm_email

$mail->WordWrap = 50; // set word wrap to 50 characters
$mail->IsHTML(false); // set email format to HTML
$mail->Subject = "REC Approval Notice - $public_title";
$body="$allSentMessage
<br><br>
<a href='$base_url/amendmentapproval.php?rmd_id=$rstug_UNCSTRefNumber2' style='background:#06F; border: none;  color: white; padding: 15px 32px;  text-align: center;  text-decoration: none;  display: inline-block; font-size: 16px;' target='_blank'>Download/Print PDF</a>";

$mail->MsgHTML($body);

if(!$mail->Send()){
	echo "Mailer Error: " . $mail->ErrorInfo;
}///end	


 require_once("./viewlrcn/send_approval_text_ammendments.php");

 $queryp2w="select * from ".$prefix."study_post_approvals where rmd_id='$rstug_UNCSTRefNumber2' order by id desc";
$cmdw2=$mysqli->query($queryp2w);
if(!$cmdw2->num_rows){
$Insert_sendAp="insert into ".$prefix."study_post_approvals (`rstug_user_id`,`rstug_rsch_project_id`,`refNo`,`approvalMain`,`approvalText1`,`approvalText2`,`approvalText3`,`dateupdated`,`rmd_id`,`signature`,`totaldocs`,`DateApproved`,`studyTools`,`whosigns`,`renewal_id`,`public_title`,`recAffiliated_id`,`ptype`) values ('$asrmApplctID_user','$protocol_idmm','$protocolCode','$sendTextHr','$sendText1','$sendText2','$sendText3',now(),'$rstug_UNCSTRefNumber2','$signature','$nummm','$sendTextDate','$sendTextStudyTools','$whosigns','$renewal_id','$public_title','$recAffiliated_id','Amendments')";
$mysqli->query($Insert_sendAp);
}

if($cmdw2->num_rows){
$Insert_sendAp2="update ".$prefix."study_post_approvals set `approvalMain`='$sendTextHr',`approvalText1`='$sendText1',`approvalText2`='$sendText2',`approvalText3`='$sendText3',`dateupdated`=now(),`signature`='$signature',`totaldocs`='$nummm',`DateApproved`='$sendTextDate',`studyTools`='$sendTextStudyTools',`whosigns`='$whosigns',`renewal_id`='$renewal_id',`public_title`='$public_title',`recAffiliated_id`='$recAffiliated_id',`ptype`='Amendments' where rmd_id='$rstug_UNCSTRefNumber2'";
$mysqli->query($Insert_sendAp2);	
}
///Send mail with comments to the PI

$msg="AMENDMENT: Dear $ownername, your protocol RefNo $protocolCode has been Approved, check your email for more details. $accroname. ";//

echo '<img src="images/loading_wait.gif">';
echo '<div class="spacer"></div>';
echo '<meta http-equiv="refresh" content="2; url='.$base_url.'/main.php?option=MyAmmendmentsREC" />';

		
}////End Approvals, rejects







if($_POST['doSendToEthical']=='Save Decision and Finalize Process' and $_POST['screening'] and ($_POST['recruitment_status']=='Rejected' || $_POST['recruitment_status']=='Resubmit | Needs Major Revisions') and $_POST['renewal_id'] and $_POST['public_title'] and $id and $_POST['approvaldate']){

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
	
	$nummm=1;
$restudytools="select * from ".$prefix."ammendments_documents where  owner_id='$asrmApplctID_user' and amendment_id='$id'  and includedon_approval='Yes' order by id desc";
$cmdtools = $mysqli->query($restudytools);
while($DBtools= $cmdtools->fetch_array()){
	$nummm+1;

$DocumentsSubmitted.="

  <tr>
    <td width='6%' valign='top'>&nbsp;$nummm </td>
	<td width='27%' valign='top'>&nbsp;$DBtools[atype]</td>
    <td width='27%' valign='top'>&nbsp;$DBtools[aLanguage]</td>
    <td width='40%' valign='top'>&nbsp;$DBtools[aVersion]</td>
    <td width='12%' valign='top'>&nbsp;$DBtools[aDate]</td>
  </tr>
 "; $nummm++;}
	
	$querypUser="select * from apvr_user where asrmApplctID='$whosigns' order by asrmApplctID desc";
$cmdwUser=$mysqli->query($querypUser);
$rSwUser=$cmdwUser->fetch_array();
$signedby=$rSwUser['name'];
$signedEmail=$rSwUser['email'];
if($rSwUser['signatures']){$signature=$rSwUser['signatures'];}else{$signature="hellensignature.jpg";}
	
	$sqlInvestigators="SELECT * FROM ".$prefix."initial_committee_screening where `owner_id`='$asrmApplctID_user' and screening='$screening' and renewal_id='$id' and reviewer_id='$asrmApplctID' order by id desc";
	$QueryInvestigators = $mysqli->query($sqlInvestigators);
	$totalInvestigators = $QueryInvestigators->num_rows;
	
		if(!$totalInvestigators){
$sqlA2="insert into ".$prefix."initial_committee_screening (`owner_id`,`protocol_id`,`created`,`updated`,`screening`,`draftopinion`,`recAffiliated_id`,`reviewer_id`,`screeningFor`,`completionStatus`,`collectiveDecision`,`ammendType`,`renewal_id`,`public_title`) 

values('$asrmApplctID_user','$protocol_idmm',now(),now(),'$screening','$draftopinion2','$recAffiliated_id','$asrmApplctID','Amendments','Completed','Yes','$ammendType','$renewal_id','$public_title')";
$mysqli->query($sqlA2);
		}
		//////////////////////////Save Decision and Finalize Process send email
	//sleep(50);	
	////Get Protocl Comments
$sqlSComments = "select * from ".$prefix."initial_committee_screening where renewal_id='$id' and owner_id='$asrmApplctID_user' and screeningFor='Amendments' order by id desc limit 0,1 ";
$resComments = $mysqli->query($sqlSComments);
while($sqComments = $resComments->fetch_array()){
$screeningmessage.=$sqComments['screening'].'<br>';
}	
		
///Get this meeting Number
$sqlSmeeting = "select * from ".$prefix."meeting where protocol_id='$protocol_idmm' and meetingFor='Amendments' order by id desc";
$resmeeting = $mysqli->query($sqlSmeeting);
$sqmeeting = $resmeeting->fetch_array();
$MeetingNumber=$sqmeeting['id'];
//$Meetingdate=date("d/m/Y", strtotime($sqmeeting['date']));

$sqlSRecruitment = "select * from ".$prefix."decision_status where id='$recruitment_status'";
$resRecruitment = $mysqli->query($sqlSRecruitment);
$sqRecruitment = $resRecruitment->fetch_array();

$status=$sqRecruitment['name'];
$Approvaltoday=date("d/m/Y", strtotime($_POST['approvaldate']));
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
$sqlA2="update ".$prefix."ammendments set `status`='Resubmit',`CompletenessCheck`='Pending',`is_sent`='0',`period`='',`end_of_project`=''  where id='$id'";
$mysqli->query($sqlA2);

require_once("viewlrcn/mail_template_reject_ammendments.php");
$whatApproved="Amendment";
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
//$mail->addCc("mawandammoses@gmail.com","REC Revisions Notice");///To UNCST
$mail->AddReplyTo($recemail, $ownername); //Reply-To Address -- CHANGE --$usrm_email

$mail->WordWrap = 50; // set word wrap to 50 characters
$mail->IsHTML(false); // set email format to HTML
$mail->Subject = "Amendment - $public_title";
$body="$allSentMessage
<br><br>
<a href='$base_url/amendmentresubmit.php?rmd_id=$rstug_UNCSTRefNumber2' style='background:#06F; border: none;  color: white; padding: 15px 32px;  text-align: center;  text-decoration: none;  display: inline-block; font-size: 16px;' target='_blank'>Download/Print PDF</a>";

$mail->MsgHTML($body);

if(!$mail->Send()){
	echo "Mailer Error: " . $mail->ErrorInfo;
}///end	


require_once("./viewlrcn/send_amendment_approval2.php");

 $queryp2w="select * from ".$prefix."study_post_approvals where rmd_id='$rstug_UNCSTRefNumber2' order by id desc";
$cmdw2=$mysqli->query($queryp2w);
if(!$cmdw2->num_rows){
$Insert_sendAp="insert into ".$prefix."study_post_approvals (`rstug_user_id`,`rstug_rsch_project_id`,`refNo`,`approvalMain`,`approvalText1`,`approvalText2`,`approvalText3`,`dateupdated`,`rmd_id`,`signature`,`totaldocs`,`DateApproved`,`studyTools`,`whosigns`,`renewal_id`,`public_title`,`recAffiliated_id`,`ptype`) values ('$asrmApplctID_user','$protocol_idmm','$protocolCode','$sendTextHr','$sendText1','$sendText2','$sendText3',now(),'$rstug_UNCSTRefNumber2','$signature','$nummm','$sendTextDate','$sendTextStudyTools','$whosigns','$renewal_id','$public_title','$recAffiliated_id','Amendments')";
$mysqli->query($Insert_sendAp);
}

if($cmdw2->num_rows){
$Insert_sendAp2="update ".$prefix."study_post_approvals set `approvalMain`='$sendTextHr',`approvalText1`='$sendText1',`approvalText2`='$sendText2',`approvalText3`='$sendText3',`dateupdated`=now(),`signature`='$signature',`totaldocs`='$nummm',`DateApproved`='$sendTextDate',`studyTools`='$sendTextStudyTools',`whosigns`='$whosigns',`renewal_id`='$renewal_id',`public_title`='$public_title',`recAffiliated_id`='$recAffiliated_id',`ptype`='Amendments' where rmd_id='$rstug_UNCSTRefNumber2'";
$mysqli->query($Insert_sendAp2);	
}
///Send mail with comments to the PI

$msg="AMENDMENT: Dear $ownername, your protocol RefNo $protocolCode has been Reviewed, check your email for more details. $accroname. ";//

echo '<img src="images/loading_wait.gif">';
echo '<div class="spacer"></div>';
echo '<meta http-equiv="refresh" content="2; url='.$base_url.'/main.php?option=MyAmmendmentsREC" />';
		
}////End Approvals, rejects




if($_POST['doSendToEthical']=='Save Decision and Finalize Process' and $_POST['screening'] and ($_POST['recruitment_status']=='Conditional Approval | Needs Minor Revisions') and $_POST['renewal_id'] and $_POST['public_title'] and $id and $_POST['approvaldate']){

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
	
	$sqlInvestigators="SELECT * FROM ".$prefix."initial_committee_screening where `owner_id`='$asrmApplctID_user' and screening='$screening' and renewal_id='$id' and reviewer_id='$asrmApplctID' order by id desc";
	$QueryInvestigators = $mysqli->query($sqlInvestigators);
	$totalInvestigators = $QueryInvestigators->num_rows;
	
		if(!$totalInvestigators){
$sqlA2="insert into ".$prefix."initial_committee_screening (`owner_id`,`protocol_id`,`created`,`updated`,`screening`,`draftopinion`,`recAffiliated_id`,`reviewer_id`,`screeningFor`,`completionStatus`,`collectiveDecision`,`ammendType`,`renewal_id`,`public_title`) 

values('$asrmApplctID_user','$protocol_idmm',now(),now(),'$screening','$draftopinion2','$recAffiliated_id','$asrmApplctID','Amendments','Completed','Yes','$ammendType','$renewal_id','$public_title')";
$mysqli->query($sqlA2);
		}
		//////////////////////////Save Decision and Finalize Process send email
	//sleep(50);	
	////Get Protocl Comments
$sqlSComments = "select * from ".$prefix."initial_committee_screening where renewal_id='$id' and owner_id='$asrmApplctID_user' and screeningFor='Amendments' order by id desc limit 0,1";
$resComments = $mysqli->query($sqlSComments);
while($sqComments = $resComments->fetch_array()){
$screeningmessage.=$sqComments['screening'].'<br>';
}	
		
///Get this meeting Number
$sqlSmeeting = "select * from ".$prefix."meeting where protocol_id='$protocol_idmm' and meetingFor='Amendments' order by id desc";
$resmeeting = $mysqli->query($sqlSmeeting);
$sqmeeting = $resmeeting->fetch_array();
$MeetingNumber=$sqmeeting['id'];
//$Meetingdate=date("d/m/Y", strtotime($sqmeeting['date']));

$sqlSRecruitment = "select * from ".$prefix."decision_status where id='$recruitment_status'";
$resRecruitment = $mysqli->query($sqlSRecruitment);
$sqRecruitment = $resRecruitment->fetch_array();

$status=$sqRecruitment['name'];
$Approvaltoday=date("d/m/Y", strtotime($_POST['approvaldate']));
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
$sqlA2="update ".$prefix."ammendments set `status`='Conditional Approval',`CompletenessCheck`='Pending',`is_sent`='0',`period`='',`end_of_project`='' where id='$id'";
$mysqli->query($sqlA2);

require_once("viewlrcn/mail_conditional_amendment_approval.php");
$whatApproved="Amendment";
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
//$mail->addCc("mawandammoses@gmail.com","REC Approval Notice");///To UNCST
$mail->AddReplyTo($recemail, $ownername); //Reply-To Address -- CHANGE --$usrm_email

$mail->WordWrap = 50; // set word wrap to 50 characters
$mail->IsHTML(false); // set email format to HTML
$mail->Subject = "Amendment - $public_title";
$body="$allSentMessageConditional
<br><br>
<a href='$base_url/amendmentresubmit.php?rmd_id=$rstug_UNCSTRefNumber2' style='background:#06F; border: none;  color: white; padding: 15px 32px;  text-align: center;  text-decoration: none;  display: inline-block; font-size: 16px;' target='_blank'>Download/Print PDF</a>";

$mail->MsgHTML($body);

if(!$mail->Send()){
	echo "Mailer Error: " . $mail->ErrorInfo;
}///end	


require_once("./viewlrcn/send_amendment_approval3.php");

 $queryp2w="select * from ".$prefix."study_post_approvals where rmd_id='$rstug_UNCSTRefNumber2' order by id desc";
$cmdw2=$mysqli->query($queryp2w);
if(!$cmdw2->num_rows){
$Insert_sendAp="insert into ".$prefix."study_post_approvals (`rstug_user_id`,`rstug_rsch_project_id`,`refNo`,`approvalMain`,`approvalText1`,`approvalText2`,`approvalText3`,`dateupdated`,`rmd_id`,`signature`,`totaldocs`,`DateApproved`,`studyTools`,`whosigns`,`renewal_id`,`public_title`,`recAffiliated_id`,`ptype`) values ('$asrmApplctID_user','$protocol_idmm','$protocolCode','$sendTextHr','$sendText1','$sendText2','$sendText3',now(),'$rstug_UNCSTRefNumber2','$signature','$nummm','$sendTextDate','$sendTextStudyTools','$whosigns','$renewal_id','$public_title','$recAffiliated_id','Amendments')";
$mysqli->query($Insert_sendAp);
}

if($cmdw2->num_rows){
$Insert_sendAp2="update ".$prefix."study_post_approvals set `approvalMain`='$sendTextHr',`approvalText1`='$sendText1',`approvalText2`='$sendText2',`approvalText3`='$sendText3',`dateupdated`=now(),`signature`='$signature',`totaldocs`='$nummm',`DateApproved`='$sendTextDate',`studyTools`='$sendTextStudyTools',`whosigns`='$whosigns',`renewal_id`='$renewal_id',`public_title`='$public_title',`recAffiliated_id`='$recAffiliated_id',`ptype`='Amendments' where rmd_id='$rstug_UNCSTRefNumber2'";
$mysqli->query($Insert_sendAp2);	
}
///Send mail with comments to the PI

$msg="AMENDMENT: Dear $ownername, your protocol RefNo $protocolCode has been marked, check your email for more details. $accroname. ";//

echo '<img src="images/loading_wait.gif">';
echo '<div class="spacer"></div>';
echo '<meta http-equiv="refresh" content="2; url='.$base_url.'/recapprova/main.php?option=MyAmmendmentsREC" />';
		
}////End Approvals, rejects







if($_POST['doSendToEthical']=='Save Decision and Finalize Process' and $_POST['screening'] and ($_POST['recruitment_status']=='Request for Responses') and $_POST['renewal_id'] and $id and $_POST['public_title'] and $_POST['approvaldate']){

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
	
	$sqlInvestigators="SELECT * FROM ".$prefix."initial_committee_screening where `owner_id`='$asrmApplctID_user' and screening='$screening' and renewal_id='$id' and reviewer_id='$asrmApplctID' order by id desc";
	$QueryInvestigators = $mysqli->query($sqlInvestigators);
	$totalInvestigators = $QueryInvestigators->num_rows;
	
		if(!$totalInvestigators){
$sqlA2="insert into ".$prefix."initial_committee_screening (`owner_id`,`protocol_id`,`created`,`updated`,`screening`,`draftopinion`,`recAffiliated_id`,`reviewer_id`,`screeningFor`,`completionStatus`,`collectiveDecision`,`ammendType`,`renewal_id`,`public_title`) 

values('$asrmApplctID_user','$protocol_idmm',now(),now(),'$screening','$draftopinion2','$recAffiliated_id','$asrmApplctID','Amendments','Completed','Yes','$ammendType','$renewal_id','$public_title')";
$mysqli->query($sqlA2);
		}
		//////////////////////////Save Decision and Finalize Process send email
	//sleep(50);	
	////Get Protocl Comments
$sqlSComments = "select * from ".$prefix."initial_committee_screening where renewal_id='$id' and owner_id='$asrmApplctID_user' and screeningFor='Amendments' order by id desc limit 0,1";
$resComments = $mysqli->query($sqlSComments);
while($sqComments = $resComments->fetch_array()){
$screeningmessage.=$sqComments['screening'].'<br>';
}	
		
///Get this meeting Number
$sqlSmeeting = "select * from ".$prefix."meeting where protocol_id='$protocol_idmm' and meetingFor='Amendments' order by id desc";
$resmeeting = $mysqli->query($sqlSmeeting);
$sqmeeting = $resmeeting->fetch_array();
$MeetingNumber=$sqmeeting['id'];
//$Meetingdate=date("d/m/Y", strtotime($sqmeeting['date']));

$sqlSRecruitment = "select * from ".$prefix."decision_status where id='$recruitment_status'";
$resRecruitment = $mysqli->query($sqlSRecruitment);
$sqRecruitment = $resRecruitment->fetch_array();

$status=$sqRecruitment['name'];
$Approvaltoday=date("d/m/Y", strtotime($_POST['approvaldate']));
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
$sqlA2="update ".$prefix."ammendments set `status`='Request for Responses',`CompletenessCheck`='Pending',`is_sent`='0',`period`='',`end_of_project`='' where id='$id'";
$mysqli->query($sqlA2);

require_once("viewlrcn/mail_request_for_responses_amendments.php");
$whatApproved="Amendment";
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
//$mail->addBcc("uncstuncstapps@gmail.com","$recOriginalName - REC Responses Notice");//$recchairEmail
$mail->FromName = "$recOriginalName"; //From Name -- CHANGE --
$mail->AddAddress($owneremail, $ownername); //
//$mail->addCc("mawandammoses@gmail.com","REC Approval Notice");///To UNCST
$mail->AddReplyTo($recemail, $ownername); //Reply-To Address -- CHANGE --$usrm_email


$mail->WordWrap = 50; // set word wrap to 50 characters
$mail->IsHTML(false); // set email format to HTML
$mail->Subject = "Amendment - $public_title";
$body="$allSentMessage
<br><br>
<a href='$base_url/amendmentresubmit.php?rmd_id=$rstug_UNCSTRefNumber2' style='background:#06F; border: none;  color: white; padding: 15px 32px;  text-align: center;  text-decoration: none;  display: inline-block; font-size: 16px;' target='_blank'>Download/Print PDF</a>";

$mail->MsgHTML($body);

if(!$mail->Send()){
	echo "Mailer Error: " . $mail->ErrorInfo;
}///end	


require_once("./viewlrcn/send_amendment_approval4.php");;

 $queryp2w="select * from ".$prefix."study_post_approvals where rmd_id='$rstug_UNCSTRefNumber2' order by id desc";
$cmdw2=$mysqli->query($queryp2w);
if(!$cmdw2->num_rows){
$Insert_sendAp="insert into ".$prefix."study_post_approvals (`rstug_user_id`,`rstug_rsch_project_id`,`refNo`,`approvalMain`,`approvalText1`,`approvalText2`,`approvalText3`,`dateupdated`,`rmd_id`,`signature`,`totaldocs`,`DateApproved`,`studyTools`,`whosigns`,`renewal_id`,`public_title`,`recAffiliated_id`,`ptype`) values ('$asrmApplctID_user','$protocol_idmm','$protocolCode','$sendTextHr','$sendText1','$sendText2','$sendText3',now(),'$rstug_UNCSTRefNumber2','$signature','$nummm','$sendTextDate','$sendTextStudyTools','$whosigns','$renewal_id','$public_title','$recAffiliated_id','Amendments')";
$mysqli->query($Insert_sendAp);
}

if($cmdw2->num_rows){
$Insert_sendAp2="update ".$prefix."study_post_approvals set `approvalMain`='$sendTextHr',`approvalText1`='$sendText1',`approvalText2`='$sendText2',`approvalText3`='$sendText3',`dateupdated`=now(),`signature`='$signature',`totaldocs`='$nummm',`DateApproved`='$sendTextDate',`studyTools`='$sendTextStudyTools',`whosigns`='$whosigns',`renewal_id`='$renewal_id',`public_title`='$public_title',`recAffiliated_id`='$recAffiliated_id',`ptype`='Amendments' where rmd_id='$rstug_UNCSTRefNumber2'";
$mysqli->query($Insert_sendAp2);	
}
///Send mail with comments to the PI

$msg="REC ANNUAL RENEWAL: Dear $ownername, your protocol RefNo $protocolCode has been renewed, check your email for more details. $accroname. ";//

echo '<img src="images/loading_wait.gif">';
echo '<div class="spacer"></div>';
echo '<meta http-equiv="refresh" content="2; url='.$base_url.'/main.php?option=MyAmmendmentsREC" />';
		
}////End Approvals, rejects


?>
  <!-- Project-->
              <div class="project">
                <div class="row bg-white has-shadow">
                  <div class="left-col col-lg-6 d-flex align-items-center justify-content-between">
                    <div class="project-title d-flex align-items-center">
                     <?php if($sqUserdd['profile']){?> <div class="image has-shadow"><img src="files/profile/<?php echo $sqUserdd['profile'];?>" alt="..." class="img-fluid"></div><?php }?>
                      <div class="text">
                        <h3 class="h4">Protocal Title</h3><small><?php echo $public_title;?></small>
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
$sqlstudy="SELECT * FROM ".$prefix."ammendments_documents where `owner_id`='$owner_id' and amendment_id='$id' order by id desc";
$Querystudy = $mysqli->query($sqlstudy);//assignedto='Not Assigned' and
$totalstudy = $Querystudy->num_rows;

?> 
<button class="accordion">Amendments, click to review</button>
  <div class="panel">
 
<table class="table table-striped table-sm" id="customers">
                  <thead>
                          <tr>
                          <th>Type</th>
                            <th>Language</th>
                            <th>Version</th>
                            <th>Date</th>

                          </tr>
                        </thead>
                        <tbody>
            <?php while($rstudy = $Querystudy->fetch_array()){
				$protocol_id=$rstudy['protocol_id'];
$wmSubmissions="select * from ".$prefix."submission where  `id`='$id'";
$cmdwbSubmissions = $mysqli->query($wmSubmissions);
$rSubmissions= $cmdwbSubmissions->fetch_array();
				
				?>
                          <tr>
                          <td><?php if($rstudy['fileAttachment']){?><a href="./files/uploads/<?php echo $rstudy['fileAttachment'];?>" target="_blank" style="color:#06F;"><?php echo $rstudy['atype'];?></a><?php }?></td>
                            
                            <td><?php echo $rstudy['aLanguage'];?></td>
                            <td><?php echo $rstudy['aVersion'];?></td>
                            <td><?php echo $rstudy['aDate'];?></td>
                            </tr>
               
               <?php }?>
                        </tbody>
                      </table>
  </div>
  
  
<button class="accordion">List of Changes, click to review</button>
  <div class="panel">

 
 
 <div class="form-group row success">
 <label class="col-sm-12 form-control-label"><b style="font-weight: bold!important;">Changes to Consent Form:  Are changes required?:</b> <?php echo $rstudym['ChangestoConsentForm'];?><br />
<a href="./files/uploads/<?php echo $rstudym['Attachnewconsentform'];?>" target="_blank"><?php echo $rstudym['Attachnewconsentform'];?></a>
</label>
 </div>
 
 
  <div class="form-group row success">
 <label class="col-sm-12 form-control-label">Changes to data collection tool: Are changes required?: <?php echo $rstudym['ChangestodataCollectionTool'];?><br />
<a href="./files/uploads/<?php echo $rstudym['Attachnewtool'];?>" target="_blank"><?php echo $rstudym['Attachnewtool'];?></a>
</label>
 </div>
 
 
   <div class="form-group row success">
 <label class="col-sm-12 form-control-label"><b style="font-weight: bold!important;">Changes to data collection tool: Are changes required?: </b><?php echo $rstudym['ChangestodataCollectionTool'];?><br />
<a href="./files/uploads/<?php echo $rstudym['Attachnewtool'];?>" target="_blank"><?php echo $rstudym['Attachnewtool'];?></a>
</label>
 </div>
 
 
 
    <div class="form-group row success">
 <label class="col-sm-12 form-control-label">Changes to protocol: Are changes required?: <?php echo $rstudym['ChangestoProtocol'];?><br />
<a href="./files/uploads/<?php echo $rstudym['Attachnewprotocol'];?>" target="_blank"><?php echo $rstudym['Attachnewprotocol'];?></a>
</label>
 </div>
 
   <div class="form-group row success">
 <label class="col-sm-12 form-control-label"><b style="font-weight: bold!important;">Are they changes to study districts? Please highlight districts:</b> <br /><?php echo $rstudym['changestostudyDistricts'];?>

</label>
 </div>
 
 <div class="form-group row success">
 <label class="col-sm-12 form-control-label"><b style="font-weight: bold!important;">Description of proposed changes:</b> <br /><?php echo $rstudym['listchanges'];?>

</label>
 
 
   <!--Approve Renewal1110--> 
<?php 
$sqlSMeeting = "select * from ".$prefix."meeting where protocol_id='$protocol_idwe' and meetingFor='Amendments' order by id desc";
$resultSMeeting = $mysqli->query($sqlSMeeting);
$sqUserMeeting = $resultSMeeting->fetch_array();

//mawandaif($rstudym['status']!='Approved'){ //$sqUserMeeting['meetingStatus']=='conducted' and ?>    
   <?php
$sqlgg2 = "select * FROM ".$prefix."initial_committee_screening where owner_id='$owner_id' and renewal_id='$id'  and screeningFor='Amendments' order by id desc";//and conceptm_status='new' 
$resultgg2 = $mysqli->query($sqlgg2);
while($rInvestigatorgg2=$resultgg2->fetch_array()){?>
<?php echo $rInvestigatorgg2['screening']."<hr />";}?>
 </div>   
  
  
 </div><!--End Panel--> 
  
  
   
    
 
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
$sqlA2rr="update ".$prefix."ammendments_documents set includedon_approval='$includedm' where owner_id='$owner_id' and amendment_id='$id' and id='$cfn_includedon_approval'";
$mysqli->query($sqlA2rr);


}
}
?>
 <form action="" method="post" name="regForm" id="regForm" autocomplte="off" enctype="multipart/form-data">
  <table class="table table-striped table-sm">
                        <thead>
                          <tr>
                          <th>&nbsp;</th>
                            <th>File name</th>
                            <th>Type</th>
                            <th>Language</th>
                            <th>Version</th>
                            <th>Submitted By</th>
                            <th> Date & Time</th>

                          </tr>
                        </thead>
                        <tbody>
                        <?php
//if no page var is given, set start to 0
$sql = "select *,DATE_FORMAT(`created`,'%d/%m/%Y %H:%s:%i') AS created FROM ".$prefix."ammendments_documents where owner_id='$owner_id' and amendment_id='$id' order by id desc LIMIT 0,150";//and conceptm_status='new' 
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
                            <td><a href="./files/uploads/<?php echo $rInvestigator['fileAttachment'];?>" target="_blank">View File</a></td>
                            <td><?php echo $rInvestigator['atype'];?></td>
                            <td><?php echo $rInvestigator['aLanguage'];?></td>
                            <td><?php echo $rInvestigator['aVersion'];?> </td>
                            <td><?php echo $rUsers['name'];?></td>
                            <td><?php echo $rInvestigator['aDate'];?></td>

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
 
 



 <form action="" method="post" name="regForm" id="regForm" enctype="multipart/form-data">
<h4>Collective Decisions (Comments will be shared with PI):</h4>
<div class="form-group row success">
<label class="col-sm-6 form-control-label" >Comments from the Committee Review Meeting (About this protocol): <font color="#CC0000">*</font></label>
<textarea name="screening" id="screening" cols="" rows="5" class="form-control  required" required><?php //echo $rInvestigatorgg2['screening'];?></textarea>

<?php /*?><textarea name="allComments" id="screening" cols="" rows="5" class="form-control  required"><?php echo $rInvestigatorgg2['screening'];?></textarea><?php */?>


<input name="asrmApplctID_user" type="hidden" value="<?php echo $owner_id;?>"/>
<input name="protocol_idmm" type="hidden" value="<?php echo $protocol_idwe;?>"/>
<input name="submission_idm" type="hidden" value="<?php echo $id;?>"/>

<input name="studyRefNo" type="hidden" value="<?php echo $rprotocalSub2Sel['code'];?>"/>
<input name="reviewer_id" type="hidden" value="<?php echo $_SESSION['asrmApplctID'];?>"/>
<input name="recAffiliated_id" type="hidden" value="<?php echo $recAffiliated_id;?>"/>
<input name="listchanges" type="hidden" value="<?php echo $rstudym['listchanges'];?>"/>
<input name="renewal_id" type="hidden" value="<?php echo $rstudym['id'];?>"/>
<input name="public_title" type="hidden" value="<?php echo $public_title;?>"/>
<input name="code" type="hidden" value="<?php echo $code;?>"/>
<input name="ammendType" type="hidden" value="<?php echo $ammendType;?>"/>
</div>
<div class="line"></div>




<div class="form-group row success">

<label class="col-sm-6 form-control-label" >Meeting Number <font color="#CC0000">*</font></label><br />
<input name="MeetingNumber" type="text" value="" class="form-control required" required/>
</div>

<div class="form-group row success">
<label class="col-sm-6 form-control-label" >Meeting /Decision Date <font color="#CC0000">*</font></label><br />
<input name="Meetingdate" type="date" value="" class="form-control required" required/>
</div>


<div class="form-group row success">
Approval Date <font color="#CC0000">*</font><br />
<input name="approvaldate" type="date" value="" class="form-control required"/>
</div>


<div class="form-group row success" style="margin-left:5px;">


<select name="whosigns" id="whosigns" class="form-control  required" style=" width:500px!important;" required>
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
<div class="line"></div>



<div class="form-group row success">
<label class="col-sm-4 form-control-label">Choose Action: <font color="#CC0000">*</font></label>
<select name="recruitment_status" id="recruitment_status" class="form-control  required" onChange="getInnitialApprovalDate(this.value)">
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

<div id="initialapprovaldate"></div>

<div class="form-group row">
                          <div class="col-sm-4 offset-sm-3">
                    <input name="doSendToEthical" type="submit"  class="btn btn-primary" value="Save Decision and Finalize Process"/>

                          </div>
   </div>
</form>
 
 <?php //mawanda}?>   
    
    
       
         
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