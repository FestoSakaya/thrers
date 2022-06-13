<ul id="countrytabs" class="shadetabs">
<li><a href="#">SAEs</a></li>

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
        


                    </div>
                  </div>
                </div>
              </div>

<?php

$sqlstudy="SELECT * FROM ".$prefix."saes where `owner_id`='$asrmApplctID' and id='$id' order by id desc limit 0,1";
$Querystudy = $mysqli->query($sqlstudy);
$totalstudy = $Querystudy->num_rows;
$rstudy = $Querystudy->fetch_array();
$main_submission_id=$rProjects['protocol_id'];

$sqlprotocol = "select * from ".$prefix."submission where id='$main_submission_id'";
$resultprotocol = $mysqli->query($sqlprotocol);
$sqprotocol = $resultprotocol->fetch_array();
if(isset($message)){echo $message;}
?>
   
   <div style="clear:both;"></div>
 <form action="" method="post" name="regForm" id="regForm" enctype="multipart/form-data">

  <div class="form-group row success">
<label class="col-sm-10 form-control-label">Select Protocol you are submitting to: <span class="error">*</span></label>
<div class="col-sm-10">

<?php 	if($rstudy['ammendType']=='manual'){
							echo $rstudy['public_title'];
							}
							if($rstudy['ammendType']=='online'){
							echo $sqprotocol['public_title'];
							}?>
</select>
</div>
</div>





 
 <div class="form-group row success">
<label class="col-sm-10 form-control-label">Date of Birth : <span class="error">*</span></label>
<div class="col-sm-10">
                          <?php
$shcategoryID4=$rstudy['date_of_birth'];
$categoryChunks = explode("-", $shcategoryID4);
$chop1="$categoryChunks[0]";
$chop2="$categoryChunks[1]";
$chop3="$categoryChunks[2]";
$currentMonth=date("m");
?>
<?php echo $chop3;?>/<?php echo $chop2;?>/<?php echo $chop1;?>
                    
</div>
  <div style="clear:both;"></div>
                        </div>
                        
                        
                        <div class="line"></div>
                        
                         <div class="form-group row success">
<label class="col-sm-10 form-control-label">Gender: <span class="error">*</span></label>
<div class="col-sm-10">
<?php echo $rstudy['gender'];?></div>

<div style="clear:both;"></div>
                        </div>
                        <div class="line"></div>
                        
                        
                         <div class="form-group row success">
                          <label class="col-sm-10 form-control-label">Article/Product beign studied <span class="error">*</span></label>
                          <div class="col-sm-10">
                      <?php echo $rstudy['ArticleBeignStudied'];?>
                         
                       </div>
                        </div>
                        <div class="line"></div>
                        
                        
                       
                        
                        
                         <div class="form-group row success">
                          <label class="col-sm-10 form-control-label">On set date : <span class="error">*</span></label>
                          
                          
                          
                          
                          
                          
                          
<div class="col-sm-10">
<?php
$shcategoryID5=$rstudy['OnSetDate'];
$categoryChunks = explode("-", $shcategoryID5);
$chop11="$categoryChunks[0]";
$chop22="$categoryChunks[1]";
$chop33="$categoryChunks[2]";
?>
<?php echo $chop33;?>/<?php echo $chop11;?>


   </div>               
         <div style="clear:both;"></div>              
                        </div>
                        
                        
                        <div class="line"></div>
                        
                           <div class="form-group row success">
                          <label class="col-sm-6 form-control-label">Article participant received (If Un Blinded) <span class="error">*</span></label>
  <div class="col-sm-10">
<?php echo $rstudy['ArticleParticipantReceived'];?>
  
  <p id="countermm">Characters limit: <span  id="countercol">250 words</span></p>
  </div>
  
                        </div>
                        <div class="line"></div>
                        
                        
                         <div class="form-group row success">
                         
                         <div class="col-sm-10">
                          <label class="col-sm-10 form-control-label">Route of administration <span class="error">*</span></label>
                     <?php echo $rstudy['RouteOfAdministration'];?>
                        
                        <p id="countermm">Characters limit: <span  id="countercol">250 words</span></p>
                        </div>
                        </div>
                        
           <?php
	$shcategoryImmmmm=$rstudy['EventResultedin'];
