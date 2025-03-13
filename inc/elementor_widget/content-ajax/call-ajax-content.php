<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' );
}

if(class_exists('NextendSocialLogin', false)){
    
    add_action('nsl_register_new_user', function ($user_id) {
 
             $user_info = get_user_by('id', $user_id);
  
             if($user_info) {
                
                     $current_user_id =  $user_info->ID;
                   
                     $change_role = '1';
                     $user_type = 'employer'; 
                     jws_create_posttype_after_register($user_type,$user_info,$current_user_id); 
                  
                    update_user_meta($current_user_id, '_active_profile', $change_role);
              
                
             }

    });

}

function jws_create_posttype_after_register($user_type,$user_info,$uid) {
    
      if (isset($user_type) && $user_type == 'employer') {
                $my_post = array(
                    'post_title' => sanitize_text_field($user_info->user_login),
                    'post_status' => 'publish',
                    'post_author' => $uid,
                    'post_type' => 'employers'
                );

                $company_id = wp_insert_post($my_post);
                update_post_meta($company_id, '_employer_dispaly_name', sanitize_text_field($user_info->display_name));
                update_user_meta($uid, 'employer_id', $company_id);

                update_user_meta($uid, '_active_profile', 1);

     } elseif(isset($user_type) && $user_type == 'freelancer') {
        
                $my_post = array(
                    'post_title' => sanitize_text_field($user_info->user_login),
                    'post_status' => 'publish',
                    'post_author' => $uid,
                    'post_type' => 'freelancers'
                );

                $freelancers_id = wp_insert_post($my_post);
                update_post_meta($freelancers_id, '_freelancer_dispaly_name', sanitize_text_field($user_info->display_name));
                update_user_meta($uid, 'freelancer_id', $freelancers_id);

                update_user_meta($uid, '_active_profile', 2);
        
     }
    
}


function alnuar_auto_login_new_user_after_registration( $user_id ) {

		if (isset($_POST['password'])) {
			wp_set_password( $_POST['password'], $user_id ); //Password previously checked in add_filter > registration_errors
		}
	

}
add_action( 'user_register', 'alnuar_auto_login_new_user_after_registration' );

function auto_redirect_after_logout(){
   global $jws_option;  
   if(isset($jws_option['logout_form_redirect']) && !empty($jws_option['logout_form_redirect'])) {
      $login_redirect = get_page_link($jws_option['logout_form_redirect']);
   }else {
      $login_redirect = home_url('/');
   }  
  wp_safe_redirect($login_redirect);
  exit;
}
add_action('wp_logout','auto_redirect_after_logout');


