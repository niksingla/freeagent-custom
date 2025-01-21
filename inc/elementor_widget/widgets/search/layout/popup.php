    <button>
        <span class="open">
            <?php 
                if(!empty($settings['icon']['value'])) {
                  \Elementor\Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] );  
                }else {
                  echo '<i aria-hidden="true" class="jws-icon-magnifying-glass"></i>';  
                }
            ?>
        </span>
        <span class="remove">
            <?php if(!empty($settings['icon3']['value'])) {
              \Elementor\Icons_Manager::render_icon( $settings['icon3'], [ 'aria-hidden' => 'true' ] );  
            }else {
                echo '<i aria-hidden="true" class="jws-icon-cross"></i>';
            }  ?>
        </span>
    </button>

    <div class="form_content_popup" id="form_content_popup">
      <div class="form-content-close">
            <span class="close-form">
                <?php if(!empty($settings['icon3']['value'])) {
                  \Elementor\Icons_Manager::render_icon( $settings['icon3'], [ 'aria-hidden' => 'true' ] );  
                }else {
                    echo '<i aria-hidden="true" class="jws-icon-cross"></i>';
                }  ?>
            </span>
    </div>
    <div class="container">
        <form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
            <select id="select_post_type_id" class="select_post_type">
                <option value="product"><?php echo esc_html__('Products','freeagent');?></option>
                <option value="post"><?php echo esc_html__('Blog','freeagent');?></option>
                <option value="jobs"><?php echo esc_html__('Jobs','freeagent');?></option>                
                <option value="services"><?php echo esc_html__('Services','freeagent');?></option>
                <option value="freelancers"><?php echo esc_html__('Freelancers','freeagent');?></option> 
                <option value="employers"><?php echo esc_html__('Employers','freeagent');?></option> 
            </select>
            <input type="search" class="search-field" placeholder="<?php echo esc_attr($settings['placeholder']); ?>" value="<?php echo get_search_query(); ?>" name="s" />
               <input type="hidden" name="post_type" value="product">
               <input type="hidden" name="action" value="jws_ajax_search"/>
        	<button type="submit" class="search-submit"><i aria-hidden="true" class="jws-icon-magnifying-glass"></i></button>
        </form>  
        <div class="search-results-wrapper"><div class="jws-search-results row jws-scrollbar"></div></div>  
    </div>

    </div>   
