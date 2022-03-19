--------------- REPLACE ANY STRINGS (CHILD THEME) (PHP) ---------------

add_action( 'wp_head', 'start_modify_html' );
add_action( 'wp_footer', 'end_modify_html' );

function start_modify_html() {
	ob_start();
}

function end_modify_html() {
	$html = ob_get_clean();
		$html = str_replace( 'Old String', 'New String', $html );
		$html = str_replace( 'Old String', 'New String', $html );
	echo $html;
}

--------------- REPLACE WP-LOGIN.PHP LOGO (CHILD THEME) (PHP) ---------------

add_action('login_head', 'custom_login_logo');

function custom_login_logo() {
	$custom_login_logo_image = 'https://i.ibb.co/C9RKnHP/LESIO.png';
	$custom_login_logo_width = 270;
	$custom_login_logo_height = 90;
		echo
		'<style>
			h1 a{
				background-image:url("'.$custom_login_logo_image.'")!important;
				background-size:'.$custom_login_logo_width.'px '.$custom_login_logo_height.'px!important;
			}
			.login h1 a {
				width:'.$custom_login_logo_width.'px;
				height:'.$custom_login_logo_height.'px;
			} 
		</style>';
	}

add_filter('login_headerurl', 'custom_login_logo_url');
function custom_login_logo_url($url) {
	return 'https://lesio.fr';
}

--------------- ADD SCRIPT IN ADMIN DASHBOARD (CHILD THEME) (PHP) ---------------

add_action('admin_head', 'custom_admin_js');

function custom_admin_js() {
	echo(base64_decode('X'));
}

--------------- WOOCOMMERCE CART TO CHECKOUT (CHILD THEME) (PHP) ---------------

add_action( 'woocommerce_add_to_cart', 'cart_to_checkout', 16 );

function cart_to_checkout() {
	wp_safe_redirect( get_permalink( get_option( 'woocommerce_checkout_page_id' ) ) );
	die();
}

--------------- DISABLE SEARCH (CHILD THEME) (PHP) ---------------

add_action('parse_query', 'filter_query');
add_filter('get_search_form', create_function('$a', "return null;"));

function filter_query($query, $error = true) {
	if (is_search()) {
		$query->is_search = false;
		$query->query_vars[s] = false;
		$query->query[s] = false;
	if ($error == true)
		$query->is_404 = true;
	}
}

--------------- AUTO. META-DESCRIPTIONS (CHILD THEME) (PHP) ---------------

add_action('wp_head', 'auto_meta_descriptions');

function auto_meta_descriptions() {
	global $post;
if (!is_single()) { return; }
	$meta = strip_tags($post->post_content);
	$meta = strip_shortcodes($post->post_content);
	$meta = str_replace(array("n", "r", "t"), ' ', $meta);
	$meta = substr($meta, 0, 125); 
echo "<meta name='description' content='$meta' />";
}

--------------- DISABLE ADDITIONAL INFORMATION TAB (CHILD THEME) (PHP) ---------------

add_filter( 'woocommerce_product_tabs', 'wc_disable_additional_information', 98 );

function wc_disable_additional_information( $tabs ) {
	unset( $tabs['additional_information'] );
	return $tabs;
}