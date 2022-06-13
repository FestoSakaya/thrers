<?php
//doSaveFive
if($_POST['doFilesUpload'] and $_FILES['attachethicalapproval']['name'] and $id and $_POST['asrmApplctID']){
function getExtension($str) {

         $i = strrpos($str,".");
         if (!$i) { return ""; } 

         $l = strlen($str) - $i;
         $ext = substr($str,$i+1,$l);
         return $ext;
 }
 
	$upload_type_id=$mysqli->real_escape_string($_POST['upload_type_id']);

	$submission_id=$mysqli->real_escape_string($_POST['submission_id']);
	$asrmApplctID=$mysqli->real_escape_string($_POST['asrmApplctID']);
	$Version=$mysqli->real_escape_string($_POST['Version']);
	$Language=$mysqli->real_escape_string($_POST['Language']);
	$othername=$mysqli->real_escape_string($_POST['othername']);
	$mdate=$mysqli->real_escape_string($_POST['date']);
	$month=$mysqli->real_escape_string($_POST['month']);
	$year=$mysqli->real_escape_string($_POST['year']);
	$DateofProposal=$mysqli->real_escape_string($year.'-'.$month.'-'.$mdate);

$extensionw = getExtension(preg_replace('/\s+/', '_', $_FILES['attachethicalapproval']['name']));

if($extensionw=='pdf'){
	
if($_FILES['attachethicalapproval']['name']){
$attachethicalapproval = preg_replace('/\s+/', '_', $_FILES['attachethicalapproval']['name']);
$attachethicalapproval2 = $asrmApplctID.$mysqli->real_escape_string(preg_replace('/\s+/', '_', $_FILES['attachethicalapproval']['name']));
$targetw1 = "./files/uploads/". basename($asrmApplctID.preg_replace('/\s+/', '_', $_FILES['attachethicalapproval']['name']));
$studytoolsext_main1 = move_uploaded_file(preg_replace('/\s+/', '_', $_FILES['attachethicalapproval']['tmp_name']), $targetw1);

}

$sqlstudyMM2="SELECT * FROM ".$prefix."submission_upload where `user_id`='$asrmApplctID' and submission_id='$submission_id' and upload_type_id='$upload_type_id' and filename='$attachethicalapproval2' order by id desc";// and filename='$attachethicalapproval2'
$QuerystudyMM2 = $mysqli->query($sqlstudyMM2);
$totalstudyMM2 = $QuerystudyMM2->num_rows;
if(!$totalstudyMM2){
$sqlA2="insert into ".$prefix."submission_upload (`user_id`,`submission_id`,`upload_type_id`,`created`,`updated`,`filename`,`filepath`,`submission_number`,`is_monitoring_action`,`Version`,`Language`,`DateofProposal`,`othername`,`new_old`) 

values('$asrmApplctID','$submission_id','$upload_type_id',now(),now(),'$attachethicalapproval2','','','','$Version','$Language','$DateofProposal','$othername','new')";
$mysqli->query($sqlA2);


$sqlEwdd = "select * FROM ".$prefix."submission_upload where user_id='$asrmApplctID' and submission_id='$protocol_id'";
$resultWedd = $mysqli->query($sqlEwdd);
$rInvestigatorD=$resultWedd->fetch_array();





$message='<div class="success">Dear '.$session_fullname.', details have been submitted, click save to continue</div>';
logaction("$session_fullname updated Study Attachments");


	//update edited table...
$sqlURevisions="SELECT * FROM ".$prefix."updated_sections where `owner_id`='$asrmApplctID' and protocol_id='$submission_id' and status='pending' order by id desc limit 0,1";
$QueryUserRevions = $mysqli->query($sqlURevisions);
$totalUsersRevions = $QueryUserRevions->num_rows;
if(!$totalUsersRevions){
$sqlAREvisedSections="insert into ".$prefix."updated_sections (`owner_id`,`protocol_id`,`protocol_information`,`protocol_team`,`protocol_details`,`study_description`,`RecruitmentCountries`,`registry`,`budget`,`study_work_plan`,`bibliography`,`attachments`,`payments`,`study_population`,`dateupdated`,`status`) 

values('$asrmApplctID','$submission_id','','','','','','','','','','1','','',now(),'pending')";
$mysqli->query($sqlAREvisedSections);
}
if($totalUsersRevions){

$sqlAREvisedSections_update="update ".$prefix."updated_sections  set `attachments`='1' where owner_id='$asrmApplctID' and protocol_id='$submission_id' and status='pending'";
$mysqli->query($sqlAREvisedSections_update);	
}/////////////////end updated sections



}
if($totalstudyMM2){
$message='<div class="error2">Dear '.$session_fullname.', looks like duplicate file attached</div>';	
}
}else{$message="<span class=error2>Please upload PDF file (s) only. Your File was not uploaded</span>";}


}//end post

