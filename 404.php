<?php
get_header(); 

global $wp_query, $wp_rewrite, $post,$current_user , $user_ID;

$data = et_get_unread_follow();

?>

<div class="header-bottom header-filter">
	<div class="main-center">
		<ul class="nav-link">
			<li <?php if(is_front_page()){ ?> class="active" <?php }?>>
				<a href="<?php echo home_url() ?>">
					<span class="icon" data-icon="W"></span>
					<span class="text"><?php _e('ALL POSTS',ET_DOMAIN) ?></span>
					<?php 
						if(!empty($data) && count($data['unread']['data']) > 0){
					?>
					<span class="number"><?php echo count($data['unread']['data']) ?></span>
					<?php } ?>
				</a>
			</li>
			<li>
				<a
			<?php 
				if($user_ID){
					echo 'href="'.et_get_page_link("following").'"';	
				} else {
					echo 'id="open_login" data-toggle="modal" href="#modal_login"';
				}
			?>>
				<span class="icon" data-icon="&"></span>
				<span class="text"><?php _e('Following',ET_DOMAIN) ?></span>
				<?php if($user_ID && count($data['follow']) > 0){ ?>
				<span class="number"><?php echo count($data['follow']) ;?></span>
				<?php } ?>
				</a>
			</li>
			<?php if ( et_get_option("pending_thread") && (et_get_counter('pending') > 0) &&(current_user_can("manage_threads") || current_user_can( 'trash_threads' )) ) {?>
			<li>
				<a href="<?php echo et_get_page_link("pending");?>">
					<span class="icon" data-icon="N"></span>
					<span class="text"><?php _e('PENDING POSTS',ET_DOMAIN) ?></span>
				</a>
			</li>
			<?php } ?>
		</ul>
	</div>
</div>
<!--end header Bottom-->
<div class="container-fluid main-center">
	<div class="row-fluid">        
		<div class="span12 marginTop30 page-not">
		<div class="img-page-not"></div>
		<p class="text-page-not"><?php _e('page not found',ET_DOMAIN);?></p>
		<p><?php _e("Looks like something's wrong here. The page you were looking for is not here.",ET_DOMAIN);?></p>
		<a href="<?php echo home_url(); ?>" class="btn back-home"><?php _e('Back to Home',ET_DOMAIN) ?></a><span class="previous-page"><a href="javascript:history.back();"><?php _e('Previous Page',ET_DOMAIN) ?></a></span>
		</div>
	</div>
</div>
 
<?php get_footer(); ?>

