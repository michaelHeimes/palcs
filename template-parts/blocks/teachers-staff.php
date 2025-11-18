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

$teachers_staff = get_field('teachers_staff') ?? null;

if($teachers_staff):

?>
<section id="<?php echo esc_attr($id); ?>" class="module block <?php echo esc_attr($className); ?>">
    <div class="grid-container">
        <div class="grid-x grid-padding-x align-center">
            <div class="cell small-12 xxlarge-10">
                <div class="filter-grid grid-x grid-padding-x">
                    <?php foreach($teachers_staff as $post) {
                        setup_postdata($post);
                        get_template_part('template-parts/loop', 'teacher-staff',
                            array(
                                'cpt' => 'administration',
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