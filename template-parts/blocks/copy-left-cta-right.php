<?php

/**
 *Copy Left CTA Right Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'copy-left-cta-right-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'copy-left-cta-right';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}

$left_column = get_field('left_column') ?? null;
$right_column = get_field('right_column') ?? null;

?>
<section id="<?php echo esc_attr($id); ?>" class="module block <?php echo esc_attr($className); ?>">
	<div class="grid-container">
        <div class="grid-x grid-padding-x">
            <?php if( !empty($left_column) ):
                $background_image = $left_column['background_image']; 
                $heading = $left_column['centered_heading'];   
                $copy = $left_column['copy'];    
            ?>
                <div class="left relative cell small-12 medium-7 tablet-8">
                    <?php if( !empty( $background_image ) ) {
                        $imgID = $background_image['ID'];
                        $img_alt = trim( strip_tags( get_post_meta( $imgID, '_wp_attachment_image_alt', true ) ) );
                        $img = wp_get_attachment_image( $imgID, 'full', false, [ "class" => "bg-img", "alt"=>$img_alt] );
                        echo $img;
                    }?>
                    <div class="relative inner">
                        <?php if( !empty($heading) ):?>
                            <h2 class="uppercase text-center">
                                <b><?= $heading;?></b>
                            </h2>
                        <?php endif;?>
                        <?php if( !empty($copy) ):?>
                            <div class="copy h3-margins">
                                <?= $copy;?>
                            </div>
                        <?php endif;?>
                    </div>
                </div>
            <?php endif;?>
            <?php if( !empty($right_column) ):
                $heading = $right_column['centered_heading'];   
                $copy = $right_column['copy']; 
                $link = $right_column['link'];     
            ?>
                <div class="right cell small-12 medium-5 tablet-4">
                    <?php if( !empty($heading) ):?>
                        <h2 class="uppercase text-center">
                            <b><?= $heading;?></b>
                        </h2>
                    <?php endif;?>
                    <?php if( !empty($copy) ):?>
                        <div class="copy h3-margins">
                            <?= $copy;?>
                        </div>
                    <?php endif;?>
                    <?php 
                    if( $link ): 
                        $link_url = $link['url'];
                        $link_title = $link['title'];
                        $link_target = $link['target'] ? $link['target'] : '_self';
                        ?>
                    <p>
                        <a class="chev-link" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>">
                            <span><?php echo esc_html( $link_title ); ?></span>
                            <?php get_template_part('template-parts/svg', 'chev-right');?>
                        </a>
                    </p>
                    <?php endif; ?>
                </div>
            <?php endif;?>
        </div>
    </div>
</section>