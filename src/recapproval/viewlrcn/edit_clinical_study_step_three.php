<ul id="countrytabs" class="shadetabs">
<li><a href="./main.php?option=submissionUpSecond&id=<?php echo $id;?>" style="text-decoration: none; position: relative;z-index: 1;padding: 3px 7px;
margin-right: 3px;border: 1px solid #778;color: #2d2b2b;background: white url(./ajaxtabs/shade.gif) top left repeat-x;">Protocol Details</a></li>

<li><a href="./main.php?option=submissionUpThird&id=<?php echo $id;?>" rel="#default" class="selected">Clinical Study</a></li>

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
                     <!-- <div class="progress">
                        <div role="progressbar" style="width: 45%; height: 6px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" class="progress-bar bg-red"></div>
                      </div>-->
                      
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
if($_POST['doCountry']=='Save' and $_POST['countryid'] and $_POST['asrmApplctID'] and $_POST['participants'] and $id){

	$countryid=$mysqli->real_escape_string($_POST['countryid']);
	$district_id=$mysqli->real_escape_string($_POST['district_id']);
	$participants=$mysqli->real_escape_string($_POST['participants']);
	$sasrmApplctID=$mysqli->real_escape_string($_POST['asrmApplctID']);
	$protocol_id=$mysqli->real_escape_string($_POST['protocol_id']);
	
$sqlInvestigators="SELECT * FROM ".$prefix."submission_country where `owner_id`='$sasrmApplctID' and country_id='$countryid' and district_id='$district_id' and submission_id='$protocol_id' order by id desc";
	$QueryInvestigators = $mysqli->query($sqlInvestigators);
	$totalInvestigators = $QueryInvestigators->num_rows;
	
		if(!$totalInvestigators){
$sqlA2="insert into ".$prefix."submission_country (`owner_id`,`submission_id`,`country_id`,`district_id`,`created`,`updated`,`participants`) 

values('$sasrmApplctID','$protocol_id','$countryid','$district_id',now(),now(),'$participants')";
$mysqli->query($sqlA2);
		}
	
}?>
<?php
if($_POST['doSaveThree']=='Save and Next' and $_POST['study_design'] and $_POST['gender_id'] and $_POST['asrmApplctID'] and $id){

	$study_design=$mysqli->real_escape_string($_POST['study_design']);
	$health_condition=$mysqli->real_escape_string($_POST['health_condition']);
	$gender_id=$mysqli->real_escape_string($_POST['gender_id']);
	$sasrmApplctID=$mysqli->real_escape_string($_POST['asrmApplctID']);
	$sample_size=$mysqli->real_escape_string($_POST['sample_size']);
	$minimum_age=$mysqli->real_escape_string($_POST['minimum_age']);
	$submission_id=$mysqli->real_escape_string($_POST['submission_id']);
	
	$maximum_age=$mysqli->real_escape_string($_POST['maximum_age']);
	$inclusion_criteria=$mysqli->real_escape_string($_POST['inclusion_criteria']);
	$exclusion_criteria=$mysqli->real_escape_string($_POST['exclusion_criteria']);
	$recruitment_init_date=$mysqli->real_escape_string($_POST['recruitment_init_date']);
	$recruitment_status_id=$mysqli->real_escape_string($_POST['recruitment_status_id']);
	$interventions=$mysqli->real_escape_string($_POST['interventions']);
	$primary_outcome=$mysqli->real_escape_string($_POST['primary_outcome']);
	$secondary_outcome=$mysqli->real_escape_string($_POST['secondary_outcome']);
	$general_procedures=$mysqli->real_escape_string($_POST['general_procedures']);
	$analysis_plan=$mysqli->real_escape_string($_POST['analysis_plan']);
	$ethical_considerations=$mysqli->real_escape_string($_POST['ethical_considerations']);

$EstimatedRecruitmentDate=($_POST['year'].'-'.$_POST['month'].'-'.$_POST['date']);

$sqlA2Protocol="update ".$prefix."submission  set `gender_id`='$gender_id',`recruitment_status_id`='$recruitment_status_id',`study_design`='$study_design',`health_condition`='$health_condition',`sample_size`='$sample_size',`minimum_age`='$minimum_age',`maximum_age`='$maximum_age',`inclusion_criteria`='$inclusion_criteria',`exclusion_criteria`='$exclusion_criteria',`recruitment_init_date`='$recruitment_init_date',`interventions`='$interventions',`primary_outcome`='$primary_outcome',`secondary_outcome`='$secondary_outcome',`general_procedures`='$general_procedures',`analysis_plan`='$analysis_plan',`ethical_considerations`='$ethical_considerations',`EstimatedRecruitmentDate`='$EstimatedRecruitmentDate' where id='$submission_id' and owner_id='$sasrmApplctID'";
$mysqli->query($sqlA2Protocol);

$message='<p class="success">Dear '.$session_fullname.', details have been submitted, proceed to continue</p>';
logaction("$session_fullname updated protocol");

echo '<img src="images/loading_wait.gif">';
echo '<div class="spacer"></div>';
echo '<meta http-equiv="REFRESH" content="0;url='.$base_url.'/main.php?option=submissionUpFour&id='.$id.'">';


}//end post

