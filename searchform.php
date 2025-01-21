<?php
/**
 * Template for displaying search forms in Twenty Seventeen
 *
 * @package WordPress
 * @subpackage freeagent
 * @since 1.0
 * @version 1.0
 */

?>


<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <button type="submit" class="searchsubmit">
		 <i aria-hidden="true" class="  jws-icon-magnifying-glass"></i>			
    </button>    
  
	<input type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Search', 'placeholder', 'freeagent' ); ?>" value="<?php echo get_search_query(); ?>" name="s" />
   
</form>
