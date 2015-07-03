<?php get_header(); ?>
<div id="wrap_inside">
    <div id="content">
        <!-- begin content -->
        <?php
        if ($template_home):
            if (have_posts ()):
                while (have_posts ()) : the_post(); ?>
                    <div id="scroller_text">
                        <h1><a href="<?php echo get_permalink() ?>" rel="bookmark" title="Permanent Link to '<?php the_title(); ?>'"><?php the_title(); ?></a></h1>
            <?php the_content(''); ?>
                </div>
        <?php
                    endwhile;
                endif;
                query_posts('cat=-999');
                $more = false;
            elseif (is_search ()): ?>
                <div id="scroller_text">
                    <h1>Search results for "<?php the_search_query(); ?>".</h1>
            <?php if (have_posts ()): ?>
                    <p>These are the search results for "<?php the_search_query(); ?>".<br/>If this is not what you expected, try using other search terms.</p>
            <?php else: ?>
                        <p>I'm sorry, I couldn't find anything that matches "<?php the_search_query(); ?>".<br/>Try using other search terms.</p>
            <?php endif; ?>
                    </div><?php elseif (is_404 ()): ?>
                        <div id="scroller_text">
                            <h1>The page you requested could not be found.</h1>
                            <p>I'm sorry, but I couldn't find the page you requested.<br/>Please try the searchbox in the upper right corner, or pick one of the items  below.</p>
                        </div><?php endif; ?>
                        <div id="scroller">
            <?php
                            if (is_home ()) {
                                //global $paged;
                                $args = array(
                                    'numberposts' => 10,
                                    'post_type' => 'page',
                                    'posts_per_page' => 7,
                                    'paged'=>($_GET["page"] ?$_GET["page"] : 1),
                                    'post__in'=>array(436,158,427,409,383,334,328,323,319,289)//289,319,323,328,334,383,409,427,158,436)//,)
                                );
                                query_posts($args);
                                $nombres=array(
                                    427=>"Urbanismo",
                                    436=>"Consulting",
                                    334=>"Hosteleria y Restauración",
                                    328=>"Industrial",
                                    323=>"Edificios Públicos",
                                    319=>"Oficinas",
                                    289=>"Residencial",
                                    383=>"Franquicias",
                                    409=>"Infraestructura",
                                    158=>"Concursos",
                                );
                                if (have_posts ()):
                                    global $id;
                                    $postCount = 0;
                                    $basepath = split('wp-content', TEMPLATEPATH);
                                    $image404 = get_bloginfo('template_directory') . '/images/imagenotfound.jpg';
                                    while (have_posts ()) : the_post();
                                        $postCount++;
                                        if ($postCount <= 7) :
                                            $image_small_150x150 = get_post_meta($id, 'image_small_120x120', true);
                                            $imagepath = $image_small_150x150 ? split('wp-content', $image_small_150x150) : split('wp-content', $image404);
                                            $image_small_150x150_refl = get_bloginfo('template_directory') . '/tools/reflect.php?grayscale=1&img=' . $basepath[0] . 'wp-content' . $imagepath[1] . '&cache=1&merge_images=1&fade_start=70&spacing=1';
            ?><a onmouseover="showScrollerInfo(this);" lang="<?php echo $nombres[$post->ID] ?>" onmouseout="hideScrollerInfo(this);" href="<?php the_permalink(); ?>"><img id="scroller_image<?php echo $postCount; ?>" src="<?php echo $image_small_150x150_refl; ?>" width="72" /></a>
            <?php
                                            endif;
                                        endwhile;
                                    endif;
                                } ?>
                            </div>
                            <div id="scroll_loader" class="loading" style="display:none;">Initiating page...</div>
                            <script type="text/javascript">hideScroller(); // show preloader</script>
                            <div id="scroller_info"></div>
                            <script type="text/javascript">
                                load_scroller();
                            </script>
                            <!-- end content -->
                        </div>
                        <?php if(($_GET["page"] ?$_GET["page"] : 1)==1){ ?>
                        <div id="next_posts" style="display:block"><!-- begin next_posts --><a href="?page=2"><?='<img src="' . get_bloginfo('template_directory') . '/images/next.png" />'?></a><!-- end next_posts --></div>
                        <?php }
                        else{?>
                        <div id="previous_posts" style="display:block"><!-- begin previous_posts --><a href="?page=1"><?php echo('<img src="' . get_bloginfo('template_directory') . '/images/previous.png" />') ?><!-- end previous_posts --></a></div>
                        <?php } ?>
                    </div>
<?php get_footer(); ?>
