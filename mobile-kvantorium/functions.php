<?php
// Отключение обновлений
// add_filter('pre_site_transient_update_core',create_function('$a', "return null;"));
// wp_clear_scheduled_hook('wp_version_check');



// add_filter( 'get_search_form', 'my_search_form' );
// function my_search_form( $form ) {

// 	$form = '
// 	<form role="search" method="get" id="searchform" action="' . home_url( '/' ) . '" >
// 		<input type="text" value="' . get_search_query() . '" name="s" id="s" />
// 		<div class="search-form-input"><img src=""> <input type="submit" id="searchsubmit" value="" /></div>
// 	</form>';

// 	return $form;
// }

//custom login logo
function my_login_logo(){
   echo '
   <style type="text/css">
        #login h1 a { background: url('. get_permalink() .'/wp-content/uploads/2020/05/Logo-Airoclean.png) no-repeat 0 0 !important;height:53px;width:210px; }
    </style>';
}
add_action('login_head', 'my_login_logo');

//like-button
// function test_function() {
//       $input_test = $_POST['like_post'];
// 			$post_id = $_POST['post_id'];
//       update_field('лайки', $input_test , $post_id );
//    }
// add_action( 'wp_ajax_nopriv_test_function',  'test_function' );
// add_action( 'wp_ajax_test_function','test_function' );


//Добавление поддержки темы
if (function_exists('add_theme_support')) {
	add_theme_support('menus');
	add_theme_support( 'custom-logo' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'wp-block-styles' );
}
add_image_size( 'main_thumb', 1300, 600, true );
add_image_size( 'prod_thumb', 600, 276, true );


//ajax load more post
// function more_post_ajax(){

//     $ppp = (isset($_POST["ppp"])) ? $_POST["ppp"] : 3;
//     $page = (isset($_POST['pageNumber'])) ? $_POST['pageNumber'] : 0;

//     header("Content-Type: text/html");

//     $args = array(
//         'suppress_filters' => true,
//         'post_type' => 'post',
//         'posts_per_page' => $ppp,
//         'paged'    => $page,
//     );

//     $loop = new WP_Query($args);

//     $out = '';

//     if ($loop -> have_posts()) :  while ($loop -> have_posts()) : $loop -> the_post();

	
// 		$category = get_the_category(); 
// if($category[0]->cat_ID == 1){$cat_calss = ' article';}
// if($category[0]->cat_ID == 4){$cat_calss = ' tip';}
// if($category[0]->cat_ID == 3){$cat_calss = ' review';}
	

	
// $image = get_field('маленькая_картинка_записи', get_the_ID());
// $url = $image['url']; 
// $alt = $image['alt'];

// $out .= '<a href="'.get_the_permalink().'" class="blog-list-card">
// <div class="blc-content">
// <div class="blc-img">
// <div class="b-slide-head '.$cat_calss.'">'. $category[0]->cat_name.'</div>
// <img class="blc-i-image" src="'.esc_url($url).'" alt="'.esc_attr($alt).'"></div>
// <h4 class="blc-title bloc-t">'.get_the_title().'</h4>
// <div class="blc-descr descr">'.trim_excerpt([ 'maxchar'=>80 ]).'</div>
// <div class="blc-footer sb-c"><span class="blc-footer-data">'.get_the_time('d/m/Y').'</span>
// <div class="s-c blc-footer-view">
// 	<div class="blc-fv-img c-c">
// 		<img src="'.get_template_directory_uri().'/img/icons/eye-darc.svg" alt="Иконка просмотры">
// 	</div>
// 	<span>'.get_field('просмотры', get_the_ID()).'</span>
// </div>
// </div>
// </div>
// </a>';
	
	
	
    endwhile;
    endif;
    wp_reset_postdata();
    die($out);
}

add_action('wp_ajax_nopriv_more_post_ajax', 'more_post_ajax');
add_action('wp_ajax_more_post_ajax', 'more_post_ajax');




//add newpost tipe portfolio

