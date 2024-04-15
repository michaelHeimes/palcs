<?php
$no_single_post = get_field('no_single_post') ?? null;
$show_content_in_modal = get_field('show_content_in_modal') ?? null;
$card_classes = $args['card-classes'] ?? null;
$thumb_id = get_post_thumbnail_id();
if( $card_classes != null ) {
	$card_classes = 'post-card cell load-more-filter-card hidden';
} else {
	$card_classes = 'post-card cell';
}
?>
<article id="post-<?php the_ID(); ?>" <?php post_class($card_classes); ?>>
	<div class="inner relative">
		<?php if( !empty( $thumb_id ) ) {
			$imgID = $thumb_id;
			$img_alt = trim( strip_tags( get_post_meta( $imgID, '_wp_attachment_image_alt', true ) ) );
			$img = wp_get_attachment_image( $imgID, 'post-card', false, [ "class" => "", "alt"=>$img_alt] );
			echo '<div class="thumbnail-wrap">';
			echo $img;
			echo '</div>';
		}?>
		<?php if( !$no_single_post ):?>
			<a class="color-blue permalink grid-x align-bottom" href="<?= esc_url(get_the_permalink());?>">
				<h3 class="color-blue"><?php the_title();?></h3>
			</a>
		<?php endif;?>
		<?php if( $show_content_in_modal ):
			$title = get_the_title();	
			$slug = sanitize_title($title);
			$post_id = get_the_ID();
		?>
			<button class="no-style color-blue permalink grid-x align-bottom" data-open="modal-<?=$post_id;?>-<?=esc_attr( $slug );?>">
				<h3 class="color-blue"><?=esc_html( $title )?></h3>
			</button>
			<div class="reveal large" id="modal-<?=$post_id;?>-<?=esc_attr( $slug );?>" data-reveal data-animation-in="fade-in fast" data-animation-out="fade-out fast" data-reset-on-close="true" data-deep-link="true">
				<div class="text-right">
					<button class="close-button no-style" data-close aria-label="Close modal" type="button">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<?php
				if( get_post_type() == 'club') { 
					$post_id = get_the_ID();
					$term_slugs = [];
					$taxonomies = '';
					$combined_terms = '';
					$categories = array('club-category');
					$slug_front = '/activities/student-activities/clubs/club-category/';
				}
				// Combine term slugs into a single string separated by spaces
				if (!empty($term_slugs)) {
				 $combined_terms = implode(' ', $term_slugs);
				}
				
				get_template_part('template-parts/content', 'post-single-img-sidebar',
					array(
						'post_id' => $post_id,	
						'post_type' => get_post_type(),
						'categories' => $categories,
						'taxonomies' => $taxonomies,
						'combined_terms' => $combined_terms,
						'slug_front' => $slug_front,
						'sidebar-width' => ' small-12 medium-5',
						'content-width' => ' small-12 medium-7',
					),
				);
				?>				
			</div>
		<?php endif;?>
	</div>
</article>