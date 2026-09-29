<?php
$is_intro = $args['is_intro'] ?? null;
$wywiwygs_50_50 = $args['wywiwygs_50_50'] ?? null;
$intro_button_link = $args['button_link'] ?? null;
$left = $wywiwygs_50_50['left_wysiwyg'] ?? null;
$right = $wywiwygs_50_50['right_wysiwyg'] ?? null;
if($left || $right):
?>
<div class="wywiwygs-50-50<?php if( $is_intro == true ):?> intro<?php endif;?>">
	<div class="grid-container">
		<div class="grid-x grid-padding-x align-center">
			<?php if( !empty($left) ):?>
				<div class="left cell small-12 medium-6 large-5">
					<?=wp_kses_post( $left );?>
					<?php 
					$link = $intro_button_link;
					if( $link ): 
						$link_url = $link['url'];
						$link_title = $link['title'];
						$link_target = $link['target'] ? $link['target'] : '_self';
						?>
					<div class="btn-wrap text-center">
						<a class="button purple-ds" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
					</div>
					<?php endif; ?>
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
<?php endif;?>