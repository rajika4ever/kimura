<article id="<?= 'art' . get_the_ID(); ?>" data-open="false" class="
      <?php the_field( 'article_type' ); ?>
      <?php if(has_post_thumbnail()): ?>has-image<?php endif; ?>
      <?php if(get_field('youtube_video')): ?>has-video<?php endif; ?>
      <?php if(get_field('facebook_video')): ?>has-video<?php endif; ?>
      expand-<?php the_field( 'visible_rows' ); ?>
      <?php echo (!isset($postExpand) || !$postExpand ? '' : 'expand-all'); ?>">
      <div class="container">

       <?php
        if(get_field('youtube_video')): ?>
            <div class="header-video">
             <iframe src="https://www.youtube.com/embed/<?php the_field( 'youtube_video' ); ?>?rel=0&amp;showinfo=0" allow="autoplay; encrypted-media" allowfullscreen="" width="560" height="315" frameborder="0">
                </iframe>
            </div>
        <?php elseif(get_field('facebook_video')): ?>
            <div class="header-video">
                <div class="fb-video" data-href="<?php the_field( 'facebook_video' ); ?>" data-width="980" data-show-text="false"></div>
            </div>
        <?php else: ?>
            <div class="header-image">
                <?php
                if ( has_post_thumbnail() ) {
                    the_post_thumbnail( 'large' );
                }
                ?>
            </div>
        <?php endif; ?>

        <content>
            <div class="row">
                <div class="col-sm-10">
					<?php 
						// adding H1 tag if its single page template
						$titleTAG = "div";
						if(is_single()){
							$titleTAG = "h1";
						}
					?>
                    <h1 class="article-title">
                        <?php if (has_category('Annons')): ?>
                            <div class="category ad">Annons</div>
                        <?php elseif (has_category('Videor')): ?>
                            <div class="category video">Video</div>
                        <?php endif; ?>

                        <a
                            href="<?php the_permalink(); ?>"
                            <?php if(!isset($postExpand) || !$postExpand): ?>
                                onclick="loadPageFromList(event, this)" data-number="<?= get_the_ID() ?>"
                            <?php endif; ?>
                        >
                            <?php the_title(); ?>
                        </a>
                    </h1>
						
                    <div class="meta clearfix author-meta-wrapper">
                        <div class="float-left author-avatar">
                            <?php echo get_wp_user_avatar(get_the_author_meta('ID'), 96); ?>
                        </div>
                        <div class="float-left author-meta">
                            <div class="author">
                                <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>">
                                    <?php $author = the_author_meta('nickname'); echo $author; ?>
                                </a>
                            </div>
                            <time class="date" datetime="<?php the_time('Y-m-d H:i') ?>"><?php $post_date = get_the_date( 'j M Y H:i' ); echo $post_date; ?></time>

                        </div>

                    </div>
                    <?php /*<div class="after-heading-ads-wrapper">
                        <?php echo do_shortcode('[the_ad_placement id="after-article-heading"]'); ?>
                    </div>*/ ?>
                    <?php
                        // Show this only for the article we are viewing, only in article page (single)
                        $actual_link = 'https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
                        $link = get_permalink(get_the_ID()); 
                        if (is_single() && $link === $actual_link) {
                            if( function_exists('the_ad_placement') ) { the_ad_placement('after-previews'); }
                        }
                    ?>
                    <section class="article-content ccc">
                        <?php
						// showing contents if the page is only a single page template
						if(is_single()){
							the_content(); 
							?>
							<div class="feed related">
								<div class="row">
									<?php
									foreach(getRelatedItems() as $post) {
										setup_postdata( $post )
										?>
										<div class="col-sm-6 mb-2">
											<a href="<?php the_permalink(); ?>">
												<article>
													<section class="header-image" style="background-image: url('<?php the_post_thumbnail_url('thumbnail'); ?>');">
														<?php the_post_thumbnail('thumbnail'); ?>
													</section>
													<content>
														<?php the_title(); ?>
													</content>

													<footer>
								<span class="view-comments">
								  <img src="<?php echo get_template_directory_uri(); ?>/img/icon-comments.svg">
								  <span class="disqus-comment-count" data-disqus-identifier="<?= $post->ID ?>"></span>
								</span>
													</footer>
												</article>
											</a>
										</div>
									<?php } $the_query->reset_postdata(); ?>
								</div>
							</div>
						<?php
						}
                        ?>

                        
                        <?php
                        if( function_exists('the_ad_placement') ) {
                            the_ad_placement('before-comments');
                        }
                        ?>
                    </section>
                    <?php if(!isset($postExpand) || !$postExpand): ?>
                        <a href="<?php the_permalink(); ?>" class="view-article"
                           onclick="loadPageFromList(event, this)" data-number="<?= get_the_ID() ?>"
                        >
                            Läs mer
                        </a>
                    <?php endif; ?>
                </div>
                <div class="col-sm-2 interest-container">
                    <div class="interest">
                        <?php if(function_exists('the_ratings')) { the_ratings(); } ?>
                        <div class="share mobile-share">
                            Dela
                            <ul>
                                <li><a href="https://www.facebook.com/sharer/sharer.php?u=<?php urlencode(the_permalink()); ?>" title="Dela på Facebook">
                                        <img src="/wp-content/themes/kimura/img/icon-facebook.svg" alt="Facebook">
                                    </a></li>
                                <li><a href="http://twitter.com/share?text=&amp;url=<?php urlencode(the_permalink()); ?> &amp;hashtags=kimura" title="Dela på Twitter">
                                        <img src="/wp-content/themes/kimura/img/icon-twitter.svg" alt="Twitter">
                                    </a></li>
                                <li><a href="mailto:?subject=<?php urlencode(the_title()); ?>&body=<?php urlencode(the_permalink()); ?>" title="Dela via mail">
                                        <img src="/wp-content/themes/kimura/img/icon-mail.svg" alt="Mail">
                                    </a>
								</li>
							</ul>
                        </div>
                    </div>
                    <div class="share">
                        Dela
                        <ul>
                            <li><a href="https://www.facebook.com/sharer/sharer.php?u=<?php urlencode(the_permalink()); ?>" title="Dela på Facebook">
                                    <img src="/wp-content/themes/kimura/img/icon-facebook.svg" alt="Facebook">
                                </a></li>
                            <li><a href="http://twitter.com/share?text=&amp;url=<?php urlencode(the_permalink()); ?> &amp;hashtags=kimura" title="Dela på Twitter">
                                    <img src="/wp-content/themes/kimura/img/icon-twitter.svg" alt="Twitter">
                                </a></li>
                            <li><a href="mailto:?subject=<?php urlencode(the_title()); ?>&body=<?php urlencode(the_permalink()); ?>" title="Dela via mail">
                                    <img src="/wp-content/themes/kimura/img/icon-mail.svg" alt="Mail">
                                </a></li>
						</ul>
                    </div>
                   </div>
					
					
					
               
				
				 <footer class="desktop-post-footer">
                <?php
                if(isset($postShowComments) && $postShowComments) {
                } else {
                    ?>
                    <?php if(comments_open($post->ID)): ?>
                        <div class="comments" onclick="addComments(<?= get_the_id(); ?>)">
              <span class="view-comments">
                <img src="<?php echo get_template_directory_uri(); ?>/img/icon-comments.svg">
                <span class="disqus-comment-count" data-disqus-identifier="<?= $post->ID ?>"></span>
                <span data-number="<?= get_the_id(); ?>" class="hidden-xs disqus-comments">Kommentarer</span>
              </span>
                        </div>
                    <?php endif; ?>
                <?php }; ?>
                <!-- Author bio -->
                <?php  $authorBio = get_the_author_meta('description'); ?>
               <div class="author-bio">
                    <p><?php echo wp_trim_words($authorBio, 15, '') ?></p>
               </div>
                <div class="meta desktop-author-meta">
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
			</div>
             
            <?php if (comments_open($post->ID)) : ?>
                <div id="post<?= get_the_ID(); ?>" data-newIdentifier="<?= $post->ID ?>" data-newUrl="<?= the_permalink() ?>" data-newTitle="<?= the_title();?>" data-newLanguage="en">
                </div>
            <?php endif; ?>
            <?php
            if(isset($postShowComments) && $postShowComments) {
                if ( comments_open($post->ID) || get_comments_number() ) {
                    comments_template();
                }
            }
            ?>
           
        </content>
    </div>
</article>

