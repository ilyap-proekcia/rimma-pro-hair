<?php
/* Fallback template. Лендинг використовує front-page.php. */
get_header();
?>
<main style="padding:80px 40px;text-align:center;color:#fff;">
  <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    <h1><?php the_title(); ?></h1>
    <?php the_content(); ?>
  <?php endwhile; endif; ?>
</main>
<?php get_footer(); ?>
