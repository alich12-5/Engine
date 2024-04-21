<?php
if ( ! isset( $content_width ) ) $content_width = 900;
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('et-entry'); ?>>
	<div class="et-entry-left col-sm-2">
		<a class="et-entry-thumbnail" href="<?php echo get_author_posts_url($post->post_author) ?>">
			<?php echo  et_get_avatar($post->post_author);?>
		</a>
		<p class="et-entry-author">
			<?php 
				$author = get_user_by( 'id', $post->post_author );
				echo  $author->display_name;
			?>
		</p>
		<p class="et-entry-date">
			<?php the_time( 'M jS Y' );?>
		</p>
	</div>
	<div class="et-entry-right col-sm-10">
		<div class="et-entry-head">
			<div class="et-entry-meta">
				<?php
					$categories = get_the_category();
					$separator = ' ';
					$output = '';
					if($categories){
						foreach($categories as $category) {
							$output .= '<a class="et-entry-cat" href="'.get_category_link( $category->term_id ).'" title="' . esc_attr( sprintf( __( "View all posts in %s",ET_DOMAIN ), $category->name ) ) . '">'.$category->cat_name.'</a>'.$separator;
						}
					echo trim($output, $separator);
					}
				?>				
				<a href="<?php the_permalink() ?>#comments" class="et-entry-comments icon" data-icon="q"><?php echo get_comments_number() ?></a>
			</div>
			<a href="<?php the_permalink() ?>"><h2 class="et-entry-title"><?php the_title(); ?></h2></a>

		</div>
		<div class="et-entry-content">
			<?php if(!is_single()) {?>

			<?php the_excerpt(); //the_content( __('Read more', ET_DOMAIN) . '&nbsp;&nbsp;<span class="icon" data-icon="]"></span>' ) ?>
			<a class="more-link" href="<?php the_permalink(); ?>"><?php _e('Read more', ET_DOMAIN) ?>&nbsp;&nbsp;<span class="icon" data-icon="]"></span></a>

			<?php } else {?>
			
			<?php the_content();?>
			<div class="post-tags"><?php the_tags(); ?></div>
			<?php } ?>
		</div>
	</div>
	<div class="clearfix"></div>
</article><!-- #post -->