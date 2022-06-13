<ul id="countrytabs" class="shadetabs">
<li><a href="#" rel="#default" class="selected">Deviations View Submission</a></li>
</ul>

<div id="countrydivcontainer" style="border:0px solid gray; width:100%; margin-bottom: 1em; padding: 10px">
<?php
$sqlstudym="SELECT * FROM ".$prefix."deviations where deviationID='$id' order by deviationID desc limit 0,1";
$Querystudym = $mysqli->query($sqlstudym);
$rstudym = $Querystudym->fetch_array();
$owner_id=$rstudym['owner_id'];
$protocol_idwe=$rstudym['protocol_id'];


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

////Payment Proof
if($_POST['doSendConfirmPayemnt']=='Save' and $id){
$paymentStatus=$mysqli->real_escape_string($_POST['paymentStatus']);

$restudytools2="update ".$prefix."deviations set paymentProof='$paymentStatus' where  owner_id='$owner_id' and deviationID='$id'";
$mysqli->query($restudytools2);


echo '<img src="images/loading_wait.gif">';
echo '<div class="spacer"></div>';
echo '<meta http-equiv="refresh" content="1; url='.$base_url.'/main.php?option=MyDeviationsREC" />';
		
}////End Approvals, rejects


if($_POST['doAssignReviewes']=='Save Details'){///Add reviewers to this protccol

$asrmApplctID_user=$mysqli->real_escape_string($_POST['asrmApplctID_user']);
	$protocol_idmm=$mysqli->real_escape_string($_POST['protocol_idmm']);
	$recAffiliated_c=$mysqli->real_escape_string($_POST['recAffiliated_id']);
	$subject=$mysqli->real_escape_string($_POST['Meetingsubject']);
	$reviewtype=$mysqli->real_escape_string($_POST['reviewtype']);
	$cfnreviewer=$mysqli->real_escape_string($_POST['cfnreviewer']);

$queryConceptLogs="select * from ".$prefix."submission_review_sr where protocol_id='$protocol_idmm' and reviewer_id='$cfnreviewer'";
$rsConceptLogs=$mysqli->query($queryConceptLogs);
$rTotalConceptLogs=$rsConceptLogs->num_rows;



if($subject){
$sqlA2rr="insert into ".$prefix."submission_review_sr (`asrmApplctID`,`protocol_id`,`owner_id`,`reviewer_id`,`reviewDate`,`recstatus`,`protocolStage`,`reviewtype`,`subject`,`recAffiliated_c`,`reviewFor`,`conflictofInterest`) 

values('$cfnreviewer','$protocol_idmm','$asrmApplctID_user','$cfnreviewer',now(),'new','stage1','$reviewtype','$subject','$recAffiliated_c','Deviations','none')";
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

$update="update ".$prefix."deviations set status='Scheduled for Review',assignedto='Assigned' where deviationID='$id'";
$mysqli->query($update);
///Now Send mail
require_once("viewlrcn/mail_template_approval_deviations.php");
$ComponentAction="Deviations";
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
//$mail->addBcc('uncstuncstapps@gmail.com',$recOriginalName);//

$mail->FromName = "REC - $recOriginalName"; //From Name -- CHANGE --
$mail->AddAddress("mawandammoses@gmail.com", $assignedtoName); //To Address -- CHANGE --
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
$message='<p class="success">Thank you, Deviations has been assigned.</p>';
	echo '<img src="images/loading_wait.gif">';
echo '<div class="spacer"></div>';
echo '<meta http-equiv="refresh" content="5; url='.$base_url.'/main.php?option=MyDeviationsREC" />';
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
	$protocolCode=$mysqli->real_escape_string($_POST['studyRefNo']);
	$recruitment_status=$_POST['recruitment_status'];
	$type_of_review=$mysqli->real_escape_string($_POST['type_of_review']);
	$recAffiliated_id=$mysqli->real_escape_string($_POST['recAffiliated_id']);
	$listchanges=$mysqli->real_escape_string($_POST['listchanges']);
	
	$TrachedChangesLanguage=$mysqli->real_escape_string($_POST['TrachedChangesLanguage']);
	$TrachedChangesVersion=$mysqli->real_escape_string($_POST['TrachedChangesVersion']);
	$TrachedChangesDate=$mysqli->real_escape_string($_POST['TrachedChangesDate']);
	$CleanCopyLanguage=$mysqli->real_escape_string($_POST['CleanCopyLanguage']);
	$CleanCopyVersion=$mysqli->real_escape_string($_POST['CleanCopyVersion']);
	$CleanCopyDate=$mysqli->real_escape_string($_POST['CleanCopyDate']);
	$CoverLetterLanguage=$mysqli->real_escape_string($_POST['CoverLetterLanguage']);
	$CoverLetterVersion=$mysqli->real_escape_string($_POST['CoverLetterVersion']);
	$CoverLetterDate=$mysqli->real_escape_string($_POST['CoverLetterDate']);
	
	$sqlInvestigators="SELECT * FROM ".$prefix."initial_committee_screening where `owner_id`='$asrmApplctID_user' and screening='$screening' and protocol_id='$protocol_idmm' and reviewer_id='$asrmApplctID' order by id desc";
	$QueryInvestigators = $mysqli->query($sqlInvestigators);
	$totalInvestigators = $QueryInvestigators->num_rows;
	
		if(!$totalInvestigators){
$sqlA2="insert into ".$prefix."initial_committee_screening (`owner_id`,`protocol_id`,`created`,`updated`,`screening`,`draftopinion`,`recAffiliated_id`,`reviewer_id`,`screeningFor`,`completionStatus`,`collectiveDecision`) 

values('$asrmApplctID_user','$protocol_idmm',now(),now(),'$screening','$draftopinion2','$recAffiliated_id','$asrmApplctID','Deviations','Completed','Yes')";
$mysqli->query($sqlA2);
		}
		//////////////////////////Save Decision and Finalize Process send email
	//sleep(50);	
	////Get Protocl Comments
$sqlSComments = "select * from ".$prefix."initial_committee_screening where protocol_id='$protocol_idmm' and owner_id='$asrmApplctID_user' and screeningFor='Deviations'";
$resComments = $mysqli->query($sqlSComments);
while($sqComments = $resComments->fetch_array()){
$screeningmessage.=$sqComments['screening'].'<br>';
}	
		
///Get this meeting Number
$sqlSmeeting = "select * from ".$prefix."meeting where protocol_id='$protocol_idmm' and meetingFor='Deviations' order by id desc";
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
$sqlA2="update ".$prefix."deviations set `status`='$recruitment_status' where deviationID='$id'";
$mysqli->query($sqlA2);


require_once("viewlrcn/mail_template_approval_deviations.php");
$whatApproved="Deviations";
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
$mail->addBcc("uncstuncstapps@gmail.com","$recOriginalName - REC Approval Notice");//$recchairEmail
$mail->FromName = "$recOriginalName"; //From Name -- CHANGE --
$mail->AddAddress($owneremail, $ownername); //
//$mail->addCc("mutumba.beth@yahoo.com","REC Approval Notice");///To UNCST
$mail->AddReplyTo($recemail, $ownername); //Reply-To Address -- CHANGE --$usrm_email

$mail->WordWrap = 50; // set word wrap to 50 characters
$mail->IsHTML(false); // set email format to HTML
$mail->Subject = "$public_title  - $protocolCode";
$body="$allSentMessage";
$mail->MsgHTML($body);

if(!$mail->Send()){
	echo "Mailer Error: " . $mail->ErrorInfo;
}///end	
echo '<img src="images/loading_wait.gif">';
echo '<div class="spacer"></div>';
echo '<meta http-equiv="refresh" content="2; url='.$base_url.'/main.php?option=MyDeviationsREC" />';
	
	

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
	$protocolCode=$mysqli->real_escape_string($_POST['studyRefNo']);
	$recruitment_status=$_POST['recruitment_status'];
	$type_of_review=$mysqli->real_escape_string($_POST['type_of_review']);
	$recAffiliated_id=$mysqli->real_escape_string($_POST['recAffiliated_id']);
	$listchanges=$mysqli->real_escape_string($_POST['listchanges']);
	
	$TrachedChangesLanguage=$mysqli->real_escape_string($_POST['TrachedChangesLanguage']);
	$TrachedChangesVersion=$mysqli->real_escape_string($_POST['TrachedChangesVersion']);
	$TrachedChangesDate=$mysqli->real_escape_string($_POST['TrachedChangesDate']);
	$CleanCopyLanguage=$mysqli->real_escape_string($_POST['CleanCopyLanguage']);
	$CleanCopyVersion=$mysqli->real_escape_string($_POST['CleanCopyVersion']);
	$CleanCopyDate=$mysqli->real_escape_string($_POST['CleanCopyDate']);
	$CoverLetterLanguage=$mysqli->real_escape_string($_POST['CoverLetterLanguage']);
	$CoverLetterVersion=$mysqli->real_escape_string($_POST['CoverLetterVersion']);
	$CoverLetterDate=$mysqli->real_escape_string($_POST['CoverLetterDate']);
	
	$sqlInvestigators="SELECT * FROM ".$prefix."initial_committee_screening where `owner_id`='$asrmApplctID_user' and screening='$screening' and protocol_id='$protocol_idmm' and reviewer_id='$asrmApplctID' order by id desc";
	$QueryInvestigators = $mysqli->query($sqlInvestigators);
	$totalInvestigators = $QueryInvestigators->num_rows;
	
		if(!$totalInvestigators){
$sqlA2="insert into ".$prefix."initial_committee_screening (`owner_id`,`protocol_id`,`created`,`updated`,`screening`,`draftopinion`,`recAffiliated_id`,`reviewer_id`,`screeningFor`,`completionStatus`,`collectiveDecision`) 

values('$asrmApplctID_user','$protocol_idmm',now(),now(),'$screening','$draftopinion2','$recAffiliated_id','$asrmApplctID','Deviations','Completed','Yes')";
$mysqli->query($sqlA2);
		}
		//////////////////////////Save Decision and Finalize Process send email
	//sleep(50);	
	////Get Protocl Comments
$sqlSComments = "select * from ".$prefix."initial_committee_screening where protocol_id='$protocol_idmm' and owner_id='$asrmApplctID_user' and screeningFor='Deviations'";
$resComments = $mysqli->query($sqlSComments);
while($sqComments = $resComments->fetch_array()){
$screeningmessage.=$sqComments['screening'].'<br>';
}	
		
///Get this meeting Number
$sqlSmeeting = "select * from ".$prefix."meeting where protocol_id='$protocol_idmm' and meetingFor='Deviations' order by id desc";
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


require_once("viewlrcn/mail_template_rejeted_deviations.php");
$whatApproved="Deviations";
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
$mail->addBcc("uncstuncstapps@gmail.com","$recOriginalName - REC Reject Notice");//$recchairEmail
$mail->FromName = "$recOriginalName"; //From Name -- CHANGE --
$mail->AddAddress($owneremail, $ownername); //
//$mail->addCc("mutumba.beth@yahoo.com","REC Reject Notice");///To UNCST
$mail->AddReplyTo($recemail, $ownername); //Reply-To Address -- CHANGE --$usrm_email

$mail->WordWrap = 50; // set word wrap to 50 characters
$mail->IsHTML(false); // set email format to HTML
$mail->Subject = "$public_title  - $protocolCode";
$body="$allSentMessage";
$mail->MsgHTML($body);

if(!$mail->Send()){
	echo "Mailer Error: " . $mail->ErrorInfo;
}///end	
echo '<img src="images/loading_wait.gif">';
echo '<div class="spacer"></div>';
echo '<meta http-equiv="refresh" content="2; url='.$base_url.'/main.php?option=MyDeviationsREC" />';

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
$sqlstudy="SELECT * FROM ".$prefix."deviations where deviationID='$id' order by deviationID desc limit 0,1";
$Querystudy = $mysqli->query($sqlstudy);
$totalstudy = $Querystudy->num_rows;
$rstudy = $Querystudy->fetch_array();
?> 

<button class="accordion">Protocol Details</button>
  <div class="panel">

   
   <div style="clear:both;"></div>

<?php 
if($rstudy['ammendType']=='manual'){?>
   <div class="form-group row success">
 <label class="col-sm-12 form-control-label">Protocol Title: <br /></label>
<?php echo $rstudy['protocol_title'];?>
</div>
<div class="line"></div> 
<?php }?>

                                          

<?php if($rstudy['ammendType']=='online'){?>
<div class="form-group row success">
 <label class="col-sm-12 form-control-label">Choose REC: <br /></label>

<select name="recAffiliated_id" id="recAffiliated_id" class="form-control  required" required>
<option value="">Please Select</option>
<?php
$sqlClinicalcv2 = "select * FROM ".$prefix."list_rec_affiliated where published='Yes' order by name asc";//and conceptm_status='new' 
$resultClinicalcv2 = $mysqli->query($sqlClinicalcv2);
while($rClinicalcv2=$resultClinicalcv2->fetch_array()){
?>
<option value="<?php echo $rClinicalcv2['id'];?>" <?php if($rClinicalcv2['id']==$rstudy['recAffiliated_id']){?>selected="selected"<?php }?>><?php echo $rClinicalcv2['name'];?></option>
<?php }?> 
</select>

</div>
<div class="line"></div> 
   <?php }?> 
   </div>



<button class="accordion">A) Protocol Deviation (May pose no more than minimal risk to participants and protocol implementation)</button>
  <div class="panel">
 <?php


$shcategoryID3=$rstudy['parta'];
$categoryChunks3 = explode("|", $shcategoryID3);

$chop1="$categoryChunks3[0]";
$chop2="$categoryChunks3[1]";
$chop3="$categoryChunks3[2]";
$chop4="$categoryChunks3[3]";
$chop5="$categoryChunks3[4]";
$chop6="$categoryChunks3[5]";
$chop7="$categoryChunks3[6]";
$chop8="$categoryChunks3[7]";
$chop9="$categoryChunks3[8]";
$chop10="$categoryChunks3[9]";
//////////////////////////////////////////
$shcategoryID4=$rstudy['partb'];
$categoryChunks4 = explode("|", $shcategoryID4);

$chei1="$categoryChunks4[0]";
$chei2="$categoryChunks4[1]";
$chei3="$categoryChunks4[2]";
$chei4="$categoryChunks4[3]";
$chei5="$categoryChunks4[4]";
$chei6="$categoryChunks4[5]";
$chei7="$categoryChunks4[6]";
$chei8="$categoryChunks4[7]";
$chei9="$categoryChunks4[8]";
$chei10="$categoryChunks4[9]";
?>
                    
                        
                                           
                       <div class="form-group row success">
                        <label class="form-control-label" style="font-weight:bold;">A) Protocol Deviation (May pose no more than minimal risk to participants and protocol implementation)</label>
                        </div>
                   
                   <div class="line"></div>
                        <div class="form-group row success">
      
                          <label class="col-sm-4 form-control-label">1.	Date of occurrence:</label>
                          <input type="date" name="PDDateofoccurrence" id="PDDateofoccurrence" class="form-control  required" value="<?php echo $rstudy['PDDateofoccurrence'];?>" readonly="readonly">
                        </div>
                        <div class="line"></div>
                        
                        
                         <div class="form-group row success">
                          <label class="col-sm-4 form-control-label">2.	Description of deviation:</label>
                                                  
                   <textarea name="PDDescriptionofdeviation" id="MyTextBox3" cols="" rows="5" class="form-control  required"  readonly="readonly"><?php echo $rstudy['PDDescriptionofdeviation'];?></textarea>       
                  <p id="countermm">Characters limit: <span  id="countercol">250 words</span></p>         
                          
                          
                            <input type="hidden" name="asrmApplctID" value="<?php echo $_SESSION['asrmApplctID'];?>">
    
                        </div>
                        <div class="line"></div>
                        
                          <div class="form-group row success">
                          <label class="col-sm-4 form-control-label">3.	Root cause of deviation:</label>
                                      
                          
                         <textarea name="Rootcauseofdeviation" id="MyTextBox4" cols="" rows="5" class="form-control  required" readonly="readonly"><?php echo $rstudy['Rootcauseofdeviation'];?></textarea>       
                  <p id="countermm">Characters limit: <span  id="countercol">250 words</span></p> 
                          
                        </div>
                        <div class="line"></div>
                        
                        <div class="form-group row success">
                          <label class="col-sm-4 form-control-label">4.	Corrective action taken:</label>
                          
                  <textarea name="Correctiveactiontaken" id="MyTextBox5" cols="" rows="5" class="form-control  required" readonly="readonly"><?php echo $rstudy['Correctiveactiontaken'];?></textarea>       
                  <p id="countermm">Characters limit: <span  id="countercol">250 words</span></p>          
                          
                        </div>
                        <div class="line"></div>
                        
                         <div class="form-group row success">
                          <label class="col-sm-4 form-control-label">5.	Measures to mitigate deviation:</label>
           
  <?php

