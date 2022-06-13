<?php
$sessionasrmApplctID=$_SESSION['asrmApplctID'];
//submission_stages
$sqlstudy="SELECT * FROM ".$prefix."renewals where `owner_id`='$sessionasrmApplctID' and id='$id' order by id desc limit 0,1";
$Querystudy = $mysqli->query($sqlstudy);
$totalstudy = $Querystudy->num_rows;
$rstudy = $Querystudy->fetch_array();
$protocol_id=$rstudy['id'];
$protocol_id2=$rstudy['id'];
//submission_stages
$sqlSub_Stages="SELECT * FROM ".$prefix."annual_stages where `owner_id`='$sessionasrmApplctID' and status='new' and annual_id='$id' order by id desc limit 0,1";
$QuerySub_stages = $mysqli->query($sqlSub_Stages);
$totalSub_Stages = $QuerySub_stages->num_rows;
$rsSubStages = $QuerySub_stages->fetch_array();



if($_POST['doSaveFirst']=='Save and Next' and $_POST['asrmApplctID'] and $_POST['protocol_title']){

	
	$project_id=$mysqli->real_escape_string($_POST['project_id']);
	$Briefrationale=$mysqli->real_escape_string($_POST['Briefrationale']);
	$sasrmApplctID=$mysqli->real_escape_string($_POST['asrmApplctID']);
	$GeneralResearchObjective=$mysqli->real_escape_string($_POST['GeneralResearchObjective']);
	$StudyMethods=$mysqli->real_escape_string($_POST['StudyMethods']);
	$public_title=$mysqli->real_escape_string($_POST['protocol_title']);
	$ManualrefNo=$mysqli->real_escape_string($_POST['ManualrefNo']);
$wmRenewals="select * from ".$prefix."submission where  id='$project_id'";
$cmdwbRenewals = $mysqli->query($wmRenewals);
$rRenewals= $cmdwbRenewals->fetch_array();
	
	$recAffiliated_id=$mysqli->real_escape_string($_POST['recAffiliated_id']);

	$sqlUsers="SELECT * FROM ".$prefix."renewals where `owner_id`='$sasrmApplctID' and id='$id' order by id desc limit 0,1";
		$QueryUsers = $mysqli->query($sqlUsers);
		$totalUsers = $QueryUsers->num_rows;
		$rUserInv=$QueryUsers->fetch_array();
		$protocID=$rUserInv['protocol_id'];
		
		
		$sqlUsersTr="SELECT * FROM ".$prefix."renewals order by id desc limit 0,1";
		$QueryUsersTr = $mysqli->query($sqlUsersTr);
		$rUserInvTr=$QueryUsersTr->fetch_array();
		$code=$rUserInvTr['id']+1;
	
		if(!$totalUsers and $code){

$sqlA2Protocol="insert into ".$prefix."renewals (`protocol_id`,`recAffiliated_id`,`owner_id`,`Briefrationale`,`GeneralResearchObjective`,`StudyMethods`,`is_sent`,`created`,`ammendType`,`code`,`public_title`,`CompletenessCheck`,`refNo`) 

values('$project_id','$recAffiliated_id','$sasrmApplctID','$Briefrationale','$GeneralResearchObjective','$StudyMethods','0',now(),'manual','$code','$public_title','Pending','$ManualrefNo')";
$mysqli->query($sqlA2Protocol);
$record_id = $mysqli->insert_id;
}
if($record_id>=1){


//Insert into Submission Stages
$wm="select * from ".$prefix."annual_stages where  owner_id='$sasrmApplctID' and status='new' and ammendType='manual' and annual_id='$id' order by id desc";
$cmdwb = $mysqli->query($wm);
$totalStages = $cmdwb->num_rows;
$r= $cmdwb->fetch_array();
if(!$totalStages){
$sqlASubmissionStages="insert into ".$prefix."annual_stages (`owner_id`,`protocol_id`,`annual_id`,`protocol_information`,`status_of_participants`,`literature`,`future_plans`,`dateCreated`,`status`,`ammendType`,`code`)  values('$sasrmApplctID','$project_id','$record_id','1','0','0','0',now(),'new','manual','$code')";
$mysqli->query($sqlASubmissionStages);
}
if($totalStages){
$sqlASubmissionStages="update ".$prefix."annual_stages  set `protocol_information`='1' where `owner_id`='$sasrmApplctID' and status='new'";
$mysqli->query($sqlASubmissionStages);
}

$message='<p class="success">Dear '.$session_fullname.', details have been submitted, save to continue</p>';
logaction("$session_fullname added created new protocol");

echo '<img src="images/loading_wait.gif">';
echo '<div class="spacer"></div>';
echo '<meta http-equiv="REFRESH" content="0;url='.$base_url.'/main.php?option=AnnualRenualManual&id='.$record_id.'">';
}
if($record_id<=0){
$message='<p class="failed">Dear '.$session_fullname.', details have not been saved. Re-enter and submit again.</p>';	
}

if($totalUsers){
$sqlA2Protocol="update ".$prefix."renewals  set `GeneralResearchObjective`='$GeneralResearchObjective',`StudyMethods`='$StudyMethods',`public_title`='$public_title',`refNo`='$ManualrefNo' where `owner_id`='$sessionasrmApplctID' and is_sent='0' and id='$id'";
$mysqli->query($sqlA2Protocol);	


//Insert into Submission Stages
$wm="select * from ".$prefix."annual_stages where  owner_id='$sasrmApplctID' and status='new' and protocol_id='$record_id' and annual_id='$id'";
$cmdwb = $mysqli->query($wm);
$totalStages = $cmdwb->num_rows;
$r= $cmdwb->fetch_array();

if($totalStages){
$sqlASubmissionStages="update ".$prefix."annual_stages  set `protocol_information`='1' where `owner_id`='$sasrmApplctID' and annual_id='$id'";
$mysqli->query($sqlASubmissionStages);
}



echo '<meta http-equiv="REFRESH" content="0;url='.$base_url.'/main.php?option=AnnualRenualSecond&id='.$id.'">';
	
}

		


}//end post