if (!function_exists('jws_get_content_form_login')) {
    
    function jws_get_content_form_login($show_login,$show_register,$active,$layouts)
    {      
        global $jws_option;

    $registration_enabled = get_option( 'users_can_register' );
    
    if($active == 'login' && !isset($_GET['signup'])) {
        $active_class = ' in-login';
    }
    if($active == 'resetPass' && !isset($_GET['signup'])) {
        $active_class = ' in-resetPass';
    }
    if($active == 'signup' || (isset($_GET['signup']) && $_GET['signup'] == 'true')) {
        $active_class = ' in-register';
    }
    $row = '';
    if($layouts=='url' && !empty($jws_option['register_form_page'])&& !empty($jws_option['login_form_page'])){
        $url_register = get_page_link($jws_option['register_form_page']);
        $url_login = get_page_link($jws_option['login_form_page']); 
        $swiper_wrap_start='';
        $swiper_wrap_end='';
       
    }else{
       $url_register = esc_url(jws_get_register_url());
        $url_login = esc_url( jws_get_login_page_url() );
        $row =' swiper swiper-no-swiping';
         $swiper_wrap_start ='<div class="swiper-wrapper">';
          $swiper_wrap_end ='</div>';
          wp_enqueue_script('swiper');
    }
    $services_link = (isset($jws_option['services_link'])) ? $jws_option['services_link'] : '';
    $agreement_link = (isset($jws_option['agreement_link'])) ? $jws_option['agreement_link'] : '';

      $policy = isset($jws_option['privacy-policy-link']) ? $jws_option['privacy-policy-link']:get_the_privacy_policy_link();  
    $employer_text = (isset($jws_option['employer_text'])) ? $jws_option['employer_text'] : '';
    $freelancer_text = (isset($jws_option['freelancer_text'])) ? $jws_option['freelancer_text'] : '';
    $account_link = class_exists('Woocommerce') ? wc_get_page_permalink( 'myaccount' ) : home_url( '/' );  
    $wc_lostpassword_url = class_exists('Woocommerce') ? wc_lostpassword_url( ) : home_url( '/' );  

     ?>

    <div id="jws-login-form" class="jws-login-form<?php echo esc_attr($active_class.' '.$layouts); ?>">
		<div class="jws-login-container">
            <div class="form-contaier <?php echo esc_attr($layouts).' '.$row; ?>">
            <?php 
            echo ''.$swiper_wrap_start;
            if($show_login) :  ?>
			<div class="<?php if($layouts!='url') echo 'swiper-slide';?>">
            
            <div class="jws-login">
            <div class="jws-animation">
              <h4 class="jws_heading_form heading-form-login"><?php echo esc_html__('Login','freeagent') ?> </h4>
             <?php
                $demo_mode = $jws_option['demo_mode'];
                if($demo_mode) {
               ?>     
                
              <div class="jws_account_demo">
                <span class="d-block"><?php echo esc_html__('Username: ','freeagent').'<strong>employer</strong> or <strong> freelancer</strong>';?></span>
                <span class="d-block"><?php echo esc_html__('Password: ','freeagent');?> <strong>Admin@1234</strong></span>
            </div>
            <?php }?>
           
                 <?php 
               
                     if(class_exists('NextendSocialLogin', false)){
                        ?> <div class="login-width-social"><?php
                        $render_social = NextendSocialLogin::renderButtonsWithContainer();
                         if(!empty($render_social)) {
                            
                            echo $render_social;
                            ?>
                             
                                <div class="social-line">
                                    <span><?php echo esc_html__('or','freeagent'); ?></span>
                                </div>
                             
                            <?php  
                         } 
                         ?>  </div> <?php
                      
                      }
                    
                    ?>  
               


            </div> 
				<form name="loginpopopform" id="loginform" action="<?php echo esc_url( site_url( 'wp-login.php', 'login_post' ) ); ?>" method="post">
                
					<p class="login-username">
                      
					    <span class="form_group ">
                    	   <input id="username" type="text" name="log" class="input required" value="" placeholder="mail@example.com" size="20" />
				        </span>
                	</p>
					<p class="login-password input-text">
                        
                        <span class="form_group">  
    						<input id="s-password" type="password" name="pwd" class="input required" placeholder="<?php echo esc_html__('Enter your password','freeagent');?>" value="" size="20" />
                            <span type="button" class="field-icon toggle-password2 jws-icon-eyeslash"></span>
                        </span>
					</p>
				
                    <div class="forgetmenot login-remember">
                        <label for="popupRememberme"><input name="rememberme" type="checkbox" value="forever" id="popupRememberme" /> <?php esc_html_e( 'Remember me', 'freeagent' ); ?></label>
                         <?php echo '<a class="lost-pass-link" href="' . $wc_lostpassword_url . '" title="' . esc_attr__( 'Forgot password?', 'freeagent' ) . '">' . esc_html__( 'Forgot password?', 'freeagent' ) . '</a>'; ?>
					</div>
					<div class="g-recaptcha" id="recaptcha7"></div>
					<p class="submit login-submit jws-button">
						<input type="submit" name="wp-submit" class="button elementor-button btn-main" value="<?php esc_attr_e( 'Login', 'freeagent' ); ?>" />
						<input type="hidden" name="testcookie" value="1" />
					</p>
					
                    <?php
        				if ( $show_login && ($show_register && $registration_enabled) ) {
        					echo '<div class="account">' . esc_html__( 'Not registered yet? ', 'freeagent' ) .'<a class="register change-form" href="'.$url_register.'">'. esc_html__( 'Create an Account', 'freeagent' ).'</a></div>';
        				}
    				?>
				</form>
	
                <div class="popup-message"></div>
              </div>
			</div>
            <?php endif; ?>
			<?php if ( $registration_enabled && $show_register): ?>
				<div class="<?php if($layouts!='url') echo 'swiper-slide';?>">   
        <div class="jws-register ">
        <div class="jws-animation">
              <h4 class="jws_heading_form heading-form-register"><?php echo esc_html__('Register','freeagent') ?></h4>
            
                   
                        <?php 
                           
                 
                         if(class_exists('NextendSocialLogin', false)){
                            ?> <div class="login-width-social"><?php
                            $render_social = NextendSocialLogin::renderButtonsWithContainer();
                             if(!empty($render_social)) {
                                
                                echo $render_social;
                                ?>
                                 
                                    <div class="social-line">
                                        <span><?php echo esc_html__('or','freeagent'); ?></span>
                                    </div>
                                 
                                <?php  
                             } 
                             ?>  </div> <?php
                          
                          }
                        
                        ?>  
                   
                       
        
                    </div> 
					<form class="auto_login" name="registerformpopup"  method="post" novalidate="novalidate">
 
                        <?php wp_nonce_field( 'ajax_register_nonce', 'register_security' ); ?>
                             <div class="user-roles">
                 <div>
                  <div class="roles">                   
                   <span class="icon_check"><i class="jws-icon-briefcase"></i> </span> 
                   
                   <input id="user_employer" type="radio" name="user_role" value="employer" checked>
                   <span class="checkbox"></span>
                   </div>
                    <?php if(!empty($freelancer_text)) echo '<label for="user_employer">'.$employer_text.'</label>';?>
                 </div>
                 <div>
                   <div class="roles">  
                    <span class="icon_check"><i class="jws-icon-laptop"></i></span> 
                     <input id="user_freelancer" type="radio" name="user_role" value="freelancer">
                     <span class="checkbox"></span>                     
                   </div>
                   <?php if(!empty($freelancer_text)) echo '<label for="user_freelancer">'.$freelancer_text.'</label>';?>
                 </div>
                </div>     
						<p>
							<input id="re-username" type="text" name="user_login" class="input required" placeholder="<?php echo esc_html__('user_example','freeagent');?>"/>
						</p>

						<p>
                       
							<input id="re-email" type="email" name="user_email" class="input required" placeholder="<?php echo esc_html__('mail@example.com','freeagent');?>"/>
						</p>

				        <div class="password">
                            <p class="input-text">
                               
								<span class="form_group">  
            						<input id="s-password" type="password" id="pwd" name="password" class="input required" placeholder="<?php echo esc_html__('Password','freeagent');?>"/>
                                    <span type="button" class="field-icon toggle-password2 jws-icon-eyeslash"></span>
                                </span> 
							</p>
                            <p class="input-text">
                                
							     <span class="form_group"> 
                            	<input id="re-password" placeholder="<?php esc_attr_e( 'Confirm password', 'freeagent' ); ?>" type="password" id="repeat_pwd" name="repeat_password" class="input required" />
						        <span type="button" class="field-icon toggle-password2 jws-icon-eyeslash"></span>
                                </span>
                        	</p>
                        </div>
                        <p class="privacy_policy">
                        <label for="popupAgree"><input name="agree" type="checkbox" value="forever" id="popupAgree" /> 
                        <?php echo esc_html__('Yes, I understand and agree to the','freeagent');?>
                        <a href="<?php echo esc_url($services_link); ?>"><?php echo esc_html__(' Terms of Service','freeagent')?></a> 
                        <?php echo esc_html__('including the','freeagent');?>
                        <a href="<?php echo esc_url($agreement_link); ?>"><?php echo esc_html__(' User Agreement','freeagent')?></a>
                         <?php echo esc_html__('and','freeagent');?>
                        <a href="<?php echo esc_url($policy); ?>"><?php echo esc_html__(' Privacy Policy','freeagent')?></a>
                        </label>
                        </p>
                        
						<?php do_action( 'signup_hidden_fields', 'create-another-site' ); ?>

						<p class="submit jws-button">
                
							<input type="submit" name="wp-submit" class="button elementor-button btn-main" value="<?php echo esc_attr_x( 'Register', 'Login popup form', 'freeagent' ); ?>" />
						</p>
					</form>
					<?php  if($show_register && $registration_enabled) echo '<div class="account">' . esc_html__( 'Already have an account? ', 'freeagent' ) .'<a class="login change-form" href="' .$url_login. '">'. esc_html__( 'Login', 'freeagent' ).'</a></div>'; ?>
                      <div class="meter">
                        <div class="meter-box">
                            <span class="box1"></span>
                            <span class="box2"></span>
                            <span class="box3"></span>
                            <span class="box4"></span>
                              <span class="text-meter"></span>
                        </div>
                      
                      </div>  
                      <div class="jws-password-hint">
                           <?php echo esc_html__('Hint: The password should be at least eight characters long. To make it stronger, use upper and lower case letters, numbers, and symbols like ! " ? $ % ^ & ).','freeagent'); ?>
                     </div>
					<div class="popup-message"></div>
				</div>
			<?php endif; 
            echo ''.$swiper_wrap_end;
            ?>
            </div>
            </div>
            </div>
		</div>
	</div>
    <?php
    }
}     


