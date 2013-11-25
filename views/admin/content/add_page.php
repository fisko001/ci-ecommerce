<?php defined('BASEPATH') or die('No direct Script Access'); ?>

<div class="pageheader">
   
	<div class="pageicon"><span class="iconfa-pencil"></span></div>
	<div class="pagetitle">
		<h5>Catalog</h5>
		<h1>Page Management</h1>
	</div>
</div><!--pageheader-->

<div class="maincontent">
	<div class="maincontentinner">
	
        <!-- Notification messages -->
        <?php if($success) { ?>
        <div class="alert">
            <p><strong>Success: </strong><?php echo $success; ?></p>
        </div>
        <?php } ?>
        <?php 
        if($errors) {  ?>
            <div class="alert alert-error">
                <p><strong>ERRORS: </strong>
                        <?php foreach($errors as $error) echo $error; ?>
                </p>
            </div>
        <?php }  ?>
        
<div class="widgetbox box-inverse">
	<h4 class="widgettitle">Add Page</h4>
	<div class="widgetcontent nopadding">
            
            
<?php if(!$success): ?>
<form method="post" class="stdform stdform2" id="newAdminAccount" action="<?php echo site_url('admin/content_management/add_cms_pages')?>">
    
    <p>
                <label for="title">Title</label>				
                <span class="field"><input type="text" class="validate[required]" name="page_name" id="page_name" value="<?php echo set_value('page_name'); ?>" /></span>
    </p>
    
    <p>
            <label for="title">Permalinks</label>				
            <span class="field"> <input type="text" class="validate[required]" name="permalink" id="permalinks" value="<?php echo set_value('permalinks'); ?>" />
                    <span>Instead of space use "-" (example => 'test page' = 'test-page')</span></span>
    </p>

    <p>
            <label for="title">Status</label>				
            <span class="field"> <select name="published">
                        <option value="1">Published</option>
                        <option value="0">Unpublished</option>
                    </select></span>
    </p>
    
     <p>
                <label for="title">Order</label>				
                <span class="field"> <select name="order">
                        <?php for($i=1; $i<100; $i++){?>
                        <option value="<?php echo $i; ?>" ><?php echo $i;?></option>
                        <?php } ?>
                    </select></span>
    </p>
    
    <p>
                <label for="title">Content</label>				
                <span class="field"> <?php
				$data	= array('name'=>'content', 'class'=>'redactor', 'value'=>set_value('content', ''));
				echo form_textarea($data);
				?>
                </span>
    </p>
    
    <p class="stdformbutton">
                <button class="btn btn-primary">Submit</button>
                <button type="reset" class="btn">Reset</button>
        </p>
    
   
</form>
<?php endif; ?>
            
 
</div><!--widgetcontent-->
</div>
<div class="divider15"></div>
   </div>
</div>