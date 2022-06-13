 <?php
session_start();
require_once('contrlrcn/c_mlsrcontrol.php');
timeout($timeout);
if(!$mysqli->real_escape_string($_SESSION['username']) and !$mysqli->real_escape_string($_SESSION['asrmApplctID']))
{
echo '<meta http-equiv="REFRESH" content="0;url=$base_url">';
	
die;
}
?><!DOCTYPE html>
<html>
  <head>
  <base href="<?php echo $base_url;?>">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $sitename;?></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Google fonts - Roboto -->
    <!--<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,700"> Hidden-->
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="css/style.default.css" id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="css/custom.css">
    <!-- Favicon-->
    <link rel="shortcut icon" href="images/favicon.png">
    <!-- Font Awesome CDN-->
    <!-- you can replace it by local Font Awesome-->
    <!--<script src="https://use.fontawesome.com/99347ac47f.js"></script> Hidden-->
    <!-- Font Icons CSS-->
   <!-- <link rel="stylesheet" href="https://file.myfontastic.com/da58YPMQ7U5HY8Rb6UxkNf/icons.css"> Hidden-->
    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
 <link rel="stylesheet" type="text/css" href="ajaxtabs/ajaxtabs.css" />
<script type="text/javascript" src="ajaxtabs/ajaxtabs.js"></script>

   <!--Begin Word count-->
<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
	<script type="text/javascript" src="js/jquery.inputlimiter.1.3.1.min.js"></script>
	<script type="text/javascript" src="js/word-count.js"></script>
    <link rel="stylesheet" type="text/css" href="js/jquery.inputlimiter.1.0.css" />
    <!--End Word count-->

<!--<script language="JavaScript" type="text/javascript" src="js/jquery-1.3.2.min.js"></script>-->
<script language="JavaScript" type="text/javascript" src="js/jquery.validate.js"></script>

  <script>
  $(document).ready(function(){
    $.validator.addMethod("username", function(value, element) {
        return this.optional(element) || /^[a-z0-9\_]+$/i.test(value);
    }, "Username must contain only letters, numbers, or underscore.");

    $("#regForm").validate();
  });
  
  
  </script>
  <link rel="stylesheet" type="text/css" href="css/tcal.css" />
	<script type="text/javascript" src="js/tcal.js"></script>
    <script type="text/javascript" src="js/ajax.js"></script>

    

    <!--End Word count-->
  </head>
  <body>
    <div class="page home-page">
      <!-- Main Navbar-->
      <header class="header">
        <nav class="navbar">
          <!-- Search Box-->
          <div class="search-box">
            <button class="dismiss"><i class="icon-close"></i></button>
            <form id="searchForm" action="#" role="search">
              <input type="search" placeholder="What are you looking for..." class="form-control">
            </form>
          </div>
          <div class="container-fluid">
            <div class="navbar-holder d-flex align-items-center justify-content-between">
              <!-- Navbar Header-->
              <!--<div class="logogrid"></div>-->
              <div class="navbar-header">
              
              <div class="logogrid"></div>
              

<?php /*?>   <?php if($session_privillage=='investigator'){?>Welcome, <?php echo $session_fullname;?><?php }else{?><div class="logogrid"></div><?php }?><?php */?>          
              </div>
              <!-- Navbar Menu -->
              
              <div class="dropdown">
  <button class="dropbtn">Welcome, <?php echo $session_fullname;?> <i class="fa fa-chevron-down"></i></button>
  <div class="dropdown-content">
  <a href="./main.php?option=MyProfile">My Profile <i class="icon-search"></i></a>
  <a href="signout.php">Logout <i class="fa fa-sign-out"></i></a>
  </div>
