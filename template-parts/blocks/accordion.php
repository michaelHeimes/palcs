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

// Create class attribute allowing for custom "className" and "align" values.
$className = 'accordion-block';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}

$allow_all_closed = get_field('allow_all_closed') ?? null;
$all_closed_by_default = get_field('all_closed_by_default') ?? null;
$allow_multiple_open = get_field('allow_multiple_open') ?? null;
$accordions = get_field('accordion') ?? null;

?>
<section id="<?php echo esc_attr($id); ?>" class="module block <?php echo esc_attr($className); ?>">
    <?php if( !empty($accordions) ):?>
        <ul class="accordion" data-accordion
        <?php
            if( $allow_all_closed ) { echo ' data-allow-all-closed="true" '; }
            if( $allow_multiple_open ) { echo ' data-multi-expand="true" '; }
        ?>
         data-deep-link="true" data-update-history="true" data-deep-link-smudge="true" data-deep-link-smudge-delay="500" data-deep-link-smudge-offset="50"
        >
            
            <?php $i = 1; foreach( $accordions as $accordion ):
                $title = $accordion['title'];    
                $content = $accordion['content'];    
            ?>    
            <li class="accordion-item<?php if( $i == 1 && $all_closed_by_default != true) { echo ' is-active';}?>" data-accordion-item>
                <a href="#<?= sanitize_title($title);?>" class="accordion-title font-header">
                    <b><?= esc_attr($title);?></b>
                    <span class="marker"></span>
                </a>
                <div class="accordion-content entry-content" data-tab-content id="<?= sanitize_title($title);?>">
                    <?= $content;?>
                 </div>
            </li>
            <?php $i++; endforeach;?>
        </ul>
    <?php endif;?>
</section>