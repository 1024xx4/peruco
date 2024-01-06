<?php get_header(); ?>

	<div id="contents" class="peruco-page">
		<div class="inner">
		<!--メインコンテンツ-->
		<main id="main-contents" class="main-contents <?php echo is_article_design(); ?> <?php is_animation_style(); ?>" itemprop="mainContentOfPage">
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<article class="cps-post">
				<header class="cps-post-header">
					<div class="inner">
						<?php if( is_single() ): ?>
							<span class="cps-post-cat category-<?php echo $cat_slug; ?>" itemprop="keywords"><a href="<?php echo $cat_link ?>" style="background-color:<?php cps_category_color(); ?>!important;"><?php echo $cat_name ?></a></span>
						<?php endif; ?>
						<h1 class="cps-post-title entry-title" itemprop="headline"><?php esc_html(the_title()); ?></h1>
						<?php if(post_custom('content_desc')): ?>
							<p><?php the_field('content_desc'); ?></p>
						<?php endif; ?>
						<div class="cps-post-meta vcard">
							<span class="writer fn" itemprop="author" itemscope itemtype="http://schema.org/Person"><span itemprop="name"><?php the_author(); ?></span></span>
							<?php if( is_single() ): ?>
							<span class="cps-post-date-box">
								<?php get_template_part( 'include/custom-time' ); ?>
							</span>
							<?php endif; ?>
						</div>
						<?php
						/*
						Template Name: ペルコ花店専用
						Template Post Type: post, page, event, portfolio
						*/
						?>
					</div>
				</header>
			<section class="cps-post-box hentry">
						<?php if ( ! get_option( 'theme_eyecatch_off' ) ) : ?>
							<div class="cps-post-thumb" itemscope itemtype="http://schema.org/ImageObject">
								<?php if(has_post_thumbnail()) { echo the_post_thumbnail( 'large_size' ); } ?>
							</div>
						<?php endif; ?>

						<div class="cps-post-main-box">
							<div class="cps-post-main <?php if( ! get_option('hl_custom_check')){is_h2_style();echo " "; is_h3_style();echo " "; is_h4_style(); }else{echo "hl-custom";} ?> entry-content <?php echo esc_html(get_option('font_size'));?> <?php echo esc_html(get_option('font_size_sp'));?>" itemprop="articleBody">

								<?php get_template_part('ad-top'); ?>

								<?php the_content(); ?>
								<?php if(!is_page('order')): ?>
								<?php echo do_shortcode('[template id="285"]'); ?>
								<?php endif; ?>

								<?php get_template_part('include/nextpage'); ?>

								<?php get_template_part('ad'); ?>

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
			<?php endif; ?>
			<?php endif; ?>


		</main>

		<?php get_sidebar(); ?>
	</div>
	</div>
	<?php get_footer(); ?>
