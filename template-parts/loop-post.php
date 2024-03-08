<?php
/**
 * Template part for displaying posts in an archive grid
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package trailhead
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('post-card cell small-12 medium-6 tablet-4'); ?>>
	
	<a href="<?=esc_url( get_permalink() );?>" rel="bookmark">
		<?php the_post_thumbnail('post-card'); ?>
	</a>
	
	<div>
		<header class="entry-header">
			<?php
			the_title( '<h2 class="entry-title h5"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
	
			if ( 'post' === get_post_type() ) :
				?>
				<div class="entry-meta">
				</div><!-- .entry-meta -->
			<?php endif; ?>
		</header><!-- .entry-header -->
	
		<div class="entry-content">
			<?php
			$post_excerpt = wp_trim_words(get_the_excerpt(), 25, '...'); // Limit to 20 words
			
			if (empty($post_excerpt)) {
				// If there's no custom excerpt, generate one from the content
				$content = get_the_content();
				$post_excerpt = wp_trim_words($content, 25, '...'); // Limit to 20 words
			}
			
			echo $post_excerpt;
			?>
		</div><!-- .entry-content -->
	</div>

	<footer class="entry-footer text-center">
		<a class="button purple-ds" href="<?=esc_url( get_permalink() );?>" rel="bookmark">
			Read More
		</a>		
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
