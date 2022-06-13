<?php
if(!$id){
	
echo '<meta http-equiv="REFRESH" content="1;url='.$base_url.'/main.php?option=dashboard">';
}
if($_POST['doSaveThree']=='Save and Next' and $id){// and $_POST['ProposedSamplesize'] 

	$ProposedSamplesize=$mysqli->real_escape_string($_POST['ProposedSamplesize']);
	$VulnerableGroupsOther=$mysqli->real_escape_string($_POST['VulnerableGroupsOther']);
	$ConsentProcessOther=$mysqli->real_escape_string($_POST['ConsentProcessOther']);
	
	$sasrmApplctID=$mysqli->real_escape_string($_POST['asrmApplctID']);
	$submission_id=$mysqli->real_escape_string($_POST['submission_id']);
	
$getReadingLevel=$mysqli->real_escape_string($_POST['getReadingLevel']);
$getTypeofStudy=$mysqli->real_escape_string($_POST['getTypeofStudy']);
$getValunalableGroups=$mysqli->real_escape_string($_POST['ValunalableGroupsOther']);
$getConsentProcess=$mysqli->real_escape_string($_POST['getConsentProcess']);
$CommunityEngagementplan=$mysqli->real_escape_string($_POST['CommunityEngagementplan']);

if($_POST['VulnerableGroups']){
	for ($i=0; $i < count($_POST['VulnerableGroups']); $i++) { 
$VulnerableGroups.=$mysqli->real_escape_string($_POST['VulnerableGroups'][$i].'.');

}
}

if($_POST['ProposedInclusionCriteria']){
	for ($i=0; $i < count($_POST['ProposedInclusionCriteria']); $i++) { 
$ProposedInclusionCriteria.=$mysqli->real_escape_string($_POST['ProposedInclusionCriteria'][$i]).'.';
}
}

if($_POST['TypeofStudy']){
	for ($i=0; $i < count($_POST['TypeofStudy']); $i++) { 
$TypeofStudy.=$mysqli->real_escape_string($_POST['TypeofStudy'][$i].'.');

}
}

if($_POST['ConsentProcess']){
for ($i=0; $i < count($_POST['ConsentProcess']); $i++) { 
$ConsentProcess.=$mysqli->real_escape_string($_POST['ConsentProcess'][$i].'.');

}
}

$Readinglevel=$mysqli->real_escape_string($_POST['Readinglevel']);
///////////////////////local table
$wm2="select * from ".$prefix."determination_of_risk where  owner_id='$sasrmApplctID' and protocol_id='$id' and status='new'";
$cmdwb2 = $mysqli->query($wm2);

if(!$cmdwb2->num_rows){
$Insert_QR5Local="insert into ".$prefix."study_population (`owner_id`,`protocol_id`,`ProposedInclusionCriteria`,`VulnerableGroups`,`VulnerableGroupsOther`,`TypeofStudy`,`TypeofStudyOther`,`ConsentProcess`,`ConsentProcessOther`,`ProposedSamplesize`,`Readinglevel`,`updatedon`,`status`,`getValunalableGroups`,`getTypeofStudy`,`getConsentProcess`,`getReadingLevel`,`CommunityEngagementplan`) values ('$sasrmApplctID','$id','$ProposedInclusionCriteria','$VulnerableGroups','$VulnerableGroupsOther','$TypeofStudy','$TypeofStudyOther','$ConsentProcess','$ConsentProcessOther','$ProposedSamplesize','$Readinglevel','$today','new','$getValunalableGroups','$getTypeofStudy','$getConsentProcess','$getReadingLevel','$CommunityEngagementplan')";
$mysqli->query($Insert_QR5Local);
$record_id = $mysqli->insert_id;
}

if($cmdwb2->num_rows){
$Insert_QR5Local="update ".$prefix."study_population  set `ProposedInclusionCriteria`='$ProposedInclusionCriteria',`VulnerableGroups`='$VulnerableGroups',`VulnerableGroupsOther`='$VulnerableGroupsOther',`TypeofStudy`='$TypeofStudy',`TypeofStudyOther`='$TypeofStudyOther',`ConsentProcess`='$ConsentProcess',`ConsentProcessOther`='$ConsentProcessOther',`ProposedSamplesize`='$ProposedSamplesize',`Readinglevel`='$Readinglevel',`getValunalableGroups`='$getValunalableGroups',`getTypeofStudy`='$getTypeofStudy',`getConsentProcess`='$getConsentProcess',`getReadingLevel`='$getReadingLevel',`CommunityEngagementplan`='$CommunityEngagementplan' where owner_id='$sasrmApplctID' and protocol_id='$id' and status='new'";
$mysqli->query($Insert_QR5Local);
$updated = $mysqli->insert_id;

}

$Humanexposure=$mysqli->real_escape_string($_POST['Humanexposure']);
$Humangenetics=$mysqli->real_escape_string($_POST['Humangenetics']);
$StemCells=$mysqli->real_escape_string($_POST['StemCells']);
$Fetaltissue=$mysqli->real_escape_string($_POST['Fetaltissue']);
$Investigationalnewdrug=$mysqli->real_escape_string($_POST['Investigationalnewdrug']);
$Investigationalnewdevice=$mysqli->real_escape_string($_POST['Investigationalnewdevice']);
$Existingdataavailable=$mysqli->real_escape_string($_POST['Existingdataavailable']);
$ExistingdataNotavailable=$mysqli->real_escape_string($_POST['ExistingdataNotavailable']);
$storedsamples=$mysqli->real_escape_string($_POST['storedsamples']);
$Observation=$mysqli->real_escape_string($_POST['Observation']);
$recordedInfo=$mysqli->real_escape_string($_POST['recordedInfo']);
$sensitiveaspects=$mysqli->real_escape_string($_POST['sensitiveaspects']);
$recordedInfobeRecorded=$mysqli->real_escape_string($_POST['recordedInfobeRecorded']);
$recordedaboutindividual=$mysqli->real_escape_string($_POST['recordedaboutindividual']);
$transferofspecimen=$mysqli->real_escape_string($_POST['transferofspecimen']);
///Insert into 

$wm1="select * from ".$prefix."determination_of_risk where  owner_id='$sasrmApplctID' and protocol_id='$id' and status='new'";
$cmdwb1 = $mysqli->query($wm1);

if(!$cmdwb1->num_rows){
$Insert_QR5Local="insert into ".$prefix."determination_of_risk (`owner_id`,`protocol_id`,`Humanexposure`,`Humangenetics`,`StemCells`,`Fetaltissue`,`Investigationalnewdrug`,`Investigationalnewdevice`,`Existingdataavailable`,`ExistingdataNotavailable`,`storedsamples`,`transferofspecimen`,`Observation`,`recordedInfo`,`sensitiveaspects`,`recordedInfobeRecorded`,`recordedaboutindividual`,`updatedon`,`status`) values ('$sasrmApplctID','$id','$Humanexposure','$Humangenetics','$StemCells','$Fetaltissue','$Investigationalnewdrug','$Investigationalnewdevice','$Existingdataavailable','$ExistingdataNotavailable','$storedsamples','$transferofspecimen','$Observation','$recordedInfo','$sensitiveaspects','$recordedInfobeRecorded','$recordedaboutindividual','$today','new')";
$mysqli->query($Insert_QR5Local);

}
if($cmdwb1->num_rows){
$Insert_QR5Local="update ".$prefix."determination_of_risk set `Humanexposure`='$Humanexposure',`Humangenetics`='$Humangenetics',`StemCells`='$StemCells',`Fetaltissue`='$Fetaltissue',`Investigationalnewdrug`='$Investigationalnewdrug',`Investigationalnewdevice`='$Investigationalnewdevice',`Existingdataavailable`='$Existingdataavailable',`ExistingdataNotavailable`='$ExistingdataNotavailable',`storedsamples`='$storedsamples',`transferofspecimen`='$transferofspecimen',`Observation`='$Observation',`recordedInfo`='$recordedInfo',`sensitiveaspects`='$sensitiveaspects',`recordedInfobeRecorded`='$recordedInfobeRecorded',`recordedaboutindividual`='$recordedaboutindividual' where `owner_id`='$sasrmApplctID' and `protocol_id`='$id'";
$mysqli->query($Insert_QR5Local);
	
}

	//Insert into Submission Stages
$wm="select * from ".$prefix."submission_stages where  owner_id='$sasrmApplctID' and protocol_id='$id' and status='new'";
$cmdwb = $mysqli->query($wm);
$totalStages = $cmdwb->num_rows;
$r= $cmdwb->fetch_array();
if($totalStages and $record_id){
$sqlASubmissionStages="update ".$prefix."submission_stages  set `study_population`='1' where `owner_id`='$sasrmApplctID' and `protocol_id`='$id'";
$mysqli->query($sqlASubmissionStages);
}

if($record_id){
	
$message='<p class="success">Dear '.$session_fullname.', details have been submitted, proceed to continue</p>';
logaction("$session_fullname updated protocol");

echo '<img src="images/loading_wait.gif">';
echo '<div class="spacer"></div>';

if($_POST['is_clinical_trial']==1){
echo '<meta http-equiv="REFRESH" content="0;url='.$base_url.'/main.php?option=submissionFour&id='.$id.'">';
}
if($_POST['is_clinical_trial']==0){
 echo '<meta http-equiv="REFRESH" content="0;url='.$base_url.'/main.php?option=submissionBudget&id='.$id.'">';
}
}


if($updated==0){
	
$message='<p class="success">Dear '.$session_fullname.', details have been submitted, proceed to continue</p>';
logaction("$session_fullname updated protocol");

echo '<img src="images/loading_wait.gif">';
echo '<div class="spacer"></div>';

if($_POST['is_clinical_trial']==1){
 echo '<meta http-equiv="REFRESH" content="0;url='.$base_url.'/main.php?option=submissionFour&id='.$id.'">';
}
if($_POST['is_clinical_trial']==0){
 echo '<meta http-equiv="REFRESH" content="0;url='.$base_url.'/main.php?option=submissionBudget&id='.$id.'">';
}
}



}//end post


