<?php
/**
 * Title: Site Chooser
 * Slug: charlottes-web/site-chooser
 * Categories: featured, charlottes-web
 * Description: Two-panel image layout letting visitors choose between Tech Expo and Food Summit.
 * Inserter: true
 */
?>
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|xx-large","bottom":"var:preset|spacing|xx-large"}}},"backgroundColor":"base","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull has-base-background-color has-background">

  <!-- wp:heading {"textAlign":"center","level":1,"fontSize":"xx-large","style":{"spacing":{"margin":{"bottom":"var:preset|spacing|large"}}}} -->
  <h1 class="wp-block-heading has-text-align-center has-xx-large-font-size">Choose Your Event</h1>
  <!-- /wp:heading -->

  <!-- wp:paragraph {"align":"center","textColor":"contrast-two","fontSize":"large","style":{"spacing":{"margin":{"bottom":"var:preset|spacing|x-large"}}}} -->
  <p class="has-text-align-center has-contrast-two-color has-text-color has-large-font-size">Two world-class events. One platform. Select your destination below.</p>
  <!-- /wp:paragraph -->

  <!-- wp:columns {"isStackedOnMobile":true,"align":"wide","style":{"spacing":{"blockGap":"var:preset|spacing|medium"}}} -->
  <div class="wp-block-columns alignwide">

    <!-- wp:column -->
    <div class="wp-block-column">
      <!-- wp:cover {"dimRatio":50,"overlayColor":"contrast","minHeight":520,"minHeightUnit":"px","isDark":true,"style":{"border":{"radius":"12px"},"spacing":{"padding":{"top":"var:preset|spacing|x-large","bottom":"var:preset|spacing|x-large","left":"var:preset|spacing|large","right":"var:preset|spacing|large"}}}} -->
      <div class="wp-block-cover is-dark" style="border-radius:12px;min-height:520px;padding-top:var(--wp--preset--spacing--x-large);padding-bottom:var(--wp--preset--spacing--x-large);padding-left:var(--wp--preset--spacing--large);padding-right:var(--wp--preset--spacing--large)">
        <span aria-hidden="true" class="wp-block-cover__background has-contrast-background-color has-background-dim-50 has-background-dim"></span>
        <div class="wp-block-cover__inner-container">
          <!-- wp:group {"layout":{"type":"flex","orientation":"vertical","justifyContent":"center","alignItems":"center"},"style":{"spacing":{"blockGap":"var:preset|spacing|medium"}}} -->
          <div class="wp-block-group">

            <!-- wp:heading {"level":2,"textAlign":"center","textColor":"base","fontSize":"x-large"} -->
            <h2 class="wp-block-heading has-text-align-center has-base-color has-text-color has-x-large-font-size">Tech Expo</h2>
            <!-- /wp:heading -->

            <!-- wp:paragraph {"align":"center","textColor":"base","fontSize":"medium"} -->
            <p class="has-text-align-center has-base-color has-text-color">The future of technology, innovation and digital transformation. Join industry leaders from across the globe.</p>
            <!-- /wp:paragraph -->

            <!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
            <div class="wp-block-buttons">
              <!-- wp:button {"backgroundColor":"primary","textColor":"base"} -->
              <div class="wp-block-button"><a class="wp-block-button__link has-primary-background-color has-base-color has-background has-text-color wp-element-button" href="/tech-expo">Visit Tech Expo →</a></div>
              <!-- /wp:button -->
            </div>
            <!-- /wp:buttons -->

          </div>
          <!-- /wp:group -->
        </div>
      </div>
      <!-- /wp:cover -->
    </div>
    <!-- /wp:column -->

    <!-- wp:column -->
    <div class="wp-block-column">
      <!-- wp:cover {"dimRatio":50,"overlayColor":"contrast","minHeight":520,"minHeightUnit":"px","isDark":true,"style":{"border":{"radius":"12px"},"spacing":{"padding":{"top":"var:preset|spacing|x-large","bottom":"var:preset|spacing|x-large","left":"var:preset|spacing|large","right":"var:preset|spacing|large"}}}} -->
      <div class="wp-block-cover is-dark" style="border-radius:12px;min-height:520px;padding-top:var(--wp--preset--spacing--x-large);padding-bottom:var(--wp--preset--spacing--x-large);padding-left:var(--wp--preset--spacing--large);padding-right:var(--wp--preset--spacing--large)">
        <span aria-hidden="true" class="wp-block-cover__background has-contrast-background-color has-background-dim-50 has-background-dim"></span>
        <div class="wp-block-cover__inner-container">
          <!-- wp:group {"layout":{"type":"flex","orientation":"vertical","justifyContent":"center","alignItems":"center"},"style":{"spacing":{"blockGap":"var:preset|spacing|medium"}}} -->
          <div class="wp-block-group">

            <!-- wp:heading {"level":2,"textAlign":"center","textColor":"base","fontSize":"x-large"} -->
            <h2 class="wp-block-heading has-text-align-center has-base-color has-text-color has-x-large-font-size">Food Summit</h2>
            <!-- /wp:heading -->

            <!-- wp:paragraph {"align":"center","textColor":"base","fontSize":"medium"} -->
            <p class="has-text-align-center has-base-color has-text-color">Celebrating food culture, sustainability and the future of global gastronomy. Taste what's next.</p>
            <!-- /wp:paragraph -->

            <!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
            <div class="wp-block-buttons">
              <!-- wp:button {"backgroundColor":"secondary","textColor":"base"} -->
              <div class="wp-block-button"><a class="wp-block-button__link has-secondary-background-color has-base-color has-background has-text-color wp-element-button" href="/food-summit">Visit Food Summit →</a></div>
              <!-- /wp:button -->
            </div>
            <!-- /wp:buttons -->

          </div>
          <!-- /wp:group -->
        </div>
      </div>
      <!-- /wp:cover -->
    </div>
    <!-- /wp:column -->

  </div>
  <!-- /wp:columns -->

</div>
<!-- /wp:group -->