
<?php
	$heading = $args['heading'] ?? null;
	$caption = $args['caption'] ?? null;
	$gravity_form = $args['gravity-form'] ?? null;

	// Generate a unique ID, or use the one passed by the block.
	$form_id = $args['form-id'] ?? wp_unique_id('form-wrap-');
?>

<div class="collapsed-form relative">
	<?php if ($heading || $caption): ?>
		<div class="section-header text-center">
			<div class="gradient-border"></div>

			<?php if ($heading): ?>
				<div class="form-heading blue-bg color-white">
					<div class="h3 font-header">
						<?= wp_kses_post($heading); ?>
					</div>
				</div>
			<?php endif; ?>

			<?php if ($caption): ?>
				<div class="caption color-blue">
					<p><?= wp_kses_post($caption); ?></p>
				</div>
			<?php endif; ?>
		</div>
	<?php endif; ?>

	<?php if ($gravity_form && $gravity_form !== 'none'): ?>
		<div id="<?= esc_attr($form_id); ?>" class="form-wrap overflow-hidden">
			<?php
				gravity_form($gravity_form, false, false, false, '', true, 12);
			?>
		</div>

		<div class="btn-wrap text-center">
			<button
				type="button"
				class="no-style form-expand-btn"
				aria-expanded="false"
				aria-controls="<?= esc_attr($form_id); ?>"
			>
				<svg xmlns="http://www.w3.org/2000/svg" width="53" height="53" viewBox="0 0 53 53">
					<g data-name="Group 366" transform="translate(-1160.308 -1506.122)">
						<circle data-name="Ellipse 10" cx="26.5" cy="26.5" r="26.5" transform="translate(1160.308 1506.122)" fill="#0151d4"/>
						<path d="m1172.397 1523.597 13.91 13.88 13.911-13.88 4.273 4.273-18.183 18.187-18.184-18.187Z" fill="#fcfdff"/>
					</g>
				</svg>
			</button>
		</div>
	<?php endif; ?>
</div>