?>

<ul id="countrytabs" class="shadetabs">

<li><a href="#" rel="#default" class="selected" <?php if($rsSubStages['protocol_information']==1){?> style="background:green; color:#FFF;" <?php }?>>Protocol Information</a></li>




<?php if($totalstudy>=1){?><li><a href="./main.php?option=AnnualRenualSecond&id=<?php echo $rstudy['id'];?>" <?php if($rsSubStages['status_of_participants']==1 and $rsSubStages['status_of_participants']==1){?> style="background:green; color:#FFF;" <?php }?>>Status of Participants & Specimens</a></li><?php }?>
<?php if(!$totalstudy){?><li class="extra" <?php if($rsSubStages['status_of_participants']==1){?> style="background:green; color:#FFF;" <?php }?>>Status of Participants & Specimens</li><?php }?>


<?php if($totalstudy>=1){?><li><a href="./main.php?option=AnnualRenualThird&id=<?php echo $rstudy['id'];?>" <?php if($rsSubStages['literature']==1){?> style="background:green; color:#FFF;" <?php }?>>Literature & Challanges</a></li><?php }?>
<?php if(!$totalstudy){?><li class="extra" <?php if($rsSubStages['literature']==1){?> style="background:green; color:#FFF;" <?php }?>>Literature & Challanges</li><?php }?>


<?php if($totalstudy>=1){?><li><a href="./main.php?option=AnnualRenualFour&id=<?php echo $rstudy['id'];?>" <?php if($rsSubStages['future_plans']==1){?> style="background:green; color:#FFF;" <?php }?>>Future Plans/Activities</a></li><?php }?>
<?php if(!$totalstudy){?><li class="extra" <?php if($rsSubStages['future_plans']==1){?> style="background:green; color:#FFF;" <?php }?>>Status of Future Plans/Activities</li><?php }?>


<?php if($totalstudy>=1){?><li><a href="./main.php?option=AnnualRenewalPayment&id=<?php echo $rstudy['id'];?>" <?php if($rsSubStages['payment_proof']==1){?> style="background:green; color:#FFF;" <?php }?>>Attachments</a></li><?php }?>
<?php if(!$totalstudy){?><li class="extra" <?php if($rsSubStages['payment_proof']==1){?> style="background:green; color:#FFF;" <?php }?>>Attachments</li><?php }?>

