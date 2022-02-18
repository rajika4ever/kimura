<?php
// Highest rated posts
if(!isset($highestRatedContainerClass)) {
    $highestRatedContainerClass = 'container';
}

if(!isset($nativendoPreviewId)) {
    $nativendoPreviewId = 'nativendo-preview-1';
}

$highestRated = the_highest_rated();
if(!is_front_page()){
    echo do_shortcode('[the_ad_placement id="after-first-subpage-article"]');
}

if($highestRated) {
?>

  <div class="feed preview">
      <div class="<?php echo $highestRatedContainerClass; ?>">
      <div class="row row-thin">
        <?php
            $num = 0;
            foreach($highestRated as $post): setup_postdata( $post );
              if($num >= 5):
                break;
            endif;

            if($num == 2) {
                echo '<div id="'.$nativendoPreviewId.'"></div>';
            }

        ?>

          <div class="col-sm-6 col-md-4 col-thin col-preview">
              <a href="<?php the_permalink(); ?>">
                  <article>
                      <div class="header-image" style="background-image: url('<?php the_post_thumbnail_url( 'medium' ); ?>');">
                            <?php
                                    if ( has_post_thumbnail() ) {
                                        the_post_thumbnail( 'medium' );
                                    }
                            ?>
                      </div>
                      <content>
                          <div class="article-title"><?php the_title(); ?></div>
                      </content>
                      <footer>
                          <span class="view-comments">
                              <img src="<?php echo get_template_directory_uri(); ?>/img/icon-comments.svg">
                              <span class="disqus-comment-count" data-disqus-identifier="<?= $post->ID ?>"></span>
                          </span>
                          <?php if (has_category('Annons')): ?>
                            <div class="category ad">Annons</div>
                          <?php else: ?>
                            <div class="category hot">Hett</div>
                          <?php endif; ?>
                      </footer>
                  </article>
              </a>
          </div>
        <?php $num++;
        endforeach; ?>
        <?php wp_reset_postdata(); ?>
      </div>
    </div>
  </div>
<?php
}
