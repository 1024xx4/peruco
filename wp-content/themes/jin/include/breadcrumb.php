<?php

function breadcrumbs($args = array()){
    global $post;
    $defaults = array(
        'id' => "breadcrumb",
        'class' => jin_footer_type(),
        'home' => "HOME",
        'search' => "で検索した結果",
        'tag' => "タグ",
        'author' => "投稿者",
        'notfound' => "ページが見つかりませんでした",
        'separator' => '<i class="jic jin-ifont-arrow space" aria-hidden="true"></i>',
        'textContainer' => '',
        'liOption' => ' itemscope itemtype="http://data-vocabulary.org/Breadcrumb"',
        'aOption' => ' itemprop="url"',
        'spanOption' => ' itemprop="title"'
    );
    $args = wp_parse_args( $args, $defaults );
    extract( $args, EXTR_SKIP );

    if($separator == '') {
        $separatorHTML = $separator;
    } else {
        $separatorHTML = '<li>'.$separator.'</li>';
    }
    if($textContainer == '') {
        $startTextContainer =  '';
        $endTextContainer = '';
    } else {
        $startTextContainer =  '<' . $textContainer . '>';
        $endTextContainer =  '</' . $textContainer . '>';
    }
	
	$str = ""; //Notice回避用
    if(is_home()) {
    }
    if(!is_home()&&!is_admin()){
        $str.= '<div id="'. $id .'" class="' . $class.'">';
        $str.= '<ul itemprop="breadcrumb"><div class="page-top-footer"><a class="totop"><i class="jic jin-ifont-arrow-top"></i></a></div>';
        $str.= '<li class="bcHome"' . $liOption . '><a href="'. home_url() .'/"' . $aOption . '><i class="jic jin-ifont-home space-i" aria-hidden="true"></i><span itemprop="name">'. $home .'</span></a></li>';
        $str.= $separatorHTML;
        $my_taxonomy = get_query_var('taxonomy');
        $cpt = get_query_var('post_type');
        if($my_taxonomy &&  is_tax($my_taxonomy)) {
            $my_tax = get_queried_object();
            $post_types = get_taxonomy( $my_taxonomy )->object_type;
            $cpt = $post_types[0];
            $str.='<li' . $liOption . '><a href="' .get_post_type_archive_link($cpt).'"' . $aOption . '><span' . $spanOption . '>'. get_post_type_object($cpt)->label.'</span></a></li>';
            $str.= $separatorHTML;
            if($my_tax -> parent != 0) {
                $ancestors = array_reverse(get_ancestors( $my_tax -> term_id, $my_tax->taxonomy ));
                foreach($ancestors as $ancestor){
                    $str.='<li' . $liOption . '><a href="'. get_term_link($ancestor, $my_tax->taxonomy) .'"' . $aOption . '><span' . $spanOption . '>'. get_term($ancestor, $my_tax->taxonomy)->name .'</span></a></li>';
                    $str.= $separatorHTML;
                }
            }
            $str.='<li>' . $startTextContainer . $my_tax -> name . $endTextContainer . '</li>';
        }elseif(is_category()) {
            $cat = get_queried_object();
            if($cat -> parent != 0){
                $ancestors = array_reverse(get_ancestors( $cat -> cat_ID, 'category' ));
                foreach($ancestors as $ancestor){
                    $str.='<li' . $liOption . '><a href="'. get_category_link($ancestor) .'"' . $aOption . '><span' . $spanOption . '>'. get_cat_name($ancestor) .'</span></a></li>';
                    $str.= $separatorHTML;
                }
            }
            $str.='<li>' . $startTextContainer. $cat -> name . $endTextContainer . '</li>';
        }elseif(is_post_type_archive()) {
            $cpt = get_query_var('post_type');
            if(is_date()) {
                $str.='<li' . $liOption . '><a href="' .get_post_type_archive_link($cpt).'"' . $aOption . '><span' . $spanOption . '>'. get_post_type_object($cpt)->label.'</span></a></li>';
                if(get_query_var('day') != 0){
                    $postTyleLink = get_post_type_archive_link(get_post_type());
                    $str.='<li' . $liOption . '><a href="'. $postTyleLink . 'date/'  . get_query_var('year') . '/"' . $aOption . '><span' . $spanOption . '>' . get_query_var('year'). '年</span></a></li>';
                    $str.= $separatorHTML;
                    $str.='<li' . $liOption . '><a href="'. $postTyleLink . 'date/'  . get_query_var('year') . '/'  . get_query_var('monthnum'). '/"' . $aOption . '><span' . $spanOption . '>'. get_query_var('monthnum') .'月</span></a></li>';
                    $str.= $separatorHTML;
                    $str.='<li' . $liOption . '><span' . $spanOption . '>' . $startTextContainer. get_query_var('day'). '日</strong></span></li>';
                } elseif(get_query_var('monthnum') != 0){
                    $postTyleLink = get_post_type_archive_link(get_post_type());
                    $str.='<li' . $liOption . '><a href="'. $postTyleLink . 'date/'  . get_query_var('year') . '/"' . $aOption . '><span' . $spanOption . '>'. get_query_var('year') .'年</span></a></li>';
                    $str.= $separatorHTML;
                    $str.='<li' . $liOption . '><span' . $spanOption . '>' . $startTextContainer. get_query_var('monthnum'). '月</strong></span></li>';
                } else {
                    $str.='<li' . $liOption . '><span' . $spanOption . '>' . $startTextContainer. get_query_var('year') .'年</strong></span></li>';
                }
            } else {
                $str.='<li>' . $startTextContainer. get_post_type_object($cpt)->label . $endTextContainer . '</li>';
            }
        }elseif($cpt && is_singular($cpt)){
			$taxes = get_object_taxonomies( $cpt  );
			$mytax = isset($taxes[0]);
            $str.='<li' . $liOption . '><a href="' .get_post_type_archive_link($cpt).'"' . $aOption . '><span' . $spanOption . '>'. get_post_type_object($cpt)->label.'</span></a></li>';
            $str.= $separatorHTML;
            $taxes = get_the_terms($post->ID, $mytax);
            $tax = $taxes ? cps_get_youngest_tax($taxes, $mytax ) : null;
            if( !empty($tax) ) {
                if($tax -> parent != 0){
                    $ancestors = array_reverse(get_ancestors( $tax -> term_id, $mytax ));
                        foreach($ancestors as $ancestor){
                            $str.='<li' . $liOption . '><a href="'. get_term_link($ancestor, $mytax).'"' . $aOption . '><span' . $spanOption . '>'. get_term($ancestor, $mytax)->name . '</span></a></li>';
                            $str.= $separatorHTML;
                        }
                }
				$str.='<li' . $liOption . '><a href="'. get_term_link($tax, $mytax).'"' . $aOption . '><span' . $spanOption . '>'. $tax -> name . '</span></a></li>';
            	$str.= $separatorHTML;
            }
            $str.= '<li' . $liOption . '><span' . $spanOption . '>' . $startTextContainer. $post -> post_title .$endTextContainer . '</span></li>';
			
        }elseif(is_single() && ! is_attachment()){
            $categories = get_the_category($post->ID);
            $cat = cps_get_youngest_cat($categories);
            if($cat -> parent != 0){
                $ancestors = array_reverse(get_ancestors( $cat -> cat_ID, 'category' ));
                foreach($ancestors as $ancestor){
                    $str.='<li' . $liOption . '><a href="'. get_category_link($ancestor).'"' . $aOption . '><span' . $spanOption . '>'. get_cat_name($ancestor). '</span></a></li>';
                    $str.= $separatorHTML;
                }
            }
            $str.='<li' . $liOption . '><a href="'. get_category_link($cat -> term_id). '"' . $aOption . '><span' . $spanOption . '>'. $cat-> cat_name . '</span></a></li>';
            $str.= $separatorHTML;
            $str.= '<li>' . $startTextContainer. $post -> post_title .$endTextContainer . '</li>';
        } elseif(is_page()){
            if($post -> post_parent != 0 ){
                $ancestors = array_reverse(get_post_ancestors( $post->ID ));
                foreach($ancestors as $ancestor){
                    $str.='<li' . $liOption . '><a href="'. get_permalink($ancestor).'"' . $aOption . '><span' . $spanOption . '>'. get_the_title($ancestor) .'</span></a></li>';
                    $str.= $separatorHTML;
                }
            }
            $str.= '<li>' . $startTextContainer. $post -> post_title .$endTextContainer . '</li>';
        } elseif(is_date()){
            if(get_query_var('day') != 0){
                $str.='<li' . $liOption . '><a href="'. get_year_link(get_query_var('year')). '"' . $aOption . '><span' . $spanOption . '>' . get_query_var('year'). '年</span></a></li>';
                $str.= $separatorHTML;
                $str.='<li' . $liOption . '><a href="'. get_month_link(get_query_var('year'), get_query_var('monthnum')). '"' . $aOption . '><span' . $spanOption . '>'. get_query_var('monthnum') .'月</span></a></li>';
                $str.= $separatorHTML;
                $str.='<li>' . $startTextContainer. get_query_var('day'). '日</li>';
            } elseif(get_query_var('monthnum') != 0){
                $str.='<li' . $liOption . '><a href="'. get_year_link(get_query_var('year')) .'"' . $aOption . '><span' . $spanOption . '>'. get_query_var('year') .'年</span></a></li>';
                $str.= $separatorHTML;
                $str.='<li>' . $startTextContainer. get_query_var('monthnum'). '月</li>';
            } else {
                $str.='<li>' . $startTextContainer. get_query_var('year') .'年</li>';
            }
        } elseif(is_search()) {
            $str.='<li>' . $startTextContainer. '「'. get_search_query() .'」'. $search .$endTextContainer . '</li>';
        } elseif(is_author()){
            $str .='<li>' . $startTextContainer. $author .' : '. get_the_author_meta('display_name', get_query_var('author')).$endTextContainer . '</li>';
        } elseif(is_tag()){
            $str.='<li>' . $startTextContainer. $tag .' : '. single_tag_title( '' , false ). $endTextContainer . '</li>';
        } elseif(is_attachment()){
            $str.= '<li>' . $startTextContainer. $post -> post_title .$endTextContainer . '</li>';
        } elseif(is_404()){
            $str.='<li>' . $startTextContainer.$notfound.$endTextContainer . '</li>';
        } else{
            $str.='<li>' . $startTextContainer. wp_title('', true) .$endTextContainer . '</li>';
        }
        $str.='</ul>';
        $str.='</div>';
    }
    echo $str;
}

