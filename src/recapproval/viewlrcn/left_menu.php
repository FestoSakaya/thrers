<?php photo();?>
<div style="clear:both;"></div>
<?php 
$sqlUserAccess = "SELECT * FROM ".$prefix."user where username='$asrmUserName'";
$queryUserAccess = $mysqli->query($sqlUserAccess);
$raccess = $queryUserAccess->fetch_array();
if($session_privillage=='superadmin'){?>
<ul class="list-unstyled">
<li <?php if($category=='dashboard'){?>class="active"<?php }?>><a href="./main.php?option=dashboard"><i class="icon-interface-windows"></i>Protocols </a> </li>
<li <?php if($category=='AllReports'){?>class="active"<?php }?>><a href="./main.php?option=AllReports"><i class="icon-interface-windows"></i> Reports </a></li>

<li> <a href="./main.php?option=AppealsAdm" <?php if($category=='AppealsAdm'){?>class="active"<?php }?>> <i class="icon-grid"></i>Appeals <span class="round roundred"><?php AppealsAdmin();?></span></a></li>

<li <?php if($category=='mstatistics'){?>class="active"<?php }?>><a href="./main.php?option=mstatistics"><i class="icon-interface-windows"></i> Statistics </a></li>

<li <?php if($category=='meetings'){?>class="active"<?php }?>><a href="./main.php?option=meetings"><i class="icon-interface-windows"></i>Meetings</a></li>

            <li <?php if($category=='faqs'){?>class="active"<?php }?>> <a href="./main.php?option=faqs"> <i class="icon-grid"></i>FAQ </a></li>
            <!--<li> <a href="./main.php?option=dashboard/"> <i class="icon-padnote"></i>Contact </a></li>-->
 <li <?php if($category=='recadmins'){?>class="active"<?php }?>><a href="./main.php?option=recadmins"><i class="icon-grid"></i>REC Admins</a></li>
 <li <?php if($category=='userAccounts'){?>class="active"<?php }?>><a href="./main.php?option=userAccount/"><i class="icon-grid"></i>System Users</a></li>
                <li <?php if($category=='ClinicalTrials'){?>class="active"<?php }?>><a href="./main.php?option=ClinicalTrials"><i class="icon-grid"></i>Accredited RECs</a></li>
                
<li <?php if($category=='abstracts'){?>class="active"<?php }?>><a href="./main.php?option=abstracts"><i class="icon-interface-windows"></i> Abstracts & Publications </a></li>
   

                
<?php /*?> <li><a href="#dashvariantsm" aria-expanded="false" data-toggle="collapse"> <i class="icon-interface-windows"></i>System Management </a>
              <ul id="dashvariantsm" class="collapse list-unstyled">
               
               <!-- <li><a href="./main.php?option=dashboard/">Configurations</a></li>
                <li><a href="./main.php?option=dashboard/">Upload Types</a></li>
                <li><a href="./main.php?option=dashboard/">Upload Extension Types</a></li>-->
              </ul>
            </li><?php */?>
</ul>
<?php }

 if($session_privillage=='UHNRO'){?>
<ul class="list-unstyled">
<li <?php if($category=='dashboard'){?>class="active"<?php }?>><a href="./main.php?option=dashboard"><i class="icon-interface-windows"></i>Protocols </a></li>
                
<li <?php if($category=='abstracts'){?>class="active"<?php }?>><a href="./main.php?option=abstracts"><i class="icon-interface-windows"></i> Abstracts & Publications </a></li>

</ul>
<?php }

