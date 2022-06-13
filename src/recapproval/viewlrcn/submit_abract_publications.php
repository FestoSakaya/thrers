<ul id="countrytabs" class="shadetabs">
<li><a href="#" rel="#default" class="selected">Submit Abstract/Publication</a></li>
</ul>

<div id="countrydivcontainer" style="border:0px solid gray; width:100%; margin-bottom: 1em; padding: 10px">
<?php
$sessionasrmApplctID=$_SESSION['asrmApplctID'];


$sqlSRR = "select * from ".$prefix."user where asrmApplctID='$sessionasrmApplctID'";
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

if($_POST['doFilesUpload']=='Save' and $_POST['project_id']){

$title=$mysqli->real_escape_string($_POST['title']);
$category=$mysqli->real_escape_string($_POST['category']);
$abstract=$mysqli->real_escape_string($_POST['abstract']);

$submission_id=$mysqli->real_escape_string($_POST['submission_id']);
$protocol_id=$mysqli->real_escape_string($_POST['project_id']);
$PermissiontopublishAbstract=$mysqli->real_escape_string($_POST['PermissiontopublishAbstract']);

$wmRenewals="select * from ".$prefix."submission where  id='$protocol_id'";
$cmdwbRenewals = $mysqli->query($wmRenewals);
$rRenewals= $cmdwbRenewals->fetch_array();

$recAffiliated_id=$mysqli->real_escape_string($rRenewals['recAffiliated_id']);


	
$sqlprotocalSubSel3="SELECT * FROM ".$prefix."abstracts where protocol_id='$protocol_id' and owner_id='$sessionasrmApplctID' and title='$title'";
$QprotocalSub2Sel3 = $mysqli->query($sqlprotocalSubSel3);
$totalstudy3 = $QprotocalSub2Sel3->num_rows;

if(!$totalstudy3){
$sqlA22="insert into ".$prefix."abstracts (`owner_id`,`protocol_id`,`recAffiliated_id`,`fileAttachment`,`created`,`status`,`title`,`category`,`details`,`PermissiontopublishAbstract`) 

values('$sessionasrmApplctID','$protocol_id','$recAffiliated_id','',now(),'Pending','$title','$category','$abstract','$PermissiontopublishAbstract')";
$mysqli->query($sqlA22);
$message='<div class="success">Changes have saved</div>';
}

	
}



$sqlstudy="SELECT * FROM ".$prefix."abstracts where `owner_id`='$sessionasrmApplctID' order by id desc limit 0,100";
$Querystudy = $mysqli->query($sqlstudy);
$totalstudy = $Querystudy->num_rows;

if(isset($message)){echo $message;}
?>
   
   <div style="clear:both;"></div>
    <button id="myBtn">Click to add Abstract</button> 
    
    
    
     <table class="table table-striped table-sm" id="customers">
                  <thead>
                          <tr>
                          <th>Title</th>
                            <th>Category</th>
                            <th>Summary</th>
                     <th>Permission to publish Abstract</th>

                          </tr>
                        </thead>
                        <tbody>
            <?php while($rstudy = $Querystudy->fetch_array()){
		$idm=$rstudy['protocol_id'];		
$sqlstudym="SELECT * FROM ".$prefix."submission where `owner_id`='$sessionasrmApplctID' and id='$idm' order by id desc limit 0,1";
$Querystudym = $mysqli->query($sqlstudym);
$rstudym = $Querystudym->fetch_array();
$owner_id=$rstudym['owner_id'];	
				
				?>
                          <tr>
                          <td><?php echo $rstudy['title'];?></td>
                          
                            <td><?php echo $rstudy['category'];?></td>
                            <td><?php echo $rstudy['details'];?></td>
                      <td><?php echo $rstudy['PermissiontopublishAbstract'];?></td>
                            </tr>
               <?php }?>
               
                        </tbody>
                      </table> 
    
    <!-- The Modal -->