function cps_get_youngest_cat($categories){
    global $post;
    if(count($categories) == 1 ){
        $youngest = $categories[0];
    }
    else{
        $count = 0;
        foreach($categories as $category){
            $children = get_term_children( $category -> term_id, 'category' );
            if($children){
                if ( $count < count($children) ){
                    $count = count($children);
                    $lot_children = $children;
                    foreach($lot_children as $child){
                        if( in_category( $child, $post -> ID ) ){
                            $youngest = get_category($child);
                        }
                    }
                }
            }
            else{
                $youngest = $category;
            }
        }
    }
	if( ! is_attachment()){
    	return $youngest;
	}
}

function cps_get_youngest_tax($taxes, $mytaxonomy){
    global $post;
    if(count($taxes) == 1 ){
        $youngest = isset($tax[0]);
    }
    else{
        $count = 0;
        foreach($taxes as $tax){
            $children = get_term_children( $tax -> term_id, $mytaxonomy );
            if($children){
                if ( $count < count($children) ){
                    $count = count($children);
                    $lot_children = $children;
                    foreach($lot_children as $child){
                        if( is_object_in_term( $post -> ID, $mytaxonomy ) ){
                            $youngest = get_term($child, $mytaxonomy);
                        }
                    }
                }
            }
            else{
                $youngest = $tax;
            }
        }
    }
    return $youngest;
}
?>