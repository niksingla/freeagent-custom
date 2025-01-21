<?php 

$post_id = get_the_ID(); 

$addons_added = get_post_meta($post_id, 'addons_service_added',true); 
                           
if(isset($addons_added) && !empty($addons_added)) {

$addons_added_list = explode(',', $addons_added);
echo '<ul class="reset_ul_ol">';
foreach($addons_added_list as $addon_id) {
    if(empty($addon_id)) continue;
    
    $addon_price = get_post_meta($addon_id, 'addon_price',true); 
    $addon_description = get_post_meta($addon_id, 'addon_description',true);
    ?>
     
      <li>
         
        <input type="checkbox" name="addon_extra[]" value="<?php echo esc_attr($addon_id); ?>" />
        <div class="content_right d-flex fl-center" style="justify-content:space-between;">
        <div class="addon_title " >
        <div class="fw-700"><?php echo get_the_title($addon_id); ?></div>
       
            <?php
             
            if (!empty($addon_description)) {
                     echo sprintf(
                    		'<div class="delivery_des fs-small">%s</div>',
                            $addon_description
                   );
               }
        
             
            ?>
     
        </div>
        <h5 class="price">
            <?php
             
               if(!empty($addon_price)) {
                 
                 echo '+'.jws_format_price($addon_price);
                
               }
             
            ?>
        </h5>
       </div>
        
       </li>
    
    <?php
    
}
echo '</ul>';

}  