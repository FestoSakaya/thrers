<ul id="countrytabs" class="shadetabs">
<li><a href="#" rel="#default" class="selected">Collective Agenda</a></li>
<li class="extra">Initial Committee Review</li>
<li class="extra">End Review</li>
</ul>

<div id="countrydivcontainer" style="border:0px solid gray; width:100%; margin-bottom: 1em; padding: 10px">
<?php
$sqlstudym="SELECT * FROM ".$prefix."submission where id='$id' order by id desc limit 0,1";
$Querystudym = $mysqli->query($sqlstudym);
$rstudym = $Querystudym->fetch_array();
$owner_id=$rstudym['owner_id'];
$protocol_idwe=$rstudym['protocol_id'];
$code="REC.00.$protocol_idwe.01";

$sqlprotocalSubSel="SELECT * FROM ".$prefix."protocol where id='$protocol_idwe' and owner_id='$owner_id'";
$QprotocalSub2Sel = $mysqli->query($sqlprotocalSubSel);
$rprotocalSub2Sel = $QprotocalSub2Sel->fetch_array();


$sqlSRR = "select * from ".$prefix."user where asrmApplctID='$owner_id'";
$resultSSS = $mysqli->query($sqlSRR);
$sqUserdd = $resultSSS->fetch_array();


if($_POST['doSendToEthical']=='Save Comments'){

// and $mysqli->real_escape_string(htmlentities(htmlspecialchars($_POST['screening'])))
//preg_replace('/[^A-Za-z0-9\-]/', '', $string);nl2br()

$screening=$mysqli->real_escape_string(htmlspecialchars($_POST['screening']));
	//$screening=$mysqli->real_escape_string(strip_tags($_POST['screening']));
	$asrmApplctID_user=$mysqli->real_escape_string($_POST['asrmApplctID_user']);
	$protocol_idmm=$mysqli->real_escape_string($_POST['protocol_idmm']);
	
	if($_FILES['draftopinion']['name']){
$draftopinion = preg_replace('/\s+/', '_', $_FILES['draftopinion']['name']);
$draftopinion2 = $asrmApplctID.'comments_'.$mysqli->real_escape_string(preg_replace('/\s+/', '_', $_FILES['draftopinion']['name']));
$targetw1 = "files/uploads/". basename($asrmApplctID.'comments_'.preg_replace('/\s+/', '_', $_FILES['draftopinion']['name']));
$studytoolsext_main1 = move_uploaded_file(preg_replace('/\s+/', '_', $_FILES['draftopinion']['tmp_name']), $targetw1);

}
	
	$sqlInvestigators="SELECT * FROM ".$prefix."initial_committee_screening where `owner_id`='$asrmApplctID_user' and screening='$screening' and protocol_id='$protocol_idmm' and reviewer_id='$asrmApplctID' order by id desc";
	$QueryInvestigators = $mysqli->query($sqlInvestigators);
	$totalInvestigators = $QueryInvestigators->num_rows;

		if(!$totalInvestigators){
$sqlA2="insert into ".$prefix."initial_committee_screening (`owner_id`,`protocol_id`,`created`,`updated`,`screening`,`draftopinion`,`reviewer_id`,`screeningFor`,`completionStatus`,`collectiveDecision`) 

values('$asrmApplctID_user','$protocol_idmm',now(),now(),'$screening','$draftopinion2','$asrmApplctID','protocol','Completed','Yes')";
$mysqli->query($sqlA2);
		}
		if($totalInvestigators and !$_FILES['draftopinion']['name']){
$sqlA2="update ".$prefix."initial_committee_screening set `screening`='$screening',`collectiveDecision`='Yes' where `owner_id`='$asrmApplctID_user' and screening='$screening' and protocol_id='$protocol_idmm' and reviewer_id='$asrmApplctID'";
$mysqli->query($sqlA2);
		}
		if($totalInvestigators and $_FILES['draftopinion']['name']){
$sqlA2="update ".$prefix."initial_committee_screening set `screening`='$screening',`draftopinion`='$draftopinion2',`collectiveDecision`='Yes' where `owner_id`='$asrmApplctID_user' and screening='$screening' and protocol_id='$protocol_idmm' and reviewer_id='$asrmApplctID'";
$mysqli->query($sqlA2);
		}
		
echo '<img src="images/loading_wait.gif">';
echo '<div class="spacer"></div>';
echo '<meta http-equiv="REFRESH" content="0;url='.$base_url.'/main.php?option=initialCommitteeReviews&id='.$id.'">';
	
}

if($_POST['doFilesProceedToNextPage']){
	
	echo '<img src="images/loading_wait.gif">';
echo '<div class="spacer"></div>';
echo '<meta http-equiv="REFRESH" content="0;url='.$base_url.'/main.php?option=initialCommitteeReviews&id='.$id.'">';
}
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
<button class="accordion">Protocol Information, click to review</button>
  <div class="panel">
  <?php
  $sqlprotocalSub="SELECT * FROM ".$prefix."submission where  id='$id' order by id desc limit 0,1";
$QprotocalSub = $mysqli->query($sqlprotocalSub);
$rprotocalSub = $QprotocalSub->fetch_array();
$protocol_id=$rprotocalSub['protocol_id'];
$iowner_id=$rprotocalSub['owner_id'];

$sqlprotocalSub2="SELECT * FROM ".$prefix."protocol where  id='$protocol_id'";
$QprotocalSub2 = $mysqli->query($sqlprotocalSub2);
$rprotocalSub2 = $QprotocalSub2->fetch_array();

$sqlclinical="SELECT * FROM ".$prefix."submission_clinical_trial where  owner_id='$iowner_id' and submission_id='$protocol_id'";
$QClinical = $mysqli->query($sqlclinical);
$rClinical = $QClinical->fetch_array();
$clinical_trial_name_id2=$rClinical['id'];

$sqlclinical2="SELECT * FROM ".$prefix."list_clinical_trial_name where  id='$clinical_trial_name_id2'";
$QClinical2 = $mysqli->query($sqlclinical2);
$rClinical2 = $QClinical2->fetch_array();
?>
  <table width="100%" border="0">
  <tr>
    <td><strong>Identification</strong></td>
    <td><strong>Protocol</strong></td>
    <td><strong>Protocol Type</strong></td>
    <td><strong>Status</strong></td>
  </tr>
  <tr>
    <td>0000<?php echo $rprotocalSub['protocol_id'];?></td>
    <td><?php echo $rprotocalSub2['code'];?></td>
    <td><?php if($rprotocalSub['is_clinical_trial']==1){?>Clinical Trial<?php }?>
  <?php if($rprotocalSub['is_clinical_trial']==0){?>Research<?php }?></td>
    <td><?php echo $rprotocalSub['status'];?></td>
  </tr>
  <tr>
    <td style="padding-top:20px;"><strong>Institution</strong></td>
    <td><strong>Updated</strong></td>
    <td><strong>Decision</strong></td>
    <td><strong>Finished</strong></td>
  </tr>
  <tr>
    <td><?php echo $rClinical2['name'];?></td>
    <td><?php echo $rprotocalSub['updated'];?></td>
    <td>&nbsp;</td>
    <td><?php echo $rprotocalSub['updated'];?></td>
  </tr>

 <!--  <tr>
    <td style="padding-top:20px;"><strong>Recruiting</strong></td>
    <td><strong>Monitoring</strong></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
   <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>-->
  
  
