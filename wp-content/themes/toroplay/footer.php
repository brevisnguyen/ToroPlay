<?php
/**
 * The template for displaying the footer
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Toroplay
 */

?>

    </div>
    </div>
</div>
<!--</Body>-->

<!--<Footer>-->
<footer class="Footer">
    <div class="Top Container">

        <!--<MnBrCn>-->
        <div class="MnBrCn BgA">
            <div class="MnBr EcBgA">
                <div class="Container">
                    <figure class="Logo"><?php if ( function_exists( 'the_custom_logo' ) ) { the_custom_logo(); } ?></figure>
                    <!--<Rght>-->
                    <div class="Rght">
                        <!--<Menu>-->
                        <nav class="Menu">
                            <ul>
                                <?php wp_nav_menu(array('container' => false, 'theme_location' => 'secondary_menu', 'items_wrap' => '%3$s', 'fallback_cb' => 'tr_default_menu')); ?>
                            </ul>
                        </nav>
                        <!--</Menu>-->
                        <!--<ListSocial>-->
                        <ul class="ListSocial">
                            <?php
                                $facebook=get_theme_mod('tp_facebook', 'http://facebook.com/');
                                $twitter=get_theme_mod('tp_twitter', 'http://twitter.com/');
                                $googleplus=get_theme_mod('tp_googleplus', 'http://google.com/');
                                $youtube=get_theme_mod('tp_youtube', 'http://youtube.com/');

                                echo $facebook != '' ? '<li><a target="_blank" href="'.$facebook.'" class="fa-facebook"></a></li>' : '';
                                echo $twitter != '' ? '<li><a target="_blank" href="'.$twitter.'" class="fa-twitter"></a></li>' : '';
                                echo $googleplus != '' ? '<li><a target="_blank" href="'.$googleplus.'" class="fa-google-plus"></a></li>' : '';
                                echo $youtube != '' ? '<li><a target="_blank" href="'.$youtube.'" class="fa-youtube-play"></a></li>' : '';
                            ?>
                            <li><a href="#Tp-Wp" class="Up AAIco-arrow_upward"></a></li>
                        </ul>
                        <!--</ListSocial>-->
                    </div>
                    <!--</Rght>-->
                </div>
            </div>
        </div>
        <!--</MnBrCn>-->
    </div>
    <div class="Bot Container">
        <div class="WebDescription">
            <p><?php echo get_theme_mod('tp_footer', __('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut aliquet vestibulum ipsum vel laoreet. Donec varius sit amet justo vitae pulvinar. Morbi varius enim a lorem elementum, quis pretium quam semper. Duis consectetur quam lorem, nec faucibus tellus elementum quis. Praesent feugiat ut nibh vel euismod. Vivamus nulla odio, porta id felis sed, malesuada tempus turpis. Etiam non mauris ac mi efficitur gravida. Morbi tempor metus sed massa porta tempus. Ut sem felis, ornare nec lorem eget, tempor rhoncus est. Aliquam eget dui sed leo aliquet ultricies. Suspendisse nec tincidunt velit. Proin sagittis aliquet gravida. Etiam quam tortor, lobortis nec volutpat eget, ultricies non turpis. Sed fringilla, lectus id bibendum tristique, massa odio accumsan dolor, eget laoreet nibh risus ut massa.', 'toroplay')); ?></p>
        </div>
        <?php wp_nav_menu(array('container' => 'nav', 'container_class' => 'MenuFt Menu', 'menu_class' => 'MenuFt', 'theme_location' => 'footer_menu', 'items_wrap' => '<ul>%3$s</ul>', 'fallback_cb' => '__return_false')); ?>
        <p class="Copy"><?php echo tp_link_footer(); ?></p>
    </div>
</footer>
<!--</Footer>-->
</div>
<!--</Tp-Wp>-->

<?php wp_footer(); ?>

<!--[ToroThemes]><CSS Framework v5.0><[contacto@torothemes.com]-->

</body>
</html>