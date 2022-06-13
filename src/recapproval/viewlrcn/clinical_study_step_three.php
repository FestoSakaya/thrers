<?php
if(!$id){
	
echo '<meta http-equiv="REFRESH" content="1;url='.$base_url.'/main.php?option=dashboard">';
}
if($_POST['doCountry']=='Save' and $_POST['countryid'] and $_POST['asrmApplctID'] and $_POST['participants'] and $id){

	$countryid=$mysqli->real_escape_string($_POST['countryid']);
	$district_id=$mysqli->real_escape_string($_POST['district_id']);
	$participants=$mysqli->real_escape_string($_POST['participants']);
	$Numberofsamples=$mysqli->real_escape_string($_POST['Numberofsamples']);
	$sasrmApplctID=$mysqli->real_escape_string($_POST['asrmApplctID']);
	$protocol_id=$mysqli->real_escape_string($_POST['protocol_id']);
	
	$Duration=$mysqli->real_escape_string($_POST['Duration']);
	$Durationperiod=$mysqli->real_escape_string($_POST['Durationperiod']);
	$Parish=$mysqli->real_escape_string($_POST['Parish']);
	$SubCounty=$mysqli->real_escape_string($_POST['SubCounty']);
	$Municipality=$mysqli->real_escape_string($_POST['Municipality']);
	
	$gender_idm=$_POST['gender_id'];
$minimum_agem=$_POST['minimum_age'];
$maximum_agem=$_POST['maximum_age'];
	
	
$sqlInvestigators="SELECT * FROM ".$prefix."submission_country where `country_id`='$countryid' and `owner_id`='$sasrmApplctID' and submission_id='$protocol_id'  and participants='$participants' order by id desc";
	$QueryInvestigators = $mysqli->query($sqlInvestigators);
	$totalInvestigators = $QueryInvestigators->num_rows;
	
		if(!$totalInvestigatorsxc){
$sqlA2="insert into ".$prefix."submission_country (`owner_id`,`submission_id`,`country_id`,`district_id`,`created`,`updated`,`participants`,`Municipality`,`SubCounty`,`Parish`,`Duration`,`Durationperiod`,`Numberofsamples`,`gender`,`MinimumAge`,`MaximumAge`) 

values('$sasrmApplctID','$protocol_id','$countryid','$district_id',now(),now(),'$participants','$Municipality','$SubCounty','$Parish','$Duration','$Durationperiod','$Numberofsamples','$gender_idm','$minimum_agem','$maximum_agem')";
$mysqli->query($sqlA2);



////////////////Add Total Participants

//Insert into Submission Stages
$wm="select * from ".$prefix."submission_stages where  owner_id='$sasrmApplctID' and protocol_id='$id' and status='new'";
$cmdwb = $mysqli->query($wm);
$totalStages = $cmdwb->num_rows;
$r= $cmdwb->fetch_array();

if($totalStages){
$sqlASubmissionStages="update ".$prefix."submission_stages  set `RecruitmentCountries`='1' where `owner_id`='$sasrmApplctID' and `protocol_id`='$id'";
$mysqli->query($sqlASubmissionStages);
}

		}
	
}else{
	$participants=$_POST['participants'];
	//$message='<p class="error">Dear '.$session_fullname.', some fields were not added. Please check No of Participants and Country </p>';
	
	
}

