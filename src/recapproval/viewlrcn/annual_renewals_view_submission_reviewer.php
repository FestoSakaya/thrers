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
$ammendType=$rstudym['ammendType'];

$sqlprotocalSubSel="SELECT * FROM ".$prefix."submission where id='$protocol_idwe'";
$QprotocalSub2Sel = $mysqli->query($sqlprotocalSubSel);
$rprotocalSub2Sel = $QprotocalSub2Sel->fetch_array();
$reviewer_id=$_SESSION['asrmApplctID'];

////Screening ID
$sqlproSubmission="SELECT * FROM ".$prefix."submission_review_sr where reviewer_id='$reviewer_id' and protocol_id='$protocol_idwe' and reviewFor='AnnualRenewal' and reviewStatus='Pending' order by id desc";
$QprotocalSubmission = $mysqli->query($sqlproSubmission);
$rprotocalSubmission = $QprotocalSubmission->fetch_array();
$rprotocalSubmission['id'];

$public_title=$rprotocalSub2Sel['public_title'];

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
	$subject=$mysqli->real_escape_string($_POST['Meetingsubject']);
	$reviewtype=$mysqli->real_escape_string($_POST['reviewtype']);
	$cfnreviewer=$mysqli->real_escape_string($_POST['cfnreviewer']);

$queryConceptLogs="select * from ".$prefix."submission_review_sr where protocol_id='$protocol_idmm' and reviewer_id='$cfnreviewer'  and reviewStatus='Pending'  and reviewFor='AnnualRenewal' order by id desc";
$rsConceptLogs=$mysqli->query($queryConceptLogs);
$rTotalConceptLogs=$rsConceptLogs->num_rows;



