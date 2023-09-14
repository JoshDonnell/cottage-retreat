<?php

use CottageRetreat\Helpers;

if (function_exists('acf_register_block')) {
	acf_register_block_type([
		'name'              => 'accordions',
		'title'             => __('Accordions'),
		'description'       => __('Accordions component with the ability to show and hide content.'),
		'render_callback'   => ['CottageRetreat\Helpers', 'acf_block'],
		'category'          => 'layout',
		'mode'              => 'edit',
		'icon'              => 'screenoptions',
		'keywords'          => [ 'accordions', 'block' ],
		'supports'          => [ 'mode' => false ]
	]);
}