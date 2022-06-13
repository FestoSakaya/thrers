<ul id="countrytabs" class="shadetabs">
<li><a href="#" rel="#default" class="selected">Deviations View Submission</a></li>
</ul>

<div id="countrydivcontainer" style="border:0px solid gray; width:100%; margin-bottom: 1em; padding: 10px">
<?php
$sqlstudym="SELECT * FROM ".$prefix."deviations where protocol_id='$id' order by deviationID desc limit 0,1";
$Querystudym = $mysqli->query($sqlstudym);
$rstudym = $Querystudym->fetch_array();
$owner_id=$rstudym['owner_id'];
$protocol_idwe=$rstudym['protocol_id'];
$deviationID=$rstudym['deviationID'];

$reviewer_id=$_SESSION['asrmApplctID'];


$sqlprotocalSubSel="SELECT * FROM ".$prefix."submission where id='$protocol_idwe'";
$QprotocalSub2Sel = $mysqli->query($sqlprotocalSubSel);
$rprotocalSub2Sel = $QprotocalSub2Sel->fetch_array();

$public_title=$rprotocalSub2Sel['public_title'];

$sqlSRR = "select * from ".$prefix."user where asrmApplctID='$owner_id'";
$resultSSS = $mysqli->query($sqlSRR);
$sqUserdd = $resultSSS->fetch_array();
////Screening ID

$sqlproSubmission="SELECT * FROM ".$prefix."submission_review_sr where reviewer_id='$reviewer_id' and protocol_id='$protocol_idwe' and reviewFor='Deviations' and reviewStatus='Pending' order by id desc";
$QprotocalSubmission = $mysqli->query($sqlproSubmission);
$rprotocalSubmission = $QprotocalSubmission->fetch_array();
$rprotocalSubmission['id'];

if($_POST['doSendToEthical']=='Save'){
	
	
	$asrmApplctID_user=$mysqli->real_escape_string($_POST['asrmApplctID_user']);
	$protocol_idmm=$mysqli->real_escape_string($_POST['protocol_idmm']);
	$screening_id=$mysqli->real_escape_string($_POST['screening_id']);
	$draftopinion2=$mysqli->real_escape_string($_POST['recruitment_status']);
	$screening=$mysqli->real_escape_string($_POST['screening']);
	$reviewerID=$mysqli->real_escape_string($_POST['reviewer_id']);
	$ammendmnet_id=$mysqli->real_escape_string($_POST['ammendmnet_id']);
	
$sqlInvestigators="SELECT * FROM ".$prefix."initial_committee_screening where `owner_id`='$asrmApplctID_user' and screening='$screening' and protocol_id='$protocol_idmm' and reviewer_id='$reviewerID' and  screeningFor='Deviations' order by id desc";
	$QueryInvestigators = $mysqli->query($sqlInvestigators);
	$totalInvestigators = $QueryInvestigators->num_rows;
	
		if(!$totalInvestigators){
$sqlA2="insert into ".$prefix."initial_committee_screening (`owner_id`,`protocol_id`,`created`,`updated`,`screening`,`draftopinion`,`recAffiliated_id`,`reviewer_id`,`screeningFor`,`completionStatus`) 

values('$asrmApplctID_user','$protocol_idmm',now(),now(),'$screening','$draftopinion2','$recAffiliated_id','$reviewerID','Deviations','Completed')";
$mysqli->query($sqlA2);
		}
	
	$update="update ".$prefix."submission_review_sr	set recstatus='$draftopinion2',reviewStatus='Completed' where protocol_id='$protocol_idmm' and reviewer_id='$reviewerID' and id='$screening_id'";
$mysqli->query($update);
	
	//$update2="update ".$prefix."deviations	set status='$draftopinion2' where protocol_id='$protocol_idmm' and code='$ammendmnet_id'";
	//$mysqli->query($update2);
	
	
		echo '<img src="images/loading_wait.gif">';
echo '<div class="spacer"></div>';
echo '<meta http-equiv="refresh" content="2; url='.$base_url.'/main.php?option=ReviewerMyDeviations" />';
		
}

?>
  <!-- Project-->
              <div class="project">
                <div class="row bg-white has-shadow">
                  <div class="left-col col-lg-6 d-flex align-items-center justify-content-between">
                    <div class="project-title d-flex align-items-center">
                     <?php if($sqUserdd['profile']){?> <div class="image has-shadow"><img src="files/profile/<?php echo $sqUserdd['profile'];?>" alt="..." class="img-fluid"></div><?php }?>
                      <div class="text">
                        <h3 class="h4">Protocal Title</h3><small><?php echo $rprotocalSub2Sel['public_title'];?></small>
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


 <?php
