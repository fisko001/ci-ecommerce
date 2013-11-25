<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title><?php echo $title; ?> | Welcome to Admin Dashboard</title>
<link href='<?php echo base_url('assets/shamcey/css/style.default.css'); ?>' rel='stylesheet' type='text/css' />
<link href='<?php echo base_url('assets/shamcey/css/style.shinyblue.html'); ?>' rel='stylesheet' type='text/css' />
<script type="text/javascript" src="<?php echo base_url('assets/shamcey/js/jquery-1.9.1.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/shamcey/js/bootstrap.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/shamcey/js/jquery-ui-1.10.3.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/shamcey/js/modernizr.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/shamcey/js/bootstrap.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/shamcey/js/jquery.cookie.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/shamcey/js/custom.js'); ?>"></script>
<script type="text/javascript">
    jQuery(document).ready(function(){
        jQuery('#login').submit(function(){
            var u = jQuery('#email').val();
            var p = jQuery('#password').val();
            if(u == '' && p == '') {
                jQuery('.login-alert').fadeIn();
                return false;
            }else{
				 jQuery('.login-alert').fadeOut();
			}
        });
    });
</script>
</head>

<body class="loginpage">
<div class="loginpanel">
	<?php echo $contents; ?>
</div>
<!--loginpanel-->

<div class="loginfooter">
     <p>&copy; <?=date('Y');?>. RUSAGAR.COM. All Rights Reserved.</p>
</div>

</body>
</html>


