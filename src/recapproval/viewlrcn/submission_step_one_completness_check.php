<?php

$sqlstudymm="SELECT * FROM ".$prefix."submission where `owner_id`='$asrmApplctID' and id='$id' order by id desc limit 0,1";
$Querystudymm = $mysqli->query($sqlstudymm);
$rstudymm = $Querystudymm->fetch_array();
$protocol_id2m2=$rstudymm['protocol_id'];
//submission_stages
if($_POST['doSaveFirst']=='Save and Next' and $_POST['title'] and $_POST['asrmApplctID'] and $id){

	
	$title=$mysqli->real_escape_string($_POST['title']);
	$acronym=$mysqli->real_escape_string($_POST['acronym']);
	$sasrmApplctID=$mysqli->real_escape_string($_POST['asrmApplctID']);
	$is_clinical_trial=$mysqli->real_escape_string($_POST['is_clinical_trial']);
	$clinical_trial_type=$mysqli->real_escape_string($_POST['clinical_trial_type']);
	$recAffiliated_id=$mysqli->real_escape_string($_POST['recAffiliated_id']);
	$type_of_review=$mysqli->real_escape_string($_POST['type_of_review']);
	$protocol_academic_type=$mysqli->real_escape_string($_POST['protocol_academic_type']);
	$protocol_academic=$mysqli->real_escape_string($_POST['protocol_academic']);
	$PACTR_number=$mysqli->real_escape_string($_POST['PACTR_number']);
	$involve_Human_participants=$mysqli->real_escape_string($_POST['involve_Human_participants']);
	$drug_related_clinical_trial=$mysqli->real_escape_string($_POST['drug_related_clinical_trial']);
	$independentstudy=$mysqli->real_escape_string($_POST['independentstudy']);
	$independentstudy_refNo=$mysqli->real_escape_string($_POST['independentstudy_refNo']);
	$institutionCode=$mysqli->real_escape_string($_POST['institutionCode']);
	
	///REC has changed. User has changed from Original REC
$sqlREcchange="SELECT * FROM ".$prefix."submission where `owner_id`='$sasrmApplctID' and id='$id' order by id desc limit 0,1";
$QueryRecChange = $mysqli->query($sqlREcchange);
$rUserRECChange=$QueryRecChange->fetch_array();

if($rUserRECChange['recAffiliated_id']!=$recAffiliated_id){
	///Get Details of the new REC
$sqlstudyREC2="SELECT * FROM ".$prefix."list_rec_affiliated where id='$recAffiliated_id'";
$QuerystudyREC2 = $mysqli->query($sqlstudyREC2);
$rstudyREC2 = $QuerystudyREC2->fetch_array();
$accroname=$rstudyREC2['accroname'];
//Change REfCode
$protocol_id_new=($rstudyREC2['recNo']+1);
$codeUpdated="$accroname-$year-$protocol_id_new";
///Update Protocol COde
$sqlUpdateProtocl="update ".$prefix."protocol set code='$codeUpdated' where id='$id' and owner_id='$sasrmApplctID'";
$mysqli->query($sqlUpdateProtocl);

$sqlstudyREC23="update ".$prefix."list_rec_affiliated set recNo='$protocol_id_new' where id='$recAffiliated_id'";
$mysqli->query($sqlstudyREC23);

$sqlA2Protocol="update ".$prefix."submission  set `code`='$codeUpdated' where id='$id' and owner_id='$sasrmApplctID'";
$mysqli->query($sqlA2Protocol);
}
	
	//update edited table...
$sqlURevisions="SELECT * FROM ".$prefix."updated_sections where `owner_id`='$sasrmApplctID' and protocol_id='$id' and status='pending' order by id desc limit 0,1";
$QueryUserRevions = $mysqli->query($sqlURevisions);
$totalUsersRevions = $QueryUserRevions->num_rows;
if(!$totalUsersRevions){
$sqlAREvisedSections="insert into ".$prefix."updated_sections (`owner_id`,`protocol_id`,`protocol_information`,`protocol_team`,`protocol_details`,`study_description`,`RecruitmentCountries`,`registry`,`budget`,`study_work_plan`,`bibliography`,`attachments`,`payments`,`study_population`,`dateupdated`,`status`) 

values('$asrmApplctID','$id','1','','','','','','','','','','','',now(),'pending')";
$mysqli->query($sqlAREvisedSections);
}
if($totalUsersRevions){

$sqlAREvisedSections_update="update ".$prefix."updated_sections  set `protocol_information`='1' where owner_id='$asrmApplctID' and protocol_id='$id' and status='pending'";
$mysqli->query($sqlAREvisedSections_update);	
}/////////////////end updated sections
	
	
	
	
	if($_FILES['attachacadimcpaper']['name']){
$attachacadimcpaper = preg_replace('/\s+/', '_', $_FILES['attachacadimcpaper']['name']);
$attachacadimcpaper2 = $asrmApplctID.$mysqli->real_escape_string(preg_replace('/\s+/', '_', $_FILES['attachacadimcpaper']['name']));
$targetw1 = "./files/uploads/". basename($asrmApplctID.preg_replace('/\s+/', '_', $_FILES['attachacadimcpaper']['name']));
$studytoolsext_main1 = move_uploaded_file(preg_replace('/\s+/', '_', $_FILES['attachacadimcpaper']['tmp_name']), $targetw1);

}
if($_FILES['antiplagiarism']['name']){
$antiplagiarism = preg_replace('/\s+/', '_', $_FILES['antiplagiarism']['name']);
$antiplagiarism2 = $asrmApplctID.$mysqli->real_escape_string(preg_replace('/\s+/', '_', $_FILES['antiplagiarism']['name']));
$targetw4 = "./files/uploads/". basename($asrmApplctID.preg_replace('/\s+/', '_', $_FILES['antiplagiarism']['name']));
$studytoolsext_main4 = move_uploaded_file(preg_replace('/\s+/', '_', $_FILES['antiplagiarism']['tmp_name']), $targetw4);

}	



if($totalUsers and $_FILES['attachacadimcpaper']['name']){
$sqlUsersNo4="update ".$prefix."protocol set `attachacadimcpaper`='$attachacadimcpaper2' where `owner_id`='$asrmApplctID' and id='$protocol_id2m2'";
$mysqli->query($sqlUsersNo4);

}

if($totalUsers and $_FILES['attachacadimcpaper']['name']){
$sqlUsersNo3="update ".$prefix."protocol set `attachacadimcpaper`='$attachacadimcpaper2' where `owner_id`='$asrmApplctID' and id='$protocol_id2m2'";
$mysqli->query($sqlUsersNo3);

}

	if($independentstudy=='Yes'){
	$message="The reference number you have provided does not exist in the system.";	
	}

	$sqlUsers="SELECT * FROM ".$prefix."submission where `owner_id`='$sasrmApplctID' and id='$id' order by id desc limit 0,1";
		$QueryUsers = $mysqli->query($sqlUsers);
		$totalUsers = $QueryUsers->num_rows;
		$rUserInv=$QueryUsers->fetch_array();
		$protocID=$rUserInv['protocol_id'];
	
///Any existing submission---NO
if(!$totalUsers and $_POST['recAffiliated_id']){
$sqlA2="insert into ".$prefix."protocol (`owner_id`,`main_submission_id`,`meeting_id`,`created`,`updated`,`migrated_id`,`code`,`status`,`reject_reason`,`committee_screening`,`opinion_required`,`date_informed`,`updated_in`,`revised_in`,`decision_in`,`monitoring_action_next_date`,`period`,`recAffiliated_id`) 

values('$sasrmApplctID','','',now(),now(),'','','','','','','','','','','','','$recAffiliated_id')";
//$mysqli->query($sqlA2);
$record_id = $mysqli->insert_id;

if($record_id){
$sqlA2Protocol="insert into ".$prefix."submission (`protocol_id`,`original_submission_id`,`owner_id`,`recruitment_status_id`,`gender_id`,`created`,`updated`,`language`,`is_translation`,`number`,`public_title`,`scientific_title`,`title_acronym`,`is_clinical_trial`,`is_sent`,`abstract`,`keywords`,`introduction`,`justification`,`goals`,`study_design`,`health_condition`,`sample_size`,`minimum_age`,`maximum_age`,`inclusion_criteria`,`exclusion_criteria`,`recruitment_init_date`,`interventions`,`primary_outcome`,`secondary_outcome`,`general_procedures`,`analysis_plan`,`ethical_considerations`,`clinical_trial_secondary`,`funding_source`,`primary_sponsor`,`secondary_sponsor`,`bibliography`,`sscientific_contact`,`prior_ethical_approval`,`clinical_trial_type`,`approvaletter`,`status`,`recAffiliated_id`,`type_of_review`,`protocol_academic_type`,`protocol_academic`,`PACTR_number`,`involve_Human_participants`,`drug_related_clinical_trial`,`independentstudy`,`independentstudy_refNo`,`institutionCode`) 

values('$record_id','','$sasrmApplctID','','',now(),now(),'en','1','1','$title','$title','$acronym','$is_clinical_trial','0','','','','','','','','','','','','','','','','','','','','','','','','','','','$clinical_trial_type','','Pending Final Submission','$recAffiliated_id','$type_of_review','$protocol_academic_type','$protocol_academic','$PACTR_number','$involve_Human_participants','$drug_related_clinical_trial','$independentstudy','$independentstudy_refNo','$institutionCode')";
//$mysqli->query($sqlA2Protocol);
///Connect to research and save this protocol. But check whether user exists type_of_review

////////////////////Addd Methodology apvr_clinical_study_methodology
$sqlAMethodology="insert into ".$prefix."clinical_study_methodology (`protocol_id`,`general_procedures`,`owner_id`,`analysis_plan`,`ethical_considerations`,`is_sent`) 

values('$record_id','','$sasrmApplctID','','','0')";
//$mysqli->query($sqlAMethodology);

//insert into education
if($_POST['institutioncode']){
for ($i=0; $i < count($_POST['institutioncode']); $i++) {
$institutioncode=$_POST['institutioncode'][$i];
$institution=$_POST['institution'][$i];

$DataSharingAgreement = preg_replace('/\s+/', '_', $_FILES['DataSharingAgreement']['name'][$i]);
$DataSharingAgreement2 = $asrmApplctID.$mysqli->real_escape_string(preg_replace('/\s+/', '_', $_FILES['DataSharingAgreement']['name'][$i]));
$targetw1 = "./files/uploads/". basename($asrmApplctID.preg_replace('/\s+/', '_', $_FILES['DataSharingAgreement']['name'][$i]));
$studytoolsext_main1 = move_uploaded_file(preg_replace('/\s+/', '_', $_FILES['DataSharingAgreement']['tmp_name'][$i]), $targetw1);

if(strlen($_POST['institution'][$i])>=5 and $DataSharingAgreement2){
$Insert_QR2="insert into ".$prefix."collaborating_institutions (`institution`,`institutioncode`,`protocol_id`,`owner_id`,`DataSharingAgreement`) values ('$institution','$institutioncode','$record_id','$asrmApplctID','$DataSharingAgreement2')";
$mysqli->query($Insert_QR2);
}
}
}



//Insert into Submission Stages
//Insert into Submission Stages
$wm="select * from ".$prefix."submission_stages where  owner_id='$sasrmApplctID'  and protocol_id='$id' ";
$cmdwb = $mysqli->query($wm);
$totalStages = $cmdwb->num_rows;
$r= $cmdwb->fetch_array();
if(!$totalStages){
$sqlASubmissionStages="insert into ".$prefix."submission_stages (`owner_id`,`protocol_id`,`protocol_information`,`protocol_team`,`protocol_details`,`study_description`,`RecruitmentCountries`,`registry`,`budget`,`study_work_plan`,`bibliography`,`filem`,`payments`,`dateCreated`,`status`)  values('$sasrmApplctID','$record_id','1','0','0','0','0','0','0','0','0','0','0',now(),'new')";
$mysqli->query($sqlASubmissionStages);
}
if($totalStages){
$sqlASubmissionStages="update ".$prefix."submission_stages  set `protocol_information`='1' where `owner_id`='$sasrmApplctID' and `protocol_id`='$submission_id'";
$mysqli->query($sqlASubmissionStages);
}


}
if($record_id>=1){
$message='<p class="success">Dear '.$session_fullname.', details have been submitted, proceed to continue</p>';
logaction("$session_fullname added created new protocol");

echo '<img src="images/loading_wait.gif">';
echo '<div class="spacer"></div>';
echo '<meta http-equiv="REFRESH" content="0;url='.$base_url.'/main.php?option=submissionSecondUp&id='.$id.'">';

}
if($record_id<=0){
$message='<p class="failed">Dear '.$session_fullname.', details have not been saved. Re-enter and submit again.</p>';	
}
}
///////////////////////////////End Sub
if($totalUsers){
$sqlA2Protocol="update ".$prefix."submission  set `public_title`='$title',`title_acronym`='$acronym',`is_clinical_trial`='$is_clinical_trial',`clinical_trial_type`='$clinical_trial_type',`type_of_review`='$type_of_review', `protocol_academic_type`='$protocol_academic_type',`protocol_academic`='$protocol_academic',`PACTR_number`='$PACTR_number',`involve_Human_participants`='$involve_Human_participants',`drug_related_clinical_trial`='$drug_related_clinical_trial',`institutionCode`='$institutionCode',`independentstudy`='$independentstudy',`independentstudy_refNo`='$independentstudy_refNo',`recAffiliated_id`='$recAffiliated_id' where `owner_id`='$asrmApplctID' and id='$id'";
$mysqli->query($sqlA2Protocol);	


//insert into education
if($_POST['institutioncode']){
for ($i=0; $i < count($_POST['institutioncode']); $i++) {
$institutioncode=$_POST['institutioncode'][$i];
$institution=$_POST['institution'][$i];

$DataSharingAgreement = preg_replace('/\s+/', '_', $_FILES['DataSharingAgreement']['name'][$i]);
$DataSharingAgreement2 = $asrmApplctID.$mysqli->real_escape_string(preg_replace('/\s+/', '_', $_FILES['DataSharingAgreement']['name'][$i]));
$targetw1 = "./files/uploads/". basename($asrmApplctID.preg_replace('/\s+/', '_', $_FILES['DataSharingAgreement']['name'][$i]));
$studytoolsext_main1 = move_uploaded_file(preg_replace('/\s+/', '_', $_FILES['DataSharingAgreement']['tmp_name'][$i]), $targetw1);

if(strlen($_POST['institution'][$i])>=5 and $DataSharingAgreement2){
$Insert_QR2="insert into ".$prefix."collaborating_institutions (`institution`,`institutioncode`,`protocol_id`,`owner_id`,`DataSharingAgreement`) values ('$institution','$institutioncode','$protocol_id2m2','$asrmApplctID','$DataSharingAgreement2')";
$mysqli->query($Insert_QR2);
}
}
}	




echo '<meta http-equiv="REFRESH" content="0;url='.$base_url.'/main.php?option=submissionSecondUp&id='.$id.'">';
	
}

		


}//end post
?>


