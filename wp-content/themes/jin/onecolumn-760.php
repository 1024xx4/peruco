<?php
/*
Template Name: １カラム【760px】
Template Post Type: post, page
*/
?>
<?php get_header(); ?>
	
	<div id="contents">

		<!--メインコンテンツ-->
		<main id="onecolumn760" class="main-contents <?php echo is_article_design(); ?> <?php is_animation_style(); ?>" itemprop="mainContentOfPage">
			
			<?php if( is_front_page() ) :?>
				<?php if ( wp_isset_widets( 'home-top-widget',true ) ) : ?>
					<div id="home-top-widget">
					<?php dynamic_sidebar( 'home-top-widget' ); ?>
					</div>
				<?php endif; ?>
			<?php endif; ?>
			
			<section class="cps-post-box hentry">
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					<?php
						// カテゴリー情報を取得
						if( is_single() ){
							$category = get_the_category();
							$cat_id   = $category[0]->cat_ID;
							$cat_name = $category[0]->cat_name;
							$cat_slug = $category[0]->category_nicename;
							$cat_link = get_category_link($cat_id);
						}
					?>
					<article class="cps-post">
						<header class="cps-post-header">
							<?php if( is_single() ): ?>
								<span class="cps-post-cat category-<?php echo $cat_slug; ?>" itemprop="keywords"><a href="<?php echo $cat_link ?>" style="background-color:<?php cps_category_color(); ?>!important;"><?php echo $cat_name ?></a></span>
							<?php endif; ?>
							<h1 class="cps-post-title entry-title" itemprop="headline"><?php esc_html(the_title()); ?></h1>
							<div class="cps-post-meta vcard">
								<span class="writer fn" itemprop="author" itemscope itemtype="http://schema.org/Person"><span itemprop="name"><?php the_author(); ?></span></span>
								<?php if( is_single() ): ?>
								<span class="cps-post-date-box">
									<?php get_template_part( 'include/custom-time' ); ?>
								</span>
								<?php endif; ?>
							</div>
						</header>
						<?php if ( ! get_option( 'theme_eyecatch_off' ) ) : ?>
							<div class="cps-post-thumb" itemscope itemtype="http://schema.org/ImageObject">
								<?php if(has_post_thumbnail()) { echo the_post_thumbnail( 'large_size' ); } ?>
							</div>
						<?php endif; ?>
						<?php if ( ! get_option( 'sns_delete' ) ) : ?>
							<?php if ( ! get_option( 'sns_top_delete' ) ) : ?>
								<?php get_template_part('include/sns-top'); ?>
							<?php endif; ?>
						<?php endif; ?>
						
						<div class="cps-post-main-box">
							<div class="cps-post-main <?php if( ! get_theme_mod('h2_style_icon') == ""){ echo get_theme_mod('h2_style_icon'); } ?> <?php if( ! get_theme_mod('h3_style_icon') == ""){ echo get_theme_mod('h3_style_icon'); } ?> <?php if( ! get_theme_mod('h4_style_icon') == ""){ echo get_theme_mod('h4_style_icon'); } ?> <?php if( ! get_option('hl_custom_check')){is_h2_style();echo " "; is_h3_style();echo " "; is_h4_style(); }else{echo "hl-custom";} ?> entry-content <?php echo esc_html(get_option('font_size'));?> <?php echo esc_html(get_option('font_size_sp'));?>" itemprop="articleBody">
								
								<?php get_template_part('ad-top'); ?>

								<?php the_content(); ?>
								
								<?php get_template_part('ad'); ?>
									
								<?php if ( ! get_option( 'sns_delete' ) ) : ?>
									<?php get_template_part('include/sns'); ?>
								<?php endif; ?>
								
								<?php get_template_part('cta'); ?>
							</div>
						</div>
					</article>
				<?php endwhile; ?>
				<?php else : ?>
					<article class="cps-post">
						<h1 class="post-title">記事が見つかりませんでした。</h1>
					</article>
				<?php endif; ?>
    		</section>
			<?php comments_template(); ?>
			
			<?php if( is_bread_display() == "exist") :?>
			<?php if( is_mobile() ): ?>
			<?php breadcrumbs(); ?>
			<?php endif; ?>
			<?php endif; ?>
			
			<?php if( ! is_singular('cta') && is_single() ): ?>
				<?php get_template_part('include/related-entries'); ?>
			<?php endif; ?>
			
			<?php if( is_front_page() ) :?>
				<?php if ( wp_isset_widets( 'home-bottom-widget',true ) ) : ?>
					<div id="home-bottom-widget">
					<?php dynamic_sidebar( 'home-bottom-widget' ); ?>
					</div>
				<?php endif; ?>
			<?php endif; ?>
			
		</main>
		
	</div>
	<?php get_footer(); ?>