<?php
$parent_title = $args['parent_title'];
$parent_page_link = $args['parent_page_link'];
$current_url = $_SERVER['REQUEST_URI'];
$onpage_links = $args['onpage_links'];
$home_url = home_url();
?>
<section class="on-page-nav purple-bg">
	<div class="grid-container">
		<div class="grid-x grid-padding-x uppercase">
			<?php if( !empty($parent_title) || !empty($parent_page_link) ):?>
				<div class="cell shrink parent-title text-center">
					<?php if($parent_page_link):
						$link = $parent_page_link;
						$link_url = $link['url'];
						$link_title = $link['title'];
						$link_target = $link['target'] ? $link['target'] : '_self';
						
						$relative_path = str_replace($home_url, '', $link_url);
					
					
						if( $current_url == $relative_path ):?>
							<span><?php echo esc_html( $link_title ); ?></span>
						<?php else:?>
							<a href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
						<?php endif;?>
					
					<?php else:?>
						<span><?=esc_attr( $parent_title );?></span>
					<?php endif;?>
				</div>
			<?php endif;?>
			<?php if( !empty($onpage_links) ):
				foreach($onpage_links as $onpage_link):	
					$link = $onpage_link['link'] ?? null;
					$link_url = $link['url'];
					$link_title = $link['title'];
					$link_target = $link['target'] ? $link['target'] : '_self';
					
					$relative_path = str_replace($home_url, '', $link_url);
			?>
				<div class="cell shrink">
					<?php if( $current_url == $relative_path ):?>
						<span><?php echo esc_html( $link_title ); ?></span>
					<?php else:?>
						<a href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
					<?php endif;?>
				</div>
			<?php endforeach; endif;?>
		</div>
	</div>
</section>