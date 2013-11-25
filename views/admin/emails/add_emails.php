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
<form method="post" class="mainForm validateForm" id="newAdminAccount" action="<?php echo site_url('admin/emails_management/add_email_content')?>">
    <fieldset>
        <div class="widget first">
            <div class="head">
              <h5 class="iList">Create New Email Content </h5>
            </div>
            
            <div class="rowElem">
                <label>Subject</label>
                <div class="formRight">
                    <input type="text" class="validate[required]" name="subject" id="subject" value="<?php echo set_value('subject'); ?>" />
                </div>
                <div class="fix"></div>
            </div>
            
            <div class="rowElem">
                <label>Status</label>
                <div class="formRight">
                    <select name="status">
                        <option value="1">Published</option>
                        <option value="0">Unpublished</option>
                    </select>
                </div>
                <div class="fix"></div>
            </div>
           
            <div class="widget">    
                <div class="head"><h5 class="iPencil">Message</h5></div>
                <textarea class="wysiwyg validate[required]" name="message" rows="5" cols=""></textarea>                
            </div>
            
            <input type="reset" value="Cancel" class="redBtn cancelForm" />
            <input type="submit" value="Create" class="greyishBtn submitForm" id="createAdminAccount"/>
            <div class="fix"></div>

        </div>
    </fieldset>
</form>
<?php endif; ?>