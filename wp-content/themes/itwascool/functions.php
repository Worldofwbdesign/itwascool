<?php
//Поддержка миниатю для постов
add_theme_support( 'post-thumbnails' );

/* Подсчет количества посещений страниц
---------------------------------------------------------- */
add_action('wp_head', 'kama_postviews');
function kama_postviews() {

    /* ------------ Настройки -------------- */
    $meta_key       = 'views';  // Ключ мета поля, куда будет записываться количество просмотров.
    $who_count      = 1;            // Чьи посещения считать? 0 - Всех. 1 - Только гостей. 2 - Только зарегистрированных пользователей.
    $exclude_bots   = 1;            // Исключить ботов, роботов, пауков и прочую нечесть :)? 0 - нет, пусть тоже считаются. 1 - да, исключить из подсчета.

    global $user_ID, $post;
    if(is_singular()) {
        $id = (int)$post->ID;
        static $post_views = false;
        if($post_views) return true; // чтобы 1 раз за поток
        $post_views = (int)get_post_meta($id,$meta_key, true);
        $should_count = false;
        switch( (int)$who_count ) {
            case 0: $should_count = true;
                break;
            case 1:
                if( (int)$user_ID == 0 )
                    $should_count = true;
                break;
            case 2:
                if( (int)$user_ID > 0 )
                    $should_count = true;
                break;
        }
        if( (int)$exclude_bots==1 && $should_count ){
            $useragent = $_SERVER['HTTP_USER_AGENT'];
            $notbot = "Mozilla|Opera"; //Chrome|Safari|Firefox|Netscape - все равны Mozilla
            $bot = "Bot/|robot|Slurp/|yahoo"; //Яндекс иногда как Mozilla представляется
            if ( !preg_match("/$notbot/i", $useragent) || preg_match("!$bot!i", $useragent) )
                $should_count = false;
        }

        if($should_count)
            if( !update_post_meta($id, $meta_key, ($post_views+1)) ) add_post_meta($id, $meta_key, 1, true);
    }
    return true;
}

//Поддержка меню
register_nav_menus(array(
    'top'    => 'Главное меню',    //Название месторасположения меню в шаблоне
));


//Featured news
if ( function_exists('register_sidebar') )
    register_sidebar( array(
        'name' => __( 'Рекомендуемые новости', '' ),
        'id' => 'featured_news',
        'description' => __( 'Блок рекомендуемых новостей', '' ),
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '<h4 class="recommend">',
        'after_title' => '</h4>'
    ));

//Длинна текста цитаты
function new_excerpt_length($length) {
    return 40;
}
add_filter('excerpt_length', 'new_excerpt_length');

//Окончание цитаты
add_filter('excerpt_more', function($more) {
    return '...';
});

//AJAX загрузка контента
function true_loadmore_scripts() {
    wp_enqueue_script('jquery'); // скорее всего он уже будет подключен, это на всякий случай
    wp_enqueue_script( 'true_loadmore', get_stylesheet_directory_uri() . '/js/loadmore.js', array('jquery') );
}

add_action( 'wp_enqueue_scripts', 'true_loadmore_scripts' );

function true_load_posts(){
    $args = unserialize(stripslashes($_POST['query']));
    $args['paged'] = $_POST['page'] + 1; // следующая страница
    $args['post_status'] = 'publish';
    $q = new WP_Query($args);
    if( $q->have_posts() ):
        while($q->have_posts()): $q->the_post();
            ?>
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
                        <span class="author">от <?php echo get_the_author(); ?></span>
                        <?php the_excerpt(); ?>

                    </div>
                    <div class="post-footer">
                        <span class="date"><?php echo get_the_date( get_option('date_format') ); ?></span>
                        <span class="views"><?php if(function_exists('the_views')) { the_views(); } ?></span>
                        <?php echo getPostLikeLink(get_the_ID()); ?> <!-- Likes -->
                        <script>jQuery(document).ready(function() {
                                jQuery(".post-like a").click(function(){
                                    heart = jQuery(this);
                                    // Retrieve post ID from data attribute
                                    post_id = heart.data("post_id");
                                    // Ajax call
                                    jQuery.ajax({
                                        type: "post",
                                        url: ajax_var.url,
                                        data: "action=post-like&nonce="+ajax_var.nonce+"&post_like=&post_id="+post_id,
                                        success: function(count){
                                            // If vote successful
                                            if(count != "already")
                                            {
                                                heart.addClass("voted");
                                                heart.siblings(".count").text(count);
                                            }
                                        }
                                    });
                                    return false;
                                })
                            })</script>
                    </div>
                </div>
            </div>
            <script>$(".post-content").equalHeights();</script>
            <?php
        endwhile;
    endif;
    wp_reset_postdata();
    die();
}


