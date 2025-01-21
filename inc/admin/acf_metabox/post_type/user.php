<?php
if( function_exists('acf_add_local_field_group') ):

    
    $key_slug = 'field_user_';
    $key_setting = 'user_metabox';

    acf_add_local_field_group(array(
    'key' => $key_setting,
    'title' => 'Manually select user roles',
    'fields' => array (
     
     
        array(
            'key' => $key_slug.'freelancer_id',
            'label' => 'Select Freelancer For User',
            'name' => 'freelancer_id',
            'type' => 'post_object',
            'post_type' => array('freelancers'),
            'allow_null' => 0,
            'multiple' => 0,
            'return_format' => 'id',
        ),
        array(
            'key' => $key_slug.'employer_id',
            'label' => 'Select Employer For User',
            'name' => 'employer_id',
            'type' => 'post_object',
            'post_type' => array('employers'),
            'allow_null' => 0,
            'multiple' => 0,
            'return_format' => 'id',
        ),
         array(
            'key' => $key_slug.'_active_profile',
            'label' => 'Select Role',
            'name' => '_active_profile',
            'type' => 'select',
            'choices' => array(
                '1' => 'Employer',
                '2' => 'Freelancer',        
             ),
            'allow_null' => 1,
            'multiple' => 0,
        ),
        
    ),   
    'location' => array (
        array (
            array (
                'param' => 'user_form',
                'operator' => '==',
                'value' => 'all',
            ),
        ),
    ),
    ));
    
   
endif;  

?>