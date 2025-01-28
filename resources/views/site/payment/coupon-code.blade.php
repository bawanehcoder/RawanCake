@if($coupona_active==='effective')
<div class="checkout-box">
    <h4 class="mb-4">@langucw('coupon code')</h4>

    <div class="input-group">
        <input type="text" class="form-control" name="coupon_code" id="coupon_code"
               placeholder="@langucw('do you have a coupon code? Enter it here')" required="">

        </div>
        <div id="coupon_discount"></div>

    <button class="btn btn-dark btn-primary-hover rounded-0 mt-6" id="coupon-apply" onclick="couponCode()">@langucw('apply')</button>

</div>
@endif
