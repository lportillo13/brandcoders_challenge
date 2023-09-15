<?php
get_header();

while (have_posts()) :
    the_post();
    
    $price = get_post_meta(get_the_ID(), '_product_price', true);
    $description = get_post_meta(get_the_ID(), '_product_description', true);
    $categories = get_the_terms(get_the_ID(), 'product_category'); 
?>

<div class="container single-post-page">
    <div class="py-lg-3 py-2 px-lg-3">
        <div class="row gy-4">
          <!-- Product image-->
          <div class="col-lg-6">
            <div class="featured-image">
                <?php the_post_thumbnail('full');?>
            </div>
          </div>
          <!-- Product details-->
          <div class="col-lg-6">
            <div class="ps-xl-5 ps-lg-3">
                <p class="title-product"><?php the_title(); ?></p>
                <p class="product-category text-capitalize"> 
                    <?php
                    foreach ($categories as $category) {
                        echo esc_html($category->name);
                        if ($category !== end($categories)) {
                            echo ', ';
                        }
                    }
                    ?>
                </p>
              <div class="align-items-center flex-wrap mb-sm-4 mb-3 fs-sm">
                <p><?php echo esc_html($description); ?></p>
                <p><strong>Price:</strong> $<?php echo esc_html($price); ?></p>
                <p><button class="btn btn-primary d-inline-flex align-items-center" type="button">Buy Now</button></p>
              </div>
            </div>
          </div>
        </div>
    </div>
</div>
<?php endwhile;
 get_footer(); ?>