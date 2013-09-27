<?php
/*
Plugin Name: HTML5 Slideshow Presentations
Plugin URI: http://j.ustin.co/s3bst2
Description: Create HTML5 slideshow presentations using our favorite cms, WordPress. Host your own presentations and share/present them anytime.
Author URI: http://about.me/jtsternberg
Author: Jtsternberg
Donate link: http://j.ustin.co/rYL89n
Version: 1.0.7
*/


add_action('admin_init', 'dsgnwrks_html5presentation_init');
function dsgnwrks_html5presentation_init() {

    // Register plugin options
    register_setting('html5-slideshow-presentations', 'include-wp_head');
    register_setting('html5-slideshow-presentations', 'include-wp_footer');

    // Set default plugin options
    add_option( 'include-wp_footer', 'yes' );

}
add_action('admin_menu', 'dsgnwrks_html5presentation_settings');
function dsgnwrks_html5presentation_settings() {
    add_options_page('HTML5 Slideshow Presentations Settings', 'HTML5 Presentations', 'manage_options', 'html5presentation-settings', 'html5presentation_settings');
}

function html5presentation_settings() { require_once('html5presentation-settings.php'); }

// Enqueue Styles
add_action('admin_enqueue_scripts', 'dsgnwrks_html5presentation_css');
function dsgnwrks_html5presentation_css() {
    wp_enqueue_style('html5presentation_admin', plugins_url('css/admin.css', __FILE__));
}


require_once( 'html5-presentation-template.php' );

add_action('init', 'html5presentation_register');
function html5presentation_register() {

    $html5presentation_box_labels = array(
        'name' => _x('HTML5 Presentations', 'post type general name'),
        'singular_name' => _x('HTML5 Presentation Slide', 'post type singular name'),
        'add_new' => _x('Add New', 'HTML5 Presentation Slide'),
        'add_new_item' => __('Add New HTML5 Presentation Slide'),
        'edit_item' => __('Edit HTML5 Presentation Slide'),
        'new_item' => __('New HTML5 Presentation Slide'),
        'view_item' => __('View HTML5 Presentation Slide'),
        'search_items' => __('Search HTML5 Presentation Slides'),
        'not_found' =>  __('Nothing found'),
        'not_found_in_trash' => __('Nothing found in Trash'),
        'parent_item_colon' => ''
        );
    $args = array(
        'labels' => $html5presentation_box_labels,
        'public' => false,
        'show_ui' => true,
        'capability_type' => 'page',
        '_builtin' => false,
        'hierarchical' => true,
        'query_var' => false,
        'supports' => array('title', 'editor', 'thumbnail', 'page-attributes')
       );

        register_post_type( 'html5presentation' , $args );
}

// Custom Post Type: html5presentation: Appearance
add_filter("manage_edit-html5presentation_columns", "dsgnwrks_html5presentation_edit_columns");
function dsgnwrks_html5presentation_edit_columns($columns){
        $columns = array(
            "cb" => "<input type=\"checkbox\" />",
            "title" => "Slide Title",
            "Presentation" => "Presentation Name",
            "theexcerpt" => "Excerpt",
            "date" => "Date Published",
            "attributes" => "Custom Order",
        );

        return $columns;
}

add_action( "manage_pages_custom_column" , "custom_columns" );
function custom_columns($column){
        global $post;
        switch ($column)
        {
            case "Presentation":
                echo '<a href="' . get_edit_post_link( $post->post_parent ) . '">';
                echo get_the_title( $post->post_parent ) . ' (Edit Presentation)';
                echo '</a>';
                break;
            case "theexcerpt":
                the_excerpt();
                break;
            case "attributes":
                echo $post->menu_order ;
                break;
        }
}

// Register the column as sortable
add_filter( 'manage_edit-html5presentation_sortable_columns', 'dsgnwrks_html5presentation_edit_columns_sortable' );
function dsgnwrks_html5presentation_edit_columns_sortable($columns) {
    $columns1['title'] = '&orderby=title&order=asc';
    $columns1['date'] = 'DESC';
    $columns1['attributes'] = 'menu_order';
    return $columns1;
}

// Custom Post Types Icons
add_action('admin_head', 'dsgnwrks_html5presentation_icons');
function dsgnwrks_html5presentation_icons() {
    global $post_type;
    ?>
    <style>
    <?php if ( ( isset( $_GET['post_type'] ) && $_GET['post_type'] == 'html5presentation') || ( isset( $post_type ) && $post_type == 'html5presentation')) : ?>
    #icon-edit { background:transparent url('<?php echo plugins_url('images/html5-icon.png', __FILE__ ); ?>') no-repeat -14px -5px;}
    <?php endif; ?>

    #adminmenu #menu-posts-html5presentation div.wp-menu-image{background:transparent url('<?php echo plugins_url('images/html5-icon-small.png', __FILE__ ); ?>') no-repeat 5px -19px;}
    #adminmenu #menu-posts-html5presentation:hover div.wp-menu-image,#adminmenu #menu-posts-html5presentation.wp-has-current-submenu div.wp-menu-image{background:transparent url('<?php echo plugins_url('images/html5-icon-small.png', __FILE__ ); ?>') no-repeat 5px 5px;}

        </style>
<?php }

