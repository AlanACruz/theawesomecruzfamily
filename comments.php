<!-- PAGE TYPE: comments.php -->
<?php if(!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME'])) : ?>  	
	<?php die('You can not access this page directly!'); ?>  
<?php endif; ?>

<?php if(!empty($post->post_password)) : ?>
  	<?php if($_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password) : ?>
		<p>This post is password protected. Enter the password to view comments.</p>
  	<?php endif; ?>
<?php endif; ?>

<?php if($comments) : ?>
  	<ol>
    	<?php foreach($comments as $comment) : ?>
	  		<li id="comment-<?php comment_ID(); ?>">
	  			<?php if ($comment->comment_approved == '0') : ?>
	  				<p>Your comment is awaiting approval</p>
	  			<?php endif; ?>
	  			<h6>
	  				<?php comment_author_link(); ?><br />
	  				<?php comment_type(); ?> on <?php comment_date(); ?> at <?php comment_time(); ?>
	  			</h6>
	  			<?php comment_text(); ?>
	  			<hr />
	  		</li>
	<?php endforeach; ?>
	</ol>
<?php else : ?>
	<p>No comments yet</p>
	<hr />
<?php endif; ?>

<?php if(comments_open()) : ?>
	<?php if(get_option('comment_registration') && !$user_ID) : ?>
		<p>You must be <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php echo urlencode(get_permalink()); ?>">logged in</a> to post a comment.</p>
	<?php else : ?>
		<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
			<?php if($user_ID) : ?>
				<p>
					Logged in as <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>.&nbsp
					<a href="<?php echo get_option('siteurl'); ?>/wp-login.php?action=logout" title="Log out of this account">Log out &raquo;</a></p>
			<?php else : ?>
				<p>
					<label for="author"><small>Name <?php if($req) echo "(required)"; ?></small></label><br />
					<input type="text" name="author" id="author" value="<?php echo $comment_author; ?>" size="22" tabindex="1" />
				</p>
				<p>
					<label for="email"><small>Mail (will not be published) <?php if($req) echo "(required)"; ?></small></label><br />
					<input type="text" name="email" id="email" value="<?php echo $comment_author_email; ?>" size="22" tabindex="2" />
				</p>
				<p>
					<label for="url"><small>Website</small></label><br />
					<input type="text" name="url" id="url" value="<?php echo $comment_author_url; ?>" size="22" tabindex="3" />
				</p>
			<?php endif; ?>
			<p><textarea name="comment" id="comment" tabindex="4"></textarea></p>
			<p><input name="submit" type="submit" id="submit" tabindex="5" value="Submit Comment" />
			<input type="hidden" name="comment_post_ID" value="<?php echo $id; ?>" /></p>
			<?php do_action('comment_form', $post->ID); ?>
		</form>
	<?php endif; ?>
<?php else : ?>
	<p>The comments are closed.</p>
<?php endif; ?>