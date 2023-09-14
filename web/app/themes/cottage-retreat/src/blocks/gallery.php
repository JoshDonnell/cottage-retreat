<?php

use CottageRetreat\Helpers;

if (function_exists('acf_register_block')) {
	acf_register_block_type([
		'name'              => 'gallery',
		'title'             => __('Image Gallery'),
		'description'       => __('Masonry grid based image gallery.'),
		'render_callback'   => ['CottageRetreat\Helpers', 'acf_block'],
		'category'          => 'layout',
		'mode'              => 'edit',
		'icon'              => 'screenoptions',
		'keywords'          => [ 'image gallery', 'block' ],
		'supports'          => [ 'mode' => false ]
	]);
}