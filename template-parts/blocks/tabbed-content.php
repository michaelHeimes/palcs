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
$id = 'cta-heading-heading-bg-img' . $block['id'];
if( !empty($block['anchor']) ) {
	$id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'cta-heading-heading-bg-img';
if( !empty($block['className']) ) {
	$className .= ' ' . $block['className'];
}

$tabs = get_field('tabs');

?>
<section id="<?php echo esc_attr($id); ?>" class="module block <?php echo esc_attr($className); ?>">
	<?php if( !empty($tabs) ):?>
		<ul class="tabs" data-tabs id="<?=$block['id'];?>-tabs">
			<?php $i = 1; foreach( $tabs as $tab ):
				$title = $tab['title'];	
			?>
				<li class="tabs-title<?php if( $i == 1 ){ echo ' is-active';}?>" <?php if( $i == 1 ){ echo 'aria-selected="true"';};?>>
					<a href="#panel-<?=sanitize_title($title);?>-<?=$i;?>"><?=$title;?></a>
				</li>
			<?php $i++; endforeach;?>
		</ul>
		<div class="tabs-content" data-tabs-content="<?=$block['id'];?>-tabs">
			<?php $i = 1; foreach( $tabs as $tab ):
				$title = $tab['title'];	
				$content = $tab['content'];	
			?>
			<div class="tabs-panel<?php if( $i == 1 ){ echo ' is-active';}?>" id="panel-<?=sanitize_title($title);?>-<?=$i;?>">
				<?=$content;?>
			</div>
			<?php $i++; endforeach;?>
		</div>  
	<?php endif;?>
</section>