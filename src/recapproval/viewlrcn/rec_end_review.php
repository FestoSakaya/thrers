<ul id="countrytabs" class="shadetabs">
<li class="extra">Reviewer Comments</li>
<li><a href="#" rel="#default" class="selected">Opinion</a></li>
</ul>

<div id="countrydivcontainer" style="border:0px solid gray; width:100%; margin-bottom: 1em; padding: 10px">
<?php
$srid=$mysqli->real_escape_string($_GET['srid']);

$sqlstudym="SELECT * FROM ".$prefix."submission where id='$id' order by id desc limit 0,1";
$Querystudym = $mysqli->query($sqlstudym);
$rstudym = $Querystudym->fetch_array();
$owner_id=$rstudym['owner_id'];
$protocol_idwe=$rstudym['protocol_id'];
$submission_idm=$rstudym['id'];
$code="REC.00.$protocol_idwe.01";

$sqlprotocalSubSel="SELECT * FROM ".$prefix."protocol where id='$protocol_idwe' and owner_id='$owner_id'";
$QprotocalSub2Sel = $mysqli->query($sqlprotocalSubSel);
$rprotocalSub2Sel = $QprotocalSub2Sel->fetch_array();
if(!$rprotocalSub2Sel['code']){
$sqlUpdateProtocl="update ".$prefix."protocol set code='$code' where id='$protocol_idwe' and owner_id='$owner_id'";
//$mysqli->query($sqlUpdateProtocl);
}

$sqlSRR = "select * from ".$prefix."user where asrmApplctID='$owner_id'";
$resultSSS = $mysqli->query($sqlSRR);
$sqUserdd = $resultSSS->fetch_array();


if($_POST['doEndReview']=='Save Decision and Submit'){

	$asrmApplctID_user=$mysqli->real_escape_string($_POST['asrmApplctID_user']);
	$protocol_idmm=$mysqli->real_escape_string($_POST['protocol_idmm']);
	$recruitment_status=$mysqli->real_escape_string($_POST['recruitment_status']);
	$period=$mysqli->real_escape_string($_POST['period']);
	$submission_idm=$mysqli->real_escape_string($_POST['submission_idm']);
	$session_reviewer=$_SESSION['asrmApplctID'];

$sqlSRecruitment = "select * from ".$prefix."decision_status where id='$recruitment_status'";
$resRecruitment = $mysqli->query($sqlSRecruitment);
$sqRecruitment = $resRecruitment->fetch_array();
$status=$sqRecruitment['name'];

$sqlA23="update ".$prefix."protocol_comment_rec set `recstatus`='$status' where `user_id`='$asrmApplctID_user' and `protocol_id`='$protocol_idmm' and reviewer_id='$session_reviewer'";
$mysqli->query($sqlA23);


$sqlA23dd="update ".$prefix."submission_review_sr set `recstatus`='$status',`protocolStage`='stage1' where `protocol_id`='$protocol_idmm' and reviewer_id='$session_reviewer' and id='$srid'";
$mysqli->query($sqlA23dd);


$sqlA23dd33="update ".$prefix."initial_committee_screening set `completionStatus`='Completed',`updated`=now() where `owner_id`='$asrmApplctID_user' and `protocol_id`='$protocol_idmm' and reviewer_id='$session_reviewer'";
$mysqli->query($sqlA23dd33);



$message='<p class="success">Review was completed successfully. Thank You</p>';

echo '<img src="images/loading_wait.gif">';
echo '<div class="spacer"></div>';
echo '<meta http-equiv="refresh" content="5; url='.$base_url.'/main.php?option=dashboard" />';

	
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
<?php if(isset($message)){echo $message;}?>
 
  
  
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


  

    <h4>Opinion:</h4>
    
 <form action="" method="post" name="regForm" id="regForm" enctype="multipart/form-data">

<div class="form-group row">

<select name="recruitment_status" id="recruitment_status" class="form-control  required">
<option value="">---------Select-------</option>
<?php
$sqlClinicalcv = "select * FROM ".$prefix."decision_status where actionfor='reviewers' order by id asc";//and conceptm_status='new' 
$resultClinicalcv = $mysqli->query($sqlClinicalcv);
while($rClinicalcv=$resultClinicalcv->fetch_array()){
?>
<option value="<?php echo $rClinicalcv['id'];?>" <?php if($rprotocalSub2['monitoring_action_id']==$rClinicalcv['id']){?>selected="selected"<?php }?>><?php echo $rClinicalcv['name'];?></option>
<?php }?>



</select>


<input name="asrmApplctID_user" type="hidden" value="<?php echo $owner_id;?>"/>
<input name="protocol_idmm" type="hidden" value="<?php echo $protocol_idwe;?>"/>
<input name="submission_idm" type="hidden" value="<?php echo $id;?>"/>
</div>
<div class="line"></div>

<div class="form-group row">
                          <div class="col-sm-4 offset-sm-3">
                    <input name="doEndReview" type="submit"  class="btn btn-primary" value="Save Decision and Submit"/>

                          </div>
                        </div>
         </form>
                        
<script type="text/javascript">

var countries=new ddajaxtabs("countrytabs", "countrydivcontainer")
countries.setpersist(true)
countries.setselectedClassTarget("link") //"link" or "linkparent"
countries.init()

</script>