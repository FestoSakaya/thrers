<ul id="countrytabs" class="shadetabs">
<li><a href="#" rel="#default" class="selected">Ammendments View Submission</a></li>
</ul>

<div id="countrydivcontainer" style="border:0px solid gray; width:100%; margin-bottom: 1em; padding: 10px">
<?php
$sqlstudym="SELECT * FROM ".$prefix."ammendments where id='$id' order by id desc limit 0,1";
$Querystudym = $mysqli->query($sqlstudym);
$rstudym = $Querystudym->fetch_array();
$owner_id=$rstudym['owner_id'];
$code=$rstudym['code'];
$protocol_idwe=$rstudym['protocol_id'];
$renewal_id=$rstudym['id'];


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


if($_POST['doAssignReviewes']=='Save Details' and $_POST['protocol_title'] and $_POST['ammendType'] and $_POST['renewal_id'] and $id){///Add reviewers to this protccol

$asrmApplctID_user=$mysqli->real_escape_string($_POST['asrmApplctID_user']);
	$protocol_idmm=$mysqli->real_escape_string($_POST['protocol_idmm']);
	$recAffiliated_c=$mysqli->real_escape_string($_POST['recAffiliated_id']);
	//$subject=$mysqli->real_escape_string($_POST['Meetingsubject']);
	$subject=$mysqli->real_escape_string("Amendment for Review");
	$reviewtype=$mysqli->real_escape_string($_POST['reviewtype']);
	$cfnreviewer=$mysqli->real_escape_string($_POST['cfnreviewer']);
	$ammendType=$mysqli->real_escape_string($_POST['ammendType']);
	$renewal_id=$mysqli->real_escape_string($_POST['renewal_id']);
	$protocol_title=$mysqli->real_escape_string($_POST['protocol_title']);

$queryConceptLogs="select * from ".$prefix."submission_review_sr where reviewer_id='$cfnreviewer' and reviewFor='Amendments' and reviewStatus='Pending' and renewal_id='$renewal_id'";
$rsConceptLogs=$mysqli->query($queryConceptLogs);
$rTotalConceptLogs=$rsConceptLogs->num_rows;



if($subject){
$sqlA2rr="insert into ".$prefix."submission_review_sr (`asrmApplctID`,`protocol_id`,`owner_id`,`reviewer_id`,`reviewDate`,`recstatus`,`protocolStage`,`reviewtype`,`subject`,`recAffiliated_c`,`reviewFor`,`conflictofInterest`,`conflictReason`,`reviewStatus`,`reassigned`,`ammendType`,`renewal_id`,`public_title`) 

values('$cfnreviewer','$protocol_idmm','$asrmApplctID_user','$cfnreviewer',now(),'new','stage1','$reviewtype','$subject','$recAffiliated_c','Amendments','none','','Pending','No','$ammendType','$renewal_id','$protocol_title')";
$mysqli->query($sqlA2rr);
$message='<p class="success">Thank you, reviewer has been included on this protocol.</p>';
}



}

