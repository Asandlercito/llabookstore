$('.J-OrderBuy .fl').click(function () {
    if ( $(this).parents('.J-OrderBuy').hasClass('order-buy-cart--show') ) {
        $(this).parents('.J-OrderBuy').removeClass('order-buy-cart--show');
        $('.J-OrderListBox').slideUp(500);
        $('.show-order').text('Show order summary');
        $('.J-showDiscount').show();
    } else {
        $(this).parents('.J-OrderBuy').addClass('order-buy-cart--show');
        $('.J-OrderListBox').slideDown();
        $('.J-showDiscount').hide(500);
        $('.show-order').text('Hide order summary');
    }
})

$('.J-GetCouponVal').on('keyup', function () {
    if ( '' == $(this).val() ) {
        $('.J-GetCoupon').addClass('np-ui-disabled').attr('disabled', 'disabled');
    } else {
        $('.J-GetCoupon').removeClass('np-ui-disabled').removeAttr('disabled');
    }
});

$('.J-OrderVal,.J-BillVal').on('keyup', function () {
    if ( '' == $.trim($(this).val()) ) {
        $(this).parent('.order-write-item').removeClass('order-write--show');
    } else {
        $(this).parent('.order-write-item').addClass('order-write--show');
        $(this).removeClass('invalid').siblings('.np-ui-input-tips').text('').hide()
    }
});

$('.J-shipping-match li').click(function () {
    var shippingId = $(this).data('id');
    var price = $(this).find('.shipping-match-sel > span').attr('data-fee');
    $(this).find('.shipping-match-sel > span').addClass('np-ui-radio-active');
    $(this).siblings().find('.shipping-match-sel > span').removeClass('np-ui-radio-active');
    llabook.shipping.update(shippingId, price);
});

$('.J-paypalAdd').click(function () {
    var e = $(this).index();
    $(this).find('.np-ui-radio').addClass('np-ui-radio-active');
    $(this).siblings().find('.np-ui-radio').removeClass('np-ui-radio-active');

    if (e == 1) {
        $(this).siblings('.order-paypal-box').slideDown(300);
    } else {
        $(this).siblings('.order-paypal-box').slideUp(300);
    }
});

$('.J-Offers').click(function () {
    $(this).children('.np-ui-checkbox').hasClass('np-ui-checkbox-active')
    ? ($(this).children('.np-ui-checkbox').removeClass('np-ui-checkbox-active'))
    : ($(this).children('.np-ui-checkbox').addClass('np-ui-checkbox-active'));
});
