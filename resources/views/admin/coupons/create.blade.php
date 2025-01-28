@extends('admin.layout.master')
@section('title')
    {{trans('general.create')}} {{trans('general.coupons')}}
@endsection
@section('css') @endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a
            href="{{route('dashboard.coupons.index')}}">{{trans('general.offers_and_discounts')}}</a></li>
    <li class="breadcrumb-item active">{{trans('general.create')}}</li>
@endsection

@section('content')
    @include('components.messagesAndErrors')
    <section id="basic-horizontal-layouts">
        <form class="form form-horizontal" action="{{route('dashboard.coupons.store')}}" method="POST"
              enctype="multipart/form-data">
            @csrf
            <input type="hidden" class="custom-file-input" name="blob" id="blob" value="coupons">
            <div class=" card ">
                <div class=" card-body table-list-card-body ">
                    <div class="form-row ">
                        <div class="form-group col-3">
                            <label for="number_of_symbols">@langucw('the number of symbols')</label>
                            <input type="number" min="1" max="100" value="1" id="number_of_symbols"
                                   class="form-control">
                        </div>
                        <div class="form-group col-3">
                            <label for="length_text">@langucw('the length of the text')</label>
                            <input type="number" min="3" max="30" value="3" id="length_text" class="form-control">
                        </div>
                        <div class="form-group row col-3">
                            <div class="form-check">
                                <label class="form-label" for="numbers_letters">@langucw('numbers and letters')</label>
                                <input type="checkbox" class="form-control " id="numbers_letters">
                            </div>
                        </div>
                        <div class="form-group col-3">
                            <div class="form-group ">
                                <div class="form-group col mt-3">
                                    <button onclick="generateCodes()" type="button" class="btn btn-success">
                                        @langucw('generate
                                        codes')
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{--                description--}}
                    <div class="form-row ">
                        <div class="form-group col-6">
                            <label for="description_ar">@langucw('symbols')</label>
                            <textarea type="text" name="symbols"  rows="12" id="symbols"
                                      class="form-control"></textarea>
                        </div>
                        <div class="form-group col-6 ">
                            <div class="form-group col-6 ">
                                <label for="fixed_discount">@langucw('fixed discount')</label>
                                <input type="number" step="any" min="0" max="1000" name="FixedDiscount"
                                       value="{{old('FixedDiscount')}}" id="FixedDiscount" class="form-control">
                            </div>
                            <div class="form-group col-6">
                                <label for="relative_discount">@langucw('relative discount')</label>
                                <input type="number" min="0" max="100" name="RelativeDiscount" placeholder="%"
                                       value="{{old('RelativeDiscount')}}" id="RelativeDiscount" class="form-control">
                            </div>
                            <div class="form-group col-6">
                                <label for="expiration_date">@langucw('expiration date')</label>
                                <x-flatpickr value="{{old('expiration_date')}}" name="expiration_date" show-time
                                             time-format="h:i"/>
                            </div>
                            <div class="form-group col-6">
                                <label for="usage_limit">@langucw('usage limit')</label>
                                <input type="number" min="1" max="100000" name="usage_limit" placeholder="%"
                                       value="{{old('usage_limit')}}" id="usage_limit" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-md-3">
                        <button type="submit" class="btn btn-danger">{{trans('general.save')}}</button>
                    </div>
                </div>
            </div>
        </form>
    </section>

@endsection
@section('scripts')
    <script>
        function generateCodes() {
            var serialLength = $("#length_text").val();
            var length = $("#number_of_symbols").val();
            var type = 0;
            if ($('#numbers_letters').is(":checked")) {
                var type = 1;
            }
            var symbols = '';
            for (var i = 0; i < length; i++) {
                console.log()
                symbols += genrateSerial(serialLength, type) + "\r\n";
            }
            $("#symbols").val(symbols)
        }

        function genrateSerial(serialLength, type) {
            switch (type) {
                case 0:
                    var chars = '0123456789';
                    break;
                case 1:
                    var chars = 'abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789';
                    break;
            }
            var randomSerial = '';
            var randomNuber;
            for (var i = 0; i < serialLength; i = i + 1) {
                randomNuber = Math.floor(Math.random() * chars.length)
                randomSerial += chars.substring(randomNuber, randomNuber + 1)
            }
            return randomSerial;
        }
    </script>

@endsection
