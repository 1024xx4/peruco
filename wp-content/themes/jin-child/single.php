<?php get_header(); ?>

	<div id="contents" class="peruco-single">
    <div class="inner">
		<!--メインコンテンツ-->
			<main id="main-contents" class="main-contents <?php echo is_article_design(); ?> <?php is_animation_style(); ?>" itemprop="mainContentOfPage">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
          <?php
            // カテゴリー情報を取得
            if( ! is_singular('cta') ){
              $category = get_the_category();
              $cat_id   = $category[0]->cat_ID;
              $cat_name = $category[0]->cat_name;
              $cat_slug = $category[0]->category_nicename;
              $cat_link = get_category_link($cat_id);
            }
          ?>
          <article class="cps-post">
            <header class="cps-post-header">
              <?php if( ! is_singular('cta') ): ?>
              <span class="cps-post-cat category-<?php echo $cat_slug; ?>" itemprop="keywords"><a href="<?php echo $cat_link ?>" style="background-color:<?php cps_category_color(); ?>!important;"><?php echo $cat_name ?></a></span>
              <?php endif; ?>
              <h1 class="cps-post-title entry-title" itemprop="headline"><?php esc_html(the_title()); ?></h1>
              <div class="cps-post-meta vcard">
                <span class="writer fn" itemprop="author" itemscope itemtype="http://schema.org/Person"><span itemprop="name"><?php the_author(); ?></span></span>
                <span class="cps-post-date-box">
                  <?php get_template_part( 'include/custom-time' ); ?>
                </span>
              </div>

            </header>
				<section class="cps-post-box hentry">
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
								<div class="cps-post-main <?php if( ! get_option('hl_custom_check')){is_h2_style();echo " "; is_h3_style();echo " "; is_h4_style(); }else{echo "hl-custom";} ?> entry-content <?php echo esc_html(get_option('font_size'));?> <?php echo esc_html(get_option('font_size_sp'));?>" itemprop="articleBody">

									<?php get_template_part('ad-top'); ?>

									<?php the_content(); ?>
									<?php echo do_shortcode('[template id="285"]'); ?>

									<?php get_template_part('include/nextpage'); ?>


									<?php
										$arr = get_the_tags();
										if($arr){
											echo '<div class="tag-box">';
											foreach ( (array)$arr as $tag ) {
												echo '<span><a href="'.get_tag_link($tag->term_id).'"><span class="tagicon"><i class="fa fa-tag" aria-hidden="true"></i></span> '.$tag->name.'</a></span>';
											}
											echo '</div>';
										}
									?>

									<?php get_template_part( 'include/custom-profile' ); ?>

									<?php get_template_part('ad'); ?>

									<?php if( ! get_post_meta( $post->ID, "custom_ad_off", true) == 'この記事で広告を表示しない' ) : ?>
									<div class="related-ad-unit-area"><?php echo get_option('ad_related_unit'); ?></div>
									<?php endif; ?>

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

				<?php if( is_bread_display() == "exist") :?>
				<?php if( is_mobile() ): ?>
				<?php breadcrumbs(); ?>
				<?php endif; ?>
				<?php endif; ?>

				<?php if( ! is_singular('cta') ): ?>
				<?php get_template_part('include/related-entries'); ?>
				<?php endif; ?>

				<?php comments_template(); ?>

				<?php get_template_part('include/prevnext'); ?>
			</main>

		<?php get_sidebar(); ?>
    </div>
	</div>
<?php get_footer(); ?>
