<?php
require_once('../configlrcn/db_mconfig.php');
echo $country=$_GET['country'];
$stateId=intval($_GET['state']);
?>

<label class="col-sm-2 form-control-label">Duration:</label>
<div class="col-sm-4">
<input name="Duration" type="text" id="Duration"  class="form-control  required"/>
</div>
 
<label class="col-sm-2 form-control-label">Period:</label>
<div class="col-sm-4">
<select name="Durationperiod" id="Durationperiod" class="form-control  required">
    <option value="">------</option>
    <option value="Days">Days</option>
<option value="Months">Months</option>
<option value="Years">Years</option>
</select>
</div>