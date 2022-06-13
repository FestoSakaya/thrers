<input name="" type="button" class="search dropbtn2" value="Click to Deviation" onClick="window.location.href='./main.php?option=Deviations&id=<?php echo $id;?>'"/>


<div id="countrydivcontainer" style="border:0px solid gray; width:100%; margin-bottom: 1em; padding: 10px">
<?php
$sessionasrmApplctID=$_SESSION['asrmApplctID'];
$sqlstudym="SELECT * FROM ".$prefix."submission where `owner_id`='$sessionasrmApplctID' and id='$id' order by id desc limit 0,1";
$Querystudym = $mysqli->query($sqlstudym);
$rstudym = $Querystudym->fetch_array();
$owner_id=$rstudym['owner_id'];

$sqlSRR = "select * from ".$prefix."user where asrmApplctID='$sessionasrmApplctID'";
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

if($_POST['doSubmitProceed']=='Save Details' and $_POST['project_id']){

	
	$project_id=$mysqli->real_escape_string($_POST['project_id']);
	
$wmRenewals="select * from ".$prefix."submission where  id='$project_id'";
$cmdwbRenewals = $mysqli->query($wmRenewals);
$rRenewals= $cmdwbRenewals->fetch_array();

	$recAffiliated_id=$mysqli->real_escape_string($_POST['recAffiliated_id']);
	$protocol_title=$rRenewals['public_title'];

	
	$asrmApplctID=$mysqli->real_escape_string($_POST['asrmApplctID']);
	//$protocol_title=$mysqli->real_escape_string($_POST['protocol_title']);


	$chosen=$mysqli->real_escape_string($_POST['chosen']);

$sqlprotocalSubSelCAllmm="SELECT * FROM ".$prefix."deviations where protocol_id='$project_id' and owner_id='$sessionasrmApplctID' and ammendType='online' and is_sent='0' order by deviationID desc";
$QprotocalSub2SelCallmm = $mysqli->query($sqlprotocalSubSelCAllmm);
$totalstudy = $QprotocalSub2SelCallmm->num_rows;
if(!$totalstudy){
$sqlA2="insert into ".$prefix."deviations (`owner_id`,`protocol_id`,`recAffiliated_id`,`PDDateofoccurrence`,`PDDescriptionofdeviation`,`Rootcauseofdeviation`,`Correctiveactiontaken`,`Measurestomitigatedeviation`,`PVDateofoccurrence`,`PVDescriptionofdeviation`,`parta`,`partaOther`,`partb`,`Rootcauseofviolation_b`,`Correctiveaction_b`,`Measurestomitigateviolation_b`,`updatedon`,`status`,`assignedto`,`is_sent`,`paymentProof`,`paymentAttachment`,`protocol_title`,`ammendType`,`renewal_id`,`CompletenessCheck`,`chosen`) 

values('$sessionasrmApplctID','$project_id','$recAffiliated_id','$PDDateofoccurrence','$PDDescriptionofdeviation','$Rootcauseofdeviation','$Correctiveactiontaken','','$PVDateofoccurrence','$PVDescriptionofdeviation','$parta','$partaOther','$partb','$Rootcauseofviolation_b','$Correctiveaction_b','$Measurestomitigateviolation_b',now(),'Pending','Not Assigned','0','Not Paid','$attachpayment2','$protocol_title','online','','Pending','$chosen')";
$mysqli->query($sqlA2);
$record_id = $mysqli->insert_id;

$message='<p class="success">Dear '.$session_fullname.', details have been submitted, click finish button below to complete your submission</p>';
//logaction("$session_fullname added Deviations $PDDescriptionofdeviation");
/*echo '<meta http-equiv="REFRESH" content="2;url=$base_url/main.php?option=DeviationsOnline&id="'.$record_id.'">';*/
echo '<meta http-equiv="REFRESH" content="0;url='.$base_url.'/main.php?option=DeviationsOnline&id='.$record_id.'">';


}
if($totalstudy and $id){
$sqlA2="update ".$prefix."deviations set  `recAffiliated_id`='$recAffiliated_id',`protocol_id`='$project_id',`chosen`='$chosen' where owner_id='$sessionasrmApplctID' and deviationID='$id'";
$mysqli->query($sqlA2);
$message='<p class="success">Dear '.$session_fullname.', details have been submitted, click finish button below to complete your submission</p>';
echo '<meta http-equiv="REFRESH" content="0;url='.$base_url.'/main.php?option=ChooseDeviationsOnline&id='.$id.'">';
}


}//end post





