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

<li><a href="./main.php?option=submissionUpSix&id=<?php echo $id;?>" style="text-decoration: none; position: relative;z-index: 1;padding: 3px 7px;
margin-right: 3px;border: 1px solid #778;color: #2d2b2b;background: white url(./ajaxtabs/shade.gif) top left repeat-x;">Attached Files</a></li>

<li><a href="./main.php?option=submissionupFinish&id=<?php echo $id;?>" rel="#default" class="selected">Payments</a></li>
</ul>

<div id="countrydivcontainer" style="border:0px solid gray; width:100%; margin-bottom: 1em; padding: 10px">
<?php
$sqlstudym="SELECT * FROM ".$prefix."submission where `owner_id`='$asrmApplctID' and is_sent='0' and protocol_id='$id' order by id desc limit 0,1";
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
<?php 
//doSaveFive
if($_POST['doFinalSubmission'] and $id and $_FILES['attachpayment']['name']){

$submission_id=$mysqli->real_escape_string($_POST['submission_id']);
$asrmApplctID=$mysqli->real_escape_string($_POST['asrmApplctID']);

if($_FILES['attachpayment']['name']){
$attachpayment = preg_replace('/\s+/', '_', $_FILES['attachpayment']['name']);
$attachpayment2 = $asrmApplctID.$mysqli->real_escape_string(preg_replace('/\s+/', '_', $_FILES['attachpayment']['name']));
$targetw1 = "./files/uploads/". basename($asrmApplctID.preg_replace('/\s+/', '_', $_FILES['attachpayment']['name']));
$studytoolsext_main1 = move_uploaded_file(preg_replace('/\s+/', '_', $_FILES['attachpayment']['tmp_name']), $targetw1);

$sqlA2Protocol="update ".$prefix."submission  set `is_sent`='1',`status`='Waiting for Committee',`paymentProof`='$attachpayment2' where id='$submission_id' and owner_id='$asrmApplctID'";
$mysqli->query($sqlA2Protocol);
}

if(!$_FILES['attachpayment']['name']){
$sqlA2Protocol="update ".$prefix."submission  set `is_sent`='1',`status`='Waiting for Committee' where id='$submission_id' and owner_id='$asrmApplctID'";
$mysqli->query($sqlA2Protocol);
}
echo '<img src="images/loading_wait.gif">';
echo '<div class="spacer"></div>';

echo '<meta http-equiv="refresh" content="5; url='.$base_url.'/main.php?option=dashboard" />';


}//end post



$sqlstudy="SELECT * FROM ".$prefix."submission where `owner_id`='$asrmApplctID' and is_sent='0' order by id desc limit 0,1";
$Querystudy = $mysqli->query($sqlstudy);
$totalstudy = $Querystudy->num_rows;
$rstudy = $Querystudy->fetch_array();
?>
<h3>Status</h3>


 <table class="table table-striped table-sm">
<tr>
<td> </td>
<td> </td>
<td> </td>
<td> </td>
 </tr>

</table>
     
  <div style="clear:both;"></div>    
   <!-- Trigger/Open The Modal -->
<form action="" name="regForm" id="regForm" method="post" enctype="multipart/form-data">
<input name="attachpayment" type="file" id="attachpayment" class="required"/>
<input name="protocol_id" type="hidden" value="<?php echo $id;?>"/>
<input type="hidden" name="asrmApplctID" value="<?php echo $_SESSION['asrmApplctID'];?>">
<input type="hidden" name="submission_id" value="<?php echo $rstudy['id'];?>">
                            
 <input name="doFinalSubmission" type="submit"  class="btn btn-primary" value="Make Final Submission" style="float:right; margin-top:5px; "/>
 

<input name="doCompleteLater" type="button"  class="btn btn-primary" value="Complete Later" style="float:right; margin-top:5px;margin-right:10px;" onClick="window.location.href='./main.php?option=dashboard'"/>
  
<div style="clear:both;"></div>
             
   
   </form>
   
   
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
<input name="attachethicalapproval" type="file" id="attachethicalapproval" class="required"/>

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