?>
<?php
if($_POST['doSaveThree']=='Save and Next' and $_POST['study_design'] and $_POST['asrmApplctID'] and $_POST['health_condition']){

	$study_design=$mysqli->real_escape_string($_POST['study_design']);
	$health_condition=$mysqli->real_escape_string($_POST['health_condition']);
	$gender_id=$mysqli->real_escape_string($_POST['gender_id']);
	$sasrmApplctID=$mysqli->real_escape_string($_POST['asrmApplctID']);
	$sample_size=$mysqli->real_escape_string($_POST['sample_size']);
	$minimum_age=$mysqli->real_escape_string($_POST['minimum_age']);
	$submission_id=$mysqli->real_escape_string($_POST['submission_id']);
	
	$maximum_age=$mysqli->real_escape_string($_POST['maximum_age']);
	$inclusion_criteria=$mysqli->real_escape_string(htmlentities($_POST['inclusion_criteria']));
	$exclusion_criteria=$mysqli->real_escape_string(htmlentities($_POST['exclusion_criteria']));
	//$recruitment_init_date=$mysqli->real_escape_string($_POST['recruitment_init_date']);
	$recruitment_init_date=$mysqli->real_escape_string($_POST['year'].'-'.$_POST['month']);
	
	
	$recruitment_status_id=$mysqli->real_escape_string($_POST['recruitment_status_id']);
	$interventions=$mysqli->real_escape_string(htmlentities($_POST['interventions']));
	$primary_outcome=$mysqli->real_escape_string(htmlentities($_POST['primary_outcome']));
	$secondary_outcome=$mysqli->real_escape_string(htmlentities($_POST['secondary_outcome']));
	$general_procedures=$mysqli->real_escape_string(htmlentities($_POST['general_procedures']));
	$analysis_plan=$mysqli->real_escape_string(htmlentities($_POST['analysis_plan']));
	$ethical_considerations=$mysqli->real_escape_string(htmlentities($_POST['ethical_considerations']));

    $riskLevel=$mysqli->real_escape_string(htmlentities($_POST['riskLevel']));
	

	
if($study_design){

	
$sqlA2Protocol="update ".$prefix."submission  set `study_design`='$study_design',`health_condition`='$health_condition',`recruitment_init_date`='$recruitment_init_date',`minimum_age_period`='$minimum_age_period',`maximum_age_period`='$maximum_age_period' where id='$id' and owner_id='$sasrmApplctID'";
$mysqli->query($sqlA2Protocol);//`general_procedures`='$general_procedures',`analysis_plan`='$analysis_plan',`ethical_considerations`='$ethical_considerations'

$sqlAMethodology="update ".$prefix."clinical_study_methodology set `general_procedures`='$general_procedures',`analysis_plan`='$analysis_plan',`ethical_considerations`='$ethical_considerations',`interventions`='$interventions',`primary_outcome`='$primary_outcome',`secondary_outcome`='$secondary_outcome',`inclusion_criteria`='$inclusion_criteria',`exclusion_criteria`='$exclusion_criteria' where `protocol_id`='$id' and owner_id='$sasrmApplctID'"; 
$mysqli->query($sqlAMethodology);

//Insert into Submission Stages
$wm="select * from ".$prefix."submission_stages where  owner_id='$sasrmApplctID' and protocol_id='$id' and status='new'";
$cmdwb = $mysqli->query($wm);
$totalStages = $cmdwb->num_rows;
$r= $cmdwb->fetch_array();

$sqlstudyData="SELECT * FROM ".$prefix."submission where `owner_id`='$asrmApplctID' and id='$id' order by id desc limit 0,1";
$QuerystudyData = $mysqli->query($sqlstudyData);
$rstudyData = $QuerystudyData->fetch_array();

////Insert multiple
$sqlstudyData2="SELECT * FROM ".$prefix."clinical_study_methodology where `owner_id`='$asrmApplctID' and protocol_id='$id' order by id desc limit 0,1";
$QuerystudyData2 = $mysqli->query($sqlstudyData2);
$rstudyData2 = $QuerystudyData2->fetch_array();


//
$sqlRecruits="SELECT * FROM ".$prefix."submission_country where `owner_id`='$asrmApplctID' and submission_id='$id'  and country_id>=1 and (participants>=1 OR participants='N/A') OR (MaximumAge>=1) order by id desc limit 0,1";
$QueryRecruits = $mysqli->query($sqlRecruits);
$totalRecruitsAresa = $QueryRecruits->num_rows;
// and strlen($rstudyData['study_design'])>10 and strlen($rstudyData['health_condition'])>10
if($totalRecruitsAresa){
	// and $rstudyData['study_design'] and $rstudyData['health_condition'] and $rstudyData2['inclusion_criteria'] and $rstudyData2['exclusion_criteria'] and $rstudyData['recruitment_init_date'] and $rstudyData2['interventions'] and $rstudyData2['primary_outcome'] and $rstudyData2['secondary_outcome'] and $totalStagesAge
$sqlASubmissionStages="update ".$prefix."submission_stages  set `study_description`='1',`RecruitmentCountries`='1' where `owner_id`='$sasrmApplctID' and `protocol_id`='$id'";
$mysqli->query($sqlASubmissionStages);
echo '<meta http-equiv="REFRESH" content="0;url='.$base_url.'/main.php?option=StudyPopulation&id='.$id.'">';
echo '<img src="images/loading_wait.gif">';
echo '<div class="spacer"></div>';
}else{$sqlASubmissionStages="update ".$prefix."submission_stages  set `study_description`='0',`RecruitmentCountries`='0' where `owner_id`='$sasrmApplctID' and `protocol_id`='$id'";
$mysqli->query($sqlASubmissionStages);

$message='<p class="error">Dear '.$session_fullname.', there is a problem with recruitment areas, check Participants, Gender, Minimum and Maximum Totals</p>';
}

logaction("$session_fullname updated protocol");



}///end $minimum_age and Max age comparison
}//end post