$qRPersoneld="select * from ".$prefix."saes_measures_mitigate_dev  where owner_id='$sessionasrmApplctID' and renewal_id='$id'";
$RPersoneld=$mysqli->query($qRPersoneld);
?>             
                                     
                  
                  <table width="100%" border="0" id="POITable" class="success">
        <tr>
            <th width="3%" style=" display:none;">&nbsp;</th>
            <th width="74%"><strong>Measures (one per row)<span class="error3">*</span></strong></th>

        </tr>

        </table>

   
<?php

while ($rowRows = $RPersoneld->fetch_array())
{ ///Display data for education history
	?>  <label class="form-control-label">
<?php echo $rowRows['Measurestomitigatedeviation'];?> </label><br />
<?php
}

?> 
                     
</div>



  </div><!--Panel A Ends-->


<!--Panel B Ends-->  
<button class="accordion">B)	Protocol violation (May pose high risk to participants and protocol implementation)</button>
  <div class="panel">
 
                        
                            <div class="form-group row success">
      
                          <label class="col-sm-4 form-control-label">1.	Date of occurrence:</label>
                          <input type="date" name="PVDateofoccurrence" id="PVDateofoccurrence" class="form-control  required" value="<?php echo $rstudy['PVDateofoccurrence'];?>" readonly="readonly">
                        </div>
         
                        
                        
                            <div class="form-group row success">
      
                          <label class="col-sm-4 form-control-label">2.	Description of violation :</label>
                  
                          
                          <textarea name="PVDescriptionofdeviation" id="MyTextBox" cols="" rows="5" class="form-control  required" readonly="readonly"><?php echo $rstudy['PVDescriptionofdeviation'];?></textarea>       
                  <p id="countermm">Characters limit: <span  id="countercol">250 words</span></p>
                          
                          
                        </div>
             
             
             
         
                        <h3>Part A;.</h3>
                          <div class="form-group row success">
                          <label class="col-sm-11 form-control-label">
          <input name="parta[]" type="checkbox" value="Failure  to obtain informed consent i.e., there is no documentation of informed consent,  or informed consent is obtained after initiation of study procedures" <?php if($chop1=='Failure  to obtain informed consent i.e., there is no documentation of informed consent,  or informed consent is obtained after initiation of study procedures' || $chop2=='Failure  to obtain informed consent i.e., there is no documentation of informed consent,  or informed consent is obtained after initiation of study procedures' || $chop3=='Failure  to obtain informed consent i.e., there is no documentation of informed consent,  or informed consent is obtained after initiation of study procedures' || $chop4=='Failure  to obtain informed consent i.e., there is no documentation of informed consent,  or informed consent is obtained after initiation of study procedures' || $chop5=='Failure  to obtain informed consent i.e., there is no documentation of informed consent,  or informed consent is obtained after initiation of study procedures' || $chop6=='Failure  to obtain informed consent i.e., there is no documentation of informed consent,  or informed consent is obtained after initiation of study procedures' || $chop7=='Failure  to obtain informed consent i.e., there is no documentation of informed consent,  or informed consent is obtained after initiation of study procedures' || $chop8=='Failure  to obtain informed consent i.e., there is no documentation of informed consent,  or informed consent is obtained after initiation of study procedures' || $chop9=='Failure  to obtain informed consent i.e., there is no documentation of informed consent,  or informed consent is obtained after initiation of study procedures'){?>checked="checked"<?php }?>> Failure  to obtain informed consent i.e., there is no documentation of informed consent,  or informed consent is obtained after initiation of study procedures <br>
          
          
          
              
