
<div class="jws-search-form">
    	<form role="search" method="get" class="searchform jws-ajax-search" action="<?php echo esc_url( home_url( '/' ) ); ?>" data-count="20" data-post_type="<?php echo ''.$settings['type_search'];?>" data-thumbnail="1" data-price="1">
  			<button type="submit" class="searchsubmit">
		       <?php       
               if(!empty($settings['icon']['value'])) {
                  \Elementor\Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] );  
                }else {
                  echo '<i aria-hidden="true" class="jws-icon-magnifying-glass"></i>';  
                } ?>
			</button>
            <input type="text" class="s" placeholder="<?php echo ''.$settings['placeholder'];?>" value="<?php echo get_search_query(); ?>" name="s" />
			<input type="hidden" name="post_type" value="<?php echo ''.$settings['type_search'];?>">
            <span class="form-loader"></span>
		</form>
</div>