$sqlstudy="SELECT * FROM ".$prefix."submission where `owner_id`='$asrmApplctID' and id='$id' order by id desc limit 0,1";
$Querystudy = $mysqli->query($sqlstudy);
$totalstudy = $Querystudy->num_rows;
$rstudy = $Querystudy->fetch_array();
$protocol_id=$rstudy['protocol_id'];

$sqlmethodology="SELECT * FROM ".$prefix."clinical_study_methodology where `owner_id`='$asrmApplctID' and protocol_id='$id' order by id desc limit 0,1";
$Querymethodology = $mysqli->query($sqlmethodology);
$rstudymethodology = $Querymethodology->fetch_array();

//submission_stages
$sqlSub_Stages="SELECT * FROM ".$prefix."submission_stages where `owner_id`='$asrmApplctID' and protocol_id='$id' and status='new' order by id desc limit 0,1";
$QuerySub_stages = $mysqli->query($sqlSub_Stages);
$totalSub_Stages = $QuerySub_stages->num_rows;
$rsSubStages = $QuerySub_stages->fetch_array();

if($category=="DelsubmissionThird"){
$upDelete="delete from ".$prefix."study_description_age  where owner_id='$asrmApplctID' and protocol_id='$id' and id='$mid'";
$mysqli->query($upDelete);

$sqlAgeTotal="SELECT * FROM ".$prefix."study_description_age where `owner_id`='$asrmApplctID' and protocol_id='$id' order by id desc limit 0,1";
$QueryAgeTotal = $mysqli->query($sqlAgeTotal);
$totalStagesAgeTotal = $QueryAgeTotal->num_rows;
if(!$totalStagesAgeTotal){
$sqlASubmissionStages2="update ".$prefix."submission_stages  set `study_description`='0' where `owner_id`='$asrmApplctID' and `protocol_id`='$id'";
//$mysqli->query($sqlASubmissionStages2);	
}

}

?>
<?php include("viewlrcn/final_button.php");?>
<ul id="countrytabs" class="shadetabs">
<?php if($totalstudy>=1){?><li><a href="./main.php?option=submission&id=<?php echo $id;?>" <?php if($rsSubStages['protocol_information']==1 and $rsSubStages['protocol_team']==1){?> style="background:green; color:#FFF;" <?php }?>>Protocol Information</a></li><?php }?>
<?php if(!$totalstudy){?><li class="extra" <?php if($rsSubStages['protocol_information']==1 and $rsSubStages['protocol_team']==1){?> style="background:green; color:#FFF;" <?php }?>>Protocol Information</li><?php }?>

<?php if($totalstudy>=1){?><li><a href="./main.php?option=submissionSecond&id=<?php echo $id;?>" <?php if($rsSubStages['protocol_details']==1){?> style="background:green; color:#FFF;" <?php }?>>Protocol Details</a></li><?php }?>
<?php if(!$totalstudy){?><li class="extra" <?php if($rsSubStages['protocol_details']==1){?> style="background:green; color:#FFF;" <?php }?>>Protocol Details</li><?php }?>


<li><a href="#" rel="#default" class="selected" <?php if($rsSubStages['study_description']==1 and $rsSubStages['RecruitmentCountries']==1){?> style="background:green; color:#FFF;" <?php }?>>Study Description</a></li>

