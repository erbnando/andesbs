<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package storefront
 */

get_header(); ?>

	<style type="text/css">
		.site-search, #site-header-cart, #secondary, .widget_nav_menu, .woocommerce-breadcrumb, .storefront-primary-navigation, .storefront-handheld-footer-bar {
			display: none!important;;
		}
		.secondary-navigation {
			float: right!important;
		}
		@media screen and (max-width: 768px) {
			.secondary-navigation {
				float: left!important;
			    clear: left;
			    display: block;
			}
			.secondary-navigation ul {
				list-style-type: none;
				margin: 0;
			}
			.secondary-navigation ul li {
				display: inline-block;
				padding: 5px 10px 0;
			}
			.secondary-navigation ul li:first-child {
				padding: 5px 10px 0 0!important;
			}
			.secondary-navigation ul li a {
				font-weight: normal;
				font-size: 14px;
			}
		}
		div.site-title {
			font-size: 2em!important;
			padding-top: 5px;
			padding-bottom: 5px;
		}
		#primary {
			width: 100%;
			float: none;
			margin-right: 0;
		}
		main {
			margin-top: 40px;
			margin-bottom: 100px!important;
		}
		*:focus {
			outline: none!important;
		}
		hr {
			margin-top: 50px;
			margin-bottom: 30px;
		}
		.responsive-video-container {
			max-width: 700px;
		}
		@media screen and (min-width: 1024px) {
			.footer-widgets .widget {
				width: 40%!important;
			}
		}
		#map {
		    height: 400px!important;
		}
		#about {
			padding-top: 20px;
		}
		#services {
			padding-top: 20px;			
		}
	</style>
	<script type="text/javascript">
		jQuery('a[href*=\\#]').on('click', function(event){     
		    event.preventDefault();
		    jQuery('html,body').animate({scrollTop:jQuery(this.hash).offset().top}, 500);
		});		
	</script>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php while ( have_posts() ) : the_post();
			?>

			<h1 id="about">About Us</h1>
		 	
			<?php
		 	the_content();

		 	?>

		 	<hr>

			<h1 id="services">Services</h1>

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
