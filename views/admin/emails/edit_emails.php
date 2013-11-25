<?php defined('BASEPATH') or die('No direct Script Access'); ?>
<!-- Notification messages -->
<?php if($success) { ?>
	<div class="nNote nSuccess hideit">
	<p><strong>Success: </strong><?php echo $success; ?></p>
	</div>
<?php } ?>
<?php if($errors) { ?>
	<div class="nNote nFailure hideit">
	<p><strong>ERRORS: </strong>
	<?php foreach($errors as $error) echo "$error<br/>"  ?></p>
</div>
<?php } ?>
<?php if(!$success): ?>
<form method="post" class="mainForm validateForm" id="newAdminAccount" action="<?php echo site_url('admin/emails_management/edit_email_content/'.$email_id)?>">
    <fieldset>
        <div class="widget first">
            <div class="head">
              <h5 class="iList">Edit Email Content </h5>
            </div>
            
            <div class="rowElem">
                <label>Subject</label>
                <div class="formRight">
                    <input type="text" class="validate[required]" name="subject" id="subject" value="<?php echo $email_info->subject; ?>" />
                </div>
                <div class="fix"></div>
            </div>
            
            <div class="rowElem">
                <label>Status</label>
                <div class="formRight">
                    <select name="status">
                       <option value="1" <?php echo ($email_info->status == "1" ? 'selected' : '');?>>Published</option>
                        <option value="0" <?php echo ($email_info->status == "0" ? 'selected' : '');?>>Unpublished</option>
                    </select>
                </div>
                <div class="fix"></div>
            </div>
           
            <div class="widget">    
                <div class="head"><h5 class="iPencil">Message</h5></div>
                <textarea class="wysiwyg" name="message" rows="5" cols=""><?php echo $email_info->message; ?></textarea>                
            </div>
            
            <input type="reset" value="Cancel" class="redBtn cancelForm" />
            <input type="submit" value="Update" class="greyishBtn submitForm" id="createAdminAccount"/>
            <div class="fix"></div>

        </div>
    </fieldset>
</form>
<?php endif; ?>