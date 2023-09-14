<?php

use CottageRetreat\Helpers;

if (function_exists('acf_register_block')) {
	acf_register_block_type([
		'name'              => 'hero',
		'title'             => __('Hero / Banner'),
		'description'       => __('The main first component to a page, showcasing a nice image and large heading.'),
		'render_callback'   => ['CottageRetreat\Helpers', 'acf_block'],
		'category'          => 'layout',
		'mode'              => 'edit',
		'icon'              => 'screenoptions',
		'keywords'          => [ 'hero', 'block' ],
		'supports'          => [ 'mode' => false ]
	]);
}