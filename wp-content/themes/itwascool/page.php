<?php get_header(); ?>
    <div class="content">

        <div class="container">
            <div class="row">


                <?php if ( have_posts() ) : ;
                    while (have_posts()) : the_post(); ?>
                        <div class="col-md-8 col-md-offset-2">
                            <div class="post">

                                <div class="post-content">
                                    <h2><?php the_title(); ?></h2>
                                    <?php the_content(); ?>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; endif; wp_reset_query(); ?>
            </div>
        </div>

    </div>

<?php get_footer(); ?>