if($session_privillage=='administrator'){?>
<ul class="list-unstyled">
<li <?php if($category=='dashboard'){?>class="active"<?php }?>><a href="./main.php?option=dashboard"><i class="icon-interface-windows"></i>Protocols <span class="round bugde"><?php TotalSubmissionsAdmin();?></span></a> </li>

<li <?php if($category=='AllReports'){?>class="active"<?php }?>><a href="./main.php?option=AllReports"><i class="icon-interface-windows"></i> Reports </a></li>
<li <?php if($category=='mstatistics'){?>class="active"<?php }?>><a href="./main.php?option=mstatistics"><i class="icon-interface-windows"></i> Statistics </a></li>
<li> <a href="./main.php?option=AppealsAdm" <?php if($category=='AppealsAdm'){?>class="active"<?php }?>> <i class="icon-grid"></i>Appeals <span class="round roundred"><?php AppealsAdmin();?></span></a></li>



<li <?php if($category=='faqs'){?>class="active"<?php }?>> <a href="./main.php?option=faqs"> <i class="icon-grid"></i>FAQ </a></li>
 <li <?php if($category=='AccreditedRECs'){?>class="active"<?php }?>><a href="./main.php?option=AccreditedRECs"><i class="icon-grid"></i>REC Admins <span class="round bugde"><?php RECAdmins();?></span></a></li>
 
  <li <?php if($category=='recitadmins'){?>class="active"<?php }?>><a href="./main.php?option=recitadmins"><i class="icon-grid"></i>REC IT Admins <span class="round bugde"><?php RECITAdmins();?></span></a></li>

<li <?php if($category=='userAccounts'){?>class="active"<?php }?>><a href="./main.php?option=userAccounts"><i class="icon-grid"></i>System Users <span class="round bugde"><?php RECUsers();?></span></a></li>

<li <?php if($category=='ClinicalTrials'){?>class="active"<?php }?>><a href="./main.php?option=ClinicalTrials"><i class="icon-grid"></i>Accredited RECs <span class="round bugde"><?php AccreditedRECs();?></span></a></li>
 <li <?php if($category=='TransferaProtocol'){?>class="active"<?php }?>><a href="./main.php?option=TransferaProtocol"><i class="icon-interface-windows"></i> Transfer a Protocol </a></li>
 
 <li <?php if($category=='AllowResubmitProtocol'){?>class="active"<?php }?>><a href="./main.php?option=AllowResubmitProtocol"><i class="icon-interface-windows"></i> Allow Resubmit Protocol </a></li>

<?php if($raccess['accessAbstracts']=="Yes"){?>
<li <?php if($category=='abstracts'){?>class="active"<?php }?>><a href="./main.php?option=abstracts"><i class="icon-interface-windows"></i> Abstracts & Publications </a></li><?php }?>
</ul>
<?php }?>
<?php 
if($session_privillage=='investigator'){?>

<ul class="list-unstyled">
<?php 
$sqlstudyFinish="SELECT * FROM ".$prefix."submission where `owner_id`='$asrmApplctID' and status='Approved' order by id desc limit 0,1";
$QuerystudyFinish = $mysqli->query($sqlstudyFinish);
$totalstudyFinish = $QuerystudyFinish->num_rows;
//if($totalstudyFinish){}
?>


<li <?php if($category=='dashboard'){?>class="active"<?php }?>><a href="./main.php?option=dashboard"><i class="icon-interface-windows"></i> My Protocols <span class="round bugde"><?php TotalCompletePendingToRECUser();?></span></a></li>

 <li> <a href="./main.php?option=MyHaltedStudies"> <i class="icon-grid"></i>My Halted Studies <span class="round roundred"><?php MyHaltedStudies();?></span></a></li>
 
 <li <?php if($category=='MyRevisions'){?>class="active"<?php }?>><a href="./main.php?option=MyRevisions"><i class="icon-interface-windows"></i>My Revisions <span class="round bugde"><?php MyTotalRevisions();?></span></a></li>

<li <?php if($category=='MyFinalReportREC'){?>class="active"<?php }?>><a href="./main.php?option=MyFinalReport"><i class="icon-interface-windows"></i> My Closeout Reports <span class="round bugde"><?php TotalPendingReportsUser();?></span></a></li>

<li <?php if($category=='AnnualRenualMa'){?>class="active"<?php }?>><a href="./main.php?option=AnnualRenualMa"><i class="icon-interface-windows"></i> My Renewals <span class="round bugde"><?php TotalPendingAnnualRenewalsUser();?></span></a></li>

<li <?php if($category=='MyAmmendments'){?>class="active"<?php }?>><a href="./main.php?option=MyAmmendments"><i class="icon-interface-windows"></i> My Amendments <span class="round bugde"><?php TotalPendingAmmendmentsUser();?></span></a></li>

<li <?php if($category=='MyNotifications'){?>class="active"<?php }?>><a href="./main.php?option=MyNotifications"><i class="icon-interface-windows"></i> My Safety and Other Notifications  <span class="round bugde"><?php TotalPendingNotificationsUser();?></span></a></li>

<li <?php if($category=='mysaes'){?>class="active"<?php }?>><a href="./main.php?option=mysaes"><i class="icon-interface-windows"></i> My SAEs <span class="round bugde"><?php TotalPendingSAEsUser();?></span></a></li>


<li <?php if($category=='MyDeviations'){?>class="active"<?php }?>><a href="./main.php?option=MyDeviations"><i class="icon-interface-windows"></i> My Deviations and Violations <span class="round bugde"><?php TotalPendingDeviationsUser();?></span></a></li>


<li <?php if($category=='SubmitAbstracts'){?>class="active"<?php }?>><a href="./main.php?option=SubmitAbstracts"><i class="icon-interface-windows"></i> My Abstracts </a></li>

<?php if($raccess['accessAbstracts']=="Yes"){?>
<li <?php if($category=='abstracts'){?>class="active"<?php }?>><a href="./main.php?option=abstracts"><i class="icon-interface-windows"></i> Abstracts & Publications </a></li><?php }?>


<li <?php if($category=='faqs'){?>class="active"<?php }?>> <a href="./main.php?option=faqs"> <i class="icon-grid"></i>FAQ </a></li>
<!--<li> <a href="./main.php?option=dashboard/"> <i class="icon-padnote"></i>Contact </a></li>-->

</ul>


<?php }?>
<?php 
if($session_privillage=='membercommittee' || $session_privillage=='communityrepresentative'){?>
<ul class="list-unstyled">

<li <?php if($category=='dashboard'){?>class="active"<?php }?>><a href="./main.php?option=dashboard"> <i class="icon-interface-windows"></i>Protocols </a></li>

<li <?php if($category=='meetings'){?>class="active"<?php }?>><a href="./main.php?option=meetings"><i class="icon-interface-windows"></i> Meetings</a></li>
   
<li <?php if($category=='faqs'){?>class="active"<?php }?>> <a href="./main.php?option=faqs"> <i class="icon-grid"></i>FAQ </a></li>
            <!--<li> <a href="./main.php?option=dashboard/"> <i class="icon-padnote"></i>Contact </a></li>-->
<?php if($raccess['accessAbstracts']=="Yes"){?>
<li <?php if($category=='abstracts'){?>class="active"<?php }?>><a href="./main.php?option=abstracts"><i class="icon-interface-windows"></i> Abstracts & Publications </a></li><?php }?>
</ul>
<?php }?>

