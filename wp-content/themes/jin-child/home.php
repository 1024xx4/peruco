<?php get_header(); ?>
<section class="visual">
  <div class="inner">
    <div class="copy">
      <h2>イベント・記念日に贈る花を<br>
      全国各地に配達します</h2>
      <p>ペルコ花店は埼玉県杉戸町にあるイベント・行事・記念日のアレンジメントフラワーが得意な生花店です。<br>
      常に新鮮なお花を揃え、Net注文で本州全域の指定の場所にお届けします。</p>
    </div>
    <ul class="visualList">
      <li><a href="<?php home_url(); ?>/about"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/home_btn01.png" alt="初めての方へ"></a></li>
      <li><a href="<?php home_url(); ?>/postage"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/home_btn02.png" alt="対応エリア・送料"></a></li>
      <li><a href="<?php home_url(); ?>/faq"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/home_btn03.png" alt="よくある質問"></a></li>
      <li><a href="<?php home_url(); ?>/order"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/home_btn04.png" alt="ご注文はこちら"></a></li>
    </ul>
    <div class="haitatsu">
      <h2>現在の最短お届け日は、<span><?php $Today = date('Y/n/j'); $postdate = date("n/j", strtotime($Today) + 60*60*24*3);echo $postdate; ?></span>です。</h2>
    </div>
  </div>
</section>
<section class="portfolio">
  <div class="inner">
    <div class="homeTtl">
      <p class="en">Portfolio</p>
      <h2>実際に贈らせていただいたお花たち</h2>
    </div>
    <div class="portfolioCnt">
      <ul class="portfolioList">
        <?php $args = array(
            'numberposts' => 10,
            'post_type' => 'portfolio'
        );
        $customPosts = get_posts( $args );
        if( $customPosts ) : foreach( $customPosts as $post) : setup_postdata( $post ); ?>
          <li class="match">
            <?php if ( has_post_thumbnail() ) : ?>
              <figure>
                <?php the_post_thumbnail('portfolio_size'); ?>
              </figure>
            <?php endif; ?>
            <div class="portfolioTxt">
              <p class="title"><span class="small">ご利用シーン：</span><?php echo get_post_meta($post->ID , 'title' ,true); ?></p>
              <p class="price"><?php echo get_post_meta($post->ID , 'price' ,true); ?></p>
              <p class="comment"><?php echo get_post_meta($post->ID , 'comment' ,true); ?></p>
            </div>
          </li>
        <?php endforeach; ?>
        <?php else: ?>
          <li><p>記事はまだありません。</p></li>
        <?php endif;
        wp_reset_postdata(); ?>
      </ul>
    </div>
  </div>
</section>
<section class="event">
  <div class="inner">
    <div class="homeTtl">
      <p class="en">Event</p>
      <h2>対応できるイベント・行事</h2>
    </div>
    <div class="eventCnt">
			<?php if( is_home() || is_front_page() ): ?>
				<?php get_template_part('include/head/pickup-contents'); ?>
			<?php else: ?>
				<?php if( is_pickup_child() == 'child_none') : ?>
				<?php else: ?>
					<?php get_template_part('include/head/pickup-contents'); ?>
				<?php endif; ?>
			<?php endif; ?>
    </div>
    <div class="homeTtl" style="margin-top: 30px;">
      <p class="en">Anniversary</p>
      <h2>対応できる記念日</h2>
    </div>
    <div class="eventCnt">
      <?php if( is_home() || is_front_page() ): ?>
        <?php get_template_part('include/pickupstyle/pickup-contents-menu-type02'); ?>
      <?php else: ?>
        <?php if( is_pickup_child() == 'child_none') : ?>
        <?php else: ?>
          <?php get_template_part('include/pickupstyle/pickup-contents-menu-type02'); ?>
        <?php endif; ?>
      <?php endif; ?>
    </div>
    <div class="eventTxt">
      <p>※上記以外の記念花のご依頼も承っております。詳しくは気軽にお問い合わせください。</p>
    </div>
  </div>
</section>
<section class="shop">
  <div class="inner">
    <div class="homeTtl">
      <p class="en">Shop</p>
      <h2>店舗情報</h2>
    </div>
    <div class="shopCnt">
      <div class="shopSplit">
        <div class="left">
          <figure>
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/home_shop.png" alt="店舗写真">
          </figure>
        </div>
        <div class="right">
          <table class="shopTable">
            <tbody>
              <tr>
                <th>店舗</th>
                <td>ペルコ花店</td>
              </tr>
              <tr>
                <th>営業時間</th>
                <td>9:00~17:00</td>
              </tr>
              <tr>
                <th>住所</th>
                <td>埼玉県北葛飾郡杉戸町高野台南1-1-9<br>
                ピージビル104</td>
              </tr>
              <tr>
                <th>電話番号</th>
                <td><a href="tel:0480-31-7374" target="_blank">0480-31-7374</a></td>
              </tr>
              <tr>
                <th>メールアドレス</th>
                <td><a href="mailto:peruco.hanaten@gmail.com" target="_blank">peruco.hanaten@gmail.com</a></td>
              </tr>
          </table>
          <div class="shopTxt">
            <p>店頭受け取りができる方は、直接受け取りに来ていただれば送料は発生しません。<br>
            店頭ではその場でご希望に沿ったアレンジメントを作成できます。お近くの方はお気軽に遊びに来てください。</p>
            <a href="https://www.ekiten.jp/shop_6028326/" target="_blank"><img src="https://peruco.net/wp-content/uploads/2019/07/ekiten.png"></a>
          </div>
        </div>
      </div>
      <div class="shopBtn">
        <a class="detail" href="<?php home_url(); ?>/about">ペルコ花店について<br>詳しく知りたい<i class="fas fa-arrow-right"></i></a>
        <a class="contact" href="<?php home_url(); ?>/order">アレンジメントの<br>ご注文はこちら<i class="fas fa-arrow-right"></i></a>
      </div>
    </div>
  </div>
</section>
<section class="info">
  <div class="inner">
    <div class="homeTtl">
      <p class="en">Blog</p>
      <h2>ブログ欄に様々な行事とお花について書きました</h2>
    </div>
    <div id="main-contents-one" class="infoCnt main-contents animate" itemscope itemtype="https://schema.org/Blog">
      <?php get_template_part('include/liststyle/post-list-mag'); ?>
    </div>
  </div>
</section>
<section class="map">
  <div class="inner">
    <div class="homeTtl">
      <p class="en">Map</p>
      <h2>ペルコ花店の地図</h2>
    </div>
  </div>
  <div class="mapCnt">
    <?php echo do_shortcode('[wpgmza id="1"]'); ?>
  </div>
</section>
<?php get_footer(); ?>
