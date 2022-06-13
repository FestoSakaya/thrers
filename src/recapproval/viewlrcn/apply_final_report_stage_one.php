<?php
$sqlstudymAmmendment="SELECT * FROM ".$prefix."final_reports where `owner_id`='$asrmApplctID' and is_sent='0' order by id desc limit 0,1";
$QuerystudymAmmendment = $mysqli->query($sqlstudymAmmendment);
$totalstudyAmmendment = $QuerystudymAmmendment->num_rows;
$rstudymAmmendment = $QuerystudymAmmendment->fetch_array();
$ammendType=$rstudymAmmendment['ammendType'];

?>

<ul id="countrytabs" class="shadetabs">
<li><a href="#" rel="#default" class="selected">Apply for Final Report</a></li>

<li class="extra">Attachments</li>


</ul>

<div id="countrydivcontainer" style="border:0px solid gray; width:100%; margin-bottom: 1em; padding: 10px">


<?php
if($_POST['doQuestionOne']=='Save and Next'){
///Yes
if($_POST['amendmenttype']=='online'){

echo '<meta http-equiv="REFRESH" content="1;url='.$base_url.'/main.php?option=OnlineFinalReport">';
echo '<img src="images/loading_wait.gif">';
echo '<div class="spacer"></div>';
}
if($_POST['amendmenttype']=='manual'){
echo '<meta http-equiv="REFRESH" content="2;url='.$base_url.'/main.php?option=ManualFinalReport">';
	echo '<img src="images/loading_wait.gif">';
echo '<div class="spacer"></div>';
	
}
//
	
}

?>

<script>
function deleteRow(row)
{
    var i=row.parentNode.parentNode.rowIndex;
    document.getElementById('POITable').deleteRow(-1);
	//document.getElementById("myTable").deleteRow(0);
}


function insRow()
{
    console.log( 'hi');
    var x=document.getElementById('POITable');
    var new_row = x.rows[1].cloneNode(true);
    var len = x.rows.length;
    new_row.cells[0].innerHTML = len;
    
    var inp1 = new_row.cells[1].getElementsByTagName('input')[0];
    inp1.id += len;
    inp1.value = '';
	
    var inp2 = new_row.cells[2].getElementsByTagName('input')[0];
    inp2.id += len;
    inp2.value = '';
		
    /*var inp3 = new_row.cells[3].getElementsByTagName('input')[0];
    inp3.id += len;
    inp3.value = '';*/
	new_row.cells[3].getElementsByTagName('input')[0].removeAttribute('style');
    x.appendChild( new_row );
}


</script>

<div style="padding-bottom:10px;"></div>

<hr />

<?php if(!$totalstudyAmmendment){?>

<form action="" method="post" name="regForm" id="regForm" autocomplte="false">
 

                         
<div class="form-group row success">
<label class="col-sm-12 form-control-label">Choose what to submit<span class="error">*</span></label>

<div class="col-sm-6">
<input name="amendmenttype" type="radio" value="online" class="required"/> Already online &nbsp;<br />
                          
<input name="amendmenttype" type="radio" value="manual" class="required"/> Manual Submission
                          
</div>
</div>


      
                    


                        
                        <div class="form-group row">
                          <div class="col-sm-4 offset-sm-3">
                    <input name="doQuestionOne" type="submit"  class="btn btn-primary" value="Save and Next"/>

                          </div>
                        </div>
   
   </form>
<?php }if($totalstudyAmmendment){


if($ammendType=='online'){

echo '<meta http-equiv="REFRESH" content="1;url='.$base_url.'/main.php?option=OnlineFinalReport">';
echo '<img src="images/loading_wait.gif">';
echo '<div class="spacer"></div>';
}
if($ammendType=='manual'){
echo '<meta http-equiv="REFRESH" content="2;url='.$base_url.'/main.php?option=ManualFinalReport">';
	echo '<img src="images/loading_wait.gif">';
echo '<div class="spacer"></div>';
	
}

}?>
                                     
</div>

<script type="text/javascript">

var countries=new ddajaxtabs("countrytabs", "countrydivcontainer")
countries.setpersist(true)
countries.setselectedClassTarget("link") //"link" or "linkparent"
countries.init()

</script>