</table>

  
  
    <hr />
  <h3 style="font-size:14px; background:#ADCEE2; color:#000000; padding:10px;">Team Members </h3> 
  
 <table id="customers">
                        <thead>
                          <tr>
                            <th>Name</th>
                            <th>Institution</th>
                            <th>Email</th>
                            <th>Country</th>
                       <th>HSP/GCP Training </th>
                       <th>Action </th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php
//if no page var is given, set start to 0
$sql = "select *,DATE_FORMAT(`created`,'%d/%m/%Y %H:%s:%i') AS created FROM ".$prefix."team where owner_id='$owner_id' and protocol_id='$protocol_idwe' order by id desc LIMIT 0,10";//and conceptm_status='new' 
$result = $mysqli->query($sql);
while($rInvestigator=$result->fetch_array()){
$countryid=$rInvestigator['countryid'];
$sqlCountry = "select * FROM ".$prefix."list_country where id='$countryid' order by id desc";//and conceptm_status='new' 
$resultCountry = $mysqli->query($sqlCountry);
$rCountry=$resultCountry->fetch_array();
	?>
                          <tr>
                            <td><?php echo $rInvestigator['name'];?></td>
                            <td><?php echo $rInvestigator['institution'];?></td>
                            <td><?php echo $rInvestigator['email'];?></td>
                            <td><?php echo $rCountry['name'];?></td>
                           <td>
                           
                          
                           <?php if($rInvestigator['GCPtraining']){?><a href="./files/uploads/<?php echo $rInvestigator['GCPtraining'];?>" style="color:#06F; font-weight:bold; font-size:12px;" target="_blank">View File</a><?php }?>
                           
                            </td>
                            
                             <td>
                             
                           <?php if($rInvestigator['employment']==1){?>   
                             <input id="go" type="button" value="View Details" onclick="window.open('<?php echo $base_url;?>viewbiodata.php?id=<?php echo $rInvestigator['id'];?>','popUpWindow','height=700, width=1000, left=100, top=100, resizable=yes, scrollbars=yes, toolbar=yes, menubar=no, location=no, directories=no, status=yes');"  class="errorm4" >
                             <?php }?>
                             
                            </td>
                          </tr>
   <?php }///////////end function ?>                 
                        </tbody>
                      </table>
  
  </div>
  
  
<button class="accordion">Protocol Details, click to review</button>
  <div class="panel">
  <?php
  $sqlprotocalSubrr="SELECT * FROM ".$prefix."submission where  id='$id' order by id desc limit 0,1";
$QprotocalSubrr = $mysqli->query($sqlprotocalSubrr);
$rprotocalSubrr = $QprotocalSubrr->fetch_array();
$protocol_idrr=$rprotocalSubrr['protocol_id'];
$iowner_idrr=$rprotocalSubrr['owner_id'];
?>
  <label class="form-control-label"><strong style="font-weight:bold;">Summary:</strong><br /> <?php echo $rprotocalSubrr['abstract'];?></label><br />
<label class="form-control-label"><strong style="font-weight:bold;">Keywords:</strong><br /><?php echo $rprotocalSubrr['keywords'];?></label><br />
<label class="form-control-label"><strong style="font-weight:bold;">Introduction:</strong><br /><?php echo $rprotocalSubrr['introduction'];?></label><br />
<label class="form-control-label"><strong style="font-weight:bold;">Justification:</strong><br /><?php echo $rprotocalSubrr['justification'];?></label><br />


 <label class="form-control-label"><strong style="font-weight:bold;">Objectives:</strong><br /></label><br />
<h5>Main Objective</h5>
  
   <?php
  $count1=0;
$qRPersoneld="select * from ".$prefix."other_objectives  where owner_id='$owner_id' and protocol_id='$protocol_idwe' and objectivetype='Main Objective' order by objectivetype asc";
$RPersoneld=$mysqli->query($qRPersoneld);
while ($rowRows = $RPersoneld->fetch_array())
{ $count1++;
///Display data for education history
	?> 
    
<label class="form-control-label">
<?php echo $count1.'. '.$rowRows['objective'];?></label><br />
<?php
}
?> 
<hr />
<h5>Specific Objectives</h5>
  
  <?php
   $count2=0;
$qRPersoneld4="select * from ".$prefix."other_objectives  where owner_id='$owner_id' and protocol_id='$protocol_idwe' and objectivetype='Specific Objective' order by objectivetype asc";
$RPersoneld4=$mysqli->query($qRPersoneld4);
while ($rowRows4 = $RPersoneld4->fetch_array())
{ $count2++;
///Display data for education history
	?> 
    
<label class="form-control-label">
<?php echo $count2.'. '.$rowRows4['objective'];?></label><br />
<?php
}
?> 

  
  </div>




<button class="accordion">Budget Information, click to review</button>
  <div class="panel">
   <?php
$Q_R="select * from ".$prefix."research_project_expenditure where rstug_user_id='$owner_id' and rstug_rsch_project_id='$protocol_idwe' order by rstug_expenditure_id desc";
$QCMD=$mysqli->query($Q_R);
$rS=$QCMD->fetch_array();

 $Q_RLocal="select * from ".$prefix."research_project_expenditure_local where rstug_user_id='$owner_id' and rstug_rsch_project_id='$protocol_idwe' order by rstug_expenditure_id desc";
$QCMDLocal=$mysqli->query($Q_RLocal);
$rSLocal=$QCMDLocal->fetch_array();
?>

 <?php
$Q_R="select * from ".$prefix."research_project_expenditure where rstug_user_id='$owner_id' and rstug_rsch_project_id='$id' order by rstug_expenditure_id desc";
$QCMD=$mysqli->query($Q_R);
$rS=$QCMD->fetch_array();

$Q_RLocal="select * from ".$prefix."research_project_expenditure_local where rstug_user_id='$owner_id' and rstug_rsch_project_id='$id' order by rstug_expenditure_id desc";
$QCMDLocal=$mysqli->query($Q_RLocal);
$rSLocal=$QCMDLocal->fetch_array();
?>