$sqlstudy="SELECT * FROM ".$prefix."submission where `owner_id`='$asrmApplctID' and id='$id' order by id desc limit 0,1";
$Querystudy = $mysqli->query($sqlstudy);
$totalstudy = $Querystudy->num_rows;
$rstudy = $Querystudy->fetch_array();
$protocol_id=$rstudy['protocol_id'];

//submission_stages
$sqlSub_Stages="SELECT * FROM ".$prefix."submission_stages where `owner_id`='$asrmApplctID' and protocol_id='$id' and status='new' order by id desc limit 0,1";
$QuerySub_stages = $mysqli->query($sqlSub_Stages);
$totalSub_Stages = $QuerySub_stages->num_rows;
$rsSubStages = $QuerySub_stages->fetch_array();
$rsSubStages['study_population'];
?>
<?php include("viewlrcn/final_button.php");?>
<ul id="countrytabs" class="shadetabs">
<?php if($totalstudy>=1){?><li><a href="./main.php?option=submission&id=<?php echo $id;?>" <?php if($rsSubStages['protocol_information']==1 and $rsSubStages['protocol_team']==1){?> style="background:green; color:#FFF;" <?php }?>>Protocol Information</a></li><?php }?>
<?php if(!$totalstudy){?><li class="extra" <?php if($rsSubStages['protocol_information']==1 and $rsSubStages['protocol_team']==1){?> style="background:green; color:#FFF;" <?php }?>>Protocol Information</li><?php }?>

<?php if($totalstudy>=1){?><li><a href="./main.php?option=submissionSecond&id=<?php echo $id;?>" <?php if($rsSubStages['protocol_details']==1){?> style="background:green; color:#FFF;" <?php }?>>Protocol Details</a></li><?php }?>
<?php if(!$totalstudy){?><li class="extra" <?php if($rsSubStages['protocol_details']==1){?> style="background:green; color:#FFF;" <?php }?>>Protocol Details</li><?php }?>

