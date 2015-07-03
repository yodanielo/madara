        </div>
        <?php get_sidebar(); ?>
    </div>
</div>
<div id="footer">
	<div id="copyright"><a href="http://desarrollo.madara.es/mapa-web/" alt="mapa-web">Mapa Web</a> |<a href="http://desarrollo.madara.es/aviso-legal/" alt="Aviso Legal"> Aviso Legal </a>| <a href="http://desarrollo.madara.es/politicas-de-privacidad/" alt="Pol&iacute;tica de Privacidad">Pol&iacute;tica de Privacidad</a> | <a target="_blank" href="http://www.artesanosdigitales.com/" alt="Artesanos Digitales">by Artesanos Digitales</a></div>
</div>


<div id="comments_title_container">
	<div id="comments_title"><!-- begin comments_title --><?php if(is_single()): ?><a onclick="doComments();" class="bda_ignore"><?php comments_number('No comments', 'One comment', '% comments' );?></a><?php endif; ?><!-- end comments_title --></div>
</div>
<div id="comments_content_container">
    <div id="comments_content">
    <!-- begin comments_content -->
    <?php if(is_single()) comments_template(); ?>
    <!-- end comments_content -->
    </div>
</div>
<script type="text/javascript">
    resizar=function(){
        //jQuery("#container").height(jQuery(window).height()-jQuery("#header").height());
        //document.title=jQuery(window).height();
    }
    resizar();
    //window.onresize=resizar;
    jQuery(document).resize(resizar);
</script>
<?php wp_footer(); ?>
<!-- statistics -->
<!--img src="http://www.bydust.com/statistics/?project=fhi-zin&host=<?php //echo get_settings('home'); ?>" style="display:none;" width="1" height="1" /-->
<!-- no more statistics -->
</body>
</html>
