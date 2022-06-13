<?php

if($_POST['doSaveBudget']=='Save and Next' and $id and $_POST['primary_sponsor']){

	$description=$mysqli->real_escape_string($_POST['description']);
	$quantity=$mysqli->real_escape_string($_POST['quantity']);
	$sasrmApplctID=$mysqli->real_escape_string($_POST['asrmApplctID']);
	$protocol_id=$mysqli->real_escape_string($_POST['protocol_id']);
	$unit_cost=$mysqli->real_escape_string($_POST['unit_cost']);
	
$sqlInvestigators="SELECT * FROM ".$prefix."research_project_expenditure where `rstug_user_id`='$sasrmApplctID' and rstug_rsch_project_id='$protocol_id' order by rstug_expenditure_id desc";
	$QueryInvestigators = $mysqli->query($sqlInvestigators);
	$totalInvestigators = $QueryInvestigators->num_rows;
	
		if(!$totalInvestigators){


$Insert_QR5="insert into ".$prefix."research_project_expenditure (`rstug_rsch_project_id`,`rstug_user_id`,`rstug_personnel_year1`,`rstug_personnel_year2`,`rstug_personnel_year3`,`rstug_personnel_year4`,`rstug_personnel_year5`,`rstug_personnel_total`,`rstug_travel_year1`,`rstug_travel_year2`,`rstug_travel_year3`,`rstug_travel_year4`,`rstug_travel_year5`,`rstug_travel_total`,`rstug_materials_year1`,`rstug_materials_year2`,`rstug_materials_year3`,`rstug_materials_year4`,`rstug_materials_year5`,`rstug_materials_total`,`rstug_adminstration_year1`,`rstug_adminstration_year2`,`rstug_adminstration_year3`,`rstug_adminstration_year4`,`rstug_adminstration_year5`,`rstug_adminstration_total`,`rstug_results_year1`,`rstug_results_year2`,`rstug_results_year4`,`rstug_results_year5`,`rstug_results_year3`,`rstug_results_total`,`rstug_other_year1`,`rstug_other_year2`,`rstug_other_year3`,`rstug_other_year4`,`rstug_other_year5`,`rstug_other_total`,`rstug_contigency_year1`,`rstug_contigency_year2`,`rstug_contigency_year3`,`rstug_contigency_year4`,`rstug_contigency_year5`,`rstug_contigency_total`,`rstug_reimbursement_year1`,`rstug_reimbursement_year2`,`rstug_reimbursement_year3`,`rstug_reimbursement_year4`,`rstug_reimbursement_year5`,`rstug_reimbursement_total`,`rstug_expd_process_status`,`projm_status`) values ('$protocol_id','$sasrmApplctID','$_POST[pyr1]','$_POST[pyr2]','$_POST[pyr3]','$_POST[pyr4]','$_POST[pyr5]','$_POST[personel]','$_POST[tr1]','$_POST[tr2]','$_POST[tr3]','$_POST[tr4]','$_POST[tr5]','$_POST[travel]','$_POST[mtr1]','$_POST[mtr2]','$_POST[mtr3]','$_POST[mtr4]','$_POST[mtr5]','$_POST[materials]','$_POST[tradm1]','$_POST[tradm2]','$_POST[tradm3]','$_POST[tradm4]','$_POST[tradm5]','$_POST[administration]','$_POST[rstr1]','$_POST[rstr2]','$_POST[rstr3]','$_POST[rstr4]','$_POST[rstr5]','$_POST[results]','$_POST[troth1]','$_POST[troth2]','$_POST[troth3]','$_POST[troth4]','$_POST[troth5]','$_POST[other]','$_POST[trcon1]','$_POST[trcon2]','$_POST[trcon3]','$_POST[trcon4]','$_POST[trcon5]','$_POST[contingency]','$_POST[reimbursement1]','$_POST[reimbursement2]','$_POST[reimbursement3]','$_POST[reimbursement4]','$_POST[reimbursement5]','$_POST[reimbursement]','Completed','closed')";
$mysqli->query($Insert_QR5);

///////////////////////local table
$Insert_QR5Local="insert into ".$prefix."research_project_expenditure_local (`rstug_rsch_project_id`,`rstug_user_id`,`rstug_personnel_year1`,`rstug_personnel_year2`,`rstug_personnel_year3`,`rstug_personnel_year4`,`rstug_personnel_year5`,`rstug_personnel_total`,`rstug_travel_year1`,`rstug_travel_year2`,`rstug_travel_year3`,`rstug_travel_year4`,`rstug_travel_year5`,`rstug_travel_total`,`rstug_materials_year1`,`rstug_materials_year2`,`rstug_materials_year3`,`rstug_materials_year4`,`rstug_materials_year5`,`rstug_materials_total`,`rstug_adminstration_year1`,`rstug_adminstration_year2`,`rstug_adminstration_year3`,`rstug_adminstration_year4`,`rstug_adminstration_year5`,`rstug_adminstration_total`,`rstug_results_year1`,`rstug_results_year2`,`rstug_results_year4`,`rstug_results_year5`,`rstug_results_year3`,`rstug_results_total`,`rstug_other_year1`,`rstug_other_year2`,`rstug_other_year3`,`rstug_other_year4`,`rstug_other_year5`,`rstug_other_total`,`rstug_contigency_year1`,`rstug_contigency_year2`,`rstug_contigency_year3`,`rstug_contigency_year4`,`rstug_contigency_year5`,`rstug_contigency_total`,`rstug_reimbursement_year1`,`rstug_reimbursement_year2`,`rstug_reimbursement_year3`,`rstug_reimbursement_year4`,`rstug_reimbursement_year5`,`rstug_reimbursement_total`,`rstug_expd_process_status`,`projm_status`) values ('$protocol_id','$sasrmApplctID','$_POST[pyrlocal1]','$_POST[pyrlocal2]','$_POST[pyrlocal3]','$_POST[pyrlocal4]','$_POST[pyrlocal5]','$_POST[personellocal]','$_POST[trlocal1]','$_POST[trlocal2]','$_POST[trlocal3]','$_POST[trlocal4]','$_POST[trlocal5]','$_POST[travellocal]','$_POST[mtrlocal1]','$_POST[mtrlocal2]','$_POST[mtrlocal3]','$_POST[mtrlocal4]','$_POST[mtrlocal5]','$_POST[materialslocal]','$_POST[tradmlocal1]','$_POST[tradmlocal2]','$_POST[tradmlocal3]','$_POST[tradmlocal4]','$_POST[tradmlocal5]','$_POST[administrationlocal]','$_POST[rstrlocal1]','$_POST[rstrlocal2]','$_POST[rstrlocal3]','$_POST[rstrlocal4]','$_POST[rstrlocal5]','$_POST[resultslocal]','$_POST[trothlocal1]','$_POST[trothlocal2]','$_POST[trothlocal3]','$_POST[trothlocal4]','$_POST[trothlocal5]','$_POST[otherlocal]','$_POST[trconlocal1]','$_POST[trconlocal2]','$_POST[trconlocal3]','$_POST[trconlocal4]','$_POST[trconlocal5]','$_POST[contingencylocal]','$_POST[reimbursementlocal1]','$_POST[reimbursementlocal2]','$_POST[reimbursementlocal3]','$_POST[reimbursementlocal4]','$_POST[reimbursementlocal5]','$_POST[reimbursementlocal]','Completed','closed')";
$mysqli->query($Insert_QR5Local);

$user_inserted_id = $mysqli->insert_id;

//Insert into Submission Stages
$wm="select * from ".$prefix."submission_stages where  owner_id='$sasrmApplctID' and protocol_id='$protocol_id' and status='new'";
$cmdwb = $mysqli->query($wm);
$totalStages = $cmdwb->num_rows;
$r= $cmdwb->fetch_array();
if($totalStages and $_POST['pyrlocal1']>=1 and $_POST['mtrlocal1']>=1 and $_POST['tradmlocal1']>=1){
$sqlASubmissionStages="update ".$prefix."submission_stages  set `budget`='1' where `owner_id`='$sasrmApplctID' and `protocol_id`='$protocol_id'";
$mysqli->query($sqlASubmissionStages);
}
if($totalStages and $_POST['pyrlocal1']==0 || $_POST['mtrlocal1']==0 || $_POST['tradmlocal1']==0){
$sqlASubmissionStages="update ".$prefix."submission_stages  set `budget`='0' where `owner_id`='$sasrmApplctID' and `protocol_id`='$protocol_id'";
$mysqli->query($sqlASubmissionStages);
}



		}


if($totalInvestigators){
	
	
	$Insert_QR5="update ".$prefix."research_project_expenditure set `rstug_rsch_project_id`='$protocol_id',`rstug_personnel_year1`='$_POST[pyr1]',`rstug_personnel_year2`='$_POST[pyr2]',`rstug_personnel_year3`='$_POST[pyr3]',`rstug_personnel_year4`='$_POST[pyr4]',`rstug_personnel_year5`='$_POST[pyr5]',`rstug_personnel_total`='$_POST[personel]',`rstug_travel_year1`='$_POST[tr1]',`rstug_travel_year2`='$_POST[tr2]',`rstug_travel_year3`='$_POST[tr3]',`rstug_travel_year4`='$_POST[tr4]',`rstug_travel_year5`='$_POST[tr5]',`rstug_travel_total`='$_POST[travel]',`rstug_materials_year1`='$_POST[mtr1]',`rstug_materials_year2`='$_POST[mtr2]',`rstug_materials_year3`='$_POST[mtr3]',`rstug_materials_year4`='$_POST[mtr4]',`rstug_materials_year5`='$_POST[mtr5]',`rstug_materials_total`='$_POST[materials]',`rstug_adminstration_year1`='$_POST[tradm1]',`rstug_adminstration_year2`='$_POST[tradm2]',`rstug_adminstration_year3`='$_POST[tradm3]',`rstug_adminstration_year4`='$_POST[tradm4]',`rstug_adminstration_year5`='$_POST[tradm5]',`rstug_adminstration_total`='$_POST[administration]',`rstug_results_year1`='$_POST[rstr1]',`rstug_results_year2`='$_POST[rstr2]',`rstug_results_year3`='$_POST[rstr3]',`rstug_results_year4`='$_POST[rstr4]',`rstug_results_year5`='$_POST[rstr5]',`rstug_results_total`='$_POST[results]',`rstug_other_year1`='$_POST[troth1]',`rstug_other_year2`='$_POST[troth2]',`rstug_other_year3`='$_POST[troth3]',`rstug_other_year4`='$_POST[troth4]',`rstug_other_year5`='$_POST[troth5]',`rstug_other_total`='$_POST[other]',`rstug_contigency_year1`='$_POST[trcon1]',`rstug_contigency_year2`='$_POST[trcon2]',`rstug_contigency_year3`='$_POST[trcon3]',`rstug_contigency_year4`='$_POST[trcon4]',`rstug_contigency_year5`='$_POST[trcon5]',`rstug_contigency_total`='$_POST[contingency]',`rstug_reimbursement_year1`='$_POST[reimbursement1]',`rstug_reimbursement_year2`='$_POST[reimbursement2]',`rstug_reimbursement_year3`='$_POST[reimbursement3]',`rstug_reimbursement_year4`='$_POST[reimbursement4]',`rstug_reimbursement_year5`='$_POST[reimbursement5]',`rstug_reimbursement_total`='$_POST[reimbursement]' where `rstug_user_id`='$sasrmApplctID' and rstug_rsch_project_id='$protocol_id'";
$mysqli->query($Insert_QR5);
//update local
$Insert_QR5Local="update ".$prefix."research_project_expenditure_local set `rstug_rsch_project_id`='$protocol_id',`rstug_personnel_year1`='$_POST[pyrlocal1]',`rstug_personnel_year2`='$_POST[pyrlocal2]',`rstug_personnel_year3`='$_POST[pyrlocal3]',`rstug_personnel_year4`='$_POST[pyrlocal4]',`rstug_personnel_year5`='$_POST[pyrlocal5]',`rstug_personnel_total`='$_POST[personellocal]',`rstug_travel_year1`='$_POST[trlocal1]',`rstug_travel_year2`='$_POST[trlocal2]',`rstug_travel_year3`='$_POST[trlocal3]',`rstug_travel_year4`='$_POST[trlocal4]',`rstug_travel_year5`='$_POST[trlocal5]',`rstug_travel_total`='$_POST[travellocal]',`rstug_materials_year1`='$_POST[mtrlocal1]',`rstug_materials_year2`='$_POST[mtrlocal2]',`rstug_materials_year3`='$_POST[mtrlocal3]',`rstug_materials_year4`='$_POST[mtrlocal4]',`rstug_materials_year5`='$_POST[mtrlocal5]',`rstug_materials_total`='$_POST[materialslocal]',`rstug_adminstration_year1`='$_POST[tradmlocal1]',`rstug_adminstration_year2`='$_POST[tradmlocal2]',`rstug_adminstration_year3`='$_POST[tradmlocal3]',`rstug_adminstration_year4`='$_POST[tradmlocal4]',`rstug_adminstration_year5`='$_POST[tradmlocal5]',`rstug_adminstration_total`='$_POST[administrationlocal]',`rstug_results_year1`='$_POST[rstrlocal1]',`rstug_results_year2`='$_POST[rstrlocal2]',`rstug_results_year3`='$_POST[rstrlocal3]',`rstug_results_year4`='$_POST[rstrlocal4]',`rstug_results_year5`='$_POST[rstrlocal5]',`rstug_results_total`='$_POST[resultslocal]',`rstug_other_year1`='$_POST[trothlocal1]',`rstug_other_year2`='$_POST[trothlocal2]',`rstug_other_year3`='$_POST[trothlocal3]',`rstug_other_year4`='$_POST[trothlocal4]',`rstug_other_year5`='$_POST[trothlocal5]',`rstug_other_total`='$_POST[otherlocal]',`rstug_contigency_year1`='$_POST[trconlocal1]',`rstug_contigency_year2`='$_POST[trconlocal2]',`rstug_contigency_year3`='$_POST[trconlocal3]',`rstug_contigency_year4`='$_POST[trconlocal4]',`rstug_contigency_year5`='$_POST[trconlocal5]',`rstug_contigency_total`='$_POST[contingencylocal]',`rstug_reimbursement_year1`='$_POST[reimbursementlocal1]',`rstug_reimbursement_year2`='$_POST[reimbursementlocal2]',`rstug_reimbursement_year3`='$_POST[reimbursementlocal3]',`rstug_reimbursement_year4`='$_POST[reimbursementlocal4]',`rstug_reimbursement_year5`='$_POST[reimbursementlocal5]',`rstug_reimbursement_total`='$_POST[reimbursementlocal]' where `rstug_user_id`='$sasrmApplctID' and rstug_rsch_project_id='$protocol_id'";
$updated=$mysqli->query($Insert_QR5Local);

//Insert into Submission Stages
$wm="select * from ".$prefix."submission_stages where  owner_id='$sasrmApplctID' and protocol_id='$protocol_id' and status='new'";
$cmdwb = $mysqli->query($wm);
$totalStages = $cmdwb->num_rows;
$r= $cmdwb->fetch_array();
if($totalStages and $_POST['pyrlocal1']>=1 and $_POST['mtrlocal1']>=1 and $_POST['tradmlocal1']>=1){
$sqlASubmissionStages="update ".$prefix."submission_stages  set `budget`='1' where `owner_id`='$sasrmApplctID' and `protocol_id`='$protocol_id'";
$mysqli->query($sqlASubmissionStages);
}
if($totalStages and $_POST['pyrlocal1']==0 || $_POST['mtrlocal1']==0 || $_POST['tradmlocal1']==0){
$sqlASubmissionStages="update ".$prefix."submission_stages  set `budget`='0' where `owner_id`='$sasrmApplctID' and `protocol_id`='$protocol_id'";
$mysqli->query($sqlASubmissionStages);
}
///Now add budget to researh

}
if(!$user_inserted_id){
$message='<li class="red"><span class="ico"></span><strong class="system_title">Budget details were not saved</strong></li>';
}


if($user_inserted_id || $updated){
	$funding_source=$mysqli->real_escape_string($_POST['funding_source']);
	$primary_sponsor=$mysqli->real_escape_string($_POST['primary_sponsor']);
	$secondary_sponsor=$mysqli->real_escape_string($_POST['secondary_sponsor']);
	$submission_id=$mysqli->real_escape_string($_POST['submission_id']);
    $sasrmApplctID=$mysqli->real_escape_string($_POST['asrmApplctID']);
	
		$PrimarySponsorCountry=$mysqli->real_escape_string($_POST['PrimarySponsorCountry']);
	$PrimarySponsorInstitution=$mysqli->real_escape_string($_POST['PrimarySponsorInstitution']);
	$SecondarySponsorCountry=$mysqli->real_escape_string($_POST['SecondarySponsorCountry']);
	$SecondarySponsorInstitution=$mysqli->real_escape_string($_POST['SecondarySponsorInstitution']);
	
$sqlA2Protocol="update ".$prefix."submission  set `funding_source`='$funding_source',`primary_sponsor`='$primary_sponsor',`secondary_sponsor`='$secondary_sponsor',`PrimarySponsorCountry`='$PrimarySponsorCountry',`PrimarySponsorInstitution`='$PrimarySponsorInstitution',`SecondarySponsorCountry`='$SecondarySponsorCountry',`SecondarySponsorInstitution`='$SecondarySponsorInstitution' where id='$submission_id' and owner_id='$sasrmApplctID'";
$mysqli->query($sqlA2Protocol);

$message='<p class="success">Dear '.$session_fullname.', details have been submitted, proceed to continue</p>';
logaction("$session_fullname updated protocol");

	//update edited table...
$sqlURevisions="SELECT * FROM ".$prefix."updated_sections where `owner_id`='$sasrmApplctID' and protocol_id='$submission_id' and status='pending' order by id desc limit 0,1";
$QueryUserRevions = $mysqli->query($sqlURevisions);
$totalUsersRevions = $QueryUserRevions->num_rows;
if(!$totalUsersRevions){
$sqlAREvisedSections="insert into ".$prefix."updated_sections (`owner_id`,`protocol_id`,`protocol_information`,`protocol_team`,`protocol_details`,`study_description`,`RecruitmentCountries`,`registry`,`budget`,`study_work_plan`,`bibliography`,`attachments`,`payments`,`study_population`,`dateupdated`,`status`) 

values('$sasrmApplctID','$submission_id','','','','','','','1','','','','','',now(),'pending')";
$mysqli->query($sqlAREvisedSections);
}
if($totalUsersRevions){

$sqlAREvisedSections_update="update ".$prefix."updated_sections  set `budget`='1' where owner_id='$sasrmApplctID' and protocol_id='$submission_id' and status='pending'";
$mysqli->query($sqlAREvisedSections_update);	
}/////////////////end updated sections

echo '<img src="images/loading_wait.gif">';
echo '<div class="spacer"></div>';
echo '<meta http-equiv="REFRESH" content="0;url='.$base_url.'/main.php?option=submissionScheduleUp&id='.$id.'">';
}
}

