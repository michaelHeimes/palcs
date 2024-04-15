<?php

/**
 * Button Group Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'button-group' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'button-group';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}

$remove_top_spacing = get_field('remove_top_spacing') ?? null;
$remove_bottom_spacing = get_field('remove_bottom_spacing') ?? null;
$alignment = get_field('alignment') ?? null;
$button_links = get_field('button_links') ?? null;

?>
<section id="<?php echo esc_attr($id); ?>" class="module block 
    <?= esc_attr($className); 
        if($remove_top_spacing) { echo esc_attr( ' ntm' ); }
        if($remove_bottom_spacing) { echo esc_attr( ' nbm' ); }
    ?>
        
">
    <div class="grid-x grid-padding-x <?= esc_attr( $alignment );?>">
        <?php  foreach($button_links as $button_link):
            $link = $button_link['link'];
        ?>
            <?php 
            if( $link ): 
                $link_url = $link['url'];
                $link_title = $link['title'];
                $link_target = $link['target'] ? $link['target'] : '_self';
                ?>
            <div class="cell shrink">
                <a class="button purple-ds" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
            </div>
            <?php endif; ?>
        <?php endforeach;?>
    </div>
    
</section>