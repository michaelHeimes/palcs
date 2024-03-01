<section class="post-footer-nav">
	<div class="grid-x grid-padding-x">
		<div class="left cell small-12 medium-6">
			<?php
			$currentpost = "";
			$cat_ID = 0;
			$cat_name = "";
			if(is_single()) {
				$currentpost = get_the_ID();
				//$terms = get_the_terms( $post->ID, 'category' );
				$categories = get_the_category( );
				//print_r($categories);
				if ( ! empty( $categories ) ) {
					$cat_ID = $categories[0]->cat_ID; 
					$cat_name = $categories[0]->name . " ";
				}
			}
					
			if(is_category()) {
				$queried_object = get_queried_object();
				//print_r($queried_object);
				$cat_ID = $queried_object->cat_ID ;
				$cat_name = $queried_object->name . " ";
			}
			echo '<h3 class="h5">Recent ' . $cat_name . ' News & Articles</h3>';
			?>
			<ul class="menu vertical">
				<?php
				$args = array(
					'post_type' => 'post',
					'posts_per_page' => 5,
					'orderby' => 'date',
					'order'=>'DESC',
					'cat'=> $cat_ID,
				);					
				$the_query = new WP_Query( $args );
				while ( $the_query->have_posts() ) {
					$the_query->the_post();
					if ($post->ID == $currentpost) {
					echo '<li><a class="currentcat" href="' . get_permalink() . '">';
				}
				else {
					echo '<li><a class="color-sky-blue" href="' . get_permalink() . '">';
				}
					the_title();
					echo "</a></li>";
				
				}
				wp_reset_postdata();
				
				?>
		
				<li class="va-wrap"><a href="<?php echo get_post_type_archive_link( 'post' );?>">View All News & Articles <i class="fas fa-chevron-right" aria-hidden="true"></i></a></li>
			</ul>
		</div>
		<div class="cell small-12 medium-6">
			<h3 class="h5">Browse Categories</h3>
			<ul class="menu vertical">
				<?php
				$categories = get_categories( array(
					'orderby' => 'name',
					'order'   => 'ASC'
				) );
				//print_r($categories);
				foreach( $categories as $category ) {
					$name = $category->name;
					$catid = $category->term_id;
					$link = get_category_link( $catid );
					if ($catid == $cat_ID) {
						echo '<li><a class="color-sky-blue currentcat" href="' . $link . '">';
					}
					else {
					echo '<li><a class"color-sky-blue" href="' . $link . '">';
					}
					echo $name;
					echo "</a></li>";
				}
				?>	
			</ul>
		</div>
	</div>
</section>