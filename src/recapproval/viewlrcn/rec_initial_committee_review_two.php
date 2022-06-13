<ul id="countrytabs" class="shadetabs">
<li class="extra">Reviewer Comments</li>
<li><a href="#" rel="#default" class="selected">Review</a></li>
<li class="extra">End Review</li>
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


if($_POST['doSendMeeting']=='Save and Proceed'){

	$asrmApplctID_user=$mysqli->real_escape_string($_POST['asrmApplctID_user']);
	$protocol_idmm=$mysqli->real_escape_string($_POST['protocol_idmm']);
	$meeting_id=$mysqli->real_escape_string($_POST['meeting']);

$sqlA2="update ".$prefix."protocol set `meeting_id`='$meeting_id',`main_submission_id`='$protocol_idmm',`recAffiliated_id`='$recAffiliated_id' where `owner_id`='$asrmApplctID_user' and `id`='$protocol_idmm'";
$mysqli->query($sqlA2);

echo '<img src="images/loading_wait.gif">';
echo '<div class="spacer"></div>';

echo '<meta http-equiv="REFRESH" content="0;url='.$base_url.'/main.php?option=recEndReview&id='.$id.'">';
	
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
<button class="accordion">Protocol Information, click to review</button>
  <div class="panel">
  <?php
  $sqlprotocalSub="SELECT * FROM ".$prefix."submission where  id='$id' order by id desc limit 0,1";
$QprotocalSub = $mysqli->query($sqlprotocalSub);
$rprotocalSub = $QprotocalSub->fetch_array();
$protocol_id=$rprotocalSub['protocol_id'];
$iowner_id=$rprotocalSub['owner_id'];

$sqlprotocalSub2="SELECT * FROM ".$prefix."protocol where  id='$protocol_id'";
$QprotocalSub2 = $mysqli->query($sqlprotocalSub2);
$rprotocalSub2 = $QprotocalSub2->fetch_array();

$sqlclinical="SELECT * FROM ".$prefix."submission_clinical_trial where  owner_id='$iowner_id' and submission_id='$protocol_id'";
$QClinical = $mysqli->query($sqlclinical);
$rClinical = $QClinical->fetch_array();
$clinical_trial_name_id2=$rClinical['id'];

$sqlclinical2="SELECT * FROM ".$prefix."list_clinical_trial_name where  id='$clinical_trial_name_id2'";
$QClinical2 = $mysqli->query($sqlclinical2);
$rClinical2 = $QClinical2->fetch_array();
?>
  <table width="100%" border="0">
  <tr>
    <td><strong>Identification</strong></td>
    <td><strong>Protocol</strong></td>
    <td><strong>Protocol Type</strong></td>
    <td><strong>Status</strong></td>
  </tr>
  <tr>
    <td>0000<?php echo $rprotocalSub['protocol_id'];?></td>
    <td><?php echo $rprotocalSub2['code'];?></td>
    <td><?php if($rprotocalSub['is_clinical_trial']==1){?>Clinical Trial<?php }?>
  <?php if($rprotocalSub['is_clinical_trial']==0){?>Research<?php }?></td>
    <td><?php echo $rprotocalSub['status'];?></td>
  </tr>
  <tr>
    <td style="padding-top:20px;"><strong>Institution</strong></td>
    <td><strong>Updated</strong></td>
    <td><strong>Decision</strong></td>
    <td><strong>Finished</strong></td>
  </tr>
  <tr>
    <td><?php echo $rClinical2['name'];?></td>
    <td><?php echo $rprotocalSub['updated'];?></td>
    <td>&nbsp;</td>
    <td><?php echo $rprotocalSub['updated'];?></td>
  </tr>

 <!--  <tr>
    <td style="padding-top:20px;"><strong>Recruiting</strong></td>
    <td><strong>Monitoring</strong></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
   <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>-->
  
  
</table>

  
  
    <hr />
  <h3 style="font-size:14px; background:#ADCEE2; color:#000000; padding:10px;">Team Members </h3> 
  
 <table id="customers">
                        <thead>
                          <tr>
                            <th>Name</th>
                            <th>Institution</th>
                            <th>Email</th>
                            <th>Country</th>
                       <th>HSP/GCP Training </th>
                       <th>Action </th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php
//if no page var is given, set start to 0
$sql = "select *,DATE_FORMAT(`created`,'%d/%m/%Y %H:%s:%i') AS created FROM ".$prefix."team where owner_id='$owner_id' and protocol_id='$protocol_idwe' order by id desc LIMIT 0,10";//and conceptm_status='new' 
$result = $mysqli->query($sql);
while($rInvestigator=$result->fetch_array()){
$countryid=$rInvestigator['countryid'];
$sqlCountry = "select * FROM ".$prefix."list_country where id='$countryid' order by id desc";//and conceptm_status='new' 
$resultCountry = $mysqli->query($sqlCountry);
$rCountry=$resultCountry->fetch_array();
	?>
                          <tr>
                            <td><?php echo $rInvestigator['name'];?></td>
                            <td><?php echo $rInvestigator['institution'];?></td>
                            <td><?php echo $rInvestigator['email'];?></td>
                            <td><?php echo $rCountry['name'];?></td>
                           <td>
                           
                          
                           <?php if($rInvestigator['GCPtraining']){?><a href="./files/uploads/<?php echo $rInvestigator['GCPtraining'];?>" style="color:#06F; font-weight:bold; font-size:12px;" target="_blank">View File</a><?php }?>
                           
                            </td>
                            
                             <td>
                             
                           <?php if($rInvestigator['employment']==1){?>   
                             <input id="go" type="button" value="View Details" onclick="window.open('<?php echo $base_url;?>viewbiodata.php?id=<?php echo $rInvestigator['id'];?>','popUpWindow','height=700, width=1000, left=100, top=100, resizable=yes, scrollbars=yes, toolbar=yes, menubar=no, location=no, directories=no, status=yes');"  class="errorm4" >
                             <?php }?>
                             
                            </td>
                          </tr>
   <?php }///////////end function ?>                 
                        </tbody>
                      </table>
  
  
  
  </div>
  
  


  <button class="accordion">Attachments, click to review</button>
  <div class="panel">
  
  <table class="table table-striped table-sm">
                        <thead>
                          <tr>
                            <th>File name</th>
                            <th>Type</th>
                            <th>Language</th>
                            <th>Version</th>
                            <th>Submitted By</th>
                            <th> Date & Time</th>

                          </tr>
                        </thead>
                        <tbody>
                        <?php
//if no page var is given, set start to 0
$sql = "select *,DATE_FORMAT(`created`,'%d/%m/%Y %H:%s:%i') AS created FROM ".$prefix."submission_upload where user_id='$owner_id' and submission_id='$protocol_idwe' order by id desc LIMIT 0,150";//and conceptm_status='new' 
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
                            <td><a href="./files/uploads/<?php echo $rInvestigator['filename'];?>" target="_blank">View File</a></td>
                            <td><?php if($rInvestigator['othername']){echo $rInvestigator['othername'];}else{echo $rfile['name'];}?></td>
                            <td><?php echo $rInvestigator['Language'];?></td>
                            <td><?php echo $rInvestigator['Version'];?> </td>
                            <td><?php echo $rUsers['name'];?></td>
                            <td><?php echo $rInvestigator['created'];?></td>

                          </tr>
   <?php }///////////end function ?>                 
                        </tbody>
                      </table>
  
  
  
  
  </div>
  
  