<?php if($totalstudy>=1){?><li><a href="./main.php?option=StudyPopulation&id=<?php echo $id;?>" <?php if($rsSubStages['study_population']==1){?> style="background:green; color:#FFF;" <?php }?>>Study Population</a></li><?php }?>
<?php if(!$totalstudy){?><li class="extra" <?php if($rsSubStages['study_population']==1){?> style="background:green; color:#FFF;" <?php }?>>Study Population</li><?php }?>

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
                     <!-- <div class="progress">
                        <div role="progressbar" style="width: 45%; height: 6px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" class="progress-bar bg-red"></div>
                      </div>-->
                      
       <?php include("viewlrcn/status_log.php");?>


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
	
	var inp4 = new_row.cells[4].getElementsByTagName('input')[0];
    inp4.id += len;
    inp4.value = '';/**/
	
	var inp5 = new_row.cells[5].getElementsByTagName('input')[0];
    inp5.id += len;
    inp5.value = '';/**/
	new_row.cells[6].getElementsByTagName('input')[0].removeAttribute('style');
    x.appendChild( new_row );
}


</script>
 <?php

if(isset($message)){echo $message;}

if($_GET['call']=="remove"){
	$part=$_GET['part'];
$upDelete="delete from ".$prefix."submission_country  where id='$part'";
$mysqli->query($upDelete);
}
//if no page var is given, set start to 0
$sql = "select *,DATE_FORMAT(`created`,'%d/%m/%Y %H:%s:%i') AS created FROM ".$prefix."submission_country where owner_id='$asrmApplctID' and submission_id='$id' order by id desc LIMIT 0,200";//and conceptm_status='new' 
$result = $mysqli->query($sql);
$totalSubmissionCountry = $result->num_rows;
?>
<h3>Recruitment Area(s): <span class="error">*</span></h3>
                 
<?php if($totalSubmissionCountry>=5){?><div  style="height:300px; overflow:scroll;"><?php }?>
 <table class="table table-striped table-sm" id="customers">
                        <thead>
                          <tr>
                            <th>Country</th>
                            <th>District</th>
                            <th>County</th>
                            <th>Sub County</th>
                            <th>Parish</th>
                            <th>Duration</th>
                            <th>Sex</th>
                            <th>Total No of participants</th>
                            <th>&nbsp;</th>
                             <th>&nbsp;</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php

while($rInvestigator=$result->fetch_array()){
$countryid=$rInvestigator['country_id'];
$districtm_id=$rInvestigator['district_id'];
$Municipality=$rInvestigator['Municipality'];
$municipalitityID=$rInvestigator['Municipality'];
//study_description_age

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

$gender=$rInvestigator['gender'];
	
$sqlGender2 = "select * FROM ".$prefix."list_gender where id='$gender'";//and conceptm_status='new' 
$resultGender2 = $mysqli->query($sqlGender2);
$rGender2=$resultGender2->fetch_array();

	?>
                          <tr>
                            <td><?php echo $rCountry['name'];?></td>
                            <td><?php echo $rDistrict['districtm_name'];?></td>
                            <td><?php echo $rmunicipalities['municipalitityName'];?></td>
                            <td><?php echo $rInvestigator['SubCounty'];?></td>
                            <td><?php echo $rInvestigator['Parish'];?></td>
                            <td><?php echo $rInvestigator['Duration'];?> <?php echo $rInvestigator['Durationperiod'];?></td>
                            <td><?php echo $rGender2['name'];?></td>
                            <td><?php echo $rInvestigator['participants'];?></td>
                            <td><input id="go" type="button" value="Update/View details" onclick="window.open('<?php echo $base_url;?>updateareas.php?id=<?php echo $rInvestigator['id'];?>','popUpWindow','height=700, width=1000, left=100, top=100, resizable=yes, scrollbars=yes, toolbar=yes, menubar=no, location=no, directories=no, status=yes');"  class="errorm4" ></td>
                            <td><a href="main.php?option=submissionThird&id=<?php echo $protocol_id;?>&call=remove&part=<?php echo $rInvestigator['id'];?>" style="color:#F00; font-weight:bold;" onclick="return confirm('Are you sure you want to delete this Institution?');">Remove</a></td>
                          </tr>
   <?php 
  if($rInvestigator['participants']>=1 and $rInvestigator['participants']!='N/A'){ $totalParticpants=($totalParticpants+$rInvestigator['participants']);}
   }///////////end function ?>  
   
    <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <<td></td>
                            <th><strong><?php echo $totalParticpants;?></strong></th>
                            <td></td>
                             <td></td>
                          </tr>               
                        </tbody>
                      </table>
                    <?php if($totalSubmissionCountry>=5){?> </div><?php }?>
   <!-- Trigger/Open The Modal -->
