<ul id="countrytabs" class="shadetabs">
<li><a href="#" rel="#default" class="selected">Apply for Annual Renewal - Part 1</a></li>
<li class="extra">Part 11</li>
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
if($_POST['doAmmendments']=='Submit'){

	$Changes=$mysqli->real_escape_string($_POST['Changes']);
	$submission_id=$mysqli->real_escape_string($_POST['submission_id']);
	$protocol_id=$mysqli->real_escape_string($_POST['protocol_id']);
	$asrmApplctID=$mysqli->real_escape_string($_POST['asrmApplctID']);
	
	
/*$sqlprotocalSubSel="SELECT * FROM ".$prefix."ammendments where protocol_id='$protocol_id' and owner_id='$sasrmApplctID'";
$QprotocalSub2Sel = $mysqli->query($sqlprotocalSubSel);
$totalstudy = $QprotocalSub2Sel->num_rows;
if(!$totalstudy){
	$sqlA2="insert into ".$prefix."ammendments (`owner_id`,`protocol_id`,`listchanges`,`TrachedChanges`,`CleanCopy`,`CoverLetter`,`created`,`status`) 

values('$asrmApplctID','$protocol_id','$Changes','$TrachedChanges2','$CleanCopy2','$CoverLetter2',now(),'Pending')";
$mysqli->query($sqlA2);
}*/


$message='<p class="success">Dear '.$session_fullname.', details have been submitted, proceed to continue</p>';
logaction("$session_fullname added Ammendments");

echo '<img src="images/loading_wait.gif">';
echo '<div class="spacer"></div>';
echo '<meta http-equiv="REFRESH" content="0;url='.$base_url.'/main.php?option=AnnualRenewalTwo&id='.$id.'">';


}//end post

$sqlstudy="SELECT * FROM ".$prefix."ammendments where `owner_id`='$asrmApplctID' and protocol_id='$id' order by id desc limit 0,1";
$Querystudy = $mysqli->query($sqlstudy);
$totalstudy = $Querystudy->num_rows;
$rstudy = $Querystudy->fetch_array();
if(isset($message)){echo $message;}
?>
   
   <div style="clear:both;"></div>
<form action="" method="post" name="regForm" id="regForm" >
                   
                        <div class="form-group row">
                          <label class="col-sm-4 form-control-label">Protocol version and date:</label>
                          <input type="text" name="Protocolversion" id="Protocolversion" class="form-control  required" value="<?php echo $rstudy['Protocolversion'];?>">
                        </div>
                        <div class="line"></div>
                        
                        
                         <div class="form-group row">
                          <label class="col-sm-4 form-control-label">Period covered by this report:</label>
                          <input type="text" name="Protocolversion" id="Protocolversion" class="form-control  required" value="">
                       
                            <input name="protocol_id" type="hidden" value="<?php echo $id;?>"/>
                            <input type="hidden" name="asrmApplctID" value="<?php echo $_SESSION['asrmApplctID'];?>">
                            <input type="hidden" name="submission_id" value="<?php echo $rstudy['id'];?>">
                       
                        </div>
                        <div class="line"></div>
                        <h3>Brief rationale for the Study</h3>
                          <div class="form-group row">
                          <label class="col-sm-6 form-control-label"><strong>General Research Objective</strong><br />
                          State the general objective/aim of the study.</label>
                        <textarea name="generalobjective" id="generalobjective" cols="" rows="5" class="form-control  required"></textarea>
                        </div>
                        <div class="line"></div>
                        
                        
                         <div class="form-group row">
                          <label class="col-sm-10 form-control-label"><strong>Study Methods :</strong><br />Brief description of the study design, study sites, study population, sample size, and study duration.</label>
                        <textarea name="StudyMethods" id="StudyMethods" cols="" rows="5" class="form-control  required"></textarea>
                        </div>
                        <div class="line"></div>
                   <p>Provide the  status of participant enrollment. </p>
