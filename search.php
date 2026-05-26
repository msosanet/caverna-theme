<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package caverna
 */

get_header();
?>

	<div class="content-layout content-layout--split">
		<main id="primary" class="site-main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<h1 class="page-title">
					<?php
					/* translators: %s: search query. */
					printf( esc_html__( 'Resultados para: %s', 'caverna' ), '<span>' . get_search_query() . '</span>' );
					?>
				</h1>
				<?php get_search_form(); ?>
			</header><!-- .page-header -->

			<div class="search-results-list">
			<?php
			/* Start the Loop */
			while ( have_posts() ) :
				the_post();

				/**
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.
				 */
				get_template_part( 'template-parts/content', 'search' );

			endwhile;
			?>
			</div>

			<?php
			the_posts_navigation();

		else :

			?>
			<header class="page-header">
				<h1 class="page-title"><?php esc_html_e( 'No encontramos resultados', 'caverna' ); ?></h1>
				<p><?php esc_html_e( 'Proba con otra palabra o volve a las ultimas notas.', 'caverna' ); ?></p>
				<?php get_search_form(); ?>
			</header>
			<?php
			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

		</main><!-- #main -->

		<?php get_sidebar(); ?>
	</div>

<?php
get_footer();
