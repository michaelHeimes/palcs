<?php
$is_intro = $args['is_intro'] ?? null;
$wywiwygs_50_50 = $args['wywiwygs_50_50'] ?? null;
$left = $wywiwygs_50_50['left_wysiwyg'] ?? null;
$right = $wywiwygs_50_50['right_wysiwyg'] ?? null;
?>
<div class="wywiwygs-50-50<?php if( $is_intro == true ):?> intro<?php endif;?>">
	<div class="grid-container">
		<div class="grid-x grid-padding-x align-center">
			<?php if( !empty($left) ):?>
				<div class="left cell small-12 medium-6 large-5">
					<?=wp_kses_post( $left );?>
				</div>
			<?php endif;?>
			<?php if( !empty($right) ):?>
				<div class="right cell small-12 medium-6 large-5">
					<?=wp_kses_post( $right );?>
				</div>
			<?php endif;?>
		</div>
	</div>
</div>