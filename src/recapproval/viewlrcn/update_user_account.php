

<div id="countrydivcontainer" style="border:0px solid gray; width:100%; margin-bottom: 1em; padding: 10px">

<?php
if($_POST['doSaveFirst']=='Save' and $_POST['asrmApplctID']){

function getExtension($str) {

         $i = strrpos($str,".");
         if (!$i) { return ""; } 

         $l = strlen($str) - $i;
         $ext = substr($str,$i+1,$l);
         return $ext;
 }
 
	define ("MAX_SIZE","400");

 $errors=0;

$image =$_FILES["photo"]["name"];
 $uploadedfile = $_FILES['photo']['tmp_name'];

  if ($image) 
  {
  $filename = stripslashes($_FILES['photo']['name']);
  $extension = getExtension($filename);
  $extension = strtolower($extension);
 if (($extension != "jpg") && ($extension != "jpeg") && ($extension != "png") && ($extension != "gif")) 
  {
echo ' Unknown Image extension ';
$errors=1;
  }
 else
{
  $size=filesize($_FILES['photo']['tmp_name']);
 
if ($size > MAX_SIZE*1024)
{
$sizelimit='<li class="red"><span class="ico"></span><strong class="system_title">If not uploaded, check Image size, resize to 500px width</strong></li>';
 $errors=1;
}
 
if($extension=="jpg" || $extension=="jpeg" )
{
$uploadedfile = $_FILES['photo']['tmp_name'];
$src = imagecreatefromjpeg($uploadedfile);
}
else if($extension=="png")
{
$uploadedfile = $_FILES['photo']['tmp_name'];
$src = imagecreatefrompng($uploadedfile);
}
else 
{
$src = imagecreatefromgif($uploadedfile);
}
 
list($width,$height)=getimagesize($uploadedfile);
//image
$newwidth=150;
$newheight=($height/$width)*$newwidth;
$tmp=imagecreatetruecolor($newwidth,$newheight);

imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight,$width,$height);


//$no=rand(1000,0000);
$newname="uncst_".preg_replace('/\s+/', '_', $image);

$filename ='./files/signatures/'. $newname;
$filename2 ='./files/signatures/'. $newname;

imagejpeg($tmp,$filename,100);
imagejpeg($tmp,$filename2,100);

imagedestroy($src);
imagedestroy($tmp);


}
}

	
	$asrmApplctID=$mysqli->real_escape_string($_POST['asrmApplctID']);
	$recAffiliated_id=$mysqli->real_escape_string($_POST['recAffiliated_id']);
	$privillage=$mysqli->real_escape_string($_POST['privillage']);
	
	$name=$mysqli->real_escape_string($_POST['name']);
	$country_id=$mysqli->real_escape_string($_POST['countryid']);
	$email=$mysqli->real_escape_string($_POST['email']);
	$password=md5($mysqli->real_escape_string($_POST['pwd']));
	$pwdNot=$mysqli->real_escape_string($_POST['pwd']);
	$username=$mysqli->real_escape_string($_POST['username']);
	$institution=$mysqli->real_escape_string($_POST['institution']);
	$recName=$mysqli->real_escape_string($_POST['recName']);
	$privillage=$mysqli->real_escape_string($_POST['privillage']);
	$authorisedtosign=$mysqli->real_escape_string($_POST['authorisedtosign']);
	$signaturestatus=$mysqli->real_escape_string($_POST['signaturestatus']);
	
	$rstug_district=$mysqli->real_escape_string($_POST['rstug_district']);
	$phone=$mysqli->real_escape_string($_POST['phone']);
	$rstug_placeofbirth=$mysqli->real_escape_string($_POST['rstug_placeofbirth']);
	
if($_POST['pwd']){
$sqlA2="update ".$prefix."user set `country_id`='$country_id',`email`='$email',`password`='$password',`is_active`='1',`name`='$name',`institution`='$institution',`privillage`='$privillage',`rstug_placeofbirth`='$rstug_placeofbirth',`phone`='$phone' where asrmApplctID='$asrmApplctID'";
$mysqli->query($sqlA2);
}
if(!$_POST['pwd']){
$sqlA2="update ".$prefix."user set `country_id`='$country_id',`email`='$email',`is_active`='1',`name`='$name',`institution`='$institution',`privillage`='$privillage',`rstug_placeofbirth`='$rstug_placeofbirth',`phone`='$phone' where asrmApplctID='$asrmApplctID'";//,`authorisedtosign`='$authorisedtosign'
$mysqli->query($sqlA2);
}

if($_FILES["photo"]["name"]){
$sqlA2="update ".$prefix."user set `signatures`='$newname',`authorisedtosign`='$authorisedtosign' where asrmApplctID='$asrmApplctID'";
$mysqli->query($sqlA2);
}

