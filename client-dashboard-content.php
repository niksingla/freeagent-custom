<?php
$current_user_id = get_current_user_id();
if($current_user_id){ ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="<?= get_template_directory_uri() . '/assets/bootstrap/css/bootstrap.min.css'; ?>">
    <script src="<?= get_template_directory_uri() . '/assets/bootstrap/js/bootstrap.bundle.min.js'; ?>"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css" integrity="sha512-H9jrZiiopUdsLpg94A333EfumgUBpO9MdbxStdeITo+KEIMaNfHNvwyjjDJb+ERPaRS6DpyRlKbvPUasNItRyw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js" integrity="sha512-uURl+ZXMBrF4AwGaWmEetzrd+J5/8NRkWAvJx5sbPSSuOb0bZLqf+tOzniObO00BjHa/dD7gub9oCGMLPQHtQA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <?php

    global $user,$jws_option;
    $user = get_userdata( $current_user_id );
    $user_meta = get_user_meta( $current_user_id );

    $employer_id  = Jws_Custom_User::get_employer_id( $current_user_id );

    if(empty($employer_id)){
        $args = array(
            'post_type'      => 'employers',
            'posts_per_page' => 1,
            'author'         => $current_user_id,
            'fields'         => 'ids',
        );
        
        $freelancer_query = new WP_Query($args);
        
        if (!empty($freelancer_query->posts)) {
            $employer_id = $freelancer_query->posts[0];
        } else {
            $employer_id = null;
        }
    }
    $args = array(
        'post_type'      => 'jobs',
        'author'         => $current_user_id,
        'post_status'    => 'publish',
    );
    $jobs = new WP_Query($args);

    $profile_meta = get_post_meta( $employer_id );

    $user_email = $user->user_email;
    $phone = get_post_meta( $employer_id, 'phone', true );
    $city = get_post_meta($employer_id, $jws_option['professional_city_field'], true);
    $country = get_post_meta($employer_id, $jws_option['professional_country_field'], true);
    $symbol = function_exists('get_woocommerce_currency_symbol') ? get_woocommerce_currency_symbol() : '£';

    ?>
    <!-- Hidden Fancybox Popup -->
    <div style="display: none;width: 98%;margin-left: auto;margin-right: auto;" id="featuredProfilesPopup">
        <div class="popup-content">
            <h4 class="mb-3">Featured Profiles</h4>
            <div id="featuredProfilesContent" class="text-center">
                <p>Loading...</p>
            </div>
        </div>
    </div>
    <div class="dashboard-container">
        <aside class="sidebar">
            <div class="profile-section">
                <img width="96" height="96" src="https://secure.gravatar.com/avatar/2133fbb36adcd2407159706ef599844f?s=200&d=mm" alt="Profile Picture" class="profile-pic">
                <h3 class="user-name">
                    <?php echo get_the_title($employer_id)?>
                </h3>
            </div>
            <nav class="sidebar-menu">
                <ul>
                <?php
                    $client_labels = [
                        'label_dashboard' => 'client-dashboard',
                        'label_jobs' => 'client-jobs',
                        'label_proposals' => 'client-proposals',
                        'label_support' => 'client-support',
                        'label_chat' => 'client-chat',
                        'label_password' => 'client-password',
                        'label_delete' => 'client-delete',
                        'label_logout' => 'logout'
                    ];

                    foreach ($client_labels as $meta_key => $section) {
                        $label = get_post_meta(get_the_ID(), $meta_key, true);
                        if ($label === '') continue;

                        if ($meta_key === 'label_logout') {
                            echo '<li><a href="' . esc_url(wp_logout_url(get_permalink(0))) . '">' . esc_html($label ?: 'Logout') . '</a></li>';
                        } else {
                            $active = ($meta_key === 'label_dashboard') ? ' class="active"' : '';
                            echo '<li' . $active . '><a href="#" data-section="' . esc_attr($section) . '">' . esc_html($label) . '</a></li>';
                        }
                    }
                ?>

                </ul>
            </nav>
        </aside>
        <div id="client-dashboard" class="dashboard-main dashboard-section p-4 active">
            <div class="welcome-section">
                <p class="greeting">Hello, <?php echo get_the_title($employer_id)?></p>
                <h2>Welcome To Your Profile</h2>
            </div>
            <div class="personal-details">
                <h3 class="section-title">Personal Details</h3>
                <div class="personal-details-list">
                    <ul>
                        <li>Name:</li>
                        <li>Email:</li>
                        <?php 
                            if($phone){ ?>
                                <li>Phone:</li>
                            <?php }
                        ?>
                        <?php 
                            if($city && $country){ ?>                            
                                <li>Address:</li>
                            <?php }
                        ?>
                    </ul>
                    <ul>
                        <li>
                            <?php echo get_the_title($employer_id)?>
                        </li>
                        <li>
                            <?php echo $user_email; ?>
                        </li>
                        <?php 
                            if($phone){ ?>                            
                                <li>
                                    <?php echo $phone; ?>
                                </li>
                            <?php }
                        ?>
                        <?php 
                            if($city && $country){ ?>
                                <li>
                                    <?php echo "$city, $country"?>
                                </li>
                            <?php }
                        ?>
                    </ul>

                </div>
            </div>
        </div>    
        <div id="client-jobs" class="dashboard-section">
            <div class="container bg-nsblue shadow-sm rounded p-4">
                <div class="my-jobs-head">
                    <h3 class="mb-4 text-center">My Jobs</h3>
                    <a data-fancybox="" data-src="<?= get_permalink( $jws_option['add_job_page'] )?>" data-type="iframe" data-preload="false" data-width="800" data-height="600" class="btn btn-primary">Add Job</a>
                </div>
                <div class="row">
                    <?php
                    $args = array(
                        'post_type'      => 'jobs',
                        'author'         => $current_user_id,
                        'post_status'    => 'publish'
                    );
                    $jobs = new WP_Query($args);
                    
                    if ($jobs->have_posts()) :
                        while ($jobs->have_posts()) : $jobs->the_post();
                        ?>
                            <div class="col-md-6 col-lg-4 mb-4">
                                <div class="card h-100 border-0 shadow-sm p-3">
                                    <div class="card-body">
                                        <h3 class="card-title"><?php the_title(); ?></h3>
                                        <?php 
                                        $city = get_post_meta(get_the_ID(),$jws_option['client_city_field'],true) ?? get_post_meta(get_the_ID(),$jws_option['client_city_field'],true);
                                        $location = $city ? $city.', ':'';
                                        $country = get_post_meta(get_the_ID(),$jws_option['client_country_field'],true) ?? get_post_meta(get_the_ID(),$jws_option['client_country_field'],true);
                                        $location .= $country;
                                        $desc = get_post_meta(get_the_ID(),$jws_option['client_spec_req_field'],true) ?? get_post_meta(get_the_ID(),$jws_option['client_spec_req_field'],true);
                                        $budget = get_post_meta(get_the_ID(),$jws_option['client_budget_field'],true) ?? get_post_meta(get_the_ID(),$jws_option['client_budget_field'],true);

                                        ?>
                                        <p class="card-text text-muted mb-1"><?php echo $location; ?></p>
                                        <?php
                                        if($budget){  ?>
                                            <p class="card-text text-muted mb-1"><?php echo  'Budget: '.$symbol.'' . $budget; ?></p>
                                        <?php }
                                        if($desc){ ?>
                                            <p class="card-text text-muted mb-1"><?php echo  wp_trim_words($desc, 20, '...'); ?></p>
                                        <?php }
                                        ?>
                                        <!-- <p class="card-text text-muted"><?php echo wp_trim_words(get_the_content(), 20, '...'); ?></p> -->
                                        <a href="<?php the_permalink(); ?>" class="btn btn-primary mt-3">View Job</a>
                                        <button type="button" class="btn btn-primary mt-2 view-featured-profiles" data-job-id="<?php echo get_the_ID(); ?>" data-fancybox data-src="#featuredProfilesPopup">
                                            View Featured Profiles
                                        </button>                                    
                                    </div>
                                </div>
                            </div>
                            <?php
                        endwhile;
                        wp_reset_postdata(); ?>
                        
                        <script>
                            jQuery(document).ready(function($) {
                                $('.view-featured-profiles').click(function() {
                                    var jobId = $(this).data('job-id');
                                    $('#featuredProfilesContent').html('<p>Loading...</p>');

                                    $.ajax({
                                        url: '<?php echo admin_url("admin-ajax.php"); ?>',
                                        type: 'POST',
                                        data: {
                                            action: 'fetch_featured_profiles',
                                            job_id: jobId
                                        },
                                        success: function(response) {
                                            $('#featuredProfilesContent').html(response);
                                        },
                                        error: function() {
                                            $('#featuredProfilesContent').html('<p>Something went wrong. Please try again.</p>');
                                        }
                                    });

                                    // Fancybox.show([{ src: "#featuredProfilesPopup", type: "inline" }]);
                                });
                            });
                        </script>

                        <?php
                        else :
                            echo '<p class="text-center text-muted">No jobs found.</p>';
                        endif;
                        ?>
                </div>
            </div>
        </div>
        <div id="client-proposals" class="dashboard-section">
            <h3>Proposals</h3>
            <?php
            $args = array(
                'post_type'      => 'jobs',
                'author'         => $current_user_id,
                'post_status'    => 'publish',
                'posts_per_page' => -1,
                'fields'         => 'ids',
            );
            $query = new WP_Query($args);
            if($query->have_posts()){
                $job_ids = $query->posts;
                $proposal_args = array(
                    'post_type'      => 'job_proposal',
                    'meta_query'     => array(
                        array(
                            'key'     => 'job_id',
                            'value'   => $job_ids,
                            'compare' => 'IN',
                        ),
                    ),
                    'posts_per_page' => -1,
                );
            
                $proposal_query = new WP_Query($proposal_args);
            
                if ($proposal_query->have_posts()) {
                    ?>
                    <div class="container bg-nsblue shadow-sm rounded p-4">
                        <div class="row">
                            <?php
                            while ($proposal_query->have_posts()) {
                                $proposal_query->the_post();                    
                                $author = get_the_author_ID();
                                $freelancer_id  = Jws_Custom_User::get_freelaner_id( $author );
                                if(empty($freelancer_id)){
                                    $args = array(
                                        'post_type'      => 'freelancers',
                                        'posts_per_page' => 1,
                                        'author'         => $author,
                                        'fields'         => 'ids',
                                    );
                                    
                                    $freelancer_query = new WP_Query($args);
                                    
                                    if (!empty($freelancer_query->posts)) {
                                        $freelancer_id = $freelancer_query->posts[0];
                                    } else {
                                        $freelancer_id = null;
                                    }
                                }
                                $position_title = get_post_meta($freelancer_id, 'freelancers_position', true);
                                $fee = get_post_meta($freelancer_id, $jws_option['professional_fee_field'], true);
                                $freelancer_link = get_the_permalink($freelancer_id);                                                    
                                $proposal_message = get_the_content();
                                $applied_job_id = get_post_meta(get_the_ID(), 'job_id', true);
                                ?>
                                <div class="col-md-6 col-lg-4 mb-4">
                                    <a href="<?= $freelancer_link; ?>">
                                        <div class="card h-100 border-0 shadow-sm p-3 bg-nsnone">
                                            <div class="card-body">
                                                <h3><?= get_the_author_nickname(); ?></h3>
                                                <p class="card-text text-muted mb-1"><?= $position_title ;?></p>
                                                <p class="card-text text-muted"><?= $symbol.$fee ;?></p>
                                                <p class="card-text text-muted">
                                                    <small>
                                                        (Applied job: <?= get_the_title($applied_job_id)?>)
                                                    </small>
                                                </p>
                                                <p class="card-text text-muted mb-1">Message: <?= $proposal_message ;?></p>
                                                <a href="mailto:<?php echo get_the_author_email(); ?>" class="btn btn-primary mt-3">Send Email</a>
                                            </div>
                                        </div>
                                    </a>
                                </div>                        
                                <?php
                            }
                            wp_reset_postdata(); ?>
                        </div>
                    </div>
                <?php } else {
                    echo '<p>No proposals found.</p>';
                }
            } else { ?>
                <p>No Jobs posted yet.</p>
            <?php }
            ?>
        </div>
        <div id="client-support" class="dashboard-section">
            <h3>Support</h3>
            <p>Need help? Contact our support team.</p>
        </div>
        <div id="client-chat" class="dashboard-section">
            <h3>Live Chat</h3>
            <p>Coming Soon.</p>        
        </div>
        <div id="client-password" class="dashboard-section">
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
        <div id="client-delete" class="dashboard-section">
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
            // Show the default section (Dashboard) on load
            document.getElementById("client-dashboard").classList.add("active");
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
        /* New Style Ends Here */

        body .dashboard-container {
            padding: 50px 0;
            display: flex;
            gap: 20px;
        }
        .sidebar-menu li a:not(.active a) {
            color: inherit;
        }
        .dashboard-container label.form-label {
            font-size: 18px;
            font-weight: 800;
        }
        .dashboard-section {
            display: none;
        }
        .my-jobs-head h3 {
            display: inline-block;
        }
        .my-jobs-head a {
            display: inline-block;
            float: right;
        }
        #client-jobs .card {
            background: #F5F9FF;
            text-align: center;
        }
        #client-jobs .card-body {
            padding: 0;
        }
        .dashboard-section.active {
            display: block;
            width: calc(76% - 20px);
        }
        .sidebar {
            width: 24%;
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
        @media (max-width: 767px){
            body .dashboard-container{
                flex-direction:column;
            }
            .dashboard-section.active {
                width: 100%;
            }
            div.dashboard-section {
                margin: 0 !important;
                box-shadow: none !important;
                padding: 0 !important;
                max-width: 100%;
            }
            .sidebar {
                width: 100%;
            }      
            .personal-details {
                margin-top: 20px;
                padding: 15px;
            }
            #client-jobs > .container {
                max-width: 100%;
                box-shadow: none!important;
            }
            .my-jobs-head {
                text-align: left;
            }  
            #client-proposals > .container {
                max-width: 100%;
                box-shadow: none!important;
                padding: 0!important;
            }    
        }
    </style>
<?php } else {
    global $jws_option;    
    ?>
        <div class="not-logged-in">
            <p>Please login to access this page. <a href="/login">Login</a></p>
        </div>
    <?php 
}