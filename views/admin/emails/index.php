<?php defined('BASEPATH') or die('No direct Script Access'); ?>

<div class="pageheader">
   
	<div class="pageicon"><span class="iconfa-table"></span></div>
	<div class="pagetitle">
		<h5>Contents</h5>
		<h1>Emails Management</h1>
	</div>
</div><!--pageheader-->

<div class="maincontent">
	<div class="maincontentinner">
	<div style="text-align:right">
		<a class="btn" href="<?php echo site_url('admin/emails_management/add_emails'); ?>"><i class="icon-plus-sign"></i> Add New Page</a>
	</div>
	<table class="table responsive">
		<thead>
			<tr>
				<th>#</th>
				<th>Subject</th>
				<th>Status</th>
				<th class="center">Action</th>
			</tr>
		</thead>
		<tbody>
		 <?php if (!$email_pages)
		 { ?>
		<tr>
			   <td colspan="4">No data to show.</td>
			</tr>
		<?php
					}
					else {
                                        $i=1;
					foreach ($email_pages as $email):
		?>
					<tr>
					<td><?php echo $i; ?></td>
					<td><?php echo $email['subject']; ?></td>
					<td><?php if($email['status'] == "1"){ echo "Published"; }else{ echo "Unpublished";} ?></td>
					<td class="center">
                                            <a class="btn" href="<?php echo site_url('admin/emails_management/edit/' . $email['email_id']); ?>"><i class="icon-pencil"></i></a>
                                            <a class="btn btn-danger" onclick="return confirm('Are you sure to delete this content?');" href="<?php echo site_url('admin/emails_management/delete/'.$email['email_id'])?>" style="color:#FFFFFF"><i class="icon-trash icon-white"></i></a></td>
					
					</tr>
		<?php $i++; endforeach; }?>
		</tbody>
	</table>

	<div class="divider15"></div>
   </div>
</div>


