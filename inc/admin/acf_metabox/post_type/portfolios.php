<?php 

if (function_exists('acf_add_local_field_group')):
    $key_setting = 'portfolios_metabox';
    $key_slug = 'field_portfolios_';
    
    
  acf_add_local_field_group(array(
    'key' => $key_setting,
    'title' => 'Portfolio Setting',
    'fields' => array (),
    'location' => array (
        array (
            array (
                'param' => 'post_type',
                'operator' => '==',
                'value' => 'portfolios',
            ),
        ),
    ),
));   
  acf_add_local_field(array(
    'key' => $key_slug.'project_link',
    'label' => 'Project link',
    'name' => 'project_link',
    'type' => 'url',
    'parent' => $key_setting 
));
  acf_add_local_field(array(
    'key' => $key_slug.'project_vid_link',
    'label' => 'Project video link',
    'name' => 'project_vid_link',
    'type' => 'url',
    'parent' => $key_setting 
));
 acf_add_local_field(array(
    'key' => $key_slug.'portfolio_attachments',
    'label' => 'Project images',
    'name' => 'portfolio_attachments',
    'type' => 'gallery',
    'return_format' => 'id',
    'parent' => $key_setting 
));




  endif;