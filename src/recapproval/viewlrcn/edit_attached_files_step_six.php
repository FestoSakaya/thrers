<ul id="countrytabs" class="shadetabs">
<li><a href="./main.php?option=submissionUpSecond&id=<?php echo $id;?>" style="text-decoration: none; position: relative;z-index: 1;padding: 3px 7px;
margin-right: 3px;border: 1px solid #778;color: #2d2b2b;background: white url(./ajaxtabs/shade.gif) top left repeat-x;">Protocol Details</a></li>

<li><a href="./main.php?option=submissionUpThird&id=<?php echo $id;?>" style="text-decoration: none; position: relative;z-index: 1;padding: 3px 7px;
margin-right: 3px;border: 1px solid #778;color: #2d2b2b;background: white url(./ajaxtabs/shade.gif) top left repeat-x;">Clinical Study</a></li>

<li><a href="./main.php?option=submissionUpFour&id=<?php echo $id;?>" style="text-decoration: none; position: relative;z-index: 1;padding: 3px 7px;
margin-right: 3px;border: 1px solid #778;color: #2d2b2b;background: white url(./ajaxtabs/shade.gif) top left repeat-x;">Additional Information</a></li>

<li><a href="./main.php?option=submissionUpBudget&id=<?php echo $id;?>" style="text-decoration: none; position: relative;z-index: 1;padding: 3px 7px;
margin-right: 3px;border: 1px solid #778;color: #2d2b2b;background: white url(./ajaxtabs/shade.gif) top left repeat-x;">Budget</a></li>

<li><a href="./main.php?option=submissionUpSchedule&id=<?php echo $id;?>" style="text-decoration: none; position: relative;z-index: 1;padding: 3px 7px;
margin-right: 3px;border: 1px solid #778;color: #2d2b2b;background: white url(./ajaxtabs/shade.gif) top left repeat-x;">Study Work Plan</a></li>

<li><a href="./main.php?option=submissionupFive&id=<?php echo $id;?>" style="text-decoration: none; position: relative;z-index: 1;padding: 3px 7px;
margin-right: 3px;border: 1px solid #778;color: #2d2b2b;background: white url(./ajaxtabs/shade.gif) top left repeat-x;">Bibliography</a></li>

<li><a href="./main.php?option=submissionUpSix&id=<?php echo $id;?>" rel="#default" class="selected">Attached Files</a></li>

<li><a href="./main.php?option=submissionupFinish&id=<?php echo $id;?>" style="text-decoration: none; position: relative;z-index: 1;padding: 3px 7px;
margin-right: 3px;border: 1px solid #778;color: #2d2b2b;background: white url(./ajaxtabs/shade.gif) top left repeat-x;">Payments</a></li>
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
     


                    </div>
                  </div>
                </div>
              </div>
<?php 
//doSaveFive
if($_POST['doFilesUpload'] and $_FILES['attachethicalapproval']['name'] and $id and $_POST['asrmApplctID']){

	$upload_type_id=$mysqli->real_escape_string($_POST['upload_type_id']);

	$submission_id=$mysqli->real_escape_string($_POST['submission_id']);
	$asrmApplctID=$mysqli->real_escape_string($_POST['asrmApplctID']);
	$protocol_id=$mysqli->real_escape_string($_POST['protocol_id']);

if($_FILES['attachethicalapproval']['name']){
$attachethicalapproval = preg_replace('/\s+/', '_', $_FILES['attachethicalapproval']['name']);
$attachethicalapproval2 = $asrmApplctID.$mysqli->real_escape_string(preg_replace('/\s+/', '_', $_FILES['attachethicalapproval']['name']));
$targetw1 = "./files/uploads/". basename($asrmApplctID.preg_replace('/\s+/', '_', $_FILES['attachethicalapproval']['name']));
$studytoolsext_main1 = move_uploaded_file(preg_replace('/\s+/', '_', $_FILES['attachethicalapproval']['tmp_name']), $targetw1);

}

$sqlA2="insert into ".$prefix."submission_upload (`user_id`,`submission_id`,`upload_type_id`,`created`,`updated`,`filename`,`filepath`,`submission_number`,`is_monitoring_action`) 

values('$asrmApplctID','$protocol_id','$upload_type_id',now(),now(),'$attachethicalapproval2','','','')";
$mysqli->query($sqlA2);

$message='<p class="success">Dear '.$session_fullname.', details have been submitted, proceed to continue</p>';
logaction("$session_fullname updated protocol, Bibliography Information");

}//end post