if($_POST['doAssignReviewesConfirm']=='Assign Now' and $id and $_POST['renewal_id']){
require("viewlrcn/class.phpmailer.php");
require("viewlrcn/class.smtp.php");

foreach($_POST['reviewer'] as $cfn_reviewer) {
$cfnreviewer= $cfn_reviewer;
//First get details about this submission
$renewal_id=$mysqli->real_escape_string($_POST['renewal_id']);

$queryConceptLogs="select * from ".$prefix."submission_review_sr where id='$cfnreviewer' and renewal_id='$renewal_id'";
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
    $recemail=$recNamew['recemail'];
	
$usr_ip = md5($_SERVER['REMOTE_ADDR']);
$md5pass = md5($_POST['pwd']);
$host  = $_SERVER['HTTP_HOST'];
$host_upper = strtoupper($host);
$path   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');



if($rTotalConceptLogs and $subject){
$sqlA2rr="update ".$prefix."submission_review_sr set recstatus='Pending' where reviewer_id='$cfnreviewer' and renewal_id='$renewal_id'";
$mysqli->query($sqlA2rr); 

$update="update ".$prefix."ammendments set status='Scheduled for Review',assignedto='Assigned' where id='$id'";
$mysqli->query($update);
///Now Send mail
require_once("viewlrcn/mail_template_assign_reviewers_amendmnet.php");
$ComponentAction="Amendments";
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
//$mail->addCc('mutumba.beth@yahoo.com',$recOriginalName);//
$mail->addBcc($recemail,$recOriginalName);//

$mail->FromName = "REC - $recOriginalName"; //From Name -- CHANGE --
$mail->AddAddress($usrm_email, $assignedtoName); //To Address -- CHANGE --
//if($dbEmail2){echo $mail->addCc($dbEmail2,'Activation Link from UNCST');}
$mail->AddReplyTo($usrm_email, $assignedtoName); //Reply-To Address -- CHANGE --$usrm_email

$mail->WordWrap = 50; // set word wrap to 50 characters
$mail->IsHTML(false); // set email format to HTML
$mail->Subject = "$subject - Amendment for Review";
$body="$allSentMessage";
$mail->MsgHTML($body);

if(!$mail->Send()){
	echo "Mailer Error: " . $mail->ErrorInfo;
}///end

}
		}
$message='<p class="success">Thank you, Amendments has been assigned.</p>';
	echo '<img src="images/loading_wait.gif">';
echo '<div class="spacer"></div>';
echo '<meta http-equiv="refresh" content="5; url='.$base_url.'/main.php?option=MyAmmendmentsREC" />';
}

//////////////////////////Make Final Decision


