<?php 

if( function_exists('acf_add_local_field_group') ):

    
    $key_slug = 'field_page_';
    $key_setting = 'page_metabox';

    acf_add_local_field_group(array(
    'key' => $key_setting,
    'title' => __('Page Setting','freeagent'),
    'fields' => array (),
    'location' => array (
        array (
            array (
                'param' => 'post_type',
                'operator' => '==',
                'value' => 'page',
            ),
        ),
    ),
    ));
    
    acf_add_local_field(array(
        'key' => $key_slug.'page_select_header',
        'label' => __('Select Header For Page','freeagent'),
        'name' => 'page_select_header',
        'type' => 'post_object',
        'post_type' => array('hf_template'),
        'multiple' => false,
        'return_format' => 'id',
        'parent' => $key_setting,
        'allow_null' => 1,
    ));
    
    acf_add_local_field(array(
        'key' => $key_slug.'page_select_footer',
        'label' => __('Select Footer For Page','freeagent'),
        'name' => 'page_select_footer',
        'type' => 'post_object',
        'post_type' => array('hf_template'),
        'multiple' => false,
        'return_format' => 'id',
        'allow_null' => 1,
        'parent' => $key_setting
    ));
    acf_add_local_field(array(
        'key' => $key_slug.'page_select_titlebar',
        'label' => __('Select Title Bar For Page','freeagent'),
        'name' => 'page_select_titlebar',
        'type' => 'post_object',
        'post_type' => array('hf_template'),
        'multiple' => false,
        'allow_null' => 1,
        'return_format' => 'id',
        'parent' => $key_setting
    ));
    acf_add_local_field(array(
            'key' => $key_slug.'enable_stick_header',
            'label' => __('Enable Sticky Header','freeagent'),
            'name' => 'enable_stick_header',
            'type' => 'true_false',
            'ui' => true,
            'parent' => $key_setting
    ));
    acf_add_local_field(array(
            'key' => $key_slug.'enable_stick_footer',
            'label' => __('Enable Sticky Footer','freeagent'),
            'name' => 'enable_stick_footer',
            'type' => 'true_false',
            'ui' => true,
            'parent' => $key_setting
    ));
    acf_add_local_field(array(
            'key' => $key_slug.'turn_off_header',
            'label' => __('Turn Off Header','freeagent'),
            'name' => 'turn_off_header',
            'type' => 'true_false',
            'ui' => true,
            'parent' => $key_setting
    ));
    acf_add_local_field(array(
            'key' => $key_slug.'turn_off_footer',
            'label' => __('Turn Off Footer','freeagent'),
            'name' => 'turn_off_footer',
            'type' => 'true_false',
            'ui' => true,
            'parent' => $key_setting
    ));
    acf_add_local_field(array(
        
            'key' => $key_slug.'title_bar_checkbox',
            'label' => __('Disable Title Bar','freeagent'),
            'name' => 'title_bar_checkbox',
            'type' => 'true_false',
            'ui' => true,
            'parent' => $key_setting                
        
    ));

endif; 

?>