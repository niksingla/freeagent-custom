<?php 

if (function_exists('acf_add_local_field_group')):
    $key_setting = 'services_metabox';
    $key_slug = 'field_services_';
    $current_date = date('F j, Y'); 
     acf_add_local_field_group(array(
        'key' => $key_setting,
        'title' => 'Services Setting',
        'fields' => array (),
        'location' => array (
            array (
                array (
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'services',
                ),
            ),
        ),
    ));
    acf_add_local_field(array(
        'key' => $key_slug.'tab1',
        'label' => 'Services Detail',
        'name' => 'tab1',
        'type' => 'tab',
        'parent' => $key_setting
    ));
    
    
    acf_add_local_field(array(
        'key' => $key_slug.'services_english_level',
        'label' => 'English level',
        'name' => 'services_english_level',
        'type' => 'taxonomy',
        'field_type' => 'select',
        'taxonomy' => 'services_english_level',
        'load_save_terms'   => 1,
        'allow_null' => 1,
        'parent' => $key_setting 
    ));
    
    
    acf_add_local_field(array(
        'key' => $key_slug.'services_language',
        'label' => 'Language',
        'name' => 'services_language',
        'type' => 'taxonomy',
        'field_type' => 'checkbox',
        'taxonomy' => 'services_language',
        'load_save_terms'   => 1,
        'parent' => $key_setting 
    )); 
        
    acf_add_local_field(array(
        'key' => $key_slug.'services_locations',
        'label' => 'Location',
        'name' => 'services_locations',
        'type' => 'taxonomy',
        'field_type' => 'select',
        'taxonomy' => 'services_locations',
        'load_save_terms'   => 1,
        'allow_null' => 1,
        'parent' => $key_setting 
    ));  
    
     acf_add_local_field(array(
        'key' => $key_slug.'services_response_time',
        'label' => 'Response Time',
        'name' => 'services_response_time',
        'type' => 'taxonomy',
        'field_type' => 'select',
        'taxonomy' => 'services_response_time',
        'load_save_terms'   => 1,
        'allow_null' => 1,
        'parent' => $key_setting 
    ));   
    acf_add_local_field(array(
        'key' => $key_slug.'services_delivery_time',
        'label' => 'Delivery Time',
        'name' => 'services_delivery_time',
        'type' => 'taxonomy',
        'field_type' => 'select',
        'taxonomy' => 'services_delivery_time',
        'load_save_terms'   => 1,
        'allow_null' => 1,
        'parent' => $key_setting 
    ));
    acf_add_local_field(array(
        'key' => $key_slug.'tab2',
        'label' => 'Price',
        'name' => 'tab2',
        'type' => 'tab',
        'parent' => $key_setting
    ));
    
    acf_add_local_field(array(
        'key' => $key_slug.'services_type',
        'label' => 'Services Type',
        'name' => 'services_type',
        'type' => 'select',
        'choices' => array(
            '1' => 'Price',
            '2' => 'Package',        
         ),
        'allow_null' => 1,
        'parent' => $key_setting 
    ));
    
    acf_add_local_field(array(
        'key' => $key_slug.'services_price',
        'label' => 'Price',
        'name' => 'services_price',
        'type' => 'number',
        'parent' => $key_setting,
        'conditional_logic' => array (
        		array (
        			array (
        			'field' => $key_slug.'services_type',
        			'operator' => '==',
        			'value' => '1',
        			),
        		),
        ),
    ));
    
    acf_add_local_field(array(
        'key' => $key_slug.'package_service',
        'label' => 'Packages',
        'name' => 'package_service',
        'type' => 'repeater',
        'layout' => 'row',
        'parent' => $key_setting,
        'conditional_logic' => array (
        		array (
        			array (
        			'field' => $key_slug.'services_type',
        			'operator' => '==',
        			'value' => '2',
        			),
        		),
        ),
        'sub_fields' => array(
         
            array(
                'key' => $key_slug.'package_title',
                'label' => 'Title',
                'name' => 'package_title',
                'type' => 'text',
            ),
            
            array(
                'key' => $key_slug.'package_price',
                'label' => 'Price',
                'name' => 'package_price',
                'type' => 'number',
            ),
            array(
                'key' => $key_slug.'package_delivery_time',
                'label' => 'Delivery Time',
                'name' => 'package_delivery_time',
                'type' => 'taxonomy',
                'field_type' => 'select',
                'taxonomy' => 'services_delivery_time',
                'load_save_terms'   => 0,
                'allow_null' => 1,
                'parent' => $key_setting 
            ),
            array(
                'key' => $key_slug.'package_revisions ',
                'label' => 'Package Revisions ',
                'name' => 'package_revisions',
                'type' => 'number',
            ),
            array(
                'key' => $key_slug.'package_features',
                'label' => 'Features List',
                'name' => 'package_features',
                'type' => 'textarea',
            ),
            array(
                'key' => $key_slug.'package_description',
                'label' => 'Description',
                'name' => 'package_description',
                'type' => 'textarea',
            ),
         
            
        ),
    
        'min' => 0, 
        'max' => 200, 
    ));
    
     acf_add_local_field(array(
        'key' => $key_slug.'tab3',
        'label' => 'Galley',
        'name' => 'tab3',
        'type' => 'tab',
        'parent' => $key_setting
    ));
    
    acf_add_local_field(array(
        'key' => $key_slug.'service_gallery',
        'label' => 'Gallery',
        'name' => 'service_gallery',
        'type' => 'gallery',
        'return_format' => 'id',
        'parent' => $key_setting 
    ));
    
    acf_add_local_field(array(
        'key' => $key_slug.'tab4',
        'label' => 'Common FAQ\'s',
        'name' => 'tab4',
        'type' => 'tab',
        'parent' => $key_setting
    ));
    
    acf_add_local_field(array(
        'key' => $key_slug.'services_ques_ans',
        'label' => 'Questions Answer',
        'name' => 'services_ques_ans',
        'type' => 'repeater',
        'parent' => $key_setting,
        'sub_fields' => array(
     
            array(
                'key' => $key_slug.'questions',
                'label' => 'Questions',
                'name' => 'questions',
                'type' => 'text',
            ),
            
            array(
                'key' => $key_slug.'answer',
                'label' => 'Answer',
                'name' => 'answer',
                'type' => 'textarea',
            ),
         
            
        ),
    
        'min' => 0, 
        'max' => 200, 
    ));

  acf_add_local_field_group(array(
        'key' => 'services_cat',
        'title' => 'Setting',
        'fields' => array (
            array(
                'key' => $key_slug.'ser_icon_images',
                'label' => 'Icon',
                'name' => 'ser_icon_images',
                'type' => 'image',
            ),
        ),
        'location' => array (
            array (
                array (
                    'param' => 'taxonomy',
                    'operator' => '==',
                    'value' => 'services_cat',
                ),
            ),
        ),
    ));



endif;