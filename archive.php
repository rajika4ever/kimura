<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package kimura
 */

get_header(); ?>
			<div class="feed main">

				<?php
				if ( have_posts() ) : ?>

					<header class="page-header">
						<h1 class="arch">
								<?php
									echo '';single_cat_title();echo '';
								 ?>
		        </h1>
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
