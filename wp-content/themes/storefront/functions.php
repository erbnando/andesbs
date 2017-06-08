<?php
/**
 * Storefront engine room
 *
 * @package storefront
 */

/**
 * Assign the Storefront version to a var
 */
$theme              = wp_get_theme( 'storefront' );
$storefront_version = $theme['Version'];

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 980; /* pixels */
}

$storefront = (object) array(
	'version' => $storefront_version,

	/**
	 * Initialize all the things.
	 */
	'main'       => require 'inc/class-storefront.php',
	'customizer' => require 'inc/customizer/class-storefront-customizer.php',
);

require 'inc/storefront-functions.php';
require 'inc/storefront-template-hooks.php';
require 'inc/storefront-template-functions.php';

if ( class_exists( 'Jetpack' ) ) {
	$storefront->jetpack = require 'inc/jetpack/class-storefront-jetpack.php';
}

if ( storefront_is_woocommerce_activated() ) {
	$storefront->woocommerce = require 'inc/woocommerce/class-storefront-woocommerce.php';

	require 'inc/woocommerce/storefront-woocommerce-template-hooks.php';
	require 'inc/woocommerce/storefront-woocommerce-template-functions.php';
}

if ( is_admin() ) {
	$storefront->admin = require 'inc/admin/class-storefront-admin.php';
}

/**
 * Note: Do not add any custom code here. Please use a custom plugin so that your customizations aren't lost during updates.
 * https://github.com/woocommerce/theme-customisations
 */

/* CUSTOM CODE :) */

function custom_styles() {
    wp_enqueue_script( 'app', get_template_directory_uri() . '/assets/js/app.js', array(), '1.0.0', true );
    wp_enqueue_style( 'app', get_template_directory_uri() . '/assets/sass/app/app.css' );
}
add_action( 'wp_enqueue_scripts', 'custom_styles' );



add_filter( 'storefront_credit_link', '__return_false' );

add_action( 'init', 'yourtheme_woocommerce_image_dimensions', 1 );
function yourtheme_woocommerce_image_dimensions() {
  	$catalog = array(
		'width' 	=> '600',	// px
		'height'	=> '600',	// px
		'crop'		=> 0		// true
	);

	$single = array(
		'width' 	=> '600',	// px
		'height'	=> '600',	// px
		'crop'		=> 0 		// true
	);

	$thumbnail = array(
		'width' 	=> '',	// px
		'height'	=> '',	// px
		'crop'		=> 0 		// false
	);

	// Image sizes
	update_option( 'shop_catalog_image_size', $catalog ); 		// Product category thumbs
	update_option( 'shop_single_image_size', $single ); 		// Single product image
//	update_option( 'shop_thumbnail_image_size', $thumbnail ); 	// Image gallery thumbs
}

if (  ! function_exists( 'woocommerce_template_loop_category_title' ) ) {
	function woocommerce_template_loop_category_title( $category ) {
		?>
		<h3>
			<?php
				echo $category->name;

				// if ( $category->count > 0 )
					// echo apply_filters( 'woocommerce_subcategory_count_html', ' <mark class="count">(' . $category->count . ')111</mark>', $category );
			?>
		</h3>
		<?php
	}
}

// Footer Map Widget