<button id="myBtn">Add New </button>        
  <div style="clear:both;"></div>                      
<form action="<?php echo $base_url;?>main.php?option=submissionThird&id=<?php echo $id;?>" method="post" name="regForm" id="regForm" autocomplete="false">                        
                   
                        
                        
                        
                        
      
   <div style="clear:both;"></div>                   
                        <div class="form-group row success">
                          <label class="col-sm-2 form-control-label">Study design: <span class="error">*</span></label>
                          <textarea name="study_design" id="mawanda1hh" cols="" rows="5" class="form-control  required"><?php if($rstudy['study_design']){echo $rstudy['study_design'];}else{$_POST['study_design'];}?></textarea>
                        </div>
                        <div class="line"></div>
                        
                        
    <div class="form-group row success">
                          <label class="col-sm-6 form-control-label">Health Condition or Problem Studied: <span class="error">*</span></label>
                         <textarea name="health_condition" id="mawanda2mm" cols="" rows="5" class="form-control  required"><?php if($rstudy['health_condition']){echo $rstudy['health_condition'];}else{$_POST['health_condition'];}?></textarea>
                           
                            <input name="protocol_id" type="hidden" value="<?php echo $id;?>"/>
                            <input type="hidden" name="asrmApplctID" value="<?php echo $_SESSION['asrmApplctID'];?>">
                            <input type="hidden" name="submission_id" value="<?php echo $rstudy['id'];?>">
                       
                        </div>
                        
  
   <div class="line"></div>
                        
 
  
                        
                        
                        
                        
                        
<div class="line"></div>
                        
                          <div class="form-group row success">
                          <label class="col-sm-2 form-control-label">Inclusion criteria: <span class="error">*</span></label>
                          <textarea name="inclusion_criteria" id="mawanda3mm" cols="" rows="5" class="form-control  required"><?php if($rstudymethodology['inclusion_criteria']){echo $rstudymethodology['inclusion_criteria'];}else{$_POST['inclusion_criteria'];}?></textarea>
                        </div>
                        <div class="line"></div>
                        
                        
                         <div class="form-group row success">
                          <label class="col-sm-2 form-control-label">Exclusion criteria: <span class="error">*</span> </label>
                          <textarea name="exclusion_criteria" id="mawanda4xxx" cols="" rows="5" class="form-control  required"><?php if($rstudymethodology['exclusion_criteria']){echo $rstudymethodology['exclusion_criteria'];}else{$_POST['exclusion_criteria'];}?></textarea>
                          
                        </div>
                        <div class="line"></div>
                        
<div class="form-group row success">
<label class="col-sm-7 form-control-label">Estimated date of initial recruitment:</label>
   <?php
   $shcategoryID4=$rstudy['recruitment_init_date'];
$categoryChunks = explode("-", $shcategoryID4);
$chop1="$categoryChunks[0]";
$chop2="$categoryChunks[1]";
$chop3="$categoryChunks[2]";
$currentMonth=date("m");
?>
<?php
//Get current Month
$previousMonth=date("m");

include("viewlrcn/previous_months.php");
?>                         
                           
  
                              
    <select name="year" id="dyear" class="form-control" tabindex="8" style=" width:100px; float:left;">
<option value="">Year</option>
<?php
define('DOB_YEAR_START', 2019+1);

$current_year = date('Y')+1;