<?php
$sqlstudy="SELECT * FROM ".$prefix."submission where `owner_id`='$asrmApplctID' and id='$id' order by id desc limit 0,1";
$Querystudy = $mysqli->query($sqlstudy);
$totalstudy = $Querystudy->num_rows;
$rstudy = $Querystudy->fetch_array();
$protocol_id=$rstudy['protocol_id'];
$protocol_id2=$rstudy['protocol_id'];
$sqlSub_Stages="SELECT * FROM ".$prefix."submission_stages where `owner_id`='$asrmApplctID'  and protocol_id='$id' order by id desc limit 0,1";
$QuerySub_stages = $mysqli->query($sqlSub_Stages);
$totalSub_Stages = $QuerySub_stages->num_rows;
$rsSubStages = $QuerySub_stages->fetch_array();
?>
<?php include("viewlrcn/final_button.php");?>
<ul id="countrytabs" class="shadetabs">
<li><a href="<?php echo $base_url;?>recapprova./main.php?option=submissionCheck&id=<?php echo $rstudy['id'];?>" rel="#default" class="selected" <?php if($rsSubStages['protocol_information']==1 and $rsSubStages['protocol_team']==1 and $totalSub_Stages){?> style="background:green; color:#FFF;" <?php }?>>Protocol Information</a></li>


