<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title><?php echo (!empty($seo_title)) ? $seo_title .' - ' : ''; echo $this->config->item('company_name'); ?></title>

<!-- Mobile Specific Metas==== -->
<meta name="viewport" content="width=device-width, initial-scale=1">


<base  />
<link rel="stylesheet" type="text/css" href="<?php echo base_url('application/themes/default/assets/ext/jquery/ui/redmond/jquery-ui-1.8.22.css'); ?>" />
<!--[if lt IE 9]>
<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>

<![endif]-->

<script type="text/javascript" src="<?php echo base_url('application/themes/default/assets/ext/jquery/jquery-1.8.0.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('application/themes/default/assets/ext/jquery/ui/jquery-ui-1.8.22.min.js'); ?>"></script>

<script type="text/javascript">
// fix jQuery 1.8.0 and jQuery UI 1.8.22 bug with dialog buttons; http://bugs.jqueryui.com/ticket/8484
if ( $.attrFn ) { $.attrFn.text = true; }
</script>


<script type="text/javascript" src="<?php echo base_url('application/themes/default/assets/ext/jquery/bxGallery/jquery.bxGallery.1.1.min.js'); ?>"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('application/themes/default/assets/ext/jquery/fancybox/jquery.fancybox-1.3.4.css'); ?>" />
<script type="text/javascript" src="<?php echo base_url('application/themes/default/assets/ext/jquery/fancybox/jquery.fancybox-1.3.4.pack.js'); ?>"></script>

<link rel="stylesheet" type="text/css" href="<?php echo base_url('application/themes/default/assets/ext/960gs/960_24_col.css'); ?>" />

<!-- buyshop styles -->
<?php echo theme_css('reset.css', true);?>
<?php echo theme_css('bootstrap.css', true);?>
<?php echo theme_css('bootstrap-responsive.css', true);?>
<?php echo theme_css('flexslider.css', true);?>
<?php echo theme_css('andepict.css', true);?>
<?php echo theme_css('product-slider.css', true);?>
<?php echo theme_css('jquery.selectbox.css', true);?>
<?php echo theme_css('nouislider.css', true);?>
<?php echo theme_css('layerslider.css', true);?>
<?php echo theme_css('style.css', true);?>

<!-- new fancybox -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url('application/themes/default/assets/buyshop_theme/buyshop_styles/fancybox/jquery.fancybox-buttons.css'); ?>" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url('application/themes/default/assets/buyshop_theme/buyshop_styles/fancybox/jquery.fancybox-thumbs.css'); ?>" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url('application/themes/default/assets/buyshop_theme/buyshop_styles/fancybox/jquery.fancybox.css'); ?>" />
<!-- new fancybox -->

<?php echo theme_css('megastore.css', true);?>
<?php echo theme_css('light-theme.css', true);?>



<!--[if IE 8 ]><link rel="stylesheet" type="text/css" href="<?php echo base_url('application/themes/default/assets/buyshop_theme/buyshop_styles/styleie8.css'); ?>" /><![endif]-->
<!--[if IE 9]><link rel="stylesheet" type="text/css" href="<?php echo base_url('application/themes/default/assets/buyshop_theme/buyshop_styles/styleie9.css'); ?>" /><![endif]-->


<!--[if !IE]><!-->
<script>if(/*@cc_on!@*/false){document.documentElement.className+='ie10';}</script>
<!--<![endif]-->

<!-- end buyshop styles -->

<!-- buyshop scripts -->
<!--
<script src="https://ajax.googleapis.com/ajax/libs/prototype/1.7.1.0/prototype.js"></script>
-->
<?php echo theme_js('html5.js', true);?>
<?php echo theme_js('jquery-1.7.2.min.js', true);?>
<?php echo theme_js('jquery-ui.min.js', true);?>
<?php echo theme_js('bootstrap.js', true);?>
<?php echo theme_js('jquery.easing.js', true);?>
<?php echo theme_js('jquery.mousewheel.js', true);?>
<?php echo theme_js('jquery.flexslider.js', true);?>
<?php echo theme_js('layerslider.kreaturamedia.jquery.js', true);?>
<?php echo theme_js('layerslider_output_light.js', true);?>
<?php echo theme_js('jquery.elastislide.js', true);?>
<?php echo theme_js('jquery.selectbox-0.2.js', true);?>
<?php echo theme_js('jquery.nouislider.js', true);?>
<?php echo theme_js('cloud-zoom.1.0.2.js', true);?>
<?php echo theme_js('retina-replace.js', true);?>
<!-- new fancybox -->
<?php echo theme_js('fancybox/jquery.fancybox.js', true);?>
<?php echo theme_js('fancybox/jquery.fancybox-buttons.js', true);?>
<?php echo theme_js('fancybox/jquery.fancybox-thumbs.js', true);?>
<?php echo theme_js('fancybox/jquery.easing-1.3.pack.js', true);?>
<?php echo theme_js('fancybox/jquery.mousewheel-3.0.6.pack.js', true);?>
<!-- new fancybox -->

<?php echo theme_js('custom.js', true);?>

<!-- end buyshop scripts -->
<link href='http://fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Rokkitt' rel='stylesheet' type='text/css'>

<link href='http://fonts.googleapis.com/css?family=Rokkitt:200,300,400,500,600,700,800' rel='stylesheet' type='text/css'>