<?php if($totalstudy>=1){?><li><a href="./main.php?option=submissionThird&id=<?php echo $id;?>" <?php if($rsSubStages['study_description']==1 and $rsSubStages['RecruitmentCountries']==1){?> style="background:green; color:#FFF;" <?php }?>>Study Description</a></li><?php }?>
<?php if(!$totalstudy){?><li class="extra" <?php if($rsSubStages['study_description']==1 and $rsSubStages['RecruitmentCountries']==1){?> style="background:green; color:#FFF;" <?php }?>>Study Description</li><?php }?>


<li><a href="#" rel="#default" class="selected" <?php if($rsSubStages['study_population']==1){?> style="background:green; color:#FFF;" <?php }?>>Study Population</a></li>

<?php if($rstudy['is_clinical_trial']==1){?>
<?php if($totalstudy>=1){?><li><a href="./main.php?option=submissionFour&id=<?php echo $id;?>" <?php if($rsSubStages['registry']==1){?> style="background:green; color:#FFF;" <?php }?>>Registry</a></li><?php }?>
<?php if(!$totalstudy){?><li class="extra" <?php if($rsSubStages['registry']==1){?> style="background:green; color:#FFF;" <?php }?>>Registry</li><?php }}?>

<?php if($totalstudy>=1){?><li><a href="./main.php?option=submissionBudget&id=<?php echo $id;?>" <?php if($rsSubStages['budget']==1){?> style="background:green; color:#FFF;" <?php }?>>Budget</a></li><?php }?>
<?php if(!$totalstudy){?><li class="extra" <?php if($rsSubStages['budget']==1){?> style="background:green; color:#FFF;" <?php }?>>Budget</li><?php }?>

<?php if($totalstudy>=1){?><li><a href="./main.php?option=submissionSchedule&id=<?php echo $id;?>" <?php if($rsSubStages['study_work_plan']==1){?> style="background:green; color:#FFF;" <?php }?>>Study Work Plan</a></li><?php }?>
<?php if(!$totalstudy){?><li class="extra" <?php if($rsSubStages['study_work_plan']==1){?> style="background:green; color:#FFF;" <?php }?>>Study Work Plan</li><?php }?>

<?php /*?><?php if($totalstudy>=1){?><li><a href="./main.php?option=submissionFive/<?php echo $rstudy['id'];?>/"<?php if($rsSubStages['bibliography']==1){?> style="background:green; color:#FFF;" <?php }?>>Bibliography</a></li><?php }?>
<?php if(!$totalstudy){?><li class="extra"<?php if($rsSubStages['bibliography']==1){?> style="background:green; color:#FFF;" <?php }?>>Bibliography</li><?php }?><?php */?>

<?php if($totalstudy>=1){?><li><a href="./main.php?option=submissionSix&id=<?php echo $id;?>" <?php if($rsSubStages['filem']==1){?> style="background:green; color:#FFF;" <?php }?>>Attached Files</a></li><?php }?>
<?php if(!$totalstudy){?><li class="extra" <?php if($rsSubStages['filem']==1){?> style="background:green; color:#FFF;" <?php }?>>Attached Files</li><?php }?>


<?php if($totalstudy>=1){?><li><a href="./main.php?option=submissionFinish&id=<?php echo $id;?>" <?php if($rsSubStages['payments']==1){?> style="background:green; color:#FFF;" <?php }?>>Payments</a></li><?php }?>
<?php if(!$totalstudy){?><li class="extra" <?php if($rsSubStages['payments']==1){?> style="background:green; color:#FFF;" <?php }?>>Payments</li><?php }?>

</ul>

<div id="countrydivcontainer" style="border:0px solid gray; width:100%; margin-bottom: 1em; padding: 10px">
<?php
$sqlstudym="SELECT * FROM ".$prefix."submission where `owner_id`='$asrmApplctID' and id='$id' order by id desc limit 0,1";
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
                     <!-- <div class="progress">
                        <div role="progressbar" style="width: 45%; height: 6px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" class="progress-bar bg-red"></div>
                      </div>-->
                      
       <?php include("viewlrcn/status_log.php");?>


                    </div>
                  </div>
                </div>
              </div>

<?php
if(isset($message)){echo $message;}
?>



                    
  <div style="clear:both;"></div>                      
<form action="" method="post" name="regForm" id="regForm" >                        
  <input name="is_clinical_trial" type="hidden" value="<?php echo $rstudy['is_clinical_trial'];?>"/>                      
                        
                        
                        
                        
      
   <div style="clear:both;"></div>                   
<?php
$sqlstudyPop="SELECT * FROM ".$prefix."study_population where `owner_id`='$asrmApplctID' and protocol_id='$protocol_id' order by id desc limit 0,1";//and status='new' 
$QuerystudyPop = $mysqli->query($sqlstudyPop);
$rstudyP = $QuerystudyPop->fetch_array();
  
  
$shcategoryID1=$rstudyP['ProposedInclusionCriteria'];
$categoryChunks1 = explode(".", $shcategoryID1);

$chop1="$categoryChunks1[0]";
$chop2="$categoryChunks1[1]";

?>

<?php 
/*?> <div class="form-group row success">
                          <label class="form-control-label col-sm-12"><strong>Population: Proposed inclusion criteria:</strong> <span class="error">*</span></label>
  <?php 
$sqlstudyPop="SELECT * FROM ".$prefix."study_population where `owner_id`='$asrmApplctID' and protocol_id='$protocol_id' and status='new' order by id desc limit 0,1";
$QuerystudyPop = $mysqli->query($sqlstudyPop);
$rstudyP = $QuerystudyPop->fetch_array();
  
  
$shcategoryID1=$rstudyP['ProposedInclusionCriteria'];
$categoryChunks1 = explode(".", $shcategoryID1);

$chop1="$categoryChunks1[0]";
$chop2="$categoryChunks1[1]";
  ?>                      
 
 <label class="form-control-label"><input name="ProposedInclusionCriteria[]" type="checkbox" value="Males" class="required" <?php if($chop1=='Males' || $chop2=='Males'){?>checked="checked"<?php }?>/> Males<br />
						  
<input name="ProposedInclusionCriteria[]" type="checkbox" value="Females"  class="required"  <?php if($chop1=='Females' || $chop2=='Females'){?>checked="checked"<?php }?>/> Females</label>
</div><?php */?>
                        <div class="line"></div>
                        
                        
    <div class="form-group row success">
    <?php
	$shcategoryID2=$rstudyP['VulnerableGroups'];
