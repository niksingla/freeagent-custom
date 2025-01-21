<?php  
    $name = get_post_meta(get_the_ID(), 'blog_name_quote', true);
    $description = get_post_meta(get_the_ID(), 'blog_description_quote', true);
        
 ?>
 
<div class="jws-post-quote">
    <i class="link_icon jws-icon-quotation-marks"></i>
    <div class="content_quote">
        <h1 class="post_title"><?php the_title(); ?></h1> 
        <?php if(!empty($name)) : ?><p class="quote_name"><?php echo esc_html($name); ?></p> <?php endif; ?>
    </div>
    
</div>
