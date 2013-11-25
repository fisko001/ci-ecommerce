<?php defined('BASEPATH') or die('No direct Script Access'); ?>

<div class="pageheader">
   
	<div class="pageicon"><span class="iconfa-table"></span></div>
	<div class="pagetitle">
		<h5>Contents</h5>
		<h1>Page Management</h1>
	</div>
</div><!--pageheader-->

<div class="maincontent">
<div class="maincontentinner">
<div style="text-align:right">
		<a class="btn" href="<?php echo site_url('admin/content_management/add_pages'); ?>"><i class="icon-plus-sign"></i> Add New Page</a>
	</div>
<table class="table responsive">
	<thead>
		<tr>
			<th>#</th>
			<th>Page</th>
			<th>Permalink</th>
			<th class="center">Action</th>
		</tr>
	</thead>
	<tbody>
	 <?php if (!$content_pages)
	 { ?>
	<tr>
		   <td colspan="4">No data to show.</td>
		</tr>
	 <?php
	 }
	else {
	foreach ($content_pages as $content):
				?>
		<tr>
			<td><?php echo $content['id']; ?></td>
			<td><?php echo $content['page_name']; ?></td>
			<td><?php echo $content['permalink']; ?></td>
			<td class="center">
                            <a class="btn" href="<?php echo site_url('admin/content_management/edit/' . $content['id']); ?>"><i class="icon-pencil"></i></a>
                            <a class="btn btn-danger" onclick="return confirm('Are Sure Want to delete this page?');" href="<?php echo site_url('admin/content_management/delete/'.$content['id'])?>" style="color:#FFFFFF"><i class="icon-trash icon-white"></i></a></td>
		</tr>
   <?php endforeach; 
  }?>     
	</tbody>
</table>

<div class="divider15"></div>
</div>
</div>

