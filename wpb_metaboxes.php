<?php
function wpb_metaboxes( $meta_boxes ) {
    $prefix = '_cmb_'; // Prefix for all fields
    $meta_boxes['wpb_metabox'] = array(
        'id' => 'wpb_metabox',
        'title' => 'WPB Circliful Options',
        'pages' => array('circliful'), // post type
        'context' => 'normal',
        'priority' => 'high',
        'show_names' => true, // Show field names on the left
        'fields' => array(
            array(
                'name' => 'Percent',
                'desc' => 'Put your data percent.',
                'id' => $prefix . 'wpb_percent',
                'type' => 'text',
				'default' => '75'
            ),
			array(
                'name' => 'Data Type',
                'desc' => 'Put your data type.',
                'id' => $prefix . 'wpb_type',
                'type' => 'text',
				'default' => '%'
            ),
			array(
                'name' => 'Dimension',
                'desc' => 'Put your dimension. For best result use less than 250',
                'id' => $prefix . 'wpb_dimension',
                'type' => 'text',
				'default' => '240'
            ),
			array(
                'name' => 'Actice width',
                'desc' => 'Put your actice circle width. For best result use less than 20',
                'id' => $prefix . 'wpb_width',
                'type' => 'text',
				'default' => '12'
            ),
			array(
                'name' => 'Font Size',
                'desc' => 'Put your font size. For best result use less than 30',
                'id' => $prefix . 'wpb_fontsize',
                'type' => 'text',
				'default' => '28'
            ),
			
			array(
                'name' => 'Color',
                'desc' => 'Select active color.',
                'id' => $prefix . 'wpb_color',
                'type' => 'colorpicker',
				'default' => '#61A9DC'
            ),
			array(
                'name' => 'Font Awesome',
                'desc' => 'Fontawesome icon class.Every Fontawesome Icon without the "fa" for example not fa fa-plus just fa-plus.',
                'id' => $prefix . 'wpb_icon',
                'type' => 'text',
            ),
        ),
    );

    return $meta_boxes;
}
add_filter( 'cmb_meta_boxes', 'wpb_metaboxes' );
