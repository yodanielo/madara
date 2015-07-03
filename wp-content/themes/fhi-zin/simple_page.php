<?php
/*
Template Name: Simple_Page
*/
?>
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
            <div id="content_right" class="post-<?php echo $post->ID; ?> full-width">
            	<h1><a href="<?php echo get_permalink() ?>" rel="bookmark" title="Permanent Link to '<?php the_title(); ?>'"><?php the_title(); ?></a> <!--span class="time"><?php //the_time('F jS, Y') ?></span--></h1>
				<?php the_content(''); ?>
            </div>
            <div id="tags" style="display:none;"><?php the_tags(); ?></div>
            <?php			
		endwhile; 
		endif; ?>
    <!-- end content -->
    </div>
   
</div>
<?php get_footer(); ?>
</div>
<?php //get_sidebar(); ?>
<?php get_footer(); ?> 