<?php if($totalstudy>=1){?><li><a href="./main.php?option=submissionSecondUp&id=<?php echo $rstudy['id'];?>" <?php if($rsSubStages['protocol_details']==1){?> style="background:green; color:#FFF;" <?php }?>>Protocol Details</a></li><?php }?>
<?php if(!$totalstudy){?><li class="extra" <?php if($rsSubStages['protocol_details']==1){?> style="background:green; color:#FFF;" <?php }?>>Protocol Details</li><?php }?>

<?php if($totalstudy>=1){?><li><a href="./main.php?option=submissionThirdUp&id=<?php echo $rstudy['id'];?>" <?php if($rsSubStages['study_description']==1 and $rsSubStages['RecruitmentCountries']==1){?> style="background:green; color:#FFF;" <?php }?>>Study Description</a></li><?php }?>
<?php if(!$totalstudy){?><li class="extra" <?php if($rsSubStages['study_description']==1 and $rsSubStages['RecruitmentCountries']==1){?> style="background:green; color:#FFF;" <?php }?>>Study Description</li><?php }?>

<?php if($totalstudy>=1){?><li><a href="./main.php?option=StudyPopulationUp&id=<?php echo $rstudy['id'];?>" <?php if($rsSubStages['study_population']==1){?> style="background:green; color:#FFF;" <?php }?>>Study Population</a></li><?php }?>
<?php if(!$totalstudy){?><li class="extra" <?php if($rsSubStages['study_population']==1){?> style="background:green; color:#FFF;" <?php }?>>Study Population</li><?php }?>


<?php if($rstudy['is_clinical_trial']==1){?>
<?php if($totalstudy>=1){?><li><a href="./main.php?option=submissionFourUp&id=<?php echo $rstudy['id'];?>" <?php if($rsSubStages['registry']==1){?> style="background:green; color:#FFF;" <?php }?>>Registry</a></li><?php }?>
<?php if(!$totalstudy){?><li class="extra" <?php if($rsSubStages['registry']==1){?> style="background:green; color:#FFF;" <?php }?>>Registry</li><?php }}?>

<?php if($totalstudy>=1){?><li><a href="./main.php?option=submissionBudgetUp&id=<?php echo $rstudy['id'];?>" <?php if($rsSubStages['budget']==1){?> style="background:green; color:#FFF;" <?php }?>>Budget</a></li><?php }?>
<?php if(!$totalstudy){?><li class="extra" <?php if($rsSubStages['budget']==1){?> style="background:green; color:#FFF;" <?php }?>>Budget</li><?php }?>

<?php if($totalstudy>=1){?><li><a href="./main.php?option=submissionScheduleUp&id=<?php echo $rstudy['id'];?>" <?php if($rsSubStages['study_work_plan']==1){?> style="background:green; color:#FFF;" <?php }?>>Study Work Plan</a></li><?php }?>
<?php if(!$totalstudy){?><li class="extra" <?php if($rsSubStages['study_work_plan']==1){?> style="background:green; color:#FFF;" <?php }?>>Study Work Plan</li><?php }?>

<?php /*?><?php if($totalstudy>=1){?><li><a href="./main.php?option=submissionFive/<?php echo $rstudy['id'];?>/" <?php if($rsSubStages['bibliography']==1){?> style="background:green; color:#FFF;" <?php }?>>Bibliography</a></li><?php }?>
<?php if(!$totalstudy){?><li class="extra"<?php if($rsSubStages['bibliography']==1){?> style="background:green; color:#FFF;" <?php }?>>Bibliography</li><?php }?><?php */?>

<?php if($totalstudy>=1){?><li><a href="./main.php?option=submissionSixUp&id=<?php echo $rstudy['id'];?>" <?php if($rsSubStages['filem']==1){?> style="background:green; color:#FFF;" <?php }?>>Attached Files</a></li><?php }?>
<?php if(!$totalstudy){?><li class="extra" <?php if($rsSubStages['filem']==1){?> style="background:green; color:#FFF;" <?php }?>>Attached Files</li><?php }?>


<?php if($totalstudy>=1){?><li><a href="./main.php?option=submissionFinishUp&id=<?php echo $rstudy['id'];?>" <?php if($rsSubStages['payments']==1){?> style="background:green; color:#FFF;" <?php }?>>Payments</a></li><?php }?>
<?php if(!$totalstudy){?><li class="extra" <?php if($rsSubStages['payments']==1){?> style="background:green; color:#FFF;" <?php }?>>Payments</li><?php }?>
</ul>
<!--<div id="countrydivcontainer" style="border:0px solid gray; width:100%; margin-bottom: 1em; padding: 10px">-->
<div style="border:0px solid gray; width:100%; margin-bottom: 1em; padding: 10px">
 


 <?php
