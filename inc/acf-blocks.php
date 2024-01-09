<?php

add_action('acf/init', 'my_acf_init_block_types');
function my_acf_init_block_types() {

    // Check function exists.
    if( function_exists('acf_register_block_type') ) {

        // register a testimonial block.
        acf_register_block_type(array(
            'name'              => 'large-colored-copy',
            'title'             => __('Large Colored Copy'),
            'description'       => __('A custom Large Colored Copy block.'),
            'render_template'   => 'template-parts/blocks/large-colored-copy.php',
            'category'          => 'formatting',
            'icon'              => 'admin-comments',
            'keywords'          => array( 'large', 'colored', 'copy', 'text' ),
        ));
    }
}

// CPT Archives Post Per page
function hwl_home_pagesize( $query ) {
    if ( ! is_admin() && $query->is_main_query() && is_post_type_archive( 'ad_property' ) ) {
        $query->set( 'posts_per_page', 9999999 );
        return;
    }

    if ( ! is_admin() && $query->is_main_query() && is_tax( 'ad_prop_type' ) ) {
        $query->set( 'posts_per_page', 9999999 );
        return;
    }

    if ( ! is_admin() && $query->is_main_query() && is_post_type_archive( 'news_post' ) ) {
        $query->set( 'posts_per_page', 7 );
        return;
    }

}
add_action( 'pre_get_posts', 'hwl_home_pagesize', 1 );