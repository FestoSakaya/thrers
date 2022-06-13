<?php
if(!$id){
	
echo '<meta http-equiv="REFRESH" content="1;url='.$base_url.'/main.php?option=dashboard">';
}
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
		
  $sqlUsersNo="SELECT * FROM ".$prefix."protocol where `owner_id`='$sasrmApplctID' and code='$independentstudy_refNo' order by id desc limit 0,1";
		$QueryUsersNo = $mysqli->query($sqlUsersNo);
		$totalUsersNo = $QueryUsersNo->num_rows;


	$sqlUsers="SELECT * FROM ".$prefix."submission where `owner_id`='$sasrmApplctID' and status='Pending Final Submission' and id='$id' order by id desc limit 0,1";
		$QueryUsers = $mysqli->query($sqlUsers);
		$totalUsers = $QueryUsers->num_rows;
		$rUserInv=$QueryUsers->fetch_array();
		
		$protocID=$rUserInv['protocol_id'];
		/*if($rUserInv['protocol_id']){}else{
		$protocID=$rUserInv['id'];
		$sqlUsersm="update ".$prefix."submission set protocol_id='$protocID' where `owner_id`='$sasrmApplctID' and status='Pending Final Submission' and is_sent='0'";
		$mysqli->query($sqlUsersm);
		}*/
		if($_POST['institutioncode']){
		for ($i=0; $i < count($_POST['institutioncode']); $i++) {
$institutioncodeFun.=$_POST['institutioncode'][$i];
$institutionFun.=$_POST['institution'][$i];

$DataSharingAgreementFun.= $_FILES['DataSharingAgreement']['tmp_name'][$i];

		}}
	
///Any existing submission---YES
if(!$totalUsers and $_POST['recAffiliated_id'] and $independentstudy=='Yes'){//and $totalUsersNo>=1 
$sqlA2="insert into ".$prefix."protocol (`owner_id`,`main_submission_id`,`meeting_id`,`created`,`updated`,`migrated_id`,`code`,`status`,`reject_reason`,`committee_screening`,`opinion_required`,`date_informed`,`updated_in`,`revised_in`,`decision_in`,`monitoring_action_next_date`,`period`,`recAffiliated_id`,`attachacadimcpaper`,`antiplagiarism`) 

values('$sasrmApplctID','','',now(),now(),'','','','','','','','','','','','','$recAffiliated_id','$attachacadimcpaper2','$antiplagiarism2')";
$mysqli->query($sqlA2);
$record_id = $mysqli->insert_id;


//if($record_id){
$sqlA2Protocol="insert into ".$prefix."submission (`protocol_id`,`original_submission_id`,`owner_id`,`recruitment_status_id`,`gender_id`,`created`,`updated`,`language`,`is_translation`,`number`,`public_title`,`scientific_title`,`title_acronym`,`is_clinical_trial`,`is_sent`,`abstract`,`keywords`,`introduction`,`justification`,`goals`,`study_design`,`health_condition`,`sample_size`,`minimum_age`,`maximum_age`,`recruitment_init_date`,`general_procedures`,`analysis_plan`,`ethical_considerations`,`clinical_trial_secondary`,`funding_source`,`primary_sponsor`,`secondary_sponsor`,`bibliography`,`sscientific_contact`,`prior_ethical_approval`,`clinical_trial_type`,`approvaletter`,`status`,`recAffiliated_id`,`type_of_review`,`protocol_academic_type`,`protocol_academic`,`PACTR_number`,`involve_Human_participants`,`drug_related_clinical_trial`,`independentstudy`,`independentstudy_refNo`,`institutionCode`) 

values('$id','','$sasrmApplctID','','',now(),now(),'en','1','1','$title','$title','$acronym','$is_clinical_trial','0','','','','','','','','','','','','','','','','','','','','','','$clinical_trial_type','','Pending Final Submission','$recAffiliated_id','$type_of_review','$protocol_academic_type','$protocol_academic','$PACTR_number','$involve_Human_participants','$drug_related_clinical_trial','$independentstudy','$independentstudy_refNo','$institutionCode')";
$mysqli->query($sqlA2Protocol);
///Connect to research and save this protocol. But check whether user exists type_of_review
$sqlTeam2="update ".$prefix."team set protocol_id='$id' where `owner_id`='$asrmApplctID' and status='new'";
$mysqli->query($sqlTeam2);
////////////////////Addd Methodology apvr_clinical_study_methodology
$sqlAMethodology="insert into ".$prefix."clinical_study_methodology (`protocol_id`,`general_procedures`,`owner_id`,`analysis_plan`,`ethical_considerations`,`is_sent`) 

values('$id','','$sasrmApplctID','','','0')";
$mysqli->query($sqlAMethodology);

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
$Insert_QR2="insert into ".$prefix."collaborating_institutions (`institution`,`institutioncode`,`protocol_id`,`owner_id`,`DataSharingAgreement`) values ('$institution','$institutioncode','$id','$asrmApplctID','$DataSharingAgreement2')";
$mysqli->query($Insert_QR2);
}
}//for each
}


//Insert into Submission Stages
//Insert into Submission Stages
$wm="select * from ".$prefix."submission_stages where  owner_id='$sasrmApplctID' and status='new' and protocol_id='$id'";
$cmdwb = $mysqli->query($wm);
$totalStages = $cmdwb->num_rows;
$r= $cmdwb->fetch_array();
if(!$totalStages){
$sqlASubmissionStages="insert into ".$prefix."submission_stages (`owner_id`,`protocol_id`,`protocol_information`,`protocol_team`,`protocol_details`,`study_description`,`RecruitmentCountries`,`registry`,`budget`,`study_work_plan`,`bibliography`,`filem`,`payments`,`dateCreated`,`status`)  values('$sasrmApplctID','$id','1','0','0','0','0','0','0','0','0','0','0',now(),'new')";
$mysqli->query($sqlASubmissionStages);
}
if($totalStages){
$sqlASubmissionStages="update ".$prefix."submission_stages  set `protocol_information`='1' where `owner_id`='$sasrmApplctID' and `protocol_id`='$id'";
$mysqli->query($sqlASubmissionStages);
}


//} end $id>
if($id>=1){
logaction("$session_fullname added created new protocol");

echo '<img src="images/loading_wait.gif">';
echo '<div class="spacer"></div>';
echo '<meta http-equiv="REFRESH" content="0;url='.$base_url.'/main.php?option=submissionSecond&id='.$id.'">';

}
if($id<=0){
$message='<p class="error2">Dear '.$session_fullname.', details have not been saved. Re-enter and submit again.</p>';	
}


}///////////////////////END YES
if(!$totalUsers and $_POST['recAffiliated_id'] and $independentstudy=='Yes'){//$totalUsersNo<=0 and 
$message='<p class="error2">Dear '.$session_fullname.', details have not been saved. Please check reference number entered.</p>';	
}
///////////////////////////////End Sub





/////////////////////////////////This does not have an existing Protocol Reference

///Any existing submission---NO

