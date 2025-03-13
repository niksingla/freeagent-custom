<?php
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
    ?>

    <div class="dashboard-container">
        <aside class="sidebar">
            <div class="profile-section">
                <?php jws_image_advanced($freelancer_id, '96x96')?>
                <h3 class="user-name">
                    <?php echo get_the_title($freelancer_id)?>
                </h3>
            </div>
            <nav class="sidebar-menu">
                <ul>
                    <li class="active"><a href="#" data-section="dashboard">Dashboard</a></li>
                    <li><a href="#" data-section="profile">Profile</a></li>
                    <li><a href="#" data-section="support">Support</a></li>
                    <li><a href="#" data-section="reviews">Reviews</a></li>
                    <li><a href="#" data-section="subscription">Subscription</a></li>
                    <li><a href="#" data-section="password">Change Password</a></li>
                    <li><a href="#" data-section="deleteAccount">Delete Account</a></li>
                    <li><a href="<?= wp_logout_url(get_permalink($freelancer_id)) ?>">Logout</a></li>
                </ul>
            </nav>

        </aside>
        <div id="dashboard" class="dashboard-main dashboard-section active">
            <div class="welcome-section">
                <p class="greeting">Hello,
                    <?php echo get_the_title($freelancer_id)?>
                </p>
                <h2>Welcome To Your Profile</h2>
            </div>

            <div class="personal-details">
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
        <div id="profile" class="dashboard-section container mt-4 p-4 bg-white shadow-sm rounded">
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
                                    echo '<div class="uploaded-image mb-2">
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
                                            echo '<div class="portfolio-image position-relative">
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
                                console.log(ft_image_input);
                                
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

        <div id="support" class="dashboard-section">
            <h3>Support</h3>
            <p>Need help? Contact our support team.</p>
        </div>

        <div id="reviews" class="dashboard-section">
            <h3>Reviews</h3>
            <p>Your reviews will be displayed here.</p>
        </div>

        <div id="subscription" class="dashboard-section">
            <h3>Subscription</h3>
            <p>Manage your subscription details.</p>
        </div>
        <div id="password" class="dashboard-section">
            <h4>Change Password</h4>
            <form id="change-password-form" method="post">
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
            <p>Request account deletion.</p>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const navLinks = document.querySelectorAll(".sidebar-menu a");
            const sections = document.querySelectorAll(".dashboard-section");

            // Function to handle navigation clicks
            navLinks.forEach(link => {
                link.addEventListener("click", function (e) {
                    if(this.hasAttribute("data-section")){
                        e.preventDefault()
                        // Remove active class from all nav links
                        navLinks.forEach(nav => nav.parentElement.classList.remove("active"));
                        this.parentElement.classList.add("active");
        
                        // Remove active class from all sections
                        sections.forEach(section => section.classList.remove("active"));
        
                        // Add active class to the clicked section
                        const sectionId = this.getAttribute("data-section");
                        document.getElementById(sectionId).classList.add("active");
                    }
                });
            });

            // Show the default section (Dashboard) on load
            document.getElementById("dashboard").classList.add("active");
        });
        jQuery(document).ready(function($) {
            $("#change-password-form").on("submit", function(e) {
                e.preventDefault();
                var formData = $(this).serialize();
                
                $.ajax({
                    type: "POST",
                    url: "<?php echo admin_url('admin-ajax.php'); ?>",
                    data: formData + "&action=change_user_password",
                    beforeSend: function() {
                        $("#password-message").html("<div class='alert alert-info'>Processing...</div>");
                    },
                    success: function(response) {
                        $("#password-message").html(response);
                        $("#change-password-form")[0].reset();
                        clearMessage();
                        // Reload page after 2 seconds on success
                        if (response.includes("success")) {
                            setTimeout(function() {
                                location.reload();
                            }, 4000);
                        }
                    },
                    error: function() {
                        $("#password-message").html("<div class='alert alert-danger'>Something is wrong.</div>");
                        clearMessage();
                    }

                });
            });
            function clearMessage() {
                setTimeout(function() {
                    $("#password-message").fadeOut("slow", function() {
                        $(this).html("").show();
                    });
                }, 5000);
            }
        });
    </script>
    <style>
        .uploaded-image img {
            max-width: 150px;
        }
        #profile-form .form-group {
            padding: 12px 16px;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
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

        body .dashboard-container * {
            font-family: "Faustina", Sans-serif;
        }

        .sidebar {
            width: 346px;
            padding: 20px;
            background-color: #F5F9FF;
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
            padding-top: 60px;
            padding-left: 31px;
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
            background-color: #F5F9FF;
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
    </style>
<?php } else { 
global $jws_option;    
?>
    <div class="not-logged-in">
        <p>Please login to access this page. <a href="/login">Login</a></p>
    </div>
<?php }
