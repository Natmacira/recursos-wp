<?php
function dhd_enqueue_styles()
{
    // Cargar los estilos del tema padre
    wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');

    // Cargar los estilos del tema hijo
    wp_enqueue_style('child-style', get_stylesheet_directory_uri() . '/style.css', array('parent-style'));

    // Cargar otros estilos adicionales
    wp_enqueue_style('skeleton-style', get_stylesheet_directory_uri() . '/skeleton.css', array('child-style'));

  
}
add_action('wp_enqueue_scripts', 'dhd_enqueue_styles');

/* CUSTOM POST TYPE */ 

// add action to create a custom post type
		register_post_type(
			'resources',
			array(
				'labels'      => array(
					'name'          => __('Resources', 'textdomain'),
					'singular_name' => __('Resource', 'textdomain'),
					'add_new_item' => __('Add New Resource'),
					'new_item' => __('New Resource'),
					'edit_item' => __('Edit Resource'),
					'view_item' => __('View Resource'),
					'all_items' => __('All Resources'),
					'search_items' => __('Search Resources'),
					'not_found' => __('No Resources found.'),
				),
				'public'      => true,
				'has_archive' => true,
				'supports'    => array(
					'title',
					'thumbnail'
				),
				//create meta box
				'register_meta_box_cb' => function () {
                    add_meta_box(
                        'date',                 	// Unique ID
                        'Date',      				// Box title
                        function($post){
                            $date = get_post_meta($post->ID, 'date', true);
                            ?><input type="text" name="date" id="date" class="postbox" value="<?php echo(esc_attr($date))?>"><?php
                        },
                        'resources' 					// Post type
                    );
					add_meta_box(
						'title',                 	// Unique ID
						'Title',      				// Box title
						function($post){
							$title = get_post_meta($post->ID, 'title', true);
							?><input type="text" name="title" id="title" class="postbox" value="<?php echo(esc_attr($title))?>"><?php
						},
						'resources' 					// Post type
					);
                    add_meta_box(
                        'excerpt',                   // Unique ID
                        'Excerpt',                   // Box title
                        function($post) {
                            $excerpt = get_post_meta($post->ID, 'excerpt', true);
                            ?>
                            <textarea name="excerpt" id="excerpt" class="postbox" rows="10" cols="100"><?php echo esc_textarea($excerpt); ?></textarea>
                            <?php
                        },
                        'resources'                   // Post type
                    );
                    

				}
			)
		);


        
// save posts from custom post type resources
add_action( 'save_post', function($post_id) {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) {
		return;
	}

	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	if ( 'resources' !== get_post_type( $post_id ) ) {
		return;
	}

	if ( isset( $_POST['date'] ) ) {
		$date = sanitize_text_field($_POST['date'] );

		update_post_meta( $post_id, 'date', $date );
	}
	if ( isset( $_POST['title'] ) ) {
		$title = sanitize_text_field($_POST['title'] );

		update_post_meta( $post_id, 'title', $title );
	}
	if ( isset( $_POST['excerpt'] ) ) {
		$excerpt = sanitize_text_field($_POST['excerpt'] );

		update_post_meta( $post_id, 'excerpt', $excerpt );
	}
  
} );

function display_resources_shortcode() {
    ob_start(); // Empieza a capturar la salida en un buffer

    // Consulta del custom post type 'resources'
    $query = new WP_Query(array('post_type' => 'resources'));

    if ($query->have_posts()) {
        echo '<div class="resources-container">';

        foreach ($query->posts as $resource) {
            // Obtener los valores de los metadatos personalizados
            $date = get_post_meta($resource->ID, 'date', true);
            $title = get_post_meta($resource->ID, 'title', true);
            $excerpt = get_post_meta($resource->ID, 'excerpt', true);
            ?>

            <!-- Sección con fecha, título y extracto -->
            <section class="resource-info">
                <p><strong></strong> <?php echo esc_html($date); ?></p>
                <h2><?php echo esc_html($title); ?></h2>
                <p><?php echo esc_html($excerpt); ?></p>
            </section>

            <!-- Sección con la imagen destacada -->
            <section class="resource-image">
                <?php
                if (has_post_thumbnail($resource->ID)) {
                    echo get_the_post_thumbnail($resource->ID, 'full', array('class' => 'resource-img'));
                }
                ?>
            </section>

            <?php
        }

        echo '</div>';
    } else {
        echo '<p>No resources found.</p>';
    }

    wp_reset_postdata(); // Resetea la consulta
    return ob_get_clean(); // Devuelve el contenido capturado
}
add_shortcode('display_resources', 'display_resources_shortcode');