$sqlstudy="SELECT * FROM ".$prefix."submission where `owner_id`='$asrmApplctID' and id='$id'  order by id desc limit 0,1";
$Querystudy = $mysqli->query($sqlstudy);
$totalstudy = $Querystudy->num_rows;
$rstudy = $Querystudy->fetch_array();
$protocol_id=$rstudy['protocol_id'];
//submission_stages
$sqlSub_Stages="SELECT * FROM ".$prefix."submission_stages where `owner_id`='$asrmApplctID' and protocol_id='$protocol_id' and status='new' order by id desc limit 0,1";
$QuerySub_stages = $mysqli->query($sqlSub_Stages);
$totalSub_Stages = $QuerySub_stages->num_rows;
$rsSubStages = $QuerySub_stages->fetch_array();
?>
<?php include("viewlrcn/final_button.php");?>
<ul id="countrytabs" class="shadetabs">
<?php if($totalstudy>=1){?><li><a href="./main.php?option=submissionCheck&id=<?php echo $rstudy['id'];?>"  <?php if($rsSubStages['protocol_information']==1 and $rsSubStages['protocol_team']==1){?> style="background:green; color:#FFF;" <?php }?>>Protocol Information</a></li><?php }?>
<?php if(!$totalstudy){?><li class="extra"  <?php if($rsSubStages['protocol_information']==1 and $rsSubStages['protocol_team']==1){?> style="background:green; color:#FFF;" <?php }?>>Protocol Information</li><?php }?>