$categoryChunksmm = explode(".", $shcategoryImmmmm);

$chopmm1="$categoryChunksmm[0]";
$chopmm2="$categoryChunksmm[1]";
$chopmm3="$categoryChunksmm[2]";
$chopmm4="$categoryChunksmm[3]";
$chopmm5="$categoryChunksmm[4]";

?>             <div class="line"></div>
                        
                        
                        
                         <div class="form-group row success">
                          <label class="col-sm-10 form-control-label">Event resulted in <span class="error">*</span>:</label><br />
<label class="col-sm-10 form-control-label"><input name="EventResultedin[]" type="checkbox" value="Death"  <?php if($chopmm1=='Death' || $chopmm2=='Death' || $chopmm3=='Death' || $chopmm4=='Death' || $chopmm5=='Death'){?>checked="checked"<?php }?>/> Death:  Cause of death <input name="CauseOfDeath" type="text" value="<?php echo $rstudy['CauseOfDeath'];?>"/> <br />


 <input name="EventResultedin[]" type="checkbox" value="Threat To Life" <?php if($chopmm1=='Threat To Life' || $chopmm2=='Threat To Life' || $chopmm3=='Threat To Life' || $chopmm4=='Threat To Life' || $chopmm5=='Threat To Life'){?>checked="checked"<?php }?>/> Threat to life<br />
 
 
 <input name="EventResultedin[]" type="checkbox" value="Inpatient Or Prolonged Hospitalisation" <?php if($chopmm1=='Inpatient Or Prolonged Hospitalisation' || $chopmm2=='Inpatient Or Prolonged Hospitalisation' || $chopmm3=='Inpatient Or Prolonged Hospitalisation' || $chopmm4=='Inpatient Or Prolonged Hospitalisation' || $chopmm5=='Inpatient Or Prolonged Hospitalisation'){?>checked="checked"<?php }?>/> Inpatient or prolonged hospitalisation: Date of admission: <input name="DateOfAdmission" type="date" value="<?php echo $rstudy['DateOfAdmission'];?>"/><br />
 
 <input name="EventResultedin[]" type="checkbox" value="Severe Or Permanent Disability" <?php if($chopmm1=='Severe Or Permanent Disability' || $chopmm2=='Severe Or Permanent Disability' || $chopmm3=='Severe Or Permanent Disability' || $chopmm4=='Severe Or Permanent Disability' || $chopmm5=='Severe Or Permanent Disability'){?>checked="checked"<?php }?>/> Severe or permanent disability  <br />
 
 
  <input name="EventResultedin[]" type="checkbox" value="None Of The Above" <?php if($chopmm1=='None Of The Above' || $chopmm2=='None Of The Above' || $chopmm3=='None Of The Above' || $chopmm4=='None Of The Above' || $chopmm5=='None Of The Above'){?>checked="checked"<?php }?>/> None of the above     </label>                 
                        
                       
                        
                        </div>
                        <div class="line"></div>
                        
                        
                         <div class="form-group row success">
                          <label class="col-sm-10 form-control-label">Descripition of the event <span class="error">*</span></label>
                          
                          <div class="col-sm-10">
             <?php echo $rstudy['DescripitionOfTheEvent'];?>
                        <p id="countermm">Characters limit: <span  id="countercol">250 words</span></p>
                        
                        </div>
                        </div>
                        <div class="line"></div>
                        
                        
                         <div class="form-group row success">
                          <label class="col-sm-10 form-control-label">Treatment of event <span class="error">*</span></label>
                          
                          <div class="col-sm-10">
           <?php echo $rstudy['TreatmentOfEvent'];?>
                        
                        <p id="countermm">Characters limit: <span  id="countercol">250 words</span></p>
                        
                        </div>
                        </div>
                        
                        <div class="line"></div>
                        
                        
                         <div class="form-group row success">
                          <label class="col-sm-10 form-control-label">Concomitant medical problems and treatments <span class="error">*</span></label><div class="col-sm-10">
            <?php echo $rstudy['ConcomitantMedicalProblems'];?>
                        
                        <p id="countermm">Characters limit: <span  id="countercol">250 words</span></p>
                        </div>
                        </div>
                        <div class="line"></div>
                        
                        
                         <?php
	$shcategoryhhh=$rstudy['EventRelatedToStudy'];