<input name="parta[]" type="checkbox" value="Enrollment of a subject who did not meet all inclusion/exclusion criteria" <?php if($chop1=='Enrollment of a subject who did not meet all inclusion/exclusion criteria' || $chop2=='Enrollment of a subject who did not meet all inclusion/exclusion criteria' || $chop3=='Enrollment of a subject who did not meet all inclusion/exclusion criteria' || $chop4=='Enrollment of a subject who did not meet all inclusion/exclusion criteria' || $chop5=='Enrollment of a subject who did not meet all inclusion/exclusion criteria' || $chop6=='Enrollment of a subject who did not meet all inclusion/exclusion criteria' || $chop7=='Enrollment of a subject who did not meet all inclusion/exclusion criteria' || $chop8=='Enrollment of a subject who did not meet all inclusion/exclusion criteria' || $chop9=='Enrollment of a subject who did not meet all inclusion/exclusion criteria'){?>checked="checked"<?php }?>> Enrollment of a subject who did not meet all inclusion/exclusion criteria<br>

<input name="parta[]" type="checkbox" value="Performing study procedure not approved by the IRB/ modifications" <?php if($chop1=='Performing study procedure not approved by the IRB/ modifications' || $chop2=='Performing study procedure not approved by the IRB/ modifications' || $chop3=='Performing study procedure not approved by the IRB/ modifications' || $chop4=='Performing study procedure not approved by the IRB/ modifications' || $chop5=='Performing study procedure not approved by the IRB/ modifications' || $chop6=='Performing study procedure not approved by the IRB/ modifications' || $chop7=='Performing study procedure not approved by the IRB/ modifications' || $chop8=='Performing study procedure not approved by the IRB/ modifications' || $chop9=='Performing study procedure not approved by the IRB/ modifications'){?>checked="checked"<?php }?>> Performing study procedure not approved by the IRB/ modifications<br>