<?php if($totalstudy>=1){?><li><a href="./main.php?option=submissionSecondUp&id=<?php echo $rstudy['id'];?>" <?php if($rsSubStages['protocol_details']==1){?> style="background:green; color:#FFF;" <?php }?>>Protocol Details</a></li><?php }?>
<?php if(!$totalstudy){?><li class="extra" <?php if($rsSubStages['protocol_details']==1){?> style="background:green; color:#FFF;" <?php }?>>Protocol Details</li><?php }?>

<?php if($totalstudy>=1){?><li><a href="./main.php?option=submissionThirdUp&id=<?php echo $rstudy['id'];?>" <?php if($rsSubStages['study_description']==1 and $rsSubStages['RecruitmentCountries']==1){?> style="background:green; color:#FFF;" <?php }?>>Study Description</a></li><?php }?>
<?php if(!$totalstudy){?><li class="extra" <?php if($rsSubStages['study_description']==1 and $rsSubStages['RecruitmentCountries']==1){?> style="background:green; color:#FFF;" <?php }?>>Study Description</li><?php }?>

<?php if($totalstudy>=1){?><li><a href="./main.php?option=StudyPopulationUp&id=<?php echo $rstudy['id'];?>" <?php if($rsSubStages['study_population']==1){?> style="background:green; color:#FFF;" <?php }?>>Study Population</a></li><?php }?>
<?php if(!$totalstudy){?><li class="extra" <?php if($rsSubStages['study_population']==1){?> style="background:green; color:#FFF;" <?php }?>>Study Population</li><?php }?>

<?php if($rstudy['is_clinical_trial']==1){?>
<?php if($totalstudy>=1){?><li><a href="./main.php?option=submissionFourUp&id=<?php echo $rstudy['id'];?>" <?php if($rsSubStages['registry']==1){?> style="background:green; color:#FFF;" <?php }?>>Registry</a></li><?php }?>
<?php if(!$totalstudy){?><li class="extra" <?php if($rsSubStages['registry']==1){?> style="background:green; color:#FFF;" <?php }?>>Registry</li><?php }}?>

<li><a href="#" rel="#default" class="selected" <?php if($rsSubStages['budget']==1){?> style="background:green; color:#FFF;" <?php }?>>Budget</a></li>

<?php if($totalstudy>=1){?><li><a href="./main.php?option=submissionScheduleUp&id=<?php echo $rstudy['id'];?>" <?php if($rsSubStages['study_work_plan']==1){?> style="background:green; color:#FFF;" <?php }?>>Study Work Plan</a></li><?php }?>
<?php if(!$totalstudy){?><li class="extra" <?php if($rsSubStages['study_work_plan']==1){?> style="background:green; color:#FFF;" <?php }?>>Study Work Plan</li><?php }?>

<?php /*?><?php if($totalstudy>=1){?><li><a href="./main.php?option=submissionFive&id=<?php echo $rstudy['id'];?>/"<?php if($rsSubStages['bibliography']==1){?> style="background:green; color:#FFF;" <?php }?>>Bibliography</a></li><?php }?>
<?php if(!$totalstudy){?><li class="extra"<?php if($rsSubStages['bibliography']==1){?> style="background:green; color:#FFF;" <?php }?>>Bibliography</li><?php }?><?php */?>

<?php if($totalstudy>=1){?><li><a href="./main.php?option=submissionSixUp&id=<?php echo $rstudy['id'];?>" <?php if($rsSubStages['filem']==1){?> style="background:green; color:#FFF;" <?php }?>>Attached Files</a></li><?php }?>
<?php if(!$totalstudy){?><li class="extra" <?php if($rsSubStages['filem']==1){?> style="background:green; color:#FFF;" <?php }?>>Attached Files</li><?php }?>

<?php if($totalstudy>=1){?><li><a href="./main.php?option=submissionFinishUp&id=<?php echo $rstudy['id'];?>" <?php if($rsSubStages['payments']==1){?> style="background:green; color:#FFF;" <?php }?>>Payments</a></li><?php }?>
<?php if(!$totalstudy){?><li class="extra" <?php if($rsSubStages['payments']==1){?> style="background:green; color:#FFF;" <?php }?>>Payments</li><?php }?>
</ul>

<div id="countrydivcontainer" style="border:0px solid gray; width:100%; margin-bottom: 1em; padding: 10px">
<?php
$sqlstudym="SELECT * FROM ".$prefix."submission where `owner_id`='$asrmApplctID' and protocol_id='$id' order by id desc limit 0,1";
$Querystudym = $mysqli->query($sqlstudym);
$rstudym = $Querystudym->fetch_array();
$owner_id=$rstudym['owner_id'];

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
                        <h3 class="h4">Protocal Title</h3><small><?php echo $rstudym['public_title'];?></small>
                      </div>
                    </div>
                    <div class="project-date"><span class="hidden-sm-down"><h3 class="h4">Author</h3> <?php echo $sqUserdd['name'];?></span></div>
                  </div>
                  <div class="right-col col-lg-6 d-flex align-items-center">
                    <div class="time"><i class="fa fa-clock-o"></i><h3 class="h4">Updated At</h3> <?php echo $rstudym['updated'];?> </div>
                    <!--<div class="comments"><i class="fa fa-comment-o"></i>20</div>-->
                    <div class="project-progress">
         <?php include("viewlrcn/status_log_resubmit.php");?>


                    </div>
                  </div>
                </div>
              </div>