$categoryChunks2 = explode(".", $shcategoryID2);

$chop3="$categoryChunks2[0]";
$chop4="$categoryChunks2[1]";
$chop5="$categoryChunks2[2]";
$chop6="$categoryChunks2[3]";
$chop7="$categoryChunks2[4]";
$chop8="$categoryChunks2[5]";
$chop9="$categoryChunks2[6]";
$chop10="$categoryChunks2[7]";
$chop11="$categoryChunks2[8]";
$chop12="$categoryChunks2[9]";

?>
                      <label class="form-control-label col-sm-12"><strong>Vulnerable Groups</strong>: <span class="error">*</span></label>
                        
                          <label class="form-control-label">
<input name="VulnerableGroups[]" type="checkbox" value="Foetuses" <?php if($chop3=='Foetuses' || $chop4=='Foetuses' || $chop5=='Foetuses' || $chop6=='Foetuses' || $chop7=='Foetuses' || $chop8=='Foetuses' || $chop9=='Foetuses' || $chop10=='Foetuses' || $chop11=='Foetuses' || $chop12=='Foetuses'){?>checked="checked"<?php }?>/> Foetuses<br />



<input name="VulnerableGroups[]" type="checkbox" value="Children (Under 12 years of age)" <?php if($chop3=='Children (Under 12 years of age)' || $chop4=='Children (Under 12 years of age)' || $chop5=='Children (Under 12 years of age)' || $chop6=='Children (Under 12 years of age)' || $chop7=='Children (Under 12 years of age)' || $chop8=='Children (Under 12 years of age)' || $chop9=='Children (Under 12 years of age)' || $chop10=='Children (Under 12 years of age)' || $chop11=='Children (Under 12 years of age)' || $chop12=='Children (Under 12 years of age)'){?>checked="checked"<?php }?>/> Children (Under 12 years of age)<br/>




<input name="VulnerableGroups[]" type="checkbox" value="Adolescents (12 – 18 years)" <?php if($chop3=='Adolescents (12 – 18 years)' || $chop4=='Adolescents (12 – 18 years)' || $chop5=='Adolescents (12 – 18 years)' || $chop6=='Adolescents (12 – 18 years)' || $chop7=='Adolescents (12 – 18 years)' || $chop8=='Adolescents (12 – 18 years)' || $chop9=='Adolescents (12 – 18 years)' || $chop10=='Adolescents (12 – 18 years)' || $chop11=='Adolescents (12 – 18 years)' || $chop12=='Adolescents (12 – 18 years)'){?>checked="checked"<?php }?>/> Adolescents (12 – 18 years)<br/>



<input name="VulnerableGroups[]" type="checkbox" value="Pregnant women" <?php if($chop3=='Pregnant women' || $chop4=='Pregnant women' || $chop5=='Pregnant women' || $chop6=='Pregnant women' || $chop7=='Pregnant women' || $chop8=='Pregnant women' || $chop9=='Pregnant women' || $chop10=='Pregnant women' || $chop11=='Pregnant women' || $chop12=='Pregnant women'){?>checked="checked"<?php }?>/> Pregnant women<br/>


<input name="VulnerableGroups[]" type="checkbox" value="Elderly (over 65 years)" <?php if($chop3=='Elderly (over 65 years)' || $chop4=='Elderly (over 65 years)' || $chop5=='Elderly (over 65 years)' || $chop6=='Elderly (over 65 years)' || $chop7=='Elderly (over 65 years)' || $chop8=='Elderly (over 65 years)' || $chop9=='Elderly (over 65 years)' || $chop10=='Elderly (over 65 years)' || $chop11=='Elderly (over 65 years)' || $chop12=='Elderly (over 65 years)'){?>checked="checked"<?php }?>/> Elderly (over 65 years)<br/>



<input name="VulnerableGroups[]" type="checkbox" value="Prisoners" <?php if($chop3=='Prisoners' || $chop4=='Prisoners' || $chop5=='Prisoners' || $chop6=='Prisoners' || $chop7=='Prisoners' || $chop8=='Prisoners' || $chop9=='Prisoners' || $chop10=='Prisoners' || $chop11=='Prisoners' || $chop12=='Prisoners'){?>checked="checked"<?php }?>/> Prisoners<br
/>

<input name="VulnerableGroups[]" type="checkbox" value="Cognitively impaired" <?php if($chop3=='Cognitively impaired' || $chop4=='Cognitively impaired' || $chop5=='Cognitively impaired' || $chop6=='Cognitively impaired' || $chop7=='Cognitively impaired' || $chop8=='Cognitively impaired' || $chop9=='Cognitively impaired' || $chop10=='Cognitively impaired' || $chop11=='Cognitively impaired' || $chop12=='Cognitively impaired'){?>checked="checked"<?php }?>/> Cognitively impaired<br/>



<input name="VulnerableGroups[]" type="checkbox" value="Hospital patients" <?php if($chop3=='Hospital patients' || $chop4=='Hospital patients' || $chop5=='Hospital patients' || $chop6=='Hospital patients' || $chop7=='Hospital patients' || $chop8=='Hospital patients' || $chop9=='Hospital patients' || $chop10=='Hospital patients' || $chop11=='Hospital patients' || $chop12=='Hospital patients'){?>checked="checked"<?php }?>/> Hospital patients<br/>

             
             
<input name="VulnerableGroups[]" type="checkbox" value="Institutionalized" <?php if($chop3=='Institutionalized' || $chop4=='Institutionalized' || $chop5=='Institutionalized' || $chop6=='Institutionalized' || $chop7=='Institutionalized' || $chop8=='Institutionalized' || $chop9=='Institutionalized' || $chop10=='Institutionalized' || $chop11=='Institutionalized' || $chop12=='Institutionalized'){?>checked="checked"<?php }?>/> Institutionalized<br/>

<input name="VulnerableGroups[]" type="checkbox" value="Other" <?php if($chop3=='Other' || $chop4=='Other' || $chop5=='Other' || $chop6=='Other' || $chop7=='Other' || $chop8=='Other' || $chop9=='Other' || $chop10=='Other' || $chop11=='Other' || $chop12=='Other'){?>checked="checked"<?php }?> onChange="getValunalableGroupsMain(this.value)"/> Other<br />