if($_POST['doTeam']=='Save' and $_POST['investigator'] and $_POST['asrmApplctID'] and $_POST['email']){// and $_FILES['GCPtraining']['name']

	$investigator=$mysqli->real_escape_string($_POST['investigator']);
	$institution=$mysqli->real_escape_string($_POST['institution']);
	$project_role=$mysqli->real_escape_string($_POST['project_role']);
	$email=$mysqli->real_escape_string($_POST['email']);
	
	$Telephone=$mysqli->real_escape_string($_POST['Telephone']);
	$lastname=$mysqli->real_escape_string($_POST['lastname']);
	$qualification=$mysqli->real_escape_string($_POST['qualification']);
	
	$sasrmApplctID=$mysqli->real_escape_string($_POST['asrmApplctID']);
	$countryid=$mysqli->real_escape_string($_POST['countryid']);
	$protocol_id=$mysqli->real_escape_string($_POST['protocol_id']);
	
	
	if($_FILES['GCPtraining']['name']){
$GCPtraining = preg_replace('/\s+/', '_', $_FILES['GCPtraining']['name']);
$GCPtraining2 = $sasrmApplctID.$mysqli->real_escape_string(preg_replace('/\s+/', '_', $_FILES['GCPtraining']['name']));
$targetw1 = "./files/uploads/". basename($sasrmApplctID.preg_replace('/\s+/', '_', $_FILES['GCPtraining']['name']));
$studytoolsext_main1 = move_uploaded_file(preg_replace('/\s+/', '_', $_FILES['GCPtraining']['tmp_name']), $targetw1);
	}
	
	$sqlInvestigators="SELECT * FROM ".$prefix."team where `owner_id`='$sasrmApplctID' and name='$investigator' and protocol_id='$protocol_id' order by id desc";// and protocol_id='$protocol_id'
	$QueryInvestigators = $mysqli->query($sqlInvestigators);
	$totalInvestigators = $QueryInvestigators->num_rows;
	
if(!$totalInvestigators){
if($totalstudy>=1){
	/// and $rInvestigator['employment']==0 || $rInvestigator['education']==0 || $rInvestigator['publications']==0
if($project_role=='Co-Investigator' || $project_role=='Principal Investigator'){
	$requiredEducation="Yes";
	$requiredEmployment="Yes";
	$requiredPublication="Yes";
}
if($project_role=='Team Member'){
	$requiredEducation="No";
	$requiredEmployment="No";
	$requiredPublication="No";
}

	
$sqlA2="insert into ".$prefix."team (`owner_id`,`protocol_id`,`name`,`institution`,`email`,`created`,`countryid`,`project_role`,`status`,`rstug_Synched`,`requiredEducation`,`requiredEmployment`,`requiredPublication`,`education`,`employment`,`publications`,`GCPtraining`,`Telephone`,`qualification`) 

values('$sasrmApplctID','$protocol_id','$investigator','$institution','$email',now(),'$countryid','$project_role','new','0','$requiredEducation','$requiredEmployment','$requiredPublication','0','0','0','$GCPtraining2','$Telephone','$qualification')";
$mysqli->query($sqlA2);

//Insert into Submission Stages
$wm="select * from ".$prefix."submission_stages where  owner_id='$sasrmApplctID' and protocol_id='$protocol_id'";
$cmdwb = $mysqli->query($wm);
$totalStages = $cmdwb->num_rows;
$r= $cmdwb->fetch_array();
///end
/*if($totalStages){
$sqlASubmissionStages="update ".$prefix."submission_stages  set `protocol_information`='1' where `owner_id`='$sasrmApplctID' and `protocol_id`='$record_id'";
$mysqli->query($sqlASubmissionStages);
}*/

}
if($totalstudy<=0){

if($project_role=='Co-Investigator' || $project_role=='Principal Investigator'){
	$requiredEducation="Yes";
	$requiredEmployment="Yes";
	$requiredPublication="Yes";
}
if($project_role=='Team Member'){
	$requiredEducation="No";
	$requiredEmployment="No";
	$requiredPublication="No";
}

if($_FILES['GCPtraining']['name']){
$GCPtraining = preg_replace('/\s+/', '_', $_FILES['GCPtraining']['name']);
$GCPtraining2 = $sasrmApplctID.$mysqli->real_escape_string(preg_replace('/\s+/', '_', $_FILES['GCPtraining']['name']));
$targetw1 = "./files/uploads/". basename($sasrmApplctID.preg_replace('/\s+/', '_', $_FILES['GCPtraining']['name']));
$studytoolsext_main1 = move_uploaded_file(preg_replace('/\s+/', '_', $_FILES['GCPtraining']['tmp_name']), $targetw1);
	}
	
$sqlA2="insert into ".$prefix."team (`owner_id`,`protocol_id`,`name`,`institution`,`email`,`created`,`countryid`,`project_role`,`status`,`rstug_Synched`,`requiredEducation`,`requiredEmployment`,`requiredPublication`,`education`,`employment`,`publications`,`GCPtraining`) 

values('$sasrmApplctID','$protocol_id','$investigator','$institution','$email',now(),'$countryid','$project_role','new','0','$requiredEducation','$requiredEmployment','$requiredPublication','0','0','0','$GCPtraining2')";
$mysqli->query($sqlA2);

//Insert into Submission Stages

$sqlASubmissionStages="update ".$prefix."submission_stages  set `protocol_information`='1' where `owner_id`='$sasrmApplctID' and `protocol_id`='$record_id'";
$mysqli->query($sqlASubmissionStages);



///end
}


///Get country details
///Get Rec Details
$sqlRecDetails="SELECT * FROM ".$prefix."list_country where `id`='$countryid'";
$QueryRecDetails = $mysqli->query($sqlRecDetails);
$sqRecDetails = $QueryRecDetails->fetch_array();
$Nationality=$sqRecDetails['name'];

		}
	
}


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
                        <h3 class="h4">Protocal Title</h3><small><?php echo $rstudymm['public_title'];?></small>
                      </div>
                    </div>
                    <div class="project-date"><span class="hidden-sm-down"><h3 class="h4">Author</h3> <?php echo $sqUserdd['name'];?></span></div>
                  </div>
                  <div class="right-col col-lg-6 d-flex align-items-center">
                    <div class="time"><i class="fa fa-clock-o"></i><h3 class="h4">Updated At</h3> <?php echo $rstudym['updated'];?> </div>
                    <!--<div class="comments"><i class="fa fa-comment-o"></i>20</div>-->
                    <div class="project-progress">
                     <!-- <div class="progress">
                        <div role="progressbar" style="width: 45%; height: 6px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" class="progress-bar bg-red"></div>
                      </div>-->
                      
       <?php include("viewlrcn/status_log_resubmit.php");?>


                    </div>
                  </div>
                </div>
              </div>


<script>
function deleteRow(row)
{
    var i=row.parentNode.parentNode.rowIndex;
    document.getElementById('POITable').deleteRow(-1);
	//document.getElementById("myTable").deleteRow(0);
}


function insRow()
{
    console.log( 'hi');
    var x=document.getElementById('POITable');
    var new_row = x.rows[1].cloneNode(true);
    var len = x.rows.length;
    new_row.cells[0].innerHTML = len;
    
    var inp1 = new_row.cells[1].getElementsByTagName('input')[0];
    inp1.id += len;
    inp1.value = '';
	
    var inp2 = new_row.cells[2].getElementsByTagName('input')[0];
    inp2.id += len;
    inp2.value = '';
		
    var inp3 = new_row.cells[3].getElementsByTagName('input')[0];
    inp3.id += len;
    inp3.value = '';/**/
	new_row.cells[4].getElementsByTagName('input')[0].removeAttribute('style');
    x.appendChild( new_row );
}


</script>



<h3>Add Team Members <span class="error">*</span></h3>
            
                        <?php