</ul>

<div id="countrydivcontainer" style="border:0px solid gray; width:100%; margin-bottom: 1em; padding: 10px">

<?php 

$sqlstudypp="SELECT * FROM ".$prefix."renewals where `owner_id`='$sessionasrmApplctID' and id='$id' order by id desc limit 0,1";
$Querystudypp = $mysqli->query($sqlstudypp);
$totalstudypp = $Querystudypp->num_rows;
$rstudypp = $Querystudypp->fetch_array();
if(isset($message)){echo $message;}
?>

<form action="" method="post" name="regForm" id="regForm" autocomplte="off">

<div class="form-group row success">
 <label class="col-sm-12 form-control-label">Choose REC: <br /></label>

<div class="col-sm-10">
<select name="recAffiliated_id" id="recAffiliated_id" class="form-control  required" required>
<option value="">Please Select</option>
<?php
$sqlClinicalcv2 = "select * FROM ".$prefix."list_rec_affiliated where published='Yes' order by name asc";//and conceptm_status='new' 
$resultClinicalcv2 = $mysqli->query($sqlClinicalcv2);
while($rClinicalcv2=$resultClinicalcv2->fetch_array()){
?>
<option value="<?php echo $rClinicalcv2['id'];?>" <?php if($rClinicalcv2['id']==$rstudypp['recAffiliated_id']){?>selected="selected"<?php }?>><?php echo $rClinicalcv2['name'];?></option>
<?php }?>
</select>
</div>

                  
                        </div>
                        <div class="line"></div> 
                        
                        
                        

<div class="form-group row success">
<label class="col-sm-10 form-control-label">Protocol Title: <span class="error">*</span></label>
<div class="col-sm-10">

<textarea name="protocol_title" id="protocol_title" cols="" rows="5" class="form-control" required><?php echo $rstudypp['public_title'];?></textarea>
</div>
</div>

<div class="form-group row success">
 <label class="col-sm-12 form-control-label">Reference Number: <br /></label>

  <textarea name="ManualrefNo" id="ManualrefNo" cols="" rows="2" class="form-control" required><?php echo $rstudypp['refNo'];?></textarea>


                  
                        </div>
                        <div class="line"></div> 
                                 
                        
                         <div class="form-group row success">
                         <input type="hidden" name="asrmApplctID" value="<?php echo $_SESSION['asrmApplctID'];?>">
                          <label class="col-sm-10 form-control-label">Brief rationale for the Study: <span class="error">*</span></label>
                          <div class="col-sm-10">
                          <textarea name="Briefrationale" id="Briefrationale" cols="" rows="5" class="form-control  required"><?php echo $rstudypp['Briefrationale'];?></textarea>
 
  
                          </div>
                        </div>
                        <div class="line"></div>
                        
                        
                        
                         <div class="form-group row success">
                          <label class="col-sm-10 form-control-label">General Research Objective: <span class="error">*</span></label>
                          <div class="col-sm-10">
                          <textarea name="GeneralResearchObjective" id="GeneralResearchObjective" cols="" rows="5" class="form-control  required"><?php echo $rstudypp['GeneralResearchObjective'];?></textarea>
                          </div>
                        </div>
                        <div class="line"></div>
                        
                        
                         <div class="form-group row success">
                          <label class="col-sm-10 form-control-label">Study Methods : <span class="error">*</span><br />
                          </label><label class="col-sm-10 form-control-label">Brief description of the study design, study sites, study population, sample size, and study duration</label>
                          <div class="col-sm-10">
                          <textarea name="StudyMethods" id="StudyMethods" cols="" rows="5" class="form-control  required"><?php echo $rstudypp['StudyMethods'];?></textarea>
                          </div>
                        </div>
                        <div class="line"></div>
                        
                        
                       
                        
                        
                        
                        
                        
                        <div class="form-group row">
                          <div class="col-sm-4 offset-sm-3">
                    <input name="doSaveFirst" type="submit"  class="btn btn-primary" value="Save and Next"/>

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