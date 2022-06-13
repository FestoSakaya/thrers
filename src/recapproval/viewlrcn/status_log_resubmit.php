<?php 

$sqlstudyFinal="SELECT * FROM ".$prefix."submission where `owner_id`='$asrmApplctID' and protocol_id='$id' order by id desc limit 0,1";
$QuerystudyFinal = $mysqli->query($sqlstudyFinal);
$totalstudyFinal = $QuerystudyFinal->num_rows;
$rstudyFinaSub = $QuerystudyFinal->fetch_array();
$paymentProof=$rstudyFinaSub['paymentProof'];
$steps=$rstudyFinaSub['steps'];
//Protocol Must
$sqlEw = "select * FROM ".$prefix."submission_upload where user_id='$asrmApplctID' and submission_id='$id' and upload_type_id='1' order by id desc";//and conceptm_status='new' 
$resultWe = $mysqli->query($sqlEw);
$totalUseSubmissionUpload = $resultWe->num_rows;

//Consent Form Must
$sqlEwdd = "select * FROM ".$prefix."submission_upload where user_id='$asrmApplctID' and submission_id='$id' and upload_type_id='3' order by id desc";
$resultWedd = $mysqli->query($sqlEwdd);
$totalUseSubmissionUploadCon = $resultWedd->num_rows;


$qRPersoneld2="select * from ".$prefix."employment_details  where rstug_user_id='$asrmApplctID'";
$RPersoneld2=$mysqli->query($qRPersoneld2);
$totalRPersoneld2 = $RPersoneld2->num_rows;

$qRPersoneld="select * from ".$prefix."education_history  where rstug_user_id='$asrmApplctID'";
$RPersoneld=$mysqli->query($qRPersoneld);
$totalRPersoneld = $RPersoneld->num_rows;

$sqlstudyTask="SELECT * FROM ".$prefix."submission_task where `owner_id`='$asrmApplctID' and submission_id='$id' order by id desc limit 0,1";
$QueryRTsusk = $mysqli->query($sqlstudyTask);
$totalstudyTask = $QueryRTsusk->num_rows;

$sql = "select * FROM ".$prefix."research_project_expenditure_local where rstug_user_id='$asrmApplctID' and rstug_rsch_project_id='$id' order by rstug_expenditure_id desc LIMIT 0,1";//and conceptm_status='new' 
$resultBudget = $mysqli->query($sql);
$totalstudyBudget = $resultBudget->num_rows;


$sqlInvestigators="SELECT * FROM ".$prefix."submission_clinical_trial where `owner_id`='$asrmApplctID' and submission_id='$id' order by id desc";
	$QueryInvestigators = $mysqli->query($sqlInvestigators);
	$totalInvestigators = $QueryInvestigators->num_rows;
	
	$sqlITeam="SELECT * FROM ".$prefix."team where `owner_id`='$asrmApplctID' and protocol_id='$id' order by id desc limit 0,1";
	$QueryTeam = $mysqli->query($sqlITeam);
	$totalTeam = $QueryTeam->num_rows;
	
	$sqlIInstitution="SELECT * FROM ".$prefix."collaborating_institutions where `owner_id`='$asrmApplctID' and protocol_id='$id' order by id desc limit 0,1";
	$QueryInstitution = $mysqli->query($sqlIInstitution);
	$totalInstitution = $QueryInstitution->num_rows;
	if($totalInstitution>=1){$totalInstitutionR=1;}//No clinical Trial
//submission_stages
$sqlStageCompleted="SELECT * FROM ".$prefix."submission_stages where `owner_id`='$asrmApplctID' and protocol_id='$id' and status='new' order by id desc limit 0,1";
$QueryStgCompleted = $mysqli->query($sqlStageCompleted);
$totalStgCompleted = $QueryStgCompleted->num_rows;
$rsSubStagesComppleted = $QueryStgCompleted->fetch_array();	 

if($rstudyFinaSub['is_clinical_trial']==1){$clinialTR=$rsSubStagesComppleted['registry'];}//Yes Clinical Trial
if($rstudyFinaSub['is_clinical_trial']==0){$clinialTR=1;}//No clinical Trial

$totalPoints=($rsSubStagesComppleted['protocol_information']+$rsSubStagesComppleted['protocol_team']+$rsSubStagesComppleted['protocol_details']+$rsSubStagesComppleted['study_description']+$rsSubStagesComppleted['RecruitmentCountries']+$rsSubStagesComppleted['budget']+$rsSubStagesComppleted['study_work_plan']+$rsSubStagesComppleted['bibliography']+$rsSubStagesComppleted['filem']+$rsSubStagesComppleted['payments']+$clinialTR+$rsSubStagesComppleted['study_population']);//

