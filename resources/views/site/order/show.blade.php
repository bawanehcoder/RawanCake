@extends('site.layout.master')
@section('title')
    @langucw('my order')
@endsection
@section('css') @endsection
@section('breadcrumb')

    <li><a href="{{route('home')}}">@langucw('home')</a></li>
    <li><a href="{{route('myprofile.index')}}">@langucw('my account')</a></li>
    <li>@langucw('my order')</li>
    <li>@langucw('show')</li>

@endsection
@section('content')

    <div class="container mt-5">
        @include('components.messagesAndErrors')
    <div class="row pad-md-100">
        <div class="col">
            <div class="card ">
                <div class="card-header">

                    <div ><label>{{ trans('general.order_details')}}</label></div>
                    <div ><label>@langucw('order number') : {{$entity->id}}</label></div>
                    <div ><label>@langucw('payment method') : {{$entity->PaymentMethod}}</label></div>

                    <div class="form-group row">

                        <div class="col"><label
                                for="first-name">{{$entity->delivery_type  =='personal_pickup'? __('branch pickup') ." : ". $entity->branch['Addres'.getLang()] :$entity->zone['Addres'.getLang()]}}</label>
                        </div>
                        <div class="col-sm-2 col-form-label"><label for="first-name">@langucw('address')</label></div>

                        <div class="col-sm-4"><label for="first-name">{{$entity->Name}}</label></div>
                        <div class="col-sm-2 col-form-label"><label for="first-name">{{trans('general.name')}}</label></div>

                        <div class="col-sm-4"><label for="first-name">{{$entity->Phone}}</label></div>
                        <div class="col-sm-2 col-form-label"><label for="first-name">@langucw('phone number')</label>
                        </div>
                        <div class="col-sm-4"><label
                                for="first-name">{{$entity->OrderDate}} {{getDayNames($entity->DeliveryTime)}}</label>
                        </div>
                        <div class="col-sm-2 col-form-label"><label for="first-name">@langucw('delivery time')</label>
                        </div>


                    </div>
                    <div class="col"><label>{{ trans('general.order_details')}}</label></div>

                </div>
                <div class="card-body">
                    <table class="">
                        <thead>
                        <tr>
                            <th >#</th>
                            <th >@langucw('product')</th>
                            <th >@langucw('price')</th>
                            <th >@langucw('quantity')</th>
                            <th >@langucw('total')</th>
                            <th >@langucw('notes')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php $subtotal=0;



                        @endphp
                        @foreach($entity->order_details??[] as $index=>$item)

                            <tr>
                                <td >{{$index}}</td>
                                <td >{{$item->item->getTitle()}} ({{$item->item->price()}})

                                    @if($item->optionDetil())
                                        @foreach($item->optionDetil()->get()??[] as $option)
                                            <br>
                                            {{$option->subOption->getTitle()}} ({{$option->AdditionalValue}})

                                        @endforeach
                                    @endif


                                    {{--                                    <br> {{$item->optionDetil?$item->optionDetil->subOption->getTitle():''}}--}}

                                </td>
                                <td >{{number_format((float)($item->Price), 2, '.', '')}} {{$currency}}</td>
                                <td >{{$item->Quantity}} </td>
                                @php $subtotal+=$item->Price*$item->Quantity; @endphp
                                <td >{{number_format((float)($item->Price*$item->Quantity), 2, '.', '')}} {{$currency}}</td>
                                <td >{{$entity->Note}} </td>
                            </tr>
                        @endforeach
                        <tr>
                            <td style="border: none;" ></td>
                            <td style="border: none;" ></td>
                            <td style="border: none;" ></td>
                            <td style="border: none;" ></td>
                            <td style="border: none;" >@langucw('subtotal')</td>
                            <td style="border: none;" class="chart-center subtotal"><span
                                    id="subtotal">{{number_format((float)$subtotal, 2, '.', '')}}</span> {{$currency}}
                            </td>
                        </tr>
                        <tr>
                            <td style="border: none;" ></td>
                            <td style="border: none;" ></td>
                            <td style="border: none;" ></td>
                            <td style="border: none;" ></td>
                            <td style="border: none;" >@langucw('delivery fee')</td>
                            <td style="border: none;" class="chart-center subtotal"><span
                                    id="subtotal">{{number_format((float)$entity->ZonePrice, 2, '.', '')}}</span> {{$currency}}
                            </td>
                        </tr>
                        <tr>
                            <td style="border: none;" ></td>
                            <td style="border: none;" ></td>
                            <td style="border: none;" ></td>
                            <td style="border: none;" ></td>
                            <td style="border: none;" >{{trans('general.discount')}}</td>
                            <td style="border: none;" class="chart-center subtotal"><span
                                    id="subtotal">{{number_format((float)$entity->Discount, 2, '.', '')}}</span> {{$currency}}
                            </td>
                        </tr>
                        <tr>
                            <td style="border: none;" ></td>
                            <td style="border: none;" ></td>
                            <td style="border: none;" ></td>
                            <td style="border: none;" ></td>
                            <td style="border: none;" >@langucw('total amount')</td>
                            <td style="border: none;" class="chart-center subtotal"><span
                                    id="subtotal">{{number_format((float)$entity->Total, 2, '.', '')}}</span> {{$currency}}
                            </td>
                        </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    </div>


@endsection
@section('scripts')

@endsection
