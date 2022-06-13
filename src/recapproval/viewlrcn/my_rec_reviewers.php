<?php //REC ADMIN
if($session_privillage=='recadmin' || $session_privillage=='rechairperson' || $session_privillage=='revicechairperson' || $session_privillage=='recitadmin'){?>

<div class="card-header d-flex align-items-center">
<button id="myBtn">Add New Reviewer </button>  <h3 class="h4" style="text-transform:uppercase;">&nbsp;&nbsp;Reviewers</h3>
</div>
<?php
if($_POST['doTeam']=='Save' and $_POST['firstname'] and $_POST['email']){

require("viewlrcn/class.phpmailer.php");
require("viewlrcn/class.smtp.php"); 
	
	$country_id=$mysqli->real_escape_string($_POST['countryid']);
	$email=$mysqli->real_escape_string($_POST['email']);
	$password=md5($mysqli->real_escape_string($_POST['pwd']));
	$pwdNot=$mysqli->real_escape_string($_POST['pwd']);
	
	$institution=$mysqli->real_escape_string($_POST['institution']);
	$recName=$mysqli->real_escape_string($_POST['recName']);
	$recAffiliated_id=$mysqli->real_escape_string($_POST['recAffiliated_id']);
	$firstname=$mysqli->real_escape_string($_POST['firstname']);
	$lastname=$mysqli->real_escape_string($_POST['lastname']);
	$name=$firstname.' '.$lastname;
	
	$sqlUserFx="SELECT * FROM ".$prefix."user order by asrmApplctID desc limit 0,1";
	$QueryUserFx = $mysqli->query($sqlUserFx);
	$recUserFx=$QueryUserFx->fetch_array();
	
	$username=rtrim($lastname.$recUserFx['asrmApplctID']);
	
	if($_POST['role']=='expert'){
		$role='recreviewer';
	$is_active=1;
	$emailText="Dear $name !<br><br>
An account has been created for you as a reviewer on National Research Information Management System (NRIMS) with the logins below. <br><br>

Username: $username<br>
Password: $pwdNot<br>
<a href='".$base_url."/'>Click here to login</a><br><br>

Best Regards<br>
$contacts<br>";
	
	
	
	}else{$role=$mysqli->real_escape_string($_POST['role']);
	$is_active=1;
	$emailText="Dear $name !<br><br>
An account has been created for you as a reviewer on National Research Information Management System (NRIMS) with the logins below pending approval from the REC Chair. <br><br>

Username: $username<br>
Password: $pwdNot<br>
<a href='$base_url/'>Click here to login</a><br><br>

Best Regards<br>
$contacts<br>";
	
	}
	
$sqlMyrecnamew="SELECT * FROM ".$prefix."list_rec_affiliated where id='$recAffiliated_id'";
$sqlFMyreccnaw=$mysqli->query($sqlMyrecnamew);
$recNamew=$sqlFMyreccnaw->fetch_array();

	$contacts=$recNamew['contacts'];
	$recOriginalName=$recNamew['name'];
	$recchairEmail=$recNamew['recchairEmail'];
	
$usr_ip = md5($_SERVER['REMOTE_ADDR']);
$md5pass = md5($_POST['pwd']);
$host  = $_SERVER['HTTP_HOST'];
$host_upper = strtoupper($host);
$path   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');

$activ_code = rand(1000,9999);
	$sqlInvestigators="SELECT * FROM ".$prefix."user where `username`='$username' order by asrmApplctID desc";
	$QueryInvestigators = $mysqli->query($sqlInvestigators);//and recAffiliated_id='$recAffiliated_id' 
	$totalInvestigators = $QueryInvestigators->num_rows;
	if($totalInvestigators){
	echo $message='<div class="error" style="font-size:16px; padding-top:5px;">Your account was not created, username/email already exists</div>';	
	}
		if(!$totalInvestigators){
$sqlA2="insert into ".$prefix."user (`country_id`,`created`,`updated`,`email`,`password`,`username`,`is_active`,`name`,`institution`,`hashcode`,`first_access`,`privillage`,`profile`,`recAffiliated_id`,`rstug_md5_id`,`rstug_act_code`) 

values('$country_id',now(),now(),'$email','$password','$username','$is_active','$name','$institution','','0','$role','','$recAffiliated_id','','$activ_code')";
$mysqli->query($sqlA2);
$md5_id = $mysqli->insert_id;
$md5_idmm = md5($mysqli->insert_id);

$updateLogin="update ".$prefix."user set rstug_md5_id='$md5_idmm' where asrmApplctID='$md5_id'";
$mysqli->query($updateLogin);

echo $message='<div class="success" style="font-size:16px; padding-top:5px;">'.$emailText.'</div>';
//echo $message='<div class="success" style="font-size:16px; padding-top:5px;">Account has been created and email sent to $email</div>';

if($email){
///Now Send mail
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

$mail->FromName = "uncstuncstapps@gmail.com"; //From Name -- CHANGE --$recOriginalName
$mail->AddAddress($email, $name); //To Address -- CHANGE --
//if($dbEmail2){echo $mail->addCc($dbEmail2,'Activation Link from UNCST');}
$mail->AddReplyTo($email, $name); //Reply-To Address -- CHANGE --$usrm_email

$mail->WordWrap = 50; // set word wrap to 50 characters
$mail->IsHTML(false); // set email format to HTML
$mail->Subject = "REC Review Account - $recOriginalName";
$body="$emailText";
$mail->MsgHTML($body);

if(!$mail->Send()){
	//echo "Mailer Error: " . $mail->ErrorInfo;
}///end

}///end Reviewer Notification



if($recchairEmail){
	base64_encode($md5_id);
///Now Send mail
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

$mail->FromName = "uncstuncstapps@gmail.com"; //From Name -- CHANGE --$recOriginalName
$mail->AddAddress($recchairEmail, $recChairName); //To Address -- CHANGE --
//if($dbEmail2){echo $mail->addCc($dbEmail2,'Activation Link from UNCST');}
$mail->AddReplyTo($email, $name); //Reply-To Address -- CHANGE --$usrm_email

$mail->WordWrap = 50; // set word wrap to 50 characters
$mail->IsHTML(false); // set email format to HTML
$mail->Subject = "REC Review Account - $recOriginalName";
$body="
Dear $recChairName !<br><br>
An account for <b>$name</b> has been created on National Research Information Management System (NRIMS) for your approval.<br><br>
Click on the link below to authorise the said account.<br><br>

<a href='$base_url/AuthRec.php?a=$md5_idmm&code=$activ_code'>Click here to authorise</a><br><br>

Best Regards<br>
$contacts<br>

";
$mail->MsgHTML($body);

if(!$mail->Send()){
	//echo "Mailer Error: " . $mail->ErrorInfo;
}///end

}///end Reviewer Notification




}
	
}


if($category=='ActivaterecReviewers' and $id){

$sqlChceckMembersNew2="update ".$prefix."user set is_active='1' where  asrmApplctID='$id'";
$mysqli->query($sqlChceckMembersNew2);//status='notallowedaccess'
$message='<div class="error2">Details were removed.</div>';
echo $message='<div class="error2">Account has been Activated</div>';	
}

if($category=='DeActivaterecReviewers' and $id){

$sqlChceckMembersNew2="update ".$prefix."user set is_active='0' where  asrmApplctID='$id'";
$mysqli->query($sqlChceckMembersNew2);//status='notallowedaccess'
echo $message='<div class="error2">Account has been De-activated</div>';
	
}

if($category=='DelReviewers' and $id){

$sqlChceckMembersNew2="delete from ".$prefix."user  where  asrmApplctID='$id'";
$mysqli->query($sqlChceckMembersNew2);//status='notallowedaccess'
echo $message='<div class="error2">Account has been Removed</div>';
	
}
?>

<!-- The Modal -->
<div id="myModal" class="modal" style="margin-top:60px;">

  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
      <span class="close">&times;</span>
      <h3><strong>Add new Reviewer</strong></h3>
    </div>
    <div class="modal-body" style="height:300px; overflow:scroll;">

 <form action="" method="post" name="regForm" id="regForm" >
 <div class="form-group row" style="padding-top:10px;">
<label class="col-sm-2 form-control-label">First Name:</label>
<div class="col-sm-10">
<input type="text" name="firstname" id="investigator" class="form-control  required" value="">
</div>
</div>
   <div class="form-group row" style="padding-top:10px;">
<label class="col-sm-2 form-control-label">Last Name:</label>
<div class="col-sm-10">
<input type="text" name="lastname" id="investigator" class="form-control  required" value="">
</div>
</div>                      
                        
   <div class="form-group row">
<label class="col-sm-2 form-control-label">Institution:</label>
<div class="col-sm-10">
<input type="text" name="institution" id="institution" class="form-control  required" value="">
<input type="hidden" name="recAffiliated_id" id="recAffiliated_id" class="form-control  required" value="<?php echo $recAffiliated_id;?>">
</div>
</div>                      
 
   <div class="form-group row">
<label class="col-sm-2 form-control-label">Email:</label>
<div class="col-sm-10">
<input type="text" name="email" id="email" class="form-control  required email" value="">
</div>
</div>



 <div class="form-group row">
<label class="col-sm-2 form-control-label">Password:</label>
<div class="col-sm-10">
<input type="password" name="pwd" id="pwd" class="form-control  required" value="">
</div>
</div>

                 
                        
    <div class="form-group row">
<label class="col-sm-2 form-control-label">Country:</label>
<div class="col-sm-10">
<select name="countryid" id="countryid" class="form-control  required">
<?php
$sqlCountrycv = "select * FROM ".$prefix."list_country order by name asc";//and conceptm_status='new' 
$resultCountrycv = $mysqli->query($sqlCountrycv);
while($rCountrycv=$resultCountrycv->fetch_array()){
?>
<option value="<?php echo $rCountrycv['id'];?>" <?php if($rCountrycv['id']==800){?>selected="selected"<?php }?>><?php echo $rCountrycv['name'];?></option>
<?php }?>
</select>
</div>
</div> 

   <div class="form-group row">
<label class="col-sm-2 form-control-label">Role:</label>
<div class="col-sm-10">
<select name="role" id="role" class="form-control  required">
<option value="secretary">REC Secretary</option>
<option value="recreviewer">REC Reviewer</option>
<option value="recreviewer">REC Member</option>
<option value="expert">Expert Reviewer</option>
<option value="rechairperson">REC Chair</option>

<option value="revicechairperson">REC Vice Chair</option>
<option value="communityrepresentative">Community Representative</option>

</select>
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
    
    
    
    
                    <div class="card-body">
                    
 

                        <?php
$category=$_POST['category'];
$page='./main.php?option=';
$url='recReviewers';
$value='&id='.$id;
//$value='listuserauthorised';

$tbl_name="";		//your table name
// How many adjacent pages should be shown on each side?
$adjacents = 3;
$query = $mysqli->query("select COUNT(*) as num from ".$prefix."user where recAffiliated_id='$recAffiliated_id' and (privillage='recreviewer' ||  privillage='secretary' || privillage='expert' || privillage='rechairperson' || privillage='revicechairperson' || privillage='communityrepresentative') order by asrmApplctID desc");//and conceptm_status='new' 
$row = $query -> fetch_array(MYSQLI_NUM);
$total_pages = $row[0];

/* Setup vars for query. */
//$targetpage = $page.$url.$value; 
$targetpage = $page.$url.$value; 	//your file name  (the name of this file)
$limitm = 10;//
//how many items to show per page
/*Extract Last Value from a link*/
$page = $_GET['page'];
								//how many items to show per page
if($page) 
$start = ($page - 1) * $limitm; 			//first item to display on this page
else
$start = 0;								//if no page var is given, set start to 0
$sql = "select *,DATE_FORMAT(`created`,'%d/%m/%Y %H:%s:%i') AS created FROM ".$prefix."user where recAffiliated_id='$recAffiliated_id' and (privillage='recreviewer' ||  privillage='secretary' || privillage='expert' || privillage='rechairperson' || privillage='revicechairperson' || privillage='communityrepresentative') order by asrmApplctID desc LIMIT $start, $limitm";//and conceptm_status='new' 
$result = $mysqli->query($sql);

/* Setup page vars for display. */
if ($page == 0) $page = 1;					//if no page var is given, default to 1.
$prev = $page - 1;							//previous page is page - 1
$next = $page + 1;							//next page is page + 1
$lastpage = ceil($total_pages/$limitm);		//lastpage is = total pages / items per page, rounded up.
$lpm1 = $lastpage - 1;						//last page minus 1

/* 
Now we apply our rules and draw the pagination object. 
We're actually saving the code to a variable in case we want to draw it more than once.
*/
$pagination = "";
if($lastpage > 1)
{	
$pagination .= "<div class=\"pagination\">";
//previous button
if ($page > 1) 
$pagination.= "<a href=\"$targetpage&page=$prev\">&laquo;previous</a>";
else
$pagination.= "<span class=\"disabled\">&laquo;previous</span>";	

//pages	
if ($lastpage < 7 + ($adjacents * 2))	//not enough pages to bother breaking it up
{	
for ($counter = 1; $counter <= $lastpage; $counter++)
{
if ($counter == $page)
$pagination.= "<span class=\"current\">$counter</span>";
else
$pagination.= "<a href=\"$targetpage&page=$counter\">$counter</a>";					
}
}
elseif($lastpage > 5 + ($adjacents * 2))	//enough pages to hide some
{
//close to beginning; only hide later pages
if($page < 1 + ($adjacents * 2))		
{
for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
{
if ($counter == $page)
$pagination.= "<span class=\"current\">$counter</span>";
else
$pagination.= "<a href=\"$targetpage&page=$counter\">$counter</a>";					
}
$pagination.= "...";
$pagination.= "<a href=\"$targetpage&page=$lpm1\">$lpm1</a>";
$pagination.= "<a href=\"$targetpage&page=$lastpage\">$lastpage</a>";		
}
//in middle; hide some front and some back
elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
{
$pagination.= "<a href=\"$targetpage&page=1\">1</a>";
$pagination.= "<a href=\"$targetpage&page=2\">2</a>";
$pagination.= "...";
for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
{
if ($counter == $page)
$pagination.= "<span class=\"current\">$counter</span>";
else
$pagination.= "<a href=\"$targetpage&page=$counter\">$counter</a>";					
}
$pagination.= "...";
$pagination.= "<a href=\"$targetpage&page=$lpm1\">$lpm1</a>";
$pagination.= "<a href=\"$targetpage&page=$lastpage\">$lastpage</a>";		
}
//close to end; only hide early pages
else
{
$pagination.= "<a href=\"$targetpage&page=1\">1</a>";
$pagination.= "<a href=\"$targetpage&page=2\">2</a>";
$pagination.= "...";
for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
{
if ($counter == $page)
$pagination.= "<span class=\"current\">$counter</span>";
else
$pagination.= "<a href=\"$targetpage&page=$counter\">$counter</a>";					
}
}
}

//next button
if ($page < $counter - 1) 
$pagination.= "<a href=\"$targetpage&page=$next\">next&raquo;</a>";
else
$pagination.= "<span class=\"disabled\">next&raquo;</span>";
$pagination.= "</div>";		
} ?>

 <div class="nav_purgination" style="margin-bottom:10px;">
<?php echo $pagination;?>
<div class="clear"></div>

</div><!--end purgination section-->
               <table class="table table-striped table-sm" id="customers">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Username</th>
                            <th>Role</th>
                            <th>Country</th>
                            <th>Authorised to Sign</th>
                            <th colspan="2">Suspend/ Activate</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php 
while($rProjects=$result->fetch_array()){
$country_id=$rProjects['country_id'];
$submi_asrmApplctID=$rProjects['asrmApplctID'];

$sqlSRR = "select * from ".$prefix."list_country where id='$country_id'";
$resultSSS = $mysqli->query($sqlSRR);
$sqUserdd = $resultSSS->fetch_array();

///Submissions Assigned apvr_submission_review_sr.asrmApplctID='$id'
$sqlSubmissions = "select * from ".$prefix."submission_review_sr where asrmApplctID='$submi_asrmApplctID'";
$resultSubmission = $mysqli->query($sqlSubmissions);
$totalSubmission = $resultSubmission->num_rows;
	?>
                          <tr>
                            <td scope="row"><?php echo $rProjects['asrmApplctID'];?> </td>
                            <td><a href="./main.php?option=AssignedProtocols&id=<?php echo $rProjects['asrmApplctID'];?>"><?php echo $rProjects['name'];?></a>
                            
                            <a href="./main.php?option=AssignedProtocols&id=<?php echo $rProjects['asrmApplctID'];?>" style="color:#F00;"><br />
                            Total Submissions Assigned: <?php echo $totalSubmission;?></a>
                            
                            </td>
                            <td><?php echo $rProjects['email'];?></td>
                            <td><?php echo $rProjects['username'];?></td>
                            <td><?php echo $rProjects['privillage'];?></td>
                            <td><?php echo $sqUserdd['name'];?></td>
                            <td><?php echo $rProjects['authorisedtosign'];?><br />
                            
                            <?php if($rProjects['signatures']){?>
                            <img src="<?php echo $base_url;?>files/signatures/<?php echo $rProjects['signatures'];?>" /><?php }?></td>
                            
                            <td> <?php if($rProjects['is_active']=='0'){?>
<span class="m-status m-status--wide cfx-watch"><a href="./main.php?option=ActivaterecReviewers&id=<?php echo $rProjects['asrmApplctID'];?>" onClick="return confirm('Are you sure you want to Activate <?php echo $rProjects['name'];?>?');">         <span class="cfx-watch-label">Deactivated</span>
        <span class="cfx-watch-switch"></span></a> </span><br /><?php }?>
                                                    
<?php if($rProjects['is_active']=='1'){?>
<span class="m-status m-status--wide cfx-watch active"><a href="./main.php?option=DeActivaterecReviewers&id=<?php echo $rProjects['asrmApplctID'];?>" onClick="return confirm('Are you sure you want to De-Activate <?php echo $rProjects['name'];?>?');">        <span class="cfx-watch-label">Activate&nbsp;</span>
        <span class="cfx-watch-switch"></span></a></span><?php }?> </td>
        
        <td><a href="./main.php?option=UpdateUser&id=<?php echo $rProjects['asrmApplctID'];?>" class="m-status-green" style="padding:5px;" >Update</a><br />
                          <a href="./main.php?option=DelReviewers&id=<?php echo $rProjects['asrmApplctID'];?>" class="m-status-red" style="padding:7px;" onclick="return confirm('Are you sure you want to delete this item?');">Delete</a></td>
        
                          </tr>
   <?php }///////////end function ?>                 
                        </tbody>
                      </table>
              </div>

 
 
	  <div class="nav_purgination">
<?php echo $pagination;?>
<div class="clear"></div>

</div><!--end purgination section-->
<?php }//end Admin