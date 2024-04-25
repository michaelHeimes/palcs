<?php

/**
 * Tabbed Content Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'block-tabbed-content' . $block['id'];
if( !empty($block['anchor']) ) {
	$id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'block-tabbed-content';
if( !empty($block['className']) ) {
	$className .= ' ' . $block['className'];
}

$tabs = get_field('tabs') ?? null;

?>
<section id="<?php echo esc_attr($id); ?>" class="module block <?php echo esc_attr($className); ?>">
	<?php if( !empty($tabs) ):?>
		<ul class="tabs" data-responsive-accordion-tabs="tabs small-accordion tablet-tabs" id="<?=$block['id'];?>-tabs" data-allow-all-closed="true" data-deep-link="true" data-update-history="true" data-deep-link-smudge="true" data-deep-link-smudge-delay="500" data-deep-link-smudge-offset="50">
			<?php $i = 1; foreach( $tabs as $tab ):
				$title = $tab['title'];	
			?>
				<li class="tabs-title<?php if( $i == 1 ){ echo ' is-active';}?>" <?php if( $i == 1 ){ echo 'aria-selected="true"';};?>>
					<a class="font-header" href="#panel-<?=sanitize_title($title);?>-<?=$i;?>">
						<b><?=$title;?></b>
						<span class="marker"></span>
					</a>
				</li>
			<?php $i++; endforeach;?>
		</ul>
		<div class="tabs-content" data-tabs-content="<?=$block['id'];?>-tabs">
			<?php $i = 1; foreach( $tabs as $tab ):
				$title = $tab['title'];	
				$content = $tab['content'];	
			?>
			<div class="tabs-panel entry-content<?php if( $i == 1 ){ echo ' is-active';}?>" id="panel-<?=sanitize_title($title);?>-<?=$i;?>">
				<?=$content;?>
			</div>
			<?php $i++; endforeach;?>
		</div>  
	<?php endif;?>
</section>