</div>
              
              
              <?php /*?><ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center">
                
                <li class="nav-item d-flex align-items-center"><a id="search" href=""> &nbsp;| </a></li>
            
             
                <!-- Logout    -->
                <li class="nav-item"><a href="" class="nav-link logout"></a></li>
              </ul><?php */?>
            </div>
          </div>
        </nav>
      </header>
      <div class="page-content d-flex align-items-stretch">
        <!-- Side Navbar -->
        <nav class="side-navbar">
          <!-- Sidebar Header-->
          <div class="sidebar-header d-flex align-items-center">
            <?php photo(); ?>
          </div>
          <!-- Sidebar Navidation Menus-->
          
          <span class="heading">Main</span>
          
           <?php //SubmissionReview();
		   include("viewlrcn/left_menu.php");?>
     
        </nav>
        <div class="content-inner">
          <!-- Page Header-->
          <header class="page-header">
            <div class="container-fluid">
         <h2 class="no-margin-bottom">   <?php if($session_privillage=='recadmin'){?><?php echo $recName['name'];?> <?php }?>
         
         
         <?php if($session_privillage=='recadmin' || $category=='dashboard' || $category=='Flagged' || $session_privillage=='membercommittee' and $session_privillage!='investigator'){
				 

			 ?>    
         
		 <div class="number flaggedme">        
         <a href="./main.php?option=Flagged">Rejected Protocols <strong  class="blinking">[<?php totalFlaggedProtocols();?>]</strong></a></div>
         
         <div class="number allprotocols">        
         <a href="./main.php?option=allSubmittedProtocols">All Protocols <strong>[<?php TotalSubmissionsAdmin();?>]</strong></a></div>
		 <?php }?>
         
         
            <?php if($session_privillage=='investigator' || $session_privillage=='membercommittee' || $session_privillage=='administrator'){?>Dashboard<?php }?>
            
            <?php if($category=='AnnualRenual' || $category=='AnnualRenualSecond' || $category=='AnnualRenualThird' || $category=='AnnualRenualFour'){?>&raquo;Annual Renual<?php }?></h2>
 
            </div>
          </header>

 <?php if($session_privillage=='administrator' and $category=='dashboard'){include("viewlrcn/dashboard_admin_top.php");}?>
 <?php if($session_privillage=='UHNRO' and $category=='dashboard'){include("viewlrcn/dashboard_admin_top_uhnro.php");}?>
 <?php if($session_privillage=='recadmin' and $category=='dashboard'){include("viewlrcn/dashboard_admin_top_recadmin.php");}?>
 <?php if($session_privillage=='investigator' and $category=='dashboard'){include("viewlrcn/dashboard_admin_top_pi.php");}?>
          <!-- Projects Section-->
          <section class="projects no-padding-top">
            <div class="container-fluid">
            <?php
