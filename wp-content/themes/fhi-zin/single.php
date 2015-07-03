<?php get_header(); ?>
<div id="wrap_inside">
    <div id="content">
    <!-- begin content -->
    <?php 
		if (have_posts()):
		$basepath = split('wp-content', TEMPLATEPATH);
		$lightboxImageURL = array();
		$imagenr = 1;
		$image404 = get_bloginfo('template_directory').'/images/imagenotfound.jpg';
		while (have_posts()) : the_post();
			$externallink = get_post_meta($post->ID, 'externallink', true); 
			$externallink_label = get_post_meta($post->ID, 'externallink_label', true);
			$download_file = get_post_meta($post->ID, 'download_file', true);
			while(get_post_meta($post->ID, 'image'.$imagenr.'_file', true)){
				array_push($lightboxImageURL, get_post_meta($post->ID, 'image'.$imagenr.'_file', true));
				$imagenr++;
			}
			
			$image_small_150x150 = get_post_meta($post->ID, 'image_small_120x120', true); 
			$imagepath = $image_small_150x150?split('wp-content',$image_small_150x150):split('wp-content',$image404);
			$image_small_150x150_refl = get_bloginfo('template_directory').'/tools/reflect.php?img='.$basepath[0].'wp-content'.$imagepath[1].'&cache=1&merge_images=1&fade_start=70&spacing=1';
			
			if(!$externallink_label) $externallink_label = 'Read more...';
			?>
			<div id="content_left">
            	<ul>
					<?php if($externallink) : ?>
                        <li class="externallink"><a href="<?php echo $externallink; ?>" target="_blank" title="External link for '<?php the_title(); ?>'"><?php echo $externallink_label; ?></a></li>
                    <?php endif; ?>
					<?php if($download_file) : ?>
                        <li class="download_file"><a href="<?php echo $download_file; ?>" target="_blank" title="Downloadable file for '<?php the_title(); ?>'">Download</a></li>
                    <?php endif; ?>
					<?php if(count($lightboxImageURL) == 1): ?>
                    	<li class="lightbox_images"><a class="bda_ignore" title="There's an attached image for '<?php the_title(); ?>'" href="<?php echo array_pop($lightboxImageURL); ?>" rel="lightbox">View image</a></li>
                    <?php elseif(count($lightboxImageURL) > 1): ?>
                    	<li class="lightbox_images"><a class="bda_ignore" title="There are <?php echo count($lightboxImageURL); ?> attached images for '<?php the_title(); ?>'" href="<?php echo array_pop($lightboxImageURL); ?>" rel="lightbox[fhizin_images]">View images (<?php echo count($lightboxImageURL) + 1; ?>)</a>
                        <?php while(count($lightboxImageURL) > 0):?>
                        	<a class="bda_ignore" style="display:none;" href="<?php echo array_pop($lightboxImageURL); ?>" rel="lightbox[fhizin_images]"></a>
                        <?php endwhile; ?></li>
                    <?php endif; ?>
                </ul>
                            <img class="post_image post_image_<?=  the_ID()?>" style="<?=(!$image_small_150x150?"display:none":"")?>" src="<?php echo $image_small_150x150_refl; ?>" width="120" />
            </div>
            <div id="content_right" class="post-<?php echo $post->ID; ?>">
            	<h1><a href="<?php echo get_permalink() ?>" rel="bookmark" title="Permanent Link to '<?php the_title(); ?>'"><?php the_title(); ?></a> <!--span class="time"><?php //the_time('F jS, Y') ?></span--></h1>
				<?php the_content(''); ?>
            </div>
            <div id="tags" style="display:none;"><?php the_tags(); ?></div>
            <?php			
		endwhile; 
		endif; ?>
    <!-- end content -->
    </div>
    <div id="next_posts"><!-- begin next_posts --><?php next_post_link('%link','<img id="next_img" src="'.get_bloginfo('template_directory').'/images/next.png" />') ?><!-- end next_posts --></div>
    <div id="previous_posts"><!-- begin previous_posts --><?php previous_post_link('%link','<img id="previous_img" src="'.get_bloginfo('template_directory').'/images/previous.png" />') ?><!-- end previous_posts --></div>
</div>
<?php get_footer(); ?>