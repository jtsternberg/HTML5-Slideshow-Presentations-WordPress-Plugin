<?php

add_filter( 'body_class', 'dsgnwrks_html5_body_class' );
function dsgnwrks_html5_body_class( $classes ){
global $post;

      $classes[] = 'html5_presentation';
      return $classes;

}

add_action( 'dsgnwrks_html5_head', 'html5presentation_include_wp_head' );
function html5presentation_include_wp_head() {
  if ( get_option( 'include-wp_head' ) ) {
    wp_head();
  }

}


add_action( 'dsgnwrks_html5_footer', 'html5slidesjs' );
function html5slidesjs() { ?>
  <script>
  function addPrettify() {
    var els = document.querySelectorAll('pre');
    for (var i = 0, el; el = els[i]; i++) {
      if (!el.classList.contains('noprettyprint')) {
        el.classList.add('prettyprint');
      }
    }

    var el = document.createElement('script');
    el.type = 'text/javascript';
    el.src = '<?php echo plugins_url('js/prettify.js', __FILE__ ); ?>';
    el.onload = function() {
      prettyPrint();
    }
    document.body.appendChild(el);
  };

  function addGeneralStyle() {
    var el = document.createElement('link');
    el.rel = 'stylesheet';
    el.type = 'text/css';
    el.href = '/css/html5-presentation.css';
    document.body.appendChild(el);

    var el = document.createElement('meta');
    el.name = 'viewport';
    el.content = 'width=1100,height=750';
    document.querySelector('head').appendChild(el);

    var el = document.createElement('meta');
    el.name = 'apple-mobile-web-app-capable';
    el.content = 'yes';
    document.querySelector('head').appendChild(el);
  };

  </script>

  <?php
  if ( get_option( 'include-wp_footer' ) ) {
    wp_footer();
  }

}

function html5slidefunction($title_slide) {
global $post;
        $html5slide_type = get_post_meta($post->ID, 'html5slide_type', true );

          echo '<article '; post_class(); echo '>';

          if ( $html5slide_type == 'title_slide' ) {
            echo '<h1>' . get_the_title() . '</h1>';
              the_content();
          } elseif ( $html5slide_type == 'no_title' ) {
              the_content();
          } elseif ( $html5slide_type == 'segue_slide' ) {
              echo '<h2>' . get_the_title() . '</h2>';
          } else {
            if ( $post->post_parent == 0 ) {
                echo '<h1>'.get_the_title().'</h1>';
              } else {
                echo '<h3>'.get_the_title().'</h3>';
              }
              the_content();
          }

          if ( isset( $GLOBALS['html5presentation_edit'] ) )
            edit_post_link( 'edit slide', '<div class="html5_edit'. $GLOBALS['html5presentation_edit'] .'">', '</div>' );
          echo '</article>';
}

add_filter( 'post_class', 'html5slideclass' );
function html5slideclass( $classes ){
global $post;

      $html5slide_class = get_post_meta($post->ID, 'html5slide_class', true);

      if ( $html5slide_class == 'smaller' ) {
        $classes[] = 'smaller';
      } elseif ( $html5slide_class == 'build' ) {
        $classes[] = 'build';
      } elseif ( $html5slide_class == 'fill' ) {
        $classes[] = 'fill';
      } elseif ( $html5slide_class == 'nobackground' ) {
        $classes[] = 'nobackground';
      }

      return $classes;

}

function html5presentationclass() {
global $post;
    $html5presentation_type = get_post_meta($post->ID, 'html5presentation_type', true );

      if ( $html5presentation_type == 'faux_widescreen' ) {
        echo '<section class="slides layout-faux-widescreen template-default">';
      } elseif ( $html5presentation_type == 'widescreen' ) {
        echo '<section class="slides layout-widescreen template-default">';
      } else {
        echo '<section class="slides layout-regular template-default">';
      }
}

