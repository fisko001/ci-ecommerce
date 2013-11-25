

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $title; ?> | Admin</title>
<?php echo include_jquery(); ?>
<?php echo include_jquery_ui(); ?>
<?php echo include_jquery_ui_css(); ?>
<?php echo admin_main_css(); ?>
<link href='http://fonts.googleapis.com/css?family=Cuprum' rel='stylesheet' type='text/css' />


<script type="text/javascript" src="<?php echo base_url();?>assets/js/wysiwyg/jquery.wysiwyg.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/wysiwyg/wysiwyg.image.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/wysiwyg/wysiwyg.link.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/wysiwyg/wysiwyg.table.js"></script>

<script type="text/javascript" src="<?php echo base_url('assets/js/dataTables/jquery.dataTables.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/dataTables/colResizable.min.js'); ?>"></script>



<script type="text/javascript" src="<?php echo base_url('assets/js/forms/forms.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/forms/autogrowtextarea.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/forms/autotab.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/forms/jquery.validationEngine-en.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/forms/jquery.validationEngine.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/forms/jquery.dualListBox.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/forms/jquery.maskedinput-1.3.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/forms/jquery.multiselect.min.js'); ?>"></script>



<script type="text/javascript" src="<?php echo base_url('assets/js/ui/jquery.jgrowl.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/ui/jquery.tipsy.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/ui/jquery.alerts.js'); ?>"></script>

<script type="text/javascript" src="<?php echo base_url('assets/js/jBreadCrumb.1.1.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/cal.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.collapsible.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.ToTop.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.listnav.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.sourcerer.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.timeentry.min.js'); ?>"></script>


<script type="text/javascript" src="<?php echo base_url('assets/js/fancybox/jquery.fancybox-1.3.4.pack.js'); ?>"></script>
<link href="<?php echo base_url('assets/js/fancybox/jquery.fancybox-1.3.4.css'); ?>" type="text/css" rel="stylesheet" />
<!--<link href="<?php echo base_url('assets/css/admin/ui.dropdownchecklist.themeroller.css'); ?>" type="text/css" rel="stylesheet" />-->

<script type="text/javascript" src="<?php echo base_url('assets/js/custom.js'); ?>"></script>
</head>

<body>

<!-- Top navigation bar -->
<div id="topNav">
    <div class="fixed">
        <div class="wrapper">
            <div class="welcome"><a href="<?php  echo site_url('admin/administration/dashboard'); ?>" title=""><img src="<?php echo base_url('assets/css/admin/images/userPic.png'); ?>" alt="" /></a><span>Howdy, <?php echo $_SESSION['email']; ?></span></div>
            <div class="userNav">
                <ul>
                    <li><a href="<?php echo site_url('admin/administration/admin_accounts'); ?>" title=""><img src="<?php echo base_url('assets/css/admin/images/icons/topnav/profile.png'); ?>" alt="" /><span>Admin Accounts</span></a></li>
                    <li><a href="<?php echo site_url('admin/administration/account_settings'); ?>" title=""><img src="<?php echo base_url('assets/css/admin/images/icons/topnav/settings.png'); ?>" alt="" /><span>Account Settings</span></a></li>
                    <li><a href="<?php echo site_url('admin/administration/logout'); ?>" title=""><img src="<?php echo base_url('assets/css/admin/images/icons/topnav/logout.png'); ?>" alt="" /><span>Logout</span></a></li>
                </ul>
            </div>
            <div class="fix"></div>
        </div>
    </div>
</div>

<!-- Header -->
<div id="header" class="wrapper">
    <div class="logo"><a href="<?php echo site_url('admin/administration/dashboard'); ?>" title="">Home</a></div>
    <div class="fix"></div>
</div>


