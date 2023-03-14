<?php
echo '<div class="bought-together-products">';
    echo '<h2>' . __( 'Buy with it', 'woocommerce' ) . '</h2>';
    echo '<form id="form" name="form">
        <ul class="flex-container" >';
            $bought_together_product_price=0;
            foreach ( $bought_together_products as $product_ids ) {
            $products = wc_get_product( $product_ids  );
            $products_id=$products->get_id();
            $product_image=$products->get_image();
            $product_price=$products->get_price();
            $bought_together_product_price=$bought_together_product_price+$product_price;
            echo '<p>' . $product_image .'</p>';
            echo '<div class="adding">';
                echo '<h2>' ."+".'</h2>';
                echo '</div>
            <input type="hidden" name="prod[]" id="ids" value="'.$products_id.'"/>';
            }
            echo '<div class="total-price">';
                echo '<p> '."Total price:$" .$bought_together_product_price.'</p>';
                echo '</div>';
            echo '<button type="button" class="button" id="submit">Add all to cart</button>';
            echo '</ul>';
        echo '</div>';?>
</form>