$sqlstudy="SELECT * FROM ".$prefix."submission where `owner_id`='$asrmApplctID' and id='$id' order by id desc limit 0,1";
$Querystudy = $mysqli->query($sqlstudy);
$totalstudy = $Querystudy->num_rows;
$rstudy = $Querystudy->fetch_array();
$protocol_id=$rstudy['protocol_id'];
if(isset($message)){echo $message;}
?>



                        
                 <h3>Recruitment Recruitment Area(s):</h3>
 <table class="table table-striped table-sm">
                        <thead>
                          <tr>
                            <th>Country</th>
                            <th>District</th>
                            <th>County</th>
                            <th>Sub County</th>
                            <th>Parish</th>
                            <th>Total No of participants</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php
//if no page var is given, set start to 0
$sql = "select *,DATE_FORMAT(`created`,'%d/%m/%Y %H:%s:%i') AS created FROM ".$prefix."submission_country where submission_id='$id' order by id desc LIMIT 0,10";//and conceptm_status='new' 
$result = $mysqli->query($sql);
while($rInvestigator=$result->fetch_array()){
$countryid=$rInvestigator['country_id'];
$districtm_id=$rInvestigator['district_id'];
$Municipality=$rInvestigator['Municipality'];
$municipalitityID=$rInvestigator['Municipality'];

$sqlCountry = "select * FROM ".$prefix."list_country where id='$countryid' order by id desc";//and conceptm_status='new' 
$resultCountry = $mysqli->query($sqlCountry);
$rCountry=$resultCountry->fetch_array();

$sqlDistrict = "select * FROM ".$prefix."districts where districtm_id='$districtm_id'";//and conceptm_status='new' 
$resultDistrict = $mysqli->query($sqlDistrict);
$rDistrict=$resultDistrict->fetch_array();
////municipalities
$sqlmunicipalities = "select * FROM ".$prefix."municipalities where municipalitityID='$municipalitityID'";//and conceptm_status='new' 
$resultmunicipalities = $mysqli->query($sqlmunicipalities);
$rmunicipalities=$resultmunicipalities->fetch_array();
	?>
                          <tr>
                            <td><?php echo $rCountry['name'];?></td>
                            <td><?php echo $rDistrict['districtm_name'];?></td>
                            <td><?php echo $rmunicipalities['municipalitityName'];?></td>
                            <td><?php echo $rInvestigator['SubCounty'];?></td>
                            <td><?php echo $rInvestigator['Parish'];?></td>
                            <td><?php echo $rInvestigator['participants'];?></td>
                          </tr>
   <?php }///////////end function ?>                 
                        </tbody>
                      </table>
   <!-- Trigger/Open The Modal -->
<button id="myBtn">Add New </button>        
  <div style="clear:both;"></div>                      
                        
                        
                        
 <form action="" method="post" name="regForm" id="regForm" >                       
                        
                        
      
   <div style="clear:both;"></div>                   
                        <div class="form-group row">
                          <label class="col-sm-2 form-control-label">Study design:</label>
                          <textarea name="study_design" id="study_design" cols="" rows="5" class="form-control  required"><?php echo $rstudy['study_design'];?></textarea>
                        </div>
                        <div class="line"></div>
                        
                        
                         <div class="form-group row">
                          <label class="col-sm-6 form-control-label">Health Condition or Problem Studied:</label>
                         <textarea name="health_condition" id="health_condition" cols="" rows="5" class="form-control  required"><?php echo $rstudy['health_condition'];?></textarea>
                            
                            <input name="protocol_id" type="hidden" value="<?php echo $protocol_id;?>"/>
                            <input type="hidden" name="asrmApplctID" value="<?php echo $_SESSION['asrmApplctID'];?>">
                            <input type="hidden" name="submission_id" value="<?php echo $rstudy['id'];?>">
                       
                        </div>
                        
                 <table width="100%" border="0">
  <tr>
    <td width="21%" style="padding-right:15px;">Gender:
    <select name="gender_id" id="gender_id" class="form-control  required">
    <option value="">------</option>
