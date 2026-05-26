<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package caverna
 */

get_header();
?>

	<div class="content-layout content-layout--split">
		<main id="primary" class="site-main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header archive-hero">
				<?php
				the_archive_title( '<h1 class="page-title">', '</h1>' );
				the_archive_description( '<div class="archive-description">', '</div>' );
				?>
			</header><!-- .page-header -->

			<div class="archive-list latest-list">
			<?php
			/* Start the Loop */
			while ( have_posts() ) :
				the_post();

				get_template_part( 'template-parts/content', 'list' );

			endwhile;
			?>
			</div>

			<?php
			the_posts_navigation();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

		</main><!-- #main -->

		<?php get_sidebar(); ?>
	</div>

<?php
get_footer();
