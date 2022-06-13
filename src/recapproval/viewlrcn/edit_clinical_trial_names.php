<?php
if($_POST['doSaveThree']=='Save'){
	
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
$newwidth=800;
$newheight=($height/$width)*$newwidth;
$tmp=imagecreatetruecolor($newwidth,$newheight);

imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight,$width,$height);


//$no=rand(1000,0000);
$newname="uncst_".preg_replace('/\s+/', '_', $image);

$filename ='./files/headers/'. $newname;
$filename2 ='./files/headers/'. $newname;

imagejpeg($tmp,$filename,100);
imagejpeg($tmp,$filename2,100);

imagedestroy($src);
imagedestroy($tmp);


}
}

	$name=$mysqli->real_escape_string($_POST['name']);
	$contacts=$mysqli->real_escape_string($_POST['contacts']);
	$recemail=$mysqli->real_escape_string($_POST['recemail']);
	$recChairName=$mysqli->real_escape_string($_POST['recChairName']);
	$recchairEmail=$mysqli->real_escape_string($_POST['recchairEmail']);
	$accroname=$mysqli->real_escape_string($_POST['accroname']);
	$bankName=$mysqli->real_escape_string($_POST['bankName']);
		
	$BranchName=$mysqli->real_escape_string($_POST['BranchName']);
	$payAmount=$mysqli->real_escape_string($_POST['payAmount']);
	$currency=$mysqli->real_escape_string($_POST['currency']);
$code=$mysqli->real_escape_string($_POST['code']);
$shortaddress=$mysqli->real_escape_string($_POST['shortaddress']);
	
$sqlA2Protocol="update ".$prefix."list_rec_affiliated   set `name`='$name',`contacts`='$contacts',`recemail`='$recemail',`recChairName`='$recChairName',`code`='$code',`recchairEmail`='$recchairEmail',`accroname`='$accroname',`bankName`='$bankName',`BranchName`='$BranchName',`payAmount`='$payAmount',`currency`='$currency',`shortaddress`='$shortaddress' where id='$id'";
$mysqli->query($sqlA2Protocol);

if($_FILES["photo"]["name"]){
$sqlA2Protocol2="update ".$prefix."list_rec_affiliated   set `recheader`='$newname' where id='$id'";
$mysqli->query($sqlA2Protocol2);	
	
}


$message='<p class="success">Dear '.$session_fullname.', details have been submitted, proceed to continue</p>';
logaction("$session_fullname updated REC");

}//end post
?>

<ul id="countrytabs" class="shadetabs">

<li><a href="#" rel="#default" class="selected">REC Submit Details</a></li>




</ul>

<div id="countrydivcontainer" style="border:0px solid gray; width:100%; margin-bottom: 1em; padding: 10px">
<?php
$sqlstudym="SELECT * FROM ".$prefix."list_rec_affiliated  where id='$id'";
$Querystudym = $mysqli->query($sqlstudym);
$rstudy = $Querystudym->fetch_array();


?>
  <!-- Project-->
              <div class="project">
                <div class="row bg-white has-shadow">
                  <div class="left-col col-lg-6 d-flex align-items-center justify-content-between">
                    <div class="project-title d-flex align-items-center">
                     
                      <div class="text">
                        <h3 class="h4">REC</h3><small><?php echo $rstudy['name'];?></small>
                      </div>
                    </div>
                 
                  </div>
                  <div class="right-col col-lg-6 d-flex align-items-center">
                    <div class="time"><i class="fa fa-clock-o"></i><h3 class="h4">Code</h3> <?php echo $rstudy['code'];?> </div>
                    <!--<div class="comments"><i class="fa fa-comment-o"></i>20</div>-->
                    <div class="project-progress">
                     <!-- <div class="progress">
                        <div role="progressbar" style="width: 45%; height: 6px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" class="progress-bar bg-red"></div>
                      </div>-->
                      
   

                    </div>
                  </div>
                </div>
              </div>
 <?php

if($message){echo $message;}
?>



      
  <div style="clear:both;"></div>                      
