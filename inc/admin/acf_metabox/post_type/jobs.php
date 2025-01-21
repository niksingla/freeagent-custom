<?php 

if (function_exists('acf_add_local_field_group')):
    $key_setting = 'jobs_metabox';
    $key_slug = 'field_jobs_';
  
  
  
 acf_add_local_field_group(array(
    'key' => $key_setting,
    'title' => 'Job Setting',
    'fields' => array (),
    'location' => array (
        array (
            array (
                'param' => 'post_type',
                'operator' => '==',
                'value' => 'jobs',
            ),
        ),
    ),
));

acf_add_local_field(array(
    'key' => $key_slug.'tab1',
    'label' => 'Jon Detail',
    'name' => 'tab1',
    'type' => 'tab',
    'parent' => $key_setting
));


acf_add_local_field(array(
    'key' => $key_slug.'job_level',
    'label' => 'Job level',
    'name' => 'job_level',
    'type' => 'taxonomy',
    'field_type' => 'select',
    'taxonomy' => 'job_level',
    'load_save_terms'   => 1,
    'allow_null' => 1,
    'parent' => $key_setting 
));

acf_add_local_field(array(
    'key' => $key_slug.'jobs_english_level',
    'label' => 'English level',
    'name' => 'jobs_english_level',
    'type' => 'taxonomy',
    'field_type' => 'select',
    'taxonomy' => 'jobs_english_level',
    'load_save_terms'   => 1,
    'allow_null' => 1,
    'parent' => $key_setting 
));


acf_add_local_field(array(
    'key' => $key_slug.'jobs_language',
    'label' => 'Language',
    'name' => 'jobs_language',
    'type' => 'taxonomy',
    'field_type' => 'checkbox',
    'taxonomy' => 'jobs_language',
    'load_save_terms'   => 1,
    'parent' => $key_setting 
));  


acf_add_local_field(array(
    'key' => $key_slug.'jobs_skill',
    'label' => 'Skill',
    'name' => 'jobs_skill',
    'type' => 'taxonomy',
    'field_type' => 'checkbox',
    'taxonomy' => 'jobs_skill',
    'load_save_terms'   => 1,
    'parent' => $key_setting 
));   

acf_add_local_field(array(
    'key' => $key_slug.'jobs_duration',
    'label' => 'Duration',
    'name' => 'jobs_duration',
    'type' => 'taxonomy',
    'field_type' => 'select',
    'taxonomy' => 'jobs_duration',
    'load_save_terms'   => 1,
    'parent' => $key_setting 
)); 

 acf_add_local_field(array(
    'key' => $key_slug.'featured',
    'label' => __('Enable Featured','freeagent'),
    'name' => '_featured',
    'type' => 'true_false',
    'ui' => true,
    'parent' => $key_setting
));
 acf_add_local_field(array(
    'key' => $key_slug.'new',
    'label' => __('Enable New','freeagent'),
    'name' => 'new',
    'type' => 'true_false',
    'ui' => true,
    'parent' => $key_setting
));
acf_add_local_field(array(
    'key' => $key_slug.'tab2',
    'label' => 'Location',
    'name' => 'tab2',
    'type' => 'tab',
    'parent' => $key_setting
));
acf_add_local_field(array(
    'key' => $key_slug.'jobs_locations',
    'label' => 'Locations',
    'name' => 'jobs_locations',
    'type' => 'taxonomy',
    'field_type' => 'select',
    'taxonomy' => 'jobs_locations',
    'load_save_terms'   => 1,
    'allow_null' => 1,
    'parent' => $key_setting 
));
acf_add_local_field(array(
    'key' => $key_slug.'map_location',
    'label' => 'Map Location',
    'name' => 'map_location',
    'type' => 'google_map',
    'instructions' => 'Drag the marker to select a location',
    'center_lat' => '', // Optional: Set the initial latitude
    'center_lng' => '', // Optional: Set the initial longitude
    'zoom' => '', // Optional: Set the initial zoom level
    'height' => '', // Optional: Set the map height in pixels
    'parent' => $key_setting 
));
acf_add_local_field(array(
    'key' => $key_slug.'tab3',
    'label' => 'Price',
    'name' => 'tab3',
    'type' => 'tab',
    'parent' => $key_setting
));

acf_add_local_field(array(
    'key' => $key_slug.'job_type',
    'label' => 'Job Type',
    'name' => 'job_type',
    'type' => 'select',
    'choices' => array(
        '1' => 'Hourly',
        '2' => 'Fixed',        
     ),
    'allow_null' => 1,
    'parent' => $key_setting 
));


acf_add_local_field(array(
    'key' => $key_slug.'min_price',
    'label' => 'Min Price',
    'name' => 'min_price',
    'type' => 'number',
    'parent' => $key_setting 
));

acf_add_local_field(array(
    'key' => $key_slug.'max_price',
    'label' => 'Max Price',
    'name' => 'max_price',
    'type' => 'number',
    'parent' => $key_setting 
));

acf_add_local_field(array(
    'key' => $key_slug.'tab4',
    'label' => 'Attachments',
    'name' => 'tab4',
    'type' => 'tab',
    'parent' => $key_setting
));

acf_add_local_field(array(
    'key' => $key_slug.'jobs_attachments',
    'label' => 'Attachments',
    'name' => 'jobs_attachments',
    'type' => 'gallery',
    'return_format' => 'id',
    'parent' => $key_setting 
));


acf_add_local_field(array(
    'key' => $key_slug.'tab5',
    'label' => 'Faqs',
    'name' => 'tab5',
    'type' => 'tab',
    'parent' => $key_setting
));


acf_add_local_field(array(
    'key' => $key_slug.'jobs_ques_ans',
    'label' => 'Questions Answer',
    'name' => 'jobs_ques_ans',
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
        'key' => 'jobs_cat',
        'title' => 'Setting',
        'fields' => array (
            array(
                'key' => $key_slug.'port_icon_images',
                'label' => 'Icon',
                'name' => 'port_icon_images',
                'type' => 'image',
            ),
        ),
        'location' => array (
            array (
                array (
                    'param' => 'taxonomy',
                    'operator' => '==',
                    'value' => 'jobs_cat',
                ),
            ),
        ),
    ));
  acf_add_local_field_group(array(
        'key' => 'jobs_locations',
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
                    'value' => 'jobs_locations',
                ),
            ),
        ),
    ));


endif;