/**
 * Filter lost password link
 *
 * @param $url
 *
 * @return string
 */
if ( ! function_exists( 'jws_get_lost_password_url' ) ) {
	function jws_get_lost_password_url() {
		$url = add_query_arg( 'action', 'lostpassword', jws_get_login_page_url() );

		return $url;
	}
}

/**
 * Get login page url
 *
 * @return false|string
 */
if ( ! function_exists( 'jws_get_login_page_url' ) ) {
	function jws_get_login_page_url() {

		if ( function_exists('jws_plugin_active') && !jws_plugin_active( 'js_composer/js_composer.php' ) ) {
			return wp_login_url();  
		}

	
		global $wpdb;
		$page = $wpdb->get_col(
		$wpdb->prepare(
					"SELECT p.ID FROM $wpdb->posts AS p INNER JOIN $wpdb->postmeta AS pm ON p.ID = pm.post_id
			WHERE 	pm.meta_key = %s
			AND 	pm.meta_value = %s
			AND		p.post_type = %s
			AND		p.post_status = %s",
					'jws_login_page',
					'1',
					'page',
					'publish'
				)
			);
			if ( ! empty( $page[0] ) ) {
				return get_permalink( $page[0] );
			}
	

		return wp_login_url();

	}
}


/**
 * Filter register link
 *
 * @param $register_url
 *
 * @return string|void
 */
