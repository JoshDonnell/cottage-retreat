<?php

use CottageRetreat\Helpers;

if (function_exists('acf_register_block')) {
	acf_register_block_type([
		'name'              => 'content',
		'title'             => __('Content'),
		'description'       => __('A simple component allowing for a heading, content and a CTA'),
		'render_callback'   => ['CottageRetreat\Helpers', 'acf_block'],
		'category'          => 'layout',
		'mode'              => 'edit',
		'icon'              => 'screenoptions',
		'keywords'          => [ 'content', 'block' ],
		'supports'          => [ 'mode' => false ]
	]);
}