<?php 
if($session_privillage=='recadmin'){?>
<ul class="list-unstyled">


<li <?php if($category=='dashboard'){?>class="active"<?php }?>><a href="./main.php?option=dashboard"><i class="icon-interface-windows"></i> Protocols <span class="round bugde"><?php TotalCompletePendingToREC();?></span></a></li>


 <li> <a href="./main.php?option=SuspectedDuplicates"> <i class="icon-grid"></i>Suspected Duplicates <span class="round roundred"><?php SuspectedDuplicates();?></span></a></li>
 
 <li> <a href="./main.php?option=Investigators"> <i class="icon-grid"></i>Investigators <span class="round roundred">New</span></a></li>
 
  <li> <a href="./main.php?option=HaltedStudies"> <i class="icon-grid"></i>Halted Studies <span class="round roundred"><?php HaltedStudies();?></span></a></li>
  
  
   <li> <a href="./main.php?option=ClosedStudies"> <i class="icon-grid"></i>Closed/ended Studies <span class="round roundred"><?php HaltedStudies();?></span></a></li>
  
   <li> <a href="./main.php?option=Appeals"> <i class="icon-grid"></i>Appeals <span class="round roundred"><?php Appeals();?></span></a></li>
  
  <li <?php if($category=='RECRevisions'){?>class="active"<?php }?>><a href="./main.php?option=RECRevisions"><i class="icon-interface-windows"></i> Revisions <span class="round bugde"><?php TotalRevisions();?></span></a></li>

<li <?php if($category=='MyFinalReportREC'){?>class="active"<?php }?>><a href="./main.php?option=MyFinalReportREC"><i class="icon-interface-windows"></i> Closeout Reports <span class="round bugde"><?php TotalPendingReports();?></span></a></li>

<li <?php if($category=='AnnualRenualMaREC'){?>class="active"<?php }?>><a href="./main.php?option=AnnualRenualMaREC"><i class="icon-interface-windows"></i> Renewals <span class="round bugde"><?php TotalPendingAnnualRenewals();?></span></a></li>

<li <?php if($category=='MyAmmendmentsREC'){?>class="active"<?php }?>><a href="./main.php?option=MyAmmendmentsREC"><i class="icon-interface-windows"></i> Amendments <span class="round bugde"><?php TotalPendingAmmendments();?></span></a></li>

<li <?php if($category=='MyNotificationsREC'){?>class="active"<?php }?>><a href="./main.php?option=MyNotificationsREC"><i class="icon-interface-windows"></i> Safety and Other Notifications  <span class="round bugde"><?php TotalPendingNotifications();?></span></a></li>

<li <?php if($category=='mysaesREC'){?>class="active"<?php }?>><a href="./main.php?option=mysaesREC"><i class="icon-interface-windows"></i> SAEs <span class="round bugde"><?php TotalPendingSAEs();?></span></a></li>


<li <?php if($category=='MyDeviationsREC'){?>class="active"<?php }?>><a href="./main.php?option=MyDeviationsREC"><i class="icon-interface-windows"></i> Deviations and Violations <span class="round bugde"><?php TotalPendingDeviations();?></span></a></li>



<li <?php if($category=='meetings'){?>class="active"<?php }?>><a href="./main.php?option=meetings"><i class="icon-interface-windows"></i> Meetings</a></li>



<li <?php if($category=='Reports'){?>class="active"<?php }?>><a href="./main.php?option=Reports"><i class="icon-interface-windows"></i> Reports </a></li>
<li <?php if($category=='recReviewers'){?>class="active"<?php }?>> <a href="./main.php?option=recReviewers"> <i class="icon-grid"></i>REC Reviewers </a></li> 
 <li> <a href="./main.php?option=Attendances"> <i class="icon-grid"></i>Minutes  </a></li>
 
<li> <a href="./main.php?option=MonitoringReports"> <i class="icon-grid"></i>Monitoring Reports  </a></li>
 

 
 <?php if($raccess['accessAbstracts']=="Yes"){?>
<li <?php if($category=='abstracts'){?>class="active"<?php }?>><a href="./main.php?option=abstracts"><i class="icon-interface-windows"></i> Abstracts & Publications </a></li><?php }?>
    <!--
<li> <a href="./main.php?option=faqs/"> <i class="icon-grid"></i>FAQ </a></li>
        <li> <a href="./main.php?option=dashboard/"> <i class="icon-padnote"></i>Contact </a></li>-->

</ul>
<?php }

