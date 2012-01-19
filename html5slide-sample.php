<?php 

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
  el.href = '/css/html5-slide.css';
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
<?php }




function html5_run_slideshow($slide_id) { ?>

  <!DOCTYPE html>

  <!--
    Google HTML5 slide template

    Authors: Luke Mahé (code)
             Marcin Wichary (code and design)
             
             Dominic Mazzoni (browser compatibility)
             Charles Chen (ChromeVox support)

    URL: http://code.google.com/p/html5slides/
  -->

  <html>
    <head>
      <title>Presentation</title>

      <meta charset='utf-8'>

      <script src='<?php echo plugins_url('js/slides.js', __FILE__ ); ?>'></script>
      <script src='<?php echo plugins_url('js/prettify.js', __FILE__ ); ?>'></script>

      <link rel="stylesheet" href="<?php echo plugins_url('css/html5-slide.css', __FILE__ ); ?>" type="text/css" media="screen" /> 
 
  </head>
    
    <style>
      /* Your individual styles here, or just use inline styles if that’s
         what you want. */
      
      
    </style>

    <body style='display: none'>

      <section class='slides layout-regular template-default'>
        
        <!-- Your slides (<article>s) go here. Delete or comment out the
             slides below. -->

<?php global $post;

    global $id;
    $paged = get_query_var( 'page' );
    $children = new WP_Query(array(
    'post_type' => page,
    'post_parent' => $id,
    'posts_per_page' => -1,
    'orderby' => 'menu_order',
    'order' => 'ASC',
    'paged' => $paged,
    ));
    ?>          
        
        <article class='biglogo'>
        </article>

        <article>
          <h1>
            Title Goes Here Up
            <br>
            To Two Lines
          </h1>
          <p>
            Sergey Brin
            <br>
            May 10, 2011
          </p>
        </article>
        
        <article>
          <p>
            This is a slide with just text. This is a slide with just text.
            This is a slide with just text. This is a slide with just text.
            This is a slide with just text. This is a slide with just text.
          </p>
          <p>
            There is more text just underneath.
          </p>
        </article>

        <article>
          <h3>
            Simple slide with header and text
          </h3>
          <p>
            This is a slide with just text. This is a slide with just text.
            This is a slide with just text. This is a slide with just text.
            This is a slide with just text. This is a slide with just text.
          </p>
          <p>
            There is more text just underneath with a <code>code sample: 5px</code>.
          </p>
        </article>

        <article class='smaller'>
          <h3>
            Simple slide with header and text (small font)
          </h3>
          <p>
            This is a slide with just text. This is a slide with just text.
            This is a slide with just text. This is a slide with just text.
            This is a slide with just text. This is a slide with just text.
          </p>
          <p>
            There is more text just underneath with a <code>code sample: 5px</code>.
          </p>
        </article>

        <article>
          <h3>
            Slide with bullet points and a longer title, just because we
            can make it longer
          </h3>
          <ul>
            <li>
              Use this template to create your presentation
            </li>
            <li>
              Use the provided color palette, box and arrow graphics, and
              chart styles
            </li>
            <li>
              Instructions are provided to assist you in using this
              presentation template effectively
            </li>
            <li>
              At all times strive to maintain Google's corporate look and feel
            </li>
          </ul>
        </article>

        <article>
          <h3>
            Slide with bullet points that builds
          </h3>
          <ul class="build">
            <li>
              This is an example of a list
            </li>
            <li>
              The list items fade in
            </li>
            <li>
              Last one!
            </li>
          </ul>

          <div class="build">
            <p>Any element with child nodes can build.</p>
            <p>It doesn't have to be a list.</p>
          </div>
        </article>

        <article class='smaller'>
          <h3>
            Slide with bullet points (small font)
          </h3>
          <ul>
            <li>
              Use this template to create your presentation
            <li>
              Use the provided color palette, box and arrow graphics, and
              chart styles
            <li>
              Instructions are provided to assist you in using this
              presentation template effectively
            <li>
              At all times strive to maintain Google's corporate look and feel
          </ul>
        </article>

        <article>
          <h3>
            Slide with a table
          </h3>
          
          <table>
            <tr>
              <th>
                Name
              <th>
                Occupation
            <tr>
              <td>
                Luke Mahé
              <td>
                V.P. of Keepin’ It Real
            <tr>
              <td>
                Marcin Wichary
              <td>
                The Michael Bay of Doodles
          </table>
        </article>
        
        <article class='smaller'>
          <h3>
            Slide with a table (smaller text)
          </h3>
          
          <table>
            <tr>
              <th>
                Name
              <th>
                Occupation
            <tr>
              <td>
                Luke Mahé
              <td>
                V.P. of Keepin’ It Real
            <tr>
              <td>
                Marcin Wichary
              <td>
                The Michael Bay of Doodles
          </table>
        </article>
        
        <article>
          <h3>
            Styles
          </h3>
          <ul>
            <li>
              <span class='red'>class="red"</span>
            <li>
              <span class='blue'>class="blue"</span>
            <li>
              <span class='green'>class="green"</span>
            <li>
              <span class='yellow'>class="yellow"</span>
            <li>
              <span class='black'>class="black"</span>
            <li>
              <span class='white'>class="white"</span>
            <li>
              <b>bold</b> and <i>italic</i>
          </ul>
        </article>
        
        <article>
          <h2>
            Segue slide
          </h2>
        </article>

        <article>
          <h3>
            Slide with an image
          </h3>
          <p>
            <img style='height: 500px' src='<?php echo plugins_url('images/wordpress-pie-chart.png', __FILE__ ); ?>'>
          </p>
          <div class='source'>
            Source: <a href="http://www.pootlepress.co.uk/2011/02/wordpress-worldwide-usage-charts/" target="_blank">http://www.pootlepress.co.uk</a>
          </div>
        </article>

        <article>
          <h3>
            Slide with an image (centered)
          </h3>
          <p>
            <img class='centered' style='height: 500px' src='<?php echo plugins_url('images/example-graph.png', __FILE__ ); ?>'>
          </p>
          <div class='source'>
            Source: Larry Page
          </div>
        </article>

        <article class='fill'>
          <h3>
            Image filling the slide (with optional header)
          </h3>
          <p>
            <img src='<?php echo plugins_url('images/example-cat.jpg', __FILE__ ); ?>'>
          </p>
          <div class='source white'>
            Source: Eric Schmidt
          </div>
        </article>

        <article>
          <h3>
            This slide has some code
          </h3>
          <section>
          <pre>
  &lt;script type='text/javascript'&gt;
    // Say hello world until the user starts questioning
    // the meaningfulness of their existence.
    function helloWorld(world) {
      for (var i = 42; --i &gt;= 0;) {
        alert('Hello ' + String(world));
      }
    }
  &lt;/script&gt;
  &lt;style&gt;
    p { color: pink }
    b { color: blue }
    u { color: 'umber' }
  &lt;/style&gt;
  </pre>
          </section>
        </article>
        
        <article class='smaller'>
          <h3>
            This slide has some code (small font)
          </h3>
          <section>
          <pre>
// This just echoes the chosen line, we'll position it later
function hello_dolly() {
  $chosen = hello_dolly_get_lyric();
  echo "<p id='dolly'>$chosen</p>";
}

// Now we set that function up to execute when the admin_notices action is called
add_action( 'admin_notices', 'hello_dolly' );

// We need some CSS to position the paragraph
function dolly_css() {
  // This makes sure that the positioning is also good for right-to-left languages
  $x = is_rtl() ? 'left' : 'right';

  echo "
  <style type='text/css'>
  #dolly {
    float: $x;
    padding-$x: 15px;
    padding-top: 5px;   
    margin: 0;
    font-size: 11px;
  }
  </style>
  ";
}
  </pre>
          </section>
        </article>
        
        <article>
          <q>
            The best way to predict the future is to invent it.
          </q>
          <div class='author'>
            Alan Kay
          </div>
        </article>
        
        <article class='smaller'>
          <q>
            A distributed system is one in which the failure of a computer 
            you didn’t even know existed can render your own computer unusable.
          </q>
          <div class='author'>
            Leslie Lamport
          </div>
        </article>
        
        <article class='nobackground'>
          <h3>
            A slide with an embed + title
          </h3>
          
          <iframe src='http://wordpress.org'></iframe>
        </article>

        <article class='nobackground'>
          <iframe src='http://wordpress.org'></iframe>
        </article>

        <article class='fill'>
          <h3>
            Full-slide embed with (optional) slide title on top
          </h3>
          <iframe src='http://wordpress.org'></iframe>
        </article>
        
        <article>
          <h3>
            Thank you!
          </h3>
          
          <ul>
            <li>
              <a href='http://wordpress.org'>wordpress.org</a>
          </ul>
        </article>

      </section>

      <?php html5slidesjs(); ?>

    </body>
  </html>  

<?php }