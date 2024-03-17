<?php
$wywiwygs_50_50 = $args['wywiwygs_50_50'] ?? null;
$left = $wywiwygs_50_50['left_wysiwyg'] ?? null;
$right = $wywiwygs_50_50['right_wysiwyg'] ?? null;
?>
<div class="wywiwygs-50-50">
	<div class="grid-container">
		<div class="grid-x grid-padding-x align-center align-bottom">
			<?php if( !empty($left) ):?>
				<div class="cell small-12 medium-6 large-5">
					<?=wp_kses_post( $left );?>
				</div>
			<?php endif;?>
			<?php if( !empty($right) ):?>
				<div class="cell small-12 medium-6 large-5">
					<?=wp_kses_post( $right );?>
				</div>
			<?php endif;?>
		</div>
	</div>
</div>