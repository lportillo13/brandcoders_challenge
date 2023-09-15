<?php
function enqueue_custom_styles() {
  wp_enqueue_style('custom-style', get_template_directory_uri() . '/css/style.css');
  wp_enqueue_style('bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css');

  wp_enqueue_script('jquery');
  wp_enqueue_script( 'custom', get_stylesheet_directory_uri().'/custom.js');
  wp_enqueue_script('bootstrap-js', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'), null, true);
}
add_action('wp_enqueue_scripts', 'enqueue_custom_styles');

require_once get_template_directory() . '/custom-functions.php';

add_theme_support( 'post-thumbnails' );

function create_custom_post_type() {
    register_post_type('products',
        array(
            'labels' => array(
                'name' => __('Products'),
                'singular_name' => __('Product'),
            ),
            'public' => true,
            'has_archive' => true,
            'menu_icon' => 'dashicons-cart',
            'supports' => array('title', 'editor', 'thumbnail', 'custom-fields'),
        )
    );
}
add_action('init', 'create_custom_post_type');

function add_custom_fields() {
    add_meta_box('product_price', 'Price', 'product_price_callback', 'products', 'normal', 'default');
    add_meta_box('product_description', 'Description', 'product_description_callback', 'products', 'normal', 'default');
}
add_action('add_meta_boxes', 'add_custom_fields');

function product_price_callback($post) {
    $price = get_post_meta($post->ID, '_product_price', true);
    echo '<input type="text" name="product_price" value="' . esc_attr($price) . '" />';
}

function product_description_callback($post) {
    $description = get_post_meta($post->ID, '_product_description', true);
    echo '<textarea name="product_description">' . esc_textarea($description) . '</textarea>';
}

function save_custom_fields($post_id) {
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;

    if (isset($_POST['product_price'])) {
        update_post_meta($post_id, '_product_price', sanitize_text_field($_POST['product_price']));
    }
    
    if (isset($_POST['product_description'])) {
        update_post_meta($post_id, '_product_description', sanitize_text_field($_POST['product_description']));
    }
}
add_action('save_post', 'save_custom_fields');

function create_custom_taxonomy() {
    register_taxonomy(
        'product_category',
        'products',
        array(
            'label' => __('Product Categories'),
            'hierarchical' => true,
            'rewrite' => array('slug' => 'product-category'),
        )
    );
}
add_action('init', 'create_custom_taxonomy');

function add_favicon_to_wp_head() {
    $favicon_url = get_template_directory_uri() . '/img/Store-Icon.png';
    echo '<link rel="icon" href="' . esc_url($favicon_url) . '" type="image/x-icon" />';
}
add_action('wp_head', 'add_favicon_to_wp_head');
?>