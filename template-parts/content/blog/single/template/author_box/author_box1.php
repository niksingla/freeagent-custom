<?php
/*Author*/
$bio = get_the_author_meta('description');
        if(empty($bio)) return;
		?>
		
		<div class="post-about-author">
			<div class="post-author-avatar"><?php  echo get_avatar( get_the_author_meta( 'ID' ), 120 ); ?></div>
			<div class="post-author-info">
            <p class="label"><?php echo esc_html__('Author','freeagent');?></p>
                <p class="at-job"><?php echo get_the_author_meta( 'job' );?></p>
                <h5 class="at-name">
                <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>">
                <?php the_author(); ?></a>
                </h5>
				<div class="description"><?php echo ''.$bio; ?></div>
                <div class="icon-author">
                    <a href="<?php echo get_the_author_meta('facebook'); ?>"><i class="fab fa-facebook-f"></i></a>
                    <a href="<?php echo get_the_author_meta('twitter'); ?>"><i class="fab fa-twitter"></i></a>
                    <a href="<?php echo get_the_author_meta('linkedin'); ?>"><i class="fab fa-linkedin-in"></i></i></a>
                </div>
			</div>
		</div>