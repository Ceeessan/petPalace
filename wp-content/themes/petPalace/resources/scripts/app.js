// alert("Hello world");
document.addEventListener('DOMContentLoaded', function () {
    var couponInput = document.getElementById('coupon_code');
    var applyCouponButton = document.getElementById('apply_coupon_button');

    couponInput.addEventListener('input', function () {
        if (couponInput.value.trim() === '') {
            applyCouponButton.disabled = true;
        } else {
            applyCouponButton.disabled = false;
        }
    });
});

