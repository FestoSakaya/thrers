<?php
if($_POST['doCountry']=='Save' and $_POST['clinical_trial_name_id'] and $_POST['asrmApplctID'] and $_POST['number'] and $id){

	$clinical_trial_name_id=$mysqli->real_escape_string($_POST['clinical_trial_name_id']);
	$number=$mysqli->real_escape_string($_POST['number']);
	$sasrmApplctID=$mysqli->real_escape_string($_POST['asrmApplctID']);
	$protocol_id=$mysqli->real_escape_string($_POST['protocol_id']);
	$NewClinicalRegistry=$mysqli->real_escape_string($_POST['NewClinicalRegistry']);
	
$sqlInvestigators="SELECT * FROM ".$prefix."submission_clinical_trial where `owner_id`='$sasrmApplctID' and clinical_trial_name_id='$clinical_trial_name_id' and submission_id='$protocol_id' and number='$number' order by id desc";
	$QueryInvestigators = $mysqli->query($sqlInvestigators);
	$totalInvestigators = $QueryInvestigators->num_rows;
	
		if(!$totalInvestigators){
$sqlA2="insert into ".$prefix."submission_clinical_trial (`owner_id`,`clinical_trial_name_id`,`submission_id`,`created`,`updated`,`number`,`date`,`NewClinicalRegistry`) 

values('$sasrmApplctID','$clinical_trial_name_id','$protocol_id',now(),now(),'$number',now(),'$NewClinicalRegistry')";
$mysqli->query($sqlA2);

		}
	
}?>
<?php
if($_POST['doSaveFour']=='Save and Next' and $_POST['asrmApplctID'] and $id){

	$clinical_trial_secondary=$mysqli->real_escape_string($_POST['clinical_trial_secondary']);
	$submission_id=$mysqli->real_escape_string($_POST['submission_id']);
	$sasrmApplctID=$mysqli->real_escape_string($_POST['asrmApplctID']);

$sqlA2Protocol="update ".$prefix."submission  set `clinical_trial_secondary`='$clinical_trial_secondary' where id='$submission_id' and owner_id='$sasrmApplctID'";
$mysqli->query($sqlA2Protocol);

//Insert into Submission Stages
$wm="select * from ".$prefix."submission_stages where  owner_id='$sasrmApplctID' and protocol_id='$submission_id' and status='new'";
$cmdwb = $mysqli->query($wm);
$totalStages = $cmdwb->num_rows;
$r= $cmdwb->fetch_array();
if($totalStages){
$sqlASubmissionStages="update ".$prefix."submission_stages  set `registry`='1' where `owner_id`='$sasrmApplctID' and `protocol_id`='$submission_id'";
$mysqli->query($sqlASubmissionStages);
}

$message='<p class="success">Dear '.$session_fullname.', details have been submitted, proceed to continue</p>';
logaction("$session_fullname updated protocol");

	//update edited table...
$sqlURevisions="SELECT * FROM ".$prefix."updated_sections where `owner_id`='$sasrmApplctID' and protocol_id='$submission_id' and status='pending' order by id desc limit 0,1";
$QueryUserRevions = $mysqli->query($sqlURevisions);
$totalUsersRevions = $QueryUserRevions->num_rows;
if(!$totalUsersRevions){
$sqlAREvisedSections="insert into ".$prefix."updated_sections (`owner_id`,`protocol_id`,`protocol_information`,`protocol_team`,`protocol_details`,`study_description`,`RecruitmentCountries`,`registry`,`budget`,`study_work_plan`,`bibliography`,`attachments`,`payments`,`study_population`,`dateupdated`,`status`) 

values('$sasrmApplctID','$submission_id','','','','','','1','','','','','','',now(),'pending')";
$mysqli->query($sqlAREvisedSections);
}
if($totalUsersRevions){

$sqlAREvisedSections_update="update ".$prefix."updated_sections  set `registry`='1' where owner_id='$sasrmApplctID' and protocol_id='$submission_id' and status='pending'";
$mysqli->query($sqlAREvisedSections_update);	
}/////////////////end updated sections

echo '<img src="images/loading_wait.gif">';
echo '<div class="spacer"></div>';
echo '<meta http-equiv="REFRESH" content="0;url='.$base_url.'/main.php?option=submissionBudgetUp&id='.$id.'">';

}//end post


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
<?php if($totalstudy>=1){?><li><a href="./main.php?option=submissionCheck&id=<?php echo $rstudy['id'];?>" <?php if($rsSubStages['protocol_information']==1 and $rsSubStages['protocol_team']==1){?> style="background:green; color:#FFF;" <?php }?>>Protocol Information</a></li><?php }?>
<?php if(!$totalstudy){?><li class="extra" <?php if($rsSubStages['protocol_information']==1 and $rsSubStages['protocol_team']==1){?> style="background:green; color:#FFF;" <?php }?>>Protocol Information</li><?php }?>