<div id="ValunalableGroupsdiv"><?php if($rstudyP['getValunalableGroups']){?><input type="text" name="ValunalableGroupsOther" id="ValunalableGroupsOther" tabindex="9" value="<?php echo $rstudyP['getValunalableGroups'];?>" style="width:400px;"/><?php }?></div>                       
</label>
                          
                            <input name="submission_id" type="hidden" value="<?php echo $rstudy['protocol_id'];?>"/>
                            <input type="hidden" name="asrmApplctID" value="<?php echo $_SESSION['asrmApplctID'];?>">
                 
                       
                        </div>
                       <div class="line"></div>   
                     <div class="form-group row success">

   <?php
	$shcategoryID3=$rstudyP['TypeofStudy'];
$categoryChunks3 = explode(".", $shcategoryID3);

$chopTS1="$categoryChunks3[0]";
$chopTS2="$categoryChunks3[1]";
$chopTS3="$categoryChunks3[2]";
$chopTS4="$categoryChunks3[3]";
$chopTS5="$categoryChunks3[4]";
$chopTS6="$categoryChunks3[5]";
$chopTS7="$categoryChunks3[6]";
$chopTS8="$categoryChunks3[7]";
$chopTS9="$categoryChunks3[8]";


?>
<label class="form-control-label col-sm-12"><strong>Type of study (check all that applies)</strong>: <span class="error">*</span></label>
                        
                          <label class="form-control-label">
<input name="TypeofStudy[]" type="checkbox" value="Cross-sectional/Survey" <?php if($chopTS1=='Cross-sectional/Survey' || $chopTS2=='Cross-sectional/Survey' || $chopTS3=='Cross-sectional/Survey' || $chopTS4=='Cross-sectional/Survey' || $chopTS5=='Cross-sectional/Survey' || $chopTS6=='Cross-sectional/Survey' || $chopTS7=='Cross-sectional/Survey' || $chopTS8=='Cross-sectional/Survey' || $chopTS9=='Cross-sectional/Survey'){?>checked="checked"<?php }?>/> Cross-sectional/Survey<br/>


<input name="TypeofStudy[]" type="checkbox" value="Secondary data" <?php if($chopTS1=='Secondary data' || $chopTS2=='Secondary data' || $chopTS3=='Secondary data' || $chopTS4=='Secondary data' || $chopTS5=='Secondary data' || $chopTS6=='Secondary data' || $chopTS7=='Secondary data' || $chopTS8=='Secondary data' || $chopTS9=='Secondary data'){?>checked="checked"<?php }?>/> Secondary data<br/>


<input name="TypeofStudy[]" type="checkbox" value="Program/Project  evaluation" <?php if($chopTS1=='Program/Project  evaluation' || $chopTS2=='Program/Project  evaluation' || $chopTS3=='Program/Project  evaluation' || $chopTS4=='Program/Project  evaluation' || $chopTS5=='Program/Project  evaluation' || $chopTS6=='Program/Project  evaluation' || $chopTS7=='Program/Project  evaluation' || $chopTS8=='Program/Project  evaluation' || $chopTS9=='Program/Project  evaluation'){?>checked="checked"<?php }?>/> Program/Project  evaluation<br/>


<input name="TypeofStudy[]" type="checkbox" value="Clinical community trial" <?php if($chopTS1=='Clinical community trial' || $chopTS2=='Clinical community trial' || $chopTS3=='Clinical community trial' || $chopTS4=='Clinical community trial' || $chopTS5=='Clinical community trial' || $chopTS6=='Clinical community trial' || $chopTS7=='Clinical community trial' || $chopTS8=='Clinical community trial' || $chopTS9=='Clinical community trial'){?>checked="checked"<?php }?>/> Clinical community trial<br/>


<input name="TypeofStudy[]" type="checkbox" value="Case control" <?php if($chopTS1=='Case control' || $chopTS2=='Case control' || $chopTS3=='Case control' || $chopTS4=='Case control' || $chopTS5=='Case control' || $chopTS6=='Case control' || $chopTS7=='Case control' || $chopTS8=='Case control' || $chopTS9=='Case control'){?>checked="checked"<?php }?>/> Case control<br/>


<input name="TypeofStudy[]" type="checkbox" value="Longitudinal study" <?php if($chopTS1=='Longitudinal study' || $chopTS2=='Longitudinal study' || $chopTS3=='Longitudinal study' || $chopTS4=='Longitudinal study' || $chopTS5=='Longitudinal study' || $chopTS6=='Longitudinal study' || $chopTS7=='Longitudinal study' || $chopTS8=='Longitudinal study' || $chopTS9=='Longitudinal study'){?>checked="checked"<?php }?>/> Longitudinal study<br/>


<input name="TypeofStudy[]" type="checkbox" value="Record review" <?php if($chopTS1=='Record review' || $chopTS2=='Record review' || $chopTS3=='Record review' || $chopTS4=='Record review' || $chopTS5=='Record review' || $chopTS6=='Record review' || $chopTS7=='Record review' || $chopTS8=='Record review' || $chopTS9=='Record review'){?>checked="checked"<?php }?>/> Record review<br/>


<input name="TypeofStudy[]" type="checkbox" value="Hospital patients" <?php if($chopTS1=='Hospital patients' || $chopTS2=='Hospital patients' || $chopTS3=='Hospital patients' || $chopTS4=='Hospital patients' || $chopTS5=='Hospital patients' || $chopTS6=='Hospital patients' || $chopTS7=='Hospital patients' || $chopTS8=='Hospital patients' || $chopTS9=='Hospital patients'){?>checked="checked"<?php }?>/> Course activity<br/>

                          
<input name="TypeofStudy[]" type="checkbox" value="Other" <?php if($chopTS1=='Other (specify)' || $chopTS2=='Other (specify)' || $chopTS3=='Other (specify)' || $chopTS4=='Other (specify)' || $chopTS5=='Other (specify)' || $chopTS6=='Other (specify)' || $chopTS7=='Other (specify)' || $chopTS8=='Other (specify)' || $chopTS9=='Other (specify)'){?>checked="checked"<?php }?>  onChange="getTypeofStudyMain(this.value)"/> Other (specify)<br />


