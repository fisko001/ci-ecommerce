<?php defined('BASEPATH') or die('No Direct Script Access'); ?>
<div class="widget first">
    <div class="head"><h5 class="iFrames">Administrators</h5></div>
    <table cellpadding="0" cellspacing="0" width="100%" class="tableStatic">    
        <thead>
            <tr>
                <td>User ID</td>
                <td>Name</td>
                <td>Username</td>
                <td>Status</td>
                <td>Group</td>
                <td>Last Login</td>
                <td>Actions</td>
            </tr>
        </thead>
        <?php if (count($administrators) == 0) { ?>
            <tr>
                <td colspan="3">No data to show</td>
            </tr> 
            <?php
        }
        else
            foreach ($administrators as $administrator):
                ?>
                <tr>
                    <td><?php echo $administrator['id']; ?></td>
                    <td><a href="<?php echo site_url('admin/administration/edit_account/'.$administrator['id']); ?>" ><?php echo $administrator['title'] . ' ' . $administrator['first_name'] . ' ' . $administrator['last_name']; ?></a></td>
                    <td><?php echo $administrator['email']; ?></td>
                    <td><?php echo $administrator['active'] ? 'Active' : 'Inactive'; ?></td>
                    <td><?php echo $administrator['group']; ?></td>
                    <td><?php echo ((bool) $administrator['last_login']) ? date('g:ia d/m/Y', $administrator['last_login']) : 'Never Logged in'; ?></td>
                    <td>Actions</td>
                </tr>
            <?php endforeach; ?>

    </table>
    
</div>
<?php echo $this->pagination->create_links(); ?>
<!--Admin Management Menus-->
<div class="widget">
    <div class="head"><h5 class="iImage2">Controls</h5></div>
    <div class="body aligncenter">
        <a href="<?php echo site_url('admin/administration/new_account'); ?>" title="" class="btnIconLeft mr10"><img src="<?php echo base_url('assets/css/admin/images/icons/dark/power.png'); ?>" alt="" class="icon" /><span id="create_new_admin">Create New User</span></a>
    </div>
</div>