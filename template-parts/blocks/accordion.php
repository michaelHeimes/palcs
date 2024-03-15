<?php

/**
 * Accordion Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'accordion-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create id attribute allowing for custom "anchor" value.
$id = 'accordion' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'accordion';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}

$allow_all_closed = get_field('allow_all_closed');
$all_closed_by_default = get_field('all_closed_by_default');
$allow_multiple_open = get_field('allow_multiple_open');
$accordions = get_field('accordion');

?>
<section id="<?php echo esc_attr($id); ?>" class="module block <?php echo esc_attr($className); ?>">
    <?php if( !empty($accordions) ):?>
        <ul class="accordion" data-accordion
        <?php
            if( $allow_all_closed ) { echo ' data-allow-all-closed="true"'; }
            if( $allow_multiple_open ) { echo ' data-multi-expand="true"'; }
        ?>
        >
            
            <?php $i = 1; foreach( $accordions as $accordion ):
                $title = $accordion['title'];    
                $content = $accordion['content'];    
            ?>    
            <li class="accordion-item<?php if( $i == 1 && $all_closed_by_default != true) { echo ' is-active';}?>" data-accordion-item>
                <a href="#" class="accordion-title weight-medium font-sans">
                    <?= esc_attr($title);?>
                    <span class="marker"></span>
                </a>
                <div class="accordion-content" data-tab-content>
                    <?= $content;?>
                 </div>
            </li>
            <?php $i++; endforeach;?>
        </ul>
    <?php endif;?>
</section>