if(!$totalUsers and $_POST['recAffiliated_id'] and $independentstudy=='No'){
$sqlA2="insert into ".$prefix."protocol (`owner_id`,`main_submission_id`,`meeting_id`,`created`,`updated`,`migrated_id`,`code`,`status`,`reject_reason`,`committee_screening`,`opinion_required`,`date_informed`,`updated_in`,`revised_in`,`decision_in`,`monitoring_action_next_date`,`period`,`recAffiliated_id`) 

values('$sasrmApplctID','','',now(),now(),'','','','','','','','','','','','','$recAffiliated_id')";
$mysqli->query($sqlA2);
$record_id = $mysqli->insert_id;

//if($record_id){
$sqlA2Protocol="insert into ".$prefix."submission (`protocol_id`,`original_submission_id`,`owner_id`,`recruitment_status_id`,`gender_id`,`created`,`updated`,`language`,`is_translation`,`number`,`public_title`,`scientific_title`,`title_acronym`,`is_clinical_trial`,`is_sent`,`abstract`,`keywords`,`introduction`,`justification`,`goals`,`study_design`,`health_condition`,`sample_size`,`minimum_age`,`maximum_age`,`recruitment_init_date`,`general_procedures`,`analysis_plan`,`ethical_considerations`,`clinical_trial_secondary`,`funding_source`,`primary_sponsor`,`secondary_sponsor`,`bibliography`,`sscientific_contact`,`prior_ethical_approval`,`clinical_trial_type`,`approvaletter`,`status`,`recAffiliated_id`,`type_of_review`,`protocol_academic_type`,`protocol_academic`,`PACTR_number`,`involve_Human_participants`,`drug_related_clinical_trial`,`independentstudy`,`independentstudy_refNo`,`institutionCode`) 

values('$id','','$sasrmApplctID','','',now(),now(),'en','1','1','$title','$title','$acronym','$is_clinical_trial','0','','','','','','','','','','','','','','','','','','','','','','$clinical_trial_type','','Pending Final Submission','$recAffiliated_id','$type_of_review','$protocol_academic_type','$protocol_academic','$PACTR_number','$involve_Human_participants','$drug_related_clinical_trial','$independentstudy','$independentstudy_refNo','$institutionCode')";
$mysqli->query($sqlA2Protocol);
///Connect to research and save this protocol. But check whether user exists type_of_review

$sqlTeam2="update ".$prefix."team set protocol_id='$id' where `owner_id`='$asrmApplctID' and status='new'";
$mysqli->query($sqlTeam2);

////////////////////Addd Methodology apvr_clinical_study_methodology
$sqlAMethodology="insert into ".$prefix."clinical_study_methodology (`protocol_id`,`general_procedures`,`owner_id`,`analysis_plan`,`ethical_considerations`,`is_sent`) 

values('$id','','$sasrmApplctID','','','0')";
$mysqli->query($sqlAMethodology);

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
$Insert_QR2="insert into ".$prefix."collaborating_institutions (`institution`,`institutioncode`,`protocol_id`,`owner_id`,`DataSharingAgreement`) values ('$institution','$institutioncode','$id','$asrmApplctID','$DataSharingAgreement2')";
$mysqli->query($Insert_QR2);
}
}
}




//Insert into Submission Stages
//Insert into Submission Stages
$wm="select * from ".$prefix."submission_stages where  owner_id='$sasrmApplctID' and status='new' and protocol_id='$id'";
$cmdwb = $mysqli->query($wm);
$totalStages = $cmdwb->num_rows;
$r= $cmdwb->fetch_array();
if(!$totalStages){
$sqlASubmissionStages="insert into ".$prefix."submission_stages (`owner_id`,`protocol_id`,`protocol_information`,`protocol_team`,`protocol_details`,`study_description`,`RecruitmentCountries`,`registry`,`budget`,`study_work_plan`,`bibliography`,`filem`,`payments`,`dateCreated`,`status`)  values('$sasrmApplctID','$id','1','0','0','0','0','0','0','0','0','0','0',now(),'new')";
$mysqli->query($sqlASubmissionStages);
}
if($totalStages){
$sqlASubmissionStages="update ".$prefix."submission_stages  set `protocol_information`='1' where `owner_id`='$sasrmApplctID' and `protocol_id`='$id'";
$mysqli->query($sqlASubmissionStages);
}


//}
if($id>=1){
$message='<p class="success">Dear '.$session_fullname.', details have been submitted, click save to continue</p>';
logaction("$session_fullname added created new protocol");

echo '<img src="images/loading_wait.gif">';
echo '<div class="spacer"></div>';
echo '<meta http-equiv="REFRESH" content="0;url='.$base_url.'/main.php?option=submissionSecond&id='.$id.'">';

}
if($id<=0){
$message='<p class="error2">Dear '.$session_fullname.', details have not been saved. Re-enter and submit again.</p>';	
}


}//End checking RefNo
///////////////////////////////End Sub

///////////////////////////////End Sub


if($totalUsers and $_FILES['attachacadimcpaper']['name']){
$sqlUsersNo4="update ".$prefix."protocol set `attachacadimcpaper`='$attachacadimcpaper2' where `owner_id`='$asrmApplctID' and id='$id'";
$mysqli->query($sqlUsersNo4);

}

if($totalUsers and $_FILES['antiplagiarism']['name']){
$sqlUsersNo3="update ".$prefix."protocol set `antiplagiarism`='$antiplagiarism2' where `owner_id`='$asrmApplctID' and id='$id'";
$mysqli->query($sqlUsersNo3);

}

////////////////Begin we are updating this submission////////////////////
if($totalUsers and $independentstudy=='Yes'){
$sqlA2Protocol="update ".$prefix."submission  set `public_title`='$title',`title_acronym`='$acronym',`is_clinical_trial`='$is_clinical_trial',`clinical_trial_type`='$clinical_trial_type',`type_of_review`='$type_of_review', `protocol_academic_type`='$protocol_academic_type',`protocol_academic`='$protocol_academic',`PACTR_number`='$PACTR_number',`involve_Human_participants`='$involve_Human_participants',`drug_related_clinical_trial`='$drug_related_clinical_trial',`institutionCode`='$institutionCode',`independentstudy`='$independentstudy',`independentstudy_refNo`='$independentstudy_refNo',`recAffiliated_id`='$recAffiliated_id' where `owner_id`='$asrmApplctID' and id='$id'";
$mysqli->query($sqlA2Protocol);	


$sqlTeam2="update ".$prefix."team set protocol_id='$id' where `owner_id`='$asrmApplctID' and status='new'";
$mysqli->query($sqlTeam2);

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
$Insert_QR2="insert into ".$prefix."collaborating_institutions (`institution`,`institutioncode`,`protocol_id`,`owner_id`,`DataSharingAgreement`) values ('$institution','$institutioncode','$id','$asrmApplctID','$DataSharingAgreement2')";
$mysqli->query($Insert_QR2);
}

}	
}

echo '<meta http-equiv="REFRESH" content="0;url='.$base_url.'/main.php?option=submissionSecond&id='.$id.'">';
	
}
if($totalUsers and $independentstudy=='Yes'){//and $totalUsersNo<=0 
$message='<p class="error2">Dear '.$session_fullname.', details have not been saved. Please check reference number entered.</p>';	
}

////NO and Reference number not provided
	if($totalUsers and $independentstudy=='No'){
$sqlA2Protocol="update ".$prefix."submission  set `public_title`='$title',`title_acronym`='$acronym',`is_clinical_trial`='$is_clinical_trial',`clinical_trial_type`='$clinical_trial_type',`type_of_review`='$type_of_review', `protocol_academic_type`='$protocol_academic_type',`protocol_academic`='$protocol_academic',`PACTR_number`='$PACTR_number',`involve_Human_participants`='$involve_Human_participants',`drug_related_clinical_trial`='$drug_related_clinical_trial',`institutionCode`='$institutionCode',`independentstudy`='$independentstudy',`independentstudy_refNo`='$independentstudy_refNo',`recAffiliated_id`='$recAffiliated_id' where `owner_id`='$asrmApplctID' and id='$id'";
$mysqli->query($sqlA2Protocol);	


$sqlTeam2="update ".$prefix."team set protocol_id='$id' where `owner_id`='$asrmApplctID' and status='new'";
$mysqli->query($sqlTeam2);
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
$Insert_QR2="insert into ".$prefix."collaborating_institutions (`institution`,`institutioncode`,`protocol_id`,`owner_id`,`DataSharingAgreement`) values ('$institution','$institutioncode','$id','$asrmApplctID','$DataSharingAgreement2')";
$mysqli->query($Insert_QR2);
}
}

}	

echo '<meta http-equiv="REFRESH" content="0;url='.$base_url.'/main.php?option=submissionSecond&id='.$id.'">';
//check if not mmawanda 

$sqlprotocalChangeCOde="SELECT * FROM ".$prefix."protocol where id='$id' and owner_id='$asrmApplctID'";
$QprotocalSubChangeCOde = $mysqli->query($sqlprotocalChangeCOde);
$rprotocalSubChangeCOde = $QprotocalSubChangeCOde->fetch_array();
$changeCOde=$rprotocalSubChangeCOde['code'];
$categoryChunkscc = explode(".", $changeCOde);

