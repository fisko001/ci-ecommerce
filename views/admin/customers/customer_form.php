<div class="pageheader">
   
	 <div class="pageicon"><span class="iconfa-pencil"></span></div>
	<div class="pagetitle">
		<h5>User</h5>
		<h1>Customer Management</h1>
	</div>
</div><!--pageheader-->

<div class="maincontent">
	<div class="maincontentinner">
	<?php
	//lets have the flashdata overright "$message" if it exists
	if($this->session->flashdata('message'))
	{
		$message	= $this->session->flashdata('message');
	}
	
	if($this->session->flashdata('error'))
	{
		$error	= $this->session->flashdata('error');
	}
	
	if(function_exists('validation_errors') && validation_errors() != '')
	{
		$error	= validation_errors();
	}
	?>
	
	
	
	<?php if (!empty($message)): ?>
		<div class="alert alert-success">
			<a class="close" data-dismiss="alert">×</a>
			<?php echo $message; ?>
		</div>
	<?php endif; ?>

	<?php if (!empty($error)): ?>
		<div class="alert alert-error">
			<a class="close" data-dismiss="alert">×</a>
			<?php echo $error; ?>
		</div>
	<?php endif; ?>
            
<div class="widgetbox box-inverse">
	<h4 class="widgettitle">Customer Form</h4>
	<div class="widgetcontent nopadding">

<?php //echo form_open('admin/customers/form/'.$id); ?>
<form class="stdform stdform2"  action="" method="post" accept-charset="utf-8" enctype="multipart/form-data">
	
    
        <p>
                <label><?php echo lang('company');?></label>			
                <span class="field"><?php
			$data	= array('name'=>'company', 'value'=>set_value('company', $company), 'class'=>'span3');
			echo form_input($data); ?></span>

        </p>

	<p>
			<label><?php echo lang('firstname');?></label>
			<span class="field"><?php
			$data	= array('name'=>'firstname', 'value'=>set_value('firstname', $firstname), 'class'=>'span3');
			echo form_input($data); ?></span>
	</p>
        
	<p>
			<label><?php echo lang('lastname');?></label>
			<span class="field"><?php
			$data	= array('name'=>'lastname', 'value'=>set_value('lastname', $lastname), 'class'=>'span3');
			echo form_input($data); ?></span>
	</p>
	

	<p>
		
			<label><?php echo lang('email');?></label>
			<span class="field"><?php
			$data	= array('name'=>'email', 'value'=>set_value('email', $email), 'class'=>'span3');
			echo form_input($data); ?></span>
		</p>
	
	<p>
			<label><?php echo lang('phone');?></label>
			<span class="field"><?php
			$data	= array('name'=>'phone', 'value'=>set_value('phone', $phone), 'class'=>'span3');
			echo form_input($data); ?></span>
	</p>
	<p>

		<label><?php echo lang('password');?></label>
		<span class="field"><?php
		$data	= array('name'=>'password', 'class'=>'span3');
		echo form_password($data); ?></span>
	</p>
	
	<p>
		<label><?php echo lang('confirm');?></label>
		<span class="field"><?php
		$data	= array('name'=>'confirm', 'class'=>'span3');
		echo form_password($data); ?></span>
	</p>


	<p>
			<label class="checkbox"></label>
			<span class="field"><?php $data	= array('name'=>'email_subscribe', 'value'=>1, 'checked'=>(bool)$email_subscribe);
			echo form_checkbox($data).' '.lang('email_subscribed'); ?>
			</span>
	</p>

	<p>

			<label class="checkbox"></label><span class="field">
				<?php
				$data	= array('name'=>'active', 'value'=>1, 'checked'=>$active);
				echo form_checkbox($data).' '.lang('active'); ?>
			</span>

	</p>

	<p>

			<label><?php echo lang('group');?></label>
			<span class="field"><?php echo form_dropdown('group_id', $group_list, set_value('group_id',$group_id), 'class="span3"'); ?></span>

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