<script language="JAVASCRIPT">

  <!--

  function addTWD() {

document.regForm.personel.value =
  parseInt(document.regForm.pyr1.value) + parseInt(document.regForm.pyr2.value) + parseInt(document.regForm.pyr3.value) + parseInt(document.regForm.pyr4.value) + parseInt(document.regForm.pyr5.value);


  document.regForm.travel.value =
  parseInt(document.regForm.tr1.value) + parseInt(document.regForm.tr2.value) + parseInt(document.regForm.tr3.value) + parseInt(document.regForm.tr4.value) + parseInt(document.regForm.tr5.value);

document.regForm.materials.value =
  parseInt(document.regForm.mtr1.value) + parseInt(document.regForm.mtr2.value) + parseInt(document.regForm.mtr3.value) + parseInt(document.regForm.mtr4.value) + parseInt(document.regForm.mtr5.value);
  
document.regForm.administration.value =
  parseInt(document.regForm.tradm1.value) + parseInt(document.regForm.tradm2.value) + parseInt(document.regForm.tradm3.value)+ parseInt(document.regForm.tradm4.value)+ parseInt(document.regForm.tradm5.value);
  
document.regForm.results.value =
  parseInt(document.regForm.rstr1.value) + parseInt(document.regForm.rstr2.value) + parseInt(document.regForm.rstr3.value);

document.regForm.other.value =
  parseInt(document.regForm.troth1.value) + parseInt(document.regForm.troth2.value) + parseInt(document.regForm.troth3.value)+ parseInt(document.regForm.troth4.value)+ parseInt(document.regForm.troth5.value);

document.regForm.contingency.value =
  parseInt(document.regForm.trcon1.value) + parseInt(document.regForm.trcon2.value) + parseInt(document.regForm.trcon3.value)+ parseInt(document.regForm.trcon4.value)+ parseInt(document.regForm.trcon5.value);
  
  document.regForm.reimbursement.value =
  parseInt(document.regForm.reimbursement1.value) + parseInt(document.regForm.reimbursement2.value) + parseInt(document.regForm.reimbursement3.value)+ parseInt(document.regForm.reimbursement4.value)+ parseInt(document.regForm.reimbursement5.value);
  
  /////Add local expenditure
  document.regForm.personellocal.value =
  parseInt(document.regForm.pyrlocal1.value) + parseInt(document.regForm.pyrlocal2.value) + parseInt(document.regForm.pyrlocal3.value) + parseInt(document.regForm.pyrlocal4.value) + parseInt(document.regForm.pyrlocal5.value);

  document.regForm.travellocal.value =
  parseInt(document.regForm.trlocal1.value) + parseInt(document.regForm.trlocal2.value) + parseInt(document.regForm.trlocal3.value) + parseInt(document.regForm.trlocal4.value) + parseInt(document.regForm.trlocal5.value);

document.regForm.materialslocal.value =
  parseInt(document.regForm.mtrlocal1.value) + parseInt(document.regForm.mtrlocal2.value) + parseInt(document.regForm.mtrlocal3.value) + parseInt(document.regForm.mtrlocal4.value) + parseInt(document.regForm.mtrlocal5.value);
  
document.regForm.administrationlocal.value =
  parseInt(document.regForm.tradmlocal1.value) + parseInt(document.regForm.tradmlocal2.value) + parseInt(document.regForm.tradmlocal3.value)+ parseInt(document.regForm.tradmlocal4.value)+ parseInt(document.regForm.tradmlocal5.value);
  
document.regForm.resultslocal.value =
  parseInt(document.regForm.rstrlocal1.value) + parseInt(document.regForm.rstrlocal2.value) + parseInt(document.regForm.rstrlocal3.value);

document.regForm.otherlocal.value =
  parseInt(document.regForm.trothlocal1.value) + parseInt(document.regForm.trothlocal2.value) + parseInt(document.regForm.trothlocal3.value)+ parseInt(document.regForm.trothlocal4.value)+ parseInt(document.regForm.trothlocal5.value);

document.regForm.contingencylocal.value =
  parseInt(document.regForm.trconlocal1.value) + parseInt(document.regForm.trconlocal2.value) + parseInt(document.regForm.trconlocal3.value)+ parseInt(document.regForm.trconlocal4.value)+ parseInt(document.regForm.trconlocal5.value);
  
  ////add local
  document.regForm.personellocal.value =
  parseInt(document.regForm.pyrlocal1.value) + parseInt(document.regForm.pyrlocal2.value) + parseInt(document.regForm.pyrlocal3.value) + parseInt(document.regForm.pyrlocal4.value) + parseInt(document.regForm.pyrlocal5.value);

  document.regForm.travellocal.value =
  parseInt(document.regForm.trlocal1.value) + parseInt(document.regForm.trlocal2.value) + parseInt(document.regForm.trlocal3.value) + parseInt(document.regForm.trlocal4.value) + parseInt(document.regForm.trlocal5.value);

document.regForm.materialslocal.value =
  parseInt(document.regForm.mtrlocal1.value) + parseInt(document.regForm.mtrlocal2.value) + parseInt(document.regForm.mtrlocal3.value) + parseInt(document.regForm.mtrlocal4.value) + parseInt(document.regForm.mtrlocal5.value);
  
document.regForm.administrationlocal.value =
  parseInt(document.regForm.tradmlocal1.value) + parseInt(document.regForm.tradmlocal2.value) + parseInt(document.regForm.tradmlocal3.value)+ parseInt(document.regForm.tradmlocal4.value)+ parseInt(document.regForm.tradmlocal5.value);
  
document.regForm.resultslocal.value =
  parseInt(document.regForm.rstrlocal1.value) + parseInt(document.regForm.rstrlocal2.value) + parseInt(document.regForm.rstrlocal3.value);

document.regForm.otherlocal.value =
  parseInt(document.regForm.trothlocal1.value) + parseInt(document.regForm.trothlocal2.value) + parseInt(document.regForm.trothlocal3.value)+ parseInt(document.regForm.trothlocal4.value)+ parseInt(document.regForm.trothlocal5.value);

document.regForm.contingencylocal.value =
  parseInt(document.regForm.trconlocal1.value) + parseInt(document.regForm.trconlocal2.value) + parseInt(document.regForm.trconlocal3.value)+ parseInt(document.regForm.trconlocal4.value)+ parseInt(document.regForm.trconlocal5.value);
  
  document.regForm.reimbursementlocal.value =
  parseInt(document.regForm.reimbursementlocal1.value) + parseInt(document.regForm.reimbursementlocal2.value) + parseInt(document.regForm.reimbursementlocal3.value)+ parseInt(document.regForm.reimbursementlocal4.value)+ parseInt(document.regForm.reimbursementlocal5.value);
  
  
///////////////////////Years Downw Totals.. LOCAL
document.regForm.year1down.value =
  parseInt(document.regForm.pyr1.value) + parseInt(document.regForm.tr1.value) + parseInt(document.regForm.mtr1.value) + parseInt(document.regForm.tradm1.value) + parseInt(document.regForm.rstr1.value) + parseInt(document.regForm.troth1.value) + parseInt(document.regForm.trcon1.value) + parseInt(document.regForm.reimbursement1.value);
 
 document.regForm.year2down.value =
  parseInt(document.regForm.pyr2.value) + parseInt(document.regForm.tr2.value) + parseInt(document.regForm.mtr2.value) + parseInt(document.regForm.tradm2.value) + parseInt(document.regForm.rstr2.value) + parseInt(document.regForm.troth2.value) + parseInt(document.regForm.trcon2.value) + parseInt(document.regForm.reimbursement2.value);
  
  
  document.regForm.year3down.value =
  parseInt(document.regForm.pyr3.value) + parseInt(document.regForm.tr3.value) + parseInt(document.regForm.mtr3.value) + parseInt(document.regForm.tradm3.value) + parseInt(document.regForm.rstr3.value) + parseInt(document.regForm.troth3.value) + parseInt(document.regForm.trcon3.value) + parseInt(document.regForm.reimbursement3.value);
  
  document.regForm.year4down.value =
  parseInt(document.regForm.pyr4.value) + parseInt(document.regForm.tr4.value) + parseInt(document.regForm.mtr4.value) + parseInt(document.regForm.tradm4.value) + parseInt(document.regForm.rstr4.value) + parseInt(document.regForm.troth4.value) + parseInt(document.regForm.trcon4.value) + parseInt(document.regForm.reimbursement4.value);
  
  document.regForm.year5down.value =
  parseInt(document.regForm.pyr5.value) + parseInt(document.regForm.tr5.value) + parseInt(document.regForm.mtr5.value) + parseInt(document.regForm.tradm5.value) + parseInt(document.regForm.rstr5.value) + parseInt(document.regForm.troth5.value) + parseInt(document.regForm.trcon5.value) + parseInt(document.regForm.reimbursement5.value);
  
document.regForm.grandtotal.value =
  parseInt(document.regForm.personel.value) + parseInt(document.regForm.travel.value) + parseInt(document.regForm.materials.value) + parseInt(document.regForm.administration.value) + parseInt(document.regForm.results.value) + parseInt(document.regForm.other.value) + parseInt(document.regForm.contingency.value) + parseInt(document.regForm.reimbursement.value);
  
  /////////////////////////Totals Local 
  document.regForm.yearlocal1down.value =
  parseInt(document.regForm.pyrlocal1.value) + parseInt(document.regForm.trlocal1.value) + parseInt(document.regForm.mtrlocal1.value) + parseInt(document.regForm.tradmlocal1.value) + parseInt(document.regForm.rstrlocal1.value) + parseInt(document.regForm.trothlocal1.value) + parseInt(document.regForm.trconlocal1.value) + parseInt(document.regForm.reimbursementlocal1.value);
 
 document.regForm.yearlocal2down.value =
  parseInt(document.regForm.pyrlocal2.value) + parseInt(document.regForm.trlocal2.value) + parseInt(document.regForm.mtrlocal2.value) + parseInt(document.regForm.tradmlocal2.value) + parseInt(document.regForm.rstrlocal2.value) + parseInt(document.regForm.trothlocal2.value) + parseInt(document.regForm.trconlocal2.value) + parseInt(document.regForm.reimbursementlocal2.value);
  
  
  document.regForm.yearlocal3down.value =
  parseInt(document.regForm.pyrlocal3.value) + parseInt(document.regForm.trlocal3.value) + parseInt(document.regForm.mtrlocal3.value) + parseInt(document.regForm.tradmlocal3.value) + parseInt(document.regForm.rstrlocal3.value) + parseInt(document.regForm.trothlocal3.value) + parseInt(document.regForm.trconlocal3.value) + parseInt(document.regForm.reimbursementlocal3.value);
  
  document.regForm.yearlocal4down.value =
  parseInt(document.regForm.pyrlocal4.value) + parseInt(document.regForm.trlocal4.value) + parseInt(document.regForm.mtrlocal4.value) + parseInt(document.regForm.tradmlocal4.value) + parseInt(document.regForm.rstrlocal4.value) + parseInt(document.regForm.trothlocal4.value) + parseInt(document.regForm.trconlocal4.value) + parseInt(document.regForm.reimbursementlocal4.value);
  
  document.regForm.yearlocal5down.value =
  parseInt(document.regForm.pyrlocal5.value) + parseInt(document.regForm.trlocal5.value) + parseInt(document.regForm.mtrlocal5.value) + parseInt(document.regForm.tradmlocal5.value) + parseInt(document.regForm.rstrlocal5.value) + parseInt(document.regForm.trothlocal5.value) + parseInt(document.regForm.trconlocal5.value) + parseInt(document.regForm.reimbursementlocal5.value);
  
document.regForm.grandTotal2.value =
  parseInt(document.regForm.personellocal.value) + parseInt(document.regForm.travellocal.value) + parseInt(document.regForm.materialslocal.value) + parseInt(document.regForm.administrationlocal.value) + parseInt(document.regForm.resultslocal.value) + parseInt(document.regForm.otherlocal.value) + parseInt(document.regForm.contingencylocal.value) + parseInt(document.regForm.reimbursementlocal.value);
   
  }

  

  //-->

  </script>		     

<?php

if(isset($message)){echo $message;}
?>

<h3>Budget</h3>
 
 
 <?php
$Q_R="select * from ".$prefix."research_project_expenditure where rstug_user_id='$asrmApplctID' and rstug_rsch_project_id='$id' order by rstug_expenditure_id desc";
$QCMD=$mysqli->query($Q_R);
$rS=$QCMD->fetch_array();

 $Q_RLocal="select * from ".$prefix."research_project_expenditure_local where rstug_user_id='$asrmApplctID' and rstug_rsch_project_id='$id' order by rstug_expenditure_id desc";
$QCMDLocal=$mysqli->query($Q_RLocal);
$rSLocal=$QCMDLocal->fetch_array();
?>

<h4> International Expenditure - Research Expenses to be covered outside Uganda</h4>
 
<form action="" method="post" name="regForm" id="regForm"  enctype="multipart/form-data" autocomplete="off">

  