//if no page var is given, set start to 0
$asrmApplctID_session=$_SESSION['asrmApplctID'];
////ge
$sqlUserTeam = "SELECT * FROM ".$prefix."user where asrmApplctID='$asrmApplctID_session'";
$queryTeam = $mysqli->query($sqlUserTeam);
$rTeam = $queryTeam->fetch_array();
$country_id=$rTeam['country_id'];
$email=$rTeam['email'];
$investigator=$rTeam['name'];
$institution=$rTeam['institution'];

$sqlInvestigatorsT="SELECT * FROM ".$prefix."team where `owner_id`='$asrmApplctID_session' and email='$email' and protocol_id='$id' order by id desc";
$QueryInvestigatorsTr = $mysqli->query($sqlInvestigatorsT);
$totalInvestigatorsTr = $QueryInvestigatorsTr->num_rows;
	
if(!$totalInvestigatorsTr){

/////////////////////////////////////////////////
$sqlA2="insert into ".$prefix."team (`owner_id`,`protocol_id`,`name`,`institution`,`email`,`created`,`countryid`,`project_role`,`status`,`rstug_Synched`,`requiredEducation`,`requiredEmployment`,`requiredPublication`,`education`,`employment`,`publications`) 

values('$asrmApplctID_session','0','$investigator','$institution','$email',now(),'$country_id','Principal Investigator','new','1','Yes','Yes','Yes','0','0','0')";
///Ignore$mysqli->query($sqlA2);
}


$sqlstudyProtocolExist="SELECT * FROM ".$prefix."team where owner_id='$asrmApplctID'  and protocol_id='$id' order by id desc limit 0,1";
$QuerystudyProtocolExist = $mysqli->query($sqlstudyProtocolExist);
$totalstudyProtocolExist = $QuerystudyProtocolExist->num_rows;



if($category=="DelsubmissionUp"){
$upDelete="delete from ".$prefix."team  where owner_id='$asrmApplctID' and id='$id'";
$mysqli->query($upDelete);
}


$sql = "select *,DATE_FORMAT(`created`,'%Y-%m-%d') AS created FROM ".$prefix."team where owner_id='$asrmApplctID' and  protocol_id='$id'  order by id desc LIMIT 0,100";//and conceptm_status='new' 
$result = $mysqli->query($sql);
while($rInvestigator=$result->fetch_array()){
$countryid=$rInvestigator['countryid'];
$sqlCountry = "select * FROM ".$prefix."list_country where id='$countryid' order by id desc";//and conceptm_status='new' 
$resultCountry = $mysqli->query($sqlCountry);
$rCountry=$resultCountry->fetch_array();
//requiredEducation  	requiredEmployment

if($rInvestigator['project_role']=='Co-Investigator' || $rInvestigator['project_role']=='Principal Investigator' and $rInvestigator['education']==1 and $rInvestigator['employment']==1){
$sqlASubmissionStages="update ".$prefix."submission_stages  set `protocol_team`='1',`bibliography`='1' where `owner_id`='$asrmApplctID'  and status='new'";
//$mysqli->query($sqlASubmissionStages);
}

if($rInvestigator['project_role']=='Co-Investigator' || $rInvestigator['project_role']=='Principal Investigator' and $rInvestigator['education']==0 and $rInvestigator['employment']==0){
$sqlASubmissionStages="update ".$prefix."submission_stages  set `protocol_team`='0',`bibliography`='0' where `owner_id`='$asrmApplctID'  and status='new'";
//$mysqli->query($sqlASubmissionStages);
}


if(strlen($rInvestigator['GCPtraining'])>=5 and $rInvestigator['project_role']!='Co-Investigator' and $rInvestigator['project_role']!='Principal Investigator'){
$up2="update ".$prefix."submission_stages set protocol_team='1' where owner_id='$asrmApplctID' and status='new'";
//$mysqli->query($up2);
}

if(!$rInvestigator['GCPtraining'] and $rInvestigator['project_role']!='Co-Investigator' and $rInvestigator['project_role']!='Principal Investigator'){
$up2="update ".$prefix."submission_stages set protocol_team='0' where owner_id='$asrmApplctID' and status='new'";
//$mysqli->query($up2);
}

// and !$rInvestigator['GCPtraining']
	?>
<button class="accordion"><strong style="font-weight:bold!important;"><?php echo $rInvestigator['name'];?></strong> - <?php echo $rInvestigator['project_role'];?>, click to review <?php if($rInvestigator['project_role']=='Co-Investigator' || $rInvestigator['project_role']=='Principal Investigator' and $rInvestigator['employment']==0 || $rInvestigator['education']==0){?>| <font class="errorm3">Incomplete</font><?php }?> </button>


  <div class="panel">
  <table width="98%" border="0" id="customers">
  <tr>
    <th>Name</th>
    <th>Role</th>
    <th>Institution</th>
    <th>Email</th>
    <th>Country</th>
    <th><strong>HSP/GCP Training</strong></th>
    <th>&nbsp;</th>
  </tr>
    <tr>
    <td><?php echo $rInvestigator['name'];?>  </td>
    <td><?php echo $rInvestigator['project_role'];?></td>
    <td><?php echo $rInvestigator['institution'];?></td>
    <td><?php echo $rInvestigator['email'];?> </td>
    <td><?php echo $rCountry['name'];?></td>
    <td>
	<?php if($today<=$rInvestigator['created']){?>
<a href="./cfxdownload.php?c=<?php echo $rInvestigator['id'];?>" target="_blank">View File</a>
<?php }else{?>
<a href="./cfxdownload.php?c=<?php echo $rInvestigator['id'];?>" target="_blank">View File</a>
<?php }?> 
    
    <?php if(!$rInvestigator['GCPtraining']){?><span style="color:#F00; font-weight:bold;">Required, not uploaded</span><?php }?>
    
    </td>
    <td>
  <input id="go" type="button" value="Update" onclick="window.open('<?php echo $base_url;?>team.php?id=<?php echo $rInvestigator['id'];?>','popUpWindow','height=700, width=1000, left=100, top=100, resizable=yes, scrollbars=yes, toolbar=yes, menubar=no, location=no, directories=no, status=yes');"  class="errorm4" ><br />
    
    <a href="./main.php?option=DelsubmissionUp&id=<?php echo $rInvestigator['id'];?>" style="color:#F00; font-weight:bold;" onclick="return confirm('Are you sure you want to delete this item?');">Delete</a>
    
    
    
    
    </td>
  </tr>
  
</table>

                          
  
 



<?php if($rInvestigator['requiredEmployment']=='Yes'){?><br />Add Employment and Education Details <span class="error">*</span> <?php if($rInvestigator['employment']==0){?><span class="errorm3">Pending</span><?php }?>
 
<?php if($rInvestigator['employment']==0){?>
<input id="go" type="button" value="Click here to Add New" onclick="window.open('<?php echo $base_url;?>biodata.php?id=<?php echo $rInvestigator['id'];?>','popUpWindow','height=700, width=1000, left=100, top=100, resizable=yes, scrollbars=yes, toolbar=yes, menubar=no, location=no, directories=no, status=yes');"  class="errorm4" ><?php }?>

<?php if($rInvestigator['employment']==1){?>

<input id="go" type="button" value="click to update" onclick="window.open('<?php echo $base_url;?>biodata.php?id=<?php echo $rInvestigator['id'];?>','popUpWindow','height=700, width=1000, left=100, top=100, resizable=yes, scrollbars=yes, toolbar=yes, menubar=no, location=no, directories=no, status=yes');"  class="errorm4"><?php }?>

<?php }?><br />

<?php /*?>
<?php if($rInvestigator['requiredEducation']=='Yes'){?>Education record <span class="error">*</span> <?php if($rInvestigator['education']==0){?><span class="errorm3">Pending</span> | <input id="go" type="button" value="Click here to Add New" onclick="window.open('<?php echo $base_url;?>biodata.php?id=<?php echo $rInvestigator['id'];?>','popUpWindow','height=700, width=1000, left=100, top=100, resizable=yes, scrollbars=yes, toolbar=yes, menubar=no, location=no, directories=no, status=yes');"  class="errorm4"><?php }?> <?php if($rInvestigator['education']==1){?>

<input id="go" type="button" value="click to update" onclick="window.open('<?php echo $base_url;?>biodata.php?id=<?php echo $rInvestigator['id'];?>','popUpWindow','height=700, width=1000, left=100, top=100, resizable=yes, scrollbars=yes, toolbar=yes, menubar=no, location=no, directories=no, status=yes');"  class="errorm4"><?php }?>

<?php }?><br />


<?php if($rInvestigator['requiredPublication']=='Yes'){?>Publications <?php if($rInvestigator['publications']==0){?><span class="errorm3">Pending</span> | <input id="go" type="button" value="Click here to Add New" onclick="window.open('<?php echo $base_url;?>biodata.php?id=<?php echo $rInvestigator['id'];?>','popUpWindow','height=700, width=1000, left=100, top=100, resizable=yes, scrollbars=yes, toolbar=yes, menubar=no, location=no, directories=no, status=yes');"  class="errorm4"><?php }?> <?php if($rInvestigator['publications']==1){?>
<input id="go" type="button" value="Added, click to update" onclick="window.open('<?php echo $base_url;?>biodata.php?id=<?php echo $rInvestigator['id'];?>','popUpWindow','height=700, width=1000, left=100, top=100, resizable=yes, scrollbars=yes, toolbar=yes, menubar=no, location=no, directories=no, status=yes');"  class="errorm4">

<?php }?><?php }?><?php */?>





  </div> 

   <?php }///////////end function ?>     
       
       
  <!-- Trigger/Open The Modal -->