<input name="parta[]" type="checkbox" value="Screening procedure required by protocol not done" <?php if($chop1=='Screening procedure required by protocol not done' || $chop2=='Screening procedure required by protocol not done' || $chop3=='Screening procedure required by protocol not done' || $chop4=='Screening procedure required by protocol not done' || $chop5=='Screening procedure required by protocol not done' || $chop6=='Screening procedure required by protocol not done' || $chop7=='Screening procedure required by protocol not done' || $chop8=='Screening procedure required by protocol not done' || $chop9=='Screening procedure required by protocol not done'){?>checked="checked"<?php }?>> Screening procedure required by protocol not done<br>

<input name="parta[]" type="checkbox" value="Failure to report serious unanticipated problems/adverse events involving risks  to subjects to the IRB" <?php if($chop1=='Failure to report serious unanticipated problems/adverse events involving risks  to subjects to the IRB' || $chop2=='Failure to report serious unanticipated problems/adverse events involving risks  to subjects to the IRB' || $chop3=='Failure to report serious unanticipated problems/adverse events involving risks  to subjects to the IRB' || $chop4=='Failure to report serious unanticipated problems/adverse events involving risks  to subjects to the IRB' || $chop5=='Failure to report serious unanticipated problems/adverse events involving risks  to subjects to the IRB' || $chop6=='Failure to report serious unanticipated problems/adverse events involving risks  to subjects to the IRB' || $chop7=='Failure to report serious unanticipated problems/adverse events involving risks  to subjects to the IRB' || $chop8=='Failure to report serious unanticipated problems/adverse events involving risks  to subjects to the IRB' || $chop9=='Failure to report serious unanticipated problems/adverse events involving risks  to subjects to the IRB'){?>checked="checked"<?php }?>> Failure to report serious unanticipated problems/adverse events involving risks  to subjects to the IRB<strong></strong><br>


