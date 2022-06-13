<ul id="countrytabs" class="shadetabs">
<li><a href="./main.php?option=submissionUpSecond&id=<?php echo $id;?>" style="text-decoration: none; position: relative;z-index: 1;padding: 3px 7px;
margin-right: 3px;border: 1px solid #778;color: #2d2b2b;background: white url(./ajaxtabs/shade.gif) top left repeat-x;">Protocol Details</a></li>

<li><a href="./main.php?option=submissionUpThird&id=<?php echo $id;?>" style="text-decoration: none; position: relative;z-index: 1;padding: 3px 7px;
margin-right: 3px;border: 1px solid #778;color: #2d2b2b;background: white url(./ajaxtabs/shade.gif) top left repeat-x;">Clinical Study</a></li>

<li><a href="./main.php?option=submissionUpFour&id=<?php echo $id;?>" style="text-decoration: none; position: relative;z-index: 1;padding: 3px 7px;
margin-right: 3px;border: 1px solid #778;color: #2d2b2b;background: white url(./ajaxtabs/shade.gif) top left repeat-x;">Additional Information</a></li>

<li><a href="./main.php?option=submissionUpBudget&id=<?php echo $id;?>" style="text-decoration: none; position: relative;z-index: 1;padding: 3px 7px;
margin-right: 3px;border: 1px solid #778;color: #2d2b2b;background: white url(./ajaxtabs/shade.gif) top left repeat-x;">Budget</a></li>

<li><a href="./main.php?option=submissionUpSchedule/<?php echo $id;?>" rel="#default" class="selected" >Study Work Plan</a></li>

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
$protocol_id=$rstudym['protocol_id'];
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
if($_POST['doSaveBudget']=='Save' and $_POST['description'] and $_POST['asrmApplctID'] and $_POST['init'] and $id){

	$description=$mysqli->real_escape_string($_POST['description']);
	$init=$mysqli->real_escape_string($_POST['init']);
	$sasrmApplctID=$mysqli->real_escape_string($_POST['asrmApplctID']);
	$protocol_id=$mysqli->real_escape_string($_POST['protocol_id']);
	$end=$mysqli->real_escape_string($_POST['end']);
	
	$startDate = date("Y-m-d", strtotime($init));
$endDate = date("Y-m-d", strtotime($end));
	
$sqlInvestigators="SELECT * FROM ".$prefix."submission_task where `owner_id`='$sasrmApplctID' and submission_id='$protocol_id' and description='$description' order by id desc";
	$QueryInvestigators = $mysqli->query($sqlInvestigators);
	$totalInvestigators = $QueryInvestigators->num_rows;
	
		if(!$totalInvestigators){
$sqlA2="insert into ".$prefix."submission_task (`owner_id`,`submission_id`,`created`,`updated`,`description`,`init`,`end`) 

values('$sasrmApplctID','$protocol_id',now(),now(),'$description','$startDate','$endDate')";
$mysqli->query($sqlA2);
		}
	
}


if($_POST['doSaveBudget']=='Save and Next'){

echo '<img src="images/loading_wait.gif">';
echo '<div class="spacer"></div>';
echo '<meta http-equiv="REFRESH" content="0;url='.$base_url.'/main.php?option=submissionupFive&id='.$id.'">';
	
}


?>
<?php
$sqlstudy="SELECT * FROM ".$prefix."submission_task where `owner_id`='$asrmApplctID' and submission_id='$protocol_id' order by id desc limit 0,1";
$Querystudy = $mysqli->query($sqlstudy);
$totalstudy = $Querystudy->num_rows;
$rstudy = $Querystudy->fetch_array();

if(isset($message)){echo $message;}
?>
 <h3>Study Work Plan: <span class="error">*</span></h3>   
                        
             <table class="table table-striped table-sm">
                        <thead>
                          <tr>
                            <th>Activity</th>
                  
                          </tr>
                        </thead>
                        <tbody>
                        <?php
//if no page var is given, set start to 0
$sql = "select *,DATE_FORMAT(`created`,'%d/%m/%Y %H:%s:%i') AS created FROM ".$prefix."submission_task where owner_id='$asrmApplctID' and submission_id='$id' order by id desc LIMIT 0,10";//and conceptm_status='new' 
$result = $mysqli->query($sql);
while($rInvestigator=$result->fetch_array()){
	?>
                          <tr>
                            <td><a href="./files/uploads/<?php echo $rInvestigator['description'];?>" style="font-weight:bold;" target="_blank"><?php echo $rInvestigator['description'];?></a></td>
                          
                          </tr>
   <?php }///////////end function ?>                 
                        </tbody>
                      </table>
   <!-- Trigger/Open The Modal -->
<button id="myBtn">Add New </button> 
  <div style="clear:both;"></div> 
   
   
<form action="" method="post" name="regForm" id="regForm" >
                        
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




<div class="form-group row" style="padding-left:10px; padding-right:10px;">
                          <label class="col-sm-6 form-control-label">Activity:</label>
                           <input name="description" id="description" type="text" class="form-control  required" required minlength="10"/> 
                            <input name="protocol_id" type="hidden" value="<?php echo $id;?>"/>
                            <input type="hidden" name="asrmApplctID" value="<?php echo $_SESSION['asrmApplctID'];?>">
                            <input type="hidden" name="submission_id" value="<?php echo $rstudy['id'];?>">
                       
                        </div>
                               
                        
                        

                        
                        <div class="line"></div>
                  
               
                         <div class="form-group row" style="padding-left:10px; padding-right:10px;">
                          <label class="col-sm-2 form-control-label">Start Date:</label>
                        <input type="date" name="init" id="init" class="form-control tcal required" value="">
                        </div>
                        <div class="line"></div>
                        
                        <div class="form-group row" style="padding-left:10px; padding-right:10px;">
                          <label class="col-sm-2 form-control-label">End Date:</label>
                        <input type="date" name="end" id="end" class="form-control tcal required" value="">
                        </div>
                        <div class="line"></div>

                         
                        
                        <div class="form-group row">
                          <div class="col-sm-4 offset-sm-3">
                    <input name="doSaveBudget" type="submit"  class="btn btn-primary" value="Save"/>

                          </div>
                        </div>
   
   </form>
   
    </div></div></div>
                                     
</div>






<script type="text/javascript">

var countries=new ddajaxtabs("countrytabs", "countrydivcontainer")
countries.setpersist(true)
countries.setselectedClassTarget("link") //"link" or "linkparent"
countries.init()

</script>