$meta_box = array(
    'id' => 'html5presentation-meta',
    'title' => 'HTML5 Slide Formatting',
    'pages' => array('html5presentation'),
    'context' => 'normal',
    'priority' => 'default',
    'fields' => array(
        array(
            'name' => 'Slide Type',
            'id' => 'html5slide_type',
            'type' => 'radio',
            'options' => array(
                array('name' => 'Standard Slide<br />', 'value' => ''),
                array('name' => 'Title Slide<br />', 'value' => 'title_slide'),
                array('name' => 'No Title<br />', 'value' => 'no_title'),
                array('name' => 'Segue Slide<br />', 'value' => 'segue_slide'),
            )
        ),
        array(
            'name' => 'Slide Style',
            'id' => 'html5slide_class',
            'type' => 'radio',
            'options' => array(
                array('name' => 'Standard<br />', 'value' => ''),
                array('name' => 'Smaller Text<br />', 'value' => 'smaller'),
                array('name' => 'Animated Revealing Child Elements<br />', 'value' => 'build'),
                array('name' => 'Content Filling the Slide<br />', 'value' => 'fill'),
                array('name' => 'No Slide Stamp (Featured Image)<br />', 'value' => 'nobackground'),
            )
        ),
        array(
            'name' => 'Presentation Type',
            'id' => 'html5presentation_type',
            'type' => 'radio',
            'options' => array(
                array('name' => 'Standard Presentation<br />', 'value' => 'standard'),
                array('name' => 'Faux Widescreen<br />', 'value' => 'faux_widescreen'),
                array('name' => 'Widescreen<br />', 'value' => 'widescreen'),
            )
        ),
        array(
            'name' => 'Remove Edit Links on Front-end',
            'id' => 'html5presentation_edit',
            'type' => 'checkbox',
        )
    )
);
add_action('admin_menu', 'dsgnwrks_html5presentation_add_box');

// Add meta box
function dsgnwrks_html5presentation_add_box() {
    global $meta_box;

    foreach ($meta_box['pages'] as $page) {
        add_meta_box($meta_box['id'], $meta_box['title'], 'dsgnwrks_html5presentation_show_box', $page, $meta_box['context'], $meta_box['priority']);
    }
}

// Callback function to show fields in meta box
function dsgnwrks_html5presentation_show_box() {
    global $meta_box, $post;

    // Use nonce for verification
    echo '<input type="hidden" name="dsgnwrks_html5presentation_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';

    echo '<table class="form-table">';

    foreach ($meta_box['fields'] as $field) {
        // get current post meta data
        if ( ( $field['id'] == 'html5presentation_type' ) && ( $post->post_parent != '0' ) ) {
            $meta = get_post_meta($post->post_parent, $field['id'], true);
        } elseif ( ( $field['id'] == 'html5presentation_edit' ) && ( $post->post_parent != '0' ) ) {
            $meta = get_post_meta($post->post_parent, $field['id'], true);
        } else {
            $meta = get_post_meta($post->ID, $field['id'], true);
        }

        echo '<tr>',
                '<th style="width:65px;">';
                if ( ( $field['id'] == 'html5presentation_type' ) && ( $post->post_parent != '0' ) ) {
                } elseif ( ( $field['id'] == 'html5presentation_edit' ) && ( $post->post_parent != '0' ) ) {
                } else {
                    echo '<b><label for="', $field['id'], '">', $field['name'], '</label></b>';
                }
                echo '</th>',
                '<td>';                '<td>';
        switch ($field['type']) {
            case 'radio':
                foreach ($field['options'] as $option) {
                    if ( ( $field['id'] == 'html5presentation_type' ) && ( $post->post_parent != '0' ) ) {
                    } else {
                        echo '<label><input style="margin-right: 5px;" type="radio" name="', $field['id'], '" value="', $option['value'], '"', $meta == $option['value'] ? ' checked="checked"' : '', ' />', $option['name'], '</label>';
                    }
                }
                break;
            case 'checkbox':
                    if ( ( $field['id'] == 'html5presentation_edit' ) && ( $post->post_parent == '0' ) ) {
                        echo '<input style="margin-right: 5px;" type="checkbox" name="', $field['id'], '" id="', $field['id'], '"', $meta ? ' checked="checked"' : '', ' />';
                    }
                break;
        }
        echo     '<td>',
            '</tr>';
    }

    echo '</table>';
}