<?php if($totalstudy>=1){?><li><a href="./main.php?option=submissionSecondUp&id=<?php echo $rstudy['id'];?>" <?php if($rsSubStages['protocol_details']==1){?> style="background:green; color:#FFF;" <?php }?>>Protocol Details</a></li><?php }?>
<?php if(!$totalstudy){?><li class="extra" <?php if($rsSubStages['protocol_details']==1){?> style="background:green; color:#FFF;" <?php }?>>Protocol Details</li><?php }?>

<?php if($totalstudy>=1){?><li><a href="./main.php?option=submissionThirdUp&id=<?php echo $rstudy['id'];?>" <?php if($rsSubStages['study_description']==1 and $rsSubStages['RecruitmentCountries']==1){?> style="background:green; color:#FFF;" <?php }?>>Study Description</a></li><?php }?>
<?php if(!$totalstudy){?><li class="extra" <?php if($rsSubStages['study_description']==1 and $rsSubStages['RecruitmentCountries']==1){?> style="background:green; color:#FFF;" <?php }?>>Study Description</li><?php }?>

<?php if($totalstudy>=1){?><li><a href="./main.php?option=StudyPopulationUp&id=<?php echo $rstudy['id'];?>" <?php if($rsSubStages['study_population']==1){?> style="background:green; color:#FFF;" <?php }?>>Study Population</a></li><?php }?>
<?php if(!$totalstudy){?><li class="extra" <?php if($rsSubStages['study_population']==1){?> style="background:green; color:#FFF;" <?php }?>>Study Population</li><?php }?>

<li><a href="#" rel="#default" class="selected" <?php if($rsSubStages['registry']==1){?> style="background:green; color:#FFF;" <?php }?>>Registry</a></li>

<?php if($totalstudy>=1){?><li><a href="./main.php?option=submissionBudgetUp&id=<?php echo $rstudy['id'];?>" <?php if($rsSubStages['budget']==1){?> style="background:green; color:#FFF;" <?php }?>>Budget</a></li><?php }?>
<?php if(!$totalstudy){?><li class="extra" <?php if($rsSubStages['budget']==1){?> style="background:green; color:#FFF;" <?php }?>>Budget</li><?php }?>

<?php if($totalstudy>=1){?><li><a href="./main.php?option=submissionScheduleUp&id=<?php echo $rstudy['id'];?>" <?php if($rsSubStages['study_work_plan']==1){?> style="background:green; color:#FFF;" <?php }?>>Study Work Plan</a></li><?php }?>
<?php if(!$totalstudy){?><li class="extra" <?php if($rsSubStages['study_work_plan']==1){?> style="background:green; color:#FFF;" <?php }?>>Study Work Plan</li><?php }?>

