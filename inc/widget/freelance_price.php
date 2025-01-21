<?php
class Jws_Price_Filter_Widget extends WP_Widget
{
	function __construct()
	{
		parent::__construct(
		  
		// Base ID of your widget
		'jws_price_filter_widget', 
		  
		// Widget name will appear in UI
		__('Jws Filter By Price', 'freeagent'), 
		  
		// Widget description
		array( 'description' => __( 'Freelance Search by Price', 'freeagent' ), ) 
		);
	}
	  
	// Creating widget front-end
	  
	public function widget( $args, $instance )
	{
	    global $wp;
         wp_enqueue_script( 'rangeslider', JWS_URI_PATH. '/assets/js/lib/ion.rangeslider.min.js', array(), '', true );
        wp_enqueue_style('rangeslider', JWS_URI_PATH.'/assets/css/ion-rangeslider.min.css');

        echo ''.$args['before_widget'];

		$title = apply_filters( 'widget_title', $instance['title'] );

		$price_min ='';
		if(isset($_GET['min_price']) && $_GET['min_price'] !='')
		{
			$price_min = $_GET['min_price'];	
		}
		$price_max ='';
		if(isset($_GET['max_price']) && $_GET['max_price'] !='')
		{
			$price_max = $_GET['max_price'];	
		}
        
		if ( '' === get_option( 'permalink_structure' ) ) {
			$form_action = remove_query_arg( array( 'page', 'paged' ), add_query_arg( $wp->query_string, '', home_url( $wp->request ) ) );
		} else {
			$form_action = preg_replace( '%\/page/[0-9]+%', '', home_url( trailingslashit( $wp->request ) ) );
		}
        $step = 10;
                

        if ($title) {
            echo ''.$args['before_title'] . $title . $args['after_title'];
        }
		?>
       <form class="freelance_price_filter" method="get" action="<?php echo esc_url( $form_action ); ?>">
          
            <div class="panel-body">
                <div class="price_slider_amount">
                    <input type="text" class="services-input-from form-control" value="<?php echo esc_attr($price_min); ?>" name="min_price"/>
                    <input type="text" class="services-input-to form-control" value="<?php echo esc_attr($price_max); ?>"  name="max_price"/>
                </div>
                <div class="range-slider">
                    <input type="text" class="services-range-slider" value="" data-min="<?php echo esc_attr($instance['min_range']); ?>" data-max="<?php echo esc_attr($instance['max_range']); ?>" data-from="<?php echo esc_attr($price_min); ?>" data-to="<?php echo esc_attr($price_max); ?>"/>
                </div>
            </div>
       			<?php echo jws_query_string_form_fields( null, array( 'min_price', 'max_price', 'paged' ), '', true ); ?>
        </form>
		<?php
        echo ''.$args['after_widget'];
	}
	// Widget Backend 
	public function form( $instance )
	{
		if ( isset( $instance[ 'title' ] ) )
		{
			$title = $instance[ 'title' ];
		}
		else
		{
			$title = __( 'New title', 'freeagent' );
		}
		
		if ( isset( $instance[ 'min_range' ] ) )
		{
			$min_range = $instance[ 'min_range' ];
		}
		else
		{
			$min_range = __( '0', 'freeagent' );
		}
		
		if ( isset( $instance[ 'max_range' ] ) )
		{
			$max_range = $instance[ 'max_range' ];
		}
		else
		{
			$max_range = __( '100', 'freeagent' );
		}
		// Widget admin form
		
		?>
		<p>
        <div class="form-group">
		  <label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>">
			<?php echo __( 'Title', 'freeagent' ); ?>
		  </label>
		  <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </div>
        <div class="form-group">
		  <label for="<?php echo esc_attr($this->get_field_id( 'min_range' )); ?>">
			<?php echo __( 'Minimum Range', 'freeagent' ); ?>
		  </label>
		  <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'min_range' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'min_range' )); ?>" type="text" value="<?php echo esc_attr( $min_range ); ?>" />
        </div>
        <div class="form-group">
		  <label for="<?php echo esc_attr($this->get_field_id( 'max_range' )); ?>">
			<?php echo __( 'Maximum Range', 'freeagent' ); ?>
		  </label>
		  <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'max_range' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'max_range' )); ?>" type="text" value="<?php echo esc_attr( $max_range ); ?>" />
        </div>

		</p>
		<?php 
	}
		  
	// Updating widget replacing old instances with new
	public function update( $new_instance, $old_instance )
	{
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['min_range'] = ( ! empty( $new_instance['min_range'] ) ) ? strip_tags( $new_instance['min_range'] ) : '';
		$instance['max_range'] = ( ! empty( $new_instance['max_range'] ) ) ? strip_tags( $new_instance['max_range'] ) : '';
		return $instance;
	}
// Class exertio_services_keyword_widget ends here
} 

if(function_exists('insert_widgets')) {
    insert_widgets( 'Jws_Price_Filter_Widget' );
}