if ( ! function_exists( 'jws_get_register_url' ) ) {
	function jws_get_register_url() {
		$url = add_query_arg( 'action', 'register', jws_get_login_page_url() );

		return $url;
	}
}
if ( ! is_multisite() ) {
	add_filter( 'register_url', 'jws_get_register_url' );
}
if ( ! function_exists( 'jws_register_ajax_callback' ) ) {
	function jws_register_ajax_callback() {

        $demo_mode = (boolean) jws_theme_get_option('demo_mode');
        if($demo_mode) {
           
            $response_data = array(
                'message' => '<p class="jws-dealer-note red">' . esc_html__( 'Sorry! you are restricted to perform this action on demo site.', 'streamvid' ). '</p>'
               
            );
            wp_send_json_error($response_data); 
        }

		// First check the nonce, if it fails the function will break
		$secure = check_ajax_referer( 'ajax_register_nonce', 'register_security', false );

		if ( ! $secure ) {
			$response_data = array(
				'message' => '<p class="jws-dealer-note red">' .$secure. '</p>'
			);

			wp_send_json_error( $response_data );
		}

		parse_str( $_POST['data'], $data );
        $code    = -1;
		foreach ( $data as $k => $v ) {
			$_POST[ $k ] = $v;
		}

		$_POST['is_popup_register'] = 1;

		if ( ! empty( $data['modify_user_notification'] ) ) {
			$_REQUEST['modify_user_notification'] = 1;
		}

		$info = array();
	
		$info['user_login'] = sanitize_user( $data['user_login'] );
		$info['user_email'] = sanitize_email( $data['user_email'] );
		$info['user_pass']  = sanitize_text_field( $data['password'] );
        $info['user_policy']  =  $data['agree'];
        $info['user_role']  =  $data['user_role'];
    
          if(!empty($info['user_login']) && isset( $info['user_login'] )) { 
                if (mb_strlen($info['user_login']) < 3) {
                        $response_data = array(
    					   'message' => esc_html__( 'Your User Name Must Contain At Least 3 Characters!', 'freeagent' )
    				    );
                        wp_send_json_error( $response_data );
                }
        }
    
        if(isset( $info['user_role'] ) && empty($info['user_role'] )){
            $response_data = array(
			   'message' => esc_html__( 'You must choose user _role', 'freeagent' )
		    );
            wp_send_json_error( $response_data );
         }
        if(!empty($info['user_pass']) && isset( $info['user_pass'] )) {
                $password = $info['user_pass'];
               $cpassword = $data['repeat_password'];
                if (mb_strlen($info['user_pass']) < 8) {
                    $response_data = array(
					   'message' => esc_html__( 'Your Password Must Contain At Least 8 Characters!', 'freeagent' )
				    );
                    wp_send_json_error( $response_data );
                }

                elseif(!preg_match("#[A-Z]+#",$password)) {
                    $response_data = array(
					   'message' => esc_html__( 'Your Password Must Contain At Least 1 Capital Letter!', 'freeagent' )
				    );
                    wp_send_json_error( $response_data );
                }

                elseif (strcmp($password, $cpassword) !== 0) {
                    $response_data = array(
					   'message' => esc_html__( 'Passwords must match!', 'freeagent' )
				    );
                    wp_send_json_error( $response_data );
                }

         } 
         if(!isset( $info['user_policy'] )){
            $response_data = array(
			   'message' => esc_html__( 'You must accept our Terms & Conditions.', 'freeagent' )
		    );
            wp_send_json_error( $response_data );
         }
         
		// Register the user
		$user_register = register_new_user( $info['user_login'], $info['user_email'] );

		if ( is_wp_error( $user_register ) ) {
			$error = $user_register->get_error_codes();
      
			if ( in_array( 'empty_username', $error ) ) {
				$response_data = array(
					'message' => '<p class="jws-dealer-note red">' . esc_html__( 'Please enter a username!', 'freeagent' ) . '</p>'
				);
			}elseif ( in_array( 'empty_password', $error ) ) {
				$response_data = array(
					'message' => '<p class="jws-dealer-note red">' . esc_html__( 'Please enter a password!', 'freeagent' ) . '</p>'
				);
			} elseif ( in_array( 'invalid_username', $error ) ) {
				$response_data = array(
					'message' => '<p class="jws-dealer-note red">' . esc_html__( 'The username is invalid. Please try again!', 'freeagent' ) . '</p>'
				);
			} elseif ( in_array( 'username_exists', $error ) ) {
				$response_data = array(
					'message' => '<p class="jws-dealer-note red">' . esc_html__( 'This username is already registered. Please choose another one.', 'freeagent' ) . '</p>'
				);
			} elseif ( in_array( 'empty_email', $error ) ) {
				$response_data = array(
					'message' => '<p class="jws-dealer-note red">' . esc_html__( 'Please type your e-mail address!', 'freeagent' ) . '</p>'
				);
			} elseif ( in_array( 'invalid_email', $error ) ) {
				$response_data = array(
					'message' => '<p class="jws-dealer-note red">' . esc_html__( 'The email address isn\'t correct. Please try again!', 'freeagent' ) . '</p>'
				);
			} elseif ( in_array( 'email_exists', $error ) ) {
				$response_data = array(
					'message' => '<p class="jws-dealer-note red">' . esc_html__( 'This email is already registered. Please choose another one!', 'freeagent' ) . '</p>'
				);
			}

			wp_send_json_error( $response_data );
		} else {
    		      
			    $code  = 1; 
                global $jws_option;
                $user = get_user_by('login', $info['user_login']);
          
                    $user_id = $user->ID;
                    if( $user ) {
                        wp_set_current_user( $user_id, $user->user_login );
                        wp_set_auth_cookie( $user_id );

                        do_action('wp_login', $user->user_login, $user);
                    }
            		if(isset($jws_option['login_form_redirect']) && !empty($jws_option['login_form_redirect'])) {
                        $login_redirect = get_page_link($jws_option['login_form_redirect']);
                    }
                    else {
            		    $current_page_id = get_queried_object_id();	 
            			$login_redirect = get_permalink( $current_page_id );
            		}
                    
                    if(isset( $info['user_role'] )){ 
                        jws_create_posttype_after_register($info['user_role'],$user,$user_id);  
                    }
                    
                    
                    
                    $response_data = array(
    				    'code'    => $code,
        				'message' => '<p class="jws-dealer-note green">' . esc_html__( 'Login successful, redirecting...', 'freeagent' ) . '</p>',
                        'redirect' => $login_redirect
    				); 
       
				    wp_send_json_success( $response_data );
		
		}
  
	}
}


