<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

use Elementor\Core\Schemes;

/**
 * Elementor icon list widget.
 *
 * Elementor widget that displays a bullet list with any chosen icons and texts.
 *
 * @since 1.0.0
 */
class Jws_Dashboard_Packages extends Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve icon list widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'dashboard_packages';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve icon list widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Dashboard Packages', 'freeagent' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve icon list widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-bullet-list';
	}

	/**
	 * Get widget keywords.
	 *
	 * Retrieve the list of keywords the widget belongs to.
	 *
	 * @since 2.1.0
	 * @access public
	 *
	 * @return array Widget keywords.
	 */
	public function get_keywords() {
		return [ 'memberships', 'packages', 'dashboard' ];
	}

	/**
	 * Register icon list widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls() {
	   
		$this->start_controls_section(
			'section_icon',
			[
				'label' => esc_html__( 'Packages List', 'freeagent' ),
			]
		);
        
        $this->add_control(
				'packages_type',
				[
					'label'     => esc_html__( 'Packages Type', 'freeagent' ),
					'type'      => Controls_Manager::SELECT,
					'default'   => 'employer',
					'options'   => [
						'employer'   => esc_html__( 'Employer', 'freeagent' ),
						'freelancer'   => esc_html__( 'Freelancer', 'freeagent' ),
					],
                    
				]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'em_name',
			[
				'label' => esc_html__( 'Text', 'freeagent' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'placeholder' => esc_html__( 'Name', 'freeagent' ),
				'default' => esc_html__( 'Name', 'freeagent' ),
			]
		);
		$repeater->add_control(
			'em_description',
			[
				'label' => esc_html__( 'Description', 'freeagent' ),
				'type' => Controls_Manager::TEXTAREA,
				'label_block' => true,
				'placeholder' => esc_html__( '', 'freeagent' ),
		
			]
		);
        
        $repeater->add_control('em_product', [
                'label' => esc_html__('Product', 'freeagent'),
                'description' => esc_html__('', 'freeagent'),
                'type' => Controls_Manager::SELECT2,
                'options' => $this->get_list_posts('product'),
        ]);

		$this->add_control(
			'em_list',
			[
				'label' => '',
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'em_name' => esc_html__( 'Package #1', 'freeagent' ),
					],
					[
						'em_name' => esc_html__( 'Package #2', 'freeagent' ),
					],
					[
						'em_name' => esc_html__( 'Package #3', 'freeagent' ),
					],
				],
				'title_field' => '{{{ em_name }}}',
                'condition' => [
    				'packages_type' => 'employer',
    			],
			]
		);
        
        
        $repeater = new Repeater();
        $repeater->add_control(
            'feature_slug',
            [
                'label' => esc_html__('Feature Slug', 'freeagent'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
                'placeholder' => esc_html__('Slug', 'freeagent'),
                'default' => 'default_slug',
                
            ]
        );
		$repeater->add_control(
			'title',
			[
				'label' => esc_html__( 'Feature Title', 'freeagent' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'placeholder' => esc_html__( 'Title', 'freeagent' ),
			
			]
		);
		$repeater->add_control(
			'des',
			[
				'label' => esc_html__( 'Description', 'freeagent' ),
				'type' => Controls_Manager::TEXTAREA,
				'label_block' => true,
				'placeholder' => esc_html__( '', 'freeagent' ),
		
			]
		);
        


		$this->add_control(
			'em_fe_list',
			[
				'label' => '',
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
                    [
                        'feature_slug' => 'jobs_number',
                        'title' => esc_html__('Jobs Allowed', 'freeagent'),
                        'des' => esc_html__('We charge a nominal fee for our services on every paid invoice.', 'freeagent'),
                    ],
	               [
                        'feature_slug' => 'jobs_expiry',
                        'title' => esc_html__('Jobs Days Visibility', 'freeagent'),
                        'des' => esc_html__('We charge a nominal fee for our services on every paid invoice.', 'freeagent'),
                    ],
                    [
                        'feature_slug' => 'jobs_featured_number',
                        'title' => esc_html__('Jobs Featured Allowed', 'freeagent'),
                        'des' => esc_html__('We charge a nominal fee for our services on every paid invoice.', 'freeagent'),
                    ],
                    [
                        'feature_slug' => 'jobs_featured_expiry',
                        'title' => esc_html__('Featured Days Visibility', 'freeagent'),
                        'des' => esc_html__('We charge a nominal fee for our services on every paid invoice.', 'freeagent'),
                    ],
                    [
                        'feature_slug' => 'package_expiry',
                        'title' => esc_html__('Package Expiry', 'freeagent'),
                        'des' => esc_html__('We charge a nominal fee for our services on every paid invoice.', 'freeagent'),
                    ],
				],
				'title_field' => '{{{ title }}}',
                'condition' => [
    				'packages_type' => 'employer',
    			],
                'max_items' => 5,
			]
		);        
        $repeater = new Repeater();
        
        $repeater->add_control(
			'free_name',
			[
				'label' => esc_html__( 'Text', 'freeagent' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'placeholder' => esc_html__( 'Name', 'freeagent' ),
				'default' => esc_html__( 'Name', 'freeagent' ),
			]
		);
		$repeater->add_control(
			'free_description',
			[
				'label' => esc_html__( 'Description', 'freeagent' ),
				'type' => Controls_Manager::TEXTAREA,
				'label_block' => true,
				'placeholder' => esc_html__( '', 'freeagent' ),
		
			]
		);
        
        $repeater->add_control('free_product', [
                'label' => esc_html__('Product', 'freeagent'),
                'description' => esc_html__('', 'freeagent'),
                'type' => Controls_Manager::SELECT2,
                'options' => $this->get_list_posts('product'),
        ]);

		$this->add_control(
			'free_list',
			[
				'label' => '',
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'free_name' => esc_html__( 'Package #1', 'freeagent' ),
					],
					[
						'free_name' => esc_html__( 'Package #2', 'freeagent' ),
					],
					[
						'free_name' => esc_html__( 'Package #3', 'freeagent' ),
					],
				],
				'title_field' => '{{{ free_name }}}',
                'condition' => [
    				'packages_type' => 'freelancer',
    			],
			]
		);
        $repeater = new Repeater();
        $repeater->add_control(
            'feature_slug',
            [
                'label' => esc_html__('Feature Slug', 'freeagent'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
                'placeholder' => esc_html__('Slug', 'freeagent'),
                'default' => 'default_slug',
                
            ]
        );
		$repeater->add_control(
			'title',
			[
				'label' => esc_html__( 'Feature Title', 'freeagent' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'placeholder' => esc_html__( 'Title', 'freeagent' ),
			
			]
		);
		$repeater->add_control(
			'des',
			[
				'label' => esc_html__( 'Description', 'freeagent' ),
				'type' => Controls_Manager::TEXTAREA,
				'label_block' => true,
				'placeholder' => esc_html__( '', 'freeagent' ),
		
			]
		);
        


		$this->add_control(
			'free_fe_list',
			[
				'label' => '',
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
                    [
                        'feature_slug' => 'services_fee',
                        'title' => esc_html__('Service Fee', 'freeagent'),
                        'des' => esc_html__('We charge a nominal fee for our services on every paid invoice.', 'freeagent'),
                    ],
	               [
                        'feature_slug' => 'services_number',
                        'title' => esc_html__('Services Allowed', 'freeagent'),
                        'des' => esc_html__('We charge a nominal fee for our services on every paid invoice.', 'freeagent'),
                    ],
                    [
                        'feature_slug' => 'services_expiry',
                        'title' => esc_html__('Services Days Visibility', 'freeagent'),
                        'des' => esc_html__('We charge a nominal fee for our services on every paid invoice.', 'freeagent'),
                    ],
                    [
                        'feature_slug' => 'bids_number',
                        'title' => esc_html__('Number of Bids', 'freeagent'),
                        'des' => esc_html__('We charge a nominal fee for our services on every paid invoice.', 'freeagent'),
                    ],
                    [
                        'feature_slug' => 'package_expiry',
                        'title' => esc_html__('Package Expiry', 'freeagent'),
                        'des' => esc_html__('We charge a nominal fee for our services on every paid invoice.', 'freeagent'),
                    ],
				],
				'title_field' => '{{{ title }}}',
                'condition' => [
    				'packages_type' => 'freelancer',
    			],
                
			]
		);        
		$this->end_controls_section();
    
	}

	/**
	 * Render icon list widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {
	   
		$settings = $this->get_settings_for_display();
        
        $flex = 'em';
        
        $feature = $settings[$flex.'_fe_list'];
         
            if($settings['packages_type'] == 'freelancer') {
            
            $flex = 'free';
            $feature = $settings[$flex.'_fe_list'];
            
        }
       
        ?>  
        <div class="packages-table-container">
        <table class="packages-table">
     
          <thead>
            
            <tr>
            
               <td><div class="fw-500 fs-md"><?php echo esc_html__('All packages','freeagent'); ?></div></td>
               
               <?php foreach ( $settings[$flex.'_list'] as $index => $item ) :  ?>
                     
                     <td class="price_heading">
                         
                         <div class="packges-name fw-700">
                          
                          <?php echo esc_html($item[$flex.'_name']);  ?>
                         
                         </div>
                         
                         <h3 class="packges-price fw-700">
                           
                           <?php
                             if(!empty($item[$flex.'_product'])) {
                                  $product = wc_get_product( $item[$flex.'_product'] );
                                  echo ''.$product->get_price_html();
                             }
                           
                           
                            ?>
                         
                         </h3>
                         
                         <div class="packges-description">
                          
                          <?php echo esc_html($item[$flex.'_description']);  ?>
                         
                         </div>
                         
                         <button class="jws-buy-packages" type="button" data-product="<?php echo esc_attr($item[$flex.'_product']); ?>"><?php echo esc_html__('Buy Now','freeagent');  ?></button>
                         <input type="hidden" class="employer_package_nonce" value="<?php echo wp_create_nonce( 'employer_package_nonce_value' ); ?>">
                         
                         <?php 
                         
                         
                         
                         ?>
                     
                     </td>
               
               <?php endforeach; ?>
            
            </tr>
            
          </thead>
          
          
          <tbody>
             <tr><td class="features_heading"><?php echo esc_html__('Features','freeagent'); ?></td></tr>
             <?php foreach ( $feature as $slug_key => $feature_item ) :  ?>
           
             <tr>
                <td>
                   
                   <div class="fw-700 cl-main"><?php echo esc_html($feature_item['title']); ?></div>
                   <div class="des"><?php echo esc_html($feature_item['des']); ?></div>
                
                </td> 
                <?php foreach ( $settings[$flex.'_list'] as $index => $item ) :  ?>
                     
                     <td>
                   
                         <?php 
                         $slug_meta=$feature_item['feature_slug'];
                          $feature_meta = get_post_meta( $item[$flex.'_product'] , $slug_meta , true);
                          
                         
                          if($slug_meta == 'jobs_fee' || $slug_meta == 'services_fee') {
                            
                            echo ''.$feature_meta.'%';
                            
                          } elseif($slug_meta == 'jobs_number' || $slug_meta == 'services_number') {
                            
                            echo ''.$feature_meta;
                            
                          } elseif($slug_meta == 'jobs_expiry' || $slug_meta == 'services_expiry') {
                           
                              if($feature_meta == '-1') {
                                 
                                 echo esc_html__('Unlimited','freeagent');
                                
                              } elseif((int)$feature_meta <= 0 || empty($feature_meta)) {
                                
                                 echo esc_html__('No support','freeagent');
                                 
                              } else {
                                 
                                 echo esc_html($feature_meta);
                                
                              }
                         
                          } elseif($slug_meta == 'jobs_featured_number') {
                            
                            echo ''.$feature_meta == '-1' ?  esc_html__('Unlimited','freeagent') : $feature_meta;
                            
                          } elseif($slug_meta == 'jobs_featured_expiry') {
                            
                            echo ''.$feature_meta == '-1' ?  esc_html__('Unlimited','freeagent') : $feature_meta;
                            
                          } elseif($slug_meta == 'package_expiry' || $slug_meta == 'services_expiry') {
                            
                            echo ''.$feature_meta == '-1' ?  esc_html__('Unlimited','freeagent') : $feature_meta;
                            
                          } elseif($slug_meta == 'bids_number') {
                            
                            echo ''.$feature_meta == '-1' ?  esc_html__('Unlimited','freeagent') : $feature_meta;
                            
                          } elseif($slug_meta == 'services_featured_expiry') {
                            
                            echo ''.$feature_meta == '-1' ?  esc_html__('Unlimited','freeagent') : $feature_meta;
                            
                          } elseif($slug_meta == 'services_featured_number') {
                            
                            echo ''.$feature_meta == '-1' ?  esc_html__('Unlimited','freeagent') : $feature_meta;
                            
                          }
                         
                          
                          
                         
                         ?>
                     
                     </td>
                
                <?php endforeach; ?>
               
             </tr>
             
             <?php endforeach; ?>
          
          </tbody>
          

        </table>
        
       </div> 
		<?php

    	
	}
    
    protected function get_list_posts($post_type = 'post')
        {
            $args = array(
                'post_type'        => $post_type,
                'suppress_filters' => true,
                'posts_per_page'   => 300,
                'no_found_rows'    => true,
            );
    
            $the_query = new \WP_Query($args);
            $results   = [];
    
            if (is_array($the_query->posts) && count($the_query->posts)) {
                foreach ($the_query->posts as $post) {
                    $results[ $post->ID ] = sanitize_text_field($post->post_title);
                }
            }
    
            return $results;
    }

	/**
	 * Render icon list widget output in the editor.
	 *
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 *
	 * @since 2.9.0
	 * @access protected
	 */
	protected function content_template() {

	}

}
