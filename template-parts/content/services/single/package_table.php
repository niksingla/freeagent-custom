<?php 

$args = wp_parse_args( $args, array(
    'addon_ids'   =>  '',
    'price_addons' => '',
    'post_id' => get_the_ID()
) );

extract( $args );

                $package_setting = array(
                  
                  'info' => '',
                  'features' => esc_html__('Features','freeagent'),
                  'revision' => esc_html__('Revision','freeagent'),
                  'delivery' => esc_html__('Delivery Time','freeagent'),
                  'price' => esc_html__('Price','freeagent'),
                
                );
                
                $package_service = get_field('package_service',$post_id); 
                
                
                
                  if ($package_service) { ?> 
                  
                  <table> 
                    
                    <?php 
                     
                    foreach($package_setting as $key => $package_item) {
                        
                        
                        ?>
                        
                         
                         <tr>
                         
                          <?php 
                                echo '<td class="sub_title">'.$package_item.'</td>';
                                foreach ($package_service as $tkey =>  $item) {
                                    
                                        if($key == 'info') {
                                            
                                            ?> 
                                        
                                            
                                             <td class="content_services">
                                                
                                                <div class="package-info">
                                                  
                                                  <div class="package-name"> <?php echo esc_html($item['package_title']); ?> </div>
                                                  <div class="package-price"> <?php echo jws_format_price((int) $price_addons + (int) $item['package_price']); ?> </div>
                                                  <div class="package-des"> <?php echo ''.$item['package_description']; ?> </div>
                                                
                                                </div>
                                             
                                             </td>
                                             
                                             
                                            
                                             <?php
                                            
                                        } elseif($key == 'features') {
                                            
                                            ?>
                                             
                                                <td class="content_services">
                                
                                                    <div class="package-feature">
                                                      
                                                     <?php 
                                                     
                                                       if(isset($item['package_features']) && !empty($item['package_features'])) {
                                                        
                                                          $list = explode(PHP_EOL, $item['package_features']);
                                                          
                                                          if(!empty($list)) {
                                                            echo '<ul class="reset_ul_ol">';
                                                                foreach($list as $item) {
                                                                    echo '<li>'.$item.'</li>';
                                                                }
                                                            echo '</ul>';
                                                          }
                                                        
                                                       }
                                                      ?>
                                                    
                                                    </div>
                                                 
                                                 </td>
                                            
                                            <?php
                                            
                                        }  elseif($key == 'revision') { 
                                            
                                           ?> 
                                            
                                            <td>
                                
                                                <div class="package-revisions">
                                                  
                                                 <?php 
                                                 
                                                   if(isset($item['package_revisions']) && !empty($item['package_revisions'])) {
                                                     
                                                     echo ''.$item['package_revisions'] == '-1' ? esc_html__('Unlimited','freeagent') : $item['package_revisions'];
                                                    
                                                   }
                                                  ?>
                                                
                                                </div>
                                             
                                             </td>
                                            
                                           <?php 
                                            
                                        } elseif($key == 'delivery') { 
                                            
                                            ?> 
                                            
                                            <td>
                                
                                                 <?php 
                                                 
                                                     $delivery_time = get_term($item['package_delivery_time']);
                                      
                                                       if (!empty($delivery_time) && !is_wp_error($delivery_time)) {
                                                             echo  esc_html($delivery_time->name);
                                                       }
                                                        
                                                  ?>
                                              
                                             
                                             </td>
                                            
                                           <?php 
                  
                                        
                                        } elseif($key == 'price') { 
                                            
                                            ?> 
                                            
                                            <td>
                                
                                                 <?php 
                                                 
                                                    echo jws_format_price((int) $price_addons + (int) $item['package_price']);
                                                        
                                                  ?>
                                                  
                                                  <button data-package="<?php echo esc_attr($tkey); ?>" class="service-buy package-type"><?php echo esc_html__('Buy Now','freeagent'); ?></button>
                                              
                                             
                                             </td>
                                            
                                           <?php 
                  
                                        
                                        }
                                    
                                        
                                }
                          
                          
                          ?>
                         
                         
                         </tr>
                  
                        
                        <?php
                    
                    }
                    
                    
                    ?>

                    </table> 
                    
                    <?php
                    
                }
                
                
                 ?>