$pages_list=array(
'dashboard'=>'dashboard_admin',
'Mydashboard'=>'my_dashboard_admin',
'RemoveFromHalted'=>'dashboard_admin',
'AddToHalted'=>'dashboard_admin',
'SuspectedDuplicates'=>'suspected_duplicate_protocols',
'newsubmission'=>'submission_step_one_begin',
'newsubmissionStart'=>'submission_step_one_begin_title',
'submission'=>'submission_step_one',
'editsubmission'=>'edit_submission_step_one',
'Delsubmission'=>'submission_step_one',
'DelInstitution'=>'submission_step_one',
'submissionSecond'=>'about_project_step_two',
'submissionSecondDel'=>'about_project_step_two',
'submissionThird'=>'clinical_study_step_three',
'DelsubmissionThird'=>'clinical_study_step_three',
'StudyPopulation'=>'study_population',
'submissionFour'=>'additional_information_four',
'submissionBudget'=>'budget_information',
'submissionSchedule'=>'schedule_information',
'submissionScheduleDel'=>'schedule_information',
'submissionFive'=>'bibliography_step_five',
'submissionFiveRemove'=>'bibliography_step_five',
'submissionFiveEmpRemove'=>'bibliography_step_five',
'submissionSix'=>'attached_files_step_six',
'submissionSixDel'=>'attached_files_step_six',
'submissionFinish'=>'finish_submission',
'submissionFinishDel'=>'finish_submission',
'GenerateInvoice'=>'finish_submission',

'submissionUpSecond'=>'edit_about_project_step_two',
'submissionUpThird'=>'edit_clinical_study_step_three',
'submissionUpFour'=>'edit_additional_information_four',
'submissionUpBudget'=>'edit_budget_information',
'submissionUpSchedule'=>'edit_schedule_information',
'submissionupFive'=>'edit_bibliography_step_five',
'submissionUpSix'=>'edit_attached_files_step_six',
'submissionupFinish'=>'edit_finish_submission',
'initialCommitteeReview'=>'initial_committee_review',
'initialCommitteeReviews'=>'initial_committee_review_two',
'EndReview'=>'end_review',
'viewsubmission'=>'view_submission',
'viewsubmissionrec'=>'view_submission',
'viewcomments'=>'view_submission',
'faqs'=>'faqs',
'meetings'=>'meetings_view',
'ConductedMeetings'=>'meetings_view',
'DidNotConductMeetings'=>'meetings_view',
'RecinitialCommitteeReview'=>'rec_initial_committee_review',
'recinitialCommitteeReviews'=>'rec_initial_committee_review_two',
'recEndReview'=>'rec_end_review',
'recReviewers'=>'my_rec_reviewers',
'DeActivaterecReviewers'=>'my_rec_reviewers',
'ActivaterecReviewers'=>'my_rec_reviewers',
'DelReviewers'=>'my_rec_reviewers',

'AssignReviewers'=>'assign_reviewers',
'AssignReviewersDel'=>'assign_reviewers',
'ReAssignReviewers'=>'re_assign_reviewers',
'ConfirmPayment'=>'confirm_payment',
'ScheduleMeeting'=>'schedule_meeting',
'recadmins'=>'rec_admins_view',
'recitadmins'=>'rec_it_admins_view',
'recReviewersall'=>'rec_reviewers_all',
'AccreditedRECs'=>'rec_admins_view_all',
'userAccounts'=>'system_user_accounts',
'ClinicalTrials'=>'clinical_trial_names',
'ActivateRec'=>'clinical_trial_names',
'DeActivateRec'=>'clinical_trial_names',
'EditClinicalTrials'=>'edit_clinical_trial_names',
'startapplyamendemnets'=>'amendments_stage_one',
'MyAmmendments'=>'my_ammendmnets',
'ApplyAmmendments'=>'apply_for_ammendmnets',
'ApplyAmmendmentsSec'=>'apply_for_ammendmnets_two',
'ApplyAmmendmentsPay'=>'apply_for_ammendmnets_two_pay',
'ManualAmmendments'=>'manual_ammendmnets',
'ManualAmmendmentsSec'=>'manual_ammendmnets_two',
'ManualAmmendmentsSecPay'=>'manual_ammendmnets_two_pay',
'AnnualRenewal'=>'apply_for_annual_renewal',
'AnnualRenewalTwo'=>'apply_for_annual_renewal_two',

'SAEsManual'=>'saes_stage_one',
'SAEsOnline'=>'saes_submission',
'SAEsManual'=>'saes_submission_manual',
'FinalSubmitSAEs'=>'saes_submission',
'FinalManualSubmitSAEs'=>'saes_submission_manual',
'mysaes'=>'my_saes',
'SAEDel'=>'my_saes',
'viewSAEs'=>'view_sae',

'MyDeviations'=>'my_protocol_deviation',
'FinalSubmitDeviations'=>'apply_for_deviations',
'ChooseDeviationsOnline'=>'deviations_online_application_chosen',


'viewDeviation'=>'edit_deviations',
'MyNotifications'=>'my_notifications',
'Notifications'=>'apply_for_notifications',
'NotificationsBegin'=>'notifications_stage_one',
'ManualNotifications'=>'apply_for_notifications_manual',
'ManualNotificationsProceed'=>'apply_for_notifications_manual_attachments',
'FinalManualnotifications'=>'apply_for_notifications_manual_attachments',

'FinalSubmitnotifications'=>'apply_for_notifications',
'MyFinalReport'=>'my_final_report',
'ApplyFinalReport'=>'apply_final_report_stage_one',
'OnlineFinalReport'=>'apply_final_report_online',
'ManualFinalReport'=>'apply_final_report_manual',
'ManualFinalReportProceed'=>'apply_final_report_manual_attachments',
'FinalRNotificationsOnline'=>'apply_final_report_online',
'OnlineFinalReportProceed'=>'apply_final_report_online_attachments',
'OnlineFinalReportProceedFinal'=>'apply_final_report_online_attachments',
'FinalRNotificationsManual'=>'apply_final_report_manual',


'CommentsSubm'=>'comments_for_me',
'SAnnualRenewals'=>'annual_renewal_stage_one',
'AnnualRenualMa'=>'annual_renewals_dashboard',
'AnnualRenual'=>'annual_renewal_step_one',
'AnnualRenualManual'=>'annual_renewal_step_one_manual',

'AnnualRenualSecond'=>'annual_renewal_step_two',

'AnnualRenualThird'=>'annual_renewal_step_three',
'AnnualRenualFour'=>'annual_renewal_step_four',
'AnnualRenewalPayment'=>'annual_renewal_payment',
'AnnualRenewalPaymentDel'=>'annual_renewal_payment',
'FinalRenewalSubmit'=>'annual_renewal_step_four2',
'viewRenewals'=>'annual_renewals_view_submission_user',
'UpdateUser'=>'update_user_account',
'reusePassword'=>'update_password_admin',
'mswitchaccount'=>'switch_account_main',
'FinalSubmission'=>'make_final_submission',
'createapproval'=>'create_research_account_new',
'switchaccount'=>'switch_account',
'MyProfile'=>'my_profile',
'ChangeMyPassword'=>'my_profile_changepassword',
'ProfilePicture'=>'my_profile_changepicture',
'dashboardDel'=>'dashboard_admin',
'AssignedProtocols'=>'assigned_protocols_per_reviewer',
'DeluserAccounts'=>'system_user_accounts',
'ActivateUser'=>'system_user_accounts',
'DeActivateUser'=>'system_user_accounts',
'ActivateAbstractsUser'=>'system_user_accounts',
'DeActivateAbstractsUser'=>'system_user_accounts',


'ActivateAbstractsAdmin'=>'rec_admins_view',
'DeActivateAbstractsAdmin'=>'rec_admins_view',

'ActivateAdmin'=>'rec_admins_view',
'DeActivateAdmin'=>'rec_admins_view',

'DelAdmin'=>'rec_admins_view',


'MyFinalReportREC'=>'recadmin_my_final_report',
'AnnualRenualMaREC'=>'rec_admin_annual_renewals_dashboard',
'MyAmmendmentsREC'=>'rec_admin_my_ammendmnets',
'AmmendmnetConfirmPayment'=>'ammendmnet_confirm_ayment',
'viewAmmendments'=>'view_ammendments',
'viewAmendmentsComments'=>'amendments_comments',
'DecisionAmmendments'=>'approve_ammendments_view_submission',
'MyNotificationsREC'=>'rec_admin_my_notifications',
'mysaesREC'=>'rec_admin_my_saes',
'MyDeviationsREC'=>'rec_admin_my_protocol_deviation',

'ConfirmRenewalPayment'=>'annual_renewals_view_submission',
'AssignRenewalReviewers'=>'annual_renewals_view_submission',
'AssignRenewalReviewersDel'=>'annual_renewals_view_submission',
'DecisionRenewalReviewers'=>'annual_renewals_view_submission',

'ConfirmAmmendments'=>'ammendments_view_submission',
'ConfirmDeviations'=>'deviations_view_submission',
'DeviationsPayment'=>'deviations_view_submission',
'ConfirmDeviationsFinal'=>'deviations_view_submission',
'ConfirmNotifications'=>'notifications_view_submission',
'ConfirmNotificationsFinal'=>'notifications_view_submission',
'ConfirmCloseoutreport'=>'closeoutreport_view_submission',
'Flagged'=>'flagged_protocols',
'Attendances'=>'attendances',
'MonitoringReports'=>'monitoring_reports',
'CompletenessCheck'=>'completeness_check',
'allSubmittedProtocols'=>'all_submitted_protocols',

'ReviewerMyFinalReport'=>'reviewer_final_report',
'ReviewerAnnualRenualMa'=>'reviewer_annual_renewals',
'ReviewerMyAmmendments'=>'reviewer_ammendments',
'viewRevAmmendments'=>'ammendments_view_reviewer',
'ReviewerMyNotifications'=>'reviewer_notifications',
'Reviewermysaes'=>'reviewer_saes',
'ReviewerMyDeviations'=>'reviewer_deviations',
'ReviewerConflict'=>'reviewer_conflict_of_interest',
'ReviewerAmmendmnets'=>'reviewer_initial_review_ammendmnets',

'Reviewercloseoutreport'=>'reviewer_closeoutreport_view_submission',
'ConfirmSAEs'=>'saes_view_submission',
'ConfirmSAEsFinal'=>'saes_view_submission',
'ReviewerInitialNotifications'=>'reviewer_initial_review_notifications',
'ReviewerInitialSAEs'=>'reviewer_initial_review_saes',
'ReviewerInitialDeviations'=>'reviewer_initial_review_deviations',

'SubmitAbstracts'=>'my_abstracts_publications',
'AddAbstracts'=>'submit_abract_publications',
'abstracts'=>'all_abstracts_publications',
'HaltedStudies'=>'halted_protocols',
'MyHaltedStudies'=>'my_halted_protocols',
'AssignReviewersAppeals'=>'assign_reviewers_appeals',
'MyHaltedStudiesReviewer'=>'reviewer_halted_protocols_for_review',
'HaltedReview'=>'halted_study_committee_review',
'RECRevisions'=>'rec_admin_revisions',
'MyRevisions'=>'my_revisions',
'statistics'=>'all_statistics_page',
'mstatistics'=>'all_statistics_page_superadmin',
'submissionCheck'=>'submission_step_one_completness_check',
'DelsubmissionUp'=>'submission_step_one_completness_check',
'DelInstitutionUp'=>'submission_step_one_completness_check',
'submissionSecondUp'=>'about_project_step_two_completness_check',
'submissionSecondDelUp'=>'about_project_step_two_completness_check',
'submissionThirdUp'=>'clinical_study_step_three_completeness_check',
'StudyPopulationUp'=>'study_population_completeness_check',
'submissionFourUp'=>'additional_information_four_completeness_check',
'submissionBudgetUp'=>'budget_information_completeness_check',
'submissionScheduleUp'=>'schedule_information_completeness_check',
'submissionScheduleDelUp'=>'schedule_information_completeness_check',
'submissionFiveUp'=>'bibliography_step_five_completeness_check',
'submissionFiveRemoveUp'=>'bibliography_step_five_completeness_check',
'submissionFiveEmpRemoveUp'=>'bibliography_step_five_completeness_check',
'submissionSixUp'=>'attached_files_step_six_completeness_check',
'submissionSixDelUp'=>'attached_files_step_six_completeness_check',
'submissionFinishUp'=>'finish_submission_completeness_check',
'submissionFinishDelUp'=>'finish_submission_completeness_check',
'Appeals'=>'appeals_protocols',
'AppealsAdm'=>'appeals_protocols_superadmin',
'Reports'=>'all_reports',
'AllReports'=>'all_reports_superadmin',
'revisionView'=>'view_submission_revision',
'RecinitialCommitteeReviewInitial'=>'annual_renewals_view_submission_reviewer',
'ClosedStudies'=>'closed_studies',
'reviewercomments'=>'reviewer_comments',
'WithdrawSubmission'=>'withdraw_submission',
'AmdCompletenessCheck'=>'completeness_check_amendments',
'AnnualCompletenessCheck'=>'completeness_check_annual_rewal',
'ReverseFinalDecision'=>'reverse_final_decision',
'ReverseAmendmentFinalDecision'=>'reverse_amendment_final_decision',
'ReverseCompCheckDecision'=>'reverse_completeness_check_decision',
'ReverseCompCheckRenewal'=>'reverse_completeness_check_decision_renewal',
'DeviationsStepOne'=>'deviations_stage_one',
'DeviationsManual'=>'deviations_manual_application',
'ChooseDeviationsManual'=>'deviations_manual_application_chosen',

'DeviationsOnline'=>'deviations_online_application',
'AddDevisionReviewers'=>'deviations_view_submission',
'DeviCompletenessCheck'=>'completeness_check_deviations',
'TransferaProtocol'=>'transfer_a_protocol_superadmin',
'TransferProceed'=>'transfer_a_protocol_superadmin_proceed',
'submissionDeletem'=>'all_delete',
'submissionDeletemain'=>'all_delete',
'ReverseFinalDecisionRenewal'=>'reverse_final_decision_renewal',
'WithdrawAmendment'=>'withdraw_amendment',
'Investigators'=>'my_investigators',
'AllowResubmitProtocol'=>'allow_resubmit_protocol',
'ResubmitAllowedProtocol'=>'allow_resubmit_protocol_recadmin',
);

