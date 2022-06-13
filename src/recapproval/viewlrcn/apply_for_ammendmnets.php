<?php

$sessionasrmApplctID=$_SESSION['asrmApplctID'];
if($_POST['doAmmendments']=='Save and Continue' and $_POST['recAffiliated_id'] and $_POST['Changes'] and $sessionasrmApplctID){

$Changes=$mysqli->real_escape_string($_POST['Changes']);
$ReasonforAmendment=$mysqli->real_escape_string($_POST['ReasonforAmendment']);
$changestostudyDistricts=$mysqli->real_escape_string($_POST['changestostudyDistricts']);
$ChangestoConsentForm=$mysqli->real_escape_string($_POST['ChangestoConsentForm']);
$ChangestodataCollectionTool=$mysqli->real_escape_string($_POST['ChangestodataCollectionTool']);
$ChangestoProtocol=$mysqli->real_escape_string($_POST['ChangestoProtocol']);

$submission_id=$mysqli->real_escape_string($_POST['submission_id']);
$protocol_id=$mysqli->real_escape_string($_POST['protocol_id']);
$recAffiliated_id=$mysqli->real_escape_string($_POST['recAffiliated_id']);

$sqlstudyPrject="SELECT * FROM ".$prefix."submission where `owner_id`='$sessionasrmApplctID' and protocol_id='$protocol_id' order by id desc limit 0,1";
$QueryPrject = $mysqli->query($sqlstudyPrject);
$totalsPrject = $QueryPrject->num_rows;
$rstudymPrject = $QueryPrject->fetch_array();
$public_title=$mysqli->real_escape_string($rstudymPrject['public_title']);
$refNo=$rstudymPrject['code'];

if($_FILES['Attachnewconsentform']['name']){
$Attachnewconsentform = preg_replace('/\s+/', '_', $_FILES['Attachnewconsentform']['name']);
$fileattachment1 = $sessionasrmApplctID.$mysqli->real_escape_string(preg_replace('/\s+/', '_', $_FILES['Attachnewconsentform']['name']));
$targetw1 = "./files/uploads/". basename($sessionasrmApplctID.preg_replace('/\s+/', '_', $_FILES['Attachnewconsentform']['name']));
$studytoolsext_main1 = move_uploaded_file(preg_replace('/\s+/', '_', $_FILES['Attachnewconsentform']['tmp_name']), $targetw1);

$sqlAAttachnewconsentform="update ".$prefix."ammendments  set `Attachnewconsentform`='$fileattachment1' where `owner_id`='$sessionasrmApplctID' and `protocol_id`='$protocol_id' and is_sent='0'";
$mysqli->query($sqlAAttachnewconsentform);
}

if($_FILES['Attachnewtool']['name']){
$Attachnewtool = preg_replace('/\s+/', '_', $_FILES['Attachnewtool']['name']);
$fileattachment2 = $sessionasrmApplctID.$mysqli->real_escape_string(preg_replace('/\s+/', '_', $_FILES['Attachnewtool']['name']));
$targetw2 = "./files/uploads/". basename($sessionasrmApplctID.preg_replace('/\s+/', '_', $_FILES['Attachnewtool']['name']));
$studytoolsext_main2 = move_uploaded_file(preg_replace('/\s+/', '_', $_FILES['Attachnewtool']['tmp_name']), $targetw2);

$sqlAAttachnewtool="update ".$prefix."ammendments  set `Attachnewtool`='$fileattachment2' where `owner_id`='$sessionasrmApplctID' and `protocol_id`='$protocol_id' and is_sent='0' and id='$id'";
$mysqli->query($sqlAAttachnewtool);
}

if($_FILES['Attachnewprotocol']['name']){
$Attachnewprotocol = preg_replace('/\s+/', '_', $_FILES['Attachnewprotocol']['name']);
$fileattachment3 = $sessionasrmApplctID.$mysqli->real_escape_string(preg_replace('/\s+/', '_', $_FILES['Attachnewprotocol']['name']));
$targetw3 = "./files/uploads/". basename($sessionasrmApplctID.preg_replace('/\s+/', '_', $_FILES['Attachnewprotocol']['name']));
$studytoolsext_main3 = move_uploaded_file(preg_replace('/\s+/', '_', $_FILES['Attachnewprotocol']['tmp_name']), $targetw3);

$sqlAAttachnewprotocol="update ".$prefix."ammendments  set `Attachnewprotocol`='$fileattachment3' where `owner_id`='$sessionasrmApplctID' and `protocol_id`='$protocol_id' and is_sent='0' and id='$id'";
$mysqli->query($sqlAAttachnewprotocol);
}


$sqlprotocalSubSelCAll="SELECT * FROM ".$prefix."ammendments order by id desc limit 0,1";
$QprotocalSub2SelCall = $mysqli->query($sqlprotocalSubSelCAll);
$rstudyCall = $QprotocalSub2SelCall->fetch_array();

$code=$rstudyCall['id']+1;
	
$sqlprotocalSubSelCAllmm="SELECT * FROM ".$prefix."ammendments where protocol_id='$protocol_id' and owner_id='$sessionasrmApplctID' and ammendType='online' and is_sent='0' order by id desc";
$QprotocalSub2SelCallmm = $mysqli->query($sqlprotocalSubSelCAllmm);
$totalstudy3 = $QprotocalSub2SelCallmm->num_rows;



if(!$totalstudy3 and $code){
$sqlA2="insert into ".$prefix."ammendments (`owner_id`,`protocol_id`,`recAffiliated_id`,`listchanges`,`fileAttachment`,`atype`,`created`,`status`,`assignedto`,`period`,`end_of_project`,`aLanguage`,`aVersion`,`aDate`,`code`,`ReasonforAmendment`,`changestostudyDistricts`,`ChangestoConsentForm`,`ChangestodataCollectionTool`,`ChangestoProtocol`,`Attachnewconsentform`,`Attachnewtool`,`Attachnewprotocol`,`paymentProof`,`is_sent`,`public_title_amendment`,`ammendType`,`protocol_title`,`refNo`) 

values('$sessionasrmApplctID','$protocol_id','$recAffiliated_id','$Changes','$fileattachment','$file_type',now(),'Pending','Not Assigned','','','$Language','$Version','$Date','$code','$ReasonforAmendment','$changestostudyDistricts','$ChangestoConsentForm','$ChangestodataCollectionTool','$ChangestoProtocol','$fileattachment1','$fileattachment2','$fileattachment3','Not Paid','0','','online','$public_title','$refNo')";
$mysqli->query($sqlA2);
$record_id = $mysqli->insert_id;

echo '<img src="images/loading_wait.gif">';
echo '<div class="spacer"></div>';
if($record_id){
echo '<meta http-equiv="REFRESH" content="0;url='.$base_url.'/main.php?option=ApplyAmmendments&id='.$record_id.'">';
}
}

if($totalstudy3){
$sqlA22="update ".$prefix."ammendments  set `listchanges`='$Changes',`ReasonforAmendment`='$ReasonforAmendment',`changestostudyDistricts`='$changestostudyDistricts',`ChangestoConsentForm`='$ChangestoConsentForm',`ChangestodataCollectionTool`='$ChangestodataCollectionTool',`ChangestoProtocol`='$ChangestoProtocol' where `owner_id`='$sessionasrmApplctID' and `protocol_id`='$protocol_id' and id='$id'";
$mysqli->query($sqlA22);
$message='<div class="success">Changes have saved</div>';

echo '<img src="images/loading_wait.gif">';
echo '<div class="spacer"></div>';
echo '<meta http-equiv="REFRESH" content="0;url='.$base_url.'/main.php?option=ApplyAmmendmentsSec&id='.$id.'">';
}


	
}


