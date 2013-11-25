<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title><?php echo $title; ?> | MegaStore</title>
<link href='<?php echo base_url('assets/shamcey/css/responsive-tables.css'); ?>' rel='stylesheet' type='text/css' />
<link href='<?php echo base_url('assets/shamcey/css/style.default.css'); ?>' rel='stylesheet' type='text/css' />
<script type="text/javascript" src="<?php echo base_url('assets/shamcey/js/jquery-1.9.1.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/shamcey/js/jquery-migrate-1.1.1.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/shamcey/js/jquery-ui-1.10.3.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/shamcey/js/modernizr.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/shamcey/js/bootstrap.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/shamcey/js/jquery.cookie.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/shamcey/js/jquery.uniform.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/shamcey/js/flot/jquery.flot.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/shamcey/js/flot/jquery.flot.resize.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/shamcey/js/responsive-tables.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/shamcey/js/custom.js'); ?>"></script>

<?php if($this->uri->segment(3)!='dashboard'):?>
<link type="text/css" href="<?php echo base_url('assets/css/redactor.css');?>" rel="stylesheet" />
<link type="text/css" href="<?php echo base_url('assets/css/file-browser.css');?>" rel="stylesheet" />
<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/jquery-ui.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/redactor.min.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/file-browser.js');?>"></script>

<script type="text/javascript">
$(document).ready(function(){
	$('.datepicker').datepicker({dateFormat: 'yy-mm-dd'});
	
	$('.redactor').redactor({
		focus: true,
		plugins: ['fileBrowser']
	});
});
</script>
<?php endif;?>
<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/excanvas.min.js"></script><![endif]-->
</head>

