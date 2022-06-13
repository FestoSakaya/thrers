<?php
session_start(); error_reporting(1);
require_once('contrlrcn/c_mlsrcontrol.php');
$timestamp=date("Ymdhsi");//xlsx
/**/header('Content-Type: application/octet-stream');
header("Content-Type: application/force-download");
header("Content-Type: application/x-msdownload");
header("Content-Disposition: attachment; filename=".$timestamp.".xls");
header("Pragma: no-cache");
header("Expires: 0");
?>

<table border="1" align="center" style="width:50%;">

<tr>
<th style="background:#796AEE; color:#FFFFFF; height:20px;">Protocol ID</th>
<th style="background:#796AEE; color:#FFFFFF; height:20px;">REC submitted to</th>	
<th style="background:#796AEE; color:#FFFFFF; height:20px;">Study Type</th>
<th style="background:#796AEE; color:#FFFFFF; height:20px;">Study Design</th>
<th style="background:#796AEE; color:#FFFFFF; height:20px;">Submission Date</th>
<th style="background:#796AEE; color:#FFFFFF; height:20px;">Comments at Completion check?(Y/N)</th>
<th style="background:#796AEE; color:#FFFFFF; height:20px;">Date Comments sent to Researcher</th>
<th style="background:#796AEE; color:#FFFFFF; height:20px;">Response Date</th>
<th style="background:#796AEE; color:#FFFFFF; height:20px;">Protocol Review Date</th>
<th style="background:#796AEE; color:#FFFFFF; height:20px;">Protocol Review Type</th>
<th style="background:#796AEE; color:#FFFFFF; height:20px;">Protocol Review Comments? (Y/N)</th>
<th style="background:#796AEE; color:#FFFFFF; height:20px;">Protocol Comment Type</th>
<th style="background:#796AEE; color:#FFFFFF; height:20px;">Date Protocol Comments sent to Researcher</th>
<th style="background:#796AEE; color:#FFFFFF; height:20px;">Protocol Comments Response Date</th>
<th style="background:#796AEE; color:#FFFFFF; height:20px;">Protocol Approval Date</th>
<th style="background:#796AEE; color:#FFFFFF; height:20px;">Ammendment (Y/N)</th>
<th style="background:#796AEE; color:#FFFFFF; height:20px;">Ammendment Submission Date</th>
<th style="background:#796AEE; color:#FFFFFF; height:20px;">Ammendment comments? (Y/N)</th>
<th style="background:#796AEE; color:#FFFFFF; height:20px;">Date Ammendment comments sent to Researcher</th>
<th style="background:#796AEE; color:#FFFFFF; height:20px;">Date of Investigator Response to Ammendments</th>
<th style="background:#796AEE; color:#FFFFFF; height:20px;">Ammendment Approval Date</th>
<th style="background:#796AEE; color:#FFFFFF; height:20px;">SAEs? (Y/N)</th>
<th style="background:#796AEE; color:#FFFFFF; height:20px;">Date of SAE</th>
<th style="background:#796AEE; color:#FFFFFF; height:20px;">SAE Submission Date</th>
<th style="background:#796AEE; color:#FFFFFF; height:20px;">Protocol Deviation or Violation? (Y/N)</th>
<th style="background:#796AEE; color:#FFFFFF; height:20px;">Date of Protocol Deviation or Violation</th>
<th style="background:#796AEE; color:#FFFFFF; height:20px;">Date of submission of Protocol Deviation or Violation</th>
<th style="background:#796AEE; color:#FFFFFF; height:20px;">Notificatiof Expiry (Y/N)</th>
<th style="background:#796AEE; color:#FFFFFF; height:20px;">Date of Notificatiof Expiry</th>
<th style="background:#796AEE; color:#FFFFFF; height:20px;">REC/UNCST Motoring Visits(Y/N)</th>
<th style="background:#796AEE; color:#FFFFFF; height:20px;">Monitoring Visit Date</th>
<th style="background:#796AEE; color:#FFFFFF; height:20px;">Date Monitoring Report sent</th>
<th style="background:#796AEE; color:#FFFFFF; height:20px;">Date of Response to Monitoring Report</th>
<th style="background:#796AEE; color:#FFFFFF; height:20px;">Close out Reports submission (Y/N)</th>
<th style="background:#796AEE; color:#FFFFFF; height:20px;">Close out Reports submission Date</th>
<th style="background:#796AEE; color:#FFFFFF; height:20px;">REC Acknowledgment of receipt date</th>
</tr>

<?php

