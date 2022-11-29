<?php
/**
 * Thankyou page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/thankyou.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.7.0
 */

defined( 'ABSPATH' ) || exit;
?>

<div class="woocommerce-order">



	<?php
	if ( $order ) :

		do_action( 'woocommerce_before_thankyou', $order->get_id() );
		?>

		<?php if ( $order->has_status( 'failed' ) ) : ?>

			<p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed"><?php esc_html_e( 'Unfortunately your order cannot be processed as the originating bank/merchant has declined your transaction. Please attempt your purchase again.', 'woocommerce' ); ?></p>

			<p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed-actions">
				<a href="<?php echo esc_url( $order->get_checkout_payment_url() ); ?>" class="button pay"><?php esc_html_e( 'Pay', 'woocommerce' ); ?></a>
				<?php if ( is_user_logged_in() ) : ?>
					<a href="<?php echo esc_url( wc_get_page_permalink( 'myaccount' ) ); ?>" class="button pay"><?php esc_html_e( 'My account', 'woocommerce' ); ?></a>
				<?php endif; ?>
			</p>

		<?php else : ?>

			<div class="row innserThankyouSucesss">

				<div class="leftSection col-md-12 col-lg-7 animate__animated animate__fast animate__fadeIn">

					<div class="sectionContainer">


					<section class="innerSectionElement sct1">

				<div class="containElements line_separator_section">

						<div class="iconSection">

						<i class="las la-check-circle"></i>

						</div>

						<div class="info">

							<small>
								Order #<?php echo $order->get_order_number(); ?> - Created at <?php echo wc_format_datetime( $order->get_date_created() ); ?>
							</small>
							<h4>
								Thank you. <?php echo $order->get_billing_first_name(); ?>
							</h4>
						</div>

					</div>

				</section>

				<section class="innerSectionElement sct2">

					<div class="containElements">

						<h1>
						Order placed and on its way!
						</h1>

						<p class="text">
						Thank you for your purchase! All the details for your <strong>order status, tracking, and estimated delivery time</strong> have been sent to your email. Here at Sebenasmart, impeccable customer service is what makes us different 😉 feel free to contact us for any inquiries.
						</p>

					</div>

				</section>
			</div>

		</div>

		<div class="rightSection col-md-12 col-lg-5 animate__animated animate__fast animate__fadeIn">

				<?php do_action( 'woocommerce_thankyou_' . $order->get_payment_method(), $order->get_id() ); ?>
				<?php do_action( 'woocommerce_thankyou', $order->get_id() ); ?>

		</div>

		</div>

		<div class="row thanksGod ">

			<div class="blockMessage animate__animated animate__delay-1s yellow_color">

				<div class="sectionContainer containElements">

					<div class="imageContainer">
					<!-- book_reference_stick.png -->
					<img src="<?php echo get_stylesheet_directory_uri() . '/resources/assets/images/icons/book_reference_stick.png' ?>" alt="">
					</div>

					<p class="text">
						I will bless Israel's people, like rain that falls on dry ground. They will grow like beautiful flowers. They will have strong roots, like the great trees in Lebanon. They will grow like a tree that makes new branches. They will be beautiful like olive trees. They will have a sweet smell, like the forests in Lebanon. I will give my people shade to live in safely. They will plant crops that give them plenty of food. They will be successful, like a vine that gives many grapes. They will be famous, like the wine from Lebanon.
					</p>
					<h3 class="byMessage">
						Hosea
						<small>
							14:5-7
						</small>
					</h3>

				</div>

			</div>

		</div>


		<?php endif; ?>



	<?php else : ?>

		<p class="woocommerce-notice woocommerce-notice--success woocommerce-thankyou-order-received"><?php echo apply_filters( 'woocommerce_thankyou_order_received_text', esc_html__( 'Thank you. Your order has been received.', 'woocommerce' ), null ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>

	<?php endif; ?>

</div>
