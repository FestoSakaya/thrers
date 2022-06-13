               <?php
if($_POST['doCountry']=='Save' and $_POST['fname']  and $_POST['surname'] and $_POST['asrmApplctID']){



$fname=$mysqli->real_escape_string($_POST['fname']);

$asrmApplctID=$mysqli->real_escape_string($_POST['asrmApplctID']);
	$country_id=$mysqli->real_escape_string($_POST['country_id']);
	$email=$mysqli->real_escape_string($_POST['email']);
	$phone=$mysqli->real_escape_string($_POST['phone']);

	
	$username = preg_replace('/\s+/', '', $usernamema);
	$institution=$mysqli->real_escape_string($_POST['institution']);
	$rstug_nin_passport=$mysqli->real_escape_string($_POST['rstug_nin_passport']);
	$rstug_district=$mysqli->real_escape_string($_POST['district']);
	$rstug_placeofbirth=$mysqli->real_escape_string($_POST['placeofbirth']);
	$idtype=$mysqli->real_escape_string($_POST['idtype']);
	$fname=$mysqli->real_escape_string($_POST['fname']);
$surname=$mysqli->real_escape_string($_POST['surname']);
$dbfirstname=$fname.' '.$surname;
$rstug_middle_name=$mysqli->real_escape_string($_POST['middle_name']);

$title=$mysqli->real_escape_string($_POST['title']);
if($title!="other"){$titleName=$mysqli->real_escape_string($_POST['title']);}
if($title=="other"){$titleName=$mysqli->real_escape_string($_POST['titleother']);}
///Get Rec Details
$sqlRecDetails="SELECT * FROM ".$prefix."list_country where `id`='$country_id'";
$QueryRecDetails = $mysqli->query($sqlRecDetails);
$sqRecDetails = $QueryRecDetails->fetch_array();
$Nationality=$sqRecDetails['name'];


$sqlA2="update ".$prefix."user set `country_id`='$country_id',`name`='$dbfirstname',`institution`='$institution',`rstug_first_name`='$fname',`rstug_middle_name`='$rstug_middle_name',`rstug_surname`='$surname',`rstug_nin_passport`='$rstug_nin_passport',`rstug_title`='$titleName',`rstug_placeofbirth`='$rstug_placeofbirth',`rstug_district`='$rstug_district',`phone`='$phone',`idtype`='$idtype' where asrmApplctID='$asrmApplctID'";
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

<li><a href="#" rel="#default" class="selected">My Profile</a></li>

<li><a href="./main.php?option=ChangeMyPassword">Change Password</a></li>
<li><a href="./main.php?option=ProfilePicture">Profile Picture</a></li>



</ul>

<div id="countrydivcontainer" style="border:0px solid gray; width:100%; margin-bottom: 1em; padding: 10px">

<?php

if(isset($message)){echo $message;}
?>

 <form id="regForm" method="post" action="" name="regForm" autocomplete="off" enctype="multipart/form-data">
    <div  class="logmain"> 
                  Required Fields marked (<span class="fontx">*</span>)
                  <hr>

      
      
       <div class="form-group row">
                          <label class="col-sm-2 form-control-label">First Name: <span class="error">*</span></label>
                          <div class="col-sm-10">
                            <input type="hidden" name="asrmApplctID" value="<?php echo $_SESSION['asrmApplctID'];?>">
                            
                            <input type="text" name="fname" class="form-control  required" value="<?php echo $rstudy['rstug_first_name'];?>" required>
                          </div>
                        </div>
                        <div class="line"></div>
                        
                         <div class="form-group row">
                          <label class="col-sm-2 form-control-label">Middle Name: </label>
                          <div class="col-sm-10">
                            <input type="text" name="middle_name" class="form-control" value="<?php echo $rstudy['rstug_middle_name'];?>">
                          </div>
                        </div>
                        <div class="line"></div>
                        
                        
                        <div class="form-group row">
                          <label class="col-sm-2 form-control-label">Last Name: <span class="error">*</span></label>
                          <div class="col-sm-10">
                            <input type="text" name="surname" class="form-control  required" value="<?php echo $rstudy['rstug_surname'];?>" required>
                          </div>
                        </div>
                        <div class="line"></div>
                        
                        
                        <div class="form-group row">
                          <label class="col-sm-2 form-control-label">Phone (Mobile): <span class="error">*</span></label>
                          <div class="col-sm-10">
                            <input type="text" name="phone" class="form-control  required" value="<?php echo $rstudy['phone'];?>" required>
                          </div>
                        </div>
                        <div class="line"></div>
                        
                        
                         <div class="form-group row">
                          <label class="col-sm-2 form-control-label">Title: <span class="error">*</span></label>
                          <div class="col-sm-10">
                           
                           <select name="title" class="form-control required" id="dropdown" tabindex="11" onChange="getStateTitle(this.value)">
              <option value="" selected></option>
              <option value="Prof." <?php if($rstudy['rstug_title']=='Prof.'){?>selected="selected"<?php }?>>Prof.</option>
              <option value="Dr." <?php if($rstudy['rstug_title']=='Dr.'){?>selected="selected"<?php }?>>Dr.</option>
              <option value="Ms." <?php if($rstudy['rstug_title']=='Ms.'){?>selected="selected"<?php }?>>Ms.</option>
              <option value="Mr." <?php if($rstudy['rstug_title']=='Mr.'){?>selected="selected"<?php }?>>Mr.</option>
              <option value="Rev." <?php if($rstudy['rstug_title']=='Rev.'){?>selected="selected"<?php }?>>Rev.</option>
              <option value="Sr." <?php if($rstudy['rstug_title']=='Sr.'){?>selected="selected"<?php }?>>Sr.</option>
              <option value="other" <?php if($rstudy['rstug_title']!='Prof.' || $rstudy['rstug_title']!='Dr.' || $rstudy['rstug_title']!='Ms.' || $rstudy['rstug_title']!='Rev.' || $rstudy['rstug_title']!='Sr.' and $rstudy['rstug_title']){?>selected="selected"<?php }?>>other</option>

              </select>
      <div id="tittleother"><?php if($rstudy['rstug_title']!='Prof.' || $rstudy['rstug_title']!='Dr.' || $rstudy['rstug_title']!='Ms.' || $rstudy['rstug_title']!='Rev.' || $rstudy['rstug_title']!='Sr.'){?><br /><strong><?php echo $rstudy['rstug_title'];?></strong><input type="hidden" name="titleother" id="titleother" tabindex="9" value="<?php echo $rstudy['rstug_title'];?>"/><?php }?></div>
      
                          </div>
                        </div>
                        <div class="line"></div>
                       
                       
                                   
                        
                                               <div class="form-group row">
                          <label class="col-sm-2 form-control-label">Nationality: <span class="error">*</span></label>
                          <div class="col-sm-10">
                            <select name="country_id" id="country_id" class="form-control required"  onChange="getStateB(this.value)">
<option value="800">Uganda</option>
<?php
$sqlCountrycv = "select * FROM ".$prefix."list_country order by name asc";//and conceptm_status='new' 
$resultCountrycv = $mysqli->query($sqlCountrycv);
while($rCountrycv=$resultCountrycv->fetch_array()){
?>
<option value="<?php echo $rCountrycv['id'];?>" <?php if($rCountrycv['id']==$rstudy['country_id']){?>selected="selected"<?php }?>><?php echo $rCountrycv['name'];?></option>
<?php }?>
</select>

 <div id="birth"><!--Begin Ajax-->

 
 <?php if($rstudy['country_id']==800){?>
 <div class="form-group row">
<label class="col-sm-2 form-control-label">Place of Birth  (eg Kampala, Uganda): <span class="error">*</span></label>
<div class="col-sm-10">
<input type="text" name="placeofbirth" id="boxno" tabindex="9" value="<?php echo $rstudy['rstug_placeofbirth'];?>" class="form-control required"/></div>
</div>
<div class="line"></div>

<div class="form-group row">
<label class="col-sm-2 form-control-label">District: <span class="error">*</span></label>
<div class="col-sm-10">
 <select name="district" id="country_id" tabindex="10" class="form-control required">
                <option value="" selected></option>
<?php
$qRMMDistricts="select * from ".$prefix."districts order by districtm_name asc";
$RDistricts = $mysqli->query($qRMMDistricts);
while($TMDistricts = $RDistricts->fetch_array()){ 
?>
                <option value="<?php echo $TMDistricts['districtm_id'];?>" <?php if($TMDistricts['districtm_id']==$rstudy['rstug_district']){?>selected="selected"<?php }?>><?php echo $TMDistricts['districtm_name'];?></option>
<?php }?>
                </select>
</div>
</div>
<div class="line"></div>

<div class="form-group row">
<label class="col-sm-2 form-control-label">National Id Number (NIN)/ Passport/ Driver's Permit:: <span class="error">*</span></label>
<div class="col-sm-10">
<input type="text" name="rstug_nin_passport" id="passportsss" tabindex="9" value="<?php echo $rstudy['rstug_nin_passport'];?>" class="form-control required"/><br />

National Id Number <input name="idtype" type="radio" value="National Id Number"  class="form-control required" <?php if($rstudy['idtype']=='National Id Number'){?>checked="checked"<?php }?>/> <br />
Passport <input name="idtype" type="radio" value="Passport"  class="form-control required" <?php if($rstudy['idtype']=='Passport'){?>checked="checked"<?php }?>/> <br />
Driver's Permit <input name="idtype" type="radio" value="Driver's Permit"  class="form-control required" <?php if($rstudy['idtype']=="Driver's Permit"){?>checked="checked"<?php }?>/> 
</div>
</div><?php }else{?>
  
 <div class="form-group row">
<label class="col-sm-2 form-control-label">Place of Birth  (eg state, province): <span class="error">*</span></label>
<div class="col-sm-10">
<input type="text" name="placeofbirth" id="boxno" tabindex="9" value="<?php echo $rstudy['rstug_user_placeofbirth'];?>" class="form-control required"/>
</div>
</div>
<div class="line"></div>


<div class="form-group row">
<label class="col-sm-2 form-control-label">Passport Number: <span class="error">*</span></label>
<div class="col-sm-10">
<label for="names"> <font color="#CC0000">*</font></label> <input type="text" name="rstug_nin_passport" id="passportsss" tabindex="9" value="<?php echo $rstudy['rstug_nin_passport'];?>" class="form-control required"/>
</div>
</div><?php }?>
 
 
 
 
 
 
 
 
 
 </div><!--End-->
 
 
 
 
 
                          </div>
                        </div>
                        <div class="line"></div>


  
 <div class="form-group row">
                          <div class="col-sm-4 offset-sm-3">
                    <input name="doCountry" type="submit"  class="btn btn-primary" value="Save"/>

                          </div>
                        </div>

</div>
                  </form>    
                                     


<script type="text/javascript">

var countries=new ddajaxtabs("countrytabs", "countrydivcontainer")
countries.setpersist(true)
countries.setselectedClassTarget("link") //"link" or "linkparent"
countries.init()

</script>