$sqlstudyREC2="SELECT * FROM ".$prefix."list_rec_affiliated where id='$recAffiliated_id'";
$QuerystudyREC2 = $mysqli->query($sqlstudyREC2);
$rstudyREC2 = $QuerystudyREC2->fetch_array();
$accroname=$rstudyREC2['accroname'];

$chopCP1="$categoryChunkscc[0]";
if($chopCP1!=$accroname){
//Update code to new accroname
$existingRefNo=$rstudyREC2['recNo']+1;
$code="$accroname-$year-$protocol_idwe";

$sqlprotocalChangeCOde="UPDATE ".$prefix."protocol set code='' where id='$id' and owner_id='$asrmApplctID'";
//$mysqli->query($sqlprotocalChangeCOde);

$sqlprotocalChangeCOde2="UPDATE ".$prefix."submission set code='' where id='$id' and owner_id='$asrmApplctID'";
//$mysqli->query($sqlprotocalChangeCOde2);	
}


}///////////////////end	



}//end post
?>
<?php
$sqlstudy="SELECT * FROM ".$prefix."submission where `owner_id`='$asrmApplctID' and id='$id' order by id desc limit 0,1";
$Querystudy = $mysqli->query($sqlstudy);
$totalstudy = $Querystudy->num_rows;
$rstudy = $Querystudy->fetch_array();
$protocol_id=$rstudy['protocol_id'];
$protocol_id2=$rstudy['protocol_id'];
$sqlSub_Stages="SELECT * FROM ".$prefix."submission_stages where `owner_id`='$asrmApplctID' and protocol_id='$id' and protocol_id>=1 and status='new' order by id desc limit 0,1";
$QuerySub_stages = $mysqli->query($sqlSub_Stages);
$totalSub_Stages = $QuerySub_stages->num_rows;
$rsSubStages = $QuerySub_stages->fetch_array();
?>
<?php include("viewlrcn/final_button.php");?>
<ul id="countrytabs" class="shadetabs">
<li><a href="<?php echo $base_url;?>main.php?option=submission&id=<?php echo $id;?>" rel="#default" class="selected" <?php if($rsSubStages['protocol_information']==1 and $rsSubStages['protocol_team']==1 and $totalSub_Stages){?> style="background:green; color:#FFF;" <?php }?>>Protocol Information</a></li>


<?php if($totalstudy>=1){?><li><a href="./main.php?option=submissionSecond&id=<?php echo $rstudy['id'];?>" <?php if($rsSubStages['protocol_details']==1){?> style="background:green; color:#FFF;" <?php }?>>Protocol Details</a></li><?php }?>
<?php if(!$totalstudy){?><li class="extra" <?php if($rsSubStages['protocol_details']==1){?> style="background:green; color:#FFF;" <?php }?>>Protocol Details</li><?php }?>

<?php if($totalstudy>=1){?><li><a href="./main.php?option=submissionThird&id=<?php echo $rstudy['id'];?>" <?php if($rsSubStages['study_description']==1 and $rsSubStages['RecruitmentCountries']==1){?> style="background:green; color:#FFF;" <?php }?>>Study Description</a></li><?php }?>
<?php if(!$totalstudy){?><li class="extra" <?php if($rsSubStages['study_description']==1 and $rsSubStages['RecruitmentCountries']==1){?> style="background:green; color:#FFF;" <?php }?>>Study Description</li><?php }?>

<?php if($totalstudy>=1){?><li><a href="./main.php?option=StudyPopulation&id=<?php echo $rstudy['id'];?>" <?php if($rsSubStages['study_population']==1){?> style="background:green; color:#FFF;" <?php }?>>Study Population</a></li><?php }?>
<?php if(!$totalstudy){?><li class="extra" <?php if($rsSubStages['study_population']==1){?> style="background:green; color:#FFF;" <?php }?>>Study Population</li><?php }?>


<?php if($rstudy['is_clinical_trial']==1){?>
<?php if($totalstudy>=1){?><li><a href="./main.php?option=submissionFour&id=<?php echo $rstudy['id'];?>" <?php if($rsSubStages['registry']==1){?> style="background:green; color:#FFF;" <?php }?>>Registry</a></li><?php }?>
<?php if(!$totalstudy){?><li class="extra" <?php if($rsSubStages['registry']==1){?> style="background:green; color:#FFF;" <?php }?>>Registry</li><?php }}?>

<?php if($totalstudy>=1){?><li><a href="./main.php?option=submissionBudget&id=<?php echo $rstudy['id'];?>" <?php if($rsSubStages['budget']==1){?> style="background:green; color:#FFF;" <?php }?>>Budget</a></li><?php }?>
<?php if(!$totalstudy){?><li class="extra" <?php if($rsSubStages['budget']==1){?> style="background:green; color:#FFF;" <?php }?>>Budget</li><?php }?>

<?php if($totalstudy>=1){?><li><a href="./main.php?option=submissionSchedule&id=<?php echo $rstudy['id'];?>" <?php if($rsSubStages['study_work_plan']==1){?> style="background:green; color:#FFF;" <?php }?>>Study Work Plan</a></li><?php }?>
<?php if(!$totalstudy){?><li class="extra" <?php if($rsSubStages['study_work_plan']==1){?> style="background:green; color:#FFF;" <?php }?>>Study Work Plan</li><?php }?>

<?php /*?><?php if($totalstudy>=1){?><li><a href="./main.php?option=submissionFive/<?php echo $rstudy['id'];?>/" <?php if($rsSubStages['bibliography']==1){?> style="background:green; color:#FFF;" <?php }?>>Bibliography</a></li><?php }?>
<?php if(!$totalstudy){?><li class="extra"<?php if($rsSubStages['bibliography']==1){?> style="background:green; color:#FFF;" <?php }?>>Bibliography</li><?php }?><?php */?>

<?php if($totalstudy>=1){?><li><a href="./main.php?option=submissionSix&id=<?php echo $rstudy['id'];?>" <?php if($rsSubStages['filem']==1){?> style="background:green; color:#FFF;" <?php }?>>Attached Files</a></li><?php }?>
<?php if(!$totalstudy){?><li class="extra" <?php if($rsSubStages['filem']==1){?> style="background:green; color:#FFF;" <?php }?>>Attached Files</li><?php }?>


<?php if($totalstudy>=1){?><li><a href="./main.php?option=submissionFinish&id=<?php echo $rstudy['id'];?>" <?php if($rsSubStages['payments']==1){?> style="background:green; color:#FFF;" <?php }?>>Payments</a></li><?php }?>
<?php if(!$totalstudy){?><li class="extra" <?php if($rsSubStages['payments']==1){?> style="background:green; color:#FFF;" <?php }?>>Payments</li><?php }?>
</ul>
<!--<div id="countrydivcontainer" style="border:0px solid gray; width:100%; margin-bottom: 1em; padding: 10px">-->
<div style="border:0px solid gray; width:100%; margin-bottom: 1em; padding: 10px">
 
<?php if(isset($message)){echo $message;}?>

 <?php
 
 
 