if($subject and !$rTotalConceptLogs){
$sqlA2rr="insert into ".$prefix."submission_review_sr (`asrmApplctID`,`protocol_id`,`owner_id`,`reviewer_id`,`reviewDate`,`recstatus`,`protocolStage`,`reviewtype`,`subject`,`recAffiliated_c`,`reviewFor`,`conflictofInterest`) 

values('$cfnreviewer','$protocol_idmm','$asrmApplctID_user','$cfnreviewer',now(),'new','stage1','$reviewtype','$subject','$recAffiliated_c','AnnualRenewal','none')";
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

$update="update ".$prefix."renewals set status='Scheduled for Review',assignedto='Assigned' where id='$id'";
$mysqli->query($update);
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
$mail->addCc('mutumba.beth@yahoo.com',$recOriginalName);//
$mail->addBcc('uncstuncstapps@gmail.com',$recOriginalName);//

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

//////////////////////////Make Final Decision


if($_POST['doSendToEthical']=='Save'){
	
	
	$asrmApplctID_user=$mysqli->real_escape_string($_POST['asrmApplctID_user']);
	$protocol_idmm=$mysqli->real_escape_string($_POST['protocol_idmm']);
	$screening_id=$mysqli->real_escape_string($_POST['screening_id']);
	$draftopinion2=$mysqli->real_escape_string($_POST['recruitment_status']);
	$screening=$mysqli->real_escape_string($_POST['screening']);
	$reviewerID=$mysqli->real_escape_string($_POST['reviewer_id']);
	$ammendmnet_id=$mysqli->real_escape_string($_POST['ammendmnet_id']);
	$renewal_id=$mysqli->real_escape_string($_POST['renewal_id']);
	$ammendType=$mysqli->real_escape_string($_POST['ammendType']);
	
$sqlInvestigators="SELECT * FROM ".$prefix."initial_committee_screening where `owner_id`='$asrmApplctID_user' and screening='$screening' and renewal_id='$renewal_id' and reviewer_id='$reviewerID' and  screeningFor='AnnualRenewal' order by id desc";
	$QueryInvestigators = $mysqli->query($sqlInvestigators);
	$totalInvestigators = $QueryInvestigators->num_rows;
	
		if(!$totalInvestigators){
 $sqlA2="insert into ".$prefix."initial_committee_screening (`owner_id`,`protocol_id`,`created`,`updated`,`screening`,`draftopinion`,`recAffiliated_id`,`reviewer_id`,`screeningFor`,`completionStatus`,`ammendType`,`renewal_id`) 

values('$asrmApplctID_user','$protocol_idmm',now(),now(),'$screening','$draftopinion2','$recAffiliated_id','$reviewerID','AnnualRenewal','Completed','$ammendType','$renewal_id')";
$mysqli->query($sqlA2);
		}
	
$update="update ".$prefix."submission_review_sr set recstatus='$draftopinion2',reviewStatus='Completed' where renewal_id='$renewal_id' and reviewer_id='$reviewerID' and reviewFor='AnnualRenewal'";
$mysqli->query($update);


	
		echo '<img src="images/loading_wait.gif">';
echo '<div class="spacer"></div>';
echo '<meta http-equiv="refresh" content="2; url='.$base_url.'/main.php?option=ReviewerAnnualRenualMa" />';
		
}
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
$sql = "select *,DATE_FORMAT(`attachment_date`,'%d/%m/%Y') AS attachment_date FROM ".$prefix."renewals_attachments where  renewal_id='$id' order by id desc LIMIT 0,200";//and conceptm_status='new' 
$result = $mysqli->query($sql);
while($rInvestigator=$result->fetch_array()){
	
$submittedBy=$rInvestigator['user_id'];
//user
$sqlUserup = "select * FROM ".$prefix."user where asrmApplctID='$submittedBy'";//and conceptm_status='new' 
$resultUser = $mysqli->query($sqlUserup);
$rUsers=$resultUser->fetch_array();
	?>
                          <tr>
                            <td><a href="./files/uploads/<?php echo $rInvestigator['attachment_file'];?>" target="_blank">View File</a></td>
                            <td><?php echo $rInvestigator['filename'];?></td>
                         
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
                            <td><a href="./files/uploads/<?php echo $rInvestigatorPrevious['filename'];?>" target="_blank">View File</a></td>
                            <td><?php if($rInvestigatorPrevious['othername']){echo $rInvestigatorPrevious['othername'];}else{echo $rfile['name'];}?></td>
                         
                            <td><?php echo $rInvestigatorPrevious['created'];?></td>
<td></td>
                          </tr>
   <?php }///////////end function ?> 
                   
                        </tbody>
                      </table>
  
  </div>
  </div>
  
  <?php if($category=='ConfirmRenewalPayment' and $session_privillage=='recadmin' || $session_privillage=='rechairperson' || $session_privillage=='revicechairperson' || $session_privillage=='recitadmin'){?>
  <button class="accordion">Payment</button>
  <div class="panel">
  <?php echo $message;?>
  <?php
$sqlgg = "select * FROM ".$prefix."renewals where id='$id'";//and conceptm_status='new' 
$resultgg = $mysqli->query($sqlgg);
$rInvestigatorgg=$resultgg->fetch_array();?>
<?php if($rInvestigatorgg['paymentStatus']=='' || $rInvestigatorgg['paymentStatus']=='Not Paid'){?>
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
   <?php }//end Payment Section?> 
 </div>   
  
  <?php }///ConfirmRenewalPayment?>
  
  
  
    
<?php if($category=='AssignRenewalReviewers' and $session_privillage=='recadmin' || $session_privillage=='rechairperson' || $session_privillage=='revicechairperson'){?>    
 <button class="accordion">Assign Reviewers</button>
  <div class="panelss">   
   <?php
   ///////////////////Assign Reviewers
$sqlgg = "select * FROM ".$prefix."initial_committee_screening where owner_id='$owner_id' and protocol_id='$protocol_idwe' and screeningFor='AnnualRenewal'";//and conceptm_status='new' 
$resultgg = $mysqli->query($sqlgg);
$rInvestigatorgg=$resultgg->fetch_array();

if($category=='AssignRenewalReviewersDel' and $id and $_GET['sid']){
    $sid=$_GET['sid'];
	$sqlA2Protocol2="delete from ".$prefix."submission_review_sr where  id='$sid'";
	$mysqli->query($sqlA2Protocol2);
	$message='<p class="error2">Reviewer has been removed.</p>';
	}

?>

<?php 
if($rstudym['assignedto']!='Assigned' and $rstudym['paymentStatus']=='Paid' || $rstudym['paymentStatus']=='Review Pending Payment'|| $rstudym['paymentStatus']=='Payment Waiver'){?>
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
$sqlProtocols="SELECT * FROM ".$prefix."submission_review_sr  where protocol_id='$protocol_idwe' and recstatus='new'";
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
    <td width="48%" align="left" class="defmf2"><a href="main.php?option=AssignRenewalReviewersDel&id=<?php echo $id;?>&sid=<?php echo $sqProtocols['id'];?>" style="color:#F00; font-weight:bold;" onclick="return confirm('Are you sure you want to delete this item?');">Delete</a></td>
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
$sqlMeeting="SELECT * FROM ".$prefix."meeting  where recAffiliated_id='$recAffiliated_id' and date>='$today' and protocol_id='$protocol_idwe' and meetingFor='AnnualRenewal'";
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
$sqlMeeting2="SELECT * FROM ".$prefix."meeting  where recAffiliated_id='$recAffiliated_id' and date>='$today' and protocol_id='$protocol_idwe' and meetingFor='AnnualRenewal'";
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
    
    </div><!--End reviewrrs-->
    <?php }//end Reviewers?>
   
   
<?php
$sqlgg = "select * FROM ".$prefix."initial_committee_screening where owner_id='$owner_id' and protocol_id='$protocol_idwe' and reviewer_id='$asrmApplctID' and completionStatus='Pending' and screeningFor='AnnualRenewal' order by id desc";//and conceptm_status='new' 
$resultgg = $mysqli->query($sqlgg);
$rInvestigatorgg=$resultgg->fetch_array();


?>
 <form action="" method="post" name="regForm" id="regForm" enctype="multipart/form-data">
<h4>Reviewer Comments:</h4>
<div class="form-group row">

<textarea name="screening" id="screening" cols="" rows="5" class="form-control  required"><?php echo $rInvestigatorgg['screening'];?></textarea>
<input name="asrmApplctID_user" type="hidden" value="<?php echo $owner_id;?>"/>
<input name="protocol_idmm" type="hidden" value="<?php echo $protocol_idwe;?>"/>
<input name="recAffiliated_id" type="hidden" value="<?php echo $recAffiliated_id;?>"/>
<input name="screening_id" type="hidden" value="<?php echo $rprotocalSubmission['id'];?>"/>
<input name="reviewer_id" type="hidden" value="<?php echo $_SESSION['asrmApplctID'];?>"/>
<input name="renewal_id" type="hidden" value="<?php echo $rstudym['id'];?>"/>
<input name="ammendType" type="hidden" value="<?php echo $ammendType;?>"/>
</div>
<div class="line"></div>


<div class="form-group row">
<label class="col-sm-4 form-control-label"><strong>Recommendation:</strong></label>
<select name="recruitment_status" id="recruitment_status" class="form-control  required">
<option value="">---------Select-------</option>
<?php
$sqlClinicalcv = "select * FROM ".$prefix."decision_status where actionfor='reviewers' order by name desc";//and conceptm_status='new' 
$resultClinicalcv = $mysqli->query($sqlClinicalcv);
while($rClinicalcv=$resultClinicalcv->fetch_array()){
?>
<option value="<?php echo $rClinicalcv['name'];?>" <?php if($rprotocalSub2Sel['monitoring_action_id']==$rClinicalcv['draftopinion']){?>selected="selected"<?php }?>><?php echo $rClinicalcv['name'];?></option>
<?php }?>
</select>



</div>

<div class="form-group row">
                          <div class="col-sm-4 offset-sm-3">
                    <input name="doSendToEthical" type="submit"  class="btn btn-primary" value="Save"/>

                          </div>
                        </div>
         </form>
         
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