               <?php
if($_POST['doPassword']=='Update' and $_FILES["photo"]["name"] and $_POST['asrmApplctID']){

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
$newwidth=200;
$newheight=($height/$width)*$newwidth;
$tmp=imagecreatetruecolor($newwidth,$newheight);

imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight,$width,$height);


//$no=rand(1000,0000);
$hp="uncst_".$fname;
$newname=$hp.$image;

$filename ='./files/profile/'. $newname;
$filename2 ='./files/profile/'. $newname;

imagejpeg($tmp,$filename,100);
imagejpeg($tmp,$filename2,100);

imagedestroy($src);
imagedestroy($tmp);


}
}

$sqlA2="update ".$prefix."user set `profile`='$newname' where asrmApplctID='$asrmApplctID'";
$mysqli->query($sqlA2);


$message='<div class="success">Your profile has been updated<br><br></div>';

		
}?>


<?php
$ownerID=$_SESSION['asrmApplctID'];
$sqlstudy="SELECT * FROM ".$prefix."user where `asrmApplctID`='$ownerID'";
$Querystudy = $mysqli->query($sqlstudy);
$totalstudy = $Querystudy->num_rows;
$rstudy = $Querystudy->fetch_array();
?>

<ul id="countrytabs" class="shadetabs">

<li><a href="./main.php?option=MyProfile">My Profile</a></li>
<li><a href="./main.php?option=ChangeMyPassword">Change Password</a></li>
<li><a href="#" rel="#default" class="selected">Profile Picture</a></li>


</ul>

<div id="countrydivcontainer" style="border:0px solid gray; width:100%; margin-bottom: 1em; padding: 10px">



 <form id="regForm" method="post" action="" name="regForm" autocomplete="off" enctype="multipart/form-data">
    <div  class="logmain"> 
                  Required Fields marked (<span class="fontx">*</span>)
                  <hr>
	  <?php if(isset($message)){echo $message;}?>
      <?php if(isset($errmessage)){echo $errmessage;}?>
      
      
      
      
       <div class="form-group row">
                          <label class="col-sm-2 form-control-label">Photo: <span class="error">*</span></label>
                          <div class="col-sm-10">
                            <input type="hidden" name="asrmApplctID" value="<?php echo $_SESSION['asrmApplctID'];?>">
                            

                            <input type="file" name="photo" tabindex="9" id="file2" class="required" /><br />
                            <?php if($rstudy['profile']){?><img src="./files/profile/<?php echo $rstudy['profile'];?>" /><?php }?>
                          </div>
                        </div>
                        <div class="line"></div>
           
  
 
 
 
 
 
 
 
 
 
 </div><!--End-->
 
 
 



  
 <div class="form-group row">
                          <div class="col-sm-4 offset-sm-3">
                    <input name="doPassword" type="submit"  class="btn btn-primary" value="Update"/>

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