if ( get_option( 'users_can_register' ) ) {
	add_action( 'wp_ajax_nopriv_jws_register_ajax', 'jws_register_ajax_callback' );
    add_action( 'wp_ajax_jws_register_ajax', 'jws_login_ajax_callback' );
}

if ( ! function_exists( 'jws_login_ajax_callback' ) ) {
	function jws_login_ajax_callback() {
		//ob_start();
     
		if ( empty( $_REQUEST['data'] ) ) {
			$response_data = array(
				'code'    => - 1,
				'message' => '<p class="jws-dealer-note red">' . esc_html__( 'Something wrong. Please try again.', 'freeagent' ) . '</p>'
			);
		} else {

			parse_str( $_REQUEST['data'], $login_data );

			foreach ( $login_data as $k => $v ) {
				$_POST[ $k ] = $v;
			}
   
			$creds = array();
            $creds['user_login'] = $login_data['log'];
            $creds['user_password'] = $login_data['pwd'];
            $creds['remember'] = $login_data['rememberme'];
            
            $secure_cookie = is_ssl() ? true : false;


            $user = wp_signon($creds, $secure_cookie);
			$user_verify = wp_signon( array(), is_ssl() );
			$code    = 1;
			$message = '';
            
            global $jws_option;    
			if($jws_option['select-page-login-register-author']) {
                $login_redirect   = get_author_posts_url($user->ID); 
			}
            elseif(isset($jws_option['login_form_redirect']) && !empty($jws_option['login_form_redirect'])) {
                $login_redirect = get_page_link($jws_option['login_form_redirect']);
                if(in_array('professional', $user->roles)) $login_redirect = get_page_link($jws_option['professional_form_page']);
                else if(in_array('customer', $user->roles)) $login_redirect = get_page_link($jws_option['client_form_page']);
            }
            else {
                $current_page_id = get_queried_object_id();	 
				$login_redirect = get_permalink( $current_page_id );
			}

			if ( is_wp_error( $user_verify ) ) {
				if ( ! empty( $user_verify->errors ) ) {
					$errors = $user_verify->errors;

					if ( ! empty( $errors['invalid_username'] ) ) {
						$message = $errors['invalid_username'];
					}elseif(! empty( $errors['incorrect_password'] )) {
					   $message = $errors['incorrect_password'];
					}elseif ( is_array( $errors['invalid_email']) ) {
        				$message =  $errors['invalid_email'];
        			}else {
						$message = $user_verify;
					}
				} else {
					$message = esc_html__( 'Something wrong. Please try again.', 'freeagent' );
				}
				$code = - 1;
			} else {
				$message = '<p class="jws-dealer-note green">' . esc_html__( 'Login successful, redirecting...', 'freeagent' ) . '</p>';
			}

			$response_data = array(
				'code'    => $code,
				'message' => $message,
                'redirect' => $login_redirect
			);

		}
		wp_send_json_success( $response_data );

	}
}
add_action( 'wp_ajax_nopriv_jws_login_ajax', 'jws_login_ajax_callback' );
add_action( 'wp_ajax_jws_login_ajax', 'jws_login_ajax_callback' );


remove_action( 'register_new_user', 'wp_send_new_user_notifications' );


 $user_id = wp_get_current_user();   
 update_user_meta($user_id->ID, 'is_activated', 1); 


function new_modify_user_table( $column ) {
    $column['activated'] = 'Activated';
    return $column;
}
add_filter( 'manage_users_columns', 'new_modify_user_table' );

function new_modify_user_table_row( $val, $column_name, $user_id ) {
    switch ($column_name) {
        case 'activated' :
            return get_user_meta($user_id, 'is_activated', true); 
        default:
    }
    return $val;
}
add_filter( 'manage_users_custom_column', 'new_modify_user_table_row', 10, 3 );

