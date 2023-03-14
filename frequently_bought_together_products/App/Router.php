<?php

namespace Fbt\App;
defined('ABSPATH') or die();
use Fbt\App\controller\Base;
class Router
{
    public function hooks()
    {
        if (!class_exists("Fbt\\App\\controller\\Base")) return;
        $base = new Base();
        add_filter('woocommerce_product_data_tabs', array($base, 'addFrequentlyBoughtTogetherTab'));
        add_action('woocommerce_product_data_panels', array($base, 'woocommerceProductCustomFields'));
        add_action('woocommerce_process_product_meta', array($base, 'processProductMeta'),10,1);
        add_action( 'woocommerce_after_single_product_summary',array($base,'showBoughtTogetherProducts') );
        add_action('wp_enqueue_scripts', array($base, 'myScripts'));
        add_action( 'wp_enqueue_scripts', array($base,'EnqueueStyles') );
        add_action('wp_ajax_submitForm', array($base, 'submitForm'));
    }
}



