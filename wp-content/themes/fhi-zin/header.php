<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
        <meta name="generator" content="WordPress <?php bloginfo('version'); ?>" />

        <title><?php wp_title(''); ?>  <?php bloginfo('name'); ?></title>

        <link href="<?php bloginfo('stylesheet_url'); ?>" rel="stylesheet" type="text/css" />
        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
        <link rel="shortcut icon" href="<?php bloginfo('template_directory'); ?>/images/favicon.gif" type="image/x-icon" />
        <!--[if IE]><script type="text/javascript">window.onerror = function(){return true;}</script><![endif]-->
        <script type="text/javascript">
            var theThemeFolder = '<?php bloginfo('template_directory'); ?>/';
            var theBlogTitle = '<?php bloginfo('name'); ?>';
        </script>
        <script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/com.bydust.array.js"></script>
        <script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/com.bydust.ajax.js"></script>
        <script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/com.bydust.expandingImages.js"></script>
        <script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/lightbox/prototype.js"></script>
        <script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/lightbox/scriptaculous.js?load=effects,builder"></script>
        <script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/lightbox/lightbox.js"></script>
        <script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/scroll.js"></script>
        <script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/main.js"></script>


        <?php wp_head(); ?>
        <script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/jquery.cycle.all.latest.js"></script>
        <script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/generales.js"></script>
        <!--[if IE ]>
            <link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/ie.css" />
        <![endif]-->
        <!--[if lte IE 7]>
            <link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/ie7.css" />
        <![endif]-->
    </head>

    <body>
        <div id="header">
            <form id="fhizin_searchform" method="get" action="<?php echo get_settings('home'); ?>"><div>
                    <input type="text" name="s" id="s" class="search_blur" value="type to search" onkeyup="fhizin_quicksearch();" onfocus="fhizin_quicksearch_onfocus();" onblur="fhizin_quicksearch_onblur();" />
                </div></form>
            <script type="text/javascript">
                var qs = bd$('s');
                function fhizin_quicksearch(){
                    setTimeout("fhizin_quicksearch_dosearch()",1000);
                }
        
                function fhizin_quicksearch_dosearch(){
                    bda.postForm(bd$('fhizin_searchform'),'<span class="loading"> Searching for "<b>' + qs.value + '</b>".</span>');
                }
        
                function fhizin_quicksearch_onfocus(){
                    if(qs.value == 'type to search') qs.value = '';
                    qs.className = 'search_focus';
                }
        
                function fhizin_quicksearch_onblur(){
                    qs.value = 'type to search';
                    qs.className = 'search_blur';
                }
            </script>
        </div>
        <div id="container">
            <div id="wrap_outside">
                <div id="wrapper">
                    <div id="logo"><a id="logo_link" href="<?php echo get_settings('home'); ?>/"><img src="<?php bloginfo('template_directory'); ?>/images/title.png" title="<?php bloginfo('name'); ?>" alt="<?php bloginfo('name'); ?>" /></a></div>
                    <div id="wrap_middle">
