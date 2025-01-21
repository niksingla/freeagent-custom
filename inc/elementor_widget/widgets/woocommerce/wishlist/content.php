<div class="jws_wishlist">
    <div class="jws-wishlist-nav">
        <a href="<?php echo esc_url( jws_get_wishlist_page_url() ); ?>" >
             <span class="wishlist_icon jws_count">
                 <?php \Elementor\Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] );  ?>
                 
                <span class="jws_wishlist_count">
                <?php  echo jws_get_wishlist_count(); ?>
                </span>
             </span> 
             <?php  if(!empty($settings['wishlist_text'])) : ?>
                 <span class="wishlist_text">
                    <?php echo esc_html($settings['wishlist_text']); ?>
                 </span>
             <?php endif; ?>
        </a>
    </div>
</div>