<body>
<div id="mainwrapper" class="mainwrapper">
<div class="header">
        <div class="logo">
            <a href="<?php  echo site_url('admin/administration/dashboard'); ?>"><img src="<?php echo base_url('assets/shamcey/images/logo.png'); ?>" alt="" /></a>
        </div>
        <div class="headerinner">
            <ul class="headmenu">
                <li class="odd">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <span class="count">4</span>
                        <span class="head-icon head-message"></span>
                        <span class="headmenu-label">Messages</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="nav-header">Messages</li>
                        <li><a href="#"><span class="icon-envelope"></span> New message from <strong>Jack</strong> <small class="muted"> - 19 hours ago</small></a></li>
                        <li><a href="#"><span class="icon-envelope"></span> New message from <strong>Daniel</strong> <small class="muted"> - 2 days ago</small></a></li>
                        <li><a href="#"><span class="icon-envelope"></span> New message from <strong>Jane</strong> <small class="muted"> - 3 days ago</small></a></li>
                        <li><a href="#"><span class="icon-envelope"></span> New message from <strong>Tanya</strong> <small class="muted"> - 1 week ago</small></a></li>
                        <li><a href="#"><span class="icon-envelope"></span> New message from <strong>Lee</strong> <small class="muted"> - 1 week ago</small></a></li>
                        <li class="viewmore"><a href="messages.html">View More Messages</a></li>
                    </ul>
                </li>
                <li>
                    <a class="dropdown-toggle" data-toggle="dropdown" data-target="#">
                    <span class="count">10</span>
                    <span class="head-icon head-users"></span>
                    <span class="headmenu-label">New Users</span>
                    </a>
                    <ul class="dropdown-menu newusers">
                        <li class="nav-header">New Users</li>
                        <li>
                            <a href="#">
                                <img src="images/photos/thumb1.png" alt="" class="userthumb" />
                                <strong>Draniem Daamul</strong>
                                <small>April 20, 2013</small>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <img src="images/photos/thumb2.png" alt="" class="userthumb" />
                                <strong>Shamcey Sindilmaca</strong>
                                <small>April 19, 2013</small>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <img src="images/photos/thumb3.png" alt="" class="userthumb" />
                                <strong>Nusja Paul Nawancali</strong>
                                <small>April 19, 2013</small>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <img src="images/photos/thumb4.png" alt="" class="userthumb" />
                                <strong>Rose Cerona</strong>
                                <small>April 18, 2013</small>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <img src="images/photos/thumb5.png" alt="" class="userthumb" />
                                <strong>John Doe</strong>
                                <small>April 16, 2013</small>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="odd">
                    <a class="dropdown-toggle" data-toggle="dropdown" data-target="#">
                    <span class="count">1</span>
                    <span class="head-icon head-bar"></span>
                    <span class="headmenu-label">Statistics</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="nav-header">Statistics</li>
                        <li><a href="#"><span class="icon-align-left"></span> New Orders from <strong>Customers</strong> <small class="muted"> - 19 hours ago</small></a></li>
                        <li><a href="#"><span class="icon-align-left"></span> New Statistics from <strong>Users</strong> <small class="muted"> - 2 days ago</small></a></li>
                        <li><a href="#"><span class="icon-align-left"></span> New Statistics from <strong>Comments</strong> <small class="muted"> - 3 days ago</small></a></li>
                        <li><a href="#"><span class="icon-align-left"></span> Most Popular in <strong>Products</strong> <small class="muted"> - 1 week ago</small></a></li>
                        <li><a href="#"><span class="icon-align-left"></span> Most Viewed in <strong>Blog</strong> <small class="muted"> - 1 week ago</small></a></li>
                        <li class="viewmore"><a href="charts.html">View More Statistics</a></li>
                    </ul>
                </li>
                <li class="right">
                    <div class="userloggedinfo">
                        <img src="<?php echo base_url('assets/shamcey/images/photos/thumb1.png'); ?>" alt="" />
                        <div class="userinfo">
                            <h5>Rudra S. Shrestha <small>- rudrasagar@gmail.com</small></h5>
                            <ul>
                                <li><a href="#">Visit Frontend</a></li>
                                <li><a href="<?php echo site_url('admin/administration/account_settings'); ?>">Account Settings</a></li>
                                <li><a href="<?php echo site_url('admin/administration/logout'); ?>">Sign Out</a></li>
                            </ul>
                        </div>
                    </div>
                </li>
            </ul><!--headmenu-->
        </div>
    </div>
    
    <div class="leftpanel">
        
        <div class="leftmenu">        
            <ul class="nav nav-tabs nav-stacked">
            	<li class="nav-header">Navigation</li>
                <li class="<?=($this->uri->segment(3)==='dashboard')?'active':''?>"><a href="<?php  echo site_url('admin/administration/dashboard'); ?>"><span class="iconfa-laptop"></span> Dashboard</a></li>
				
				 <li class="<?=($this->uri->segment(2)==='content_management' || $this->uri->segment(2)==='emails_management' || $this->uri->segment(2)==='locations')?'dropdown active':'dropdown'?>"><a href="#"><span class="iconfa-book"></span>Contents</a>
                    <ul style="<?=($this->uri->segment(2)==='content_management' || $this->uri->segment(2)==='emails_management' || $this->uri->segment(2)==='banners' || $this->uri->segment(2)==='locations' )?'display: block':''?>">
                        <li><a href="<?php echo site_url('admin/content_management'); ?>">Pages</a></li>						
                        <li><a href="<?php echo site_url('admin/emails_management'); ?>">Emails</a></li>
						<li><a href="<?php echo site_url('admin/banners'); ?>">Banners</a></li>    
						<li><a href="<?php echo site_url('admin/locations'); ?>">Locations</a></li>                        
                    </ul>
                </li>				
				 <li class="<?=($this->uri->segment(2)==='categories' || $this->uri->segment(2)==='products' || $this->uri->segment(2)==='coupons' )?'dropdown active':'dropdown'?>"><a href="#"><span class="iconfa-book"></span>Catalog</a>
                     <ul style="<?=($this->uri->segment(2)==='categories' || $this->uri->segment(2)==='products' || $this->uri->segment(2)==='coupons')?'display: block':''?>">
                        <li><a href="<?php echo site_url('admin/categories'); ?>">Categories</a></li>						
                        <li><a href="<?php echo site_url('admin/products'); ?>">Products</a></li> 
						<li><a href="<?php echo site_url('admin/coupons'); ?>">Coupons</a></li> 
						<li><a href="#">Gift Cards</a></li>          
                    </ul>
                </li>
				<li class="<?=($this->uri->segment(2)==='users' || $this->uri->segment(2)==='orders'  || $this->uri->segment(2)==='tickets' )?'dropdown active':'dropdown'?>"><a href="#"><span class="iconfa-book"></span>Users</a>
                   <ul style="<?=($this->uri->segment(2)==='users' || $this->uri->segment(2)==='orders' || $this->uri->segment(2)==='customers' || $this->uri->segment(2)==='tickets')?'display: block':''?>">
                        <li><a href="<?php echo site_url('admin/users'); ?>">Administrators</a></li>
                        <li><a href="<?php echo site_url('admin/customers'); ?>">Customers</a></li>
						<li><a href="<?php echo site_url('admin/tickets'); ?>">Support Help</a></li>
                        <li><a href="#">Orders</a></li>     
                    </ul>
                </li>
                <li><a href="media.html"><span class="iconfa-picture"></span> Media Manager</a></li>
                <li class="dropdown"><a href="#"><span class="iconfa-envelope"></span> Messaging</a>
                    <ul>
                        <li><a href="messages.html">Mailbox</a></li>
                        <li><a href="chat.html">Chat Page</a></li>
                    </ul>
                </li>
                <li><a href="calendar.html"><span class="iconfa-calendar"></span> Calendar</a></li>
                
            </ul>
        </div><!--leftmenu-->
        
    </div><!-- leftpanel -->
    <div class="rightpanel">
        
        <ul class="breadcrumbs">
            <li><a href="<?php  echo site_url('admin/administration/dashboard'); ?>"><i class="iconfa-home"></i></a> <span class="separator"></span></li>
            <li><?php echo isset($title) ? $title: '-'; ?></li>
          
        </ul>
     
	 <?php echo $contents; ?>
	 
	
	 
	 <div class="footer" style="margin-left:10px">
                    <div class="footer-left">
                        <span>&copy; 2013. RUSAGAR.COM. All Rights Reserved.</span>
                    </div>
                    <div class="footer-right">
                        <span>Developed by: <a href="http://www.rusagar.com/" target="_blank">RUSAGAR</a></span>
                    </div>
                </div><!--footer-->
                
            </div><!--maincontentinner-->
        </div><!--maincontent-->
        
    </div><!--rightpanel-->
    
