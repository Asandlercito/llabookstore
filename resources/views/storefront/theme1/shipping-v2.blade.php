@extends('storefront.layout.theme1')

@section('page-title')
    {{ __('Shipping') }}
@endsection

@push('css-page')
    <link rel="stylesheet" href="{{asset('assets/theme1/css/checkout.css')}}">
@endpush

@section('content')
    @php
        $coupon_price = !empty($coupon_price) ? $coupon_price : 0;
        $shipping_price = !empty($shipping_price) ? $shipping_price : 0;
    @endphp

    <main>
        <div class="order-wrap order-wrap-animation">
            <div class="order-content">

                <div class="nav-model-mask J-Mask"></div>

                <div class="order-inform">
                    <div class="order-header-main order-logo-mobile">
                        <div class="order-header">
                            <a href="{{route('store.slug',$store->slug)}}" itemprop="url">
                                @if(!empty($store->logo))
                                    <img data-original="{{asset(Storage::url('uploads/store_logo/'.$store->logo))}}"
                                        src="{{asset(Storage::url('uploads/store_logo/'.$store->logo))}}"
                                        alt="" itemprop="logo">
                                @else
                                    <img data-original="{{asset(Storage::url('uploads/store_logo/'.$store->logo))}}"
                                        src="{{asset(Storage::url('uploads/store_logo/'.$store->logo))}}"
                                        alt="" itemprop="logo">
                                @endif
                            </a>
                        </div>
                    </div>

                    <div class="order-buy-cart J-OrderBuy">
                        <div class="fl">
                            <span class="iconfont icon-gouwuchekong">
                                <svg viewBox="0 0 20 20" class="_1fragemd _1fragemqb _1fragem48 _1fragem47" focusable="false" aria-hidden="true"><path d="M17.178 13.088H5.453c-.454 0-.91-.364-.91-.818L3.727 1.818H0V0h4.544c.455 0 .91.364.91.818l.09 1.272h13.45c.274 0 .547.09.73.364.18.182.27.454.18.727l-1.817 9.18c-.09.455-.455.728-.91.728zM6.27 11.27h10.09l1.454-7.362H5.634l.637 7.362zm.092 7.715a1.817 1.817 0 10.002-3.634 1.817 1.817 0 00-.002 3.634zm9.18 0a1.816 1.816 0 10-.001-3.635 1.818 1.818 0 000 3.635z"></path></svg>
                            </span>
                            <span class="show-order">Show order summary</span>
                            <span class="icon-arrow iconfont icon-back">
                                <svg viewBox="0 0 14 14" class="_1fragemd _1fragemqb _1fragem48 _1fragem47" focusable="false" aria-hidden="true"><path d="M12.6 3L14 4.4 8.4 10 7 11.4 5.6 10 0 4.4 1.4 3 7 8.6"></path></svg>
                            </span>
                        </div>
                        <div class="fr">
                            <span class="order-buy-price js-order-total-price-top J-Total" data-price="">
                                <strong>$64.44</strong>
                            </span>
                        </div>
                    </div>

                    <div class="order-inform-wrap">
                        <div class="order-write">

                            <div class="order-header-main">
                                <div class="order-header">
                                    <a href="{{route('store.slug',$store->slug)}}" itemprop="url">
                                        @if(!empty($store->logo))
                                            <img data-original="{{asset(Storage::url('uploads/store_logo/'.$store->logo))}}"
                                                src="{{asset(Storage::url('uploads/store_logo/'.$store->logo))}}"
                                                alt="" itemprop="logo">
                                        @else
                                            <img data-original="{{asset(Storage::url('uploads/store_logo/'.$store->logo))}}"
                                                src="{{asset(Storage::url('uploads/store_logo/'.$store->logo))}}"
                                                alt="" itemprop="logo">
                                        @endif
                                    </a>
                                </div>
                                <div class="order-crumbs J-OrderCrumbs">
                                    <a href="{{ route('store.cart',$store->slug) }}">{{ __('Cart') }}</a>
                                    <span class="iconfont icon-back">
                                        <svg viewBox="0 0 10 10" class="_1fragemk _1fragem1b _1fragem4g _1fragem4f" focusable="false" aria-hidden="true"><path d="M2 1l1-1 4 4 1 1-1 1-4 4-1-1 4-4"></path></svg>
                                    </span>
                                    <a href="{{ route('checkout.information',$store->slug) }}">{{ __('Information') }}</a>
                                    <span class="iconfont icon-back">
                                        <svg viewBox="0 0 10 10" class="_1fragemk _1fragem1b _1fragem4g _1fragem4f" focusable="false" aria-hidden="true"><path d="M2 1l1-1 4 4 1 1-1 1-4 4-1-1 4-4"></path></svg>
                                    </span>
                                    <span class="J-step1 active">{{ __('Shipping') }}</span>
                                    <span class="iconfont icon-back">
                                        <svg viewBox="0 0 10 10" class="_1fragemk _1fragem1b _1fragem4g _1fragem4f" focusable="false" aria-hidden="true"><path d="M2 1l1-1 4 4 1 1-1 1-4 4-1-1 4-4"></path></svg>
                                    </span>
                                    <span class="J-step2">{{ __('Payment') }}</span>
                                </div>
                            </div>

                            <div class="step-section">

                                <div class="step-section-inform" style="display: block;">
                                    <div class="row">
                                        <div class="row-label"> Contact </div>
                                        <div class="row-inform J-Email">{{ $cust_details['email'] }}</div>
                                        <a class="row-change J-ChangeInformation" href="{{ route('checkout.information',$store->slug) }}">Change</a>
                                    </div>
                                    <div class="row">
                                        <div class="row-label"> Ship to </div>
                                        <div class="row-inform J-Address">
                                            {{ $cust_details['billing_address'] . ', ' . $cust_details['billing_city'] . ' ' . $cust_details['billing_postalcode'] . ', ' . $cust_details['billing_country'] }}
                                        </div>
                                        <a class="row-change J-ChangeInformation focus-address" href="{{ route('checkout.information',$store->slug) }}"> Change </a>
                                    </div>
                                </div>

                                <div class="step-section-content">
                                    <div class="order-step J-ShippingMethod" style="display: block;">
                                        <div class="order-title">Shipping method</div>

                                        <div class="information-edit">
                                            {{Form::model($cust_details, array('route' => array('checkout.processShipping', $store->slug), 'method' => 'POST')) }}

                                                <input class="js-shipping-id" type="hidden" name="shipping_id" value="{{$shipping_id}}">

                                                <div class="order-write-list clearfloat">
                                                    <div class="order-write-item order-select-logistics">
                                                        <div class="shipping-tips">
                                                            <span class="icon iconfont icon-gantanhao"></span>
                                                            <div class="shipping-tips-text">
                                                                Your cart has been modified and the shipping rate you
                                                                previously selected no longer applies. Please select a
                                                                new rate.
                                                            </div>
                                                            <div class="shipping-tips-text-no-province" style="display: none;">
                                                                This order can't be shipped to your location. Contact
                                                                the store for more information.
                                                            </div>
                                                        </div>

                                                        @if ($store->enable_shipping == "on" && $shippings->count() > 0)
                                                            <ul class="J-shipping-match shipping-match" style="display: block;">
                                                                @foreach ($shippings as $shipping)
                                                                    <li data-id="{{$shipping['id']}}">
                                                                        <div class="fl shipping-match-sel">
                                                                            <span class="np-ui-radio @if ($shipping['id'] == $shipping_id) np-ui-radio-active @endif"
                                                                                data-id="{{$shipping['id']}}"
                                                                                data-title="{{$shipping['name']}}"
                                                                                data-originfee="0.00" data-fee="{{$shipping['price']}}">
                                                                            </span>
                                                                        </div>
                                                                        <div class="shipping-match-details">
                                                                            <span>{{$shipping['name']}}</span>
                                                                        </div>
                                                                        <div class="fr shipping-match-price">
                                                                            <strong>{{\App\Models\Utility::priceFormat($shipping['price'])}}</strong>
                                                                        </div>
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        @endif

                                                        <div class="order-checkbox order-write-item display-none insurance-order-checkbox">
                                                            <span class="np-ui-checkbox np-ui-checkbox-active"></span>
                                                            <span>
                                                                Add Shipping Insurance to your order
                                                                <span class="insurance-order-subtotal"></span>
                                                            </span>
                                                            <span class="iconfont icon-wenhao phone-tips-icon insurance-tips-icon J-Tips">
                                                                <div class="phone-tips">
                                                                    <p>
                                                                        Shipping insurance offers premium protection and safety for
                                                                        your valuable items during shipping.
                                                                    </p>
                                                                    <span class="iconfont icon-bofang"></span>
                                                                </div>
                                                            </span>
                                                        </div>

                                                        <div class="J-MethodsEmpty shipping-methods" style="display: none;">
                                                            <img alt="" src="https://static-theme.cdncloud.top/buyer/public/img/shippingMethods.png">
                                                            <p>
                                                                <a href="{{route('store.cart',$store->slug)}}">
                                                                    There are no shipping methods available for your
                                                                    cart or destination.
                                                                </a>
                                                            </p>
                                                            <div class="unavailable-products" style="display: none;"></div>
                                                        </div>

                                                        <div class="J-MethodsLoading shipping-methods-loading" style="display: none;">
                                                            <span class="methods-loading">
                                                                <img src="https://static-theme.cdncloud.top/buyer/public/img/methods-load.png" alt="">
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="order-write-list order-button">
                                                    <div class="order-write-item">
                                                        <a class="J-ChangeInformation back-prev"
                                                            href="{{ route('checkout.information', $store->slug) }}">
                                                            <span class="iconfont icon-back"></span>
                                                            Return to information
                                                        </a>
                                                    </div>
                                                    <div class="order-write-item">
                                                        <button class="np-ui-btn np-ui-main-btn J-placeShipping">
                                                            <span class="btn-text">Continue to payment</span>
                                                            <span class="iconfont icon-jiazai loading"></span>
                                                        </button>
                                                        {{-- <a class="np-ui-btn np-ui-main-btn J-placeShipping"
                                                            href="{{ route('checkout.payment', $store->slug) }}">
                                                            <span class="btn-text">Continue to payment</span>
                                                            <span class="iconfont icon-jiazai loading"></span>
                                                        </a> --}}
                                                    </div>
                                                </div>
                                            {{Form::close()}}
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <p class="order-reserved">{{$storethemesetting['footer_note']}}</p>
                            <div class="order-payment-tips"></div>
                        </div>

                        <div class="order-list-box J-OrderListBox" id="card-summary">
                            <div class="order-list J-OrderList">

                                <div class="J-OrderByCart">
                                    @if(!empty($products))
                                        @php
                                            $total = 0;
                                            $sub_tax = 0;
                                            $sub_total= 0;
                                        @endphp

                                        @foreach($products as $product)
                                            @if(isset($product['variant_id']) && !empty($product['variant_id']))
                                                <div class="order-item">
                                                    <div class="order-img">
                                                        <div>
                                                            @if(!empty($product['image']))
                                                                <img src="{{asset($product['image'])}}" alt="">
                                                            @else
                                                                <img src="{{asset(Storage::url('uploads/is_cover_image/default.jpg'))}}" alt="">
                                                            @endif
                                                        </div>
                                                        <span class="fr">{{$product['quantity']}}</span>
                                                    </div>
                                                    <div class="order-iform">
                                                        <div class="order-name">
                                                            {{ $product['product_name'].' - ( ' . $product['variant_name'] .' ) ' }}
                                                        </div>
                                                        {{-- <div class="order-types">Black</div> --}}
                                                        <div class="cart-properties"></div>
                                                        <div class="discount-tag display-none">
                                                            <span class="iconfont icon-yduizhekou"></span>
                                                        </div>
                                                    </div>
                                                    <div class="order-price">
                                                        @php
                                                            $total_tax = 0;
                                                        @endphp

                                                        @if(!empty($product['tax']))
                                                            @foreach($product['tax'] as $tax)
                                                                @php
                                                                    $sub_tax = ($product['variant_price'] * $product['quantity'] * $tax['tax']) / 100;
                                                                    $total_tax += $sub_tax;
                                                                @endphp
                                                            @endforeach
                                                        @endif

                                                        @php
                                                            $totalprice = $product['variant_price'] * $product['quantity'] + $total_tax;
                                                            $subtotal = $product['variant_price'] * $product['quantity'];
                                                            $sub_total += $subtotal;
                                                        @endphp

                                                        {{\App\Models\Utility::priceFormat($totalprice)}}
                                                    </div>
                                                </div>
                                            @else
                                            <div class="order-item">
                                                <div class="order-img">
                                                    <div>
                                                        @if(!empty($product['image']))
                                                            <img src="{{asset($product['image'])}}" alt="">
                                                        @else
                                                            <img src="{{asset(Storage::url('uploads/is_cover_image/default.jpg'))}}" alt="">
                                                        @endif
                                                    </div>
                                                    <span class="fr">{{$product['quantity']}}</span>
                                                </div>
                                                <div class="order-iform">
                                                    <div class="order-name">
                                                        {{ $product['product_name'] }}
                                                    </div>
                                                    {{-- <div class="order-types">
                                                        @if(!empty($product['tax']))
                                                            +
                                                            @foreach($product['tax'] as $tax)
                                                                @php
                                                                    $sub_tax = ($product['price'] * $product['quantity'] * $tax['tax']) / 100;
                                                                    $total_tax += $sub_tax;
                                                                @endphp

                                                                {{\App\Models\Utility::priceFormat($sub_tax).' ('.$tax['tax_name'].' '.($tax['tax']).'%)'}}
                                                            @endforeach
                                                        @endif
                                                    </div> --}}
                                                    <div class="cart-properties"></div>
                                                    <div class="discount-tag display-none">
                                                        <span class="iconfont icon-yduizhekou"></span>
                                                    </div>
                                                </div>
                                                <div class="order-price">
                                                    @php
                                                        $total_tax = 0;
                                                    @endphp

                                                    @if(!empty($product['tax']))
                                                        @foreach($product['tax'] as $tax)
                                                            @php
                                                                $sub_tax = ($product['price'] * $product['quantity'] * $tax['tax']) / 100;
                                                                $total_tax += $sub_tax;
                                                            @endphp
                                                        @endforeach
                                                    @endif

                                                    @php
                                                        $totalprice = $product['price'] * $product['quantity'] + $total_tax;
                                                        $subtotal = $product['price'] * $product['quantity'];
                                                        $sub_total += $subtotal;
                                                    @endphp

                                                    {{\App\Models\Utility::priceFormat($totalprice)}}

                                                    @php
                                                        $total += $totalprice;
                                                    @endphp
                                                </div>
                                            </div>
                                            @endif
                                        @endforeach
                                    @endif
                                </div>

                                <div class="order-item border-b">
                                    <div style="display: none;" class="get-billing-codes" data-type=""></div>
                                    <div class="order-coupon-input">
                                        <input class="np-ui-input coupon hidd_val J-GetCouponVal" id="stripe_coupon"
                                            type="text" autocomplete="off" placeholder="{{ __('Enter Coupon Code') }}">
                                        <input class="hidden_coupon" type="hidden" name="coupon" value="">
                                        <input type="text" placeholder=""
                                            style="width: 0; height: 0; opacity: 0; position: fixed; top: 0; left: 0; z-index: -1;">
                                        <button class="apply-coupon np-ui-btn np-ui-main-btn J-GetCoupon np-ui-disabled" disabled="disabled">
                                            <span class="iconfont icon-xiajiantou">
                                                <svg viewBox="0 0 20 20" class="_1fragemk _1fragem1b _1fragem4g _1fragem4f" focusable="false" aria-hidden="true"><path d="M15.215 8.743L8.818 2.347 10.586.58 20 9.993l-9.427 9.428-1.768-1.768 6.41-6.41H0v-2.5h15.215z"></path></svg>
                                            </span>
                                            <em>{{ __('Apply') }}</em>
                                        </button>
                                    </div>
                                    <div class="order-coupon-box J-CouponItem"></div>
                                </div>

                                <div class="order-item border-b">
                                    <p class="order-p">
                                        <span class="fl">Subtotal</span>
                                        <span class="fr">
                                            <i class="J-Subtotal">
                                                {{ \App\Models\Utility::priceFormat( !empty($sub_total) ? $sub_total : 0 ) }}
                                            </i>
                                        </span>
                                    </p>

                                    @if($store->enable_shipping == 'on')
                                        <p class="order-p">
                                            <span class="fl">{{ __('Shipping') }}</span>
                                            <span class="fr">
                                                <i class="shipping J-Shipping">
                                                    {{ \App\Models\Utility::priceFormat( !empty($shipping_price) ? $shipping_price : 0 ) }}
                                                </i>
                                            </span>
                                        </p>
                                    @endif

                                    @foreach($taxArr['tax'] as $k=>$tax)
                                        <p class="order-p">
                                            <span class="fl">{{$tax}}</span>
                                            <span class="fr">
                                                <i class="J-Taxes">
                                                    {{\App\Models\Utility::priceFormat($taxArr['rate'][$k])}}
                                                </i>
                                            </span>
                                        </p>
                                    @endforeach
                                </div>

                                <div class="order-item order-total">
                                    <input class="product_total" type="hidden" value="{{$total}}">
                                    <input class="total_pay_price js-product-total" type="hidden" value="{{App\Models\Utility::priceFormat($total)}}">
                                    <span>{{__('Total')}}</span>
                                    <span class="final_total_price">
                                        <i class="js-total-price-bottom J-Total" data-original="{{ \App\Models\Utility::priceFormat( !empty($total) ? $total + $shipping_price : 0 ) }}">
                                            USD
                                            <strong>
                                                {{ \App\Models\Utility::priceFormat( !empty($total) ? $total + $shipping_price : 0 ) }}
                                            </strong>
                                        </i>
                                    </span>
                                </div>
                                {{-- <div class="order-tips">
                                    <img src="https://img.cdncloud.top/uploader/997045f01077dbf412d22aef96727be1.jpg" alt="">
                                </div> --}}
                            </div>
                        </div>

                    </div>
                </div>

                <div class="popbox">
                    <div class="loadding"></div>
                </div>

            </div>
        </div>
    </main>
