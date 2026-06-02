<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package caverna
 */

get_header();
?>

	<main id="primary" class="site-main">

		<?php
		$principal_term = get_category_by_slug( 'principal' );
		if ( ! $principal_term ) {
			$principal_term = get_term_by( 'name', 'Principal', 'category' );
		}

		$featured_term = get_category_by_slug( 'destacados' );
		if ( ! $featured_term ) {
			$featured_term = get_term_by( 'name', 'Destacados', 'category' );
		}

		$featured_ids    = array();
		$principal_query = null;
		$secondary_query = null;

		if ( $featured_term ) {
			$secondary_query = new WP_Query(
				array(
					'post_type'           => 'post',
					'posts_per_page'      => 5,
					'cat'                 => (int) $featured_term->term_id,
					'ignore_sticky_posts' => 1,
				)
			);
		}

		if ( $secondary_query && $secondary_query->have_posts() ) :
			?>
			<section class="home-featured home-featured--editorials content-layout">
				<header class="home-featured__header">
					<p class="advertising-kicker"><?php esc_html_e( 'Para no perderse', 'caverna' ); ?></p>
					<h2 class="section-title"><?php esc_html_e( 'Editoriales destacadas', 'caverna' ); ?></h2>
				</header>
				<div class="secondary-grid">
					<?php
					while ( $secondary_query->have_posts() ) :
						$secondary_query->the_post();
						$featured_ids[] = get_the_ID();
						get_template_part( 'template-parts/content', 'secondary' );
					endwhile;
					?>
				</div>
			</section>
			<?php
		endif;

		wp_reset_postdata();

		if ( $principal_term ) {
			$principal_query = new WP_Query(
				array(
					'post_type'           => 'post',
					'posts_per_page'      => 3,
					'cat'                 => (int) $principal_term->term_id,
					'post__not_in'        => $featured_ids,
					'ignore_sticky_posts' => 1,
				)
			);
		}

		if ( $principal_query && $principal_query->have_posts() ) :
			?>
			<section class="home-featured home-featured--principal content-layout">
				<header class="home-featured__header">
					<p class="advertising-kicker"><?php esc_html_e( 'Seleccion editorial', 'caverna' ); ?></p>
					<h2 class="section-title"><?php esc_html_e( 'Destacadas', 'caverna' ); ?></h2>
				</header>
				<?php
				while ( $principal_query->have_posts() ) :
					$principal_query->the_post();
					$featured_ids[] = get_the_ID();

					get_template_part( 'template-parts/content', 'featured' );
				endwhile;
				?>
			</section>
			<?php
		endif;

		wp_reset_postdata();

		caverna_radio_player( array( 'class_name' => 'caverna-radio-player--home' ) );

		if ( is_active_sidebar( 'ad-home-top' ) ) :
			?>
			<section class="home-ad content-layout">
				<?php dynamic_sidebar( 'ad-home-top' ); ?>
			</section>
			<?php
		endif;

		$paged = max( 1, (int) get_query_var( 'paged' ) );
		$latest_query = new WP_Query(
			array(
				'post_type'           => 'post',
				'posts_per_page'      => (int) get_option( 'posts_per_page', 10 ),
				'paged'               => $paged,
				'post__not_in'        => $featured_ids,
				'ignore_sticky_posts' => 1,
			)
		);
		?>

		<div class="content-layout content-layout--split">
			<section class="home-latest">
				<?php
				$leaderboard_ad     = get_theme_mod( 'caverna_home_leaderboard_ad', '' );
				$leaderboard_ad_own = get_theme_mod( 'caverna_home_leaderboard_ad_own', '' );
				$leaderboard_pick   = caverna_pick_ad( $leaderboard_ad, $leaderboard_ad_own );
				if ( empty( $leaderboard_pick ) ) {
					$leaderboard_pick = caverna_default_ad( 'horizontal' );
				}
				if ( ! empty( $leaderboard_pick ) ) :
					?>
					<div class="ad-banner ad-banner--leaderboard">
						<?php echo $leaderboard_pick; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
					</div>
					<?php
				elseif ( is_customize_preview() ) :
					?>
					<div class="ad-placeholder ad-placeholder--leaderboard" aria-hidden="true">
						Espacio publicidad (728x90)
					</div>
					<?php
				endif;
				?>

				<h2 class="section-title"><?php esc_html_e( 'Ultimas entradas', 'caverna' ); ?></h2>
				<div class="latest-list">
					<?php
					if ( $latest_query->have_posts() ) :
						$latest_count         = 0;
						$latest_seen_ids      = array();
						$newsletter_rendered  = false;
						$popular_rendered     = false;
						while ( $latest_query->have_posts() ) :
							$latest_query->the_post();
							$latest_count++;
							$latest_seen_ids[] = get_the_ID();
							get_template_part( 'template-parts/content', 'list' );

							if ( ! $newsletter_rendered && 2 === $latest_count ) :
								caverna_newsletter_form( 'inline' );
								$newsletter_rendered = true;
								caverna_render_popular_posts_block( array_merge( $featured_ids, $latest_seen_ids ) );
								$popular_rendered = true;
							endif;

							if ( 0 === $latest_count % 5 ) :
								$inline_ad     = get_theme_mod( 'caverna_home_inline_ad', '' );
								$inline_ad_own = get_theme_mod( 'caverna_home_inline_ad_own', '' );
								$inline_pick   = caverna_pick_ad( $inline_ad, $inline_ad_own );
								if ( empty( $inline_pick ) ) {
									$inline_pick = caverna_default_ad( 'horizontal' );
								}
								if ( ! empty( $inline_pick ) ) :
									?>
									<div class="home-ad">
										<div class="ad-banner ad-banner--leaderboard">
											<?php echo $inline_pick; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
										</div>
									</div>
									<?php
								elseif ( is_customize_preview() ) :
									?>
									<div class="home-ad">
										<div class="ad-placeholder ad-placeholder--leaderboard" aria-hidden="true">
											Espacio publicidad (728x90)
										</div>
									</div>
									<?php
								endif;
							endif;
						endwhile;

						if ( ! $newsletter_rendered && $latest_count > 0 ) :
							caverna_newsletter_form( 'inline' );
							caverna_render_popular_posts_block( array_merge( $featured_ids, $latest_seen_ids ) );
							$popular_rendered = true;
						endif;

						if ( ! $popular_rendered && $latest_count > 0 ) :
							caverna_render_popular_posts_block( array_merge( $featured_ids, $latest_seen_ids ) );
						endif;
					else :
						get_template_part( 'template-parts/content', 'none' );
					endif;
					?>
				</div>

				<?php
				$inline_ad     = get_theme_mod( 'caverna_home_inline_ad', '' );
				$inline_ad_own = get_theme_mod( 'caverna_home_inline_ad_own', '' );
				$inline_pick   = caverna_pick_ad( $inline_ad, $inline_ad_own );
				if ( ! empty( $inline_pick ) ) :
					?>
					<section class="home-ad">
						<div class="ad-banner ad-banner--leaderboard">
							<?php echo $inline_pick; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
						</div>
					</section>
					<?php
				elseif ( is_active_sidebar( 'ad-home-inline' ) ) :
					?>
					<section class="home-ad">
						<?php dynamic_sidebar( 'ad-home-inline' ); ?>
					</section>
					<?php
				elseif ( is_customize_preview() ) :
					?>
					<section class="home-ad">
						<div class="ad-placeholder ad-placeholder--leaderboard" aria-hidden="true">
							Espacio publicidad (728x90)
						</div>
					</section>
					<?php
				endif;
				?>

				<?php
				if ( $latest_query->max_num_pages > 1 ) {
					$original_query = $GLOBALS['wp_query'];
					$GLOBALS['wp_query'] = $latest_query;
					the_posts_navigation(
						array(
							'prev_text' => __( 'Entradas anteriores', 'caverna' ),
							'next_text' => __( 'Entradas siguientes', 'caverna' ),
						)
					);
					$GLOBALS['wp_query'] = $original_query;
				}
				?>
			</section>

			<?php get_sidebar(); ?>
		</div>

		<?php
		wp_reset_postdata();
		$home_sections = array(
			array(
				'slug'  => 'cannabis',
				'label' => __( 'Cannabis', 'caverna' ),
			),
			array(
				'slug'  => 'cultura',
				'label' => __( 'Cultura', 'caverna' ),
			),
			array(
				'slug'  => 'podcasts',
				'label' => __( 'Podcasts', 'caverna' ),
			),
		);

		foreach ( $home_sections as $home_section ) :
			$section_term = get_category_by_slug( $home_section['slug'] );

			if ( ! $section_term ) {
				continue;
			}

			$section_query = new WP_Query(
				array(
					'post_type'           => 'post',
					'posts_per_page'      => 3,
					'cat'                 => (int) $section_term->term_id,
					'post__not_in'        => $featured_ids,
					'ignore_sticky_posts' => 1,
				)
			);

			if ( ! $section_query->have_posts() ) {
				continue;
			}
			?>
			<section class="home-section content-layout">
				<div class="home-section__header">
					<h2 class="section-title"><?php echo esc_html( $home_section['label'] ); ?></h2>
					<a class="read-more-link" href="<?php echo esc_url( get_category_link( $section_term ) ); ?>"><?php esc_html_e( 'Ver seccion', 'caverna' ); ?></a>
				</div>
				<div class="secondary-grid">
					<?php
					while ( $section_query->have_posts() ) :
						$section_query->the_post();
						get_template_part( 'template-parts/content', 'secondary' );
					endwhile;
					wp_reset_postdata();
					?>
				</div>
			</section>
			<?php
		endforeach;
		?>

	</main><!-- #main -->

<?php
get_footer();
?>
