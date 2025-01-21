<?php 

if (function_exists('acf_add_local_field_group')):
    $key_setting = 'product_metabox';
    $key_slug = 'field_product_';
    
    acf_add_local_field_group(array(
        'key' => 'product_cat',
        'title' => 'Product Setting',
        'fields' => array (
            array(
                'key' => $key_slug.'shop_single_thumbnail_position',
                'label' => esc_html('Thumbnail Position','freeagent'),
                'name' => 'shop_single_thumbnail_position',
                'type'=>'select',
                'choices' => array(
                    'left' => 'Left',
                    'right' => 'Right',
                    'bottom' => 'Bottom',
                    'default'=> 'Default'
                ),
                'default_value' => 'default',
            ),
        ),
        'location' => array (
            array (
                array (
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'product',
                ),
            ),
        ),
    ));

endif;