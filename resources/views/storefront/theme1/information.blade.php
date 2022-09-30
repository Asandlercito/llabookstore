@extends('storefront.layout.theme1')

@section('page-title')
    {{ __('Information') }}
@endsection

@push('css-page')
    <link rel="stylesheet" href="{{asset('assets/theme1/css/checkout.css')}}">
@endpush

@section('content')
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
                            <span class="show-order">{{ __('Show order summary') }}</span>
                            <span class="icon-arrow iconfont icon-back">
                                <svg viewBox="0 0 14 14" class="_1fragemd _1fragemqb _1fragem48 _1fragem47" focusable="false" aria-hidden="true"><path d="M12.6 3L14 4.4 8.4 10 7 11.4 5.6 10 0 4.4 1.4 3 7 8.6"></path></svg>
                            </span>
                        </div>
                        <div class="fr">
                            <span class="order-buy-price js-order-total-price J-Total" data-price="">
                                <strong>{{\App\Models\Utility::priceFormat(!empty($total)?$total:'0')}}</strong>
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

                                    <span class="J-step0 active">{{ __('Information') }}</span>
                                    <span class="iconfont icon-back">
                                        <svg viewBox="0 0 10 10" class="_1fragemk _1fragem1b _1fragem4g _1fragem4f" focusable="false" aria-hidden="true"><path d="M2 1l1-1 4 4 1 1-1 1-4 4-1-1 4-4"></path></svg>
                                    </span>

                                    @if($store->enable_shipping == "on")
                                        <span class="J-step1">{{ __('Shipping') }}</span>
                                        <span class="iconfont icon-back">
                                            <svg viewBox="0 0 10 10" class="_1fragemk _1fragem1b _1fragem4g _1fragem4f" focusable="false" aria-hidden="true"><path d="M2 1l1-1 4 4 1 1-1 1-4 4-1-1 4-4"></path></svg>
                                        </span>
                                    @endif

                                    <span class="J-step2">{{ __('Payment') }}</span>
                                </div>
                            </div>

                            <div class="step-section">
                                <div class="step-section-content">
                                    <div class="order-step J-CustomerInfor" style="display: block;">

                                        <div class="paypal-inform-box" style="display: block;">
                                            <div class="paypal-checkout">
                                                <div class="paypal-checkout-title">Express checkout</div>
                                                <div class="J-paypal-payment paypal-payment--inform display-flex">
                                                    <div id="paypal-button">
                                                        <div class="paypal-buttons paypal-buttons-context-iframe paypal-buttons-label-paypal paypal-buttons-layout-horizontal">
                                                            <span class="payment-icon" style="display: flex !important; justify-content: center;">
                                                                <img src="{{ asset('assets/theme1/img/visa.svg') }}" alt="Visa" width="64" style="border: 1px solid #dfe3e8;border-radius: 4px;">
                                                                <img src="{{ asset('assets/theme1/img/mastercard.svg') }}" alt="Mastercard" width="64" style="border: 1px solid #dfe3e8;border-radius: 4px;">
                                                                <img src="{{ asset('assets/theme1/img/maestro.svg') }}" alt="Maestro" width="64" style="border: 1px solid #dfe3e8;border-radius: 4px;">
                                                                <img src="{{ asset('assets/theme1/img/american-express.svg') }}" alt="American Express" width="64" style="border: 1px solid #dfe3e8;border-radius: 4px;">
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="order-title">{{ __('Contact information') }}</div>

                                        <div class="information-edit">
                                            {{Form::model($cust_details,array('route' => array('checkout.processInformation',$store->slug), 'method' => 'POST')) }}
                                                <div class="order-write-list clearfloat">
                                                    <div class="order-write-item">
                                                        @if(!empty(Auth::guard('customers')->user()->email))
                                                            {{ Form::label('email', __('Email')) }}
                                                            {{ Form::email('email', Auth::guard('customers')->user()->email,array('class'=>'np-ui-input J-OrderVal', 'placeholder'=>__('Email'), 'required'=>'required', 'readonly'=>'true')) }}
                                                        @else
                                                            {{ Form::label('email', __('Email'))}}
                                                            {{ Form::email('email', old('email'), array('class'=>'np-ui-input J-OrderVal', 'placeholder'=>__('Email'), 'required'=>'required', 'maxlength'=>100, 'data-type'=>'shipping_email')) }}
                                                        @endif
                                                        <div class="np-ui-input-tips" style="display: none;"></div>
                                                        <div class="J-Offers order-checkbox">
                                                            <span class="np-ui-checkbox"></span>
                                                            <span>{{ __('Email me with news and offers') }}</span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="order-title">{{ __('Shipping address') }}</div>
                                                <div class="order-write-list clearfloat order-item-half">
                                                    <div class="order-write-item fl">
                                                        {{ Form::label('name', __('First Name')) }}
                                                        {{ Form::text('name', old('name'), array('class'=>'np-ui-input J-OrderVal', 'placeholder'=>__('First Name'), 'required'=>'required', 'maxlength'=>64, 'data-type'=>'shipping_first_name')) }}
                                                        <div class="np-ui-input-tips"></div>
                                                    </div>
                                                    <div class="order-write-item fr">
                                                        {{ Form::label('last_name', __('Last Name')) }}
                                                        {{ Form::text('last_name', old('last_name'), array('class'=>'np-ui-input J-OrderVal', 'placeholder'=>__('Last Name'), 'required'=>'required', 'maxlength'=>64, 'data-type'=>'shipping_last_name')) }}
                                                        <div class="np-ui-input-tips"></div>
                                                    </div>
                                                </div>

                                                <div class="order-write-list clearfloat">
                                                    <div class="order-write-item">
                                                        {{ Form::label('billingaddress', __('Address')) }}
                                                        {{ Form::text('billing_address', old('billing_address'), array('class'=>'np-ui-input J-OrderVal J-GoogleMapAddress', 'placeholder'=>__('Address'), 'required'=>'required', 'maxlength'=>255, 'data-type'=>'shipping_address')) }}
                                                        <div class="np-ui-input-tips"></div>
                                                        <span class="iconfont icon-dingwei phone-tips-icon J-Tips"></span>
                                                        <div class="phone-tips zipcode-tips">
                                                            <p>Enter characters to enable address suggestion</p>
                                                            <span class="iconfont icon-bofang"></span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="order-write-list clearfloat">
                                                    <div class="order-write-item">
                                                        {{ Form::label('apartment', __('Apartment, suite, etc. (optional)')) }}
                                                        {{ Form::text('apartment', old('apartment'), array('class'=>'np-ui-input J-OrderVal', 'placeholder'=>__('Apartment, suite, etc. (optional)'), 'required'=>'required', 'maxlength'=>255, 'data-type'=>'shipping_other_address')) }}
                                                        <div class="np-ui-input-tips"></div>
                                                    </div>
                                                </div>

                                                <div class="order-write-list clearfloat">
                                                    <div class="order-write-item">
                                                        {{ Form::label('billing_city', __('City')) }}
                                                        {{ Form::text('billing_city', old('billing_city'), array('class'=>'np-ui-input J-OrderVal', 'placeholder'=>__('City'), 'required'=>'required', 'maxlength'=>64, 'data-type'=>'shipping_city')) }}
                                                        <div class="np-ui-input-tips"></div>
                                                    </div>
                                                </div>

                                                <div class="order-write-list clearfloat order-item-three">
                                                    <div class="order-write-item fl order-write--show">
                                                        <label>{{ __('Country/Region') }}</label>
                                                        <select class="np-ui-select J-Country J-OrderVal"
                                                            autocomplete="shipping country" data-type="shipping_contry"
                                                            aria-required="true" id="country"
                                                            name="billing_country" required>
                                                        </select>
                                                        <span class="iconfont icon-back select-arrow">
                                                            <svg viewBox="0 0 14 14" class="_1fragemd _1fragemqb _1fragem48 _1fragem47" focusable="false" aria-hidden="true"><path d="M12.6 3L14 4.4 8.4 10 7 11.4 5.6 10 0 4.4 1.4 3 7 8.6"></path></svg>
                                                        </span>
                                                        <div class="np-ui-input-tips" style="display: none;"></div>
                                                    </div>

                                                    <div class="order-write-item fl order-write--show">
                                                        <label>{{ __('Province/State') }}</label>
                                                        {{-- <span id="state-code"><input type="text" id="state"></span> --}}
                                                        <select class="np-ui-select J-Province J-OrderVal"
                                                            data-type="billing_province" aria-required="true"
                                                            id="billing_province" name="billing_province">
                                                        </select>
                                                        <span class="iconfont icon-back select-arrow">
                                                            <svg viewBox="0 0 14 14" class="_1fragemd _1fragemqb _1fragem48 _1fragem47" focusable="false" aria-hidden="true"><path d="M12.6 3L14 4.4 8.4 10 7 11.4 5.6 10 0 4.4 1.4 3 7 8.6"></path></svg>
                                                        </span>
                                                        <div class="np-ui-input-tips"></div>
                                                    </div>

                                                    <div class="order-write-item fr">
                                                        {{ Form::label('billing_postalcode', __('Postal code')) }}
                                                        {{ Form::text('billing_postalcode', old('billing_postalcode'), array('class'=>'np-ui-input J-OrderVal J-ZipCode', 'placeholder'=>__('Postal code'), 'maxlength'=>32, 'data-type'=>'shipping_zip_code' )) }}
                                                        <div class="np-ui-input-tips"></div>
                                                    </div>
                                                </div>

                                                <div class="order-write-list order-item-phone">
                                                    <div class="order-write-item">
                                                        {{ Form::label('phone', __('Phone')) }}
                                                        {{ Form::text('phone',old('phone'),array('class'=>'np-ui-input J-OrderVal J-PhoneVal', 'placeholder'=>__('Phone'), 'required'=>'required', 'maxlength'=>32, 'data-type'=>'shipping_phone')) }}
                                                        <div class="np-ui-input-tips"></div>
                                                        <span class="iconfont icon-wenhao phone-tips-icon J-Tips"></span>
                                                        <div class="phone-tips">
                                                            <p>{{ __('En caso de que tengamos que contactarte sobre tu pedido.') }}</p>
                                                            <span class="iconfont icon-bofang"></span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="order-write-list order-button">
                                                    <div class="order-write-item">
                                                        <a class="return-cart back-prev"
                                                            href="{{ route('store.cart',$store->slug) }}">
                                                            <span class="iconfont icon-back"></span>
                                                            {{ __('Return to cart') }}
                                                        </a>
                                                    </div>
                                                    <div class="order-write-item">
                                                        <button class="np-ui-btn np-ui-main-btn J-placeCustomer J-Event-AddPaymentInfo"
                                                            type="submit">
                                                            <span class="btn-text">{{$store->enable_shipping == "on" ? __('Continue to shipping') : __('Continue to payment') }}</span>
                                                            <span class="iconfont icon-jiazai loading"></span>
                                                        </button>
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
                                            type="text" autocomplete="off" placeholder="{{ __('Discount code') }}">
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
                                        <span class="fl">{{ __('Subtotal') }}</span>
                                        <span class="fr">
                                            <i class="J-Subtotal">{{\App\Models\Utility::priceFormat(!empty($sub_total)?$sub_total:0)}}</i>
                                        </span>
                                    </p>

                                    <p class="order-p js-discount" style="display:none;">
                                        <span class="fl">{{ __('Discount') }}</span>
                                        <span class="fr">
                                            <i class="J-Discount"></i>
                                        </span>
                                    </p>

                                    @if($store->enable_shipping == "on")
                                        <p class="order-p">
                                            <span class="fl">{{ __('Shipping') }}</span>
                                            <span class="fr">
                                                <i class="shipping J-Shipping">Calculated at next step</i>
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
                                    <input class="total_pay_price" type="hidden" value="{{App\Models\Utility::priceFormat($total)}}">
                                    <span>{{ __('Total') }}</span>
                                    <span class="final_total_price">
                                        <i class="J-Total js-total-price" data-original="{{\App\Models\Utility::priceFormat(!empty($total)?$total:0)}}">
                                            USD <strong>{{\App\Models\Utility::priceFormat(!empty($total)?$total:'0')}}</strong>
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
        var pixels = '{{$store->fbpixel_code}}';
        const arrayPixels = pixels.split(',');

        console.log("los pixels ",arrayPixels);

        !function(f,b,e,v,n,t,s)
        {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
        n.callMethod.apply(n,arguments):n.queue.push(arguments)};
        if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
        n.queue=[];t=b.createElement(e);t.async=!0;
        t.src=v;s=b.getElementsByTagName(e)[0];
        s.parentNode.insertBefore(t,s)}(window, document,'script',
        'https://connect.facebook.net/en_US/fbevents.js');
        if (arrayPixels.length > 0) {
            arrayPixels.forEach(element => {
                fbq('init', element);
            });
        } else {
            fbq('init', pixels);
        }

        fbq('track', 'InitiateCheckout');
    </script>

    <script>
        ttq.track('InitiateCheckout');
    </script>

    <script src="{{asset('js/country-states.js')}}"></script>

    <script>
        // user country code for selected option
        let user_country_code = "PE";

        (function () {
            // script https://www.html-code-generator.com/html/drop-down/country-region

            // Get the country name and state name from the imported script.
            let country_list = country_and_states['country'];
            let states_list = country_and_states['states'];

            // creating country name drop-down
            let option =  '';
            option += '<option>Select country</option>';
            for(let country_code in country_list){
                // set selected option user country
                let selected = (country_code == user_country_code) ? ' selected' : '';
                option += '<option value="'+country_code+'"'+selected+'>'+country_list[country_code]+'</option>';
            }
            document.getElementById('country').innerHTML = option;

            // creating states name drop-down
            // let text_box = '<input type="text" class="input-text" id="state">';
            // let state_code_id = document.getElementById("state-code");

            function create_states_dropdown() {
                // get selected country code
                let country_code = document.getElementById("country").value || user_country_code;
                // console.info(country_code);
                let states = states_list[country_code];
                // invalid country code or no states add textbox
                // if(!states){
                //     state_code_id.innerHTML = text_box;
                //     return;
                // }
                let option = '';
                if (states.length > 0) {
                    // console.info(states);
                    // option = '<select id="state">\n';
                    option = '';
                    for (let i = 0; i < states.length; i++) {
                        option += '<option value="'+states[i].code+'">'+states[i].name+'</option>';
                    }
                    // option += '</select>';
                }
                // else {
                //     // create input textbox if no states
                //     option = text_box
                // }
                // state_code_id.innerHTML = option;
                // console.info(option);
                document.getElementById('billing_province').innerHTML = option;
            }

            // country select change event
            const country_select = document.getElementById("country");
            country_select.addEventListener('change', create_states_dropdown);

            create_states_dropdown();
        })();
    </script>

    <script>
        function billing_data() {
            $("[name='shipping_address']").val($("[name='billing_address']").val());
            $("[name='shipping_city']").val($("[name='billing_city']").val());
            $("[name='shipping_state']").val($("[name='billing_state']").val());
            $("[name='shipping_country']").val($("[name='billing_country']").val());
            $("[name='shipping_postalcode']").val($("[name='billing_postalcode']").val());
        }

        $(document).ready(function () {
            $('.change_location').trigger('change');

            setTimeout(function () {
                var shipping_id = $("input[name='shipping_id']:checked").val();
                getTotal(shipping_id);
            }, 200);

            var totalPrice = '{{ \App\Models\Utility::priceFormat( !empty($total) ? $total : '0' ) }}';
            $('.js-order-total-price').html(`<strong>${totalPrice}</strong>`);

        });

        $(document).on('change', '.shipping_mode', function () {
            var shipping_id = this.value;
            getTotal(shipping_id);
        });

        function getTotal(shipping_id) {
            var pro_total_price = $('.pro_total_price').attr('data-original');

            if (shipping_id == undefined) {
                $('.shipping_price_add').hide();
                return false
            } else {
                $('.shipping_price_add').show();
            }

            $.ajax({
                url: '{{ route('user.shipping', [$store->slug,'_shipping'])}}'.replace('_shipping', shipping_id),
                data: {
                    "pro_total_price": pro_total_price,
                    "_token": "{{ csrf_token() }}",
                },
                method: 'POST',
                context: this,
                dataType: 'json',

                success: function (data) {
                    var price = data.price + pro_total_price;
                    $('.shipping_price').html(data.price);
                    $('.shipping_price').attr('data-value', data.price);
                    $('.pro_total_price').html(data.total_price);
                }
            });
        }

        $(document).on('change', '.change_location', function () {
            var location_id = $('.change_location').val();

            if (location_id == 0) {
                $('#location_hide').hide();

            } else {
                $('#location_hide').show();

            }

            $.ajax({
                url: '{{ route('user.location', [$store->slug,'_location_id'])}}'.replace('_location_id', location_id),
                data: {
                    "_token": "{{ csrf_token() }}",
                },
                method: 'POST',
                context: this,
                dataType: 'json',

                success: function (data) {
                    var html = '';
                    var shipping_id = '{{(isset($cust_details['shipping_id']) ? $cust_details['shipping_id'] : '')}}';
                    $.each(data.shipping, function (key, value) {
                        var checked = '';
                        if (shipping_id != '' && shipping_id == value.id) {
                            checked = 'checked';
                        }

                        html += '<div class="shipping_location"><input type="radio" name="shipping_id" data-id="' + value.price + '" value="' + value.id + '" id="shipping_price' + key + '" class="shipping_mode" ' + checked + '>' +
                            ' <label name="shipping_label" for="shipping_price' + key + '" class="shipping_label"> ' + value.name + '</label></div>';

                    });
                    $('#shipping_location_content').html(html);
                }
            });
        });

        $(document).on('click', '.apply-coupon', function (e) {
            e.preventDefault();

            var ele = $(this);
            var coupon = ele.closest('.order-coupon-input').find('.coupon').val();
            var hidden_field = $('.hidden_coupon').val();
            var price = $('#card-summary .product_total').val();
            var shipping_price = $('#card-summary .shipping_price').attr('data-value');

            if (coupon == hidden_field && coupon != "") {
                show_toastr('Error', 'Coupon Already Used', 'error');
            } else {
                if (coupon != '') {

                    $.ajax({
                        url: '{{route('apply.productcoupon')}}',
                        datType: 'json',
                        data: {
                            price: price,
                            shipping_price: shipping_price,
                            store_id: {{$store->id}},
                            coupon: coupon
                        },
                        success: function (data) {
                            $('#stripe_coupon, #paypal_coupon').val(coupon);
                            if (data.is_success) {
                                $('.hidden_coupon').val(coupon);
                                $('.hidden_coupon').attr(data);

                                $('.dicount_price').html(data.discount_price);
                                $('.J-Discount').html(`${data.discount_price}`);
                                $('.js-discount').show();
                                ele.closest('.order-coupon-input').find('.coupon').val('')

                                $('.final_total_price').html(`
                                    <i class="J-Total" data-original="${data.final_price_data_value}">
                                        USD <strong>${data.final_price}</strong>
                                    </i>
                                `);

                                $('.js-order-total-price').html(`
                                    <strong>${data.final_price}</strong>
                                `);


                                // $('.coupon-tr').show().find('.coupon-price').text(data.discount_price);
                                // $('.final-price').text(data.final_price);
                                show_toastr('Success', data.message, 'success');
                            } else {
                                // $('.coupon-tr').hide().find('.coupon-price').text('');
                                // $('.final-price').text(data.final_price);
                                show_toastr('Error', data.message, 'error');
                            }
                        }
                    })
                } else {
                    $.ajax({
                        url: '{{route('apply.removecoupn')}}',
                        datType: 'json',
                        data: {
                            price: "price",
                            shipping_price: "shipping_price",
                            slug:{{$store->id}} ,
                            coupon: "coupon"
                        },
                        success: function (data) {
                        }
                    });
                    var hidd_cou = $('.hidd_val').val();

                    if(hidd_cou == ""){
                       var total_pa_val =  $(".total_pay_price").val();
                       $(".final_total_price").html(total_pa_val);
                       $(".dicount_price").html(0.00);

                    }
                    show_toastr('Error', '{{__('Invalid Coupon Code.')}}', 'error');
                }
            }

        });
    </script>

    <script src="{{asset('assets/theme1/js/checkout.js')}}"></script>
@endpush