<h4> International Expenditure - Research Expenses to be covered outside Uganda</h4>
 

<table border="1" cellspacing="0" cellpadding="0" align="left" width="100%" id="vouchers" class="table">
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
    <td width="184" align="left" valign="bottom"><strong>Personnel</strong></td>
    <td width="187" align="center" valign="bottom"><?php if($rS['rstug_personnel_year1']){echo $rS['rstug_personnel_year1'];}else{ echo "0";}?></td>
    <td width="152" align="center" valign="bottom"><?php if($rS['rstug_personnel_year2']){echo $rS['rstug_personnel_year2'];}else{ echo "0";}?></td>
    <td width="154" align="center" valign="bottom"><?php if($rS['rstug_personnel_year3']){echo $rS['rstug_personnel_year3'];}else{ echo "0";}?></td>
    <td width="154" align="center" valign="bottom"><?php if($rS['rstug_personnel_year4']){echo $rS['rstug_personnel_year4'];}else{ echo "0";}?></td>
     <td width="154" align="center" valign="bottom"><?php if($rS['rstug_personnel_year5']){echo $rS['rstug_personnel_year5'];}else{ echo "0";}?></td>
    <td width="154" align="center" valign="bottom"><?php if($rS['rstug_personnel_total']){echo $rS['rstug_personnel_total'];}else{ echo "0";}?></td>
  </tr>
  <tr>
    <td width="184" align="left" valign="bottom"><strong>Travel <font color="#CC0000">*</font></strong></td>
    <td width="187" align="center" valign="bottom"><?php if($rS['rstug_travel_year1']){echo $rS['rstug_travel_year1'];}else{ echo "0";}?></td>
    <td width="152" align="center" valign="bottom"><?php if($rS['rstug_travel_year2']){echo $rS['rstug_travel_year2'];}else{ echo "0";}?></td>
    <td width="154" align="center" valign="bottom"><?php if($rS['rstug_travel_year3']){echo $rS['rstug_travel_year3'];}else{ echo "0";}?></td>
   
   
   <td width="154" align="center" valign="bottom"><?php if($rS['rstug_travel_year4']){echo $rS['rstug_travel_year4'];}else{ echo "0";}?></td>
   
   <td width="154" align="center" valign="bottom"><?php if($rS['rstug_travel_year5']){echo $rS['rstug_travel_year5'];}else{ echo "0";}?></td>
   
    <td width="154" align="center" valign="bottom"><?php if($rS['rstug_travel_total']){echo $rS['rstug_travel_total'];}else{ echo "0";}?></td>
  </tr>
  <tr>
    <td width="184" align="left" valign="bottom"><strong>Materials and Supplies</strong></td>
    <td width="187" align="center" valign="bottom"><?php echo $rS['rstug_materials_year1'];?></td>
    <td width="152" align="center" valign="bottom"><?php echo $rS['rstug_materials_year2'];?></td>
    <td width="154" align="center" valign="bottom"><?php echo $rS['rstug_materials_year3'];?></td>
    
    
<td width="154" align="center" valign="bottom"><?php echo $rS['rstug_materials_year4'];?></td>
<td width="154" align="center" valign="bottom"><?php echo $rS['rstug_materials_year5'];?></td>

    <td width="154" align="center" valign="bottom"><?php echo $rS['rstug_materials_total'];?></td>
  </tr>
  <tr>
    <td width="184" align="left" valign="bottom"><strong>Administration</strong></td>
    <td width="187" align="center" valign="bottom"><?php echo $rS['rstug_adminstration_year1'];?></td>
    <td width="152" align="center" valign="bottom"><?php echo $rS['rstug_adminstration_year2'];?></td>
    <td width="154" align="center" valign="bottom"><?php echo $rS['rstug_adminstration_year3'];?></td>
    
    
 <td width="154" align="center" valign="bottom"><?php echo $rS['rstug_adminstration_year4'];?></td>
  <td width="154" align="center" valign="bottom"><?php echo $rS['rstug_adminstration_year5'];?></td>
  
    <td width="154" align="center" valign="bottom"><?php echo $rS['rstug_adminstration_total'];?></td>
  </tr>
  <tr>
    <td width="184" align="left" valign="bottom"><strong>Results dissemination</strong></td>
    <td width="187" align="center" valign="bottom"><?php echo $rS['rstug_results_year1'];?></td>
    <td width="152" align="center" valign="bottom"><?php echo $rS['rstug_results_year2'];?></td>
    <td width="154" align="center" valign="bottom"><?php echo $rS['rstug_results_year3'];?></td>
    
     <td width="154" align="center" valign="bottom"><?php echo $rS['rstug_results_year4'];?></td>
      <td width="154" align="center" valign="bottom"><?php echo $rS['rstug_results_year5'];?></td>

    <td width="154" align="center" valign="bottom"><?php echo $rS['rstug_results_total'];?></td>
  </tr>
 
  <tr>
    <td width="184" align="left" valign="bottom"><strong>Contingency</strong></td>
    <td width="187" align="center" valign="bottom"><?php echo $rS['rstug_contigency_year1'];?></td>
    <td width="152" align="center" valign="bottom"><?php echo $rS['rstug_contigency_year2'];?></td>
    <td width="154" align="center" valign="bottom" ><?php echo $rS['rstug_contigency_year3'];?></td>
    
    
    <td width="154" align="center" valign="bottom" ><?php echo $rS['rstug_contigency_year4'];?></td>
    <td width="154" align="center" valign="bottom" ><?php echo $rS['rstug_contigency_year5'];?></td>
    
    
    <td width="154" align="center" valign="bottom" ><?php echo $rS['rstug_contigency_total'];?></td>
  </tr>
  
  
   <tr>
    <td width="184" align="left" valign="bottom"><strong>Reimbursement and Time Compensations </strong></td>
    <td width="187" align="center" valign="bottom"><?php echo $rS['rstug_reimbursement_year1'];?></td>
    <td width="152" align="center" valign="bottom"><?php echo $rS['rstug_reimbursement_year2'];?></td>
    <td width="154" align="center" valign="bottom" ><?php echo $rS['rstug_reimbursement_year3'];?></td>
    
    
    <td width="154" align="center" valign="bottom" ><?php echo $rS['rstug_reimbursement_year4'];?></td>
    <td width="154" align="center" valign="bottom" ><?php echo $rS['rstug_reimbursement_year5'];?></td>
    
    
    <td width="154" align="center" valign="bottom" ><?php echo $rS['rstug_reimbursement_total'];?></td>
  </tr>
   <tr>
    <td width="184" align="left" valign="bottom"><strong>Other</strong></td>
    <td width="187" align="center" valign="bottom"><?php echo $rS['rstug_other_year1'];?></td>
    <td width="152" align="center" valign="bottom"><?php echo $rS['rstug_other_year2'];?></td>
    <td width="154" align="center" valign="bottom"><?php echo $rS['rstug_other_year3'];?></td>
    