$sqlstudy="SELECT * FROM ".$prefix."deviations where `owner_id`='$sessionasrmApplctID' and deviationID='$id' order by deviationID desc limit 0,1";
$Querystudy = $mysqli->query($sqlstudy);
$totalstudy = $Querystudy->num_rows;
$rstudy = $Querystudy->fetch_array();
if(isset($message)){echo $message;}

$shcategoryID3=$rstudy['parta'];
$categoryChunks3 = explode("|", $shcategoryID3);

$chop1="$categoryChunks3[0]";
$chop2="$categoryChunks3[1]";
$chop3="$categoryChunks3[2]";
$chop4="$categoryChunks3[3]";
$chop5="$categoryChunks3[4]";
$chop6="$categoryChunks3[5]";
$chop7="$categoryChunks3[6]";
$chop8="$categoryChunks3[7]";
$chop9="$categoryChunks3[8]";
$chop10="$categoryChunks3[9]";
//////////////////////////////////////////
$shcategoryID4=$rstudy['partb'];
$categoryChunks4 = explode("|", $shcategoryID4);

$chei1="$categoryChunks4[0]";
$chei2="$categoryChunks4[1]";
$chei3="$categoryChunks4[2]";
$chei4="$categoryChunks4[3]";
$chei5="$categoryChunks4[4]";
$chei6="$categoryChunks4[5]";
$chei7="$categoryChunks4[6]";
$chei8="$categoryChunks4[7]";
$chei9="$categoryChunks4[8]";
$chei10="$categoryChunks4[9]";
?>

   
   <div style="clear:both;"></div>
<form action="" method="post" name="regForm" id="regForm" enctype="multipart/form-data">

<div class="form-group row success">
<label class="col-sm-10 form-control-label">Select Protocol you are submitting to: <span class="error">*</span></label>
<div class="col-sm-10">

<select name="project_id" id="project_id" class="form-control  required">
<option value="">Please Select Protocol</option>
<?php
$sqlSubmission = "select * FROM ".$prefix."submission where owner_id='$sessionasrmApplctID' and status='Approved' order by id desc";
$QuerySubmission = $mysqli->query($sqlSubmission);
while($resultSubmission=$QuerySubmission->fetch_array()){
?>
<option value="<?php echo $resultSubmission['id'];?>" <?php if($resultSubmission['id']==$rstudy['protocol_id']){?>selected="selected"<?php }?>><?php echo $resultSubmission['public_title'];?></option>

<?php }?>

</select>
</div>
</div>


<div class="form-group row success">
 <label class="col-sm-12 form-control-label">Choose REC: <br /></label>

<select name="recAffiliated_id" id="recAffiliated_id" class="form-control  required" required>
<option value="">Please Select</option>
<?php
$sqlClinicalcv2 = "select * FROM ".$prefix."list_rec_affiliated where published='Yes' order by name asc";//and conceptm_status='new' 
$resultClinicalcv2 = $mysqli->query($sqlClinicalcv2);
while($rClinicalcv2=$resultClinicalcv2->fetch_array()){
?>
<option value="<?php echo $rClinicalcv2['id'];?>" <?php if($rClinicalcv2['id']==$rstudy['recAffiliated_id']){?>selected="selected"<?php }?>><?php echo $rClinicalcv2['name'];?></option>
<?php }?>
</select>

                  
                        </div>
                        <div class="line"></div> 
                   
                     
<div class="form-group row success">
 <label class="col-sm-12 form-control-label">What would you like to submit: <br /><br />

<input name="chosen" type="radio" value="Deviation" <?php if($rstudy['chosen']=='Deviation'){?>checked="checked"<?php }?>/> Deviation<br />
<input name="chosen" type="radio" value="Violation" <?php if($rstudy['chosen']=='Violation'){?>checked="checked"<?php }?>/> Violation<br />
<input name="chosen" type="radio" value="Both" <?php if($rstudy['chosen']=='Both'){?>checked="checked"<?php }?>/> Both</label>

                  
                        </div>
                        <div class="line"></div> 
                       
      <div class="form-group row">
                          <div class="col-sm-4 offset-sm-3">
                    <input name="doSubmitProceed" type="submit"  class="btn btn-primary" value="Save Details"/>
                 
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