if($_POST['doSendToEthical']=='Save Decision and Finalize Process' and $_POST['screening'] and $_POST['recruitment_status']=='Approved'){

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
	$protocolCode=$mysqli->real_escape_string($_POST['protocolCode']);
	$protocolrefNo=$mysqli->real_escape_string($_POST['protocolCode']);
	$recruitment_status=$_POST['recruitment_status'];
	$type_of_review=$mysqli->real_escape_string($_POST['type_of_review']);
	$recAffiliated_id=$mysqli->real_escape_string($_POST['recAffiliated_id']);
	$listchanges=$mysqli->real_escape_string($_POST['listchanges']);

	
	$sqlInvestigators="SELECT * FROM ".$prefix."initial_committee_screening where `owner_id`='$asrmApplctID_user' and screening='$screening' and protocol_id='$protocol_idmm' and reviewer_id='$asrmApplctID' order by id desc";
	$QueryInvestigators = $mysqli->query($sqlInvestigators);
	$totalInvestigators = $QueryInvestigators->num_rows;
	
		if(!$totalInvestigators){
$sqlA2="insert into ".$prefix."initial_committee_screening (`owner_id`,`protocol_id`,`created`,`updated`,`screening`,`draftopinion`,`recAffiliated_id`,`reviewer_id`,`screeningFor`,`completionStatus`,`collectiveDecision`) 

values('$asrmApplctID_user','$protocol_idmm',now(),now(),'$screening','$draftopinion2','$recAffiliated_id','$asrmApplctID','Amendments','Completed','Yes')";
$mysqli->query($sqlA2);
		}
		//////////////////////////Save Decision and Finalize Process send email
	//sleep(50);	
	////Get Protocl Comments
$sqlSComments = "select * from ".$prefix."initial_committee_screening where protocol_id='$protocol_idmm' and owner_id='$asrmApplctID_user' and screeningFor='Amendments'";
$resComments = $mysqli->query($sqlSComments);
while($sqComments = $resComments->fetch_array()){
$screeningmessage.=$sqComments['screening'].'<br>';
}	
		
///Get this meeting Number
$sqlSmeeting = "select * from ".$prefix."meeting where protocol_id='$protocol_idmm' and meetingFor='Amendments' order by id desc";
$resmeeting = $mysqli->query($sqlSmeeting);
$sqmeeting = $resmeeting->fetch_array();
$MeetingNumber=$sqmeeting['id'];
$Meetingdate=date("d/m/Y", strtotime($sqmeeting['date']));

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

$restudytools2="select * from ".$prefix."ammendments where  owner_id='$asrmApplctID_user' and protocol_id='$protocol_idmm' order by id desc";
$cmdtools2 = $mysqli->query($restudytools2);
$DBtools2= $cmdtools2->fetch_array();

$rstug_UNCSTRefNumber=$DBtools2['code'];
$rstug_UNCSTRefNumber2=md5($DBtools2['code']);
$protocolCode=$DBtools2['code'];

$nummm=1;
$restudytools="select * from ".$prefix."ammendments where  owner_id='$asrmApplctID_user' and protocol_id='$protocol_idmm' order by id desc";
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


////Now send email
$sqlA2="update ".$prefix."ammendments set `status`='$recruitment_status',`period`='$period',`end_of_project`='$endofproject' where protocol_id='$protocol_idmm'  and code='$code'";
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
$mail->setFrom("uncstuncstapps@gmail.com", "REC Admin");
/////////////////////////////Begin Mail Body
///////////Send copy to UNCST Research
//mmmmm///$mail->addCc($recchairEmail,"$recOriginalName - Chairman"); //REC Chair
$mail->addBcc($recemail,"$recOriginalName");//$recchairEmail
$mail->FromName = "$recOriginalName"; //From Name -- CHANGE --
$mail->AddAddress($owneremail, $ownername); //
//$mail->addCc("mutumba.beth@yahoo.com","REC Approval Notice");///To UNCST  $owneremail
$mail->AddReplyTo($recemail, $ownername); //Reply-To Address -- CHANGE --$usrm_email

$mail->WordWrap = 50; // set word wrap to 50 characters
$mail->IsHTML(false); // set email format to HTML
$mail->Subject = "$public_title  - $protocolrefNo";
$body="$allSentMessage
<br><br>
<a href=''.$base_url.'/studyapproval.php?rmd_id=$rstug_UNCSTRefNumber2' style='background:#06F; border: none;  color: white; padding: 15px 32px;  text-align: center;  text-decoration: none;  display: inline-block; font-size: 16px;' target='_blank'>Download/Print PDF</a>
";
$mail->MsgHTML($body);

if(!$mail->Send()){
	echo "Mailer Error: " . $mail->ErrorInfo;
}///end	


 require_once("./viewlrcn/send_approval_text_ammendments.php");

 $queryp2w="select * from ".$prefix."study_approvals where rmd_id='$rstug_UNCSTRefNumber2' order by id desc";
$cmdw2=$mysqli->query($queryp2w);
if(!$cmdw2->num_rows){
$Insert_sendAp="insert into ".$prefix."study_approvals (`rstug_user_id`,`rstug_rsch_project_id`,`refNo`,`approvalMain`,`approvalText1`,`approvalText2`,`approvalText3`,`dateupdated`,`rmd_id`,`signature`,`totaldocs`,`DateApproved`,`studyTools`) values ('$asrmApplctID_user','$protocol_idmm','$protocolCode','$sendTextHr','$sendText1','$sendText2','$sendText3',now(),'$rstug_UNCSTRefNumber2','$signature','$nummm','$sendTextDate','$sendTextStudyTools')";
$mysqli->query($Insert_sendAp);
}



echo '<img src="images/loading_wait.gif">';
echo '<div class="spacer"></div>';
echo '<meta http-equiv="refresh" content="1; url='.$base_url.'/main.php?option=MyAmmendmentsREC" />';
		
}////End Approvals, rejects


