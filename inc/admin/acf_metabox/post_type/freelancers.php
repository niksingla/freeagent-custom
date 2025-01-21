<?php 

if (function_exists('acf_add_local_field_group')):
    $key_setting = 'freelancers_metabox';
    $key_slug = 'field_freelancers_';
    
       acf_add_local_field_group(array(
        'key' => $key_setting,
        'title' => 'Freelancers Setting',
        'fields' => array (),
        'location' => array (
            array (
                array (
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'freelancers',
                ),
            ),
        ),
    ));
    acf_add_local_field(array(
        'key' => $key_slug.'tab1',
        'label' => 'Freelancers Detail',
        'name' => 'tab1',
        'type' => 'tab',
        'parent' => $key_setting
    ));    
    acf_add_local_field(array(
        'key' => $key_slug.'freelancers_position',
        'label' => __('Position description','freeagent'),
        'name' => 'freelancers_position',
        'type' => 'text',
        'parent' => $key_setting 
    ));
    acf_add_local_field(array(
        'key' => $key_slug.'freelancers_english_level',
        'label' => 'English level',
        'name' => 'freelancers_english_level',
        'type' => 'taxonomy',
        'field_type' => 'select',
        'taxonomy' => 'freelancers_english_level',
        'load_save_terms'   => 1,
        'allow_null' => 1,
        'parent' => $key_setting 
    ));
    
    
    acf_add_local_field(array(
        'key' => $key_slug.'freelancers_language',
        'label' => 'Language',
        'name' => 'freelancers_language',
        'type' => 'taxonomy',
        'field_type' => 'checkbox',
        'taxonomy' => 'freelancers_language',
        'load_save_terms'   => 1,
        'parent' => $key_setting 
    )); 
      acf_add_local_field(array(
        'key' => $key_slug.'freelancers_skill',
        'label' => 'Skill',
        'name' => 'freelancers_skill',
        'type' => 'taxonomy',
        'field_type' => 'checkbox',
        'taxonomy' => 'freelancers_skill',
        'load_save_terms'   => 1,
        'parent' => $key_setting 
    ));       
    acf_add_local_field(array(
        'key' => $key_slug.'freelancers_location',
        'label' => 'Location',
        'name' => 'freelancers_location',
        'type' => 'taxonomy',
        'field_type' => 'select',
        'taxonomy' => 'freelancers_location',
         'load_save_terms'   => 1,
         'allow_null' => 1,
        'parent' => $key_setting 
    ));  
    acf_add_local_field(array(
        'key' => $key_slug.'freelancers_response_time',
        'label' => 'Response Time',
        'name' => 'freelancers_response_time',
        'type' => 'taxonomy',
        'field_type' => 'select',
        'taxonomy' => 'freelancers_response_time',
        'load_save_terms'   => 1,
        'allow_null' => 1,
        'parent' => $key_setting 
    )); 
      acf_add_local_field(array(
        'key' => $key_slug.'freelancers_type',
        'label' => 'Freelancer Type',
        'name' => 'freelancers_type',
        'type' => 'taxonomy',
        'field_type' => 'select',
        'taxonomy' => 'freelancers_type',
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
        'key' => $key_slug.'min_price',
        'label' => 'Hourly Rate',
        'name' => 'min_price',
        'type' => 'number',
        'parent' => $key_setting 
    ));     
    
      acf_add_local_field(array(
        'key' => $key_slug.'tab3',
        'label' => 'Experience',
        'name' => 'tab3',
        'type' => 'tab',
        'parent' => $key_setting
    ));   
    acf_add_local_field(array(
        'key' => $key_slug.'experience',
        'label' => 'Experience',
        'name' => 'experience',
        'type' => 'repeater',
        'parent' => $key_setting,
        'sub_fields' => array(
     
            array(
                'key' => $key_slug.'ex_start_date',
                'label' => 'Start Date',
                'name' => 'ex_start_date',
                'type' => 'text',
            ),
             array(
                'key' => $key_slug.'ex_end_date',
                'label' => 'End Date',
                'name' => 'ex_end_date',
                'type' => 'text',
            ),           
            array(
                'key' => $key_slug.'experience_position',
                'label' => 'Add Experience',
                'name' => 'experience_position',
                'type' => 'text',
            ),
            array(
                'key' => $key_slug.'url_work',
                'label' => 'Reference Link',
                'name' => 'url_work',
                'type' => 'text',
            ), 

            array(
                'key' => 'ex_description',
                'label' => 'Description',
                'name' => 'ex_description',
                'type' => 'textarea',
                'instructions' => esc_html__('Enter your text here.','freeagent'),
                'required' => true,
                'rows' => 4,  
            ),   
            
        ),
    
        'min' => 0, 
        'max' => 100, 
    ));
    acf_add_local_field(array(
        'key' => $key_slug.'tab4',
        'label' => 'Education',
        'name' => 'tab4',
        'type' => 'tab',
        'parent' => $key_setting
    ));   
    acf_add_local_field(array(
        'key' => $key_slug.'education',
        'label' => 'Education',
        'name' => 'education',
        'type' => 'repeater',
        'parent' => $key_setting,
        'sub_fields' => array(
     
            array(
                'key' => $key_slug.'e_start_date',
                'label' => 'Start Date',
                'name' => 'e_start_date',
                'type' => 'text',
            ),
             array(
                'key' => $key_slug.'e_end_date',
                'label' => 'End Date',
                'name' => 'e_end_date',
                'type' => 'text',
            ),           
            array(
                'key' => $key_slug.'education_degree',
                'label' => 'Degree',
                'name' => 'education_degree',
                'type' => 'text',
            ),
            array(
                'key' => $key_slug.'university',
                'label' => 'University,College',
                'name' => 'university',
                'type' => 'text',
            ), 
   
            
        ),
    
        'min' => 0, 
        'max' => 100, 
    ));
  acf_add_local_field_group(array(
        'key' => 'freelancers_location',
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
                    'value' => 'freelancers_location',
                ),
            ),
        ),
    ));




endif;