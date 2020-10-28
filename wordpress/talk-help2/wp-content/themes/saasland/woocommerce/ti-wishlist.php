<?php
/**
 * The Template for displaying wishlist for owner.
 *
 * @version 1.20.0
 * @package TInvWishlist\Template
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}
wp_enqueue_script( 'tinvwl' );
?>
<?php do_action( 'tinvwl_before_wishlist', $wishlist ); ?>
        <div class="cart_title">
            <div class="row">
                <div class="col-md-6 col-4">
                    <h6 class="f_p"> <?php esc_html_e( 'Product Name', 'saasland' ); ?> </h6>
                </div>
                <?php if ( isset( $wishlist_table_row['colm_price'] ) && $wishlist_table_row['colm_price'] ) { ?>
                <div class="col-md-2 col-4">
                    <h6 class="f_p"> <?php esc_html_e( 'Unit Price', 'saasland' ); ?> </h6>
                </div>
                <?php } ?>
                <?php if ( isset( $wishlist_table_row['colm_stock'] ) && $wishlist_table_row['colm_stock'] ) { ?>
                <div class="col-md-4 col-4">
                    <h6 class="f_p"> <?php esc_html_e( 'Stock Status', 'saasland' ); ?> </h6>
                </div>
                <?php } ?>
            </div>
        </div>

        <?php wc_print_notices(); ?>
        <form action="<?php echo esc_url( tinv_url_wishlist() ); ?>" class="woocommerce-cart-form" method="post" autocomplete="off">
            <div class="table-responsive">
                <?php do_action( 'tinvwl_before_wishlist_table', $wishlist ); ?>
                <table class="row table cart_table wislist_table mb-0 tinvwl-table-manage-list">
                    <tbody>

                    <?php
                    foreach ( $products as $wl_product ) {
                        $product = apply_filters( 'tinvwl_wishlist_item', $wl_product['data'] );
                        unset( $wl_product['data'] );
                        if ( $wl_product['quantity'] > 0 && apply_filters( 'tinvwl_wishlist_item_visible', true, $wl_product, $product ) ) {
                            $product_url = apply_filters( 'tinvwl_wishlist_item_url', $product->get_permalink(), $wl_product, $product );
                            do_action( 'tinvwl_wishlist_row_before', $wl_product, $product );
                            ?>
                            <tr>

                                <td class="product col-lg-6 col-md-5 col-sm-5 col-xs-5" data-title="<?php esc_attr_e( 'PRODUCT', 'saasland' ) ?>">
                                    <div class="media">
                                        <div class="media-left">
                                            <?php
                                            $thumbnail = apply_filters( 'tinvwl_wishlist_item_thumbnail', $product->get_image(), $wl_product, $product );
                                            if ( ! $product->is_visible() ) {
                                                echo wp_kses_post($thumbnail); // WPCS: xss ok.
                                            } else {
                                                printf( '<a href="%s">%s</a>', esc_url( $product_url ), $thumbnail ); // WPCS: xss ok.
                                            }
                                            ?>
                                        </div>
                                        <div class="media-body">
                                            <h5 class="mb-0">
                                                <?php
                                                if ( ! $product->is_visible() ) {
                                                    echo apply_filters( 'tinvwl_wishlist_item_name', $product->get_title(), $wl_product, $product ) . '&nbsp;'; // WPCS: xss ok.
                                                } else {
                                                    echo apply_filters( 'tinvwl_wishlist_item_name', sprintf( '<a href="%s">%s</a>', esc_url( $product_url ), $product->get_title() ), $wl_product, $product ); // WPCS: xss ok.
                                                }
                                                echo apply_filters( 'tinvwl_wishlist_item_meta_data', tinv_wishlist_get_item_data( $product, $wl_product ), $wl_product, $product ); // WPCS: xss ok.
                                                ?>
                                            </h5>
                                        </div>
                                    </div>
                                </td>

                                <?php if ( isset( $wishlist_table_row['colm_price'] ) && $wishlist_table_row['colm_price'] ) { ?>
                                    <td class="col-lg-2 col-md-2 col-sm-2 col-xs-2" data-title="<?php esc_attr_e( 'PRICE', 'saasland' ) ?>">
                                        <div class="total">
                                            <?php echo apply_filters( 'tinvwl_wishlist_item_price', $product->get_price_html(), $wl_product, $product ); ?>
                                        </div>
                                    </td>
                                <?php } ?>

                                <?php if ( isset( $wishlist_table_row['colm_stock'] ) && $wishlist_table_row['colm_stock'] ) { ?>
                                    <td class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                                        <div class="quantity">
                                            <div class="product-qty">
                                                <p>
                                                    <?php
                                                    $availability = (array) $product->get_availability();
                                                    if ( ! array_key_exists( 'availability', $availability ) ) {
                                                        $availability['availability'] = '';
                                                    }
                                                    if ( ! array_key_exists( 'class', $availability ) ) {
                                                        $availability['class'] = '';
                                                    }
                                                    $availability_html = empty( $availability['availability'] ) ? '<p class="stock ' . esc_attr( $availability['class'] ) . '">
                                                        <span class="tinvwl-txt">' . esc_html__( 'In stock', 'saasland' ) . '</span></p>'
                                                        : '<p class="stock ' . esc_attr( $availability['class'] ) . '"><span><i class="ftinvwl ftinvwl-' . ( ( 'out-of-stock' === esc_attr( $availability['class'] ) ? 'times' : 'check' ) ) . '"></i></span>
                                                        <span>' . esc_html( $availability['availability'] ) . '</span></p>';

                                                    echo apply_filters( 'tinvwl_wishlist_item_status', $availability_html, $availability['availability'], $wl_product, $product ); // WPCS: xss ok.
                                                    ?>
                                                </p>
                                            </div>
                                        </div>
                                    </td>
                                <?php } ?>

                                <?php if ( isset( $wishlist_table_row['add_to_cart'] ) && $wishlist_table_row['add_to_cart'] ) { ?>
                                    <td class="col-lg-2 col-md-3 col-sm-3 col-xs-3" data-title="<?php esc_attr_e( 'CART', 'saasland' ) ?>">
                                            <div class="del-item">
                                            <?php
                                            if ( apply_filters( 'tinvwl_wishlist_item_action_add_to_cart', $wishlist_table_row['add_to_cart'], $wl_product, $product ) ) {
                                                ?>
                                                <a href="?add-to-cart=<?php echo esc_attr( $wl_product['ID'] ); ?>" class="add_cart">
                                                    <?php echo esc_html( apply_filters( 'tinvwl_wishlist_item_add_to_cart', $wishlist_table_row['text_add_to_cart'], $wl_product, $product ) ); ?>
                                                </a>
                                            <?php } ?>
                                                <button type="submit" name="tinvwl-remove"
                                                        value="<?php echo esc_attr( $wl_product['ID'] ); ?>"
                                                        title="<?php esc_html_e( 'Remove', 'saasland' ) ?>"><i class="icon_close"></i></i>
                                                </button>

                                            </div>
                                    </td>
                                <?php } ?>
                            </tr>
                        <?php }} ?>
                    </tbody>
                </table>
            </div>
        </form>


        <div class="tinv-lists-nav tinv-wishlist-clear">
            <?php do_action( 'tinvwl_pagenation_wishlist', $wishlist ); ?>
        </div>

