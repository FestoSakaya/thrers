<?php
if(!$id){
	
echo '<meta http-equiv="REFRESH" content="1;url='.$base_url.'/main.php?option=dashboard">';
}
if($_POST['doSaveBudget']=='Save' and $_FILES['studyworkplan']['name'] and $_POST['asrmApplctID'] and $id){
function getExtension($str) {

         $i = strrpos($str,".");
         if (!$i) { return ""; } 

         $l = strlen($str) - $i;
         $ext = substr($str,$i+1,$l);
         return $ext;
 }
 $extension = getExtension(preg_replace('/\s+/', '_', $_FILES['studyworkplan']['name']));
 
	if($extension=='pdf'){
	$sasrmApplctID=$mysqli->real_escape_string($_POST['asrmApplctID']);
	$protocol_id=$mysqli->real_escape_string($_POST['protocol_id']);
	$init=$mysqli->real_escape_string($_POST['init']);
	$end=$mysqli->real_escape_string($_POST['end']);
	
		if($_FILES['studyworkplan']['name']){
$studyworkplan = preg_replace('/\s+/', '_', $_FILES['studyworkplan']['name']);
$studyworkplan2 = $asrmApplctID.$mysqli->real_escape_string(preg_replace('/\s+/', '_', $_FILES['studyworkplan']['name']));
$targetw1 = "./files/uploads/". basename($asrmApplctID.preg_replace('/\s+/', '_', $_FILES['studyworkplan']['name']));
$studytoolsext_main1 = move_uploaded_file(preg_replace('/\s+/', '_', $_FILES['studyworkplan']['tmp_name']), $targetw1);

}
	
$startDate = date("Y-m-d", strtotime($init));
$endDate = date("Y-m-d", strtotime($end));
	
$sqlInvestigators="SELECT * FROM ".$prefix."submission_task where `owner_id`='$sasrmApplctID' and submission_id='$id' and description='$studyworkplan2' order by id desc";
	$QueryInvestigators = $mysqli->query($sqlInvestigators);
	$totalInvestigators = $QueryInvestigators->num_rows;
	

	
		if(!$totalInvestigators){
$sqlA2="insert into ".$prefix."submission_task (`owner_id`,`submission_id`,`created`,`updated`,`description`,`init`,`end`) 

values('$sasrmApplctID','$id',now(),now(),'$studyworkplan2','$startDate','$endDate')";
$mysqli->query($sqlA2);

//Insert into Submission Stages
$wm="select * from ".$prefix."submission_stages where  owner_id='$sasrmApplctID' and protocol_id='$id' and status='new'";
$cmdwb = $mysqli->query($wm);
$totalStages = $cmdwb->num_rows;
$r= $cmdwb->fetch_array();
if($totalStages){
$sqlASubmissionStages="update ".$prefix."submission_stages  set `study_work_plan`='1' where `owner_id`='$sasrmApplctID' and `protocol_id`='$id'";
$mysqli->query($sqlASubmissionStages);
}
		}
	
	}//end Extension .pdf
	else{$message="<span class=error2>Please upload PDF file (s) only. Your File was not uploaded</span>";}
}


if($_POST['doWorkPlan']=='Save and Next'){
	
	echo '<meta http-equiv="REFRESH" content="0;url='.$base_url.'/main.php?option=submissionSix&id='.$id.'">';
}

$sqlstudy3="SELECT * FROM ".$prefix."submission where `owner_id`='$asrmApplctID' and id='$id' order by id desc limit 0,1";
$Querystudy3 = $mysqli->query($sqlstudy3);
$totalstudy3 = $Querystudy3->num_rows;
$rstudy3 = $Querystudy3->fetch_array();

$protocol_id=$rstudy3['protocol_id'];
//submission_stages
$sqlSub_Stages="SELECT * FROM ".$prefix."submission_stages where `owner_id`='$asrmApplctID' and protocol_id='$id' and status='new' order by id desc limit 0,1";
$QuerySub_stages = $mysqli->query($sqlSub_Stages);
$totalSub_Stages = $QuerySub_stages->num_rows;
$rsSubStages = $QuerySub_stages->fetch_array();
?>
<?php include("viewlrcn/final_button.php");?>
<ul id="countrytabs" class="shadetabs">
<?php if($totalstudy3>=1){?><li><a href="./main.php?option=submission&id=<?php echo $id;?>" <?php if($rsSubStages['protocol_information']==1 and $rsSubStages['protocol_team']==1){?> style="background:green; color:#FFF;" <?php }?>>Protocol Information</a></li><?php }?>
<?php if(!$totalstudy3){?><li class="extra" <?php if($rsSubStages['protocol_information']==1 and $rsSubStages['protocol_team']==1){?> style="background:green; color:#FFF;" <?php }?>>Protocol Information</li><?php }?>

