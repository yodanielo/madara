<?php 
	if ('comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
	die ('Please do not load this page directly. Thanks!'); ?>

	<div id="comments_close"><a class="bda_ignore" onclick="doComments();"><img src="<?php bloginfo('template_directory'); ?>/images/commentsclose.png" width="13" height="13" border="0" /></a></div>
	<div id="comments_navigation">
		<a class="bda_ignore active" id="comments_view_a" onclick="showViewCommentsPanel();">View all comments</a>
		<a class="bda_ignore" id="comments_write_a" onclick="showWriteCommentPanel();">Write a comment</a>
	</div>
	<?php if ($comments) : ?>
	<div id="comments_view">
		<h3 id="comments"><?php comments_number('No comments', 'One comment', '% comments' );?> to &#8220;<?php the_title(); ?>&#8221;</h3>
		
		<div id="comments_scroll_outside">
		<div id="comments_scroll_inside">
		<table width="100%">
			<?php 
				$altrow = false;
				foreach ($comments as $comment) : 
				$altrow = !$altrow; ?>
				<tr>
					<td class="altrow<?php echo ($altrow)?1:2; ?>" width="120">
						<h4><?php comment_author_link() ?></h4>
						<?php echo get_avatar($comment,'50'); ?>
						<p><?php comment_date('F jS, Y') ?><br/>at <?php comment_time() ?></p>
						<p><?php edit_comment_link('edit','',''); ?></p>
				   </td><td class="altrow<?php echo ($altrow)?1:2; ?>">
						<?php if ($comment->comment_approved == '0') : ?>
						<p>Your comment is awaiting moderation.</p>
						<?php endif; ?>
						<?php comment_text() ?>
					</td></tr>
			<?php endforeach;  ?>
		 </table>
		 </div></div>
		 <?php else : ?>
			 <?php if ('open' == $post->comment_status) : ?> 
				<!-- If comments are open, but there are no comments. -->
				<p>There aren't any comments yet. Be the first to <a class="bda_ignore" onclick="showWriteCommentPanel();">write a comment</a>!</p>
			 <?php else : ?>
				<!-- If comments are closed. -->
				<p>Comments are closed for this item.</p>
			<?php endif; ?>
		
	</div>
	<?php endif; ?>
	<div id="comments_write">
		<?php if ('open' == $post->comment_status) : ?>
			<h3 id="respond">Leave a Reply</h3>
			
			<?php if ( get_option('comment_registration') && !$user_ID ) : ?>
				<p>You must be <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php the_permalink(); ?>">logged in</a> to post a comment.</p>
			<?php else : ?>
				<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
				<?php if ( $user_ID ) : ?>
					<p>Logged in as <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?action=logout" title="Log out of this account">Logout &raquo;</a></p>
				<?php else : ?>
					
					<p><input type="text" name="author" id="author" value="<?php echo $comment_author; ?>" size="22" tabindex="1" />
					<label for="author"><small>Name <?php if ($req) echo "(required)"; ?></small></label></p>
					
					<p><input type="text" name="email" id="email" value="<?php echo $comment_author_email; ?>" size="22" tabindex="2" />
					<label for="email"><small>Mail (will not be published) <?php if ($req) echo "(required)"; ?></small></label></p>
					
					<p><input type="text" name="url" id="url" value="<?php echo $comment_author_url; ?>" size="22" tabindex="3" />
					<label for="url"><small>Website</small></label></p>
					
				<?php endif; ?>
					
					<p><small><strong>XHTML:</strong> You can use these tags: <?php echo allowed_tags(); ?></small></p>
					
					<p><textarea name="comment" id="comment" cols="100%" rows="10" tabindex="4"></textarea></p>
					
					<p><input name="submit" type="submit" id="submit" tabindex="5" value="Submit Comment" />
					<input type="hidden" name="comment_post_ID" value="<?php echo $id; ?>" />
					</p>
					<?php do_action('comment_form', $post->ID); ?>
					
				</form>
				
			<?php endif; // If registration required and not logged in ?>
			
			<?php endif; // if you delete this the sky will fall on your head ?>        
	</div>