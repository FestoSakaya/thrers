<ul id="countrytabs" class="shadetabs">
<li><a href="#" rel="#default" class="selected">Ammendments View Submission</a></li>
</ul>

<div id="countrydivcontainer" style="border:0px solid gray; width:100%; margin-bottom: 1em; padding: 10px">
<?php
$reviewer_id=$_SESSION['asrmApplctID'];
$sqlproSubmission="SELECT * FROM ".$prefix."submission_review_sr where reviewer_id='$reviewer_id' and id='$id' and reviewFor='Amendments' order by id desc";
$QprotocalSubmission = $mysqli->query($sqlproSubmission);
$rprotocalSubmission = $QprotocalSubmission->fetch_array();

if($rprotocalSubmission['ammendType']=='online'){
$mmprotocol_id=$rprotocalSubmission['protocol_id'];
$sqlstudym="SELECT * FROM ".$prefix."ammendments where protocol_id='$mmprotocol_id' order by id desc limit 0,1";
$Querystudym = $mysqli->query($sqlstudym);
$rstudym = $Querystudym->fetch_array();
$owner_id=$rstudym['owner_id'];
$code=$rstudym['code'];
$protocol_idwe=$rstudym['protocol_id'];
$renewal_id=$rstudym['id'];

$public_title=$rstudym['protocol_title'];



}
if($rprotocalSubmission['ammendType']=='manual'){
$mmprotocol_id=$rprotocalSubmission['renewal_id'];
$sqlstudym="SELECT * FROM ".$prefix."ammendments where id='$mmprotocol_id' order by id desc limit 0,1";
$Querystudym = $mysqli->query($sqlstudym);
$rstudym = $Querystudym->fetch_array();
$owner_id=$rstudym['owner_id'];
$code=$rstudym['code'];
$protocol_idwe=$rstudym['protocol_id'];
$renewal_id=$rstudym['id'];

$public_title=$rstudym['protocol_title'];


}






$sqlSRR = "select * from ".$prefix."user where asrmApplctID='$owner_id'";
$resultSSS = $mysqli->query($sqlSRR);
$sqUserdd = $resultSSS->fetch_array();
////Screening ID


?>
  <!-- Project-->
              <div class="project">
                <div class="row bg-white has-shadow">
                  <div class="left-col col-lg-6 d-flex align-items-center justify-content-between">
                    <div class="project-title d-flex align-items-center">
                     <?php if($sqUserdd['profile']){?> <div class="image has-shadow"><img src="files/profile/<?php echo $sqUserdd['profile'];?>" alt="..." class="img-fluid"></div><?php }?>
                      <div class="text">
                        <h3 class="h4">Protocal Title</h3><small><?php echo $public_title;?></small>
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
$sqlstudy="SELECT * FROM ".$prefix."ammendments_documents where code='$code' order by id desc";
$Querystudy = $mysqli->query($sqlstudy);
$totalstudy = $Querystudy->num_rows;

?> 
<button class="accordion">Ammendments, click to review</button>
  <div class="panel">
 
<table class="table table-striped table-sm" id="customers">
                  <thead>
                          <tr>
                          <th>Type</th>
                            <th>Language</th>
                            <th>Version</th>
                            <th>Date</th>

                          </tr>
                        </thead>
                        <tbody>
            <?php while($rstudy = $Querystudy->fetch_array()){
				$protocol_id=$rstudy['protocol_id'];
$wmSubmissions="select * from ".$prefix."submission where  `id`='$protocol_id'";
$cmdwbSubmissions = $mysqli->query($wmSubmissions);
$rSubmissions= $cmdwbSubmissions->fetch_array();
				
				?>
                          <tr>
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
 <?php echo $rstudym['listchanges'];?>
 
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
$sqlgg = "select * FROM ".$prefix."initial_committee_screening where owner_id='$owner_id' and renewal_id='$renewal_id' and reviewer_id='$asrmApplctID' and screeningFor='Amendments' order by id desc";//and conceptm_status='new' 
$resultgg = $mysqli->query($sqlgg);
$rInvestigatorgg=$resultgg->fetch_array();


?>
 <form action="" method="post" name="regForm" id="regForm" enctype="multipart/form-data">
<h4>Reviewer Comments:</h4>

<div class="form-group row success">
Comment: <?php echo $rInvestigatorgg['screening'];?><br /><br />
Status: <?php echo $rInvestigatorgg['draftopinion'];?>



</div>

         </form>
  
    
    
       
         
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