<?php

$categories = wp_get_post_terms( get_the_ID(), 'sstory_cat' );

if( ! empty( $categories ) ) :
?>

<div <?php post_class( 'success-story ' .  $categories[0]->slug ); ?>>
    <div class="sstory-thumbnail" style="background-image: url('<?php print get_the_post_thumbnail_url( null, 'gta-hz' ); ?>');'">
        <a href="<?php print get_permalink(); ?>"></a>
        <div class="sstory-meta">
            <?php 
                $color = get_term_meta( $categories[0]->term_id, 'cc_color', true );

                printf( '<span class="sstory-cat" %s>%s</span>', 
                    ! empty( $color ) ? 'style="background-color: ' . esc_attr( $color ) . ';"' : '', 
                    esc_html( $categories[0]->name ) ); 
            ?>
        </div>
    </div>
    <div class="sstory-logo">
        <?php if( ! empty( $logo = get_post_meta( get_the_ID(), '_success_story_logo', true ) ) ) : ?>

        <a href="<?php print get_permalink(); ?>"><img src="<?php print esc_url( $logo ); ?>" alt="<?php the_title(); ?>" class="sstory-logo-img" /></a>

        <?php endif; ?>
    </div>
</div>
<?php endif; ?>