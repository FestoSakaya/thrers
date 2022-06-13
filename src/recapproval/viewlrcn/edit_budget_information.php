<ul id="countrytabs" class="shadetabs">
<li><a href="./main.php?option=submissionUpSecond&id=<?php echo $id;?>" style="text-decoration: none; position: relative;z-index: 1;padding: 3px 7px;
margin-right: 3px;border: 1px solid #778;color: #2d2b2b;background: white url(./ajaxtabs/shade.gif) top left repeat-x;">Protocol Details</a></li>

<li><a href="./main.php?option=submissionUpThird&id=<?php echo $id;?>" style="text-decoration: none; position: relative;z-index: 1;padding: 3px 7px;
margin-right: 3px;border: 1px solid #778;color: #2d2b2b;background: white url(./ajaxtabs/shade.gif) top left repeat-x;">Clinical Study</a></li>

<li><a href="./main.php?option=submissionUpFour&id=<?php echo $id;?>" style="text-decoration: none; position: relative;z-index: 1;padding: 3px 7px;
margin-right: 3px;border: 1px solid #778;color: #2d2b2b;background: white url(./ajaxtabs/shade.gif) top left repeat-x;">Additional Information</a></li>

<li><a href="./main.php?option=submissionUpBudget&id=<?php echo $id;?>" rel="#default" class="selected" >Budget</a></li>

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
                        <div role="progressbar" style="width: 45%; height: 6px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" class="progress-bar bg-red"></div>
                      </div>
     


                    </div>
                  </div>
                </div>
              </div>
              
              
  <?php
if($_POST['doCountry']=='Save' and $_POST['description'] and $_POST['asrmApplctID'] and $_POST['unit_cost'] and $id){

	$description=$mysqli->real_escape_string($_POST['description']);
	$quantity=$mysqli->real_escape_string($_POST['quantity']);
	$sasrmApplctID=$mysqli->real_escape_string($_POST['asrmApplctID']);
	$protocol_id=$mysqli->real_escape_string($_POST['protocol_id']);
	$unit_cost=$mysqli->real_escape_string($_POST['unit_cost']);
	
$sqlInvestigators="SELECT * FROM ".$prefix."submission_cost where `owner_id`='$sasrmApplctID' and submission_id='$protocol_id' and description='$description' order by id desc";
	$QueryInvestigators = $mysqli->query($sqlInvestigators);
	$totalInvestigators = $QueryInvestigators->num_rows;
	
		if(!$totalInvestigators){
$sqlA2="insert into ".$prefix."submission_cost (`owner_id`,`submission_id`,`created`,`updated`,`description`,`quantity`,`unit_cost`) 

values('$sasrmApplctID','$protocol_id',now(),now(),'$description','$quantity','$unit_cost')";
$mysqli->query($sqlA2);
		}
	
}?>
<?php
if($_POST['doSaveBudget']=='Save and Next' and $_POST['funding_source'] and $_POST['asrmApplctID'] and $id){

	$funding_source=$mysqli->real_escape_string($_POST['funding_source']);
	$primary_sponsor=$mysqli->real_escape_string($_POST['primary_sponsor']);
	$secondary_sponsor=$mysqli->real_escape_string($_POST['secondary_sponsor']);
	$submission_id=$mysqli->real_escape_string($_POST['submission_id']);
    $sasrmApplctID=$mysqli->real_escape_string($_POST['asrmApplctID']);
$sqlA2Protocol="update ".$prefix."submission  set `funding_source`='$funding_source',`primary_sponsor`='$primary_sponsor',`secondary_sponsor`='$secondary_sponsor' where id='$submission_id' and owner_id='$sasrmApplctID'";
$mysqli->query($sqlA2Protocol);

$message='<p class="success">Dear '.$session_fullname.', details have been submitted, proceed to continue</p>';
logaction("$session_fullname updated protocol");

echo '<img src="images/loading_wait.gif">';
echo '<div class="spacer"></div>';

echo '<meta http-equiv="REFRESH" content="0;url='.$base_url.'/main.php?option=submissionUpSchedule&id='.$id.'">';


}//end post

$sqlstudy="SELECT * FROM ".$prefix."submission where `owner_id`='$asrmApplctID' and id='$id' order by id desc limit 0,1";
$Querystudy = $mysqli->query($sqlstudy);
$totalstudy = $Querystudy->num_rows;
$rstudy = $Querystudy->fetch_array();
$protocol_id=$rstudy['protocol_id'];
if(isset($message)){echo $message;}
?>

<h3>Budget</h3>
  <table class="table table-striped table-sm">
                        <thead>
                          <tr>
                            <th>Cost description</th>
                            <th>Unit cost</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Created</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php
//if no page var is given, set start to 0
$sql = "select *,DATE_FORMAT(`created`,'%d/%m/%Y %H:%s:%i') AS created FROM ".$prefix."submission_cost where owner_id='$asrmApplctID' and submission_id='$protocol_id' order by id desc LIMIT 0,10";//and conceptm_status='new' 
$result = $mysqli->query($sql);
while($rInvestigator=$result->fetch_array()){
	?>
                          <tr>
                            <td><?php echo $rInvestigator['description'];?></td>
                            <td><?php echo $rInvestigator['quantity'];?></td>
                            <td><?php echo $rInvestigator['unit_cost'];?></td>
                            <td><?php echo number_format(round($rInvestigator['quantity']*$rInvestigator['unit_cost']),2);?></td>
                            <td><?php echo $rInvestigator['created'];?></td>
                          </tr>
   <?php }///////////end function ?>                 
                        </tbody>
                      </table>
   <!-- Trigger/Open The Modal -->
