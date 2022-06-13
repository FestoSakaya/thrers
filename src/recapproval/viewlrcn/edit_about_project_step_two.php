
<ul id="countrytabs" class="shadetabs">
<li><a href="./main.php?option=submissionUpSecond&id=<?php echo $id;?>" rel="#default" class="selected">Protocol Details</a></li>

<li><a href="./main.php?option=submissionUpThird&id=<?php echo $id;?>" style="text-decoration: none; position: relative;z-index: 1;padding: 3px 7px;
margin-right: 3px;border: 1px solid #778;color: #2d2b2b;background: white url(./ajaxtabs/shade.gif) top left repeat-x;">Clinical Study</a></li>

<li><a href="./main.php?option=submissionUpFour&id=<?php echo $id;?>" style="text-decoration: none; position: relative;z-index: 1;padding: 3px 7px;
margin-right: 3px;border: 1px solid #778;color: #2d2b2b;background: white url(./ajaxtabs/shade.gif) top left repeat-x;">Additional Information</a></li>

<li><a href="./main.php?option=submissionUpBudget&id=<?php echo $id;?>" style="text-decoration: none; position: relative;z-index: 1;padding: 3px 7px;
margin-right: 3px;border: 1px solid #778;color: #2d2b2b;background: white url(./ajaxtabs/shade.gif) top left repeat-x;">Budget</a></li>

<li><a href="./main.php?option=submissionUpSchedule&id=<?php echo $id;?>" style="text-decoration: none; position: relative;z-index: 1;padding: 3px 7px;
margin-right: 3px;border: 1px solid #778;color: #2d2b2b;background: white url(./ajaxtabs/shade.gif) top left repeat-x;">Study Work Plan</a></li>

<li><a href="./main.php?option=submissionupFive&id=<?php echo $id;?>" style="text-decoration: none; position: relative;z-index: 1;padding: 3px 7px;
margin-right: 3px;border: 1px solid #778;color: #2d2b2b;background: white url(./ajaxtabs/shade.gif) top left repeat-x;">Bibliography</a></li>

<li><a href="./main.php?option=submissionUpSix&id=<?php echo $id;?>" style="text-decoration: none; position: relative;z-index: 1;padding: 3px 7px;
margin-right: 3px;border: 1px solid #778;color: #2d2b2b;background: white url(./ajaxtabs/shade.gif) top left repeat-x;">Attached Files</a></li>

<li><a href="./main.php?option=submissionupFinish&id=<?php echo $id;?>" style="text-decoration: none; position: relative;z-index: 1;padding: 3px 7px;
margin-right: 3px;border: 1px solid #778;color: #2d2b2b;background: white url(./ajaxtabs/shade.gif) top left repeat-x;">Payments</a></li>
</ul>

<div id="countrydivcontainer" style="border:0px solid gray; width:100%; margin-bottom: 1em; padding: 10px">
<?php
$sqlstudym="SELECT * FROM ".$prefix."submission where `owner_id`='$asrmApplctID' and id='$id' order by id desc limit 0,1";
$Querystudym = $mysqli->query($sqlstudym);
$rstudym = $Querystudym->fetch_array();
$owner_id=$rstudym['owner_id'];

$sqlSRR = "select * from ".$prefix."user where asrmApplctID='$asrmApplctID'";
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
                     
                     
                     <div class="progress">
  <div class="progress-bar progress-bar-striped active" role="progressbar"
  aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:100%">
    100% Complete
  </div>
</div> 


                    </div>
                  </div>
                </div>
              </div>
 <?php