@endsection

@push('script-page')
    <script>
        fbq('track', 'InitiateCheckout');
        ttq.track('InitiateCheckout');
    </script>

    <script>
        $(document).ready(function () {
            var totalPrice = $('.js-total-price-bottom').attr('data-original');
            $('.js-order-total-price-top').html(`<strong>${totalPrice}</strong>`);
        });

        // Namespace
        var llabook = window.llabook || {};

        llabook.shipping = {
            update: function (id, price = 0) {
                var total = $('.js-product-total').val();

                $.ajax({
                    url: '{{ route('user.shipping', [$store->slug, '_shipping']) }}'.replace('_shipping', id),
                    method: 'POST',
                    context: this,
                    dataType: 'json',
                    data: {
                        "pro_total_price": total,
                        "_token": "{{ csrf_token() }}",
                    },
                    success: function (data) {
                        var price = data.price + total;
                        $('.js-shipping-id').val(id);
                        $('.J-Shipping').text(data.price);
                        $('.js-total-price-bottom').html(`USD <strong>${data.total_price}</strong>`);
                        $('.js-order-total-price-top').html(`<strong>${data.total_price}</strong>`);
                    }
                });
            },
        };

        window.llabook = llabook;
    </script>

    <script src="{{asset('assets/theme1/js/checkout.js')}}"></script>
@endpush
