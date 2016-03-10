<?php get_header(); ?>
	<div class="content">

		<div class="container">
			<div class="row">
			<h3 class="search-result">Результаты по запросу "<?php echo get_search_query() ?>"</h3>

				<?php if ( have_posts() ) : ;
					while (have_posts()) : the_post(); ?>
						<div class="col-md-4">
							<div class="post">
								<div class="img-wrapp" style="background-image: url(<?php
								if ( has_post_thumbnail() ) {
									the_post_thumbnail_url();
								}
								?>">
									<div class="post-descr">
										<a href="<?php echo get_permalink(); ?>" class="button">Читать</a>
									</div>
								</div>
								<div class="post-content">
									<div class="category <?php
									foreach((get_the_category()) as $category) {
										echo  $category->category_nicename;
									}
									?>"><?php
										foreach((get_the_category()) as $category) {
											echo  $category->cat_name;
										}
										?></div>
									<h2><a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></h2>
									<span class="author">от Ирина Гуреева</span>
									<?php the_excerpt(); ?>

								</div>
								<div class="post-footer">
									<span class="date"><?php echo get_the_date( get_option('date_format') ); ?></span>
									<span class="views"><?php if(function_exists('the_views')) { the_views(); } ?></span>
									<span class="likes">15</span>
								</div>
							</div>
						</div>
					<?php endwhile;
				endif;

				wp_reset_query(); ?>




				<div class="col-md-12">
					<div class="btn-wrapp">
						<?php echo get_next_posts_link( 'Загрузить еще', $the_query->max_num_pages );
						echo get_previous_posts_link( 'Предыдущие записи' );?>
					</div>
				</div>

			</div>
		</div>

	</div>

<?php get_footer(); ?>