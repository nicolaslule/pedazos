<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package inovawebdesign
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function inovawebdesign_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'inovawebdesign_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function inovawebdesign_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'inovawebdesign_pingback_header' );

function inova_socials_sharing() {
		global $post;
		?>

 <div class="row justify-content-sm-between align-items-sm-center mt-5">
          <div class="col-md-12">
            <div class="d-flex align-items-center">
              <h4 class="font-size-1 font-weight-medium text-uppercase mb-0 mr-3">Share:</h4>

              <a class="btn btn-sm btn-md btn-icon btn-soft-dark btn-bg-transparent rounded-circle mr-2" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(get_permalink($post->ID)); ?>">
                <span class="fab fa-facebook-f btn-icon__inner"></span>
              </a>
              <a class="btn btn-sm btn-md btn-icon btn-soft-dark btn-bg-transparent rounded-circle mr-2" href="https://twitter.com/intent/tweet?text=<?php echo urlencode(get_the_title()); ?>&amp;url=<?php echo urlencode(get_permalink($post->ID)); ?>">
                <span class="fab fa-twitter btn-icon__inner"></span>
              </a>
              <a class="btn btn-sm btn-md btn-icon btn-soft-dark btn-bg-transparent rounded-circle mr-2" href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo urlencode(get_permalink($post->ID)); ?>&amp;title=<?php echo urlencode(get_the_title()); ?>&amp;summary=<?php echo urlencode(get_the_excerpt()); ?>">
                <span class="fab fa-linkedin-in btn-icon__inner"></span>
              </a>
              <a class="btn btn-sm btn-md  btn-icon btn-soft-dark btn-bg-transparent rounded-circle mr-2" href="mailto:?subject=I wanted you to read this great blog post.&amp;body=Check out this article <?php echo urlencode(get_permalink($post->ID)); ?>">
                <span class="fab fa-telegram btn-icon__inner"></span>
              </a>
              <a class="btn btn-sm btn-md btn-icon btn-soft-dark btn-bg-transparent rounded-circle mr-2" href="https://www.stumbleupon.com/submit?url=<?php echo urlencode(get_permalink($post->ID)); ?>&amp;title=<?php echo urlencode(get_the_title()); ?>">
                <span class="fab fa-stumbleupon btn-icon__inner"></span>
              </a>
                
            </div>
          </div>     
        </div>

		<?php
}


/**
 * Change more string at the end of the excerpt
 *
 * @since  1.0
 *
 * @param string $more
 *
 * @return string
 */

// Modifies the excerpt lenght for blog post
function custom_excerpt_more( $more ) {
	$more = '&hellip;';
	return $more;
}

add_filter( 'excerpt_more', 'custom_excerpt_more' );

function custom_excerpt_length( $length ) {
	return 30;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

// Provides the pagination for blog posts
function inova_pagination() {

global $wp_query;

if ( $wp_query->max_num_pages <= 1 ) return; 

$big = 999999999; // need an unlikely integer

$pages = paginate_links( array(
        'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
        'format' => '?paged=%#%',
        'current' => max( 1, get_query_var('paged') ),
        'total' => $wp_query->max_num_pages,
        'type'  => 'array',
    ) );
    if( is_array( $pages ) ) {
        $paged = ( get_query_var('paged') == 0 ) ? 1 : get_query_var('paged');
        echo '<nav aria-label="Page navigation"><ul class="pagination mb-0">';
        foreach ( $pages as $page ) {
                echo "<li class='page-item'>$page</li>";
        }
       echo '</ul></nav>';
        }
}



// Shortcodes
  function topo_hero_shortcode( $topo_hero) {
    $topo_hero = shortcode_atts(
        array(
            'topo-city' => 'Chicago',
            'topo-text' => 'We craft websites through a consistent, cohesive strategy an elevate your brand perception.',
        ), $topo_hero, $tag );
      
  ob_start(); ?>
            <div class="d-lg-flex position-relative">
                <div id="SVGwaveBottom3Shape" class="container d-lg-flex align-items-lg-center height-lg-100vh space-top-3 space-top-md-4 space-lg-0 mt-lg-5">
                    <div class="w-lg-50 mb-5">
                        <div class="media align-items-center mb-4">
                            <div class="media-body">
                              <h2 class="lead d-inline-block mb-0">Web Design | Web Development | SEO</h2>
                            </div>
                        </div>
                    <div class="mb-4">
                    <h1 class="text-primary display-4 font-size-md-down-5 font-weight-semi-bold"><?php  echo $topo_hero['topo-city']  ?></h1>
                    <p class="lead"><?php  echo $topo_hero['topo-text']  ?></p>
                   </div>
                     <a class="btn btn-primary btn-wide transition-3d-hover" href="https://www.inovawebdesign.com/project/">Get Started<span class="fas fa-angle-right ml-2"></span></a>
                   </div>
             <figure class="d-none d-lg-block w-75 position-absolute bottom-0 left-0 z-index-n1">
                <img class="js-svg-injector" src="https://www.inovawebdesign.com/wp-content/themes/inovawebdesign/images/svg/components/wave-3-bottom.svg" alt="SVG wave background" data-parent="#SVGwaveBottom3Shape">
             </figure>
                 <div class="col-lg-4 bg-img-hero min-height-lg-100vh position-lg-absolute top-lg-0 right-lg-0 px-lg-0 space-2 space-sm-hero space-sm-4" style="background-image: url(https://www.inovawebdesign.com/wp-content/uploads/2018/12/chicago-web-developers.jpg);">
                </div>
                </div>
            </div>
            <div class="container mt-6">
<?php 
      $topo_hero = ob_get_contents();
	  ob_end_clean();
	  return $topo_hero;
}
add_shortcode( 'topo_hero', 'topo_hero_shortcode' );


// half shortcode 