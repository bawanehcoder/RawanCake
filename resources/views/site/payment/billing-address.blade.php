<div id="billing-form">
    <h4 class="mb-4">@langucw('billing address')

    </h4>
    <div class="row row-cols-sm-2 row-cols-1 g-4">

        <div class="col-md-12">
            <div class="col-sm-12 d-flex flex-wrap gap-6">
                <div class="form-check m-0">
                    <input class="form-check-input" checked name="type" type="radio" id="bill_form"
                        data-toggle-shipping="#bill-form">
                    <label class="form-check-label" for="bill_form">@langucw('delivery address')</label>
                </div>


                <div class="form-check m-0">
                    <input class="form-check-input branch_pickup" type="radio" name="type" id="shiping_address"
                        data-toggle-shipping="#shipping-form">
                    <label class="form-check-label" for="shiping_address">@langucw('branch pickup')</label>
                </div>
            </div>



            <div class="row">
                <div class="col-6">
                    <label>{{ trans('general.name') }}</label>
                    <input class="form-field" type="text" name="name" id="name_input"
                        value='{{ old('name') ?? $entity?->name }}' placeholder="{{ trans('general.name') }}">
                </div>
                <div class="col-6">
                    <label>@langucw('phone number')</label>
                    <input class="form-field" type="text" id="phone_number" name="phone_number"
                        value='{{ old('phone_number') ?? $entity?->phone }}' placeholder="@langucw('phone number')">
                </div>
                <div id="shipping-form" class="mt-md-8 mt-6" style="display: none;">
                    <div class="col-12">
                        <label>@langucw('branch')</label>
                        <div class="select-wrapper">
                            <select class="form-field" id="branch_pickup_s" name="branch_pickup_s">
                                @foreach (\App\Models\Branche::select('*')->get() as $index => $branch)
                                    <option value="{{ $branch->id }}">{{ $branch->getTitle() }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div id="bill-form">
                    <div class="col-12">
                        <label>@langucw('address')</label>
                        <div class="select-wrapper">


                            <select class="form-field" id="address" name="address">
                                @foreach (\App\Models\Zones::select('*')->get() as $index => $zone)
                                    @php

                                        if (isset($delivery_free) && $delivery_free) {
                                            $price_de = 0;
                                        } elseif ($conditional_deliverie ?? false != false) {
                                            if (count($conditional_deliverie['zones']) < 1) {
                                                $price_de = $conditional_deliverie['delivery'];
                                            } elseif (in_array($zone->id, $conditional_deliverie['zones'])) {
                                                $price_de = $conditional_deliverie['delivery'];
                                            } else {
                                                $price_de = \App\Transformers\ZonesTransformer::getDelivery($zone);
                                            }
                                        } else {
                                            $price_de = \App\Transformers\ZonesTransformer::getDelivery($zone);
                                        }

                                    @endphp
                                    <option {{ $zone->id == $entity->zone_id ? 'selected' : '' }}
                                        att_prise="{{ $price_de }}" value="{{ $zone->id }}">
                                        {{ $zone->AddresEn }}
                                        | {{ $zone->AddresAr }} | {{ number_format((float) $price_de, 2, '.', '') }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                @php
                    $datetime = new DateTime('tomorrow');
                @endphp

                @if ($special == 1)
                    <div class="col-md-12">
                        <p style="color: red;margin-top:30px;">
                            You have special products, your order will not be ready before tomorrow, and you have to pay
                            online.
                        </p>
                    </div>
                @endif

                <div class="col-md-6">
                    <label>@langucw('delivery date')</label>
                    <input autocomplete="off" class="form-field datepicker" type="text" id="delivery_date"
                        name="delivery_date" value='{{ old('delivery_date') ?? $entity?->delivery_date }}'
                        placeholder="@langucw('delivery Date')"
                        min="{{ $special == 1 ? $datetime->format('Y-m-d') : date('Y-m-d', strtotime(now())) }}">
                </div>

                <div class="col-md-6">
                    <label>@langucw('delivery time')</label>
                    <input autocomplete="off" class="form-field timepicker" type="text" id="delivery_time2"
                        name="delivery_time2" value='{{ old('delivery_time') ?? $entity?->delivery_time }}'
                        placeholder="@langucw('delivery time')">
                </div>

                <div class="col-md-12">
                    <label>@langucw('street name')</label>
                    <textarea autocomplete="off" class="form-field" id="place" name="place"></textarea>
                </div>

                <div class="col-md-12">
                    <label>@langucw('notes')</label>
                    <textarea autocomplete="off" class="form-field" id="notes_textarea" name="notes_textarea"></textarea>
                </div>
            </div>

        </div>












    </div>

</div>
@php
    $minDate = '0';
@endphp

@if ($special == 1)
    @php
        $minDate = '+1';
    @endphp
@endif


@php
    $timestamp = strtotime(now()) + 90 * 60;

    $time = date('H:i', $timestamp);
    // dd($time);
@endphp
@section('footer')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intl-tel-input@25.2.1/build/css/intlTelInput.css">

    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.14.1/themes/base/jquery-ui.css">
    <script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
    <script src="https://code.jquery.com/ui/1.14.1/jquery-ui.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/intl-tel-input@25.2.1/build/js/intlTelInput.min.js"></script>
    <script>
        const input = document.querySelector("#phone_number");
        window.intlTelInput(input, {
            loadUtils: () => import("https://cdn.jsdelivr.net/npm/intl-tel-input@25.2.1/build/js/utils.js"),
            initialCountry: "auto",
            geoIpLookup: callback => {
                fetch("https://ipapi.co/json")
                    .then(res => res.json())
                    .then(data => callback(data.country_code))
                    .catch(() => callback("us"));
            },
        });
    </script>
    <style>
        .ui-datepicker-calendar td {
            display: table-cell;
        }
        .is-invalid {
    border: 1px solid red !important;!i;!;
}
    </style>
    <script>
        function getFormattedDate(date) {
            const [day, month, year] = date.split('/').map(Number); // Parse input
            return `${day}/${month}/${year}`; // Standardize format without leading zeros
        }

        function GetTodayDate() {
            var tdate = new Date();
            var dd = tdate.getDate(); //yields day
            var MM = tdate.getMonth(); //yields month
            var yyyy = tdate.getFullYear(); //yields year
            var currentDate = (MM + 1) + "/" + dd + "/" + yyyy;

            return currentDate;
        }
        $(function() {
            var now = new Date();
            $(".datepicker").datepicker({
                minDate: {{ $minDate }},
                onSelect: function(selectedDate) {
                    $('input.timepicker').timepicker('destroy');
                    // custom callback logic here
                    console.log(GetTodayDate());
                    console.log(selectedDate);

                    if (getFormattedDate(selectedDate) == GetTodayDate()) {
                        $('input.timepicker').val('')

                        $('input.timepicker').timepicker({
                            timeFormat: 'h:mm p',
                            interval: 30,
                            minTime: '{{ $time }}',
                            maxTime: '11:59pm',
                            defaultTime: '10',
                            startTime: '08:30am',
                            dynamic: false,
                            dropdown: true,
                            scrollbar: true
                        });
                        console.log('hereeeee');

                    } else {
                        $('input.timepicker').timepicker({
                            timeFormat: 'h:mm p',
                            interval: 30,
                            maxTime: '11:59pm',
                            defaultTime: '10',
                            startTime: '08:30am',
                            minTime: '08:30am',
                            dynamic: false,
                            dropdown: true,
                            scrollbar: true
                        });
                    }
                }
            });
        });
    </script>



    <script>
        $(document).ready(function() {
            $('input.timepicker').timepicker({
                timeFormat: 'h:mm p',
                interval: 30,
                maxTime: '11:59pm',
                minTime: '08:30am',
                startTime: '08:30am',
                dynamic: false,
                dropdown: true,
                scrollbar: true
            });
        });
    </script>
@endsection
