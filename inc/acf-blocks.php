<?php

function register_acf_block_types() {

    // Check function exists.
    if( function_exists('acf_register_block_type') ) {
        
        acf_register_block_type(array(
            'name'              => 'copy-left-cta-right',
            'title'             => __('Block: Copy Left, CTA Right'),
            'description'       => __('Block: Copy Left, CTA Right'),
            'render_template'   => 'template-parts/blocks/copy-left-cta-right.php',
            'category'          => 'formatting',
            'icon'              => 'admin-comments',
            'keywords'          => array( 'custom', 'block', 'copy', 'cta' ),
        ));
        
        acf_register_block_type(array(
            'name'              => 'accordion',
            'title'             => __('Block: Accordion'),
            'description'       => __('Block: Accordion'),
            'render_template'   => 'template-parts/blocks/accordion.php',
            'category'          => 'formatting',
            'icon'              => 'admin-comments',
            'keywords'          => array( 'custom', 'block', 'accordion' ),
        ));
        
        acf_register_block_type(array(
            'name'              => 'button-group',
            'title'             => __('Block: Button Group'),
            'description'       => __('Block: Button Group'),
            'render_template'   => 'template-parts/blocks/button-group.php',
            'category'          => 'formatting',
            'icon'              => 'admin-comments',
            'keywords'          => array( 'custom', 'block', 'button', 'buttons', 'group' ),
        ));
        
        acf_register_block_type(array(
            'name'              => 'tabs',
            'title'             => __('Block: Tabbed Content'),
            'description'       => __('Block: Tabbed Content'),
            'render_template'   => 'template-parts/blocks/tabbed-content.php',
            'category'          => 'formatting',
            'icon'              => 'admin-comments',
            'keywords'          => array( 'custom', 'block', 'tabs', 'tabbed' ),
        ));
        
    }
        
}

if( function_exists('acf_register_block_type') ) {
    add_action('acf/init', 'register_acf_block_types');
}