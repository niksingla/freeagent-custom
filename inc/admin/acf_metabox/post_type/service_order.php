<?php 

if (function_exists('acf_add_local_field_group')):
    $key_setting = 'service_order_metabox';
    $key_slug = 'field_service_order_';
  
  
  
 acf_add_local_field_group(array(
    'key' => $key_setting,
    'title' => 'Queue Setting',
    'fields' => array (),
    'location' => array (
        array (
            array (
                'param' => 'post_type',
                'operator' => '==',
                'value' => 'service_order',
            ),
        ),
    ),
));

acf_add_local_field(array(
    'key' => $key_slug.'status',
    'label' => 'Status',
    'name' => 'status',
    'type' => 'select',
    'choices' => array(
        'hired' => 'Hired',
        'completed' => 'Completed',  
        'cancel' => 'Cancel',        
     ),
    'allow_null' => 1,
    'parent' => $key_setting 
));


acf_add_local_field(array(
    'key' => $key_slug.'service_id',
    'label' => 'Service Id',
    'name' => 'service_id',
    'type' => 'text',
    'parent' => $key_setting 
));

acf_add_local_field(array(
    'key' => $key_slug.'order_amount',
    'label' => 'Order Amount',
    'name' => 'order_amount',
    'type' => 'number',
    'parent' => $key_setting 
));

acf_add_local_field(array(
    'key' => $key_slug.'seller',
    'label' => 'Seller',
    'name' => 'seller',
    'type' => 'text',
    'parent' => $key_setting 
));

acf_add_local_field(array(
    'key' => $key_slug.'time',
    'label' => 'Time',
    'name' => 'time',
    'type' => 'text',
    'parent' => $key_setting 
));

endif;