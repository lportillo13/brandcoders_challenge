<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="format-detection" content="telephone=no">

<title><?php wp_title( '', true, 'right' ); ?></title>

<?php
    wp_head();
?>
</head>

<body>
<div class="container">
    <header class="d-flex flex-wrap justify-content-center py-3 border-bottom">
        <a href="<?php echo home_url(); ?>" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
            <img src="<?php echo get_template_directory_uri() . '/img/Store-Logo.png'; ?>" width="200px" alt="Header Logo"/>
        </a>
        <ul class="nav nav-pills">
            <li class="nav-item"><a href="<?php echo home_url(); ?>" class="nav-link">Home</a></li>
            <li class="nav-item"><a href="<?php echo home_url('/products/'); ?>" class="nav-link">Products</a></li>
        </ul>
    </header>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var currentUrl = window.location.href;
        var productsLink = document.querySelector('.nav-link[href="<?php echo home_url('/products/'); ?>"]');
        var homeLink = document.querySelector('.nav-link[href="<?php echo home_url(); ?>"]');

        if (currentUrl.indexOf(productsLink.getAttribute('href')) !== -1) {
            productsLink.classList.add('active');
            homeLink.classList.remove('active'); 
        } else {
            productsLink.classList.remove('active'); 
            if (currentUrl === "<?php echo home_url(); ?>") {
                homeLink.classList.add('active'); // 
            }
        }
    });
</script>