function html5presentationlogo( $presentation_id ) {

  if ( is_admin() )
    return;
      $title_slide = new WP_Query(array(
      'post_type' => 'html5presentation',
      'p' => $presentation_id,
      'posts_per_page' => 1,
      'orderby' => 'menu_order',
      'order' => 'ASC',
      ));
      while ($title_slide->have_posts()) : $title_slide->the_post();


      $thumbnail = has_post_thumbnail( get_the_ID() )
        ? wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' )
        : false;

      $thumb_url = ! isset( $thumbnail[0] ) ? '' : $thumbnail[0];

      ?>
    <style type="text/css">
      .slides.template-default > article:not(.nobackground):not(.biglogo) {
        background: url(<?php echo $thumb_url; ?>) 660px 625px no-repeat;

        background-color: white;
      }
    </style>

<?php endwhile;
wp_reset_query();
}

function html5_run_presentation($presentation_id) {
global $post; ?>

  <!DOCTYPE html>

  <!--
    Google HTML5 slide template

    Authors: Luke Mahé (code)
             Marcin Wichary (code and design)

             Dominic Mazzoni (browser compatibility)
             Charles Chen (ChromeVox support)

    URL: http://code.google.com/p/html5slides/
  -->

  <!--
    HTML5 Slideshow Presentations WordPress Plugin
    Authors: Justin Sternberg

    URL: http://wordpress.org/extend/plugins/html5-slideshow-presentations/
  -->

  <html>
    <head>
      <title><?php the_title(); ?></title>

      <meta charset='utf-8'>
      <meta http-equiv="X-UA-Compatible" content="IE=edge">

      <script src='<?php echo plugins_url('js/slides.js', __FILE__ ); ?>'></script>
      <script src='<?php echo plugins_url('js/prettify.js', __FILE__ ); ?>'></script>

      <?php
      if ( file_exists( get_stylesheet_directory().'/html5slide-replace.css' ) ) {
        echo '<link rel="stylesheet" href="'. get_stylesheet_directory_uri() .'/html5slide-replace.css" type="text/css" media="screen" />';
      } else {
        echo '<link rel="stylesheet" href="'. plugins_url('css/html5-slide.css', __FILE__ ) .'" type="text/css" media="screen" />';
      }

      if ( file_exists( get_stylesheet_directory().'/html5slide-style.css') && !file_exists( get_stylesheet_directory().'/html5slide-replace.css' ) ) {
        echo '<link rel="stylesheet" href="'. get_stylesheet_directory_uri() .'/html5slide-style.css" type="text/css" media="screen" />';
      }

      ?>

      <?php html5presentationlogo($presentation_id); ?>

  <?php do_action( 'dsgnwrks_html5_head' ); ?>
  </head>

    <body style='display: none' <?php body_class(); ?>>

      <?php
      $title_slide = new WP_Query(array(
      'post_type' => 'html5presentation',
      'p' => $presentation_id,
      'posts_per_page' => 1,
      'orderby' => 'menu_order',
      'order' => 'ASC',
      ));
      while ($title_slide->have_posts()) : $title_slide->the_post();

      if ( get_post_meta($post->ID, 'html5presentation_edit', true ) ) $GLOBALS['html5presentation_edit'] = ' hide_edit_link';

      html5presentationclass();

      html5slidefunction($title_slide);
        endwhile;
        wp_reset_query(); ?>

        <?php
        $title_slide = new WP_Query(array(
        'post_type' => 'html5presentation',
        'post_parent' => $presentation_id,
        'posts_per_page' => -1,
        'orderby' => 'menu_order',
        'order' => 'ASC',
        ));
        while ($title_slide->have_posts()) : $title_slide->the_post();
        html5slidefunction($title_slide);
        endwhile;
        wp_reset_query(); ?>

      </section>

      <?php html5slidesjs(); ?>

    <?php do_action( 'dsgnwrks_html5_footer' ); ?>
    </body>
  </html>

<?php }