<table border="1" cellspacing="0" cellpadding="0" align="left" width="100%" id="vouchers" class="table success">
  <tr>
    <td width="184" align="center" valign="bottom">&nbsp;</td>
    <td width="187" align="center" valign="bottom"><strong>Year 1<br />
      (US $)</strong></td>
    <td width="152" align="center" valign="bottom"><strong>Year 2<br />
      (US $)</strong></td>
    <td width="154" align="center" valign="bottom"><strong>Year 3<br />
       (US $)</strong></td>
    <td width="154" align="center" valign="bottom"><strong>Year 4<br />
       (US $)</strong></td>
    <td width="154" align="center" valign="bottom"><strong>Year 5<br />
       (US $)</strong></td>
    <td width="154" align="center" valign="bottom"><strong>TOTAL</strong></td>
  </tr>
  <tr>
    <td width="184" align="left" valign="bottom" class="defmf"><strong>Personnel</strong></td>
    <td width="187" align="center" valign="bottom"><input type="text" name="pyr1" id="quantity" tabindex="4" class="required"  onkeyup="addTWD();" value="<?php if($rS['rstug_personnel_year1']){echo $rS['rstug_personnel_year1'];}else{ echo "0";}?>"/></td>
    <td width="152" align="center" valign="bottom"><input type="text" name="pyr2" id="price_unit" tabindex="5" class="number"   onkeyup="addTWD();" value="<?php if($rS['rstug_personnel_year2']){echo $rS['rstug_personnel_year2'];}else{ echo "0";}?>"/></td>
    <td width="154" align="center" valign="bottom"><input type="text" name="pyr3" id="price_unit" tabindex="5" class="number"   onkeyup="addTWD();" value="<?php if($rS['rstug_personnel_year3']){echo $rS['rstug_personnel_year3'];}else{ echo "0";}?>"/></td>
    <td width="154" align="center" valign="bottom"><input type="text" name="pyr4" id="price_unit" tabindex="5" class="number"   onkeyup="addTWD();" value="<?php if($rS['rstug_personnel_year4']){echo $rS['rstug_personnel_year4'];}else{ echo "0";}?>"/></td>
     <td width="154" align="center" valign="bottom"><input type="text" name="pyr5" id="price_unit" tabindex="5" class="number"   onkeyup="addTWD();" value="<?php if($rS['rstug_personnel_year5']){echo $rS['rstug_personnel_year5'];}else{ echo "0";}?>"/></td>
    <td width="154" align="center" valign="bottom"><input type="text" name="personel" id="total" tabindex="7"  value="<?php if($rS['rstug_personnel_total']){echo $rS['rstug_personnel_total'];}else{ echo "0";}?>" class="required number"></td>
  </tr>
  <tr>
    <td width="184" align="left" valign="bottom" class="defmf"><strong>Travel </strong></td>
    <td width="187" align="center" valign="bottom"><input type="text" name="tr1" id="quantity1" tabindex="9"  onkeyup="addTWD();" class="number" value="<?php if($rS['rstug_travel_year1']){echo $rS['rstug_travel_year1'];}else{ echo "0";}?>"/></td>
    <td width="152" align="center" valign="bottom"><input type="text" name="tr2" id="price_unit1" tabindex="10"  onkeyup="addTWD();" class="number" value="<?php if($rS['rstug_travel_year2']){echo $rS['rstug_travel_year2'];}else{ echo "0";}?>"/></td>
    <td width="154" align="center" valign="bottom"><input type="text" name="tr3" id="price_unit1" tabindex="10"  onkeyup="addTWD();" class="number" value="<?php if($rS['rstug_travel_year3']){echo $rS['rstug_travel_year3'];}else{ echo "0";}?>"/></td>
   
   
   <td width="154" align="center" valign="bottom"><input type="text" name="tr4" id="price_unit1" tabindex="10"  onkeyup="addTWD();" class="number" value="<?php if($rS['rstug_travel_year4']){echo $rS['rstug_travel_year4'];}else{ echo "0";}?>"/></td>
   
   <td width="154" align="center" valign="bottom"><input type="text" name="tr5" id="price_unit1" tabindex="10"  onkeyup="addTWD();" class="number" value="<?php if($rS['rstug_travel_year5']){echo $rS['rstug_travel_year5'];}else{ echo "0";}?>"/></td>
   
    <td width="154" align="center" valign="bottom"><input type="text" name="travel" id="total1" tabindex="7" value="<?php if($rS['rstug_travel_total']){echo $rS['rstug_travel_total'];}else{ echo "0";}?>" class="required number"/></td>
  </tr>
  <tr>
    <td width="184" align="left" valign="bottom" class="defmf"><strong>Materials and Supplies</strong></td>
    <td width="187" align="center" valign="bottom"><input type="text" name="mtr1" id="quantity2" tabindex="13"  onkeyup="addTWD();" class="number" value="<?php if($rS['rstug_materials_year1']){echo $rS['rstug_materials_year1'];}else{ echo "0";}?>"/></td>
    
    <td width="152" align="center" valign="bottom"><input type="text" name="mtr2" id="price_unit2" tabindex="14"  onkeyup="addTWD();" class="number" value="<?php if($rS['rstug_materials_year2']){echo $rS['rstug_materials_year2'];}else{ echo "0";}?>"/></td>
    
    <td width="154" align="center" valign="bottom"><input type="text" name="mtr3" id="price_unit2" tabindex="14"  onkeyup="addTWD();" class="number" value="<?php if($rS['rstug_materials_year3']){echo $rS['rstug_materials_year3'];}else{ echo "0";}?>"/></td>
    
    
<td width="154" align="center" valign="bottom"><input type="text" name="mtr4" id="price_unit2" tabindex="14"  onkeyup="addTWD();" class="number" value="<?php if($rS['rstug_materials_year4']){echo $rS['rstug_materials_year4'];}else{ echo "0";}?>"/></td>

<td width="154" align="center" valign="bottom"><input type="text" name="mtr5" id="price_unit2" tabindex="14"  onkeyup="addTWD();" class="number" value="<?php if($rS['rstug_materials_year5']){echo $rS['rstug_materials_year5'];}else{ echo "0";}?>"/></td>

    <td width="154" align="center" valign="bottom"><input type="text" name="materials" id="total2" tabindex="16"  value="<?php if($rS['rstug_materials_total']){echo $rS['rstug_materials_total'];}else{ echo "0";}?>" class="required number"/></td>
  </tr>
  <tr>
    <td width="184" align="left" valign="bottom" class="defmf"><strong>Administration</strong></td>
    <td width="187" align="center" valign="bottom"><input type="text" name="tradm1" id="quantity3" tabindex="18"  onkeyup="addTWD();" class="number" value="<?php if($rS['rstug_adminstration_year1']){echo $rS['rstug_adminstration_year1'];}else{ echo "0";}?>"/></td>
    
    <td width="152" align="center" valign="bottom"><input type="text" name="tradm2" id="price_unit3" tabindex="19"  onkeyup="addTWD();" class="number" value="<?php if($rS['rstug_adminstration_year2']){echo $rS['rstug_adminstration_year2'];}else{ echo "0";}?>"/></td>
    
    <td width="154" align="center" valign="bottom"><input type="text" name="tradm3" id="price_unit3" tabindex="19"  onkeyup="addTWD();" class="number" value="<?php if($rS['rstug_adminstration_year3']){echo $rS['rstug_adminstration_year3'];}else{ echo "0";}?>"/></td>
    
    
 <td width="154" align="center" valign="bottom"><input type="text" name="tradm4" id="price_unit3" tabindex="19"  onkeyup="addTWD();" class="number" value="<?php if($rS['rstug_adminstration_year4']){echo $rS['rstug_adminstration_year4'];}else{ echo "0";}?>"/></td>
 
  <td width="154" align="center" valign="bottom"><input type="text" name="tradm5" id="price_unit3" tabindex="19"  onkeyup="addTWD();" class="number" value="<?php if($rS['rstug_adminstration_year5']){echo $rS['rstug_adminstration_year5'];}else{ echo "0";}?>"/></td>
  
    <td width="154" align="center" valign="bottom"><input type="text" name="administration" id="total3" tabindex="21" value="<?php if($rS['rstug_adminstration_total']){echo $rS['rstug_adminstration_total'];}else{ echo "0";}?>" class="required number"/></td>
  </tr>
  <tr>
    <td width="184" align="left" valign="bottom" class="defmf"><strong>Results dissemination</strong></td>
    <td width="187" align="center" valign="bottom"><input type="text" name="rstr1" id="quantity4" tabindex="21" onkeyup="addTWD();" class="number" value="<?php if($rS['rstug_results_year1']){echo $rS['rstug_results_year1'];}else{ echo "0";}?>"/></td>
    <td width="152" align="center" valign="bottom"><input type="text" name="rstr2" id="price_unit4" tabindex="23"  onkeyup="addTWD();" class="number" value="<?php if($rS['rstug_results_year2']){echo $rS['rstug_results_year2'];}else{ echo "0";}?>"/></td>
    <td width="154" align="center" valign="bottom"><input type="text" name="rstr3" id="price_unit4" tabindex="23"  onkeyup="addTWD();" class="number" value="<?php if($rS['rstug_results_year3']){echo $rS['rstug_results_year3'];}else{ echo "0";}?>"/></td>
    
     <td width="154" align="center" valign="bottom"><input type="text" name="rstr4" id="price_unit4" tabindex="23"  onkeyup="addTWD();" class="number" value="<?php if($rS['rstug_results_year4']){echo $rS['rstug_results_year4'];}else{ echo "0";}?>"/></td>
      <td width="154" align="center" valign="bottom"><input type="text" name="rstr5" id="price_unit4" tabindex="23"  onkeyup="addTWD();" class="number" value="<?php if($rS['rstug_results_year5']){echo $rS['rstug_results_year5'];}else{ echo "0";}?>"/></td>

    <td width="154" align="center" valign="bottom"><input type="text" name="results" id="total4" tabindex="25" value="<?php if($rS['rstug_results_total']){echo $rS['rstug_results_total'];}else{ echo "0";}?>"/></td>
  </tr>
 
  <tr>
    <td width="184" align="left" valign="bottom" class="defmf"><strong>Contingency</strong></td>
    <td width="187" align="center" valign="bottom"><input type="text" name="trcon1" id="quantity6" tabindex="32"  onkeyup="addTWD();" class="number" value="<?php if($rS['rstug_contigency_year1']){echo $rS['rstug_contigency_year1'];}else{ echo "0";}?>"/></td>
    
    <td width="152" align="center" valign="bottom"><input type="text" name="trcon2" id="price_unit6" tabindex="33"  onkeyup="addTWD();" class="number" value="<?php if($rS['rstug_contigency_year2']){echo $rS['rstug_contigency_year2'];}else{ echo "0";}?>"/></td>
    
    <td width="154" align="center" valign="bottom" ><input type="text" name="trcon3" id="price_unit6" tabindex="33"  onkeyup="addTWD();" class="number" value="<?php if($rS['rstug_contigency_year3']){echo $rS['rstug_contigency_year3'];}else{ echo "0";}?>"/></td>
    
    
    <td width="154" align="center" valign="bottom" ><input type="text" name="trcon4" id="price_unit6" tabindex="33"  onkeyup="addTWD();" class="number" value="<?php if($rS['rstug_contigency_year4']){echo $rS['rstug_contigency_year4'];}else{ echo "0";}?>"/></td>
    
    <td width="154" align="center" valign="bottom" ><input type="text" name="trcon5" id="price_unit6" tabindex="33"  onkeyup="addTWD();" class="number" value="<?php if($rS['rstug_contigency_year5']){echo $rS['rstug_contigency_year5'];}else{ echo "0";}?>"/></td>
    
    
    <td width="154" align="center" valign="bottom" ><input type="text" name="contingency" id="total6" tabindex="35" value="<?php if($rS['rstug_contigency_total']){echo $rS['rstug_contigency_total'];}else{ echo "0";}?>"/></td>
  </tr>
  
  
  
 <tr>
    <td width="184" align="left" valign="bottom" class="defmf"><strong>Reimbursement and Time Compensations </strong></td>
    <td width="187" align="center" valign="bottom"><input type="text" name="reimbursement1" id="quantity6" tabindex="32"  onkeyup="addTWD();" class="number" value="<?php if($rS['rstug_reimbursement_year1']){echo $rS['rstug_reimbursement_year1'];}else{ echo "0";}?>"/></td>
    
    <td width="152" align="center" valign="bottom"><input type="text" name="reimbursement2" id="price_unit6" tabindex="33"  onkeyup="addTWD();" class="number" value="<?php if($rS['rstug_reimbursement_year2']){echo $rS['rstug_reimbursement_year2'];}else{ echo "0";}?>"/></td>
    
    <td width="154" align="center" valign="bottom" ><input type="text" name="reimbursement3" id="price_unit6" tabindex="33"  onkeyup="addTWD();" class="number" value="<?php if($rS['rstug_reimbursement_year3']){echo $rS['rstug_reimbursement_year3'];}else{ echo "0";}?>"/></td>
    
    
    <td width="154" align="center" valign="bottom" ><input type="text" name="reimbursement4" id="price_unit6" tabindex="33"  onkeyup="addTWD();" class="number" value="<?php if($rS['rstug_reimbursement_year4']){echo $rS['rstug_reimbursement_year4'];}else{ echo "0";}?>"/></td>
    
    <td width="154" align="center" valign="bottom" ><input type="text" name="reimbursement5" id="price_unit6" tabindex="33"  onkeyup="addTWD();" class="number" value="<?php if($rS['rstug_reimbursement_year5']){echo $rS['rstug_reimbursement_year5'];}else{ echo "0";}?>"/></td>
    
    
    <td width="154" align="center" valign="bottom" ><input type="text" name="reimbursement" id="total6" tabindex="35" value="<?php if($rS['rstug_reimbursement_total']){echo $rS['rstug_reimbursement_total'];}else{ echo "0";}?>"/></td>
  </tr>
  
   <tr>
    <td width="184" align="left" valign="bottom" class="defmf"><strong>Other</strong></td>
    <td width="187" align="center" valign="bottom"><input type="text" name="troth1" id="quantity5" tabindex="27"  onkeyup="addTWD();" class="number" value="<?php if($rS['rstug_other_year1']){echo $rS['rstug_other_year1'];}else{ echo "0";}?>"/></td>
    
    <td width="152" align="center" valign="bottom"><input type="text" name="troth2" id="price_unit5" tabindex="28"  onkeyup="addTWD();" class="number" value="<?php if($rS['rstug_other_year2']){echo $rS['rstug_other_year2'];}else{ echo "0";}?>"/></td>
    
    <td width="154" align="center" valign="bottom"><input type="text" name="troth3" id="price_unit5" tabindex="28"  onkeyup="addTWD();" class="number" value="<?php if($rS['rstug_other_year3']){echo $rS['rstug_other_year3'];}else{ echo "0";}?>"/></td>
    