<?php if($totalstudy3>=1){?><li><a href="./main.php?option=submissionSecond&id=<?php echo $id;?>" <?php if($rsSubStages['protocol_details']==1){?> style="background:green; color:#FFF;" <?php }?>>Protocol Details</a></li><?php }?>
<?php if(!$totalstudy3){?><li class="extra" <?php if($rsSubStages['protocol_details']==1){?> style="background:green; color:#FFF;" <?php }?>>Protocol Details</li><?php }?>

<?php if($totalstudy3>=1){?><li><a href="./main.php?option=submissionThird&id=<?php echo $id;?>" <?php if($rsSubStages['study_description']==1 and $rsSubStages['RecruitmentCountries']==1){?> style="background:green; color:#FFF;" <?php }?>>Study Description</a></li><?php }?>
<?php if(!$totalstudy3){?><li class="extra" <?php if($rsSubStages['study_description']==1 and $rsSubStages['RecruitmentCountries']==1){?> style="background:green; color:#FFF;" <?php }?>>Study Description</li><?php }?>

<?php if($totalstudy3>=1){?><li><a href="./main.php?option=StudyPopulation&id=<?php echo $id;?>" <?php if($rsSubStages['study_population']==1){?> style="background:green; color:#FFF;" <?php }?>>Study Population</a></li><?php }?>
<?php if(!$totalstudy3){?><li class="extra" <?php if($rsSubStages['study_population']==1){?> style="background:green; color:#FFF;" <?php }?>>Study Population</li><?php }?>



<?php if($rstudy3['is_clinical_trial']==1){?>
<?php if($totalstudy3>=1){?><li><a href="./main.php?option=submissionFour&id=<?php echo $id;?>" <?php if($rsSubStages['registry']==1){?> style="background:green; color:#FFF;" <?php }?>>Registry</a></li><?php }?>
<?php if(!$totalstudy3){?><li class="extra" <?php if($rsSubStages['registry']==1){?> style="background:green; color:#FFF;" <?php }?>>Registry</li><?php }}?>


<?php if($totalstudy3>=1){?><li><a href="./main.php?option=submissionBudget&id=<?php echo $id;?>" <?php if($rsSubStages['budget']==1){?> style="background:green; color:#FFF;" <?php }?>>Budget</a></li><?php }?>
<?php if(!$totalstudy3){?><li class="extra" <?php if($rsSubStages['budget']==1){?> style="background:green; color:#FFF;" <?php }?>>Budget</li><?php }?>

<li><a href="#" rel="#default" class="selected" <?php if($rsSubStages['study_work_plan']==1){?> style="background:green; color:#FFF;" <?php }?>>Study Work Plan</a></li>

<?php /*?><?php if($totalstudy3>=1){?><li><a href="./main.php?option=submissionFive/<?php echo $rstudy3['id'];?>/"<?php if($rsSubStages['bibliography']==1){?> style="background:green; color:#FFF;" <?php }?>>Bibliography</a></li><?php }?>
<?php if(!$totalstudy3){?><li class="extra"<?php if($rsSubStages['bibliography']==1){?> style="background:green; color:#FFF;" <?php }?>>Bibliography</li><?php }?><?php */?>

<?php if($totalstudy3>=1){?><li><a href="./main.php?option=submissionSix&id=<?php echo $id;?>" <?php if($rsSubStages['filem']==1){?> style="background:green; color:#FFF;" <?php }?>>Attached Files</a></li><?php }?>
<?php if(!$totalstudy3){?><li class="extra" <?php if($rsSubStages['filem']==1){?> style="background:green; color:#FFF;" <?php }?>>Attached Files</li><?php }?>

<?php if($totalstudy3>=1){?><li><a href="./main.php?option=submissionFinish&id=<?php echo $id;?>" <?php if($rsSubStages['payments']==1){?> style="background:green; color:#FFF;" <?php }?>>Payments</a></li><?php }?>
<?php if(!$totalstudy3){?><li class="extra" <?php if($rsSubStages['payments']==1){?> style="background:green; color:#FFF;" <?php }?>>Payments</li><?php }?>
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
              <?php include("viewlrcn/status_log.php");?>


                    </div>
                  </div>
                </div>
              </div>
              
              
  <?php

