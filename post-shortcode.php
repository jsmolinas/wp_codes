<?php

function post_shortcode_func($atts) {
    $atts = shortcode_atts( array(
        'category_name' => '',
        'posts_per_page' => '',
    ), $atts);

    extract( $atts );

    $args = array(
        'category_name' => $category_name, 
        'posts_per_page' => $posts_per_page
    );

    $the_query = new WP_Query($args);

    if ( $the_query->have_posts() ) :
        $content = '';
        while ( $the_query->have_posts() ) :

            $the_query->the_post();
            $content .= '<h3>'.get_the_title().'</h3>';
            $content .= '<p>'.get_the_excerpt().'</p>';
        endwhile;
        wp_reset_postdata();
    else :
        $content.='<div><p>Sorry, no posts matched your criteria.</p></div>';
    endif;

    return $content;
}

add_shortcode('generalpost', 'post_shortcode_func');

?>