if($_POST['doTeam']=='Save' and $_POST['investigator'] and $_POST['asrmApplctID'] and $_POST['email'] and $id){// and $_FILES['GCPtraining']['name']

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
	
$sqlInvestigators="SELECT * FROM ".$prefix."team where `owner_id`='$sasrmApplctID' and name='$investigator' and protocol_id='$id' order by id desc";// and protocol_id='$protocol_id'
	$QueryInvestigators = $mysqli->query($sqlInvestigators);
	$totalInvestigators = $QueryInvestigators->num_rows;
	

if($totalInvestigators<=0){


$sqlA2="insert into ".$prefix."team (`owner_id`,`protocol_id`,`name`,`institution`,`email`,`created`,`countryid`,`project_role`,`status`,`rstug_Synched`,`requiredEducation`,`requiredEmployment`,`requiredPublication`,`education`,`employment`,`publications`,`GCPtraining`,`Telephone`,`qualification`) 

values('$sasrmApplctID','$id','$investigator','$institution','$email',now(),'$countryid','$project_role','new','0','$requiredEducation','$requiredEmployment','$requiredPublication','0','0','0','$GCPtraining2','$Telephone','$qualification')";
$mysqli->query($sqlA2);
$teamMember_id = $mysqli->insert_id;

/////////////After adding to Team Members Table, now add to others
$bibliography=$mysqli->real_escape_string($_POST['bibliography']);

//insert into education
for ($i=0; $i < count($_POST['rstug_educn_designation']); $i++) {
$rstug_educn_university=$mysqli->real_escape_string($_POST['rstug_educn_university'][$i]);
$rstug_educn_designation=$mysqli->real_escape_string($_POST['rstug_educn_designation'][$i]);
$rstug_educn_year=$_POST['rstug_educn_year'][$i];
$rstug_educn_period=$_POST['rstug_educn_period'][$i];
$completionyeareduc=$_POST['completionyeareduc'][$i];

$sqlEduc="SELECT * FROM ".$prefix."education_history where `rstug_user_id`='$sasrmApplctID' and teamMemberID='$teamMember_id' and rstug_educn_university='$rstug_educn_university' and  rstug_educn_designation='$rstug_educn_designation' and  rstug_educn_year='$rstug_educn_year' order by rstug_educn_id desc limit 0,1";
$QueryEduc = $mysqli->query($sqlEduc);
$totalEduc = $QueryEduc->num_rows;

if(strlen($_POST['rstug_educn_designation'][$i])>=5 and !$totalEduc){
$Insert_QR2="insert into ".$prefix."education_history (`rstug_user_id`,`rstug_educn_university`,`rstug_educn_designation`,`rstug_educn_year`,`completionyear`,`rstug_educn_period`,`rstug_ammend`,`rstug_Synched`,`teamMemberID`) values ('$sasrmApplctID','$rstug_educn_university','$rstug_educn_designation','$rstug_educn_year','$completionyeareduc','$rstug_educn_period','0','0','$teamMember_id')";
$mysqli->query($Insert_QR2);
$record_id1 = $mysqli->insert_id;
}

if($record_id1){
$sqlA2Protocolamm="update ".$prefix."team  set `education`='1' where owner_id='$sasrmApplctID' and id='$teamMember_id'";
$mysqli->query($sqlA2Protocolamm);}

}
/////////////////////Begin


for ($i=0; $i < count($_POST['rstug_institution'][$i]); $i++) {
	$current_yearm = date('Y');
$institution=$mysqli->real_escape_string($_POST['rstug_institution'][$i]);
$designation=$mysqli->real_escape_string($_POST['designation'][$i]);
$year=$_POST['year'][$i];
$completionyear=$_POST['completionyear'][$i];
//$period=$_POST['period'][$i];
$period=($current_yearm-$year);
$sqlEmploy="SELECT * FROM ".$prefix."employment_details where `rstug_user_id`='$sasrmApplctID' and teamMemberID='$teamMember_id' and rstug_institution='$institution' and rstug_designation='$designation' and rstug_year='$year' order by rstug_employment_id desc limit 0,1";
$QueryEmploy = $mysqli->query($sqlEmploy);
$totalEmploy = $QueryEmploy->num_rows;


if(strlen($_POST['rstug_institution'][$i])>=5 and !$totalEmploy){
$Insert_QR2="insert into ".$prefix."employment_details (`rstug_user_id`,`rstug_institution`,`rstug_designation`,`rstug_year`,`completionyear`,`rstug_period`,`rstug_ammend`,`teamMemberID`) values ('$sasrmApplctID','$institution','$designation','$year','$completionyear','$period','0','$teamMember_id')";
$inseted=$mysqli->query($Insert_QR2);
$record_id2 = $mysqli->insert_id;
}
//////////////update
if($record_id2){
$sqlA2Protocola="update ".$prefix."team  set `employment`='1' where owner_id='$sasrmApplctID' and id='$teamMember_id'";
$mysqli->query($sqlA2Protocola);
$message='<p class="success">Dear '.$session_fullname.', details have been submitted, close the page and continue with your submission.</p>';
logaction("$session_fullname updated protocol, Bibliography Information");

}
}


for ($i=0; $i < count($_POST['title'][$i]); $i++) {
$titledd=$mysqli->real_escape_string($_POST['title'][$i]);
$citationdd=$mysqli->real_escape_string($_POST['citation'][$i]);

$sqlCitations="SELECT * FROM ".$prefix."publications where `owner_id`='$sasrmApplctID' and title='$titledd' and citation='$citationdd' order by id desc limit 0,1";
$QueryCitations = $mysqli->query($sqlCitations);
$totalCitatons = $QueryCitations->num_rows;


if(!$totalCitatons and strlen($titledd)>5){
$Insert_QR2ff="insert into ".$prefix."publications (`owner_id`,`protocol_id`,`title`,`citation`,`created`,`teamMemberID`) values ('$sasrmApplctID','','$titledd','$citationdd',now(),'$teamMember_id')";
$mysqli->query($Insert_QR2ff);
$record_id3 = $mysqli->insert_id;
}
//////////////update
if($record_id3){
$sqlA2ProtocolaSS="update ".$prefix."team  set `publications`='1' where owner_id='$sasrmApplctID' and id='$teamMember_id'";
$mysqli->query($sqlA2ProtocolaSS);

}
}
//////////////////////end education, publication
//Insert into Submission Stages
$wm="select * from ".$prefix."submission_stages where  owner_id='$sasrmApplctID' and status='new' and `protocol_id`='$id'";
$cmdwb = $mysqli->query($wm);
$totalStages = $cmdwb->num_rows;
$r= $cmdwb->fetch_array();
if(!$totalStages){
$sqlASubmissionStages="insert into ".$prefix."submission_stages (`owner_id`,`protocol_id`,`protocol_information`,`protocol_team`,`protocol_details`,`study_description`,`RecruitmentCountries`,`registry`,`budget`,`study_work_plan`,`bibliography`,`filem`,`payments`,`dateCreated`,`status`)  values('$sasrmApplctID','$id','1','0','0','0','0','0','0','0','0','0','0',now(),'new')";
$mysqli->query($sqlASubmissionStages);
}

if($totalStages){
$sqlASubmissionStages="update ".$prefix."submission_stages  set `protocol_information`='1' where `owner_id`='$sasrmApplctID' and `protocol_id`='$id'";
$mysqli->query($sqlASubmissionStages);
}
if(!$totalStages){
$sqlASubmissionStages="update ".$prefix."submission_stages  set `protocol_information`='0' where `owner_id`='$sasrmApplctID' and `protocol_id`='$id'";
//$mysqli->query($sqlASubmissionStages);
}

///end
}


///Get country details
///Get Rec Details
$sqlRecDetails="SELECT * FROM ".$prefix."list_country where `id`='$countryid'";
$QueryRecDetails = $mysqli->query($sqlRecDetails);
$sqRecDetails = $QueryRecDetails->fetch_array();
$Nationality=$sqRecDetails['name'];

	
}




?>

  <div class="project-progress">
                     
                     
             <?php //include("viewlrcn/status_log.php");?>
</div>


<script>
function deleteRow(row)
{
    var i=row.parentNode.parentNode.rowIndex;
    document.getElementById('POITable').deleteRow(-1);
	//document.getElementById("myTable").deleteRow(0);
}


function insRowInst()
{
    console.log( 'hi');
    var x=document.getElementById('POITableis');
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

<script>
function deleteRowu(row)
{
    var i=row.parentNode.parentNode.rowIndex;
    document.getElementById('POITable').deleteRowu(-1);
	//document.getElementById("myTable").deleteRowu(0);
}
function deleteRow2(row)
{
    var i=row.parentNode.parentNode.rowIndex;
    document.getElementById('POITable2').deleteRowu(-1);
	//document.getElementById("myTable").deleteRowu(0);
}
function deleteRow3(row)
{
    var i=row.parentNode.parentNode.rowIndex;
    document.getElementById('POITable3').deleteRowu(-1);
	//document.getElementById("myTable").deleteRowu(0);
}
function insRowu()
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
	
    /*
	
	var inp3 = new_row.cells[3].getElementsByTagName('input')[0];
    inp3.id += len;
    inp3.value = '';
	
	var inp4 = new_row.cells[4].getElementsByTagName('input')[0];
    inp4.id += len;
    inp4.value = '';
	
	new_row.cells[5].getElementsByTagName('input')[0].removeAttribute('style');	
	
	
	var inp3 = new_row.cells[3].getElementsByTagName('input')[0];
    inp3.id += len;
    inp3.value = '';*/
	
     new_row.cells[4].getElementsByTagName('input')[0].removeAttribute('style');
    x.appendChild( new_row );
}