<td width="154" align="center" valign="bottom"><?php echo $rS['rstug_other_year4'];?></td>
<td width="154" align="center" valign="bottom"><?php echo $rS['rstug_other_year5'];?></td>

    <td width="154" align="center" valign="bottom"><?php echo $rS['rstug_other_total'];?></td>
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
    <td width="143" align="center" valign="bottom"><strong><?php echo $year1;?></strong></td>
    <td width="148" align="center" valign="bottom"><strong><?php echo $year2;?></strong></td>
    <td width="169" align="center" valign="bottom" ><strong><?php echo $year3;?></strong></td>
    <td width="151" align="center" valign="bottom" ><strong><?php echo $year4;?></strong></td>
    <td width="156" align="center" valign="bottom" ><strong><?php echo $year5;?></strong></td>
    <td width="115" align="center" valign="bottom" ><b><?php
	
	$grandTotal=($rS['rstug_personnel_total']+$rS['rstug_travel_total']+$rS['rstug_materials_total']+$rS['rstug_adminstration_total']+$rS['rstug_results_total']+$rS['rstug_other_total']+$rS['rstug_contigency_total']+$rS['rstug_reimbursement_total']);
	
	 echo $grandTotal;$grandTotal="";?></b></td>
  </tr>
    <tr>
  
    <td valign="bottom" colspan="7">&nbsp;</td>
  </tr>
</table>









<div class="class" style="clear:both;"></div>
<h4> Local Expenditure - Research Expenses to be covered in Uganda</h4>


<table border="1" cellspacing="0" cellpadding="0" align="left" width="100%" id="vouchers" class="table">
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
    <td width="184" align="left" valign="bottom"><strong>Personnel</strong></td>
    <td width="187" align="center" valign="bottom"><?php echo $rSLocal['rstug_personnel_year1'];?>
    </td>
    <td width="152" align="center" valign="bottom"><?php echo $rSLocal['rstug_personnel_year2'];?></td>
    <td width="154" align="center" valign="bottom"><?php echo $rSLocal['rstug_personnel_year3'];?></td>
    <td width="154" align="center" valign="bottom"><?php echo $rSLocal['rstug_personnel_year4'];?></td>
     <td width="154" align="center" valign="bottom"><?php echo $rSLocal['rstug_personnel_year5'];?></td>
    <td width="154" align="center" valign="bottom"><?php echo $rSLocal['rstug_personnel_total'];?></td>
  </tr>
  <tr>
    <td width="184" align="left" valign="bottom"><strong>Travel <font color="#CC0000">*</font></strong></td>
    <td width="187" align="center" valign="bottom"><?php echo $rSLocal['rstug_travel_year1'];?></td>
    <td width="152" align="center" valign="bottom"><?php echo $rSLocal['rstug_travel_year2'];?></td>
    <td width="154" align="center" valign="bottom"><?php echo $rSLocal['rstug_travel_year3'];?></td>
   
   
   <td width="154" align="center" valign="bottom"><?php echo $rSLocal['rstug_travel_year4'];?></td>
   
   <td width="154" align="center" valign="bottom"><?php echo $rSLocal['rstug_travel_year5'];?></td>
   
    <td width="154" align="center" valign="bottom"><?php echo $rSLocal['rstug_travel_total'];?></td>
  </tr>
  <tr>
    <td width="184" align="left" valign="bottom"><strong>Materials and Supplies</strong></td>
    <td width="187" align="center" valign="bottom"><?php echo $rSLocal['rstug_materials_year1'];?></td>
    <td width="152" align="center" valign="bottom"><?php echo $rSLocal['rstug_materials_year2'];?></td>
    <td width="154" align="center" valign="bottom"><?php echo $rSLocal['rstug_materials_year3'];?></td>
    
    
<td width="154" align="center" valign="bottom"><?php echo $rSLocal['rstug_materials_year4'];?></td>
<td width="154" align="center" valign="bottom"><?php echo $rSLocal['rstug_materials_year5'];?></td>

    <td width="154" align="center" valign="bottom"><?php echo $rSLocal['rstug_materials_total'];?></td>
  </tr>
  <tr>
    <td width="184" align="left" valign="bottom"><strong>Administration</strong></td>
    <td width="187" align="center" valign="bottom"><?php echo $rSLocal['rstug_adminstration_year1'];?></td>
    <td width="152" align="center" valign="bottom"><?php echo $rSLocal['rstug_adminstration_year2'];?></td>
    <td width="154" align="center" valign="bottom"><?php echo $rSLocal['rstug_adminstration_year3'];?></td>
    
    
 <td width="154" align="center" valign="bottom"><?php echo $rSLocal['rstug_adminstration_year4'];?></td>
  <td width="154" align="center" valign="bottom"><?php echo $rSLocal['rstug_adminstration_year5'];?></td>
  
    <td width="154" align="center" valign="bottom"><?php echo $rSLocal['rstug_adminstration_total'];?></td>
  </tr>
  <tr>
    <td width="184" align="left" valign="bottom"><strong>Results dissemination</strong></td>
    <td width="187" align="center" valign="bottom"><?php echo $rSLocal['rstug_results_year1'];?></td>
    <td width="152" align="center" valign="bottom"><?php echo $rSLocal['rstug_results_year2'];?></td>
    <td width="154" align="center" valign="bottom"><?php echo $rSLocal['rstug_results_year3'];?></td>
    
     <td width="154" align="center" valign="bottom"><?php echo $rSLocal['rstug_results_year4'];?></td>
      <td width="154" align="center" valign="bottom"><?php echo $rSLocal['rstug_results_year5'];?></td>

    <td width="154" align="center" valign="bottom"><?php echo $rSLocal['rstug_results_total'];?></td>
  </tr>
 
  <tr>
    <td width="184" align="left" valign="bottom"><strong>Contingency</strong></td>
    <td width="187" align="center" valign="bottom"><?php echo $rSLocal['rstug_contigency_year1'];?></td>
    <td width="152" align="center" valign="bottom"><?php echo $rSLocal['rstug_contigency_year2'];?></td>
    <td width="154" align="center" valign="bottom" ><?php echo $rSLocal['rstug_contigency_year3'];?></td>
    
    
    <td width="154" align="center" valign="bottom" ><?php echo $rSLocal['rstug_contigency_year4'];?></td>
    <td width="154" align="center" valign="bottom" ><?php echo $rSLocal['rstug_contigency_year5'];?></td>
    
    
    <td width="154" align="center" valign="bottom" ><?php echo $rSLocal['rstug_contigency_total'];?></td>
  </tr>
  
   <tr>
    <td width="184" align="left" valign="bottom"><strong>Reimbursement and Time Compensations </strong></td>
    <td width="187" align="center" valign="bottom"><?php echo $rSLocal['rstug_reimbursement_year1'];?></td>
    <td width="152" align="center" valign="bottom"><?php echo $rSLocal['rstug_reimbursement_year2'];?></td>
    <td width="154" align="center" valign="bottom" ><?php echo $rSLocal['rstug_reimbursement_year3'];?></td>
    
    
    <td width="154" align="center" valign="bottom" ><?php echo $rSLocal['rstug_reimbursement_year4'];?></td>
    <td width="154" align="center" valign="bottom" ><?php echo $rSLocal['rstug_reimbursement_year5'];?></td>
    
    
    <td width="154" align="center" valign="bottom" ><?php echo $rSLocal['rstug_reimbursement_total'];?></td>
  </tr>
  
   <tr>
    <td width="184" align="left" valign="bottom"><strong>Other</strong></td>
    <td width="187" align="center" valign="bottom"><?php echo $rSLocal['rstug_other_year1'];?></td>
    <td width="152" align="center" valign="bottom"><?php echo $rSLocal['rstug_other_year2'];?></td>
    <td width="154" align="center" valign="bottom"><?php echo $rSLocal['rstug_other_year3'];?></td>
    
