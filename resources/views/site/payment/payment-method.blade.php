<div class="checkout-box">

    <h4 class="mb-4">@langucw('payment method')</h4>

    <div class="checkout-payment-method">
        <div class="single-method form-check">
            <input  {{$special==1?'disabled ':''}}  value="cash_on_delivery" class="form-check-input" type="radio" id="payment_type1" name="payment-method">
            <label class="form-check-label" for="payment_type1">@langucw('cash on delivery')</label>
            <p>@langucw('please fill out the required data')</p>
        </div>

        <div class="single-method form-check">
            <input checked value="payment_by_credit_card" class="form-check-input" type="radio" id="payment_type2" name="payment-method">
            <label class="form-check-label" for="payment_type2">@langucw('Payment by credit card')</label>
            <p>@langucw('please fill out the required data')</p>
        </div>

        <div class="single-method form-check">
            <input class="form-check-input" type="checkbox" id="terms_conditions">
            <label class="form-check-label" for="terms_conditions">@langucw('i have read the terms and conditions and agree to them')</label>
        </div>

    </div>

    <button class="btn btn-dark btn-primary-hover rounded-0 mt-6" onclick="CompleteReques()">@langucw('complete the request')</button>

</div>
