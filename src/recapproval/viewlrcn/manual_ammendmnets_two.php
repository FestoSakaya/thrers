<?php
$sessionasrmApplctID=$_SESSION['asrmApplctID'];

if($_POST['doFilesUpload']=='Save' and $_POST['Version'] and $_POST['Language'] and $id and $_POST['DocumentName']){

	$DocumentName=$mysqli->real_escape_string($_POST['DocumentName']);
	$submission_id=$mysqli->real_escape_string($_POST['submission_id']);
	$project_idmm=$mysqli->real_escape_string($_POST['project_id']);
	$asrmApplctID=$mysqli->real_escape_string($_POST['asrmApplctID']);
	
	$Version=$mysqli->real_escape_string($_POST['Version']);
	$Language=$mysqli->real_escape_string($_POST['Language']);
	$Date=$mysqli->real_escape_string($_POST['Date']);
	$code=$mysqli->real_escape_string($_POST['code']);
	
$ReasonforAmendment=$mysqli->real_escape_string($_POST['ReasonforAmendment']);
$changestostudyDistricts=$mysqli->real_escape_string($_POST['changestostudyDistricts']);
$ChangestoConsentForm=$mysqli->real_escape_string($_POST['ChangestoConsentForm']);
$ChangestodataCollectionTool=$mysqli->real_escape_string($_POST['ChangestodataCollectionTool']);
$ChangestoProtocol=$mysqli->real_escape_string($_POST['ChangestoProtocol']);
$recAffiliated_id=$mysqli->real_escape_string($_POST['recAffiliated_id']);
$otherattachment=$mysqli->real_escape_string($_POST['otherattachment']);	

if($file_type=='TrachedChanges'){
$CoverLetter = preg_replace('/\s+/', '_', $_FILES['attachethicalapproval']['name']);
$fileattachment = $sessionasrmApplctID.$mysqli->real_escape_string(preg_replace('/\s+/', '_', $_FILES['attachethicalapproval']['name']));
$targetw3 = "files/uploads/". basename($sessionasrmApplctID.preg_replace('/\s+/', '_', $_FILES['attachethicalapproval']['name']));
$studytoolsext_main3 = move_uploaded_file(preg_replace('/\s+/', '_', $_FILES['attachethicalapproval']['tmp_name']), $targetw3);
}

if($file_type=='Payment'){
$Payment = preg_replace('/\s+/', '_', $_FILES['attachethicalapproval']['name']);
$fileattachment = $sessionasrmApplctID.$mysqli->real_escape_string(preg_replace('/\s+/', '_', $_FILES['attachethicalapproval']['name']));
$targetw3 = "./files/uploads/". basename($sessionasrmApplctID.preg_replace('/\s+/', '_', $_FILES['attachethicalapproval']['name']));
$studytoolsext_main3 = move_uploaded_file(preg_replace('/\s+/', '_', $_FILES['attachethicalapproval']['tmp_name']), $targetw3);
}
if($file_type=='CleanCopy'){
$CoverLetter = preg_replace('/\s+/', '_', $_FILES['attachethicalapproval']['name']);
$fileattachment = $sessionasrmApplctID.$mysqli->real_escape_string(preg_replace('/\s+/', '_', $_FILES['attachethicalapproval']['name']));
$targetw3 = "./files/uploads/". basename($sessionasrmApplctID.preg_replace('/\s+/', '_', $_FILES['attachethicalapproval']['name']));
$studytoolsext_main3 = move_uploaded_file(preg_replace('/\s+/', '_', $_FILES['attachethicalapproval']['tmp_name']), $targetw3);
}
if($file_type=='CoverLetter'){
$CoverLetter = preg_replace('/\s+/', '_', $_FILES['attachethicalapproval']['name']);
$fileattachment = $sessionasrmApplctID.$mysqli->real_escape_string(preg_replace('/\s+/', '_', $_FILES['attachethicalapproval']['name']));
$targetw3 = "./files/uploads/". basename($sessionasrmApplctID.preg_replace('/\s+/', '_', $_FILES['attachethicalapproval']['name']));
$studytoolsext_main3 = move_uploaded_file(preg_replace('/\s+/', '_', $_FILES['attachethicalapproval']['tmp_name']), $targetw3);
}
	
if($file_type=='otherattachment'){
$CoverLetter = preg_replace('/\s+/', '_', $_FILES['attachethicalapproval']['name']);
$fileattachment = $sessionasrmApplctID.$mysqli->real_escape_string(preg_replace('/\s+/', '_', $_FILES['attachethicalapproval']['name']));
$targetw3 = "./files/uploads/". basename($sessionasrmApplctID.preg_replace('/\s+/', '_', $_FILES['attachethicalapproval']['name']));
$studytoolsext_main3 = move_uploaded_file(preg_replace('/\s+/', '_', $_FILES['attachethicalapproval']['tmp_name']), $targetw3);
}
if($DocumentName){
$CoverLetter = preg_replace('/\s+/', '_', $_FILES['attachethicalapproval']['name']);
$fileattachment = $sessionasrmApplctID.$mysqli->real_escape_string(preg_replace('/\s+/', '_', $_FILES['attachethicalapproval']['name']));
$targetw3 = "./files/uploads/". basename($sessionasrmApplctID.preg_replace('/\s+/', '_', $_FILES['attachethicalapproval']['name']));
$studytoolsext_main3 = move_uploaded_file(preg_replace('/\s+/', '_', $_FILES['attachethicalapproval']['tmp_name']), $targetw3);
}

$sqlprotocalSubSel="SELECT * FROM ".$prefix."ammendments_documents where amendment_id='$id' and owner_id='$sessionasrmApplctID' and atype='$file_type' and fileAttachment='$fileattachment'";
$QprotocalSub2Sel = $mysqli->query($sqlprotocalSubSel);
$totalstudy = $QprotocalSub2Sel->num_rows;
if(!$totalstudy and $id>1){
$sqlA2="insert into ".$prefix."ammendments_documents (`owner_id`,`protocol_id`,`recAffiliated_id`,`listchanges`,`fileAttachment`,`atype`,`created`,`status`,`assignedto`,`period`,`end_of_project`,`aLanguage`,`aVersion`,`aDate`,`code`,`ReasonforAmendment`,`changestostudyDistricts`,`ChangestoConsentForm`,`ChangestodataCollectionTool`,`ChangestoProtocol`,`Attachnewconsentform`,`Attachnewtool`,`Attachnewprotocol`,`paymentProof`,`is_sent`,`ammendType`,`protocol_title`,`refNo`,`amendment_id`,`otherattachment`) 

values('$sessionasrmApplctID','$id','$recAffiliated_id','','$fileattachment','$DocumentName',now(),'Pending','Not Assigned','','','$Language','$Version','$Date','$code','$ReasonforAmendment','$changestostudyDistricts','$ChangestoConsentForm','$ChangestodataCollectionTool','$ChangestoProtocol','','','','Not Paid','','manual','','','$id','$otherattachment')";
$mysqli->query($sqlA2);
}


$message='<p class="success">Dear '.$session_fullname.', details have been submitted.</p>';
logaction("$session_fullname added Ammendments");



}//end post