<!-- options from admin -->
<style type="text/css">
/* bg image  */
        /* bg image  */

            /* theme color  */
        .bgcolor_icon,
        .form-mail button,
        .es-nav a.btn:hover,
        .flexslider.small .flex-direction-nav a:hover,
        .nav-tabs > li > a:hover, .nav-tabs > .active > a, .nav-tabs > .active > a:hover,
        .product-img-box .more-views li .video i,
        .nav > li > a:hover{
            background-color:        }

        #topline a:hover,
        #topline .fadelink li a:hover, #topline .fadelink > a:hover,
        #nav > li.home-link:hover > a,
        .nav-list li li a:hover,
        .breadcrumbs a,
        a .custom_color,
        a:hover .custom_color, a.custom_color:hover,
        .twit .icon,
        h4 [class^="icon-twitter-bird"],
        .flex-direction-nav a,
        .form-search button.btn-top-search,
        .product .product-tocart a, .preview .product-tocart a,
        .rating strong i,
        .orderEdit{
            color:        }

        textarea:focus, input[type="text"]:focus, input[type="password"]:focus, input[type="datetime"]:focus, input[type="datetime-local"]:focus, input[type="date"]:focus, input[type="month"]:focus, input[type="time"]:focus, input[type="week"]:focus, input[type="number"]:focus, input[type="email"]:focus, input[type="url"]:focus, input[type="search"]:focus, input[type="tel"]:focus, input[type="color"]:focus, .uneditable-input:focus,
        .cloud-zoom-big{
            border-color: ;
        }

        #nav > li > ul,
        #nav li:hover .menu_custom_block,
        .ui-widget-header,
        .ui-widget-content,
        .tab-content{
            border-color:;

        }

        button, .button,
        .shopping_cart_mini .button:hover,
        #nav > li:hover > a,
        button.button-3x, .button.button-3x,
        .nav-header > a,
        .custom_submit,
        .ui-widget-header,
        .middle_icon_color{
            background:;
        }
/* end theme color  */

/* text color  */
        body, #topline .phone, .hidden-small-desktop, #topline .link_label,
        select, textarea, input[type="text"], input[type="password"], input[type="datetime"], input[type="datetime-local"], input[type="date"], input[type="month"], input[type="time"], input[type="week"], input[type="number"], input[type="email"], input[type="url"], input[type="search"], input[type="tel"], input[type="color"], .uneditable-input,
        .product .product-price, .product .product-price-regular, .preview .product-price, .preview .product-price-regular,
        .cleancode, ul.icons li, #footer_bottom .noHover span.text, #footer_bottom .noHover span.text span, .form-mail input,
        .rating-stars span,
        .custom_color,
        .shopping_cart_mini, .shopping_cart_mini .product-price,
        .product .product-price span.old, .product .product-price-regular span.old, .preview .product-price span.old, .preview .product-price-regular span.old{
            color: ;
        }
/* end text color  */

/* link color  */
        a, #topline, #topline a, #footer_bottom i,
        #topline .fadelink > a, #topline .fadelink li a, #topline .fadelink > a,
        #nav > li > a, #footer_popup p a, #nav li.level1 > a, #nav li.level2 > a, .nav-tabs > li > a,
        .reviews-box a.custom_submit, .reviews-box .reviews_link,
        .twit a,
        .shopping_cart_mini .product-detailes .product-name{
            color: ;
        }
/* end link color  */

/* link hover color  */
        a:hover,
        #topline a:hover,
        #topline .fadelink li a:hover, #topline .fadelink > a:hover,
        #nav > li.home-link:hover > a,
        .nav-list li li a:hover,
        .breadcrumbs a:hover, #nav > li:hover > a,
        .flexslider.small .flex-direction-nav a:hover,
        .custom_submit:hover, #nav li.level1:hover > a, #nav li.level2:hover > a, #footer_popup p a:hover,
        .nav-tabs > li > a:hover, .nav-tabs > .active > a, .nav-tabs > .active > a:hover,
        .twit a:hover,
        .shopping_cart_mini .product-detailes .product-name:hover{
            color: ;
        }

            /* end link hover color  */

/* Background color  */
        body{
            background-color:;
        }
/* end Background color  */

/* captions color  */
        h1, #column_right h1, h2, h3, h4,
        .nav-list li a,
        #nav > li > a,
        .block .block-title,
        .accordion-heading,
        .custom_blocks .box a,
        #footer_popup h3, #footer_popup h4,
        button, .button,
        .custom_submit,
        .infoBox .infoBoxHeading, .infoBox .infoBoxHeading a,
        button.button-2x, .button.button-2x,
        button.button-3x, .button.button-3x,
        .product-shop .product-name h1, #column_right .product-shop .prod_info_name h1{
            color: ;
        }
/* end captions color  */

/* captions google font  */

        h1, #column_right h1, h2, h3, h4,
        .nav-list li a,
        #nav > li > a,
        .block .block-title,
        .accordion-heading,
        .custom_blocks .box a,
        #footer_popup h3, #footer_popup h4,
        .infoBox .infoBoxHeading, .infoBox .infoBoxHeading a,
        button.button-2x, .button.button-2x,
        button.button-3x, .button.button-3x,
        .product-shop .product-name h1, #column_right .product-shop .prod_info_name h1,
        .product-shop h2.custom_block_title{
            font-family:Rokkitt;
        }

/* end captions google font  */

/* simple product view in listing  */

/* simple product view in listing  */





    </style>
    <!-- end options from admin -->

</head>

<body>

		
		

<?php
/*
End header.php file
*/