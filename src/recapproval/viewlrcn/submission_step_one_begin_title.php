<ul id="countrytabs" class="shadetabs">
<li><a href="#" rel="#default" class="selected" <?php if($rsSubStages['protocol_information']==1 and $rsSubStages['protocol_team']==1){?> style="background:green; color:#FFF;" <?php }?>>Protocol Information</a></li>


<?php if($totalstudy>=1){?><li><a href="./main.php?option=submissionSecond&id=<?php echo $id;?>" <?php if($rsSubStages['protocol_details']==1){?> style="background:green; color:#FFF;" <?php }?>>Protocol Details</a></li><?php }?>
<?php if(!$totalstudy){?><li class="extra" <?php if($rsSubStages['protocol_details']==1){?> style="background:green; color:#FFF;" <?php }?>>Protocol Details</li><?php }?>

<?php if($totalstudy>=1){?><li><a href="./main.php?option=submissionThird&id=<?php echo $id;?>" <?php if($rsSubStages['study_description']==1 and $rsSubStages['RecruitmentCountries']==1){?> style="background:green; color:#FFF;" <?php }?>>Study Description</a></li><?php }?>
<?php if(!$totalstudy){?><li class="extra" <?php if($rsSubStages['study_description']==1 and $rsSubStages['RecruitmentCountries']==1){?> style="background:green; color:#FFF;" <?php }?>>Study Description</li><?php }?>

<?php if($totalstudy>=1){?><li><a href="./main.php?option=StudyPopulation&id=<?php echo $id;?>" <?php if($rsSubStages['study_population']==1){?> style="background:green; color:#FFF;" <?php }?>>Study Population</a></li><?php }?>
<?php if(!$totalstudy){?><li class="extra" <?php if($rsSubStages['study_population']==1){?> style="background:green; color:#FFF;" <?php }?>>Study Population</li><?php }?>


<?php if($rstudy['is_clinical_trial']==1){?>
<?php if($totalstudy>=1){?><li><a href="./main.php?option=submissionFour&id=<?php echo $id;?>" <?php if($rsSubStages['registry']==1){?> style="background:green; color:#FFF;" <?php }?>>Registry</a></li><?php }?>
<?php if(!$totalstudy){?><li class="extra" <?php if($rsSubStages['registry']==1){?> style="background:green; color:#FFF;" <?php }?>>Registry</li><?php }}?>

<?php if($totalstudy>=1){?><li><a href="./main.php?option=submissionBudget&id=<?php echo $id;?>" <?php if($rsSubStages['budget']==1){?> style="background:green; color:#FFF;" <?php }?>>Budget</a></li><?php }?>
<?php if(!$totalstudy){?><li class="extra" <?php if($rsSubStages['budget']==1){?> style="background:green; color:#FFF;" <?php }?>>Budget</li><?php }?>

<?php if($totalstudy>=1){?><li><a href="./main.php?option=submissionSchedule&id=<?php echo $id;?>" <?php if($rsSubStages['study_work_plan']==1){?> style="background:green; color:#FFF;" <?php }?>>Study Work Plan</a></li><?php }?>
<?php if(!$totalstudy){?><li class="extra" <?php if($rsSubStages['study_work_plan']==1){?> style="background:green; color:#FFF;" <?php }?>>Study Work Plan</li><?php }?>

<?php /*?><?php if($totalstudy>=1){?><li><a href="./main.php?option=submissionFive/<?php echo $rstudy['id'];?>/" <?php if($rsSubStages['bibliography']==1){?> style="background:green; color:#FFF;" <?php }?>>Bibliography</a></li><?php }?>
<?php if(!$totalstudy){?><li class="extra"<?php if($rsSubStages['bibliography']==1){?> style="background:green; color:#FFF;" <?php }?>>Bibliography</li><?php }?><?php */?>

<?php if($totalstudy>=1){?><li><a href="./main.php?option=submissionSix&id=<?php echo $id;?>" <?php if($rsSubStages['filem']==1){?> style="background:green; color:#FFF;" <?php }?>>Attached Files</a></li><?php }?>
<?php if(!$totalstudy){?><li class="extra" <?php if($rsSubStages['filem']==1){?> style="background:green; color:#FFF;" <?php }?>>Attached Files</li><?php }?>


<?php if($totalstudy>=1){?><li><a href="./main.php?option=submissionFinish&id=<?php echo $id;?>" <?php if($rsSubStages['payments']==1){?> style="background:green; color:#FFF;" <?php }?>>Payments</a></li><?php }?>
<?php if(!$totalstudy){?><li class="extra" <?php if($rsSubStages['payments']==1){?> style="background:green; color:#FFF;" <?php }?>>Payments</li><?php }?>
</ul>

<div id="countrydivcontainer" style="border:0px solid gray; width:100%; margin-bottom: 1em; padding: 10px">


