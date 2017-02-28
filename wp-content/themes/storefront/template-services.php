<?php
/**
 * The template for displaying full width pages.
 *
 * Template Name: Services
 *
 * @package storefront
 */

get_header(); ?>

	<div id="primary" class="content-area services">
		<main id="main" class="site-main" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

			<header class="entry-header">
				<?php
				storefront_post_thumbnail( 'full' );
				the_title( '<h1 class="entry-title">', '</h1>' );
				?>
			</header>

			<div class="entry-content">
				<?php the_content(); ?>
				<?php
					wp_link_pages( array(
						'before' => '<div class="page-links">' . __( 'Pages:', 'storefront' ),
						'after'  => '</div>',
					) );
				?>
			</div>
			
			<div class="services-list">
				<?php if( have_rows('service_group') ): ?>
					<?php while( have_rows('service_group') ): the_row(); ?>
						<h3><?php the_sub_field('service_group_title'); ?></h3>
						<?php if( have_rows('service') ): ?>
							<table>
								<tbody>
									<?php while( have_rows('service') ): the_row(); ?>
										<tr>
											<td>
												<strong>
													<span class="service-name"><?php the_sub_field('service_name') ?><br></span>
												</strong>
												<span class="service-description"><?php the_sub_field('service_description') ?></span>
											</td>
											<td>
												<span class="service-cost">
													$<?php the_sub_field('service_cost') ?>
												</span>
											</td>
										</tr>
									<?php endwhile; ?>
								</tbody>
							</table>
						<?php endif; ?>
					<?php endwhile; ?>
				<?php endif; ?>				
			</div>

		<?php
		endwhile; // End of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
// do_action( 'storefront_sidebar' );
get_sidebar('main');
get_footer();
