<ul id="countrytabs" class="shadetabs">
<li><a href="#" rel="#default" class="selected">Ammendments View Submission</a></li>
</ul>

<div id="countrydivcontainer" style="border:0px solid gray; width:100%; margin-bottom: 1em; padding: 10px">
<?php
$sqlstudym="SELECT * FROM ".$prefix."ammendments where id='$id' order by id desc limit 0,1";
$Querystudym = $mysqli->query($sqlstudym);
$rstudym = $Querystudym->fetch_array();
$owner_id=$rstudym['owner_id'];
$code=$rstudym['code'];
$protocol_idwe=$rstudym['protocol_id'];
$renewal_id=$rstudym['id'];


if($rstudym['ammendType']=='online'){
$sqlprotocalSubSel="SELECT * FROM ".$prefix."submission where id='$protocol_idwe'";
$QprotocalSub2Sel = $mysqli->query($sqlprotocalSubSel);
$rprotocalSub2Sel = $QprotocalSub2Sel->fetch_array();

$public_title=$rprotocalSub2Sel['public_title'];
}

if($rstudym['ammendType']=='manual'){
$public_title=$rstudym['protocol_title'];	
}

$sqlSRR = "select * from ".$prefix."user where asrmApplctID='$owner_id'";
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
                        <h3 class="h4">Protocal Title</h3><small><?php echo $rprotocalSub2Sel['public_title'];?></small>
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
              
                                
</div>

  <?php
$sqlstudy="SELECT * FROM ".$prefix."ammendments_documents where `owner_id`='$owner_id' and amendment_id='$id' order by id desc";
$Querystudy = $mysqli->query($sqlstudy);//assignedto='Not Assigned' and
$totalstudy = $Querystudy->num_rows;

?> 
<button class="accordion">Ammendments, click to review</button>
  <div class="panel">
 
<table class="table table-striped table-sm" id="customers">
                  <thead>
                          <tr>
                          <th>Protocol</th>
                            <th>Type</th>
                            <th>Language</th>
                            <th>Version</th>
                            <th>Date</th>

                          </tr>
                        </thead>
                        <tbody>
            <?php while($rstudy = $Querystudy->fetch_array()){
				$protocol_id=$rstudy['protocol_id'];
				
if($rstudym['ammendType']=='online'){
$wmSubmissions="select * from ".$prefix."submission where  `id`='$protocol_id'";
$cmdwbSubmissions = $mysqli->query($wmSubmissions);
$rSubmissions= $cmdwbSubmissions->fetch_array();
}

if($rstudym['ammendType']=='manual'){
$public_title=$rstudym['protocol_title'];
}
				
				?>
                          <tr>
                          <td><?php echo $public_title;?></td>
                          
                            <td><?php if($rstudy['fileAttachment']){?><a href="./files/uploads/<?php echo $rstudy['fileAttachment'];?>" target="_blank" style="color:#06F;"><?php echo $rstudy['atype'];?></a><?php }?></td>
                            
                            <td><?php echo $rstudy['aLanguage'];?></td>
                            <td><?php echo $rstudy['aVersion'];?></td>
                            <td><?php echo $rstudy['aDate'];?></td>
                            </tr>
               
               <?php }?>
                        </tbody>
                      </table>
  </div>
  
  
<button class="accordion">List of Changes, click to review</button>
  <div class="panel">
 
 
 
 
 
 <div class="form-group row success">
 <label class="col-sm-12 form-control-label"><b style="font-weight: bold!important;">Changes to Consent Form:  Are changes required?:</b> <?php echo $rstudym['ChangestoConsentForm'];?><br />
<a href="./files/uploads/<?php echo $rstudym['Attachnewconsentform'];?>" target="_blank"><?php echo $rstudym['Attachnewconsentform'];?></a>
</label>
 </div>
 
 
  <div class="form-group row success">
 <label class="col-sm-12 form-control-label">Changes to data collection tool: Are changes required?: <?php echo $rstudym['ChangestodataCollectionTool'];?><br />
