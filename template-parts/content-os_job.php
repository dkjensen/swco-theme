<?php

$categories = wp_get_post_terms( get_the_ID(), 'os_job_cat' );

$category = ! empty( $categories ) ? $categories[0]->slug : '';

?>

<div <?php post_class( 'job-listing ' . $category ); ?>>
    <div class="job-listing-logo">
        <?php if( ! empty( $logo = get_post_meta( get_the_ID(), '_job_logo', true ) ) ) : ?>

        <a href="<?php print get_permalink(); ?>"><img src="<?php print esc_url( $logo ); ?>" alt="<?php the_title(); ?>" class="job-logo-img" /></a>

        <?php endif; ?>
    </div>
    <div class="job-listing-meta">
        <h2 class="h4"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
        <span class="job-meta job-meta-organization"><?php print get_post_meta( get_the_ID(), '_job_organization_name', true ); ?></span>
        <span class="job-meta job-meta-location">
            <span class="dashicons dashicons-location"></span>
            <?php print get_post_meta( get_the_ID(), '_job_location', true ); ?>
        </span>
    </div>
</div>