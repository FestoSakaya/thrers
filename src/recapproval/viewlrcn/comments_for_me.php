<ul id="countrytabs" class="shadetabs">
<li><a href="#" rel="#default" class="selected">View Submission</a></li>
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
if(!$rprotocalSub2Sel['code']){
$sqlUpdateProtocl="update ".$prefix."protocol set code='$code' where id='$protocol_idwe' and owner_id='$owner_id'";
//$mysqli->query($sqlUpdateProtocl);
}

$sqlSRR = "select * from ".$prefix."user where asrmApplctID='$owner_id'";
$resultSSS = $mysqli->query($sqlSRR);
$sqUserdd = $resultSSS->fetch_array();


if($_POST['doSendToEthical']=='Send to Ethical Review' and $_POST['screening']){

	$screening=$mysqli->real_escape_string($_POST['screening']);
	$asrmApplctID_user=$mysqli->real_escape_string($_POST['asrmApplctID_user']);
	$protocol_idmm=$mysqli->real_escape_string($_POST['protocol_idmm']);
	
	if($_FILES['draftopinion']['name']){
$draftopinion = preg_replace('/\s+/', '_', $_FILES['draftopinion']['name']);
$draftopinion2 = $asrmApplctID.$mysqli->real_escape_string(preg_replace('/\s+/', '_', $_FILES['draftopinion']['name']));
$targetw1 = "files/uploads/". basename($asrmApplctID.preg_replace('/\s+/', '_', $_FILES['draftopinion']['name']));
$studytoolsext_main1 = move_uploaded_file(preg_replace('/\s+/', '_', $_FILES['draftopinion']['tmp_name']), $targetw1);

}
	
	$sqlInvestigators="SELECT * FROM ".$prefix."initial_committee_screening where `owner_id`='$asrmApplctID_user' and screening='$screening' and protocol_id='$protocol_idmm' order by id desc";
	$QueryInvestigators = $mysqli->query($sqlInvestigators);
	$totalInvestigators = $QueryInvestigators->num_rows;
	
		if(!$totalInvestigators){
$sqlA2="insert into ".$prefix."initial_committee_screening (`owner_id`,`protocol_id`,`created`,`updated`,`screening`,`draftopinion`) 

values('$asrmApplctID_user','$protocol_idmm',now(),now(),'$screening','$draftopinion2')";
$mysqli->query($sqlA2);
		}
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

  

  
<div class=" success">Comments</div>

    <table class="table table-striped table-sm" id="customers">
                        <thead>
                          <tr>
                            <th>Date & Time</th>
                            <th>Comment</th>
 </tr>
                        </thead>
                        <tbody>
                                              <?php
//if no page var is given, set start to 0
$sql2 = "select *,DATE_FORMAT(`created`,'%d/%m/%Y %H:%s:%i') AS created FROM ".$prefix."initial_committee_screening where owner_id='$owner_id' and protocol_id='$protocol_idwe' and collectiveDecision='Yes' order by id desc LIMIT 0,10";//and conceptm_status='new' 
$result2 = $mysqli->query($sql2);
$rInvestigator2=$result2->fetch_array();
	?>
    <tr>
                            <td colspan="2"><h4>Collective Decisions</h4></td>
                          </tr>
                          
                          <tr>
                            <td><?php echo $rInvestigator2['created'];?></td>
                            <td><?php echo $rInvestigator2['screening'];?></td>
</tr>
      
       
                        <?php
//if no page var is given, set start to 0
$sql = "select *,DATE_FORMAT(`chdate`,'%d/%m/%Y %H:%s:%i') AS chdate FROM ".$prefix."completeness_check_comments where owner_id='$owner_id' and protocol_id='$protocol_idwe' and status='Rejected' order by id desc LIMIT 0,10";//and conceptm_status='new' 
$result = $mysqli->query($sql);
if($totalInvestigators = $result->num_rows){
?>

   <tr>
                            <td colspan="2"><h4>Comments at Completeness Check</h4></td>
                          </tr>
<?php 

while($rInvestigator=$result->fetch_array()){
$upload_type_id=$rInvestigator['upload_type_id'];
$submittedBy=$rInvestigator['reviewer_id'];

//user
$sqlUserup = "select * FROM ".$prefix."user where asrmApplctID='$submittedBy'";//and conceptm_status='new' 
$resultUser = $mysqli->query($sqlUserup);
$rUsers=$resultUser->fetch_array();
	?>
                          <tr>
                            <td><?php echo $rInvestigator['chdate'];?></td>
                            <td><?php echo $rInvestigator['chcomments'];?></td>
</tr>
   <?php }}///////////end function ?> 
              
                        </tbody>
                      </table>
             
  

  
  
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