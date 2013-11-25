<html>
<body>
	<h1>Activate account for <?php echo $identity;?></h1>
	<p>Please click this link to <?php echo anchor('auth/activate/'. $id .'/'. $activation, 'Activate Your Account');?>.</p>
</body>
</html>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Email Template</title>
<style type="text/css">
body {
	margin: 0;
	padding:0;
	background-color: #f8f8f8;
	font: normal 12px HelveticaMedium, Arial, Helvetica, sans-serif;
	color: #484848;
	}
#footer {
	border-top: 3px solid #909090;
	padding: 28px 0 0;
	}
@font-face {
    font-family: 'HelveticaMedium';
    src: url('helvetica-webfont.eot');
    src: url('helvetica-webfont.eot?#iefix') format('embedded-opentype'),
         url('helvetica-webfont.woff') format('woff'),
         url('helvetica-webfont.ttf') format('truetype'),
         url('helvetica-webfont.svg#HelveticaMedium') format('svg');
    font-weight: normal;
    font-style: normal;

}
#footer {
	color: #1e1d1d;
	padding: 26px 50px 0;
	}
p {
	margin: 0;
	line-height: 24px;
	}
a {
	color: #e7112c;
	text-decoration: none;
	}
a:hover {
	text-decoration: underline;
	}	
.footerLink a{
	color: #343434;
	text-decoration: none;
	}
.footerLink a:hover {
	/*text-decoration: underline;*/
	border-bottom: 1px solid #cccccc;
	}
.footerLink p img {
	vertical-align: middle;
	padding: 0 0 0 8px;
	}
#content {
	padding: 44px 0 120px;
	}
</style>
</head>

<body>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td><table width="700" border="0" cellpadding="0" cellspacing="0" align="center">
  <tr>
    <td><img src="header.jpg" alt="" /></td>
  </tr>
</table>
</td>
  </tr>
  <tr>
    <td><table width="600" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td id="content">
    <p>Dear Subscriber Name</p>
    
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas sagittis risus sit amet purus convallis elementum. Maecenas felis purus, tempus non adipiscing vitae, elementum quis sem. Curabitur sit amet massa at dolor aliquet ullamcorper. Sed tincidunt enim sed urna suscipit eget tempor felis feugiat. Suspendisse potenti. Aenean dignissim pulvinar metus in commodo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Sed scelerisque placerat sodales. Nulla mattis, arcu sit amet adipiscing vestibulum, est orci accumsan sapien, non varius tortor nulla quis neque. Phasellus hendrerit eros eget libero egestas sed hendrerit massa mattis. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Praesent nisi dolor, euismod nec tincidunt vitae, fringilla ac nisi.

<br /><br />Fusce mollis lacinia justo quis porta. Donec porttitor lacinia lobortis. Vivamus risus lectus, ultrices ut lobortis ac, facilisis at sem. In porta lobortis lacus eu commodo. Etiam sodales erat vel eros malesuada malesuada pulvinar elit ullamcorper. Duis sit amet risus nunc, quis rhoncus tortor. Pellentesque sed justo purus, at tempor felis. 

<br /><br />Phasellus purus nisl, lacinia vel convallis et, <a href="#">http://www.bizelaw.com/notification-url/</a></p>
<p>&nbsp;</p>
<p><a href="#"><img src="btn.gif" alt="" /></a></p>
    </td>
  </tr>
</table>
</td>
  </tr>
  <tr>
    <td><table width="700" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td id="footer">
    <table width="600" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="left">
    <p>If you wish to unsubscribe to this mailing service,</p>
	<p>please <a href="#">click here</a></p>
    </td>
    <td align="right" class="footerLink">
    <p><strong>Follow us on</strong> <img src="social.jpg" alt="" border="0" usemap="#Map" /></p>
    <p>&copy; <a href="#">bizelaw Pty. Ltd.</a> 2012</p>
    </td>
  </tr>
</table>

    </td>
  </tr>
</table>
</td>
  </tr>
</table>

<map name="Map" id="Map">
  <area shape="rect" coords="-1,-1,17,15" href="#" />
  <area shape="rect" coords="19,0,37,15" href="#" />
  <area shape="rect" coords="40,1,76,14" href="#" />
</map>
</body>
</html>