$categoryChunkhh = explode(".", $shcategoryhhh);

$chophh1="$categoryChunkhh[0]";
$chophh2="$categoryChunkhh[1]";
$chophh3="$categoryChunkhh[2]";
$chophh4="$categoryChunkhh[3]";
$chophh5="$categoryChunkhh[4]";

?> 
                         <div class="form-group row success">
                          <label class="col-sm-10 form-control-label">Was the event related to this study article? <span class="error">*</span><br /><br />
                        <input name="EventRelatedToStudy" type="radio" value="Definitely" <?php if($chophh1=='Definitely' || $chophh2=='Definitely' || $chophh3=='Definitely' || $chophh4=='Definitely' || $chophh5=='Definitely'){?>checked="checked"<?php }?>/> Definitely<br />
                        
                         <input name="EventRelatedToStudy" type="radio" value="Probably" <?php if($chophh1=='Probably' || $chophh2=='Probably' || $chophh3=='Probably' || $chophh4=='Probably' || $chophh5=='Probably'){?>checked="checked"<?php }?>/> Probably<br />
                         
                          <input name="EventRelatedToStudy" type="radio" value="Possibly" <?php if($chophh1=='Possibly' || $chophh2=='Possibly' || $chophh3=='Possibly' || $chophh4=='Possibly' || $chophh5=='Possibly'){?>checked="checked"<?php }?>/> Possibly<br />
                          
                           <input name="EventRelatedToStudy" type="radio" value="Unlikely" <?php if($chophh1=='Unlikely' || $chophh2=='Unlikely' || $chophh3=='Unlikely' || $chophh4=='Unlikely' || $chophh5=='Unlikely'){?>checked="checked"<?php }?>/> Unlikely<br />
                           
                            <input name="EventRelatedToStudy" type="radio" value="Not Related" <?php if($chophh1=='Not Related' || $chophh2=='Not Related' || $chophh3=='Not Related' || $chophh4=='Not Related' || $chophh5=='Not Related'){?>checked="checked"<?php }?>/> Not Related<br /></label>
                        </div>
                        <div class="line"></div>
                        
                        
                        <div class="form-group row success">
                          <label class="col-sm-10 form-control-label">Did the event abate after stopping study article?  <span class="error">*</span>
                        <input name="EventAbateAfterStopping" type="radio" value="Yes" <?php if($rstudy['EventAbateAfterStopping']=='Yes'){?>checked="checked"<?php }?>/> Yes 
                        <input name="EventAbateAfterStopping" type="radio" value="No" <?php if($rstudy['EventAbateAfterStopping']=='No'){?>checked="checked"<?php }?> /> No</label>
                        </div>
                        <div class="line"></div>
                        
                        
                        <div class="form-group row success">
                          <label class="col-sm-10 form-control-label"> Out come <span class="error">*</span></label>
                          <div class="col-sm-10">
             <?php echo $rstudy['EventOutCome'];?>
                        
                        <p id="countermm">Characters limit: <span  id="countercol">250 words</span></p>
                        
                        </div>
                        </div>
                        <div class="line"></div>
                        
                        
                        <div class="form-group row success">
                        
                          <label class="col-sm-10 form-control-label">Describe the corrective action undertaken  <span class="error">*</span> </label>
                          <div class="col-sm-10">
                    <?php echo $rstudy['CorrectiveActionUndertaken'];?><br />
                        
                        <p id="countermm">Characters limit: <span  id="countercol">250 words</span></p>

<label class="col-sm-10 form-control-label">Attach Evidence of corrective action (PDF only) <span class="error">*</span><br />


<?php if($rstudy['AttachEvienceofcorrective']){?>

<a href="./files/uploads/<?php echo $rstudy['AttachEvienceofcorrective'];?>" target="_blank" style="font-weight:bold;">Click to view</a>
<?php }?>


  </label>
</div>
</div>
                        <div class="line"></div>
                        
                        
       
   
   </form>
                                     
</div>

<script type="text/javascript">

var countries=new ddajaxtabs("countrytabs", "countrydivcontainer")
countries.setpersist(true)
countries.setselectedClassTarget("link") //"link" or "linkparent"
countries.init()

</script>