<a href="./files/uploads/<?php echo $rstudym['Attachnewtool'];?>" target="_blank"><?php echo $rstudym['Attachnewtool'];?></a>
</label>
 </div>
 
 
   <div class="form-group row success">
 <label class="col-sm-12 form-control-label"><b style="font-weight: bold!important;">Changes to data collection tool: Are changes required?: </b><?php echo $rstudym['ChangestodataCollectionTool'];?><br />
<a href="./files/uploads/<?php echo $rstudym['Attachnewtool'];?>" target="_blank"><?php echo $rstudym['Attachnewtool'];?></a>
</label>
 </div>
 
 
 
    <div class="form-group row success">
 <label class="col-sm-12 form-control-label">Changes to protocol: Are changes required?: <?php echo $rstudym['ChangestoProtocol'];?><br />
<a href="./files/uploads/<?php echo $rstudym['Attachnewprotocol'];?>" target="_blank"><?php echo $rstudym['Attachnewprotocol'];?></a>
</label>
 </div>
 
   <div class="form-group row success">
 <label class="col-sm-12 form-control-label"><b style="font-weight: bold!important;">Are they changes to study districts? Please highlight districts:</b> <br /><?php echo $rstudym['changestostudyDistricts'];?>

</label>
 </div>
 
 <div class="form-group row success">
 <label class="col-sm-12 form-control-label"><b style="font-weight: bold!important;">Description of proposed changes:</b> <br /><?php echo $rstudym['listchanges'];?>

</label>
 </div>
 
 
 </div>   
  
<?php
$sqlstudy="SELECT * FROM ".$prefix."ammendments_documents where `owner_id`='$owner_id' and amendment_id='$id' order by id desc";
$Querystudy = $mysqli->query($sqlstudy);//assignedto='Not Assigned' and
$totalstudy = $Querystudy->num_rows;

?> 
<button class="accordion">Amendments, click to review comments</button>
  <div class="panelss">
 
 <table id="customers" style="font-size:14px;">
                        <thead>
                          <tr>
                            <th>Date & Time</th>
                            <th>Reviewer</th>
                            <th>Message</th>
 
                          </tr>
                        </thead>
                        <tbody>
                        <?php
//if no page var is given, set start to 0
$sql = "select *,DATE_FORMAT(`created`,'%d/%m/%Y %H:%s:%i') AS created FROM ".$prefix."initial_committee_screening where screeningFor='Amendments' and renewal_id='$id' order by id desc LIMIT 0,10";//and conceptm_status='new'

$result = $mysqli->query($sql);
while($rInvestigator=$result->fetch_array()){
$upload_type_id=$rInvestigator['upload_type_id'];
$reviewer_id=$rInvestigator['reviewer_id'];

//user
$sqlUserup = "select * FROM ".$prefix."user where asrmApplctID='$reviewer_id'";//and conceptm_status='new' 
$resultUser = $mysqli->query($sqlUserup);
$rUsers=$resultUser->fetch_array();
	?>
                         <tr>
                            <td valign="top"><?php echo $rInvestigator['created'];?></td>
                            <td valign="top"><?php echo $rUsers['name'];?></td>
                            <td><?php echo $rInvestigator['screening'];?></td>

                          </tr>
   <?php }///////////end function ?>                 
                        </tbody>
                      </table>
  </div>
    
       
         
    <script>
var acc = document.getElementsByClassName("accordion");
var i;

for (i = 0; i < acc.length; i++) {
    acc[i].addEventListener("click", function() {
        this.classList.toggle("activem");
        var panel = this.nextElementSibling;
        if (panel.style.display === "block") {
            panel.style.display = "none";
        } else {
            panel.style.display = "block";
        }
    });
}
</script> 

                        
<script type="text/javascript">

var countries=new ddajaxtabs("countrytabs", "countrydivcontainer")
countries.setpersist(true)
countries.setselectedClassTarget("link") //"link" or "linkparent"
countries.init()

</script>