<?php
$sqlGender = "select * FROM ".$prefix."list_gender order by name asc";//and conceptm_status='new' 
$resultGender = $mysqli->query($sqlGender);
while($rGender=$resultGender->fetch_array()){
?>
<option value="<?php echo $rGender['id'];?>" <?php if($rGender['id']==$rstudy['gender_id']){?>selected="selected"<?php }?>><?php echo $rGender['name'];?></option>
<?php }?>
</select>

    </td>
    <td width="26%" style="padding-right:15px;">Target sample size:
    <input type="text" name="sample_size" id="sample_size" class="form-control  required number" value="<?php echo $rstudy['sample_size'];?>">
</td>
    <td width="27%" style="padding-right:15px;">Minimum Age:
    <input type="text" name="minimum_age" id="minimum_age" class="form-control  required number" value="<?php echo $rstudy['minimum_age'];?>">
    </td>
    <td width="26%" style="padding-right:15px;">Maximum Age:
    <input type="text" name="maximum_age" id="maximum_age" class="form-control  required number" value="<?php echo $rstudy['maximum_age'];?>">
    </td>
  </tr>
</table>
       
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        <div class="line"></div>
                        
                          <div class="form-group row">
                          <label class="col-sm-2 form-control-label">Inclusion criteria:</label>
                          <textarea name="inclusion_criteria" id="inclusion_criteria" cols="" rows="5" class="form-control  required"><?php echo $rstudy['inclusion_criteria'];?></textarea>
                        </div>
                        <div class="line"></div>
                        
                        
                         <div class="form-group row">
                          <label class="col-sm-2 form-control-label">Exclusion criteria:</label>
                          <textarea name="exclusion_criteria" id="exclusion_criteria" cols="" rows="5" class="form-control  required"><?php echo $rstudy['exclusion_criteria'];?></textarea>
                        </div>
                        <div class="line"></div>
                        
  <div class="form-group row">
                          <label class="col-sm-7 form-control-label">Estimated date of initial recruitment:</label>

<?php
   $shcategoryID4=$rstudy['EstimatedRecruitmentDate'];
$categoryChunks = explode("-", $shcategoryID4);
$chop1="$categoryChunks[0]";
$chop2="$categoryChunks[1]";
$chop3="$categoryChunks[2]";

