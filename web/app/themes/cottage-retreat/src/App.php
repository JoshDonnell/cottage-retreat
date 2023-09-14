<?php

use Timber\Site;
use CottageRetreat\Config;
use CottageRetreat\Helpers;
use CottageRetreat\Remove;
use CottageRetreat\Blocks;

class App extends Site {
	public function __construct() 
	{
		new Remove;
		new Blocks;

		add_action( 'after_setup_theme', array( $this, 'theme_supports' ) );
		add_action( 'init', array( $this, 'register_post_types' ) );
		add_action( 'init', array( $this, 'register_taxonomies' ) );
		add_action('init', array($this, 'create_acf_options_page'));
		add_action('init', array($this, 'register_image_thumbnails'));
		add_action('init', array($this, 'register_menus'));

		add_filter( 'timber/context', array( $this, 'add_to_context' ) );
		add_filter( 'timber/twig', array( $this, 'add_to_twig' ) );
		add_filter( 'timber/twig/environment/options', [ $this, 'update_twig_environment_options' ] );

		parent::__construct();
	}

	/**
	 * This is where you can register custom post types.
	 */
	public function register_post_types()
	{

	}

	/**
	 * This is where you can register custom taxonomies.
	 */
	public function register_taxonomies()
	{

	}

	/**
	 * Create ACF Options Page
	 */
	public function create_acf_options_page() 
	{
		if(!get_field('acf_options')) {
            if(function_exists('acf_add_options_page')) acf_add_options_page();
        }
	}

	/**
	 * Register Thumbnail sizes
	*/

	function register_image_thumbnails()
	{
		$image_sizes = !empty(getenv('WP_IMAGE_SIZES')) ? explode(',', getenv('WP_IMAGE_SIZES')) : [375, 767, 1024, 1280, 1800, 2500];     

		foreach ($image_sizes as $width) {
			add_image_size($width . '-thumb', $width);
		}
	}

	/**
	 * Register navigation via our config
	 */

	function register_menus()
	{
		register_nav_menus(Config::menus());
	}

	/**
	 * This is where you add some context
	 *
	 * @param string $context context['this'] Being the Twig's {{ this }}.
	 */
	public function add_to_context( $context )
	{
		$context['menu']  = $this->build_navigation();
		$context['site']  = $this;
		$context['options'] = get_fields('options');

		return $context;
	}

	/**
	 * Build out our navigation into our array
	 */

	public function build_navigation()
	{
		$menus = [];

		// TODO - Impliment object caching
		foreach(get_registered_nav_menus() as $key => $menu) {
			$menus[$key] =  Timber::get_menu($key);
		}

		return $menus;
	}

	public function theme_supports()
	{
		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
			)
		);

		/*
		 * Enable support for Post Formats.
		 *
		 * See: https://codex.wordpress.org/Post_Formats
		 */
		add_theme_support(
			'post-formats',
			array(
				'aside',
				'image',
				'video',
				'quote',
				'link',
			)
		);

		add_theme_support( 'menus' );

        /*
		 * Remove file edit from admin
		 */
        defined('DISALLOW_FILE_EDIT') or define('DISALLOW_FILE_EDIT', true);
	}

	/**
	 * This is where you can add your own functions to twig.
	 *
	 * @param Twig\Environment $twig get extension.
	 */
	public function add_to_twig( $twig )
	{
		/**
		 * Required when you want to use Twig’s template_from_string.
		 * @link https://twig.symfony.com/doc/3.x/functions/template_from_string.html
		 */
		// $twig->addExtension( new Twig\Extension\StringLoaderExtension() );

		// Add helpers to twig
		$mix_helper = new Twig\TwigFunction('mix', function($path) {
			Helpers::mix($path);
		});


		// Add helper to generate responsive images
		$responsive_images = new Twig\TwigFunction('responsiveImage', function($default, $tablet = null, $mobile = null, $maxWidth = false, $parentClass = false, $childClass = false, $fetchpriority = null, $lazy = true) {
			Helpers::responsive_image($default, $tablet, $mobile, $maxWidth, $parentClass, $childClass, $fetchpriority, $lazy);
		});

		$twig->addFunction($mix_helper);
		$twig->addFunction($responsive_images);


		return $twig;
	}

	/**
	 * Updates Twig environment options.
	 *
	 * @link https://twig.symfony.com/doc/2.x/api.html#environment-options
	 *
	 * \@param array $options An array of environment options.
	 *
	 * @return array
	 */
	function update_twig_environment_options( $options )
	{
	    // $options['autoescape'] = true;

	    return $options;
	}
}
