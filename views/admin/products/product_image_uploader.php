<?php defined('BASEPATH') or die('No direct Script Access'); ?>
<script type="text/javascript" src="<?php echo base_url('assets/shamcey/js/jquery.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/shamcey/js/jquery-ui.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/shamcey/js/redactor.min.js');?>"></script>

<script type="text/javascript">

<?php if( $this->input->post('submit') ):?>
$(window).ready(function(){
	$('#iframe_uploader', window.parent.document).height($('body').height());	
});
<?php endif;?>

<?php if($file_name):?>
	parent.add_product_image('<?php echo $file_name;?>');
<?php endif;?>

</script>

<?php if (!empty($error)): ?>
	<div class="alert alert-error">
		<a class="close" data-dismiss="alert">×</a>
		<?php echo $error; ?>
	</div>
<?php endif; ?>

<div class="row-fluid">
	<div class="span12">
		
                <form class="stdform stdform2"  action="<?php  echo site_url('admin/products/product_image_upload'); ?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">
			<?php echo form_upload(array('name'=>'userfile', 'id'=>'userfile', 'class'=>'input-file'));?> <input class="btn" name="submit" type="submit" value="<?php echo lang('upload');?>" />
		</form>
	</div>
</div>

