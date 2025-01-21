<?php 

if (function_exists('acf_add_local_field_group')):
    $key_setting = 'job_proposal_metabox';
    $key_slug = 'field_job_proposal_';
  
  
  
 acf_add_local_field_group(array(
    'key' => $key_setting,
    'title' => 'Proposal Setting',
    'fields' => array (),
    'location' => array (
        array (
            array (
                'param' => 'post_type',
                'operator' => '==',
                'value' => 'job_proposal',
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
        'pending' => 'Pending',
        'hired' => 'Hired',
        'completed' => 'Completed',  
        'cancel' => 'Cancel',        
     ),
    'allow_null' => 1,
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
    'key' => $key_slug.'job_id',
    'label' => 'Job Id',
    'name' => 'job_id',
    'type' => 'text',
    'parent' => $key_setting 
));

acf_add_local_field(array(
    'key' => $key_slug.'proposal_amount',
    'label' => 'Proposal Amount',
    'name' => 'proposal_amount',
    'type' => 'number',
    'parent' => $key_setting 
));

acf_add_local_field(array(
    'key' => $key_slug.'jobs_duration',
    'label' => 'Time Period',
    'name' => 'jobs_duration',
    'type' => 'taxonomy',
    'field_type' => 'select',
    'taxonomy' => 'jobs_duration',
    'load_save_terms'   => 0,
    'parent' => $key_setting 
)); 


acf_add_local_field(array(
    'key' => $key_slug.'proposal_hour',
    'label' => 'Estimated hours',
    'name' => 'proposal_hour',
    'type' => 'number',
    'parent' => $key_setting 
));

acf_add_local_field(array(
    'key' => $key_slug.'admin_fee',
    'label' => 'Admin fee',
    'name' => 'admin_fee',
    'type' => 'number',
    'parent' => $key_setting 
));

acf_add_local_field(array(
    'key' => $key_slug.'proposal_attachments',
    'label' => 'Attachments',
    'name' => 'proposal_attachments',
    'type' => 'gallery',
    'return_format' => 'id',
    'parent' => $key_setting 
));



endif;