<div id="myModal" class="modal" style="margin-top:80px;">

  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
      <span class="close">&times;</span>
      <h3><strong>New Attachment</strong></h3>
    </div>
    <div class="modal-body" style="height:320px; overflow:scroll;">


 <form action="" method="post" name="regForm" id="regForm" enctype="multipart/form-data">
<div class="form-group row success">
<label class="col-sm-10 form-control-label">Select Protocol you are submitting to: <span class="error">*</span></label>
<div class="col-sm-10">

<select name="project_id" id="project_id" class="form-control  required">
<option value="">Please Select Protocol</option>
<?php
$sqlSubmission = "select * FROM ".$prefix."submission where owner_id='$asrmApplctID' and status='Approved' order by id desc";//and conceptm_status='new' 
$QuerySubmission = $mysqli->query($sqlSubmission);
while($resultSubmission=$QuerySubmission->fetch_array()){
?>
<option value="<?php echo $resultSubmission['id'];?>" <?php if($resultSubmission['id']==$rstudypp['protocol_id']){?>selected="selected"<?php }?>><?php echo $resultSubmission['public_title'];?></option>

<?php }?>

</select>
</div>
</div>


<div class="form-group row success">
<label class="col-sm-10 form-control-label">Title<span class="error">*</span></label>
<div class="col-sm-10">

<input type="text" name="title" id="title" class="form-control  required" value="">

</select>
</div>
</div>




<div class="form-group row success">
<label class="col-sm-10 form-control-label">Select Category: <span class="error">*</span></label>
<div class="col-sm-10">

<select name="category" id="category" class="form-control  required">
<option value="">Category</option>

<option value="Publications">Publications</option>
<option value="Abstract">Abstract</option>

</select>
</div>
</div>



 <div class="form-group row success">
 
 <label class="col-sm-12 form-control-label">Abstract/Publication: <span class="error">*</span></label>
<div class="col-sm-12">

                          
 <textarea name="abstract" id="MyTextBox" cols="" rows="5" class="form-control  required"><?php echo $rstudy['abstract'];?></textarea>

  <?php $wmRenewals="select * from ".$prefix."submission where  id='$id'";
$cmdwbRenewals = $mysqli->query($wmRenewals);
$rRenewals= $cmdwbRenewals->fetch_array();?>
<input name="recAffiliated_id" type="hidden" value="<?php echo $rRenewals['recAffiliated_id'];?>"/> 
<input name="protocol_id" type="hidden" value="<?php echo $id;?>"/>
<input type="hidden" name="asrmApplctID" value="<?php echo $_SESSION['asrmApplctID'];?>">

</div>
</div>

 <div class="form-group row success">
 
 <label class="col-sm-12 form-control-label">Permission to publish Abstract: <span class="error">*</span></label>
<div class="col-sm-12">
<input name="PermissiontopublishAbstract" type="radio" value="Yes" /> YES &nbsp;<input name="PermissiontopublishAbstract" type="radio" value="No" checked="checked"/> NO

</div>
</div>
                        
                       
       
       <div class="form-group row">
                          <div class="col-sm-4 offset-sm-3">
                    <input name="doFilesUpload" type="submit"  class="btn btn-primary" value="Save"/>




                          </div>
                        </div>
                                          
     </form>                   
    </div>
    </div>
    </div><!--End-->
<?php /*?>
<form action="" method="post" name="regForm" id="regForm" >
           
 
   
                   
                        
                        <div class="form-group row">
                          <div class="col-sm-4 offset-sm-3">
                    <input name="donotifications" type="submit"  class="btn btn-primary" value="Save"/>
<input name="protocol_id" type="hidden" value="<?php echo $id;?>"/>
<input type="hidden" name="asrmApplctID" value="<?php echo $_SESSION['asrmApplctID'];?>">

                          </div>
                        </div>
   
   </form><?php */?>
   
   
   
   
   
                                     
</div>

<script type="text/javascript">

var countries=new ddajaxtabs("countrytabs", "countrydivcontainer")
countries.setpersist(true)
countries.setselectedClassTarget("link") //"link" or "linkparent"
countries.init()

</script>