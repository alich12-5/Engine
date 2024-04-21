<?php 
/*
 * If the current post is protected by a password and the visitor has not yet
 * entered the password we will return early without loading the comments.
 */
if ( post_password_required() )
	return;
?>


<div id="comments" class="et-comments-area">
	<h2 class="et-comments-title">
		<?php comments_number( __('Be the first to post a comment.',ET_DOMAIN), __('1 Comment on this article',ET_DOMAIN) , __('% Comments on this article',ET_DOMAIN) ); ?>
	</h2>
	<ul class="et-comment-list">
		<?php 
			wp_list_comments(array(
				'type' 			=> 'comment',
				'callback' 		=> 'je_comment_template',
				'avatar_size' 	=> 40,
				'reply_text'	=> __('Reply ',ET_DOMAIN).'<span class="icon" data-icon="R"></span>', 
			)) 
		?>
		<div class="comments-navigation">
		<?php 
			paginate_comments_links();
		?> 
		</div>
	</ul>
</div>


<div id="et_respond">
	<?php comment_form(array(
		'title_reply' 			=> __('Add a comment', ET_DOMAIN),
		'comment_notes_before' 	=> '',
		'comment_notes_after' 	=> '<p class="submit-form"><button id="submit_comment" class="et-submit-comment">' . __('Submit comment', ET_DOMAIN) . '<span class="icon" data-icon="p"></span></button></p>'
	)); ?>
</div>