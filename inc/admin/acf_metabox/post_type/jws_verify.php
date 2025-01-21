<?php 

if (function_exists('acf_add_local_field_group')):
    $key_setting = 'jws_verify_metabox';
    $key_slug = 'field_jws_verify_';
  
  
  
 acf_add_local_field_group(array(
    'key' => $key_setting,
    'title' => 'Verify Setting',
    'fields' => array (),
    'location' => array (
        array (
            array (
                'param' => 'post_type',
                'operator' => '==',
                'value' => 'jws_verify',
            ),
        ),
    ),
));


acf_add_local_field(array(
    'key' => $key_slug.'contact_number',
    'label' => 'Contact number',
    'name' => 'contact_number',
    'type' => 'text',
    'parent' => $key_setting ,
));

acf_add_local_field(array(
    'key' => $key_slug.'verification_number',
    'label' => 'CNIC / Passport / NIN / SSN',
    'name' => 'verification_number',
    'type' => 'text',
    'parent' => $key_setting ,
));

acf_add_local_field(array(
    'key' => $key_slug.'address',
    'label' => 'Address',
    'name' => 'address',
    'type' => 'textarea',
    'parent' => $key_setting 
));

acf_add_local_field(array(
    'key' => $key_slug.'document',
    'label' => 'Document',
    'name' => 'document',
    'type' => 'gallery',
    'return_format' => 'id',
    'parent' => $key_setting 
));

endif;