<button id="myBtn">Add Team Member </button>       



    
    
    
<!-- The Modal -->
<div id="myModal" class="modal" style="margin-top:70px;">

  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
      <span class="close">&times;</span>
      <h3><strong>Add Team Member</strong></h3>
    </div>
    <div class="modal-body" style="height:300px; overflow:scroll;">

 <form action="" method="post" name="regForm" id="regForm" autocomplete="off" enctype="multipart/form-data">
 
 <table width="100%" border="0">
  <tr>
    <td width="50%"> <div class="form-group row" style="padding-top:6px;">

<div class="col-sm-10">
<label class="col-sm form-control-label"><strong>First Name: <span class="error">*</span></strong></label>
<input type="text" name="investigator" id="investigator" class="form-control  required" value="" placeholder="First Name" required autocomplete="off">
<input name="protocol_id" type="hidden" value="<?php echo $id;?>"/>
</div>
</div></td>
    <td width="50%">   <div class="form-group row" style="padding-top:6px;">

<div class="col-sm-10">
<label class="col-sm form-control-label"><strong>Last Name: <span class="error">*</span></strong></label>
<input type="text" name="lastname" id="investigator" class="form-control  required" value="" placeholder="Last Name" required autocomplete="off">
</div>
</div></td>
  </tr>
  <tr>
    <td width="50%"> <div class="form-group row" style="padding-top:6px;">

<div class="col-sm-10">
<label class="col-sm form-control-label"><strong>Role: <span class="error">*</span></strong></label>
<select name="project_role" id="gender_id" class="form-control  required">
    <option value="">Please Select Role</option>

<option value="Team Member">Team Member</option>
<option value="Principal Investigator">Principal Investigator</option>
<option value="Co-Investigator">Co-Investigator</option>

</select>
</div>
</div></td>
    <td width="50%">  <div class="form-group row">

<div class="col-sm-10">
<label class="col-sm form-control-label"><strong>Institution: <span class="error">*</span></strong></label>
<input type="text" name="institution" id="institution" class="form-control  required" value="" placeholder="Institution" required minlength="10" autocomplete="off">
<input type="hidden" name="asrmApplctID" value="<?php echo $_SESSION['asrmApplctID'];?>">
</div>
</div>  </td>
  </tr>
  <tr>
    <td width="50%"> <div class="form-group row">

<div class="col-sm-10">
<label class="col-sm form-control-label"><strong>Email: <span class="error">*</span></strong></label>
<input type="email" name="email" id="email" class="form-control  required email" value="" placeholder="Email" required>
</div>
</div></td>
    <td width="50%"><div class="form-group row">

<div class="col-sm-10">
<label class="col-sm form-control-label"><strong>Telephone: <span class="error">*</span></strong></label>
<input type="text" name="Telephone" id="email" class="form-control  required" value="" placeholder="Telephone" required autocomplete="off">
</div>
</div> </td>
  </tr>
  <tr>
    <td width="50%"><div class="form-group row" style="padding-top:6px;">

<div class="col-sm-10">
<label class="col-sm form-control-label"><strong>Qualification: <span class="error">*</span></strong></label>
<input type="text" name="qualification" id="investigator" class="form-control  required" placeholder="Qualification" value="" required autocomplete="off">
</div>
</div></td>
    <td width="50%"><div class="form-group row">

<div class="col-sm-10">
<label class="col-sm form-control-label"><strong>Country: <span class="error">*</span></strong></label>
<select name="countryid" id="countryid" class="form-control  required">
<option value="">Please Select Country</option>
<option value="800">Uganda</option>
<?php
$sqlCountrycv = "select * FROM ".$prefix."list_country order by name asc";//and conceptm_status='new' 
$resultCountrycv = $mysqli->query($sqlCountrycv);
while($rCountrycv=$resultCountrycv->fetch_array()){
?>
<option value="<?php echo $rCountrycv['id'];?>" <?php if($rCountrycv['id']==800){?>selected="selected"<?php }?>><?php echo $rCountrycv['name'];?></option>
<?php }?>
</select>
</div>
</div> </td>
  </tr>
  
  
  <tr>

    <td width="100%" colspan="2">   <div class="form-group row" style="padding-top:6px;">

<div class="col-sm-10">
<label class="col-sm form-control-label"><strong>HSP/GCP Training:</strong></label>

<input name="GCPtraining" type="file" id="GCPtraining" />
</div>
</div></td>
  </tr>  
  
  
  
</table>

 

   
         
                        
       
       <div class="form-group row">
                          <div class="col-sm-4 offset-sm-3">
                    <input name="doTeam" type="submit"  class="btn btn-primary" value="Save"/>

                          </div>
                        </div>
                                          
     </form>                   
    </div>
    </div>
    </div>
    
<div style="padding-bottom:10px;"></div>
<?php


if(isset($message)){echo $message;}

?>
<hr />
<form action="" method="post" name="regForm" id="regForm" autocomplete="off">
 <div class="form-group row success" style="padding-top:15px;">
<label class="form-control-label">Add Collaborating Institutions <span class="error">*</span></label>
<label class="form-control-label"><input name="institutionCode" type="radio" value="Yes" class="required" onChange="getInstitutionalCode(this.value)" <?php if($rstudy['institutionCode']=='Yes'){?>checked="checked"<?php }?> required/> Yes

