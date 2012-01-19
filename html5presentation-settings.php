<?php 
    $inc_wp_head = get_option( 'include-wp_head' );
    $inc_wp_footer = get_option( 'include-wp_footer' );
?>

<div class="wrap">
    
    <h2>HTML5 Slideshow Presentations Settings</h2>

    <form class="html5-slideshow-presentations" method="post" action="options.php">
        <?php settings_fields('html5-slideshow-presentations'); ?>
        <p>Thanks for using the HTML5 Slideshow Presentations Plugin! You'll find options below for selecting which functionality you would like enabled.</p>

        <table class="form-table">

            <tr valign="top">
            <th scope="row">
            <strong>Include <code>&#60;?php wp_head(); ?&#62;</code> in Slides' head section</strong>
            <p>This will likely effect the display of the slides as wp_head loads theme and plugin css files. You may need this if you are looking for plugin functionality on slide pages.<p>
            </th>
            <td><input type="checkbox" name="include-wp_head" value="yes"<?php echo $inc_wp_head == 'yes' ? ' checked' : '';?> /></td>
            </tr>        

            <tr valign="top">
            <th scope="row">
            <strong>Include <code>&#60;?php wp_footer(); ?&#62;</code> in Slides' footer section</strong>
            <p>Disabling this will remove the admin bar (if enabled) as well as other plugin functionality. May need to disable if plugins/theme is conflicting with slide pages.<p>
            </th>
            <td><input type="checkbox" name="include-wp_footer" value="yes"<?php echo $inc_wp_footer == 'yes' ? ' checked' : '';?> /></td>
            </tr>        

        </table>
        
        <p class="submit">
        <input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
        </p>

    </form>
    <p class="jtsocial"><a class="jtpaypal" href="http://j.ustin.co/rYL89n" target="_blank">Contribute<span></span></a>
        <a class="jttwitter" href="http://j.ustin.co/wUfBD3" target="_blank">Follow me on Twitter<span></span></a>
        <a class="jtemail" href="http://j.ustin.co/scbo43" target="blank">Contact Me<span></span></a>
    </p>

</div>