<div id="TypeofStudydiv"><?php if($rstudyP['getTypeofStudy']){?><input type="text" name="getTypeofStudy" id="getTypeofStudy" tabindex="9" value="<?php echo $rstudyP['getTypeofStudy'];?>" style="width:400px;"/><?php }?> </div>                           
                       </label>
        
                       
    </div>
                        
                 <div class="line"></div>   
                     <div class="form-group row success">
                      <label class="form-control-label col-sm-12"><strong>Consent Process</strong> : <span class="error">*</span></label>
 <?php
	$shcategoryID3=$rstudyP['ConsentProcess'];
$categoryChunks3 = explode(".", $shcategoryID3);

$chopCP1="$categoryChunks3[0]";
$chopCP2="$categoryChunks3[1]";
$chopCP3="$categoryChunks3[2]";
$chopCP4="$categoryChunks3[3]";
$chopCP5="$categoryChunks3[4]";


?>   
                          <label class="form-control-label">
<input name="ConsentProcess[]" type="checkbox" value="Written" <?php if($chopCP1=='Written' || $chopCP2=='Written' || $chopCP3=='Written' || $chopCP4=='Written' || $chopCP5=='Written'){?>checked="checked"<?php }?>  required/> Written<br/>


<input name="ConsentProcess[]" type="checkbox" value="Oral" <?php if($chopCP1=='Oral' || $chopCP2=='Oral' || $chopCP3=='Oral' || $chopCP4=='Oral' || $chopCP5=='Oral'){?>checked="checked"<?php }?>/> Oral<br/>


<input name="ConsentProcess[]" type="checkbox" value="English" <?php if($chopCP1=='English' || $chopCP2=='English' || $chopCP3=='English' || $chopCP4=='English' || $chopCP5=='English'){?>checked="checked"<?php }?> /> English<br/>


<input name="ConsentProcess[]" type="checkbox" value="Local Language" <?php if($chopCP1=='Local Language' || $chopCP2=='Local Language' || $chopCP3=='Local Language' || $chopCP4=='Local Language' || $chopCP5=='Local Language'){?>checked="checked"<?php }?>/> Local Language <br/>


<input name="ConsentProcess[]" type="checkbox" value="Other" <?php if($chopCP1=='Other' || $chopCP2=='Other' || $chopCP3=='Other' || $chopCP4=='Other' || $chopCP5=='Other'){?>checked="checked"<?php }?>  onChange="getConsentProcessMain(this.value)"/> Other (Specify)<br />


<div id="ConsentProcessdiv"><?php if($rstudyP['getConsentProcess']){?><input type="text" name="getConsentProcess" id="getConsentProcess" tabindex="9" value="<?php echo $rstudyP['getConsentProcess'];?>" style="width:400px;"/><?php }?> </div>                       
                       </label>
        
                       
    </div> 
                        
 
                             
                         <div class="line"></div>   
                     <div class="form-group row success">
 <?php
	$shcategoryID4=$rstudyP['Readinglevel'];
$categoryChunks4 = explode(".", $shcategoryID4);

$chopRL1="$categoryChunks4[0]";
$chopRL2="$categoryChunks4[1]";
$chopRL3="$categoryChunks4[2]";
$chopRL4="$categoryChunks4[3]";
$chopRL5="$categoryChunks4[4]";


?> <label class="form-control-label col-sm-12"><strong>Reading level of consent document</strong> : <span class="error">*</span></label>
                        
                          <label class="form-control-label">
<input name="Readinglevel" type="radio" value="Primary" <?php if($chopRL1=='Primary' || $chopRL2=='Primary' || $chopRL3=='Primary' || $chopRL4=='Primary' || $chopRL5=='Primary'){?>checked="checked"<?php }?>  onChange="getReadingLevelMain(this.value)"/> Primary <br/>


<input name="Readinglevel" type="radio" value="Secondary" <?php if($chopRL1=='Secondary' || $chopRL2=='Secondary' || $chopRL3=='Secondary' || $chopRL4=='Secondary' || $chopRL5=='Secondary'){?>checked="checked"<?php }?>  onChange="getReadingLevelMain(this.value)"/> Secondary<br/>


<input name="Readinglevel" type="radio" value="Tertiary" <?php if($chopRL1=='Tertiary' || $chopRL2=='Tertiary' || $chopRL3=='Tertiary' || $chopRL4=='Tertiary' || $chopRL5=='Tertiary'){?>checked="checked"<?php }?>  onChange="getReadingLevelMain(this.value)"/> Tertiary<br/>


<input name="Readinglevel" type="radio" value="Other" <?php if($chopRL1=='Other' || $chopRL2=='Other' || $chopRL3=='Other' || $chopRL4=='Other' || $chopRL5=='Other'){?>checked="checked"<?php }?>   onChange="getReadingLevelMain(this.value)"/> Other (Specify)<br />

<div id="ReadingLeveldiv"><?php if($rstudyP['getReadingLevel']){?><input type="text" name="getReadingLevel" id="getReadingLevel" tabindex="9" value="<?php echo $rstudyP['getReadingLevel'];?>" style="width:400px;"/><?php }?></div>  
                          
                       </label>
        
                       
    </div> 
    
 <div class="line"></div>  
  <div class="form-group row success">
<label class="form-control-label col-sm-12"><strong>Community Engagement plan</strong> : <span class="error">*</span></label>
  
   <textarea name="CommunityEngagementplan" id="MyTextBox" cols="" rows="5" class="form-control  required"><?php if($rstudyP['CommunityEngagementplan']){echo $rstudyP['CommunityEngagementplan'];}else{$_POST['CommunityEngagementplan'];}?></textarea>
 
  <p id="countermm">Characters limit: <span  id="countercol">250 words</span></p>                    
</div>
                      
 
                        
                        
                            <div class="line"></div>   
                     <div class="form-group row success">
                      <label class="form-control-label col-sm-12"><strong>Determination of Risk (Check all that applies)</strong> : <span class="error">*</span></label>
                      <?php