<?php
if($_POST['doQuestionOne']=='Save and Next' and $_POST['recAffiliated_id'] and $_POST['title'] and $_POST['asrmApplctID'] and $_SESSION['asrmApplctID']){
///Yes
$title=$mysqli->real_escape_string($_POST['title']);
	$acronym=$mysqli->real_escape_string($_POST['acronym']);
	$sasrmApplctID=$mysqli->real_escape_string($_POST['asrmApplctID']);
	$recAffiliated_id=$mysqli->real_escape_string($_POST['recAffiliated_id']);

$sqlA2="insert into ".$prefix."protocol (`owner_id`,`main_submission_id`,`meeting_id`,`created`,`updated`,`migrated_id`,`code`,`status`,`reject_reason`,`committee_screening`,`opinion_required`,`date_informed`,`updated_in`,`revised_in`,`decision_in`,`monitoring_action_next_date`,`period`,`recAffiliated_id`,`attachacadimcpaper`,`antiplagiarism`) 

values('$sasrmApplctID','','',now(),now(),'','','','','','','','','','','','','$recAffiliated_id','$attachacadimcpaper2','$antiplagiarism2')";
$mysqli->query($sqlA2);
$record_id = $mysqli->insert_id;


//if($record_id){
$sqlA2Protocol="insert into ".$prefix."submission (`protocol_id`,`original_submission_id`,`owner_id`,`recruitment_status_id`,`gender_id`,`created`,`updated`,`language`,`is_translation`,`number`,`public_title`,`scientific_title`,`title_acronym`,`is_clinical_trial`,`is_sent`,`abstract`,`keywords`,`introduction`,`justification`,`goals`,`study_design`,`health_condition`,`sample_size`,`minimum_age`,`maximum_age`,`recruitment_init_date`,`general_procedures`,`analysis_plan`,`ethical_considerations`,`clinical_trial_secondary`,`funding_source`,`primary_sponsor`,`secondary_sponsor`,`bibliography`,`sscientific_contact`,`prior_ethical_approval`,`clinical_trial_type`,`approvaletter`,`status`,`recAffiliated_id`,`type_of_review`,`protocol_academic_type`,`protocol_academic`,`PACTR_number`,`involve_Human_participants`,`drug_related_clinical_trial`,`independentstudy`,`independentstudy_refNo`,`institutionCode`) 

values('$record_id','','$sasrmApplctID','','',now(),now(),'en','1','1','$title','$title','$acronym','$is_clinical_trial','0','','','','','','','','','','','','','','','','','','','','','','$clinical_trial_type','','Pending Final Submission','$recAffiliated_id','$type_of_review','$protocol_academic_type','$protocol_academic','$PACTR_number','$involve_Human_participants','$drug_related_clinical_trial','$independentstudy','$independentstudy_refNo','$institutionCode')";
$mysqli->query($sqlA2Protocol);

//$sqlTeam2="update ".$prefix."team set protocol_id='$record_id' where `owner_id`='$asrmApplctID' and status='new'";
//$mysqli->query($sqlTeam2);
////////////////////Addd Methodology apvr_clinical_study_methodology
$sqlAMethodology="insert into ".$prefix."clinical_study_methodology (`protocol_id`,`general_procedures`,`owner_id`,`analysis_plan`,`ethical_considerations`,`is_sent`) 

values('$record_id','','$sasrmApplctID','','','0')";
$mysqli->query($sqlAMethodology);

$sqlASubmissionStages="insert into ".$prefix."submission_stages (`owner_id`,`protocol_id`,`protocol_information`,`protocol_team`,`protocol_details`,`study_description`,`RecruitmentCountries`,`registry`,`budget`,`study_work_plan`,`bibliography`,`filem`,`payments`,`dateCreated`,`status`)  values('$sasrmApplctID','$record_id','0','0','0','0','0','0','0','0','0','0','0',now(),'new')";
$mysqli->query($sqlASubmissionStages);

if($record_id){
	echo '<img src="images/loading_wait.gif">';
echo '<div class="spacer"></div>';
echo '<meta http-equiv="REFRESH" content="0;url='.$base_url.'/main.php?option=submission&id='.$record_id.'">';
}
//
	
}

?>

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
		
    /*var inp3 = new_row.cells[3].getElementsByTagName('input')[0];
    inp3.id += len;
    inp3.value = '';*/
	new_row.cells[3].getElementsByTagName('input')[0].removeAttribute('style');
    x.appendChild( new_row );
}


</script>

<div style="padding-bottom:10px;"></div>

<hr />

<form action="" method="post" name="regForm" id="regForm" autocomplte="false">
 

                         
<div class="form-group row success">


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

<input type="hidden" name="asrmApplctID" value="<?php echo $_SESSION['asrmApplctID'];?>">
                          </div>
                        </div>
</div>



                         
                         
<?php /*?><div class="form-group row success">
<label class="col-sm-4 form-control-label">Is the study a drug related Clinical trial? <span class="error">*</span></label>

<div class="col-sm-6">
<input name="drug_related_clinical_trial" type="radio" value="Yes" class="required" <?php if($rstudy['drug_related_clinical_trial']=='Yes'){?>checked="checked"<?php }?>/> Yes &nbsp;
                          
<input name="drug_related_clinical_trial" type="radio" value="No" class="required" <?php if($rstudy['drug_related_clinical_trial']=='No'){?>checked="checked"<?php }?>/> No<br />
                          
</div>
</div>        
        <?php */?>            
                    


                        
                        <div class="form-group row">
                          <div class="col-sm-4 offset-sm-3">
                    <input name="doQuestionOne" type="submit"  class="btn btn-primary" value="Save and Next"/>

                          </div>
                        </div>
   
   </form>
                                     
</div>

<script type="text/javascript">

var countries=new ddajaxtabs("countrytabs", "countrydivcontainer")
countries.setpersist(true)
countries.setselectedClassTarget("link") //"link" or "linkparent"
countries.init()

</script>