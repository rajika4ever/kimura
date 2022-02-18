<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package kimura
 */

get_header(); ?>


  <div class="feed">

		<?php
		if ( have_posts() ) : ?>

			<header class="page-header">
				<h1 class="arch"><?php
					/* translators: %s: search query. */
					printf( esc_html__( 'Sökresultat för %s', 'kimura' ), '<span>' . get_search_query() . '</span>' );
				?></h1>
			</header><!-- .page-header -->

			<?php
			/* Start the Loop */
            $the_query = $wp_query;
			while ( have_posts() ) : the_post();
                require "template-parts/post-item.php";
			endwhile;
      ?>

	    <div class="container pag">
	      <?php
	      next_posts_link( 'Nästa sida', $the_query->max_num_pages );  ?>
	    </div>

      <?php
			else : ?>
      <h1 class="arch">
        Kunde inte hitta något
      </h1>
			<?php endif; ?>

		</div>

<?php
get_footer();