if($session_privillage=='recitadmin'){?>
<ul class="list-unstyled">


<li <?php if($category=='dashboard'){?>class="active"<?php }?>><a href="./main.php?option=dashboard"><i class="icon-interface-windows"></i> Protocols <span class="round bugde"><?php TotalCompletePendingToREC();?></span></a></li>


 <li> <a href="./main.php?option=SuspectedDuplicates"> <i class="icon-grid"></i>Suspected Duplicates <span class="round roundred"><?php SuspectedDuplicates();?></span></a></li>
 
  <li> <a href="./main.php?option=HaltedStudies"> <i class="icon-grid"></i>Halted Studies <span class="round roundred"><?php HaltedStudies();?></span></a></li>
   <li> <a href="./main.php?option=ClosedStudies"> <i class="icon-grid"></i>Closed/ended Studies <span class="round roundred"><?php HaltedStudies();?></span></a></li>
  
   <li> <a href="./main.php?option=Appeals"> <i class="icon-grid"></i>Appeals <span class="round roundred"><?php Appeals();?></span></a></li>
  
  <li <?php if($category=='RECRevisions'){?>class="active"<?php }?>><a href="./main.php?option=RECRevisions"><i class="icon-interface-windows"></i> Revisions <span class="round bugde"><?php TotalRevisions();?></span></a></li>

<li <?php if($category=='MyFinalReportREC'){?>class="active"<?php }?>><a href="./main.php?option=MyFinalReportREC"><i class="icon-interface-windows"></i> Closeout Reports <span class="round bugde"><?php TotalPendingReports();?></span></a></li>

<li <?php if($category=='AnnualRenualMaREC'){?>class="active"<?php }?>><a href="./main.php?option=AnnualRenualMaREC"><i class="icon-interface-windows"></i> Renewals <span class="round bugde"><?php TotalPendingAnnualRenewals();?></span></a></li>

<li <?php if($category=='MyAmmendmentsREC'){?>class="active"<?php }?>><a href="./main.php?option=MyAmmendmentsREC/"><i class="icon-interface-windows"></i> Amendments <span class="round bugde"><?php TotalPendingAmmendments();?></span></a></li>

<li <?php if($category=='MyNotificationsREC'){?>class="active"<?php }?>><a href="./main.php?option=MyNotificationsREC"><i class="icon-interface-windows"></i> Safety and Other Notifications  <span class="round bugde"><?php TotalPendingNotifications();?></span></a></li>

<li <?php if($category=='mysaesREC'){?>class="active"<?php }?>><a href="./main.php?option=mysaesREC"><i class="icon-interface-windows"></i> SAEs <span class="round bugde"><?php TotalPendingSAEs();?></span></a></li>


<li <?php if($category=='MyDeviationsREC'){?>class="active"<?php }?>><a href="./main.php?option=MyDeviationsREC"><i class="icon-interface-windows"></i> Deviations and Violations <span class="round bugde"><?php TotalPendingDeviations();?></span></a></li>



<li <?php if($category=='meetings'){?>class="active"<?php }?>><a href="./main.php?option=meetings"><i class="icon-interface-windows"></i> Meetings</a></li>


<li <?php if($category=='statistics'){?>class="active"<?php }?>><a href="./main.php?option=statistics"><i class="icon-interface-windows"></i> Statistics </a></li>

<li <?php if($category=='Reports'){?>class="active"<?php }?>><a href="./main.php?option=Reports"><i class="icon-interface-windows"></i> Reports </a></li>
<li <?php if($category=='recReviewers'){?>class="active"<?php }?>> <a href="./main.php?option=recReviewers"> <i class="icon-grid"></i>REC Reviewers </a></li> 
 <li> <a href="./main.php?option=Attendances"> <i class="icon-grid"></i>Minutes  </a></li>
 
<li> <a href="./main.php?option=MonitoringReports"> <i class="icon-grid"></i>Monitoring Reports  </a></li>
 

 
 <?php if($raccess['accessAbstracts']=="Yes"){?>
<li <?php if($category=='abstracts'){?>class="active"<?php }?>><a href="./main.php?option=abstracts"><i class="icon-interface-windows"></i> Abstracts & Publications </a></li><?php }?>
    <!--
<li> <a href="./main.php?option=faqs/"> <i class="icon-grid"></i>FAQ </a></li>
        <li> <a href="./main.php?option=dashboard/"> <i class="icon-padnote"></i>Contact </a></li>-->

</ul>
<?php }