//doSaveFive
if($_POST['doFilesUploadProceed'] and $id){
$message='<div class="success">Dear '.$session_fullname.', details have been submitted, click save to continue</div>';
logaction("$session_fullname updated protocol, Bibliography Information");

echo '<img src="images/loading_wait.gif">';
echo '<div class="spacer"></div>';
echo '<meta http-equiv="REFRESH" content="0;url='.$base_url.'/main.php?option=submissionFinishUp&id='.$id.'">';



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

<?php if($rstudy['is_clinical_trial']==1){?>
<?php if($totalstudy>=1){?><li><a href="./main.php?option=submissionFourUp&id=<?php echo $rstudy['id'];?>" <?php if($rsSubStages['registry']==1){?> style="background:green; color:#FFF;" <?php }?>>Registry</a></li><?php }?>
<?php if(!$totalstudy){?><li class="extra" <?php if($rsSubStages['registry']==1){?> style="background:green; color:#FFF;" <?php }?>>Registry</li><?php }}?>

<?php if($totalstudy>=1){?><li><a href="./main.php?option=submissionBudgetUp&id=<?php echo $rstudy['id'];?>" <?php if($rsSubStages['budget']==1){?> style="background:green; color:#FFF;" <?php }?>>Budget</a></li><?php }?>
<?php if(!$totalstudy){?><li class="extra" <?php if($rsSubStages['budget']==1){?> style="background:green; color:#FFF;" <?php }?>>Budget</li><?php }?>

<?php if($totalstudy>=1){?><li><a href="./main.php?option=submissionScheduleUp&id=<?php echo $rstudy['id'];?>" <?php if($rsSubStages['study_work_plan']==1){?> style="background:green; color:#FFF;" <?php }?>>Study Work Plan</a></li><?php }?>
<?php if(!$totalstudy){?><li class="extra" <?php if($rsSubStages['study_work_plan']==1){?> style="background:green; color:#FFF;" <?php }?>>Study Work Plan</li><?php }?>

<?php /*?><?php if($totalstudy>=1){?><li><a href="./main.php?option=submissionFive/<?php echo $rstudy['id'];?>/"<?php if($rsSubStages['bibliography']==1){?> style="background:green; color:#FFF;" <?php }?>>Bibliography</a></li><?php }?>
<?php if(!$totalstudy){?><li class="extra" <?php if($rsSubStages['bibliography']==1){?> style="background:green; color:#FFF;" <?php }?>>Bibliography</li><?php }?><?php */?>


<li><a href="#" rel="#default" class="selected" <?php if($rsSubStages['filem']==1){?> style="background:green; color:#FFF;" <?php }?>>Attached Files</a></li>


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
                     
                     
             <?php include("viewlrcn/status_log_resubmit.php");?>

                    </div>
                  </div>
                </div>
              </div>
<?php 
if($message){echo $message;}

?>
<h3>Attachments:</h3>


 <table class="table table-striped table-sm">
                  <thead>
                          <tr>
                            <th>File name</th>
                            <th>Type</th>
                            <th><span class="form-control-label">Version</span></th>
                            <th><span class="form-control-label">Language</span></th>
                            <th><span class="form-control-label">Date</span></th>
                         <th>&nbsp;</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php
						
	if($_GET['call']=='attremove' and $id){
    $part=$_GET['part'];
	$sqlA2Protocol2="delete from ".$prefix."submission_upload where user_id='$asrmApplctID' and submission_id='$protocol_id' and id='$part'";
	$mysqli->query($sqlA2Protocol2);
	}
						
						
//if no page var is given, set start to 0
$sql = "select *,DATE_FORMAT(`created`,'%d/%m/%Y %H:%s:%i') AS created FROM ".$prefix."submission_upload where user_id='$asrmApplctID' and submission_id='$protocol_id' order by id desc LIMIT 0,200";//and conceptm_status='new' 
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
                            <td>    <?php if($today<=$rInvestigator['created']){?>
<a href="./cfxdownload.php?id=<?php echo $rInvestigator['id'];?>" target="_blank">View File</a>
<?php }else{?>
<a href="./cfxdownload.php?id=<?php echo $rInvestigator['id'];?>" target="_blank">View File</a>
<?php }?></td>
                            <td><?php if($rInvestigator['othername']){echo $rInvestigator['othername'];}else{echo $rfile['name'];}?></td>
                            <td><?php echo $rInvestigator['Version'];?></td>
                            <td><?php echo $rInvestigator['Language'];?></td>
                            <td><?php echo $rInvestigator['DateofProposal'];?></td>
<td><?php if($rInvestigator['new_old']=='new'){?><a href="./main.php?option=submissionSixUp&id=<?php echo $protocol_id;?>&call=attremove&part=<?php echo $rInvestigator['id'];?>" style="color:#F00; font-weight:bold;" onclick="return confirm('Are you sure you want to delete this item?');">Delete</a><?php }?></td>


                          </tr>
   <?php }///////////end function ?>                 
                        </tbody>
                      </table>
   <button id="myBtn">New Attachment </button>      
  <div style="clear:both;"></div>    
   <!-- Trigger/Open The Modal -->
   