<?php /*?><?php if($totalstudy>=1){?><li><a href="./main.php?option=submissionFive/<?php echo $rstudy['id'];?>/"<?php if($rsSubStages['bibliography']==1){?> style="background:green; color:#FFF;" <?php }?>>Bibliography</a></li><?php }?>
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
                     <!-- <div class="progress">
                        <div role="progressbar" style="width: 45%; height: 6px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" class="progress-bar bg-red"></div>
                      </div>-->
                      
 <?php include("viewlrcn/status_log_resubmit.php");?>


                    </div>
                  </div>
                </div>
              </div>
 <?php
if(isset($message)){echo $message;}
?>
 <!-- Trigger/Open The Modal -->
<button id="myBtn">Add New </button>      
  <div style="clear:both;"></div>  
  
<form action="" method="post" name="regForm" id="regForm" >
<h3>Clinical Trial</h3>


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
$sql = "select *,DATE_FORMAT(`created`,'%d/%m/%Y %H:%s:%i') AS created FROM ".$prefix."submission_clinical_trial where owner_id='$asrmApplctID' and submission_id='$id' order by id desc LIMIT 0,10";//and conceptm_status='new' 
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
    



















      
   <div style="clear:both;"></div>                   
                        <div class="form-group row  success">
                          <label class="col-sm-2 form-control-label">Secondary Registry:</label>
                          <textarea name="clinical_trial_secondary" id="clinical_trial_secondary" cols="" rows="5" class="form-control"><?php echo $rstudy['clinical_trial_secondary'];?></textarea>
                          <input type="hidden" name="asrmApplctID" value="<?php echo $_SESSION['asrmApplctID'];?>">
                          <input type="hidden" name="submission_id" value="<?php echo $rstudy['id'];?>">
                        </div>
                        <div class="line"></div>
    
                         
                        
                        <div class="form-group row">
                          <div class="col-sm-4 offset-sm-3">
                    <input name="doSaveFour" type="submit"  class="btn btn-primary" value="Save and Next"/>

                          </div>
                        </div>
   
   </form>
   


<!-- The Modal -->
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
      <span class="close">&times;</span>
      <h3><strong>New Clinical Trial Registry</strong></h3>
    </div>
    <div class="modal-body">

 <form action="" method="post" name="regForm" id="regForm" >
 
 <div class="form-group row" style="padding-top:10px;">
<label class="col-sm-3 form-control-label">Clinical Trial Registry:</label>
<div class="col-sm-9">
<select name="clinical_trial_name_id" id="clinical_trial_name_id" class="form-control  required" onChange="getNewClinicalRegistry(this.value)">

<?php
$sqlClinicalcv = "select * FROM ".$prefix."list_clinical_trial_name order by name asc";//and conceptm_status='new' 
$resultClinicalcv = $mysqli->query($sqlClinicalcv);
while($rClinicalcv=$resultClinicalcv->fetch_array()){
?>
<option value="<?php echo $rClinicalcv['id'];?>"><?php echo $rClinicalcv['name'];?></option>
<?php }?>
<option value="Other">Other (Specify)</option>
</select>
</div>


</div> 

<div class="form-group row">

 <div id="NewClinicalRegistrydiv"></div>

</div>


 <div class="form-group row">
 
<label class="col-sm-3 form-control-label">Registry Number:</label>
<div class="col-sm-9">
<input type="text" name="number" id="number" class="form-control  required" value="" required>
<input name="protocol_id" type="hidden" value="<?php echo $id;?>"/>
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
    
    
    
    
    
    
    
    
    
<?php /*?>    
<!-- The Modal -->
<div id="myModal2" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
      <span class="close">&times;</span>
      <h3><strong>New Clinical Trial Registry</strong></h3>
    </div>
    <div class="modal-body">

 <form action="" method="post" name="regForm" id="regForm" >
 
 <div class="form-group row" style="padding-top:10px;">
<label class="col-sm-2 form-control-label">Clinical Trial:</label>
<div class="col-sm-10">
<select name="clinical_trial_name_id" id="clinical_trial_name_id" class="form-control  required">
<?php
$sqlClinicalcv = "select * FROM ".$prefix."list_clinical_trial_name order by name asc";//and conceptm_status='new' 
$resultClinicalcv = $mysqli->query($sqlClinicalcv);
while($rClinicalcv=$resultClinicalcv->fetch_array()){
?>
<option value="<?php echo $rClinicalcv['id'];?>"><?php echo $rClinicalcv['name'];?></option>
<?php }?>
</select>
</div>
</div> 



 <div class="form-group row">
 
<label class="col-sm-2 form-control-label">Number:</label>
<div class="col-sm-10">
<input type="text" name="number" id="number" class="form-control  required" value="">
<input name="protocol_id" type="hidden" value="<?php echo $id;?>"/>
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

<?php */?>    
    
    
    
                                     
</div>






<script type="text/javascript">

var countries=new ddajaxtabs("countrytabs", "countrydivcontainer")
countries.setpersist(true)
countries.setselectedClassTarget("link") //"link" or "linkparent"
countries.init()

</script>