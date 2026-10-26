
<?php
/**
 * Collapsed Form Block Template.
 *
 * @param array $block The block settings and attributes.
 * @param string $content The block inner HTML.
 * @param bool $is_preview True during AJAX preview.
 * @param int|string $post_id The post ID.
 */

$id = 'collapsed-form-' . $block['id'];

if (!empty($block['anchor'])) {
	$id = $block['anchor'];
}

$className = 'collapsed-form-block relative';

if (!empty($block['className'])) {
	$className .= ' ' . $block['className'];
}

$heading = get_field('heading') ?? null;
$caption = get_field('caption') ?? null;
$gravity_form = get_field('gravity_form') ?? null;
?>

<section id="<?= esc_attr($id); ?>" class="module block <?= esc_attr($className); ?>">
	<?php
		get_template_part(
			'template-parts/part',
			'collapsed-form',
			array(
				'form-id'      => 'form-wrap-' . $block['id'],
				'heading'      => $heading,
				'caption'      => $caption,
				'gravity-form' => $gravity_form
			)
		);
	?>
</section>
