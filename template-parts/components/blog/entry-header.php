<?php
/**
 * Template for post entry header
 */
$the_post_id = get_the_ID();
$hide_title = get_post_meta($the_post_id, "_hide_page_title", true);
$heading_class = !empty($hide_title) && 'yes' === $hide_title ? 'hide' : '';

$has_post_thumbnail = get_the_post_thumbnail($the_post_id);
?>
<header class="entry-header">
    <?php
    //featured image
    if ($has_post_thumbnail) {
        ?>
            <a href="<?php echo esc_url(get_permalink()); ?>">
                <img src="<?php echo esc_url(get_the_post_thumbnail_url($the_post_id)); ?>" loading="lazy" class="img-fluid"
                    alt="">
            </a>
        <?php
    }
    if (is_single() || is_page()) {
        printf(
            '<h1 class="page-title text-dark %1$s">%2$s</h1>',
            esc_attr($heading_class),
            wp_kses_post(get_the_title())
        );
    } else {
        printf(
            '<h2 class="entry-title mb-3"><a href="%1$s" class="link-dark">%2$s</a></h2>',
            esc_url(get_the_permalink()),
            wp_kses_post(get_the_title())
        );
    }
    ?>
</header>