<!--  <button class="accordion">History, click to review</button>
  <div class="panel">Ngssss  snsnsnsn</div>-->
  
  

  
     <?php
if($_POST['doAddComment']=='Save'){

	$reviwer=$mysqli->real_escape_string($_POST['reviwer']);
	$asrmApplctID_user=$mysqli->real_escape_string($_POST['asrmApplctID_user']);
	$protocol_idmm=$mysqli->real_escape_string($_POST['protocol_idmm']);
	$message=$mysqli->real_escape_string($_POST['message']);
	$is_confidential=$mysqli->real_escape_string($_POST['is_confidential']);

	
$sqlInvestigators="SELECT * FROM ".$prefix."protocol_comment_rec where `protocol_id`='$protocol_idmm' and user_id='$asrmApplctID_user' and reviewer_id='$reviwer' and recAffiliated_id='$recAffiliated_id' and message='$message'";
	$QueryInvestigators = $mysqli->query($sqlInvestigators);
	$totalInvestigators = $QueryInvestigators->num_rows;
	
		if(!$totalInvestigators){
$sqlA2="insert into ".$prefix."protocol_comment_rec (`protocol_id`,`user_id`,`created`,`updated`,`message`,`reviewer_id`,`is_confidential`,`recAffiliated_id`) 

values('$protocol_idmm','$asrmApplctID_user',now(),now(),'$message','$reviwer','$is_confidential','$recAffiliated_id')";
$mysqli->query($sqlA2);
		}
	
}?>
    <table class="table table-striped table-sm">
                        <thead>
                          <tr>
                            <th>Date & Time</th>
                            <th>Author</th>
                            <th>Message</th>
 
                          </tr>
                        </thead>
                        <tbody>
                        <?php