/*
* Function ajax filter
*/
if (!function_exists('jws_ajax_product_filter')) {
    function jws_ajax_product_filter()
    {
        $inc_product_ids = $ex_product_ids = $asset_type = $filter_categories = $posts_per_page = $orderby = $order = null;
        if (isset($_POST['ex_product_ids'])) {
            $ex_product_ids = $_POST['ex_product_ids'];
        }
        if (isset($_POST['inc_product_ids'])) {
            $inc_product_ids = $_POST['inc_product_ids'];
        }
        if (isset($_POST['asset_type'])) {
            $asset_type = sanitize_text_field($_POST['asset_type']);
        }
        if (isset($_POST['filter_categories'])) {
            $filter_categories = sanitize_text_field($_POST['filter_categories']);
        }
        if (isset($_POST['posts_per_page'])) {
            $posts_per_page = intval($_POST['posts_per_page']);
        }
        if (isset($_POST['orderby'])) {
            $orderby = sanitize_text_field($_POST['orderby']);
        }
        if (isset($_POST['order'])) {
            $order = strtoupper(sanitize_text_field($_POST['order']));
        }

        if (is_front_page()) {
            $paged = (get_query_var('page')) ? get_query_var('page') : 1;
        } else {
            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
        }
        
        if(isset($_POST['paged'] ) && $_POST['paged'] > 1 ) $paged = $_POST['paged'];
        
        if($_POST['layout'] == 'carousel'){
            $grid_class = 'product-item product swiper-slide '.$_POST['display'].'';
        }else {
            $class    = 'grid-layout row';
            $grid_class = 'product-item product '.$_POST['display'].' col-xl-' . $_POST['columns'] . ' col-lg-' . $_POST['columns_tablet'] . ' col-' . $_POST['columns_mobile'] .'';
        }
        
        
        
        
         if($_POST['layout'] == 'carousel') {
            
                
        $_POST['show_nav'] ? $_POST['show_nav'] : $_POST['show_nav'] = 'false';
        $_POST['show_nav_tablet'] ? $_POST['show_nav_tablet'] : $_POST['show_nav_tablet'] = 'false';
        $_POST['show_nav_mobile'] ? $_POST['show_nav_mobile'] : $_POST['show_nav_mobile'] = 'false';
        
        $_POST['show_pag'] ? $_POST['show_pag'] : $_POST['show_pag'] = 'false';
        $_POST['show_pag_tablet'] ? $_POST['show_pag_tablet'] : $_POST['show_pag_tablet'] = 'false';
        $_POST['show_pag_mobile'] ? $_POST['show_pag_mobile'] : $_POST['show_pag_mobile'] = 'false';
        
        $_POST['autoplay'] ? $_POST['autoplay'] : $_POST['autoplay'] = 'false';
        $_POST['autoplay_tablet'] ? $_POST['autoplay_tablet'] : $_POST['autoplay_tablet'] = 'false';
        $_POST['autoplay_mobile'] ? $_POST['autoplay_mobile'] : $_POST['autoplay_mobile'] = 'false';  
         $infinite = ($_POST['infinite']) ? 'true' : 'false';
        if($_POST['enble_muntirow'] == 'yes') {
           $_POST['number_row'] ? $_POST['number_row'] : $_POST['number_row'] = 1;
           $_POST['number_row_tablet'] ? $_POST['number_row_tablet'] : $_POST['number_row_tablet'] = 1;
           $_POST['number_row_mobile'] ? $_POST['number_row_mobile'] : $_POST['number_mobile'] = 1;
           
           $_POST['number_col_row'] ? $_POST['number_col_row'] : $_POST['number_col_row'] = 1;
           $_POST['number_col_row_tablet'] ? $_POST['number_col_row_tablet'] : $_POST['number_col_row_tablet'] = 1;
           $_POST['number_col_row_mobile'] ? $_POST['number_col_row_mobile'] : $_POST['number_col_row_mobile'] = 1;
    
        
       
            
            $data_slick = 'data-slick=\'{"rows":"'.$_POST['number_row'].'","slidesPerRow":"'.$_POST['number_col_row'].'","slidesToShow":1 ,"slidesToScroll":1,"autoplay": '.$_POST['autoplay'].',"arrows": '.$_POST['show_nav'].', "dots":'.$_POST['show_pag'].',
            "speed": '.$_POST['speed'].', "responsive":[{"breakpoint": 1024,"settings":{"rows":"'.$_POST['number_row_tablet'].'","slidesPerRow":"'.$_POST['number_col_row_tablet'].'"}},
            {"breakpoint": 768,"settings":{"rows":"'.$_POST['number_row_mobile'].'","slidesPerRow":"'.$_POST['number_col_row_mobile'] .'"}}]}\''; 
              }else{
                   $data_slick = 'data-slick=\'{"slidesToShow":'.$_POST['slides_to_show']['size'].' ,"slidesToScroll": '.$_POST['scroll'].',"autoplay": '.$_POST['autoplay'].',"arrows": '.$_POST['show_nav'].', "dots":'.$_POST['show_pag'].',
                    "speed": '.$_POST['speed'].', "infinite":'.$infinite.' , "responsive":[{"breakpoint": 1024,"settings":{"slidesToShow": '.$_POST['slides_to_show_tablet']['size'].',"slidesToScroll": '.$_POST['scroll'].'}},
                    {"breakpoint": 768,"settings":{"slidesToShow": '.$_POST['slides_to_show_mobile']['size'].',"slidesToScroll": '.$_POST['scroll'].'}}]}\''; 
              }   
          }else {
                $data_slick = '';
          }
        
        
        $wc_attr = array(
            'post_type' => 'product',
            'product_cat' =>  $filter_categories,
            'posts_per_page' => $posts_per_page,
            'paged' => $paged,
            'orderby' => $orderby,
            'order' => $order,  
        );
        
        
        if(!empty($ex_product_ids)) {
           $wc_attr['post__not_in'] = $ex_product_ids;
        }
        
  
        
        if(!empty($inc_product_ids)) {
           $wc_attr['post__in'] = $inc_product_ids;
        }

        if ($asset_type) {
            switch ($asset_type) {
                case 'featured':
                    $meta_query[] = array(
                        array(
                            'taxonomy' => 'product_visibility',
                            'field'    => 'name',
                            'terms'    => 'featured',
                            'operator' => 'IN'
                        ),
                    );
                    $wc_attr['tax_query'] = $meta_query;
                    break;
                case 'onsale':
                    $product_ids_on_sale = wc_get_product_ids_on_sale();
                    $wc_attr['post__in'] = $product_ids_on_sale;
                    break;
                case 'best-selling':
                    $wc_attr['meta_key'] = 'total_sales';
                    $wc_attr['orderby']  = 'meta_value_num';
                    break;
                case 'latest':
                    $wc_attr['orderby'] = 'date';
                    break;
                case 'toprate':
                    $wc_attr['orderby'] = 'meta_value_num';
                    $wc_attr['meta_key'] = '_wc_average_rating';
                    $wc_attr['order'] = 'DESC';
                    break;
                case 'deal':
                    $product_ids_on_sale = wc_get_product_ids_on_sale();
                    $wc_attr['post__in'] = $product_ids_on_sale;
                    $wc_attr['meta_query'] = array(
                        'relation' => 'AND',
                        array(
                            'key' => '_sale_price_dates_to',
                            'value' => time(),
                            'compare' => '>'
                        )
                    );
                    break;
                default:
                    break;
            }
        }


        if (isset($_POST['product_attribute']) && isset($_POST['attribute_value'])) {
            if (is_array($_POST['product_attribute'])) {
                foreach ($_POST['product_attribute'] as $key => $value) {
                    $tax_query[] = array(
                        'taxonomy' => $value,
                        'terms'    => array_map('sanitize_title', (array)$_POST['attribute_value'][$key]),
                        'field'    => 'slug',
                        'operator' => 'IN'
                    );
                }
            } else {
                $tax_query[] = array(
                    'taxonomy' => sanitize_title($_POST['product_attribute']),
                    'terms'    => array_map('sanitize_title', (array)$_POST['attribute_value']),
                    'field'    => 'slug',
                    'operator' => 'IN'
                );
            }
        }

        if (isset($_POST['product_tag'])) {
            $wc_attr['product_tag'] = sanitize_title($_POST['product_tag']);
        }

        if (isset($_POST['price_filter']) && $_POST['price_filter'] > 0) {
            $min = (intval($_POST['price_filter']) - 1)*intval($_POST['price_filter_range']);
            $max = intval($_POST['price_filter'])*intval($_POST['price_filter_range']);
            $meta_query[] = array(
                'key'     => '_price',
                'value'   => array($min, $max),
                'compare' => 'BETWEEN',
                'type'    => 'NUMERIC'
            );
        }

        if (isset($_POST['s']) && $_POST['s'] != '') {
            $wc_attr['s'] = esc_attr($_POST['s']);
        }

        $product_query = new WP_Query($wc_attr);
        
        ob_start(); ?>
        
        <?php if(isset($_POST['paged'] ) && $_POST['paged'] > 1 ) {
             while ($product_query->have_posts()) {
                 $product_query->the_post();
                 echo '<div class="'.esc_attr($grid_class).'">';    
                 include( JWS_ABS_PATH_WC.'/archive-layout/content-'.$_POST['display'].'.php'  );
                 echo '</div>';
            } 
            
        } else { ?>
            
            <div class="products">
                <?php 
                    if($_POST['layout'] == 'carousel') echo '<div class="carousel" '.$data_slick.'>';  
                            while ($product_query->have_posts()) {
                                 $product_query->the_post();
                                 echo '<div class="'.esc_attr($grid_class).'">';    
                                 wc_get_template_part( 'archive-layout/content', $_POST['display'] );
                                 echo '</div>';
                            }
                    if($_POST['layout'] == 'carousel') echo '</div>'; 
                ?>
            </div>
            
        <?php } ?>
        <?php
        wp_reset_postdata();
        $output = ob_get_clean();
        
        $output =  array(
    	    		'items' => $output,
    	    		'status' => ( $product_query->max_num_pages > $paged ) ? 'have-posts' : 'no-more-posts'
    	 );

        
        
      
      
       echo json_encode( $output );

		die();
    }

    add_action('wp_ajax_jws_ajax_product_filter', 'jws_ajax_product_filter');
    add_action('wp_ajax_nopriv_jws_ajax_product_filter', 'jws_ajax_product_filter');
}