$rquery = $mysqli->query("select *,DATE_FORMAT(`updated`,'%d/%m/%Y') AS datesubmitted from ".$prefix."submission where status='Approved' order by id desc");
while ($results = $rquery->fetch_array()){//and worked_on='No' 
	$owner_id=$results['owner_id'];
$main_submission_id=$results['id'];
$sqlSRR = "select * from ".$prefix."user where asrmApplctID='$owner_id'";
$resultSSS = $mysqli->query($sqlSRR);
$sqUserdd = $resultSSS->fetch_array();

$sqlprotocol = "select *,DATE_FORMAT(`decision_in`,'%d/%m/%Y') AS decision_in,DATE_FORMAT(`revised_in`,'%d/%m/%Y') AS revised_in from ".$prefix."protocol where id='$main_submission_id' and owner_id='$owner_id' order by id desc";
$resultprotocol = $mysqli->query($sqlprotocol);
$sqprotocol = $resultprotocol->fetch_array();	

if($sqprotocol['revised_in']!='0000-00-00 00:00:00'){$comnetsat_completeness="Yes";}else{$comnetsat_completeness="No";}


if($sqprotocol['revised_in']!='0000-00-00 00:00:00'){$Date_Comments_sent_to_Researcher=$sqprotocol['revised_in'];}else{}
if($sqprotocol['decision_in']!='0000-00-00 00:00:00'){$ResponseDate=$sqprotocol['decision_in'];}else{}



////Get REC
$recAffiliated_id=$results['recAffiliated_id'];
$clinical_trial_type=$results['clinical_trial_type'];

$sqlSRREC = "select * from ".$prefix."list_rec_affiliated where id='$recAffiliated_id'";
$resultSSSREC = $mysqli->query($sqlSRREC);
$sqUserddRREC = $resultSSSREC->fetch_array();
//is_clinical_trial

$sqlSRREC2 = "select * from ".$prefix."categories where rstug_categoryID='$clinical_trial_type'";
$resultSSSREC2 = $mysqli->query($sqlSRREC2);
$sqUserddRREC2 = $resultSSSREC2->fetch_array();


//Date comments sent to researcher

$sqlconditional = "select * from ".$prefix."initial_committee_screening where protocol_id='$main_submission_id' and owner_id='$owner_id' and screeningFor='protocol' and collectiveDecision='Yes' order by id desc limit 0,1";
$queryconditional = $mysqli->query($sqlconditional);
$sqconditional = $queryconditional->fetch_array();
$totalConditional = $queryconditional->num_rows;

if($totalConditional>=1){$Protocol_review_comments="Yes";}else{$Protocol_review_comments="No";}

////Protocol Review Date
$sqlPcomments2 = "select * from ".$prefix."completeness_check_comments where protocol_id='$main_submission_id' and owner_id='$owner_id' order by id desc limit 0,1";
$resultCommentsp2 = $mysqli->query($sqlPcomments2);
$sqCommentsp2 = $resultCommentsp2->fetch_array();
$protocol_review_date=$sqCommentsp2['chdate'];

$diff=date( "Y-m-d H:m:s", strtotime($protocol_review_date . "-2 day"));
	
$Protocol_comment_type=$sqconditional['screening'];
if($protocol_review_date){
	//if($sqprotocol['revised_in']!='0000-00-00 00:00:00'){
	//echo "It was revised<br>";
	
	$Date_Comments_sent_to_Researcherm=$sqprotocol['revised_in'];
/*$sqlupdateSm_protocol="update ".$prefix."protocol set Comments_at_Completion='Yes',Date_Comments_sent_to_Researcher='$Date_Comments_sent_to_Researcherm',worked_on='Yes' where id='$main_submission_id' and owner_id='$owner_id'";*/
$sqlupdateSm_protocol="update ".$prefix."protocol set comments_response_date='$diff',protocol_review_date='$protocol_review_date' where id='$main_submission_id' and owner_id='$owner_id'";
//$mysqli->query($sqlupdateSm_protocol);

$sqlupdateSm_protocolmm="update ".$prefix."submission set worked_on='Yes' where id='$main_submission_id' and owner_id='$owner_id'";
//$mysqli->query($sqlupdateSm_protocolmm);

}else{
	//echo "Not Revised<br>";
$sqlupdateSm_protocol2="update ".$prefix."protocol set Comments_at_Completion='No',Date_Comments_sent_to_Researcher='',worked_on='Yes' where id='$main_submission_id' and owner_id='$owner_id'";
//$mysqli->query($sqlupdateSm_protocol2);

$sqlupdateSm_protocolmm="update ".$prefix."submission set worked_on='Yes' where id='$main_submission_id' and owner_id='$owner_id'";
//$mysqli->query($sqlupdateSm_protocolmm);

}

/////////////completeness check protocol
$sqlPcommentsp = "select * from ".$prefix."submission_archive where id='$main_submission_id' and owner_id='$owner_id' order by id desc limit 0,1";
$resultCommentsp = $mysqli->query($sqlPcommentsp);
$sqCommentsp = $resultCommentsp->fetch_array();
$totalCompleteness = $resultCommentsp->num_rows;


$date_comments_at_completeness_check=$sqCommentsp['date_of_action'];





//study_approvals

$sqlconditional2 = "select * from ".$prefix."study_approvals where rstug_rsch_project_id='$main_submission_id' and rstug_user_id='$owner_id' order by id desc";
$resultconditional2 = $mysqli->query($sqlconditional2);
$sqconditional2 = $resultconditional2->fetch_array();
$protocol_approval_date=$sqconditional2['DateApproved'];


///ammendments
$sqlAmendment = "select * from ".$prefix."ammendments where protocol_id='$main_submission_id' and owner_id='$owner_id' order by id desc";
$resultAmendment = $mysqli->query($sqlAmendment);
$totalAmendment = $resultAmendment->num_rows;
$sqAmendment = $resultAmendment->fetch_array();
if($totalAmendment){$Amendments="Yes";}else{$Amendments="No";}

$Amendments_submissionDate=$sqAmendment['created'];
$DateofInvestigator_Responseto_Ammendments=$sqAmendment['dateofammed_response'];
///completeness check ammendmnets
$sqlAmendment2 = "select * from ".$prefix."completeness_check_comments_amendment where protocol_id='$main_submission_id' and owner_id='$owner_id' and status='Rejected' order by id desc limit 0,1";
$resultAmendment2 = $mysqli->query($sqlAmendment2);
$totalAmendment2 = $resultAmendment2->num_rows;
$sqAmendment2 = $resultAmendment2->fetch_array();
if($totalAmendment2){$Amendments_comment="Yes";}else{$Amendments_comment="No";}
$Date_Ammendment_Researcher=$sqAmendment2['chdate'];

//Approved
$sqlAmendment3 = "select * from ".$prefix."study_post_approvals where rstug_rsch_project_id='$main_submission_id' and rstug_user_id='$owner_id' order by id desc limit 0,1";
$resultAmendment3 = $mysqli->query($sqlAmendment3);
$totalAmendment3 = $resultAmendment3->num_rows;
$sqAmendment3 = $resultAmendment3->fetch_array();
$Ammendmnet_approvalDate=$sqAmendment3['DateApproved'];

///SAEs
$sqlSAE = "select * from ".$prefix."saes where protocol_id='$main_submission_id' and owner_id='$owner_id' order by id desc limit 0,1";
$resultSAE = $mysqli->query($sqlSAE);
$totalSAE = $resultSAE->num_rows;
$sqSAE = $resultSAE->fetch_array();
if($totalSAE){$SAE="Yes";}else{$SAE="No";}
$SAEDATE=$sqSAE['datesubmitted'];
$DateOfAdmission=$sqSAE['DateOfAdmission'];
//Protocol Deviation
$sqlDeiation = "select * from ".$prefix."deviations where protocol_id='$main_submission_id' and owner_id='$owner_id' order by deviationID desc limit 0,1";
$resultDeiation = $mysqli->query($sqlDeiation);
$totalDeiation = $resultDeiation->num_rows;
$sqDeiation = $resultDeiation->fetch_array();

if($totalDeiation){$devition="Yes";}else{$devition="No";}
$DeviationDate=$sqDeiation['updatedon'];
$PDDateofoccurrence=$sqDeiation['PDDateofoccurrence'];

//Noticication of expiry notifications
$sqlNotification = "select * from ".$prefix."notifications where protocol_id='$main_submission_id' and owner_id='$owner_id' order by id desc limit 0,1";
$resultNotification = $mysqli->query($sqlNotification);
$totalNotification = $resultNotification->num_rows;
$sqNotification = $resultNotification->fetch_array();
if($totalNotification){$Notification="Yes";}else{$Notification="No";}
$DateofNotification=$sqNotification['created'];
///Annual Report
$sqlMonitoring = "select * from ".$prefix."monitoring_reports where protocol_id='$main_submission_id' and owner_id='$owner_id' order by id desc limit 0,1";
$resultMonitoring = $mysqli->query($sqlMonitoring);
$totalMonitoring = $resultMonitoring->num_rows;
$sqMonitoring = $resultMonitoring->fetch_array();

if($totalMonitoring){$MonitoringVisit="Yes";}else{$MonitoringVisit="No";}
$MonitoringVisitDate=$sqMonitoring['docDate'];
$date_report_sent=$sqMonitoring['date_report_sent'];
$date_ofmonitoring_response=$sqMonitoring['date_ofmonitoring_response'];

//////////Closeout
$sqlCloseout = "select * from ".$prefix."final_reports where protocol_id='$main_submission_id' and owner_id='$owner_id' order by id desc limit 0,1";
$resultCloseout = $mysqli->query($sqlCloseout);
$totalCloseout = $resultCloseout->num_rows;
$sqCloseout = $resultCloseout->fetch_array();

if($totalCloseout){$closeoutreport="Yes";}else{$closeoutreport="No";}
$closeoutreport_date=$sqCloseout['created'];
$recaknoldgement_date=$sqCloseout['approved_date'];
/**/


if($sqprotocol['decision_in']!='0000-00-00 00:00:00'){$decision_in=$sqprotocol['decision_in'];}//Protocol Approval Date
if($sqprotocol['revised_in']!='0000-00-00 00:00:00'){$revised_in=$sqprotocol['revised_in'];}

if($sqprotocol['updated']!='0000-00-00 00:00:00'){$response_Date=$sqprotocol['updated'];}

if($sqprotocol['Comments_at_Completion']=='Yes'){$comments_response_date=$sqprotocol['comments_response_date'];}

if($sqprotocol['Comments_at_Completion']=='Yes'){$Date_Comments_sent_to_Researcher2=$sqprotocol['Date_Comments_sent_to_Researcher'];}

echo "<tr>";
////Five
echo "<td>".$results['code']."</td>";//.'code:'.$main_submission_id
echo "<td>".$sqUserddRREC['name']."</td>";
echo "<td>".$sqUserddRREC2['rstug_categoryName']."</td>";
echo "<td>".$results['study_design']."</td>";//
echo "<td>".$results['created']."</td>";
echo "<td>".$sqprotocol['Comments_at_Completion']."</td>";//comments at c-check$date_comments_at_completeness_check 


echo "<td>".$Date_Comments_sent_to_Researcher2."</td>";

echo "<td>".$comments_response_date."</td>";//Response Date
echo "<td>".$sqprotocol['protocol_review_date']."</td>";
echo "<td>".$results['type_of_review']."</td>";


echo "<td>".$Protocol_review_comments."</td>";//Protocol review comments
echo "<td>".$Protocol_comment_type."</td>";//Not yet protocol comment type

echo "<td>".$sqprotocol['protocol_review_date']."</td>";//Date Protocol Comments sent to Researcher $Date_Comments_sent_to_Researcher
echo "<td>".$ResponseDate."</td>";
echo "<td>".$protocol_approval_date."</td>";///Approval Date

echo "<td>".$Amendments."</td>";//Ammendment (Y/N)
echo "<td>".$Amendments_submissionDate."</td>";//Ammendment Submission Date
echo "<td>".$Amendments_comment."</td>";//Ammendment comments? (Y/N)
echo "<td>".$Date_Ammendment_Researcher."</td>";//Date Ammendment comments sent to Researcher
echo "<td>".$DateofInvestigator_Responseto_Ammendments."</td>";//Date of Investigator Response to Ammendments

echo "<td>".$Ammendmnet_approvalDate."</td>";//Ammendment Approval Date
echo "<td>".$SAE."</td>";//SAEs? (Y/N)
echo "<td>".$DateOfAdmission."</td>";//Date of SAE
echo "<td>".$SAEDATE."</td>";//SAE Submission Date
echo "<td>".$devition."</td>";
echo "<td>".$PDDateofoccurrence."</td>";
echo "<td>".$DeviationDate."</td>";
echo "<td>".$Notification."</td>";
echo "<td>".$DateofNotification."</td>";
echo "<td>".$MonitoringVisit."</td>";

echo "<td>".$MonitoringVisitDate."</td>";
echo "<td>".$date_report_sent."</td>";
echo "<td>".$date_ofmonitoring_response."</td>";
echo "<td>".$closeoutreport."</td>";
echo "<td>".$closeoutreport_date."</td>";
echo "<td>".$recaknoldgement_date."</td>";




echo "</tr>";

}


echo "</table>";
?>
