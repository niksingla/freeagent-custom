<?php 

if (function_exists('acf_add_local_field_group')):
    $key_setting = 'employers_metabox';
    $key_slug = 'field_employers_';
    
    acf_add_local_field_group(array(
        'key' => $key_setting,
        'title' => 'Employers Setting',
        'fields' => array (),
        'location' => array (
            array (
                array (
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'employers',
                ),
            ),
        ),
    ));  
    
    acf_add_local_field(array(
        'key' => $key_slug.'tab1',
        'label' => 'Employers Detail',
        'name' => 'tab1',
        'type' => 'tab',
        'parent' => $key_setting
    )); 
    
    acf_add_local_field(array(
        'key' => $key_slug.'employers_size',
        'label' => 'Employer Size',
        'name' => 'employers_size',
        'type' => 'taxonomy',
        'field_type' => 'select',
        'taxonomy' => 'employers_size',
        'load_save_terms'   => 1,
        'allow_null' => 1,
        'parent' => $key_setting 
    ));
    
    acf_add_local_field(array(
        'key' => $key_slug.'employers_location',
        'label' => 'Location',
        'name' => 'employers_location',
        'type' => 'taxonomy',
        'field_type' => 'select',
        'taxonomy' => 'employers_location',
        'load_save_terms'   => 1,
        'allow_null' => 1,
        'parent' => $key_setting 
    ));

    acf_add_local_field(array(
        'key' => $key_slug.'facebook_url',
        'label' => __('Facebok Url','freeagent'),
        'name' => 'facebook_url',
        'type' => 'text',
        'parent' => $key_setting 
    ));
    
    acf_add_local_field(array(
        'key' => $key_slug.'twitter_url',
        'label' => __('Twitter Url','freeagent'),
        'name' => 'twitter_url',
        'type' => 'text',
        'parent' => $key_setting 
    ));
    
    acf_add_local_field(array(
        'key' => $key_slug.'linkedin_url',
        'label' => __('Linkedin Url','freeagent'),
        'name' => 'linkedin_url',
        'type' => 'text',
        'parent' => $key_setting 
    ));
    
    acf_add_local_field_group(array(
        'key' => 'employers_location',
        'title' => 'Setting',
        'fields' => array (
            array(
                'key' => $key_slug.'logo_loca',
                'label' => 'Icon',
                'name' => 'logo_loca',
                'type' => 'image',
            ),
        ),
        'location' => array (
            array (
                array (
                    'param' => 'taxonomy',
                    'operator' => '==',
                    'value' => 'employers_location',
                ),
            ),
        ),
    ));




endif;