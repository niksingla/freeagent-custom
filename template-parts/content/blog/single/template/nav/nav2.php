<?php
$archive_year  = get_the_time('Y'); 
$archive_month = get_the_time('m'); 
$archive_day   = get_the_time('d');
$prev_post = get_previous_post(); $next_post = get_next_post(); 
?>
<nav class="navigation post-navigation" role="navigation">
    			<?php 
                        if(!empty($prev_post)){    
                           
                           
                            echo '<div class="left">
                                    
                                   <div class="content_nav">
                                     <a href="'.get_the_permalink($prev_post->ID).'">
                                        <span><i class="jws-icon-arrow-left-2"></i>'.esc_html__('previous post','freeagent').'</span>
                                        <h6 class="title">'.get_the_title($prev_post->ID).'</h6>
                                       
                                     </a>
                                   </div>
                            </div>'; 
                      
                            }else {
                                $first = new WP_Query('posts_per_page=1&order=DESC'); $first->the_post(); 
                  
                                echo '<div class="left">
                                   <div class="content_nav">
                                     <a href="'.get_the_permalink($first->ID).'">
                                        <span>'.esc_html__('previous post','freeagent').'<i class="jws-icon-arrow-left-2"></i></span>
                                        <h6 class="title">'.get_the_title($first->ID).'</h6>
                                      </a>                                       
                                   </div>
                                </div>';  
                        
                                 wp_reset_postdata();   
                            }
                            
                            ?>
                               
                            <?php
                            
                            if(!empty($next_post)){
                          
                                   echo '<div class="right">
                                            
                                            <div class="content_nav">
                                             <a href="'.get_the_permalink($next_post->ID).'">
                                                <span>'.esc_html__('next post','freeagent').'<i class="jws-icon-arrow-right-2"></i></span> 
                                                <h6 class="title">'.get_the_title($next_post->ID).'</h6>
                                               
                                               
                                             </a>
                                            </div>
                                         
                                   </div>';   
                            }else {
                                $last  = new WP_Query('posts_per_page=1&order=ASC'); $last->the_post();
                           
                                 echo '<div class="right">
                                            <div class="content_nav">
                                               <a href="'.get_the_permalink($last->ID).'">
                                                    <span>'.esc_html__('next post','freeagent').'<i class="jws-icon-arrow-right-2"></i></span>  
                                                    <h6 class="title">'.get_the_title($last->ID).'</h6>
                                               </a>
                                            </div>
                                            
                                   </div>';
                                   wp_reset_postdata(); 
                            }
                 ?>
</nav><!-- .navigation -->