<td width="154" align="center" valign="bottom"><?php echo $rSLocal['rstug_other_year4'];?></td>
<td width="154" align="center" valign="bottom"><?php echo $rSLocal['rstug_other_year5'];?></td>

    <td width="154" align="center" valign="bottom"><?php echo $rSLocal['rstug_other_total'];?></td>
  </tr>
<?php
$year11=($rSLocal['rstug_personnel_year1']+$rSLocal['rstug_travel_year1']+$rSLocal['rstug_materials_year1']+$rSLocal['rstug_adminstration_year1']+$rSLocal['rstug_results_year1']+$rSLocal['rstug_other_year1']+$rSLocal['rstug_contigency_year1']);

$year22=($rSLocal['rstug_personnel_year2']+$rSLocal['rstug_travel_year2']+$rSLocal['rstug_materials_year2']+$rSLocal['rstug_adminstration_year2']+$rSLocal['rstug_results_year2']+$rSLocal['rstug_other_year2']+$rSLocal['rstug_contigency_year2']);

$year33=($rSLocal['rstug_personnel_year3']+$rSLocal['rstug_travel_year3']+$rSLocal['rstug_materials_year3']+$rSLocal['rstug_adminstration_year3']+$rSLocal['rstug_results_year3']+$rSLocal['rstug_other_year3']+$rSLocal['rstug_contigency_year3']);

$year44=($rSLocal['rstug_personnel_year4']+$rSLocal['rstug_travel_year4']+$rSLocal['rstug_materials_year4']+$rSLocal['rstug_adminstration_year4']+$rSLocal['rstug_results_year4']+$rSLocal['rstug_other_year4']+$rSLocal['rstug_contigency_year4']);

$year55=($rSLocal['rstug_personnel_year5']+$rSLocal['rstug_travel_year5']+$rSLocal['rstug_materials_year5']+$rSLocal['rstug_adminstration_year5']+$rSLocal['rstug_results_year5']+$rSLocal['rstug_other_year5']+$rSLocal['rstug_contigency_year5']);
?>
 <tr>
    <td width="363" align="left" valign="bottom"><strong>Total</strong></td>
    <td width="143" align="center" valign="bottom"><strong><?php echo $year11;?></strong></td>
    <td width="148" align="center" valign="bottom"><strong><?php echo $year22;?></strong></td>
    <td width="169" align="center" valign="bottom" ><strong><?php echo $year33;?></strong></td>
    <td width="151" align="center" valign="bottom" ><strong><?php echo $year44;?></strong></td>
    <td width="156" align="center" valign="bottom" ><strong><?php echo $year55;?></strong></td>
    <td width="115" align="center" valign="bottom" ><b><?php
	
	$grandTotal2=($rSLocal['rstug_personnel_total']+$rSLocal['rstug_travel_total']+$rSLocal['rstug_materials_total']+$rSLocal['rstug_adminstration_total']+$rSLocal['rstug_results_total']+$rSLocal['rstug_other_total']+$rSLocal['rstug_contigency_total']+$rSLocal['rstug_reimbursement_total']);
	
	 echo $grandTotal2;$grandTotal2="";?></b></td>
  </tr>
    <tr>
  
    <td valign="bottom" colspan="7">&nbsp;</td>
  </tr>
</table>
 <?php
  $sqlstudyff="SELECT * FROM ".$prefix."submission where id='$id' order by id desc limit 0,1";
$Querystudyff = $mysqli->query($sqlstudyff);
$rstudyff = $Querystudyff->fetch_array(); 
?>              

<table border="1" cellspacing="0" cellpadding="0" align="left" width="100%" id="vouchers" class="table">

  <tr>
    <td width="363" align="left" valign="bottom"><strong>Primary Sponsor:</strong> <?php echo $rstudyff['primary_sponsor'];?>
    
    </td>
    <td width="187"  valign="bottom">  
    <strong>Country: </strong>
    <?php
$PrimarySponsorCountry=$rstudyff['PrimarySponsorCountry'];
$sqlCountrycv = "select * FROM ".$prefix."list_country where id='$PrimarySponsorCountry' order by name asc";//and conceptm_status='new' 
$resultCountrycv = $mysqli->query($sqlCountrycv);
$rCountrycv=$resultCountrycv->fetch_array();
echo $rCountrycv['name'];?>
    </td>
    <td width="152"  valign="bottom"><strong>Institution:</strong> <?php echo $rstudyff['PrimarySponsorInstitution'];?></td>
  </tr>
  
  
  
  <tr>

    <td width="187"  valign="bottom"> <label class="form-control-label"><strong>Secondary Sponsor:</strong></label>
       <?php echo $rstudyff['secondary_sponsor'];?></td>
       
    <td width="152"  valign="bottom"><label class="form-control-label"><strong>Country:</strong></label>