$sqlstudy="SELECT * FROM ".$prefix."deviations where deviationID='$deviationID' order by deviationID desc limit 0,1";
$Querystudy = $mysqli->query($sqlstudy);
$totalstudy = $Querystudy->num_rows;
$rstudy = $Querystudy->fetch_array();
?> 
<button class="accordion">A) Protocol Deviation (May pose no more than minimal risk to participants and protocol implementation)</button>
  <div class="panel">
 
<label><strong>1.	Date of occurrence:</strong> <?php echo $rstudy['PDDateofoccurrence'];?></label><br />
<label><strong>2.	Description of deviation :</strong> <?php echo $rstudy['PDDescriptionofdeviation'];?></label><br />
<label><strong>3.	Root cause of deviation :</strong> <?php echo $rstudy['Rootcauseofdeviation'];?></label><br />

<label><strong>4.	Corrective action taken :</strong> <?php echo $rstudy['Correctiveactiontaken'];?></label><br />
<label><strong>5.	Measures to mitigate deviation :</strong> <?php echo $rstudy['Measurestomitigatedeviation'];?></label><br />

  </div>
  
<button class="accordion">B)	Protocol violation (May pose high risk to participants and protocol implementation)</button>
  <div class="panel">
 
<label><strong>1.	Date of occurrence:</strong> <?php echo $rstudy['PVDateofoccurrence'];?></label><br />
<label><strong>2.	Description of violation :</strong> <?php echo $rstudy['PVDescriptionofdeviation'];?></label><br />


<label><strong>Part A;</strong><br />
<?php echo $rstudy['parta'];?><br />
<?php echo $rstudy['partaOther'];?>
</label>



<label><strong>Part B:</strong><br /><?php echo $rstudy['partb'];?></label><br />


<label><strong>3. Root cause of violation :</strong> <?php echo $rstudy['Rootcauseofviolation_b'];?></label><br />


<label><strong>4. Corrective action:</strong> <?php echo $rstudy['Correctiveaction_b'];?></label><br />

<label><strong>5. Measures to mitigate violation: </strong> <?php echo $rstudy['Measurestomitigateviolation_b'];?></label>


  </div>
  
  

    
    
<?php
$sqlgg = "select * FROM ".$prefix."initial_committee_screening where owner_id='$owner_id' and protocol_id='$protocol_idwe' and reviewer_id='$asrmApplctID' and completionStatus='Pending'";//and conceptm_status='new' 
$resultgg = $mysqli->query($sqlgg);
$rInvestigatorgg=$resultgg->fetch_array();


?>
 <form action="" method="post" name="regForm" id="regForm" enctype="multipart/form-data">
<h4>Reviewer Comments:</h4>
<div class="form-group row">
<label class="col-sm-4 form-control-label">Committee Screening:</label>
<textarea name="screening" id="screening" cols="" rows="5" class="form-control  required"><?php echo $rInvestigatorgg['screening'];?></textarea>
<input name="asrmApplctID_user" type="hidden" value="<?php echo $owner_id;?>"/>
<input name="protocol_idmm" type="hidden" value="<?php echo $protocol_idwe;?>"/>
<input name="recAffiliated_id" type="hidden" value="<?php echo $recAffiliated_id;?>"/>
<input name="screening_id" type="hidden" value="<?php echo $rprotocalSubmission['id'];?>"/>
<input name="reviewer_id" type="hidden" value="<?php echo $_SESSION['asrmApplctID'];?>"/>
<input name="ammendmnet_id" type="hidden" value="<?php echo $ammendmnet_id;?>"/>
</div>
<div class="line"></div>


<div class="form-group row">

<select name="recruitment_status" id="recruitment_status" class="form-control  required">
<option value="">---------Select-------</option>
<?php
$sqlClinicalcv = "select * FROM ".$prefix."decision_status order by name desc";//and conceptm_status='new' 
$resultClinicalcv = $mysqli->query($sqlClinicalcv);
while($rClinicalcv=$resultClinicalcv->fetch_array()){
?>
<option value="<?php echo $rClinicalcv['name'];?>" <?php if($rprotocalSub2Sel['monitoring_action_id']==$rClinicalcv['draftopinion']){?>selected="selected"<?php }?>><?php echo $rClinicalcv['name'];?></option>
<?php }?>
</select>



</div>

<div class="form-group row">
                          <div class="col-sm-4 offset-sm-3">
                    <input name="doSendToEthical" type="submit"  class="btn btn-primary" value="Save"/>

                          </div>
                        </div>
         </form>
  
    
    
       
         
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

                        
<script type="text/javascript">

var countries=new ddajaxtabs("countrytabs", "countrydivcontainer")
countries.setpersist(true)
countries.setselectedClassTarget("link") //"link" or "linkparent"
countries.init()

</script>