//doSaveFive
if($_POST['doFilesUploadProceed'] and $id){
$message='<p class="success">Dear '.$session_fullname.', details have been submitted, proceed to continue</p>';
logaction("$session_fullname updated protocol, Bibliography Information");

echo '<img src="images/loading_wait.gif">';
echo '<div class="spacer"></div>';

echo '<meta http-equiv="REFRESH" content="0;url='.$base_url.'/main.php?option=submissionupFinish&id='.$id.'">';


}//end post

$sqlstudy="SELECT * FROM ".$prefix."submission where `owner_id`='$asrmApplctID' and id='$id' order by id desc limit 0,1";
$Querystudy = $mysqli->query($sqlstudy);
$totalstudy = $Querystudy->num_rows;
$rstudy = $Querystudy->fetch_array();
$protocol_id=$rstudym['protocol_id'];
?>
<h3>Attachments:</h3>


 <table class="table table-striped table-sm">
                        <thead>
                          <tr>
                            <th>Type</th>
                            <th>Name</th>
                            <th>File name</th>
                            <th> Date & Time</th>

                          </tr>
                        </thead>
                        <tbody>
                        <?php
//if no page var is given, set start to 0
$sql = "select *,DATE_FORMAT(`created`,'%Y-%m-%d') AS created FROM ".$prefix."submission_upload where user_id='$asrmApplctID' and submission_id='$protocol_id' order by id desc LIMIT 0,10";//and conceptm_status='new' 
$result = $mysqli->query($sql);
while($rInvestigator=$result->fetch_array()){
$upload_type_id=$rInvestigator['upload_type_id'];

$sqlrr = "select * FROM ".$prefix."upload_type where id='$upload_type_id'";//and conceptm_status='new' 
$resultdd = $mysqli->query($sqlrr);
$rdf=$resultdd->fetch_array();


	?>
                          <tr>
                            <td><?php if($today<=$rInvestigator['created']){?>
<a href="./cfxdownload.php?id=<?php echo $rInvestigator['id'];?>" target="_blank">View File</a>
<?php }else{?>
<a href="./cfxdownload.php?id=<?php echo $rInvestigator['id'];?>" target="_blank">View File</a>
<?php }?></td>
                            <td><?php echo $rdf['name'];?></td>
                            <td><?php echo $rInvestigator['created'];?></td>
                            <td><?php echo $rInvestigator['updated'];?></td>

                          </tr>
   <?php }///////////end function ?>                 
                        </tbody>
                      </table>
   <button id="myBtn">New Attachment </button>      
  <div style="clear:both;"></div>    
   <!-- Trigger/Open The Modal -->
   
   <?php
$sqlEw = "select * FROM ".$prefix."submission_upload where user_id='$asrmApplctID' and submission_id='$id' and  upload_type_id='1'";//and conceptm_status='new' 
$resultWe = $mysqli->query($sqlEw);
$totalUserEr = $resultWe->num_rows;
if($totalUserEr){
?>
<form action="" name="regForm" id="regForm" method="post" enctype="multipart/form-data">
 <input name="doFilesUploadProceed" type="submit"  class="btn btn-primary" value="Save and Next" style="float:right; margin-top:5px;"/>
<div style="clear:both;"></div>
   </form><?php }if(!$totalUserEr){ echo "<strong style='color:#F00'>Upload files to proceed. Protocol is required</strong>";}?>
   
   
   <!-- The Modal -->
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
      <span class="close">&times;</span>
      <h3><strong>New Attachment</strong></h3>
    </div>
    <div class="modal-body">

 <form action="" method="post" name="regForm" id="regForm" enctype="multipart/form-data">
<strong style="color:#F00;">Note: Protocol is Required</strong>
 <div class="form-group row" style="padding-top:10px;">
<label class="col-sm-2 form-control-label">Type:</label>
<div class="col-sm-10">
<select name="upload_type_id" id="upload_type_id" class="form-control  required">
<?php
$sqlClinicalcv = "select * FROM ".$prefix."upload_type order by name asc";//and conceptm_status='new' 
$resultClinicalcv = $mysqli->query($sqlClinicalcv);
while($rClinicalcv=$resultClinicalcv->fetch_array()){
?>
<option value="<?php echo $rClinicalcv['id'];?>"><?php echo $rClinicalcv['name'];?></option>
<?php }?>
</select>
</div>
</div> 



 <div class="form-group row">
 
<label class="col-sm-2 form-control-label">File:</label>
<div class="col-sm-10">
<input name="attachethicalapproval" type="file" id="attachethicalapproval" class="required" required/>

<input name="protocol_id" type="hidden" value="<?php echo $protocol_id;?>"/>
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