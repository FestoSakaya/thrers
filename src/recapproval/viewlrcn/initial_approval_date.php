<?php
$country=$_GET['country'];
if($country=='Approved'){?>
<div class="form-group row success">
<label class="col-sm-6 form-control-label" >Approval Valid until Date <font color="#CC0000">*</font></label><br />
<input name="approvalvaliduntil" type="date" value="" class="form-control" required/>
</div>

<div class="form-group row success">
<label class="col-sm-6 form-control-label" >Reference Number <font color="#CC0000">*</font></label><br />
<input name="initialReferenceNumber" type="text" value="" class="form-control required" required/>
</div>
<?php }?>