//if no page var is given, set start to 0
$sql = "select *,DATE_FORMAT(`created`,'%d/%m/%Y %H:%s:%i') AS created FROM ".$prefix."protocol_comment_rec where user_id='$owner_id' and protocol_id='$protocol_idwe' and reviewer_id='$asrmApplctID' order by id desc LIMIT 0,10";//and conceptm_status='new' 
$result = $mysqli->query($sql);
while($rInvestigator=$result->fetch_array()){
$upload_type_id=$rInvestigator['upload_type_id'];
$submittedBy=$rInvestigator['user_id'];

//user
$sqlUserup = "select * FROM ".$prefix."user where asrmApplctID='$submittedBy'";//and conceptm_status='new' 
$resultUser = $mysqli->query($sqlUserup);
$rUsers=$resultUser->fetch_array();
	?>
                          <tr>
                            <td><?php echo $rInvestigator['created'];?></td>
                            <td><?php echo $rUsers['name'];?></td>
                            <td><?php echo $rInvestigator['message'];?></td>

                          </tr>
   <?php }///////////end function ?>                 
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

                 
<button id="myBtn">Add Comments </button> 
  <div style="clear:both;"></div>
  
  <!-- The Modal -->
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
      <span class="close">&times;</span>
      <h3><strong>Add Comments</strong></h3>
    </div>
    <div class="modal-body">

 <form action="" method="post" name="regForm" id="regForm" >
                      
 <div class="form-group row" style="padding-top:10px;">
 <input name="reviwer" type="hidden" value="<?php echo $_SESSION['asrmApplctID'];?>"/>
 
<label class="col-sm-2 form-control-label">Message:</label>
<div class="col-sm-10">

<textarea name="message" id="message" cols="" rows="" class="form-control  required"></textarea>

<input name="asrmApplctID_user" type="hidden" value="<?php echo $owner_id;?>"/>
<input name="protocol_idmm" type="hidden" value="<?php echo $protocol_idwe;?>"/>
</div>
</div> 



                        
                  
                        
       
       <div class="form-group row">
                          <div class="col-sm-4 offset-sm-3">
                    <input name="doAddComment" type="submit"  class="btn btn-primary" value="Save"/>

                          </div>
                        </div>
                                          
     </form>                   
    </div>
    </div>
    </div><!--End-->
     <form action="" method="post" name="regForm" id="regForm" enctype="multipart/form-data">
<div class="form-group row">
                          <div class="col-sm-4 offset-sm-3">
                    <input name="doSendMeeting" type="submit"  class="btn btn-primary" value="Save and Proceed"/>

                          </div>
                        </div>
         </form>
                        
<script type="text/javascript">

var countries=new ddajaxtabs("countrytabs", "countrydivcontainer")
countries.setpersist(true)
countries.setselectedClassTarget("link") //"link" or "linkparent"
countries.init()

</script>