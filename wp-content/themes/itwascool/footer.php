<footer class="main-foot">

    <div class="container">
        <div class="row">

            <div class="col-md-3">
                <div class="logo-wrapper">
                    <a href="/" class="logo">Itwas<br><span>.cool</span></a>
                </div>
            </div>
            <div class="col-md-4">
                <h3>Категории</h3>
                <nav class="bottom-mnu">
                    <?php wp_nav_menu(); ?>
                </nav>
            </div>

            <div class="col-md-2">
                <h3>О нас</h3>
                <nav class="bottom-mnu about">
                    <ul>
                        <li><a href="/about">О проекте</a></li>
                        <li><a href="/callback">Обратная связь</a></li>
                    </ul>
                </nav>
            </div>

            <div class="col-md-3">
                <h3>Оставайтесь на связи</h3>
                <nav class="bottom-mnu social">
                    <ul>
                        <li><a href="#" class="facebook"></a></li>
                        <li><a href="#" class="instagram"></a></li>
                        <li><a href="#" class="vkontakte"></a></li>
                    </ul>
                </nav>
            </div>

        </div>
    </div>

    <div class="copyright">

        <div class="container">
            <div class="col-md-12">
                &copy; <?php echo date("Y"); ?> itwas.cool. Все права защищены.
            </div>
        </div>

    </div>

</footer>

<div class="hidden"></div>

<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/libs/html5shiv/es5-shim.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/libs/html5shiv/html5shiv.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/libs/html5shiv/html5shiv-printshiv.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/libs/respond/respond.min.js"></script>
<![endif]-->

<!-- Load Scripts Start -->
<script>var scr = {"scripts":[
        {"src" : "<?php echo get_template_directory_uri(); ?>/js/libs.js", "async" : false},
        {"src" : "<?php echo get_template_directory_uri(); ?>/libs/vegas/vegas.min.js", "async" : false},
        {"src" : "<?php echo get_template_directory_uri(); ?>/libs/equalHeights/jquery.equalheights.min.js", "async" : false},
        {"src" : "<?php echo get_template_directory_uri(); ?>/js/common.js", "async" : false}
    ]};!function(t,n,r){"use strict";var c=function(t){if("[object Array]"!==Object.prototype.toString.call(t))return!1;for(var r=0;r<t.length;r++){var c=n.createElement("script"),e=t[r];c.src=e.src,c.async=e.async,n.body.appendChild(c)}return!0};t.addEventListener?t.addEventListener("load",function(){c(r.scripts);},!1):t.attachEvent?t.attachEvent("onload",function(){c(r.scripts)}):t.onload=function(){c(r.scripts)}}(window,document,scr);
</script>
<!-- Load Scripts End -->
<?php wp_footer(); ?>
</body>
</html>