<?php defined('BASEPATH') or die('No direct Script Access'); ?>
<script type="text/javascript" src="<?php echo base_url('assets/shamcey/js/jquery.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/shamcey/js/jquery-ui.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/shamcey/js/redactor.min.js');?>"></script>
<script type="text/javascript">
//<![CDATA[
$(document).ready(function(){
	create_sortable();	
});
// Return a helper with preserved width of cells
var fixHelper = function(e, ui) {
	ui.children().each(function() {
		$(this).width($(this).width());
	});
	return ui;
};
function create_sortable()
{
	$('#banners_sortable').sortable({
		scroll: true,
		helper: fixHelper,
		axis: 'y',
		handle:'.handle',
		update: function(){
			save_sortable();
		}
	});	
	$('#banners_sortable').sortable('enable');
}

function save_sortable()
{
	serial=$('#banners_sortable').sortable('serialize');
			
	$.ajax({
		url:'<?php echo site_url('admin/banners/organize');?>',
		type:'POST',
		data:serial
	});
}
function areyousure()
{
	return confirm('Are you sure to delete this banner');
}
//]]>
</script>


<div class="pageheader">
   
	<div class="pageicon"><span class="iconfa-table"></span></div>
	<div class="pagetitle">
		<h5>Contents</h5>
		<h1>Banners Management</h1>
	</div>
</div><!--pageheader-->

<div class="maincontent">
<div class="maincontentinner">
    
    
    
    <div style="text-align:right">
                  <a class="btn" href="<?php echo site_url('admin/banners/form'); ?>"><i class="icon-plus-sign"></i> Add New Banner</a>
    </div>

    <table class="table responsive">
	<thead>
		<tr>
			<th>Sort</th>
			<th>Title</th>
			<th>Enable On</th>
			<th>Disable On</th>
			<th class="center">Action</th>
		</tr>
	</thead>
        <?php echo (count($banners) < 1)?'<tr><td style="text-align:center;" colspan="5">No banners found.</td></tr>':''?>
	<?php if ($banners): ?>
	<tbody id="banners_sortable">
	<?php
	foreach ($banners as $banner):

		//clear the dates out if they're all zeros
		if ($banner->enable_on == '0000-00-00')
		{
			$enable_test	= false;
			$enable		= '';
		}
		else
		{
			$eo = explode('-', $banner->enable_on);
			$enable_test	= $eo[0].$eo[1].$eo[2];
			$enable		= $eo[1].'-'.$eo[2].'-'.$eo[0];
		}

		if ($banner->disable_on == '0000-00-00')
		{
			$disable_test	= false;
			$disable		= '';
		}
		else
		{
			$do = explode('-', $banner->disable_on);
			$disable_test	= $do[0].$do[1].$do[2];
			$disable	= $do[1].'-'.$do[2].'-'.$do[0];
		}


		$disabled_icon	= '';
		$curDate = date('Ymd');

		if (($enable_test && $enable_test > $curDate) || ($disable_test && $disable_test <= $curDate))
		{
			$disabled_icon	= '<span style="color:#ff0000;">&bull;</span> ';
		}
		?>
		<tr id="banners-<?php echo $banner->id;?>">
			<td class="handle"><a class="btn" style="cursor:move"><span class="icon-align-justify"></span></a></td>
			<td><?php echo $disabled_icon.$banner->title;?></td>
			<td><?php echo $enable;?></td>
			<td><?php echo $disable;?></td>
			<td  class="center">
				<div class="btn-group" >
					<a class="btn" href="<?php echo  site_url('admin/banners/form/'.$banner->id);?>"><i class="icon-pencil"></i></a>
					<a class="btn btn-danger" href="<?php echo site_url('admin/banners/delete/'.$banner->id);?>" onclick="return areyousure();"><i class="icon-trash icon-white"></i></a>
				</div>
			</td>
		</tr>
	<?php endforeach; ?>
	</tbody>
	<?php endif;?>
</table>


<div class="divider15"></div>
</div>
</div>

 