function insRow2()
{
    console.log( 'hi');
    var x=document.getElementById('POITable2');
    var new_row = x.rows[1].cloneNode(true);
    var len = x.rows.length;
    new_row.cells[0].innerHTML = len;
    
    var inp1 = new_row.cells[1].getElementsByTagName('input')[0];
    inp1.id += len;
    inp1.value = '';
	
    var inp2 = new_row.cells[2].getElementsByTagName('input')[0];
    inp2.id += len;
    inp2.value = '';
		
    /*var inp3 = new_row.cells[3].getElementsByTagName('input')[0];
    inp3.id += len;
    inp3.value = '';	new_row.cells[3].getElementsByTagName('input')[0].removeAttribute('style');*/

     new_row.cells[5].getElementsByTagName('input')[0].removeAttribute('style');
    x.appendChild( new_row );
}

function insRow3()
{
    console.log( 'hi');
    var x=document.getElementById('POITable3');
    var new_row = x.rows[1].cloneNode(true);
    var len = x.rows.length;
    new_row.cells[0].innerHTML = len;
    
    var inp1 = new_row.cells[1].getElementsByTagName('input')[0];
    inp1.id += len;
    inp1.value = '';
	
    var inp2 = new_row.cells[2].getElementsByTagName('input')[0];
    inp2.id += len;
    inp2.value = '';
	
		
    /*var inp3 = new_row.cells[3].getElementsByTagName('input')[0];
    inp3.id += len;
    inp3.value = '';	new_row.cells[3].getElementsByTagName('input')[0].removeAttribute('style');*/

    new_row.cells[3].getElementsByTagName('input')[0].removeAttribute('style');
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
$investigator=$mysqli->real_escape_string($rTeam['name']);
$institution=$mysqli->real_escape_string($rTeam['institution']);

$sqlInvestigatorsT="SELECT * FROM ".$prefix."team where `owner_id`='$asrmApplctID_session' and email='$email' and protocol_id='$id' order by id desc limit 0,1";//and protocol_id='$id' 
$QueryInvestigatorsTr = $mysqli->query($sqlInvestigatorsT);
$totalInvestigatorsTr = $QueryInvestigatorsTr->num_rows;
$rTeamExist = $QueryInvestigatorsTr->fetch_array();///
////////////////////////////////////////////////////////////////////////
$sqlInvestigatorsT2="SELECT * FROM ".$prefix."team where `owner_id`='$asrmApplctID_session' and status='new' and protocol_id='$id' order by id desc limit 0,1";//and protocol_id='$id' 
$QueryInvestigatorsTr2 = $mysqli->query($sqlInvestigatorsT2);
$totalInvestigatorsTr2 = $QueryInvestigatorsTr2->num_rows;
	
if(!$totalInvestigatorsTr){//Team member does not have existing data
/////////////////////////////////////////////////
$sqlA2="insert into ".$prefix."team (`owner_id`,`protocol_id`,`name`,`institution`,`email`,`created`,`countryid`,`project_role`,`status`,`rstug_Synched`,`requiredEducation`,`requiredEmployment`,`requiredPublication`,`education`,`employment`,`publications`) 

values('$asrmApplctID_session','$id','$investigator','$institution','$email',now(),'$country_id','Principal Investigator','new','1','Yes','Yes','Yes','0','0','0')";
$mysqli->query($sqlA2);
}

if($totalInvestigatorsTr and !$totalInvestigatorsTr2){//Team has existing data
///Labour, pick old data
$sqlA2="insert into ".$prefix."team (`owner_id`,`protocol_id`,`name`,`institution`,`email`,`created`,`countryid`,`project_role`,`status`,`rstug_Synched`,`requiredEducation`,`requiredEmployment`,`requiredPublication`,`education`,`employment`,`publications`) 

values('$asrmApplctID_session','$id','$investigator','$institution','$email',now(),'$country_id','Principal Investigator','new','1','Yes','Yes','Yes','1','1','1')";
$mysqli->query($sqlA2);
$submitted_team_id = $mysqli->insert_id;
///employment_details  education_history
$new_team_id=$rTeamExist['id'];

//////////////////////////////////////////////////////////////////////////////////////////////////////////
$sqlHistory="SELECT * FROM ".$prefix."education_history where `rstug_user_id`='$asrmApplctID_session' and teamMemberID='$new_team_id' order by rstug_educn_id desc";$QueryHistory = $mysqli->query($sqlHistory);
$rTeamHistory = $QueryHistory->fetch_array();
$new_rstug_educn_university=$mysqli->real_escape_string($rTeamHistory['rstug_educn_university']);
$new_rstug_educn_designation=$mysqli->real_escape_string($rTeamHistory['rstug_educn_designation']);
$new_rstug_educn_year=$mysqli->real_escape_string($rTeamHistory['rstug_educn_year']);
$new_completionyear=$mysqli->real_escape_string($rTeamHistory['completionyear']);
$new_rstug_educn_period=$mysqli->real_escape_string($rTeamHistory['rstug_educn_period']);


$Insert_QR2m="insert into ".$prefix."education_history (`rstug_user_id`,`rstug_educn_university`,`rstug_educn_designation`,`rstug_educn_year`,`completionyear`,`rstug_educn_period`,`rstug_ammend`,`rstug_Synched`,`teamMemberID`) values ('$asrmApplctID_session','$new_rstug_educn_university','$new_rstug_educn_designation','$new_rstug_educn_year','$new_completionyear','$new_rstug_educn_period','0','0','$submitted_team_id')";
$mysqli->query($Insert_QR2m);

/////////////////////////////////////////PI employment_details exists/////////////////////////////////////////////////////////////////
$sqlEmploymentD="SELECT * FROM ".$prefix."employment_details where `rstug_user_id`='$asrmApplctID_session' and teamMemberID='$new_team_id' order by rstug_employment_id desc";$QueryEmploymentD = $mysqli->query($sqlEmploymentD);
$rTeamEmploymentD = $QueryEmploymentD->fetch_array();
$new_rstug_institution_emp=$mysqli->real_escape_string($rTeamEmploymentD['rstug_institution']);
$new_rstug_designation_emp=$mysqli->real_escape_string($rTeamEmploymentD['rstug_designation']);
$new_rstug_year_emp=$rTeamEmploymentD['rstug_year'];
$new_completionyear_emp=$mysqli->real_escape_string($rTeamEmploymentD['completionyear']);
$new_rstug_period_emp=$rTeamEmploymentD['rstug_period'];



$Insert_QR2="insert into ".$prefix."employment_details (`rstug_user_id`,`rstug_institution`,`rstug_designation`,`rstug_year`,`completionyear`,`rstug_period`,`rstug_ammend`,`teamMemberID`) values ('$asrmApplctID_session','$new_rstug_institution_emp','$new_rstug_designation_emp','$new_rstug_year_emp','$new_completionyear_emp','$new_rstug_period_emp','0','$submitted_team_id')";
$inseted=$mysqli->query($Insert_QR2);




}


$sqlstudyProtocolExist="SELECT * FROM ".$prefix."team where owner_id='$asrmApplctID'  and protocol_id='$id' order by id desc limit 0,1";
$QuerystudyProtocolExist = $mysqli->query($sqlstudyProtocolExist);
$totalstudyProtocolExist = $QuerystudyProtocolExist->num_rows;



if($category=="Delsubmission"){
	$mid=$mysqli->real_escape_string($_GET['mid']);
$upDelete="delete from ".$prefix."team  where owner_id='$asrmApplctID' and id='$mid'";
$mysqli->query($upDelete);
}


$sql = "select *,DATE_FORMAT(`created`,'%Y-%m-%d') AS created FROM ".$prefix."team where owner_id='$asrmApplctID' and  status='new' and protocol_id='$id' order by id desc LIMIT 0,100";//and conceptm_status='new' 
$result = $mysqli->query($sql);
while($rInvestigator=$result->fetch_array()){
$countryid=$rInvestigator['countryid'];

$sqlstudyProtocolExist="update ".$prefix."team set protocol_id='$id' where owner_id='$asrmApplctID'  and protocol_id='$id' and status='new'";
//$mysqli->query($sqlstudyProtocolExist);

$sqlCountry = "select * FROM ".$prefix."list_country where id='$countryid' order by id desc";//and conceptm_status='new' 
$resultCountry = $mysqli->query($sqlCountry);
$rCountry=$resultCountry->fetch_array();
//requiredEducation  	requiredEmployment

if($rInvestigator['project_role']=='Co-Investigator' || $rInvestigator['project_role']=='Principal Investigator' and $rInvestigator['education']==1 and $rInvestigator['employment']==1){
$sqlASubmissionStages="update ".$prefix."submission_stages  set `protocol_team`='1',`bibliography`='1' where `owner_id`='$asrmApplctID'  and status='new' and `protocol_id`='$id'";
$mysqli->query($sqlASubmissionStages);
}

if($rInvestigator['project_role']=='Co-Investigator' || $rInvestigator['project_role']=='Principal Investigator' and $rInvestigator['education']==0 and $rInvestigator['employment']==0){
$sqlASubmissionStages="update ".$prefix."submission_stages  set `protocol_team`='0',`bibliography`='0' where `owner_id`='$asrmApplctID'  and status='new' and `protocol_id`='$id'";
$mysqli->query($sqlASubmissionStages);
}

//strlen($rInvestigator['GCPtraining'])>=5 and 
if($rInvestigator['project_role']!='Co-Investigator' and $rInvestigator['project_role']!='Principal Investigator'){
$up2="update ".$prefix."submission_stages set protocol_team='1' where owner_id='$asrmApplctID' and status='new' and `protocol_id`='$id'";
$mysqli->query($up2);
} 
//!$rInvestigator['GCPtraining'] and 
if($rInvestigator['project_role']!='Co-Investigator' and $rInvestigator['project_role']!='Principal Investigator'){
$up2="update ".$prefix."submission_stages set protocol_team='0' where owner_id='$asrmApplctID' and status='new' and `protocol_id`='$id'";
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
    
   <?php /*?> <?php if(!$rInvestigator['GCPtraining']){?><span style="color:#F00; font-weight:bold;">Required, not uploaded</span><?php }?><?php */?>
    
    </td>
    <td>
  <input id="go" type="button" value="Update" onclick="window.open('<?php echo $base_url;?>team.php?id=<?php echo $rInvestigator['id'];?>','popUpWindow','height=700, width=1000, left=100, top=100, resizable=yes, scrollbars=yes, toolbar=yes, menubar=no, location=no, directories=no, status=yes');"  class="errorm4" ><br />
    
    <a href="./main.php?option=Delsubmission&id=<?php echo $id;?>&mid=<?php echo $rInvestigator['id'];?>" style="color:#F00; font-weight:bold;" onclick="return confirm('Are you sure you want to delete this item?');">Delete</a>
    
    
    
    
    </td>
  </tr>
  
</table>

                          
  
 



<?php if($rInvestigator['requiredEmployment']=='Yes'){?><br />Add Employment and Education Details <span class="error">*</span> <?php if($rInvestigator['employment']==0){?><span class="errorm3">Pending</span><?php }?>
 
<?php /*?><?php if($rInvestigator['employment']==0){?>
<input id="go" type="button" value="Click here to Add New" onclick="window.open('<?php echo $base_url;?>biodata.php?id=<?php echo $rInvestigator['id'];?>','popUpWindow','height=700, width=1000, left=100, top=100, resizable=yes, scrollbars=yes, toolbar=yes, menubar=no, location=no, directories=no, status=yes');"  class="errorm4" ><?php }?>

<?php if($rInvestigator['employment']==1){?>

<input id="go" type="button" value="click to update" onclick="window.open('<?php echo $base_url;?>biodata.php?id=<?php echo $rInvestigator['id'];?>','popUpWindow','height=700, width=1000, left=100, top=100, resizable=yes, scrollbars=yes, toolbar=yes, menubar=no, location=no, directories=no, status=yes');"  class="errorm4"><?php }?><?php */?>

<?php }?><br />






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
    <div class="modal-body" style="height:400px; overflow:scroll;">

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
<label class="col-sm form-control-label"><strong>HSP/GCP Training: </strong></label>

<input name="GCPtraining" type="file" id="GCPtraining" />
</div>
</div></td>
  </tr>  
  
  
  
</table>

 
<!--Begin education, employment background-->
          
                        
<div class="form-group row" style="margin-left:10px;">
                        
<table width="100%">
                <tr>
<td colspan="2">

<h3 style="font-size:14px;" class="defmf">Employment <span class="error">*</span></h3><hr />
<table width="80%" border="0" id="POITable" class="thhdeaders">
        <tr>
            <th width="6%" style=" display:none;">&nbsp;</th>
            <th width="21%"><strong>Institution (in full)<span class="error3">*</span>
            </strong></th>
            <th width="28%"><strong>Designation <span class="error3">*</span></strong></th>
            <th width="14%"><strong>Start Year <span class="error3">*</span></strong></th>


            <th width="13%">End Year *</th>
            <th width="18%">&nbsp;</th>
        </tr>
        <tr>
            <td style=" display:none;">1</td>
            <td>
            
            <input type="text" name="rstug_institution[]" id="cvd" tabindex="8" class="requiremd" minlength="5" style="border:1px solid #7F9DB9;width:160px;background:#ffffff;padding:5px;" required/>
            

            </td>
            <td><input type="text" name="designation[]" id="customss2" tabindex="5" class="requiredm" style="border:1px solid #7F9DB9;width:200px;background:#ffffff;padding:5px;" required/></td>
  
          
  
  
            <td><select name="year[]" id="ssss" class="requiredm" style="border:1px solid #7F9DB9;width:60px;background:#ffffff;padding:5px;"  onChange="getNextYear(this.value)" required>
<option value="">Year</option>
<?php
define('DOB_YEAR_START', 1950);

$current_year = date('Y')+0;

for ($count = $current_year; $count >= DOB_YEAR_START; $count--)
{
?>
    <option value="<?php echo $count;?>"><?php echo $count;?></option>
<?php }?>

  </select></td>
       
           
            <td>
            
            <div id="nextyeardiv"></div>
            
           
            
            
            
            <input type="button" id="delPOIbutton" value="Delete" onClick="deleteRowu(this)" style="display:none; font-size:12px;"/>
            
            </td>
            <td>
             
            <input type="button" id="addmorePOIbutton" value="Add Rows" onClick="insRowu()" style="font-size:12px;"/></td>
        </tr>
       </table>
       

    
    
    <br />
   
   <h3 style="font-size:14px;" class="defmf">Education <span class="error">*</span></h3> <hr />
    <table width="100%">
                <tr>
<td colspan="2">

<table width="80%" border="0" id="POITable2" class="thhdeaders">
        <tr>
            <th width="2%" style=" display:none;">&nbsp;</th>
            <th width="17%"><strong>Institution (in full)<span class="error3">*</span></strong></th>
            <th width="20%"><strong>Qualification <span class="error3">*</span></strong></th>
            <th width="10%"><strong>Start Year <span class="error3">*</span></strong></th>
            <th width="15%">End Year *</th>
            <th width="19%"><strong>Field of  Specialization <span class="error3">*</span></strong></th>

            <th width="2%">&nbsp;</th>
            <th width="15%">&nbsp;</th>
        </tr>
        <tr>
            <td style=" display:none;">1</td>
            <td>
<input type="text" name="rstug_educn_university[]" id="vvv" tabindex="8" class="requiredm" minlength="5" style="border:1px solid #7F9DB9;width:160px;background:#ffffff;padding:5px;" required/>
            </td>
            <td><input type="text" name="rstug_educn_designation[]" id="customss2" class="requiredm" minlength="5" style="border:1px solid #7F9DB9;width:160px;background:#ffffff;padding:5px;" required/></td>
  
          
  
  
            <td><select name="rstug_educn_year[]" id="ssss" class="requiredm" style="border:1px solid #7F9DB9;width:60px;background:#ffffff;padding:5px;" onChange="getNextYearM(this.value)" required>
<option value="">Year</option>
<?php
define('DOB_YEAR_START', 1950);

$current_year = date('Y')+0;

for ($count = $current_year; $count >= DOB_YEAR_START; $count--)
{
?>
    <option value="<?php echo $count;?>"><?php echo $count;?></option>
<?php }?>

  </select></td>
            <td> <div id="nextyearmmdiv"></div></td>
              <td>
            <input type="text" name="rstug_educn_period[]" id="ddd" tabindex="5" class="requiredm" style="border:1px solid #7F9DB9;width:160px;background:#ffffff;padding:5px;" required/>
            </td>
           
            <td><input type="button" id="delPOIbutton" value="Delete" onClick="deleteRow2(this)" style="display:none; font-size:12px;"/></td>
            <td><input type="button" id="addmorePOIbutton" value="Add Rows" onClick="insRow2()" style="font-size:12px;"/></td>
        </tr>
        </table>
        
        
        
     
    
    </td>
    </tr>
    

                
              </table>
    
    
    
    
    
    </td>
    </tr>

                
              </table>
    
                        
                        
                     
                       
                                               
   <h3 style="font-size:14px;" class="defmf">Recent Publications </h3> <hr />
    <table width="100%">
                <tr>
<td colspan="2">

<table width="80%" border="0" id="POITable3" class="thhdeaders">
        <tr>
            <th width="2%" style=" display:none;">&nbsp;</th>
            <th width="22%"><strong>Title<span class="error3">*</span></strong></th>
            <th width="26%"><strong>Citation <span class="error3">*</span></strong></th>
            <th width="1%">&nbsp;</th>
            <th width="14%">&nbsp;</th>
        </tr>
        <tr>
            <td style=" display:none;">1</td>
            <td>
 <input type="hidden" name="ssss[]" id="vvv" tabindex="8" class="requiredm" minlength="5"/>   
             <textarea name="title[]" id="MyTextBox333" cols="" rows="5" class="form-control"><?php echo $rstudy['title'];?></textarea>



            </td>
            <td> 
            
         <input type="hidden" name="titleee[]" id="vvv" tabindex="8" class="requiredm" minlength="5"/>   
             <textarea name="citation[]" id="MyTextBox333" cols="" rows="5" class="form-control"><?php echo $rstudy['citation'];?></textarea></td>
  
          
  
  
           
            <td><input type="button" id="delPOIbutton" value="Delete" onClick="deleteRow3(this)" style="display:none; font-size:12px;"/></td>
            <td><input type="button" id="addmorePOIbutton" value="Add Rows" onClick="insRow3()" style="font-size:12px;"/></td>
        </tr>
        </table>
        
    </td>
    </tr>
    
</table>

    </td>
    </tr>
</table>
</div>
      
        
                        
 <!--End education, employment background-->      
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

<hr />
<form action="" method="post" name="regForm" id="regForm" autocomplete="off" enctype="multipart/form-data">
 <div class="form-group row success" style="padding-top:15px;">
<label class="form-control-label">Add Collaborating Institutions <span class="error">*</span></label>
<label class="form-control-label"><input name="institutionCode" type="radio" value="Yes" class="required" onChange="getInstitutionalCode(this.value)" <?php if($rstudy['institutionCode']=='Yes' || $_POST['institutionCode']=='Yes'){?>checked="checked"<?php }?> required/> Yes

<input name="institutionCode" type="radio" value="No" class="required" onChange="getInstitutionalCode(this.value)"  <?php if($rstudy['institutionCode']=='No' || $_POST['institutionCode']=='No'){?>checked="checked"<?php }?> required/> No</label>
<div id="InstitutionalCodediv">

          <?php
if($category=='DelInstitution'){
$mid=$mysqli->real_escape_string($_GET['id']);
$qRDel2="delete from ".$prefix."collaborating_institutions where owner_id='$asrmApplctID' and id='$mid'";
$mysqli->query($qRDel2);
}
$qRPersoneld2="select * from ".$prefix."collaborating_institutions  where owner_id='$asrmApplctID' and protocol_id='$id'";
$RPersoneld2=$mysqli->query($qRPersoneld2);
if($RPersoneld2->num_rows || $_POST['institution']){

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
<input type="text" name="institution[]" id="vvv" tabindex="4" class="requiremd" minlength="8" style="border:1px solid #ffffff;width:230px;background:#ffffff;padding:5px;" autocomplete="off" value="<?php echo $institutioncodeFun;?>"/>
            </td>
            <td><input type="text" name="institutioncode[]" id="customss2" tabindex="5" class="requiredm" style="border:1px solid #ffffff;width:230px;background:#ffffff;padding:5px;" autocomplete="off" value="<?php echo $institutionFun;?>"/></td>
            <td> <input type="file" name="DataSharingAgreement[]" id="DataSharingAgreement" class="required">
            <?php //echo $DataSharingAgreementFun;?>
            
            </td>

           
            <td><input type="button" id="delPOIbutton" value="Delete" onClick="deleteRow(this)" style="display:none; font-size:12px;"/></td>
            <td><input type="button" id="addmorePOIbutton" value="Add Rows" onClick="insRow()" style="font-size:12px;"/></td>
        </tr>
       <?php while ($rowRows2 = $RPersoneld2->fetch_array())
{ ?>
<tr>
            <td id="grid"><?php echo $rowRows2['institution'];?> </td>
            <td id="grid"><?php echo $rowRows2['institutioncode'];?> </td>
            <td id="grid"></td>
            
            <td id="grid"> <?php if($today){?>
<a href="./cfxdownload.php?bt=<?php echo $rowRows2['id'];?>" target="_blank">View File</a>
<?php }else{?>
<a href="./cfxdownload.php?bt=<?php echo $rowRows2['id'];?>" target="_blank">View File</a>
<?php }?>
            
            </td>
            <td><a href="./main.php?option=DelInstitution&id=<?php echo $rowRows2['id'];?>" style="color:#F00; font-weight:bold;" onclick="return confirm('Are you sure you want to delete this Institution?');">Delete</a></td>
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
                          <div class="col-sm-10"><input name="protocol_academic" type="radio" value="Academic" class="required" <?php if($rstudy['protocol_academic']=='Academic' || $_POST['protocol_academic']=='Academic'){?>checked="checked"<?php }?>  onChange="getAcademicType(this.value)" required/> Academic &nbsp;
                          
                          
                          
<input name="protocol_academic" type="radio" value="Non-Academic" class="required" <?php if($rstudy['protocol_academic']=='Non-Academic' || $_POST['protocol_academic']=='Non-Academic'){?>checked="checked"<?php }?>  onChange="getAcademicType(this.value)" required/> Non-Academic<br />
                          
                          
                          <div id="academic">
<?php if($rstudy['protocol_academic']=='Academic' || $_POST['protocol_academic_type']){?> <select name="protocol_academic_type" id="dropdown" class="form-control required">
   <option value="" selected="selected">&nbsp;Select from list</option>
   <option value="Bachelors" <?php if($rstudy['protocol_academic_type']=='Diploma' || $_POST['protocol_academic_type']=='Diploma'){?>selected="selected"<?php }?>>&nbsp;Diploma</option>
<option value="Bachelors" <?php if($rstudy['protocol_academic_type']=='Bachelors' || $_POST['protocol_academic_type']=='Bachelors'){?>selected="selected"<?php }?>>&nbsp;Bachelors</option>
<option value="Bachelors Fellowship" <?php if($rstudy['protocol_academic_type']=='Bachelors Fellowship' || $_POST['protocol_academic_type']=='Bachelors Fellowship'){?>selected="selected"<?php }?>>&nbsp;Bachelors Fellowship</option>

<option value="Masters" <?php if($rstudy['protocol_academic_type']=='Masters' || $_POST['protocol_academic_type']=='Masters'){?>selected="selected"<?php }?>>&nbsp;Masters</option>

<option value="Masters Fellowship" <?php if($rstudy['protocol_academic_type']=='Masters Fellowship'){?>selected="selected"<?php }?>>&nbsp;Masters Fellowship</option>

<option value="PHD" <?php if($rstudy['protocol_academic_type']=='PHD' || $_POST['protocol_academic_type']=='PHD'){?>selected="selected"<?php }?>>&nbsp;PHD</option>
<option value="PHD Fellowship" <?php if($rstudy['protocol_academic_type']=='PHD Fellowship' || $_POST['protocol_academic_type']=='PHD Fellowship'){?>selected="selected"<?php }?>>&nbsp;PHD Fellowship</option>

<option value="Post-Doctoral Fellowship" <?php if($rstudy['protocol_academic_type']=='Post-Doctoral Fellowship' || $_POST['protocol_academic_type']=='Post-Doctoral Fellowship'){?>selected="selected"<?php }?>>&nbsp;Post-Doctoral Fellowship</option>

<option value="Post-Doctoral Studies" <?php if($rstudy['protocol_academic_type']=='Post-Doctoral Studies' || $_POST['protocol_academic_type']=='Post-Doctoral Studies'){?>selected="selected"<?php }?>>&nbsp;Post-Doctoral Studies</option>
                </select><?php }?></div>

<?php 

$sqlProtocol="SELECT *,DATE_FORMAT(`created`,'%Y-%m-%d') AS created FROM ".$prefix."protocol where `owner_id`='$asrmApplctID' and id='$id' order by id desc limit 0,1";
$QueryProtocol = $mysqli->query($sqlProtocol);
$rstudyProtocol=$QueryProtocol->fetch_array();

?>

<?php if(strlen($rstudyProtocol['attachacadimcpaper'])>=5){?>
<a href="./cfxdownload.php?act=<?php echo $rstudyProtocol['id'];?>" target="_blank">Academic/admission letter</a>
<?php }?><br />

<?php if($rstudyProtocol['antiplagiarism']){?>
<a href="./cfxdownload.php?act=<?php echo $rstudyProtocol['id'];?>" target="_blank">Anti-plagiarism Check</a>
<?php }?>
<?php /*?><?php if($rstudy['protocol_academic_type']){?>
<p>Attachment Academic/admission letter</p>
<input name="attachacadimcpaper" type="file" id="attachacadimcpaper"/>
<?php }?><?php */?>

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
                <option value="<?php echo $TCat['rstug_categoryID'];?>" <?php if($TCat['rstug_categoryID']==$rstudy['clinical_trial_type'] || $_POST['clinical_trial_type']==$TCat['rstug_categoryID']){?>selected="selected"<?php }?>>&nbsp;<?php echo $TCat['rstug_categoryName'];?></option>
<?php }?>
                </select>
                        
<label class="col-sm-4 form-control-label">Is the study a clinical trial? <span class="error">*</span></label>

<input name="is_clinical_trial" type="radio" value="1" class="required" <?php if($rstudy['is_clinical_trial']=='1'){?>checked="checked"<?php }?> /> Yes &nbsp;<input name="is_clinical_trial" type="radio" value="0" class="required" <?php if($rstudy['is_clinical_trial']=='0'){?>checked="checked"<?php }?>required/> No<br />  <!--onChange="getClinicalTrial(this.value)"!--> 
  <div id="clinical">
  
 <?php if($rstudy['is_clinical_trial']=='0'){?>
 <label class="col-sm-2 form-control-label">Choose Category<span class="error">*</span></label>

 
<select name="clinical_trial_type" id="dropdown" class="form-control required" required>
   <option value="" selected="selected">&nbsp;Select from list</option>
<?php
$qRCat="select * from apvr_categories where publish='Yes' order by rstug_categoryName asc";
$RCat = $mysqli->query($qRCat);
while($TCat = $RCat->fetch_array()){
?>
                <option value="<?php echo $TCat['rstug_categoryID'];?>" <?php if($TCat['rstug_categoryID']==$rstudy['clinical_trial_type'] || $_POST['clinical_trial_type']==$rstudy['clinical_trial_type']){?>selected="selected"<?php }?>>&nbsp;<?php echo $TCat['rstug_categoryName'];?></option>
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
<input name="drug_related_clinical_trial" type="radio" value="Yes" class="required" <?php if($rstudy['drug_related_clinical_trial']=='Yes' || $_POST['drug_related_clinical_trial']=='Yes'){?>checked="checked"<?php }?> required/> Yes &nbsp;
                          
<input name="drug_related_clinical_trial" type="radio" value="No" class="required" <?php if($rstudy['drug_related_clinical_trial']=='No' || $_POST['drug_related_clinical_trial']=='No'){?>checked="checked"<?php }?> required/> No<br />
                          
</div>
</div>

<div class="form-group row success">

<!--<div class="tooltip"><b style="color:#093;">View Comments</b>
    <span class="tooltiptext">Enter Existing Reference Number</span>
  </div>-->
<label class="col-sm-7 form-control-label">Is the study 'nested' to an existing study? <span class="error">*</span></label>

<div class="col-sm-6">
<input name="independentstudy" type="radio" value="Yes" class="required" <?php if($rstudy['independentstudy']=='Yes' || $_POST['independentstudy']=='Yes'){?>checked="checked"<?php }?> required  onChange="getIndependentStudy(this.value)"/> Yes &nbsp;
                          
<input name="independentstudy" type="radio" value="No" class="required" <?php if($rstudy['independentstudy']=='No' || $_POST['independentstudy']=='No'){?>checked="checked"<?php }?> required  onChange="getIndependentStudy(this.value)"/> No<br />

  
  <?php if($rstudy['independentstudy_refNo'] || $_POST['independentstudy_refNo']){?>
  <label class="col-sm- form-control-label">Enter Existing Reference Number: <span class="error">*</span></label>
  <input type="text" name="independentstudy_refNo" id="vvv" tabindex="4" class="required" style="border:1px solid #ffffff;width:230px;background:#ffffff;padding:5px;" autocomplete="off" value="<?php if($rstudy['independentstudy_refNo']){echo $rstudy['independentstudy_refNo'];}else{echo $_POST['independentstudy_refNo'];}?>"/>
  

   <?php }else {?><div id="independentdiv"></div>  <?php }?>
  
                     
</div>
</div>





   <?php /*?><?php */?>


<div class="line"></div>
     
                    
                    
                        
                        
                         <div class="form-group row success">
                          <label class="col-sm-2 form-control-label">Project Title: <span class="error">*</span></label>
                          <div class="col-sm-10">
                            <input type="text" name="title" class="form-control  required" value="<?php if(!$rstudy['public_title']){echo $_POST['title'];}else{ echo $rstudy['public_title'];}?>" autocomplete="off" id="title" required>
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
<option value="<?php echo $rClinicalcv2['id'];?>" <?php if($rClinicalcv2['id']==$rstudy['recAffiliated_id'] || $_POST['recAffiliated_id']==$rClinicalcv2['id']){?>selected="selected"<?php }?>><?php echo $rClinicalcv2['name'];?></option>
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

<option value="Expedited Review" <?php if($rstudy['type_of_review']=='Expedited Review' || $_POST['type_of_review']=='Expedited Review'){?>selected="selected"<?php }?>>Expedited Review</option>
<option value="Regular Review" <?php if($rstudy['type_of_review']=='Regular Review' || $_POST['type_of_review']=='Regular Review'){?>selected="selected"<?php }?>>Regular Review</option>

<option value="Fast Track" <?php if($rstudy['type_of_review']=='Fast Track' || $_POST['type_of_review']=='Fast Track'){?>selected="selected"<?php }?>>Fast Track</option>
<option value="Exempt" <?php if($rstudy['type_of_review']=='Exempt'|| $_POST['type_of_review']=='Exempt'){?>selected="selected"<?php }?>>Exempt</option>
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