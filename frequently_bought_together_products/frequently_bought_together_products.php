<?php
/*
* Plugin Name: Frequently Bought Together Products
* Description: Shows frequently bought together products on the product page.
* Version: 1.0
* Author: Sibi
*/




defined('ABSPATH') or die();
if(!file_exists(WP_PLUGIN_DIR.'/frequently_bought_together_products/vendor/autoload.php')) return;
require_once WP_PLUGIN_DIR.'/frequently_bought_together_products/vendor/autoload.php';
defined("FBT_PATH") or define("FBT_PATH",plugin_dir_url(__FILE__));

if((!class_exists('Fbt\App\Router'))  || (!method_exists(\Fbt\App\Router::class,'hooks'))) return;
$router=new \Fbt\App\Router();
$router->hooks();