$sqlstudymAmmendment="SELECT * FROM ".$prefix."ammendments where `owner_id`='$asrmApplctID' and is_sent='0'  and ammendType='manual'  and id='$id' order by id desc limit 0,1";
$QuerystudymAmmendment = $mysqli->query($sqlstudymAmmendment);
$totalstudyAmmendment = $QuerystudymAmmendment->num_rows;
$rstudymAmmendment = $QuerystudymAmmendment->fetch_array();
///Attachments

$sqlprotocalAttachments="SELECT * FROM ".$prefix."ammendments_documents where owner_id='$sessionasrmApplctID' and is_sent='0' and ammendType='manual'  and amendment_id='$id' order by id desc";
$QprotocalAttachments = $mysqli->query($sqlprotocalAttachments);
$totalstudyAttachments = $QprotocalAttachments->num_rows;
$rsAtatchments = $QprotocalAttachments->fetch_array();

////Attached Payment
$sqlPayment="SELECT * FROM ".$prefix."ammendments_documents where `owner_id`='$asrmApplctID' and is_sent='0' and atype='Payment' and ammendType='manual'  and amendment_id='$id' order by id desc limit 0,1";
$QueryPayment = $mysqli->query($sqlPayment);
$totalPayment = $QueryPayment->num_rows;
?>
<?php
if($_POST['doQuestionOne']=='Save and Next'){

echo '<meta http-equiv="REFRESH" content="1;url='.$base_url.'/main.php?option=ManualAmmendmentsSecPay&id='.$id.'">';
echo '<img src="images/loading_wait.gif">';
echo '<div class="spacer"></div>';
//
	
}

?>

<ul id="countrytabs" class="shadetabs">

<?php if($totalstudyAmmendment>=1){?><li><a href="./main.php?option=ManualAmmendments&id=<?php echo $id;?>" style="background:green; color:#FFF;">Amendment Information</a></li><?php }?>
<?php if(!$totalstudyAmmendment){?><li class="extra" <?php if($totalstudy){?> style="background:green; color:#FFF;" <?php }?>>Amendment Information</li><?php }?>


<?php if($totalstudyAmmendment>=1){?><li><a href="./main.php?option=ManualAmmendmentsSec&id=<?php echo $id;?>" <?php if($totalstudyAttachments>=1 and $rsAtatchments['fileAttachment']){?> style="background:green; color:#FFF;" <?php }?>>Attachments</a></li><?php }?>