$sqlstudymAmmendment="SELECT * FROM ".$prefix."ammendments where `owner_id`='$asrmApplctID' and is_sent='0' and id='$id' order by id desc limit 0,1";
$QuerystudymAmmendment = $mysqli->query($sqlstudymAmmendment);
$totalstudyAmmendment = $QuerystudymAmmendment->num_rows;
$rstudymAmmendment = $QuerystudymAmmendment->fetch_array();

$sqlprotocalAttachments="SELECT * FROM ".$prefix."ammendments_documents where owner_id='$sessionasrmApplctID' and is_sent='0' and amendment_id='$id' order by id desc";
$QprotocalAttachments = $mysqli->query($sqlprotocalAttachments);
$totalstudyAttachments = $QprotocalAttachments->num_rows;
$rsAtatchments = $QprotocalAttachments->fetch_array();

////Attached Payment
$sqlPayment="SELECT * FROM ".$prefix."ammendments_documents where `owner_id`='$asrmApplctID' and atype='Payment' and is_sent='0' and amendment_id='$id' order by id desc limit 0,1";
$QueryPayment = $mysqli->query($sqlPayment);
$totalPayment = $QueryPayment->num_rows;

?><ul id="countrytabs" class="shadetabs">
<?php if($totalstudyAmmendment>=1){?><li><a href="./main.php?option=ApplyAmmendments&id=<?php echo $id;?>" style="background:green; color:#FFF;">Amendment Information</a></li><?php }?>
<?php if(!$totalstudyAmmendment){?><li class="extra" <?php if($totalstudy){?> style="background:green; color:#FFF;" <?php }?>>Amendment Information</li><?php }?>


