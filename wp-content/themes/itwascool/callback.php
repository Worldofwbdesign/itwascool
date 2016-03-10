<?php
/*
Template Name: Форма обратной связи
*/
?>

<?php get_header(); ?>
    <div class="content">

        <div class="container">
            <div class="row">


                <?php if ( have_posts() ) : ;
                    while (have_posts()) : the_post(); ?>
                        <div class="col-md-8 col-md-offset-2">
                            <div class="post">

                                <div class="post-content text-center">
                                    <h2 class="callback-head"><?php the_title(); ?></h2>
                                    <form class="main-form" action="">

                                        <!-- Hidden Required Fields -->
                                        <input type="hidden" name="project_name" value="ItWasCool">
                                        <input type="hidden" name="admin_email" value="admin@mail.ru">
                                        <input type="hidden" name="form_subject" value="Main_Form">
                                        <!-- END Hidden Required Fields -->

                                        <label>
                                            <span>Ваше имя *</span>
                                            <input type="text" name="name" required>
                                        </label>
                                        <label>
                                            <span>Телефон *</span>
                                            <input type="tel" name="phone" required>
                                        </label>
                                        <label>
                                            <span>Email *</span>
                                            <input type="text" name="email" required>
                                        </label>
                                        <label>
                                            <span>Сообщение</span>
                                            <textarea name="message"></textarea>
                                        </label>
                                        <button type="submit">Отправить</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; endif; wp_reset_query(); ?>
            </div>
        </div>

    </div>

<?php get_footer(); ?>