?>
<?php
$sqlstudy="SELECT * FROM ".$prefix."submission_task where `owner_id`='$asrmApplctID' and submission_id='$id' order by id desc limit 0,1";
$Querystudy = $mysqli->query($sqlstudy);
$totalstudy = $Querystudy->num_rows;
$rstudy = $Querystudy->fetch_array();
if(isset($message)){echo $message;}
?>

<h3>Study Work Plan: <span class="error">*</span></h3>   
                        
             <table class="table table-striped table-sm success">
               <tr>
                            <td class="defmf">File Name </td>
<td>&nbsp;</td>
                          </tr>
                        <tbody>
<?php
if($category=='submissionScheduleDel' and $id){

	$sqlA2Protocol2="DELETE from ".$prefix."submission_task where owner_id='$asrmApplctID' and submission_id='$id' and id='$id'";
	//$mysqli->query($sqlA2Protocol2);
	//check if empty rows
$sqlstudy22="SELECT * FROM ".$prefix."submission_task where `owner_id`='$asrmApplctID' and submission_id='$id' order by id desc limit 0,1";
$Querystudy33 = $mysqli->query($sqlstudy22);

if(!$Querystudy33->num_rows){
$sqlASubmissionStages="update ".$prefix."submission_stages  set `study_work_plan`='0' where `owner_id`='$asrmApplctID' and `protocol_id`='$id'";
$mysqli->query($sqlASubmissionStages);
}
	}
//if no page var is given, set start to 0
$sql = "select *,DATE_FORMAT(`created`,'%d/%m/%Y %H:%s:%i') AS created FROM ".$prefix."submission_task where owner_id='$asrmApplctID' and submission_id='$id' order by id desc LIMIT 0,10";//and conceptm_status='new' 
$result = $mysqli->query($sql);
while($rInvestigator=$result->fetch_array()){
	?>
                          <tr>
                            <td><?php echo $rInvestigator['description'];?></td>
<td><a href="./main.php?option=submissionScheduleDel&id=<?php echo $rInvestigator['id'];?>" style="color:#F00; font-weight:bold;" onclick="return confirm('Are you sure you want to delete this item?');">Delete</a></td>
                          </tr>
   <?php }///////////end function ?>                 
                        </tbody>
                      </table>
  <!-- Trigger/Open The Modal -->
<button id="myBtn">Click to Attach study work plan </button> 
  <div style="clear:both;"></div> 
   
   
<form action="" method="post" name="regForm" id="regForm" >
                        
                        <div class="form-group row">
                          <div class="col-sm-4 offset-sm-3">
                    <input name="doWorkPlan" type="submit"  class="btn btn-primary" value="Save and Next"/>

                          </div>
                        </div>
   
   </form>
   
<!-- The Modal -->
<div id="myModal" class="modal" style="margin-top:80px;">

  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
      <span class="close">&times;</span>
      <h3><strong>Attach study work plan</strong></h3>
    </div>
    <div class="modal-body">
    <form action="" method="post" name="regForm" id="regForm" enctype="multipart/form-data">




 <div class="form-group row">
 
<label class="col-sm-3 form-control-label">File (PDF only):</label>
<div class="col-sm-9">
<input name="studyworkplan" type="file" id="attachethicalapproval" class="required" required/>

<input name="protocol_id" type="hidden" value="<?php echo $protocol_id;?>"/>
<input type="hidden" name="asrmApplctID" value="<?php echo $_SESSION['asrmApplctID'];?>">
<input type="hidden" name="submission_id" value="<?php echo $rstudy['id'];?>">
</div>
</div>
                        


                         
                        
                        <div class="form-group row">
                          <div class="col-sm-4 offset-sm-3">
                    <input name="doSaveBudget" type="submit"  class="btn btn-primary" value="Save"/>

                          </div>
                        </div>
   
   </form>
   
    </div></div></div>
                                     
</div>






<script type="text/javascript">

var countries=new ddajaxtabs("countrytabs", "countrydivcontainer")
countries.setpersist(true)
countries.setselectedClassTarget("link") //"link" or "linkparent"
countries.init()

</script>