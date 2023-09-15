<?php
    get_header();
?>
<div class="px-4 py-5 text-center d-flex hero-section" style="background: url(<?php echo get_template_directory_uri() . '/img/Store-Hero.jpg'; ?>);">
    <img class="d-block mx-auto mb-4" src="<?php echo get_template_directory_uri() . '/img/Store-Logo.png'; ?>" alt="Hero Logo" width="200px">
    <h1 class="display-5 fw-bold text-white">Welcome to Our Store</h1>
    <div class="col-lg-6 mx-auto">
      <p class="lead mb-4 text-white">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla porta non nisi eget viverra. Nam eget risus neque. Nulla nisi mauris, suscipit sit amet porta quis, vestibulum non ipsum. In hac habitasse platea dictumst. Aenean feugiat pretium quam ac viverra. Integer iaculis tortor risus, at fermentum libero convallis vel.</p>
      <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
        <a href="./products"><button type="button" class="btn btn-primary btn-lg px-4 gap-3">Buy Now</button></a>
      </div>
    </div>
  </div>

<?php
  get_footer();
?>