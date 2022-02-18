
       <article id="<?= 'art' . get_the_ID(); ?>" data-open="false" class="expand-<?php the_field( 'visible_rows' ); ?> <?php the_field( 'article_type' ); ?> <?php if(has_post_thumbnail()): ?>has-image<?php endif; ?>">
        <div class="container">

          <?php
           if(get_field('youtube_video')): ?>
            <section class="header-video">
             
            </section>
           <?php elseif(get_field('facebook_video')): ?>
             <section class="header-video">
              <div class="fb-video" data-href="<?php the_field( 'facebook_video' ); ?>" data-width="980" data-show-text="false"></div>
   				 	</section>
           <?php else: ?>
            <section class="header-image">
              <?php
                if ( has_post_thumbnail() ) {
                the_post_thumbnail( 'large' );
                }
              ?>
            </section>
          <?php endif; ?>

          <content>
            <div class="row">
              <div class="col-sm-10">
                <h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
                <section class="article-content">
                  <?php
                    the_content(); ?>
                </section>
                <span class="view-article" data-number="<?= get_the_ID() ?>">Läs mer</span>
              </div>
              <div class="col-sm-2 interest-container">
                <div class="interest">
                  <?php if(function_exists('the_ratings')) { the_ratings(); } ?>
                </div>
              </div>
            </div>

            <footer>
              <div class="comments">
                <span class="view-comments">
                  <img src="<?php echo get_template_directory_uri(); ?>/img/icon-comments.svg">
                  <span class="disqus-comment-count" data-disqus-identifier="<?= $post->ID ?>"></span> <span data-number="<?= get_the_id(); ?>" class="hidden-xs disqus-comments">Kommentarer</span>
                </span>

              </div>
              <div class="meta">
                <div class="float-left float-sm-right px-2">
                  <?php echo get_wp_user_avatar(get_the_author_meta('ID'), 96); ?>
                </div>
                <div class="float-left float-sm-left">
                  <time class="date" datetime="<?php the_time('Y-m-d H:i') ?>"><?php $post_date = get_the_date( 'j M H:i' ); echo $post_date; ?></time>
                  <div class="author">
                    <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>">
                      <?php $author = the_author_meta('nickname'); echo $author; ?>
                    </a>
                  </div>
                </div>
              </div>
            </footer>
          </content>

        </div>
      </article>