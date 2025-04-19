<?php
use Automattic\WooCommerce\Utilities\OrderUtil;
$current_user_id = get_current_user_id();
if($current_user_id){
    ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="<?= get_template_directory_uri() . '/assets/bootstrap/css/bootstrap.min.css'; ?>">
    <script src="<?= get_template_directory_uri() . '/assets/bootstrap/js/bootstrap.bundle.min.js'; ?>"></script>
    <?php
    global $user,$jws_option;
    $user = get_userdata( $current_user_id );
    $user_meta = get_user_meta( $current_user_id );

    $freelancer_id  = Jws_Custom_User::get_freelaner_id( $current_user_id );
    $credits = get_user_meta( $current_user_id, 'freelancer_credits', true ) ? get_user_meta( $current_user_id, 'freelancer_credits', true ) : 0;
    if(empty($freelancer_id)){
        $args = array(
            'post_type'      => 'freelancers',
            'posts_per_page' => 1,
            'author'         => $current_user_id,
            'fields'         => 'ids',
        );
        
        $freelancer_query = new WP_Query($args);
        
        if (!empty($freelancer_query->posts)) {
            $freelancer_id = $freelancer_query->posts[0];
        } else {
            $freelancer_id = null;
        }
    }
    $profile_meta = get_post_meta( $freelancer_id );

    $user_email = $user->user_email;
    $phone = get_post_meta( $freelancer_id, 'phone', true );
    $city = get_post_meta($freelancer_id, $jws_option['professional_city_field'], true);
    $country = get_post_meta($freelancer_id, $jws_option['professional_country_field'], true);

    if ( ! function_exists( 'wps_sfw_cancel_url' ) ) {
        /**
         * This function is used to cancel url.
         *
         * @name wps_sfw_cancel_url.
         * @param int    $wps_subscription_id wps_subscription_id.
         * @param String $wps_status wps_status.
         * @since 1.0.0
         */
        function wps_sfw_cancel_url( $wps_subscription_id, $wps_status ) {
    
            $wps_link = add_query_arg(
                array(
                    'wps_subscription_id'        => $wps_subscription_id,
                    'wps_subscription_status' => $wps_status,
                )
            );
            $wps_link = wp_nonce_url( $wps_link, $wps_subscription_id . $wps_status );
    
            return $wps_link;
        }
    }
    ?>

    <div class="dashboard-container">
        <aside class="sidebar bg-nsblue">
            <div class="profile-section">
                <a href="<?= get_permalink( $freelancer_id )?>">
                    <?php jws_image_advanced($freelancer_id, '96x96')?>
                </a>
                <h3 class="user-name">
                    <a href="<?= get_permalink( $freelancer_id )?>">                    
                        <?php echo get_the_title($freelancer_id)?>
                    </a>
                </h3>
            </div>
            <nav class="sidebar-menu">
                <ul>
                    <li class="active"><a href="#" data-section="dashboard">Dashboard</a></li>
                    <li><a href="#" data-section="profile">Profile</a></li>
                    <li><a href="#" data-section="requests">Requests</a></li>
                    <li><a href="#" data-section="support">Support</a></li>
                    <li><a href="#" data-section="reviews">Reviews</a></li>
                    <li><a href="#" data-section="subscription">Subscription</a></li>
                    <li><a href="#" data-section="orders">Order History</a></li>
                    <li><a href="#" data-section="password">Change Password</a></li>
                    <li><a href="#" data-section="deleteAccount">Delete Account</a></li>
                    <li><a href="<?= wp_logout_url(get_permalink($freelancer_id)) ?>">Logout</a></li>
                </ul>
            </nav>

        </aside>
        <div id="dashboard" class="dashboard-main dashboard-section p-4 active">
            <div class="welcome-section">
                <p class="greeting">Hello,
                    <?php echo get_the_title($freelancer_id)?>
                </p>
                <div class="welcome-head">
                    <h2>Welcome To Your Profile</h2>
                    <p>Credits left: <?= $credits; ?></p>
                </div>
            </div>

            <div class="personal-details bg-nsblue">
                <h3 class="section-title">Personal Details</h3>
                <div class="personal-details-list">
                    <ul>
                        <li>Name:</li>
                        <li>Email:</li>
                        <li>Phone:</li>
                        <li>Address:</li>
                    </ul>
                    <ul>
                        <li>
                            <?php echo get_the_title($freelancer_id)?>
                        </li>
                        <li>
                            <?php echo $user_email; ?>
                        </li>
                        <li>
                            <?php echo $phone; ?>
                        </li>
                        <li>
                            <?php echo "$city, $country"?>
                        </li>
                    </ul>

                </div>
            </div>
        </div>
        <div id="profile" class="dashboard-section container p-4 shadow-sm rounded bg-nsblue">
            <?php
            $form_id = $jws_option['professional_form_id'];
            $formApi = fluentFormApi('forms')->form($form_id);

            if ($formApi && $formApi->renderable()) {            
                $fields = $formApi->fields();
                $fields = $fields['fields'];
                ?>
                    <h2>Edit Profile</h2>                    
                    <form id="profile-form" method="POST" class="needs-validation" novalidate action="" enctype="multipart/form-data">
                        <?php
                        $fields_map = [
                            'professional_title' => 'select',
                            'professional_skills' => 'textarea',
                            'professional_country_field' => 'select',
                            'professional_city_field' => 'select',
                            'professional_service_type_field' => 'checkbox',
                            'professional_gender_field' => 'radio',
                            'professional_fee_field' => 'number',
                            'professional_business_name_field' => 'text',
                            'professional_website_field' => 'text',
                            'professional_phone_field' => 'phone',
                            'professional_brief_description_field' => 'content',
                            'professional_ft_image_field' => 'post_thumb',
                            'professional_portfolio_field' => 'portfolio_images',
                            // 'professional_reference_field' => 'text',
                        ];

                        foreach ($fields_map as $meta_key => $field_type) {
                            $label = get_label_from_fieldId_ff($form_id, $jws_option[$meta_key], true);
                            if($meta_key == 'professional_skills'){                        
                                $label = 'Services';
                                $value = get_post_meta($freelancer_id, $meta_key, true);
                                $field_id = $meta_key;
                            } else if($meta_key == 'professional_title'){
                                $value = get_post_meta($freelancer_id, 'freelancers_position', true);
                                $field_id = $jws_option[$meta_key];
                            }
                            else{
                                $value = get_post_meta($freelancer_id, $jws_option[$meta_key], true);
                                $field_id = $jws_option[$meta_key];
                            }
                            $options_html = '';

                            foreach ($fields as $field) {
                                if (isset($field['attributes']) && $field['attributes']['name'] === $field_id && $field['settings'] && $field['settings']['advanced_options']) {
                                    $options = $field['settings']['advanced_options'];
                                    foreach ($options as $option) {
                                        switch ($field_type) {
                                            case 'select':
                                                $selected = ($value == $option['value']) ? 'selected' : '';
                                                $options_html .= '<option value="'.$option['value'].'" '.$selected.'>'.$option['value'].'</option>';
                                                break;

                                            case 'checkbox':
                                                $checked = (is_array($value) && in_array($option['value'], $value)) ? 'checked' : '';
                                                $options_html .= '<div class="form-check">
                                                                    <input type="checkbox" id="'.$option['value'].'" name="'.$field_id.'[]" value="'.$option['value'].'" class="form-check-input" '.$checked.'>
                                                                    <label class="form-check-label" for="'.$option['value'].'">'.$option['value'].'</label>
                                                                </div>';
                                                break;

                                            case 'radio':
                                                $checked = ($value == $option['value']) ? 'checked' : '';
                                                $options_html .= '<div class="form-check">
                                                                    <input type="radio" id="'.$option['value'].'" name="'.$field_id.'" value="'.$option['value'].'" class="form-check-input" '.$checked.'>
                                                                    <label class="form-check-label" for="'.$option['value'].'">'.$option['value'].'</label>
                                                                </div>';
                                                break;                                                                        
                                        }
                                    }
                                    break;
                                }
                            }

                            if ($field_type == 'select' && $options_html) {
                                echo '<div class="form-group mb-3 d-flex align-items-center gap-4">
                                        <label for="'.$field_id.'" class="form-label mb-0">'.$label.'</label>
                                        <select id="'.$field_id.'" name="'.$field_id.'" class="form-select select2 w-auto">'.$options_html.'</select>
                                      </div>';
                            } elseif ($field_type == 'checkbox' || $field_type == 'radio') {
                                echo '<div class="mb-3 form-group">
                                        <label class="form-label">'.$label.'</label>
                                        <div class="form-check p-0">'.$options_html.'</div>
                                      </div>';
                            } elseif ($field_type == 'textarea') {
                                if ($meta_key == 'professional_skills') {
                                    echo '<div class="mb-3 form-group">
                                            <label for="'.$field_id.'" class="form-label">'.$label.'</label>
                                            <textarea id="'.$field_id.'" name="'.$field_id.'" class="form-control" rows="3">'.esc_textarea(implode(', ', (array) $value)).'</textarea>
                                            <small class="form-text text-muted">Enter skills separated by commas (e.g., Film Actor, TV Actor, Writer, etc.). Only letters and underscores (_) are allowed.</small>
                                          </div>';
                                } else {
                                    echo '<div class="mb-3 form-group">
                                            <label for="'.$field_id.'" class="form-label">'.$label.'</label>
                                            <textarea id="'.$field_id.'" name="'.$field_id.'" class="form-control" rows="3">'.$value.'</textarea>                                    
                                          </div>';
                                }
                            } elseif ($field_type == 'content') {
                                $value = get_the_excerpt($freelancer_id);
                                echo '<div class="mb-3 form-group">
                                        <label for="'.$field_id.'" class="form-label">'.$label.'</label>
                                        <textarea id="'.$field_id.'" name="'.$field_id.'" class="form-control" rows="3">'.$value.'</textarea>                                    
                                      </div>';
                            } elseif ($field_type == 'post_thumb') {
                                $image_url = wp_get_attachment_url(get_post_thumbnail_id($freelancer_id));
                                echo '<div class="mb-3 form-group">
                                        <label for="'.$field_id.'" class="form-label">'.$label.'</label>
                                        <div class="image-upload-wrapper d-flex flex-column align-items-start">';
                                
                                if ($image_url) {
                                    echo '<div class="uploaded-image mb-2 d-flex flex-column">
                                            <img src="'.$image_url.'" alt="Uploaded Image" class="img-thumbnail">
                                            <button type="button" class="btn btn-danger btn-sm mt-2 remove-image">Remove</button>
                                          </div>';
                                }
                            
                                echo '<input type="hidden" id="'.$field_id.'" name="'.$field_id.'" value="'.esc_attr($image_url).'" />
                                    <input class="d-none ft-img-upload" type="file" name="ft-img-upload" value="'.esc_attr($image_url).'" />  
                                    <button type="button" class="btn btn-primary btn-sm upload-image">Upload Image</button>
                                      </div>
                                      <small class="form-text text-muted">Allowed formats: JPG, PNG, GIF. Max size: 2MB.</small>
                                      </div>';
                            } elseif ($field_type == 'portfolio_images') {
                                if (is_array($value)) {
                                    echo '<div class="mb-3 form-group">
                                            <label for="'.$field_id.'" class="form-label">'.$label.'</label>
                                            <div class="portfolio-upload-wrapper d-flex flex-column align-items-start">';
                                    
                                    echo '<div class="portfolio-images d-flex flex-wrap gap-2">';  
                                    if (!empty($value) && is_array($value)) {
                                        foreach ($value as $image_url) {
                                            echo '<div class="portfolio-image position-relative d-flex flex-column">
                                                    <img src="'.esc_url($image_url).'" alt="Portfolio Image" class="img-thumbnail">
                                                    <button type="button" class="btn btn-danger btn-sm mt-2 remove-portfolio-image">Remove</button>
                                                    <input type="hidden" name="'.$field_id.'[]" value="'.esc_attr($image_url).'">
                                                  </div>';
                                        }
                                    }
                                    echo '</div>'; // End portfolio-images
                            
                                    echo '<input type="file" class="portfolio-upload-input d-none" multiple accept="image/*">
                                          <div class="mt-2">
                                            <button type="button" class="btn btn-primary btn-sm upload-portfolio-images">Upload Images</button>
                                          </div>
                                          </div>
                                          <small class="form-text text-muted">Allowed formats: JPG, PNG, GIF. Max 20 images. Max size: 2MB per image.</small>
                                          </div>';
                                }
                            }
                            else if($field_type == 'text'){
                                if($meta_key == 'professional_website_field'){
                                    echo '<div class="mb-3 form-group">
                                            <label for="'.$field_id.'" class="form-label">Website URL</label>
                                            <input type="text" id="'.$field_id.'" name="'.$field_id.'" class="form-control" value="'.esc_attr($value).'">
                                            <small class="form-text text-muted">https://www.example.com OR https://example.com</small>
                                          </div>';
                                } else {
                                    echo '<div class="mb-3 form-group">
                                            <label for="'.$field_id.'" class="form-label">'.$label.'</label>
                                            <input type="text" id="'.$field_id.'" name="'.$field_id.'" class="form-control" value="'.esc_attr($value).'">
                                          </div>';
                                }
                            } else if($field_type == 'number'){
                                echo '<div class="mb-3 form-group">
                                        <label for="'.$field_id.'" class="form-label">'.$label.'</label>
                                        <input type="number" id="'.$field_id.'" name="'.$field_id.'" class="form-control" value="'.esc_attr($value).'" min="0" step="any">
                                      </div>';
                            } else if($field_type == 'phone'){
                                echo '<div class="mb-3 form-group">
                                        <label for="'.$field_id.'" class="form-label">'.$label.'</label>
                                        <input type="tel" id="'.$field_id.'" name="'.$field_id.'" class="form-control" value="'.esc_attr($value).'">
                                      </div>';
                            }
                        }
                        ?>

                        <script>
                            document.addEventListener("DOMContentLoaded", function() {
                                document.getElementById("professional_skills").addEventListener("input", function() {
                                    this.value = this.value.replace(/[^a-zA-Z_,\s]/g, ''); 
                                });
                                const phoneField = document.getElementById("professional_phone_field");
                                phoneField.addEventListener("input", function() {
                                    this.value = this.value.replace(/[^0-9+]/g, ''); // Allow only numbers and +
                                });

                                document.getElementById("profile-form").addEventListener("submit", function(event) {
                                    const phonePattern = /^\+?[0-9]{7,15}$/;
                                    if (!phonePattern.test(phoneField.value)) {
                                        alert("Please enter a valid phone number (7-15 digits, optional + at start).");
                                        event.preventDefault();
                                    }
                                });                                
                            });
                        </script>
                        <?php wp_nonce_field('profile_form_action', 'profile_form_nonce'); ?>
                        <?php wp_nonce_field('featured_image_upload_nonce', 'featured_image_upload_nonce'); ?>
                        <?php wp_nonce_field('portfolio_upload_nonce', 'portfolio_upload_nonce'); ?>
                        <!-- Submit Button -->
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Save Profile</button>
                        </div>
                    </form>
                    <script type="text/javascript">
                        jQuery(document).ready(($)=>{
                            $(document).on("click", ".remove-image", function () {                                
                                var wrapper = $(this).closest(".uploaded-image");
                                var input = wrapper.siblings(".ft-img-upload");
                                input.val(""); 
                                wrapper.remove();                            
                                $(document).trigger("imageRemoved", [input]);
                            });

                            $(document).on("click", ".upload-image", function () {
                                $(this).siblings(".ft-img-upload").click();
                            });

                            $(document).on("change", ".ft-img-upload", function (event) {
                                var input = this;
                                var file = input.files[0]; // Single image for featured image
                                var formData = new FormData();
                                var previewWrapper = $(this).siblings(".uploaded-image");
                                var nonce = $("#featured_image_upload_nonce").val();
                                var ft_image_input = $("[name='<?= $jws_option['professional_ft_image_field']; ?>']");                                
                                
                                if (!file) {
                                    alert("Please select an image.");
                                    return;
                                }

                                formData.append("action", "handle_featured_image_upload");
                                formData.append("nonce", nonce);
                                formData.append("featured_image", file);

                                // AJAX request to upload featured image
                                $.ajax({
                                    url: "<?= admin_url('admin-ajax.php') ?>", 
                                    type: "POST",
                                    data: formData,
                                    processData: false,
                                    contentType: false,
                                    success: function (response) {
                                        if (response.success) {
                                            ft_image_input.val(response.data.image_url)
                                            previewWrapper.html(""); // Clear previous image
                                            var imageWrapper = $('<div class="position-relative"></div>').appendTo(previewWrapper);
                                            $('<img>', {
                                                src: response.data.image_url,
                                                class: "img-thumbnail",
                                                style: "max-width: 150px;",
                                                alt: "Featured Image",
                                            }).appendTo(imageWrapper);
                                            $('<button>', {
                                                type: "button",
                                                class: "btn btn-danger btn-sm mt-2 remove-featured-image",
                                                text: "Remove",
                                            }).appendTo(imageWrapper);
                                            $('<input>', {
                                                type: "hidden",
                                                name: "featured_image",
                                                value: response.data.image_url,
                                            }).appendTo(imageWrapper);
                                        } else {
                                            alert("Image upload failed: " + response.data.message);
                                        }
                                    },
                                    error: function () {
                                        alert("An error occurred while uploading the featured image.");
                                    },
                                });
                            });

                            $(document).on("click", ".upload-portfolio-images", function () {
                                $(this).closest(".portfolio-upload-wrapper").find(".portfolio-upload-input").click();
                            });
                            
                            $(document).on("change", ".portfolio-upload-input", function (event) {
                                var input = this;
                                var files = input.files;
                                var formData = new FormData();
                                var previewWrapper = $(this).siblings(".portfolio-images");
                                var nonce = $("#portfolio_upload_nonce").val();

                                // Check total number of images
                                var existingImages = previewWrapper.children(".portfolio-image").length;
                                var remainingSlots = 20 - existingImages;

                                if (files.length > remainingSlots) {
                                    alert("You can only upload up to 20 images.");
                                    return;
                                }

                                formData.append("action", "handle_portfolio_upload");
                                formData.append("nonce", nonce);

                                $.each(files, function (i, file) {
                                    formData.append("portfolio_images[]", file);
                                });

                                // AJAX request to upload images
                                $.ajax({
                                    url: "<?= admin_url( 'admin-ajax.php' )?>", 
                                    type: "POST",
                                    data: formData,
                                    processData: false,
                                    contentType: false,
                                    success: function (response) {
                                        if (response.success) {
                                            $.each(response.data.images, function (index, imageUrl) {
                                                var imageWrapper = $('<div class="portfolio-image position-relative"></div>').appendTo(previewWrapper);
                                                $('<img>', {
                                                    src: imageUrl,
                                                    class: "img-thumbnail",
                                                    style: "max-width: 150px;",
                                                    alt: "Portfolio Image",
                                                }).appendTo(imageWrapper);
                                                $('<button>', {
                                                    type: "button",
                                                    class: "btn btn-danger btn-sm mt-2 remove-portfolio-image",
                                                    text: "Remove",
                                                }).appendTo(imageWrapper);
                                                $('<input>', {
                                                    type: "hidden",
                                                    name: "<?= $jws_option['professional_portfolio_field']; ?>[]",
                                                    value: imageUrl,
                                                }).appendTo(imageWrapper);
                                            });
                                        } else {
                                            alert("Image upload failed: " + response.data.message);
                                        }
                                    },
                                    error: function () {
                                        alert("An error occurred while uploading images.");
                                    },
                                });
                            });
                            $(document).on("click", ".remove-portfolio-image", function () {
                                $(this).closest(".portfolio-image").remove();
                            });
                        })      
                    </script>
                <?php
            }
            
            ?>
        </div>
        
        <div id="requests" class="dashboard-section container p-0">
            <div class="container p-4 shadow-sm rounded mb-4 bg-nsblue">
                <h2>Requests</h2>  
                <?php
                    $jobs_onboard = get_post_meta($freelancer_id, 'jobs_on_board', true);
                    $jobs_onboard = is_array($jobs_onboard) ? $jobs_onboard : [];
                    $jobs_onboard = array_filter($jobs_onboard, function($id) {
                        return get_post_status($id) !== false;
                    });
                    if($jobs_onboard){ ?>                
                        <div class="row">
                            <?php foreach ($jobs_onboard as $job) { ?>
                                <div class="col-md-6 col-lg-4 mb-4">                                    
                                    <div class="card h-100 border-0 shadow-sm p-3 bg-nsnone">
                                        <?php
                                        $city = get_post_meta($job,$jws_option['client_city_field'],true) ?? get_post_meta($job,$jws_option['client_city_field'],true);
                                        $location = $city ? $city.', ':'';
                                        $country = get_post_meta($job,$jws_option['client_country_field'],true) ?? get_post_meta($job,$jws_option['client_country_field'],true);
                                        $location .= $country;
                                        $budget = get_post_meta($job,$jws_option['client_budget_field'],true) ?? get_post_meta($job,$jws_option['client_budget_field'],true);
                                        $symbol = function_exists('get_woocommerce_currency_symbol') ? get_woocommerce_currency_symbol() : '£';
                                        $desc = get_post_meta($job,$jws_option['client_spec_req_field'],true) ?? get_post_meta($job,$jws_option['client_spec_req_field'],true);

                                        ?>
                                        <div class="card-body">
                                            <h3><?= get_the_title($job); ?></h3>                                                                                                
                                            <p class="card-text text-muted mb-1"><?php echo $location; ?></p>
                                            <p class="card-text text-muted mb-1">Budget: <?php echo $symbol.$budget; ?></p>
                                            <p class="card-text text-muted mb-1"><?php echo  wp_trim_words($desc, 20, '...'); ?></p>
                                            <a href="<?= get_the_permalink( $job ); ?>" class="btn btn-primary mt-3">View Job</a>                                                                          
                                        </div>
                                    </div>
                                </div>  
                            <?php } ?>
                        </div>

                    <?php } else {
                        echo '<p>There is no request at the moment.</p>';                        
                    } 
                ?>                
            </div>
            <?php
            $args = array(
                'post_type'      => 'jobs',
                'post_status'    => 'publish',
                'posts_per_page' => -1,
                'post__in'       => $jobs_onboard,
                'orderby'        => 'post__in',
            );
            
            $jobs_query = new WP_Query($args);                

            $args = array(
                'post_type'      => 'job_proposal',
                'author'         => $current_user_id,
                'post_status'    => 'publish'
            );
            $proposals = get_posts($args);
            if($proposals){ ?>
                <div class="container p-4 shadow-sm rounded bg-nsblue">
                    <h2>Proposals Sent</h2>
                    <div class="row">
                        <?php 
                        foreach ($proposals as $proposal) { 
                            $job = get_post_meta( $proposal->ID, 'job_id', true );
                            $job_post = get_post( $job );
                            if($job_post && $job_post->post_status == 'publish'){ ?>
                                <div class="col-md-6 col-lg-4 mb-4">                                    
                                    <div class="card h-100 border-0 shadow-sm p-3 bg-nsnone">
                                        <?php
                                        $city = get_post_meta($job,$jws_option['client_city_field'],true) ?? get_post_meta($job,$jws_option['client_city_field'],true);
                                        $location = $city ? $city.', ':'';
                                        $country = get_post_meta($job,$jws_option['client_country_field'],true) ?? get_post_meta($job,$jws_option['client_country_field'],true);
                                        $location .= $country;
                                        $budget = get_post_meta($job,$jws_option['client_budget_field'],true) ?? get_post_meta($job,$jws_option['client_budget_field'],true);
                                        $symbol = function_exists('get_woocommerce_currency_symbol') ? get_woocommerce_currency_symbol() : '£';
                                        $desc = get_post_meta($job,$jws_option['client_spec_req_field'],true) ?? get_post_meta($job,$jws_option['client_spec_req_field'],true);

                                        ?>
                                        <div class="card-body">
                                            <h3><?= get_the_title($job); ?></h3>                                                                                                
                                            <p class="card-text text-muted mb-1"><?php echo $location; ?></p>
                                            <p class="card-text text-muted mb-1">Budget: <?php echo $symbol.$budget; ?></p>
                                            <p class="card-text text-muted mb-1"><?php echo  wp_trim_words($desc, 20, '...'); ?></p>
                                            <a href="<?= get_the_permalink( $job ); ?>" class="btn btn-primary mt-3">View Job</a>                                                                          
                                        </div>
                                    </div>
                                </div>                            
                            <?php }
                        }
                        ?>
                    </div>
                </div>
            <?php } ?>
        </div>
        <div id="support" class="dashboard-section p-4 bg-nsblue rounded">
            <h3>Support</h3>
            <p>Need help? Contact our support team.</p>
        </div>

        <div id="reviews" class="dashboard-section p-4 bg-nsblue rounded">
            <h3>Reviews</h3>
            <p>Your reviews will be displayed here.</p>
        </div>

        <div id="subscription" class="dashboard-section">        
            <div class="container mb-4 p-4 bg-nsblue rounded">
                <h2>Manage Subscriptions</h2>
                <?php
                $user_id = get_current_user_id();
                $args = array(
                    'numberposts' => -1,
                    'post_type'   => 'wps_subscriptions',
                    'post_status' => 'wc-wps_renewal',
                    'meta_query' => array(
                        array(
                            'key'   => 'wps_customer_id',
                            'value' => $user_id,
                        ),
                    ),
                );
                $wps_subscriptions = get_posts( $args ); ?>
                <div class="wps_sfw_account_wrap">
                    <?php if(count($wps_subscriptions)>0){ ?>
                        <table>
                            <thead>
                                <tr>
                                    <th class="woocommerce-orders-table__header woocommerce-orders-table__header-order-number"><span class="nobr"><?php esc_html_e( 'Name', 'subscriptions-for-woocommerce' ); ?></span></th>
                                    <th class="woocommerce-orders-table__header woocommerce-orders-table__header-order-status"><span class="nobr"><?php esc_html_e( 'Status', 'subscriptions-for-woocommerce' ); ?></span></th>
                                    <th class="woocommerce-orders-table__header woocommerce-orders-table__header-order-date"><span class="nobr"><?php echo esc_html_e( 'Next Payment Date', 'subscriptions-for-woocommerce' ); ?></span></th>
                                    <th class="woocommerce-orders-table__header woocommerce-orders-table__header-order-total"><span class="nobr"><?php echo esc_html_e( 'Recurring Total', 'subscriptions-for-woocommerce' ); ?></span></th>
                                    <th class="woocommerce-orders-table__header woocommerce-orders-table__header-order-actions"><?php esc_html_e( 'Next Recurring', 'subscriptions-for-woocommerce' ); ?></th>
                                    <th class="woocommerce-orders-table__header woocommerce-orders-table__header-order-actions"><?php esc_html_e( 'Action', 'subscriptions-for-woocommerce' ); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach ( $wps_subscriptions as $key => $wps_subscription ) {
                                if ( OrderUtil::custom_orders_table_usage_is_enabled() ) {
                                    $subcription_id = $wps_subscription;
                                } else {
                                    $subcription_id = $wps_subscription->ID;
                                }
                                $parent_order_id   = wps_sfw_get_meta_data( $subcription_id, 'wps_parent_order', true );
                                $wps_wsfw_is_order = false;
                                if ( function_exists( 'wps_sfw_check_valid_order' ) && ! wps_sfw_check_valid_order( $parent_order_id ) ) {
                                    $wps_wsfw_is_order = apply_filters( 'wps_wsfw_check_parent_order', $wps_wsfw_is_order, $parent_order_id );
                                    if ( false == $wps_wsfw_is_order ) {
                                        continue;
                                    }
                                }
                                $name = wps_sfw_get_meta_data($subcription_id, 'product_name', true);
                                ?>
                                <tr class="wps_sfw_account_row woocommerce-orders-table__row woocommerce-orders-table__row--status-processing order">
                                    <td class="wps_sfw_account_col woocommerce-orders-table__cell woocommerce-orders-table__cell-order-number">
                                        <?php echo esc_html( $name ); ?>
                                    </td>
                                    <?php $wps_status = wps_sfw_get_meta_data( $subcription_id, 'wps_subscription_status', true ); ?>
                                    <td class="wps_sfw_account_col woocommerce-orders-table__cell woocommerce-orders-table__cell-order-status wps_sfw_<?php echo esc_html( $wps_status ); ?>">
                                        <?php
    
                                        if ( 'active' === $wps_status ) {
                                            $wps_status = esc_html__( 'active', 'subscriptions-for-woocommerce' );
                                        } elseif ( 'on-hold' === $wps_status ) {
                                            $wps_status = esc_html__( 'on-hold', 'subscriptions-for-woocommerce' );
                                        } elseif ( 'cancelled' === $wps_status ) {
                                            $wps_status = esc_html__( 'cancelled', 'subscriptions-for-woocommerce' );
                                        } elseif ( 'paused' === $wps_status ) {
                                            $wps_status = esc_html__( 'paused', 'subscriptions-for-woocommerce' );
                                        } elseif ( 'pending' === $wps_status ) {
                                            $wps_status = esc_html__( 'pending', 'subscriptions-for-woocommerce' );
                                        } elseif ( 'expired' === $wps_status ) {
                                            $wps_status = esc_html__( 'expired', 'subscriptions-for-woocommerce' );
                                        }
                                            echo esc_html( $wps_status );
                                        ?>
                                    </td>
                                    <td class="wps_sfw_account_col woocommerce-orders-table__cell woocommerce-orders-table__cell-order-date">
                                <?php
                                    $wps_next_payment_date = wps_sfw_get_meta_data( $subcription_id, 'wps_next_payment_date', true );
                                if ( 'cancelled' === $wps_status ) {
                                    $wps_next_payment_date = '';
                                }
                                    echo esc_html( wps_sfw_get_the_wordpress_date_format( $wps_next_payment_date ) );
                                ?>
                                    </td>
                                    <td class="wps_sfw_account_col woocommerce-orders-table__cell woocommerce-orders-table__cell-order-total">
                                    <?php
                                    do_action( 'wps_sfw_display_susbcription_recerring_total_account_page', $subcription_id );
                                    ?>
                                    </td>
                                    <td class="wps_sfw_account_col woocommerce-orders-table__cell woocommerce-orders-table__cell-order-next-reccuring-days">
                                        <?php
                                        if ( $wps_next_payment_date ) {
                                            $time_difference = (int) $wps_next_payment_date - time();
    
                                            // Convert the difference from seconds to days.
                                            $days_left = ceil( $time_difference / ( 60 * 60 * 24 ) );
                                            if ( $days_left > 1 ) {
                                                $day_text = esc_attr__( 'Days', 'subscriptions-for-woocommerce' );
                                                echo esc_attr( $days_left . ' ' . $day_text );
                                            } else {
                                                echo esc_attr__( 'Tomorrow', 'subscriptions-for-woocommerce' );
                                            }
                                        } else {
                                            echo esc_attr( '---' );
                                        }
                                        ?>
                                    </td>
                                    </td>
                                    <?php
                                    $wps_status = wps_sfw_get_meta_data( $subcription_id, 'wps_subscription_status', true );
                                    if ( 'active' == $wps_status ) {
                                        $wps_cancel_url = wps_sfw_cancel_url( $subcription_id, $wps_status );
                                        ?>
                                            <td class="wps_sfw_account_col woocommerce-orders-table__cell woocommerce-orders-table__cell-order-actions">
                                                <a href="<?php echo esc_url( $wps_cancel_url ); ?>" class="button wps_sfw_cancel_subscription"><?php esc_html_e( 'Cancel', 'subscriptions-for-woocommerce' ); ?></a>
                                            </td>
                                        <?php
                                    } else { ?>
                                        <td class="wps_sfw_account_col woocommerce-orders-table__cell woocommerce-orders-table__cell-order-actions">
                                            <span class="wps_sfw_account_show_subscription">---</span>
                                        </td>
                                    <?php }
                                    ?>
                                </tr>
                                <?php
                            }
                            ?>
                            </tbody>
                        </table>                        
                    <?php } else{
                        echo '<p class="text-muted">No Subscription plan activated.</p>';
                    }?>
                </div>                    
            </div>
            <div class="container mb-4 p-4 bg-nsblue rounded">
                <h2 class="mb-4">Subscription Plans</h2>
                <div class="row">
                    <?php                  
                    $args = array(
                        'numberposts' => -1,
                        'post_type'   => 'wps_subscriptions',
                        'post_status' => 'wc-wps_renewal',
                        'meta_query' => array(
                            'relation' => 'AND',
                            array(
                                'key'   => 'wps_customer_id',
                                'value' => $user_id,
                            ),
                            array(
                                'key' => 'wps_subscription_status',
                                'value' => 'active',
                            ),                            
                        ),
                    );
                    $owned_subscriptions = get_posts( $args );    
                    $subscription_ids = wp_list_pluck($owned_subscriptions, 'ID');
                    $owned_product_ids = [];
                    foreach ($subscription_ids as $subscription_id_one) {
                        $owned_product_ids[] = get_post_meta( $subscription_id_one, 'product_id', true );
                    }
                    $args = array(
                        'numberposts' => -1,
                        'post_type'   => 'product',
                        'post_status' => 'publish',
                        'meta_query' => array(
                            array(
                                'key'   => '_wps_sfw_product',
                                'value' => 'yes',
                            ),
                        ),
                    );
                    $wps_subscriptions = get_posts( $args );
                    if (!empty($wps_subscriptions)) {
                        foreach ($wps_subscriptions as $post) {
                            setup_postdata($post);
                            $product = wc_get_product($post->ID);
                            $price = $product->get_price();
                            $link = get_permalink($post->ID);
                            ?>
                            <div class="col-md-6">
                                <div class="card shadow-sm p-3 mb-4 bg-nsnone">
                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo get_the_title($post->ID); ?>
                                        </h5>
                                        <p class="card-text"><?php echo wp_trim_words(get_the_content($post->ID), 20); ?></p>
                                        <h4 class="text-primary">£<?php echo esc_html($price); ?></h4>
                                        <?php 
                                        if(in_array($post->ID, $owned_product_ids)){ ?>   
                                            <a href="javascript:void(0)" class="btn btn-primary disabled">Activated</a>
                                        <?php } else { 
                                            $add_to_cart_url = wc_get_checkout_url() . '?add-to-cart=' . $post->ID;
                                            ?>
                                            <form class="form-product" action="<?php echo esc_url($add_to_cart_url); ?>" method="post">
                                                <button type="submit" class="btn btn-primary">Subscribe Now</button>
                                            </form>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>

                            <?php
                        }
                        wp_reset_postdata();
                    } else {
                        echo '<p class="text-muted">No subscription plans available.</p>';
                    }
                    ?>
                </div>
            </div>            
            <div class="container p-4 bg-nsblue rounded">
                <h2>Buy More Credits</h2>                
                <div class="row">
                    <?php
                    $credit_packs = wc_get_products(['category' => ['credit-pack'], 'status' => 'publish']);
                    foreach ($credit_packs as $pack) {
                        $credits = get_post_meta($pack->get_id(), 'credit_value', true);
                        ?>
                        <div class="col-md-4 mb-4">
                            <div class="card p-3 text-center bg-nsnone">
                                <h4><?php echo esc_html($credits); ?> Credits</h4>
                                <p>Price: <strong>£<?php echo $pack->get_price(); ?></strong></p>
                                <?php
                                $add_to_cart_url = wc_get_checkout_url() . '?add-to-cart=' . $pack->get_id();
                                ?>
                                <form class="form-product" action="<?php echo esc_url($add_to_cart_url); ?>" method="post">
                                    <button type="submit" class="btn btn-primary">Buy Now</button>
                                </form>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        <div id="orders" class="dashboard-section">
            <h2>Order History</h2>
            <div class="container card shadow-sm">
                <?php
                if ( is_user_logged_in() ) {
                    do_action( 'woocommerce_account_orders_endpoint' );
                } else {
                    echo '<p>You need to be logged in to view your orders.</p>';
                }
                ?>
            </div>
        </div>
        <div id="password" class="dashboard-section">
            <h4>Change Password</h4>
            <form id="change-password-form" method="post" class="p-4 bg-nsblue rounded">
                <div class="mb-3">
                    <label for="current_password" class="form-label">Current Password</label>
                    <input type="password" class="form-control" id="current_password" name="current_password" required>
                </div>
                <div class="mb-3">
                    <label for="new_password" class="form-label">New Password</label>
                    <input type="password" class="form-control" id="new_password" name="new_password" required>
                </div>
                <div class="mb-3">
                    <label for="confirm_password" class="form-label">Confirm New Password</label>
                    <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                </div>
                <input type="hidden" name="change_password_nonce" value="<?php echo wp_create_nonce('change_password_nonce'); ?>">
                <button type="submit" class="btn btn-primary">Update Password</button>
                <div id="password-message" class="mt-3"></div>
            </form>

        </div>

        <div id="deleteAccount" class="dashboard-section">
            <h3>Delete Account</h3>
            <form id="delete-account-form" class="p-4 bg-nsblue">
                <?php wp_nonce_field('delete_account_action', 'delete_account_nonce'); ?>
                <div class="form-group">
                    <label for="del-password">Enter your password</label>
                    <input type="password" id="del-password" name="password" class="form-control" required>
                </div>
                <div class="form-check my-3">
                    <input type="checkbox" id="confirm-delete" class="form-check-input" required>
                    <label class="form-check-label" for="confirm-delete">I confirm I want to delete my account</label>
                </div>
                <button type="submit" class="btn btn-danger">Delete My Account</button>
            </form>
        </div>
    </div>
    <div id="notification-container" style="position: fixed; top: 20px; right: 20px; z-index: 9999;"></div>
    <script>        
        document.addEventListener("DOMContentLoaded", function () {
            function showSectionFromHash() {
                let hash = window.location.hash.replace("#", ""); // Get hash without #
                if (hash) {
                    let targetSection = document.querySelector(`[data-section="${hash}"]`);
                    if (targetSection) {
                        // Hide all sections first
                        document.querySelectorAll("[data-section]").forEach(section => {
                            // section.style.display = "none";
                        });

                        // Show the target section
                        targetSection.style.display = "block";
                    }
                }
            }

            // Run on page load
            showSectionFromHash();

            // Listen for hash changes
            window.addEventListener("hashchange", showSectionFromHash);
        });
        document.addEventListener("DOMContentLoaded", function () {
            const buttons = document.querySelectorAll(".form-product button[type='submit']");

            buttons.forEach(button => {
                button.addEventListener("click", function (e) {
                    e.preventDefault(); // Prevent default form submission

                    fetch("<?php echo admin_url('admin-ajax.php'); ?>", {
                        method: "POST",
                        headers: { "Content-Type": "application/x-www-form-urlencoded" },
                        body: "action=clear_woocommerce_cart"
                    }).then(response => response.json())
                    .then(() => {
                        this.closest("form").submit();
                    });
                });
            });
        });

    </script>
    <style>
        body .dashboard-container :where(h1, h2, h3, label.form-label) {
            font-family: "Faustina", Sans-serif;
        }
        .bg-nsblue{
            background-color:#F5F9FF;
        }
        .bg-nsnone{
            background-color:transparent;
        }

        .dashboard-container .btn.btn-primary {
            border-radius: 4px;
            padding: 8px 10px;
            border: none;
            background: var(--btn-bgcolor);
            font-weight: 800;
        }
        .dashboard-container .btn.btn-danger {
            border-radius: 4px;
            padding: 8px 10px;
            border: none;
            background: #FC544B;
            font-weight: 800;
        }
        :is(.uploaded-image,.portfolio-image) button {
            width: fit-content;
        }
        .dashboard-container :is(#profile, #password) [type="submit"] {
            padding: 13px 25px;
        }
        @media (max-width: 767px){
            .dashboard-main .greeting{
                margin-bottom:0;
                font-size:14px;
            }
            .welcome-section h2 {
                font-size: 28px;
            }
            .welcome-section {
                margin-bottom: 0;
                padding: 15px;
            }
            aside.sidebar{
                width: 100%;
            }

        }
        /* New Style Ends */
        
        h3.user-name a, .sidebar-menu li a:not(.active a) {
            color: inherit;
        }
        .welcome-head {
            display: flex;
            justify-content: space-between;
        }
        .uploaded-image img {
            max-width: 150px;
        }
        #profile-form .form-group {
            padding-bottom: 20px;
            border-bottom: 0.5px solid #00000030;
        }
        .dashboard-container label.form-label {
            font-size: 18px;
            font-weight: 800;
        }
        .dashboard-container .form-group span.select2 {
            width: 200px!important;
        }
        .dashboard-section {
            display: none;
        }
        .dashboard-section.active {
            display: block;
            width: calc(76% - 20px);
        }

        body .dashboard-container {
            padding: 50px 0;
            display: flex;
            gap: 20px;
        }        
        .sidebar {
            width: 346px;
            padding: 20px;            
            border-radius: 9px 0 0 9px;
        }

        .profile-section {
            display: flex;
            gap: 20px;
            margin-bottom: 35px;
        }

        .profile-img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
        }

        h3.user-name {
            font-family: "Faustina", Sans-serif;
            font-size: 24px;
            font-weight: 600;
            display: flex;
            align-items: center;
            line-height: 100%;
        }

        .profile-img img {
            border-radius: 50%;
        }

        .profile-section img {
            border-radius: 50%;
            border: 4px solid #388FFF;
        }

        .sidebar-menu ul {
            list-style: none;
            padding: 0;
        }

        .sidebar-menu li {
            padding: 10px;
            padding-bottom: 20px;
            border-bottom: 1px solid #D6DEDF;
            font-family: "Faustina", Sans-serif;
            font-size: 24px;
            font-weight: 600;
        }

        .dashboard-main {
            flex-grow: 1;            
        }

        .dashboard-main .greeting {
            font-size: 18px;
            line-height: 27px;
            color: #606779;
            margin-bottom: 10px;
        }

        .welcome-section h2 {
            font-size: 32px;
        }

        .welcome-section {
            margin-bottom: 20px;
        }

        .stats-container {
            display: flex;
            gap: 15px;
        }

        .stat-box {
            flex: 1;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            color: #fff;
            font-size: 24px;
            line-height: 140%;
            background-color: #388FFF;
        }

        .personal-details {
            margin-top: 60px;        
            border-radius: 9px 0 0 9px;
            padding: 20px 30px;
        }

        .personal-details .section-title {
            font-size: 24px;
            margin-bottom: 30px;
        }

        .personal-details ul {
            list-style: none;
            padding: 0;
        }

        .personal-details li {
            margin-bottom: 10px;
            color: #606779;
            font-size: 18px;
            line-height: 27px;
        }

        .personal-details-list {
            display: flex;
            gap: 40px;
        }

        .sidebar-menu ul>li:last-child {
            border-bottom: none;
        }
        :where(.uploaded-image, .portfolio-image) img {
            width: 150px!important;
            height: 150px!important;
            object-fit: cover;
        }
        .woocommerce-orders-table tr td {
            padding-left: 0;
        }
        #orders > .container {
            max-width: 100%;
        }
        @media (max-width: 767px){
            body .dashboard-container{
                flex-direction:column;
            }
            .dashboard-section.active {
                width: 100%;
            }
            .personal-details {
                margin-top: 20px;
                padding: 15px;
            }
            div.dashboard-section {
                margin: 0!important;
            }
            div.dashboard-section {
                margin: 0!important;
                box-shadow: none!important;
                /* padding: 0!important; */
                max-width: 100%;
            }
            #profile-form .form-group {
                justify-content: space-between;
            }
            div#requests > .container {
                margin-top: 20px;
                box-shadow: none!important;
                /* padding: 0!important; */
                max-width: 100%;
            }
            div#subscription > .container {
                max-width: 100%;
                padding: 0;
            }
        }
    </style>
<?php } else { 
global $jws_option;    
?>
    <div class="not-logged-in">
        <p>Please login to access this page. <a href="/login">Login</a></p>
    </div>
<?php }
