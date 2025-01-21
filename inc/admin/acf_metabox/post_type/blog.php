<?php 

if( function_exists('acf_add_local_field_group') ):
    
    $key_slug = 'field_blog_';
  acf_add_local_field_group(array(
        'key' => 'category',
        'title' => 'Setting',
        'fields' => array (
            array(
                'key' => $key_slug.'color',
                'label' => 'Color',
                'name' => 'color',
                'type' => 'color_picker',
            ),
        ),
        'location' => array (
            array (
                array (
                    'param' => 'taxonomy',
                    'operator' => '==',
                    'value' => 'category',
                ),
            ),
        ),
    ));
    acf_add_local_field_group(array(
        'key' => 'blog_quote_metabox',
        'title' => __('Quote Setting','freeagent'),
        'fields' => array(
            array(
                'key' => 'blog_name_quote',
                'label' => __('Add Name Quote','freeagent'),
                'name' => 'blog_name_quote',
                'type' => 'text',
            ),
         ),    
        'location' => array (
            array (
                array(
                    'param' => 'post_format',
                    'operator' => '==',
                    'value' => 'quote',
                ),
            ),
        ),
    ));
    
    acf_add_local_field_group(array(
        'key' => 'blog_audio_metabox',
        'title' => __('Audio Setting','freeagent'),
        'fields' => array(
            array(
                'key' => 'blog_audio_url',
                'label' => __('Add Link Audio','freeagent'),
                'name' => 'blog_audio_url',
                'type' => 'text',
            ),
         ),   
        'location' => array (
            array (
                array(
                    'param' => 'post_format',
                    'operator' => '==',
                    'value' => 'audio',
                ),
            ),
        ),
    ));
    
    acf_add_local_field_group(array(
        'key' => 'blog_link_metabox',
        'title' => __('Link Setting','freeagent'),
        'fields' => array(
            array(
                'key' => 'blog_name_link',
                'label' => __('Add Name Link','freeagent'),
                'name' => 'blog_name_link',
                'type' => 'text',
            ),
            array(
                'key' => 'blog_url_link',
                'label' => __('Add Url Link','freeagent'),
                'name' => 'blog_url_link',
                'type' => 'text',
            ),
         ),   
        'location' => array (
            array (
                array(
                    'param' => 'post_format',
                    'operator' => '==',
                    'value' => 'link',
                ),
            ),
        ),
    ));
    
    acf_add_local_field_group(array(
        'key' => 'blog_video_metabox',
        'title' => __('Video Setting','freeagent'),
        'fields' => array(
            array(
                'key' => 'blog_video',
                'label' => __('Add Url For Video','freeagent'),
                'name' => 'blog_video',
                'type' => 'text',
            ),
            
         ),   
        'location' => array (
            array (
                array(
                    'param' => 'post_format',
                    'operator' => '==',
                    'value' => 'video',
                ),
            ),
        ),
    ));
    
    acf_add_local_field_group(array(
        'key' => 'blog_gallery_metabox',
        'title' => __('Gallery Setting','freeagent'),
        'fields' => array(
          
          array(
            'key' => 'image_gallery_list',
            'label' => __('Gallery','freeagent'),
            'name' => 'image_gallery_list',
            'type' => 'gallery',
            'instructions' => __('Select images for the gallery.','freeagent'),
            'required' => false,
            'return_format' => 'array',
            'preview_size' => 'thumbnail',
            'library' => 'all',
        )
            
         ),   
        'location' => array (
            array (
                array(
                    'param' => 'post_format',
                    'operator' => '==',
                    'value' => 'gallery',
                ),
            ),
        ),
    ));

endif;   


?>