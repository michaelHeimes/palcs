<?php
/**
 * Template part for displaying page content in page.php
 */
?>

<div id="post-<?php the_ID(); ?>" <?php post_class(''); ?> role="article" itemscope itemtype="http://schema.org/WebPage">
						
	<header class="article-header">
		<h1 class="page-title"><?php the_title(); ?></h1>
	</header> <!-- end article header -->
					
    <section class="entry-content" itemprop="text">
	    <?php the_content(); ?>
	</section> <!-- end article section -->
						
	<div class="article-footer">
		<?php wp_link_pages(); ?>
	</div> <!-- end article footer -->
						    
	<?php comments_template(); ?>
					
</div> <!-- end article -->