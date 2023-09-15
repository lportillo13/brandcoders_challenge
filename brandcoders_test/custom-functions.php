<?php 
function add_custom_menu_page() {
    add_menu_page(
        'Generate Theme Info',     
        'Generate Theme Info',              
        'manage_options',             
        'generate-specific-post',     
        'generate_specific_post_page',
        'dashicons-admin-generic',    
        80                            
    );
}

add_action('admin_menu', 'add_custom_menu_page');

function generate_specific_post_page() {
if (isset($_POST['generate_products'])) {
    $products = array(
        array(
            'title' => 'Headphones',
            'price' => '100',
            'category' => 'Electronics',
            'image' => 'img/headphone.jpg',
        ),
        array(
            'title' => 'Computer',
            'price' => '1000',
            'category' => 'Electronics',
            'image' => 'img/computer.jpg',
        ),
        array(
            'title' => 'Cellphone',
            'price' => '800',
            'category' => 'Electronics',
            'image' => 'img/cellphone.jpg',
        ),
        array(
            'title' => 'Camera',
            'price' => '1200',
            'category' => 'Electronics',
            'image' => 'img/camera.jpg',
        ),
        array(
            'title' => 'T-Shirt',
            'price' => '20',
            'category' => 'Clothing',
            'image' => 'img/tshirt.jpg',
        ),
        array(
            'title' => 'Mario Bros',
            'price' => '30',
            'category' => 'Toys',
            'image' => 'img/toys.jpg',
        ),
        array(
            'title' => 'Animals',
            'price' => '20',
            'category' => 'Toys',
            'image' => 'img/animals.jpg',
        ),
    );

    foreach ($products as $product_data) {
        $product_title = $product_data['title'];
        $product_price = $product_data['price'];
        $product_category = $product_data['category'];
        $product_image = $product_data['image'];
        $product_description = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent at laoreet eros. Maecenas at orci pharetra, gravida dui vel, euismod augue. Suspendisse non tempus est, eu mattis augue. Etiam cursus nisl at massa suscipit, eget auctor quam dignissim. Duis sed lacus eu nisl condimentum luctus at vitae ex.';
        $product_author_id = 1; 

        $new_product = array(
            'post_title'   => $product_title,
            'post_content' => '',
            'post_author'  => $product_author_id,
            'post_status'  => 'publish',
            'post_type'    => 'products', 
        );

        $product_id = wp_insert_post($new_product);

        if ($product_id) {
            update_post_meta($product_id, '_product_price', $product_price);
            update_post_meta($product_id, '_product_description', $product_description);

            $term_slug = sanitize_title($product_category);
            $taxonomy = 'product_category';
            wp_set_object_terms($product_id, $term_slug, $taxonomy);

            $image_path = get_template_directory() . '/' . $product_image;

            if (file_exists($image_path)) {
                $image_id = upload_image_and_set_as_featured($image_path, $product_id);

                if ($image_id) {
                    echo '<div class="updated"><p>Product "' . $product_title . '" generated successfully with a featured image!</p></div>';
                } else {
                    echo '<div class="error"><p>Error adding the featured image for Product "' . $product_title . '".</p></div>';
                }
            } else {
                echo '<div class="error"><p>Image file does not exist for Product "' . $product_title . '".</p></div>';
            }
        } else {
            echo '<div class="error"><p>Error generating Product "' . $product_title . '".</p></div>';
        }
    }
}
?>
    <div class="wrap">
        <h2>Generate Products</h2>
        <form method="post">
            <p>
                <input type="submit" name="generate_products" class="button button-primary" value="Generate Theme Info">
            </p>
        </form>
    </div>
    <?php
}

function upload_image_and_set_as_featured($image_path, $post_id) {
    if (file_exists($image_path)) {
        $image_filename = basename($image_path);
        $upload = wp_upload_bits($image_filename, null, file_get_contents($image_path));

        if (!empty($upload['error'])) {
            return false; 
        }

        $file_path = $upload['file'];
        $file_name = basename($file_path);

        $attachment = array(
            'post_mime_type' => $upload['type'],
            'post_title'     => sanitize_file_name($file_name),
            'post_content'   => '',
            'post_status'    => 'inherit',
        );

        $attachment_id = wp_insert_attachment($attachment, $file_path, $post_id);

        if (!is_wp_error($attachment_id)) {
            require_once ABSPATH . 'wp-admin/includes/image.php';
            $attachment_data = wp_generate_attachment_metadata($attachment_id, $file_path);
            wp_update_attachment_metadata($attachment_id, $attachment_data);
            set_post_thumbnail($post_id, $attachment_id);

            return $attachment_id;
        }
    }

    return false;
}

?>