<?php defined('BASEPATH') or die('No direct Script Access'); ?>
<script type="text/javascript" src="<?php echo base_url('assets/shamcey/js/jquery.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/shamcey/js/jquery-ui.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/shamcey/js/redactor.min.js');?>"></script>
<script type="text/javascript">
$(document).ready(function(){
	$('.datepicker').datepicker({dateFormat: 'yy-mm-dd'});
	
	$('.redactor').redactor({
		focus: true,
		plugins: ['fileBrowser']
	});
});
</script>


<div class="pageheader">
   
	<div class="pageicon"><span class="iconfa-pencil"></span></div>
	<div class="pagetitle">
		<h5>Catalog</h5>
		<h1>Banners Management</h1>
	</div>
</div><!--pageheader-->

<div class="maincontent">
	<div class="maincontentinner">
	<?php 
        if($errors[0]!="") {  ?>
            <div class="alert alert-error">
                <p><strong>ERRORS: </strong>
                        <?php foreach($errors as $error) echo $error; ?>
                </p>
            </div>
        <?php }  ?>
<div class="widgetbox box-inverse">
	<h4 class="widgettitle">Banner Form</h4>
	<div class="widgetcontent nopadding">

<?php

$title			= array('name'=>'title', 'value' => set_value('title', $title));
$enable_on		= array('name'=>'enable_on', 'id'=>'enable_on', 'value'=>set_value('enable_on', set_value('enable_on', $enable_on)));
$disable_on		= array('name'=>'disable_on', 'id'=>'disable_on', 'value'=>set_value('disable_on', set_value('disable_on', $disable_on)));
$f_image		= array('name'=>'image', 'id'=>'image');
$link			= array('name'=>'link', 'value' => set_value('link', $link));	
$new_window		= array('name'=>'new_window', 'value'=>1, 'checked'=>set_checkbox('new_window', 1, $new_window));
?>
<form class="stdform stdform2"  action="" method="post" accept-charset="utf-8" enctype="multipart/form-data">
<!--<?php echo form_open_multipart('admin/banners/form/'.$id); ?>-->
        <p>
                <label for="title">Title</label>				
                <span class="field"><?php echo form_input($title); ?></span>
        </p>
                                
	<p>
            <label for="link">Link</label>
            <span class="field"><?php echo form_input($link); ?></span>
        </p>
        <p>
            <label for="enable_on">Enable on</label>
            <span class="field"><?php echo form_input($enable_on); ?></span>
        </p>
        <p>
            <label for="disable_on">Disable on</label>
            <span class="field"><?php echo form_input($disable_on); ?></span>
        </p>
        <p>
            <label class="checkbox">New Window?</label>
	    <span class="field"><?php echo form_checkbox($new_window); ?> </span>
	</label>
        </p>
        <p>
            <label for="image"><?php echo lang('image');?> </label>
            <span class="field"><?php echo form_upload($f_image); ?></span>
            <?php if($id && $image != ''):?>
                <div style="text-align:center; padding:5px; border:1px solid #ccc;"><img src="<?php echo base_url('uploads/'.$image);?>" alt="current"/><br/>Current file</div>
            <?php endif;?>
        </p>
        
                
        <p class="stdformbutton">
                <button class="btn btn-primary">Submit</button>
                <button type="reset" class="btn">Reset</button>
        </p>

</form>
	</div><!--widgetcontent-->
</div>
<div class="divider15"></div>
   </div>
</div>
<script type="text/javascript">
	$(document).ready(function() {
		$("#enable_on").datepicker({ dateFormat: 'mm-dd-yy'});
		$("#disable_on").datepicker({ dateFormat: 'mm-dd-yy'});
	});
	
	$('form').submit(function() {
		$('.btn').attr('disabled', true).addClass('disabled');
	});
</script>
