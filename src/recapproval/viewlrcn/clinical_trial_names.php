<?php if($session_privillage=='administrator'){?><button id="myBtn">Add a REC</button>
<table width="100%" border="0" style="margin-top:15px;">
  <tr>
    <td width="59%">Find Admins:<br />
    <input type="text" class="form-control"></td>
    <td width="4%">&nbsp;</td>
    <td width="22%">
Status:<br />
<select class="form-control btn-default btn" id="select-filter-status" name="status" data-live-search="true" tabindex="-98">
                                <option value="" selected="">All</option>
                                <option value="S">Active</option>
                                <option value="R">Suspended</option>
          </select>
                                
   </td>
   <td width="9%"> <br /><!--<input name="" type="button" class="btn-warning btn" value="Export to CSV"/>-->
   
   <div class="number allprotocols">        
<a href="exportallrecs.php?action=?status=<?php echo $status;?>&category=<?php echo $category;?>">EXPORT RESULTS</a>

</div>
   
   
   </td>
   <td width="6%"><br /><input type="submit" name="button" id="button" class="search btn" value="Search" /></td>
  </tr>
</table>

<?php

if($category=='ActivateRec' and $id){

$sqlChceckMembersNew2="update ".$prefix."list_rec_affiliated set published='Yes' where  id='$id'";
$mysqli->query($sqlChceckMembersNew2);//status='notallowedaccess'
$message='<div class="error2">Details were Published.</div>';
$message='<div class="error2">Account has been Activated</div>';	
}



if($category=='DeActivateRec' and $id){

$sqlChceckMembersNew2="update ".$prefix."list_rec_affiliated set published='No' where  id='$id'";
$mysqli->query($sqlChceckMembersNew2);//status='notallowedaccess'
$message='<div class="error2">Account has been Unpublished</div>';
	
}


if($_POST['doTeam']=='Save' and $_POST['name']){

require("viewlrcn/class.phpmailer.php");
require("viewlrcn/class.smtp.php"); 
	$name=$mysqli->real_escape_string($_POST['name']);
	
	
	$code=$mysqli->real_escape_string($_POST['code']);
	$contacts=$mysqli->real_escape_string($_POST['contacts']);
	$recemail=$mysqli->real_escape_string($_POST['recemail']);
	$recChairName=$mysqli->real_escape_string($_POST['recChairName']);
	$recchairEmail=$mysqli->real_escape_string($_POST['recchairEmail']);
	$accroname=$mysqli->real_escape_string($_POST['accroname']);

	
$usr_ip = md5($_SERVER['REMOTE_ADDR']);
$md5pass = md5($_POST['pwd']);
$host  = $_SERVER['HTTP_HOST'];
$host_upper = strtoupper($host);
$path   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');

$activ_code = rand(1000,9999);
	
	$sqlInvestigators="SELECT * FROM ".$prefix."list_rec_affiliated where `name`='$name' order by id desc";
	$QueryInvestigators = $mysqli->query($sqlInvestigators);
	$totalInvestigators = $QueryInvestigators->num_rows;
	if($totalInvestigators){
	$message='<p class="error">'.$name.' was not created, already exists</p>';	
	}
		if(!$totalInvestigators){
$sqlA2="insert into ".$prefix."list_rec_affiliated (`created`,`updated`,`name`,`slug`,`status`,`code`,`contacts`,`recemail`,`recChairName`,`recchairEmail`,`accroname`,`recNo`,`bankName`,`BranchName`,`payAmount`,`currency`) 

values(now(),now(),'$name','$name','1','$code','$contacts','$recemail','$recChairName','$recchairEmail','$accroname','$recNo','$bankName','$BranchName','$payAmount','$currency')";
$mysqli->query($sqlA2);
$md5_id = $mysqli->insert_id;

$message='<p class="success">Account for '.$name.' has been created</p>';


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
//$mail->addCc('uncstuncstapps@gmail.com','Activation Link from UNCST');//
//$mail->addBcc('mawandammoses@gmail.com','Activation Link from UNCST');//

$mail->FromName = "UNCST"; //From Name -- CHANGE --
$mail->AddAddress('uncstuncstapps@gmail.com', $code); //To Address -- CHANGE --
//if($dbEmail2){echo $mail->addCc($dbEmail2,'Activation Link from UNCST');}
$mail->AddReplyTo("uncstuncstapps@gmail.com", $code); //Reply-To Address -- CHANGE --$usrm_email

$mail->WordWrap = 50; // set word wrap to 50 characters
$mail->IsHTML(false); // set email format to HTML
$mail->Subject = "$name-$code";
$body="
Dear UNCST !<br><br>
A new REC <b>$name</b> has been created on National Research Information Management System : NRIMS<br><br>

Code: $code<br>
Rec Name: $name<br>
Contacts: $contacts<br>
Email: $recemail<br>
Rec Chair: $recChairName<br>
Email for Rec Chair: $recchairEmail<br><br>

Best Regards<br>
Uganda National Council for Science and Technology<br>

";
$mail->MsgHTML($body);

if(!$mail->Send()){
echo "Mailer Error: " . $mail->ErrorInfo;
}///end
		}
	
}?>

<div class="card-header d-flex align-items-center">
                      <h3 class="h4">REC User Accounts </h3>
</div>
                    <div class="card-body">
                    <?php if($message){?><div class="success"><?php echo $message;?></div><?php }?>
                    
              
                        <?php
							//if no page var is given, set start to 0
$sql = "select *,DATE_FORMAT(`created`,'%d/%m/%Y %H:%s:%i') AS created FROM ".$prefix."list_rec_affiliated order by id desc ";//and conceptm_status='new' 
$result = $mysqli->query($sql);
?>


 <table width="100%" class="table table-striped table-sm" id="customers">
                        <thead>
                          <tr>
                            <th>Name</th>
                            <th>Submissions</th>
                            <th>Contacts</th>
                            <th>Created</th>
                            <th>Header Status</th>
                            <th>Status</th>
                            <th>Actions</th>
                          </tr>
                        </thead>
                        <tbody>


<?php 
while($rProjects=$result->fetch_array()){
$country_id=$rProjects['country_id'];
$recAffiliated_id=$rProjects['id'];

$sqlSRR = "select * from ".$prefix."list_country where id='$country_id'";
$resultSSS = $mysqli->query($sqlSRR);
$rCountry = $resultSSS->fetch_array();
$header=strlen($rProjects['recheader']);


$sqlSRR_tr = "select * from ".$prefix."submission where recAffiliated_id='$recAffiliated_id'";
$resultSSS_tr = $mysqli->query($sqlSRR_tr);
$total_tr = $resultSSS_tr->num_rows;
	?>
                          <tr>
                            <td><?php echo $rProjects['name'];?><br />
                            <?php echo $rProjects['accroname'];?></td>
                            <td><?php echo $total_tr;?>
                          
                            </td>
                            <td><?php echo $rProjects['contacts'];?></td>
                            <td><?php echo $rProjects['created'];?></td>
                            <td><?php if($header>=7){?>                            
                            <a href="<?php echo $base_url;?>previewheader.php?rmd_id=<?php echo $rProjects['id'];?>" target="_blank"><span class="label label-sec3">Header Uploaded, Preview in PDF</span></a>
                            
                             <?php }else{?><span class="label label label-warning"> Header Not Uploaded, action required</span> <?php }?></td>
                            <td>
							
							<?php if($rProjects['published']=='No'){?>
<span class="m-status m-status--wide cfx-watch"><a href="./main.php?option=ActivateRec&id=<?php echo $rProjects['id'];?>" onClick="return confirm('Are you sure you want to Activate <?php echo $rProjects['name'];?>?');">         <span class="cfx-watch-label">OFF</span>
        <span class="cfx-watch-switch"></span></a> </span><br /><?php }?>
                                                    
<?php if($rProjects['published']=='Yes'){?>
<span class="m-status m-status--wide cfx-watch active"><a href="./main.php?option=DeActivateRec&id=<?php echo $rProjects['id'];?>" onClick="return confirm('Are you sure you want to De-Activate <?php echo $rProjects['name'];?>?');">        <span class="cfx-watch-label">ON&nbsp;</span>
        <span class="cfx-watch-switch"></span></a></span><?php }?>
        
        
        
        </td>
                            <td><a href="./main.php?option=EditClinicalTrials&id=<?php echo $rProjects['id'];?>">Update</a>
                          
                            </td>
                          </tr>
   <?php }///////////end function ?>                 
                        </tbody>
                      </table>
                    </div>



<!-- The Modal -->
<div id="myModal" class="modal" style="margin-top:60px;">

  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
      <span class="close">&times;</span>
      <h3><strong>Add a REC</strong></h3>
    </div>
    <div class="modal-body" style="height:300px; overflow:scroll;">

 <form action="" method="post" name="regForm" id="regForm" >
 <div class="form-group row" style="padding-top:10px;">
<label class="col-sm-2 form-control-label">Name:</label>
<div class="col-sm-10">

<textarea name="name" cols="" rows="" class="form-control  required"></textarea>
</div>
</div>
                        
                        
   <div class="form-group row">
<label class="col-sm-2 form-control-label">Code:</label>
<div class="col-sm-10">
<input type="text" name="code" id="code" class="form-control  required" value="">
</div>
</div> 

   <div class="form-group row">
<label class="col-sm-2 form-control-label">Contacts:</label>
<div class="col-sm-10">
<textarea name="contacts" cols="" rows="" class="form-control  required"></textarea>
</div>
</div> 


<div class="form-group row">
<label class="col-sm-2 form-control-label">Email:</label>
<div class="col-sm-10">
<input type="text" name="recemail" id="recemail" class="form-control  required email" value="">
</div>
</div> 


<div class="form-group row">
<label class="col-sm-2 form-control-label">REC Chair:</label>
<div class="col-sm-10">
<input type="text" name="recChairName" id="recChairName" class="form-control  required" value="">
</div>
</div>  

<div class="form-group row">
<label class="col-sm-2 form-control-label">Accroname:</label>
<div class="col-sm-10">
<input type="text" name="accroname" id="accroname" class="form-control  required" value="">
</div>
</div>

<div class="form-group row">
<label class="col-sm-2 form-control-label">Email for REC Chair:</label>
<div class="col-sm-10">
<input type="text" name="recchairEmail" id="recchairEmail" class="form-control  required email" value="">
</div>
</div>                  

       <div class="form-group row">
                          <div class="col-sm-4 offset-sm-3">
                    <input name="doTeam" type="submit"  class="btn btn-primary" value="Save"/>

                          </div>
                        </div>
                                          
     </form>                   
    </div>
    </div>
    </div><!--End Reviewer-->
<?php }//end Admin