<?php
//Consent forms a must
$is_clinical_trial=$rstudym['is_clinical_trial'];
$sqlEwCC = "select * FROM ".$prefix."submission_upload where user_id='$asrmApplctID' and submission_id='$protocol_id' and upload_type_id='3'";//and conceptm_status='new' 
$resultWeCC = $mysqli->query($sqlEwCC);
$totalUserErCC = $resultWeCC->num_rows;//for only clinical trials Not required for now 2. Informed Consent Forms (for Clinical Trials)<br>

///////////////////////////////////////////////////////////////
$sqlEwCC22 = "select * FROM ".$prefix."submission_upload where user_id='$asrmApplctID' and submission_id='$protocol_id' and upload_type_id='3'";//informed concent' 
$resultWeCC22 = $mysqli->query($sqlEwCC22);
$totalUserErCC22 = $resultWeCC22->num_rows;


$sqlEw = "select * FROM ".$prefix."submission_upload where user_id='$asrmApplctID' and submission_id='$protocol_id' and upload_type_id='1'";//and conceptm_status='new' 
$resultWe = $mysqli->query($sqlEw);
$totalUserEr = $resultWe->num_rows;
//
$wm="select * from ".$prefix."submission_stages where  owner_id='$asrmApplctID' and protocol_id='$protocol_id' and status='new'";
$cmdwb = $mysqli->query($wm);
$totalStages = $cmdwb->num_rows;
$r= $cmdwb->fetch_array();
if($totalStages and $totalUserEr and $totalUserErCC22){
$sqlASubmissionStages="update ".$prefix."submission_stages  set `filem`='1' where `owner_id`='$asrmApplctID' and `protocol_id`='$protocol_id'";
$mysqli->query($sqlASubmissionStages);
}
if($totalUserEr and $totalUserErCC22 and $is_clinical_trial==1){//and $totalUserErCC Ignore 2. Informed Consent Forms (for Clinical Trials)<br>
?>   
<form action="" name="regForm" id="regForm" method="post" enctype="multipart/form-data">
 <input name="doFilesUploadProceed" type="submit"  class="btn btn-primary" value="Save and Next" style="float:right; margin-top:5px;"/>
<div style="clear:both;"></div>
</form><?php }

$sqlstudyPop="SELECT * FROM ".$prefix."study_population where `owner_id`='$asrmApplctID' and protocol_id='$protocol_id' order by id desc limit 0,1";//and status='new' 
$QuerystudyPop = $mysqli->query($sqlstudyPop);
$rstudyP = $QuerystudyPop->fetch_array();
$shcategoryID3=$rstudyP['ConsentProcess'];
$categoryChunks3 = explode(".", $shcategoryID3);

$chopCP1="$categoryChunks3[0]";
$chopCP2="$categoryChunks3[1]";
$chopCP3="$categoryChunks3[2]";
$chopCP4="$categoryChunks3[3]";
$chopCP5="$categoryChunks3[4]";
if($chopCP1=='Written' || $chopCP2=='Written' || $chopCP1=='Oral' || $chopCP2=='Oral'){//Make Informed consent required
$required="3. Informed Consent Forms";
$amust=1;
}

if($totalUserEr and $totalUserErCC22 and $is_clinical_trial==0 and $totalUserErCC44){
?>   
<form action="" name="regForm" id="regForm" method="post" enctype="multipart/form-data">
 <input name="doFilesUploadProceed" type="submit"  class="btn btn-primary" value="Save and Next" style="float:right; margin-top:5px;"/>
<div style="clear:both;"></div>
</form><?php }
echo $filesRequired="<strong style='color:#F00'>The following files must be uploaded:<br>
1. Protocol<br>
2. Data Collection Tools<br>
$required

</strong>";
if(!$totalUserEr){

$wm="select * from ".$prefix."submission_stages where  owner_id='$asrmApplctID' and protocol_id='$protocol_id' and status='new'";
$cmdwb = $mysqli->query($wm);
$totalStages = $cmdwb->num_rows;
$r= $cmdwb->fetch_array();
if($totalStages){
$sqlASubmissionStages="update ".$prefix."submission_stages  set `filem`='0' where `owner_id`='$asrmApplctID' and `protocol_id`='$protocol_id'";
$mysqli->query($sqlASubmissionStages);
}

}?>
   
   
   <!-- The Modal -->