add_action('wp_ajax_loadmore', 'true_load_posts');
add_action('wp_ajax_nopriv_loadmore', 'true_load_posts');
//AJAX загрузка контента END

//Лайки
add_action('wp_ajax_nopriv_post-like', 'post_like');
add_action('wp_ajax_post-like', 'post_like');

wp_enqueue_script('like_post', get_template_directory_uri().'/js/post-like.js', array('jquery'), '1.0', true );
wp_localize_script('like_post', 'ajax_var', array(
    'url' => admin_url('admin-ajax.php'),
    'nonce' => wp_create_nonce('ajax-nonce')
));

function hasAlreadyVoted($post_id)
{

    global $timebeforerevote;
    // $timebeforerevote = 120; // = 2 hours - через сколько пользователь сможет проголосовать еще раз
    $timebeforerevote = 36000;
// Retrieve post votes IPs
    $meta_IP = get_post_meta($post_id, "voted_IP");
    $voted_IP = $meta_IP[0];
    if(!is_array($voted_IP))
        $voted_IP = array();
// Retrieve current user IP
    $ip = $_SERVER['REMOTE_ADDR'];
// If user has already voted
    if(in_array($ip, array_keys($voted_IP)))
    {
        $time = $voted_IP[$ip];
        $now = time();
// Compare between current time and vote time
        if(round(($now - $time) / 60) > $timebeforerevote)
            return false;
        return true;
    }
    return false;
}

function post_like()
{
    // Check for nonce security
    $nonce = $_POST['nonce'];
    if ( ! wp_verify_nonce( $nonce, 'ajax-nonce' ) )
        die ( 'Busted!');
    if(isset($_POST['post_like']))
    {
        // Retrieve user IP address
        $ip = $_SERVER['REMOTE_ADDR'];
        $post_id = $_POST['post_id'];
// Get voters'IPs for the current post
        $meta_IP = get_post_meta($post_id, "voted_IP");
        $voted_IP = $meta_IP[0];
        if(!is_array($voted_IP))
            $voted_IP = array();
// Get votes count for the current post
        $meta_count = get_post_meta($post_id, "votes_count", true);
// Use has already voted ?
        if(!hasAlreadyVoted($post_id))
        {
            $voted_IP[$ip] = time();
// Save IP and increase votes count
            update_post_meta($post_id, "voted_IP", $voted_IP);
            update_post_meta($post_id, "votes_count", ++$meta_count);
            // Display count (ie jQuery return value)
            echo $meta_count;
        }
        else
            echo "already";
    }
    exit;
}

function getPostLikeLink($post_id)
{
    $themename = "itwascool";
    $vote_count = get_post_meta($post_id, "votes_count", true);
    $output = '<p class="post-like">';
    if(hasAlreadyVoted($post_id))
        $output .= ' <span title="'.__('I like this article', $themename).'" class="like alreadyvoted"></span>';
    else
        $output .= '<a href="#" data-post_id="'.$post_id.'">
 <span  title="'.__('I like this article', $themename).'"class="qtip likes"></span>
 </a>';
    $output .= '<span class="count">'.$vote_count.'</span></p>';
    return $output;
}