<table border="1" cellspacing="0" cellpadding="0" width="100%">
  <tr>
    <td width="46" valign="top"><p>&nbsp;</p></td>
    <td width="244" valign="top"><p>&nbsp;Participants</p></td>
    <td width="185" valign="top"><p>&nbsp;Number</p></td>
    <td width="536" valign="top"><p>&nbsp;Remarks*</p></td>
  </tr>
  <tr>
    <td width="46" valign="top"><ol start="1" type="1">
      <li>&nbsp;</li>
    </ol></td>
    <td width="244" valign="top"><p>&nbsp;Approved sample size</p></td>
    <td width="185" valign="top"><input type="text" name="Approvedsamplesize" id="Approvedsamplesize" class="form-control  required" value=""></td>
    <td width="536" valign="top"><input type="text" name="Approvedsamplesizec" id="Approvedsamplesizec" class="form-control  required" value=""></td>
  </tr>
  <tr>
    <td width="46" valign="top"><ol start="2" type="1">
      <li>&nbsp;</li>
    </ol></td>
    <td width="244" valign="top"><p>&nbsp;Screened</p></td>
    <td width="185" valign="top"><input type="text" name="Screened" id="Screened" class="form-control  required" value=""></td>
    <td width="536" valign="top"><input type="text" name="Screenedc" id="Screenedc" class="form-control  required" value=""></td>
  </tr>
  <tr>
    <td width="46" valign="top"><ol start="3" type="1">
      <li>&nbsp;</li>
    </ol></td>
    <td width="244" valign="top"><p>&nbsp;Enrolled</p></td>
    <td width="185" valign="top"><input type="text" name="Enrolled" id="Enrolled" class="form-control  required" value=""></td>
    <td width="536" valign="top"><input type="text" name="Enrolledc" id="Enrolled" class="form-control  required" value=""></td>
  </tr>
  <tr>
    <td width="46" valign="top"><ol start="4" type="1">
      <li>&nbsp;</li>
    </ol></td>
    <td width="244" valign="top"><p>&nbsp;Withdrawn</p></td>
    <td width="185" valign="top"><input type="text" name="Withdrawn" id="Withdrawn" class="form-control  required" value=""></td>
    <td width="536" valign="top"><input type="text" name="Withdrawnc" id="Withdrawnc" class="form-control  required" value=""></td>
  </tr>
  <tr>
    <td width="46" valign="top"><ol start="5" type="1">
      <li>&nbsp;</li>
    </ol></td>
    <td width="244" valign="top"><p>&nbsp;Terminated</p></td>
    <td width="185" valign="top"><input type="text" name="Terminated" id="Terminated" class="form-control  required" value=""></td>
    <td width="536" valign="top"><input type="text" name="Terminatedc" id="Terminatedc" class="form-control  required" value=""></td>
  </tr>
  <tr>
    <td width="46" valign="top"><ol start="6" type="1">
      <li>&nbsp;</li>
    </ol></td>
    <td width="244" valign="top"><p>&nbsp;Lost to follow up</p></td>
    <td width="185" valign="top"><input type="text" name="Losttofollowup" id="Losttofollowup" class="form-control  required" value=""></td>
    <td width="536" valign="top"><input type="text" name="Losttofollowupc" id="Losttofollowupc" class="form-control  required" value=""></td>
  </tr>
  <tr>
    <td width="46" valign="top"><ol start="7" type="1">
      <li>&nbsp;</li>
    </ol></td>
    <td width="244" valign="top"><p>&nbsp;Died</p></td>
    <td width="185" valign="top"><input type="text" name="Died" id="Died" class="form-control  required" value=""></td>
    <td width="536" valign="top"><input type="text" name="Diedc" id="Diedc" class="form-control  required" value=""></td>
  </tr>
</table>
<p>*Give relevant  explanation where necessary</p>

                        
                        <div class="form-group row">
                          <div class="col-sm-4 offset-sm-3">
                    <input name="doAmmendments" type="submit"  class="btn btn-primary" value="Submit"/>

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