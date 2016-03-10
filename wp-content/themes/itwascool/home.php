<?php include (TEMPLATEPATH . "/home-header.php"); ?>
    <div class="content">

        <div class="container">
            <div class="row">


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
                                    $category = get_the_category();
                                    if($category[0]->cat_name == "Рекомендуемые") {
                                        //if first category in array is "featured", get next category in line
                                        $name = $category[1]->category_nicename;
                                        echo $name;

                                    } else {
                                        //get the first category
                                        $name = $category[0]->category_nicename;
                                        echo $name;
                                    }?>">
                                        <?php
                                        $category = get_the_category();
                                        if($category[0]->cat_name == "Рекомендуемые") {
                                            //if first category in array is "featured", get next category in line
                                            $name = $category[1]->cat_name;
                                            echo $name;

                                        } else {
                                            //get the first category
                                            $name = $category[0]->cat_name;
                                            echo $name;

                                        }
                                        ?></div>
                                    <h2><a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></h2>
                                    <?php the_excerpt(); ?>

                                </div>
                                <div class="post-footer">
                                    <span class="date"><?php echo get_the_date( get_option('date_format') ); ?></span>
                                    <span class="views"><?php if(function_exists('the_views')) { the_views(); } ?></span>
                                    <?php echo getPostLikeLink(get_the_ID()); ?>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; endif; wp_reset_query(); ?>

            </div>
            <?php if (  $wp_query->max_num_pages > 1 ) : ?>
                <script>
                    var ajaxurl = '<?php echo site_url() ?>/wp-admin/admin-ajax.php';
                    var true_posts = '<?php echo serialize($wp_query->query_vars); ?>';
                    var current_page = <?php echo (get_query_var('paged')) ? get_query_var('paged') : 1; ?>;
                    var max_pages = '<?php echo $wp_query->max_num_pages; ?>';
                </script>
                <div class="loadmore-wrapp">
                    <div id="true_loadmore" class="button btnload">Загрузить ещё</div>
                </div>
            <?php endif; ?>
        </div>

    </div>

<?php get_footer(); ?>