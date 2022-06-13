<?php
$wmSubmissions="select * from ".$prefix."submission where  `id`='$id'";
$cmdwbSubmissions = $mysqli->query($wmSubmissions);
$rSubmissions= $cmdwbSubmissions->fetch_array();

$sessionasrmApplctID=$_SESSION['asrmApplctID'];
if($_POST['doFilesUpload']=='Save' and  $_POST['project_id'] and $id){

	$file_type=$mysqli->real_escape_string($_POST['file_type']);
	$submission_id=$mysqli->real_escape_string($_POST['submission_id']);
	$project_id=$mysqli->real_escape_string($_POST['project_id']);
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
	
$wmRenewals3="select * from ".$prefix."submission where  id='$project_id'";
$cmdwbRenewals3 = $mysqli->query($wmRenewals3);
$rRenewals3= $cmdwbRenewals3->fetch_array();
	
	$recAffiliated_id=$mysqli->real_escape_string($rRenewals3['recAffiliated_id']);


if($file_type=='Payment'){
$Payment = preg_replace('/\s+/', '_', $_FILES['attachethicalapproval']['name']);
$fileattachment = $sessionasrmApplctID.$mysqli->real_escape_string(preg_replace('/\s+/', '_', $_FILES['attachethicalapproval']['name']));
$targetw3 = "./files/uploads/". basename($sessionasrmApplctID.preg_replace('/\s+/', '_', $_FILES['attachethicalapproval']['name']));
$studytoolsext_main3 = move_uploaded_file(preg_replace('/\s+/', '_', $_FILES['attachethicalapproval']['tmp_name']), $targetw3);



$sqlprotocalAttachments="SELECT * FROM ".$prefix."ammendments_documents where atype='$file_type' and amendment_id='$id' and owner_id='$sessionasrmApplctID' and is_sent='0' and fileAttachment='$fileattachment' order by id desc";
$QprotocalAttachments = $mysqli->query($sqlprotocalAttachments);
$totalstudyAttachments = $QprotocalAttachments->num_rows;

if(!$totalstudyAttachments){

$sqlA2="insert into ".$prefix."ammendments_documents (`owner_id`,`protocol_id`,`recAffiliated_id`,`listchanges`,`fileAttachment`,`atype`,`created`,`status`,`assignedto`,`period`,`end_of_project`,`aLanguage`,`aVersion`,`aDate`,`code`,`ReasonforAmendment`,`changestostudyDistricts`,`ChangestoConsentForm`,`ChangestodataCollectionTool`,`ChangestoProtocol`,`Attachnewconsentform`,`Attachnewtool`,`Attachnewprotocol`,`paymentProof`,`is_sent`,`ammendType`,`protocol_title`,`refNo`,`amendment_id`) 

values('$sessionasrmApplctID','$id','$recAffiliated_id','','$fileattachment','$file_type',now(),'Pending','Not Assigned','','','$Language','$Version','$Date','$code','$ReasonforAmendment','','','','','','','','Not Paid','0','online','','','$id')";
$mysqli->query($sqlA2);
}
if($totalstudyAttachments){

$sqlA2="update ".$prefix."ammendments_documents  set `fileAttachment`='$fileattachment',`aLanguage`='$Language',`aVersion`='$Version',`aDate`='$Date' where `owner_id`='$sessionasrmApplctID' and amendment_id='$id' and atype='$file_type' and is_sent='0'";
$mysqli->query($sqlA2);
}




}
	


$message='<p class="success">Dear '.$session_fullname.', details have been submitted.</p>';
logaction("$session_fullname added Ammendments");



}//end post



$sqlstudymAmmendment="SELECT * FROM ".$prefix."ammendments where `owner_id`='$asrmApplctID' and id='$id' and is_sent='0' order by id desc limit 0,1";
$QuerystudymAmmendment = $mysqli->query($sqlstudymAmmendment);
$totalstudyAmmendment = $QuerystudymAmmendment->num_rows;
$rstudymAmmendment = $QuerystudymAmmendment->fetch_array();
///Attachments

$sqlprotocalAttachments="SELECT * FROM ".$prefix."ammendments_documents where owner_id='$sessionasrmApplctID' and amendment_id='$id' and is_sent='0' order by id desc";
$QprotocalAttachments = $mysqli->query($sqlprotocalAttachments);
$totalstudyAttachments = $QprotocalAttachments->num_rows;