<input name="institutionCode" type="radio" value="No" class="required" onChange="getInstitutionalCode(this.value)"  <?php if($rstudy['institutionCode']=='No'){?>checked="checked"<?php }?> required/> No</label>
<div id="InstitutionalCodediv">

          <?php
if($category=='DelInstitutionUp'){
$mid=$mysqli->real_escape_string($_GET['id']);
$qRDel2="delete from ".$prefix."collaborating_institutions where owner_id='$asrmApplctID' and id='$mid'";
$mysqli->query($qRDel2);
}
$qRPersoneld2="select * from ".$prefix."collaborating_institutions  where owner_id='$asrmApplctID' and protocol_id='$protocol_id2'";
$RPersoneld2=$mysqli->query($qRPersoneld2);
if($RPersoneld2->num_rows){

	?>

   
   <table width="80%" border="0" id="POITable" class="htheadersm">
        <tr>
            <th width="2%" style=" display:none;">&nbsp;</th>
            <th width="23%"><strong>Name of Institution<span class="error">*</span></strong>
            </th>
            <th width="25%"><strong>Institutional Code</strong></th>
            <th width="1%"><strong>Data Sharing Agreement <span class="error">*</span></strong></th>


            <th width="1%">&nbsp;</th>
            <th width="14%">&nbsp;</th>
        </tr>
        
        <tr>
            <td style=" display:none;">1</td>
            <td>
<input type="text" name="institution[]" id="vvv" tabindex="4" class="requiremd" minlength="8" style="border:1px solid #ffffff;width:230px;background:#ffffff;padding:5px;" autocomplete="off"/>
            </td>
            <td><input type="text" name="institutioncode[]" id="customss2" tabindex="5" class="requiredm" style="border:1px solid #ffffff;width:230px;background:#ffffff;padding:5px;" autocomplete="off"/></td>
            <td> <input type="file" name="DataSharingAgreement[]" id="DataSharingAgreement" class="required"></td>

           
            <td><input type="button" id="delPOIbutton" value="Delete" onClick="deleteRow(this)" style="display:none; font-size:12px;"/></td>
            <td><input type="button" id="addmorePOIbutton" value="Add Rows" onClick="insRow()" style="font-size:12px;"/></td>
        </tr>
       <?php while ($rowRows2 = $RPersoneld2->fetch_array())
{ ?>
<tr>
            <td id="grid"><?php echo $rowRows2['institution'];?> </td>
            <td id="grid"><?php echo $rowRows2['institutioncode'];?> </td>
            <td id="grid"></td>
            
            <td id="grid">
            
        <?php if($today){?>
<a href="./cfxdownload.php?bt=<?php echo $rowRows2['id'];?>" target="_blank">View File</a>
<?php }else{?>
<a href="./cfxdownload.php?bt=<?php echo $rowRows2['id'];?>" target="_blank">View File</a>
<?php }?><br />
            </td>
            <td><a href="./main.php?option=DelInstitutionUp&id=<?php echo $rowRows2['id'];?>" style="color:#F00; font-weight:bold;" onclick="return confirm('Are you sure you want to delete this Institution?');">Delete</a></td>
        </tr>

<?php
}

?> 
    </table>
<?php }//end if total exist

?> 


</div>
</div>

 
                         <div class="form-group row success" style="padding-top:15px;">
                          <label class="col-sm-2 form-control-label">Type of Research? <span class="error">*</span></label>
                          <div class="col-sm-10"><input name="protocol_academic" type="radio" value="Academic" class="required" <?php if($rstudy['protocol_academic']=='Academic'){?>checked="checked"<?php }?>  onChange="getAcademicType(this.value)" required/> Academic &nbsp;
                          
                          
                          
<input name="protocol_academic" type="radio" value="Non-Academic" class="required" <?php if($rstudy['protocol_academic']=='Non-Academic'){?>checked="checked"<?php }?>  onChange="getAcademicType(this.value)" required/> Non-Academic<br />
                          
                          
                          <div id="academic">
<?php if($rstudy['protocol_academic']=='Academic'){?> <select name="protocol_academic_type" id="dropdown" class="form-control required">
   <option value="" selected="selected">&nbsp;Select from list</option>
   <option value="Bachelors" <?php if($rstudy['protocol_academic_type']=='Diploma'){?>selected="selected"<?php }?>>&nbsp;Diploma</option>
<option value="Bachelors" <?php if($rstudy['protocol_academic_type']=='Bachelors'){?>selected="selected"<?php }?>>&nbsp;Bachelors</option>
<option value="Bachelors Fellowship" <?php if($rstudy['protocol_academic_type']=='Bachelors Fellowship'){?>selected="selected"<?php }?>>&nbsp;Bachelors Fellowship</option>
<option value="Masters" <?php if($rstudy['protocol_academic_type']=='Masters'){?>selected="selected"<?php }?>>&nbsp;Masters</option>
<option value="Masters Fellowship" <?php if($rstudy['protocol_academic_type']=='Masters Fellowship'){?>selected="selected"<?php }?>>&nbsp;Masters Fellowship</option>
<option value="PHD" <?php if($rstudy['protocol_academic_type']=='PHD'){?>selected="selected"<?php }?>>&nbsp;PHD</option>
<option value="PHD Fellowship" <?php if($rstudy['protocol_academic_type']=='PHD Fellowship'){?>selected="selected"<?php }?>>&nbsp;PHD Fellowship</option>
<option value="Post-Doctoral Fellowship" <?php if($rstudy['protocol_academic_type']=='Post-Doctoral Fellowship'){?>selected="selected"<?php }?>>&nbsp;Post-Doctoral Fellowship</option>
<option value="Post-Doctoral Studies" <?php if($rstudy['protocol_academic_type']=='Post-Doctoral Studies'){?>selected="selected"<?php }?>>&nbsp;Post-Doctoral Studies</option>
                </select><?php }?></div>
                
                
             <?php 

$sqlProtocol="SELECT * FROM ".$prefix."protocol where `owner_id`='$sasrmApplctID' and id='$protocol_id2m2' order by id desc limit 0,1";
$QueryProtocol = $mysqli->query($sqlProtocol);
$rstudyProtocol=$QueryProtocol->fetch_array();
?> 
<?php if($today<=$rstudyProtocol['created'] and $rstudyProtocol['attachacadimcpaper']){?>
<a href="./cfxdownload.php?act=<?php echo $rstudyProtocol['id'];?>" target="_blank">Academic/admission letter</a>
<?php }else{?>
<a href="./cfxdownload.php?act=<?php echo $rstudyProtocol['id'];?>" target="_blank">Academic/admission letter</a>
<?php }?><br />

<?php if($today<=$rstudyProtocol['created'] and $rstudyProtocol['antiplagiarism']){?>
<a href="./cfxdownload.php?act=<?php echo $rstudyProtocol['id'];?>" target="_blank">Anti-plagiarism Check</a>
<?php }else{?>
<a href="./cfxdownload.php?act=<?php echo $rstudyProtocol['id'];?>" target="_blank">Anti-plagiarism Check</a>
<?php }?>
                
                
                </div>  </div>
                        
                        
                         <div class="line"></div>
                         
                         
