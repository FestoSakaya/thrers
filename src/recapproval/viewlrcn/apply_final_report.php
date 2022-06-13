<ul id="countrytabs" class="shadetabs">
<li><a href="#" rel="#default" class="selected">Apply for Close Out Report</a></li>
</ul>

<div id="countrydivcontainer" style="border:0px solid gray; width:100%; margin-bottom: 1em; padding: 10px">
<?php
$sessionasrmApplctID=$_SESSION['asrmApplctID'];


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

if($_POST['doFilesUpload']=='Save' and $_POST['project_id']){

$Changes=$mysqli->real_escape_string($_POST['Changes']);
$submission_id=$mysqli->real_escape_string($_POST['submission_id']);
	$protocol_id=$mysqli->real_escape_string($_POST['project_id']);

$wmRenewals="select * from ".$prefix."submission where  id='$protocol_id'";
$cmdwbRenewals = $mysqli->query($wmRenewals);
$rRenewals= $cmdwbRenewals->fetch_array();

$recAffiliated_id=$mysqli->real_escape_string($rRenewals['recAffiliated_id']);

$CoverLetter = preg_replace('/\s+/', '_', $_FILES['attachethicalapproval']['name']);
$fileattachment = $sessionasrmApplctID.$mysqli->real_escape_string(preg_replace('/\s+/', '_', $_FILES['attachethicalapproval']['name']));
$targetw3 = "files/uploads/". basename($sessionasrmApplctID.preg_replace('/\s+/', '_', $_FILES['attachethicalapproval']['name']));
$studytoolsext_main3 = move_uploaded_file(preg_replace('/\s+/', '_', $_FILES['attachethicalapproval']['tmp_name']), $targetw3);
	
$sqlprotocalSubSel3="SELECT * FROM ".$prefix."final_reports where protocol_id='$protocol_id' and owner_id='$sessionasrmApplctID' and status='Pending' and fileAttachment='$fileattachment'";
$QprotocalSub2Sel3 = $mysqli->query($sqlprotocalSubSel3);
$totalstudy3 = $QprotocalSub2Sel3->num_rows;

if(!$totalstudy3){
$sqlA22="insert into ".$prefix."final_reports (`owner_id`,`protocol_id`,`recAffiliated_id`,`fileAttachment`,`created`,`status`) 

values('$sessionasrmApplctID','$protocol_id','$recAffiliated_id','$fileattachment',now(),'Pending')";
$mysqli->query($sqlA22);
$message='<div class="success">Changes have saved</div>';
}

if($totalstudy3){	
$sqlA2="update ".$prefix."final_reports set `fileAttachment`='$fileattachment' where owner_id='$sessionasrmApplctID' and protocol_id='$project_id' and status='Pending' and fileAttachment='$fileattachment'";
$mysqli->query($sqlA2);
$message='<div class="success">Close Out Report has been saved</div>';
}
	
}

if($category=='FinalReportnotifications'){
	
$sqlstudyReport="SELECT * FROM ".$prefix."final_reports where `status`='Pending'  order by id desc limit 0,1";
$QuerystudyReport = $mysqli->query($sqlstudyReport);
$rstudyReport = $QuerystudyReport->fetch_array();
$id=$rstudyReport['protocol_id'];
		////Get Protocol ID
$sqlstudy="SELECT * FROM ".$prefix."submission where `protocol_id`='$id'  order by id desc limit 0,1";
$Querystudy = $mysqli->query($sqlstudy);
$rstudy = $Querystudy->fetch_array();

$public_title=$rstudy['public_title'];
$recAffiliated_idmm=$rstudy['recAffiliated_id'];

$sqlMyrecnamew="SELECT * FROM ".$prefix."list_rec_affiliated where id='$recAffiliated_idmm'";
$sqlFMyreccnaw=$mysqli->query($sqlMyrecnamew);
$recNamew=$sqlFMyreccnaw->fetch_array();

$contacts=$recNamew['contacts'];
$recOriginalNamem=$recNamew['name'];
//PI Name
$sqlMyUser="SELECT * FROM ".$prefix."user where asrmApplctID='$asrmApplctID'";
$sqlFUser=$mysqli->query($sqlMyUser);
$recUser=$sqlFUser->fetch_array();
$name=$recUser['name'];
$email=$recUser['email'];
	
	
	//FInish submission
$sqlA2Protocol1="update ".$prefix."final_reports  set `status`='Submitted' where `owner_id`='$sessionasrmApplctID' and status='Pending'";
$mysqli->query($sqlA2Protocol1);

///////////////////////////send mail notification
require("viewlrcn/class.phpmailer.php");
require("viewlrcn/class.smtp.php"); 


///Now Send mail
require_once("viewlrcn/mail_template_make_final_submission_closeout_report.php");

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
$mail->addCc('mutumba.beth@yahoo.com',$recOriginalNamem);//
$mail->addBcc('uncstuncstapps@gmail.com',$recOriginalNamem);//

$mail->FromName = "$recOriginalNamem"; //From Name -- CHANGE --
$mail->AddAddress($email, $name); //To Address -- CHANGE --$email
//if($dbEmail2){echo $mail->addCc($dbEmail2,'Activation Link from UNCST');}
$mail->AddReplyTo($email, $name); //Reply-To Address -- CHANGE --$usrm_email

$mail->WordWrap = 50; // set word wrap to 50 characters
$mail->IsHTML(false); // set email format to HTML
$mail->Subject = "Closeout Report Confirmation - $public_title";
$body="$allSentMessage
";
$mail->MsgHTML($body);

if(!$mail->Send()){
	echo "Mailer Error: " . $mail->ErrorInfo;
}///end



$message="<p class='success'>Dear $name !<br><br>
Thank you for your renewal for protocol titled, '<b>$public_title</b>'. Your renewal has been submitted on <b>$today</b>.<br /><br />

Best Regards<br>
$contacts<br><br></p>";


echo '<img src="images/loading_wait.gif">';
echo '<div class="spacer"></div>';
echo '<meta http-equiv="REFRESH" content="0;url='.$base_url.'/main.php?option=MyFinalReport&id='.$id.'">';


}

