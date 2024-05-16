// alert("Hello world");
document.addEventListener('DOMContentLoaded', function() {
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


