<?php get_header(); ?>

<div class="content">

    <div class="container">
        <div class="row">


            <?php if ( have_posts() ) : ;
                while (have_posts()) : the_post(); ?>
                    <div class="col-md-6 col-md-offset-3">
                        <div class="post">
                            <div class="img-wrapp" style="background-image: url(<?php
                            if ( has_post_thumbnail() ) {
                                the_post_thumbnail_url();
                            }
                            ?>">
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
                                <span class="author">от Ирина Гуреева</span>
                                <?php the_content(); ?>

                            </div>
                            <div class="post-footer">
                                <span class="date"><?php echo get_the_date(); ?></span>
							    <span class="views"><?php if(function_exists('the_views')) { the_views(); } ?></span>
                                <?php echo getPostLikeLink(get_the_ID()); ?>
                            </div>
                        </div>
                    </div>
                <?php endwhile; endif; wp_reset_query(); ?>

        </div>
    </div>

</div>

<?php get_footer(); ?>