$sqlstudyPop2="SELECT * FROM ".$prefix."determination_of_risk where `owner_id`='$asrmApplctID' and protocol_id='$protocol_id' order by id desc limit 0,1";//and status='new'  
$QuerystudyPop2 = $mysqli->query($sqlstudyPop2);
$rstudyP2 = $QuerystudyPop2->fetch_array();?>
  <table border="1" cellspacing="0" cellpadding="0" class="newtable">
  <tr>
    <td width="625" valign="top"><p><strong>Does the research involve any of the    following</strong></p></td>
    <td width="54" valign="top"><p><strong>YES</strong></p></td>
    <td width="55" valign="top"><p><strong>NO</strong></p></td>
  </tr>
  <tr>
    <td width="625" valign="top"><p class="defmf">Human exposure to ionizing radiation</p></td>
    <td width="54" valign="top"><input name="Humanexposure" type="radio" value="Yes" <?php if($rstudyP2['Humanexposure']=='Yes'){?>checked="checked"<?php }?> class="required"/></td>
    <td width="55" valign="top"><input name="Humanexposure" type="radio" value="No" <?php if($rstudyP2['Humanexposure']=='No'){?>checked="checked"<?php }?> class="required"/>
    

    </td>
  </tr>
  <tr>
    <td width="625" valign="top"><p class="defmf">Human genetics</p></td>
    <td width="54" valign="top"><input name="Humangenetics" type="radio" value="Yes" <?php if($rstudyP2['Humangenetics']=='Yes'){?>checked="checked"<?php }?> class="required"/></td>
    <td width="55" valign="top"><input name="Humangenetics" type="radio" value="No" <?php if($rstudyP2['Humangenetics']=='No'){?>checked="checked"<?php }?> class="required"/></td>
  </tr>
  <tr>
    <td width="625" valign="top"><p class="defmf">Stem Cells</p></td>
    <td width="54" valign="top">
    <input name="StemCells" type="radio" value="Yes" <?php if($rstudyP2['StemCells']=='Yes'){?>checked="checked"<?php }?> class="required"/></td>
    <td width="55" valign="top"><input name="StemCells" type="radio" value="No" <?php if($rstudyP2['StemCells']=='No'){?>checked="checked"<?php }?> class="required"/></td>
  </tr>
  <tr>
    <td width="625" valign="top"><p class="defmf">Fetal    tissue or abortus</p></td>
    <td width="54" valign="top"><input name="Fetaltissue" type="radio" value="Yes" <?php if($rstudyP2['Fetaltissue']=='Yes'){?>checked="checked"<?php }?> class="required"/></td>
    <td width="55" valign="top"><input name="Fetaltissue" type="radio" value="No" <?php if($rstudyP2['Fetaltissue']=='No'){?>checked="checked"<?php }?> class="required"/></td>
  </tr>
  <tr>
    <td width="625" valign="top"><p class="defmf">Investigational    new drug</p></td>
    <td width="54" valign="top"><input name="Investigationalnewdrug" type="radio" value="Yes" <?php if($rstudyP2['Investigationalnewdrug']=='Yes'){?>checked="checked"<?php }?> class="required"/></td>
    <td width="55" valign="top"><input name="Investigationalnewdrug" type="radio" value="No" <?php if($rstudyP2['Investigationalnewdrug']=='No'){?>checked="checked"<?php }?> class="required"/></td>
  </tr>
  <tr>
    <td width="625" valign="top"><p class="defmf">Investigational    new device or technique (e.g. therapeutic, diagnostic)</p></td>
    
    <td width="54" valign="top"><input name="Investigationalnewdevice" type="radio" value="Yes" <?php if($rstudyP2['Investigationalnewdevice']=='Yes'){?>checked="checked"<?php }?> class="required"/></td>
    <td width="55" valign="top"><input name="Investigationalnewdevice" type="radio" value="No" <?php if($rstudyP2['Investigationalnewdevice']=='No'){?>checked="checked"<?php }?> class="required"/></td>
  </tr>
  <tr>
    <td width="625" valign="top"><p class="defmf">Existing    data available via public archives/sources</p></td>
    <td width="54" valign="top"><input name="Existingdataavailable" type="radio" value="Yes" <?php if($rstudyP2['Existingdataavailable']=='Yes'){?>checked="checked"<?php }?> class="required"/></td>
    <td width="55" valign="top"><input name="Existingdataavailable" type="radio" value="No" <?php if($rstudyP2['Existingdataavailable']=='No'){?>checked="checked"<?php }?> class="required"/></td>
  </tr>
  <tr>
    <td width="625" valign="top"><p class="defmf">Existing    data not available via public archives</p></td>
    <td width="54" valign="top"><input name="ExistingdataNotavailable" type="radio" value="Yes" <?php if($rstudyP2['ExistingdataNotavailable']=='Yes'){?>checked="checked"<?php }?> class="required"/></td>
    <td width="55" valign="top"><input name="ExistingdataNotavailable" type="radio" value="No" <?php if($rstudyP2['ExistingdataNotavailable']=='No'){?>checked="checked"<?php }?> class="required"/></td>
  </tr>
  <tr>
    <td width="625" valign="top"><p class="defmf">Will    the research involve the use of stored samples/patient data</p></td>
    
    <td width="54" valign="top"><input name="storedsamples" type="radio" value="Yes" <?php if($rstudyP2['storedsamples']=='Yes'){?>checked="checked"<?php }?> class="required"/></td>
    <td width="55" valign="top"><input name="storedsamples" type="radio" value="No" <?php if($rstudyP2['storedsamples']=='No'){?>checked="checked"<?php }?> class="required"/></td>
  </tr>
  <tr>
    <td width="625" valign="top"><p class="defmf">Will the research involve shipping/transfer of specimen</p></td>
     <td width="54" valign="top"><input name="transferofspecimen" type="radio" value="Yes" <?php if($rstudyP2['transferofspecimen']=='Yes'){?>checked="checked"<?php }?> class="required"/></td>
    <td width="55" valign="top"><input name="transferofspecimen" type="radio" value="No" <?php if($rstudyP2['transferofspecimen']=='No'){?>checked="checked"<?php }?> class="required"/></td>
  </tr>
  <tr>
    <td width="625" valign="top"><p class="defmf">Observation    of public behaviour</p></td>
    <td width="54" valign="top"><input name="Observation" type="radio" value="Yes" <?php if($rstudyP2['Observation']=='Yes'){?>checked="checked"<?php }?> class="required"/></td>
    <td width="55" valign="top"><input name="Observation" type="radio" value="No"<?php if($rstudyP2['Observation']=='No'){?>checked="checked"<?php }?>  class="required"/></td>
  </tr>
  <tr>
    <td width="625" valign="top"><p class="defmf">Is the    information going to be recorded in such a way that subjects can be    identified</p></td>    <td width="54" valign="top"><input name="recordedInfo" type="radio" value="Yes" <?php if($rstudyP2['recordedInfo']=='Yes'){?>checked="checked"<?php }?> class="required"/></td>
    <td width="55" valign="top"><input name="recordedInfo" type="radio" value="No" <?php if($rstudyP2['recordedInfo']=='No'){?>checked="checked"<?php }?> class="required"/></td>
  </tr>
  <tr>
    <td width="625" valign="top"><p class="defmf">Does    the research deal with sensitive aspects of the subjects behaviour, sexual    behavior, alcohol use or illegal conduct such as drug use</p></td>
    <td width="54" valign="top"><input name="sensitiveaspects" type="radio" value="Yes" <?php if($rstudyP2['sensitiveaspects']=='Yes'){?>checked="checked"<?php }?> class="required"/></td>
    <td width="55" valign="top"><input name="sensitiveaspects" type="radio" value="No" <?php if($rstudyP2['sensitiveaspects']=='No'){?>checked="checked"<?php }?> class="required"/></td>
  </tr>
  <tr>
    <td width="625" valign="top"><p class="defmf">Could the information recorded    about the individual if it became known outside of the research, place the    subject at risk of criminal prosecution or civil liability</p></td>
    <td width="54" valign="top"><input name="recordedInfobeRecorded" type="radio" value="Yes" <?php if($rstudyP2['recordedInfobeRecorded']=='Yes'){?>checked="checked"<?php }?> class="required"/></td>
    <td width="55" valign="top"><input name="recordedInfobeRecorded" type="radio" value="No" <?php if($rstudyP2['recordedInfobeRecorded']=='No'){?>checked="checked"<?php }?> class="required"/></td>
  </tr>
  <tr>
    <td width="625" valign="top"><p class="defmf">Could    the information recorded about the individual if it became known outside of    the research, damage the subjects financial standing, reputation and    employability?</p></td>
    <td width="54" valign="top"><input name="recordedaboutindividual" type="radio" value="Yes" <?php if($rstudyP2['recordedaboutindividual']=='Yes'){?>checked="checked"<?php }?> class="required"/></td>
    <td width="55" valign="top"><input name="recordedaboutindividual" type="radio" value="No" <?php if($rstudyP2['recordedaboutindividual']=='No'){?>checked="checked"<?php }?> class="required"/></td>
  </tr>