<?php if(!$totalstudyAmmendment){?><li class="extra" <?php if(!$totalstudyAttachments){?> style="background:green; color:#FFF;" <?php }?>>Attachments</li><?php }?>



<?php if($totalstudyAmmendment>=1){?><li><a href="./main.php?option=ManualAmmendmentsSecPay&id=<?php echo $id;?>" <?php if($totalPayment){?> style="background:green; color:#FFF;" <?php }?>>Payment</a></li><?php }?>

<?php if(!$totalstudyAmmendment){?><li class="extra" <?php if(!$totalPayment){?> style="background:green; color:#FFF;" <?php }?>>Payment</li><?php }?>


</ul>

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
                        <h3 class="h4">Protocal Title</h3><small><?php echo $rstudymAmmendment['public_title'];?></small>
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
if($_GET['del']=='true' and $category=='ManualAmmendmentsSec' and $id){
	$did=$mysqli->real_escape_string($_GET['did']);
$sqlA2Protocol2="delete from ".$prefix."ammendments_documents where `owner_id`='$sessionasrmApplctID' and id='$did'";
$mysqli->query($sqlA2Protocol2);	
	
	
}

$sqlstudy="SELECT *,DATE_FORMAT(`created`,'%Y-%m-%d') AS created FROM ".$prefix."ammendments_documents where `owner_id`='$sessionasrmApplctID' and amendment_id='$id'  and atype!='Payment' order by id desc";//and is_sent!='1' 
$Querystudy = $mysqli->query($sqlstudy);
$totalstudy = $Querystudy->num_rows;

if(isset($message)){echo $message;}
?>
   
   <div style="clear:both;"></div>
    <button id="myBtn">Click to add New Attachment </button> 
    
    
    
     <table class="table table-striped table-sm" id="customers">
                  <thead>
                          <tr>
                          <th>Protocol</th>
                            <th>Type</th>
                            <th>Language</th>
                            <th>Version</th>
                            <th>Date</th>
 <th></th>
                          </tr>
                        </thead>
                        <tbody>
            <?php while($rstudy = $Querystudy->fetch_array()){
				$code=$rstudy['code'];
$wmSubmissions="select * from ".$prefix."ammendments where  `id`='$id'";
$cmdwbSubmissions = $mysqli->query($wmSubmissions);
$rSubmissions= $cmdwbSubmissions->fetch_array();
				
				?>
                          <tr>
                          <td><?php echo $rSubmissions['protocol_title'];?></td>
                          
                            <td><?php if($today<=$rstudy['created']){?>
<a href="./cfxdownload.php?amm=<?php echo $rstudy['id'];?>" target="_blank" style="color:#06F;"><?php if($rstudy['atype']=='otherattachment'){echo $rstudy['otherattachment'];}  if($rstudy['atype']!='otherattachment'){echo $rstudy['atype'];}?></a>
<?php }else{?>
<a href="./cfxdownload.php?amm=<?php echo $rstudy['id'];?>" target="_blank" style="color:#06F;"><?php if($rstudy['atype']=='otherattachment'){echo $rstudy['otherattachment'];}  if($rstudy['atype']!='otherattachment'){echo $rstudy['atype'];}?></a>
<?php }?><br /></td>
                            
                            <td><?php echo $rstudy['aLanguage'];?></td>
                            <td><?php echo $rstudy['aVersion'];?></td>
                            <td><?php echo $rstudy['aDate'];?></td>
                            <td><a href="./main.php?option=ManualAmmendmentsSec&id=<?php echo $rstudy['amendment_id'];?>&del=true&did=<?php echo $rstudy['id'];?>" style="color:#F00; font-weight:bold;" onclick="return confirm('Are you sure you want to delete this item?');">Delete</a></td>
                            </tr>
               
               <?php }?>
                        </tbody>
                      </table> 
                      
<?php 
$wmRenewals="select * from ".$prefix."ammendments where  `owner_id`='$sessionasrmApplctID' and id='$id' and is_sent!='1' order by id desc limit 0,1";
$cmdwbRenewals = $mysqli->query($wmRenewals);
$rRenewals= $cmdwbRenewals->fetch_array();
//////////////Get Totals
$wmTrackedChanges="select * from ".$prefix."ammendments_documents where  `owner_id`='$sessionasrmApplctID' and amendment_id='$id' and atype='TrachedChanges'  and is_sent!='1' order by id desc limit 0,1";
$cmdwbTrackedChanges = $mysqli->query($wmTrackedChanges);
$totalsTrackedChanges = $cmdwbTrackedChanges->num_rows;