////Attached Payment
$sqlPayment="SELECT * FROM ".$prefix."ammendments_documents where `owner_id`='$asrmApplctID' and amendment_id='$id' and atype='Payment' and is_sent='0' order by id desc limit 0,1";
$QueryPayment = $mysqli->query($sqlPayment);
$totalPayment = $QueryPayment->num_rows;
?>


<?php

if($_POST['doSubmitAmendment']=='Click to Finish and Submit Amendments' and $_POST['project_id'] and $id){
	
$protocol_id=$mysqli->real_escape_string($_POST['project_id']);
$recAffiliated_idmm=$mysqli->real_escape_string($_POST['recAffiliated_id']);

////Get Protocol ID
$sqlMyrecnamew="SELECT * FROM ".$prefix."list_rec_affiliated where id='$recAffiliated_idmm'";
$sqlFMyreccnaw=$mysqli->query($sqlMyrecnamew);
$recNamew=$sqlFMyreccnaw->fetch_array();

$contacts=$recNamew['contacts'];
$recOriginalNamem=$recNamew['name'];
$recemail=$recNamew['recemail'];
//PI Name
$sqlMyUser="SELECT * FROM ".$prefix."user where asrmApplctID='$sessionasrmApplctID'";
$sqlFUser=$mysqli->query($sqlMyUser);
$recUser=$sqlFUser->fetch_array();
$name=$recUser['name'];
$email=$recUser['email'];

$sqlprotocalSubSelCAll2="SELECT * FROM ".$prefix."ammendments where id='$id' and owner_id='$sessionasrmApplctID'  and is_sent!='1' order by id desc";
$QprotocalSub2SelCall2 = $mysqli->query($sqlprotocalSubSelCAll2);
$rstudyCall2 = $QprotocalSub2SelCall2->fetch_array();
$code2=$rstudyCall2['code'];
$protocol_title=$rstudyCall2['protocol_title'];
//$recAffiliated_idmm=$rstudyCall2['recAffiliated_id'];

	//FInish submission
	
$sqlA2Protocol12="update ".$prefix."ammendments_documents  set `is_sent`='1' where `owner_id`='$sessionasrmApplctID' and is_sent='0' and amendment_id='$id'";
$mysqli->query($sqlA2Protocol12);

$sqlA2Protocol1="update ".$prefix."ammendments  set `status`='Submitted',`is_sent`='1',`CompletenessCheck`='Pending' where `owner_id`='$sessionasrmApplctID' and is_sent='0' and id='$id'";
$mysqli->query($sqlA2Protocol1);


require("viewlrcn/class.phpmailer.php");
require("viewlrcn/class.smtp.php"); 


///Now Send mail
require_once("viewlrcn/mail_template_make_final_submission_ammendments.php");

$mail = new PHPMailer(true); //important
$mail->IsSMTP(); // set mailer to use SMTP
$mail->Port = "587"; // SMTP Port
$mail->CharSet =  "utf-8";
$mail->Host = "$usmtpHost"; // specify SMTP server//nemesis.eahd.or.ug mailhost02.cfi.co.ug
$mail->SMTPAuth = true; // turn on SMTP authentication
$mail->SMTPSecure = 'tls';
$mail->SMTPDebug = 0;


$mail->Username = "uncstuncstapps@gmail.com"; // SMTP username -- CHANGE --
$mail->Password = "lpupvbvillxraaey"; // SMTP password -- CHANGE --
$mail->setFrom("uncstuncstapps@gmail.com", "Admin");
/////////////////////////////Begin Mail Body
$mail->addCc($recemail,$recOriginalNamem);//
//$mail->addBcc('uncstuncstapps@gmail.com',$recOriginalNamem);//

$mail->FromName = "$recOriginalNamem"; //From Name -- CHANGE --
$mail->AddAddress($email, $name); //To Address -- CHANGE --$email
//if($dbEmail2){echo $mail->addCc($dbEmail2,'Activation Link from UNCST');}
$mail->AddReplyTo($email, $name); //Reply-To Address -- CHANGE --$usrm_email

$mail->WordWrap = 50; // set word wrap to 50 characters
$mail->IsHTML(false); // set email format to HTML
$mail->Subject = "Amendments Confirmation - $protocol_title";
$body="$allSentMessage
";
$mail->MsgHTML($body);

if(!$mail->Send()){
	echo "Mailer Error: " . $mail->ErrorInfo;
}///end



$message="<p class='success'>Dear $name !<br><br>
Thank you for your renewal for protocol titled, '<b>$protocol_title</b>' Your Amendmnets have been submitted on <b>$today</b>.<br /><br />

Best Regards<br>
$contacts<br><br></p>";

echo '<img src="images/loading_wait.gif">';
echo '<div class="spacer"></div>';
echo '<meta http-equiv="REFRESH" content="2;url='.$base_url.'/main.php?option=MyAmmendments">';
	
}