/*echo "protocol_information:".$rsSubStagesComppleted['protocol_information'].'<br>';
echo "protocol_team:".$rsSubStagesComppleted['protocol_team'].'<br>';
echo "protocol_details:".$rsSubStagesComppleted['protocol_details'].'<br>';
echo "study_description:".$rsSubStagesComppleted['study_description'].'<br>';
echo "RecruitmentCountries:".$rsSubStagesComppleted['RecruitmentCountries'].'<br>';
echo "budget:".$rsSubStagesComppleted['budget'].'<br>';
echo "study_work_plan:".$rsSubStagesComppleted['study_work_plan'].'<br>';
echo "bibliography:".$rsSubStagesComppleted['bibliography'].'<br>';
echo "filem:".$rsSubStagesComppleted['filem'].'<br>';
echo "payments:".$rsSubStagesComppleted['payments'].'<br>';
echo "clinialTR:".$clinialTR.'<br>';
echo "study_population:".$rsSubStagesComppleted['study_population'].'<br>';*/

if(!$totalStgCompleted){$stepsDone=0;}

if($totalPoints=='1'){$stepsDone='20';}
if($totalPoints=='2'){$stepsDone=30;}
if($totalPoints=='3'){$stepsDone=35;}
if($totalPoints=='4'){$stepsDone=40;}
if($totalPoints=='5'){$stepsDone=50;}
if($totalPoints=='6'){$stepsDone=60;}
if($totalPoints=='7'){$stepsDone=70;}
if($totalPoints=='8'){$stepsDone=75;}
if($totalPoints=='9'){$stepsDone=80;} 
if($totalPoints=='10'){$stepsDone=85;}
if($totalPoints=='11'){$stepsDone=100;}
if($totalPoints=='12'){$stepsDone=100;}
if($totalPoints=='13'){$stepsDone=100;}

?>
<div class="progress">


  <div class="progress-bar progress-bar-striped active" role="progressbar"
  aria-valuenow="<?php echo $stepsDone;?>" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $stepsDone;?>%">
    <?php echo $stepsDone;?>%
  </div>
