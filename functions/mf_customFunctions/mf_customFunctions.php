

<?php


 	function martfury_extra_cart() {
		$extras = martfury_menu_extras();

		if ( empty( $extras ) || ! in_array( 'cart', $extras ) ) {
			return '';
		}

		if ( ! function_exists( 'woocommerce_mini_cart' ) ) {
			return '';
		}
		global $woocommerce;
		ob_start();
		woocommerce_mini_cart();
		$mini_cart = ob_get_clean();

		$mini_content = sprintf( '	<div class="widget_shopping_cart_content">%s</div>', $mini_cart );

		printf(
			'<li class="extra-menu-item menu-item-cart mini-cart woocommerce">
				<a class="cart-contents" id="icon-cart-contents" href="%s">
					<i class="las la-shopping-cart extra-icon"></i>
					<span class="mini-item-counter mf-background-primary">
						%s
					</span>
				</a>
				<div class="mini-cart-content">
				<span class="tl-arrow-menu"></span>
				%s
				</div>
			</li>',
			esc_url( wc_get_cart_url() ),
			intval( $woocommerce->cart->cart_contents_count ),
			$mini_content
		);

	}


	/**
 * Get Menu extra Account
 *
 * @since  1.0.0
 *
 * @return string
 */
	function martfury_extra_account() {
		$extras = martfury_menu_extras();

		if ( empty( $extras ) || ! in_array( 'account', $extras ) ) {
			return;
		}

		if ( is_user_logged_in() ) {
			$user_menu = martfury_nav_vendor_menu();
			$user_id   = get_current_user_id();
			if ( empty( $user_menu ) ) {
				$user_menu = martfury_nav_user_menu();
			}
			$account = get_permalink( get_option( 'woocommerce_myaccount_page_id' ) );
			if ( ! empty( martfury_get_option( 'user_logged_link' ) ) ) {
				$account_link = martfury_get_option( 'user_logged_link' );

			} else {
				$account_link = $account;
			}
			$author      = get_user_by( 'id', $user_id );
			$author_name = $author->display_name;

			$logged_type = '<i class="las la-user extra-icon"></i>';
			$user_type   = 'icon';
			if ( martfury_get_option( 'user_logged_type' ) == 'avatar' ) {
				$logged_type = get_avatar( $user_id, 32 );
				$user_type   = 'avatar';
			}


			if ( class_exists( 'WeDevs_Dokan' ) && in_array( 'seller', $author->roles ) ) {
				if ( ! empty( martfury_get_option( 'vendor_logged_link' ) ) ) {
					$account_link = martfury_get_option( 'vendor_logged_link' );
				} else {
					$account_link = function_exists( 'dokan_get_navigation_url' ) ? dokan_get_navigation_url() : $account_link;
				}
				$shop_info    = get_user_meta( $user_id, 'dokan_profile_settings', true );
				if ( $shop_info && isset( $shop_info['store_name'] ) && $shop_info['store_name'] ) {
					$author_name = $shop_info['store_name'];
				}
			} elseif ( class_exists( 'WCVendors_Pro' ) && in_array( 'vendor', $author->roles ) ) {

				if ( ! empty( martfury_get_option( 'vendor_logged_link' ) ) ) {
					$account_link = martfury_get_option( 'vendor_logged_link' );
				} else {
					$dashboard_page_id = get_option( 'wcvendors_dashboard_page_id' );
					$dashboard_page_id = is_array( $dashboard_page_id ) ? $dashboard_page_id[0] : $dashboard_page_id;
					if ( $dashboard_page_id ) {
						$account_link = get_permalink( $dashboard_page_id );
					}
                }

			} elseif ( class_exists( 'WC_Vendors' ) && in_array( 'vendor', $author->roles ) ) {

				if ( ! empty( martfury_get_option( 'vendor_logged_link' ) ) ) {
					$account_link = martfury_get_option( 'vendor_logged_link' );
				} else {
					$vendor_dashboard_page = get_option( 'wcvendors_vendor_dashboard_page_id' );
					$account_link          = get_permalink( $vendor_dashboard_page );
                }


			} elseif ( class_exists( 'WCMp' ) && in_array( 'dc_vendor', $author->roles ) ) {
				if ( ! empty( martfury_get_option( 'vendor_logged_link' ) ) ) {
					$account_link = martfury_get_option( 'vendor_logged_link' );
				} else {
					if ( function_exists( 'wcmp_vendor_dashboard_page_id' ) && wcmp_vendor_dashboard_page_id() ) {
						$account_link = get_permalink( wcmp_vendor_dashboard_page_id() );
					}
                }

				if ( function_exists( 'get_wcmp_vendor' ) ) {
					$store_user  = get_wcmp_vendor( $user_id );
					$author_name = $store_user->page_title;
				}
			} elseif ( function_exists( 'wcfm_is_vendor' ) && wcfm_is_vendor() ) {
				if ( ! empty( martfury_get_option( 'vendor_logged_link' ) ) ) {
					$account_link = martfury_get_option( 'vendor_logged_link' );
				} else {
					$pages = get_option( "wcfm_page_options" );
					if ( isset( $pages['wc_frontend_manager_page_id'] ) && $pages['wc_frontend_manager_page_id'] ) {
						$account_link = get_permalink( $pages['wc_frontend_manager_page_id'] );
					}
                }

				global $WCFM;
				$author_name = $WCFM->wcfm_vendor_support->wcfm_get_vendor_store_name_by_vendor( absint( $user_id ) );

				if ( function_exists( 'wcfmmp_get_store' ) && martfury_get_option( 'user_logged_type' ) == 'avatar' ) {
					$store_user  = wcfmmp_get_store( $user_id );
					$logged_type = sprintf( '<img src="%s" alt="%s">', esc_url( $store_user->get_avatar() ), esc_html__( 'Logo', 'martfury' ) );
				}

			}



			echo sprintf(
				'<li class="extra-menu-item menu-item-account logined %s">
				<a href="%s">%s</a>
				<ul>
					<li>
						<h3>%s</h3>
					</li>
					<li>
						%s
					</li>
					<li class="line-space"></li>
					<li class="logout">
						<a href="%s">%s</a>
					</li>
				</ul>
			</li>',
				esc_attr( $user_type ),
				esc_url( $account_link ),
				$logged_type,
				esc_html__( 'Hello,', 'martfury' ) . ' ' . $author_name . '!',
				implode( ' ', $user_menu ),
				esc_url( wp_logout_url( $account ) ),
				esc_html__( 'Logout', 'martfury' )
			);
		} else {

			$register      = '';
			$register_text = esc_html__( 'Register', 'martfury' );

			if ( get_option( 'woocommerce_enable_myaccount_registration' ) === 'yes' ) {
				$register = sprintf(
					'<a href="%s" class="item-register" id="menu-extra-register">%s</a>',
					esc_url( get_permalink( get_option( 'woocommerce_myaccount_page_id' ) ) ),
					$register_text
				);
			}

			echo sprintf(
				'<li class="extra-menu-item menu-item-account">
					<a href="%s" id="menu-extra-login"><i class="las la-user extra-icon"></i><span class="login-text">%s</span></a>
					%s
				</li>',
				esc_url( get_permalink( get_option( 'woocommerce_myaccount_page_id' ) ) ),
				esc_html__( 'Log in', 'martfury' ),
				$register
			);
		}


	}

	function martfury_extra_wislist() {
		$extras = martfury_menu_extras();

		if ( empty( $extras ) || ! in_array( 'wishlist', $extras ) ) {
			return '';
		}

		if ( ! function_exists( 'YITH_WCWL' ) ) {
			return '';
		}

		$count = YITH_WCWL()->count_products();

		printf(
			'<li class="extra-menu-item menu-item-wishlist menu-item-yith">
			<a class="yith-contents" id="icon-wishlist-contents" href="%s">
				<i class="lar la-heart extra-icon" rel="tooltip"></i>

				<span class="mini-item-counter mf-background-primary">
					%s
				</span>
			</a>
		</li>',
			esc_url( get_permalink( get_option( 'yith_wcwl_wishlist_page_id' ) ) ),
			intval( $count )
		);

	}

	function cartFloatSide(){

		echo '<i class="las la-shopping-cart"></i>';

	}
	add_action('xoo_wsc_basket_content', 'cartFloatSide');

	function terms_side_cart(){

		echo '<p class="sideText">
			Lorem ipsum dolor, sit amet consectetur adipisicing elit. Harum iusto iste eum quidem sit? Illum, perspiciatis, laboriosam ipsa minima saepe, maiores sint perferendis vero natus error quasi aspernatur minus. Impedit?
		</p>';

	}
	add_action('xoo_wsc_footer_end', 'terms_side_cart');


	function martfury_header_bar() {
		// if ( ! intval( martfury_get_option( 'header_bar' ) ) ) {
		// 	return;
		// }

		?>
        <div class="header-bar topbar">
			<?php
			$sidebar = 'primary';
			dynamic_sidebar( $sidebar );
			if ( is_active_sidebar( $sidebar ) ) {
			}
			?>
        </div>
		<?php
	}

?>