<?php
$SecondarySponsorCountry=$rstudyff['SecondarySponsorCountry'];
$sqlCountrycv2 = "select * FROM ".$prefix."list_country where id='$SecondarySponsorCountry' order by name asc";//and conceptm_status='new' 
$resultCountrycv2 = $mysqli->query($sqlCountrycv2);
$rCountrycv2=$resultCountrycv2->fetch_array();
?>
<?php echo $rCountrycv2['name'];?></td>


  
    <td valign="bottom"><label class="form-control-label"><strong>Institution:</strong></label>
       <?php echo $rstudyff['SecondarySponsorInstitution'];?></td>
  </tr>
</table>
                
                      
                      
  </div>
  


<button class="accordion">Clinical Study, click to review</button>
  <div class="panel">
  
  <h3>Recruitment Recruitment Area(s):</h3>
  
  <table class="table table-striped table-sm">
                        <thead>
                          <tr>
                            <th>Country</th>
                            <th>District</th>
                            <th>County</th>
                            <th>Sub County</th>
                            <th>Parish</th>
                            <th>Total No of participants</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php
//if no page var is given, set start to 0
$sql = "select *,DATE_FORMAT(`created`,'%d/%m/%Y %H:%s:%i') AS created FROM ".$prefix."submission_country where submission_id='$id' order by id desc LIMIT 0,10";//and conceptm_status='new' 
$result = $mysqli->query($sql);
while($rInvestigator=$result->fetch_array()){
$countryid=$rInvestigator['country_id'];
$districtm_id=$rInvestigator['district_id'];
$Municipality=$rInvestigator['Municipality'];
$municipalitityID=$rInvestigator['Municipality'];

$sqlCountry = "select * FROM ".$prefix."list_country where id='$countryid' order by id desc";//and conceptm_status='new' 
$resultCountry = $mysqli->query($sqlCountry);
$rCountry=$resultCountry->fetch_array();

$sqlDistrict = "select * FROM ".$prefix."districts where districtm_id='$districtm_id'";//and conceptm_status='new' 
$resultDistrict = $mysqli->query($sqlDistrict);
$rDistrict=$resultDistrict->fetch_array();
////municipalities
$sqlmunicipalities = "select * FROM ".$prefix."municipalities where municipalitityID='$municipalitityID'";//and conceptm_status='new' 
$resultmunicipalities = $mysqli->query($sqlmunicipalities);
$rmunicipalities=$resultmunicipalities->fetch_array();
	?>
                          <tr>
                            <td><?php echo $rCountry['name'];?></td>
                            <td><?php echo $rDistrict['districtm_name'];?></td>
                            <td><?php echo $rmunicipalities['municipalitityName'];?></td>
                            <td><?php echo $rInvestigator['SubCounty'];?></td>
                            <td><?php echo $rInvestigator['Parish'];?></td>
                            <td><?php echo $rInvestigator['participants'];?></td>
                          </tr>
      <?php 
   if($rInvestigator['participants'] and $rInvestigator['participants']!="N/A"){$Totalparticipants=($rInvestigator['participants']+$Totalparticipants);}
   }///////////end function ?> 
   <tr>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td><?php echo $Totalparticipants;?></td>
                          </tr>                 
                        </tbody>
                      </table>
             <table width="80%" border="0" id="POITable" class="htheadersm">
        <tr>
            <th width="20%"><strong>Gender:</strong>
            </th>
            <th width="20%"><strong>Minimum Age:</strong></th>
            <th width="20%"><strong>Maximum Age:</strong></th>
<th width="10%"><strong>Quantity:</strong></th>
<th width="10%"><strong>Duration:</strong></th>
        </tr>
        

   <?php 
$qRPersoneld2="select * from ".$prefix."study_description_age  where owner_id='$owner_id' and protocol_id='$protocol_idwe'";
$RPersoneld2=$mysqli->query($qRPersoneld2);  
while ($rowRows2 = $RPersoneld2->fetch_array())
{$gender=$rowRows2['gender'];
	
$sqlGender2 = "select * FROM ".$prefix."list_gender where id='$gender'";//and conceptm_status='new' 
$resultGender2 = $mysqli->query($sqlGender2);
$rGender2=$resultGender2->fetch_array();
	
	 ?>
<tr>
            <td id="grid"><?php echo $rGender2['name'];?> </td>
            <td id="grid"><?php echo $rowRows2['MinimumAge'];?> </td>
            <td id="grid"><?php echo $rowRows2['MaximumAge'];?> </td>
            <td id="grid"><?php echo $rowRows2['quantity'];?> </td>
            <td id="grid"><?php echo $rowRows2['Duration'];?> </td>
                </tr>

<?php
$Qty=($rowRows2['quantity']+$Qty);
}

?> 
<tr>
            <td id="grid">&nbsp;</td>
            <td id="grid">&nbsp;</td>
            <td id="grid">&nbsp; </td>
            <td id="grid"><?php echo $Qty;?> </td>
            <td id="grid">&nbsp;</td>
                </tr>
    </table>                       
              
<hr />
   <?php
 $sqlstudyDD="SELECT * FROM ".$prefix."submission where id='$id' order by id desc limit 0,1";
$QuerystudyDD = $mysqli->query($sqlstudyDD);
$rstudyDD = $QuerystudyDD->fetch_array();  
   
    ?>          

<label class="form-control-label"><strong style="font-weight:bold;">Study design:</strong> <?php echo $rstudyDD['funding_source'];?></label>  <br />
<label class="form-control-label"><strong style="font-weight:bold;">Health Condition or Problem Studied:</strong> <?php echo nl2br($rstudyDD['health_condition']);?></label>

 




<?php
$sqlmethodology="SELECT * FROM ".$prefix."clinical_study_methodology where `owner_id`='$owner_id' and protocol_id='$protocol_idwe' order by id desc limit 0,1";
$Querymethodology = $mysqli->query($sqlmethodology);
$rstudymethodology = $Querymethodology->fetch_array();
?>

<label class="form-control-label"><strong style="font-weight:bold;">Inclusion criteria:</strong> <?php echo nl2br($rstudymethodology['inclusion_criteria']);?></label><br />
<label class="form-control-label"><strong style="font-weight:bold;">Exclusion criteria:</strong> <?php echo nl2br($rstudymethodology['exclusion_criteria']);?></label>  <br />
<label class="form-control-label"><strong style="font-weight:bold;">Estimated date of initial recruitment:</strong> <?php echo $rstudyDD['recruitment_init_date'];?></label> 
<hr />
<label class="form-control-label"><strong style="font-weight:bold;">Interventions:</strong> <?php echo nl2br($rstudymethodology['interventions']);?></label><br />
<label class="form-control-label"><strong style="font-weight:bold;">Primary outcomes:</strong> <?php echo nl2br($rstudymethodology['primary_outcome']);?></label><br />
<label class="form-control-label"><strong style="font-weight:bold;">Secondary outcomes:</strong> <?php echo nl2br($rstudymethodology['secondary_outcome']);?></label>

