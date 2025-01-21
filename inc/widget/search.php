<?php
function register_search_widget() {
    if(function_exists('insert_widgets')) insert_widgets('Custom_Search_Widget');
}
add_action('widgets_init', 'register_search_widget');

// Create the widget class
class Custom_Search_Widget extends WP_Widget {
    public function __construct() {
        parent::__construct(
            'custom_search_widget',
            'JWS Search',
            array('description' => 'jws search form widget.')
        );
    }

    public function widget($args, $instance) {
        global $wp;
        echo ''.$args['before_widget'];

        // Display widget title
        $title = apply_filters('widget_title', $instance['title']);
        if ($title) {
            echo ''.$args['before_title'] . $title . $args['after_title'];
        }
  		if ( '' === get_option( 'permalink_structure' ) ) {
			$form_action = remove_query_arg( array( 'page', 'paged' ), add_query_arg( $wp->query_string, '', home_url( $wp->request ) ) );
		} else {
			$form_action = preg_replace( '%\/page/[0-9]+%', '', home_url( trailingslashit( $wp->request ) ) );
		}
        // Display search form
        ?>
        <form role="search" method="get" class="search-form" action="<?php echo ''.$form_action; ?>">
           <button type="submit" class="search-submit"><i aria-hidden="true" class="  jws-icon-magnifying-glass"></i></button>
           <input type="search" class="search-field" placeholder="<?php echo esc_attr_x('Search...', 'placeholder', 'freeagent'); ?>" value="<?php echo get_search_query(); ?>" name="s" />
          
        </form>
        <?php

        echo ''.$args['after_widget'];
    }

    public function form($instance) {
        $title = !empty($instance['title']) ? $instance['title'] : '';
        

        // Output the widget form
        ?>
        <p>
            <label for="<?php echo ''.$this->get_field_id('title'); ?>">Title:</label>
            <input class="widefat" id="<?php echo ''.$this->get_field_id('title'); ?>" name="<?php echo ''.$this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>">
        </p>

        <?php
    }

    public function update($new_instance, $old_instance) {
        $instance = array();
        $instance['title'] = !empty($new_instance['title']) ? strip_tags($new_instance['title']) : '';
        $instance['post_type'] = !empty($new_instance['post_type']) ? sanitize_key($new_instance['post_type']) : '';

        return $instance;
    }
}