/*
* Function ajax filter
*/
if (!function_exists('jws_ajax_category_tabs_filter')) {
    function jws_ajax_category_tabs_filter()
    {

     if(!empty($_POST['filter_categories'])) {
      
        if($_POST['filter_categories'] == 'all'){
             if($_POST['filter_categories_for_asset']){
                foreach ($_POST['filter_categories_for_asset'] as $product_cat_slug) {
                    $product_cat = get_term_by('slug', $product_cat_slug, 'product_cat');
  
                    ?>
                    
                    <div class="<?php echo esc_attr($_POST['columns']); ?>">
                        <a href="<?php echo get_term_link( $product_cat->term_id, 'product_cat' );  ?>">
                            <?php echo wp_get_attachment_image( get_term_meta( $product_cat->term_id, 'thumbnail_id', 1 ), 'full' ); ?>
                            <h4><?php echo esc_html($product_cat->name); ?></h4>
                        </a>
                    </div>
                    
                    <?php
   
                } 
            }     
        }else{
            $term = get_queried_object();
        
            $category = get_term_by( 'slug', $_POST['filter_categories'], 'product_cat' );
        
            $id = $category->term_id;
            
            $children = get_categories(
              array(
                'taxonomy' => 'product_cat',
                'parent' =>$id
              )
            );
        
            if ( $children ) { 
                foreach( $children as $product_cat )
                {
                    ?>
                    
                    <div class="<?php echo esc_attr($_POST['columns']); ?>">
                        <a href="<?php echo get_term_link( $product_cat->term_id, 'product_cat' );  ?>">
                            <?php echo wp_get_attachment_image( get_term_meta( $product_cat->term_id, 'thumbnail_id', 1 ), 'full' ); ?>
                            <h4><?php echo esc_html($product_cat->name); ?></h4>
                        </a>
                    </div>
                    
                    <?php
                }
            }  
        }
wp_die();
    }  
       
    }

    add_action('wp_ajax_jws_ajax_category_tabs_filter', 'jws_ajax_category_tabs_filter');
    add_action('wp_ajax_nopriv_jws_ajax_category_tabs_filter', 'jws_ajax_category_tabs_filter');
}