<hr />



<label class="form-control-label"><strong style="font-weight:bold;">Secondary Registry:</strong> <?php echo $rstudyDD['clinical_trial_secondary'];?></label>

<hr />
 <table class="table table-striped table-sm">
                        <thead>
                          <tr>
                            <th>Registry Name</th>
                            <th>Registry Number</th>
                            <th>Date</th>

                          </tr>
                        </thead>
                        <tbody>
                        <?php
//if no page var is given, set start to 0
$sql = "select *,DATE_FORMAT(`created`,'%d/%m/%Y %H:%s:%i') AS created FROM ".$prefix."submission_clinical_trial where submission_id='$id' order by id desc LIMIT 0,10";//and conceptm_status='new' 
$result = $mysqli->query($sql);
while($rInvestigator=$result->fetch_array()){
$clinical_trial_name_id=$rInvestigator['clinical_trial_name_id'];
$sqlCountry = "select * FROM ".$prefix."list_clinical_trial_name where id='$clinical_trial_name_id' order by id desc";//and conceptm_status='new' 
$resultCountry = $mysqli->query($sqlCountry);
$rCountry=$resultCountry->fetch_array();
	?>
                          <tr>
                            <td><?php if($rInvestigator['NewClinicalRegistry']){echo $rInvestigator['NewClinicalRegistry'];}else{echo $rCountry['name'];}?></td>
                            <td><?php echo $rInvestigator['number'];?></td>
                            <td><?php echo $rInvestigator['created'];?></td>

                          </tr>
   <?php }///////////end function ?>                 
                        </tbody>
                      </table>

  </div>


  <button class="accordion">Methodology, click to review</button>
  <div class="panel">
  <?php
   $sqlstudyDDw2="SELECT * FROM ".$prefix."submission where id='$id' order by id desc limit 0,1";
$QuerystudyDDw2 = $mysqli->query($sqlstudyDDw2);
$rstudyDDw2 = $QuerystudyDDw2->fetch_array();  
?>
<?php
$sqlmethodology="SELECT * FROM ".$prefix."clinical_study_methodology where `owner_id`='$owner_id' and protocol_id='$protocol_idwe' order by id desc limit 0,1";
$Querymethodology = $mysqli->query($sqlmethodology);
$rstudymethodology = $Querymethodology->fetch_array();
?>
<label class="form-control-label"><strong style="font-weight:bold;">General Procedures:</strong> <?php echo nl2br($rstudymethodology['general_procedures']);?></label><br />
<label class="form-control-label"><strong style="font-weight:bold;">Analysis Plan:</strong> <?php echo nl2br($rstudymethodology['analysis_plan']);?></label><br />
<label class="form-control-label"><strong style="font-weight:bold;">Ethical Considerations:</strong> <?php echo nl2br($rstudymethodology['ethical_considerations']);?></label>

  </div>
  
  
 <button class="accordion">Study Work Plan, click to review</button>
  <div class="panel">
  <table class="table table-striped table-sm">
                        <thead>
                          <tr>
                            <th>Activity</th>
                           
                          </tr>
                        </thead>
                        <tbody>
                        <?php
//if no page var is given, set start to 0
$sql = "select *,DATE_FORMAT(`created`,'%d/%m/%Y %H:%s:%i') AS created FROM ".$prefix."submission_task where submission_id='$id' order by id desc LIMIT 0,10";//and conceptm_status='new' 
$result = $mysqli->query($sql);
while($rInvestigator=$result->fetch_array()){
	?>
                          <tr>
                            <td><a href="./files/uploads/<?php echo $rInvestigator['description'];?>" style="font-weight:bold;" target="_blank"><?php echo $rInvestigator['description'];?></a></td>
                      

                          </tr>
   <?php }///////////end function ?>                 
                        </tbody>
                      </table>
  </div> 
  


  <button class="accordion">Attachments, click to review</button>
  <div class="panel">
  
  <table class="table table-striped table-sm">
                        <thead>
                          <tr>
                            <th>File name</th>
                            <th>Type</th>
                            <th>Language</th>
                            <th>Version</th>
                            <th>Submitted By</th>
                            <th> Date & Time</th>

                          </tr>
                        </thead>
                        <tbody>
                        <?php
//if no page var is given, set start to 0
$sql = "select *,DATE_FORMAT(`created`,'%d/%m/%Y %H:%s:%i') AS created FROM ".$prefix."submission_upload where user_id='$owner_id' and submission_id='$protocol_idwe' order by id desc LIMIT 0,150";//and conceptm_status='new' 
$result = $mysqli->query($sql);
while($rInvestigator=$result->fetch_array()){
$upload_type_id=$rInvestigator['upload_type_id'];
$submittedBy=$rInvestigator['user_id'];

$filem = "select * FROM ".$prefix."upload_type where id='$upload_type_id'";//and conceptm_status='new' 
$resultfile = $mysqli->query($filem);
$rfile=$resultfile->fetch_array();
//user
$sqlUserup = "select * FROM ".$prefix."user where asrmApplctID='$submittedBy'";//and conceptm_status='new' 
$resultUser = $mysqli->query($sqlUserup);
$rUsers=$resultUser->fetch_array();
	?>
                          <tr>
                            <td><a href="./files/uploads/<?php echo $rInvestigator['filename'];?>" target="_blank">View File</a></td>
                            <td><?php if($rInvestigator['othername']){echo $rInvestigator['othername'];}else{echo $rfile['name'];}?></td>
                            <td><?php echo $rInvestigator['Language'];?></td>
                            <td><?php echo $rInvestigator['Version'];?> </td>
                            <td><?php echo $rUsers['name'];?></td>
                            <td><?php echo $rInvestigator['created'];?></td>

                          </tr>
   <?php }///////////end function
   
   $sqlstudyff="SELECT *,DATE_FORMAT(`updated`,'%d/%m/%Y %H:%s:%i') AS updated FROM ".$prefix."submission where id='$id' order by id desc limit 0,1";
$Querystudyff = $mysqli->query($sqlstudyff);
$rstudyff = $Querystudyff->fetch_array(); 
$submittedBy=$rstudyff['owner_id'];
//user
$sqlUserup2 = "select * FROM ".$prefix."user where asrmApplctID='$submittedBy'";//and conceptm_status='new' 
$resultUser2 = $mysqli->query($sqlUserup2);
$rUsers2=$resultUser2->fetch_array();
 ?>  
   
     <tr>
                            <td><a href="./files/uploads/<?php echo $rstudyff['paymentProof'];?>" >View File</a></td>
                            <td>Payment</td>
                             <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td><?php echo $rUsers2['name'];?></td>
                            <td><?php echo $rstudyff['updated'];?></td>

                          </tr>
                                        
                        </tbody>
                      </table>
  
  
  
  
  </div>
  
  