<div class="form-group row success">
                          <label class="col-sm-2 form-control-label">Choose Category<span class="error">*</span></label>
                          <div class="col-sm-10">
                          <select name="clinical_trial_type" id="dropdown" class="form-control required" required>
   <option value="" selected="selected">&nbsp;Select from list</option>
<?php
$qRCat="select * from apvr_categories where publish='Yes' order by rstug_categoryName asc";
$RCat = $mysqli->query($qRCat);
while($TCat = $RCat->fetch_array()){
?>
                <option value="<?php echo $TCat['rstug_categoryID'];?>" <?php if($TCat['rstug_categoryID']==$rstudy['clinical_trial_type']){?>selected="selected"<?php }?>>&nbsp;<?php echo $TCat['rstug_categoryName'];?></option>
<?php }?>
                </select>
                        
<label class="col-sm-4 form-control-label">Is the study a clinical trial? <span class="error">*</span></label>

<input name="is_clinical_trial" type="radio" value="1" class="required" <?php if($rstudy['is_clinical_trial']=='1'){?>checked="checked"<?php }?> /> Yes &nbsp;<input name="is_clinical_trial" type="radio" value="0" class="required" <?php if($rstudy['is_clinical_trial']=='0'){?>checked="checked"<?php }?>required/> No<br />  <!--onChange="getClinicalTrial(this.value)"!--> 
  <div id="clinical">
<?php if($rstudy['is_clinical_trial']=='0'){?> <select name="clinical_trial_type" id="dropdown" class="form-control required" required>
   <option value="" selected="selected">&nbsp;Select from list</option>
<?php
$qRCat="select * from apvr_categories order by rstug_categoryName asc";
$RCat = $mysqli->query($qRCat);
while($TCat = $RCat->fetch_array()){
?>
                <option value="<?php echo $TCat['rstug_categoryID'];?>" <?php if($TCat['rstug_categoryID']==$rstudy['clinical_trial_type']){?>selected="selected"<?php }?>>&nbsp;<?php echo $TCat['rstug_categoryName'];?></option>
<?php }?>
                </select><?php }?>

<?php /*?>
<?php if($rstudy['is_clinical_trial']=='1'){?>
<label class="form-control-label"><strong>Pan African Clinical Trials Registry (PACTR)  registration number <span class="error">*</span></strong></label><br />
<input name="PACTR_number" type="text" value="<?php echo $rstudy['PACTR_number'];?>" class="form-control required" autocomplete="off"/>   <?php }?>        <?php */?>     </div>        
                
                
        
                          
                          
                          
                          
                          </div>
                        </div>
                        <div class="line"></div>
                    
                    
                    
            <div class="line"></div>
  <input name="involve_Human_participants" type="hidden" value="No"/>                     
<?php /* ?>   <input name="drug_related_clinical_trial" type="hidden" value="Yes"/>  
    <input name="drug_related_clinical_trial" type="hidden" value="Yes"/> 
      <input name="is_clinical_trial" type="hidden" value="1"/>               
<div class="form-group row success">
<label class="col-sm-4 form-control-label">Does the study involve Human participants? <span class="error">*</span></label>

<div class="col-sm-6">
<input name="involve_Human_participants" type="radio" value="Yes" class="required" <?php if($rstudy['involve_Human_participants']=='Yes'){?>checked="checked"<?php }?>/> Yes &nbsp;
                          
<input name="involve_Human_participants" type="radio" value="No" class="required" <?php if($rstudy['involve_Human_participants']=='No'){?>checked="checked"<?php }?>/> No<br />
                          
</div>
</div>        <?php */?>                    
                         
<div class="form-group row success">
<label class="col-sm-4 form-control-label">Is the study a drug related Clinical trial? <span class="error">*</span></label>

<div class="col-sm-6">
<input name="drug_related_clinical_trial" type="radio" value="Yes" class="required" <?php if($rstudy['drug_related_clinical_trial']=='Yes'){?>checked="checked"<?php }?> required/> Yes &nbsp;
                          
<input name="drug_related_clinical_trial" type="radio" value="No" class="required" <?php if($rstudy['drug_related_clinical_trial']=='No'){?>checked="checked"<?php }?> required/> No<br />
                          
</div>
</div>

<div class="form-group row success">
<label class="col-sm-7 form-control-label">Is the study 'nested' to an existing study? <span class="error">*</span></label>

<div class="col-sm-6">
<input name="independentstudy" type="radio" value="Yes" class="required" <?php if($rstudy['independentstudy']=='Yes'){?>checked="checked"<?php }?> required  onChange="getIndependentStudy(this.value)"/> Yes &nbsp;
                          
<input name="independentstudy" type="radio" value="No" class="required" <?php if($rstudy['independentstudy']=='No'){?>checked="checked"<?php }?> required  onChange="getIndependentStudy(this.value)"/> No<br />


  <?php if($rstudy['independentstudy_refNo']){?>
  <label class="col-sm- form-control-label">Enter Existing Reference Number: <span class="error">*</span></label>
  <input type="text" name="independentstudy_refNo" id="vvv" tabindex="4" class="required" style="border:1px solid #ffffff;width:230px;background:#ffffff;padding:5px;" autocomplete="off" value="<?php echo $rstudy['independentstudy_refNo'];?>"/> <?php }else {?><div id="independentdiv"></div>  <?php }?>
  
                     
</div>
</div>





   <?php /*?><?php */?>


<div class="line"></div>
     
                    
                    
                        
                        
                         <div class="form-group row success">
                          <label class="col-sm-2 form-control-label">Project Title: <span class="error">*</span></label>
                          <div class="col-sm-10">
                            <input type="text" name="title" class="form-control  required" value="<?php echo $rstudy['public_title'];?>" autocomplete="off" id="title" required>
                          </div>
                        </div>
                        <div class="line"></div>
                        
                      
                        
                          <div class="form-group row success">
                          <label class="col-sm-2 form-control-label">Choose REC: <span class="error">*</span></label>
                          <div class="col-sm-10">
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

<input name="asrmApplctID" type="hidden" value="<?php echo $asrmApplctID;?>" />
                          </div>
                        </div>
                        
                        
                        
                        
                  <div class="line"></div>
                        
                          <div class="form-group row success">
                          <label class="col-sm-2 form-control-label">Type of Review: <span class="error">*</span></label>
                          <div class="col-sm-10">
                       <select name="type_of_review" id="recAffiliated_id" class="form-control  required" required>
<option value="">Please Select</option>

<option value="Expedited Review" <?php if($rstudy['type_of_review']=='Expedited Review'){?>selected="selected"<?php }?>>Expedited Review</option>
<option value="Regular Review" <?php if($rstudy['type_of_review']=='Regular Review'){?>selected="selected"<?php }?>>Regular Review</option>

<option value="Fast Track" <?php if($rstudy['type_of_review']=='Fast Track'){?>selected="selected"<?php }?>>Fast Track</option>
<option value="Exempt" <?php if($rstudy['type_of_review']=='Exempt'){?>selected="selected"<?php }?>>Exempt</option>
</select>
                          </div>
                        </div>       
                        
                        
                        
                          <div class="line"></div>
                        
                        
                        
                        <div class="form-group row">
                          <div class="col-sm-4 offset-sm-3">
                    <input name="doSaveFirst" type="submit"  class="btn btn-primary" value="Save and Next"/>

                          </div>
                        </div>
   
   </form>
                                     
</div>
 
 
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