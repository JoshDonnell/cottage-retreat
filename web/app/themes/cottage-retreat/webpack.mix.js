let mix = require('laravel-mix');
require('laravel-mix-purgecss');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for your application, as well as bundling up your JS files.
 |
 */

mix.setPublicPath('/')
	.ts('resources/js/app.ts', 'resources/dist/js')
	.sass('resources/css/app.scss', 'resources/dist/css')
	.purgeCss({
		content: [
			'resources/js/**/**/*.js',
			'resources/js/**/**/*.ts',
			'views/**/*.twig',
			'src/**/*.php',
		],
		extend: {
			defaultExtractor: (content) => content.match(/[A-z0-9-:\/\@]+/g) || [],
		},
	})
	.version()
	.browserSync({
		proxy:'cottage-retreat.localhost',
		files: ["resources/dist/css/app.css", "resources/dist/js/app.js", "views/**/**/*"]
	});