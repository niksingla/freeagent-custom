<?php 

if (function_exists('acf_add_local_field_group')):
    $key_setting = 'jws_report_metabox';
    $key_slug = 'field_jws_report_';
  
  
  
 acf_add_local_field_group(array(
    'key' => $key_setting,
    'title' => 'Report Detail',
    'fields' => array (),
    'location' => array (
        array (
            array (
                'param' => 'post_type',
                'operator' => '==',
                'value' => 'jws_report',
            ),
        ),
    ),
));

acf_add_local_field(array(
    'key' => $key_slug.'reason_type',
    'label' => 'Reason Type',
    'name' => 'reason_type',
    'type' => 'select',
    'choices' => array(
        'freelancer' => 'Freelancer',
        'employer' => 'Employer',  
        'job' => 'Job', 
        'service' => 'Service',       
     ),
    'allow_null' => 1,
    'parent' => $key_setting 
));

acf_add_local_field(array(
    'key' => $key_slug.'reason',
    'label' => 'Reason',
    'name' => 'reason',
    'type' => 'select',
    'choices' => array(
        'fake' => 'This is the fake',
        'other' => 'Other',        
     ),
    'allow_null' => 1,
    'parent' => $key_setting,
    'conditional_logic' => array (
		array (
			array (
    			'field' => $key_slug.'reason_type',
    			'operator' => '!=',
    			'value' => 'job',
			),
            array (
    			'field' => $key_slug.'reason_type',
    			'operator' => '!=',
    			'value' => 'service',
			),
		),
	),
));

acf_add_local_field(array(
    'key' => $key_slug.'job_reason',
    'label' => 'Reason',
    'name' => 'job_reason',
    'type' => 'taxonomy',
    'field_type' => 'select',
    'taxonomy' => 'report_cat',
    'load_save_terms'   => 1,
    'allow_null' => 1,
    'parent' => $key_setting,
    'conditional_logic' => array (
		array (
			array (
    			'field' => $key_slug.'reason_type',
    			'operator' => '==',
    			'value' => 'job',
			),
		),
	),
));

acf_add_local_field(array(
    'key' => $key_slug.'service_reason',
    'label' => 'Reason',
    'name' => 'service_reason',
    'type' => 'taxonomy',
    'field_type' => 'select',
    'taxonomy' => 'service_report_reason',
    'load_save_terms'   => 1,
    'allow_null' => 1,
    'parent' => $key_setting,
    'conditional_logic' => array (
		array (
			array (
    			'field' => $key_slug.'reason_type',
    			'operator' => '==',
    			'value' => 'service',
			),
		),
	),
));

acf_add_local_field(array(
    'key' => $key_slug.'description',
    'label' => 'Description',
    'name' => 'description',
    'type' => 'textarea',
    'parent' => $key_setting 
));

acf_add_local_field(array(
    'key' => $key_slug.'user_report',
    'label' => 'User report',
    'name' => 'user_report',
    'type' => 'text',
    'parent' => $key_setting,
    'conditional_logic' => array (
		array (
			array (
    			'field' => $key_slug.'reason_type',
    			'operator' => '!=',
    			'value' => 'job',
			),
            array (
    			'field' => $key_slug.'reason_type',
    			'operator' => '!=',
    			'value' => 'service',
			),
		),
	),
));

acf_add_local_field(array(
    'key' => $key_slug.'job_report',
    'label' => 'Id reported job',
    'name' => 'job_report',
    'type' => 'text',
    'parent' => $key_setting,
    'conditional_logic' => array (
		array (
			array (
    			'field' => $key_slug.'reason_type',
    			'operator' => '==',
    			'value' => 'job',
			),
		),
	),
));

acf_add_local_field(array(
    'key' => $key_slug.'service_report',
    'label' => 'Id reported service',
    'name' => 'service_report',
    'type' => 'text',
    'parent' => $key_setting,
    'conditional_logic' => array (
		array (
			array (
    			'field' => $key_slug.'reason_type',
    			'operator' => '==',
    			'value' => 'service',
			),
		),
	),
));

endif;