<td width="154" align="center" valign="bottom"><input type="text" name="troth4" id="price_unit5" tabindex="28"  onkeyup="addTWD();" class="number" value="<?php if($rS['rstug_other_year4']){echo $rS['rstug_other_year4'];}else{ echo "0";}?>"/></td>

<td width="154" align="center" valign="bottom"><input type="text" name="troth5" id="price_unit5" tabindex="28"  onkeyup="addTWD();" class="number" value="<?php if($rS['rstug_other_year5']){echo $rS['rstug_other_year5'];}else{ echo "0";}?>"/></td>

    <td width="154" align="center" valign="bottom"><input type="text" name="other" id="total5" tabindex="30"  value="<?php if($rS['rstug_other_total']){echo $rS['rstug_other_total'];}else{ echo "0";}?>"/></td>
  </tr>
  
<?php
$year1=($rS['rstug_personnel_year1']+$rS['rstug_travel_year1']+$rS['rstug_materials_year1']+$rS['rstug_adminstration_year1']+$rS['rstug_results_year1']+$rS['rstug_other_year1']+$rS['rstug_contigency_year1']+$rS['rstug_reimbursement_year1']);

$year2=($rS['rstug_personnel_year2']+$rS['rstug_travel_year2']+$rS['rstug_materials_year2']+$rS['rstug_adminstration_year2']+$rS['rstug_results_year2']+$rS['rstug_other_year2']+$rS['rstug_contigency_year2']+$rS['rstug_reimbursement_year2']);

$year3=($rS['rstug_personnel_year3']+$rS['rstug_travel_year3']+$rS['rstug_materials_year3']+$rS['rstug_adminstration_year3']+$rS['rstug_results_year3']+$rS['rstug_other_year3']+$rS['rstug_contigency_year3']+$rS['rstug_reimbursement_year3']);

$year4=($rS['rstug_personnel_year4']+$rS['rstug_travel_year4']+$rS['rstug_materials_year4']+$rS['rstug_adminstration_year4']+$rS['rstug_results_year4']+$rS['rstug_other_year4']+$rS['rstug_contigency_year4']+$rS['rstug_reimbursement_year4']);

$year5=($rS['rstug_personnel_year5']+$rS['rstug_travel_year5']+$rS['rstug_materials_year5']+$rS['rstug_adminstration_year5']+$rS['rstug_results_year5']+$rS['rstug_other_year5']+$rS['rstug_contigency_year5']+$rS['rstug_reimbursement_year5']);
?>
 <tr>
    <td width="363" align="left" valign="bottom"><strong>Total</strong></td>
    <td width="143" align="center" valign="bottom">   
    <input type="text" name="year1down" id="total5" tabindex="30"  value="<?php if($year1){echo $year1;}else{ echo "0";}?>"/>
    
    </td>
    <td width="148" align="center" valign="bottom">    
    <input type="text" name="year2down" id="total5" tabindex="30"  value="<?php if($year2){echo $year2;}else{ echo "0";}?>"/>
    </td>
    <td width="169" align="center" valign="bottom" >    
      <input type="text" name="year3down" id="total5" tabindex="30"  value="<?php if($year3){echo $year3;}else{ echo "0";}?>"/>
    
    </td>
    <td width="151" align="center" valign="bottom" >
       <input type="text" name="year4down" id="total5" tabindex="30"  value="<?php if($year4){echo $year4;}else{ echo "0";}?>"/>
    
    
    </td>
    <td width="156" align="center" valign="bottom" >    
       <input type="text" name="year5down" id="total5" tabindex="30"  value="<?php if($year5){echo $year5;}else{ echo "0";}?>"/>
    
    </td>
    <td width="115" align="center" valign="bottom" >
    <?php
	$grandTotal=($rS['rstug_personnel_total']+$rS['rstug_travel_total']+$rS['rstug_materials_total']+$rS['rstug_adminstration_total']+$rS['rstug_results_total']+$rS['rstug_other_total']+$rS['rstug_contigency_total']+$rS['rstug_reimbursement_total']+$rS['rstug_reimbursement_total']);
	?>
	<input type="text" name="grandtotal" id="total5" tabindex="30"  value="<?php if($grandTotal){echo $grandTotal;}else{ echo "0";}?>"/>
	
	<?php
	
	?></b></td>
  </tr>
    <tr>
  
    <td valign="bottom" colspan="7">&nbsp;</td>
  </tr>
</table>









<div class="class" style="clear:both;"></div>
<h4> Local Expenditure - Research Expenses to be covered in Uganda</h4>


<table border="1" cellspacing="0" cellpadding="0" align="left" width="100%" id="vouchers" class="table success">
  <tr>
    <td width="184" align="center" valign="bottom">&nbsp;</td>
    <td width="187" align="center" valign="bottom"><strong>Year 1<br />
      (US $)</strong></td>
    <td width="152" align="center" valign="bottom"><strong>Year 2<br />
      (US $)</strong></td>
    <td width="154" align="center" valign="bottom"><strong>Year 3<br />
       (US $)</strong></td>
    <td width="154" align="center" valign="bottom"><strong>Year 4<br />
       (US $)</strong></td>
    <td width="154" align="center" valign="bottom"><strong>Year 5<br />
       (US $)</strong></td>
    <td width="154" align="center" valign="bottom"><strong>TOTAL</strong></td>
  </tr>
  <tr>
    <td width="184" align="left" valign="bottom" class="defmf"><strong>Personnel <font color="#CC0000">*</font></strong></td>
    <td width="187" align="center" valign="bottom"><input type="text" name="pyrlocal1" id="quantity" tabindex="4" class="required"  onkeyup="addTWD();" value="<?php if($rSLocal['rstug_personnel_year1']){echo $rSLocal['rstug_personnel_year1'];}else{ echo "0";}?>"/>
    
    <input name="rstug_expenditure_id2" type="hidden" value="<?php echo $rSLocal['rstug_expenditure_id'];?>" />
    </td>
    <td width="152" align="center" valign="bottom"><input type="text" name="pyrlocal2" id="price_unit" tabindex="5" class="number required"   onkeyup="addTWD();" value="<?php if($rSLocal['rstug_personnel_year2']){echo $rSLocal['rstug_personnel_year2'];}else{ echo "0";}?>"/></td>
    
    <td width="154" align="center" valign="bottom"><input type="text" name="pyrlocal3" id="price_unit" tabindex="5" class="number required"   onkeyup="addTWD();" value="<?php if($rSLocal['rstug_personnel_year3']){echo $rSLocal['rstug_personnel_year3'];}else{ echo "0";}?>"/></td>
    
    <td width="154" align="center" valign="bottom"><input type="text" name="pyrlocal4" id="price_unit" tabindex="5" class="number required"   onkeyup="addTWD();" value="<?php if($rSLocal['rstug_personnel_year4']){echo $rSLocal['rstug_personnel_year4'];}else{ echo "0";}?>"/></td>
    
     <td width="154" align="center" valign="bottom"><input type="text" name="pyrlocal5" id="price_unit" tabindex="5" class="number required"   onkeyup="addTWD();" value="<?php if($rSLocal['rstug_personnel_year5']){echo $rSLocal['rstug_personnel_year5'];}else{ echo "0";}?>"/></td>
     
    <td width="154" align="center" valign="bottom"><input type="text" name="personellocal" id="total" tabindex="7"  value="<?php if($rSLocal['rstug_personnel_total']){echo $rSLocal['rstug_personnel_total'];}else{ echo "0";}?>" class="required number"/></td>
  </tr>
  <tr>
    <td width="184" align="left" valign="bottom" class="defmf"><strong>Travel</strong></td>
    <td width="187" align="center" valign="bottom"><input type="text" name="trlocal1" id="quantity1" tabindex="9"  onkeyup="addTWD();" class="number" value="<?php if($rSLocal['rstug_travel_year1']){echo $rSLocal['rstug_travel_year1'];}else{ echo "0";}?>"/></td>
    
    <td width="152" align="center" valign="bottom"><input type="text" name="trlocal2" id="price_unit1" tabindex="10"  onkeyup="addTWD();" class="number" value="<?php if($rSLocal['rstug_travel_year2']){echo $rSLocal['rstug_travel_year2'];}else{ echo "0";}?>"/></td>
    
    <td width="154" align="center" valign="bottom"><input type="text" name="trlocal3" id="price_unit1" tabindex="10"  onkeyup="addTWD();" class="number" value="<?php if($rSLocal['rstug_travel_year3']){echo $rSLocal['rstug_travel_year3'];}else{ echo "0";}?>"/></td>
   
   
   <td width="154" align="center" valign="bottom"><input type="text" name="trlocal4" id="price_unit1" tabindex="10"  onkeyup="addTWD();" class="number" value="<?php if($rSLocal['rstug_travel_year4']){echo $rSLocal['rstug_travel_year4'];}else{ echo "0";}?>"/></td>
   
   <td width="154" align="center" valign="bottom"><input type="text" name="trlocal5" id="price_unit1" tabindex="10"  onkeyup="addTWD();" class="number" value="<?php if($rSLocal['rstug_travel_year5']){echo $rSLocal['rstug_travel_year5'];}else{ echo "0";}?>"/></td>
   
    <td width="154" align="center" valign="bottom"><input type="text" name="travellocal" id="total1" tabindex="7" value="<?php if($rSLocal['rstug_travel_total']){echo $rSLocal['rstug_travel_total'];}else{ echo "0";}?>" class="required number"/></td>
  </tr>
  <tr>
    <td width="184" align="left" valign="bottom" class="defmf"><strong>Materials and Supplies <font color="#CC0000">*</font></strong></td>
    <td width="187" align="center" valign="bottom"><input type="text" name="mtrlocal1" id="quantity2" tabindex="13"  onkeyup="addTWD();" class="number required" value="<?php if($rSLocal['rstug_materials_year1']){echo $rSLocal['rstug_materials_year1'];}else{ echo "0";}?>"/></td>
    
    <td width="152" align="center" valign="bottom"><input type="text" name="mtrlocal2" id="price_unit2" tabindex="14"  onkeyup="addTWD();" class="number required" value="<?php if($rSLocal['rstug_materials_year2']){echo $rSLocal['rstug_materials_year2'];}else{ echo "0";}?>"/></td>
    
    <td width="154" align="center" valign="bottom"><input type="text" name="mtrlocal3" id="price_unit2" tabindex="14"  onkeyup="addTWD();" class="number" value="<?php if($rSLocal['rstug_materials_year3']){echo $rSLocal['rstug_materials_year3'];}else{ echo "0";}?>"/></td>
    
    