<input name="parta[]" type="checkbox" value="Failure to perform a required lab test that may affect  subject safety or data integrity" <?php if($chop1=='Failure to perform a required lab test that may affect  subject safety or data integrity' || $chop2=='Failure to perform a required lab test that may affect  subject safety or data integrity' || $chop3=='Failure to perform a required lab test that may affect  subject safety or data integrity' || $chop4=='Failure to perform a required lab test that may affect  subject safety or data integrity' || $chop5=='Failure to perform a required lab test that may affect  subject safety or data integrity' || $chop6=='Failure to perform a required lab test that may affect  subject safety or data integrity' || $chop7=='Failure to perform a required lab test that may affect  subject safety or data integrity' || $chop8=='Failure to perform a required lab test that may affect  subject safety or data integrity' || $chop9=='Failure to perform a required lab test that may affect  subject safety or data integrity'){?>checked="checked"<?php }?>> Failure to perform a required lab test that may affect  subject safety or data integrity<br>


<input name="parta[]" type="checkbox" value="Drug/study medication dispensing or dosing error"  <?php if($chop1=='Drug/study medication dispensing or dosing error' || $chop2=='Drug/study medication dispensing or dosing error' || $chop3=='Drug/study medication dispensing or dosing error' || $chop4=='Drug/study medication dispensing or dosing error' || $chop5=='Drug/study medication dispensing or dosing error' || $chop6=='Drug/study medication dispensing or dosing error' || $chop7=='Drug/study medication dispensing or dosing error' || $chop8=='Drug/study medication dispensing or dosing error' || $chop9=='Drug/study medication dispensing or dosing error'){?>checked="checked"<?php }?>> Drug/study medication dispensing or dosing error<strong></strong><br>


<input name="parta[]" type="checkbox" value="Study visit conducted outside of required time  frame that, in the opinion of the PI or IRB, may affect subject safety"  <?php if($chop1=='Study visit conducted outside of required time  frame that, in the opinion of the PI or IRB, may affect subject safety' || $chop2=='Study visit conducted outside of required time  frame that, in the opinion of the PI or IRB, may affect subject safety' || $chop3=='Study visit conducted outside of required time  frame that, in the opinion of the PI or IRB, may affect subject safety' || $chop4=='Study visit conducted outside of required time  frame that, in the opinion of the PI or IRB, may affect subject safety' || $chop5=='Study visit conducted outside of required time  frame that, in the opinion of the PI or IRB, may affect subject safety' || $chop6=='Study visit conducted outside of required time  frame that, in the opinion of the PI or IRB, may affect subject safety' || $chop7=='Study visit conducted outside of required time  frame that, in the opinion of the PI or IRB, may affect subject safety' || $chop8=='Study visit conducted outside of required time  frame that, in the opinion of the PI or IRB, may affect subject safety' || $chop9=='Study visit conducted outside of required time  frame that, in the opinion of the PI or IRB, may affect subject safety'){?>checked="checked"<?php }?>> Study visit conducted outside of required time  frame that, in the opinion of the PI or IRB, may affect subject safety<br>


<input name="parta[]" type="checkbox" value="Failure to follow safety monitoring plan" <?php if($chop1=='Failure to follow safety monitoring plan' || $chop2=='Failure to follow safety monitoring plan' || $chop3=='Failure to follow safety monitoring plan' || $chop4=='Failure to follow safety monitoring plan' || $chop5=='Failure to follow safety monitoring plan' || $chop6=='Failure to follow safety monitoring plan' || $chop7=='Failure to follow safety monitoring plan' || $chop8=='Failure to follow safety monitoring plan' || $chop9=='Failure to follow safety monitoring plan'){?>checked="checked"<?php }?>> Failure to follow safety monitoring plan<br>


<input name="parta[]" type="checkbox" value="Other" onChange="getDeviationOther(this.value)" <?php if($chop1=='Other' || $chop2=='Other' || $chop3=='Other' || $chop4=='Other' || $chop5=='Other' || $chop6=='Other' || $chop7=='Other' || $chop8=='Other' || $chop9=='Other'){?>checked="checked"<?php }?>/> Others </label>            
 
 
 <div id="DeviationOtherdiv"><?php if($rstudy['partaOther']){?><textarea name="partaOther" id="partaOther" cols="" rows="5" class="form-control  required" readonly="readonly"><?php echo $rstudy['partaOther'];?></textarea><?php }?></div>
 
 
              
                        </div>
              
                        
                        
                 <h3>Part B:</h3>
                          <div class="form-group row success">
                          <label class="col-sm-6 form-control-label"></label>
<label class="col-sm-11 form-control-label"><input name="partb[]" type="checkbox" value="Implementation of unapproved  recruitment procedures"  <?php if($chei1=='Implementation of unapproved  recruitment procedures' || $chei2=='Implementation of unapproved  recruitment procedures' || $chei3=='Implementation of unapproved  recruitment procedures' || $chei4=='Implementation of unapproved  recruitment procedures' || $chei5=='Implementation of unapproved  recruitment procedures' || $chei6=='Implementation of unapproved  recruitment procedures' || $chei7=='Implementation of unapproved  recruitment procedures' || $chei8=='Implementation of unapproved  recruitment procedures'){?>checked="checked"<?php }?>> Implementation of unapproved  recruitment procedures</label>