add_action( 'save_post', 'dsgnwrks_html5presentation_save_data', 10, 2 );
// Save data from meta box
function dsgnwrks_html5presentation_save_data( $id, $post ) {
    global $meta_box;

    // verify nonce
    if ( !isset( $_POST['dsgnwrks_html5presentation_meta_box_nonce'] ) || !wp_verify_nonce($_POST['dsgnwrks_html5presentation_meta_box_nonce'], basename(__FILE__))) {
        return $id;
    }

    // check autosave
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return $id;
    }

    // check permissions
    if ('page' == $_POST['post_type']) {
        if (!current_user_can('edit_page', $id)) {
            return $id;
        }
    } elseif (!current_user_can('edit_post', $id)) {
        return $id;
    }

    foreach ($meta_box['fields'] as $field) {
        $old = get_post_meta($id, $field['id'], true);
        $new = $_POST[$field['id']];

        if ($new && $new != $old) {
            if ( ( $field['id'] == 'html5presentation_type' ) && ( $post->post_parent != '0' ) ) {
                update_post_meta($post->post_parent, $field['id'], $new);
            } else {
                update_post_meta($id, $field['id'], $new);
            }
        } elseif ('' == $new && $old) {
            delete_post_meta($id, $field['id'], $old);
        }
    }
}

add_action( 'do_meta_boxes' , 'remove_html5presentations_page_attributes' );
function remove_html5presentations_page_attributes() {
global $post;
    remove_meta_box('pageparentdiv', 'html5presentation', 'side', 'core');
    if ( $post->post_parent )
        remove_meta_box( 'postimagediv', 'html5presentation', 'side' );
}

// HTML5 Presentation Picker Meta-Box
add_action( 'add_meta_boxes', 'dsgnwrks_add_html5presentation_meta_box' );
function dsgnwrks_add_html5presentation_meta_box() {
    add_meta_box(
        'dsgnwrks_html5presentation_select',
        'HTML5 Presentation',
        'presentation_attributes_meta_box',
        'page',
        'side'
    );
    add_meta_box(
        'dsgnwrks_html5presentation_select',
        'HTML5 Slide' ? __('HTML5 Slide Attributes') : __('Attributes'),
        'presentation_attributes_meta_box',
        'html5presentation',
        'side',
        'core'
        );
}
function presentation_attributes_meta_box($post) {

        if ( $post->post_type == 'html5presentation' ) {
            $option_none = __('(New Presentation)');
            $meta_name = 'parent_id';
            $selected = $post->post_parent;
        }
        else {
            $option_none = __('(Select a presentation)');
            $meta_name = 'associated_presentation_ID';
            $selected = get_post_meta( $post->ID, 'associated_presentation_ID', true);

            wp_nonce_field( plugin_basename( __FILE__ ), 'dsgnwrks_html5presentations_meta_box_noncename' );
        }

        $pages = wp_dropdown_pages(array('post_type' => 'html5presentation', 'exclude_tree' => $post->ID, 'selected' => $selected, 'name' => $meta_name, 'depth' => 1, 'show_option_none' => $option_none, 'sort_column'=> 'menu_order, post_title', 'echo' => 0));
        if ( ! empty( $pages ) ) {
            ?>
            <style type="text/css">
            #associated_presentation_ID {
                max-width: 100%;
            }
            </style>
            <?php
            if ( $post->post_type == 'html5presentation' ) { ?>
                <p><strong><?php _e('This slide belongs to:') ?></strong></p>
                <label class="screen-reader-text" for="parent_id"><?php _e('This slide belongs to:') ?></label>
                <?php echo $pages; ?>
            <?php } else { ?>
                <?php echo $pages; ?>
                <p class="howto"><?php _e('Choose an HTML5 Presentation to display on this page:') ?></p>
                <label class="screen-reader-text" for="<?php echo $meta_name ?>"><?php _e('This slide belongs to:') ?></label>
            <?php }
        } // end empty pages check

        if ( $post->post_type == 'html5presentation' ) { ?>
            <p><strong><?php _e('Manually Order Slides') ?></strong></p>
            <p class="howto">Begins with 0. Default ordering is by date, oldest first.</p>
            <p><label class="screen-reader-text" for="menu_order"><?php _e('Order') ?></label><input name="menu_order" type="text" size="4" id="menu_order" value="<?php echo esc_attr($post->menu_order) ?>" /></p>
            <p><?php if ( 'page' == $post->post_type ) _e( 'Need help? Use the Help tab in the upper right of your screen.' ); ?></p>
        <?php }
}

add_action('save_post', 'save_associated_html5presentation_to_post', 1, 2);
function save_associated_html5presentation_to_post($post_id, $post) {
    if ( !isset( $_POST['dsgnwrks_html5presentations_meta_box_noncename'] ) || !wp_verify_nonce( $_POST['dsgnwrks_html5presentations_meta_box_noncename'], plugin_basename(__FILE__) ))
    return $post->ID;

    if ( !current_user_can( 'edit_post', $post->ID ) )
        return $post->ID;

    if( $post->post_type == 'revision' ) return;

    $presentation_id = $_POST['associated_presentation_ID'];
    update_post_meta($post->ID, 'associated_presentation_ID', $presentation_id);
    if(!$presentation_id)
        delete_post_meta($post->ID, 'associated_presentation_ID');


}

add_action( 'template_redirect', 'load_html5presentation_template' );
function load_html5presentation_template() {
    global $post;
    if ( isset( $post->ID ) && ( $presentation_id = get_post_meta( $post->ID, 'associated_presentation_ID', true ) ) ) {
        html5_run_presentation( $presentation_id );
        exit;
    }
}

?>