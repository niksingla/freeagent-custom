<?php 

if (function_exists('acf_add_local_field_group')):
    $key_setting = 'job_addons_metabox';
    $key_slug = 'field_job_addons_';
  
  
  
 acf_add_local_field_group(array(
    'key' => $key_setting,
    'title' => 'Addons Setting',
    'fields' => array (),
    'location' => array (
        array (
            array (
                'param' => 'post_type',
                'operator' => '==',
                'value' => 'service_addons',
            ),
        ),
    ),
));

acf_add_local_field(array(
    'key' => $key_slug.'addon_price',
    'label' => 'Price',
    'name' => 'addon_price',
    'type' => 'number',
    'parent' => $key_setting,
));

acf_add_local_field(array(
    'key' => $key_slug.'addon_delivery_time',
    'label' => 'Delivery Time',
    'name' => 'addon_delivery_time',
    'type' => 'taxonomy',
    'field_type' => 'select',
    'taxonomy' => 'services_delivery_time',
    'load_save_terms'   => 0,
    'allow_null' => 1,
    'parent' => $key_setting 
));

acf_add_local_field(array(
    'key' => $key_slug.'addon_description',
    'label' => 'Description',
    'name' => 'addon_description',
    'type' => 'textarea',
    'parent' => $key_setting 
));




endif;