<?php

namespace CottageRetreat;

class Helpers {
    /**
     * Get the path to a versioned Mix file.
     */
    public static function mix($path)
    {
        static $manifest;
        $publicFolder = '/resources/dist';
        $themePath = '/app/themes/cottage-retreat';
        $rootPath = $_SERVER['DOCUMENT_ROOT'] . $themePath;
        $publicPath = $rootPath . $publicFolder;

        if (!$manifest) {
            if (!file_exists($manifestPath = ($rootPath .'/mix-manifest.json') )) {
                throw new Exception('Manifest Now Found');
            }

            $manifest = json_decode(file_get_contents($manifestPath), true);
        }

        $path = $publicFolder . $path;

        if (!array_key_exists($path, $manifest)) {
            throw new Exception(
                'No file found, please check the manifest json file.'
            );
        }

        echo $themePath.$manifest[$path];
    }


    /** 
     * ACF Block loader helper
    */

    public static function acf_block( $block, $content = '', $is_preview = false )
    {
		$context = \Timber::context();
		$context['block'] = $block;
		$context['data'] = get_fields();
		$context['is_preview'] = $is_preview;
        \Timber::render( 'blocks/' . str_replace('acf/', '', $block['name']) . '.twig', $context);
	}


    /**
     * Responsive Image Helper
     */

    public static function responsive_image($default, $tablet = null, $mobile = null, $maxWidth = false, $parentClass = false, $childClass = false, $fetchPriority = null, $lazy = true)
    { 
        $theme_image_sizes = !empty(getenv('WP_IMAGE_SIZES')) ? explode(',', getenv('WP_IMAGE_SIZES')) : [375, 767, 1024, 1280, 1800, 2500];     
        $image_sizes_to_use = $maxWidth ? [] : $theme_image_sizes;

        if ($maxWidth) {
            $image_sizes_to_use = array_filter($theme_image_sizes, function($width) use ($maxWidth) {
                return ($width <= $maxWidth);
            });
        }

        \Timber::render('components/image.twig' ,[
            'default_image' => $default,
            'tablet_image' => $tablet,
            'mobile_image' => $mobile,
            'max_width' => $maxWidth,
            'parent_class' => $parentClass,
            'child_class' => $childClass,
            'fetchpriority' => $fetchPriority,
            'lazy_loaded' => $lazy,
            'image_sizes' => $image_sizes_to_use,
        ]);
    }
}