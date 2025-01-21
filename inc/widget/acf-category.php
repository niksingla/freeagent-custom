<?php

class JwsCategoryListWidget extends WP_Widget {
    public function __construct() {
        parent::__construct(
            'custom_category_list_widget',
            'Jws Category List',
            array('description' => 'Display a list of categories for custom post types.')
        );
    }

    public function widget($args, $instance) {
        echo ''.$args['before_widget'];

        // Display widget title
        $title = apply_filters('widget_title', $instance['title']);
        if ($title) {
            echo ''.$args['before_title'] . $title . $args['after_title'];
        }
        global $wp;
        // Display category list
        $taxonomy = $instance['taxonomy'];
        $type = isset($instance['type']) ? $instance['type'] : 'checkbox';
        $categories = get_categories(array('taxonomy' => $taxonomy, 'show_count'=>'yes'));
        $cat_current = get_queried_object_id();
        $argss = array();
  		if ( '' === get_option( 'permalink_structure' ) ) {
			$form_action = remove_query_arg( array( 'page', 'paged' ), add_query_arg( $wp->query_string, '', home_url( $wp->request ) ) );
		} else {
			$form_action = preg_replace( '%\/page/[0-9]+%', '', home_url( trailingslashit( $wp->request ) ) );
		}
     
       
        if ($categories) {
   
            if($type == 'checkbox') {
            
               echo '<div class="type checkbox"><form method="get" action="'.esc_url( $form_action ).'">
                        <input name="'.$taxonomy.'" type="hidden" class="file_checkbox_value">';
                        jws_query_string_form_fields( null, array($taxonomy), '', false );
                 echo '</form>';
                
                  if(isset($_GET[$taxonomy])) {
                      $argss   =   explode( ',',  $_GET[$taxonomy] );  
                    }
                  
                echo '<ul>';
                foreach ($categories as $category) {
                     $id = $category->term_id; 
                    
                     if (in_array($category->slug, $argss) || ($cat_current == $id )){
                      $current = 'current-cat';  
                     } else{
                      $current ='';    
                     }
                      $logo_loca_value = get_field('logo_loca', $category);
                      
                      if(!empty($logo_loca_value)){
                        $flag = '<img src="' . esc_url($logo_loca_value['url']) . '" alt="Logo" />';
                      }else{
                        $flag='';
                      }
                    echo '<li><a data-name="'.$taxonomy.'" data-value="'.esc_attr( $category->slug ).'" data-title="'.$category->name.'" class="'.$current.'">' .$flag. $category->name . '<span class="count">('.$category->count.')</span></a></li>';
                }
                echo '</ul></div>';
                
            } else {
                
                echo '<div class="type select"><form method="get" action="'.esc_url( $form_action ).'">
                        <input name="'.$taxonomy.'" type="hidden" class="file_checkbox_value">';
                        jws_query_string_form_fields( null, array($taxonomy), '', false );
                 echo '</form>';
                
                  if(isset($_GET[$taxonomy])) {
                      $argss   =   $_GET[$taxonomy];  
                  } else {
                    $argss = '';
                  }
                  
                echo '<select>';
                echo '<option value="">'.esc_html__('Select ','freeagent').$title.'</option>';
                foreach ($categories as $category) {
                     $id = $category->term_id; 
                
                      $logo_loca_value = get_field('logo_loca', $category);
                      
                      if(!empty($logo_loca_value)){
                        $flag = '<img src="' . esc_url($logo_loca_value['url']) . '" alt="Logo" />';
                      }else{
                        $flag='';
                      }
                    echo '<option data-name="'.$taxonomy.'" value="'.esc_attr( $category->slug ).'" '.selected($argss, esc_attr( $category->slug ), false).' >' .$flag. $category->name . '('.$category->count.')' . '</option>';
                }
                echo '</select></div>';
                
            }
         
        }

        echo ''.$args['after_widget'];
    }

    public function form($instance) {
        $title = !empty($instance['title']) ? $instance['title'] : 'Category List';
        $taxonomy = !empty($instance['taxonomy']) ? $instance['taxonomy'] : 'category';
        $type = !empty($instance['type']) ? $instance['type'] : 'checkbox';
        // Output the widget form
        ?>
        <p>
            <label for="<?php echo ''.$this->get_field_id('title'); ?>">Title:</label>
            <input class="widefat" id="<?php echo ''.$this->get_field_id('title'); ?>" name="<?php echo ''.$this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>">
        </p>
        <p>
            <label for="<?php echo ''.$this->get_field_id('taxonomy'); ?>">Select Taxonomy:</label>
            <select id="<?php echo ''.$this->get_field_id('taxonomy'); ?>" name="<?php echo ''.$this->get_field_name('taxonomy'); ?>" class="widefat">
                <?php
                $taxonomies = get_taxonomies(array(), 'objects');
                foreach ($taxonomies as $taxonomy_object) {
                    echo '<option value="' . $taxonomy_object->name . '" ' . selected($taxonomy, $taxonomy_object->name, false) . '>' . $taxonomy_object->label . '</option>';
                }
                ?>
            </select>
        </p>
        <p>
            <label for="<?php echo ''.$this->get_field_id('type'); ?>">Select Type:</label>
            <select id="<?php echo ''.$this->get_field_id('type'); ?>" name="<?php echo ''.$this->get_field_name('type'); ?>" class="widefat">
                <option value="checkbox" <?php echo selected($type, 'checkbox' , false);  ?>>Checkbox</option>
                <option value="select" <?php echo selected($type, 'select' , false);  ?>>Select</option>
            </select>
        </p>
        <?php
    }

    public function update($new_instance, $old_instance) {
        $instance = array();
        $instance['title'] = !empty($new_instance['title']) ? strip_tags($new_instance['title']) : '';
        $instance['taxonomy'] = !empty($new_instance['taxonomy']) ? $new_instance['taxonomy'] : 'category';
        $instance['type'] = !empty($new_instance['type']) ? $new_instance['type'] : 'checkbox';
        return $instance;
    }
}


if(function_exists('insert_widgets')) {
    insert_widgets( 'JwsCategoryListWidget' );
}