<label class="col-sm-11 form-control-label"><input name="partb[]" type="checkbox" value="Missing original signed and dated consent form (only a photocopy available)" <?php if($chei1=='Missing original signed and dated consent form (only a photocopy available)' || $chei2=='Missing original signed and dated consent form (only a photocopy available)' || $chei3=='Missing original signed and dated consent form (only a photocopy available)' || $chei4=='Missing original signed and dated consent form (only a photocopy available)' || $chei5=='Missing original signed and dated consent form (only a photocopy available)' || $chei6=='Missing original signed and dated consent form (only a photocopy available)' || $chei7=='Missing original signed and dated consent form (only a photocopy available)' || $chei8=='Missing original signed and dated consent form (only a photocopy available)'){?>checked="checked"<?php }?>> Missing original signed and dated consent form (only a photocopy available)</label>


<label class="col-sm-11 form-control-label"><input name="partb[]" type="checkbox" value="Missing pages of executed consent form" <?php if($chei1=='Missing pages of executed consent form' || $chei2=='Missing pages of executed consent form' || $chei3=='Missing pages of executed consent form' || $chei4=='Missing pages of executed consent form' || $chei5=='Missing pages of executed consent form' || $chei6=='Missing pages of executed consent form' || $chei7=='Missing pages of executed consent form' || $chei8=='Missing pages of executed consent form'){?>checked="checked"<?php }?>> Missing pages of executed consent form</label>

  
<label class="col-sm-11 form-control-label" style="padding-left:50px;">(Inappropriate documentation of informed consent, including: Missing subject signature, Missing investigator signature, Copy not given to the person signing the form, Someone other than the subject dated the consent form, Individual obtaining informed consent not listed on IRB approved study personnel  list)</label>


<label class="col-sm-11 form-control-label"><input name="partb[]" type="checkbox" value="Use of invalid consent form, i.e., consent form without IRB approval stamp or  outdated/expired consent form" <?php if($chei1=='Use of invalid consent form, i.e., consent form without IRB approval stamp or  outdated/expired consent form' || $chei2=='Use of invalid consent form, i.e., consent form without IRB approval stamp or  outdated/expired consent form' || $chei3=='Use of invalid consent form, i.e., consent form without IRB approval stamp or  outdated/expired consent form' || $chei4=='Use of invalid consent form, i.e., consent form without IRB approval stamp or  outdated/expired consent form' || $chei5=='Use of invalid consent form, i.e., consent form without IRB approval stamp or  outdated/expired consent form' || $chei6=='Use of invalid consent form, i.e., consent form without IRB approval stamp or  outdated/expired consent form' || $chei7=='Use of invalid consent form, i.e., consent form without IRB approval stamp or  outdated/expired consent form' || $chei8=='Use of invalid consent form, i.e., consent form without IRB approval stamp or  outdated/expired consent form'){?>checked="checked"<?php }?>> Use of invalid consent form, i.e., consent form without IRB approval stamp or  outdated/expired consent form</label>


<label class="col-sm-11 form-control-label"><input name="partb[]" type="checkbox" value="Failure to follow the approved study procedure that, in the opinion of the PI,  does not affect subject safety or data integrity;" <?php if($chei1=='Failure to follow the approved study procedure that, in the opinion of the PI,  does not affect subject safety or data integrity;' || $chei2=='Failure to follow the approved study procedure that, in the opinion of the PI,  does not affect subject safety or data integrity;' || $chei3=='Failure to follow the approved study procedure that, in the opinion of the PI,  does not affect subject safety or data integrity;' || $chei4=='Failure to follow the approved study procedure that, in the opinion of the PI,  does not affect subject safety or data integrity;' || $chei5=='Failure to follow the approved study procedure that, in the opinion of the PI,  does not affect subject safety or data integrity;' || $chei6=='Failure to follow the approved study procedure that, in the opinion of the PI,  does not affect subject safety or data integrity;' || $chei7=='Failure to follow the approved study procedure that, in the opinion of the PI,  does not affect subject safety or data integrity;' || $chei8=='Failure to follow the approved study procedure that, in the opinion of the PI,  does not affect subject safety or data integrity;'){?>checked="checked"<?php }?>> Failure to follow the approved study procedure that, in the opinion of the PI,  does not affect subject safety or data integrity;</label>
  

