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

<li><a href="./main.php?option=submissionupFive&id=<?php echo $id;?>"  rel="#default" class="selected">Bibliography</a></li>

<li><a href="./main.php?option=submissionUpSix&id=<?php echo $id;?>" style="text-decoration: none; position: relative;z-index: 1;padding: 3px 7px;
margin-right: 3px;border: 1px solid #778;color: #2d2b2b;background: white url(./ajaxtabs/shade.gif) top left repeat-x;">Attached Files</a></li>

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
if($_POST['doSaveFive'] and $_POST['bibliography'] and $_POST['sscientific_contact'] and $_POST['asrmApplctID'] and $id){

	$bibliography=$mysqli->real_escape_string($_POST['bibliography']);
	$sscientific_contact=$mysqli->real_escape_string($_POST['sscientific_contact']);
	$prior_ethical_approval=$mysqli->real_escape_string($_POST['prior_ethical_approval']);
	$submission_id=$mysqli->real_escape_string($_POST['submission_id']);
	$asrmApplctID=$mysqli->real_escape_string($_POST['asrmApplctID']);

if($_FILES['attachethicalapproval']['name']){
$attachethicalapproval = preg_replace('/\s+/', '_', $_FILES['attachethicalapproval']['name']);
$attachethicalapproval2 = $sasrmApplctID.$mysqli->real_escape_string(preg_replace('/\s+/', '_', $_FILES['attachethicalapproval']['name']));
$targetw1 = "files/uploads/". basename($sasrmApplctID.preg_replace('/\s+/', '_', $_FILES['attachethicalapproval']['name']));
$studytoolsext_main1 = move_uploaded_file(preg_replace('/\s+/', '_', $_FILES['attachethicalapproval']['tmp_name']), $targetw1);

$sqlA2Protocola="update ".$prefix."submission  set `approvaletter`='$attachethicalapproval2' where id='$submission_id' and owner_id='$asrmApplctID'";
$mysqli->query($sqlA2Protocola);
}

$sqlA2Protocol="update ".$prefix."submission  set `bibliography`='$bibliography',`sscientific_contact`='$sscientific_contact',`prior_ethical_approval`='$prior_ethical_approval' where id='$submission_id' and owner_id='$asrmApplctID'";
$mysqli->query($sqlA2Protocol);

$message='<p class="success">Dear '.$session_fullname.', details have been submitted, proceed to continue</p>';
logaction("$session_fullname updated protocol, Bibliography Information");

echo '<img src="images/loading_wait.gif">';
echo '<div class="spacer"></div>';
echo '<meta http-equiv="REFRESH" content="0;url='.$base_url.'/main.php?option=submissionUpSix&id='.$id.'">';


}//end post

$sqlstudy="SELECT * FROM ".$prefix."submission where `owner_id`='$asrmApplctID' and id='$id' order by id desc limit 0,1";
$Querystudy = $mysqli->query($sqlstudy);
$totalstudy = $Querystudy->num_rows;
$rstudy = $Querystudy->fetch_array();
$protocol_id=$rstudy['protocol_id'];
if(isset($message)){echo $message;}
?>

<form action="" name="regForm" id="regForm" method="post" enctype="multipart/form-data">
       <h3>Bibliography</h3>
                        <div class="form-group row">
                          <label class="col-sm-2 form-control-label">Bibliography:</label>
                          <textarea name="bibliography" id="bibliography" cols="" rows="5" class="form-control  required"><?php echo $rstudy['bibliography'];?></textarea>
                        </div>
                        <div class="line"></div>
                        
                        <h3>Contacts</h3>
                         <div class="form-group row">
                          <label class="col-sm-2 form-control-label">Contact Person:</label>
                         
                            <input type="text" name="sscientific_contact" id="sscientific_contact" class="form-control  required" value="<?php echo $rstudy['sscientific_contact'];?>">
                           <input name="protocol_id" type="hidden" value="<?php echo $protocol_id;?>"/>
                            <input type="hidden" name="asrmApplctID" value="<?php echo $_SESSION['asrmApplctID'];?>">
                            <input type="hidden" name="submission_id" value="<?php echo $rstudy['id'];?>">
                       
                        </div>
                        <div class="line"></div>
                        
                        <?php /*?>  <div class="form-group row">
                          <label class="col-sm-4 form-control-label">Prior Ethical Approval:</label>

                          <input name="prior_ethical_approval" type="radio" value="1" class="required"  onChange="getState(this.value)" <?php if($rstudy['prior_ethical_approval']==1){?>checked="checked"<?php }?>/> Yes &nbsp;<input name="prior_ethical_approval" type="radio" value="0" class="required" onChange="getState(this.value)" <?php if($rstudy['prior_ethical_approval']==0){?>checked="checked"<?php }?>/> No
  
                        
                          
                        </div>
                        <div id="statediv"></div>
<?php if($rstudy['prior_ethical_approval']==1){?>
  <a href="./files/uploads/<?php echo $rstudy['approvaletter'];?>" ><?php echo $rstudy['approvaletter'];?></a>
  <?php }?>  
  
                        <div class="line"></div><?php */?>
                        
                       
                        
                        <div class="form-group row">
                          <div class="col-sm-4 offset-sm-3">
                    <input name="doSaveFive" type="submit"  class="btn btn-primary" value="Save and Next"/>

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