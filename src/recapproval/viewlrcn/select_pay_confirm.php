<?php
require_once('../configlrcn/db_mconfig.php');
$country=$_GET['country'];
if($country=='Not Paid' || $country=='Not Confirmed'){
?>
<div class="form-group row">
                          <label class="col-sm-4 form-control-label">Comment / Notes: <span class="error">*</span></label>
                          <textarea name="comment" id="comment" cols="" rows="5" class="form-control  required"><?php echo $rstudy['payments_comment'];?></textarea>
                        </div>

<?php }?>
