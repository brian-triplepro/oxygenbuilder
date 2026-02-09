//**** Image fix for when images are not showing ****//

add_action('after_setup_theme', function () {
	add_theme_support('woocommerce');
	add_theme_support('wc-product-gallery-zoom');
	add_theme_support('wc-product-gallery-lightbox');
	add_theme_support('wc-product-gallery-slider');
});

add_action('wp_enqueue_scripts', function () {
	if (!function_exists('is_product') || !is_product()) {
		return;
}

wp_enqueue_script('jquery');

if (!wp_script_is('photoswipe', 'registered')) {
if (function_exists('WC') && WC()) {
$base = trailingslashit(WC()->plugin_url());
wp_register_script('photoswipe', $base . 'assets/js/photoswipe/photoswipe.min.js', [], WC_VERSION, true);
wp_register_script('photoswipe-ui-default', $base . 'assets/js/photoswipe/photoswipe-ui-default.min.js', ['photoswipe'], WC_VERSION, true);
}
}
if (!wp_style_is('photoswipe', 'registered')) {
	if (function_exists('WC') && WC()) {
		$base = trailingslashit(WC()->plugin_url());
		wp_register_style('photoswipe', $base . 'assets/css/photoswipe/photoswipe.min.css', [], WC_VERSION);
		wp_register_style('photoswipe-default-skin', $base . 'assets/css/photoswipe/default-skin/default-skin.min.css', ['photoswipe'], WC_VERSION);
	}
}

wp_enqueue_script('photoswipe');
wp_enqueue_script('photoswipe-ui-default');
wp_enqueue_style('photoswipe');
wp_enqueue_style('photoswipe-default-skin');

if (!wp_script_is('wc-single-product', 'registered')) {
	if (function_exists('WC') && WC()) {
		$base = trailingslashit(WC()->plugin_url());
		$deps = ['jquery', 'photoswipe', 'photoswipe-ui-default'];
		wp_register_script('wc-single-product', $base . 'assets/js/frontend/single-product.min.js', $deps, WC_VERSION, true);
	}
}

wp_enqueue_script('wc-single-product');
}, 99); 
add_action('wp_print_scripts', function () {
	if (function_exists('is_product') && is_product() && !wp_script_is('wc-single-product', 'enqueued')) {
		wp_enqueue_script('wc-single-product');
	}
}, 1);

/// ******  end of fix *****///
