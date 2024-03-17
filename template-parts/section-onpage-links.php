<?php
$parent_title = $args['parent_title'];
$onpage_links = $args['onpage_links'];
?>
<section class="onpage-links purple-bg">
	<div class="grid-container">
		<div class="grid-x grid-padding-x align-right uppercase">
			<?php if( !empty($parent_title) ):?>
				<div class="cell shrink parent-title text-right">
					<span><?=esc_attr( $parent_title );?></span>
				</div>
			<?php endif;?>
			<?php if( !empty($onpage_links) ):
				foreach($onpage_links as $onpage_link):	
					$link = $onpage_link['link'] ?? null;
					$link_url = $link['url'];
					$link_title = $link['title'];
					$link_target = $link['target'] ? $link['target'] : '_self';
			?>
				<div class="cell shrink">
					<a href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
				</div>
			<?php endforeach; endif;?>
		</div>
	</div>
</section>