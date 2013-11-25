<?php defined('BASEPATH') or die('No direct Script Access'); ?>
<!-- Notification messages -->
                <?php if($success) { ?>
            <div class="nNote nSuccess hideit">
                <p><strong>Success: </strong>Details successfully updated</p>
            </div>
                <?php } ?>
                <?php if($errors) { ?>
            <div class="nNote nFailure hideit">
                <p><strong>ERRORS: </strong>
                <?php foreach($errors as $error)
                {
                        echo "$error";
                }
                ?>
                </p>
            </div><?php } ?>
<form method="post" class="mainForm" id="changePasswordForm">
    <fieldset>
        <div class="widget first">
            <div class="head"><h5 class="iList">Edit Administrator Details</h5></div>
            <div class="rowElem">
                <label>Title</label>
                <div class="formRight"><?php echo create_titles_dropdown($admin['title']); ?></div>
                <div class="fix"></div>
            </div>
            <div class="rowElem">
                <label>First Name</label>
                <div class="formRight"><input type="text" name="first_name" value="<?php echo $admin['first_name']; ?>"/></div>
                <div class="fix"></div>
            </div>
            <div class="rowElem">
                <label>Last Name</label>
                <div class="formRight"><input type="text" name="last_name" value="<?php echo $admin['last_name']; ?>" /></div>
                <div class="fix"></div>
            </div>
            <div class="rowElem">
                <label>E-mail</label>
                <div class="formRight"><input type="text" name="email" value="<?php echo $admin['email']; ?>" /></div>
                <div class="fix"></div>
            </div>
            <div class="rowElem">
                <label>Status</label>
                <div class="formRight">
                    <select name="status">
                        <option value="1">Active</option>
                        <option value="0" <?php echo $admin['active'] == 0 ? 'selected=""':''; ?>>Disabled</option>
                    </select>
                </div>
                <div class="fix"></div>
            </div>
            <div class="rowElem">
                <label>Position</label>
                <div class="formRight"><input type="text" name="position" value="<?php echo $admin['position']; ?>"/></div>
                <div class="fix"></div>
            </div>
            <input type="button" name="submit" value="Cancel" class="redBtn cancelForm"/>
            <input type="submit" value="Update" class="greyishBtn submitForm" id="changePasswordBtn"/>
            <div class="fix"></div>

        </div>
        <input type="hidden" name="admin_id" id="admin_id" value="<?php echo $admin['id']; ?>"/>
    </fieldset>
</form>