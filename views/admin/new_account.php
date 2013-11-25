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
<form method="post" class="mainForm validateForm" id="newAdminAccount">
    <fieldset>
        <div class="widget first">
            <div class="head"><h5 class="iList">Create New Administrator Account</h5></div>
            <div class="rowElem">
                <label>Title</label>
                <div class="formRight"><?php echo create_titles_dropdown(); ?></div>
                <div class="fix"></div>
            </div>
            <div class="rowElem">
                <label>First Name</label>
                <div class="formRight">
                    <input type="text" class="validate[required]" name="first_name" id="first_name" value="<?php echo set_value('first_name'); ?>" />
                </div>
                <div class="fix"></div>
            </div>
            <div class="rowElem">
                <label>Last Name</label>
                <div class="formRight">
                    <input type="text" class="validate[required]" name="last_name" id="last_name" value="<?php echo set_value('last_name'); ?>" />
                </div>
                <div class="fix"></div>
            </div>
            <div class="rowElem">
                <label>Email/Username</label>
                <div class="formRight">
                    <input type="text" class="validate[required,custom[email]]" name="email" id="email" value="<?php echo set_value('email'); ?>" />
                </div>
                <div class="fix"></div>
            </div>
            <div class="rowElem">
                <label>Confirm E-mail</label>
                <div class="formRight">
                    <input type="text" class="validate[required,equals[email]]" name="confirm_email" id="confirm_email" value="<?php echo set_value('confirm_email'); ?>" />
                </div>
                <div class="fix"></div>
            </div>
            <div class="rowElem">
                <label>Password</label>
                <div class="formRight">
                    <input type="password" class="validate[required]" name="password" id="password" />
                </div>
                <div class="fix"></div>
            </div>
            <div class="rowElem">
                <label>Confirm Password</label>
                <div class="formRight"><input type="password" class="validate[required,equals[password]" name="confirm_password" id="confirm_password" /></div>
                <div class="fix"></div>
            </div>
            <div class="rowElem">
                <label>Position</label>
                <div class="formRight">
                    <input type="text" class="validate[required]" name="position" id="position" value="<?php echo set_value('position'); ?>" />
                </div>
                <div class="fix"></div>
            </div>
            <input type="reset" value="Cancel" class="redBtn cancelForm" />
            <input type="submit" value="Create" class="greyishBtn submitForm" id="createAdminAccount" name="create"/>
            <div class="fix"></div>

        </div>
    </fieldset>
</form>
<?php endif; ?>