<td width="154" align="center" valign="bottom"><input type="text" name="mtrlocal4" id="price_unit2" tabindex="14"  onkeyup="addTWD();" class="number required" value="<?php if($rSLocal['rstug_materials_year4']){echo $rSLocal['rstug_materials_year4'];}else{ echo "0";}?>"/></td>

<td width="154" align="center" valign="bottom"><input type="text" name="mtrlocal5" id="price_unit2" tabindex="14"  onkeyup="addTWD();" class="number required" value="<?php if($rSLocal['rstug_materials_year5']){echo $rSLocal['rstug_materials_year5'];}else{ echo "0";}?>"/></td>

    <td width="154" align="center" valign="bottom"><input type="text" name="materialslocal" id="total2" tabindex="16"  value="<?php if($rSLocal['rstug_materials_total']){echo $rSLocal['rstug_materials_total'];}else{ echo "0";}?>" class="required number"/></td>
  </tr>
  <tr>
    <td width="184" align="left" valign="bottom" class="defmf"><strong>Administration <font color="#CC0000">*</font></strong></td>
    <td width="187" align="center" valign="bottom"><input type="text" name="tradmlocal1" id="quantity3" tabindex="18"  onkeyup="addTWD();" class="number required" value="<?php if($rSLocal['rstug_adminstration_year1']){echo $rSLocal['rstug_adminstration_year1'];}else{ echo "0";}?>"/></td>
    
    <td width="152" align="center" valign="bottom"><input type="text" name="tradmlocal2" id="price_unit3" tabindex="19"  onkeyup="addTWD();" class="number required" value="<?php if($rSLocal['rstug_adminstration_year2']){echo $rSLocal['rstug_adminstration_year2'];}else{ echo "0";}?>"/></td>
    
    <td width="154" align="center" valign="bottom"><input type="text" name="tradmlocal3" id="price_unit3" tabindex="19"  onkeyup="addTWD();" class="number required" value="<?php if($rSLocal['rstug_adminstration_year3']){echo $rSLocal['rstug_adminstration_year3'];}else{ echo "0";}?>"/></td>
    
    
 <td width="154" align="center" valign="bottom"><input type="text" name="tradmlocal4" id="price_unit3" tabindex="19"  onkeyup="addTWD();" class="number required" value="<?php if($rSLocal['rstug_adminstration_year4']){echo $rSLocal['rstug_adminstration_year4'];}else{ echo "0";}?>"/></td>
 
  <td width="154" align="center" valign="bottom"><input type="text" name="tradmlocal5" id="price_unit3" tabindex="19"  onkeyup="addTWD();" class="number required" value="<?php if($rSLocal['rstug_adminstration_year5']){echo $rSLocal['rstug_adminstration_year5'];}else{ echo "0";}?>"/></td>
  
    <td width="154" align="center" valign="bottom"><input type="text" name="administrationlocal" id="total3" tabindex="21" value="<?php if($rSLocal['rstug_adminstration_total']){echo $rSLocal['rstug_adminstration_total'];}else{ echo "0";}?>" class="required number"/></td>
  </tr>
  <tr>
    <td width="184" align="left" valign="bottom" class="defmf"><strong>Results dissemination <font color="#CC0000">*</font></strong></td>
    <td width="187" align="center" valign="bottom"><input type="text" name="rstrlocal1" id="quantity4" tabindex="21" onkeyup="addTWD();" class="number required" value="<?php if($rSLocal['rstug_results_year1']){echo $rSLocal['rstug_results_year1'];}else{ echo "0";}?>"/></td>
    
    <td width="152" align="center" valign="bottom"><input type="text" name="rstrlocal2" id="price_unit4" tabindex="23"  onkeyup="addTWD();" class="number required" value="<?php if($rSLocal['rstug_results_year2']){echo $rSLocal['rstug_results_year2'];}else{ echo "0";}?>"/></td>
    
    <td width="154" align="center" valign="bottom"><input type="text" name="rstrlocal3" id="price_unit4" tabindex="23"  onkeyup="addTWD();" class="number required" value="<?php if($rSLocal['rstug_results_year3']){echo $rSLocal['rstug_results_year3'];}else{ echo "0";}?>"/></td>
    
     <td width="154" align="center" valign="bottom"><input type="text" name="rstrlocal4" id="price_unit4" tabindex="23"  onkeyup="addTWD();" class="number required" value="<?php if($rSLocal['rstug_results_year4']){echo $rSLocal['rstug_results_year4'];}else{ echo "0";}?>"/></td>
     
      <td width="154" align="center" valign="bottom"><input type="text" name="rstrlocal5" id="price_unit4" tabindex="23"  onkeyup="addTWD();" class="number required" value="<?php if($rSLocal['rstug_results_year5']){echo $rSLocal['rstug_results_year5'];}else{ echo "0";}?>"/></td>

    <td width="154" align="center" valign="bottom"><input type="text" name="resultslocal" id="total4" tabindex="25" value="<?php if($rSLocal['rstug_results_total']){echo $rSLocal['rstug_results_total'];}else{ echo "0";}?>"/></td>
  </tr>
  
  <tr>
    <td width="184" align="left" valign="bottom" class="defmf"><strong>Contingency</strong></td>
    <td width="187" align="center" valign="bottom"><input type="text" name="trconlocal1" id="quantity6" tabindex="32"  onkeyup="addTWD();" class="number" value="<?php if($rSLocal['rstug_contigency_year1']){echo $rSLocal['rstug_contigency_year1'];}else{ echo "0";}?>"/></td>
    
    <td width="152" align="center" valign="bottom"><input type="text" name="trconlocal2" id="price_unit6" tabindex="33"  onkeyup="addTWD();" class="number" value="<?php if($rSLocal['rstug_contigency_year2']){echo $rSLocal['rstug_contigency_year2'];}else{ echo "0";}?>"/></td>
    
    <td width="154" align="center" valign="bottom" ><input type="text" name="trconlocal3" id="price_unit6" tabindex="33"  onkeyup="addTWD();" class="number" value="<?php if($rSLocal['rstug_contigency_year3']){echo $rSLocal['rstug_contigency_year3'];}else{ echo "0";}?>"/></td>
    
    
    <td width="154" align="center" valign="bottom" ><input type="text" name="trconlocal4" id="price_unit6" tabindex="33"  onkeyup="addTWD();" class="number" value="<?php if($rSLocal['rstug_contigency_year4']){echo $rSLocal['rstug_contigency_year4'];}else{ echo "0";}?>"/></td>
    
    <td width="154" align="center" valign="bottom" ><input type="text" name="trconlocal5" id="price_unit6" tabindex="33"  onkeyup="addTWD();" class="number" value="<?php if($rSLocal['rstug_contigency_year5']){echo $rSLocal['rstug_contigency_year5'];}else{ echo "0";}?>"/></td>
    
    
    <td width="154" align="center" valign="bottom" ><input type="text" name="contingencylocal" id="total6" tabindex="35" value="<?php if($rSLocal['rstug_contigency_total']){echo $rSLocal['rstug_contigency_total'];}else{ echo "0";}?>"/></td>
  </tr>
  
  <tr>
    <td width="184" align="left" valign="bottom" class="defmf"><strong>Reimbursement and Time Compensations </strong></td>
    <td width="187" align="center" valign="bottom"><input type="text" name="reimbursementlocal1" id="quantity6" tabindex="32"  onkeyup="addTWD();" class="number" value="<?php if($rSLocal['rstug_reimbursement_year1']){echo $rSLocal['rstug_reimbursement_year1'];}else{ echo "0";}?>"/></td>
    
    <td width="152" align="center" valign="bottom"><input type="text" name="reimbursementlocal2" id="price_unit6" tabindex="33"  onkeyup="addTWD();" class="number" value="<?php if($rSLocal['rstug_reimbursement_year2']){echo $rSLocal['rstug_reimbursement_year2'];}else{ echo "0";}?>"/></td>
    
    <td width="154" align="center" valign="bottom" ><input type="text" name="reimbursementlocal3" id="price_unit6" tabindex="33"  onkeyup="addTWD();" class="number" value="<?php if($rSLocal['rstug_reimbursement_year3']){echo $rSLocal['rstug_reimbursement_year3'];}else{ echo "0";}?>"/></td>
    
    
    <td width="154" align="center" valign="bottom" ><input type="text" name="reimbursementlocal4" id="price_unit6" tabindex="33"  onkeyup="addTWD();" class="number" value="<?php if($rSLocal['rstug_reimbursement_year4']){echo $rSLocal['rstug_reimbursement_year4'];}else{ echo "0";}?>"/></td>
    
    <td width="154" align="center" valign="bottom" ><input type="text" name="reimbursementlocal5" id="price_unit6" tabindex="33"  onkeyup="addTWD();" class="number" value="<?php if($rSLocal['rstug_reimbursement_year5']){echo $rSLocal['rstug_reimbursement_year5'];}else{ echo "0";}?>"/></td>
    
    
    <td width="154" align="center" valign="bottom" ><input type="text" name="reimbursementlocal" id="total6" tabindex="35" value="<?php if($rSLocal['rstug_reimbursement_total']){echo $rSLocal['rstug_reimbursement_total'];}else{ echo "0";}?>"/></td>
  </tr>
  
  <tr>
    <td width="184" align="left" valign="bottom" class="defmf"><strong>Other</strong></td>
    <td width="187" align="center" valign="bottom"><input type="text" name="trothlocal1" id="quantity5" tabindex="27"  onkeyup="addTWD();" class="number" value="<?php if($rSLocal['rstug_other_year1']){echo $rSLocal['rstug_other_year1'];}else{ echo "0";}?>"/></td>
    
    <td width="152" align="center" valign="bottom"><input type="text" name="trothlocal2" id="price_unit5" tabindex="28"  onkeyup="addTWD();" class="number" value="<?php if($rSLocal['rstug_other_year2']){echo $rSLocal['rstug_other_year2'];}else{ echo "0";}?>"/></td>
    
    <td width="154" align="center" valign="bottom"><input type="text" name="trothlocal3" id="price_unit5" tabindex="28"  onkeyup="addTWD();" class="number" value="<?php if($rSLocal['rstug_other_year3']){echo $rSLocal['rstug_other_year3'];}else{ echo "0";}?>"/></td>
    