if($session_privillage=='rechairperson' || $session_privillage=='revicechairperson'){?>
<ul class="list-unstyled">

<li <?php if($category=='dashboard'){?>class="active"<?php }?>><a href="./main.php?option=dashboard"><i class="icon-interface-windows"></i> Protocols </a></li>
<li <?php if($category=='Reports'){?>class="active"<?php }?>><a href="./main.php?option=Reports"><i class="icon-interface-windows"></i> Reports </a></li>
  <li> <a href="./main.php?option=Appeals" <?php if($category=='Appeals'){?>class="active"<?php }?>> <i class="icon-grid"></i>Appeals <span class="round roundred"><?php Appeals();?></span></a></li>

<li <?php if($category=='statistics'){?>class="active"<?php }?>><a href="./main.php?option=statistics"><i class="icon-interface-windows"></i> Statistics </a></li>

<li <?php if($category=='meetings'){?>class="active"<?php }?>><a href="./main.php?option=meetings"><i class="icon-interface-windows"></i> Meetings</a></li>
 
<li <?php if($category=='recReviewers'){?>class="active"<?php }?>> <a href="./main.php?option=recReviewers"> <i class="icon-grid"></i>REC Reviewers </a></li>
<li <?php if($category=='faqs'){?>class="active"<?php }?>> <a href="./main.php?option=faqs"> <i class="icon-grid"></i>FAQ </a></li>
           <!-- <li> <a href="./main.php?option=dashboard/"> <i class="icon-padnote"></i>Contact </a></li>-->

<?php if($raccess['accessAbstracts']=="Yes"){?>
<li <?php if($category=='abstracts'){?>class="active"<?php }?>><a href="./main.php?option=abstracts"><i class="icon-interface-windows"></i> Abstracts & Publications </a></li><?php }?>
</ul>
<?php }?>