class Footer_Map_Widget extends WP_Widget {
  public function __construct() {
    $widget_ops = array( 
      'classname' => 'footer_map_widget',
      'description' => 'Footer Map Widget',
    );
    parent::__construct( 'footer_map_widget', 'Footer Map Widget', $widget_ops );
  }
  /**
   * Outputs the content of the widget
   *
   * @param array $args
   * @param array $instance
   */
  public function widget( $args, $instance ) {
?>
	<div class="widget footer-map-widget">
		<style>
		#map {
		    height: 300px;
		    width: 100%;
		}
		</style>
		<div id="map"></div>
		<script>
		function initMap() {
		    var uluru = {
		        lat: 39.116493,
		        lng: -77.251609
		    };
		    var map = new google.maps.Map(document.getElementById('map'), {
		        zoom: 14,
			    streetViewControl: false,
		        styles: [{
		            "featureType": "administrative",
		            "elementType": "all",
		            "stylers": [{
		                "saturation": "-100"
		            }]
		        }, {
		            "featureType": "administrative.province",
		            "elementType": "all",
		            "stylers": [{
		                "visibility": "off"
		            }]
		        }, {
		            "featureType": "landscape",
		            "elementType": "all",
		            "stylers": [{
		                "saturation": -100
		            }, {
		                "lightness": 65
		            }, {
		                "visibility": "on"
		            }]
		        }, {
		            "featureType": "poi",
		            "elementType": "all",
		            "stylers": [{
		                "saturation": -100
		            }, {
		                "lightness": "50"
		            }, {
		                "visibility": "simplified"
		            }]
		        }, {
		            "featureType": "road",
		            "elementType": "all",
		            "stylers": [{
		                "saturation": "-100"
		            }]
		        }, {
		            "featureType": "road.highway",
		            "elementType": "all",
		            "stylers": [{
		                "visibility": "simplified"
		            }]
		        }, {
		            "featureType": "road.arterial",
		            "elementType": "all",
		            "stylers": [{
		                "lightness": "30"
		            }]
		        }, {
		            "featureType": "road.local",
		            "elementType": "all",
		            "stylers": [{
		                "lightness": "40"
		            }]
		        }, {
		            "featureType": "transit",
		            "elementType": "all",
		            "stylers": [{
		                "saturation": -100
		            }, {
		                "visibility": "simplified"
		            }]
		        }, {
		            "featureType": "water",
		            "elementType": "geometry",
		            "stylers": [{
		                "hue": "#ffff00"
		            }, {
		                "lightness": -25
		            }, {
		                "saturation": -97
		            }]
		        }, {
		            "featureType": "water",
		            "elementType": "labels",
		            "stylers": [{
		                "lightness": -25
		            }, {
		                "saturation": -100
		            }]
		        }],
		        center: uluru
		    });
			google.maps.event.addDomListener(window, "resize", function() {
			    var center = map.getCenter();
			    google.maps.event.trigger(map, "resize");
			    map.setCenter(center); 
			});
			function pinSymbol(color) {
			    return {
			        path: 'M 0,0 C -2,-20 -10,-22 -10,-30 A 10,10 0 1,1 10,-30 C 10,-22 2,-20 0,0 z M -2,-30 a 2,2 0 1,1 4,0 2,2 0 1,1 -4,0',
			        fillColor: color,
			        fillOpacity: 1,
			        strokeColor: '#000',
			        strokeWeight: 2,
			        scale: 1,
			   };
			}
		    var marker = new google.maps.Marker({
		        position: uluru,
		        map: map,
		   		icon: pinSymbol("#FFF")
		    });
		}
		</script>
		<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBQtNUzsNGBQn3SCf5YMueF6GUWpe2sN10&callback=initMap">
		</script>
	</div>
	<?php 
  	/*
    echo '<div class="latest-tweets">';
    echo '<div class="latest-tweets-title">';
    echo '<h4>Recent Tweeets by <span style="text-transform: uppercase;">@' . get_option('ignitesite_twitter_username') . '</span></h4>';
    echo '<a class="button secondary follow" href="https://twitter.com/intent/user?screen_name=' . get_option('ignitesite_twitter_username') . '">Follow</a>';
    echo '</div>';
    echo '<div class="latest-tweets-subtitle">';
    echo '<img src="' . $instance['image'] . '" />';
    echo '<h5>' . $instance['title'] . '</h5>';
    echo '<p>@' . get_option('ignitesite_twitter_username') . '</p>';
    echo '</div>';
    echo '</div>';
    */
  }
  /**
   * Outputs the options form on admin
   *
   * @param array $instance The widget options
   */
  public function form( $instance ) {
  	/*
    $title = ! empty( $instance['title'] ) ? $instance['title'] : __( '', 'text_domain' );
    $image = ! empty( $instance['image'] ) ? $instance['image'] : __( '', 'text_domain' );

    ?>
    <p>
    <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e( esc_attr( 'Organization Name:' ) ); ?></label> 
    <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
    </p>
    <p>
    <label for="<?php echo esc_attr( $this->get_field_id( 'image' ) ); ?>"><?php _e( esc_attr( 'Organization Image URL:' ) ); ?></label> 
    <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'image' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'image' ) ); ?>" type="text" value="<?php echo esc_attr( $image ); ?>">
    </p>

    <?php
	*/
  }
  /**
   * Processing widget options on save
   *
   * @param array $new_instance The new options
   * @param array $old_instance The previous options
   */
  public function update( $new_instance, $old_instance ) {
  	/*
    $instance = array();
    $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
    $instance['image'] = ( ! empty( $new_instance['image'] ) ) ? strip_tags( $new_instance['image'] ) : '';
    return $instance;
    */
  }
}

function register_recent_footer_map_widget() {
    register_widget( 'footer_map_widget' );
}
add_action( 'widgets_init', 'register_recent_footer_map_widget' );

// remove_action('init', 'woocommerce_process_registration' );
// add_action( 'init', 'dalluva_process_registration' );

function image_crop_dimensions($default, $orig_w, $orig_h, $new_w, $new_h, $crop){
	if ( !$crop ) return null; // let the wordpress default function handle this

$aspect_ratio = $orig_w / $orig_h;
$size_ratio = max($new_w / $orig_w, $new_h / $orig_h);

$crop_w = round($new_w / $size_ratio);
$crop_h = round($new_h / $size_ratio);

$s_x = floor( ($orig_w - $crop_w) / 2 );
$s_y = floor( ($orig_h - $crop_h) / 2 );

return array( 0, 0, (int) $s_x, (int) $s_y, (int) $new_w, (int) $new_h, (int) $crop_w, (int) $crop_h );
}
add_filter('image_resize_dimensions', 'image_crop_dimensions', 10, 6);

add_action( 'widgets_init', 'theme_slug_widgets_init' );
function theme_slug_widgets_init() {
    register_sidebar( array(
        'name' => __( 'Main Sidebar', 'theme-slug' ),
        'id' => 'sidebar-2',
        'description' => '',
    ) );
}

// Disable product review (tab)
function woo_remove_product_tabs($tabs) {
	unset($tabs['reviews']);
	return $tabs;
}

add_filter( 'woocommerce_product_tabs', 'woo_remove_product_tabs', 98 );

function wptuts_responsive_video_shortcode( $atts ) {
    extract( shortcode_atts( array (
        'id' => '',
        'controls' => '0',
        'showinfo' => '0',
        'rel' => '0',
        'start' => '0'
    ), $atts ) );
    return '<div class="responsive-video-container"><div class="wptuts-video-container"><iframe src="//www.youtube.com/embed/' . $id . '?controls=' . $controls . '&showinfo=' . $showinfo . '&rel=' . $rel . '&start=' . $start . '" height="240" width="320" allowfullscreen="" frameborder="0"></iframe></div></div>';
}
add_shortcode ('responsive-video', 'wptuts_responsive_video_shortcode' );

add_filter('show_admin_bar', '__return_false');

