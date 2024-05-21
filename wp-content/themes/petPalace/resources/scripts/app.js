// alert("Hello world");

//Listing:
document.addEventListener('DOMContentLoaded', function () {
    const couponInput = document.querySelector('#coupon_code');
    const applyCouponButton = document.querySelector('button[name="apply_coupon"]');

    function toggleCouponButton() {
        if (couponInput.value.trim() === '') {
            applyCouponButton.disabled = true;
        } else {
            applyCouponButton.disabled = false;
        }
    }

    toggleCouponButton();

    couponInput.addEventListener('input', toggleCouponButton);
});

//För ikonerna katt|hund|gnagare|fågel
jQuery(document).ready(function ($) {
    $('.icon-animals').on('click', function () {
        var category = $(this).data('category');
        var url = ajax_variables.siteUrl + '/product-category/' + category;
        window.location.href = url;
    });
});