<?php if($totalstudyAmmendment>=1){?><li><a href="./main.php?option=ApplyAmmendmentsSec&id=<?php echo $id;?>" <?php if($totalstudyAttachments>=1 and $rsAtatchments['fileAttachment']){?> style="background:green; color:#FFF;" <?php }?>>Attachments</a></li><?php }?>

<?php if(!$totalstudyAmmendment){?><li class="extra" <?php if(!$totalstudyAttachments){?> style="background:green; color:#FFF;" <?php }?>>Attachments</li><?php }?>



<?php if($totalstudyAmmendment>=1){?><li><a href="./main.php?option=ApplyAmmendmentsPay&id=<?php echo $id;?>" <?php if($totalPayment){?> style="background:green; color:#FFF;" <?php }?>>Payment</a></li><?php }?>

<?php if(!$totalstudyAmmendment){?><li class="extra" <?php if(!$totalPayment){?> style="background:green; color:#FFF;" <?php }?>>Payment</li><?php }?>
</ul>

<div id="countrydivcontainer" style="border:0px solid gray; width:100%; margin-bottom: 1em; padding: 10px">
<?php

$sqlstudym="SELECT * FROM ".$prefix."submission where `owner_id`='$sessionasrmApplctID' order by id desc limit 0,1";
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
if(isset($message)){echo $message;}
?>
   
   <div style="clear:both;"></div>
    <button id="myBtn">Click to add New Attachment </button> 
    
    

                      
<?php 
$wmRenewals="select *,DATE_FORMAT(`created`,'%Y-%m-%d') AS created from ".$prefix."ammendments  where `owner_id`='$asrmApplctID' and is_sent='0' and id='$id' order by id desc limit 0,1";
$cmdwbRenewals = $mysqli->query($wmRenewals);
$rRenewals= $cmdwbRenewals->fetch_array();
//////////////Get Totals

/////////////////Check totals
/*echo $totalsPayment.'| Proof of Payment<br>';
echo $totalsCoverLetter.'| Cover Letter<br>';
echo $totalsCleanCopy.'| Clean Copy<br>';
echo $totalsTrackedChanges.'| Tracked Changes<br>';*/
?>



<form action="" method="post" name="regForm" id="regForm" enctype="multipart/form-data">

<div class="form-group row success">
 <label class="col-sm-12 form-control-label">Choose REC: <br /></label>

<select name="recAffiliated_id" id="recAffiliated_id" class="form-control  required" required>
<option value="">Please Select</option>
<?php
$sqlClinicalcv2 = "select * FROM ".$prefix."list_rec_affiliated where published='Yes' order by name asc";//and conceptm_status='new' 
$resultClinicalcv2 = $mysqli->query($sqlClinicalcv2);
while($rClinicalcv2=$resultClinicalcv2->fetch_array()){
?>
<option value="<?php echo $rClinicalcv2['id'];?>" <?php if($rClinicalcv2['id']==$rRenewals['recAffiliated_id']){?>selected="selected"<?php }?>><?php echo $rClinicalcv2['name'];?></option>
<?php }?>
</select>

                  
                        </div>
                        <div class="line"></div> 
      
      
      
      <div class="form-group row success">
 <label class="col-sm-12 form-control-label">Choose Project: <br /></label>
<?php $owner_id=$_SESSION['asrmApplctID'];?>
<select name="protocol_id" id="protocol_id" class="form-control  required" required>
<option value="">Please Select</option>
<?php
$sqlProject = "select * FROM ".$prefix."submission where owner_id='$owner_id' order by public_title asc";//and conceptm_status='new' 
$resultProject = $mysqli->query($sqlProject);
while($rProject=$resultProject->fetch_array()){
?>
<option value="<?php echo $rProject['id'];?>" <?php if($rProject['id']==$rRenewals['protocol_id']){?>selected="selected"<?php }?>><?php echo $rProject['public_title'];?></option>
<?php }?>
</select>

                  
                        </div>
                        <div class="line"></div> 
                                          
                   
                   <div class="form-group row success">
 <label class="col-sm-12 form-control-label">Changes to Consent Form:  Are changes required?: <br />

<input name="ChangestoConsentForm" type="radio" value="No" onChange="getChangestoConsentForm(this.value)" <?php if($rRenewals['ChangestoConsentForm']=='No'){?>checked="checked"<?php }?>/>