for ($count = $current_year; $count >= DOB_YEAR_START; $count--)
{
?>
 <option value="<?php echo $count;?>"  <?php if($chop1==$count){?> selected="selected"<?php }?>><?php echo $count;?></option>
<?php }?>

  </select>

    </div>
                        
                        
                       
                        <div class="line"></div>
                        
         
                      <?php if($rstudy['is_clinical_trial']==1){?>
                     <div class="form-group row success">
                          <label class="col-sm-4 form-control-label">Interventions: <span class="error">*</span></label>
                          <textarea name="interventions" id="mawanda5bb" cols="" rows="5" class="form-control  required"><?php if($rstudymethodology['interventions']){echo $rstudymethodology['interventions'];}else{$_POST['interventions'];}?></textarea>
                          
                   </div>
                        <div class="line"></div>
                        <?php }?>   
                        
                        
                     <?php if($rstudy['is_clinical_trial']==0){?>
                     <div class="form-group row success">
                          <label class="col-sm-4 form-control-label">Interventions: </label>
                          <textarea name="interventions" id="mawanda5vvv" cols="" rows="5" class="form-control"><?php if($rstudymethodology['interventions']){echo $rstudymethodology['interventions'];}else{$_POST['interventions'];}?></textarea>
                          
                   </div>
                        <div class="line"></div>
                        <?php }?> 
                        
                        
                        <div class="form-group row success">
                          <label class="col-sm-4 form-control-label">Primary outcomes: <span class="error">*</span></label>
                          <textarea name="primary_outcome" id="mawanda6gg" cols="" rows="5" class="form-control  required"><?php if($rstudymethodology['primary_outcome']){echo $rstudymethodology['primary_outcome'];}else{$_POST['primary_outcome'];}?></textarea>
                          
                        </div>
                        <div class="line"></div>   
                        
                        
                         <div class="form-group row success">
                          <label class="col-sm-4 form-control-label">Secondary outcomes: <span class="error">*</span></label>
                          <textarea name="secondary_outcome" id="mawanda7cc" cols="" rows="5" class="form-control  required"><?php if($rstudymethodology['secondary_outcome']){echo $rstudymethodology['secondary_outcome'];}else{$_POST['secondary_outcome'];}?></textarea>
                          
                        </div>
                        <div class="line"></div>  
                        
                        <h2>Methodology</h2>
                        <div class="form-group row success">
                          <label class="col-sm-4 form-control-label">General Procedures: <span class="error">*</span></label>
                          <textarea name="general_procedures" id="mawanda8cc" cols="" rows="5" class="form-control  required"><?php if($rstudymethodology['general_procedures']){echo $rstudymethodology['general_procedures'];}else{$_POST['general_procedures'];}?></textarea>
                          
                        </div>
                        <div class="line"></div> 
                        
                        <div class="form-group row success">
                          <label class="col-sm-4 form-control-label">Analysis Plan: <span class="error">*</span></label>
                          <textarea name="analysis_plan" id="mawanda9cc" cols="" rows="5" class="form-control  required"><?php if($rstudymethodology['analysis_plan']){echo $rstudymethodology['analysis_plan'];}else{$_POST['analysis_plan'];}?></textarea>
                          
                        </div>
                        <div class="line"></div> 
                        
                            <div class="form-group row success">
                          <label class="col-sm-4 form-control-label">Ethical Considerations: <span class="error">*</span></label>
                          <textarea name="ethical_considerations" id="mawanda10xx" cols="" rows="5" class="form-control  required"><?php if($rstudymethodology['ethical_considerations']){echo $rstudymethodology['ethical_considerations'];}else{$_POST['ethical_considerations'];}?></textarea>
                          <!--
                          <p id="countermm">Characters limit: <span  id="countercol">100 words</span></p> -->
                          
                        </div>
                        
                        
                        <div class="line"></div> 
                        
                         <?php /*?>    <div class="form-group row success">
                         <label class="col-sm-4 form-control-label">Risk Level: <span class="error">*</span></label>
<label class="col-sm-12 form-control-label"><input name="riskLevel" type="radio" value="No Greater than Minimal Risk"  onChange="getRiskType(this.value)" <?php if($rstudy['riskLevel']=='No Greater than Minimal Risk'){?>checked="checked"<?php }?>/> No Greater than Minimal Risk<br /></label>
                          
<label class="col-sm-12 form-control-label"><input name="riskLevel" type="radio" value="Minor Increase over Minimal Risk"   onChange="getRiskType(this.value)" <?php if($rstudy['riskLevel']=='Minor Increase over Minimal Risk'){?>checked="checked"<?php }?>/> Minor Increase over Minimal Risk<br /></label>
                          
<label class="col-sm-12 form-control-label"> <input name="riskLevel" type="radio" value="Moderate Risk"   onChange="getRiskType(this.value)" <?php if($rstudy['riskLevel']=='Moderate Risk'){?>checked="checked"<?php }?>/> Moderate Risk<br /></label>
                         
<label class="col-sm-12 form-control-label"><input name="riskLevel" type="radio" value="High Risk"   onChange="getRiskType(this.value)" <?php if($rstudy['riskLevel']=='High Risk'){?>checked="checked"<?php }?>/> High Risk <br /></label>

<div id="riskdiv"></div>
               
                        </div><?php */?>
                        
                        
                        
                        <div class="line"></div> 
                        
                        
                         
                        
                        <div class="form-group row">
                          <div class="col-sm-4 offset-sm-3">
                    <input name="doSaveThree" type="submit"  class="btn btn-primary" value="Save and Next"/>

                          </div>
                        </div>
   
  </form>
   