<button id="myBtn">Add New </button> 
  <div style="clear:both;"></div>  
<form action="" method="post" name="regForm" id="regForm" >

  


<div class="form-group row">
                          <label class="col-sm-6 form-control-label">Funding source:</label>
                         <textarea name="funding_source" id="funding_source" cols="" rows="5" class="form-control  required"><?php echo $rstudy['funding_source'];?></textarea>
                            
                            <input name="protocol_id" type="hidden" value="<?php echo $protocol_id;?>"/>
                            <input type="hidden" name="asrmApplctID" value="<?php echo $_SESSION['asrmApplctID'];?>">
                            <input type="hidden" name="submission_id" value="<?php echo $rstudy['id'];?>">
                       
                        </div>
                               
                        
                        

                        
                        <div class="line"></div>
                        
                          <div class="form-group row">
                          <label class="col-sm-2 form-control-label">Primary Sponsor:</label>
                          <textarea name="primary_sponsor" id="primary_sponsor" cols="" rows="5" class="form-control  required"><?php echo $rstudy['primary_sponsor'];?></textarea>
                        </div>
                        <div class="line"></div>
               
                        
                        
                        <div class="form-group row">
                          <label class="col-sm-2 form-control-label">Secondary Sponsor:</label>
                          <textarea name="secondary_sponsor" id="secondary_sponsor" cols="" rows="5" class="form-control  required"><?php echo $rstudy['secondary_sponsor'];?></textarea>
                        </div>
                        <div class="line"></div>

                         
                        
                        <div class="form-group row">
                          <div class="col-sm-4 offset-sm-3">
                    <input name="doSaveBudget" type="submit"  class="btn btn-primary" value="Save and Next"/>

                          </div>
                        </div>
   
   </form>
   


<!-- The Modal -->
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
      <span class="close">&times;</span>
      <h3><strong>New Clinical Trial Registry</strong></h3>
    </div>
    <div class="modal-body">

 <form action="" method="post" name="regForm" id="regForm" >
 

 <div class="form-group row">
 
<label class="col-sm-2 form-control-label">Description:</label>
<div class="col-sm-10">
<select name="description" id="description" class="form-control  required">
<option value="Personnel">Personnel</option>
<option value="Travel">Travel</option>
<option value="Materials and Supplies">Materials and Supplies</option>
<option value="Administration">Administration</option>
<option value="Results dissemination">Results dissemination</option>
<option value="Contingency">Contingency</option>
<option value="Other">Other</option>
</select>

<input name="protocol_id" type="hidden" value="<?php echo $protocol_id;?>"/>
<input type="hidden" name="asrmApplctID" value="<?php echo $_SESSION['asrmApplctID'];?>">
</div>
</div>
                        
  
  
   <div class="form-group row">
 
<label class="col-sm-2 form-control-label">Quantity:</label>
<div class="col-sm-10">
<input type="number" name="quantity" id="quantity" class="form-control  required" value="" required>
</div>
</div>  


 <div class="form-group row">
 
<label class="col-sm-2 form-control-label">Unit cost:</label>
<div class="col-sm-10">
<input type="number" name="unit_cost" id="unit_cost" class="form-control  required" value="" required>
</div>
</div>


              
                        
       
       <div class="form-group row">
                          <div class="col-sm-4 offset-sm-3">
                    <input name="doCountry" type="submit"  class="btn btn-primary" value="Save"/>

                          </div>
                        </div>
                                          
     </form>                   
    </div>
    </div>
    </div><!--End-->
    
    
    
    
    
    
    
    
    
    
<!-- The Modal -->
<div id="myModal2" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
      <span class="close">&times;</span>
      <h3><strong>New Clinical Trial Registry</strong></h3>
    </div>
    <div class="modal-body">

 <form action="" method="post" name="regForm" id="regForm" >
 
 <div class="form-group row" style="padding-top:10px;">
<label class="col-sm-2 form-control-label">Country:</label>
<div class="col-sm-10">
<select name="clinical_trial_name_id" id="clinical_trial_name_id" class="form-control  required">
<?php
$sqlClinicalcv = "select * FROM ".$prefix."list_clinical_trial_name order by name asc";//and conceptm_status='new' 
$resultClinicalcv = $mysqli->query($sqlClinicalcv);
while($rClinicalcv=$resultClinicalcv->fetch_array()){
?>
<option value="<?php echo $rClinicalcv['id'];?>"><?php echo $rClinicalcv['name'];?></option>
<?php }?>
</select>
</div>
</div> 



 <div class="form-group row">
 
<label class="col-sm-2 form-control-label">Number:</label>
<div class="col-sm-10">
<input type="text" name="number" id="number" class="form-control  required" value="">
<input name="protocol_id" type="hidden" value="<?php echo $id;?>"/>
<input type="hidden" name="asrmApplctID" value="<?php echo $_SESSION['asrmApplctID'];?>">
</div>
</div>
                        
                  
                        
       
       <div class="form-group row">
                          <div class="col-sm-4 offset-sm-3">
                    <input name="doCountry" type="submit"  class="btn btn-primary" value="Save"/>

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