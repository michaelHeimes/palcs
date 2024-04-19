<?php
	$thumb_id = get_post_thumbnail_id();
	$event_date = get_field('event_date') ?? null;
	$date = DateTime::createFromFormat( 'Ymd', $event_date );
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('event-card load-more-filter-card cell hidden'); ?>>
	<div class="inner relative">
		<div class="grid-x grid-padding-x">
			<?php if( !empty( $thumb_id ) ) {
				$imgID = $thumb_id;
				$img_alt = trim( strip_tags( get_post_meta( $imgID, '_wp_attachment_image_alt', true ) ) );
				$img = wp_get_attachment_image( $imgID, 'event-card', false, [ "class" => "", "alt"=>$img_alt] );
				echo '<div class="thumbnail-wrap cell small-12 medium-4">';
				echo '<a href="' . esc_url(get_the_permalink()) . '">';
				echo '<div class="purple-ds link">';
				echo $img;
				echo '</div>';
				echo '</a>';
				echo '</div>';
			}?>
			<div class="cell small-12 medium-8">
				<h3 class="h6 color-blue">
					<a class="color-blue" href="<?= esc_url(get_the_permalink());?>">
						<?php the_title();?>
					</a>
				</h3>
				<?php if( !empty($event_date) ):?>
				<p class="date">
					<b>Event Date:</b>
					<?=$date->format( 'm/d/y' );?>
				</p>
				<?php endif;?>
				<?php if (has_excerpt()) {
					echo '<p>';
						the_excerpt();
					echo '</p>';
				} else {
					// No custom excerpt, create one from the content
					$content = get_the_content();
					$excerpt_length = 30; // Number of characters for the excerpt
					$excerpt = wp_trim_words($content, $excerpt_length, '<span class="color-coral">...</span>'); // Trim content to specified length with ellipsis
					echo $excerpt;
				}?>
				<div class="btn-wrap grid-x align-right">
					<a class="button purple-ds" class="color-dark-gray" href="<?= esc_url(get_the_permalink());?>">
						See Event
					</a>
				</div>
			</div>
		</div>
	</div>
</article>