</table>

  

                          
                          </label>
        
                       
    </div> 
                        
<div class="form-group row">
                          <div class="col-sm-4 offset-sm-3">
                    <input name="doSaveThree" type="submit"  class="btn btn-primary" value="Save and Next"/>

                          </div>
                        </div>
   
  </form>
   



<!-- The Modal -->
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
      <span class="close">&times;</span>
      <h3><strong>New Country</strong></h3>
    </div>
    <div class="modal-body">

 <form action="" method="post" name="regForm" id="regForm" >
 
 <div class="form-group row" style="padding-top:10px;">
<label class="col-sm-2 form-control-label">Country:</label>
<div class="col-sm-10">
<select name="countryid" id="countryid" class="form-control  required">
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
</div> 


<div class="form-group row">
<label class="col-sm-2 form-control-label">District:</label>
<div class="col-sm-10">
<select name="district_id" id="district_id" class="form-control  required" onChange="getMunicipality(this.value)">
<?php
$sqlDistrictv = "select * FROM ".$prefix."list_districts order by name asc";//and conceptm_status='new' 
$resultDistrictcv = $mysqli->query($sqlDistrictv);
while($rDistrictcv=$resultDistrictcv->fetch_array()){
?>
<option value="<?php echo $rDistrictcv['id'];?>"><?php echo $rDistrictcv['name'];?></option>
<?php }?>
</select>
</div>
</div>

 <div id="municipalitydiv"></div>
 
 <div id="subcountydiv"></div>

<!--<div class="form-group row">
 
<label class="col-sm-2 form-control-label">Sub County:</label>
<div class="col-sm-10">
<input type="text" name="SubCounty" id="participants" class="form-control  required" value="" required>

</div>
</div>-->

<div class="form-group row">
 
<label class="col-sm-2 form-control-label">Parish:</label>
<div class="col-sm-10">
<input type="text" name="Parish" id="participants" class="form-control  required" value="" required>

</div>
</div>

<div class="form-group row">
 
<label class="col-sm-2 form-control-label">Duration:</label>
<div class="col-sm-10">
<input type="text" name="Duration" id="participants" class="form-control  required" value="" required>

</div>
</div>

 <div class="form-group row">
 
<label class="col-sm-2 form-control-label">No of Participants:</label>
<div class="col-sm-10">
<input type="number" name="participants" id="participants" class="form-control  required" value="" required>
<input name="submission_id" type="hidden" value="<?php echo $rstudy['protocol_id'];?>"/>
<input type="hidden" name="asrmApplctID" value="<?php echo $_SESSION['asrmApplctID'];?>">
</div>
</div>
                        
                  
                        
       
       <div class="form-group row">
                          <div class="col-sm-4 offset-sm-3">
                    <input name="doCountry" type="submit"  class="btn btn-primary" value="Save"/>

                          </div>
                        </div>
                                          
     </form>                   
    </div>
    </div>
    </div><!--End-->
                                     
</div>

<script type="text/javascript">

var countries=new ddajaxtabs("countrytabs", "countrydivcontainer")
countries.setpersist(true)
countries.setselectedClassTarget("link") //"link" or "linkparent"
countries.init()

</script>