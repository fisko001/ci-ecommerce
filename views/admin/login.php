<?php defined('BASEPATH') or die('No direct Script Access'); ?>

<div class="loginpanelinner">
	<div class="logo animate0 bounceIn"><img src="<?php echo base_url('assets/shamcey/images/logo.png'); ?>" alt="" /></div>
	 <form id="login" action="" method="post">
		<?php if($error) { ?>
		<div class="inputwrapper">
			<div class="alert alert-error"><?php echo $error; ?></div>
		</div>
		 <?php } ?>
		  <div class="inputwrapper login-alert">
		   <div class="alert alert-error">Please enter username and password</div>
		</div>
		<div class="inputwrapper animate1 bounceIn">
			<input type="text" name="email" id="email" placeholder="Enter any username or email" class="validate[required]"/>
			
		</div>
		<div class="inputwrapper animate2 bounceIn">
			<input type="password" name="password" id="password" placeholder="Enter any password" class="validate[required]" />
		</div>
		<div class="inputwrapper animate3 bounceIn">
			<button name="submit">Sign In</button>
		</div>
		
		<div class="inputwrapper animate4 bounceIn">
			<!--<div class="pull-right">Not a member? <a href="registration.html">Sign Up</a></div>-->
			<label><input type="checkbox" id="check2" class="remember" name="remember" /> Keep me sign in</label>
		</div>
	</form>
</div>
<!--loginpanelinner-->
	