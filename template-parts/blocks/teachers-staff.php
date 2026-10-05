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
$id = 'teachers-staff-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'teachers-staff-block';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}

$col_count = get_field('columns') ?: 'four-col';
$alignment = get_field('alignment') ?: 'align-left';
$teachers_staff = get_field('teachers_staff') ?? null;

$className .= ' ' . $col_count; 


if($col_count == 'four-col') {
    $width_classes = 'small-12 xxlarge-10';
    $col_width_classes = 'small-up-2 medium-up-2 tablet-up-3 xlarge-up-4';
}
if($col_count == 'five-col') {
    $width_classes = 'small-12 xxlarge-11';
    $col_width_classes = 'small-up-2 medium-up-3 tablet-up-4 large-up-5';
}

if($teachers_staff):

?>
<section id="<?php echo esc_attr($id); ?>" class="module block <?php echo esc_attr($className); ?>">
    <div class="grid-container">
        <div class="grid-x grid-padding-x align-center">
            <div class="cell <?=$width_classes;?> content-width">
                <div class="filter-grid grid-x grid-padding-x <?=$col_width_classes;?> <?=$alignment;?>">
                    <?php foreach($teachers_staff as $post) {
                        setup_postdata($post);
                        get_template_part('template-parts/loop', 'teacher-staff',
                            array(
                                'post_id' => $post->ID,
                            )
                        );
                    }?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php wp_reset_postdata(); endif;?>