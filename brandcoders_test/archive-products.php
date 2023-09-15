<?php get_header();

$args = array(
    'post_type' => 'products', // Replace with your custom post type name
    'posts_per_page' => -1,   // Display all products; you can change this value
);

$products_query = new WP_Query($args); 

$args_latest = array(
    'post_type' => 'products', // Replace with your custom post type name
    'posts_per_page' => 3, // To show the latest 3 products
    'order' => 'DESC',
);

$products_latest_query = new WP_Query($args_latest); ?>

<div class="container archive-section">
    <p class="section-title">All Products</p>
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
    <?php if ($products_query->have_posts()) :
        while ($products_query->have_posts()) :
            $products_query->the_post();

            // Get custom field values
            $price = get_post_meta(get_the_ID(), '_product_price', true);
            $description = get_post_meta(get_the_ID(), '_product_description', true);
            $featured_image_id = get_post_meta(get_the_ID(), '_product_featured_image', true);
            $featured_image = wp_get_attachment_image($featured_image_id, 'thumbnail');
            $categories = get_the_terms(get_the_ID(), 'product_category'); 
            $post_permalink = get_permalink();
            ?>

            <div class="col">
              <div class="card shadow-sm">
                <?php if (has_post_thumbnail()) : ?>
                    <div class="featured-image">
                        <?php the_post_thumbnail('medium'); // You can specify image size here ?>
                    </div>
                <?php endif; ?>
                <div class="card-body">
                    <p class="title-product"><?php the_title(); ?></p>
                    <?php if ($price) : ?>
                        <p>Price: $<?php echo esc_html($price); ?></p>
                    <?php endif; ?>             
                    <?php if ($description) : ?>
                        <p>Description: <?php echo esc_html($description); ?></p>
                    <?php endif; ?>
                    <?php if ($categories) : ?>
                        <p class="product-category text-capitalize">Category: 
                            <?php
                            foreach ($categories as $category) {
                                echo esc_html($category->name);
                                if ($category !== end($categories)) {
                                    echo ', ';
                                }
                            }
                            ?>
                        </p>
                    <?php endif; ?><br>
                    <a href="<?php echo esc_url($post_permalink) ?>">
                        <button class="btn btn-primary d-inline-flex align-items-center" type="button">More Info</button>
                   </a>
                </div>
              </div>         
            </div>      

        <?php endwhile;
        wp_reset_postdata();
    else :
        echo 'No products found.';
    endif; ?>
    </div>  
    <br>
    <p class="section-title">Latest Products</p>
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
    <?php if ($products_latest_query->have_posts()) :
        while ($products_latest_query->have_posts()) :
            $products_latest_query->the_post();

            $price = get_post_meta(get_the_ID(), '_product_price', true);
            $description = get_post_meta(get_the_ID(), '_product_description', true);
            $featured_image_id = get_post_meta(get_the_ID(), '_product_featured_image', true);
            $featured_image = wp_get_attachment_image($featured_image_id, 'thumbnail');
            $categories = get_the_terms(get_the_ID(), 'product_category'); 
            $post_permalink = get_permalink();
            ?>


            <div class="col">
              <div class="card shadow-sm">
                <?php if (has_post_thumbnail()) : ?>
                    <div class="featured-image">
                        <?php the_post_thumbnail('medium'); // You can specify image size here ?>
                    </div>
                <?php endif; ?>
                <div class="card-body">
                    <p class="title-product"><?php the_title(); ?></p>
                    <?php if ($price) : ?>
                        <p>Price: $<?php echo esc_html($price); ?></p>
                    <?php endif; ?>             
                    <?php if ($description) : ?>
                        <p>Description: <?php echo esc_html($description); ?></p>
                    <?php endif; ?>
                    <?php if ($categories) : ?>
                        <p class="product-category">Category: 
                            <?php
                            foreach ($categories as $category) {
                                echo esc_html($category->name);
                                if ($category !== end($categories)) {
                                    echo ', ';
                                }
                            }
                            ?>
                        </p>
                    <?php endif; ?><br>
                    <a href="<?php echo esc_url($post_permalink) ?>">
                        <button class="btn btn-primary d-inline-flex align-items-center" type="button">More Info</button>
                   </a>
                </div>
              </div>         
            </div>      

        <?php endwhile;
        wp_reset_postdata();
    else :
        echo 'No products found.';
    endif; ?>
    </div> 
</div> 

<?php get_footer(); ?>