<td width="154" align="center" valign="bottom"><input type="text" name="trothlocal4" id="price_unit5" tabindex="28"  onkeyup="addTWD();" class="number" value="<?php if($rSLocal['rstug_other_year4']){echo $rSLocal['rstug_other_year4'];}else{ echo "0";}?>"/></td>

<td width="154" align="center" valign="bottom"><input type="text" name="trothlocal5" id="price_unit5" tabindex="28"  onkeyup="addTWD();" class="number" value="<?php if($rSLocal['rstug_other_year5']){echo $rSLocal['rstug_other_year5'];}else{ echo "0";}?>"/></td>

    <td width="154" align="center" valign="bottom"><input type="text" name="otherlocal" id="total5" tabindex="30"  value="<?php if($rSLocal['rstug_other_total']){echo $rSLocal['rstug_other_total'];}else{ echo "0";}?>"/></td>
  </tr>
<?php
$year11=($rSLocal['rstug_personnel_year1']+$rSLocal['rstug_travel_year1']+$rSLocal['rstug_materials_year1']+$rSLocal['rstug_adminstration_year1']+$rSLocal['rstug_results_year1']+$rSLocal['rstug_other_year1']+$rSLocal['rstug_contigency_year1']+$rSLocal['rstug_reimbursement_year1']);

$year22=($rSLocal['rstug_personnel_year2']+$rSLocal['rstug_travel_year2']+$rSLocal['rstug_materials_year2']+$rSLocal['rstug_adminstration_year2']+$rSLocal['rstug_results_year2']+$rSLocal['rstug_other_year2']+$rSLocal['rstug_contigency_year2']+$rSLocal['rstug_reimbursement_year2']);

$year33=($rSLocal['rstug_personnel_year3']+$rSLocal['rstug_travel_year3']+$rSLocal['rstug_materials_year3']+$rSLocal['rstug_adminstration_year3']+$rSLocal['rstug_results_year3']+$rSLocal['rstug_other_year3']+$rSLocal['rstug_contigency_year3']+$rSLocal['rstug_reimbursement_year3']);

$year44=($rSLocal['rstug_personnel_year4']+$rSLocal['rstug_travel_year4']+$rSLocal['rstug_materials_year4']+$rSLocal['rstug_adminstration_year4']+$rSLocal['rstug_results_year4']+$rSLocal['rstug_other_year4']+$rSLocal['rstug_contigency_year4']+$rSLocal['rstug_reimbursement_year4']);

$year55=($rSLocal['rstug_personnel_year5']+$rSLocal['rstug_travel_year5']+$rSLocal['rstug_materials_year5']+$rSLocal['rstug_adminstration_year5']+$rSLocal['rstug_results_year5']+$rSLocal['rstug_other_year5']+$rSLocal['rstug_contigency_year5']+$rSLocal['rstug_reimbursement_year5']);



?>
<tr>
    <td width="363" align="left" valign="bottom"><strong>Total</strong></td>
    <td width="143" align="center" valign="bottom">   
    <input type="text" name="yearlocal1down" id="total5" tabindex="30"  value="<?php if($year11){echo $year11;}else{ echo "0";}?>"/>
    
    </td>
    <td width="148" align="center" valign="bottom">    
    <input type="text" name="yearlocal2down" id="total5" tabindex="30"  value="<?php if($year22){echo $year22;}else{ echo "0";}?>"/>
    </td>
    <td width="169" align="center" valign="bottom" >    
      <input type="text" name="yearlocal3down" id="total5" tabindex="30"  value="<?php if($year33){echo $year33;}else{ echo "0";}?>"/>
    
    </td>
    <td width="151" align="center" valign="bottom" >
       <input type="text" name="yearlocal4down" id="total5" tabindex="30"  value="<?php if($year44){echo $year44;}else{ echo "0";}?>"/>
    
    
    </td>
    <td width="156" align="center" valign="bottom" >    
       <input type="text" name="yearlocal5down" id="total5" tabindex="30"  value="<?php if($year55){echo $year55;}else{ echo "0";}?>"/>
    
    </td>
    <td width="115" align="center" valign="bottom" >
    <?php
	$grandTotal2=($rSLocal['rstug_personnel_total']+$rSLocal['rstug_travel_total']+$rSLocal['rstug_materials_total']+$rSLocal['rstug_adminstration_total']+$rSLocal['rstug_results_total']+$rSLocal['rstug_other_total']+$rSLocal['rstug_contigency_total']+$rSLocal['rstug_reimbursement_total']);
	?>
	<input type="text" name="grandTotal2" id="total5" tabindex="30"  value="<?php if($grandTotal2){echo $grandTotal2;}else{ echo "0";}?>"/>
	
	<?php
	
	?></b></td>
  </tr>
    <tr>
  
    <td valign="bottom" colspan="7">&nbsp;</td>
  </tr>
</table>

<div class="class" style="clear:both;"></div>





  <div style="clear:both;"></div> 
<div class="form-group row">
                                                   
                            <input name="protocol_id" type="hidden" value="<?php echo $id;?>"/>
                            <input type="hidden" name="asrmApplctID" value="<?php echo $_SESSION['asrmApplctID'];?>">
                            <input type="hidden" name="submission_id" value="<?php echo $rstudy['id'];?>">
                       
                        </div>
                               
                        
                        

                        
                        <div class="line"></div>
                 
<table width="100%" border="0" class=" success">
  <tr>
    <td width="32%">
                          
                          
        <label class="form-control-label">Primary Sponsor: <span class="error">*</span></label>
<input name="primary_sponsor" type="text" class="form-control  required" value="<?php echo $rstudy['primary_sponsor'];?>"/>
          
          
          
                          
                      </td>
    <td width="34%" style="padding-top:12px;"> 
    
<label class="form-control-label">Country: <span class="error">*</span></label>

<select name="PrimarySponsorCountry" id="countryid" class="form-control  required">

<option value="800">Uganda</option>
<?php
$sqlCountrycv = "select * FROM ".$prefix."list_country order by name asc";//and conceptm_status='new' 
$resultCountrycv = $mysqli->query($sqlCountrycv);
while($rCountrycv=$resultCountrycv->fetch_array()){
?>
<option value="<?php echo $rCountrycv['id'];?>" <?php if($rCountrycv['id']==$rstudy['SecondarySponsorCountry']){?>selected="selected"<?php }?>><?php echo $rCountrycv['name'];?></option>
<?php }?>
</select>

</td>
    <td width="34%">
       
        <label class="form-control-label">Institution: <span class="error">*</span></label>
        <input name="PrimarySponsorInstitution" type="text" class="form-control  required" value="<?php echo $rstudy['PrimarySponsorInstitution'];?>"/>
          
          </td>
  </tr>
</table>

                        
                          
                        <div class="line"></div>

                        <table width="100%" border="0" class=" success">
  <tr>
    <td width="32%">
                          
                          
        <label class="form-control-label">Secondary Sponsor:</label>
        <input name="secondary_sponsor" type="text" class="form-control" value="<?php echo $rstudy['secondary_sponsor'];?>"/>
          
          
          
                          
                      </td>
    <td width="34%" style="padding-top:12px;"> 
    
<label class="form-control-label">Country:</label>

<select name="SecondarySponsorCountry" id="countryid" class="form-control">

<option value="800">Uganda</option>
<?php
$sqlCountrycv2 = "select * FROM ".$prefix."list_country order by name asc";//and conceptm_status='new' 
$resultCountrycv2 = $mysqli->query($sqlCountrycv2);
while($rCountrycv2=$resultCountrycv2->fetch_array()){
?>
<option value="<?php echo $rCountrycv2['id'];?>" <?php if($rCountrycv2['id']==$rstudy['SecondarySponsorCountry']){?>selected="selected"<?php }?>><?php echo $rCountrycv2['name'];?></option>
<?php }?>
</select>

</td>
    <td width="34%">
       
        <label class="form-control-label">Institution:</label>
        <input name="SecondarySponsorInstitution" type="text" class="form-control" value="<?php echo $rstudy['SecondarySponsorInstitution'];?>"/>
          
          </td>
  </tr>
</table>  
         
                         
                        
                        <div class="form-group row">
                          <div class="col-sm-4 offset-sm-3">
                    <input name="doSaveBudget" type="submit"  class="btn btn-primary" value="Save and Next"/>

                          </div>
                        </div>
   
   </form>
   

    
    
    

                                     
</div>
