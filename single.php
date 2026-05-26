<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package caverna
 */

get_header();
?>

	<div class="content-layout content-layout--split">
		<main id="primary" class="site-main">

		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', get_post_type() );

			?>
			<section class="share-box" aria-label="<?php esc_attr_e( 'Compartir nota', 'caverna' ); ?>">
				<h2><?php esc_html_e( 'Compartir nota', 'caverna' ); ?></h2>
				<a class="read-more-link" href="<?php echo esc_url( 'https://www.facebook.com/sharer/sharer.php?u=' . rawurlencode( get_permalink() ) ); ?>" target="_blank" rel="noopener"><?php esc_html_e( 'Facebook', 'caverna' ); ?></a>
				<a class="read-more-link" href="<?php echo esc_url( 'https://twitter.com/intent/tweet?url=' . rawurlencode( get_permalink() ) . '&text=' . rawurlencode( get_the_title() ) ); ?>" target="_blank" rel="noopener"><?php esc_html_e( 'X/Twitter', 'caverna' ); ?></a>
				<a class="read-more-link" href="<?php echo esc_url( 'https://wa.me/?text=' . rawurlencode( get_the_title() . ' ' . get_permalink() ) ); ?>" target="_blank" rel="noopener"><?php esc_html_e( 'WhatsApp', 'caverna' ); ?></a>
			</section>

			<?php
			$related = new WP_Query(
				array(
					'post_type'           => 'post',
					'posts_per_page'      => 3,
					'post__not_in'        => array( get_the_ID() ),
					'category__in'        => wp_get_post_categories( get_the_ID() ),
					'ignore_sticky_posts' => 1,
				)
			);

			if ( $related->have_posts() ) :
				?>
				<section class="related-posts">
					<h2 class="section-title"><?php esc_html_e( 'Mas notas', 'caverna' ); ?></h2>
					<div class="related-grid">
						<?php
						while ( $related->have_posts() ) :
							$related->the_post();
							get_template_part( 'template-parts/content', 'secondary' );
						endwhile;
						wp_reset_postdata();
						?>
					</div>
				</section>
				<?php
			endif;

			the_post_navigation(
				array(
					'prev_text' => '<span class="nav-subtitle">' . esc_html__( 'Anterior', 'caverna' ) . '</span> <span class="nav-title">%title</span>',
					'next_text' => '<span class="nav-subtitle">' . esc_html__( 'Siguiente', 'caverna' ) . '</span> <span class="nav-title">%title</span>',
				)
			);

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>

		</main><!-- #main -->

		<?php get_sidebar(); ?>
	</div>

<?php
get_footer();