if($_POST['doSendToEthical']=='Save Decision and Finalize Process' and $_POST['screening'] and $_POST['recruitment_status']=='Rejected'){

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
	$protocolCode=$mysqli->real_escape_string($_POST['protocolCode']);
	$protocolrefNo=$mysqli->real_escape_string($_POST['protocolCode']);
	$recruitment_status=$_POST['recruitment_status'];
	$type_of_review=$mysqli->real_escape_string($_POST['type_of_review']);
	$recAffiliated_id=$mysqli->real_escape_string($_POST['recAffiliated_id']);
	$listchanges=$mysqli->real_escape_string($_POST['listchanges']);

	
	$sqlInvestigators="SELECT * FROM ".$prefix."initial_committee_screening where `owner_id`='$asrmApplctID_user' and screening='$screening' and protocol_id='$protocol_idmm' and reviewer_id='$asrmApplctID' order by id desc";
	$QueryInvestigators = $mysqli->query($sqlInvestigators);
	$totalInvestigators = $QueryInvestigators->num_rows;
	
		if(!$totalInvestigators){
$sqlA2="insert into ".$prefix."initial_committee_screening (`owner_id`,`protocol_id`,`created`,`updated`,`screening`,`draftopinion`,`recAffiliated_id`,`reviewer_id`,`screeningFor`,`completionStatus`,`collectiveDecision`) 

values('$asrmApplctID_user','$protocol_idmm',now(),now(),'$screening','$draftopinion2','$recAffiliated_id','$asrmApplctID','Amendments','Completed','Yes')";
$mysqli->query($sqlA2);
		}
		//////////////////////////Save Decision and Finalize Process send email
	//sleep(50);	
	////Get Protocl Comments
$sqlSComments = "select * from ".$prefix."initial_committee_screening where protocol_id='$protocol_idmm' and owner_id='$asrmApplctID_user' and screeningFor='Amendments'";
$resComments = $mysqli->query($sqlSComments);
while($sqComments = $resComments->fetch_array()){
$screeningmessage.=$sqComments['screening'].'<br>';
}	
		
///Get this meeting Number
$sqlSmeeting = "select * from ".$prefix."meeting where protocol_id='$protocol_idmm' and meetingFor='Amendments' order by id desc";
$resmeeting = $mysqli->query($sqlSmeeting);
$sqmeeting = $resmeeting->fetch_array();
$MeetingNumber=$sqmeeting['id'];
$Meetingdate=date("d/m/Y", strtotime($sqmeeting['date']));

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


require_once("viewlrcn/mail_template_reject_ammendments.php");
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
$mail->addBcc($recemail,"$recOriginalName");//$recchairEmail
$mail->FromName = "$recOriginalName"; //From Name -- CHANGE --
$mail->AddAddress($owneremail, $ownername); //
//$mail->addCc("mutumba.beth@yahoo.com","REC Reject Notice");///To UNCST  $owneremail
$mail->AddReplyTo($recemail, $ownername); //Reply-To Address -- CHANGE --$usrm_email

$mail->WordWrap = 50; // set word wrap to 50 characters
$mail->IsHTML(false); // set email format to HTML
$mail->Subject = "$public_title  - $protocolrefNo";
$body="$allSentMessage";
$mail->MsgHTML($body);

if(!$mail->Send()){
	echo "Mailer Error: " . $mail->ErrorInfo;
}///end	



echo '<img src="images/loading_wait.gif">';
echo '<div class="spacer"></div>';
echo '<meta http-equiv="refresh" content="1; url='.$base_url.'/main.php?option=MyAmmendmentsREC" />';
		
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
$sqlstudy="SELECT * FROM ".$prefix."ammendments_documents where `owner_id`='$owner_id' and code='$code' order by id desc";
$Querystudy = $mysqli->query($sqlstudy);//assignedto='Not Assigned' and
$totalstudy = $Querystudy->num_rows;

?> 
<button class="accordion">Ammendments, click to review</button>
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
$wmSubmissions="select * from ".$prefix."submission where  `id`='$protocol_id'";
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
 </div>
 
 
 </div>   
  
  
  
  
  
    
    
   <?php
   ///////////////////Assign Reviewers
$sqlgg = "select * FROM ".$prefix."initial_committee_screening where owner_id='$owner_id' and renewal_id='$renewal_id' and screeningFor='Amendments' and completionStatus='Pending'";//and conceptm_status='new' 
$resultgg = $mysqli->query($sqlgg);
$rInvestigatorgg=$resultgg->fetch_array();

if($_GET['status']=='delete' and $id and $_GET['sid']){
    $sid=$_GET['sid'];
	$sqlA2Protocol2="delete from ".$prefix."submission_review_sr where renewal_id='$renewal_id' and id='$sid'";
	$mysqli->query($sqlA2Protocol2);
	$message='<p class="error2">Reviewer has been removed.</p>';
	}

?>

<?php if(($rstudym['assignedto']!='Assigned' || $rstudym['assignedto']=='Assigned') and $session_privillage!='investigator' and $session_privillage!='recreviewer'){?>
<button id="myBtn">Click to Add Reviewers to this Amendment</button>   
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
$sqlProtocols="SELECT * FROM ".$prefix."submission_review_sr  where renewal_id='$renewal_id' and recstatus='new' and reviewFor='Amendments' order by id desc";
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
	<?php echo $sqReviewer['name'];?>
    <input name="renewal_id" type="hidden" value="<?php echo $sqProtocols['renewal_id'];?>"/>
    
    
    </td>
    
    
    <td width="22%" align="left" style="padding-bottom:20px;" class="defmf2"><?php echo $sqProtocols['reviewtype'];?> </td>
    <td width="48%" align="left" class="defmf2"><?php echo $sqProtocols['subject'];?></td>
    <td width="48%" align="left" class="defmf2"><a href="main.php?option=ConfirmAmmendments&id=<?php echo $id;?>&sid=<?php echo $sqProtocols['id'];?>&status=delete" style="color:#F00; font-weight:bold;" onclick="return confirm('Are you sure you want to delete this item?');">Delete</a></td>
  </tr>



<?php }?>
</table>
<?php if($rTotalAnyAssigned and $session_privillage!='investigator' and $session_privillage!='recreviewer'){?><input name="doAssignReviewesConfirm" type="submit"  class="btn btn-primary" value="Assign Now"/><?php }?>
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

<input name="renewal_id" type="hidden" value="<?php echo $id;?>"/>
<input name="ammendType" type="hidden" value="<?php echo $rstudym['ammendType'];?>"/>
<input name="protocol_title" type="hidden" value="<?php echo $public_title;?>"/>
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

<?php /*?>  <div class="form-group row">
  <label class="col-sm-3 form-control-label">Meeting Subject: <span class="error">*</span></label>
  <div class="col-sm-8">

  <select name="Meetingsubject" id="Meetingsubject" class="form-control  required" required>
  <option value="">Please Select</option>
<?php
$sqlMeeting="SELECT * FROM ".$prefix."meeting  where recAffiliated_id='$recAffiliated_id' and date>='$today' and protocol_id='$id' and meetingFor='Amendments'";
$QueryMeeting=$mysqli->query($sqlMeeting);
while($sqMeeting = $QueryMeeting->fetch_array()){?>
<option value="<?php echo $sqMeeting['subject'];?>"><?php echo $sqMeeting['subject'];?></option>
<?php }?>
</select>

</div>
</div> <?php */?>

       <div class="form-group row">
   <div class="col-sm-8 offset-sm-3sss">
   <?php
$sqlMeeting2="SELECT * FROM ".$prefix."meeting  where recAffiliated_id='$recAffiliated_id' and date>='$today' and protocol_id='$id' and meetingFor='Amendments'";
$QueryMeeting2=$mysqli->query($sqlMeeting2);
$protocolMeeting2 = $QueryMeeting2->num_rows;
//if(!$protocolMeeting2){echo "<span  style='color:#F00;'>Please Add meeting, Amendment will not be assigned without creating a meeting</span>";}
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