<div id="myModal" class="modal" style="margin-top:80px;">

  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
      <span class="close">&times;</span>
      <h3><strong>New Attachment</strong></h3>
    </div>
    <div class="modal-body" style="height:300px; overflow:scroll;">

 <form action="" method="post" name="regForm" id="regForm" enctype="multipart/form-data">
 
 
 <div class="form-group row" style="padding-top:10px;">
<label class="col-sm-3 form-control-label">Type: <span class="error">*</span></label>
<div class="col-sm-8">
<select name="upload_type_id" id="upload_type_id" class="form-control  required" required onChange="getProtocolLanguage(this.value)">
<option value="">Please Select</option>
<?php
$sqlClinicalcv = "select * FROM ".$prefix."upload_type order by name asc";//and conceptm_status='new' 
$resultClinicalcv = $mysqli->query($sqlClinicalcv);
while($rClinicalcv=$resultClinicalcv->fetch_array()){
?>
<option value="<?php echo $rClinicalcv['id'];?>"><?php echo $rClinicalcv['name'];?></option>
<?php }?>
<option value="other">Other</option>
</select>
</div>
</div> 

 <div class="form-group row">
 <div id="getProtocolLanguagediv"></div>
 </div>
 
 <div class="form-group row">
 
<label class="col-sm-3 form-control-label">Version: <span class="error">*</span></label>
<div class="col-sm-8">
<input type="text" name="Version" id="Version" class="form-control  required" value="" required>

</div>
</div> 

  <div class="form-group row">
 
<label class="col-sm-3 form-control-label">Date:</label>
<div class="col-sm-8">
<table width="100%" border="0">
  <tr>
    <td>
  
  <select name="year" id="dyear" class="form-control" tabindex="8" style=" width:100px; float:left;"  onChange="getMonthPopulate(this.value)">
<option value="">Year</option>
<?php
define('DOB_YEAR_START', 2000);

$current_year = date('Y')+0;

for ($count = $current_year; $count >= DOB_YEAR_START; $count--)
{
?>
 <option value="<?php echo $count;?>"><?php echo $count;?></option>
<?php }?>

  </select>
    
    </td>
    <td><div id="monthdiv"></div></td>
    <td> 
    
    <select name="date" id="ddate" class="form-control" tabindex="6" style=" width:80px; float:left;">
    <option value="">Date</option>
   <option value="01">&nbsp;01</option>
   <option value="02">&nbsp;02</option>
   <option value="03">&nbsp;03</option>
   <option value="04">&nbsp;04</option>
   <option value="05">&nbsp;05</option>
   <option value="06">&nbsp;06</option>
   <option value="07">&nbsp;07</option>
   <option value="08">&nbsp;08</option>
   <option value="09">&nbsp;09</option>
   <option value="10">&nbsp;10</option>
   <option value="11">&nbsp;11</option>
   <option value="12">&nbsp;12</option>
  <option value="13">&nbsp;13</option>
<option value="14">&nbsp;14</option>
<option value="15">&nbsp;15</option>
<option value="16">&nbsp;16</option>
<option value="17">&nbsp;17</option>
<option value="18">&nbsp;18</option>
<option value="19">&nbsp;19</option>
<option value="20">&nbsp;20</option>
<option value="21">&nbsp;21</option>
<option value="22">&nbsp;22</option>
<option value="23">&nbsp;23</option>
<option value="24">&nbsp;24</option>
<option value="25">&nbsp;25</option>
<option value="26">&nbsp;26</option>
<option value="27">&nbsp;27</option>
<option value="28">&nbsp;28</option>
<option value="29">&nbsp;29</option>
<option value="30">&nbsp;30</option>
<option value="31">&nbsp;31</option>
   
  </select>
  </td>
  </tr>
</table>






</div>
</div>        


 <div class="form-group row">
 
<label class="col-sm-3 form-control-label">File  (PDF) <span class="error">*</span>:</label>
<div class="col-sm-8">
<input name="attachethicalapproval" type="file" id="attachethicalapproval" class="required" required/>

<input name="protocol_id" type="hidden" value="<?php echo $id;?>"/>
<input type="hidden" name="asrmApplctID" value="<?php echo $_SESSION['asrmApplctID'];?>">
<input type="hidden" name="submission_id" value="<?php echo $rstudy['id'];?>">
</div>
</div>
                        
  




 

            
                  
       
       <div class="form-group row">
                          <div class="col-sm-4 offset-sm-3">
                    <input name="doFilesUpload" type="submit"  class="btn btn-primary" value="Save"/>

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