add_action('init', 'my_custom_init');
function my_custom_init(){
	register_post_type('portfolio', array(
		'labels'             => array(
			'name'               => 'Портфолио проектов', // Основное название типа записи
			'singular_name'      => 'Проект', // отдельное название записи типа Book
			'add_new'            => 'Добавить новый проект',
			'add_new_item'       => 'Добавить новый проект',
			'edit_item'          => 'Редактировать проект',
			'new_item'           => 'Новвй проект',
			'view_item'          => 'Посмотреть проект',
			'search_items'       => 'Найти проект',
			'not_found'          =>  'Проектов не найдено',
			'not_found_in_trash' => 'В корзине проектов не найдено',
			'parent_item_colon'  => '',
			'menu_name'          => 'Портфолио'

		  ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => true,
		'menu_icon' => 'dashicons-media-document',
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array('title','editor','author')
	) );
}






//trim post descr

function trim_excerpt( $args = '' ){
global $post;

	if( is_string($args) )
		parse_str( $args, $args );

	$rg = (object) array_merge( array(
		'maxchar'     => 350,   // Макс. количество символов.
		'text'        => '',    // Какой текст обрезать (по умолчанию post_excerpt, если нет post_content.
								// Если в тексте есть `<!--more-->`, то `maxchar` игнорируется и берется
								// все до <!--more--> вместе с HTML.
		'autop'       => true,  // Заменить переносы строк на <p> и <br> или нет?
		'save_tags'   => '',    // Теги, которые нужно оставить в тексте, например '<strong><b><a>'.
		'more_text'   => 'Читать дальше...', // Текст ссылки `Читать дальше`.
		'ignore_more' => false, // нужно ли игнорировать <!--more--> в контенте
	), $args );

	$rg = apply_filters( 'kama_excerpt_args', $rg );

	if( ! $rg->text )
		$rg->text = $post->post_excerpt ?: $post->post_content;

	$text = $rg->text;
	// убираем блочные шорткоды: [foo]some data[/foo]. Учитывает markdown
	$text = preg_replace( '~\[([a-z0-9_-]+)[^\]]*\](?!\().*?\[/\1\]~is', '', $text );
	// убираем шоткоды: [singlepic id=3]. Учитывает markdown
	$text = preg_replace( '~\[/?[^\]]*\](?!\()~', '', $text );
	$text = trim( $text );

	// <!--more-->
	if( ! $rg->ignore_more  &&  strpos( $text, '<!--more-->') ){
		preg_match('/(.*)<!--more-->/s', $text, $mm );

		$text = trim( $mm[1] );

		$text_append = ' <a href="'. get_permalink( $post ) .'#more-'. $post->ID .'">'. $rg->more_text .'</a>';
	}
	// text, excerpt, content
	else {
		$text = trim( strip_tags($text, $rg->save_tags) );

		// Обрезаем
		if( mb_strlen($text) > $rg->maxchar ){
			$text = mb_substr( $text, 0, $rg->maxchar );
			$text = preg_replace( '~(.*)\s[^\s]*$~s', '\\1...', $text ); // кил последнее слово, оно 99% неполное
		}
	}

	// сохраняем переносы строк. Упрощенный аналог wpautop()
	if( $rg->autop ){
		$text = preg_replace(
			array("/\r/", "/\n{2,}/", "/\n/",   '~</p><br ?/?>~'),
			array('',     '</p><p>',  '<br />', '</p>'),
			$text
		);
	}

	$text = apply_filters( ' trim_excerpt', $text, $rg );

	if( isset($text_append) )
		$text .= $text_append;

	return ( $rg->autop && $text ) ? "<p>$text</p>" : $text;
}


//css js
add_action( 'wp_enqueue_scripts', 'styles__theme' );
add_action('wp_footer', 'add_scripts');

function styles__theme() {
	wp_enqueue_style( 'aeroclin', get_stylesheet_uri() );
	wp_enqueue_style( 'nuled', get_template_directory_uri() . '/css/nuled.css');
	wp_enqueue_style( 'style', get_template_directory_uri() . '/css/style.css' );
	wp_enqueue_style( 'fonts', 'https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">');
	//jquery
	wp_deregister_script('jquery-core');
	wp_deregister_script('jquery-ui');
	wp_deregister_script('jquery');
	wp_register_script( 'jquery-core', 'https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js', false, null, true );
	wp_register_script( 'jquery', false, array('jquery-core'), null, true );
	wp_enqueue_script( 'jquery' );

}
function add_scripts() {
		wp_enqueue_script('script', get_template_directory_uri() . '/js/script.js', array('jquery'));
	if(is_page_template('contact-us-page.php')){
		wp_enqueue_script('map','https://api-maps.yandex.ru/2.1/?apikey=93fece7a-9fe4-47c6-80de-eaea41ec7d4a&lang=ru_RU', array('jquery'));
		wp_enqueue_script('map-init', get_template_directory_uri() . '/js/map.js', array('jquery','map'));
	}else{
		
	

	wp_enqueue_script('slider', get_template_directory_uri() . '/js/slider.js', array('jquery'));
		if(is_page_template('portfolio-page.php')) {
		wp_enqueue_script('galery', get_template_directory_uri() .'/js/jquery.fancybox.min.js', array('jquery'));
		wp_enqueue_style( 'galery-css', get_template_directory_uri() . '/css/galery.css' );
	}
		}
}
 


//defer js load
function mihdan_add_defer_attribute( $tag, $handle ) {
    
  $handles = array(
    'cookies',
    'modal',
	  'fc-modal',
	  'fc-form',
	  
  );
    
   foreach( $handles as $defer_script) {
      if ( $defer_script === $handle ) {
         return str_replace( ' src', ' defer="defer" src', $tag );
      }
   }
 
   return $tag;
}
add_filter( 'script_loader_tag', 'mihdan_add_defer_attribute', 10, 2 );




//ACF cancel update
add_filter( 'site_transient_update_plugins', 'filter_plugin_updates' );
function filter_plugin_updates( $value ) {
	unset( $value->response['advanced-custom-fields-pro/acf.php'] );
	return $value;
}


function my_acf_init() {
	
	if( function_exists('acf_add_options_page') ) {

		
acf_add_options_page(array(
		'page_title' 	=> 'Слайдер на главной странице',
		'menu_title'	=> 'Слайдер',
		'menu_slug' 	=> 'theme-general-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false,
	'icon_url' => 'dashicons-email',
	));
}
}

add_action('acf/init', 'my_acf_init');

// function register_acf_block_types() {

// 	// register a testimonial block.
// 	acf_register_block_type(array(
// 			'name'              => 'slider',
// 			'title'             => __('Слайдер под меню'),
// 			'description'       => __('Блок с добавление слайдера и собственных картинок'),
// 			'render_template'   => 'blocks/hero-slider.php',
// 			'category'          => 'layout',
// 			'mode' => 'auto',
// 			'icon' => 'welcome-widgets-menus',
// 			'align' => 'wide',
// 			'keywords'          => array( 'Слайдер', 'Первый блок' )));
	

// // register blocks
// if( function_exists('acf_register_block_type') ) {
// 	add_action('acf/init', 'register_acf_block_types');
// }


