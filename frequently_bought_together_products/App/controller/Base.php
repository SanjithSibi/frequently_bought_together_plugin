<?php

namespace Fbt\App\controller;
defined('ABSPATH') or die();
class Base
{
    function addFrequentlyBoughtTogetherTab($tabs)
    {
        if(! is_array($tabs)) {
            return $tabs;
        }
            $tabs['frequently_bought_together'] = array(
                'label' => __('Bought Together', 'woocommerce'),
                'priority' => 50,
                'target' => 'Related_product',
            );
            return $tabs;
    }
    function woocommerceProductCustomFields()
    {
        global  $post;
        $product_id=$post->ID;
        ?>
        <div id="Related_product" class="panel woocommerce_options_panel hidden">
        <select class="wc-product-search" multiple="multiple" style="width: 50%;" id="grouped_products" name="product_name[]">
            <?php
            $product_ids = get_post_meta( $product_id, '_product_name',$single = true ) ;
            foreach ( $product_ids as $products ) {
                $product = wc_get_product( $products );
                $id=$product->get_id();
                if ( is_object( $product ) ) {
                    echo '<option value="' . esc_attr( $id ) . '"' . selected( true, true, false ) . '>' . esc_html( wp_strip_all_tags( $product->get_formatted_name() ) ) . '</option>';
                }
            }
            ?>
        </select>
        </div>
        <?php
    }
    function processProductMeta( $post_id ) {
        //print_r($_POST['product_name']);
        if (!empty( $_POST['product_name'] ) ) {
            update_post_meta( $post_id, '_product_name', ( $_POST['product_name'] ) );
        }

    }
    function EnqueueStyles() {
        wp_enqueue_style( 'plugin-styles', FBT_PATH . '/Assets/css/frontend.css',__FILE__ );
    }
    function myScripts()
    {
        wp_enqueue_script('bought-together', FBT_PATH . '/Assets/js/ajax.js', array('jquery'), '1.0', true);
        wp_localize_script('bought-together', 'contactForm', array(
            'ajaxUrl' => admin_url('admin-ajax.php')

        ));
    }
    function showBoughtTogetherProducts() {
        global $product;
        $product_id=$product->get_id();
        $bought_together_products = get_post_meta( $product_id, '_product_name',$single = true ) ;
        array_push($bought_together_products,$product_id);
            if (! empty( $bought_together_products) ) {
                include_once WP_PLUGIN_DIR . '/frequently_bought_together_products/App/view/frontend.php';
            }
    }
    function submitForm()
    {
        $data =$_POST['values'];
        foreach ($data as $bought_together_product_id ){
            $id=$bought_together_product_id["value"];
            WC()->cart->add_to_cart( $id, 1 );
        }
    }
}

