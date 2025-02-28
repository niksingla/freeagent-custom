<?php
$current_user_id = get_current_user_id();
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
$profile_meta = get_post_meta( $employer_id );

$user_email = $user->user_email;
$phone = get_post_meta( $employer_id, 'phone', true );
$city = get_post_meta($employer_id, $jws_option['professional_city_field'], true);
$country = get_post_meta($employer_id, $jws_option['professional_country_field'], true);
// echo '<pre>';
// print_r([$user,$profile_meta]);
// echo '</pre>';


?>
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
                <li class="active"><a href="#">Dashboard</a></li>
                <li><a href="#">Support</a></li>
                <li><a href="#">Live Chat</a></li>
                <li><a href="#">Change Password</a></li>
                <li><a href="#">Delete Account</a></li>
                <script>
                    console.log("<?=get_permalink($freelancer_id); ?>");
                    
                </script>
                <li><a href="<?php echo wp_logout_url(get_permalink(0))?>">Logout</a></li>
            </ul>
        </nav>
    </aside>
    <div class="dashboard-main">
        <div class="welcome-section">
            <p class="greeting">Hello, <?php echo get_the_title($employer_id)?></p>
            <h2>Welcome To Your Profile</h2>
        </div>
        <div class="stats-container">
            <div class="stat-box">
                <p>Ongoing Service</p>
                <p>2</p>
            </div>
            <div class="stat-box">
                <p>Completed</p>
                <p>4</p>
            </div>
            <div class="stat-box">
                <p>Total Services</p>
                <p>8</p>
            </div>
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
                        <?php echo get_the_title($employer_id)?>
                    </li>
                    <li>
                        user@gmail.com
                    </li>
                    <li>
                        123-456-7890
                    </li>
                    <li>
                        Florida City, FL, UK
                    </li>
                </ul>

            </div>
        </div>
    </div>
</div>

<style>
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
</style>