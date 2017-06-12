<article class="page-content">

	<section class="entry-content">
		<?php the_content() ?>
	</section>
			
	<?php if (is_user_logged_in()) { ?>	
		<div class="edit">
			<span class="edit-link"><?php edit_post_link( "Edit" ); ?></span>
		</div>
	<?php } ?>

</article>		