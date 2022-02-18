<?php get_header(); ?>

  <?php
  $curauth = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author));
  ?>

  <div class="container text-center mt-5 mb-5">
    <article>
      <content>
        <div class="row">
          <div class="col-sm-8 offset-sm-2 pb-4 pt-4">
            <?php echo get_wp_user_avatar(get_the_author_meta('ID'), 96); ?>
            <h1 class="mt-3"><?php echo $curauth->nickname; ?></h1>
            <?php echo $curauth->user_description; ?>
          </div>
        </div>
      </content>
    </article>
  </div>


  <div class="feed main">

		<?php
		if ( have_posts() ) : ?>

			<header class="page-header">
				<h2 class="arch">
          Artiklar från <?php echo $curauth->nickname; ?>
        </h2>
			</header><!-- .page-header -->

			<?php
			/* Start the Loop */
			while ( have_posts() ) : the_post();
                $the_query = $wp_query;
                require "template-parts/post-item.php";
			endwhile;

			else :

				get_template_part( 'template-parts/content', 'none' );

			endif; ?>

	    <div class="container pag">
	      <?php
	      next_posts_link( 'Nästa sida', $the_query->max_num_pages );  ?>
	    </div>

		</div>

<?php
get_footer();