</div><!--mainwrapper-->
<script type="text/javascript">
    jQuery(document).ready(function() {
        
      // simple chart
		var flash = [[0, 11], [1, 9], [2,12], [3, 8], [4, 7], [5, 3], [6, 1]];
		var html5 = [[0, 5], [1, 4], [2,4], [3, 1], [4, 9], [5, 10], [6, 13]];
      var css3 = [[0, 6], [1, 1], [2,9], [3, 12], [4, 10], [5, 12], [6, 11]];
			
		function showTooltip(x, y, contents) {
			jQuery('<div id="tooltip" class="tooltipflot">' + contents + '</div>').css( {
				position: 'absolute',
				display: 'none',
				top: y + 5,
				left: x + 5
			}).appendTo("body").fadeIn(200);
		}
	
			
		var plot = jQuery.plot(jQuery("#chartplace"),
			   [ { data: flash, label: "Flash(x)", color: "#6fad04"},
              { data: html5, label: "HTML5(x)", color: "#06c"},
              { data: css3, label: "CSS3", color: "#666"} ], {
				   series: {
					   lines: { show: true, fill: true, fillColor: { colors: [ { opacity: 0.05 }, { opacity: 0.15 } ] } },
					   points: { show: true }
				   },
				   legend: { position: 'nw'},
				   grid: { hoverable: true, clickable: true, borderColor: '#666', borderWidth: 2, labelMargin: 10 },
				   yaxis: { min: 0, max: 15 }
				 });
		
		var previousPoint = null;
		jQuery("#chartplace").bind("plothover", function (event, pos, item) {
			jQuery("#x").text(pos.x.toFixed(2));
			jQuery("#y").text(pos.y.toFixed(2));
			
			if(item) {
				if (previousPoint != item.dataIndex) {
					previousPoint = item.dataIndex;
						
					jQuery("#tooltip").remove();
					var x = item.datapoint[0].toFixed(2),
					y = item.datapoint[1].toFixed(2);
						
					showTooltip(item.pageX, item.pageY,
									item.series.label + " of " + x + " = " + y);
				}
			
			} else {
			   jQuery("#tooltip").remove();
			   previousPoint = null;            
			}
		
		});
		
		jQuery("#chartplace").bind("plotclick", function (event, pos, item) {
			if (item) {
				jQuery("#clickdata").text("You clicked point " + item.dataIndex + " in " + item.series.label + ".");
				plot.highlight(item.series, item.datapoint);
			}
		});
    
        
        //datepicker
        jQuery('#datepicker').datepicker();
        
        // tabbed widget
        jQuery('.tabbedwidget').tabs();
        
        
    
    });
</script>
</body>
</html>
