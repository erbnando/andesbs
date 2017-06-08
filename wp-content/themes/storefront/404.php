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
		.site-search, #site-header-cart, #secondary, .widget_nav_menu, .woocommerce-breadcrumb, .storefront-primary-navigation, .storefront-handheld-footer-bar, .secondary-navigation {
			display: none!important;;
		}
		header {
			margin-bottom: 0!important;
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
			margin-bottom: 40px!important;
			height: 400px;
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

			<h2>

			Oops, whatever you were looking for was not found!
			<br><br>
			<a href="<?php echo site_url(); ?>">Here is a link to our homepage.</a>

			</h2>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
// do_action( 'storefront_sidebar' );
get_sidebar('main');
get_footer();