<!-- The Modal -->
<div id="myModal" class="modal" style="margin-top:70px;">

  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
      <span class="close">&times;</span>
      <h3><strong>New Country</strong></h3>
    </div>
    <div class="modal-body" style="height:300px; overflow:scroll;">

 <form action="" method="post" name="regForm" id="regForm" >
 
 <div class="form-group row" style="padding-top:10px;">
<label class="col-sm-2 form-control-label">Country:</label>
<div class="col-sm-10">
<select name="countryid" id="countryid" class="form-control  required"  onChange="getRecruitCountry(this.value)">
<option value="">Please Select Country</option>
<option value="895">N/A</option>
<option value="800">Uganda</option>
<?php
$sqlCountrycv = "select * FROM ".$prefix."list_country order by name asc";//and conceptm_status='new' 
$resultCountrycv = $mysqli->query($sqlCountrycv);
while($rCountrycv=$resultCountrycv->fetch_array()){
?>
<option value="<?php echo $rCountrycv['id'];?>"><?php echo $rCountrycv['name'];?></option>
<?php }?>
</select>
</div>
</div> 

<div id="ifuganda"><!--Begin if Uganda-->

</div><!--End if Uganda-->

 <div id="municipalitydiv"></div>
 
 <div id="subcountydiv"></div>

<!--<div class="form-group row">
 
<label class="col-sm-2 form-control-label">Sub County:</label>
<div class="col-sm-10">
<input type="text" name="SubCounty" id="participants" class="form-control  required" value="" required>

</div>
</div>-->



<!--<div class="form-group row">-->

<div id="ifuganda"></div><!--If country is N/A-->


<!--</div>-->

 <div class="form-group row">
 
<label class="col-sm-2 form-control-label">No of Participants:</label>
<div class="col-sm-10">
<input type="text" name="participants" id="participants" class="form-control  required" value="" required>
<input name="protocol_id" type="hidden" value="<?php echo $id;?>"/>
<input type="hidden" name="asrmApplctID" value="<?php echo $_SESSION['asrmApplctID'];?>">
</div>


</div>


 <div class="form-group row">
 
<label class="col-sm-2 form-control-label">Sex:</label>
<div class="col-sm-10">
  <select name="gender_id" id="gender_id" class="form-control" required>
    <option value="">Please select Sex</option>
<?php
$sqlGender = "select * FROM ".$prefix."list_gender  where display='Yes' order by status asc";//and conceptm_status='new' 
$resultGender = $mysqli->query($sqlGender);
while($rGender=$resultGender->fetch_array()){
?>
<option value="<?php echo $rGender['id'];?>" <?php if($rstudy['gender_id']==$rGender['id']){?>selected="selected"<?php }?>><?php echo $rGender['name'];?></option>
<?php }?>
</select>
</div>


</div>


<div class="form-group row">
 
<label class="col-sm-2 form-control-label">Minimum Age:</label>
<div class="col-sm-10">
<input type="text" name="minimum_age" id="minimum_age" class="form-control number" value="" autocomplete="off" required>
</div>


</div>

<div class="form-group row">
 
<label class="col-sm-2 form-control-label">Maximum Age:</label>
<div class="col-sm-10">
<input type="text" name="maximum_age" id="maximum_age" class="form-control number" value=""  autocomplete="off" required>
</div>


</div>


                        

<div id="ifuganda"></div><!--If country is N/A-->               
                        
       
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