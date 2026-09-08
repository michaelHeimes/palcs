<?php

/**
 * Collapsed Form Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'collapsed-form-' . $block['id'];
if( !empty($block['anchor']) ) {
	$id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'collapsed-form-block relative';
if( !empty($block['className']) ) {
	$className .= ' ' . $block['className'];
}

$heading = get_field('heading') ?? null;
$caption = get_field('caption') ?? null;
$gravity_form = get_field('gravity_form') ?? null;

?>
<section id="<?php echo esc_attr($id); ?>" class="module block <?php echo esc_attr($className); ?>">
	<?php if($heading || $caption):?>
		<div class="section-header text-center">
			<div class="gradient-border"></div>
		<?php if($heading):?>
			<div class="form-heading blue-bg color-white">
			<div class="h3 font-header">
				<?=wp_kses_post( $heading );?>
			</div>
			</div>
		<?php endif;?>
		<?php if($caption):?>
			<div class="caption color-blue">
				<p><?=wp_kses_post( $caption );?></p>
			</div>
		<?php endif;?>
		</div>
	<?php endif;?>
	<?php if ($gravity_form && $gravity_form !== 'none') :?>
		<div class="form-wrap overflow-hidden">
			<?php
			$escaped_gravity_form = acf_esc_html($gravity_form);
			gravity_form( $escaped_gravity_form, false, false, false, '', true, 12 ); 
			?>
		</div>
		<div class="btn-wrap text-center">
			<button type="button" class="no-style form-expand-btn" aria-label="expands the above form">
				<svg xmlns="http://www.w3.org/2000/svg" width="53" height="53" viewBox="0 0 53 53"><g data-name="Group 366" transform="translate(-1160.308 -1506.122)"><circle data-name="Ellipse 10" cx="26.5" cy="26.5" r="26.5" transform="translate(1160.308 1506.122)" fill="#0151d4"/><path d="m1172.397 1523.597 13.91 13.88 13.911-13.88 4.273 4.273-18.183 18.187-18.184-18.187Z" fill="#fcfdff"/></g></svg>
			</button>
		</div>
	<?php endif;?>
</section>