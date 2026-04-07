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
$id = 'info-stats-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'info-stats';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}

$icons_text_background_color = get_field('icons_text_background_color') ?? null;

$icons_text_text_color = get_field('icons_text_text_color') ?? null;

$itt_text_color = '#fff';

if($icons_text_text_color == 'charcoal-gray') {
    $itt_text_color = '#272727';
}

$icon_text_columns = get_field('icon_text_columns') ?? null;

$multi_column_list_text_and_list = get_field('multi_column_list_text_and_list') ?? null;
$multi_column_list_background_color = get_field('multi_column_list_background_color') ?? null;
$multi_column_list_text_color = get_field('multi_column_list_text_color') ?? null;
$multi_column_list_columns = get_field('multi_column_list_columns') ?? null;

$mcl_text_color = '#fff';

if($multi_column_list_text_color == 'charcoal-gray') {
    $mcl_text_color = '#272727';
}

$footer_logo = get_field('footer_logo') ?? null;
$footer_text = get_field('footer_text') ?? null;

if( $icon_text_columns || $multi_column_list_text_and_list ):
?>
<section id="<?php echo esc_attr($id); ?>" class="module block <?= esc_attr($className);?>">
    <?php if($icon_text_columns ):?>
        <div class="icon-text-columns" style="background-color: <?=esc_html($icons_text_background_color);?>; color: <?=esc_html($itt_text_color );?>;">
            <div class="grid-x grid-padding-x small-up-1 medium-up-3 ">
                <?php foreach($icon_text_columns as $col):
                    $icon = $col['icon'] ?? null;
                    $heading = $col['heading'] ?? null;
                    $subheading = $col['subheading'] ?? null;
                ?>
                    <div class="cell text-center">
                        <?php if($icon):?>
                            <div class="icon-wrap">
                                <?=wp_get_attachment_image( $icon['id'], 'full' );?>
                            </div>
                        <?php endif;?>
                        <?php if($heading || $subheading):?>
                            <div class="text-wrap">
                                <?php if($heading):?>
                                    <h2 style="color: <?=$itt_text_color;?>"><?=wp_kses_post( $heading  );?></h2>
                                <?php endif;?>
                                <?php if($subheading):?>
                                    <h3 class="h5" style="color: <?=$itt_text_color;?>"><?=wp_kses_post( $subheading  );?></h3>
                                <?php endif;?>
                            </div>
                        <?php endif;?>
                    </div>
                <?php endforeach;?>
            </div>
        </div>
    <?php endif;?>
    
    <?php if( $multi_column_list_text_and_list ):?>
        <div class="multi-column-lists list-cols-<?=esc_attr($multi_column_list_columns);?> text-color-<?=esc_attr($multi_column_list_text_color);?>" style="background-color: <?=esc_html($multi_column_list_background_color);?>; color: <?=esc_html($mcl_text_color);?> !important;">
            <?=wp_kses_post( $multi_column_list_text_and_list );?>
        </div>
    <?php endif;?>
    
    <?php if($footer_logo || $footer_text):?>
        <div class="footer">
            <div class="grid-x grid-padding-x align-middle">
                <?php if($footer_logo):?>
                    <div class="footer-logo cell small-12 medium-6 tablet-7">
                        <?=wp_get_attachment_image( $footer_logo['id'], 'full');?>
                    </div>
                <?php endif;?>
                <?php if($footer_text):?>
                    <div class="footer-text cell small-12 medium-6 tablet-5">
                        <?=wp_kses_post($footer_text);?>
                    </div>
                <?php endif;?>
            </div>
        </div>
    <?php endif;?>
    
</section>
<?php endif;?>