$sqlstudy="SELECT * FROM ".$prefix."final_reports where `owner_id`='$sessionasrmApplctID' and status='Pending' order by id desc limit 0,100";
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
                            <th>Attachment</th>
                     

                          </tr>
                        </thead>
                        <tbody>
            <?php while($rstudy = $Querystudy->fetch_array()){
		$idm=$rstudy['protocol_id'];		
$sqlstudym="SELECT * FROM ".$prefix."submission where `owner_id`='$sessionasrmApplctID' and id='$idm' order by id desc limit 0,1";
$Querystudym = $mysqli->query($sqlstudym);
$rstudym = $Querystudym->fetch_array();
$owner_id=$rstudym['owner_id'];	
				
				?>
                          <tr>
                          <td><?php echo $rstudym['public_title'];?></td>
                          
                            <td><a href="./files/uploads/<?php echo $rstudy['fileAttachment'];?>" target="_blank" style="color:#06F;">Click to view</a></td>
                     
                            </tr>
               <?php }?>
               
                        </tbody>
                      </table> 
    
    <!-- The Modal -->
<div id="myModal" class="modal" style="margin-top:80px;">

  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
      <span class="close">&times;</span>
      <h3><strong>New Attachment</strong></h3>
    </div>
    <div class="modal-body" style="height:320px; overflow:scroll;">


 <form action="" method="post" name="regForm" id="regForm" enctype="multipart/form-data">
<div class="form-group row success">
<label class="col-sm-10 form-control-label">Select Protocol you are submitting to: <span class="error">*</span></label>
<div class="col-sm-10">
<?php
$sqlSubmission = "select * FROM ".$prefix."submission where owner_id='$asrmApplctID' and status='Approved' and DaysToExpiry>=60 order by id desc"; 
$QuerySubmission = $mysqli->query($sqlSubmission);
 $totalSubmission = $QuerySubmission->num_rows;
 if( $totalSubmission){
?>
<select name="project_id" id="project_id" class="form-control  required">

<option value="">Please Select Protocol</option>
<?php

while($resultSubmission=$QuerySubmission->fetch_array()){
?>
<option value="<?php echo $resultSubmission['id'];?>" <?php if($resultSubmission['id']==$rstudypp['protocol_id']){?>selected="selected"<?php }?>><?php echo $resultSubmission['public_title'];?></option>

<?php }?>

</select>
<?php }else{?><div class="error2">You dont have any project nearing end</div><?php }?>
</div>
</div>

 <div class="form-group row success">
 
<label class="col-sm-8 form-control-label">File  (PDF) <span class="error">*</span>:</label>
<div class="col-sm-8">
<input name="attachethicalapproval" type="file" id="attachethicalapproval" class="required" required/>

  <?php $wmRenewals="select * from ".$prefix."submission where  id='$id'";
$cmdwbRenewals = $mysqli->query($wmRenewals);
$rRenewals= $cmdwbRenewals->fetch_array();?>
<input name="recAffiliated_id" type="hidden" value="<?php echo $rRenewals['recAffiliated_id'];?>"/> 
<input name="protocol_id" type="hidden" value="<?php echo $id;?>"/>
<input type="hidden" name="asrmApplctID" value="<?php echo $_SESSION['asrmApplctID'];?>">

</div>
</div>
                        
                       
       
       <div class="form-group row">
                          <div class="col-sm-4 offset-sm-3">
<?php  if($totalSubmission){?><input name="doFilesUpload" type="submit"  class="btn btn-primary" value="Save"/><?php }?>




                          </div>
                        </div>
                                          
     </form>                   
    </div>
    </div>
    </div><!--End-->

<form action="" method="post" name="regForm" id="regForm" >
           
 
   
                   
                        
                        <div class="form-group row">
                          <div class="col-sm-4 offset-sm-3">
                    <input name="donotifications" type="submit"  class="btn btn-primary" value="Save"/>
<input name="protocol_id" type="hidden" value="<?php echo $id;?>"/>
<input type="hidden" name="asrmApplctID" value="<?php echo $_SESSION['asrmApplctID'];?>">

<?php if($totalstudy){?>					
					<input name="doSaveFinish" type="button"  class="btn-secondary" value="Make Final Submission" style="float:right; margin-top:5px; "  onClick="window.location.href='<?php echo $base_url;?>recapprova./main.php?option=FinalReportnotifications&id=<?php echo $id;?>'"/>
					
					<?php }?>
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