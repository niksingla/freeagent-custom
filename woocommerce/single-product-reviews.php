<?php
/**
 * Display single product reviews (comments)
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product-reviews.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 4.3.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

if ( ! comments_open() ) {
	return;
}

$average_rate  = number_format( $product->get_average_rating(), 1 );
$display_rate  = $average_rate * 20;
$count         = $product->get_review_count();
?>
<div id="reviews" class="woocommerce-Reviews">


		<div id="review_form_wrapper" class="active">
        	<?php if ( get_option( 'woocommerce_review_rating_verification_required' ) === 'no' || wc_customer_bought_product( '', get_current_user_id(), $product->get_id() ) ) : ?>
			<div id="review_form">
				<?php
				$commenter    = wp_get_current_commenter();
				$comment_form = array(
					/* translators: %s is product title */
					'title_reply'         => have_comments() ? esc_html__( 'Write A Review', 'freeagent' ) : sprintf( esc_html__( 'Be the first to review &ldquo;%s&rdquo;', 'freeagent' ), get_the_title() ),
					/* translators: %s is product title */
					'title_reply_to'      => esc_html__( 'Leave a Reply to %s', 'freeagent' ),
					'title_reply_before'  => '<span id="reply-title" class="comment-reply-title">',
					'title_reply_after'   => '</span>',
					'comment_notes_after' => '',
					'label_submit'        => esc_html__( 'Submit review', 'freeagent' ),
					'logged_in_as'        => '',
					'comment_field'       => '',
                    'fields'               => array(
						'author' => '<div class="row"><p class="comment-form-author col-xl-6">' .
										'<label>'.esc_html__('Name *','freeagent').'</label><input id="author" class="field-simple" name="author" placeholder="'.esc_attr__('Your Name','freeagent').'" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" aria-required="true" /></p>',
						'email'  => '<p class="comment-form-email col-xl-6">' .
										'<label>'.esc_html__('Email *','freeagent').'</label><input id="email" class="field-simple" name="email" placeholder="'.esc_attr__('Email Address','freeagent').'" type="email" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" aria-required="true" /></p></div>',
					),
				);

				$name_email_required = (bool) get_option( 'require_name_email', 1 );

	

				$account_page_url = wc_get_page_permalink( 'myaccount' );
				if ( $account_page_url ) {
					/* translators: %s opening and closing link tags respectively */
					$comment_form['must_log_in'] = '<p class="must-log-in">' . sprintf( esc_html__( 'You must be %1$slogged in%2$s to post a review.', 'freeagent' ), '<a href="' . esc_url( $account_page_url ) . '">', '</a>' ) . '</p>';
				}

		

				$comment_form['comment_field'] .= '<p class="comment-form-comment"><label>'.esc_html__('Review','freeagent').'</label><textarea id="comment" placeholder="'.esc_attr__('Type your comment here...','freeagent').'" type="email" name="comment" cols="45" rows="8" required></textarea></p>';

				comment_form( apply_filters( 'woocommerce_product_review_comment_form_args', $comment_form ) );
				?>
			</div>
            <?php else : ?>
		          <p class="woocommerce-verification-required"><?php esc_html_e( 'Only logged in customers who have purchased this product may leave a review.', 'freeagent' ); ?></p>
        	<?php endif; ?>
		</div>

    	<div id="comments" class="active">
		<h2 class="woocommerce-Reviews-title">
			<?php
			$count = $product->get_review_count();
			if ( $count && wc_review_ratings_enabled() ) {
				/* translators: 1: reviews count 2: product name */
				$reviews_title = sprintf( esc_html( _n( '%1$s review for %2$s', '%1$s reviews for %2$s', $count, 'freeagent' ) ), esc_html( $count ), '<span>' . get_the_title() . '</span>' );
				echo apply_filters( 'woocommerce_reviews_title', $reviews_title, $count, $product ); // WPCS: XSS ok.
			} else {
				esc_html_e( 'Reviews', 'freeagent' );
			}
			?>
		</h2>

		<?php  if ( have_comments() ) : ?>
			<ol class="commentlist ct_ul_ol">
				<?php wp_list_comments( apply_filters( 'woocommerce_product_review_list_args', array( 'callback' => 'woocommerce_comments' ) ) ); ?>
			</ol>

			<?php
			if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
				echo '<nav class="jws-pagination-number">';
				paginate_comments_links(
					apply_filters(
						'woocommerce_comment_pagination_args',
						array(
							'prev_text' => '<i class="jws-icon-expand_right_double"></i>',
							'next_text' => '<i class="jws-icon-expand_right_double"></i>',
							'type'      => 'list',
						)
					)
				);
				echo '</nav>';
			endif;
			?>
		<?php else : ?>
			<div class="woocommerce-noreviews"><?php esc_html_e( 'There are no reviews yet.', 'freeagent' ); ?></div>
		<?php endif; ?>
	</div>

	<div class="clear"></div>
</div>