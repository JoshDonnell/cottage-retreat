<?php

namespace CottageRetreat;

class Blocks {
    function __construct()
    {
        add_action('acf/init', [$this, 'custom_blocks']);
        add_filter('allowed_block_types_all', [$this, 'enqueue_custom_blocks']);
    }

    public function custom_blocks()
    {
        include 'blocks/hero.php';
        include 'blocks/content.php';
        include 'blocks/gallery.php';
        include 'blocks/accordions.php';
    }

    public function enqueue_custom_blocks()
    {
        return [
            'core/block',
            'acf/hero',
            'acf/content',
            'acf/gallery',
            'acf/accordions'
        ];
    }
}