?>

<ul id="countrytabs" class="shadetabs">

<?php if($totalstudyAmmendment>=1){?><li><a href="./main.php?option=ApplyAmmendments&id=<?php echo $id;?>" style="background:green; color:#FFF;">Amendment Information</a></li><?php }?>
<?php if(!$totalstudyAmmendment){?><li class="extra" <?php if($totalstudy){?> style="background:green; color:#FFF;" <?php }?>>Amendment Information</li><?php }?>


<?php if($totalstudyAmmendment>=1){?><li><a href="./main.php?option=ApplyAmmendmentsSec&id=<?php echo $id;?>" <?php if($totalstudyAttachments>=1){?> style="background:green; color:#FFF;" <?php }?>>Attachments</a></li><?php }?>

<?php if(!$totalstudyAmmendment){?><li class="extra" <?php if(!$totalstudyAttachments){?> style="background:green; color:#FFF;" <?php }?>>Attachments</li><?php }?>



<?php if($totalstudyAmmendment>=1){?><li><a href="./main.php?option=ApplyAmmendmentsPay&id=<?php echo $id;?>" <?php if($totalPayment){?> style="background:green; color:#FFF;" <?php }?>>Payment</a></li><?php }?>

<?php if(!$totalstudyAmmendment){?><li class="extra" <?php if(!$totalPayment){?> style="background:green; color:#FFF;" <?php }?>>Payment</li><?php }?>


</ul>

<div id="countrydivcontainer" style="border:0px solid gray; width:100%; margin-bottom: 1em; padding: 10px">
<?php

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


$sqlstudy="SELECT *,DATE_FORMAT(`created`,'%Y-%m-%d') AS created FROM ".$prefix."ammendments_documents where `owner_id`='$sessionasrmApplctID' and amendment_id='$id' and atype='Payment' and is_sent='0' order by id desc";//and is_sent!='1' 
$Querystudy = $mysqli->query($sqlstudy);
$totalstudy = $Querystudy->num_rows;

if(isset($message)){echo $message;}
?>
   
   <div style="clear:both;"></div>
    <button id="myBtn">Click to add Payment Attachment </button> 
    
    
    
     <table class="table table-striped table-sm" id="customers">
                  <thead>
                          <tr>
                          <th>Protocol</th>
                            <th>Type</th>
                          </tr>
                        </thead>
                        <tbody>
            <?php while($rstudy = $Querystudy->fetch_array()){

				
				?>
                          <tr>
                          <td><?php echo $rstudymAmmendment['protocol_title'];?></td>
                          
                            <td><?php if($today<=$rstudy['created']){?>
<a href="./cfxdownload.php?amm=<?php echo $rstudy['id'];?>" target="_blank" style="color:#06F;"><?php if($rstudy['atype']=='otherattachment'){echo $rstudy['otherattachment'];}  if($rstudy['atype']!='otherattachment'){echo $rstudy['atype'];}?></a>
<?php }else{?>
<a href="./cfxdownload.php?amm=<?php echo $rstudy['id'];?>" target="_blank" style="color:#06F;"><?php if($rstudy['atype']=='otherattachment'){echo $rstudy['otherattachment'];}  if($rstudy['atype']!='otherattachment'){echo $rstudy['atype'];}?></a>
<?php }?><br />  </td>
                            </tr>
               
               <?php }?>
                        </tbody>
                      </table> 
                      