<!-- Content wrapper -->
<div class="wrapper">
	
	<!-- Left navigation -->
    <div class="leftNav">
    	<ul id="menu">
		<!--
                <li class="dash"><a href="#" title="" class=""><span>Reports</span></a></li>
            <li class="forms"><a href="<?php echo site_url('admin/entities/upload_invoice'); ?>" title=""><span>Invoices</span></a></li>
            <li class="login"><a href="<?php echo site_url('admin/seekers'); ?>" title=""><span>Job Seekers</span></a></li>
            <li class="recruiter"><a href="#" title="" class="exp"><span>Recruiters</span></a>
                <ul class="sub">
                    <li><a href="<?php echo site_url('admin/recruiters/new_applications'); ?>" title="">New Applications</a></li>
                    <li><a href="<?php echo site_url('admin/recruiters'); ?>" title="">All Recruiters</a></li>
                    <li><a href="<?php echo site_url('admin/recruiters/create'); ?>" title="">Add New Recruiter</a></li>
                </ul>
            </li>
            <li class="tables"><a href="#" title="" class="exp"><span>Companies and Entities</span></a>
                <ul class="sub">
                    <li><a href="<?php echo site_url('admin/entities/upload_invoice'); ?>" title="">Upload Invoice</a></li>
                    <li><a href="<?php echo site_url('admin/entities/'); ?>" title="">All Entities</a></li>
                    <li><a href="<?php echo site_url('admin/companies/'); ?>" title="">All Companies</a></li>
                </ul>
            </li>
            <li class="jobs"><a href="calendar.html" title="" class="exp"><span>Jobs</span></a>
                <ul class="sub">
                    <li><a href="403.html" title="">Search</a></li>
                    <li><a href="<?php echo site_url('admin/jobs/active_jobs'); ?>" title="">Active Jobs</a></li>
                    <li><a href="405.html" title="">Expiring Jobs</a></li>
                    <li><a href="500.html" title="">Jobs Archive</a></li>
                </ul>
            </li>
            <li class="graphs"><a href="#" title="" class="exp"><span>Parameters</span></a>
                <ul class="sub">
                    <li><a href="<?php echo site_url('admin/job_types'); ?>" title="">Job Types</a></li>
                    <li><a href="<?php echo site_url('admin/work_types'); ?>" title="">Work Types</a></li>
                    <li><a href="<?php echo site_url('admin/practice_areas'); ?>" title="">Practice Areas</a></li>
                    <li><a href="<?php echo site_url('admin/employer_types'); ?>" title="">Employer Types</a></li>
                    <li><a href="<?php echo site_url('admin/entity_types'); ?>" title="">Entity Types</a></li>
                    <li><a href="<?php echo site_url('admin/countries');?>" title="">Countries</a></li>
                    <li><a href="<?php echo site_url('admin/states/locations');?>" title="">Locations</a></li>
                    <li><a href="<?php echo site_url('admin/states');?>" title="">States</a></li>
                    <li><a href="<?php echo site_url('admin/user_titles');?>" title="">User Titles</a></li>
                    <li><a href="<?php echo site_url('admin/currency_tax/currency');?>" title="">Currency</a></li>
                    <li><a href="<?php echo site_url('admin/currency_tax/tax');?>" title="">Tax</a></li>
                </ul>
            </li>
            <li class="files"><a href="<?php echo site_url('admin/advertisement'); ?>" title=""><span>Advertising</span></a></li>
            <li class="graphs"><a href="#" title="" class="exp"><span>Content Management</span></a>
                <ul class="sub">
                    <li><a href="<?php echo site_url('admin/content_management/add_pages'); ?>" title="">Add Pages</a></li>
                    <li><a href="<?php echo site_url('admin/content_management'); ?>" title="">List Pages</a></li>
                </ul>
            </li>
            
            <li class="dash"><a href="#" title="" class="exp"><span>Rates(Invoiced Account)</span></a>
                <ul class="sub">
                    <li><a href="<?php echo site_url('admin/rates/add_invoiced_rate'); ?>" title="">Add Rates</a></li>
                    <li><a href="<?php echo site_url('admin/rates/invoiced'); ?>" title="">List Rates</a></li>
                </ul>
            </li>
            <li class="dash"><a href="#" title="" class="exp"><span>Rates(Non-invoiced Account)</span></a>
                <ul class="sub">
                    <li><a href="<?php echo site_url('admin/rates/add_non_invoiced_rate'); ?>" title="">Add Rates</a></li>
                    <li><a href="<?php echo site_url('admin/rates/noninvoiced'); ?>" title="">List Rates</a></li>
                </ul>
            </li>
			-->
			
	  <li class="graphs"><a href="#" title="" class="exp"><span>Content Management</span></a>
                <ul class="sub">
                    <li><a href="<?php echo site_url('admin/content_management/add_pages'); ?>" title="">Add Pages</a></li>
                    <li><a href="<?php echo site_url('admin/content_management'); ?>" title="">List Pages</a></li>
                </ul>
            </li>
			 <li class="graphs"><a href="#" title="" class="exp"><span>Emails Management</span></a>
                <ul class="sub">
                    <li><a href="<?php echo site_url('admin/emails_management/add_emails'); ?>" title="">Add Email Content</a></li>
                    <li><a href="<?php echo site_url('admin/emails_management'); ?>" title="">List Emails</a></li>
                </ul>
            </li>
          <li class="graphs"><a href="#" title="" class="exp"><span>Users</span></a>
                <ul class="sub">
                    
                    <li><a href="<?php echo site_url('admin/users'); ?>" title="">Users</a></li>
                    <li><a href="<?php echo site_url('admin/users/add_user'); ?>" title="">Add New User</a></li>

                </ul>
            </li>
			
			<li class="graphs" onClick="document.location='<?php echo site_url('admin/categories'); ?>';"><a href="<?php echo site_url('admin/categories'); ?>" title="" class="exp"><span>Categories</span></a>
               
            </li>
        </ul>
    </div>
    
    <!-- Content -->
    <div class="content">
    	<div class="title"><h5><?php echo isset($title)?$title:'No title Set'; ?></h5></div>
            <?php echo $contents; ?>
    </div>
    <div class="fix"></div>
</div>

<!-- Footer -->
<div id="footer">
	<div class="wrapper">
            <span>&copy; Copyright <?php echo date('Y'); ?>, RUSAGAR.COM. </span>
    </div>
</div>

</body>
</html>