$array_file='viewlrcn/'.$pages_list[$category].".php";
	$array_file=(file_exists($array_file))?$array_file:'viewlrcn/error_pager.php';
//echo $array_file;
		include($array_file);	

?>
            </div>
          </section>
          <!-- Client Section-->

          <!-- Page Footer-->
          <footer class="main-footer">
            <div class="container-fluid">
              <div class="row">
                <div class="col-sm-10">
                  <p>&copy; Uganda National Council for Science and Technology - UNCST, <?php echo date("Y");?>. All rights reserved  | <a href="https://www.uncst.go.ug/terms-and-conditions-of-use/" target="_blank"><strong>Terms and Conditions</strong></a> | <a href="https://www.uncst.go.ug/privacy-policy/" target="_blank"><strong>Privacy Policy</strong></a></p>
                </div>
            
              </div>
            </div>
          </footer>
        </div>
      </div>
    </div>
<?php /*?> <!-- Javascript files-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="js/tether.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.cookie.js"> </script>
    <script src="js/jquery.validate.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
    <script src="js/charts-home.js"></script><?php */?>
    <script src="js/front.js"></script>
    <!-- Google Analytics: change UA-XXXXX-X to be your site's ID.-->
    <!---->
  <!--  <script>
      (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
      function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
      e=o.createElement(i);r=o.getElementsByTagName(i)[0];
      e.src='//www.google-analytics.com/analytics.js';
      r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
      ga('create','UA-XXXXX-X');ga('send','pageview');
    </script>-->
    
    <?php if($category=='CompletenessCheck'){
	
		
		?>
    <button id="myBtnchck">Completeness Check </button>
    
    
    <!-- The Modal -->
<div id="myModal" class="modal" style="margin-top:20px;">

  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
      <span class="close">&times;</span>
      <h3><strong>Completeness Check</strong></h3>
    </div>
    <div class="modal-body" style="height:450px; overflow:scroll; padding:5px;">
 <?php
$qcommentDrafts="select * from ".$prefix."completeness_check_comments where protocol_id='$protocol_idwe' and reviewer_id='$asrmApplctID'";
$rcommentDrafts=$mysqli->query($qcommentDrafts);
$ResultsCommentDrafyts=$rcommentDrafts->fetch_array();?>
<form action="" method="post" name="regForm" id="regForm" autocomplete="false">  
    <!--onChange="getCompleteness(this.value)"
     onChange="getCompleteness(this.value)"
    -->


<!--<div id="completenessdiv"></div>-->

<?php //if($ResultsCommentDrafyts['chcomments']){?>
<textarea name="AssessorComments" cols="10" rows="8" style="width:100%;"><?php //echo $ResultsCommentDrafyts['chcomments'];?></textarea><?php //}?>

<div style="clear:both;"></div>
<input name="status" type="radio" value="Approved" class="required"> Approve &nbsp; <input name="status" type="radio" value="Rejected" class="required"> Reject<br>
<div style="clear:both; padding-bottom:10px;"></div>
<input id="c-signup-submit" name="doSaveCommentsDraft" class="btnLogin" value="Save Comments" type="submit"  tabindex="10" style="float:left;"/>
</form>
    
    </div>
    </div>
    </div>

    <?php }?>
    

<?php if($category=='CompletenessCheck'){?>
<script>
// Get the modal
var modal = document.getElementById('myModal');

// Get the button that opens the modal
var btn = document.getElementById("myBtnchck");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
    modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script><?php }else{?>
<script>
// Get the modal
var modal = document.getElementById('myModal');

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
    modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script><?php }?>

<!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/5b445eaa6d961556373d9099/default';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->


  </body>
</html>