<?php 
if($session_privillage=='recreviewer'){?>
<ul class="list-unstyled">


<li <?php if($category=='dashboard'){?>class="active"<?php }?>><a href="./main.php?option=dashboard"><i class="icon-interface-windows"></i> Protocols <span class="round bugde"><?php TotalCompletePendingToRECReviewer();?></span></a></li>

 <li> <a href="./main.php?option=MyHaltedStudiesReviewer"> <i class="icon-grid"></i>Halted Studies <span class="round roundred"><?php MyHaltedStudiesForReview();?></span></a></li>

<li <?php if($category=='ReviewerMyFinalReportREC'){?>class="active"<?php }?>><a href="./main.php?option=ReviewerMyFinalReport"><i class="icon-interface-windows"></i> Closeout Reports <span class="round bugde"><?php TotalPendingReportsReviewer();?></span></a></li>

<li <?php if($category=='ReviewerAnnualRenualMa'){?>class="active"<?php }?>><a href="./main.php?option=ReviewerAnnualRenualMa"><i class="icon-interface-windows"></i> Renewals <span class="round bugde"><?php TotalPendingAnnualRenewalsReviewer();?></span></a></li>

<li <?php if($category=='ReviewerMyAmmendments'){?>class="active"<?php }?>><a href="./main.php?option=ReviewerMyAmmendments"><i class="icon-interface-windows"></i> Amendments <span class="round bugde"><?php TotalPendingAmmendmentsReviewer();?></span></a></li>

<li <?php if($category=='ReviewerMyNotifications'){?>class="active"<?php }?>><a href="./main.php?option=ReviewerMyNotifications"><i class="icon-interface-windows"></i> Safety and Other Notifications  <span class="round bugde"><?php TotalPendingNotificationsReviewer();?></span></a></li>

<li <?php if($category=='Reviewermysaes'){?>class="active"<?php }?>><a href="./main.php?option=Reviewermysaes"><i class="icon-interface-windows"></i> SAEs <span class="round bugde"><?php TotalPendingSAEsReviewer();?></span></a></li>


<li <?php if($category=='ReviewerMyDeviations'){?>class="active"<?php }?>><a href="./main.php?option=ReviewerMyDeviations"><i class="icon-interface-windows"></i> Deviations and Violations <span class="round bugde"><?php TotalPendingDeviationsReviewer();?></span></a></li>


<li <?php if($category=='ReviewerConflict'){?>class="active"<?php }?>><a href="./main.php?option=ReviewerConflict"><i class="icon-interface-windows"></i> Conflict of Interest <span class="round bugde"><?php TotalConflictofInterestReviewer();?></span></a></li>

<?php if($raccess['accessAbstracts']=="Yes"){?>
<li <?php if($category=='abstracts'){?>class="active"<?php }?>><a href="./main.php?option=abstracts"><i class="icon-interface-windows"></i> Abstracts & Publications </a></li><?php }?>

<!--Begin menu to submit as a reviewer-->
<hr />

<li <?php if($category=='Mydashboard'){?>class="active"<?php }?>><a href="./main.php?option=Mydashboard"><i class="icon-interface-windows"></i> My Protocols <span class="round bugde"><?php TotalCompletePendingToRECUser();?></span></a></li>

 <li> <a href="./main.php?option=MyHaltedStudies"> <i class="icon-grid"></i>My Halted Studies <span class="round roundred"><?php MyHaltedStudies();?></span></a></li>
 
 <li <?php if($category=='MyRevisions'){?>class="active"<?php }?>><a href="./main.php?option=MyRevisions"><i class="icon-interface-windows"></i>My Revisions <span class="round bugde"><?php MyTotalRevisions();?></span></a></li>

<li <?php if($category=='MyFinalReportREC'){?>class="active"<?php }?>><a href="./main.php?option=MyFinalReport"><i class="icon-interface-windows"></i> My Closeout Reports <span class="round bugde"><?php TotalPendingReportsUser();?></span></a></li>

<li <?php if($category=='AnnualRenualMa'){?>class="active"<?php }?>><a href="./main.php?option=AnnualRenualMa"><i class="icon-interface-windows"></i> My Renewals <span class="round bugde"><?php TotalPendingAnnualRenewalsUser();?></span></a></li>

<li <?php if($category=='MyAmmendments'){?>class="active"<?php }?>><a href="./main.php?option=MyAmmendments"><i class="icon-interface-windows"></i> My Amendments <span class="round bugde"><?php TotalPendingAmmendmentsUser();?></span></a></li>

<li <?php if($category=='MyNotifications'){?>class="active"<?php }?>><a href="./main.php?option=MyNotifications"><i class="icon-interface-windows"></i> My Safety and Other Notifications  <span class="round bugde"><?php TotalPendingNotificationsUser();?></span></a></li>

<li <?php if($category=='mysaes'){?>class="active"<?php }?>><a href="./main.php?option=mysaes"><i class="icon-interface-windows"></i> My SAEs <span class="round bugde"><?php TotalPendingSAEsUser();?></span></a></li>


<li <?php if($category=='MyDeviations'){?>class="active"<?php }?>><a href="./main.php?option=MyDeviations"><i class="icon-interface-windows"></i> My Deviations and Violations <span class="round bugde"><?php TotalPendingDeviationsUser();?></span></a></li>


<li <?php if($category=='SubmitAbstracts'){?>class="active"<?php }?>><a href="./main.php?option=SubmitAbstracts"><i class="icon-interface-windows"></i> My Abstracts </a></li>

<?php if($raccess['accessAbstracts']=="Yes"){?>
<li <?php if($category=='abstracts'){?>class="active"<?php }?>><a href="./main.php?option=abstracts"><i class="icon-interface-windows"></i> Abstracts & Publications </a></li><?php }?>
<!--End menu to submit as a reviewer-->
</ul>
<?php }

if($session_privillage=='monitoring'  || $session_privillage=='secretary'){?>
<ul class="list-unstyled">

<li <?php if($category=='dashboard'){?>class="active"<?php }?>><a href="./main.php?option=dashboard"><i class="icon-interface-windows"></i> Protocols </a></li>

  
</ul>
<?php }?>
