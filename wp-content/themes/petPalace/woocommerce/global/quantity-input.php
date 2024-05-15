<div class="quantity">
    <?php
    /**
     * Hook to output something before the quantity input field.
     *
     * @since 7.2.0
     */
    do_action( 'woocommerce_before_quantity_input_field' );
    ?>
    <label class="screen-reader-text" for="<?php echo esc_attr( $input_id ); ?>"><?php echo esc_attr( $label ); ?></label>
    <button type="button" class="minus">-</button>
    <input
        type="<?php echo esc_attr( $type ); ?>"
        <?php echo $readonly ? 'readonly="readonly"' : ''; ?>
        id="<?php echo esc_attr( $input_id ); ?>"
        class="<?php echo esc_attr( join( ' ', (array) $classes ) ); ?> qty"
        name="<?php echo esc_attr( $input_name ); ?>"
        value="<?php echo esc_attr( $input_value ); ?>"
        aria-label="<?php esc_attr_e( 'Product quantity', 'woocommerce' ); ?>"
        size="4"
        min="<?php echo esc_attr( $min_value ); ?>"
        max="<?php echo esc_attr( 0 < $max_value ? $max_value : '' ); ?>"
        <?php if ( ! $readonly ) : ?>
            step="<?php echo esc_attr( $step ); ?>"
            placeholder="<?php echo esc_attr( $placeholder ); ?>"
            inputmode="<?php echo esc_attr( $inputmode ); ?>"
            autocomplete="<?php echo esc_attr( isset( $autocomplete ) ? $autocomplete : 'on' ); ?>"
        <?php endif; ?>
    />
    <button type="button" class="plus">+</button>
    <?php
    /**
     * Hook to output something after quantity input field
     *
     * @since 3.6.0
     */
    do_action( 'woocommerce_after_quantity_input_field' );
    ?>
</div>

<script type="text/javascript">
    jQuery(document).ready(function($){
        function addQuantityHandlers() {
            $('.quantity').off('click', '.plus').on('click', '.plus', function(e) {
                $input = $(this).prev('input.qty');
                var val = parseInt($input.val(), 10);
                if (!isNaN(val)) {
                    $input.val( val + 1 ).change();
                } else {
                    $input.val(1).change();
                }
            });

            $('.quantity').off('click', '.minus').on('click', '.minus', function(e) {
                $input = $(this).next('input.qty');
                var val = parseInt($input.val(), 10);
                if (!isNaN(val) && val > 0) {
                    $input.val( val - 1 ).change();
                } else {
                    $input.val(0).change();
                }
            });
        }

        addQuantityHandlers();

        $(document.body).on('updated_cart_totals', function() {
            addQuantityHandlers();
        });
    });
</script>