No<br /><input name="ChangestoConsentForm" type="radio" value="Yes" onChange="getChangestoConsentForm(this.value)" <?php if($rRenewals['ChangestoConsentForm']=='Yes'){?>checked="checked"<?php }?>/> Yes</label>
                    <div id="changestoconsentform">
                    
                <?php if($today<=$rRenewals['created']){?>
<a href="./cfxdownload.php?ammb=<?php echo $rRenewals['id'];?>" target="_blank" style="color:#06F;">View File</a>
<?php }else{?>
<a href="./cfxdownload.php?ammb=<?php echo $rRenewals['id'];?>" target="_blank" style="color:#06F;">View File</a>
<?php }?><br />     
                    
                    
                    </div>      

                  
                        </div>
                        <div class="line"></div> 
                   
                   
                   
                   
                     <div class="form-group row success">
                          <label class="col-sm-12 form-control-label">Changes to data collection tool: Are changes required?: <br /><input name="ChangestodataCollectionTool" type="radio" value="No" onChange="getChangestodataCollectionTool(this.value)" <?php if($rRenewals['ChangestodataCollectionTool']=='No'){?>checked="checked"<?php }?>/> No<br />
                          <input name="ChangestodataCollectionTool" type="radio" value="Yes" onChange="getChangestodataCollectionTool(this.value)" <?php if($rRenewals['ChangestodataCollectionTool']=='Yes'){?>checked="checked"<?php }?>/> Yes</label>
                          
<div id="changestodatacollectiontool">


<?php if($today<=$rRenewals['created']){?>
<a href="./cfxdownload.php?amma=<?php echo $rRenewals['id'];?>" target="_blank" style="color:#06F;">View File</a>
<?php }else{?>
<a href="./cfxdownload.php?amma=<?php echo $rRenewals['id'];?>" target="_blank" style="color:#06F;">View File</a>
<?php }?><br />  

</div> 
                  
                        </div>
                        <div class="line"></div> 
                   
                   
                   
                   <div class="form-group row success">
                          <label class="col-sm-12 form-control-label">Changes to protocol: Are changes required?: <br /><input name="ChangestoProtocol" type="radio" value="No"  onChange="getChangestoProtocol(this.value)"  <?php if($rRenewals['ChangestoProtocol']=='No'){?>checked="checked"<?php }?>/> No<br />
       <input name="ChangestoProtocol" type="radio" value="Yes" onChange="getChangestoProtocol(this.value)" <?php if($rRenewals['ChangestoProtocol']=='Yes'){?>checked="checked"<?php }?>/> Yes</label>
                          
<div id="changestoprotocol">

<?php if($today<=$rRenewals['created']){?>
<a href="./cfxdownload.php?ammc=<?php echo $rRenewals['id'];?>" target="_blank" style="color:#06F;">View File</a>
<?php }else{?>
<a href="./cfxdownload.php?ammc=<?php echo $rRenewals['id'];?>" target="_blank" style="color:#06F;">View File</a>
<?php }?><br /> 


</div> 
                  
                        </div>
                        <div class="line"></div>
                   
                   
                   
                   
                   
                   
                   
                   
                      <div class="form-group row success">
                          <label class="col-sm-12 form-control-label">Are they changes to study districts? Please highlight districts  :</label>
                          <textarea name="changestostudyDistricts" id="changestostudyDistricts" cols="" rows="5" class="form-control" required><?php echo $rRenewals['changestostudyDistricts'];?></textarea>

                  
                        </div>
                        <div class="line"></div> 
                   
                   
                   
                        <div class="form-group row success">
                          <label class="col-sm-12 form-control-label">Description of proposed changes:</label>
                          <textarea name="Changes" id="Changes" cols="" rows="5" class="form-control" required><?php echo $rRenewals['listchanges'];?></textarea>


  
                           <input name="project_id" type="hidden" value="<?php echo $id;?>"/>
                            <input type="hidden" name="asrmApplctID" value="<?php echo $_SESSION['asrmApplctID'];?>">
                            
                  
                        </div>
                        <div class="line"></div>
                        
                    
                        
                         <div class="form-group row success">
                          <label class="col-sm-12 form-control-label">Reason for Amendment/Modification:</label>
                          <textarea name="ReasonforAmendment" id="ReasonforAmendment" cols="" rows="5" class="form-control" required><?php echo $rRenewals['ReasonforAmendment'];?></textarea>

                  
                        </div>
                        <div class="line"></div>
                        
 
   
                   
                        
                        <div class="form-group row">
                          <div class="col-sm-12 offset-sm-3">
                    <input name="doAmmendments" type="submit"  class="btn btn-primary" value="Save and Continue"/>

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