<!--  <button class="accordion">History, click to review</button>
  <div class="panel">Ngssss  snsnsnsn</div>-->
 <button class="accordion">Comments, click to review </button>
  <div class="panelm">
  
  <table class="table table-striped table-sm success">
                 
                          <tr>
                            <th>Date & Time</th>
                            <th>Author</th>
                            <th>Message</th>
 
                          </tr>
                   
                   
                        <?php
$sql = "select *,DATE_FORMAT(`created`,'%d/%m/%Y %H:%s:%i') AS created FROM ".$prefix."initial_committee_screening where protocol_id='$protocol_idwe' and collectiveDecision='No' order by id desc LIMIT 0,10";//and conceptm_status='new'

$result = $mysqli->query($sql);
while($rInvestigator=$result->fetch_array()){
$upload_type_id=$rInvestigator['upload_type_id'];
$submittedBy=$rInvestigator['reviewer_id'];

//user
$sqlUserup = "select * FROM ".$prefix."user where asrmApplctID='$submittedBy'";//and conceptm_status='new' 
$resultUser = $mysqli->query($sqlUserup);
$rUsers=$resultUser->fetch_array();
	?>
                         <tr>
                            <td><?php echo $rInvestigator['created'];?></td>
                            <td><?php echo $rUsers['name'];?></td>
                            <td><?php echo $rInvestigator['screening'];?></td>

                          </tr>
   <?php }///////////end function ?>                 
                   
                      </table>
                      
                      </div>
  
  
<!--  <button class="accordion">Comments, click to review </button>
  <div class="panel">-->
  
     <?php
if($_POST['doComment']=='Save' and $_POST['message']){

	$message=$mysqli->real_escape_string($_POST['message']);
	$asrmApplctID_user=$mysqli->real_escape_string($_POST['asrmApplctID_user']);
	$protocol_idmm=$mysqli->real_escape_string($_POST['protocol_idmm']);
	$is_confidential=$mysqli->real_escape_string($_POST['is_confidential']);
	
$sqlInvestigators="SELECT * FROM ".$prefix."protocol_comment where `protocol_id`='$protocol_idmm' and user_id='$asrmApplctID_user' and message='$message' order by id desc";
	$QueryInvestigators = $mysqli->query($sqlInvestigators);
	$totalInvestigators = $QueryInvestigators->num_rows;
	
		if(!$totalInvestigators){
$sqlA2="insert into ".$prefix."protocol_comment (`protocol_id`,`user_id`,`created`,`updated`,`message`,`is_confidential`) 

values('$protocol_idmm','$asrmApplctID_user',now(),now(),'$message','$is_confidential')";
$mysqli->query($sqlA2);
		}
	
}?>
  
  

  <!--<button id="myBtn">New Comment </button> -->
  
  
  <!-- The Modal -->
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
      <span class="close">&times;</span>
      <h3><strong>Message</strong></h3>
    </div>
    <div class="modal-body">

 <form action="" method="post" name="regForm" id="regForm" >
 
 <div class="form-group row" style="padding-top:10px;">
<label class="col-sm-2 form-control-label">Message:</label>
<div class="col-sm-10">
<textarea name="message" id="message" cols="" rows="5" class="form-control  required"></textarea>
<input name="asrmApplctID_user" type="hidden" value="<?php echo $owner_id;?>"/>
<input name="protocol_idmm" type="hidden" value="<?php echo $protocol_idwe;?>"/>
</div>
</div> 


<div class="form-group row">
<label class="col-sm-6 form-control-label"> <input name="is_confidential" type="checkbox" value="1" /> Is this a confidential comment? </label>

</div>


                        
                  
                        
       
       <div class="form-group row">
                          <div class="col-sm-4 offset-sm-3">
                    <input name="doComment" type="submit"  class="btn btn-primary" value="Save"/>

                          </div>
                        </div>
                                          
     </form>                   
    </div>
   <!-- </div>-->
    </div><!--End-->
  
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
<?php
$sqlgg = "select * FROM ".$prefix."initial_committee_screening where owner_id='$owner_id' and protocol_id='$protocol_idwe'  and reviewer_id='$asrmApplctID' order by id desc";//and conceptm_status='new' 
$resultgg = $mysqli->query($sqlgg);
$rInvestigatorgg=$resultgg->fetch_array();?>






 <form action="" method="post" name="regForm" id="regForm" enctype="multipart/form-data">
<h4>Collective Decisions (Comments will be shared with PI):</h4>
<div class="form-group row">
<label class="col-sm-4 form-control-label">Comments from the Committee Review Meeting (About this protocol):</label>
<textarea name="screening" id="screening" cols="" rows="5" class="form-control  required"><?php echo htmlentities(htmlspecialchars($rInvestigatorgg['screening']));?></textarea>
<input name="asrmApplctID_user" type="hidden" value="<?php echo $owner_id;?>"/>
<input name="protocol_idmm" type="hidden" value="<?php echo $protocol_idwe;?>"/>
</div>
<div class="line"></div>
<?php // echo $_SESSION['asrmApplctID'];?>

<?php if($_SESSION['asrmApplctID']==9){?> 
<div class="form-group row">
 
<label class="col-sm-3 form-control-label">Attach Comments (PDF/Word) <span class="error">*</span>:</label>
<div class="col-sm-8">
<input name="draftopinion" type="file" id="attachethicalapproval"/>
<?php if($rInvestigatorgg['draftopinion']){?><br />
<span style="color:#F00;">Review attached file to make sure it opens before you proceed.</span><br />
<a href="./files/uploads/<?php echo $rInvestigatorgg['draftopinion'];?>" target="_blank">View Attached Comments</a><?php }?>

</div>
</div><?php }?>


<div class="form-group row">
<div class="col-sm-4 offset-sm-3">
<input name="doSendToEthical" type="submit"  class="btn btn-primary" value="Save Comments"/>

<?php if($_SESSION['asrmApplctID']==9){?> 
<input name="doFilesProceedToNextPage" type="submit"  class="btn btn-primary" value="Click to Proceed" style="float:right; margin-top:5px;" onclick="return confirm('Are you sure you want to Proceed? Make sure you attached comments, review attached file to make sure it opens before you proceed.');"/>
<?php }?>

</div>
</div>
         </form>
                        
<script type="text/javascript">

var countries=new ddajaxtabs("countrytabs", "countrydivcontainer")
countries.setpersist(true)
countries.setselectedClassTarget("link") //"link" or "linkparent"
countries.init()

</script>