$wmCleanCopy="select * from ".$prefix."ammendments_documents where  `owner_id`='$sessionasrmApplctID' and amendment_id='$id' and atype='CleanCopy'  and is_sent!='1' order by id desc limit 0,1";
$cmdwbCleanCopy = $mysqli->query($wmCleanCopy);
$totalsCleanCopy = $cmdwbCleanCopy->num_rows;

$wmCoverLetter="select * from ".$prefix."ammendments_documents where  `owner_id`='$sessionasrmApplctID' and status='Pending' and atype='CoverLetter'  and is_sent!='1'  and amendment_id='$id' order by id desc limit 0,1";
$cmdwbCoverLetter = $mysqli->query($wmCoverLetter);
$totalsCoverLetter = $cmdwbCleanCopy->num_rows;
$rRenewalsProtcoo= $cmdwbCoverLetter->fetch_array();

$wmPayment="select * from ".$prefix."ammendments_documents where  `owner_id`='$sessionasrmApplctID' and amendment_id='$id' and atype='Payment'  and is_sent!='1' order by id desc limit 0,1";
$cmdwbPayment = $mysqli->query($wmPayment);
$totalsPayment = $cmdwbPayment->num_rows;

/////////////////Check totals
/*echo $totalsPayment.'| Proof of Payment<br>';
echo $totalsCoverLetter.'| Cover Letter<br>';
echo $totalsCleanCopy.'| Clean Copy<br>';
echo $totalsTrackedChanges.'| Tracked Changes<br>';*/
?>


<div style="color:#F00;">
<?php if($totalsCleanCopy<=0 || $totalsTrackedChanges<=0){ //$totalsPayment<=0 || $totalsCoverLetter<=0 || ?>
Please attach:<br /><?php }?>
<?php if($totalsTrackedChanges<=0){?>Proposal with Tracked Changes<br /><?php }?>
<?php if($totalsCleanCopy<=0){?>Clean Copy<br /><?php }else{?>
<form action="" method="post" name="regForm" id="regForm" autocomplte="false">
<input name="doQuestionOne" type="submit"  class="btn btn-primary" value="Save and Next"/>
</form>
<?php }?>
<?php /*?><?php if($totalsCoverLetter<=0){?>Cover letter<br /><?php }?>
<?php if($totalsPayment<=0){?>Proof of Payment<?php }?><?php */?>
    
    </div>
    <!-- The Modal -->
<div id="myModal" class="modal" style="margin-top:80px;">

  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
      <span class="close">&times;</span>
      <h3><strong>New Attachment</strong></h3>
    </div>
    <div class="modal-body" style="height:400px; overflow:scroll;">


 <form action="" method="post" name="regForm" id="regForm" enctype="multipart/form-data">
 

 <div class="form-group row success" style="padding-top:10px;">
 <input name="amendment_id" type="hidden" value="<?php echo $id;?>"/>
 <input name="recAffiliated_id" type="hidden" value="<?php echo $rRenewals['recAffiliated_id'];?>"/>
 <input name="code" type="hidden" value="<?php echo $rRenewals['code'];?>"/>
<label class="col-sm-10 form-control-label">Document Name <span class="error">*</span></label>
<div class="col-sm-10">
<!--<select name="file_type" id="upload_type_id" class="form-control  required" required onChange="getProtocolLanguage(this.value)">
<option value="">Select file type</option>
<option value="TrachedChanges">Tracked Changes</option>
<option value="CleanCopy">Clean Copy</option>
<option value="CoverLetter">Cover Letter</option>
<option value="otherattachment">Other</option>
</select>-->
<div class="col-sm-10ss" style="margin-left:10px;">
<input type="text" name="DocumentName" id="othername" class="form-control  required" value="" required style="width:730px;">

</div>
</div>
</div> 
<!--<div class="form-group row success">
 <div id="getProtocolLanguagediv"></div>
 </div>-->


 <div class="form-group row success">
 
<label class="col-sm-10 form-control-label">File  (PDF) <span class="error">*</span>:</label>
<div class="col-sm-10">
<input name="attachethicalapproval" type="file" id="attachethicalapproval" class="required" required/>

<input type="hidden" name="asrmApplctID" value="<?php echo $_SESSION['asrmApplctID'];?>">

</div>
</div>
                        
                       
   <div class="form-group row success">
 
<label class="col-sm-10 form-control-label">Language <span class="error">*</span>:</label>
<div class="col-sm-10">
<input type="text" name="Language" value=""  class="form-control  required">

</div>
</div>

 <div class="form-group row success">
 
<label class="col-sm-10 form-control-label">Version <span class="error">*</span>:</label>
<div class="col-sm-10">
<input type="text" name="Version" value=""  class="form-control  required">

</div>
</div>

 <div class="form-group row success">
 
<label class="col-sm-10 form-control-label">Version Date <span class="error">*</span>:</label>
<div class="col-sm-10">
<input type="date" name="Date" value=""  class="form-control  required">

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