</div>
<?php 
 if($rstudyFinaSub['status']=='Pending Final Submission' and ($totalPoints=='13' || $totalPoints=='12' || $totalPoints=='11') and $totalUseSubmissionUpload){?>
<!--<input name="doFinalSubmission" type="submit"  class="btn-secondary" value="Make Final Submission" style="float:right; margin-top:5px; "  onClick="window.location.href='./main.php?option=FinalSubmissionddd'" />-->
<a href="./main.php?option=FinalSubmission&id=<?php echo $id;?>"  style="float:right; margin-top:5px; color:#ffffff; text-decoration:none; " class="btn-secondary" onclick="return confirm('Are you sure you want to Submit? Check to make sure all comments raised in Completeness Check are submitted. You will not be able to Edit this Protocol if you click OK. Click CANCEL to edit and submit your submission later.')">Resubmit Protocol</a>

<?php 
 }
 
 if(($rstudyFinaSub['status']=='completeness check' || $rstudyFinaSub['status']=='waiting Committee') and ($totalPoints=='13' || $totalPoints=='12' || $totalPoints=='11') and $totalUseSubmissionUpload){?>
<!--<input name="doFinalSubmission" type="submit"  class="btn-secondary" value="Make Final Submission" style="float:right; margin-top:5px; "  onClick="window.location.href='./main.php?option=FinalSubmissionddd'" />-->
<a href="./main.php?option=FinalSubmission&id=<?php echo $id;?>"  style="float:right; margin-top:5px; color:#ffffff; text-decoration:none; " class="btn-secondary" onclick="return confirm('Are you sure you want to Submit? Check to make sure all comments raised in Completeness Check are submitted. You will not be able to Edit this Protocol if you click OK. Click CANCEL to edit and submit your submission later.')">Resubmit Protocol</a>

<?php 
 }

 if($rstudyFinaSub['status']=='Conditional Approval' || $rstudyFinaSub['status']=='Conditional Approval | Needs Minor Revisions' and ($totalPoints=='13' || $totalPoints=='12' || $totalPoints=='11') and $totalUseSubmissionUpload){?>
<!--<input name="doFinalSubmission" type="submit"  class="btn-secondary" value="Make Final Submission" style="float:right; margin-top:5px; "  onClick="window.location.href='./main.php?option=FinalSubmissionddd'" />-->
<a href="./main.php?option=FinalSubmission&id=<?php echo $id;?>"  style="float:right; margin-top:5px; color:#ffffff; text-decoration:none; " class="btn-secondary" onclick="return confirm('Are you sure you want to Submit? Check to make sure all comments raised in Completeness Check are submitted. You will not be able to Edit this Protocol if you click OK. Click CANCEL to edit and submit your submission later.')">Resubmit Protocol</a>

<?php 
 }
 
  if($rstudyFinaSub['status']=='Request for Responses' and ($totalPoints=='13' || $totalPoints=='12' || $totalPoints=='11') and $totalUseSubmissionUpload){?>
<!--<input name="doFinalSubmission" type="submit"  class="btn-secondary" value="Make Final Submission" style="float:right; margin-top:5px; "  onClick="window.location.href='./main.php?option=FinalSubmissionddd'" />-->
<a href="./main.php?option=FinalSubmission&id=<?php echo $id;?>"  style="float:right; margin-top:5px; color:#ffffff; text-decoration:none; " class="btn-secondary" onclick="return confirm('Are you sure you want to Submit? Check to make sure all comments raised in Completeness Check are submitted. You will not be able to Edit this Protocol if you click OK. Click CANCEL to edit and submit your submission later.')">Resubmit Protocol</a>

<?php 
 }
  if($rstudyFinaSub['status']=='Resubmit | Needs Major Revisions' and ($totalPoints=='13' || $totalPoints=='12' || $totalPoints=='11') and $totalUseSubmissionUpload){?>
<!--<input name="doFinalSubmission" type="submit"  class="btn-secondary" value="Make Final Submission" style="float:right; margin-top:5px; "  onClick="window.location.href='./main.php?option=FinalSubmissionddd'" />-->
<a href="./main.php?option=FinalSubmission&id=<?php echo $id;?>"  style="float:right; margin-top:5px; color:#ffffff; text-decoration:none; " class="btn-secondary" onclick="return confirm('Are you sure you want to Submit? Check to make sure all comments raised in Completeness Check are submitted. You will not be able to Edit this Protocol if you click OK. Click CANCEL to edit and submit your submission later.')">Resubmit Protocol</a>

<?php 
 }
 
   if($rstudyFinaSub['status']=='Rejected' and ($totalPoints=='13' || $totalPoints=='12' || $totalPoints=='11') and $totalUseSubmissionUpload){?>
<!--<input name="doFinalSubmission" type="submit"  class="btn-secondary" value="Make Final Submission" style="float:right; margin-top:5px; "  onClick="window.location.href='./main.php?option=FinalSubmissionddd'" />-->
<a href="./main.php?option=FinalSubmission&id=<?php echo $id;?>"  style="float:right; margin-top:5px; color:#ffffff; text-decoration:none; " class="btn-secondary" onclick="return confirm('Are you sure you want to Submit? Check to make sure all comments raised in Completeness Check are submitted. You will not be able to Edit this Protocol if you click OK. Click CANCEL to edit and submit your submission later.')">Resubmit Protocol</a>

<?php 
 }
 
  if($rstudyFinaSub['status']=='Scheduled for Review' and ($totalPoints=='13' || $totalPoints=='12' || $totalPoints=='11') and $totalUseSubmissionUpload){?>
<!--<input name="doFinalSubmission" type="submit"  class="btn-secondary" value="Make Final Submission" style="float:right; margin-top:5px; "  onClick="window.location.href='./main.php?option=FinalSubmissionddd'" />-->
<a href="./main.php?option=FinalSubmission&id=<?php echo $id;?>"  style="float:right; margin-top:5px; color:#ffffff; text-decoration:none; " class="btn-secondary" onclick="return confirm('Are you sure you want to Submit? Check to make sure all comments raised in Completeness Check are submitted. You will not be able to Edit this Protocol if you click OK. Click CANCEL to edit and submit your submission later.')">Resubmit Protocol</a>

<?php 
 }
 
   if($rstudyFinaSub['status']=='Waiting for Committee' and ($totalPoints=='13' || $totalPoints=='12' || $totalPoints=='11') and $totalUseSubmissionUpload){?>
<!--<input name="doFinalSubmission" type="submit"  class="btn-secondary" value="Make Final Submission" style="float:right; margin-top:5px; "  onClick="window.location.href='./main.php?option=FinalSubmissionddd'" />-->
<a href="./main.php?option=FinalSubmission&id=<?php echo $id;?>"  style="float:right; margin-top:5px; color:#ffffff; text-decoration:none; " class="btn-secondary" onclick="return confirm('Are you sure you want to Submit? Check to make sure all comments raised in Completeness Check are submitted. You will not be able to Edit this Protocol if you click OK. Click CANCEL to edit and submit your submission later.')">Resubmit Protocol</a>

<?php 
 }
 
?>