<?php 
$wmRenewals="select * from ".$prefix."ammendments where  `owner_id`='$sessionasrmApplctID' and is_sent!='1' and id='$id' order by id desc limit 0,1";
$cmdwbRenewals = $mysqli->query($wmRenewals);
$rRenewals= $cmdwbRenewals->fetch_array();
//////////////Get Totals
$wmTrackedChanges="select * from ".$prefix."ammendments_documents where  `owner_id`='$sessionasrmApplctID' and atype='TrachedChanges'  and is_sent!='1' and amendment_id='$id' order by id desc limit 0,1";
$cmdwbTrackedChanges = $mysqli->query($wmTrackedChanges);
$totalsTrackedChanges = $cmdwbTrackedChanges->num_rows;

$wmCleanCopy="select * from ".$prefix."ammendments_documents where  `owner_id`='$sessionasrmApplctID' and atype='CleanCopy'  and is_sent!='1' and amendment_id='$id' order by id desc limit 0,1";
$cmdwbCleanCopy = $mysqli->query($wmCleanCopy);
$totalsCleanCopy = $cmdwbCleanCopy->num_rows;

$wmCoverLetter="select * from ".$prefix."ammendments_documents where  `owner_id`='$sessionasrmApplctID' and status='Pending' and atype='CoverLetter'  and is_sent!='1' and amendment_id='$id' order by id desc limit 0,1";
$cmdwbCoverLetter = $mysqli->query($wmCoverLetter);
$totalsCoverLetter = $cmdwbCleanCopy->num_rows;
$rRenewalsProtcoo= $cmdwbCoverLetter->fetch_array();

$wmPayment="select *,DATE_FORMAT(`created`,'%d/%m/%Y') AS created from ".$prefix."ammendments_documents where  `owner_id`='$sessionasrmApplctID' and atype='Payment'  and is_sent!='1' and amendment_id='$id' order by id desc limit 0,1";
$cmdwbPayment = $mysqli->query($wmPayment);
$totalsPayment = $cmdwbPayment->num_rows;

/////////////////Check totals
/*echo $totalsPayment.'| Proof of Payment<br>';
echo $totalsCoverLetter.'| Cover Letter<br>';
echo $totalsCleanCopy.'| Clean Copy<br>';
echo $totalsTrackedChanges.'| Tracked Changes<br>';*/
?>


<div style="color:#F00; margin-top:10px;">
<?php if($totalstudy<=0){ //$totalsPayment<=0 || $totalsCoverLetter<=0 || ?>
Please attach:<br /><?php }?>
<?php if($totalstudy<=0){?>Payment Receipt<br /><?php }else{?>
<form action="" method="post" name="regForm" id="regForm" autocomplte="false">
 <input name="project_id" type="hidden" value="<?php echo $id;?>"/>
 <input name="recAffiliated_id" type="hidden" value="<?php echo $rRenewals['recAffiliated_id'];?>"/>
 <input name="protocol_title" type="hidden" value="<?php echo $rSubmissions['public_title'];?>"/>
  <input name="code" type="hidden" value="<?php echo $rRenewals['code'];?>"/>
<input name="doSubmitAmendment" type="submit"  class="btn btn-primary" value="Click to Finish and Submit Amendments"/>
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
  <input name="project_id" type="hidden" value="<?php echo $id;?>"/>
 <input name="recAffiliated_id" type="hidden" value="<?php echo $rRenewals['recAffiliated_id'];?>"/>
 <input name="code" type="hidden" value="<?php echo $rRenewals['code'];?>"/>
 
<label class="col-sm-10 form-control-label">File Type: <span class="error">*</span></label>
<div class="col-sm-10">
<select name="file_type" id="upload_type_id" class="form-control  required" required>
<option value="">Select file type</option>
<option value="Payment">Payment Receipt</option>
</select>
</div>
</div> 



 <div class="form-group row success">
 
<label class="col-sm-10 form-control-label">File  (PDF) <span class="error">*</span>:</label>
<div class="col-sm-10">
<input name="attachethicalapproval" type="file" id="attachethicalapproval" class="required" required/>

<input type="hidden" name="asrmApplctID" value="<?php echo $_SESSION['asrmApplctID'];?>">

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