<label class="col-sm-11 form-control-label" style="padding-left:50px;">(Study procedure conducted out of sequence, Omitting an approved portion of the protocol, Failure to perform a required lab test, Missing lab results, Enrollment of ineligible subject (e.g., subject's age was 6 months above age  limit), Study visit conducted outside of required timeframe) </label>

 
<label class="col-sm-11 form-control-label"><input name="partb[]" type="checkbox" value="Over-enrollment" <?php if($chei1=='Over-enrollment' || $chei2=='Over-enrollment' || $chei3=='Over-enrollment' || $chei4=='Over-enrollment' || $chei5=='Over-enrollment' || $chei6=='Over-enrollment' || $chei7=='Over-enrollment' || $chei8=='Over-enrollment'){?>checked="checked"<?php }?>> Over-enrollment</label>


<label class="col-sm-11 form-control-label"><input name="partb[]" type="checkbox" value="Enrollment of subjects after IRB-approval of study expired or lapsed;"<?php if($chei1=='Enrollment of subjects after IRB-approval of study expired or lapsed;' || $chei2=='Enrollment of subjects after IRB-approval of study expired or lapsed;' || $chei3=='Enrollment of subjects after IRB-approval of study expired or lapsed;' || $chei4=='Enrollment of subjects after IRB-approval of study expired or lapsed;' || $chei5=='Enrollment of subjects after IRB-approval of study expired or lapsed;' || $chei6=='Enrollment of subjects after IRB-approval of study expired or lapsed;' || $chei7=='Enrollment of subjects after IRB-approval of study expired or lapsed;' || $chei8=='Enrollment of subjects after IRB-approval of study expired or lapsed;'){?>checked="checked"<?php }?>> Enrollment of subjects after IRB-approval of study expired or lapsed;</label>


<label class="col-sm-11 form-control-label"><input name="partb[]" type="checkbox" value="Failure to submit continuing  review application to the IRB before study expiration" <?php if($chei1=='Failure to submit continuing  review application to the IRB before study expiration' || $chei2=='Failure to submit continuing  review application to the IRB before study expiration' || $chei3=='Failure to submit continuing  review application to the IRB before study expiration' || $chei4=='Failure to submit continuing  review application to the IRB before study expiration' || $chei5=='Failure to submit continuing  review application to the IRB before study expiration' || $chei6=='Failure to submit continuing  review application to the IRB before study expiration' || $chei7=='Failure to submit continuing  review application to the IRB before study expiration' || $chei8=='Failure to submit continuing  review application to the IRB before study expiration'){?>checked="checked"<?php }?>> Failure to submit continuing  review application to the IRB before study expiration</label>
              
                        </div>       
                        
  
                        
<div class="form-group row success">
<label class="col-sm-4 form-control-label">3. Root cause of violation </label>

  <textarea name="Rootcauseofviolation_b" id="MyTextBox7" cols="" rows="5" class="form-control  required" readonly="readonly"><?php echo $rstudy['Rootcauseofviolation_b'];?></textarea>       
                  <p id="countermm">Characters limit: <span  id="countercol">250 words</span></p>


</div>


                        
<div class="form-group row success">
<label class="col-sm-4 form-control-label">4. Corrective action  </label>
<textarea name="Correctiveaction_b" id="MyTextBox7" cols="" rows="5" class="form-control  required" readonly="readonly"><?php echo $rstudy['Correctiveaction_b'];?></textarea>       
                  <p id="countermm">Characters limit: <span  id="countercol">250 words</span></p>



</div>


                        
<div class="form-group row success">
<label class="col-sm-4 form-control-label">5. Measures to mitigate violation  </label>

  <?php
$qRPersoneld2="select * from ".$prefix."saes_measures_mitigate_dev_b  where owner_id='$sessionasrmApplctID' and renewal_id='$id'";
$RPersoneld2=$mysqli->query($qRPersoneld2);
?>             
                                     
                  
                  <table width="100%" border="0" id="POITable2" class="success">
        <tr>
            <th width="3%" style=" display:none;">&nbsp;</th>
            <th width="74%"><strong>Measures (one per row)<span class="error3">*</span></strong></th>

        </tr>

        </table>



<?php

while ($rowRows2 = $RPersoneld2->fetch_array())
{ ///Display data for education history
	?>  <label class="form-control-label">
<?php echo $rowRows2['Measurestomitigatedeviation'];?> </label><br />
<?php
}

?> 
</div>


  </div><!--Panel B Ends-->
  
 
<?php if($category=='DeviationsPayment' and $id){?>  <!--Panel Payment Begins-->  
<button class="accordion">Payment</button>
  <div class="panel"> 
  
  
<form action="" method="post" name="regForm" id="regForm" enctype="multipart/form-data">


<?php
$sqlgg = "select * FROM ".$prefix."deviations where owner_id='$owner_id' and deviationID='$id' order by deviationID desc limit 0,1";//and conceptm_status='new' 
$resultgg = $mysqli->query($sqlgg);
$rInvestigatorgg=$resultgg->fetch_array();?>
<div class="form-group row">
<select name="paymentStatus" id="paymentStatus" class="form-control required"  onChange="getPayConfirm(this.value)">
<option value="" <?php if($rInvestigatorgg['paymentProof']==''){?>selected="selected"<?php }?>>Please Select</option>

<option value="Not Paid" <?php if($rInvestigatorgg['paymentProof']=='Not Paid'){?>selected="selected"<?php }?>>Not Paid</option>
<option value="Review Pending Payment" <?php if($rInvestigatorgg['paymentProof']=='Review Pending Payment'){?>selected="selected"<?php }?>>Review Pending Payment</option>
<option value="Payment Waiver" <?php if($rInvestigatorgg['paymentProof']=='Payment Waiver'){?>selected="selected"<?php }?>>Payment Waiver</option>
<option value="Paid" <?php if($rInvestigatorgg['paymentProof']=='Paid'){?>selected="selected"<?php }?>>Paid</option>
</select>
</div>


<div class="form-group row">
                          <div class="col-sm-4 offset-sm-3">
                    <input name="doSendConfirmPayemnt" type="submit"  class="btn btn-primary" value="Save"/>

                          </div>
                        </div>
         </form>

  </div>
  <!--Panel Payment Ends--> 
   <?php }?> 
  
  

    
   <?php
   ///////////////////Assign Reviewers
$sqlgg = "select * FROM ".$prefix."initial_committee_screening where owner_id='$owner_id' and protocol_id='$protocol_idwe' and screeningFor='Deviations'";//and conceptm_status='new' 
$resultgg = $mysqli->query($sqlgg);
$rInvestigatorgg=$resultgg->fetch_array();

if($category=='AssignReviewersDel' and $id and $_GET['sid']){
    $sid=$_GET['sid'];
	$sqlA2Protocol2="delete from ".$prefix."submission_review_sr where protocol_id='$protocol_idwe' and id='$sid'";
	$mysqli->query($sqlA2Protocol2);
	$message='<p class="error2">Reviewer has been removed.</p>';
	}

?>

<?php if($rstudym['assignedto']!='Assigned' and $category=='AddDevisionReviewers' and $id){?>
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
$sqlProtocols="SELECT * FROM ".$prefix."submission_review_sr  where protocol_id='$protocol_idwe' and recstatus='new' and reviewFor='Deviations'";
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
    
    <input name="public_title" type="text" value="<?php echo $public_title;?>" />
    </td>
    
    
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
  <label class="col-sm-3 form-control-label">Meeting Subject: <span class="error">*</span></label>
  <div class="col-sm-8">

  <select name="Meetingsubject" id="Meetingsubject" class="form-control  required" required>
  <option value="">Please Select</option>
<?php
$sqlMeeting="SELECT * FROM ".$prefix."meeting  where recAffiliated_id='$recAffiliated_id' and date>='$today' and protocol_id='$protocol_idwe' and meetingFor='Deviations'";
$QueryMeeting=$mysqli->query($sqlMeeting);
while($sqMeeting = $QueryMeeting->fetch_array()){?>
<option value="<?php echo $sqMeeting['subject'];?>"><?php echo $sqMeeting['subject'];?></option>
<?php }?>
</select>

</div>
</div> 

       <div class="form-group row">
   <div class="col-sm-8 offset-sm-3sss">
   <?php
$sqlMeeting2="SELECT * FROM ".$prefix."meeting  where recAffiliated_id='$recAffiliated_id' and date>='$today' and protocol_id='$protocol_idwe' and meetingFor='Deviations'";
$QueryMeeting2=$mysqli->query($sqlMeeting2);
$protocolMeeting2 = $QueryMeeting2->num_rows;
if(!$protocolMeeting2){echo "<span  style='color:#F00;'>Please Add meeting, Protocol will not be assigned without creating a meeting</span>";}
if($protocolMeeting2){
?>
<input name="doAssignReviewes" type="submit"  class="btn btn-primary" value="Save Details"/>
<?php }?>
                          </div>
                        </div>
                                          
     </form>                   
    </div>
    </div>
    </div><!--End-->
    
    
   <!--Approve Renewal1110--> 
<?php 
$sqlSMeeting = "select * from ".$prefix."meeting where protocol_id='$protocol_idwe' and meetingFor='Deviations' order by id desc";
$resultSMeeting = $mysqli->query($sqlSMeeting);
$sqUserMeeting = $resultSMeeting->fetch_array();

if($rstudym['status']!='Approved' and $category=='ConfirmDeviationsFinal'){?>    
   <?php
$sqlgg2 = "select * FROM ".$prefix."initial_committee_screening where owner_id='$owner_id' and protocol_id='$protocol_idwe'  and reviewer_id='$asrmApplctID'  and screeningFor='Deviations' order by id desc";//and conceptm_status='new' 
$resultgg2 = $mysqli->query($sqlgg2);
$rInvestigatorgg2=$resultgg2->fetch_array();?>
 <form action="" method="post" name="regForm" id="regForm" enctype="multipart/form-data">
<h4>Collective Decisions (Comments will be shared with PI):</h4>
<div class="form-group row">
<label class="col-sm-6 form-control-label">Comments from the Committee Review Meeting (About this protocol):</label>
<textarea name="screening" id="screening" cols="" rows="5" class="form-control  required"><?php echo $rInvestigatorgg2['screening'];?></textarea>

<input name="asrmApplctID_user" type="hidden" value="<?php echo $owner_id;?>"/>
<input name="protocol_idmm" type="hidden" value="<?php echo $protocol_idwe;?>"/>
<input name="submission_idm" type="hidden" value="<?php echo $id;?>"/>
<input name="public_title" type="hidden" value="<?php echo $public_title;?>"/>
<input name="studyRefNo" type="hidden" value="<?php echo $rprotocalSub2Sel['code'];?>"/>
<input name="reviewer_id" type="hidden" value="<?php echo $_SESSION['asrmApplctID'];?>"/>
<input name="recAffiliated_id" type="hidden" value="<?php echo $recAffiliated_id;?>"/>
<input name="listchanges" type="hidden" value="<?php echo $rstudym['listchanges'];?>"/>

<input name="TrachedChangesLanguage" type="hidden" value="<?php echo $rstudym['TrachedChangesLanguage'];?>"/>
<input name="TrachedChangesVersion" type="hidden" value="<?php echo $rstudym['TrachedChangesVersion'];?>"/>
<input name="TrachedChangesDate" type="hidden" value="<?php echo $rstudym['TrachedChangesDate'];?>"/>
<input name="CleanCopyLanguage" type="hidden" value="<?php echo $rstudym['CleanCopyLanguage'];?>"/>
<input name="CleanCopyVersion" type="hidden" value="<?php echo $rstudym['CleanCopyVersion'];?>"/>
<input name="CleanCopyDate" type="hidden" value="<?php echo $rstudym['CleanCopyDate'];?>"/>
<input name="CoverLetterLanguage" type="hidden" value="<?php echo $rstudym['CoverLetterLanguage'];?>"/>
<input name="CoverLetterVersion" type="hidden" value="<?php echo $rstudym['CoverLetterVersion'];?>"/>
<input name="CoverLetterDate" type="hidden" value="<?php echo $rstudym['CoverLetterDate'];?>"/>


</div>
<div class="line"></div>


<div class="form-group row">
<label class="col-sm-4 form-control-label">Choose Action:</label>
<select name="recruitment_status" id="recruitment_status" class="form-control  required">
<option value="">---------Select-------</option>
<?php
$sqlClinicalcv = "select * FROM ".$prefix."decision_status order by name desc";//and conceptm_status='new' 
$resultClinicalcv = $mysqli->query($sqlClinicalcv);
while($rClinicalcv=$resultClinicalcv->fetch_array()){
?>
<option value="<?php echo $rClinicalcv['name'];?>" <?php if($rprotocalSub2Sel['monitoring_action_id']==$rClinicalcv['id']){?>selected="selected"<?php }?>><?php echo $rClinicalcv['name'];?></option>
<?php }?>
</select>
</div>


<div class="form-group row">
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