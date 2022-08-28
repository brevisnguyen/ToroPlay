<?php

if (!class_exists('tp_color_scheme')) {
class tp_color_scheme {
	public function __construct() {
        
		add_action( 'customize_register', array( $this, 'customizer_register' ) );
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'customize_js' ) );
		add_action( 'customize_controls_print_footer_scripts', array( $this, 'color_scheme_template' ) );
		add_action( 'customize_preview_init', array( $this, 'customize_preview_js' ) );
		add_action( 'wp_head', array( $this, 'output_css' ), 200 );

	}

	public $options = array(
        'tp_color_a',
        'tp_color_b',
        'tp_color_c',
        'tp_color_d',
        'tp_color_e',
        'tp_color_f',
	);

	public function get_color_schemes() {
        return array(
            'default' => array(
                'label'  => __( 'Default', 'toroplay' ),
                'colors' => array(
                    '#eceff1',
                    '#fff',
                    '#9c27b0',
                    '#ffc107',
                    '#ff5722',
                    '#78909c',
                ),
            ),
            'dark' => array(
                'label'  => __( 'Dark', 'toroplay' ),
                'colors' => array(
                    '#263238',
                    '#fff',
                    '#263238',
                    '#ffc107',
                    '#B71C1C',
                    '#78909c',
                ),
            ),
            'blue' => array(
                'label'  => __( 'Blue', 'toroplay' ),
                'colors' => array(
                    '#eceff1',
                    '#fff',
                    '#3f51b5',
                    '#00B0FF',
                    '#00B0FF',
                    '#78909c',
                ),
            ),
        );
	}

	public function customizer_register( WP_Customize_Manager $wp_customize ) {
        
		$color_schemes = $this->get_color_schemes();
		$choices = array();
		foreach ( $color_schemes as $color_scheme => $value ) {
	       $choices[$color_scheme] = $value['label'];
		}
        
		$wp_customize->add_section( 'trcolors', array(
            'title' => __( 'Colors', 'toroplay' ),
            'priority' => 3
		) );
        
        $wp_customize->add_setting('color_scheme', array(
            'default' => 'default',
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'sanitize_text_field',
        ));

        $wp_customize->add_control( 'color_scheme', array(
            'label'    => __('Color scheme', 'toroplay'),
            'section'  => 'trcolors',
            'type'    => 'select',
            'choices' => $choices,
        ));
    

		$options = array(
            'tp_color_a' => __( 'Web Background', 'toroplay' ),
            'tp_color_b' => __( 'Content Background', 'toroplay' ),
            'tp_color_c' => __( 'General Color #1', 'toroplay' ),
            'tp_color_d' => __( 'General Color #2', 'toroplay' ),
            'tp_color_e' => __( 'General Color #3', 'toroplay' ),
            'tp_color_f' => __( 'General Color #4', 'toroplay' ),
		);
        
        $i=0;
		foreach ( $options as $key => $label ) {
            
            $i++; $rest=$i-1;
            
            $wp_customize->add_setting( $key, array(
                'sanitize_callback' => 'sanitize_hex_color',
                'transport' => 'postMessage',
                'default' => $color_schemes['default']['colors'][$rest],
                'capability'     => 'edit_theme_options',
            ) );
            
            $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $key, array(
                'label' => $label,
                'section' => 'trcolors',
            ) ) );
            
		}

	}

	public $is_custom = false;

	public function get_color_scheme() {
        
        $color_schemes = $this->get_color_schemes();
        $color_scheme  = get_theme_mod( 'trcolor_scheme' );
        $color_scheme  = isset( $color_schemes[$color_scheme] ) ? $color_scheme : 'default';

        if ( 'default' != $color_scheme ) $this->is_custom = true;

        $colors = array_map( 'strtolower', $color_schemes[$color_scheme]['colors'] );

        foreach ( $this->options as $k => $option ) {
            $color = get_theme_mod( $option );
            if ( $color && strtolower( $color ) != $colors[$k] ) {
                $colors[$k] = $color;
                $this->is_custom = true;
            }
        }
        
        return $colors;
        
	}

	public function output_css() {
        $colors = $this->get_color_scheme();

        echo '
        <style id="tp_style_css" type="text/css">
            '.$this->get_css( $colors ).'
        </style>
        '."\n\r";
	}

	public function get_css( $colors ) {
        
        $css = '';

        $css .= '
        /*Web Background*/body{background-color: %1$s }
        /*Content Background*/.Body .Content{background-color: %2$s }

        /*General Color #1*/
        .BgA,.Button:hover,a.Button:hover,button:hover,input[type="button"]:hover,input[type="reset"]:hover,input[type="submit"]:hover,.ListSocial a,.AZList>li:hover:before,.TpMvPlay:after,.Button.STPb:hover,.widget_categories>ul li:hover,.TPostBg:before,.FilterRadio span:before{background-color: %3$s }
        .ClA,a:hover,.Form-Icon input+i,.Form-Icon textarea+i,.Year,.SearchMovies label:before,.SearchMovies .sol-active .sol-caret:before,.SearchMovies .Form-Select select:focus+label:before,.widget_nav_menu>div>ul>li:hover:before,.widget_nav_menu>div>ul>li.current-menu-item:before,.widget_nav_menu>div>ul>li:hover>a,.widget_nav_menu>div>ul>li.current-menu-item>a,.widget_nav_menu>div>ul>li>i.On+a,.widget_nav_menu>div>ul>li>i.On+a:before,.Wdgt>.Title>span,.comment-reply-link:before,.Comment p a,.SearchMovies .Form-Group input:focus+i{color: %3$s }
        .Search .Form-Icon input{border-color: %3$s }
        @media screen and (min-width:62em){
            .Menu li li[class*="AAIco-"]:before,.Menu li li[class*="fa-"]:before{color: %3$s }
        }

        /*General Color #2*/
        .Menu>ul>li:hover:before,.Menu>ul>li.current-menu-item:before,.Menu>ul>li:hover>a,.Menu>ul>li.current-menu-item>a,.Menu>ul>li.current-cat:before,.Menu>ul>li.current-cat>a,.menu-item-has-children>i,p.Info>span.Vote:before,.TpMvPlay:before,.TPMvCn,.Button.STPa,.Description p[class]:before,.TPost.Single .Title,.TPlayer .Title strong,.MovieInfo .InfoList li a,.InfoList>li:before,.InfoList span:before,.MovieTabNav .Lnk.on,.MovieTabNav .Lnk.on:before,.ClB{color: %4$s }
        .ListSocial>li>a.Up,.Qlty,.Button.STPa:hover,.wp-pagenavi a:hover:after,.Wdgt>.Title:after,.TPost .Top,.ListPOpt>li>a.Fav.On,.BgB{background-color: %4$s }
        .Button.STPa,.pie,.percircle .bar,.gt50 .fill{border-color: %4$s }
        .Result,.TPost .Top>i:after,.TPost .Top>i:before,.SearchMovies .sol-selection-container,.SearchMovies .sol-selection-top .sol-selection-container:before,.MovieTabNav .Lnk.on:after,.trsrcbx{border-top-color: %4$s }
        .Result:before,.TPost .Top:before,.SearchMovies .sol-selection-top .sol-selection-container,.SearchMovies .sol-selection-container:before,.trsrcbx:before{border-bottom-color: %4$s }  
        .MovieTabNav .Lnk.on{box-shadow: inset 0 -3px 0 %4$s } 
        @media screen and (max-width:62em){
            .menu-item-has-children>i.On+a{color: %4$s }
        }
        @media screen and (min-width:62em){
            ::-webkit-scrollbar-thumb{background-color: %4$s }
            .Menu>ul>li.current-menu-item>a:before,.Menu>ul>li.current-cat>a:before{background-color: %4$s }
            .Menu>ul>li.menu-item-has-children:after,.widget_nav_menu>div>ul>li.menu-item-has-children:after{border-bottom-color: %4$s }
            .Menu .sub-menu,.widget_nav_menu>div>ul .sub-menu{border-top-color: %4$s }
        }

        /*General Color #3*/
        .Button,a.Button,button,input[type="button"],input[type="reset"],input[type="submit"],.show .MenuBtn,.show .MenuBtn:hover,.AZList>li.Current:before,.Button.STPb.Current,.MovieListSld .owl-controls .owl-page.active,.wp-pagenavi span.current:after,.TPost .Top.Num1,.sol-selected-display-item:hover,.trsrclst>li:hover,.ListPOpt>li>a.Rep,.ListPOpt>li>a.Fav,.TPlayer .lgtbx-lnk:hover,.BgC{background-color: %5$s }
        .TPost .Top.Num1>i:before,.TPost .Top.Num1>i:after{border-top-color: %5$s }
        .TPost .Top.Num1:before{border-bottom-color: %5$s } 

        /*General Color #4*/
        body,.AZList>li>a,.MenuFt>ul>li>a,.TPMvCn,.wp-pagenavi a,.TPost.C .Description p[class] span,.SearchMovies .Form-Group input{color: %6$s }
        .AZList>li:before,.MenuFt>ul>li:hover>a,.Button.STPb,.MovieListSldCn:before,.wp-pagenavi a:after,.wp-pagenavi span:after,.Wdgt:before,.Wdgt>.Title:before,.SearchMovies .sol-label:before,.sol-selected-display-item,.trsrclst>li,.trsrcbx label:before{background-color: %6$s }
        .MenuFt>ul>li>a,.MovieListSldCn:after{border-color: %6$s }';

        if( get_theme_mod('color_scheme', 'default') == 'default' ){

            $css .= '.TPost.B .Title{background:-moz-linear-gradient(top,rgba(0,0,0,0) 0,rgba(0,0,0,.65) 100|);background:-webkit-linear-gradient(top,rgba(0,0,0,0) 0,rgba(0,0,0,.65) 100|);background:linear-gradient(to bottom,rgba(0,0,0,0) 0,rgba(0,0,0,.65) 100|)}.TpMvPlay:before{box-shadow:0 0 0 2px #fff,0 0 10px rgba(0,0,0,.5)}.Body .Content{box-shadow:0 0 20px rgba(0,0,0,.05)}.TPostBg:after{box-shadow:inset 0 0 100px rgba(0,0,0,.5)}.percircle{box-shadow:inset 0 0 0 2px rgba(255,255,255,.2)}.TPost.Single footer{border-top-color:rgba(255,255,255,.2)}.MovieTabNav{border-bottom-color:rgba(255,255,255,.2)}.VotesCn{border-right-color:rgba(255,255,255,.2)}.InfoList{color:rgba(255,255,255,.7)}.Result,.SearchMovies .sol-container.sol-active .sol-selection-container,.TPMvCn,.trsrcbx{box-shadow:0 0 10px rgba(0,0,0,.1)}.CommentsList li li .Comment,.Form-Select label,.MovieListSld .owl-controls .owl-page,.Result,.TPMvCn,.sol-inner-container,.sol-selection-container,.trsrcbx,.widget_categories>ul li,.widget_nav_menu>div>ul>li.current-menu-item,.widget_nav_menu>div>ul>li:hover,.widget_nav_menu>div>ul>li>i.On+a,.widget_nav_menu>div>ul>li>i.On+a+ul,input,select,textarea{background-color:#fff}.Search .Form-Icon input:focus,.TpMvPlay:before{background-color:rgba(0,0,0,.4)}.TPost .Top:after{border-bottom-color:rgba(0,0,0,.4)}.EcBgA,.Header .Rght:before,.MenuBtnClose,.Search .Form-Icon input,.TPlayer .Title,.TPlayer .lgtbx-lnk,.TPostBg:after{background-color:rgba(0,0,0,.6)}.AZList>li.Current>a,.AZList>li>a:hover,.Button,.Button.STPa:hover,.InfoList span,.InfoList strong,.ListSocial a,.MenuFt>ul>li:hover>a,.MnBr .Menu>ul>li>a,.Qlty,.Search .Form-Icon input,.TPlayer .Title,.TPlayer .lgtbx-lnk,.TPost .Top.Num1,.TPost.B .Title,.TPost.Single,.TPost.Single a,.qtip,.sol-selected-display-item,.trsrclst>li,.widget_categories>ul li:hover,.wp-pagenavi a:hover,.wp-pagenavi span.current,a.Button,button,input[type=button],input[type=reset],input[type=submit]{color:#fff}.ListPOpt>li>a.Fav.On,.ListSocial>li>a.Up,.SearchMovies label,.TPTblCn th,.TPost .Top,.TPost.C .Description p[class],.TPost.C .TPMvCn .Title,.Wdgt>.Title,a,section>.Top>h1,section>.Top>.Title{color:#000}.ListGall figure:after,.ListVids figure:after{background-color:#000}.ListPOpt>li>a.Fcb,.ListPOpt>li>a.Ggl,.ListPOpt>li>a.Twt{border-color:#fff}@media screen and (max-width:62em){.MnBr .Menu>ul>li>a,.MnBr .menu-item-has-children>i.On+a{background-color:rgba(0,0,0,.2)}.MnBr .sub-menu{background-color:rgba(0,0,0,.4)}.MnBr .Menu li[class*=AAIco-]:before,.MnBr .Menu li[class*=fa-]:before,.MnBr .sub-menu a{color:#fff}}@media screen and (min-width:62em){.MnBr .Menu .sub-menu,.widget_nav_menu>div>ul .sub-menu{box-shadow:0 0 10px rgba(0,0,0,.1)}.TPost.D .Image:before,.TPost.D .TPMvCn{background-color:rgba(0,0,0,.4);color:#fff}.MnBr .Menu>ul>li[class*=AAIco-]:before,.MnBr .Menu>ul>li[class*=fa-]:before,.TPost.D .Description a,.TPost.D .Title{color:#fff}::-webkit-scrollbar{background-color:rgba(0,0,0,.3)}}';

        }elseif( get_theme_mod('color_scheme', 'default') == 'dark' ){
         
            $css.='.TPost.B .Title{background:-moz-linear-gradient(top,rgba(0,0,0,0) 0,rgba(0,0,0,.65) 100|);background:-webkit-linear-gradient(top,rgba(0,0,0,0) 0,rgba(0,0,0,.65) 100|);background:linear-gradient(to bottom,rgba(0,0,0,0) 0,rgba(0,0,0,.65) 100|)}.TpMvPlay:before{box-shadow:0 0 0 2px #fff,0 0 10px rgba(0,0,0,.5)}.Body .Content{box-shadow:0 0 20px rgba(0,0,0,.05)}.TPostBg:after{box-shadow:inset 0 0 100px rgba(0,0,0,.5)}.percircle{box-shadow:inset 0 0 0 2px rgba(255,255,255,.2)}.TPost.Single footer{border-top-color:rgba(255,255,255,.2)}.MovieTabNav{border-bottom-color:rgba(255,255,255,.2)}.VotesCn{border-right-color:rgba(255,255,255,.2)}.InfoList{color:rgba(255,255,255,.7)}.Result,.SearchMovies .sol-container.sol-active .sol-selection-container,.TPMvCn,.trsrcbx{box-shadow:0 0 10px rgba(0,0,0,.1)}.CommentsList li li .Comment,.Form-Select label,.MovieListSld .owl-controls .owl-page,.Result,.TPMvCn,.sol-inner-container,.sol-selection-container,.trsrcbx,.widget_categories>ul li,.widget_nav_menu>div>ul>li.current-menu-item,.widget_nav_menu>div>ul>li:hover,.widget_nav_menu>div>ul>li>i.On+a,.widget_nav_menu>div>ul>li>i.On+a+ul,input,select,textarea{background-color:#fff}.Search .Form-Icon input:focus,.TpMvPlay:before{background-color:rgba(0,0,0,.4)}.TPost .Top:after{border-bottom-color:rgba(0,0,0,.4)}.EcBgA,.Header .Rght:before,.MenuBtnClose,.Search .Form-Icon input,.TPlayer .Title,.TPlayer .lgtbx-lnk,.TPostBg:after{background-color:rgba(0,0,0,.6)}.AZList>li.Current>a,.AZList>li>a:hover,.Button,.Button.STPa:hover,.InfoList span,.InfoList strong,.ListSocial a,.MenuFt>ul>li>a:hover,.MnBr .Menu>ul>li>a,.Qlty,.Search .Form-Icon input,.TPlayer .Title,.TPlayer .lgtbx-lnk,.TPost .Top.Num1,.TPost.B .Title,.TPost.Single,.TPost.Single a,.qtip,.sol-selected-display-item,.trsrclst>li,.widget_categories>ul li:hover,.wp-pagenavi a:hover,.wp-pagenavi span.current,a.Button,button,input[type=button],input[type=reset],input[type=submit]{color:#fff}.ListPOpt>li>a.Fav.On,.ListSocial>li>a.Up,.TPTblCn th,.TPost .Top,.TPost.C .Description p[class],.Wdgt>.Title,a,section>.Top>h1,section>.Top>.Title{color:#fff}.ListGall figure:after,.ListVids figure:after{background-color:#000}.ListPOpt>li>a.Fcb,.ListPOpt>li>a.Ggl,.ListPOpt>li>a.Twt{border-color:#fff}@media screen and (max-width:62em){.MnBr .Menu>ul>li>a,.MnBr .menu-item-has-children>i.On+a{background-color:rgba(0,0,0,.2)}.MnBr .sub-menu{background-color:rgba(0,0,0,.4)}.MnBr .Menu li[class*=AAIco-]:before,.MnBr .Menu li[class*=fa-]:before,.MnBr .sub-menu a{color:#fff}}@media screen and (min-width:62em){.MnBr .Menu .sub-menu,.widget_nav_menu>div>ul .sub-menu{box-shadow:0 0 10px rgba(0,0,0,.1)}.TPost.D .Image:before,.TPost.D .TPMvCn{background-color:rgba(0,0,0,.4);color:#fff}.MnBr .Menu>ul>li[class*=AAIco-]:before,.MnBr .Menu>ul>li[class*=fa-]:before,.TPost.D .Description a,.TPost.D .Title{color:#fff}::-webkit-scrollbar{background-color:rgba(0,0,0,.3)}}';
            $css.='a:hover{color: #78909c}.TPMvCn{color: #F7F7F7;background-color: #395B64;}';
            
        }elseif( get_theme_mod('color_scheme', 'default') == 'blue' ){

            $css.= '.TPost.B .Title{background:-moz-linear-gradient(top,rgba(0,0,0,0) 0,rgba(0,0,0,.65) 100|);background:-webkit-linear-gradient(top,rgba(0,0,0,0) 0,rgba(0,0,0,.65) 100|);background:linear-gradient(to bottom,rgba(0,0,0,0) 0,rgba(0,0,0,.65) 100|)}.TpMvPlay:before{box-shadow:0 0 0 2px #fff,0 0 10px rgba(0,0,0,.5)}.Body .Content{box-shadow:0 0 20px rgba(0,0,0,.05)}.TPostBg:after{box-shadow:inset 0 0 100px rgba(0,0,0,.5)}.percircle{box-shadow:inset 0 0 0 2px rgba(255,255,255,.2)}.TPost.Single footer{border-top-color:rgba(255,255,255,.2)}.MovieTabNav{border-bottom-color:rgba(255,255,255,.2)}.VotesCn{border-right-color:rgba(255,255,255,.2)}.InfoList{color:rgba(255,255,255,.7)}.Result,.SearchMovies .sol-container.sol-active .sol-selection-container,.TPMvCn,.trsrcbx{box-shadow:0 0 10px rgba(0,0,0,.1)}.CommentsList li li .Comment,.Form-Select label,.MovieListSld .owl-controls .owl-page,.Result,.TPMvCn,.sol-inner-container,.sol-selection-container,.trsrcbx,.widget_categories>ul li,.widget_nav_menu>div>ul>li.current-menu-item,.widget_nav_menu>div>ul>li:hover,.widget_nav_menu>div>ul>li>i.On+a,.widget_nav_menu>div>ul>li>i.On+a+ul,input,select,textarea{background-color:#fff}.Search .Form-Icon input:focus,.TpMvPlay:before{background-color:rgba(0,0,0,.4)}.TPost .Top:after{border-bottom-color:rgba(0,0,0,.4)}.EcBgA,.Header .Rght:before,.MenuBtnClose,.Search .Form-Icon input,.TPlayer .Title,.TPlayer .lgtbx-lnk,.TPostBg:after{background-color:rgba(0,0,0,.6)}.AZList>li.Current>a,.AZList>li>a:hover,.Button,.Button.STPa:hover,.InfoList span,.InfoList strong,.ListSocial a,.MenuFt>ul>li>a:hover,.MnBr .Menu>ul>li>a,.Qlty,.Search .Form-Icon input,.TPlayer .Title,.TPlayer .lgtbx-lnk,.TPost .Top.Num1,.TPost.B .Title,.TPost.Single,.TPost.Single a,.qtip,.sol-selected-display-item,.trsrclst>li,.widget_categories>ul li:hover,.wp-pagenavi a:hover,.wp-pagenavi span.current,a.Button,button,input[type=button],input[type=reset],input[type=submit]{color:#fff}.ListPOpt>li>a.Fav.On,.ListSocial>li>a.Up,.SearchMovies label,.TPTblCn th,.TPost .Top,.TPost.C .Description p[class],.TPost.C .TPMvCn .Title,.Wdgt>.Title,a,section>.Top>h1,section>.Top>.Title{color:#000}.ListGall figure:after,.ListVids figure:after{background-color:#000}.ListPOpt>li>a.Fcb,.ListPOpt>li>a.Ggl,.ListPOpt>li>a.Twt{border-color:#fff}@media screen and (max-width:62em){.MnBr .Menu>ul>li>a,.MnBr .menu-item-has-children>i.On+a{background-color:rgba(0,0,0,.2)}.MnBr .sub-menu{background-color:rgba(0,0,0,.4)}.MnBr .Menu li[class*=AAIco-]:before,.MnBr .Menu li[class*=fa-]:before,.MnBr .sub-menu a{color:#fff}}@media screen and (min-width:62em){.MnBr .Menu .sub-menu,.widget_nav_menu>div>ul .sub-menu{box-shadow:0 0 10px rgba(0,0,0,.1)}.TPost.D .Image:before,.TPost.D .TPMvCn{background-color:rgba(0,0,0,.4);color:#fff}.MnBr .Menu>ul>li[class*=AAIco-]:before,.MnBr  .Menu>ul>li[class*=fa-]:before,.TPost.D .Description a,.TPost.D .Title{color:#fff}::-webkit-scrollbar{background-color:rgba(0,0,0,.3)}}';
            
        }
    
        return str_replace('|', '%', vsprintf( $css, $colors ));

	}

	public function color_scheme_template() {
    $colors = array(
      'tp_color_a'                 => '{{ data.tp_color_a }}',
      'tp_color_b'						=> '{{ data.tp_color_b }}',
      'tp_color_c'								=> '{{ data.tp_color_c }}',
      'tp_color_d'					=> '{{ data.tp_color_d }}',
      'tp_color_e'					=> '{{ data.tp_color_e }}',
      'tp_color_f'					=> '{{ data.tp_color_f }}',
    );
    ?>
    <script type="text/html" id="tmpl-tp-color-scheme">
      <?php echo $this->get_css( $colors ); ?>
    </script>
		<?php
	}

	public function customize_js() {
        
        wp_enqueue_script( 'tp-color-scheme', get_template_directory_uri() . '/inc/customizer/assets/js/color-scheme.js', array( 'customize-controls', 'iris', 'underscore', 'wp-util' ), '', true );
        wp_localize_script( 'tp-color-scheme', 'tpColorScheme', $this->get_color_schemes() );
	}

	public function customize_preview_js() {
        $myvars = array( 
            'ajaxurl' => admin_url( 'admin-ajax.php' ),
        );
		wp_enqueue_script( 'tp-color-scheme-preview', get_template_directory_uri() . '/inc/customizer/assets/js/color-scheme-preview.js', array( 'customize-preview' ), '', true );
        wp_localize_script( 'tp-color-scheme-preview', 'trColor', $myvars );
	}
}
}

new tp_color_scheme;