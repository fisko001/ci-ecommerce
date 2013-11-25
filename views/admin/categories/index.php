<?php defined('BASEPATH') or die('No direct Script Access'); ?>
<script type="text/javascript">
function areyousure()
{
	return confirm('Are you sure to delete it?');
}
</script>

<div class="pageheader">
   
	<div class="pageicon"><span class="iconfa-table"></span></div>
	<div class="pagetitle">
		<h5>Catalog</h5>
		<h1>Categories Management</h1>
	</div>
</div><!--pageheader-->

<div class="maincontent">
	<div class="maincontentinner">
            
            
	<div style="text-align:right">
		<a class="btn" href="<?php echo site_url('admin/categories/form'); ?>"><i class="icon-plus-sign"></i> Add New Category</a>
	</div>
	<table class="table responsive">
		<thead>
			<tr>
				<th>#</th>
				<th>Name</th>
				<th>Permalink</th>
				<th>Sequence</th>
				<th class="center">Action</th>
				
			</tr>
		</thead>
		<tbody>
		 <?php echo (count($categories) < 1)?'<tr><td style="text-align:center;" colspan="3">There are currently no categories.</td></tr>':''?>
           <?php
			define('ADMIN_FOLDER', "admin");
			function list_categories($cats, $sub='') {
			
			foreach ($cats as $cat):?>           
                 <tr>
				<td><?php echo  $cat['category']->id; ?></td>
				<td><?php echo  $sub.$cat['category']->name; ?></td>
				<td><?php echo  $cat['category']->slug; ?></td>
				<td><?php echo  $cat['category']->sequence; ?></td>
				<td class="center">
						<a class="btn" href="<?php echo  site_url(ADMIN_FOLDER.'/categories/form/'.$cat['category']->id);?>" title="Edit"><i class="icon-pencil"></i></a>
						
						<a class="btn btn-danger" href="<?php echo  site_url(ADMIN_FOLDER.'/categories/delete/'.$cat['category']->id);?>" onclick="return areyousure();" style="color:#FFFFFF" title="Delete"><i class="icon-trash icon-white"></i></a>
					
				</td>
			</tr> 
			<?php
				if (sizeof($cat['children']) > 0)
				{
					$sub2 = str_replace('&rarr;&nbsp;', '&nbsp;', $sub);
						$sub2 .=  '&nbsp;&nbsp;&nbsp;&rarr;&nbsp;';
					list_categories($cat['children'], $sub2);
				}
			endforeach;
			}
		
		list_categories($categories);
		?>     
		</tbody>
	</table>

	<div class="divider15"></div>
   </div>
</div>

	
