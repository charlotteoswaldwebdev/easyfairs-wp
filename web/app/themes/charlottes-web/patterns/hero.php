<?php
/**
 * Title: Hero Section
 * Slug: charlottes-web/hero
 * Categories: featured, easyfairs
 * Description: Full-width hero with headline, subheading, and primary CTA.
 * Inserter: true
 */
?>
<!-- wp:cover {"dimRatio":70,"overlayColor":"contrast","minHeight":600,"minHeightUnit":"px","isDark":true,"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|xx-large","bottom":"var:preset|spacing|xx-large"}}}} -->
<div class="wp-block-cover alignfull is-dark" style="min-height:600px;padding-top:var(--wp--preset--spacing--xx-large);padding-bottom:var(--wp--preset--spacing--xx-large)">
  <span aria-hidden="true" class="wp-block-cover__background has-contrast-background-color has-background-dim-70 has-background-dim"></span>
  <div class="wp-block-cover__inner-container">
    <!-- wp:group {"layout":{"type":"constrained","contentSize":"800px"},"style":{"spacing":{"blockGap":"var:preset|spacing|medium"}}} -->
    <div class="wp-block-group">

      <!-- wp:heading {"level":1,"textAlign":"center","textColor":"base","fontSize":"huge"} -->
      <h1 class="wp-block-heading has-text-align-center has-base-color has-text-color has-huge-font-size">Welcome to the Future of Events</h1>
      <!-- /wp:heading -->

      <!-- wp:paragraph {"align":"center","textColor":"base","fontSize":"large"} -->
      <p class="has-text-align-center has-base-color has-text-color has-large-font-size">Where ideas meet innovation. Join thousands of industry leaders at the most anticipated events of the year.</p>
      <!-- /wp:paragraph -->

      <!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"},"style":{"spacing":{"margin":{"top":"var:preset|spacing|medium"}}}} -->
      <div class="wp-block-buttons">
        <!-- wp:button {"backgroundColor":"primary","textColor":"base"} -->
        <div class="wp-block-button"><a class="wp-block-button__link has-primary-background-color has-base-color has-background has-text-color wp-element-button">Explore Events</a></div>
        <!-- /wp:button -->
      </div>
      <!-- /wp:buttons -->

    </div>
    <!-- /wp:group -->
  </div>
</div>
<!-- /wp:cover -->