<form action="" method="post" name="regForm" id="regForm" autocomplete="false" enctype="multipart/form-data">                        
                        
                        
                        
                        
                        
      
   <div style="clear:both;"></div>                   
                        <div class="form-group row success">
                          <label class="col-sm-2 form-control-label">Full Name: <span class="error">*</span></label>
                          <textarea name="name" id="name" cols="" rows="5" class="form-control  required"><?php echo $rstudy['name'];?></textarea>
                        </div>
                        <div class="line"></div>
                        
                        
    <div class="form-group row success">
                          <label class="col-sm-6 form-control-label">Contacts: <span class="error">*</span></label>
                         <textarea name="contacts" id="contacts" cols="" rows="5" class="form-control  required"><?php echo $rstudy['contacts'];?></textarea>
              
                       
                        </div>
                                        <div class="line"></div>
                        
                        
    <div class="form-group row success">
                          <label class="col-sm-6 form-control-label">Code: <span class="error">*</span></label>
                         <textarea name="code" id="code" cols="" rows="5" class="form-control  required"><?php echo $rstudy['code'];?></textarea>
              
                       
                        </div>
                        
                        <div class="line"></div>
                        
                          <div class="form-group row success">
                          <label class="col-sm-2 form-control-label">REC Email : <span class="error">*</span></label>
                          <textarea name="recemail" id="recemail" cols="" rows="5" class="form-control  required"><?php echo $rstudy['recemail'];?></textarea>
                        </div>
                        <div class="line"></div>
                        
                        
                         <div class="form-group row success">
                          <label class="col-sm-2 form-control-label">REC Chairman: <span class="error">*</span> </label>
                          <textarea name="recChairName" id="recChairName" cols="" rows="5" class="form-control  required"><?php echo $rstudy['recChairName'];?></textarea>
                        </div>
                        <div class="line"></div>
                        

                        
                     <div class="form-group row success">
                          <label class="col-sm-4 form-control-label">REC Chair Email: <span class="error">*</span></label>
                          <textarea name="recchairEmail" id="recchairEmail" cols="" rows="5" class="form-control  required"><?php echo $rstudy['recchairEmail'];?></textarea>
    </div>
                        <div class="line"></div>   
                        
                        
                        <div class="form-group row success">
                          <label class="col-sm-4 form-control-label">Accro Name (Short Name): <span class="error">*</span></label>
                          <textarea name="accroname" id="accroname" cols="" rows="5" class="form-control  required"><?php  echo $rstudy['accroname'];?></textarea>
                        </div>
                        <div class="line"></div>   
                        
                    <?php /*?>    
                         <div class="form-group row success">
                          <label class="col-sm-4 form-control-label">Bank Name: <span class="error">*</span></label>
                          <textarea name="bankName" id="bankName" cols="" rows="5" class="form-control  required"><?php  echo $rstudy['bankName'];?></textarea>
                        </div>
                        <div class="line"></div>  

                        <div class="form-group row success">
                          <label class="col-sm-4 form-control-label">Branch Name: <span class="error">*</span></label>
                          <textarea name="BranchName" id="BranchName" cols="" rows="5" class="form-control  required"><?php echo $rstudy['BranchName'];?></textarea>
                        </div>
                        <div class="line"></div> 
                        
                        <div class="form-group row success">
                          <label class="col-sm-4 form-control-label">Amount per Submission: <span class="error">*</span></label>
                          <textarea name="payAmount" id="payAmount" cols="" rows="5" class="form-control  required"><?php echo $rstudy['payAmount'];?></textarea>
                        </div>
                        <div class="line"></div>
						 <div class="form-group row success">
                          <label class="col-sm-4 form-control-label">Currency: <span class="error">*</span></label>
                          <textarea name="currency" id="currency" cols="" rows="5" class="form-control  required"><?php echo $rstudy['currency'];?></textarea>
                        </div>
						
						  <div class="form-group row success">
                          <label class="col-sm-4 form-control-label">Short Address (Address to appear on Approval Letter): <span class="error">*</span></label>
                          <textarea name="shortaddress" id="shortaddress" cols="" rows="5" class="form-control"><?php echo $rstudy['shortaddress'];?></textarea>
                        </div>
          
						 <?php */?>
                        
                          
      
      
                        <div class="line"></div> 
                        
                            <div class="form-group row success">
                          <label class="col-sm-4 form-control-label">REC Header: <b>(Width: 800px by Height: 130px)</b><span class="error">*</span></label>
                          
                          <?php if(!$rstudy['recheader']){?><input type="file" name="photo" tabindex="9" id="file2"/><?php }?>

                            
                            <?php if($rstudy['recheader']){?>
                            <input type="file" name="photo" tabindex="9" id="file2"/><br />
                            <img src="./files/headers/<?php echo $rstudy['recheader'];?>" /><?php }?>
                        </div>
                         
                        
                     
                        
                        
                        <div class="form-group row">
                          <div class="col-sm-4 offset-sm-3">
                    <input name="doSaveThree" type="submit"  class="btn btn-primary" value="Save"/>

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