<?php 

if (function_exists('acf_add_local_field_group')):
    $key_setting = 'nav-menus_metabox';
    $key_slug = 'field_nav-menus_';
    

        acf_add_local_field_group(array(
            'key' => 'group_menu_item_image',
            'title' => 'Menu Item Image',
            'fields' => array(
                array(
                    'key' => $key_slug.'field_menu_item_image',
                    'label' => 'Image',
                    'name' => 'menu_item_image',
                    'type' => 'image',
                    'instructions' => 'Upload or select an image for this menu item.',
                    'return_format' => 'url', // Change this format if you need a different value
                ),
            ),
            'location' => array(
                array(
                    array(
                        'param' => 'nav_menu_item',
                        'operator' => '==',
                        'value' => 'location/top', // Replace with the menu location where you want to add the image field
                    ),
                ),
            ),
        ));

endif;