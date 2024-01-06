<?php

add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {
	wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
}

// 画像サイズを追加する
add_image_size('portfolio_size', 800, 800,true);

// メディアライブラリに画像サイズを登録する
add_filter( 'image_size_names_choose', 'my_custom_image_sizes' );
if( ! function_exists('my_custom_image_sizes') ) {
	function my_custom_image_sizes( $sizes ) {
		return array_merge( $sizes, array(
			'portfolio_size' => __('制作事例'),
		) );
	}
}

//カスタムメニュー対応
add_theme_support( 'menus' );
register_nav_menus(array(
		'pickup-contents02' => 'トップページの記念日コンテンツ',
	)
);