if($_POST['doTeam']=='Save' and $_POST['investigator'] and $_POST['asrmApplctID'] and $_POST['email'] and $id){

	$investigator=$mysqli->real_escape_string($_POST['investigator']);
	$institution=$mysqli->real_escape_string($_POST['institution']);
	$email=$mysqli->real_escape_string($_POST['email']);
	$sasrmApplctID=$mysqli->real_escape_string($_POST['asrmApplctID']);
	$countryid=$mysqli->real_escape_string($_POST['countryid']);
	$protocol_id=$mysqli->real_escape_string($_POST['protocol_id']);
	
	$sqlInvestigators="SELECT * FROM ".$prefix."team where `owner_id`='$sasrmApplctID' and name='$investigator' and protocol_id='$protocol_id' order by id desc";
	$QueryInvestigators = $mysqli->query($sqlInvestigators);
	$totalInvestigators = $QueryInvestigators->num_rows;
	
		if(!$totalInvestigators){
$sqlA2="insert into ".$prefix."team (`owner_id`,`protocol_id`,`name`,`institution`,`email`,`created`,`countryid`) 

values('$sasrmApplctID','$protocol_id','$investigator','$institution','$email',now(),'$countryid')";
$mysqli->query($sqlA2);
		}
	
}?>
<?php
if($_POST['doSaveSecond']=='Save and Next' and $_POST['abstract'] and $_POST['justification'] and $_POST['asrmApplctID'] and $id){

	$abstract=$mysqli->real_escape_string($_POST['abstract']);
	$keywords=$mysqli->real_escape_string($_POST['keywords']);
	$introduction=$mysqli->real_escape_string($_POST['introduction']);
	$sasrmApplctID=$mysqli->real_escape_string($_POST['asrmApplctID']);
	$justification=$mysqli->real_escape_string($_POST['justification']);
	$goals=$mysqli->real_escape_string($_POST['goals']);
	$submission_id=$mysqli->real_escape_string($_POST['submission_id']);

$sqlA2Protocol="update ".$prefix."submission  set `abstract`='$abstract',`keywords`='$keywords',`introduction`='$introduction',`justification`='$justification',`goals`='$goals' where id='$submission_id' and owner_id='$sasrmApplctID'";
$mysqli->query($sqlA2Protocol);

$message='<p class="success">Dear '.$session_fullname.', details have been submitted, proceed to continue</p>';
logaction("$session_fullname updated protocol");

echo '<img src="images/loading_wait.gif">';
echo '<div class="spacer"></div>';
echo '<meta http-equiv="REFRESH" content="0;url='.$base_url.'/main.php?option=submissionUpThird&id='.$id.'">';


}//end post

$sqlstudy="SELECT * FROM ".$prefix."submission where `owner_id`='$asrmApplctID' and id='$id' order by id desc limit 0,1";
$Querystudy = $mysqli->query($sqlstudy);
$totalstudy = $Querystudy->num_rows;
$rstudy = $Querystudy->fetch_array();
$protocol_id=$rstudy['protocol_id'];
if(isset($message)){echo $message;}
?>
<h3>Team</h3>
 <table class="table table-striped table-sm">
                        <thead>
                          <tr>
                            <th>Name</th>
                            <th>Institution</th>
                            <th>Email</th>
                            <th>Country</th>
                       <!--     <th>Actions</th>-->
                          </tr>
                        </thead>
                        <tbody>
                        <?php
//if no page var is given, set start to 0
$sql = "select *,DATE_FORMAT(`created`,'%d/%m/%Y %H:%s:%i') AS created FROM ".$prefix."team where owner_id='$asrmApplctID' and protocol_id='$protocol_id' order by id desc LIMIT 0,10";//and conceptm_status='new' 
$result = $mysqli->query($sql);
while($rInvestigator=$result->fetch_array()){
$countryid=$rInvestigator['countryid'];
$sqlCountry = "select * FROM ".$prefix."list_country where id='$countryid' order by id desc";//and conceptm_status='new' 
$resultCountry = $mysqli->query($sqlCountry);
$rCountry=$resultCountry->fetch_array();
	?>
                          <tr>
                            <td><h3 class="h4"><?php echo $rInvestigator['name'];?></h3></td>
                            <td><?php echo $rInvestigator['institution'];?></td>
                            <td><?php echo $rInvestigator['email'];?></td>
                            <td><?php echo $rCountry['name'];?></td>
                            <!--<td> <button id="myBtn">Remove</button>
                            </td>-->
                          </tr>
   <?php }///////////end function ?>                 
                        </tbody>
                      </table>
   <!-- Trigger/Open The Modal -->
