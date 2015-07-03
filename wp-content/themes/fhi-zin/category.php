<?php get_header(); ?>
<div id="wrap_inside">
    <div id="content">
        <div id="content_right" class="full-width">
            <h1><?php the_category() ?></h1>
            <?php
            if (!is_category(get_category_by_slug("articulos"))) {
                if (have_posts ()) {
                    while (have_posts ()) {
                        the_post ();
            ?>
                        <div id="scroller_text">
                            <h1><a href="<?php echo get_permalink () ?>" rel="bookmark" title="Permanent Link to '<?php the_title (); ?>'"><?php the_title (); ?></a></h1>
                <?php the_excerpt () ?>
                    </div>
            <?php
                    }
                } else {
                    echo '<div id="nohay">No hay Entradas para mostrar.</div>';
                }
            } elseif (is_category(get_category_by_slug("articulos"))) {
                if (have_posts ()) {
                    while (have_posts ()) {
                        the_post();
            ?>
                        <div class="conartitem">
                            <span></span>
                            <div>
                            <?php
                                the_title();
                                $archivo = get_post_meta($post->ID, "adjunto", true);
                                $textoarchivo = "Descargar";
                            ?>&nbsp;<a target="_blank" class="artitem" href="<?= $archivo ?>"><?= $textoarchivo ?></a>
                            </div>
                        </div>
            <?php
                    }
                } else {
                    echo '<div id="nohay">No hay Entradas para mostrar.</div>';
                }
            ?>
                <script type="text/javascript">
                    jQuery(document).ready(function(){
                        jQuery(".menu-item-274").addClass("current-menu-item");
                        jQuery(".menu-item-274").addClass("current_page_item");
                    });
                </script>
            <?php
            }
            ?>

        </div>
    </div>
</div>
<?php get_footer(); ?>