?>
<select name="date" id="ddate" class="form-control  required" tabindex="6" style=" width:100px; float:left;">
    <option value="">Date</option>
    <option value="01" <?php if($chop3=='01'){?> selected="selected"<?php }?>>&nbsp;01</option>
   <option value="02" <?php if($chop3=='02'){?> selected="selected"<?php }?>>&nbsp;02</option>
   <option value="03" <?php if($chop3=='03'){?> selected="selected"<?php }?>>&nbsp;03</option>
   <option value="04" <?php if($chop3=='04'){?> selected="selected"<?php }?>>&nbsp;04</option>
   <option value="05" <?php if($chop3=='05'){?> selected="selected"<?php }?>>&nbsp;05</option>
   <option value="06" <?php if($chop3=='06'){?> selected="selected"<?php }?>>&nbsp;06</option>
   <option value="07" <?php if($chop3=='07'){?> selected="selected"<?php }?>>&nbsp;07</option>
   <option value="08" <?php if($chop3=='08'){?> selected="selected"<?php }?>>&nbsp;08</option>
   <option value="09" <?php if($chop3=='09'){?> selected="selected"<?php }?>>&nbsp;09</option>
   <option value="10" <?php if($chop3=='10'){?> selected="selected"<?php }?>>&nbsp;10</option>
   <option value="11" <?php if($chop3=='11'){?> selected="selected"<?php }?>>&nbsp;11</option>
   <option value="12" <?php if($chop3=='12'){?> selected="selected"<?php }?>>&nbsp;12</option>
   <option value="13" <?php if($chop3=='13'){?> selected="selected"<?php }?>>&nbsp;13</option>
   <option value="14" <?php if($chop3=='14'){?> selected="selected"<?php }?>>&nbsp;14</option>
   <option value="15" <?php if($chop3=='15'){?> selected="selected"<?php }?>>&nbsp;15</option>
   <option value="16" <?php if($chop3=='16'){?> selected="selected"<?php }?>>&nbsp;16</option>
   <option value="17" <?php if($chop3=='17'){?> selected="selected"<?php }?>>&nbsp;17</option>
   <option value="18" <?php if($chop3=='18'){?> selected="selected"<?php }?>>&nbsp;18</option>
   <option value="19" <?php if($chop3=='19'){?> selected="selected"<?php }?>>&nbsp;19</option>
   <option value="20" <?php if($chop3=='20'){?> selected="selected"<?php }?>>&nbsp;20</option>
   <option value="21" <?php if($chop3=='21'){?> selected="selected"<?php }?>>&nbsp;21</option>
   <option value="22" <?php if($chop3=='22'){?> selected="selected"<?php }?>>&nbsp;22</option>
   <option value="23" <?php if($chop3=='23'){?> selected="selected"<?php }?>>&nbsp;23</option>
   <option value="24" <?php if($chop3=='24'){?> selected="selected"<?php }?>>&nbsp;24</option>
   <option value="25" <?php if($chop3=='25'){?> selected="selected"<?php }?>>&nbsp;25</option>
   <option value="26" <?php if($chop3=='26'){?> selected="selected"<?php }?>>&nbsp;26</option>
   <option value="27" <?php if($chop3=='27'){?> selected="selected"<?php }?>>&nbsp;27</option>
   <option value="28" <?php if($chop3=='28'){?> selected="selected"<?php }?>>&nbsp;28</option>
   <option value="29" <?php if($chop3=='29'){?> selected="selected"<?php }?>>&nbsp;29</option>
   <option value="30" <?php if($chop3=='30'){?> selected="selected"<?php }?>>&nbsp;30</option>
   <option value="31" <?php if($chop3=='31'){?> selected="selected"<?php }?>>&nbsp;31</option>
  </select>
                         
                           
    <select name="month" id="dmonth" class="form-control  required" tabindex="7" style=" width:200px; float:left;">
    <option value="">&nbsp;Month</option>
    <option value="01" <?php if($chop2=='01'){?> selected="selected"<?php }?>>&nbsp;January</option>
    <option value="02" <?php if($chop2=='02'){?> selected="selected"<?php }?>>&nbsp;Feabruary</option>
   <option value="03" <?php if($chop2=='03'){?> selected="selected"<?php }?>>&nbsp;March</option>
   <option value="04" <?php if($chop2=='04'){?> selected="selected"<?php }?>>&nbsp;April</option>
   <option value="05" <?php if($chop2=='05'){?> selected="selected"<?php }?>>&nbsp;May</option>
   <option value="06" <?php if($chop2=='06'){?> selected="selected"<?php }?>>&nbsp;June</option>
   <option value="07" <?php if($chop2=='07'){?> selected="selected"<?php }?>>&nbsp;July</option>
   <option value="08" <?php if($chop2=='08'){?> selected="selected"<?php }?>>&nbsp;August</option>
   <option value="09" <?php if($chop2=='09'){?> selected="selected"<?php }?>>&nbsp;September</option>
   <option value="10" <?php if($chop2=='10'){?> selected="selected"<?php }?>>&nbsp;October</option>
   <option value="11" <?php if($chop2=='11'){?> selected="selected"<?php }?>>&nbsp;November</option>
   <option value="12" <?php if($chop2=='12'){?> selected="selected"<?php }?>>&nbsp;December</option>
  </select>
                              
    <select name="year" id="dyear" class="form-control  required" tabindex=8"" style=" width:100px; float:left;">
<option value="">Year</option>
<?php
define('DOB_YEAR_START', 2019);

$current_year = date('Y')+1;

