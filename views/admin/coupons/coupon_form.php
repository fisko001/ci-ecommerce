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

<script type="text/javascript">
$(function(){
$("#datepicker1").datepicker({dateFormat: 'mm-dd-yy', altField: '#datepicker1_alt', altFormat: 'yy-mm-dd'});
$("#datepicker2").datepicker({dateFormat: 'mm-dd-yy', altField: '#datepicker2_alt', altFormat: 'yy-mm-dd'});
});
</script>
<div class="pageheader">
   
	<div class="pageicon"><span class="iconfa-pencil"></span></div>
	<div class="pagetitle">
		<h5>Catalog</h5>
		<h1>Coupons Management</h1>
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
	
<?php //echo form_open($this->config->item('admin_folder').'/coupons/form/'.$id); ?>

<form class="stdform stdform2"  action="<?=site_url('admin/coupons/form/'.$id);?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">

<div class="alert alert-info" style="text-align:center;">
	<strong><?php echo sprintf(lang('times_used'), @$num_uses);?></strong>
</div>

		<p>
 
			<label for="code"><?php echo lang('coupon_code');?></label>
			<span class="field"><?php
			$data	= array('name'=>'code', 'value'=>set_value('code', $code), 'class'=>'span3');
			echo form_input($data);
			?>
			</span>
		</p>
		<p>
			<label for="max_uses"><?php echo lang('max_uses');?></label>
			<span class="field"><?php
			$data	= array('name'=>'max_uses', 'value'=>set_value('max_uses', $max_uses), 'class'=>'span3');
			echo form_input($data);
			?>
			</span>
	     </p>
		 <p>		
			<label for="max_product_instances"><?php echo lang('limit_per_order')?></label>
			<span class="field"><?php
			$data	= array('name'=>'max_product_instances', 'value'=>set_value('max_product_instances', $max_product_instances), 'class'=>'span3');
			echo form_input($data);
			?>
			</span>
		</p>
		<p>	
			<label for="start_date"><?php echo lang('enable_on');?></label>
			<span class="field"><?php
			$data	= array('id'=>'datepicker1', 'value'=>set_value('start_date', reverse_format($start_date)), 'class'=>'span3');
			echo form_input($data);
			?>
			<input type="hidden" name="start_date" value="<?php echo set_value('start_date', $start_date) ?>" id="datepicker1_alt" />
			</span>
		</p>
		<p>	
			<label for="end_date"><?php echo lang('disable_on');?></label>
			<span class="field"><?php
			$data	= array('id'=>'datepicker2', 'value'=>set_value('end_date', reverse_format($end_date)), 'class'=>'span3');
			echo form_input($data);
			?>
			<input type="hidden" name="end_date" value="<?php echo set_value('end_date', $end_date) ?>" id="datepicker2_alt" />
			</span>
		</p>
		<p>	
			<label for="reduction_target"><?php echo lang('coupon_type');?></label>
			<span class="field"><?php
		 		$options = array(
				'price'  => lang('price_discount'),
				'shipping' => lang('free_shipping')
               	);
				echo form_dropdown('reduction_target', $options,  $reduction_target, 'id="gc_coupon_type" class="span3"');
			?>
			</span>
	     </p>
		 <p>	
			<label for="reduction_amount"><?php echo lang('reduction_amount')?></label>
			
			<div class="row">
				<div class="span1"><br />
				<?php	$options = array(
	                  'percent'  => '%',
					  'fixed' => '$'
	               	);
					echo ' '.form_dropdown('reduction_type', $options,  $reduction_type, 'class="span1"');
				?>
				</div>
				<div class="span2"><br />
					<?php
						$data	= array('id'=>'reduction_amount', 'name'=>'reduction_amount', 'value'=>set_value('reduction_amount', $reduction_amount), 'class'=>'span2');
						echo form_input($data);?>
				
	</div><br />
	<div class="span6 offset1 well">
		<?php
	 		$options = array(
              '1' => lang('apply_to_whole_order'),
			  '0' => lang('apply_to_select_items')
           	);
			echo form_dropdown('whole_order_coupon', $options,  set_value(0, $whole_order_coupon), 'id="gc_coupon_appliesto_fields"');
		?>
		</p>	
		<div id="gc_coupon_products">
			<table width="100%" border="0" style="margin-top:10px;" cellspacing="5" cellpadding="0">
			<?php echo $product_rows; ?>
			</table>
		</div>
	</div>
</div>

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
$('form').submit(function() {
	$('.btn').attr('disabled', true).addClass('disabled');
});

$(document).ready(function(){
	$("#gc_tabs").tabs();
	
	if($('#gc_coupon_type').val() == 'shipping')
	{
		$('#gc_coupon_price_fields').hide();
	}
	
	$('#gc_coupon_type').bind('change keyup', function(){
		if($(this).val() == 'price')
		{
			$('#gc_coupon_price_fields').show();
		}
		else
		{
			$('#gc_coupon_price_fields').hide();
		}
	});
	
	if($('#gc_coupon_appliesto_fields').val() == '1')
	{
		$('#gc_coupon_products').hide();
	}
	
	$('#gc_coupon_appliesto_fields').bind('change keyup', function(){
		if($(this).val() == 0)
		{
			$('#gc_coupon_products').show();
		}
		else
		{
			$('#gc_coupon_products').hide();
		}
	});
});

</script>



