<?php defined('BASEPATH') or die('No direct Script Access'); ?>
<!-- Notification messages -->

               <?php if($success) { ?>
            <div class="nNote nSuccess hideit">
                <p><strong>Success: </strong>User details successfully updated.</p>
            </div>
                <?php } ?>
                <?php if($errors) {  if (!$success){ ?>
            <div class="nNote nFailure hideit">
                <p><strong>ERRORS: </strong>
                        <?php foreach($errors as $error) echo $error; ?>
                </p>
            </div>
                <?php } } ?>

<form method="post" class="mainForm" id="editSeekerForm">
    <fieldset>
        <div class="widget first">
            <div class="head"><h5 class="iList">Edit Seeker Details #<?php echo $userinfo[0]["id"]; ?></h5></div>
            <div class="rowElem">
                <label>Title</label>
                <div class="formRight"><?php echo create_admin_titles_dropdown($userinfo[0]['title']); ?></div>
                <div class="fix"></div>
            </div>
            <div class="rowElem">
                <label>First Name</label>
                <div class="formRight"><input type="text" name="first_name" value="<?php echo $userinfo[0]['first_name']; ?>"/></div>
                <div class="fix"></div>
            </div>
            <div class="rowElem">
                <label>Last Name</label>
                <div class="formRight"><input type="text" name="last_name" value="<?php echo $userinfo[0]['last_name']; ?>" /></div>
                <div class="fix"></div>
            </div>
            <div class="rowElem">
                <label>Username</label>
                <div class="formRight"><input type="text" name="username" value="<?php echo $userinfo[0]['email']; ?>" disabled="" /></div>
                <div class="fix"></div>
            </div>
            <div class="rowElem">
                <label>E-mail</label>
                <div class="formRight"><input type="text" name="email" value="<?php echo $userinfo[0]['email']; ?>" /></div>
                <div class="fix"></div>
            </div>
            <div class="rowElem">
                <label>Status</label>
                <div class="formRight">
                    <select name="status">
                        <option value="1">Active</option>
                        <option value="0" <?php echo $userinfo[0]['active'] == 0 ? 'selected=""':''; ?>>Disabled</option>
                    </select>
                </div>
                <div class="fix"></div>
            </div>
           
            <input type="button" name="submit" value="Cancel" class="redBtn cancelForm"/>
            <input type="submit" value="Update" class="greyishBtn submitForm" id="updateSeekerDetails" name="update"/>
            <div class="fix"></div>

        </div>
        <input type="hidden" name="user_id" id="user_id" value="<?php echo $userinfo[0]['id']; ?>"/>
    </fieldset>
</form>