if($signaturestatus=='remove'){
$sqlA22="update ".$prefix."user set `signatures`='',`authorisedtosign`='No' where asrmApplctID='$asrmApplctID'";
$mysqli->query($sqlA22);
}

$message='<p class="success">Dear '.$session_fullname.', details have been submitted, proceed to continue</p>';
logaction("$session_fullname added created new protocol");

/*echo '<img src="images/loading_wait.gif">';
echo '<div class="spacer"></div>';
echo("<script>location.href = '$base_url/main.php?option=userAccounts';</script>");*/


if($_POST['pwd']){
require("viewlrcn/class.phpmailer.php");
require("viewlrcn/class.smtp.php");
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

$mail->FromName = "UNCST"; //From Name -- CHANGE --
$mail->AddAddress($email, $name); //To Address -- CHANGE --
//if($dbEmail2){echo $mail->addCc($dbEmail2,'Activation Link from UNCST');}
$mail->AddReplyTo($email, $name); //Reply-To Address -- CHANGE --$usrm_email

$mail->WordWrap = 50; // set word wrap to 50 characters
$mail->IsHTML(false); // set email format to HTML
$mail->Subject = "REC Member Account Details";
$body="
Dear $name !<br><br>
An account has been updated. You will use these logins whenever to log into the system. Below are your login details;<br><br>
Username: $username<br>
Password: $pwdNot<br>
<a href='".$base_url."/'>Click here to login</a><br><br>

Best Regards<br>
Uganda National Council for Science and Technology<br>

";
$mail->MsgHTML($body);

if(!$mail->Send()){
	echo "Mailer Error: " . $mail->ErrorInfo;
}///end
}//end password updated


}//end post

$sqlstudy="SELECT * FROM ".$prefix."user where asrmApplctID='$id'";
$Querystudy = $mysqli->query($sqlstudy);
$totalstudy = $Querystudy->num_rows;
$rstudy = $Querystudy->fetch_array();
$rstudy['recAffiliated_id'];
?>

<ul id="countrytabs" class="shadetabs">
<li><a href="#" rel="#default" class="selected" style="background:green; color:#FFF;">Update Account - <?php echo $rstudy['name'];?></a></li>

</ul>
<?php 
if(isset($message)){echo $message;}
?>

<form action="" method="post" name="regForm" id="regForm" autocomplte="off" enctype="multipart/form-data">
      <div class="form-group row success" style="padding-top:10px;">
<label class="col-sm-2 form-control-label">Full Name:</label>
<div class="col-sm-10">
<input type="text" name="name" id="investigator" class="form-control  required" value="<?php echo $rstudy['name'];?>">
</div>
</div>
                        
                        
   <div class="form-group row success">
<label class="col-sm-2 form-control-label">Institution:</label>
<div class="col-sm-10">
<input type="text" name="institution" id="institution" class="form-control" value="<?php echo $rstudy['institution'];?>">
<input type="hidden" name="recAffiliated_id" id="recAffiliated_id" class="form-control  required" value="<?php echo $recAffiliated_id;?>">
</div>
</div>                      
 
   <div class="form-group row success">
<label class="col-sm-2 form-control-label">Email:</label>
<div class="col-sm-10">
<input type="text" name="email" id="email" class="form-control  required email" value="<?php echo $rstudy['email'];?>">
</div>
</div>

 <div class="form-group row success">
<label class="col-sm-2 form-control-label">Username:</label>
<div class="col-sm-10">
<input type="text" name="username" id="username" class="form-control  required" value="<?php echo $rstudy['username'];?>">
</div>
</div>

 <div class="form-group row success">
<label class="col-sm-2 form-control-label">Password:</label>
<div class="col-sm-10">
<input type="password" name="pwd" id="pwd" class="form-control" value="">
</div>
</div>

           <div class="form-group row success">