<button id="myBtn">Add New Investigator </button>       
   <div style="clear:both;"></div>  
<form action="" method="post" name="regForm" id="regForm" >
                 
                        <div class="form-group row">
                          <label class="col-sm-2 form-control-label">Summary:</label>
                          <textarea name="abstract" id="abstract" cols="" rows="5" class="form-control  required"><?php echo $rstudy['abstract'];?></textarea>
                        </div>
                        <div class="line"></div>
                        
                        
                         <div class="form-group row">
                          <label class="col-sm-2 form-control-label">Keywords:</label>
                         
                            <input type="text" name="keywords" id="keywords" class="form-control  required" value="<?php echo $rstudy['keywords'];?>">
                            <input name="protocol_id" type="hidden" value="<?php echo $protocol_id;?>"/>
                            <input type="hidden" name="asrmApplctID" value="<?php echo $_SESSION['asrmApplctID'];?>">
                            <input type="hidden" name="submission_id" value="<?php echo $rstudy['id'];?>">
                       
                        </div>
                        <div class="line"></div>
                        
                          <div class="form-group row">
                          <label class="col-sm-2 form-control-label">Introduction:</label>
                          <textarea name="introduction" id="introduction" cols="" rows="5" class="form-control  required"><?php echo $rstudy['introduction'];?></textarea>
                        </div>
                        <div class="line"></div>
                        
                        
                         <div class="form-group row">
                          <label class="col-sm-2 form-control-label">Justification:</label>
                          <textarea name="justification" id="justification" cols="" rows="5" class="form-control  required"><?php echo $rstudy['justification'];?></textarea>
                        </div>
                        <div class="line"></div>
                        
             
             <div class="form-group row">
                          <label class="col-sm-4 form-control-label">Objectives:</label>
                          <textarea name="goals" id="goals" cols="" rows="5" class="form-control  required"><?php echo $rstudy['goals'];?></textarea>
                        </div>
                        <div class="line"></div>
                        
                        <div class="form-group row">
                          <div class="col-sm-4 offset-sm-3">
                    <input name="doSaveSecond" type="submit"  class="btn btn-primary" value="Save and Next"/>

                          </div>
                        </div>
   
   </form>
   

<!-- The Modal -->
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
      <span class="close">&times;</span>
      <h3><strong>Add new Investigator to the Team</strong></h3>
    </div>
    <div class="modal-body">

 <form action="" method="post" name="regForm" id="regForm" >
 <div class="form-group row" style="padding-top:10px;">
<label class="col-sm-2 form-control-label">Name:</label>
<div class="col-sm-10">
<input type="text" name="investigator" id="investigator" class="form-control  required" value="" required>
<input name="protocol_id" type="hidden" value="<?php echo $protocol_id;?>"/>
</div>
</div>
                        
                        
   <div class="form-group row">
<label class="col-sm-2 form-control-label">Institution:</label>
<div class="col-sm-10">
<input type="text" name="institution" id="institution" class="form-control  required" value="" required minlength="10">
<input type="hidden" name="asrmApplctID" value="<?php echo $_SESSION['asrmApplctID'];?>">
</div>
</div>                      
 
   <div class="form-group row">
<label class="col-sm-2 form-control-label">Email:</label>
<div class="col-sm-10">
<input type="email" name="email" id="email" class="form-control  required email" value="" required>
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
                          <div class="col-sm-4 offset-sm-3">
                    <input name="doTeam" type="submit"  class="btn btn-primary" value="Save"/>

                          </div>
                        </div>
                                          
     </form>                   
    </div>
    </div>
    </div>
                                     
</div>

<script type="text/javascript">

var countries=new ddajaxtabs("countrytabs", "countrydivcontainer")
countries.setpersist(true)
countries.setselectedClassTarget("link") //"link" or "linkparent"
countries.init()

</script>