<?php defined('BASEPATH') or die('No direct Script Access'); ?>

<div class="pageheader">
   
	<div class="pageicon"><span class="iconfa-table"></span></div>
	<div class="pagetitle">
		<h5>Administrators</h5>
		<h1>Admin Management</h1>
	</div>
</div><!--pageheader-->

<div class="maincontent">
<div class="maincontentinner">
<div style="text-align:right">
		<a class="btn" href="#"><i class="icon-plus-sign"></i> Add New User</a>
</div>
    
    
    <table class="table responsive">
	<thead>
		<tr>
			<th>User ID</th>
			<th>Status</th>
			<th>Full Name (E-Mail)</th>
                        <th>Group Type</th>
                        <th>Last Login</th>
			<th class="center">Action</th>
		</tr>
	</thead>
	<tbody>
	 <?php if (count($users) == 0)
                { ?>
                        <tr>
                                <td colspan="6">No data to show</td>
                        </tr> 
                        <?php
                }
                else {
                    foreach ($users as $user):
                            ?>
                            <tr>
                            <td><?php echo $user['id']; ?></td>
                            <td><?php echo (bool) $user['active'] ? 'Active' : 'Disabled'; ?></td>
                            <td><?php echo $user['title'] . ' ' . ucfirst($user['first_name']) . ' ' . ucfirst($user['last_name']) ?> - 
                                    (<?php echo $user['email']; ?>)
                            </td>
                            <td><?php echo ucfirst($user['user_type']); ?></td>
                            <td><?php echo ((bool) $user['last_login']) ? date('g:ia d/m/Y', $user['last_login']) : 'Never Logged in'; ?></td>
                            <td class="center"><a class="btn" href="<?php echo site_url('admin/users/edit/' . $user['id']); ?>"><i class="icon-pencil"></i></a> <a class="btn btn-danger" onclick="return confirm('Are you sure to delete this user?');" href="<?php echo site_url('admin/users/delete/'.$user['id'])?>" style="color:#FFFFFF"><i class="icon-trash icon-white"></i></a></td>
                            </tr>
        <?php endforeach; 
              }
        ?>
	</tbody>
</table>
<?php echo $this->pagination->create_links(); ?>
<div class="divider15"></div>
</div>
</div>

 