for ($count = $current_year; $count >= DOB_YEAR_START; $count--)
{
?>
    <option value="<?php echo $count;?>" <?php if($chop1==$count){?> selected="selected"<?php }?>><?php echo $count;?></option>
<?php }?>

  </select>





                        </div>

                        
                        
                       
                        <div class="line"></div>
                        
         
                        
                        
                        
                     <div class="form-group row">
                          <label class="col-sm-4 form-control-label">Interventions:</label>
                          <textarea name="interventions" id="interventions" cols="" rows="5" class="form-control  required"><?php echo $rstudy['interventions'];?></textarea>
                        </div>
                        <div class="line"></div>   
                        
                        
                        <div class="form-group row">
                          <label class="col-sm-4 form-control-label">Primary outcomes:</label>
                          <textarea name="primary_outcome" id="primary_outcome" cols="" rows="5" class="form-control  required"><?php echo $rstudy['primary_outcome'];?></textarea>
                        </div>
                        <div class="line"></div>   
                        
                        
                         <div class="form-group row">
                          <label class="col-sm-4 form-control-label">Secondary outcomes:</label>
                          <textarea name="secondary_outcome" id="secondary_outcome" cols="" rows="5" class="form-control  required"><?php echo $rstudy['secondary_outcome'];?></textarea>
                        </div>
                        <div class="line"></div> 
                        
                        <?php
$sqlmethodology="SELECT * FROM ".$prefix."clinical_study_methodology where `owner_id`='$owner_id' and protocol_id='$protocol_idwe' order by id desc limit 0,1";
$Querymethodology = $mysqli->query($sqlmethodology);
$rstudymethodology = $Querymethodology->fetch_array();
?> 
                        
                        <h2>Methodology</h2>
                        <div class="form-group row">
                          <label class="col-sm-4 form-control-label">General Procedures:</label>
                          <textarea name="general_procedures" id="general_procedures" cols="" rows="5" class="form-control  required"><?php echo $rstudymethodology['general_procedures'];?></textarea>
                        </div>
                        <div class="line"></div> 
                        
                        <div class="form-group row">
                          <label class="col-sm-4 form-control-label">Analysis Plan:</label>
                          <textarea name="analysis_plan" id="analysis_plan" cols="" rows="5" class="form-control  required"><?php echo $rstudymethodology['analysis_plan'];?></textarea>
                        </div>
                        <div class="line"></div> 
                        
                            <div class="form-group row">
                          <label class="col-sm-4 form-control-label">Ethical Considerations:</label>
                          <textarea name="ethical_considerations" id="ethical_considerations" cols="" rows="5" class="form-control  required"><?php echo $rstudymethodology['ethical_considerations'];?></textarea>
                        </div>
                        <div class="line"></div> 
                        
                        
                        
                         
                        
                        <div class="form-group row">
                          <div class="col-sm-4 offset-sm-3">
                    <input name="doSaveThree" type="submit"  class="btn btn-primary" value="Save and Next"/>

                          </div>
                        </div>
   
   </form>
   



<!-- The Modal -->
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
      <span class="close">&times;</span>
      <h3><strong>New Country</strong></h3>
    </div>
    <div class="modal-body">

 <form action="" method="post" name="regForm" id="regForm" >
 
 <div class="form-group row" style="padding-top:10px;">
<label class="col-sm-2 form-control-label">Country:</label>
<div class="col-sm-10">
<select name="countryid" id="countryid" class="form-control  required" required>
<option value="">Please Select Country</option>
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


<div class="form-group row">
<label class="col-sm-2 form-control-label">District:</label>
<div class="col-sm-10">
<select name="district_id" id="district_id" class="form-control  required" required>
<?php
$sqlDistrictv = "select * FROM ".$prefix."list_districts order by name asc";//and conceptm_status='new' 
$resultDistrictcv = $mysqli->query($sqlDistrictv);
while($rDistrictcv=$resultDistrictcv->fetch_array()){
?>
<option value="<?php echo $rDistrictcv['id'];?>"><?php echo $rDistrictcv['name'];?></option>
<?php }?>
</select>
</div>
</div>


 <div class="form-group row">
 
<label class="col-sm-2 form-control-label">Perticipants:</label>
<div class="col-sm-10">
<input type="number" name="participants" id="participants" class="form-control  required" value="" required>
<input name="protocol_id" type="hidden" value="<?php echo $protocol_id;?>"/>
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