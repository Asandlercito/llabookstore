@extends('storefront.layout.theme1')

@section('page-title')
    {{ __('Payment') }}
@endsection

@push('css-page')
    <link rel="stylesheet" href="{{asset('assets/theme1/css/checkout.css')}}">
@endpush

@section('content')
    @php
        $coupon_price = !empty($coupon_price) ? $coupon_price : 0;
        $shipping_price = !empty($shipping_price) ? $shipping_price : 0;
        $full_price = !empty($full_price) ? $full_price : 0;
    @endphp

    <input type="hidden" id="return_url">
    <input type="hidden" id="return_order_id">

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
                            <span class="order-buy-price js-order-total-price J-Total" data-price=""><strong>$64.44</strong> </span>
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

                                    @if($store->enable_shipping == "on")
                                        <a href="{{ route('checkout.shipping',$store->slug) }}">{{ __('Shipping') }}</a>
                                        <span class="iconfont icon-back">
                                            <svg viewBox="0 0 10 10" class="_1fragemk _1fragem1b _1fragem4g _1fragem4f" focusable="false" aria-hidden="true"><path d="M2 1l1-1 4 4 1 1-1 1-4 4-1-1 4-4"></path></svg>
                                        </span>
                                    @endif

                                    <span class="J-step2 active">{{ __('Payment') }}</span>
                                </div>
                            </div>

                            <div class="step-section">

                                <div class="step-section-inform" style="display: block;">
                                    <div class="row">
                                        <div class="row-label"> Contact </div>
                                        <div class="row-inform J-Email">{{ $cust_details['email'] }}</div>
                                        <a class="row-change J-ChangeInformation" href="{{ route('checkout.information',$store->slug) }}">Change</a>
                                    </div>

                                    @if($store->enable_shipping == "on")
                                        <div class="row">
                                            <div class="row-label"> Ship to </div>
                                            <div class="row-inform J-Address">
                                                {{ $cust_details['billing_address'] . ', ' . $cust_details['billing_city'] . ' ' . $cust_details['billing_postalcode'] . ', ' . $cust_details['billing_country'] }}
                                            </div>
                                            <a class="row-change J-ChangeInformation" href="{{ route('checkout.information',$store->slug) }}"> Change </a>
                                        </div>

                                        <div class="row">
                                            <div class="row-label"> Method</div>
                                            <div class="row-inform">
                                                <span class="J-express-name">{{$shipping_name}}</span> ·
                                                <span class="J-express-fee">{{ \App\Models\Utility::priceFormat( !empty($shipping_price) ? $shipping_price : 0 ) }}</span>
                                            </div>
                                            <a class="row-change J-ChangeShipping" href="{{ route('checkout.shipping',$store->slug) }}"> Change </a>
                                        </div>
                                    @endif
                                </div>

                                <div class="step-section-content">
                                    <input type="hidden" class="J-enable_creditcard" value="1">
                                    <input type="hidden" class="J-enable_paypal" value="1">
                                    <input type="hidden" class="J-is_open_cash" value="0">

                                    <div class="order-step J-PaymentMethod" style="display: block;">
                                        {{-- <div class="order-title order-title-pb">Payment</div>
                                        <div class="order-pay-tips">All transactions are secure and encrypted.</div> --}}
                                        <div class="order-title order-title-pb">Billing address</div>
                                        <div class="order-pay-tips">Select the address that matches your card or payment
                                            method.</div>
                                        <div class="order-pay-failed J-PaymentFailed">
                                            <span class="icon iconfont icon-gantanhao"></span>
                                            <div class="test J-PaymentFailed--text">
                                            </div>
                                        </div>
                                        <div class="information-edit">
                                            <div class="order-write-list clearfloat">
                                                <div class="pay-free" style="display: none;">
                                                    <span class="iconfont icon-zerooff1"></span>
                                                    <p>Your order is free. No payment is required</p>
                                                </div>

                                                <div class="order-write-item order-payment J-PayPalBox">
                                                    <ul>
                                                        <li>
                                                            <div class="order-paypal-h3 J-paypalAdd">
                                                                <div class="fl">
                                                                    <span class="np-ui-radio np-ui-radio-active"></span>
                                                                    Same as shipping address
                                                                </div>
                                                                <div class="fr"></div>
                                                            </div>
                                                            <div class="order-paypal-h3 J-paypalAdd" style="border-bottom-left-radius: 6px;border-bottom-right-radius: 6px;">
                                                                <div class="fl"><span class="np-ui-radio"></span>
                                                                    Use a different billing address
                                                                </div>
                                                                <div class="fr"></div>
                                                            </div>
                                                            <div class="order-paypal-box billing" style="display:none">
                                                                <div class="clearfloat order-item-half">
                                                                    <div class="order-write-item fl">
                                                                        <label>First Name</label>
                                                                        <input type="text" class="np-ui-input J-BillVal"
                                                                            maxlength="64" data-type="billing_first_name"
                                                                            placeholder="First Name">
                                                                        <div class="np-ui-input-tips"></div>
                                                                    </div>
                                                                    <div class="order-write-item fr">
                                                                        <label>Last Name</label>
                                                                        <input type="text" class="np-ui-input J-BillVal"
                                                                            maxlength="64" data-type="billing_last_name"
                                                                            placeholder="Last Name">
                                                                        <div class="np-ui-input-tips"></div>
                                                                    </div>
                                                                </div>
                                                                <div class="clearfloat">
                                                                    <div class="order-write-item">
                                                                        <label>Address</label>
                                                                        <input type="text" class="np-ui-input J-BillVal"
                                                                            maxlength="255" data-type="billing_address"
                                                                            placeholder="Address">
                                                                        <div class="np-ui-input-tips"></div>
                                                                    </div>
                                                                </div>
                                                                <div class="clearfloat">
                                                                    <div class="order-write-item">
                                                                        <label>Apartment, suite, etc. (optional)</label>
                                                                        <input type="text" class="np-ui-input J-BillVal"
                                                                            maxlength="255" data-type="billing_other_address"
                                                                            placeholder="Apartment, suite, etc. (optional)">
                                                                        <div class="np-ui-input-tips"></div>
                                                                    </div>
                                                                </div>
                                                                <div class="clearfloat">
                                                                    <div class="order-write-item">
                                                                        <label>City</label>
                                                                        <input type="text" class="np-ui-input J-BillVal"
                                                                            maxlength="64" data-type="billing_city"
                                                                            placeholder="City" name="city" value="">
                                                                        <div class="np-ui-input-tips"></div>
                                                                    </div>
                                                                </div>
                                                                <div class="clearfloat order-item-three">
                                                                    <div class="order-write-item fl order-write--show">
                                                                        <label>Country/Region</label>
                                                                        <select class="np-ui-select J-Country J-BillVal"
                                                                            data-type="billing_contry">
                                                                            <option value="US" data-id="140"
                                                                                data-countries="United States">United States
                                                                            </option>
                                                                            <option value="CA" data-id="99"
                                                                                data-countries="Canada">Canada</option>
                                                                            <option value="AU" data-id="25"
                                                                                data-countries="Australia">Australia</option>
                                                                            <option value="GB" data-id="237"
                                                                                data-countries="United Kingdom">United Kingdom
                                                                            </option>
                                                                            <option disabled="disabled">
                                                                                ----------------------------</option>
                                                                            <option value="AF" data-id="10"
                                                                                data-countries="Afghanistan">Afghanistan
                                                                            </option>
                                                                            <option value="AX" data-id="27"
                                                                                data-countries="Aland lslands">Aland lslands
                                                                            </option>
                                                                            <option value="AL" data-id="8"
                                                                                data-countries="Albania">Albania</option>
                                                                            <option value="DZ" data-id="9"
                                                                                data-countries="Algeria">Algeria</option>
                                                                            <option value="AD" data-id="21"
                                                                                data-countries="Andorra">Andorra</option>
                                                                            <option value="AO" data-id="22"
                                                                                data-countries="Angola">Angola</option>
                                                                            <option value="AI" data-id="23"
                                                                                data-countries="Anguilla">Anguilla</option>
                                                                            <option value="AG" data-id="24"
                                                                                data-countries="Antigua and Barbuda">Antigua and
                                                                                Barbuda</option>
                                                                            <option value="AR" data-id="11"
                                                                                data-countries="Argentina">Argentina</option>
                                                                            <option value="AW" data-id="13"
                                                                                data-countries="Aruba">Aruba</option>
                                                                            <option value="AU" data-id="25"
                                                                                data-countries="Australia">Australia</option>
                                                                            <option value="AT" data-id="26"
                                                                                data-countries="Austria">Austria</option>
                                                                            <option value="AZ" data-id="15"
                                                                                data-countries="Azerbaijan">Azerbaijan</option>
                                                                            <option value="BS" data-id="30"
                                                                                data-countries="Bahamas">Bahamas</option>
                                                                            <option value="BH" data-id="34"
                                                                                data-countries="Bahrain">Bahrain</option>
                                                                            <option value="BB" data-id="28"
                                                                                data-countries="Barbados">Barbados</option>
                                                                            <option value="BY" data-id="37"
                                                                                data-countries="Belarus">Belarus</option>
                                                                            <option value="BE" data-id="42"
                                                                                data-countries="Belgium">Belgium</option>
                                                                            <option value="BZ" data-id="49"
                                                                                data-countries="Belize">Belize</option>
                                                                            <option value="BJ" data-id="41"
                                                                                data-countries="Benin">Benin</option>
                                                                            <option value="BM" data-id="38"
                                                                                data-countries="Bermuda">Bermuda</option>
                                                                            <option value="BT" data-id="50"
                                                                                data-countries="Bhutan">Bhutan</option>
                                                                            <option value="BO" data-id="46"
                                                                                data-countries="Bolivia">Bolivia</option>
                                                                            <option value="BA" data-id="47"
                                                                                data-countries="Bosnia and Herzegovina">Bosnia
                                                                                and
                                                                                Herzegovina</option>
                                                                            <option value="BW" data-id="48"
                                                                                data-countries="Botswana">Botswana</option>
                                                                            <option value="IO" data-id="238"
                                                                                data-countries="British Indian Ocean Territory">
                                                                                British Indian Ocean Territory</option>
                                                                            <option value="BG" data-id="39"
                                                                                data-countries="Bulgaria">Bulgaria</option>
                                                                            <option value="BI" data-id="52"
                                                                                data-countries="Burundi">Burundi</option>
                                                                            <option value="KH" data-id="102"
                                                                                data-countries="Cambodia">Cambodia</option>
                                                                            <option value="CA" data-id="99"
                                                                                data-countries="Canada">Canada</option>
                                                                            <option value="CV" data-id="73"
                                                                                data-countries="Cape Verde">Cape Verde</option>
                                                                            <option value="KY" data-id="107"
                                                                                data-countries="Cayman Islands">Cayman Islands
                                                                            </option>
                                                                            <option value="CF" data-id="246"
                                                                                data-countries="Central African Republic">
                                                                                Central
                                                                                African Republic</option>
                                                                            <option value="TD" data-id="243"
                                                                                data-countries="Chad">Chad</option>
                                                                            <option value="CL" data-id="245"
                                                                                data-countries="Chile">Chile</option>
                                                                            <option value="CX" data-id="181"
                                                                                data-countries="Christmas Island">Christmas
                                                                                Island
                                                                            </option>
                                                                            <option value="CO" data-id="78"
                                                                                data-countries="Colombia">Colombia</option>
                                                                            <option value="KM" data-id="109"
                                                                                data-countries="Comoros">Comoros</option>
                                                                            <option value="CG" data-id="76"
                                                                                data-countries="Congo">Congo</option>
                                                                            <option value="CD" data-id="77"
                                                                                data-countries="Congo(DRC)">Congo(DRC)</option>
                                                                            <option value="CK" data-id="114"
                                                                                data-countries="Cook Islands">Cook Islands
                                                                            </option>
                                                                            <option value="HR" data-id="112"
                                                                                data-countries="Croatia">Croatia</option>
                                                                            <option value="CY" data-id="178"
                                                                                data-countries="Cyprus">Cyprus</option>
                                                                            <option value="DK" data-id="55"
                                                                                data-countries="Denmark">Denmark</option>
                                                                            <option value="DJ" data-id="95"
                                                                                data-countries="Djibouti">Djibouti</option>
                                                                            <option value="DO" data-id="59"
                                                                                data-countries="Dominica">Dominica</option>
                                                                            <option value="DO" data-id="60"
                                                                                data-countries="Dominican Republic">Dominican
                                                                                Republic
                                                                            </option>
                                                                            <option value="EC" data-id="62"
                                                                                data-countries="Ecuador">Ecuador</option>
                                                                            <option value="EG" data-id="17"
                                                                                data-countries="Egypt">Egypt</option>
                                                                            <option value="ER" data-id="63"
                                                                                data-countries="Eritrea">Eritrea</option>
                                                                            <option value="EE" data-id="20"
                                                                                data-countries="Estonia">Estonia</option>
                                                                            <option value="ET" data-id="18"
                                                                                data-countries="Ethiopia">Ethiopia</option>
                                                                            <option value="FK" data-id="74"
                                                                                data-countries="Falkland Islands">Falkland
                                                                                Islands
                                                                            </option>
                                                                            <option value="FO" data-id="65"
                                                                                data-countries="Faroe Islands">Faroe Islands
                                                                            </option>
                                                                            <option value="FJ" data-id="71"
                                                                                data-countries="Fiji Islands">Fiji Islands
                                                                            </option>
                                                                            <option value="FI" data-id="72"
                                                                                data-countries="Finland">Finland</option>
                                                                            <option value="FR" data-id="64"
                                                                                data-countries="France">France</option>
                                                                            <option value="GF" data-id="67"
                                                                                data-countries="French Guiana">French Guiana
                                                                            </option>
                                                                            <option value="GM" data-id="75"
                                                                                data-countries="Gambia">Gambia</option>
                                                                            <option value="GE" data-id="15501"
                                                                                data-countries="Georgia">Georgia</option>
                                                                            <option value="DE" data-id="56"
                                                                                data-countries="Germany">Germany</option>
                                                                            <option value="GH" data-id="100"
                                                                                data-countries="Ghana">Ghana</option>
                                                                            <option value="GI" data-id="244"
                                                                                data-countries="Gibraltar">Gibraltar</option>
                                                                            <option value="GL" data-id="82"
                                                                                data-countries="Greenland">Greenland</option>
                                                                            <option value="GD" data-id="81"
                                                                                data-countries="Grenada">Grenada</option>
                                                                            <option value="GP" data-id="84"
                                                                                data-countries="Guadeloupe">Guadeloupe</option>
                                                                            <option value="GN" data-id="97"
                                                                                data-countries="Guinea">Guinea</option>
                                                                            <option value="GW" data-id="98"
                                                                                data-countries="Guinea-Bissau">Guinea-Bissau
                                                                            </option>
                                                                            <option value="GY" data-id="86"
                                                                                data-countries="Guyana">Guyana</option>
                                                                            <option value="HT" data-id="88"
                                                                                data-countries="Haiti">Haiti</option>
                                                                            <option value="HN" data-id="93"
                                                                                data-countries="Honduras">Honduras</option>
                                                                            <option value="IS" data-id="43"
                                                                                data-countries="Iceland">Iceland</option>
                                                                            <option value="IN" data-id="235"
                                                                                data-countries="India">India</option>
                                                                            <option value="ID" data-id="236"
                                                                                data-countries="Indonesia">Indonesia</option>
                                                                            <option value="IR" data-id="232"
                                                                                data-countries="Iran">Iran</option>
                                                                            <option value="IE" data-id="19"
                                                                                data-countries="Ireland">Ireland</option>
                                                                            <option value="IM" data-id="137"
                                                                                data-countries="Isle of Man">Isle of Man
                                                                            </option>
                                                                            <option value="IL" data-id="233"
                                                                                data-countries="Israel">Israel</option>
                                                                            <option value="IT" data-id="234"
                                                                                data-countries="Italy">Italy</option>
                                                                            <option value="JP" data-id="170"
                                                                                data-countries="Japan">Japan</option>
                                                                            <option value="JO" data-id="239"
                                                                                data-countries="Jordan">Jordan</option>
                                                                            <option value="KZ" data-id="87"
                                                                                data-countries="Kazakhstan">Kazakhstan</option>
                                                                            <option value="KE" data-id="113"
                                                                                data-countries="Kenya">Kenya</option>
                                                                            <option value="KI" data-id="94"
                                                                                data-countries="Kiribati">Kiribati</option>
                                                                            <option value="KW" data-id="111"
                                                                                data-countries="Kuwait">Kuwait</option>
                                                                            <option value="KG" data-id="96"
                                                                                data-countries="Kyrgyzstan">Kyrgyzstan</option>
                                                                            <option value="LV" data-id="115"
                                                                                data-countries="Latvia">Latvia</option>
                                                                            <option value="LB" data-id="118"
                                                                                data-countries="Lebanon">Lebanon</option>
                                                                            <option value="LR" data-id="119"
                                                                                data-countries="Liberia">Liberia</option>
                                                                            <option value="LY" data-id="120"
                                                                                data-countries="Libya">Libya</option>
                                                                            <option value="LI" data-id="122"
                                                                                data-countries="Liechtenstein">Liechtenstein
                                                                            </option>
                                                                            <option value="LT" data-id="121"
                                                                                data-countries="Lithuania">Lithuania</option>
                                                                            <option value="LU" data-id="124"
                                                                                data-countries="Luxembourg">Luxembourg</option>
                                                                            <option value="MO" data-id="15500"
                                                                                data-countries="Macao SAR">Macao SAR</option>
                                                                            <option value="MK" data-id="133"
                                                                                data-countries="Macedonia,Former Yugoslav Republic of">
                                                                                Macedonia,Former Yugoslav
                                                                                Republic of</option>
                                                                            <option value="MG" data-id="127"
                                                                                data-countries="Madagascar">Madagascar</option>
                                                                            <option value="MW" data-id="130"
                                                                                data-countries="Malawi">Malawi</option>
                                                                            <option value="MY" data-id="131"
                                                                                data-countries="Malaysia">Malaysia</option>
                                                                            <option value="MV" data-id="128"
                                                                                data-countries="Maldives">Maldives</option>
                                                                            <option value="ML" data-id="132"
                                                                                data-countries="Mali">Mali</option>
                                                                            <option value="MT" data-id="129"
                                                                                data-countries="Malta">Malta</option>
                                                                            <option value="MQ" data-id="135"
                                                                                data-countries="Martinique">Martinique</option>
                                                                            <option value="MR" data-id="139"
                                                                                data-countries="Mauritania">Mauritania</option>
                                                                            <option value="MU" data-id="138"
                                                                                data-countries="Mauritius">Mauritius</option>
                                                                            <option value="MX" data-id="153"
                                                                                data-countries="Mexico">Mexico</option>
                                                                            <option value="MD" data-id="149"
                                                                                data-countries="Moldova">Moldova</option>
                                                                            <option value="MC" data-id="151"
                                                                                data-countries="Monaco">Monaco</option>
                                                                            <option value="ME" data-id="15497"
                                                                                data-countries="Montenegro">Montenegro</option>
                                                                            <option value="MS" data-id="144"
                                                                                data-countries="Montserrat">Montserrat</option>
                                                                            <option value="MA" data-id="150"
                                                                                data-countries="Morocco">Morocco</option>
                                                                            <option value="MZ" data-id="152"
                                                                                data-countries="Mozambique">Mozambique</option>
                                                                            <option value="MM" data-id="148"
                                                                                data-countries="Myanmar">Myanmar</option>
                                                                            <option value="NA" data-id="154"
                                                                                data-countries="Namibia">Namibia</option>
                                                                            <option value="NR" data-id="158"
                                                                                data-countries="Nauru">Nauru</option>
                                                                            <option value="NP" data-id="159"
                                                                                data-countries="Nepal">Nepal</option>
                                                                            <option value="NL" data-id="90"
                                                                                data-countries="Netherlands">Netherlands
                                                                            </option>
                                                                            <option value="NZ" data-id="225"
                                                                                data-countries="New Zealand">New Zealand
                                                                            </option>
                                                                            <option value="NI" data-id="160"
                                                                                data-countries="Nicaragua">Nicaragua</option>
                                                                            <option value="NE" data-id="161"
                                                                                data-countries="Niger">Niger</option>
                                                                            <option value="NG" data-id="162"
                                                                                data-countries="Nigeria">Nigeria</option>
                                                                            <option value="NO" data-id="164"
                                                                                data-countries="Norway">Norway</option>
                                                                            <option value="OM" data-id="14"
                                                                                data-countries="Oman">Oman</option>
                                                                            <option value="PK" data-id="31"
                                                                                data-countries="Pakistan">Pakistan</option>
                                                                            <option value="PS" data-id="33"
                                                                                data-countries="Palestinian Authority">
                                                                                Palestinian
                                                                                Authority</option>
                                                                            <option value="PA" data-id="35"
                                                                                data-countries="Panama">Panama</option>
                                                                            <option value="PG" data-id="29"
                                                                                data-countries="Papua New Guinea">Papua New
                                                                                Guinea
                                                                            </option>
                                                                            <option value="PY" data-id="32"
                                                                                data-countries="Paraguay">Paraguay</option>
                                                                            <option value="PE" data-id="147"
                                                                                data-countries="Peru">Peru</option>
                                                                            <option value="PH" data-id="70"
                                                                                data-countries="Philippines">Philippines
                                                                            </option>
                                                                            <option value="PN" data-id="167"
                                                                                data-countries="Pitcairn Islands">Pitcairn
                                                                                Islands
                                                                            </option>
                                                                            <option value="PL" data-id="45"
                                                                                data-countries="Poland">Poland</option>
                                                                            <option value="PT" data-id="168"
                                                                                data-countries="Portugal">Portugal</option>
                                                                            <option value="QA" data-id="106"
                                                                                data-countries="Qatar">Qatar</option>
                                                                            <option value="RE" data-id="123"
                                                                                data-countries="Reunion">Reunion</option>
                                                                            <option value="RO" data-id="126"
                                                                                data-countries="Romania">Romania</option>
                                                                            <option value="RU" data-id="61"
                                                                                data-countries="Russia">Russia</option>
                                                                            <option value="RW" data-id="125"
                                                                                data-countries="Rwanda">Rwanda</option>
                                                                            <option value="WS" data-id="174"
                                                                                data-countries="Samoa">Samoa</option>
                                                                            <option value="ST" data-id="182"
                                                                                data-countries="Sao Tome and Principe">Sao Tome
                                                                                and
                                                                                Principe</option>
                                                                            <option value="SA" data-id="180"
                                                                                data-countries="Saudi Arabia">Saudi Arabia
                                                                            </option>
                                                                            <option value="SN" data-id="177"
                                                                                data-countries="Senegal">Senegal</option>
                                                                            <option value="RS" data-id="175"
                                                                                data-countries="Serbia">Serbia</option>
                                                                            <option value="SC" data-id="179"
                                                                                data-countries="Seychelles">Seychelles</option>
                                                                            <option value="SL" data-id="176"
                                                                                data-countries="Sierra Leone">Sierra Leone
                                                                            </option>
                                                                            <option value="SK" data-id="190"
                                                                                data-countries="Slovakia">Slovakia</option>
                                                                            <option value="SI" data-id="191"
                                                                                data-countries="Slovenia">Slovenia</option>
                                                                            <option value="SB" data-id="196"
                                                                                data-countries="Solomon Islands">Solomon Islands
                                                                            </option>
                                                                            <option value="SO" data-id="197"
                                                                                data-countries="Somalia">Somalia</option>
                                                                            <option value="ZA" data-id="155"
                                                                                data-countries="South Africa">South Africa
                                                                            </option>
                                                                            <option value="ES" data-id="221"
                                                                                data-countries="Spain">Spain</option>
                                                                            <option value="SE" data-id="171"
                                                                                data-countries="Sweden">Sweden</option>
                                                                            <option value="CH" data-id="172"
                                                                                data-countries="Switzerland">Switzerland
                                                                            </option>
                                                                            <option value="SY" data-id="227"
                                                                                data-countries="Syria">Syria</option>
                                                                            <option value="TJ" data-id="198"
                                                                                data-countries="Tajikistan">Tajikistan</option>
                                                                            <option value="TZ" data-id="200"
                                                                                data-countries="Tanzania">Tanzania</option>
                                                                            <option value="TL" data-id="57"
                                                                                data-countries="Timor-Leste">Timor-Leste
                                                                            </option>
                                                                            <option value="TG" data-id="58"
                                                                                data-countries="Togo">Togo</option>
                                                                            <option value="TN" data-id="205"
                                                                                data-countries="Tunisia">Tunisia</option>
                                                                            <option value="TM" data-id="208"
                                                                                data-countries="Turkmenistan">Turkmenistan
                                                                            </option>
                                                                            <option value="TV" data-id="206"
                                                                                data-countries="Tuvalu">Tuvalu</option>
                                                                            <option value="UG" data-id="217"
                                                                                data-countries="Uganda">Uganda</option>
                                                                            <option value="AE" data-id="12"
                                                                                data-countries="United Arab Emirates">United
                                                                                Arab
                                                                                Emirates</option>
                                                                            <option value="GB" data-id="237"
                                                                                data-countries="United Kingdom">United Kingdom
                                                                            </option>
                                                                            <option value="US" data-id="140"
                                                                                data-countries="United States">United States
                                                                            </option>
                                                                            <option value="VA" data-id="69"
                                                                                data-countries="Vatican City">Vatican City
                                                                            </option>
                                                                            <option value="VN" data-id="240"
                                                                                data-countries="Vietnam">Vietnam</option>
                                                                            <option value="YE" data-id="230"
                                                                                data-countries="Yemen">Yemen</option>
                                                                            <option value="ZM" data-id="241"
                                                                                data-countries="Zambia">Zambia</option>
                                                                            <option value="ZW" data-id="104"
                                                                                data-countries="Zimbabwe">Zimbabwe</option>
                                                                        </select>
                                                                        <span class="iconfont icon-back select-arrow">
                                                                            <svg viewBox="0 0 14 14" class="_1fragemd _1fragemqb _1fragem48 _1fragem47" focusable="false" aria-hidden="true"><path d="M12.6 3L14 4.4 8.4 10 7 11.4 5.6 10 0 4.4 1.4 3 7 8.6"></path></svg>
                                                                        </span>
                                                                        <div class="np-ui-input-tips"></div>
                                                                    </div>
                                                                    <div class="order-write-item fl order-write--show">
                                                                        <label>Province/State</label>
                                                                        <select class="np-ui-select J-Province J-BillVal"
                                                                            data-type="billing_province">
                                                                            <option value="-1000" disabled="disabled">
                                                                                Province/State </option>
                                                                            <option value="PE-AMA" data-province="Amazonas">
                                                                                Amazonas</option>
                                                                            <option value="PE-ANC" data-province="Áncash">Áncash
                                                                            </option>
                                                                            <option value="PE-APU" data-province="Apurímac">
                                                                                Apurímac</option>
                                                                            <option value="PE-ARE" data-province="Arequipa">
                                                                                Arequipa</option>
                                                                            <option value="PE-AYA" data-province="Ayacucho">
                                                                                Ayacucho</option>
                                                                            <option value="PE-CAJ" data-province="Cajamarca">
                                                                                Cajamarca</option>
                                                                            <option value="PE-CAL" data-province="Callao">Callao
                                                                            </option>
                                                                            <option value="PE-CUS" data-province="Cuzco">Cuzco
                                                                            </option>
                                                                            <option value="PE-HUV" data-province="Huancavelica">
                                                                                Huancavelica</option>
                                                                            <option value="PE-HUC" data-province="Huánuco">
                                                                                Huánuco</option>
                                                                            <option value="PE-ICA" data-province="Ica">Ica
                                                                            </option>
                                                                            <option value="PE-JUN" data-province="Junín">Junín
                                                                            </option>
                                                                            <option value="PE-LAL" data-province="La Libertad">
                                                                                La Libertad</option>
                                                                            <option value="PE-LAM" data-province="Lambayeque">
                                                                                Lambayeque</option>
                                                                            <option value="PE-LIM"
                                                                                data-province="Lima (departamento)">Lima
                                                                                (departamento)
                                                                            </option>
                                                                            <option value="PE-LMA" selected=""
                                                                                data-province="Lima (provincia)">Lima
                                                                                (provincia)
                                                                            </option>
                                                                            <option value="PE-LOR" data-province="Loreto">Loreto
                                                                            </option>
                                                                            <option value="PE-MDD"
                                                                                data-province="Madre de Dios">Madre de Dios
                                                                            </option>
                                                                            <option value="PE-MOQ" data-province="Moquegua">
                                                                                Moquegua</option>
                                                                            <option value="PE-PAS" data-province="Pasco">Pasco
                                                                            </option>
                                                                            <option value="PE-PIU" data-province="Piura">Piura
                                                                            </option>
                                                                            <option value="PE-PUN" data-province="Puno">Puno
                                                                            </option>
                                                                            <option value="PE-SAM" data-province="San Martín">
                                                                                San Martín</option>
                                                                            <option value="PE-TAC" data-province="Tacna">Tacna
                                                                            </option>
                                                                            <option value="PE-TUM" data-province="Tumbes">Tumbes
                                                                            </option>
                                                                            <option value="PE-UCA" data-province="Ucayali">
                                                                                Ucayali</option>
                                                                        </select>
                                                                        <span class="iconfont icon-back select-arrow">
                                                                            <svg viewBox="0 0 14 14" class="_1fragemd _1fragemqb _1fragem48 _1fragem47" focusable="false" aria-hidden="true"><path d="M12.6 3L14 4.4 8.4 10 7 11.4 5.6 10 0 4.4 1.4 3 7 8.6"></path></svg>
                                                                        </span>
                                                                        <div class="np-ui-input-tips"></div>
                                                                    </div>
                                                                    <div class="order-write-item fr">
                                                                        <label>Zip Code</label>
                                                                        <input type="text" class="np-ui-input J-BillVal"
                                                                            maxlength="32" data-type="billing_zip_code"
                                                                            placeholder="Zip Code">
                                                                        <div class="np-ui-input-tips"></div>
                                                                    </div>
                                                                </div>
                                                                <div class="order-item-phone">
                                                                    <div class="order-write-item">
                                                                        <label>Phone</label>
                                                                        <input type="text" class="np-ui-input J-BillVal"
                                                                            data-type="billing_phone" maxlength="32"
                                                                            placeholder="Phone">
                                                                        <div class="np-ui-input-tips"></div>
                                                                        <span
                                                                            class="iconfont icon-wenhao phone-tips-icon J-Tips"></span>
                                                                        <div class="phone-tips">
                                                                            <p>In case we need to contact you for delivery</p>
                                                                            <span class="iconfont icon-bofang"></span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>

                                                {{-- <div class="order-title order-title-pb J-PayPalBox">Billing address</div>
                                                <div class="order-pay-tips">Select the address that matches your card or payment
                                                    method.</div> --}}
                                                <div class="order-title order-title-pb J-PayPalBox">Payment</div>
                                                <div class="order-pay-tips">All transactions are secure and encrypted.</div>

                                                <div class="order-write-item order-payment order-payment-box">
                                                    <ul>
                                                        <li>
                                                            <div class="order-paypal-h3 J-SwitchPal" data-cardtype="3"
                                                                data-type="card" data-payment="Credit Card">
                                                                <div class="fl">
                                                                    <span class="np-ui-radio np-ui-radio-active"></span>
                                                                    <strong>Credit / Debit Card</strong>
                                                                </div>
                                                                <div class="fr">
                                                                    <span class="payment-icon">
                                                                        <img src="https://static-theme.cdncloud.top/liquid/buyer/public/img/payment/visa1.svg"
                                                                            alt="Payment"><img
                                                                            src="https://static-theme.cdncloud.top/liquid/buyer/public/img/payment/mastercard.svg"
                                                                            alt="Payment"><img
                                                                            src="https://static-theme.cdncloud.top/liquid/buyer/public/img/payment/maestro.svg"
                                                                            alt="Payment"><img
                                                                            src="https://static-theme.cdncloud.top/liquid/buyer/public/img/payment/AmericanExpress.svg"
                                                                            alt="Payment">
                                                                    </span>

                                                                </div>
                                                            </div>
                                                            <div class="order-paypal-box credit-built-in"
                                                                style="display: block;border-bottom-left-radius: 6px;border-bottom: 0;border-bottom-right-radius: 6px;">
                                                                <div class="form-wrap">
                                                                    <form id="payment-form">
                                                                        <div id="card-element" class="ab-element">

                                                                            <?php
                                                                            if (empty($_POST)) {
                                                                                //dd($_POST);
                                                                                $host= $_SERVER["HTTP_HOST"];
                                                                                $url= $_SERVER["REQUEST_URI"];
                                                                                //dd("host and url ",$host,"url",$url);
                                                                                //dd("host and url ",$host,"url",$url);
                                                                                $username='80247828';
                                                                                //$password='prodpassword_36WvLliGty7TfiuPrMRjnYtQcPbUPFqxbSOlZpK6gg0t5';
                                                                                $password='testpassword_byCzuU7Ev0ztduSjt4jXdJ8bEZCWeZrR9rKdT0sKUwQnC';
                                                                                $num=($full_price+$shipping_price-$coupon_price)*100;
                                                                                //$num=(4.9)*100;
                                                                                $data = ["amount" =>strval($num),"currency" => "USD","orderId"=> time(), "customer" => ["email" => $cust_details['email']]];
                                                                                $data_string = json_encode($data);
                                                                                //dd("acaaa else",$data_string);
                                                                                $ch = curl_init('https://api.micuentaweb.pe/api-payment/V4/Charge/CreatePayment');
                                                                                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
                                                                                curl_setopt($ch, CURLOPT_POSTFIELDS,$data_string);
                                                                                curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
                                                                                curl_setopt($ch, CURLOPT_USERPWD, "$username:$password");
                                                                                curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                                                                                    'Content-Type: application/json',
                                                                                    'Content-Length: ' . strlen($data_string))
                                                                                );
                                                                                $json_response = curl_exec($ch);

                                                                                $resultv = json_decode($json_response, true);

                                                                                $cjtkn = $resultv['answer']['formToken'];
                                                                                ?>

                                                                                   <script
                                                                                        src="https://static.micuentaweb.pe/static/js/krypton-client/V4.0/stable/kr-payment-form.min.js"
                                                                                        kr-public-key="80247828:testpublickey_JlLuP9Fm5f8ZRpc9N3J2hXREc1iK0JGILUbJotir7KSvZ"
                                                                                        kr-language="en-USA"
                                                                                        kr-post-url-success='<?php echo "https://".$host.$url."";?>'>
                                                                                   </script>

                                                                                    <!-- theme and plugins. should be loaded after the javascript library -->
                                                                                    <!-- not mandatory but helps to have a nice payment form out of the box -->

                                                                                    <link rel="stylesheet" href="https://static.micuentaweb.pe/static/js/krypton-client/V4.0/ext/classic-reset.css">
                                                                                    <script src="https://static.micuentaweb.pe/static/js/krypton-client/V4.0/ext/classic.js"></script>
                                                                                    <style type="text/css">
                                                                                        /* .kr-expiry {
                                                                                            max-width: 130px !important;
                                                                                            display: inline-block !important;
                                                                                        } */

                                                                                        /* .kr-security-code {
                                                                                            max-width: 130px !important;
                                                                                            display: inline-block !important;

                                                                                        } */
                                                                                        .kr-popin-button {
                                                                                            background-color: #46a024 !important;
                                                                                            color:#fff !important;
                                                                                        }

                                                                                        .kr-embedded .kr-payment-button {
                                                                                            background-color: #46a024 !important;
                                                                                            color:#fff !important;
                                                                                            border-radius: 5px;
                                                                                            width: 100% !important;
                                                                                        }

                                                                                        .kr-installment-number{
                                                                                            display:none !important;
                                                                                        }

                                                                                        .kr-first-installment-delay{
                                                                                            display:none !important;
                                                                                        }
                                                                                    </style>

                                                                                    <!-- payment form -->
                                                                                    <div class="kr-embedded" kr-form-token="<?php echo $cjtkn;?>">
                                                                                        <!-- payment form fields -->
                                                                                        <div class="kr-pan"></div>
                                                                                        <div class="kr-expiry"></div>
                                                                                        <div class="kr-card-holder-name"></div>
                                                                                        <div class="kr-security-code"></div>
                                                                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                                                        <input type="hidden" name="_method" value="PUT">

                                                                                        <!-- payment form submit button -->
                                                                                        <button class="kr-payment-button"></button>

                                                                                        <!-- error zone -->
                                                                                        <div class="kr-form-error"></div>
                                                                                    </div>

                                                                                <?php
                                                                            } else {
                                                                                //dd("acaaa else");
                                                                                $cjans = $_POST['kr-answer'];
                                                                                $cjdata = json_decode($cjans);
                                                                                ///dd("CJDATAAA",$cjdata->orderStatus);
                                                                                if ($cjdata->orderStatus == "PAID") {
                                                                                    if (!empty(Auth::guard('customers')->user()->email)) {
                                                                                        //dd(" bbbbbbbbbbbbbbbbbbbbbbbb");
                                                                                        echo "<script>$(document).ready(function () { cjsavdatau(); });</script>";
                                                                                    } else {
                                                                                        //dd(" AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA");
                                                                                        echo "<script>$(document).ready(function () { cjsavdatai(); });</script>";
                                                                                    }
                                                                                } else {
                                                                                    echo "<script> Swal.fire({ icon: 'error', confirmButtonColor: '#0f5ef8', title: '{{ __('There was an error, please try again') }}' }); </script>";
                                                                                    $host = $_SERVER["HTTP_HOST"];
                                                                                    $url = $_SERVER["REQUEST_URI"];
                                                                                    $username = '80247828';
                                                                                    //desarrollo $username='80247828';
                                                                                    $password = 'prodpassword_36WvLliGty7TfiuPrMRjnYtQcPbUPFqxbSOlZpK6gg0t5';
                                                                                    //desarrollo $password= 'testpassword_byCzuU7Ev0ztduSjt4jXdJ8bEZCWeZrR9rKdT0sKUwQnC';
                                                                                    $num = ($full_price + $shipping_price - $coupon_price) * 100;
                                                                                    $data = [
                                                                                        "amount" => strval($num),
                                                                                        "currency" => "USD",
                                                                                        "orderId" => time(),
                                                                                        "customer" => [
                                                                                            "email" => $cust_details['email']
                                                                                        ]
                                                                                    ];
                                                                                    $data_string = json_encode($data);

                                                                                    $ch = curl_init('https://api.micuentaweb.pe/api-payment/V4/Charge/CreatePayment');
                                                                                    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
                                                                                    curl_setopt($ch, CURLOPT_POSTFIELDS,$data_string);
                                                                                    curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
                                                                                    curl_setopt($ch, CURLOPT_USERPWD, "$username:$password");
                                                                                    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                                                                                        'Content-Type: application/json',
                                                                                        'Content-Length: ' . strlen($data_string))
                                                                                    );
                                                                                    $json_response = curl_exec($ch);

                                                                                    $resultv = json_decode($json_response, true);
                                                                                    $cjtkn = $resultv['answer']['formToken'];
                                                                                    ?>

                                                                                        <script src="https://static.micuentaweb.pe/static/js/krypton-client/V4.0/stable/kr-payment-form.min.js"
                                                                                            kr-public-key="80247828:publickey_1QGTVNmroGkkRbUKyrZuR4Zi6EhfMYRXhbspkMTTmSWIf"
                                                                                            kr-language="es-PE"
                                                                                            kr-post-url-success='<?php echo "https://".$host.$url."";?>'>
                                                                                        </script>

                                                                                        <!-- theme and plugins. should be loaded after the javascript library -->
                                                                                        <!-- not mandatory but helps to have a nice payment form out of the box -->

                                                                                        <link rel="stylesheet" href="https://static.micuentaweb.pe/static/js/krypton-client/V4.0/ext/classic-reset.css">
                                                                                        <script src="https://static.micuentaweb.pe/static/js/krypton-client/V4.0/ext/classic.js"></script>
                                                                                        <style type="text/css">
                                                                                            .kr-expiry {
                                                                                                max-width: 131px !important;
                                                                                                display: inline-block !important;
                                                                                            }

                                                                                            .kr-security-code {
                                                                                                max-width: 131px !important;
                                                                                                display: inline-block !important;
                                                                                            }

                                                                                            .kr-popin-button {
                                                                                                background-color: #46a024 !important;
                                                                                                color:#fff !important;
                                                                                            }

                                                                                            .kr-embedded .kr-payment-button {
                                                                                                background-color: #46a024 !important;
                                                                                                color:#fff !important;
                                                                                                border-radius: 5px;
                                                                                                width: 100% !important;
                                                                                            }

                                                                                            .kr-installment-number {
                                                                                                display:none !important;
                                                                                            }

                                                                                            .kr-first-installment-delay {
                                                                                                display:none !important;
                                                                                            }
                                                                                        </style>

                                                                                        <!-- payment form -->
                                                                                        <div class="kr-embedded" kr-form-token="<?php echo $cjtkn;?>">
                                                                                            <!-- payment form fields -->
                                                                                            <div class="kr-pan"></div>
                                                                                            <div class="kr-expiry"></div>
                                                                                            <div class="kr-security-code"></div>
                                                                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                                                            <input type="hidden" name="_method" value="PUT">

                                                                                            <!-- payment form submit button -->
                                                                                            <button class="kr-payment-button"></button>

                                                                                            <!-- error zone -->
                                                                                            <div class="kr-form-error"></div>
                                                                                        </div>
                                                                                    <?php
                                                                                }
                                                                            }
                                                                            ?>

                                                                        </div>
                                                                        <div id="card-errors" role="alert"></div>
                                                                    </form>
                                                                    <style type="text/css" id="styles_js">
                                                                        #card-errors {
                                                                            font-size: 14px;
                                                                            color: #f56c6c;
                                                                            padding-left: 12px;
                                                                            padding-bottom: 6px;
                                                                        }

                                                                        #ab_loader {
                                                                            position: relative;
                                                                            display: block;
                                                                            width: 30px;
                                                                            height: 30px;
                                                                            left: 50%;
                                                                            top: 50%;
                                                                            transform: translate(-50%, -50%);
                                                                            -moz-transform: translate(-50%, -50%);
                                                                            -o-transform: translate(-50%, -50%);
                                                                            -ms-transform: translate(-50%, -50%);
                                                                        }

                                                                        #ab_loader:before {
                                                                            content: '';
                                                                            display: block;
                                                                            position: absolute;
                                                                            width: 100%;
                                                                            height: 100%;
                                                                            box-sizing: border-box;
                                                                            line-height: 100%;
                                                                            overflow: hidden;
                                                                            border-radius: 100%;
                                                                            border: none;
                                                                            z-index: 1;
                                                                            border-bottom: #ccc solid 3px;
                                                                            border-top: dodgerblue solid 3px;
                                                                            border-right: #ccc solid 3px;
                                                                            border-left: #ccc solid 3px;
                                                                            -webkit-animation-name: loader;
                                                                            -moz-animation-name: loader;
                                                                            -ms-animation-name: loader;
                                                                            -o-animation-name: loader;
                                                                            animation-name: loader;
                                                                            -webkit-animation-iteration-count: infinite;
                                                                            -moz-animation-iteration-count: infinite;
                                                                            -o-animation-iteration-count: infinite;
                                                                            -ms-animation-iteration-count: infinite;
                                                                            animation-iteration-count: infinite;
                                                                            -webkit-animation-timing-function: linear;
                                                                            -moz-animation-timing-function: linear;
                                                                            -ms-animation-timing-function: linear;
                                                                            -o-animation-timing-function: linear;
                                                                            animation-timing-function: linear;
                                                                            -webkit-animation-fill-mode: forwards;
                                                                            -ms-animation-fill-mode: forwards;
                                                                            -moz-animation-fill-mode: forwards;
                                                                            -o-animation-fill-mode: forwards;
                                                                            animation-fill-mode: forwards;
                                                                            -webkit-animation-duration: 1s;
                                                                            -moz-animation-duration: 1s;
                                                                            -ms-animation-duration: 1s;
                                                                            -o-animation-duration: 1s;
                                                                            animation-duration: 1s;
                                                                        }

                                                                        @-webkit-keyframes loader {
                                                                            from {
                                                                                -webkit-transform: rotate(0deg);
                                                                                -moz-transform: rotate(0deg);
                                                                                -ms-transform: rotate(0deg);
                                                                                -o-transform: rotate(0deg);
                                                                                transform: rotate(0deg);
                                                                            }

                                                                            to {
                                                                                -webkit-transform: rotate(360deg);
                                                                                -moz-transform: rotate(360deg);
                                                                                -ms-transform: rotate(360deg);
                                                                                -o-transform: rotate(360deg);
                                                                                transform: rotate(360deg);
                                                                            }
                                                                        }

                                                                        @-o-keyframes loader {
                                                                            from {
                                                                                -webkit-transform: rotate(0deg);
                                                                                -moz-transform: rotate(0deg);
                                                                                -ms-transform: rotate(0deg);
                                                                                -o-transform: rotate(0deg);
                                                                                transform: rotate(0deg);
                                                                            }

                                                                            to {
                                                                                -webkit-transform: rotate(360deg);
                                                                                -moz-transform: rotate(360deg);
                                                                                -ms-transform: rotate(360deg);
                                                                                -o-transform: rotate(360deg);
                                                                                transform: rotate(360deg);
                                                                            }
                                                                        }

                                                                        @-moz-keyframes loader {
                                                                            from {
                                                                                -webkit-transform: rotate(0deg);
                                                                                -moz-transform: rotate(0deg);
                                                                                -ms-transform: rotate(0deg);
                                                                                -o-transform: rotate(0deg);
                                                                                transform: rotate(0deg);
                                                                            }

                                                                            to {
                                                                                -webkit-transform: rotate(360deg);
                                                                                -moz-transform: rotate(360deg);
                                                                                -ms-transform: rotate(360deg);
                                                                                -o-transform: rotate(360deg);
                                                                                transform: rotate(360deg);
                                                                            }
                                                                        }

                                                                        @keyframes loader {
                                                                            from {
                                                                                -webkit-transform: rotate(0deg);
                                                                                -moz-transform: rotate(0deg);
                                                                                -ms-transform: rotate(0deg);
                                                                                -o-transform: rotate(0deg);
                                                                                transform: rotate(0deg);
                                                                            }

                                                                            to {
                                                                                -webkit-transform: rotate(360deg);
                                                                                -moz-transform: rotate(360deg);
                                                                                -ms-transform: rotate(360deg);
                                                                                -o-transform: rotate(360deg);
                                                                                transform: rotate(360deg);
                                                                            }
                                                                        }

                                                                        @-webkit-keyframes scale {
                                                                            from {
                                                                                -webkit-transform: scale(1);
                                                                                -moz-transform: scale(1);
                                                                                -ms-transform: scale(1);
                                                                                -o-transform: scale(1);
                                                                                transform: scale(1);
                                                                            }

                                                                            50% {
                                                                                -webkit-transform: scale(1.5);
                                                                                -moz-transform: scale(1.5);
                                                                                -ms-transform: scale(1.5);
                                                                                -o-transform: scale(1.5);
                                                                                transform: scale(1.5);
                                                                            }

                                                                            to {
                                                                                -webkit-transform: scale(1);
                                                                                -moz-transform: scale(1);
                                                                                -ms-transform: scale(1);
                                                                                -o-transform: scale(1);
                                                                                transform: scale(1);
                                                                            }
                                                                        }

                                                                        @-o-keyframes scale {
                                                                            from {
                                                                                -webkit-transform: scale(1);
                                                                                -moz-transform: scale(1);
                                                                                -ms-transform: scale(1);
                                                                                -o-transform: scale(1);
                                                                                transform: scale(1);
                                                                            }

                                                                            50% {
                                                                                -webkit-transform: scale(1.5);
                                                                                -moz-transform: scale(1.5);
                                                                                -ms-transform: scale(1.5);
                                                                                -o-transform: scale(1.5);
                                                                                transform: scale(1.5);
                                                                            }

                                                                            to {
                                                                                -webkit-transform: scale(1);
                                                                                -moz-transform: scale(1);
                                                                                -ms-transform: scale(1);
                                                                                -o-transform: scale(1);
                                                                                transform: scale(1);
                                                                            }
                                                                        }

                                                                        @-moz-keyframes scale {
                                                                            from {
                                                                                -webkit-transform: scale(1);
                                                                                -moz-transform: scale(1);
                                                                                -ms-transform: scale(1);
                                                                                -o-transform: scale(1);
                                                                                transform: scale(1);
                                                                            }

                                                                            50% {
                                                                                -webkit-transform: scale(1.5);
                                                                                -moz-transform: scale(1.5);
                                                                                -ms-transform: scale(1.5);
                                                                                -o-transform: scale(1.5);
                                                                                transform: scale(1.5);
                                                                            }

                                                                            to {
                                                                                -webkit-transform: scale(1);
                                                                                -moz-transform: scale(1);
                                                                                -ms-transform: scale(1);
                                                                                -o-transform: scale(1);
                                                                                transform: scale(1);
                                                                            }
                                                                        }

                                                                        @keyframes scale {
                                                                            from {
                                                                                -webkit-transform: scale(1);
                                                                                -moz-transform: scale(1);
                                                                                -ms-transform: scale(1);
                                                                                -o-transform: scale(1);
                                                                                transform: scale(1);
                                                                            }

                                                                            50% {
                                                                                -webkit-transform: scale(1.5);
                                                                                -moz-transform: scale(1.5);
                                                                                -ms-transform: scale(1.5);
                                                                                -o-transform: scale(1.5);
                                                                                transform: scale(1.5);
                                                                            }

                                                                            to {
                                                                                -webkit-transform: scale(1);
                                                                                -moz-transform: scale(1);
                                                                                -ms-transform: scale(1);
                                                                                -o-transform: scale(1);
                                                                                transform: scale(1);
                                                                            }
                                                                        }

                                                                        #ab_loaderCeil {
                                                                            position: absolute;
                                                                            display: block;
                                                                            width: 100%;
                                                                            height: 100%;
                                                                            left: 0;
                                                                            top: 0;
                                                                            background: rgba(255, 255, 255, 0.5);
                                                                        }

                                                                        .Card_item {
                                                                            width: 100%;
                                                                            list-style: none;
                                                                            margin-bottom: 10px;
                                                                        }

                                                                        .Card_radio {
                                                                            -webkit-appearance: radio;
                                                                            appearance: radio;
                                                                            float: none;
                                                                        }

                                                                        .Card_in {
                                                                            display: inline-block;
                                                                            margin-left: 10px;
                                                                            font-size: 14px;
                                                                            font-weight: 600;
                                                                            position: relative;
                                                                            top: -1px;
                                                                        }

                                                                        .card-image {
                                                                            margin-left: 5px;
                                                                            position: relative;
                                                                            top: 4px;
                                                                            display: inline-block;
                                                                            background: url('https://sandbox-pay.asiabill.com/static/v3/images/pm-m.png') no-repeat;
                                                                            width: 28px;
                                                                            height: 20px !important;
                                                                        }

                                                                        .card-image-1 {
                                                                            background-position: -52px 0;
                                                                            width: 25px;
                                                                        }

                                                                        .card-image-2 {
                                                                            background-position: -77px 0;
                                                                        }

                                                                        .card-image-3 {
                                                                            background-position: 0 -19px;
                                                                        }

                                                                        .card-image-4 {
                                                                            background-position: -25px -19px;
                                                                            width: 24px;
                                                                        }

                                                                        .card-image-5 {
                                                                            background-position: -75px -19px;
                                                                        }

                                                                        .card-image-6 {
                                                                            background-position: -75px -19px;
                                                                        }
                                                                    </style>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <li style="display:none;">
                                                            <input class="J-PayPalNumber" type="hidden" value="">
                                                            <div class="order-paypal-h3 J-SwitchPal" data-type="paypal"
                                                                data-payment="PayPal">
                                                                <div class="fl">
                                                                    <span class="np-ui-radio "></span>
                                                                    <img class="align payment-img"
                                                                        src="https://static-theme.cdncloud.top/buyer/public/img/payment/paypal.svg"
                                                                        alt="">
                                                                    Paypal
                                                                </div>
                                                            </div>
                                                            <div class="order-paypal-box" style="display: none">
                                                                <div class="order-paypal-tip">
                                                                    <span class="paypal-icon"></span>
                                                                </div>
                                                                <p>After clicking “Complete order”, you will be redirected to
                                                                    PayPal to complete your
                                                                    purchase securely.</p>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>


                                                <div class="order-write-list order-button">
                                                    <div class="order-write-item">
                                                        <a class="J-ChangeShipping back-prev" href="{{ route('checkout.shipping',$store->slug) }}">
                                                            <span class="iconfont icon-back"></span>
                                                            Return to shipping
                                                        </a>
                                                    </div>
                                                    <div class="order-write-item">
                                                        <div id="paypal-payment-button"
                                                            class="paypal-payment-button J-PaypalButton" style="display: none;">
                                                            <div id="zoid-paypal-buttons-uid_5cc0dd52af_mdq6mzc6mjg"
                                                                class="paypal-buttons paypal-buttons-context-iframe paypal-buttons-label-paypal paypal-buttons-layout-vertical"
                                                                data-paypal-smart-button-version="5.0.318"
                                                                style="height: 0px; transition: all 0.2s ease-in-out 0s;">
                                                                <style nonce="">
                                                                    #zoid-paypal-buttons-uid_5cc0dd52af_mdq6mzc6mjg {
                                                                        position: relative;
                                                                        display: inline-block;
                                                                        width: 100%;
                                                                        min-height: 25px;
                                                                        min-width: 150px;
                                                                        max-width: 750px;
                                                                        font-size: 0;
                                                                    }

                                                                    #zoid-paypal-buttons-uid_5cc0dd52af_mdq6mzc6mjg>iframe {
                                                                        position: absolute;
                                                                        top: 0;
                                                                        left: 0;
                                                                        width: 100%;
                                                                        height: 100%;
                                                                    }

                                                                    #zoid-paypal-buttons-uid_5cc0dd52af_mdq6mzc6mjg>iframe.component-frame {
                                                                        z-index: 100;
                                                                    }

                                                                    #zoid-paypal-buttons-uid_5cc0dd52af_mdq6mzc6mjg>iframe.prerender-frame {
                                                                        transition: opacity .2s linear;
                                                                        z-index: 200;
                                                                    }

                                                                    #zoid-paypal-buttons-uid_5cc0dd52af_mdq6mzc6mjg>iframe.visible {
                                                                        opacity: 1;
                                                                    }

                                                                    #zoid-paypal-buttons-uid_5cc0dd52af_mdq6mzc6mjg>iframe.invisible {
                                                                        opacity: 0;
                                                                        pointer-events: none;
                                                                    }

                                                                    #zoid-paypal-buttons-uid_5cc0dd52af_mdq6mzc6mjg>.smart-menu {
                                                                        position: absolute;
                                                                        z-index: 300;
                                                                        top: 0;
                                                                        left: 0;
                                                                        width: 100%;
                                                                    }
                                                                </style><iframe allowtransparency="true"
                                                                    name="__zoid__paypal_buttons__eyJzZW5kZXIiOnsiZG9tYWluIjoiaHR0cHM6Ly9wZXJ0bGFuZGx5LmNvbSJ9LCJtZXRhRGF0YSI6eyJ3aW5kb3dSZWYiOnsidHlwZSI6InBhcmVudCIsImRpc3RhbmNlIjowfX0sInJlZmVyZW5jZSI6eyJ0eXBlIjoicmF3IiwidmFsIjoie1widWlkXCI6XCJ6b2lkLXBheXBhbC1idXR0b25zLXVpZF81Y2MwZGQ1MmFmX21kcTZtemM2bWpnXCIsXCJjb250ZXh0XCI6XCJpZnJhbWVcIixcInRhZ1wiOlwicGF5cGFsLWJ1dHRvbnNcIixcImNoaWxkRG9tYWluTWF0Y2hcIjp7XCJfX3R5cGVfX1wiOlwicmVnZXhcIixcIl9fdmFsX19cIjpcIlxcXFwucGF5cGFsXFxcXC4oY29tfGNuKSg6XFxcXGQrKT8kXCJ9LFwidmVyc2lvblwiOlwiMTBfMV8wXCIsXCJwcm9wc1wiOntcImVudlwiOlwicHJvZHVjdGlvblwiLFwibG9jYWxlXCI6e1wiY291bnRyeVwiOlwiVVNcIixcImxhbmdcIjpcImVuXCJ9LFwib25DbGlja1wiOntcIl9fdHlwZV9fXCI6XCJjcm9zc19kb21haW5fZnVuY3Rpb25cIixcIl9fdmFsX19cIjp7XCJpZFwiOlwidWlkX2NiMGY5NmQ0YWFfbWRxNm16YzZtamdcIixcIm5hbWVcIjpcIm9uQ2xpY2tcIn19LFwiY3JlYXRlT3JkZXJcIjp7XCJfX3R5cGVfX1wiOlwiY3Jvc3NfZG9tYWluX2Z1bmN0aW9uXCIsXCJfX3ZhbF9fXCI6e1wiaWRcIjpcInVpZF9kMWQ0ZDY0MmI1X21kcTZtemM2bWpnXCIsXCJuYW1lXCI6XCJjcmVhdGVPcmRlclwifX0sXCJvbkFwcHJvdmVcIjp7XCJfX3R5cGVfX1wiOlwiY3Jvc3NfZG9tYWluX2Z1bmN0aW9uXCIsXCJfX3ZhbF9fXCI6e1wiaWRcIjpcInVpZF8yNmQ2ZThlY2M3X21kcTZtemM2bWpnXCIsXCJuYW1lXCI6XCJvbkFwcHJvdmVcIn19LFwib25DYW5jZWxcIjp7XCJfX3R5cGVfX1wiOlwiY3Jvc3NfZG9tYWluX2Z1bmN0aW9uXCIsXCJfX3ZhbF9fXCI6e1wiaWRcIjpcInVpZF84MjI2NGJmZDk4X21kcTZtemM2bWpnXCIsXCJuYW1lXCI6XCJvbkNhbmNlbFwifX0sXCJjb21taXRcIjp0cnVlLFwic3R5bGVcIjp7XCJjdXN0b21cIjp7XCJfX3R5cGVfX1wiOlwidW5kZWZpbmVkXCJ9LFwibGFiZWxcIjpcInBheXBhbFwiLFwibGF5b3V0XCI6XCJ2ZXJ0aWNhbFwiLFwiY29sb3JcIjpcImdvbGRcIixcInNoYXBlXCI6XCJyZWN0XCIsXCJ0YWdsaW5lXCI6ZmFsc2UsXCJoZWlnaHRcIjo0NCxcInBlcmlvZFwiOntcIl9fdHlwZV9fXCI6XCJ1bmRlZmluZWRcIn0sXCJtZW51UGxhY2VtZW50XCI6XCJiZWxvd1wifSxcImNzcE5vbmNlXCI6e1wiX190eXBlX19cIjpcInVuZGVmaW5lZFwifSxcImZ1bmRpbmdTb3VyY2VcIjp7XCJfX3R5cGVfX1wiOlwidW5kZWZpbmVkXCJ9LFwic3RvcmFnZVN0YXRlXCI6e1wiZ2V0XCI6e1wiX190eXBlX19cIjpcImNyb3NzX2RvbWFpbl9mdW5jdGlvblwiLFwiX192YWxfX1wiOntcImlkXCI6XCJ1aWRfNjRmNmU0YjA4MV9tZHE2bXpjNm1qZ1wiLFwibmFtZVwiOlwiZ2V0XCJ9fSxcInNldFwiOntcIl9fdHlwZV9fXCI6XCJjcm9zc19kb21haW5fZnVuY3Rpb25cIixcIl9fdmFsX19cIjp7XCJpZFwiOlwidWlkX2JiYWIwYTIyNjNfbWRxNm16YzZtamdcIixcIm5hbWVcIjpcInNldFwifX19LFwic2Vzc2lvblN0YXRlXCI6e1wiZ2V0XCI6e1wiX190eXBlX19cIjpcImNyb3NzX2RvbWFpbl9mdW5jdGlvblwiLFwiX192YWxfX1wiOntcImlkXCI6XCJ1aWRfYmRhMzk0OThjNV9tZHE2bXpjNm1qZ1wiLFwibmFtZVwiOlwiZ2V0XCJ9fSxcInNldFwiOntcIl9fdHlwZV9fXCI6XCJjcm9zc19kb21haW5fZnVuY3Rpb25cIixcIl9fdmFsX19cIjp7XCJpZFwiOlwidWlkXzI0ODdhMzZhMzJfbWRxNm16YzZtamdcIixcIm5hbWVcIjpcInNldFwifX19LFwiY29tcG9uZW50c1wiOltcImJ1dHRvbnNcIl0sXCJjcmVhdGVCaWxsaW5nQWdyZWVtZW50XCI6e1wiX190eXBlX19cIjpcInVuZGVmaW5lZFwifSxcImNyZWF0ZVN1YnNjcmlwdGlvblwiOntcIl9fdHlwZV9fXCI6XCJ1bmRlZmluZWRcIn0sXCJvbkNvbXBsZXRlXCI6e1wiX190eXBlX19cIjpcInVuZGVmaW5lZFwifSxcIm9uU2hpcHBpbmdDaGFuZ2VcIjp7XCJfX3R5cGVfX1wiOlwidW5kZWZpbmVkXCJ9LFwib25TaGlwcGluZ0FkZHJlc3NDaGFuZ2VcIjp7XCJfX3R5cGVfX1wiOlwidW5kZWZpbmVkXCJ9LFwib25TaGlwcGluZ09wdGlvbnNDaGFuZ2VcIjp7XCJfX3R5cGVfX1wiOlwidW5kZWZpbmVkXCJ9LFwiZ2V0UHJlcmVuZGVyRGV0YWlsc1wiOntcIl9fdHlwZV9fXCI6XCJjcm9zc19kb21haW5fZnVuY3Rpb25cIixcIl9fdmFsX19cIjp7XCJpZFwiOlwidWlkXzUyZTYyZmNjMTJfbWRxNm16YzZtamdcIixcIm5hbWVcIjpcImdldFByZXJlbmRlckRldGFpbHNcIn19LFwiZ2V0UG9wdXBCcmlkZ2VcIjp7XCJfX3R5cGVfX1wiOlwiY3Jvc3NfZG9tYWluX2Z1bmN0aW9uXCIsXCJfX3ZhbF9fXCI6e1wiaWRcIjpcInVpZF82YTFlZjEwNzcwX21kcTZtemM2bWpnXCIsXCJuYW1lXCI6XCJnZXRQb3B1cEJyaWRnZVwifX0sXCJvbkluaXRcIjp7XCJfX3R5cGVfX1wiOlwiY3Jvc3NfZG9tYWluX2Z1bmN0aW9uXCIsXCJfX3ZhbF9fXCI6e1wiaWRcIjpcInVpZF83NjQyZWY2MmJhX21kcTZtemM2bWpnXCIsXCJuYW1lXCI6XCJvbkluaXRcIn19LFwiZ2V0UXVlcmllZEVsaWdpYmxlRnVuZGluZ1wiOntcIl9fdHlwZV9fXCI6XCJjcm9zc19kb21haW5fZnVuY3Rpb25cIixcIl9fdmFsX19cIjp7XCJpZFwiOlwidWlkXzhjYTA2OTRjZjRfbWRxNm16YzZtamdcIixcIm5hbWVcIjpcImdldFF1ZXJpZWRFbGlnaWJsZUZ1bmRpbmdcIn19LFwiY2xpZW50SURcIjpcIkFWNFJ0NExicm14WFdiNFpZdzNuZi1uUTB5NTZLak5KTGJWd3dPcVg3UVNYNEFhLVlGcmlPeFA3bEpJU3l6U191bkNjdGgzT1Jub1d5VWs1XCIsXCJjbGllbnRBY2Nlc3NUb2tlblwiOntcIl9fdHlwZV9fXCI6XCJ1bmRlZmluZWRcIn0sXCJwYXJ0bmVyQXR0cmlidXRpb25JRFwiOlwiU2FpbGluZ19DYXJ0XCIsXCJtZXJjaGFudFJlcXVlc3RlZFBvcHVwc0Rpc2FibGVkXCI6ZmFsc2UsXCJlbmFibGVUaHJlZURvbWFpblNlY3VyZVwiOmZhbHNlLFwic2RrQ29ycmVsYXRpb25JRFwiOlwiZjk0MTc4MzA5YTgzM1wiLFwic3RvcmFnZUlEXCI6XCJ1aWRfMmIzMWM1YzRkY19tamU2bmRtNm50ZVwiLFwic2Vzc2lvbklEXCI6XCJ1aWRfNDNjZDU4ZTE5Ml9tZHE2bXpjNm1qZ1wiLFwiYnV0dG9uU2Vzc2lvbklEXCI6XCJ1aWRfZjE3MmFiOGZjMF9tZHE2bXpjNm1qZ1wiLFwiZW5hYmxlVmF1bHRcIjp7XCJfX3R5cGVfX1wiOlwidW5kZWZpbmVkXCJ9LFwiYW1vdW50XCI6e1wiX190eXBlX19cIjpcInVuZGVmaW5lZFwifSxcInN0YWdlSG9zdFwiOntcIl9fdHlwZV9fXCI6XCJ1bmRlZmluZWRcIn0sXCJidXR0b25TaXplXCI6e1wiX190eXBlX19cIjpcInVuZGVmaW5lZFwifSxcImFwaVN0YWdlSG9zdFwiOntcIl9fdHlwZV9fXCI6XCJ1bmRlZmluZWRcIn0sXCJmdW5kaW5nRWxpZ2liaWxpdHlcIjp7XCJwYXlwYWxcIjp7XCJlbGlnaWJsZVwiOnRydWUsXCJ2YXVsdGFibGVcIjpmYWxzZX0sXCJwYXlsYXRlclwiOntcImVsaWdpYmxlXCI6ZmFsc2UsXCJwcm9kdWN0c1wiOntcInBheUluM1wiOntcImVsaWdpYmxlXCI6ZmFsc2UsXCJ2YXJpYW50XCI6bnVsbH0sXCJwYXlJbjRcIjp7XCJlbGlnaWJsZVwiOmZhbHNlLFwidmFyaWFudFwiOm51bGx9LFwicGF5bGF0ZXJcIjp7XCJlbGlnaWJsZVwiOmZhbHNlLFwidmFyaWFudFwiOm51bGx9fX0sXCJjYXJkXCI6e1wiZWxpZ2libGVcIjp0cnVlLFwiYnJhbmRlZFwiOnRydWUsXCJpbnN0YWxsbWVudHNcIjpmYWxzZSxcInZlbmRvcnNcIjp7XCJ2aXNhXCI6e1wiZWxpZ2libGVcIjp0cnVlLFwidmF1bHRhYmxlXCI6dHJ1ZX0sXCJtYXN0ZXJjYXJkXCI6e1wiZWxpZ2libGVcIjp0cnVlLFwidmF1bHRhYmxlXCI6dHJ1ZX0sXCJhbWV4XCI6e1wiZWxpZ2libGVcIjp0cnVlLFwidmF1bHRhYmxlXCI6dHJ1ZX0sXCJkaXNjb3ZlclwiOntcImVsaWdpYmxlXCI6ZmFsc2UsXCJ2YXVsdGFibGVcIjp0cnVlfSxcImhpcGVyXCI6e1wiZWxpZ2libGVcIjpmYWxzZSxcInZhdWx0YWJsZVwiOmZhbHNlfSxcImVsb1wiOntcImVsaWdpYmxlXCI6ZmFsc2UsXCJ2YXVsdGFibGVcIjp0cnVlfSxcImpjYlwiOntcImVsaWdpYmxlXCI6ZmFsc2UsXCJ2YXVsdGFibGVcIjp0cnVlfX0sXCJndWVzdEVuYWJsZWRcIjp0cnVlfSxcInZlbm1vXCI6e1wiZWxpZ2libGVcIjpmYWxzZX0sXCJpdGF1XCI6e1wiZWxpZ2libGVcIjpmYWxzZX0sXCJjcmVkaXRcIjp7XCJlbGlnaWJsZVwiOmZhbHNlfSxcImFwcGxlcGF5XCI6e1wiZWxpZ2libGVcIjpmYWxzZX0sXCJzZXBhXCI6e1wiZWxpZ2libGVcIjpmYWxzZX0sXCJpZGVhbFwiOntcImVsaWdpYmxlXCI6ZmFsc2V9LFwiYmFuY29udGFjdFwiOntcImVsaWdpYmxlXCI6ZmFsc2V9LFwiZ2lyb3BheVwiOntcImVsaWdpYmxlXCI6ZmFsc2V9LFwiZXBzXCI6e1wiZWxpZ2libGVcIjpmYWxzZX0sXCJzb2ZvcnRcIjp7XCJlbGlnaWJsZVwiOmZhbHNlfSxcIm15YmFua1wiOntcImVsaWdpYmxlXCI6ZmFsc2V9LFwicDI0XCI6e1wiZWxpZ2libGVcIjpmYWxzZX0sXCJ6aW1wbGVyXCI6e1wiZWxpZ2libGVcIjpmYWxzZX0sXCJ3ZWNoYXRwYXlcIjp7XCJlbGlnaWJsZVwiOmZhbHNlfSxcInBheXVcIjp7XCJlbGlnaWJsZVwiOmZhbHNlfSxcImJsaWtcIjp7XCJlbGlnaWJsZVwiOmZhbHNlfSxcInRydXN0bHlcIjp7XCJlbGlnaWJsZVwiOmZhbHNlfSxcIm94eG9cIjp7XCJlbGlnaWJsZVwiOmZhbHNlfSxcIm1heGltYVwiOntcImVsaWdpYmxlXCI6ZmFsc2V9LFwiYm9sZXRvXCI6e1wiZWxpZ2libGVcIjpmYWxzZX0sXCJtZXJjYWRvcGFnb1wiOntcImVsaWdpYmxlXCI6ZmFsc2V9LFwibXVsdGliYW5jb1wiOntcImVsaWdpYmxlXCI6ZmFsc2V9fSxcInBsYXRmb3JtXCI6XCJkZXNrdG9wXCIsXCJyZW1lbWJlcmVkXCI6W10sXCJleHBlcmltZW50XCI6e1wiZW5hYmxlVmVubW9cIjpmYWxzZSxcImRpc2FibGVQYXlsYXRlclwiOmZhbHNlLFwiZW5hYmxlVmVubW9BcHBMYWJlbFwiOmZhbHNlfSxcImZsb3dcIjpcInB1cmNoYXNlXCIsXCJyZW1lbWJlclwiOntcIl9fdHlwZV9fXCI6XCJjcm9zc19kb21haW5fZnVuY3Rpb25cIixcIl9fdmFsX19cIjp7XCJpZFwiOlwidWlkXzMxNTBlY2YzMjZfbWRxNm16YzZtamdcIixcIm5hbWVcIjpcInJlbWVtYmVyXCJ9fSxcImN1cnJlbmN5XCI6XCJVU0RcIixcImludGVudFwiOlwiY2FwdHVyZVwiLFwiYnV5ZXJDb3VudHJ5XCI6e1wiX190eXBlX19cIjpcInVuZGVmaW5lZFwifSxcInZhdWx0XCI6ZmFsc2UsXCJlbmFibGVGdW5kaW5nXCI6W1wiY2FyZFwiLFwiY3JlZGl0XCIsXCJwYXlsYXRlclwiXSxcImRpc2FibGVGdW5kaW5nXCI6W10sXCJkaXNhYmxlQ2FyZFwiOltdLFwibWVyY2hhbnRJRFwiOltcIlAySlhDRlVWNERWVEFcIl0sXCJyZW5kZXJlZEJ1dHRvbnNcIjpbXCJwYXlwYWxcIixcImNhcmRcIl0sXCJjc3BcIjp7XCJub25jZVwiOlwiXCJ9LFwibm9uY2VcIjpcIlwiLFwiZ2V0UGFnZVVybFwiOntcIl9fdHlwZV9fXCI6XCJjcm9zc19kb21haW5fZnVuY3Rpb25cIixcIl9fdmFsX19cIjp7XCJpZFwiOlwidWlkX2ZjNGZjMmZhMGVfbWRxNm16YzZtamdcIixcIm5hbWVcIjpcImdldFBhZ2VVcmxcIn19LFwidXNlcklEVG9rZW5cIjp7XCJfX3R5cGVfX1wiOlwidW5kZWZpbmVkXCJ9LFwiY2xpZW50TWV0YWRhdGFJRFwiOntcIl9fdHlwZV9fXCI6XCJ1bmRlZmluZWRcIn0sXCJkZWJ1Z1wiOmZhbHNlLFwidGVzdFwiOntcImFjdGlvblwiOlwiY2hlY2tvdXRcIn0sXCJ3YWxsZXRcIjp7XCJfX3R5cGVfX1wiOlwidW5kZWZpbmVkXCJ9LFwicGF5bWVudE1ldGhvZE5vbmNlXCI6e1wiX190eXBlX19cIjpcInVuZGVmaW5lZFwifSxcInBheW1lbnRNZXRob2RUb2tlblwiOntcIl9fdHlwZV9fXCI6XCJ1bmRlZmluZWRcIn0sXCJicmFuZGVkXCI6e1wiX190eXBlX19cIjpcInVuZGVmaW5lZFwifSxcImFwcGxlUGF5U3VwcG9ydFwiOmZhbHNlLFwic3VwcG9ydHNQb3B1cHNcIjp0cnVlLFwic3VwcG9ydGVkTmF0aXZlQnJvd3NlclwiOmZhbHNlLFwidXNlckV4cGVyaWVuY2VGbG93XCI6e1wiX190eXBlX19cIjpcInVuZGVmaW5lZFwifSxcImFwcGxlUGF5XCI6e1wiX190eXBlX19cIjpcInVuZGVmaW5lZFwifSxcImV4cGVyaWVuY2VcIjpcIlwiLFwiYWxsb3dCaWxsaW5nUGF5bWVudHNcIjp0cnVlfSxcImV4cG9ydHNcIjp7XCJpbml0XCI6e1wiX190eXBlX19cIjpcImNyb3NzX2RvbWFpbl9mdW5jdGlvblwiLFwiX192YWxfX1wiOntcImlkXCI6XCJ1aWRfNjk0ZjQ4MmUyMl9tZHE2bXpjNm1qZ1wiLFwibmFtZVwiOlwiaW5pdFwifX0sXCJjbG9zZVwiOntcIl9fdHlwZV9fXCI6XCJjcm9zc19kb21haW5fZnVuY3Rpb25cIixcIl9fdmFsX19cIjp7XCJpZFwiOlwidWlkXzc1OTQ2Y2I0YjJfbWRxNm16YzZtamdcIixcIm5hbWVcIjpcImNsb3NlOjptZW1vaXplZFwifX0sXCJjaGVja0Nsb3NlXCI6e1wiX190eXBlX19cIjpcImNyb3NzX2RvbWFpbl9mdW5jdGlvblwiLFwiX192YWxfX1wiOntcImlkXCI6XCJ1aWRfMjhkNDdjNDljMV9tZHE2bXpjNm1qZ1wiLFwibmFtZVwiOlwiY2hlY2tDbG9zZVwifX0sXCJyZXNpemVcIjp7XCJfX3R5cGVfX1wiOlwiY3Jvc3NfZG9tYWluX2Z1bmN0aW9uXCIsXCJfX3ZhbF9fXCI6e1wiaWRcIjpcInVpZF9iOTMwYzc2OTNkX21kcTZtemM2bWpnXCIsXCJuYW1lXCI6XCJQZVwifX0sXCJvbkVycm9yXCI6e1wiX190eXBlX19cIjpcImNyb3NzX2RvbWFpbl9mdW5jdGlvblwiLFwiX192YWxfX1wiOntcImlkXCI6XCJ1aWRfY2ZlYTY1MjU4Y19tZHE2bXpjNm1qZ1wiLFwibmFtZVwiOlwiRGVcIn19LFwic2hvd1wiOntcIl9fdHlwZV9fXCI6XCJjcm9zc19kb21haW5fZnVuY3Rpb25cIixcIl9fdmFsX19cIjp7XCJpZFwiOlwidWlkX2NmYjEyMTdhNTRfbWRxNm16YzZtamdcIixcIm5hbWVcIjpcImhlXCJ9fSxcImhpZGVcIjp7XCJfX3R5cGVfX1wiOlwiY3Jvc3NfZG9tYWluX2Z1bmN0aW9uXCIsXCJfX3ZhbF9fXCI6e1wiaWRcIjpcInVpZF9jN2Y3ZmIyMGQ3X21kcTZtemM2bWpnXCIsXCJuYW1lXCI6XCJnZVwifX0sXCJleHBvcnRcIjp7XCJfX3R5cGVfX1wiOlwiY3Jvc3NfZG9tYWluX2Z1bmN0aW9uXCIsXCJfX3ZhbF9fXCI6e1wiaWRcIjpcInVpZF83ZGI3NmRiZDAzX21kcTZtemM2bWpnXCIsXCJuYW1lXCI6XCJIZVwifX19fSJ9fQ__"
                                                                    title="PayPal" allowpaymentrequest="allowpaymentrequest"
                                                                    scrolling="no" id="jsx-iframe-1fc38994da"
                                                                    class="component-frame visible"
                                                                    style="background-color: transparent; border: none;"></iframe>
                                                                <div id="smart-menu" class="smart-menu"></div>
                                                                <div id="installments-modal" class="installments-modal"></div>
                                                                <iframe name="__detect_close_uid_ba2caccb01_mdq6mzc6mjg__"
                                                                    style="display: none;"></iframe>
                                                            </div>
                                                        </div>
                                                        {{-- <button class="np-ui-btn np-ui-main-btn J-CreateOrder">
                                                            <span class="btn-text">
                                                                Complete order
                                                            </span>
                                                            <span class="iconfont icon-jiazai loading">
                                                                <svg style="width: 32px;height: 32px;vertical-align: middle;fill: currentColor;overflow: hidden;" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="887"><path d="M512 1024c-136.76544 0-265.33888-53.248-362.04544-149.95456s-149.95456-225.28-149.95456-362.04544c0-96.82944 27.17696-191.13984 78.60224-272.6912 49.99168-79.29856 120.66816-143.38048 204.34944-185.30304l43.008 85.83168c-68.03456 34.07872-125.50144 86.17984-166.15424 150.67136-41.73824 66.21184-63.81568 142.80704-63.81568 221.4912 0 229.376 186.61376 416.01024 416.01024 416.01024s416.01024-186.61376 416.01024-416.01024c0-78.68416-22.05696-155.27936-63.81568-221.4912-40.6528-64.49152-98.11968-116.59264-166.15424-150.67136l43.008-85.83168c83.70176 41.92256 154.35776 106.00448 204.34944 185.30304 51.42528 81.55136 78.60224 175.86176 78.60224 272.6912 0 136.76544-53.248 265.33888-149.95456 362.04544s-225.28 149.95456-362.04544 149.95456z" p-id="888"></path></svg>
                                                            </span>
                                                        </button> --}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="np-ui-cart-pay"></div>
                                    </div>
                                </div>

                            </div>

                            <p class="order-reserved">{{ $storethemesetting['footer_note'] }}</p>
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
                                            <i class="J-Subtotal">{{\App\Models\Utility::priceFormat(!empty($sub_total)?$sub_total:0)}}</i>
                                        </span>
                                    </p>

                                    @if($store->enable_shipping == "on")
                                        <p class="order-p">
                                            <span class="fl">Shipping</span>
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
                                    <input class="total_pay_price" type="hidden" value="{{App\Models\Utility::priceFormat($total)}}">
                                    <span>{{__('Total')}}</span>
                                    <span class="final_total_price">
                                        <i class="J-Total" data-original="{{ \App\Models\Utility::priceFormat( !empty($total) ? $total + $shipping_price : 0 ) }}">
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

        fbq('track', 'AddPaymentInfo');
    </script>

    <!-- TIKTOK PIXEL -->
    <script>
        ttq.track('CompleteRegistration')
    </script>

    <script>
        $(document).ready(function () {
            var totalPrice = '{{ \App\Models\Utility::priceFormat( !empty($total) ? $total : '0' ) }}';
            $('.js-order-total-price').html(`<strong>${totalPrice}</strong>`);

            $('.J-CreateOrder').on('click', function(e) {
                e.preventDefault();
                $('.kr-payment-button').trigger('click');
            })
        });
    </script>

    <script src="{{asset('assets/libs/jquery-mask-plugin/dist/jquery.mask.min.js')}}"></script>

    @if (isset($store_payments['is_stripe_enabled']) && $store_payments['is_stripe_enabled'] == 'on')
        <script src="https://js.stripe.com/v3/"></script>
        <script type="text/javascript">
            var stripe = Stripe('{{ isset($store_payments['stripe_key'])?$store_payments['stripe_key']:'' }}');
            var elements = stripe.elements();

            // Custom styling can be passed to options when creating an Element.
            var style = {
                base: {
                    // Add your base input styles here. For example:
                    fontSize: '14px',
                    color: '#32325d',
                },
            };

            // Create an instance of the card Element.
            var card = elements.create('card', {style: style});

            // Add an instance of the card Element into the `card-element` <div>.
            card.mount('#card-element');

            // Create a token or display an error when the form is submitted.
            var form = document.getElementById('payment-form');
            form.addEventListener('submit', function (event) {
                event.preventDefault();

                stripe.createToken(card).then(function (result) {
                    if (result.error) {
                        $("#card-errors").html(result.error.message);
                        show_toastr('Error', result.error.message, 'error');
                    } else {
                        // Send the token to your server.
                        stripeTokenHandler(result.token);
                    }
                });
            });

            function stripeTokenHandler(token) {
                // Insert the token ID into the form so it gets submitted to the server
                var form = document.getElementById('payment-form');
                var hiddenInput = document.createElement('input');
                hiddenInput.setAttribute('type', 'hidden');
                hiddenInput.setAttribute('name', 'stripeToken');
                hiddenInput.setAttribute('value', token.id);
                form.appendChild(hiddenInput);

                form.submit();
            }
        </script>
    @endif

    <script>
        $(document).on('click', '#owner-whatsapp', function () {
            var product_array = '{{$encode_product}}';
            var product = JSON.parse(product_array.replace(/&quot;/g, '"'));
            var order_id = '{{$order_id = time()}}';
            var total_price = $('#Subtotal .total_price').attr('data-value');
            var coupon_id = $('.hidden_coupon').attr('data_id');
            var dicount_price = $('.dicount_price').html();

            var data = {
                type: 'whatsapp',
                coupon_id: coupon_id,
                dicount_price: dicount_price,
                total_price: total_price,
                product: product,
                order_id: order_id,
                wts_number: $('#wts_number').val()
            }

            getWhatsappUrl(dicount_price, total_price, coupon_id, data);

            $.ajax({
                url: '{{ route('user.whatsapp',$store->slug) }}',
                method: 'POST',
                data: data,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (data) {
                    if (data.status == 'success') {

                        removesession();
                        show_toastr(data["success"], '{!! session('+data["status"]+') !!}', data["status"]);

                       setTimeout(function () {
                            var url = '{{ route('store-complete.complete', [$store->slug, ":id"]) }}';
                            url = url.replace(':id', data.order_id);

                            window.location.href = url;
                        }, 1000);

                       setTimeout(function () {
                            var get_url_msg_url = $('#return_url').val();
                            var append_href = get_url_msg_url + '{{route('user.order',[$store->slug,Crypt::encrypt(!empty($order->id) ? $order->id + 1 : 0 + 1)])}}';

                            window.open(append_href, '_blank');
                        }, 1000);
                    } else {
                        show_toastr("Error", data.success, data["status"]);
                    }

                }
            });
        });

        $(document).on('click', '#owner-telegram', function () {
            var product_array = '{{$encode_product}}';
            var product = JSON.parse(product_array.replace(/&quot;/g, '"'));
            var order_id = '{{$order_id = time()}}';
            var total_price = $('#Subtotal .total_price').attr('data-value');
            var coupon_id = $('.hidden_coupon').attr('data_id');
            var dicount_price = $('.dicount_price').html();

            var data = {
                type: 'telegram',
                coupon_id: coupon_id,
                dicount_price: dicount_price,
                total_price: total_price,
                product: product,
                order_id: order_id,
            }

            getWhatsappUrl(dicount_price, total_price, coupon_id, data);

            $.ajax({
                url: '{{ route('user.telegram',$store->slug) }}',
                method: 'POST',
                data: data,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (data) {
                    if (data.status == 'success') {
                        show_toastr(data["success"], '{!! session('+data["status"]+') !!}', data["status"]);

                        setTimeout(function () {
                            removesession();

                            var url = '{{ route('store-complete.complete', [$store->slug, ":id"]) }}';
                            url = url.replace(':id', data.order_id);

                            window.location.href = url;
                        }, 1000);

                    } else {
                        show_toastr("Error", data.success, data["status"]);
                    }
                }
            });
        });

        $(document).on('click', '#cash_on_delivery', function () {
            var product_array = '{{$encode_product}}';
            var product = JSON.parse(product_array.replace(/&quot;/g, '"'));
            var order_id = '{{$order_id = time()}}';

            var total_price = $('#Subtotal .total_price').attr('data-value');
            var coupon_id = $('.hidden_coupon').attr('data_id');
            var dicount_price = $('.dicount_price').html();

            var data = {
                coupon_id: coupon_id,
                dicount_price: dicount_price,
                total_price: total_price,
                product: product,
                order_id: order_id,
            }

            $.ajax({
                url: '{{ route('user.cod',$store->slug) }}',
                method: 'POST',
                data: data,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (data) {
                    if (data.status == 'success') {
                        show_toastr(data["success"], '{!! session('+data["status"]+') !!}', data["status"]);

                        setTimeout(function () {
                            var url = '{{ route('store-complete.complete', [$store->slug, ":id"]) }}';
                            url = url.replace(':id', data.order_id);
                            window.location.href = url;
                        }, 1000);

                        removesession();
                    } else {
                        show_toastr("Error", data.success, data["status"]);
                    }
                }
            });
        });

        function cjsavdatai() {

            var product_array = '{{$encode_product}}';
            var product = JSON.parse(product_array.replace(/&quot;/g, '"'));
            var order_id = '{{$order_id = time()}}';

            //var total_price = $('#Subtotal .total_price').attr('data-value');
            var total_price =$('#card-summary .product_total').val();
            //var coupon_id = $('.hidden_coupon').attr('data_id');
            var coupon_id = 1;
            //var dicount_price = $('.dicount_price').html();
            var dicount_price = 0;

            var data = {
                coupon_id: coupon_id,
                dicount_price: dicount_price,
                total_price: total_price,
                product: product,
                order_id: order_id,
            }
            ///console.log("YA PEEEE LUIIIGUIS",'{{ route('user.vdatai',$store->slug) }}');
            $.ajax({
                url: '{{ route('user.vdatai',$store->slug) }}',
                method: 'POST',
                data: data,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (data) {
                    console.log("DENTRO DEL AJAX",data);
                    if (data.status == 'success') {

                        Swal.fire({ icon: 'success', confirmButtonColor: '#0f5ef8', title: '{{ __('Successful purchase') }}' });
                        //show_toastr(data["success"], '{!! session('+data["status"]+') !!}', data["status"]);

                        setTimeout(function () {
                            var url = '{{ route('store-complete.complete', [$store->slug, ":id"]) }}';
                            url = url.replace(':id', data.order_id);
                            window.location.href = url;
                        }, 1000);

                        removesession();
                    } else {
                        show_toastr("Error", data.success, data["status"]);
                    }
                }
            });
        };

        function cjsavdatau() {
            var product_array = '{{$encode_product}}';
            var product = JSON.parse(product_array.replace(/&quot;/g, '"'));
            var order_id = '{{$order_id = time()}}';
            var total_price = $('#Subtotal .total_price').attr('data-value');
            var coupon_id = $('.hidden_coupon').attr('data_id');
            var dicount_price = $('.dicount_price').html();

            var data = {
                coupon_id: coupon_id,
                dicount_price: dicount_price,
                total_price: total_price,
                product: product,
                order_id: order_id,
            }

            $.ajax({
                url: '{{ route('user.vdatai',$store->slug) }}',
                method: 'POST',
                data: data,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (data) {
                    if (data.status == 'success') {
                        removesession();

                        Swal.fire({ icon: 'success', confirmButtonColor: '#0f5ef8', title: '{{ __('Successful purchase') }}' });

                        //show_toastr(data["success"], '{!! session('+data["status"]+') !!}', data["status"]);
                        setTimeout(function () {
                            var url = '{{ route('store-complete.complete', [$store->slug, ":id"]) }}';
                            url = url.replace(':id', data.order_id);
                            window.location.href = url;
                        }, 1000);
                    } else {
                        show_toastr("Error", data.success, data["status"]);
                    }
                }
            });
        };

        $(document).on('click', '#bank_transfer', function () {
            var product_array = '{{$encode_product}}';
            var product = JSON.parse(product_array.replace(/&quot;/g, '"'));
            var order_id = '{{$order_id = time()}}';
            var total_price = $('#Subtotal .total_price').attr('data-value');
            var coupon_id = $('.hidden_coupon').attr('data_id');
            var dicount_price = $('.dicount_price').html();

            var data = {
                coupon_id: coupon_id,
                dicount_price: dicount_price,
                total_price: total_price,
                product: product,
                order_id: order_id,
            }

            $.ajax({
                url: '{{ route('user.bank_transfer',$store->slug) }}',
                method: 'POST',
                data: data,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (data) {
                    if (data.status == 'success') {
                        removesession();
                        show_toastr(data["success"], '{!! session('+data["status"]+') !!}', data["status"]);

                        setTimeout(function () {
                            var url = '{{ route('store-complete.complete', [$store->slug, ":id"]) }}';
                            url = url.replace(':id', data.order_id);
                            window.location.href = url;
                        }, 1000);
                    } else {
                        show_toastr("Error", data.success, data["status"]);
                    }
                }
            });
        });

        $(document).on('click', '#bank_transferinv', function () {
            var product_array = '{{$encode_product}}';
            var product = JSON.parse(product_array.replace(/&quot;/g, '"'));
            var order_id = '{{$order_id = time()}}';

            var total_price = $('#Subtotal .total_price').attr('data-value');
            var coupon_id = $('.hidden_coupon').attr('data_id');
            var dicount_price = $('.dicount_price').html();

            var data = {
                coupon_id: coupon_id,
                dicount_price: dicount_price,
                total_price: total_price,
                product: product,
                order_id: order_id,
            }

            $.ajax({
                url: '{{ route('user.bank_transferinv',$store->slug) }}',
                method: 'POST',
                data: data,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (data) {
                    if (data.status == 'success') {
                        show_toastr(data["success"], '{!! session('+data["status"]+') !!}', data["status"]);

                        setTimeout(function () {
                            var url = '{{ route('store-complete.complete', [$store->slug, ":id"]) }}';
                            url = url.replace(':id', data.order_id);
                            window.location.href = url;
                        }, 1000);
                        removesession();
                    } else {
                        show_toastr("Error", data.success, data["status"]);
                    }
                }
            });
        });
    </script>

    <script>
        // Apply Coupon
        $(document).on('click', '.apply-coupon', function (e) {
            e.preventDefault();

            var ele = $(this);
            var coupon = ele.closest('.row').find('.coupon').val();
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

                                var html = '';
                                html += '<span class="text-sm font-weight-bold total_price" data-value="' + data.final_price_data_value + '">' + data.final_price + '</span>'
                                $('.final_total_price').html(html);


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
                    show_toastr('Error', '{{__('Invalid Coupon Code.')}}', 'error');
                }
            }

        });

        //for create/get Whatsapp Url
        function getWhatsappUrl(coupon = '', finalprice = '', coupon_id = '', data = '') {
            $.ajax({
                url: '{{ route('get.whatsappurl',$store->slug) }}',
                method: 'post',
                data: {dicount_price: coupon, finalprice: finalprice, coupon_id: coupon_id, data: data},
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (data) {
                    if (data.status == 'success') {
                        $('#return_url').val(data.url);
                        $('#return_order_id').val(data.order_id);

                    } else {
                        $('#return_url').val('')
                        show_toastr("Error", data.success, data["status"]);
                    }
                }
            });
        }

        //for create/get Telegram Url
        function getTelegramUrl(coupon = '', finalprice = '', coupon_id = '', data = '') {
            $.ajax({
                url: '{{ route('get.whatsappurl',$store->slug) }}',
                method: 'post',
                data: {dicount_price: coupon, finalprice: finalprice, coupon_id: coupon_id, data: data},
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (data) {
                    if (data.status == 'success') {
                        $('#return_url').val(data.url);
                        $('#return_order_id').val(data.order_id);

                    } else {
                        $('#return_url').val('')
                        show_toastr("Error", data.success, data["status"]);
                    }
                }
            });
        }

        function removesession(slug) {
            $.ajax({
                url: '{{ route('remove.session',$store->slug) }}',
                method: 'get',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (data) { }
            });
        }
    </script>

    <script src="{{asset('assets/theme1/js/checkout.js')}}"></script>
@endpush