/*
* Function ajax tab
*/
if (!function_exists('jws_ajax_project_tab')) {
    function jws_ajax_project_tab()
    {
               $settings = array('project_ids','project_layouts','tab_categories','project_attribute','posts_per_page','orderby','order','attribute_value','project_tag','readmore_text','excerpt_length','excerpt_more','project_image_size');
        if (isset($_POST['project_ids'])) {
            $settings['project_ids'] = sanitize_text_field(wp_unslash($_POST['project_ids']));
        }
        if (isset($_POST['project_layouts'])) {
            $settings['project_layouts'] = sanitize_text_field($_POST['project_layouts']);
        }
        if (isset($_POST['tab_categories'])) {
            $settings['tab_categories'] = sanitize_text_field($_POST['tab_categories']);
        }
        if (isset($_POST['posts_per_page'])) {
            $settings['posts_per_page'] = intval($_POST['posts_per_page']);
        }
        if (isset($_POST['orderby'])) {
            $settings['orderby'] = sanitize_text_field($_POST['orderby']);
        }
        if (isset($_POST['order'])) {
            
            $settings['order'] = strtoupper(sanitize_text_field($_POST['order']));
        }
        if (isset($_POST['readmore_text'])) {
            
            $settings['readmore_text'] = strtoupper(sanitize_text_field($_POST['readmore_text']));
        }
        if (isset($_POST['excerpt_length'])) {
            
            $settings['excerpt_length'] = strtoupper(sanitize_text_field($_POST['excerpt_length']));
        }
        if (isset($_POST['excerpt_more'])) {
            
            $settings['excerpt_more'] = strtoupper(sanitize_text_field($_POST['excerpt_more']));
        }
         if (isset($_POST['project_image_size'])) {
            
            $settings['project_image_size'] = strtoupper(sanitize_text_field($_POST['project_image_size']));
        }
        if (is_front_page()) {
            $paged = (get_query_var('page')) ? get_query_var('page') : 1;
        } else {
            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
        }
   

             $class_row = 'slider-layout slider row';   
             $grid_class = 'jws_project_item  ';
        
        
        $class_row .= ' jws_project_'.$_POST['project_layouts'].'';
       
        
        $project_attr = array(
            'post_type' => 'projects',
            'posts_per_page' =>  $settings['posts_per_page'],
            'paged' =>  $paged,
            'orderby' =>  $settings['orderby'],
            'order' =>  $settings['order'],
            'post__not_in'=>  $settings['project_ids'],
        );
        $project_attr['tax_query'][] = [
						'taxonomy' => 'projects_cat',
						'field'    => 'slug',
						'terms'    =>  $settings['tab_categories'],
                        'operator' => 'IN'
					];

     


        if (isset($settings['project_tag'])) {
            $project_attr['projects_tag'] = sanitize_title($settings['project_tag']);
        }



        if (isset($_POST['s']) && $_POST['s'] != '') {
            $project_attr['s'] = esc_attr($_POST['s']);
        }

        $project_query = new WP_Query($project_attr);
        ob_start(); ?>
        <div>
        <div class="projects project_content <?php echo esc_attr($class_row); ?>">
            
            <?php while ($project_query->have_posts()) {
            $project_query->the_post();
             $class_slug = '';
                $format = has_post_format() ? get_post_format() : 'no_format'; 
                echo '<article class="'.$grid_class.' '.$format.$class_slug.'">';
                       include JWS_ABS_PATH . '/inc/elementor_widget/widgets/project_tabs_slider/layout/'.$settings['project_layouts'].'.php';
                       
                echo '</article>';
         
        } ?>
        </div>
        </div>
        <?php
        $output = ob_get_contents();
        ob_end_clean();
        wp_reset_postdata();
        echo ent2ncr($output);
    }

    add_action('wp_ajax_jws_ajax_project_tab', 'jws_ajax_project_tab');
    add_action('wp_ajax_nopriv_jws_ajax_project_tab', 'jws_ajax_project_tab');
}