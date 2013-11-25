<script type="text/javascript" >
    $(function(){
        $('#changePasswordBtn').click(function(e){
            e.preventDefault();
            var Pwdata ='';
            $.each($('#changePasswordForm').serializeArray(), function(i, field) {
                Pwdata += field.name + '='+field.value+'&';
            });
            $.ajax({
                url : '<?php echo site_url('admin/administration/change_password'); ?>',
                type : 'post',
                dataType : 'json',
                data : Pwdata,
                success : function(data){
                    if(data.success){
                        $.jGrowl(data.success, {sticky : true});
                        $("#changePasswordForm input[type='password']").val('');
                    }
                    else{
                        jAlert(data.error, 'Failure');
                    }
                }
            });
            // reset values of all fields
            $("#changePasswordForm input[type='text']").val('');
        });
        
        // Update Admin Details
        $('#updateAdminDetails').click(function(e){
            e.preventDefault();
            var ADdata ='';
            $.each($('#adminDetailsForm').serializeArray(), function(i, field) {
                ADdata += field.name + '='+field.value+'&';
            });
            $.ajax({
                url : '<?php echo site_url('admin/administration/update_details'); ?>',
                type : 'post',
                dataType : 'json',
                data : ADdata,
                success : function(data){
                    if(data.success){
                        $.jGrowl(data.success, 'Success');
                    }
                    else{
                        jAlert(data.error, 'Failure');
                    }
                }
            });
        });
    });
</script>
<div class="pageheader">
   
	<div class="pageicon"><span class="iconfa-pencil"></span></div>
	<div class="pagetitle">
		<h5>Users</h5>
		<h1>Account Settings</h1>
	</div>
</div><!--pageheader-->

<div class="maincontent">
	<div class="maincontentinner">

<div class="widgetbox box-inverse">
	<h4 class="widgettitle">Account Form</h4>
	<div class="widgetcontent nopadding">
<span id="pass-change-info" ></span>
<h2 class="iList">Change Password</h2>
<form class="stdform stdform2"  action="" method="post" accept-charset="utf-8" enctype="multipart/form-data">
           <p>
		<label for="name">Current Password</label>
                <span class="field"><input name="current_password" type="password" class="validate[required]" id="current_password"/></span>
 
           <p>
                <label for="newpassword">New password:</label>
                <span class="field"><input type="password" name="new_password" class="validate[required]" id="new_password"/></span>
             
            </p>
           <p>
                <label>New password Confirm:</label>
                <span class="field"><input type="password" name="new_password_confirm" class="validate[required,equals[new_password]" id="new_password_confirm"/>
               </span>
           </p>
           <p class="stdformbutton">
					<button class="btn btn-primary" id="changePasswordBtn">Change Password</button>
					<button type="reset" class="btn">Reset</button>
                                         <input type="submit" value="Change Password" class="btn btn-primary" id="changePasswordBtn"/>
				</p>


        </div>
   
</form>
<form method="post" class="mainForm" id="adminDetailsForm">
    <fieldset>
        <div class="widget first">
            <div class="head"><h5 class="iList">Account Details</h5></div>
            <div class="rowElem">
                <label>Title:</label>
                <div class="formRight"><?php echo create_titles_dropdown($user['title']); ?></div>
                <div class="fix"></div>
            </div>
            <div class="rowElem">
                <label>First Name:</label>
                <div class="formRight"><input type="text" name="first_name" value="<?php echo $user['first_name']; ?>"/></div>
                <div class="fix"></div>
            </div>
            <div class="rowElem">
                <label>Last Name:</label>
                <div class="formRight"><input type="text" name="last_name" value="<?php echo $user['last_name']; ?>" /></div>
                <div class="fix"></div>
            </div>
            <div class="rowElem">
                <label>Position :</label>
                <div class="formRight"><input type="text" name="position" value="<?php echo $user['position']; ?>" /></div>
                <div class="fix"></div>
            </div>
            <input type="submit" value="Change Account Details" class="greyishBtn submitForm" id="updateAdminDetails"/>
            <div class="fix"></div>

        </div>
    </fieldset>
</form>

</div><!--widgetcontent-->
</div>
<div class="divider15"></div>
   </div>
</div>