<label class="col-sm-2 form-control-label">Privillage:</label>
<div class="col-sm-10"> 
<select name="privillage" id="privillage" class="form-control  required">
<option value="">Please Select</option>
<option value="investigator" <?php if($rstudy['privillage']=='investigator'){?>selected="selected"<?php }?>>Investigator</option>
<option value="secretary" <?php if($rstudy['privillage']=='secretary'){?>selected="selected"<?php }?>>Secretary</option>
<option value="membercommittee" <?php if($rstudy['privillage']=='membercommittee'){?>selected="selected"<?php }?>>Member Committee</option>
<option value="administrator" <?php if($rstudy['privillage']=='administrator'){?>selected="selected"<?php }?>>Super Administrator</option>
<option value="recadmin" <?php if($rstudy['privillage']=='recadmin'){?>selected="selected"<?php }?>>REC Admin</option>
<option value="recitadmin" <?php if($rstudy['privillage']=='recitadmin'){?>selected="selected"<?php }?>>REC IT Administrator</option>
<option value="recreviewer" <?php if($rstudy['privillage']=='recreviewer'){?>selected="selected"<?php }?>>REC Reviewer</option>
<option value="rechairperson" <?php if($rstudy['privillage']=='rechairperson'){?>selected="selected"<?php }?>>REC Chairperson</option>
<option value="revicechairperson" <?php if($rstudy['privillage']=='revicechairperson'){?>selected="selected"<?php }?>>REC Vice Chairperson</option>
<option value="recsecretary" <?php if($rstudy['privillage']=='recsecretary'){?>selected="selected"<?php }?>>REC Secretary</option>
<option value="communityrepresentative" <?php if($rstudy['privillage']=='communityrepresentative'){?>selected="selected"<?php }?>>Community Representative</option>
</select>
</div>
</div>           
                        
    <div class="form-group row success">
<label class="col-sm-2 form-control-label">Country:</label>
<div class="col-sm-10">
<select name="countryid" id="countryid" class="form-control  required">
<option value="800">Uganda</option>
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




                   
      <?php if($rstudy['privillage']!='investigator'){?>                  
                         <div class="form-group row success">
                          <label class="col-sm-2 form-control-label">Assign REC: <span class="error">*</span></label>
                          <div class="col-sm-10">
                            <select name="recAffiliated_id" id="recAffiliated_id" class="form-control required">
<option value="">Please Select</option>
<?php
$sqlClinicalcv = "select * FROM ".$prefix."list_rec_affiliated order by name asc";//and conceptm_status='new' 
$resultClinicalcv = $mysqli->query($sqlClinicalcv);
while($rClinicalcv=$resultClinicalcv->fetch_array()){
?>
<option value="<?php echo $rClinicalcv['id'];?>" <?php if($rClinicalcv['id']==$rstudy['recAffiliated_id']){?>selected="selected"<?php }?>><?php echo $rClinicalcv['name'];?></option>
<?php }?>
</select>

                          </div>
                        </div><?php }?>
              


<?php if($rstudy['privillage']!='investigator' and $rstudy['privillage']!='recitadmin'){?> 

<div class="line"></div> 
                        
                            <div class="form-group row success">
                          <label class="col-sm-4 form-control-label">Authorised Signature (jpg Image only 150px width)</b><span class="error">*</span></label>
                          
                          <?php if(!$rstudy['signatures']){?><input type="file" name="photo" tabindex="9" id="file2"/><?php }?>

                            
                            <?php if($rstudy['signatures']){?>
                            <input type="file" name="photo" tabindex="9" id="file2"/><br />
                            <img src="<?php echo $base_url;?>files/signatures/<?php echo $rstudy['signatures'];?>" /><br />
							<input name="signaturestatus" type="radio" value="remove" /> <span style="color:#F00;">Remove Signature</span>&nbsp;<input name="signaturestatus" type="radio" value="keep" checked="checked"/> <span style="color:#F00;">Keep Signature</span>
							
							<?php }?>
                        </div>

                       <div class="line"></div> 
                        
                            <div class="form-group row success">
                          <label class="col-sm-4 form-control-label">Authorised to Sign Approval Letter</b><span class="error">*</span></label>                          
                         <input name="authorisedtosign" type="radio" value="Yes" <?php if($rstudy['authorisedtosign']=='Yes'){?>checked="checked"<?php }?>/> Yes
                         <input name="authorisedtosign" type="radio" value="No" <?php if($rstudy['authorisedtosign']=='No'){?>checked="checked"<?php }?> /> No
                        </div>
<?php }?>

 <div class="form-group row success">
<label class="col-sm-2 form-control-label">Place of Birth:</label>
<div class="col-sm-10">
<input type="date" name="rstug_placeofbirth" id="rstug_placeofbirth" class="form-control " value="<?php echo $rstudy['rstug_placeofbirth'];?>">
</div>
</div>

 <div class="form-group row success">
<label class="col-sm-2 form-control-label">Phone Number:</label>
<div class="col-sm-10">
<input type="text" name="phone" id="phone" class="form-control" value="<?php echo $rstudy['phone'];?>">
<input name="asrmApplctID" type="hidden" value="<?php echo $id;?>"/>
</div>
</div>




                   
                        <div class="form-group row success">
                          <div class="col-sm-4 offset-sm-3">
                    <input name="doSaveFirst" type="submit"  class="btn btn-primary" value="Save"/>

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